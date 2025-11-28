<!-- resources/views/admin/users/edit.blade.php -->
@extends('layouts.app')

@section('title', 'Edit User - ' . config('app.name'))

@section('page-title', 'Edit User')
@section('page-subtitle', 'Update user information and roles')

@section('page-actions')
    <a href="{{ route('admin.users.index') }}" class="btn btn-outline-primary">
        <i class="ti ti-arrow-left me-2"></i>
        Back to Users
    </a>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <!-- Error Message -->
        @if (count($errors) > 0)
            <div class="alert alert-danger alert-dismissible" role="alert">
                <div class="d-flex">
                    <div>
                        <i class="ti ti-alert-triangle me-2"></i>
                    </div>
                    <div>
                        <h4 class="alert-title">Validation Error</h4>
                        <div class="text-muted">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
            </div>
        @endif

        <!-- User Profile Card -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="ti ti-user-edit me-2"></i>
                    Edit User Profile
                </h3>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.users.update', $user->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label required">Full Name</label>
                                <input type="text" name="name" class="form-control" placeholder="Enter full name"
                                       value="{{ old('name', $user->name) }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label required">Email Address</label>
                                <input type="email" name="email" class="form-control" placeholder="Enter email address"
                                       value="{{ old('email', $user->email) }}" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">New Password</label>
                                <input type="password" name="password" class="form-control" placeholder="Leave blank to keep current password">
                                <div class="form-hint">Only enter if you want to change the password</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Confirm New Password</label>
                                <input type="password" name="confirm-password" class="form-control" placeholder="Confirm new password">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label required">System Roles</label>
                                <select name="roles[]" class="form-select" multiple="multiple" required>
                                    @foreach ($roles as $value => $label)
                                        <option value="{{ $value }}" {{ in_array($value, $userRole) ? 'selected' : '' }}>
                                            {{ $label }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-check">
                                    <input class="form-check-input" type="checkbox" name="is_active" {{ $user->status ? 'checked' : '' }}>
                                    <span class="form-check-label">User account is active</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer bg-transparent mt-4">
                        <div class="btn-list justify-content-end">
                            <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary">
                                <i class="ti ti-x me-2"></i>
                                Cancel
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="ti ti-device-floppy me-2"></i>
                                Update User
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- User Information Card -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="ti ti-info-circle me-2"></i>
                    User Information
                </h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">User ID</label>
                            <input type="text" class="form-control" value="{{ $user->id }}" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Registration Date</label>
                            <input type="text" class="form-control" value="{{ $user->created_at->format('M j, Y g:i A') }}" readonly>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Last Login</label>
                            <input type="text" class="form-control"
                                   value="{{ $user->last_login_at ? $user->last_login_at->format('M j, Y g:i A') : 'Never' }}" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Last Updated</label>
                            <input type="text" class="form-control" value="{{ $user->updated_at->format('M j, Y g:i A') }}" readonly>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
