@extends('layouts.app')

@section('title', 'Role Management')
@section('page-title', 'Role Management')
@section('page-subtitle', 'Manage system roles and permissions')

@push('css')
    <style>
        .role-badge {
            padding: 0.5rem 1rem;
            border-radius: 6px;
            font-weight: 600;
            font-size: 0.875rem;
        }

        .action-buttons {
            display: flex;
            gap: 0.25rem;
            flex-wrap: nowrap;
        }

        .action-btn {
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 6px;
            transition: all 0.2s;
        }

        .action-btn:hover {
            transform: translateY(-1px);
        }

        .empty-state {
            padding: 2rem;
            text-align: center;
        }

        .empty-state i {
            font-size: 3rem;
            opacity: 0.5;
            margin-bottom: 1rem;
        }

        .permission-count {
            font-size: 0.75rem;
            color: #6c757d;
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title mb-0">Roles List</h3>
                        <div class="card-actions">
                            @can('create roles')
                                <a href="{{ route('admin.roles.create') }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-plus me-1"></i> Create New Role
                                </a>
                            @endcan
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Success/Error Messages -->
                        @session('success')
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fas fa-check me-2"></i>
                                {{ $value }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endsession

                        @session('error')
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="fas fa-exclamation-circle me-2"></i>
                                {{ $value }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endsession

                        <!-- Advanced Search Section -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="card-title mb-0">
                                    <i class="fas fa-search me-2"></i>Advanced Search
                                </h5>
                            </div>
                            <div class="card-body">
                                <form method="GET" action="{{ route('admin.roles.index') }}" id="searchForm">
                                    <div class="row g-3">
                                        <!-- Global Search -->
                                        <div class="col-md-6">
                                            <label class="form-label">Global Search</label>
                                            <input type="text" name="search" class="form-control"
                                                placeholder="Search role names, permissions..."
                                                value="{{ request('search') }}">
                                        </div>

                                        <!-- Users Count Filter -->
                                        <div class="col-md-3">
                                            <label class="form-label">Users Count</label>
                                            <select name="users_count" class="form-select">
                                                <option value="all">All</option>
                                                <option value="0" {{ request('users_count') == '0' ? 'selected' : '' }}>No Users</option>
                                                <option value="1-10" {{ request('users_count') == '1-10' ? 'selected' : '' }}>1-10 Users</option>
                                                <option value="10+" {{ request('users_count') == '10+' ? 'selected' : '' }}>10+ Users</option>
                                            </select>
                                        </div>

                                        <!-- Permissions Count Filter -->
                                        <div class="col-md-3">
                                            <label class="form-label">Permissions Count</label>
                                            <select name="permissions_count" class="form-select">
                                                <option value="all">All</option>
                                                <option value="0" {{ request('permissions_count') == '0' ? 'selected' : '' }}>No Permissions</option>
                                                <option value="1-10" {{ request('permissions_count') == '1-10' ? 'selected' : '' }}>1-10 Permissions</option>
                                                <option value="10+" {{ request('permissions_count') == '10+' ? 'selected' : '' }}>10+ Permissions</option>
                                            </select>
                                        </div>

                                        <!-- Action Buttons -->
                                        <div class="col-md-12 d-flex align-items-end gap-2">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fas fa-search me-1"></i> Search
                                            </button>
                                            <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary">
                                                <i class="fas fa-redo me-1"></i> Reset
                                            </a>

                                            @if (request()->hasAny(['search', 'users_count', 'permissions_count']))
                                                <span class="badge bg-info align-self-center ms-2">
                                                    <i class="fas fa-filter me-1"></i>
                                                    {{ $roles->total() }} results found
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Quick Stats Section -->
                        <div class="bulk-action-section">
                            <div class="row">
                                <div class="col-md-12">
                                    <label class="form-label small text-muted mb-1">Quick Stats</label>
                                    <div class="d-flex gap-4 text-center">
                                        <div>
                                            <div class="h5 mb-0 text-primary">{{ $roles->total() }}</div>
                                            <small class="text-muted">Total Roles</small>
                                        </div>
                                        <div>
                                            <div class="h5 mb-0 text-success">{{ $rolesWithUsers ?? 0 }}</div>
                                            <small class="text-muted">Roles with Users</small>
                                        </div>
                                        <div>
                                            <div class="h5 mb-0 text-info">{{ $rolesWithPermissions ?? 0 }}</div>
                                            <small class="text-muted">Roles with Permissions</small>
                                        </div>
                                        <div>
                                            <div class="h5 mb-0 text-warning">{{ $protectedRoles ?? 0 }}</div>
                                            <small class="text-muted">Protected Roles</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Roles Table -->
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th width="60px">ID</th>
                                        <th>Role Information</th>
                                        <th>Users</th>
                                        <th>Permissions</th>
                                        <th>Created At</th>
                                        <th width="150px">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($roles as $role)
                                        <tr class="{{ $role->name === 'Super Admin' ? 'table-warning' : '' }}">
                                            <td>
                                                <span class="text-muted">#{{ $role->id }}</span>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="role-badge me-3
                                                        {{ $role->name === 'Super Admin' ? 'bg-warning text-dark' :
                                                           ($role->name === 'Admin' ? 'bg-primary' : 'bg-secondary') }}">
                                                        {{ substr($role->name, 0, 2) }}
                                                    </div>
                                                    <div>
                                                        <div class="fw-bold">{{ $role->name }}</div>
                                                        @if($role->description)
                                                            <div class="text-muted small">{{ $role->description }}</div>
                                                        @endif
                                                        @if(in_array($role->name, ['Super Admin', 'State Admin']))
                                                            <small class="text-warning">
                                                                <i class="fas fa-shield-alt me-1"></i>Protected Role
                                                            </small>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="text-center">
                                                    <div class="h5 mb-0 {{ $role->users_count > 0 ? 'text-success' : 'text-muted' }}">
                                                        {{ $role->users_count }}
                                                    </div>
                                                    <small class="text-muted">users</small>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="text-center">
                                                    <div class="h5 mb-0 {{ $role->permissions_count > 0 ? 'text-info' : 'text-muted' }}">
                                                        {{ $role->permissions_count }}
                                                    </div>
                                                    <small class="text-muted">permissions</small>
                                                </div>
                                                @if($role->permissions_count > 0)
                                                    <div class="permission-count mt-1">
                                                        @foreach($role->permissions->take(3) as $permission)
                                                            <span class="badge bg-light text-dark small me-1">
                                                                {{ $permission->name }}
                                                            </span>
                                                        @endforeach
                                                        @if($role->permissions_count > 3)
                                                            <small class="text-muted">+{{ $role->permissions_count - 3 }} more</small>
                                                        @endif
                                                    </div>
                                                @endif
                                            </td>
                                            <td>
                                                <span class="text-muted small" title="{{ $role->created_at->format('M j, Y g:i A') }}">
                                                    {{ $role->created_at->diffForHumans() }}
                                                </span>
                                            </td>
                                            <td>
                                                <div class="action-buttons">
                                                    @can('view roles')
                                                        <a href="{{ route('admin.roles.show', $role->id) }}"
                                                            class="btn btn-info btn-sm action-btn" title="View Details">
                                                            <i class="menu-icon tf-icons bx bx-eye"></i>
                                                        </a>
                                                    @endcan

                                                    @can('edit roles')
                                                        <a href="{{ route('admin.roles.edit', $role->id) }}"
                                                            class="btn btn-primary btn-sm action-btn" title="Edit Role"
                                                            {{ in_array($role->name, ['Super Admin', 'State Admin']) && !auth()->user()->hasRole('Super Admin') ? 'disabled' : '' }}>
                                                            <i class="menu-icon tf-icons bx bx-edit"></i>
                                                        </a>
                                                    @endcan

                                                    @can('delete roles')
                                                        @if(!in_array($role->name, ['Super Admin', 'State Admin']))
                                                            <form method="POST"
                                                                action="{{ route('admin.roles.destroy', $role->id) }}"
                                                                class="d-inline"
                                                                onsubmit="return confirm('Are you sure you want to delete {{ $role->name }} role?')">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="btn btn-danger btn-sm action-btn"
                                                                    title="Delete Role">
                                                                    <i class="menu-icon tf-icons bx bx-trash"></i>
                                                                </button>
                                                            </form>
                                                        @endif
                                                    @endcan
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center py-4">
                                                <div class="empty-state">
                                                    <i class="fas fa-shield-alt"></i>
                                                    <h4 class="mt-3">No Roles Found</h4>
                                                    <p class="text-muted">No roles match your search criteria.</p>
                                                    @can('create roles')
                                                        <a href="{{ route('admin.roles.create') }}" class="btn btn-primary">
                                                            <i class="fas fa-plus me-1"></i> Create First Role
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
                        @if ($roles->hasPages())
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <div class="text-muted small">
                                    Showing {{ $roles->firstItem() }} to {{ $roles->lastItem() }} of
                                    {{ $roles->total() }} entries
                                </div>
                                <div>
                                    {{ $roles->links('pagination::bootstrap-5') }}
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
            // Advanced Search Form Handling
            const searchForm = document.getElementById('searchForm');
            if (searchForm) {
                // Auto-submit form when filters change
                const autoSubmitFields = searchForm.querySelectorAll('select[name="users_count"], select[name="permissions_count"]');
                autoSubmitFields.forEach(field => {
                    field.addEventListener('change', function() {
                        searchForm.submit();
                    });
                });
            }

            // Clear all filters
            const clearFiltersBtn = document.querySelector('a[href="{{ route('admin.roles.index') }}"]');
            if (clearFiltersBtn) {
                clearFiltersBtn.addEventListener('click', function(e) {
                    if (window.location.search) {
                        e.preventDefault();
                        window.location.href = "{{ route('admin.roles.index') }}";
                    }
                });
            }

            // Pagination preservation
            function preservePagination() {
                const paginationLinks = document.querySelectorAll('.pagination a');
                paginationLinks.forEach(link => {
                    const url = new URL(link.href);
                    const currentUrl = new URL(window.location.href);

                    // Preserve all search parameters
                    currentUrl.searchParams.forEach((value, key) => {
                        if (key !== 'page') {
                            url.searchParams.set(key, value);
                        }
                    });

                    link.href = url.toString();
                });
            }

            preservePagination();

            // Initialize tooltips
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[title]'));
            const tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });
    </script>
@endpush
