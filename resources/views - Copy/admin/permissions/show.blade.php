@extends('layouts.app')

@section('title', 'Permission Details')
@section('page-title', 'Permission Details')
@section('page-subtitle', 'View permission information and role assignments')

@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Permission Information</h3>
                <div class="card-actions">
                    @can('edit permissions')
                    <a href="{{ route('admin.permissions.edit', $permission->id) }}" class="btn btn-primary btn-sm">
                        <i class="ti ti-edit me-1"></i> Edit Permission
                    </a>
                    @endcan
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th width="40%">Name:</th>
                        <td><code class="text-primary">{{ $permission->name }}</code></td>
                    </tr>
                    <tr>
                        <th>Assigned to Roles:</th>
                        <td><span class="badge bg-secondary">{{ $permission->roles_count }}</span> roles</td>
                    </tr>
                    <tr>
                        <th>Created:</th>
                        <td>{{ $permission->created_at->format('M j, Y g:i A') }}</td>
                    </tr>
                    <tr>
                        <th>Last Updated:</th>
                        <td>{{ $permission->updated_at->format('M j, Y g:i A') }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Assigned Roles</h3>
            </div>
            <div class="card-body">
                @if($permission->roles->count() > 0)
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Role Name</th>
                                <th>Permissions Count</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($permission->roles as $role)
                            <tr>
                                <td>
                                    <span class="badge bg-primary">{{ $role->name }}</span>
                                </td>
                                <td>
                                    <span class="badge bg-secondary">{{ $role->permissions_count }}</span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="empty">
                    <div class="empty-icon">
                        <i class="ti ti-users-off" style="font-size: 2rem;"></i>
                    </div>
                    <p class="empty-title">No roles assigned</p>
                    <p class="empty-subtitle text-muted">
                        This permission is not assigned to any roles.
                    </p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">All System Roles</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Role Name</th>
                                <th>Total Permissions</th>
                                <th>Has This Permission</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($roles as $role)
                            <tr>
                                <td>
                                    <span class="badge bg-primary">{{ $role->name }}</span>
                                </td>
                                <td>
                                    <span class="badge bg-secondary">{{ $role->permissions_count }}</span>
                                </td>
                                <td>
                                    @if($role->hasPermissionTo($permission->name))
                                    <span class="badge bg-success">Yes</span>
                                    @else
                                    <span class="badge bg-danger">No</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.roles.edit', $role->id) }}" class="btn btn-primary btn-sm">
                                        <i class="ti ti-edit"></i> Manage Role
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
