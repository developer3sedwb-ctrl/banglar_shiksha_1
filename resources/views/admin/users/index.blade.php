@extends('layouts.app')

@section('title', 'User Management')
@section('page-title', 'User Management')
@section('page-subtitle', 'Manage system users and their roles')

@push('css')
    <style>
        .avatar-circle {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--bs-primary) 0%, var(--bs-primary-dark) 100%);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 1rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .status-badge {
            padding: 0.375rem 0.75rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            letter-spacing: 0.3px;
        }

        .action-buttons .btn {
            border-radius: 8px;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .action-buttons .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        }

        .card-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-bottom: none;
        }

        .card-header .btn {
            background: rgba(255, 255, 255, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: white;
        }

        .card-header .btn:hover {
            background: rgba(255, 255, 255, 0.3);
            border-color: rgba(255, 255, 255, 0.4);
        }

        .table {
            --bs-table-bg: transparent;
        }

        .table > thead {
            background: linear-gradient(135deg, #f6f9fc 0%, #f1f5f9 100%);
            border-bottom: 2px solid #e2e8f0;
        }

        .table > thead th {
            border: none;
            font-weight: 700;
            font-size: 0.875rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #475569;
            padding: 1rem 0.75rem;
        }

        .table > tbody tr {
            transition: all 0.2s;
            border-bottom: 1px solid #f1f5f9;
        }

        .table > tbody tr:hover {
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .table > tbody tr.table-active {
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.1) 0%, rgba(59, 130, 246, 0.05) 100%);
        }

        .table > tbody td {
            vertical-align: middle;
            padding: 1rem 0.75rem;
            border-color: #f1f5f9;
        }

        .badge {
            font-size: 0.75rem;
            padding: 0.375rem 0.75rem;
            border-radius: 12px;
            font-weight: 600;
        }

        .bulk-action-section {
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.02);
        }

        .form-control, .form-select {
            border-radius: 8px;
            border: 2px solid #e2e8f0;
            padding: 0.625rem 1rem;
            font-size: 0.875rem;
            transition: all 0.2s;
        }

        .form-control:focus, .form-select:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .empty-state {
            padding: 3rem;
            text-align: center;
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            border-radius: 12px;
        }

        .empty-state i {
            font-size: 4rem;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 1.5rem;
        }

        .pagination {
            --bs-pagination-border-radius: 8px;
            --bs-pagination-active-bg: #3b82f6;
            --bs-pagination-active-border-color: #3b82f6;
        }

        .impersonate-notice {
            background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
            color: #78350f;
            border-radius: 8px;
            padding: 0.75rem 1rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .quick-stats-card {
            background: white;
            border-radius: 12px;
            padding: 1rem;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            border: 1px solid #e2e8f0;
            transition: all 0.3s;
        }

        .quick-stats-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
        }

        .quick-stats-number {
            font-size: 2rem;
            font-weight: 700;
            line-height: 1;
            margin-bottom: 0.25rem;
        }

        .user-info-container {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .user-details {
            flex: 1;
        }

        .user-name {
            font-weight: 600;
            color: #1e293b;
            font-size: 0.95rem;
        }

        .user-email {
            color: #64748b;
            font-size: 0.85rem;
        }

        .user-phone {
            color: #94a3b8;
            font-size: 0.8rem;
        }

        .role-badge {
            background: linear-gradient(135deg, var(--bs-primary) 0%, #2563eb 100%);
            color: white;
            border-radius: 20px;
            padding: 0.25rem 0.75rem;
            font-size: 0.75rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
        }

        .permission-count {
            font-size: 0.8rem;
            color: #64748b;
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }

        .last-login-time {
            display: flex;
            flex-direction: column;
            gap: 0.25rem;
        }

        .login-time {
            font-size: 0.85rem;
            color: #1e293b;
            font-weight: 500;
        }

        .login-relative {
            font-size: 0.75rem;
            color: #94a3b8;
        }

        /* Custom checkbox styling */
        .form-check-input {
            width: 1.25rem;
            height: 1.25rem;
            border-radius: 6px;
            border: 2px solid #cbd5e1;
            cursor: pointer;
        }

        .form-check-input:checked {
            background-color: #3b82f6;
            border-color: #3b82f6;
        }

        .form-check-input:disabled {
            background-color: #f1f5f9;
            border-color: #e2e8f0;
        }

        /* Loading overlay */
        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255, 255, 255, 0.9);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            display: none;
        }

        /* Toast notification */
        .custom-toast {
            position: fixed;
            top: 20px;
            right: 20px;
            min-width: 300px;
            z-index: 9999;
            animation: slideInRight 0.3s ease-out;
        }

        @keyframes slideInRight {
            from {
                transform: translateX(100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        /* Advanced search card */
        .advanced-search-card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            margin-bottom: 1.5rem;
        }

        .advanced-search-card .card-header {
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            color: #1e293b;
            border-bottom: 1px solid #e2e8f0;
            border-radius: 12px 12px 0 0;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .user-info-container {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.5rem;
            }

            .action-buttons {
                flex-wrap: wrap;
            }

            .action-buttons .btn {
                width: 36px;
                height: 36px;
            }

            .quick-stats-card {
                margin-bottom: 1rem;
            }
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid">
        <!-- Loading Overlay -->
        <div class="loading-overlay" id="loadingOverlay">
            <div class="text-center">
                <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <p class="mt-3 text-muted fw-medium">Processing...</p>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <!-- Main Card -->
                <div class="card border-0 shadow-lg">
                    <div class="card-header d-flex justify-content-between align-items-center py-3">
                        <div>
                            <h3 class="card-title mb-0 fw-bold">
                                <i class="fas fa-users me-2"></i>User Management
                            </h3>
                            <small class="text-white opacity-75">Manage all system users and their permissions</small>
                        </div>
                        <div class="card-actions d-flex align-items-center gap-2">
                            <!-- Impersonation Notice -->
                            @if (session('impersonator'))
                                <div class="impersonate-notice">
                                    <i class="fas fa-user-secret fa-lg"></i>
                                    <div>
                                        <strong>Impersonating:</strong> {{ auth()->user()->name }}
                                    </div>
                                    <a href="{{ route('admin.users.stop-impersonate') }}"
                                        class="btn btn-sm btn-danger ms-2">
                                        <i class="fas fa-user-slash me-1"></i>Stop
                                    </a>
                                </div>
                            @endif

                            @can('create users')
                                <a href="{{ route('admin.users.create') }}" class="btn btn-lg btn-primary px-4">
                                    <i class="fas fa-user-plus me-2"></i>Add New User
                                </a>
                            @endcan
                        </div>
                    </div>

                    <div class="card-body p-4">
                        <!-- Success/Error Messages -->
                        @session('success')
                            <div class="alert alert-success alert-dismissible fade show d-flex align-items-center" role="alert">
                                <i class="fas fa-check-circle fa-lg me-3"></i>
                                <div class="flex-grow-1">{{ $value }}</div>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endsession

                        @session('error')
                            <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center" role="alert">
                                <i class="fas fa-exclamation-circle fa-lg me-3"></i>
                                <div class="flex-grow-1">{{ $value }}</div>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endsession

                        <!-- Advanced Search Card -->
                        <div class="card advanced-search-card">
                            <div class="card-header py-3">
                                <h5 class="mb-0 fw-bold">
                                    <i class="fas fa-search me-2"></i>Advanced Filters
                                </h5>
                            </div>
                            <div class="card-body">
                                <form method="GET" action="{{ route('admin.users.index') }}" id="searchForm">
                                    <div class="row g-3">
                                        <!-- Global Search -->
                                        <div class="col-lg-4 col-md-6">
                                            <label class="form-label fw-semibold">Global Search</label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-transparent">
                                                    <i class="fas fa-search text-muted"></i>
                                                </span>
                                                <input type="text" name="search" class="form-control border-start-0 ps-0"
                                                    placeholder="Name, email, phone, department..."
                                                    value="{{ request('search') }}">
                                            </div>
                                        </div>

                                        <!-- Status Filter -->
                                        <div class="col-lg-2 col-md-6">
                                            <label class="form-label fw-semibold">Status</label>
                                            <select name="status" class="form-select">
                                                <option value="all">All Status</option>
                                                <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                                                <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                            </select>
                                        </div>

                                        <!-- Role Filter -->
                                        <div class="col-lg-2 col-md-6">
                                            <label class="form-label fw-semibold">Role</label>
                                            <select name="role" class="form-select">
                                                <option value="all">All Roles</option>
                                                @foreach ($roles as $roleName => $roleDisplay)
                                                    <option value="{{ $roleName }}" {{ request('role') == $roleName ? 'selected' : '' }}>
                                                        {{ $roleDisplay }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <!-- Department Filter -->
                                        <div class="col-lg-2 col-md-6">
                                            <label class="form-label fw-semibold">Department</label>
                                            <select name="department" class="form-select">
                                                <option value="all">All Departments</option>
                                                @foreach ($departments as $department)
                                                    <option value="{{ $department }}" {{ request('department') == $department ? 'selected' : '' }}>
                                                        {{ $department }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <!-- Online Status -->
                                        <div class="col-lg-2 col-md-6">
                                            <label class="form-label fw-semibold">Online Status</label>
                                            <select name="online_status" class="form-select">
                                                <option value="all">All</option>
                                                <option value="online" {{ request('online_status') == 'online' ? 'selected' : '' }}>Online</option>
                                                <option value="offline" {{ request('online_status') == 'offline' ? 'selected' : '' }}>Offline</option>
                                            </select>
                                        </div>

                                        <!-- Date Range -->
                                        <div class="col-lg-3 col-md-6">
                                            <label class="form-label fw-semibold">Date From</label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-transparent">
                                                    <i class="fas fa-calendar text-muted"></i>
                                                </span>
                                                <input type="date" name="date_from" class="form-control border-start-0 ps-0"
                                                    value="{{ request('date_from') }}">
                                            </div>
                                        </div>

                                        <div class="col-lg-3 col-md-6">
                                            <label class="form-label fw-semibold">Date To</label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-transparent">
                                                    <i class="fas fa-calendar text-muted"></i>
                                                </span>
                                                <input type="date" name="date_to" class="form-control border-start-0 ps-0"
                                                    value="{{ request('date_to') }}">
                                            </div>
                                        </div>

                                        <!-- Action Buttons -->
                                        <div class="col-lg-6 col-md-12 d-flex align-items-end gap-2">
                                            <button type="submit" class="btn btn-primary px-4">
                                                <i class="fas fa-search me-2"></i> Search
                                            </button>
                                            <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary px-4">
                                                <i class="fas fa-redo me-2"></i> Reset
                                            </a>

                                            @if (request()->hasAny(['search', 'status', 'role', 'department', 'date_from', 'date_to', 'online_status']))
                                                <span class="badge bg-info align-self-center ms-2 py-2 px-3">
                                                    <i class="fas fa-filter me-1"></i>
                                                    {{ $users->total() }} results found
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Quick Stats -->
                        <div class="row mb-4">
                            <div class="col-lg-3 col-md-6 mb-3">
                                <div class="quick-stats-card">
                                    <div class="quick-stats-number text-primary">{{ $users->total() }}</div>
                                    <div class="text-muted fw-medium">Total Users</div>
                                    <i class="fas fa-users text-primary mt-2 fa-lg"></i>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 mb-3">
                                <div class="quick-stats-card">
                                    <div class="quick-stats-number text-success">{{ $activeUsersCount ?? 0 }}</div>
                                    <div class="text-muted fw-medium">Active Users</div>
                                    <i class="fas fa-user-check text-success mt-2 fa-lg"></i>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 mb-3">
                                <div class="quick-stats-card">
                                    <div class="quick-stats-number text-danger">{{ $inactiveUsersCount ?? 0 }}</div>
                                    <div class="text-muted fw-medium">Inactive Users</div>
                                    <i class="fas fa-user-times text-danger mt-2 fa-lg"></i>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 mb-3">
                                <div class="quick-stats-card">
                                    <div class="quick-stats-number text-info">{{ $onlineUsersCount ?? 0 }}</div>
                                    <div class="text-muted fw-medium">Online Now</div>
                                    <i class="fas fa-wifi text-info mt-2 fa-lg"></i>
                                </div>
                            </div>
                        </div>

                        <!-- Bulk Actions Section -->
                        @canany(['edit users', 'delete users', 'impersonate users'])
                            <div class="bulk-action-section">
                                <form method="POST" action="{{ route('admin.users.bulk-action') }}" class="mb-0" id="bulkActionForm">
                                    @csrf
                                    <div class="row align-items-center">
                                        <div class="col-lg-4 col-md-6 mb-3 mb-md-0">
                                            <label class="form-label fw-semibold mb-2">Bulk Actions</label>
                                            <div class="d-flex gap-2">
                                                <select name="action" class="form-select flex-grow-1" required>
                                                    <option value="">Choose Action...</option>
                                                    <option value="activate">Activate Selected</option>
                                                    <option value="deactivate">Deactivate Selected</option>
                                                    @can('impersonate users')
                                                        <option value="impersonate">Impersonate Selected</option>
                                                    @endcan
                                                    @can('delete users')
                                                        <option value="delete">Delete Selected</option>
                                                    @endcan
                                                </select>
                                                <button type="submit" class="btn btn-primary px-4" id="bulkActionBtn" disabled>
                                                    Apply
                                                </button>
                                            </div>
                                            <div class="form-text mt-2">
                                                <i class="fas fa-info-circle me-1"></i>
                                                Selected: <span id="selectedCount" class="fw-semibold">0</span> users
                                            </div>
                                        </div>
                                        <div class="col-lg-8 col-md-6">
                                            <div class="d-flex justify-content-end">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="selectAll">
                                                    <label class="form-check-label fw-semibold ms-2" for="selectAll">
                                                        Select All Users
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        @endcanany

                        <!-- Users Table -->
                        <div class="table-responsive rounded-3 overflow-hidden">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        @canany(['edit users', 'delete users', 'impersonate users'])
                                            <th width="50px" class="ps-4">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="selectAllMobile">
                                                </div>
                                            </th>
                                        @endcanany
                                        <th width="70px">ID</th>
                                        <th>User Information</th>
                                        <th>Role & Permissions</th>
                                        <th>Department</th>
                                        <th width="120px">Status</th>
                                        <th width="140px">Last Login</th>
                                        <th width="180px" class="text-end pe-4">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($users as $user)
                                        <tr class="{{ $user->id == auth()->id() ? 'table-active border-start border-primary border-3' : '' }}">
                                            @canany(['edit users', 'delete users', 'impersonate users'])
                                                <td class="ps-4">
                                                    <div class="form-check">
                                                        <input type="checkbox" name="users[]" value="{{ $user->id }}"
                                                            class="user-checkbox form-check-input"
                                                            {{ $user->id == auth()->id() || $user->hasRole('Super Admin') ? 'disabled' : '' }}>
                                                    </div>
                                                </td>
                                            @endcanany
                                            <td>
                                                <span class="badge bg-light text-dark fw-semibold">#{{ $user->id }}</span>
                                            </td>
                                            <td>
                                                <div class="user-info-container">
                                                    <div class="avatar-circle">
                                                        {{ substr($user->name, 0, 1) }}
                                                        @if($user->is_online)
                                                            <span class="position-absolute translate-middle badge rounded-circle bg-success border border-white p-1"
                                                                  style="top: 35px; left: 35px;">
                                                                <span class="visually-hidden">Online</span>
                                                            </span>
                                                        @endif
                                                    </div>
                                                    <div class="user-details">
                                                        <div class="user-name">{{ $user->name }}</div>
                                                        <div class="user-email">
                                                            <i class="fas fa-envelope me-1"></i>{{ $user->email }}
                                                        </div>
                                                        @if ($user->phone)
                                                            <div class="user-phone">
                                                                <i class="fas fa-phone me-1"></i>{{ $user->phone }}
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex flex-wrap gap-1 mb-1">
                                                    @foreach ($user->roles as $role)
                                                        <span class="role-badge">
                                                            <i class="fas fa-shield-alt me-1"></i>{{ $role->name }}
                                                        </span>
                                                    @endforeach
                                                </div>
                                                <div class="permission-count">
                                                    <i class="fas fa-key"></i>
                                                    @php
                                                        $permissionCount = 0;
                                                        foreach ($user->roles as $role) {
                                                            $permissionCount += $role->permissions->count();
                                                        }
                                                    @endphp
                                                    {{ $permissionCount }} permissions
                                                </div>
                                            </td>
                                            <td>
                                                <span class="badge bg-light text-dark fw-medium">
                                                    <i class="fas fa-building me-1"></i>
                                                    {{ $user->department ?? 'N/A' }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="status-badge {{ $user->status ? 'bg-success' : 'bg-danger' }}">
                                                    <i class="fas fa-{{ $user->status ? 'check' : 'times' }} me-1"></i>
                                                    {{ $user->status ? 'Active' : 'Inactive' }}
                                                </span>
                                                @if ($user->is_online)
                                                    <span class="badge bg-success mt-1 d-inline-block">Online</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="last-login-time">
                                                    @if ($user->last_login_at)
                                                        <span class="login-time">
                                                            {{ $user->last_login_at->format('M j, Y') }}
                                                        </span>
                                                        <span class="login-relative">
                                                            {{ $user->last_login_at->format('g:i A') }} •
                                                            {{ $user->last_login_at->diffForHumans() }}
                                                        </span>
                                                    @else
                                                        <span class="text-muted fst-italic">Never logged in</span>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div class="action-buttons d-flex justify-content-end gap-1">
                                                    @can('view users')
                                                        <a href="{{ route('admin.users.show', $user->id) }}"
                                                            class="btn btn-info btn-sm action-btn"
                                                            data-bs-toggle="tooltip" data-bs-placement="top" title="View Details">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                    @endcan

                                                    @can('impersonate users')
                                                        @if ($user->id != auth()->id() && !$user->hasRole('Super Admin'))
                                                            <a href="{{ route('admin.users.impersonate', $user->id) }}"
                                                                class="btn btn-warning btn-sm action-btn"
                                                                data-bs-toggle="tooltip" data-bs-placement="top" title="Impersonate"
                                                                onclick="return confirm('Impersonate {{ $user->name }}? You can return to your account using the banner at the top.')">
                                                                <i class="fas fa-user-secret"></i>
                                                            </a>
                                                        @endif
                                                    @endcan

                                                    @can('edit users')
                                                        <a href="{{ route('admin.users.edit', $user->id) }}"
                                                            class="btn btn-primary btn-sm action-btn"
                                                            data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"
                                                            {{ $user->hasRole('Super Admin') && !auth()->user()->hasRole('Super Admin') ? 'disabled' : '' }}>
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                    @endcan

                                                    @can('delete users')
                                                        @if ($user->id != auth()->id() && !$user->hasRole('Super Admin'))
                                                            <button type="button"
                                                                class="btn btn-danger btn-sm action-btn delete-user-btn"
                                                                data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"
                                                                data-user-id="{{ $user->id }}"
                                                                data-user-name="{{ $user->name }}">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        @endif
                                                    @endcan
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="{{ auth()->user()->canAny(['edit users', 'delete users', 'impersonate users'])? 8: 7 }}"
                                                class="text-center py-5">
                                                <div class="empty-state">
                                                    <i class="fas fa-user-slash"></i>
                                                    <h4 class="mt-3 fw-bold">No Users Found</h4>
                                                    <p class="text-muted mb-4">No users match your search criteria.</p>
                                                    @can('create users')
                                                        <a href="{{ route('admin.users.create') }}" class="btn btn-primary px-4">
                                                            <i class="fas fa-plus me-2"></i> Create First User
                                                        </a>
                                                    @endcan
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        @if ($users->hasPages())
                            <div class="d-flex justify-content-between align-items-center mt-4 pt-3 border-top">
                                <div class="text-muted">
                                    Showing {{ $users->firstItem() }} to {{ $users->lastItem() }} of {{ $users->total() }} entries
                                </div>
                                <div>
                                    {{ $users->links('pagination::bootstrap-5') }}
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title fw-bold text-danger">
                        <i class="fas fa-exclamation-triangle me-2"></i>Confirm Deletion
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body py-4">
                    <p>Are you sure you want to delete user <strong id="deleteUserName"></strong>?</p>
                    <p class="text-muted small">This action cannot be undone. All user data will be permanently removed.</p>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form id="deleteUserForm" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-trash me-2"></i>Delete User
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Elements
            const selectAll = document.getElementById('selectAll');
            const selectAllMobile = document.getElementById('selectAllMobile');
            const userCheckboxes = document.querySelectorAll('.user-checkbox');
            const bulkActionForm = document.getElementById('bulkActionForm');
            const bulkActionBtn = document.getElementById('bulkActionBtn');
            const selectedCount = document.getElementById('selectedCount');
            const loadingOverlay = document.getElementById('loadingOverlay');
            const deleteButtons = document.querySelectorAll('.delete-user-btn');
            const deleteConfirmModal = document.getElementById('deleteConfirmModal');
            const deleteUserName = document.getElementById('deleteUserName');
            const deleteUserForm = document.getElementById('deleteUserForm');

            // Tooltips initialization
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            const tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });

            // Select all functionality
            function setupSelectAllCheckbox(checkbox, targetCheckboxes) {
                if (checkbox) {
                    checkbox.addEventListener('change', function() {
                        const isChecked = this.checked;
                        targetCheckboxes.forEach(cb => {
                            if (!cb.disabled) {
                                cb.checked = isChecked;
                            }
                        });
                        updateSelectedCount();
                        updateBulkActionButton();
                    });
                }
            }

            setupSelectAllCheckbox(selectAll, userCheckboxes);
            setupSelectAllCheckbox(selectAllMobile, userCheckboxes);

            // Individual checkbox change
            userCheckboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    updateSelectAllCheckboxes();
                    updateSelectedCount();
                    updateBulkActionButton();
                });
            });

            // Update select all checkboxes
            function updateSelectAllCheckboxes() {
                const enabledCheckboxes = Array.from(userCheckboxes).filter(cb => !cb.disabled);
                const checkedEnabled = enabledCheckboxes.filter(cb => cb.checked);

                [selectAll, selectAllMobile].forEach(checkbox => {
                    if (checkbox) {
                        checkbox.checked = checkedEnabled.length === enabledCheckboxes.length && enabledCheckboxes.length > 0;
                        checkbox.indeterminate = checkedEnabled.length > 0 && checkedEnabled.length < enabledCheckboxes.length;
                    }
                });
            }

            // Update selected count
            function updateSelectedCount() {
                const checkedCount = Array.from(userCheckboxes).filter(cb => cb.checked && !cb.disabled).length;
                selectedCount.textContent = checkedCount;
            }

            // Update bulk action button
            function updateBulkActionButton() {
                const checkedCount = Array.from(userCheckboxes).filter(cb => cb.checked && !cb.disabled).length;
                if (bulkActionBtn) {
                    bulkActionBtn.disabled = checkedCount === 0;
                    bulkActionBtn.textContent = checkedCount > 0 ? `Apply to ${checkedCount} Selected` : 'Apply';
                }
            }

            // Bulk action form validation
            if (bulkActionForm) {
                bulkActionForm.addEventListener('submit', function(e) {
                    const checkedBoxes = Array.from(userCheckboxes).filter(cb => cb.checked && !cb.disabled);
                    const action = this.querySelector('select[name="action"]').value;

                    if (checkedBoxes.length === 0) {
                        e.preventDefault();
                        showToast('Please select at least one user.', 'warning');
                        return false;
                    }

                    if (!action) {
                        e.preventDefault();
                        showToast('Please select an action to perform.', 'warning');
                        return false;
                    }

                    if (action === 'delete') {
                        if (!confirm(`Are you sure you want to delete ${checkedBoxes.length} user(s)? This action cannot be undone.`)) {
                            e.preventDefault();
                            return false;
                        }
                    }

                    if (action === 'impersonate') {
                        if (checkedBoxes.length > 1) {
                            e.preventDefault();
                            showToast('You can only impersonate one user at a time.', 'warning');
                            return false;
                        }
                    }

                    // Show loading overlay
                    showLoading();
                });
            }

            // Delete user modal
            deleteButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const userId = this.getAttribute('data-user-id');
                    const userName = this.getAttribute('data-user-name');

                    deleteUserName.textContent = userName;
                    deleteUserForm.action = `/admin/users/${userId}`;

                    const modal = new bootstrap.Modal(deleteConfirmModal);
                    modal.show();
                });
            });

            // Advanced Search Form Handling
            const searchForm = document.getElementById('searchForm');
            if (searchForm) {
                // Auto-submit for filters
                const autoSubmitFields = searchForm.querySelectorAll('select[name="status"], select[name="role"], select[name="department"], select[name="online_status"]');
                autoSubmitFields.forEach(field => {
                    field.addEventListener('change', function() {
                        showLoading();
                        searchForm.submit();
                    });
                });

                // Date validation
                const dateFrom = searchForm.querySelector('input[name="date_from"]');
                const dateTo = searchForm.querySelector('input[name="date_to"]');

                if (dateFrom && dateTo) {
                    dateFrom.addEventListener('change', function() {
                        if (dateTo.value && this.value > dateTo.value) {
                            dateTo.value = this.value;
                        }
                    });

                    dateTo.addEventListener('change', function() {
                        if (dateFrom.value && this.value < dateFrom.value) {
                            dateFrom.value = this.value;
                        }
                    });
                }
            }

            // Preserve pagination parameters
            function preservePagination() {
                const paginationLinks = document.querySelectorAll('.pagination a');
                paginationLinks.forEach(link => {
                    const url = new URL(link.href);
                    const currentUrl = new URL(window.location.href);

                    currentUrl.searchParams.forEach((value, key) => {
                        if (key !== 'page') {
                            url.searchParams.set(key, value);
                        }
                    });

                    link.href = url.toString();
                });
            }

            // Show loading overlay
            function showLoading() {
                if (loadingOverlay) {
                    loadingOverlay.style.display = 'flex';
                }
            }

            // Hide loading overlay
            function hideLoading() {
                if (loadingOverlay) {
                    loadingOverlay.style.display = 'none';
                }
            }

            // Show toast notification
            function showToast(message, type = 'info') {
                const toast = document.createElement('div');
                toast.className = `custom-toast alert alert-${type} alert-dismissible fade show`;
                toast.innerHTML = `
                    <i class="fas fa-${type === 'warning' ? 'exclamation-triangle' : 'info-circle'} me-2"></i>
                    ${message}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                `;
                document.body.appendChild(toast);

                setTimeout(() => {
                    if (toast.parentNode) {
                        toast.remove();
                    }
                }, 5000);
            }

            // Row click for selection (optional)
            document.querySelectorAll('tbody tr').forEach(row => {
                row.addEventListener('click', function(e) {
                    if (!e.target.closest('a') && !e.target.closest('button') && !e.target.closest('input')) {
                        const checkbox = this.querySelector('.user-checkbox');
                        if (checkbox && !checkbox.disabled) {
                            checkbox.checked = !checkbox.checked;
                            checkbox.dispatchEvent(new Event('change'));
                        }
                    }
                });
            });

            // Hide loading when page is fully loaded
            window.addEventListener('load', hideLoading);

            // Initialize
            updateSelectedCount();
            updateBulkActionButton();
            updateSelectAllCheckboxes();
            preservePagination();
        });
    </script>
@endpush
