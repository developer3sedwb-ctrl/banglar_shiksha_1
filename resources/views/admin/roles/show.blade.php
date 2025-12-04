@extends('layouts.app')

@section('title', 'Role Details')
@section('page-title', 'Role Details')
@section('page-subtitle', 'View role information and permissions')

@push('css')
<style>
    .card-sm {
        border-radius: 0.5rem;
        border: 1px solid #dee2e6;
    }

    .badge-sm {
        font-size: 0.7rem;
        padding: 0.2rem 0.5rem;
    }

    .permission-card {
        border: 1px solid #dee2e6;
        border-radius: 0.5rem;
        transition: all 0.2s ease;
        margin-bottom: 1rem;
    }

    .permission-card:hover {
        border-color: #0d6efd;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
    }

    .permission-item {
        padding: 0.5rem 0.75rem;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        font-size: 0.85rem;
    }

    .permission-item:last-child {
        border-bottom: none;
    }

    .permission-item:hover {
        background-color: rgba(0, 0, 0, 0.02);
    }

    .copy-permission {
        opacity: 0;
        transition: opacity 0.2s ease;
        padding: 0.125rem 0.375rem;
        font-size: 0.75rem;
    }

    .permission-item:hover .copy-permission {
        opacity: 1;
    }

    .user-avatar {
        width: 32px;
        height: 32px;
        font-size: 0.8rem;
        border-radius: 50%;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
    }

    .stat-card {
        padding: 1rem;
        border-radius: 0.5rem;
        background: #f8f9fa;
        text-align: center;
    }

    .stat-number {
        font-size: 1.5rem;
        font-weight: 700;
        color: #2d3748;
    }

    .stat-label {
        font-size: 0.75rem;
        color: #6c757d;
        margin-top: 0.25rem;
    }

    .status-indicator {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        display: inline-block;
        margin-right: 0.25rem;
    }

    .status-online {
        background-color: #28a745;
    }

    .status-offline {
        background-color: #6c757d;
    }

    .table-sm th, .table-sm td {
        padding: 0.75rem 0.5rem;
        font-size: 0.875rem;
    }

    .breadcrumb {
        font-size: 0.875rem;
        padding: 0.5rem 0;
        background: transparent;
    }

    .group-icon {
        width: 32px;
        height: 32px;
        background: rgba(13, 110, 253, 0.1);
        border-radius: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #0d6efd;
    }

    .search-input {
        font-size: 0.875rem;
        padding: 0.375rem 0.75rem;
        height: calc(1.5em + 0.75rem + 2px);
    }

    .empty-state {
        padding: 2rem;
        text-align: center;
    }

    .empty-state-icon {
        font-size: 2rem;
        opacity: 0.3;
        margin-bottom: 1rem;
    }

    .filter-badge {
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .filter-badge.active {
        background-color: #0d6efd;
        color: white;
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    <!-- Breadcrumb -->
    <div class="row mb-3">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.roles.index') }}">Roles</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $role->name }}</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Error Display -->
    <x-error-display />

    <div class="row">
        <div class="col-12">
            <div class="card card-sm">
                <div class="card-header bg-white py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0 fs-6 fw-bold">
                            <i class='bx bx-show me-2'></i>Role Details: {{ $role->name }}
                        </h5>
                        <div class="btn-group btn-group-sm">
                            @can('edit roles')
                                @if(!in_array($role->name, ['Super Admin', 'State Admin']) || auth()->user()->hasRole('Super Admin'))
                                    <a href="{{ route('admin.roles.edit', $role->id) }}" class="btn btn-primary">
                                        <i class='bx bx-edit me-1'></i>Edit
                                    </a>
                                @endif
                            @endcan
                            <a href="{{ route('admin.roles.index') }}" class="btn btn-outline-secondary">
                                <i class='bx bx-arrow-back me-1'></i>Back
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Role Information -->
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-lg-8">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="card bg-light border-0">
                                        <div class="card-body p-3">
                                            <table class="table table-borderless table-sm mb-0">
                                                <tbody>
                                                    <tr>
                                                        <td class="ps-0" width="40%"><strong>Role Name:</strong></td>
                                                        <td>
                                                            <span class="badge bg-primary">{{ $role->name }}</span>
                                                            @if(in_array($role->name, ['Super Admin', 'State Admin']))
                                                                <span class="badge bg-warning text-dark ms-1">
                                                                    <i class='bx bx-shield-quarter me-1'></i>Protected
                                                                </span>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    @if($role->description)
                                                    <tr>
                                                        <td class="ps-0"><strong>Description:</strong></td>
                                                        <td class="text-muted small">{{ $role->description }}</td>
                                                    </tr>
                                                    @endif
                                                    @if($role->stakeholder)
                                                    <tr>
                                                        <td class="ps-0"><strong>Stakeholder:</strong></td>
                                                        <td>
                                                            <span class="badge bg-info">{{ $role->stakeholder }}</span>
                                                        </td>
                                                    </tr>
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="card bg-light border-0">
                                        <div class="card-body p-3">
                                            <table class="table table-borderless table-sm mb-0">
                                                <tbody>
                                                    <tr>
                                                        <td class="ps-0" width="40%"><strong>Total Users:</strong></td>
                                                        <td>
                                                            <span class="badge bg-secondary">{{ $role->users_count ?? $role->users->count() }}</span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="ps-0"><strong>Total Permissions:</strong></td>
                                                        <td>
                                                            <span class="badge bg-info">{{ $role->permissions_count ?? $role->permissions->count() }}</span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="ps-0"><strong>Created:</strong></td>
                                                        <td class="text-muted small">
                                                            {{ $role->created_at->format('M d, Y') }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="ps-0"><strong>Updated:</strong></td>
                                                        <td class="text-muted small">
                                                            {{ $role->updated_at->format('M d, Y') }}
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="row g-2">
                                <div class="col-6">
                                    <div class="stat-card">
                                        <div class="stat-number">{{ $permissionsByGroup->count() ?? 0 }}</div>
                                        <div class="stat-label">Modules</div>
                                        <i class='bx bx-folder mt-2 opacity-50'></i>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="stat-card">
                                        <div class="stat-number">{{ $role->permissions_count ?? $role->permissions->count() }}</div>
                                        <div class="stat-label">Permissions</div>
                                        <i class='bx bx-key mt-2 opacity-50'></i>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="stat-card">
                                        <div class="stat-number">{{ $role->users_count ?? $role->users->count() }}</div>
                                        <div class="stat-label">Users</div>
                                        <i class='bx bx-user mt-2 opacity-50'></i>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="stat-card">
                                        <div class="stat-number">{{ $totalUsersOnline ?? 0 }}</div>
                                        <div class="stat-label">Online</div>
                                        <i class='bx bx-signal mt-2 opacity-50'></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Permissions Section -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h6 class="mb-0 fw-bold">
                                    <i class='bx bx-key me-2'></i>Assigned Permissions
                                </h6>
                                <div class="d-flex align-items-center gap-2">
                                    <div class="input-group input-group-sm" style="width: 250px;">
                                        <span class="input-group-text"><i class='bx bx-search'></i></span>
                                        <input type="text" class="form-control search-input"
                                               placeholder="Search permissions..." id="permissionSearch">
                                    </div>
                                    @if($permissionsByGroup && $permissionsByGroup->count() > 0)
                                    <div class="dropdown">
                                        <button class="btn btn-outline-secondary btn-sm dropdown-toggle"
                                                type="button" data-bs-toggle="dropdown">
                                            <i class='bx bx-filter me-1'></i>Filter
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item small" href="#" data-filter="all">All Groups</a></li>
                                            @foreach($permissionsByGroup as $group => $permissions)
                                                <li><a class="dropdown-item small" href="#" data-filter="{{ $group }}">{{ $group }}</a></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    @endif
                                </div>
                            </div>

                            @if($permissionsByGroup && $permissionsByGroup->count() > 0)
                                <div class="row g-3" id="permissionsContainer">
                                    @foreach($permissionsByGroup as $group => $permissions)
                                        <div class="col-lg-4 col-md-6">
                                            <div class="card permission-card" data-group="{{ $group }}">
                                                <div class="card-header bg-white border-bottom py-2">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div class="d-flex align-items-center gap-2">
                                                            <div class="group-icon">
                                                                <i class='bx bx-folder'></i>
                                                            </div>
                                                            <div>
                                                                <h6 class="mb-0 small fw-bold text-capitalize">{{ $group }}</h6>
                                                                <small class="text-muted">{{ $permissions->count() }} permissions</small>
                                                            </div>
                                                        </div>
                                                        <span class="badge bg-primary badge-sm">{{ $permissions->count() }}</span>
                                                    </div>
                                                </div>
                                                <div class="card-body p-0">
                                                    @foreach($permissions as $permission)
                                                        <div class="permission-item d-flex align-items-center justify-content-between">
                                                            <div class="d-flex align-items-center gap-2">
                                                                <i class='bx bx-key text-success'></i>
                                                                <span class="small" title="{{ $permission->name }}">
                                                                    {{ Str::limit($permission->name, 25) }}
                                                                </span>
                                                            </div>
                                                            <button class="btn btn-sm btn-outline-secondary copy-permission"
                                                                    data-permission="{{ $permission->name }}"
                                                                    data-bs-toggle="tooltip" title="Copy">
                                                                <i class='bx bx-copy'></i>
                                                            </button>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                @can('edit roles')
                                                <div class="card-footer bg-white border-top py-2">
                                                    <a href="{{ route('admin.roles.edit', $role->id) }}?group={{ $group }}"
                                                       class="btn btn-outline-primary btn-sm w-100">
                                                        <i class='bx bx-edit me-1'></i>Manage Group
                                                    </a>
                                                </div>
                                                @endcan
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <!-- Quick Actions -->
                                @can('edit roles')
                                <div class="mt-4">
                                    <div class="card border-0 bg-light">
                                        <div class="card-body p-3">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div>
                                                    <h6 class="mb-1 small fw-bold">Quick Actions</h6>
                                                    <p class="text-muted small mb-0">Manage role permissions</p>
                                                </div>
                                                <div class="dropdown">
                                                    <button class="btn btn-primary btn-sm dropdown-toggle"
                                                            type="button" data-bs-toggle="dropdown">
                                                        <i class='bx bx-cog me-1'></i>Actions
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li>
                                                            <a class="dropdown-item small"
                                                               href="{{ route('admin.roles.edit', $role->id) }}">
                                                                <i class='bx bx-edit me-2'></i>Edit All Permissions
                                                            </a>
                                                        </li>
                                                        <li><hr class="dropdown-divider"></li>
                                                        @foreach($permissionsByGroup as $group => $permissions)
                                                            <li>
                                                                <a class="dropdown-item small"
                                                                   href="{{ route('admin.roles.edit', $role->id) }}?group={{ $group }}">
                                                                    <i class='bx bx-folder me-2'></i>Edit {{ $group }}
                                                                </a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endcan

                            @else
                                <div class="empty-state">
                                    <div class="empty-state-icon">
                                        <i class='bx bx-lock-open'></i>
                                    </div>
                                    <h6 class="text-dark mb-2">No Permissions Assigned</h6>
                                    <p class="text-muted small mb-3">This role doesn't have any permissions assigned yet.</p>
                                    @can('edit roles')
                                        <a href="{{ route('admin.roles.edit', $role->id) }}" class="btn btn-primary btn-sm">
                                            <i class='bx bx-key me-1'></i>Assign Permissions
                                        </a>
                                    @endcan
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Assigned Users -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card card-sm">
                                <div class="card-header bg-white py-3">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h6 class="mb-0 fw-bold">
                                            <i class='bx bx-user me-2'></i>Assigned Users
                                            <span class="badge bg-secondary ms-1">{{ $role->users_count ?? $role->users->count() }}</span>
                                        </h6>
                                        <div class="input-group input-group-sm" style="width: 250px;">
                                            <span class="input-group-text"><i class='bx bx-search'></i></span>
                                            <input type="text" class="form-control search-input"
                                                   placeholder="Search users..." id="userSearch">
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    @if($role->users && $role->users->count() > 0)
                                        <div class="table-responsive">
                                            <table class="table table-sm table-hover" id="usersTable">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th class="small fw-bold">User</th>
                                                        <th class="small fw-bold">Email</th>
                                                        <th class="small fw-bold">Status</th>
                                                        <th class="small fw-bold">Last Login</th>
                                                        <th class="small fw-bold">Online</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($role->users as $user)
                                                        <tr>
                                                            <td>
                                                                <div class="d-flex align-items-center gap-2">
                                                                    <div class="user-avatar">
                                                                        {{ substr($user->name, 0, 1) }}
                                                                    </div>
                                                                    <div>
                                                                        <div class="small fw-semibold">{{ $user->name }}</div>
                                                                        <div class="text-muted x-small">{{ $user->department ?? 'N/A' }}</div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td class="small">{{ $user->email }}</td>
                                                            <td>
                                                                <span class="badge {{ $user->status ? 'bg-success' : 'bg-danger' }} badge-sm">
                                                                    {{ $user->status ? 'Active' : 'Inactive' }}
                                                                </span>
                                                            </td>
                                                            <td class="small text-muted">
                                                                @if($user->last_login_at)
                                                                    {{ $user->last_login_at->diffForHumans() }}
                                                                @else
                                                                    Never
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if($user->is_online)
                                                                    <span class="status-indicator status-online"></span>
                                                                    <span class="small text-success">Online</span>
                                                                @else
                                                                    <span class="status-indicator status-offline"></span>
                                                                    <span class="small text-muted">Offline</span>
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
                                                <i class='bx bx-user-x'></i>
                                            </div>
                                            <h6 class="text-dark mb-2">No Users Assigned</h6>
                                            <p class="text-muted small">This role doesn't have any users assigned yet.</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer bg-white py-3 border-top">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="small text-muted">
                            Role ID: #{{ $role->id }} • Guard: {{ $role->guard_name }}
                        </div>
                        <div class="btn-group btn-group-sm">
                            @can('edit roles')
                                @if(!in_array($role->name, ['Super Admin', 'State Admin']) || auth()->user()->hasRole('Super Admin'))
                                    <a href="{{ route('admin.roles.edit', $role->id) }}" class="btn btn-primary">
                                        <i class='bx bx-edit me-1'></i>Edit Role
                                    </a>
                                @endif
                            @endcan
                            <a href="{{ route('admin.roles.index') }}" class="btn btn-outline-secondary">
                                <i class='bx bx-arrow-back me-1'></i>Back to List
                            </a>
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
        // Permission Search
        const permissionSearch = document.getElementById('permissionSearch');
        if (permissionSearch) {
            permissionSearch.addEventListener('input', function(e) {
                const searchTerm = e.target.value.toLowerCase().trim();
                const permissionCards = document.querySelectorAll('.permission-card');

                permissionCards.forEach(card => {
                    const permissions = card.querySelectorAll('.permission-item');
                    let visibleCount = 0;

                    permissions.forEach(item => {
                        const permissionText = item.textContent.toLowerCase();
                        if (permissionText.includes(searchTerm)) {
                            item.style.display = 'flex';
                            visibleCount++;
                        } else {
                            item.style.display = 'none';
                        }
                    });

                    // Show/hide card based on visible permissions
                    if (visibleCount > 0) {
                        card.style.display = 'block';
                        const badge = card.querySelector('.badge-sm');
                        if (badge) {
                            badge.textContent = visibleCount;
                        }
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        }

        // User Search
        const userSearch = document.getElementById('userSearch');
        if (userSearch) {
            userSearch.addEventListener('input', function(e) {
                const searchTerm = e.target.value.toLowerCase().trim();
                const userRows = document.querySelectorAll('#usersTable tbody tr');

                userRows.forEach(row => {
                    const userName = row.querySelector('td:first-child').textContent.toLowerCase();
                    const userEmail = row.querySelector('td:nth-child(2)').textContent.toLowerCase();

                    if (userName.includes(searchTerm) || userEmail.includes(searchTerm)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
        }

        // Group Filter
        document.querySelectorAll('.dropdown-item[data-filter]').forEach(item => {
            item.addEventListener('click', function(e) {
                e.preventDefault();
                const filter = this.getAttribute('data-filter');
                const permissionCards = document.querySelectorAll('.permission-card');

                permissionCards.forEach(card => {
                    const group = card.getAttribute('data-group');
                    if (filter === 'all' || filter === group) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                });

                // Update dropdown text
                const dropdownButton = this.closest('.dropdown').querySelector('.dropdown-toggle');
                if (dropdownButton) {
                    const icon = dropdownButton.querySelector('i').outerHTML;
                    dropdownButton.innerHTML = icon + (filter === 'all' ? ' All Groups' : ' ' + filter);
                }
            });
        });

        // Copy Permission Functionality
        document.querySelectorAll('.copy-permission').forEach(button => {
            button.addEventListener('click', async function() {
                const permissionName = this.getAttribute('data-permission');

                try {
                    await navigator.clipboard.writeText(permissionName);

                    // Visual feedback
                    const originalHtml = this.innerHTML;
                    this.innerHTML = '<i class="bx bx-check"></i>';
                    this.classList.remove('btn-outline-secondary');
                    this.classList.add('btn-success');

                    // Show toast notification
                    showToast(`Copied: ${permissionName}`, 'success');

                    setTimeout(() => {
                        this.innerHTML = originalHtml;
                        this.classList.remove('btn-success');
                        this.classList.add('btn-outline-secondary');
                    }, 2000);

                } catch (err) {
                    showToast('Failed to copy permission', 'error');
                }
            });
        });

        // Initialize tooltips
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        const tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });

        // Show toast notification
        function showToast(message, type = 'info') {
            // Use the existing toast-notification component
            const event = new CustomEvent('show-toast', {
                detail: { message, type }
            });
            window.dispatchEvent(event);

            // Fallback alert if toast component not loaded
            if (type === 'success') {
                alert('✓ ' + message);
            } else if (type === 'error') {
                alert('✗ ' + message);
            }
        }

        // Keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            // Ctrl/Cmd + F to focus search
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

            // Escape to clear search
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
    });
</script>
@endpush
