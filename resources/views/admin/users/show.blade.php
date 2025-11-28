@extends('layouts.app')

@section('title', 'User Details')
@section('page-title', 'User Details')
@section('page-subtitle', 'View user information and permissions')

@section('content')
<div class="container-fluid">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard') }}">
                    <i class="bx bx-home-alt"></i> Dashboard
                </a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('admin.users.index') }}">
                    <i class="bx bx-user"></i> User Management
                </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                <i class="bx bx-user-circle"></i> User Details
            </li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title mb-0">User Information</h3>
                    <div class="card-actions d-flex gap-2">
                        <!-- Back Button -->
                        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary btn-sm">
                            <i class="bx bx-arrow-back me-1"></i> Back to Users
                        </a>

                        @can('edit users')
                        <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-primary btn-sm">
                            <i class="bx bx-edit me-1"></i> Edit User
                        </a>
                        @endcan
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-bordered">
                                <tr>
                                    <th width="40%">Name:</th>
                                    <td>{{ $user->name }}</td>
                                </tr>
                                <tr>
                                    <th>Email:</th>
                                    <td>{{ $user->email }}</td>
                                </tr>
                                <tr>
                                    <th>Phone:</th>
                                    <td>{{ $user->phone ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Department:</th>
                                    <td>{{ $user->department ?? 'N/A' }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-bordered">
                                <tr>
                                    <th width="40%">Designation:</th>
                                    <td>{{ $user->designation ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Status:</th>
                                    <td>
                                        <span class="badge {{ $user->status ? 'bg-success' : 'bg-danger' }}">
                                            <i class="bx {{ $user->status ? 'bx-check' : 'bx-x' }} me-1"></i>
                                            {{ $user->status ? 'Active' : 'Inactive' }}
                                        </span>
                                        @if($user->is_online)
                                        <span class="badge bg-success ms-1">
                                            <i class="bx bx-wifi me-1"></i>Online
                                        </span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Last Login:</th>
                                    <td>
                                        @if($user->last_login_at)
                                            <span class="d-flex align-items-center">
                                                <i class="bx bx-calendar me-2"></i>
                                                {{ $user->last_login_at->format('M j, Y g:i A') }}
                                            </span>
                                        @else
                                            <span class="text-muted">Never</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Registered:</th>
                                    <td>
                                        <span class="d-flex align-items-center">
                                            <i class="bx bx-calendar-plus me-2"></i>
                                            {{ $user->created_at->format('M j, Y g:i A') }}
                                        </span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <!-- User Avatar Section -->
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="card bg-light">
                                <div class="card-body text-center py-4">
                                    <div class="user-avatar-large mx-auto mb-3">
                                        {{ substr($user->name, 0, 1) }}
                                    </div>
                                    <h4 class="mb-1">{{ $user->name }}</h4>
                                    <p class="text-muted mb-2">{{ $user->email }}</p>
                                    <div class="d-flex justify-content-center gap-2 flex-wrap">
                                        <span class="badge bg-primary">{{ $user->roles->count() }} Roles</span>
                                        <span class="badge bg-info">{{ $user->getAllPermissions()->count() }} Permissions</span>
                                        <span class="badge bg-secondary">Member since {{ $user->created_at->format('M Y') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Roles & Permissions Section -->
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="mb-0">
                                    <i class="bx bx-shield-alt me-2"></i>Roles & Permissions
                                </h5>
                                <span class="badge bg-primary">
                                    {{ $user->getAllPermissions()->count() }} Total Permissions
                                </span>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead class="table-light">
                                        <tr>
                                            <th width="20%">Role</th>
                                            <th>Permissions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($user->roles as $role)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <i class="bx bx-shield-quarter me-2 text-primary"></i>
                                                    <span class="fw-bold">{{ $role->name }}</span>
                                                </div>
                                            </td>
                                            <td>
                                                @if($role->permissions->count() > 0)
                                                    <div class="d-flex flex-wrap gap-1">
                                                        @foreach($role->permissions as $permission)
                                                        <span class="badge bg-info d-flex align-items-center">
                                                            <i class="bx bx-check-shield me-1"></i>
                                                            {{ $permission->name }}
                                                        </span>
                                                        @endforeach
                                                    </div>
                                                @else
                                                    <span class="text-muted">No permissions assigned</span>
                                                @endif
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="2" class="text-center text-muted py-4">
                                                <i class="bx bx-user-x display-4 d-block mb-2"></i>
                                                No roles assigned to this user
                                            </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Additional Actions -->
                    @canany(['impersonate users', 'delete users'])
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="card border-warning">
                                <div class="card-header bg-warning bg-opacity-10">
                                    <h6 class="mb-0">
                                        <i class="bx bx-cog me-2"></i>Administrative Actions
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex flex-wrap gap-2">
                                        @can('impersonate users')
                                            @if($user->id != auth()->id() && !$user->hasRole('Super Admin'))
                                            <a href="{{ route('admin.users.impersonate', $user->id) }}"
                                               class="btn btn-success btn-sm"
                                               onclick="return confirm('Impersonate {{ $user->name }}? You can return to your account using the banner at the top.')">
                                                <i class="bx bx-user-voice me-1"></i> Impersonate User
                                            </a>
                                            @endif
                                        @endcan

                                        @can('delete users')
                                            @if($user->id != auth()->id() && !$user->hasRole('Super Admin'))
                                            <form method="POST" action="{{ route('admin.users.destroy', $user->id) }}"
                                                  class="d-inline"
                                                  onsubmit="return confirm('Are you sure you want to delete {{ $user->name }}? This action cannot be undone.')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="bx bx-trash me-1"></i> Delete User
                                                </button>
                                            </form>
                                            @endif
                                        @endcan

                                        @if($user->isImpersonated())
                                        <span class="badge bg-warning text-dark align-self-center">
                                            <i class="bx bx-user-voice me-1"></i> Currently Being Impersonated
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endcanany
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('css')
<style>
.user-avatar-large {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--bs-primary), var(--bs-info));
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 2rem;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

.breadcrumb {
    background-color: #f8f9fa;
    border-radius: 0.375rem;
    padding: 0.75rem 1rem;
}

.breadcrumb-item a {
    color: var(--bs-primary);
    text-decoration: none;
    display: flex;
    align-items: center;
    gap: 0.25rem;
}

.breadcrumb-item a:hover {
    color: var(--bs-primary-dark);
}

.breadcrumb-item.active {
    color: var(--bs-secondary);
    display: flex;
    align-items: center;
    gap: 0.25rem;
}

.card-header {
    background-color: #f8f9fa;
    border-bottom: 1px solid #dee2e6;
}

.table th {
    background-color: #f8f9fa;
    font-weight: 600;
}

.badge {
    font-size: 0.75em;
    display: inline-flex;
    align-items: center;
    gap: 0.25rem;
}

.action-buttons {
    display: flex;
    gap: 0.5rem;
    flex-wrap: wrap;
}

@media (max-width: 768px) {
    .card-actions {
        flex-direction: column;
        width: 100%;
        margin-top: 1rem;
    }

    .card-actions .btn {
        width: 100%;
        justify-content: center;
    }

    .user-avatar-large {
        width: 60px;
        height: 60px;
        font-size: 1.5rem;
    }
}
</style>
@endpush
