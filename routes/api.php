<?php
// routes/api.php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SSOController;
use Illuminate\Support\Facades\Request;
// use App\Http\Controllers\Api\UserController;

// Public API routes
Route::get('/health', [SSOController::class, 'health']);
Route::post('/login', [SSOController::class, 'loginWithCredentials']);
Route::post('/refresh-token', [SSOController::class, 'refreshToken']);

Route::post('/sso/logout', [SSOController::class, 'logoutCallback']);

Route::prefix('sso')->group(function () {
    Route::post('/callback', [SSOController::class, 'callback']);
    Route::post('/logout-callback', [SSOController::class, 'logoutCallback']);
    Route::post('/login-with-credentials', [SSOController::class, 'loginWithCredentials']);
    Route::get('/user', [SSOController::class, 'user']);
});


// Protected API routes
Route::middleware(['sso.auth'])->group(function () {
    // User management

    Route::get('/api/user', [SSOController::class, 'user'])->name('api.user');
    Route::get('/user', [SSOController::class, 'user']);
    Route::post('/user/token', [SSOController::class, 'createApiToken']);
    Route::post('/logout', [SSOController::class, 'logout']);

    // User profile endpoints
    // Route::get('/profile', [UserController::class, 'profile']);
    // Route::put('/settings', [UserController::class, 'updateSettings']);
    // Route::get('/dashboard', [UserController::class, 'dashboard']);


    // Example resource endpoints
    Route::get('/projects', function (Request $request) {
        // $user = $request->attributes->get('sso_user');

        return response()->json([
            'projects' => [
                ['id' => 1, 'name' => 'Project Alpha', 'status' => 'active'],
                ['id' => 2, 'name' => 'Project Beta', 'status' => 'completed'],
            ],
            // 'user' => $user
        ]);
    });
});
