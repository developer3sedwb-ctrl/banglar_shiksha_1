@extends('layouts.app')

@section('title', 'User Management')
@section('page-title', 'User Management')
@section('page-subtitle', 'Manage system users and their roles')

@push('css')
    <style>
        /* Compact Design */
        :root {
            --compact-padding: 0.5rem;
            --border-radius-sm: 6px;
            --border-radius-md: 8px;
        }

        .card {
            border: none;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
        }

        .card-header {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            color: white;
            padding: 0.75rem 1rem;
            border-bottom: none;
        }

        .card-body {
            padding: 1rem;
        }

        /* Compact Table */
        .table {
            margin-bottom: 0;
            font-size: 0.875rem;
        }

        .table th {
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.5px;
            padding: 0.75rem 0.5rem;
            background: #f8fafc;
            border-bottom: 2px solid #e2e8f0;
            color: #475569;
        }

        .table td {
            padding: 0.5rem;
            vertical-align: middle;
            border-color: #f1f5f9;
        }

        .table tr:hover {
            background-color: #f8fafc;
        }

        /* Avatar - Smaller */
        .avatar-sm {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 0.875rem;
        }

        .avatar-online {
            position: relative;
        }

        .avatar-online::after {
            content: '';
            position: absolute;
            bottom: 0;
            right: 0;
            width: 8px;
            height: 8px;
            background-color: #10b981;
            border-radius: 50%;
            border: 2px solid white;
        }

        /* Compact Action Buttons */
        .btn-xs {
            padding: 0.25rem 0.5rem;
            font-size: 0.75rem;
            line-height: 1;
            border-radius: var(--border-radius-sm);
        }

        .action-buttons {
            display: flex;
            gap: 0.25rem;
        }

        .action-btn {
            width: 28px;
            height: 28px;
            padding: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 6px;
        }

        /* Text Highlighting */
        .text-highlight {
            color: #1e40af;
            font-weight: 600;
        }

        .text-muted {
            color: #64748b !important;
            font-size: 0.8125rem;
        }

        .text-success {
            color: #059669 !important;
        }

        .text-danger {
            color: #dc2626 !important;
        }

        .text-warning {
            color: #d97706 !important;
        }

        .text-info {
            color: #0891b2 !important;
        }

        /* Badge Compact */
        .badge-sm {
            font-size: 0.6875rem;
            padding: 0.25rem 0.5rem;
            border-radius: 10px;
            font-weight: 500;
        }

        .badge-success-light {
            background-color: #d1fae5;
            color: #065f46;
        }

        .badge-danger-light {
            background-color: #fee2e2;
            color: #991b1b;
        }

        .badge-primary-light {
            background-color: #dbeafe;
            color: #1e40af;
        }

        .badge-warning-light {
            background-color: #fef3c7;
            color: #92400e;
        }

        /* Form Controls Compact */
        .form-control-sm,
        .form-select-sm {
            padding: 0.375rem 0.75rem;
            font-size: 0.875rem;
            border-radius: var(--border-radius-sm);
        }

        .input-group-sm>.form-control,
        .input-group-sm>.form-select {
            padding: 0.375rem 0.75rem;
            font-size: 0.875rem;
        }

        /* Search Card Compact */
        .search-card .card-header {
            padding: 0.5rem 1rem;
            background: #f8fafc;
            color: #1e293b;
            border-bottom: 1px solid #e2e8f0;
        }

        .search-card .card-body {
            padding: 0.75rem;
        }

        /* Stats Compact */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
            gap: 0.5rem;
            margin: 0.75rem 0;
        }

        .stat-card {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: var(--border-radius-md);
            padding: 0.75rem;
            text-align: center;
        }

        .stat-number {
            font-size: 1.25rem;
            font-weight: 700;
            line-height: 1;
            margin-bottom: 0.25rem;
        }

        .stat-label {
            font-size: 0.75rem;
            color: #64748b;
        }

        /* Bulk Actions Compact */
        .bulk-section {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: var(--border-radius-md);
            padding: 0.75rem;
            margin: 0.75rem 0;
        }

        /* Empty State Compact */
        .empty-state {
            padding: 2rem 1rem;
            text-align: center;
        }

        .empty-state-icon {
            font-size: 2.5rem;
            color: #cbd5e1;
            margin-bottom: 1rem;
        }

        /* Pagination Compact */
        .pagination-sm .page-link {
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
        }

        /* User Info Compact */
        .user-info {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .user-details {
            flex: 1;
            min-width: 0;
        }

        .user-name {
            font-weight: 600;
            color: #1e293b;
            font-size: 0.875rem;
            line-height: 1.2;
        }

        .user-email {
            color: #64748b;
            font-size: 0.8125rem;
            line-height: 1.2;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        /* Role Tags Compact */
        .role-tag {
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
            background: #e0e7ff;
            color: #3730a3;
            padding: 0.125rem 0.5rem;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: 500;
            margin: 0.125rem;
        }

        /* Last Login Compact */
        .last-login {
            font-size: 0.8125rem;
            color: #64748b;
        }

        .last-login-time {
            font-weight: 500;
            color: #1e293b;
        }

        /* Impersonation Notice Compact */
        .impersonation-notice {
            background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
            color: #78350f;
            padding: 0.375rem 0.75rem;
            border-radius: var(--border-radius-sm);
            font-size: 0.8125rem;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            margin-right: 0.75rem;
        }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            .table-responsive {
                margin: 0 -1rem;
                padding: 0 1rem;
            }

            .action-buttons {
                flex-wrap: wrap;
            }

            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        /* Hover Effects */
        .btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .stat-card:hover {
            border-color: #c7d2fe;
            box-shadow: 0 2px 4px rgba(99, 102, 241, 0.1);
        }

        /* Custom Scrollbar */
        .table-responsive::-webkit-scrollbar {
            height: 6px;
        }

        .table-responsive::-webkit-scrollbar-track {
            background: #f1f5f9;
        }

        .table-responsive::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 3px;
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid">
        <!-- Loading Overlay -->
        <div class="loading-overlay d-none" id="loadingOverlay">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <!-- Main Card -->
                <div class="card">
                    <!-- Card Header -->
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="mb-0 fw-bold">
                                <i class='bx bx-user me-2'></i>User Management
                            </h5>
                            <small class="opacity-75">Manage all system users and permissions</small>
                        </div>
                        <div class="d-flex align-items-center">
                            <!-- Impersonation Notice -->
                            @if (session('impersonator'))
                                <div class="impersonation-notice">
                                    <i class='bx bx-user-voice'></i>
                                    <span>Impersonating: {{ auth()->user()->name }}</span>
                                    <a href="{{ route('admin.users.stop-impersonate') }}"
                                        class="btn btn-xs btn-danger ms-2">
                                        <i class='bx bx-log-out'></i> Stop
                                    </a>
                                </div>
                            @endif

                            @can('create users')
                                <a href="{{ route('admin.users.create') }}" class="btn btn-primary btn-sm">
                                    <i class='bx bx-plus me-1'></i> Add User
                                </a>
                            @endcan
                        </div>
                    </div>

                    <!-- Card Body -->
                    <div class="card-body">
                        <!-- Messages -->
                        @session('success')
                            <div class="alert alert-success alert-dismissible fade show py-2" role="alert">
                                <i class='bx bx-check-circle me-2'></i>
                                {{ $value }}
                                <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert"></button>
                            </div>
                        @endsession

                        @session('error')
                            <div class="alert alert-danger alert-dismissible fade show py-2" role="alert">
                                <i class='bx bx-error-circle me-2'></i>
                                {{ $value }}
                                <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert"></button>
                            </div>
                        @endsession

                        <!-- Search Section -->
                        <div class="card search-card mb-3">
                            <div class="card-header py-2">
                                <h6 class="mb-0">
                                    <i class='bx bx-search me-2'></i>Search & Filters
                                </h6>
                            </div>
                            <div class="card-body">
                                <form method="GET" action="{{ route('admin.users.index') }}" id="searchForm">
                                    <div class="row g-2">
                                        <!-- Global Search -->
                                        <div class="col-lg-3 col-md-6">
                                            <div class="input-group input-group-sm">
                                                <span class="input-group-text bg-transparent">
                                                    <i class='bx bx-search text-muted'></i>
                                                </span>
                                                <input type="text" name="search" class="form-control"
                                                    placeholder="Search..." value="{{ request('search') }}">
                                            </div>
                                        </div>

                                        <!-- Status -->
                                        <div class="col-lg-2 col-md-4">
                                            <select name="status" class="form-select form-select-sm">
                                                <option value="all">All Status</option>
                                                <option value="active"
                                                    {{ request('status') == 'active' ? 'selected' : '' }}>
                                                    Active
                                                </option>
                                                <option value="inactive"
                                                    {{ request('status') == 'inactive' ? 'selected' : '' }}>
                                                    Inactive
                                                </option>
                                            </select>
                                        </div>

                                        <!-- Role -->
                                        <div class="col-lg-2 col-md-4">
                                            <select name="role" class="form-select form-select-sm">
                                                <option value="all">All Roles</option>
                                                @foreach ($roles as $roleName => $roleDisplay)
                                                    <option value="{{ $roleName }}"
                                                        {{ request('role') == $roleName ? 'selected' : '' }}>
                                                        {{ $roleDisplay }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <!-- Department -->
                                        <div class="col-lg-2 col-md-4">
                                            <select name="department" class="form-select form-select-sm">
                                                <option value="all">All Departments</option>
                                                @foreach ($departments as $department)
                                                    <option value="{{ $department }}"
                                                        {{ request('department') == $department ? 'selected' : '' }}>
                                                        {{ $department }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <!-- Action Buttons -->
                                        <div class="col-lg-3 col-md-6 d-flex gap-2">
                                            <button type="submit" class="btn btn-primary btn-sm flex-grow-1">
                                                <i class='bx bx-search me-1'></i> Search
                                            </button>
                                            <a href="{{ route('admin.users.index') }}"
                                                class="btn btn-outline-secondary btn-sm">
                                                <i class='bx bx-reset'></i>
                                            </a>
                                        </div>
                                    </div>

                                    <!-- Advanced Filters (Collapsible) -->
                                    <div class="mt-2">
                                        <a class="btn btn-link btn-sm text-decoration-none p-0" data-bs-toggle="collapse"
                                            href="#advancedFilters" role="button">
                                            <i class='bx bx-chevron-down me-1'></i>Advanced Filters
                                        </a>

                                        <div class="collapse mt-2" id="advancedFilters">
                                            <div class="row g-2">
                                                <!-- Date Range -->
                                                <div class="col-md-3">
                                                    <input type="date" name="date_from"
                                                        class="form-control form-control-sm" placeholder="From"
                                                        value="{{ request('date_from') }}">
                                                </div>
                                                <div class="col-md-3">
                                                    <input type="date" name="date_to"
                                                        class="form-control form-control-sm" placeholder="To"
                                                        value="{{ request('date_to') }}">
                                                </div>

                                                <!-- Online Status -->
                                                <div class="col-md-3">
                                                    <select name="online_status" class="form-select form-select-sm">
                                                        <option value="all">All Online Status</option>
                                                        <option value="online"
                                                            {{ request('online_status') == 'online' ? 'selected' : '' }}>
                                                            Online
                                                        </option>
                                                        <option value="offline"
                                                            {{ request('online_status') == 'offline' ? 'selected' : '' }}>
                                                            Offline
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Quick Stats -->
                        {{-- <div class="stats-grid d-flex mt-5 text-center mb-3">
                            <div class="stat-card">
                                <div class="stat-number text-primary">{{ $users->total() }}</div>
                                <div class="stat-label">Total Users</div>
                                <i class='bx bx-user mt-1 text-primary'></i>
                            </div>
                            <div class="stat-card">
                                <div class="stat-number text-success">{{ $activeUsersCount ?? 0 }}</div>
                                <div class="stat-label">Active</div>
                                <i class='bx bx-user-check mt-1 text-success'></i>
                            </div>
                            <div class="stat-card">
                                <div class="stat-number text-danger">{{ $inactiveUsersCount ?? 0 }}</div>
                                <div class="stat-label">Inactive</div>
                                <i class='bx bx-user-x mt-1 text-danger'></i>
                            </div>
                            <div class="stat-card">
                                <div class="stat-number text-info">{{ $onlineUsersCount ?? 0 }}</div>
                                <div class="stat-label">Online</div>
                                <i class='bx bx-wifi mt-1 text-info'></i>
                            </div>
                        </div> --}}

                        <!-- Bulk Actions -->
                        @canany(['edit users', 'delete users', 'impersonate users'])
                            <div class="bulk-section">
                                <form method="POST" action="{{ route('admin.users.bulk-action') }}" id="bulkActionForm">
                                    @csrf
                                    <div class="row align-items-center g-2">
                                        <div class="col-md-4">
                                            <div class="d-flex align-items-center gap-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="selectAll">
                                                    <label class="form-check-label small" for="selectAll">
                                                        Select All
                                                    </label>
                                                </div>
                                                <span class="badge bg-light text-dark">
                                                    <span id="selectedCount">0</span> selected
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="d-flex gap-2">
                                                <select name="action" class="form-select form-select-sm" required>
                                                    <option value="">Bulk Action...</option>
                                                    <option value="activate">Activate</option>
                                                    <option value="deactivate">Deactivate</option>
                                                    @can('impersonate users')
                                                        <option value="impersonate">Impersonate</option>
                                                    @endcan
                                                    @can('delete users')
                                                        <option value="delete">Delete</option>
                                                    @endcan
                                                </select>
                                                <button type="submit" class="btn btn-sm btn-primary" id="bulkActionBtn"
                                                    disabled>
                                                    Apply
                                                </button>
                                            </div>
                                        </div>
                                        <div class="col-md-3 text-end">
                                            <small class="text-muted">
                                                Showing {{ $users->firstItem() }}-{{ $users->lastItem() }} of
                                                {{ $users->total() }}
                                            </small>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        @endcanany

                        <!-- Users Table -->
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        @canany(['edit users', 'delete users', 'impersonate users'])
                                            <th width="40px" class="ps-3">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="selectAllTable">
                                                </div>
                                            </th>
                                        @endcanany
                                        <th width="60px">ID</th>
                                        <th>User</th>
                                        <th>Dise Code</th>
                                        <th>Role</th>
                                        <th>Department</th>
                                        <th width="100px">Status</th>
                                        <th width="120px">Last Login</th>
                                        <th width="100px" class="text-end pe-3">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($users as $user)
                                        <tr class="{{ $user->id == auth()->id() ? 'table-active' : '' }}">
                                            @canany(['edit users', 'delete users', 'impersonate users'])
                                                <td class="ps-3">
                                                    <div class="form-check">
                                                        <input type="checkbox" name="users[]" value="{{ $user->id }}"
                                                            class="user-checkbox form-check-input"
                                                            {{ $user->id == auth()->id() || $user->hasRole('Super Admin') ? 'disabled' : '' }}>
                                                    </div>
                                                </td>
                                            @endcanany
                                            <td>
                                                <span class="badge bg-light text-dark">#{{ $user->id }}</span>
                                            </td>
                                            <td>
                                                <div class="user-info">
                                                    <div class="avatar-sm {{ $user->is_online ? 'avatar-online' : '' }}">
                                                        {{ substr($user->name, 0, 1) }}
                                                    </div>
                                                    <div class="user-details">
                                                        <div class="user-name text-highlight">{{ $user->name }}</div>
                                                        <div class="user-email">{{ $user->email }}</div>
                                                        @if ($user->phone)
                                                            <small class="text-muted">
                                                                <i class='bx bx-phone'></i> {{ $user->phone }}
                                                            </small>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="text-highlight">
                                                    {{ $user->dise_code ?? 'N/A' }}
                                                </span>
                                            </td>
                                            <td>
                                                <div class="d-flex flex-wrap gap-1">
                                                    @foreach ($user->roles as $role)
                                                        <span class="role-tag">
                                                            <i class='bx bx-shield-alt'></i>
                                                            {{ $role->name }}
                                                        </span>
                                                    @endforeach
                                                </div>
                                                <small class="text-muted">
                                                    @php
                                                        $permissionCount = 0;
                                                        foreach ($user->roles as $role) {
                                                            $permissionCount += $role->permissions->count();
                                                        }
                                                    @endphp
                                                    {{ $permissionCount }} perms
                                                </small>
                                            </td>
                                            <td>
                                                <span class="text-highlight">
                                                    {{ $user->department ?? 'N/A' }}
                                                </span>
                                            </td>
                                            <td>
                                                <span
                                                    class="badge-sm {{ $user->status ? 'badge-success-light' : 'badge-danger-light' }}">
                                                    <i class='bx bx-{{ $user->status ? 'check' : 'x' }} me-1'></i>
                                                    {{ $user->status ? 'Active' : 'Inactive' }}
                                                </span>
                                                @if ($user->is_online)
                                                    <span class="badge-sm badge-success-light mt-1 d-block">
                                                        <i class='bx bx-wifi'></i> Online
                                                    </span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="last-login">
                                                    @if ($user->last_login_at)
                                                        <div class="last-login-time">
                                                            {{ $user->last_login_at->format('M j') }}
                                                        </div>
                                                        <small class="text-muted">
                                                            {{ $user->last_login_at->format('g:i A') }}
                                                        </small>
                                                    @else
                                                        <span class="text-muted">Never</span>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div class="action-buttons d-flex justify-content-end gap-1">
                                                    @can('view users')
                                                        <a href="{{ route('admin.users.show', $user->id) }}"
                                                            class="btn btn-info btn-xs action-btn" data-bs-toggle="tooltip"
                                                            title="View">
                                                            <i class='bx bx-show'></i>
                                                        </a>
                                                    @endcan

                                                    @can('impersonate users')
                                                        @if ($user->id != auth()->id() && !$user->hasRole('Super Admin'))
                                                            <a href="{{ route('admin.users.impersonate', $user->id) }}"
                                                                class="btn btn-warning btn-xs action-btn"
                                                                data-bs-toggle="tooltip" title="Impersonate"
                                                                onclick="return confirm('Impersonate {{ $user->name }}?')">
                                                                <i class='bx bx-user-voice'></i>
                                                            </a>
                                                        @endif
                                                    @endcan

                                                    @can('edit users')
                                                        <a href="{{ route('admin.users.edit', $user->id) }}"
                                                            class="btn btn-primary btn-xs action-btn" data-bs-toggle="tooltip"
                                                            title="Edit"
                                                            {{ $user->hasRole('Super Admin') && !auth()->user()->hasRole('Super Admin') ? 'disabled' : '' }}>
                                                            <i class='bx bx-edit'></i>
                                                        </a>
                                                    @endcan

                                                    @can('delete users')
                                                        @if ($user->id != auth()->id() && !$user->hasRole('Super Admin'))
                                                            <button type="button"
                                                                class="btn btn-danger btn-xs action-btn delete-btn"
                                                                data-bs-toggle="tooltip" title="Delete"
                                                                data-user-id="{{ $user->id }}"
                                                                data-user-name="{{ $user->name }}">
                                                                <i class='bx bx-trash'></i>
                                                            </button>
                                                        @endif
                                                    @endcan
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="{{ auth()->user()->canAny(['edit users', 'delete users', 'impersonate users'])? 8: 7 }}"
                                                class="text-center py-4">
                                                <div class="empty-state">
                                                    <i class='bx bx-user-x empty-state-icon'></i>
                                                    <h6 class="mb-2 text-highlight">No Users Found</h6>
                                                    <p class="text-muted small mb-3">No users match your search criteria.
                                                    </p>
                                                    @can('create users')
                                                        <a href="{{ route('admin.users.create') }}"
                                                            class="btn btn-sm btn-primary">
                                                            <i class='bx bx-plus me-1'></i> Create User
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
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <div class="text-muted small">
                                    Showing {{ $users->firstItem() }} to {{ $users->lastItem() }} of
                                    {{ $users->total() }}
                                </div>
                                <div>
                                    {{ $users->onEachSide(1)->links('pagination::bootstrap-5') }}
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0 pb-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body text-center py-3">
                    <i class='bx bx-trash text-danger mb-3' style="font-size: 3rem;"></i>
                    <h5 class="mb-2 text-highlight">Delete User?</h5>
                    <p class="text-muted mb-0">Are you sure you want to delete <strong id="deleteUserName"></strong>?</p>
                    <small class="text-danger d-block mt-1">This action cannot be undone.</small>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-outline-secondary btn-sm"
                        data-bs-dismiss="modal">Cancel</button>
                    <form id="deleteForm" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">
                            <i class='bx bx-trash me-1'></i> Delete
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
            const selectAllTable = document.getElementById('selectAllTable');
            const userCheckboxes = document.querySelectorAll('.user-checkbox');
            const bulkActionForm = document.getElementById('bulkActionForm');
            const bulkActionBtn = document.getElementById('bulkActionBtn');
            const selectedCount = document.getElementById('selectedCount');
            const deleteButtons = document.querySelectorAll('.delete-btn');
            const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
            const deleteForm = document.getElementById('deleteForm');
            const deleteUserName = document.getElementById('deleteUserName');

            // Tooltips
            const tooltips = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
                .map(el => new bootstrap.Tooltip(el));

            // Select All functionality
            function setupSelectAll(source, targets) {
                if (source) {
                    source.addEventListener('change', function() {
                        targets.forEach(cb => {
                            if (!cb.disabled) cb.checked = this.checked;
                        });
                        updateSelection();
                    });
                }
            }

            setupSelectAll(selectAll, userCheckboxes);
            setupSelectAll(selectAllTable, userCheckboxes);

            // Individual checkbox change
            userCheckboxes.forEach(cb => {
                cb.addEventListener('change', updateSelection);
            });

            // Update selection counters
            function updateSelection() {
                const selected = Array.from(userCheckboxes).filter(cb => cb.checked && !cb.disabled);
                selectedCount.textContent = selected.length;

                // Update bulk action button
                if (bulkActionBtn) {
                    bulkActionBtn.disabled = selected.length === 0;
                }

                // Update select all checkboxes
                const enabled = Array.from(userCheckboxes).filter(cb => !cb.disabled);
                const allSelected = selected.length === enabled.length && enabled.length > 0;
                const indeterminate = selected.length > 0 && selected.length < enabled.length;

                [selectAll, selectAllTable].forEach(cb => {
                    if (cb) {
                        cb.checked = allSelected;
                        cb.indeterminate = indeterminate;
                    }
                });
            }

            // Bulk action form validation
            if (bulkActionForm) {
                bulkActionForm.addEventListener('submit', function(e) {
                    const selected = Array.from(userCheckboxes).filter(cb => cb.checked && !cb.disabled);
                    const action = this.querySelector('select[name="action"]').value;

                    if (selected.length === 0) {
                        e.preventDefault();
                        showToast('Please select at least one user.', 'warning');
                        return false;
                    }

                    if (!action) {
                        e.preventDefault();
                        showToast('Please select an action.', 'warning');
                        return false;
                    }

                    if (action === 'delete' && !confirm(`Delete ${selected.length} user(s)?`)) {
                        e.preventDefault();
                        return false;
                    }

                    if (action === 'impersonate' && selected.length > 1) {
                        e.preventDefault();
                        showToast('Can only impersonate one user.', 'warning');
                        return false;
                    }
                });
            }

            // Delete button handlers
            deleteButtons.forEach(btn => {
                btn.addEventListener('click', function() {
                    const userId = this.dataset.userId;
                    const userName = this.dataset.userName;

                    deleteUserName.textContent = userName;
                    deleteForm.action = `/admin/users/${userId}`;
                    deleteModal.show();
                });
            });

            // Auto-submit filters on change
            document.querySelectorAll('#searchForm select').forEach(select => {
                select.addEventListener('change', function() {
                    this.form.submit();
                });
            });

            // Collapsible advanced filters
            const advancedFilters = document.getElementById('advancedFilters');
            if (advancedFilters) {
                const urlParams = new URLSearchParams(window.location.search);
                const hasAdvancedFilters = ['date_from', 'date_to', 'online_status'].some(param => urlParams.has(
                    param));

                if (hasAdvancedFilters) {
                    const bsCollapse = new bootstrap.Collapse(advancedFilters, {
                        toggle: false
                    });
                    bsCollapse.show();
                }
            }

            // Row click for selection (optional)
            document.querySelectorAll('tbody tr').forEach(row => {
                row.addEventListener('click', function(e) {
                    if (!e.target.closest('a') && !e.target.closest('button') && !e.target.closest(
                            'input')) {
                        const checkbox = this.querySelector('.user-checkbox');
                        if (checkbox && !checkbox.disabled) {
                            checkbox.checked = !checkbox.checked;
                            checkbox.dispatchEvent(new Event('change'));
                        }
                    }
                });
            });

            // Toast notification
            function showToast(message, type = 'info') {
                const toast = document.createElement('div');
                toast.className = `toast align-items-center text-bg-${type} border-0 position-fixed`;
                toast.style.cssText = 'top: 20px; right: 20px; z-index: 9999;';
                toast.innerHTML = `
            <div class="d-flex">
                <div class="toast-body">
                    <i class='bx bx-${type === 'warning' ? 'error' : 'info-circle'} me-2'></i>
                    ${message}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>
        `;
                document.body.appendChild(toast);

                const bsToast = new bootstrap.Toast(toast);
                bsToast.show();

                toast.addEventListener('hidden.bs.toast', () => toast.remove());
            }

            // Initialize
            updateSelection();
        });
    </script>
@endpush
