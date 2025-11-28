@extends('layouts.app')

@section('title', isset($user) ? 'Edit User' : 'Create User')
@section('page-title', isset($user) ? 'Edit User' : 'Create New User')
@section('page-subtitle', isset($user) ? 'Update user information' : 'Add a new user to the system')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">User Information</h3>
            </div>
            <form method="POST" action="{{ isset($user) ? route('admin.users.update', $user->id) : route('admin.users.store') }}">
                @csrf
                @if(isset($user))
                    @method('PUT')
                @endif

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name" class="form-label">Full Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" name="name" value="{{ old('name', $user->name ?? '') }}"
                                    placeholder="Enter full name" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email Address <span class="text-danger">*</span></label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    id="email" name="email" value="{{ old('email', $user->email ?? '') }}"
                                    placeholder="Enter email address" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone Number</label>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                    id="phone" name="phone" value="{{ old('phone', $user->phone ?? '') }}"
                                    placeholder="Enter phone number">
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="department" class="form-label">Department</label>
                                <input type="text" class="form-control @error('department') is-invalid @enderror"
                                    id="department" name="department" value="{{ old('department', $user->department ?? '') }}"
                                    placeholder="Enter department">
                                @error('department')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="designation" class="form-label">Designation</label>
                                <input type="text" class="form-control @error('designation') is-invalid @enderror"
                                    id="designation" name="designation" value="{{ old('designation', $user->designation ?? '') }}"
                                    placeholder="Enter designation">
                                @error('designation')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="password" class="form-label">
                                    {{ isset($user) ? 'New Password' : 'Password' }}
                                    @if(!isset($user))<span class="text-danger">*</span>@endif
                                </label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    id="password" name="password"
                                    placeholder="{{ isset($user) ? 'Leave blank to keep current password' : 'Enter password' }}"
                                    {{ !isset($user) ? 'required' : '' }}>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    @if(isset($user))
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="confirm-password" class="form-label">Confirm Password</label>
                                <input type="password" class="form-control"
                                    id="confirm-password" name="confirm-password"
                                    placeholder="Confirm new password">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <div class="form-check form-switch mt-4">
                                    <input class="form-check-input" type="checkbox" id="status" name="status"
                                        {{ old('status', $user->status ?? true) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="status">Active User</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="confirm-password" class="form-label">Confirm Password <span class="text-danger">*</span></label>
                                <input type="password" class="form-control @error('confirm-password') is-invalid @enderror"
                                    id="confirm-password" name="confirm-password"
                                    placeholder="Confirm password" required>
                                @error('confirm-password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    @endif

                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="roles" class="form-label">Roles <span class="text-danger">*</span></label>
                                @error('roles')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <div class="row">
                                    @foreach($roles as $roleName => $roleDisplay)
                                    <div class="col-md-3 mb-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox"
                                                name="roles[]" value="{{ $roleName }}"
                                                id="role_{{ $roleName }}"
                                                {{ (isset($userRole) && in_array($roleName, array_keys($userRole))) ? 'checked' : '' }}
                                                {{ $roleName == 'Super Admin' && !auth()->user()->hasRole('Super Admin') ? 'disabled' : '' }}>
                                            <label class="form-check-label" for="role_{{ $roleName }}">
                                                {{ $roleName }}
                                            </label>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-end">
                    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary">
                        {{ isset($user) ? 'Update User' : 'Create User' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
