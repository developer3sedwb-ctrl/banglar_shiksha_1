<?php
// app/Services/SSOService.php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class SSOService
{
    protected $authServer;

    public function __construct()
    {
        $this->authServer = config('sso.auth_server');
    }

 /**
     * Verify SSO token with central server
     */
    public function verifyToken(string $token): ?array
    {
        try {
            Log::info('Attempting SSO token verification', [
                'auth_server' => $this->authServer,
                'token_prefix' => substr($token, 0, 10) . '...',
                'api_key_prefix' => substr(config('sso.api_key'), 0, 10) . '...'
            ]);

            $response = Http::timeout(15)
                ->retry(2, 100)
                ->withHeaders([
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                    'X-Requested-With' => 'XMLHttpRequest',
                ])
                ->post($this->authServer . '/api/sso/verify-token', [
                    'session_token' => $token,
                    'api_key' => config('sso.api_key'),
                    'secret_key' => config('sso.secret_key'),
                ]);

            Log::info('SSO verification response', [
                'status' => $response->status(),
                'success' => $response->successful(),
                'headers' => $response->headers(),
                'body' => $response->body()
            ]);

            if ($response->successful()) {
                $data = $response->json();

                if ($data['success'] ?? false) {
                    Log::info('SSO token verification successful', [
                        'user_id' => $data['user']['id'] ?? 'unknown',
                        'email' => $data['user']['email'] ?? 'unknown'
                    ]);
                    return $data;
                }

                Log::warning('SSO token verification failed - server returned false', [
                    'response' => $data,
                    'token' => substr($token, 0, 10) . '...'
                ]);
            } else {
                Log::error('SSO server error', [
                    'status' => $response->status(),
                    'response' => $response->body(),
                    'url' => $this->authServer . '/api/sso/verify-token'
                ]);
            }
        } catch (\Exception $e) {
            Log::error('SSO verification exception', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'exception_type' => get_class($e)
            ]);
        }

        return null;
    }

    /**
     * Validate application credentials
     */
    public function validateApplication(): bool
    {
        try {
            $response = Http::timeout(10)
                ->withHeaders([
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                    'X-Requested-With' => 'XMLHttpRequest',
                ])
                ->post($this->authServer . '/api/sso/validate-application', [
                    'api_key' => config('sso.api_key'),
                    'secret_key' => config('sso.secret_key'),
                ]);

            Log::info('Application validation response', [
                'status' => $response->status(),
                'body' => $response->body()
            ]);

            return $response->successful() && ($response->json('valid') ?? false);
        } catch (\Exception $e) {
            Log::error('SSO application validation failed: ' . $e->getMessage());
            return false;
        }
    }
    /**
     * Login with credentials (for API authentication)
     */
    public function loginWithCredentials(string $email, string $password): ?array
    {
        try {
            $response = Http::timeout(15)
                ->post($this->authServer . '/api/sso/direct-login', [
                    'email' => $email,
                    'password' => $password,
                    'api_key' => config('sso.api_key'),
                    'secret_key' => config('sso.secret_key'),
                ]);

            if ($response->successful()) {
                $data = $response->json();

                if ($data['success'] ?? false) {
                    return $data;
                }

                Log::warning('SSO direct login failed', [
                    'email' => $email,
                    'response' => $data
                ]);
            }
        } catch (\Exception $e) {
            Log::error('SSO direct login exception: ' . $e->getMessage());
        }

        return null;
    }

    /**
     * Create API token for user
     */
    public function createApiToken(int $userId, string $tokenName = 'api-token'): ?array
    {
        try {
            $response = Http::timeout(10)
                ->post($this->authServer . '/api/sso/create-api-token', [
                    'user_id' => $userId,
                    'token_name' => $tokenName,
                    'api_key' => config('sso.api_key'),
                    'secret_key' => config('sso.secret_key'),
                ]);

            if ($response->successful()) {
                return $response->json();
            }
        } catch (\Exception $e) {
            Log::error('SSO create API token failed: ' . $e->getMessage());
        }

        return null;
    }

    /**
     * Logout from central server
     */
    public function logout(string $sessionToken): bool
    {
        try {
            $response = Http::timeout(10)
                ->post($this->authServer . '/api/sso/logout', [
                    'session_token' => $sessionToken,
                    'api_key' => config('sso.api_key'),
                    'secret_key' => config('sso.secret_key'),
                    'reason' => 'client_logout',
                ]);

            return $response->successful() && ($response->json('success') ?? false);
        } catch (\Exception $e) {
            Log::error('SSO logout failed: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Get user info from central server
     */
    public function getUserInfo(int $userId): ?array
    {
        try {
            $response = Http::timeout(10)
                ->post($this->authServer . '/api/sso/get-user', [
                    'user_id' => $userId,
                    'api_key' => config('sso.api_key'),
                    'secret_key' => config('sso.secret_key'),
                ]);

            if ($response->successful()) {
                return $response->json('user');
            }
        } catch (\Exception $e) {
            Log::error('SSO get user info failed: ' . $e->getMessage());
        }

        return null;
    }


    /**
     * Refresh token
     */
    public function refreshToken(string $refreshToken): ?array
    {
        try {
            $response = Http::timeout(10)
                ->post($this->authServer . '/api/sso/refresh-token', [
                    'refresh_token' => $refreshToken,
                    'api_key' => config('sso.api_key'),
                    'secret_key' => config('sso.secret_key'),
                ]);

            if ($response->successful()) {
                return $response->json();
            }
        } catch (\Exception $e) {
            Log::error('SSO token refresh failed: ' . $e->getMessage());
        }

        return null;
    }
}
