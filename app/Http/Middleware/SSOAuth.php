<?php
// app/Http/Middleware/SSOAuth.php (Client App - Port 8002)

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class SSOAuth
{
    protected $authServer;

    public function __construct()
    {
        $this->authServer = config('sso.auth_server');
    }

    public function handle(Request $request, Closure $next): Response
    {
        // Skip authentication for SSO callback routes and public endpoints
        if ($this->shouldSkipAuthentication($request)) {
            // return $next($request);
            return $this->handleAuthenticatedRequest($request, $next);
        }

        // Check if user is already authenticated via Laravel Auth
        if (Auth::check()) {
            return $next($request);
        }

        // Check if user is authenticated via SSO session
        if ($this->isAuthenticatedViaSSO()) {
            // Sync SSO session with Laravel Auth
            $this->syncSSOWithAuth();
            return $next($request);
        }

        // Check for API token authentication
        if ($this->authenticateViaApiToken($request)) {
            return $next($request);
        }

        // Try auto-login from central portal (cross-port)
        if ($this->tryAutoLoginFromCentral($request)) {
            return $next($request);
        }

        // Handle unauthenticated request
        return $this->handleUnauthenticated($request);
    }

        /**
     * Handle authenticated user request
     */
    protected function handleAuthenticatedRequest(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Add headers to prevent caching of authenticated pages
        return $response->withHeaders([
            'Cache-Control' => 'no-cache, no-store, must-revalidate',
            'Pragma' => 'no-cache',
            'Expires' => '0',
        ]);
    }

    protected function tryAutoLoginFromCentral(Request $request): bool
    {
        try {
            Log::info('Attempting cross-port auto-login', [
                'client_app' => config('app.url'),
                'central_server' => $this->authServer,
                'app_id' => config('sso.app_id')
            ]);

            // Use a fresh HTTP client without cookie sharing to avoid session conflicts
            $response = Http::timeout(5)
                ->withOptions(['verify' => false])
                ->withHeaders([
                    'Accept' => 'application/json',
                    'X-Requested-With' => 'XMLHttpRequest'
                ])
                ->get($this->authServer . '/check-login');

            Log::info('Central login check response', [
                'status' => $response->status(),
                'logged_in' => $response->successful() ? $response->json('logged_in') : 'failed'
            ]);

            if ($response->successful() && $response->json('logged_in')) {
                Log::info('User logged in centrally, getting auto-login token');

                // Get auto-login token for THIS specific application
                $autoLoginResponse = Http::timeout(10)
                    ->withOptions(['verify' => false])
                    ->withHeaders([
                        'Accept' => 'application/json',
                        'X-Requested-With' => 'XMLHttpRequest'
                    ])
                    ->get($this->authServer . '/auto-login/' . config('sso.app_id'));

                if ($autoLoginResponse->successful() && $autoLoginResponse->json('success')) {
                    $data = $autoLoginResponse->json();

                    Log::info('Auto-login token received', [
                        'has_token' => !empty($data['sso_token']),
                        'session_reused' => $data['session_reused'] ?? false
                    ]);

                    // Verify the auto-login token
                    $verificationResponse = Http::timeout(10)
                        ->withOptions(['verify' => false])
                        ->post($this->authServer . '/api/sso/verify-token', [
                            'session_token' => $data['sso_token'],
                            'api_key' => config('sso.api_key'),
                            'secret_key' => config('sso.secret_key'),
                        ]);

                    if ($verificationResponse->successful() && $verificationResponse->json('success')) {
                        $verificationData = $verificationResponse->json();

                        // Store session data and login user
                        $this->createWebSession($verificationData);

                        Log::info('Cross-port auto-login successful', [
                            'client_app' => config('app.url'),
                            'user_id' => $verificationData['user']['id'],
                            'email' => $verificationData['user']['email']
                        ]);

                        return true;
                    } else {
                        Log::warning('Token verification failed', [
                            'status' => $verificationResponse->status(),
                            'response' => $verificationResponse->body()
                        ]);
                    }
                } else {
                    Log::warning('Auto-login token request failed', [
                        'status' => $autoLoginResponse->status(),
                        'response' => $autoLoginResponse->body()
                    ]);
                }
            }
        } catch (\Exception $e) {
            Log::error('Cross-port auto-login failed', [
                'client_app' => config('app.url'),
                'central_server' => $this->authServer,
                'error' => $e->getMessage()
            ]);
        }

        return false;
    }

    protected function isAuthenticatedViaSSO(): bool
    {
        return Session::get(config('sso.session.authenticated')) === true;
    }

    protected function shouldSkipAuthentication(Request $request): bool
    {
        $skipRoutes = [
            'sso/callback',
            'sso/logout',
            'login',
            'health',
            'api/health',
            'up',
        ];

        foreach ($skipRoutes as $route) {
            if ($request->is($route)) {
                return true;
            }
        }

        return false;
    }

    protected function authenticateViaApiToken(Request $request): bool
    {
        $apiToken = $request->bearerToken() ?: $request->get('api_token');

        if (!$apiToken) {
            return false;
        }

        try {
            $response = Http::timeout(10)
                ->withOptions(['verify' => false])
                ->post($this->authServer . '/api/sso/verify-token', [
                    'session_token' => $apiToken,
                    'api_key' => config('sso.api_key'),
                    'secret_key' => config('sso.secret_key'),
                ]);

            if ($response->successful() && $response->json('success')) {
                $data = $response->json();

                $request->merge([
                    'sso_user' => $data['user'],
                    'sso_session' => $data['session'],
                    'api_authenticated' => true,
                ]);

                if ($request->expectsJson()) {
                    $request->attributes->set('sso_user', $data['user']);
                    $request->attributes->set('sso_session', $data['session']);
                    return true;
                }

                // Create web session and login user for web requests
                $this->createWebSession($data);
                return true;
            }
        } catch (\Exception $e) {
            Log::error('API token authentication failed: ' . $e->getMessage());
        }

        return false;
    }

    /**
     * Sync SSO session with Laravel Auth
     */
    protected function syncSSOWithAuth(): void
    {
        if ($this->isAuthenticatedViaSSO() && !Auth::check()) {
            $ssoUser = Session::get(config('sso.session.user'));

            if ($ssoUser) {
                $user = \App\Models\User::where('sso_id', $ssoUser['id'])
                                      ->orWhere('email', $ssoUser['email'])
                                      ->first();

                if ($user) {
                    Auth::login($user);
                    Log::info('Synced SSO session with Laravel Auth', [
                        'user_id' => $user->id,
                        'email' => $user->email
                    ]);
                }
            }
        }
    }

    /**
     * Create web session and login user
     */
    protected function createWebSession(array $authData): void
    {
        // Get or create local user
        $user = $this->getOrCreateLocalUser($authData['user']);

        // Assign role based on SSO data
        $user->assignRoleFromSSO($authData['user']);

        // Login user with Laravel Auth
        Auth::login($user);

        // Update last login
        $user->update(['last_login_at' => now()]);

        // Store SSO session data
        Session::put(config('sso.session.authenticated'), true);
        Session::put(config('sso.session.user'), $authData['user']);
        Session::put(config('sso.session.session_data'), $authData['session']);
        Session::put('sso_last_validation', time());
        Session::put('auto_logged_in', true);
    }

    /**
     * Get or create local user based on SSO user data
     */
    protected function getOrCreateLocalUser(array $ssoUser)
    {
        // Try to find user by SSO ID or email
        $user = \App\Models\User::where('sso_id', $ssoUser['id'])
                               ->orWhere('email', $ssoUser['email'])
                               ->first();

        if (!$user) {
            // Create new user
            $user = \App\Models\User::create([
                'sso_id' => $ssoUser['id'],
                'name' => $ssoUser['name'],
                'email' => $ssoUser['email'],
                'password' => bcrypt(\Illuminate\Support\Str::random(32)),
                'email_verified_at' => now(),
            ]);
        } else {
            // Update existing user with latest SSO data
            $user->update([
                'sso_id' => $ssoUser['id'],
                'name' => $ssoUser['name'],
                'email' => $ssoUser['email'],
            ]);
        }

        return $user;
    }

    protected function handleUnauthenticated(Request $request)
    {
        // Clear inconsistent session state
        if (Session::get('user_id') && !Auth::check()) {
            Session::flush();
        }

        // Auto-redirect to SSO server for web requests
        if (config('sso.auto_redirect') && !$request->expectsJson()) {
            return $this->redirectToSSO($request);
        }

        // Return JSON response for API requests
        if ($request->expectsJson()) {
            return response()->json([
                'error' => 'Unauthenticated',
                'message' => 'SSO authentication required',
                'auth_url' => $this->getSSOLoginUrl($request)
            ], 401);
        }

        // Show login page for web requests
        return redirect()->route('sso.login');
    }

    protected function redirectToSSO(Request $request)
    {
        $loginUrl = $this->getSSOLoginUrl($request);
        return redirect($loginUrl);
    }

    protected function getSSOLoginUrl(Request $request): string
    {
        return $this->authServer . '/login?' . http_build_query([
            'app_id' => config('sso.app_id'),
            'redirect_url' => $request->fullUrl(),
        ]);
    }
}
