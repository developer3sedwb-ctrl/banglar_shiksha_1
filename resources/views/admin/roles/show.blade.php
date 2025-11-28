@extends('layouts.app')

@section('title', 'Role Details')
@section('page-title', 'Role Details')
@section('page-subtitle', 'View role information and permissions')

@push('css')
    <style>
        /* Enhanced Card Styles */
        .card-hover {
            transition: all 0.3s ease;
            border: 1px solid #e3e6f0;
        }

        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            border-color: var(--bs-primary);
        }

        /* Permission Group Styles */
        .permission-group {
            background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            border: 1px solid #e3e6f0;
            border-left: 4px solid var(--bs-primary);
            transition: all 0.3s ease;
        }

        .permission-group:hover {
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            border-left-color: var(--bs-success);
        }

        .permission-group-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
            padding-bottom: 0.75rem;
            border-bottom: 2px solid #e9ecef;
        }

        .permission-group-title {
            font-weight: 700;
            color: var(--bs-dark);
            font-size: 1.1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .permission-count {
            background: var(--bs-primary);
            color: white;
            padding: 0.35rem 1rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        /* Permission Item Styles */
        .permission-item {
            display: flex;
            align-items: center;
            padding: 0.75rem;
            margin-bottom: 0.5rem;
            background: white;
            border-radius: 8px;
            border: 1px solid #f1f3f4;
            transition: all 0.2s ease;
        }

        .permission-item:hover {
            background: #f8f9fa;
            border-color: var(--bs-primary);
            transform: translateX(5px);
        }

        .permission-item:last-child {
            margin-bottom: 0;
        }

        .permission-name {
            flex: 1;
            font-family: 'SF Mono', 'Monaco', 'Menlo', 'Ubuntu Mono', monospace;
            font-size: 0.85rem;
            color: #2d3748;
            font-weight: 500;
        }


        /* Enhanced Stat Cards */
        .stat-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 12px;
            padding: 1.5rem;
            text-align: center;
            border: none;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: rgba(255, 255, 255, 0.3);
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .stat-card .stat-number {
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 0.5rem;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .stat-card .stat-label {
            font-size: 0.9rem;
            opacity: 0.9;
            font-weight: 500;
        }

        /* Role Badge Enhancement */
        .role-badge-lg {
            font-size: 1.1rem;
            padding: 0.6rem 1.2rem;
            border-radius: 8px;
            font-weight: 700;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        /* User Avatar Enhancement */
        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 1rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        /* Search Enhancement */
        .search-container {
            position: relative;
            max-width: 350px;
        }

        .search-input {
            padding-left: 3rem;
            border-radius: 25px;
            border: 2px solid #e3e6f0;
            transition: all 0.3s ease;
        }

        .search-input:focus {
            border-color: var(--bs-primary);
            box-shadow: 0 0 0 0.2rem rgba(var(--bs-primary-rgb), 0.25);
        }

        .search-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
            z-index: 5;
        }

        /* Status Indicators */
        .status-indicator {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            display: inline-block;
            margin-right: 8px;
            box-shadow: 0 0 0 2px rgba(255, 255, 255, 0.8);
        }

        .status-online {
            background-color: #28a745;
            animation: pulse 2s infinite;
        }

        .status-offline {
            background-color: #6c757d;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
                opacity: 1;
            }

            50% {
                transform: scale(1.2);
                opacity: 0.7;
            }

            100% {
                transform: scale(1);
                opacity: 1;
            }
        }

        /* Table Enhancement */
        .table-hover tbody tr {
            transition: all 0.3s ease;
        }

        .table-hover tbody tr:hover {
            background-color: rgba(var(--bs-primary-rgb), 0.05);
            transform: translateX(5px);
        }

        /* Empty State Enhancement */
        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            color: #6c757d;
        }

        .empty-state-icon {
            font-size: 4rem;
            margin-bottom: 1.5rem;
            opacity: 0.3;
            color: var(--bs-primary);
        }

        /* Breadcrumb Enhancement */
        .breadcrumb {
            background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
            border-radius: 10px;
            padding: 1rem 1.5rem;
            border: 1px solid #e3e6f0;
        }

        .breadcrumb-item a {
            color: var(--bs-primary);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .breadcrumb-item a:hover {
            color: var(--bs-dark);
        }

        /* Badge Enhancement */
        .badge {
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        /* Animation for copied state */
        @keyframes copyFlash {
            0% {
                background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }

            100% {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                transform: scale(1);
            }
        }

        .copied {
            animation: copyFlash 0.6s ease;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .permission-group-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.5rem;
            }

            .module-stats {
                flex-direction: column;
                gap: 1rem;
            }

            .stat-card {
                margin-bottom: 1rem;
            }
        }


        .permission-group-card {
            border: 1px solid #e3e6f0;
            border-radius: 12px;
            transition: all 0.3s ease;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.04);
        }

        .permission-group-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            border-color: var(--bs-primary);
        }

        .group-icon-wrapper {
            width: 40px;
            height: 40px;
            background: rgba(var(--bs-primary-rgb), 0.1);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .permission-item {
            transition: all 0.3s ease;
            border: 1px solid transparent;
        }

        .permission-item:hover {
            background: rgba(var(--bs-primary-rgb), 0.05) !important;
            border-color: rgba(var(--bs-primary-rgb), 0.2);
            transform: translateX(5px);
        }

        .copy-permission {
            transition: all 0.3s ease;
            opacity: 0;
        }

        .permission-item:hover .copy-permission {
            opacity: 1;
        }

        .card.bg-gradient-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
            border: none;
            border-radius: 15px;
        }

        .border-dashed {
            border: 2px dashed #dee2e6 !important;
        }

        .empty-state-icon {
            opacity: 0.7;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .permission-group-card {
                margin-bottom: 1rem;
            }

            .btn-group {
                width: 100%;
                margin-top: 1rem;
            }

            .btn-group .btn {
                flex: 1;
            }
        }

        /* Animation for copy feedback */
        @keyframes copySuccess {
            0% {
                background-color: var(--bs-success);
            }

            100% {
                background-color: transparent;
            }
        }

        .copy-success {
            animation: copySuccess 1s ease;
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid">
        <!-- Enhanced Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard') }}" class="d-flex align-items-center">
                        <i class="bx bx-home-alt me-2"></i> Dashboard
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.roles.index') }}" class="d-flex align-items-center">
                        <i class="bx bx-shield me-2"></i> Role Management
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page" class="d-flex align-items-center">
                    <i class="bx bx-show me-2"></i> Role Details
                </li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-12">
                <div class="card card-hover">
                    <div class="card-header bg-transparent border-bottom-0 pb-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h3 class="card-title mb-1 text-dark">Role Information</h3>
                                <p class="text-muted mb-0">Detailed view of role permissions and assigned users</p>
                            </div>
                            <div class="card-actions">
                                @can('edit roles')
                                    <a href="{{ route('admin.roles.edit', $role->id) }}" class="btn btn-primary btn-lg">
                                        <i class="fas fa-edit me-2"></i> Edit Role
                                    </a>
                                @endcan
                                <a href="{{ route('admin.roles.index') }}" class="btn btn-outline-secondary btn-lg">
                                    <i class="fas fa-arrow-left me-2"></i> Back to Roles
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Enhanced Role Summary -->
                        <div class="row mb-5">
                            <div class="col-lg-8">
                                <div class="card bg-light border-0">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <table class="table table-borderless">
                                                    <tbody>
                                                        <tr>
                                                            <td class="border-0 ps-0" width="40%">
                                                                <strong class="text-dark">Role Name:</strong>
                                                            </td>
                                                            <td class="border-0">
                                                                <span
                                                                    class="badge role-badge-lg bg-primary">{{ $role->name }}</span>
                                                                @if (in_array($role->name, ['Super Admin', 'State Admin']))
                                                                    <span class="badge bg-warning text-dark ms-2">
                                                                        <i class="fas fa-shield-alt me-1"></i>Protected Role
                                                                    </span>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        @if ($role->description)
                                                            <tr>
                                                                <td class="border-0 ps-0">
                                                                    <strong class="text-dark">Description:</strong>
                                                                </td>
                                                                <td class="border-0">
                                                                    <p class="text-muted mb-0">{{ $role->description }}</p>
                                                                </td>
                                                            </tr>
                                                        @endif
                                                        <tr>
                                                            <td class="border-0 ps-0">
                                                                <strong class="text-dark">Total Users:</strong>
                                                            </td>
                                                            <td class="border-0">
                                                                <span
                                                                    class="badge bg-secondary fs-6">{{ $role->users_count }}</span>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="col-md-6">
                                                <table class="table table-borderless">
                                                    <tbody>
                                                        <tr>
                                                            <td class="border-0 ps-0" width="40%">
                                                                <strong class="text-dark">Total Permissions:</strong>
                                                            </td>
                                                            <td class="border-0">
                                                                <span
                                                                    class="badge bg-info fs-6">{{ $role->permissions_count }}</span>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="border-0 ps-0">
                                                                <strong class="text-dark">Created:</strong>
                                                            </td>
                                                            <td class="border-0">
                                                                <div class="d-flex align-items-center text-muted">
                                                                    <i class="fas fa-calendar me-2"></i>
                                                                    {{ $role->created_at->format('M j, Y g:i A') }}
                                                                </div>
                                                                <small
                                                                    class="text-muted">({{ $role->created_at->diffForHumans() }})</small>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="border-0 ps-0">
                                                                <strong class="text-dark">Last Updated:</strong>
                                                            </td>
                                                            <td class="border-0">
                                                                <div class="d-flex align-items-center text-muted">
                                                                    <i class="fas fa-clock me-2"></i>
                                                                    {{ $role->updated_at->format('M j, Y g:i A') }}
                                                                </div>
                                                                <small
                                                                    class="text-muted">({{ $role->updated_at->diffForHumans() }})</small>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Enhanced Module Statistics -->
                        @if ($permissionsByGroup->count() > 0)
                            <div class="row mb-5">
                                <div class="col-12">
                                    <h4 class="mb-4 text-dark">
                                        <i class="fas fa-chart-pie me-2 text-primary"></i>Permission Overview
                                    </h4>
                                    <div class="row g-4">
                                        <div class="col-xl-3 col-md-6">
                                            <div class="stat-card">
                                                <div class="stat-number">{{ $permissionsByGroup->count() }}</div>
                                                <div class="stat-label">Modules</div>
                                                <i class="fas fa-folder mt-3 opacity-50" style="font-size: 2rem;"></i>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-md-6">
                                            <div class="stat-card"
                                                style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
                                                <div class="stat-number">{{ $role->permissions_count }}</div>
                                                <div class="stat-label">Total Permissions</div>
                                                <i class="fas fa-key mt-3 opacity-50" style="font-size: 2rem;"></i>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-md-6">
                                            <div class="stat-card"
                                                style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
                                                <div class="stat-number">{{ $role->users_count }}</div>
                                                <div class="stat-label">Assigned Users</div>
                                                <i class="fas fa-users mt-3 opacity-50" style="font-size: 2rem;"></i>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-md-6">
                                            <div class="stat-card"
                                                style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);">
                                                <div class="stat-number">{{ $totalUsersOnline ?? 0 }}</div>
                                                <div class="stat-label">Users Online</div>
                                                <i class="fas fa-signal mt-3 opacity-50" style="font-size: 2rem;"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- Enhanced Permissions by Group -->
                        <div class="row mb-5">
                            <div class="col-12">
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <h4 class="mb-0 text-dark">
                                        <i class="fas fa-lock me-2 text-primary"></i>Assigned Permissions by Module
                                    </h4>
                                    <div class="search-container">
                                        <i class="fas fa-search search-icon"></i>
                                        <input type="text" class="form-control search-input"
                                            placeholder="Search permissions..." id="permissionSearch">
                                    </div>
                                </div>
                                @if ($permissionsByGroup->count() > 0)
                                    <div class="row">
                                        @foreach ($permissionsByGroup as $group => $permissions)
                                            <div class="col-lg-6 col-xl-4 mb-4">
                                                <div class="card permission-group-card h-100">
                                                    <div class="card-header bg-transparent border-bottom-0 pb-2">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <div class="d-flex align-items-center">
                                                                <div class="group-icon-wrapper me-3">
                                                                    <i class="fas fa-folder fa-lg text-primary"></i>
                                                                </div>
                                                                <div>
                                                                    <h6
                                                                        class="card-title mb-0 text-dark fw-bold text-capitalize">
                                                                        {{ $group }}</h6>
                                                                    <small class="text-muted">{{ $permissions->count() }}
                                                                        permissions</small>
                                                                </div>
                                                            </div>
                                                            <span
                                                                class="badge bg-primary rounded-pill">{{ $permissions->count() }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="card-body py-3">
                                                        <div class="permission-list">
                                                            @foreach ($permissions as $permission)
                                                                <div
                                                                    class="permission-item d-flex align-items-center justify-content-between p-3 mb-2 bg-light rounded-3">
                                                                    <div class="d-flex align-items-center">
                                                                        <i class="fas fa-key text-success me-3 fs-6"></i>
                                                                        <div>
                                                                            <div
                                                                                class="permission-name fw-semibold text-dark">
                                                                                {{ $permission->name }}</div>
                                                                            <small
                                                                                class="text-muted d-block mt-1">{{ $permission->description ?? 'System permission' }}</small>
                                                                        </div>
                                                                    </div>
                                                                    <button
                                                                        class="btn btn-sm btn-outline-primary copy-permission"
                                                                        data-permission="{{ $permission->name }}"
                                                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                                                        title="Copy permission name">
                                                                        <i class="fas fa-copy"></i>
                                                                    </button>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                    <div class="card-footer bg-transparent border-top-0 pt-0">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <small class="text-muted">
                                                                <i class="fas fa-clock me-1"></i>
                                                                Updated {{ $role->updated_at->diffForHumans() }}
                                                            </small>
                                                            @can('edit roles')
                                                                <a href="{{ route('admin.roles.edit', $role->id) }}?group={{ $group }}"
                                                                    class="btn btn-sm btn-outline-primary">
                                                                    <i class="fas fa-edit me-1"></i> Manage
                                                                </a>
                                                            @endcan
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                    <!-- Enhanced Statistics Row -->
                                    <div class="row mt-4">
                                        <div class="col-12">
                                            <div class="card bg-gradient-primary text-white mb-4">
                                                <div class="card-body">
                                                    <div class="row text-center">
                                                        <div class="col-md-3 mb-3 mb-md-0">
                                                            <div class="h2 fw-bold mb-1">
                                                                {{ $permissionsByGroup->count() }}</div>
                                                            <small class="opacity-75">Permission Groups</small>
                                                        </div>
                                                        <div class="col-md-3 mb-3 mb-md-0">
                                                            <div class="h2 fw-bold mb-1">{{ $role->permissions_count }}
                                                            </div>
                                                            <small class="opacity-75">Total Permissions</small>
                                                        </div>
                                                        <div class="col-md-3 mb-3 mb-md-0">
                                                            <div class="h2 fw-bold mb-1">{{ $role->users_count }}</div>
                                                            <small class="opacity-75">Assigned Users</small>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="h2 fw-bold mb-1">{{ $totalUsersOnline ?? 0 }}
                                                            </div>
                                                            <small class="opacity-75">Users Online</small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Quick Actions -->
                                    @can('edit roles')
                                        <div class="row mb-4">
                                            <div class="col-12">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <div>
                                                                <h6 class="card-title mb-1">Quick Actions</h6>
                                                                <p class="text-muted mb-0">Manage role permissions efficiently
                                                                </p>
                                                            </div>
                                                            <div class="btn-group">
                                                                <a href="{{ route('admin.roles.edit', $role->id) }}"
                                                                    class="btn btn-primary">
                                                                    <i class="fas fa-edit me-2"></i> Edit All Permissions
                                                                </a>
                                                                <button type="button"
                                                                    class="btn btn-primary dropdown-toggle dropdown-toggle-split"
                                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                                    <span class="visually-hidden">Toggle Dropdown</span>
                                                                </button>
                                                                <ul class="dropdown-menu">
                                                                    @foreach ($permissionsByGroup as $group => $permissions)
                                                                        <li>
                                                                            <a class="dropdown-item"
                                                                                href="{{ route('admin.roles.edit', $role->id) }}?group={{ $group }}">
                                                                                <i class="fas fa-folder me-2"></i> Edit
                                                                                {{ ucfirst($group) }}
                                                                            </a>
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endcan
                                @else
                                    <!-- Enhanced Empty State -->
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card border-dashed">
                                                <div class="card-body text-center py-5">
                                                    <div class="empty-state-icon mb-4">
                                                        <i class="fas fa-lock-open fa-4x text-muted"></i>
                                                    </div>
                                                    <h3 class="text-dark mb-3">No Permissions Assigned</h3>
                                                    <p class="text-muted mb-4">This role doesn't have any permissions
                                                        assigned yet. Start by assigning relevant permissions to define what
                                                        users with this role can access.</p>

                                                    <div class="row justify-content-center mb-4">
                                                        <div class="col-md-8">
                                                            <div class="alert alert-info">
                                                                <div class="d-flex">
                                                                    <i class="fas fa-info-circle me-3 mt-1"></i>
                                                                    <div>
                                                                        <strong>Tip:</strong> Assign permissions to control
                                                                        what actions users with this role can perform.
                                                                        Consider starting with basic view permissions and
                                                                        gradually adding more capabilities.
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    @can('edit roles')
                                                        <div class="d-flex justify-content-center gap-3 flex-wrap">
                                                            <a href="{{ route('admin.roles.edit', $role->id) }}"
                                                                class="btn btn-primary btn-lg">
                                                                <i class="fas fa-key me-2"></i> Assign Permissions
                                                            </a>
                                                            <a href="{{ route('admin.roles.create') }}"
                                                                class="btn btn-outline-primary btn-lg">
                                                                <i class="fas fa-copy me-2"></i> Clone from Existing Role
                                                            </a>
                                                            <button class="btn btn-outline-secondary btn-lg"
                                                                data-bs-toggle="modal" data-bs-target="#permissionHelpModal">
                                                                <i class="fas fa-question-circle me-2"></i> Learn More
                                                            </button>
                                                        </div>
                                                    @endcan
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Permission Help Modal -->
                                    <div class="modal fade" id="permissionHelpModal" tabindex="-1"
                                        aria-labelledby="permissionHelpModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="permissionHelpModalLabel">
                                                        <i class="fas fa-question-circle me-2 text-primary"></i>
                                                        Understanding Permissions
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-6 mb-4">
                                                            <div class="card border-0 bg-light">
                                                                <div class="card-body text-center">
                                                                    <i class="fas fa-eye fa-2x text-primary mb-3"></i>
                                                                    <h6 class="card-title">View Permissions</h6>
                                                                    <p class="card-text small text-muted">Allow users to
                                                                        see data and pages without making changes</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 mb-4">
                                                            <div class="card border-0 bg-light">
                                                                <div class="card-body text-center">
                                                                    <i class="fas fa-edit fa-2x text-warning mb-3"></i>
                                                                    <h6 class="card-title">Edit Permissions</h6>
                                                                    <p class="card-text small text-muted">Enable users to
                                                                        modify existing data and content</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 mb-4">
                                                            <div class="card border-0 bg-light">
                                                                <div class="card-body text-center">
                                                                    <i class="fas fa-plus fa-2x text-success mb-3"></i>
                                                                    <h6 class="card-title">Create Permissions</h6>
                                                                    <p class="card-text small text-muted">Grant ability to
                                                                        add new records and content</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 mb-4">
                                                            <div class="card border-0 bg-light">
                                                                <div class="card-body text-center">
                                                                    <i class="fas fa-trash fa-2x text-danger mb-3"></i>
                                                                    <h6 class="card-title">Delete Permissions</h6>
                                                                    <p class="card-text small text-muted">Provide authority
                                                                        to remove data and records</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    @can('edit roles')
                                                        <a href="{{ route('admin.roles.edit', $role->id) }}"
                                                            class="btn btn-primary">
                                                            <i class="fas fa-key me-2"></i> Start Assigning Permissions
                                                        </a>
                                                    @endcan
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Enhanced Assigned Users -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card card-hover">
                                    <div class="card-header bg-transparent border-bottom-0">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h4 class="card-title mb-0 text-dark">
                                                <i class="fas fa-users me-2 text-primary"></i>Assigned Users
                                                <span class="badge bg-secondary ms-2 fs-6">{{ $role->users_count }}</span>
                                            </h4>
                                            <div class="search-container">
                                                <i class="fas fa-search search-icon"></i>
                                                <input type="text" class="form-control search-input"
                                                    placeholder="Search users..." id="userSearch">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        @if ($role->users->count() > 0)
                                            <div class="table-responsive">
                                                <table class="table table-hover table-borderless" id="usersTable">
                                                    <thead class="table-light">
                                                        <tr>
                                                            <th class="border-0 ps-4">
                                                                <strong>User Name</strong>
                                                            </th>
                                                            <th class="border-0">
                                                                <strong>Email</strong>
                                                            </th>
                                                            <th class="border-0">
                                                                <strong>Status</strong>
                                                            </th>
                                                            <th class="border-0">
                                                                <strong>Last Login</strong>
                                                            </th>
                                                            <th class="border-0 pe-4">
                                                                <strong>Online</strong>
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($role->users as $user)
                                                            <tr class="position-relative">
                                                                <td class="ps-4">
                                                                    <div class="d-flex align-items-center">
                                                                        <div class="user-avatar me-3">
                                                                            {{ substr($user->name, 0, 1) }}
                                                                        </div>
                                                                        <div>
                                                                            <div class="fw-bold text-dark">
                                                                                {{ $user->name }}</div>
                                                                            <small
                                                                                class="text-muted">{{ $user->department ?? 'N/A' }}</small>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <span class="text-dark">{{ $user->email }}</span>
                                                                </td>
                                                                <td>
                                                                    <span
                                                                        class="badge {{ $user->status ? 'bg-success' : 'bg-danger' }} fs-7">
                                                                        <i
                                                                            class="fas fa-{{ $user->status ? 'check' : 'times' }} me-1"></i>
                                                                        {{ $user->status ? 'Active' : 'Inactive' }}
                                                                    </span>
                                                                </td>
                                                                <td>
                                                                    @if ($user->last_login_at)
                                                                        <span
                                                                            class="text-muted">{{ $user->last_login_at->diffForHumans() }}</span>
                                                                    @else
                                                                        <span class="text-muted">Never</span>
                                                                    @endif
                                                                </td>
                                                                <td class="pe-4">
                                                                    @if ($user->is_online)
                                                                        <span
                                                                            class="status-indicator status-online"></span>
                                                                        <small class="text-success fw-bold">Online</small>
                                                                    @else
                                                                        <span
                                                                            class="status-indicator status-offline"></span>
                                                                        <small class="text-muted">Offline</small>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        @else
                                            <div class="empty-state">
                                                <div class="empty-state-icon">
                                                    <i class="fas fa-user-slash"></i>
                                                </div>
                                                <h4 class="text-dark mb-3">No Users Assigned</h4>
                                                <p class="text-muted">This role doesn't have any users assigned yet.</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Enhanced Permission Search
            const permissionSearch = document.getElementById('permissionSearch');
            if (permissionSearch) {
                permissionSearch.addEventListener('input', function(e) {
                    const searchTerm = e.target.value.toLowerCase().trim();
                    const permissionGroups = document.querySelectorAll('.permission-group');

                    permissionGroups.forEach(group => {
                        const permissions = group.querySelectorAll('.permission-item');
                        let visibleCount = 0;

                        permissions.forEach(permission => {
                            const permissionText = permission.querySelector(
                                '.permission-name').textContent.toLowerCase();
                            if (permissionText.includes(searchTerm)) {
                                permission.style.display = 'flex';
                                visibleCount++;
                            } else {
                                permission.style.display = 'none';
                            }
                        });

                        const permissionCount = group.querySelector('.permission-count');
                        const groupElement = group.closest('.col-lg-6');

                        if (visibleCount > 0) {
                            groupElement.style.display = 'block';
                            permissionCount.textContent = `${visibleCount}`;
                            group.style.opacity = '1';
                        } else {
                            groupElement.style.display = 'none';
                            group.style.opacity = '0.5';
                        }
                    });
                });
            }

            // Enhanced User Search
            const userSearch = document.getElementById('userSearch');
            if (userSearch) {
                userSearch.addEventListener('input', function(e) {
                    const searchTerm = e.target.value.toLowerCase().trim();
                    const userRows = document.querySelectorAll('#usersTable tbody tr');

                    userRows.forEach(row => {
                        const userName = row.querySelector('td:first-child').textContent
                            .toLowerCase();
                        const userEmail = row.querySelector('td:nth-child(2)').textContent
                            .toLowerCase();

                        if (userName.includes(searchTerm) || userEmail.includes(searchTerm)) {
                            row.style.display = '';
                            row.style.opacity = '1';
                        } else {
                            row.style.display = 'none';
                            row.style.opacity = '0.5';
                        }
                    });
                });
            }


            // Enhanced Toast Notification
            function showToast(message, type = 'info') {
                // Remove existing toasts
                document.querySelectorAll('.custom-toast').forEach(toast => toast.remove());

                const toast = document.createElement('div');
                toast.className = `custom-toast alert alert-${type} alert-dismissible fade show position-fixed`;
                toast.style.cssText = `
            top: 20px;
            right: 20px;
            z-index: 9999;
            min-width: 300px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            border: none;
        `;

                toast.innerHTML = `
            <div class="d-flex align-items-center">
                <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-circle'} me-2 fs-5"></i>
                <span class="flex-grow-1">${message}</span>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
            </div>
        `;

                document.body.appendChild(toast);

                // Auto remove after 3 seconds
                setTimeout(() => {
                    if (toast.parentNode) {
                        toast.remove();
                    }
                }, 3000);
            }

            // Enhanced Keyboard Shortcuts
            document.addEventListener('keydown', function(e) {
                // Ctrl + F to focus search
                if ((e.ctrlKey || e.metaKey) && e.key === 'f') {
                    e.preventDefault();
                    const activeElement = document.activeElement;
                    if (!activeElement.matches('input, textarea')) {
                        const searchInput = permissionSearch || userSearch;
                        if (searchInput) {
                            searchInput.focus();
                            searchInput.select();
                        }
                    }
                }

                // Escape to clear search and blur
                if (e.key === 'Escape') {
                    if (permissionSearch) {
                        permissionSearch.value = '';
                        permissionSearch.dispatchEvent(new Event('input'));
                    }
                    if (userSearch) {
                        userSearch.value = '';
                        userSearch.dispatchEvent(new Event('input'));
                    }
                    document.activeElement.blur();
                }
            });

            // Initialize Bootstrap Tooltips
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[title]'));
            const tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl, {
                    trigger: 'hover focus'
                });
            });

            // Add loading animation to cards
            const cards = document.querySelectorAll('.card-hover');
            cards.forEach(card => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';

                setTimeout(() => {
                    card.style.transition = 'all 0.6s ease';
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, 100);
            });


            document.querySelectorAll('.copy-permission').forEach(button => {
                button.addEventListener('click', async function() {
                    const permissionName = this.getAttribute('data-permission');

                    try {
                        await navigator.clipboard.writeText(permissionName);

                        // Visual feedback
                        const originalHtml = this.innerHTML;
                        this.innerHTML = '<i class="fas fa-check"></i>';
                        this.classList.add('btn-success');
                        this.classList.remove('btn-outline-primary');

                        // Show toast notification
                        showToast(`✅ Copied: ${permissionName}`, 'success');

                        setTimeout(() => {
                            this.innerHTML = originalHtml;
                            this.classList.remove('btn-success');
                            this.classList.add('btn-outline-primary');
                        }, 2000);

                    } catch (err) {
                        showToast('❌ Failed to copy permission name', 'error');
                    }
                });
            });

            // Initialize tooltips
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            const tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });

            // Group filtering functionality
            const filterButtons = document.querySelectorAll('.group-filter');
            filterButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const group = this.getAttribute('data-group');

                    // Remove active class from all buttons
                    filterButtons.forEach(btn => btn.classList.remove('active'));
                    // Add active class to clicked button
                    this.classList.add('active');

                    // Filter permission groups
                    document.querySelectorAll('.permission-group-card').forEach(card => {
                        const cardGroup = card.querySelector('.card-title').textContent
                            .toLowerCase().trim();
                        if (group === 'all' || cardGroup.includes(group.toLowerCase())) {
                            card.style.display = 'block';
                        } else {
                            card.style.display = 'none';
                        }
                    });
                });
            });

            // Enhanced toast function
            function showToast(message, type = 'info') {
                // Implementation for toast notifications
                const toastContainer = document.getElementById('toast-container') || createToastContainer();
                const toast = document.createElement('div');
                toast.className = `toast align-items-center text-white bg-${type} border-0`;
                toast.innerHTML = `
            <div class="d-flex">
                <div class="toast-body">${message}</div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>
        `;
                toastContainer.appendChild(toast);

                const bsToast = new bootstrap.Toast(toast);
                bsToast.show();
            }

            function createToastContainer() {
                const container = document.createElement('div');
                container.id = 'toast-container';
                container.className = 'toast-container position-fixed top-0 end-0 p-3';
                container.style.zIndex = '9999';
                document.body.appendChild(container);
                return container;
            }
        });
    </script>
@endpush
