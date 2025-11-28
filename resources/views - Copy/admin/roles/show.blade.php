@extends('layouts.app')

@section('title', 'Role Details')
@section('page-title', 'Role Details')
@section('page-subtitle', 'View role information and permissions')

@push('css')
<style>
.permission-group {
    background: #f8fafc;
    border-radius: 8px;
    padding: 1rem;
    margin-bottom: 1rem;
    border-left: 4px solid var(--wb-primary);
}

.permission-group-header {
    display: flex;
    justify-content: between;
    align-items: center;
    margin-bottom: 0.75rem;
    padding-bottom: 0.5rem;
    border-bottom: 1px solid #e5e7eb;
}

.permission-group-title {
    font-weight: 600;
    color: var(--wb-primary);
    font-size: 1.1rem;
}

.permission-count {
    background: var(--wb-primary);
    color: white;
    padding: 0.25rem 0.75rem;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 500;
}

.permission-item {
    display: flex;
    align-items: center;
    padding: 0.5rem 0;
    border-bottom: 1px solid #f1f5f9;
}

.permission-item:last-child {
    border-bottom: none;
}

.permission-name {
    flex: 1;
    font-family: 'Monaco', 'Menlo', 'Ubuntu Mono', monospace;
    font-size: 0.9rem;
    color: #374151;
}

.permission-badge {
    background: #dbeafe;
    color: #1e40af;
    padding: 0.25rem 0.5rem;
    border-radius: 4px;
    font-size: 0.75rem;
    font-weight: 500;
}

.module-stats {
    display: flex;
    gap: 1rem;
    margin-bottom: 1.5rem;
}

.stat-card {
    background: white;
    border: 1px solid #e5e7eb;
    border-radius: 8px;
    padding: 1rem;
    text-align: center;
    flex: 1;
}

.stat-number {
    font-size: 2rem;
    font-weight: 700;
    color: var(--wb-primary);
    margin-bottom: 0.25rem;
}

.stat-label {
    color: #6b7280;
    font-size: 0.875rem;
}

.empty-state {
    text-align: center;
    padding: 3rem 2rem;
    color: #6b7280;
}

