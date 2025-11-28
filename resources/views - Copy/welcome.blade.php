<!-- resources/views/welcome.blade.php -->
@extends('layouts.app')

@section('title', 'Welcome - ' . config('app.name'))

@section('content')
<div class="page page-center">
    <div class="container container-tight py-4">
        <div class="text-center mb-4">
            <h1>🏛️ {{ config('app.name') }}</h1>
            <p class="text-muted">Government Education Management System</p>
        </div>

        @if(Auth::check())
            <div class="text-center">
                <div class="mb-3">
                    <h2>Welcome back, {{ Auth::user()->name }}!</h2>
                    <p class="text-muted">You are logged in as <strong>{{ Auth::user()->getRoleNames()->first() }}</strong></p>
                </div>
                <a href="{{ route('dashboard') }}" class="btn btn-primary btn-lg">
                    📊 Go to Dashboard
                </a>
            </div>
        @else
            <div class="card card-md">
                <div class="card-body text-center">
                    <h2 class="h2 mb-4">Welcome to Education Portal</h2>
                    <p class="text-muted mb-4">
                        Government Education Management System with Multi-level Access Control.
                        Please login using your authorized credentials.
                    </p>

                    <div class="mb-3">
                        <a href="{{ route('sso.login') }}" class="btn btn-primary btn-lg">
                            🔐 Login with SSO
                        </a>
                    </div>

                    <div class="text-muted small">
                        Secure authentication through Government SSO Portal
                    </div>
                </div>
            </div>

            <div class="text-center text-muted mt-3">
                <div class="row">
                    <div class="col-4">
                        <div class="h3">🔒</div>
                        <div class="text-muted">Secure Access</div>
                    </div>
                    <div class="col-4">
                        <div class="h3">👥</div>
                        <div class="text-muted">Multi-Role</div>
                    </div>
                    <div class="col-4">
                        <div class="h3">📊</div>
                        <div class="text-muted">Real-time Data</div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
