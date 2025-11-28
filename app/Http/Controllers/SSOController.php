<?php
// app/Http/Controllers/SSOController.php  (Client app 8002)

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use App\Services\SSOService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class SSOController extends Controller
{
    protected $ssoService;

    public function __construct(SSOService $ssoService)
    {
        $this->ssoService = $ssoService;
    }

    /**
     * Handle SSO callback from central auth server
     */
    public function callback(Request $request)
    {
        $ssoToken = $request->get('sso_token');
        $userId = $request->get('user_id');
        $redirectUrl = $request->get('redirect_url', '/dashboard');

        Log::info('SSO callback received', [
            'user_id' => $userId,
            'has_token' => !empty($ssoToken),
            'redirect_url' => $redirectUrl
        ]);

        if (!$ssoToken) {
            Log::error('SSO callback missing token');
            return $this->redirectToLogin('Invalid SSO response');
        }

        // Verify token with central server
        $verificationResult = $this->ssoService->verifyToken($ssoToken);

        if (!$verificationResult) {
            Log::error('SSO token verification failed');
            return $this->redirectToLogin('Authentication failed. Please try again.');
        }

        // Store session data and login user
        $this->createWebSession($verificationResult);

        Log::info('SSO login successful', [
            'user_id' => $verificationResult['user']['id'],
            'email' => $verificationResult['user']['email']
        ]);

        // Redirect to intended URL
        return redirect($redirectUrl);
    }


    /**
     * Show local login page (optional)
     */
    public function showLogin()
    {
        // If already authenticated, redirect to dashboard
        if (Auth::check()) {
            return redirect('/dashboard');
        }

        // Check if the login view exists, if not redirect to SSO directly
        if (!view()->exists('auth.login')) {
            return redirect()->route('sso.login');
        }

        return view('auth.login');
    }

    /**
     * Handle local login with credentials
     */
    public function loginWithCredentials(Request $request)
    {
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            if ($request->expectsJson()) {
                return response()->json([
                    'error' => 'Validation failed',
                    'messages' => $validator->errors()
                ], 422);
            }
            return back()->withErrors($validator)->withInput();
        }

        $loginResult = $this->ssoService->loginWithCredentials(
            $request->email,
            $request->password
        );

        if (!$loginResult) {
            $error = 'Invalid credentials. Please try again.';

            if ($request->expectsJson()) {
                return response()->json([
                    'error' => 'Authentication failed',
                    'message' => $error
                ], 401);
            }

            return back()->with('error', $error)->withInput();
        }

        // For API response, return token
        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'user' => $loginResult['user'],
                'session' => $loginResult['session'],
                'access_token' => $loginResult['session']['token'],
                'token_type' => 'bearer',
                'expires_at' => $loginResult['session']['last_activity_at']
            ]);
        }

        // For web request, create session and login user
        $this->createWebSession($loginResult);

        $redirectUrl = $request->get('redirect_url', '/dashboard');
        return redirect($redirectUrl);
    }

    /**
     * Initiate SSO login
     */
    public function login(Request $request)
    {
        // If already authenticated with Laravel Auth, redirect to dashboard
        if (Auth::check()) {
            Log::info('SSO login attempted but user already authenticated via Auth', [
                'user_id' => Auth::id(),
                'email' => Auth::user()->email ?? null
            ]);

            return redirect()->route('dashboard');
        }

        $redirectUrl = $request->get('redirect_url', $request->fullUrl());

        $ssoLoginUrl = config('sso.auth_server') . '/login?' . http_build_query([
            'app_id' => config('sso.app_id'),
            'redirect_url' => url($redirectUrl),
        ]);

        return redirect($ssoLoginUrl);
    }



    /**
     * Handle logout from client application with global logout
     */
    public function logout(Request $request)
    {
        $user = Auth::user();
        $sessionToken = Session::get('sso_session_token');

        Log::info('Client app logout initiated', [
            'user_id' => $user ? $user->id : null,
            'email' => $user ? $user->email : null,
            'has_session_token' => !empty($sessionToken),
            'logout_type' => 'client_initiated'
        ]);

        // Notify central server about global logout
        if ($user && $sessionToken) {
            $this->notifyCentralGlobalLogout($user, $sessionToken);
        }

        // Clear local session
        $this->clearLocalSession();

        // For API requests, return JSON response
        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Successfully logged out from all applications'
            ]);
        }

        // For web requests, redirect to home page
        return redirect('/')->with('success', 'You have been successfully logged out from all applications.');
    }


    /**
     * Handle logout callback from central server
     */
    public function logoutCallback(Request $request)
    {
        Log::info('Central logout callback received', [
            'session_token' => $request->get('session_token'),
            'user_id' => $request->get('user_id'),
            'logout_reason' => $request->get('logout_reason'),
            'ip' => $request->ip()
        ]);

        // Validate required parameters
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'session_token' => 'required|string',
            'user_id' => 'required|integer',
            'timestamp' => 'required|integer',
            'signature' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Missing required parameters',
                'errors' => $validator->errors()
            ], 400);
        }

        DB::table('sessions')->where('user_id', $request->get('user_id'))->delete();
        Log::info('User session deleted from database', ['user_id' => $request->get('user_id')]);

        $sessionToken = $request->input('session_token');
        $userId = $request->input('user_id');
        $timestamp = $request->input('timestamp');
        $signature = $request->input('signature');

        // Verify signature
        $signatureData = $timestamp . $sessionToken . $userId;
        $expectedSignature = hash_hmac('sha256', $signatureData, config('sso.secret_key'));

        if (!hash_equals($signature, $expectedSignature)) {
            Log::warning('Invalid logout signature');
            return response()->json(['success' => false, 'message' => 'Invalid signature'], 403);
        }

        // Check timestamp
        if (abs(time() - $timestamp) > 300) {
            return response()->json(['success' => false, 'message' => 'Expired request'], 400);
        }

        // Clear local session
        $this->clearLocalSession();

        Log::info('Central logout processed successfully', [
            'user_id' => $userId,
            'logout_reason' => $request->get('logout_reason')
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Logged out successfully from client application'
        ]);
    }

    /**
     * Notify central server about global logout
     */
    private function notifyCentralGlobalLogout($user, $sessionToken)
    {
        try {
            $timestamp = now()->timestamp;
            $appId = config('sso.app_id');

            $payload = [
                'user_id' => $user->id,
                'session_token' => $sessionToken,
                'app_id' => $appId,
                'timestamp' => $timestamp,
            ];

            // Generate signature for central server verification
            $signatureData = $timestamp . $sessionToken . $user->id . $appId;
            $payload['signature'] = hash_hmac('sha256', $signatureData, config('sso.secret_key'));

            $centralLogoutUrl = config('sso.auth_server') . '/api/sso/global-logout';

            Log::info('Notifying central server about global logout', [
                'central_logout_url' => $centralLogoutUrl,
                'user_id' => $user->id,
                'app_id' => $appId,
                'has_session_token' => !empty($sessionToken)
            ]);

            $response = Http::timeout(8)
                ->withOptions(['verify' => false])
                ->post($centralLogoutUrl, $payload);

            return $response->successful() && $response->json('success');
        } catch (\Exception $e) {
            Log::error('Failed to notify central server about global logout: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Clear local session completely
     */
    private function clearLocalSession(): void
    {
        Auth::logout();
        Session::flush();
        Session::invalidate();
        Session::regenerateToken();

        Log::info('Local session cleared completely');
    }

    /**
     * Handle logout callback from central server
     */
    public function logoutFromCentral(Request $request)
    {
        Log::info('Central logout callback received', [
            'session_token' => $request->get('session_token'),
            'user_id' => $request->get('user_id'),
            'logout_reason' => $request->get('logout_reason'),
            'ip' => $request->ip()
        ]);

        // Validate required parameters
        $validator = Validator::make($request->all(), [
            'session_token' => 'required|string',
            'user_id' => 'required|integer',
            'timestamp' => 'required|integer',
            'signature' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Missing required parameters',
                'errors' => $validator->errors()
            ], 400);
        }

        $sessionToken = $request->input('session_token');
        $userId = $request->input('user_id');
        $timestamp = $request->input('timestamp');
        $signature = $request->input('signature');
        $logoutReason = $request->input('logout_reason', 'central_logout');

        // Verify signature
        $signatureData = $timestamp . $sessionToken . $userId;
        $expectedSignature = hash_hmac('sha256', $signatureData, config('sso.secret_key'));

        if (!hash_equals($signature, $expectedSignature)) {
            Log::warning('Invalid logout signature', [
                'expected' => $expectedSignature,
                'received' => $signature
            ]);
            return response()->json(['success' => false, 'message' => 'Invalid signature'], 403);
        }

        // Check timestamp
        if (abs(time() - $timestamp) > 300) {
            return response()->json(['success' => false, 'message' => 'Expired request'], 400);
        }

        // Verify the session token matches our current session
        $currentSessionToken = Session::get('sso_session_token');

        Log::info('Verifying session token for logout callback', [
            'received_token' => $sessionToken ? substr($sessionToken, 0, 10) . '...' : 'null',
            'current_token' => $currentSessionToken ? substr($currentSessionToken, 0, 10) . '...' : 'null'
        ]);

        if ($currentSessionToken !== $sessionToken) {
            Log::warning('Session token mismatch in logout callback', [
                'received_token' => $sessionToken ? substr($sessionToken, 0, 10) . '...' : 'null',
                'current_token' => $currentSessionToken ? substr($currentSessionToken, 0, 10) . '...' : 'null'
            ]);

            // Even if tokens don't match, we should still clear local session for security
        }

        // Clear local session using Auth facade
        $this->clearLocalSession();

        Log::info('Central logout processed successfully', [
            'user_id' => $userId,
            'logout_reason' => $logoutReason
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Logged out successfully from client application'
        ]);
    }


    /**
     * Get current user info (API endpoint)
     */
    public function user(Request $request)
    {
        // Check Laravel Auth authentication first
        if (Auth::check()) {
            $user = Auth::user();
            $session = Session::get(config('sso.session.session_data'));

            return response()->json([
                'user' => $user,
                'session' => $session,
            ]);
        }

        // Fallback to SSO session data
        if (Session::get(config('sso.session.authenticated'))) {
            $user = Session::get(config('sso.session.user'));
            $session = Session::get(config('sso.session.session_data'));

            return response()->json([
                'user' => $user,
                'session' => $session,
            ]);
        }
        // Check API token authentication
        elseif ($request->attributes->get('sso_user')) {
            $user = $request->attributes->get('sso_user');
            $session = $request->attributes->get('sso_session');

            return response()->json([
                'user' => $user,
                'session' => $session,
            ]);
        } else {
            return response()->json(['error' => 'Unauthenticated'], 401);
        }
    }

    /**
     * Health check endpoint
     */
    public function health()
    {
        $appStatus = $this->ssoService->validateApplication();

        return response()->json([
            'status' => 'healthy',
            'sso_connected' => $appStatus,
            'timestamp' => now()->toISOString(),
            'service' => 'SSO Client API',
            'user_authenticated' => Auth::check()
        ]);
    }

    /**
     * Helper method to create web session and login user
     */
    private function createWebSession(array $authData): void
    {
        // Get or create local user
        $user = $this->getOrCreateLocalUser($authData['user']);
        // dd($user);
        // Login user with Laravel Auth
        Auth::login($user);

        // Store SSO session data
        Session::put(config('sso.session.authenticated'), true);
        Session::put(config('sso.session.user'), $authData['user']);
        Session::put(config('sso.session.session_data'), $authData['session']);
        Session::put('sso_last_validation', time());
        Session::put('sso_session_token', $authData['session']['token']); // Store token separately for easy access
    }



    /**
     * Get or create local user based on SSO user data
     */
    private function getOrCreateLocalUser(array $ssoUser)
    {
        // Try to find user by SSO ID or email
        // dd($ssoUser);
        $user = User::where('dise_code', $ssoUser['dise_code'])
            ->orWhere('email', $ssoUser['email'])
            ->first();

        // if (!$user) {
        //     // Create new user
        //     $user = User::create([
        //         'sso_id' => $ssoUser['id'],
        //         'name' => $ssoUser['name'],
        //         'email' => $ssoUser['email'],
        //         'password' => bcrypt(Str::random(32)),
        //         'email_verified_at' => now(),
        //     ]);
        // } else {
        //     // Update existing user with latest SSO data
        //     $user->update([
        //         'sso_id' => $ssoUser['id'],
        //         'name' => $ssoUser['name'],
        //         'email' => $ssoUser['email'],
        //     ]);
        // }

        return $user;
    }

    /**
     * Helper method to redirect to login with error handling
     */
    private function redirectToLogin(string $error = null)
    {
        if (view()->exists('auth.login')) {
            return $error ? redirect('/login')->with('error', $error) : redirect('/login');
        }

        // If login view doesn't exist, redirect to SSO directly
        return $error
            ? redirect()->route('sso.login')->with('error', $error)
            : redirect()->route('sso.login');
    }
}
