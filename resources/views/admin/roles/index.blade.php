@extends('layouts.app')

@section('title', 'Role Management')
@section('page-title', 'Roles')
@section('page-subtitle', 'Manage user roles and permissions')

@push('css')
<style>
    .role-avatar {
        width: 32px;
        height: 32px;
        font-size: 0.75rem;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .table-sm th, .table-sm td {
        padding: 0.5rem;
        font-size: 0.875rem;
    }

    .badge-sm {
        font-size: 0.65rem;
        padding: 0.2rem 0.4rem;
    }

    .btn-xs {
        padding: 0.125rem 0.375rem;
        font-size: 0.75rem;
        line-height: 1.2;
        border-radius: 0.25rem;
    }

    .stats-card {
        padding: 0.75rem;
        border-radius: 0.375rem;
        font-size: 0.875rem;
    }

    .filter-card {
        border: 1px solid #dee2e6;
        border-radius: 0.375rem;
        padding: 0.75rem;
    }

    .permission-chip {
        display: inline-block;
        background: #f8f9fa;
        border: 1px solid #dee2e6;
        border-radius: 12px;
        padding: 0.125rem 0.375rem;
        font-size: 0.7rem;
        margin: 0.125rem;
        color: #6c757d;
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <!-- Quick Stats -->
            <div class="row mb-3">
                <div class="col-xl-3 col-md-6">
                    <div class="card stats-card bg-light">
                        <div class="card-body p-2">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <i class='bx bx-shield text-primary fs-5'></i>
                                </div>
                                <div class="flex-grow-1 ms-2">
                                    <h6 class="mb-0 fw-bold">{{ $totalRoles }}</h6>
                                    <small class="text-muted">Total Roles</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card stats-card bg-light">
                        <div class="card-body p-2">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <i class='bx bx-user-check text-success fs-5'></i>
                                </div>
                                <div class="flex-grow-1 ms-2">
                                    <h6 class="mb-0 fw-bold">{{ $rolesWithUsers }}</h6>
                                    <small class="text-muted">With Users</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card stats-card bg-light">
                        <div class="card-body p-2">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <i class='bx bx-key text-info fs-5'></i>
                                </div>
                                <div class="flex-grow-1 ms-2">
                                    <h6 class="mb-0 fw-bold">{{ $rolesWithPermissions }}</h6>
                                    <small class="text-muted">With Permissions</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card stats-card bg-light">
                        <div class="card-body p-2">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <i class='bx bx-lock text-warning fs-5'></i>
                                </div>
                                <div class="flex-grow-1 ms-2">
                                    <h6 class="mb-0 fw-bold">{{ $protectedRoles }}</h6>
                                    <small class="text-muted">Protected</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Card -->
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0 fs-6 fw-bold">
                            <i class='bx bx-list-ul me-2'></i>Role Management
                        </h5>
                        <div>
                            @can('create roles')
                            <a href="{{ route('admin.roles.create') }}" class="btn btn-primary btn-sm">
                                <i class='bx bx-plus me-1'></i>New Role
                            </a>
                            @endcan
                        </div>
                    </div>
                </div>

                <!-- Filter Card -->
                <div class="card-body border-bottom py-2">
                    <div class="filter-card">
                        <form method="GET" action="{{ route('admin.roles.index') }}" id="searchForm">
                            <div class="row g-2">
                                <div class="col-md-3">
                                    <label class="form-label small fw-bold">Search</label>
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text"><i class='bx bx-search'></i></span>
                                        <input type="text" name="search" class="form-control form-control-sm"
                                               placeholder="Role name..." value="{{ request('search') }}">
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <label class="form-label small fw-bold">Users</label>
                                    <select name="users_count" class="form-select form-select-sm">
                                        <option value="all">All Users</option>
                                        <option value="0" {{ request('users_count') == '0' ? 'selected' : '' }}>No Users</option>
                                        <option value="1-10" {{ request('users_count') == '1-10' ? 'selected' : '' }}>1-10 Users</option>
                                        <option value="10+" {{ request('users_count') == '10+' ? 'selected' : '' }}>10+ Users</option>
                                    </select>
                                </div>

                                <div class="col-md-2">
                                    <label class="form-label small fw-bold">Permissions</label>
                                    <select name="permissions_count" class="form-select form-select-sm">
                                        <option value="all">All Permissions</option>
                                        <option value="0" {{ request('permissions_count') == '0' ? 'selected' : '' }}>No Permissions</option>
                                        <option value="1-10" {{ request('permissions_count') == '1-10' ? 'selected' : '' }}>1-10 Permissions</option>
                                        <option value="10+" {{ request('permissions_count') == '10+' ? 'selected' : '' }}>10+ Permissions</option>
                                    </select>
                                </div>

                                @if(!empty($stakeholderTypes))
                                <div class="col-md-2">
                                    <label class="form-label small fw-bold">Stakeholder</label>
                                    <select name="stakeholder" class="form-select form-select-sm">
                                        <option value="">All Stakeholders</option>
                                        @foreach($stakeholderTypes as $type)
                                        <option value="{{ $type }}" {{ request('stakeholder') == $type ? 'selected' : '' }}>
                                            {{ $type }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                @endif

                                <div class="col-md-3 d-flex align-items-end">
                                    <div class="btn-group btn-group-sm" role="group">
                                        <button type="submit" class="btn btn-primary">
                                            <i class='bx bx-filter me-1'></i>Filter
                                        </button>
                                        <a href="{{ route('admin.roles.index') }}" class="btn btn-outline-secondary">
                                            <i class='bx bx-reset me-1'></i>Clear
                                        </a>
                                    </div>

                                    @if(request()->hasAny(['search', 'users_count', 'permissions_count', 'stakeholder']))
                                    <span class="badge bg-info ms-2 align-self-center">
                                        {{ $roles->total() }} found
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Table -->
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-sm table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th width="40" class="ps-3">#</th>
                                    <th width="60" class="text-center">Role</th>
                                    <th width="80" class="text-center">Users</th>
                                    <th width="120" class="text-center">Permissions</th>
                                    <th width="120" class="text-center">Created</th>
                                    <th width="100" class="text-end pe-3">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($roles as $role)
                                <tr class="{{ $role->name === 'Super Admin' ? 'table-warning' : '' }}">
                                    <td class="ps-3">
                                        <small class="text-muted">#{{ $role->id }}</small>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="role-avatar rounded-circle me-2
                                                {{ $role->name === 'Super Admin' ? 'bg-warning text-dark' :
                                                   ($role->name === 'Admin' ? 'bg-primary text-white' : 'bg-secondary text-white') }}">
                                                {{ substr($role->name, 0, 2) }}
                                            </div>
                                            <div>
                                                <div class="fw-semibold small">{{ $role->name }}</div>
                                                @if($role->description)
                                                <small class="text-muted">{{ Str::limit($role->description, 40) }}</small>
                                                @endif
                                                @if(in_array($role->name, ['Super Admin', 'State Admin']))
                                                <div>
                                                    <span class="badge badge-sm bg-warning">
                                                        <i class='bx bx-shield-quarter me-1'></i>Protected
                                                    </span>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge
                                            {{ $role->users_count > 0 ? 'bg-success' : 'bg-light text-dark' }}">
                                            {{ $role->users_count }}
                                        </span>
                                    </td>
                                    <td>
                                        @if($role->permissions_count > 0)
                                        <div class="d-flex flex-wrap gap-1">
                                            @foreach($role->permissions->take(2) as $permission)
                                            <span class="permission-chip">
                                                {{ Str::limit($permission->name, 12) }}
                                            </span>
                                            @endforeach
                                            @if($role->permissions_count > 2)
                                            <span class="permission-chip">
                                                +{{ $role->permissions_count - 2 }}
                                            </span>
                                            @endif
                                        </div>
                                        @else
                                        <span class="badge bg-light text-muted">None</span>
                                        @endif
                                    </td>
                                    <td>
                                        <small class="text-muted">
                                            {{ $role->created_at->format('M d, Y') }}
                                        </small>
                                    </td>
                                    <td class="text-end pe-3">
                                        <div class="btn-group btn-group-sm" role="group">
                                            @can('view roles')
                                            <a href="{{ route('admin.roles.show', $role->id) }}"
                                               class="btn btn-outline-info"
                                               title="View">
                                                <i class='bx bx-show'></i>
                                            </a>
                                            @endcan

                                            @can('edit roles')
                                            <a href="{{ route('admin.roles.edit', $role->id) }}"
                                               class="btn btn-outline-primary {{ in_array($role->name, ['Super Admin', 'State Admin']) && !auth()->user()->hasRole('Super Admin') ? 'disabled' : '' }}"
                                               title="Edit">
                                                <i class='bx bx-edit'></i>
                                            </a>
                                            @endcan

                                            @can('delete roles')
                                            @if(!in_array($role->name, ['Super Admin', 'State Admin']))
                                            <button type="button"
                                                    class="btn btn-outline-danger"
                                                    title="Delete"
                                                    onclick="confirmDelete('{{ $role->id }}', '{{ $role->name }}')">
                                                <i class='bx bx-trash'></i>
                                            </button>
                                            <form id="delete-form-{{ $role->id }}"
                                                  action="{{ route('admin.roles.destroy', $role->id) }}"
                                                  method="POST" style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                            @endif
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4">
                                        <div class="py-4">
                                            <i class='bx bx-shield fs-1 text-muted mb-3'></i>
                                            <h6 class="text-muted mb-2">No roles found</h6>
                                            <p class="small text-muted mb-3">
                                                {{ request()->hasAny(['search', 'users_count', 'permissions_count', 'stakeholder'])
                                                   ? 'Try adjusting your filters'
                                                   : 'Create your first role' }}
                                            </p>
                                            @can('create roles')
                                            <a href="{{ route('admin.roles.create') }}" class="btn btn-primary btn-sm">
                                                <i class='bx bx-plus me-1'></i>Create Role
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
                    @if($roles->hasPages())
                    <div class="card-footer bg-white py-2">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="small text-muted">
                                Showing {{ $roles->firstItem() }} to {{ $roles->lastItem() }} of {{ $roles->total() }}
                            </div>
                            <div>
                                {{ $roles->onEachSide(1)->links('pagination::bootstrap-5') }}
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Auto-submit form on filter change
        const filters = document.querySelectorAll('select[name="users_count"], select[name="permissions_count"], select[name="stakeholder"]');
        filters.forEach(filter => {
            filter.addEventListener('change', function() {
                document.getElementById('searchForm').submit();
            });
        });

        // Initialize tooltips
        const tooltips = document.querySelectorAll('[title]');
        tooltips.forEach(el => {
            new bootstrap.Tooltip(el);
        });
    });

    function confirmDelete(id, name) {
        if (confirm(`Are you sure you want to delete "${name}" role?`)) {
            document.getElementById(`delete-form-${id}`).submit();
        }
    }
</script>
@endpush
