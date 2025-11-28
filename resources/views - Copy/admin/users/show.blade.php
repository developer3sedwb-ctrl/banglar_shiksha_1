@extends('layouts.app')

@section('title', 'User Details')
@section('page-title', 'User Details')
@section('page-subtitle', 'View user information and permissions')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">User Information</h3>
                <div class="card-actions">
                    @can('edit users')
                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-primary btn-sm">
                        <i class="ti ti-edit me-1"></i> Edit User
                    </a>
                    @endcan
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-bordered">
                            <tr>
                                <th width="40%">Name:</th>
                                <td>{{ $user->name }}</td>
                            </tr>
                            <tr>
                                <th>Email:</th>
                                <td>{{ $user->email }}</td>
                            </tr>
                            <tr>
                                <th>Phone:</th>
                                <td>{{ $user->phone ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Department:</th>
                                <td>{{ $user->department ?? 'N/A' }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-bordered">
                            <tr>
                                <th width="40%">Designation:</th>
                                <td>{{ $user->designation ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Status:</th>
                                <td>
                                    <span class="badge {{ $user->status ? 'bg-success' : 'bg-danger' }}">
                                        {{ $user->status ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <th>Last Login:</th>
                                <td>{{ $user->last_login_at ? $user->last_login_at->format('M j, Y g:i A') : 'Never' }}</td>
                            </tr>
                            <tr>
                                <th>Registered:</th>
                                <td>{{ $user->created_at->format('M j, Y g:i A') }}</td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-12">
                        <h5>Roles & Permissions</h5>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Role</th>
                                        <th>Permissions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($user->roles as $role)
                                    <tr>
                                        <td width="20%">
                                            <span class="badge bg-primary">{{ $role->name }}</span>
                                        </td>
                                        <td>
                                            @foreach($role->permissions as $permission)
                                            <span class="badge bg-info me-1 mb-1">{{ $permission->name }}</span>
                                            @endforeach
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
    </div>
</div>
@endsection
