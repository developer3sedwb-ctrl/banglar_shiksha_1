<!-- resources/views/errors/404.blade.php -->
@extends('layouts.app')

@section('title', 'Page Not Found')

@section('content')
<div class="page page-center">
    <div class="container-tight py-4">
        <div class="empty">
            <div class="empty-header">404</div>
            <p class="empty-title">Page Not Found</p>
            <p class="empty-subtitle text-muted">
                The page you are looking for does not exist.
            </p>
            <div class="empty-action">
                <a href="{{ route('dashboard') }}" class="btn btn-primary">
                    ← Back to Dashboard
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
