@extends('layouts.app')

@section('title', 'Role Management')
@section('page-title', 'Role Management')
@section('page-subtitle', 'Manage system roles and permissions')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Roles List</h3>
                <div class="card-actions">
                    @can('create roles')
                    <a href="{{ route('admin.roles.create') }}" class="btn btn-primary btn-sm">
                        <i class="ti ti-plus me-1"></i> Create New Role
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

                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th width="60px">#</th>
                                <th>Role Name</th>
                                <th>Users</th>
                                <th>Permissions</th>
                                <th width="200px">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $key => $role)
                            <tr>
                                <td>{{ ++$key + ($roles->currentPage() - 1) * $roles->perPage() }}</td>
                                <td>
                                    <span class="badge bg-primary">{{ $role->name }}</span>
                                </td>
                                <td>
                                    <span class="badge bg-secondary">{{ $role->users_count }}</span>
                                </td>
                                <td>
                                    <span class="badge bg-info">{{ $role->permissions_count }}</span>
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        @can('view roles')
                                        <a class="btn btn-info btn-sm" href="{{ route('admin.roles.show', $role->id) }}" title="View">
                                            <i class="ti ti-eye"></i>
                                        </a>
                                        @endcan
                                        @can('edit roles')
                                        <a class="btn btn-primary btn-sm" href="{{ route('admin.roles.edit', $role->id) }}" title="Edit">
                                            <i class="ti ti-edit"></i>
                                        </a>
                                        @endcan
                                        @can('delete roles')
                                        @if(!in_array($role->name, ['Super Admin', 'State Admin']))
                                        <form method="POST" action="{{ route('admin.roles.destroy', $role->id) }}" style="display:inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Are you sure you want to delete this role?')"
                                                title="Delete">
                                                <i class="ti ti-trash"></i>
                                            </button>
                                        </form>
                                        @endif
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-center mt-3">
                    {{ $roles->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