.empty-state-icon {
    font-size: 3rem;
    margin-bottom: 1rem;
    opacity: 0.5;
}
</style>
@endpush

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Role Information</h3>
                <div class="card-actions">
                    @can('edit roles')
                    <a href="{{ route('admin.roles.edit', $role->id) }}" class="btn btn-primary btn-sm">
                        <i class="ti ti-edit me-1"></i> Edit Role
                    </a>
                    @endcan
                    <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary btn-sm">
                        <i class="ti ti-arrow-left me-1"></i> Back
                    </a>
                </div>
            </div>
            <div class="card-body">
                <!-- Role Summary -->
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-bordered">
                            <tr>
                                <th width="40%">Role Name:</th>
                                <td>
                                    <span class="badge bg-primary fs-6">{{ $role->name }}</span>
                                </td>
                            </tr>
                            <tr>
                                <th>Total Users:</th>
                                <td>
                                    <span class="badge bg-secondary">{{ $role->users_count }}</span>
                                </td>
                            </tr>
                            <tr>
                                <th>Total Permissions:</th>
                                <td>
                                    <span class="badge bg-info">{{ $role->permissions_count }}</span>
                                </td>
                            </tr>
                            <tr>
                                <th>Created:</th>
                                <td>{{ $role->created_at->format('M j, Y g:i A') }}</td>
                            </tr>
                            <tr>
                                <th>Last Updated:</th>
                                <td>{{ $role->updated_at->format('M j, Y g:i A') }}</td>
                            </tr>
                        </table>
                    </div>
                </div>

                <!-- Module Statistics -->
                @if($permissionsByGroup->count() > 0)
                <div class="row mt-4">
                    <div class="col-12">
                        <h5 class="mb-3">Permission Overview</h5>
                        <div class="module-stats">
                            <div class="stat-card">
                                <div class="stat-number">{{ $permissionsByGroup->count() }}</div>
                                <div class="stat-label">Modules</div>
                            </div>
                            <div class="stat-card">
                                <div class="stat-number">{{ $role->permissions_count }}</div>
                                <div class="stat-label">Total Permissions</div>
                            </div>
                            <div class="stat-card">
                                <div class="stat-number">{{ $role->users_count }}</div>
                                <div class="stat-label">Assigned Users</div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Permissions by Group -->
                <div class="row mt-4">
                    <div class="col-12">
                        <h5 class="mb-3">Assigned Permissions by Module</h5>

                        @if($permissionsByGroup->count() > 0)
                            @foreach($permissionsByGroup as $group => $permissions)
                            <div class="permission-group">
                                <div class="permission-group-header">
                                    <div class="permission-group-title text-capitalize">
                                        <i class="ti ti-folder me-2"></i>{{ $group }} Permissions
                                    </div>
                                    <div class="permission-count">
                                        {{ $permissions->count() }} permissions
                                    </div>
                                </div>

                                <div class="permission-list">
                                    @foreach($permissions as $permission)
                                    <div class="permission-item">
                                        <div class="permission-name">
                                            {{ $permission->name }}
                                        </div>
                                        <div class="permission-badge">
                                            {{ $permission->name }}
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endforeach
                        @else
                        <div class="empty-state">
                            <div class="empty-state-icon">
                                <i class="ti ti-lock-off"></i>
                            </div>
                            <h4>No Permissions Assigned</h4>
                            <p class="text-muted">This role doesn't have any permissions assigned yet.</p>
                            @can('edit roles')
                            <a href="{{ route('admin.roles.edit', $role->id) }}" class="btn btn-primary">
                                <i class="ti ti-key me-1"></i> Assign Permissions
                            </a>
                            @endcan
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Assigned Users -->
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">
                                    <i class="ti ti-users me-2"></i>Assigned Users
                                    <span class="badge bg-secondary ms-2">{{ $role->users_count }}</span>
                                </h4>
                            </div>
                            <div class="card-body">
                                @if($role->users->count() > 0)
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>User Name</th>
                                                <th>Email</th>
                                                <th>Status</th>
                                                <th>Last Login</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($role->users as $user)
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <span class="avatar avatar-sm bg-primary me-2">
                                                            {{ substr($user->name, 0, 1) }}
                                                        </span>
                                                        {{ $user->name }}
                                                    </div>
                                                </td>
                                                <td>{{ $user->email }}</td>
                                                <td>
                                                    <span class="badge {{ $user->status ? 'bg-success' : 'bg-danger' }}">
                                                        {{ $user->status ? 'Active' : 'Inactive' }}
                                                    </span>
                                                </td>
                                                <td>
                                                    @if($user->last_login_at)
                                                        <span class="text-muted">{{ $user->last_login_at->diffForHumans() }}</span>
                                                    @else
                                                        <span class="text-muted">Never</span>
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
                                        <i class="ti ti-user-off"></i>
                                    </div>
                                    <h4>No Users Assigned</h4>
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
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add search functionality for permissions
    const searchInput = document.createElement('input');
    searchInput.type = 'text';
    searchInput.placeholder = 'Search permissions...';
    searchInput.className = 'form-control mb-3';
    searchInput.style.maxWidth = '300px';

    const permissionsSection = document.querySelector('.row.mt-4 .col-12');
    if (permissionsSection) {
        permissionsSection.insertBefore(searchInput, permissionsSection.querySelector('h5'));

        searchInput.addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            const permissionGroups = document.querySelectorAll('.permission-group');

            permissionGroups.forEach(group => {
                const permissions = group.querySelectorAll('.permission-item');
                let visibleCount = 0;

                permissions.forEach(permission => {
                    const permissionText = permission.querySelector('.permission-name').textContent.toLowerCase();
                    if (permissionText.includes(searchTerm)) {
                        permission.style.display = 'flex';
                        visibleCount++;
                    } else {
                        permission.style.display = 'none';
                    }
                });

                // Show/hide group based on visible permissions
                const groupHeader = group.querySelector('.permission-group-header');
                const permissionCount = group.querySelector('.permission-count');

                if (visibleCount > 0) {
                    group.style.display = 'block';
                    permissionCount.textContent = `${visibleCount} permissions`;
                } else {
                    group.style.display = 'none';
                }
            });
        });
    }

    // Add copy permission functionality
    document.querySelectorAll('.permission-badge').forEach(badge => {
        badge.style.cursor = 'pointer';
        badge.title = 'Click to copy permission name';

        badge.addEventListener('click', function() {
            const permissionName = this.textContent;
            navigator.clipboard.writeText(permissionName).then(() => {
                const originalText = this.textContent;
                this.textContent = 'Copied!';
                this.style.background = '#10b981';

                setTimeout(() => {
                    this.textContent = originalText;
                    this.style.background = '';
                }, 2000);
            });
        });
    });
});
</script>
@endpush
