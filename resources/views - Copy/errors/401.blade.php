<!-- resources/views/errors/401.blade.php -->
@extends('layouts.app')

@section('title', 'Unauthorized')

@section('content')
<div class="page page-center">
    <div class="container-tight py-4">
        <div class="empty">
            <div class="empty-header">401</div>
            <p class="empty-title">Unauthorized Access</p>
            <p class="empty-subtitle text-muted">
                You need to be authenticated to access this page.
            </p>
            <div class="empty-action">
                <a href="{{ route('sso.login') }}" class="btn btn-primary">
                    🔐 Login with SSO
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
