@extends('layouts.app')

@section('title', 'Permission Management')
@section('page-title', 'Permission Management')
@section('page-subtitle', 'Manage system permissions and access controls')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Permissions List</h3>
                <div class="card-actions">
                    @can('create permissions')
                    <a href="{{ route('admin.permissions.create') }}" class="btn btn-primary btn-sm">
                        <i class="ti ti-plus me-1"></i> Create New Permission
                    </a>
                    @endcan
                </div>
            </div>
            <div class="card-body">
                @session('success')
                    <div class="alert alert-success" role="alert">
                        {{ $value }}
                    </div>
                @endsession

                @session('error')
                    <div class="alert alert-danger" role="alert">
                        {{ $value }}
                    </div>
                @endsession

                <!-- Search Form -->
                <form method="GET" action="{{ route('admin.permissions.index') }}" class="mb-4">
                    <div class="row g-2">
                        <div class="col-md-6">
                            <input type="text" name="search" class="form-control"
                                placeholder="Search permissions..." value="{{ $search }}">
                        </div>
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-secondary w-100">
                                <i class="ti ti-search me-1"></i> Search
                            </button>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('admin.permissions.index') }}" class="btn btn-outline-secondary w-100">
                                <i class="ti ti-refresh me-1"></i> Reset
                            </a>
                        </div>
                    </div>
                </form>

                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th width="60px">#</th>
                                <th>Permission Name</th>
                                <th>Roles</th>
                                <th>Created</th>
                                <th width="150px">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($permissions as $key => $permission)
                            <tr>
                                <td>{{ ++$key + ($permissions->currentPage() - 1) * $permissions->perPage() }}</td>
                                <td>
                                    <code class="text-primary">{{ $permission->name }}</code>
                                </td>
                                <td>
                                    <span class="badge bg-secondary">{{ $permission->roles_count }}</span> roles
                                </td>
                                <td>
                                    <small class="text-muted">{{ $permission->created_at->format('M j, Y') }}</small>
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        @can('view permissions')
                                        <a class="btn btn-info btn-sm" href="{{ route('admin.permissions.show', $permission->id) }}">
                                            <i class="ti ti-eye"></i>
                                        </a>
                                        @endcan
                                        @can('edit permissions')
                                        <a class="btn btn-primary btn-sm" href="{{ route('admin.permissions.edit', $permission->id) }}">
                                            <i class="ti ti-edit"></i>
                                        </a>
                                        @endcan
                                        @can('delete permissions')
                                        <form method="POST" action="{{ route('admin.permissions.destroy', $permission->id) }}" style="display:inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Are you sure you want to delete this permission?')"
                                                {{ $permission->roles_count > 0 ? 'disabled' : '' }}>
                                                <i class="ti ti-trash"></i>
                                            </button>
                                        </form>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-4">
                                    <div class="empty">
                                        <div class="empty-icon">
                                            <i class="ti ti-shield-off" style="font-size: 2rem;"></i>
                                        </div>
                                        <p class="empty-title">No permissions found</p>
                                        <p class="empty-subtitle text-muted">
                                            @can('create permissions')
                                            Get started by creating a new permission.
                                            @else
                                            No permissions match your search criteria.
                                            @endcan
                                        </p>
                                        @can('create permissions')
                                        <div class="empty-action">
                                            <a href="{{ route('admin.permissions.create') }}" class="btn btn-primary">
                                                <i class="ti ti-plus me-1"></i> Create Permission
                                            </a>
                                        </div>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-center mt-3">
                    {{ $permissions->appends(request()->query())->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
