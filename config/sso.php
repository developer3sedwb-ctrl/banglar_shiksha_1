<?php

// config/sso.php (Client App)
return [
    'auth_server' => env('SSO_AUTH_SERVER', 'http://localhost:8000'),
    'app_id' => env('SSO_APP_ID'),
    'api_key' => env('SSO_API_KEY'),
    'secret_key' => env('SSO_SECRET_KEY'),
    'auto_redirect' => env('SSO_AUTO_REDIRECT', true),

    'session' => [
        'authenticated' => 'sso_authenticated',
        'user' => 'sso_user',
        'session_data' => 'sso_session_data',
    ],

    'routes' => [
        'login_callback' => '/sso/callback',
        'logout_callback' => '/sso/logout-callback',
    ],

    // API endpoints
    'endpoints' => [
        'user_create' => '/api/sso/users/create',
        'user_update' => '/api/sso/users/update',
        'user_delete' => '/api/sso/users/delete',
        'global_logout' => '/api/sso/global-logout',
    ],

    'timeout' => 10,
];
