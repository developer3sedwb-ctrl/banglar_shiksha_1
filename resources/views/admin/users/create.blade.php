@extends('layouts.app')

@section('title', isset($user) ? 'Edit User' : 'Create User')
@section('page-title', isset($user) ? 'Edit User' : 'Create New User')
@section('page-subtitle', isset($user) ? 'Update user information' : 'Add a new user to the system')

@section('content')
<div class="container-fluid">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard') }}">
                    <i class="bx bx-home-alt"></i> Dashboard
                </a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('admin.users.index') }}">
                    <i class="bx bx-user"></i> User Management
                </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                <i class="bx {{ isset($user) ? 'bx-edit' : 'bx-user-plus' }}"></i>
                {{ isset($user) ? 'Edit User' : 'Create User' }}
            </li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title mb-0">
                        <i class="bx {{ isset($user) ? 'bx-user-edit' : 'bx-user-plus' }} me-2"></i>
                        {{ isset($user) ? 'Edit User Information' : 'Create New User' }}
                    </h3>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary btn-sm">
                        <i class="bx bx-arrow-back me-1"></i>
                        Back to Users
                    </a>
                </div>

                <form method="POST" action="{{ isset($user) ? route('admin.users.update', $user->id) : route('admin.users.store') }}" id="userForm">
                    @csrf
                    @if(isset($user))
                        @method('PUT')
                    @endif

                    <div class="card-body">
                        <!-- Flash Messages -->
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="bx bx-check-circle me-2"></i>
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="bx bx-error-circle me-2"></i>
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        @if(session('warning'))
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <i class="bx bx-error-alt me-2"></i>
                                {{ session('warning') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        @if($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="bx bx-error-circle me-2"></i>
                                <strong>Please fix the following errors:</strong>
                                <ul class="mb-0 mt-1">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name" class="form-label">
                                        <i class="bx bx-user me-1"></i>
                                        Full Name <span class="text-danger">*</span>
                                    </label>
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
                                    <label for="email" class="form-label">
                                        <i class="bx bx-envelope me-1"></i>
                                        Email Address <span class="text-danger">*</span>
                                    </label>
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
                                    <label for="phone" class="form-label">
                                        <i class="bx bx-phone me-1"></i>
                                        Phone Number
                                    </label>
                                    <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                        id="phone" name="phone" value="{{ old('phone', $user->phone ?? '') }}"
                                        placeholder="Enter phone number" maxlength="15">
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="dise_code" class="form-label">
                                        <i class="bx bx-id-card me-1"></i>
                                        DISE Code
                                    </label>
                                    <input type="text" class="form-control @error('dise_code') is-invalid @enderror"
                                        id="dise_code" name="dise_code" value="{{ old('dise_code', $user->dise_code ?? '') }}"
                                        placeholder="Enter 11-digit DISE code" maxlength="11" pattern="[0-9]{11}">
                                    @error('dise_code')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">
                                        <i class="bx bx-info-circle me-1"></i>
                                        11-digit DISE code starting with 192
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="department" class="form-label">
                                        <i class="bx bx-building me-1"></i>
                                        Department
                                    </label>
                                    <input type="text" class="form-control @error('department') is-invalid @enderror"
                                        id="department" name="department" value="{{ old('department', $user->department ?? '') }}"
                                        placeholder="Enter department">
                                    @error('department')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="designation" class="form-label">
                                        <i class="bx bx-briefcase me-1"></i>
                                        Designation
                                    </label>
                                    <input type="text" class="form-control @error('designation') is-invalid @enderror"
                                        id="designation" name="designation" value="{{ old('designation', $user->designation ?? '') }}"
                                        placeholder="Enter designation">
                                    @error('designation')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Password Section -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card border-0 bg-light mb-4">
                                    <div class="card-header bg-transparent border-bottom">
                                        <h6 class="mb-0">
                                            <i class="bx bx-lock me-2"></i>
                                            Password Settings
                                        </h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="password" class="form-label">
                                                        {{ isset($user) ? 'New Password' : 'Password' }}
                                                        @if(!isset($user))<span class="text-danger">*</span>@endif
                                                    </label>
                                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                                        id="password" name="password"
                                                        placeholder="{{ isset($user) ? 'Leave blank to keep current password' : 'Enter strong password' }}"
                                                        {{ !isset($user) ? 'required' : '' }}
                                                        minlength="8">
                                                    @error('password')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror

                                                    <!-- Password Strength Meter -->
                                                    <div class="password-strength mt-2">
                                                        <div class="progress" style="height: 5px;">
                                                            <div class="progress-bar" id="password-strength-bar" role="progressbar" style="width: 0%"></div>
                                                        </div>
                                                        <small class="form-text text-muted" id="password-strength-text">
                                                            Password strength: Very Weak
                                                        </small>
                                                    </div>

                                                    <!-- Password Requirements -->
                                                    <div class="password-requirements mt-2">
                                                        <small class="form-text text-muted">
                                                            <strong>Password must contain:</strong>
                                                        </small>
                                                        <ul class="list-unstyled mt-1 mb-0 small">
                                                            <li id="req-length" class="text-muted">
                                                                <i class="bx bx-x text-danger me-1"></i>
                                                                At least 8 characters
                                                            </li>
                                                            <li id="req-uppercase" class="text-muted">
                                                                <i class="bx bx-x text-danger me-1"></i>
                                                                One uppercase letter
                                                            </li>
                                                            <li id="req-lowercase" class="text-muted">
                                                                <i class="bx bx-x text-danger me-1"></i>
                                                                One lowercase letter
                                                            </li>
                                                            <li id="req-number" class="text-muted">
                                                                <i class="bx bx-x text-danger me-1"></i>
                                                                One number
                                                            </li>
                                                            <li id="req-special" class="text-muted">
                                                                <i class="bx bx-x text-danger me-1"></i>
                                                                One special character
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="password_confirmation" class="form-label">
                                                        {{ isset($user) ? 'Confirm New Password' : 'Confirm Password' }}
                                                        @if(!isset($user))<span class="text-danger">*</span>@endif
                                                    </label>
                                                    <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                                                        id="password_confirmation" name="confirm-password"
                                                        placeholder="{{ isset($user) ? 'Confirm new password' : 'Confirm password' }}"
                                                        {{ !isset($user) ? 'required' : '' }}>
                                                    @error('password_confirmation')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror

                                                    <!-- Password Match Indicator -->
                                                    <div class="password-match mt-2">
                                                        <small id="password-match-text" class="form-text text-muted">
                                                            <i class="bx bx-info-circle me-1"></i>
                                                            Passwords must match
                                                        </small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @if(isset($user))
                                            <div class="alert alert-info mt-2 mb-0">
                                                <i class="bx bx-info-circle me-2"></i>
                                                Leave password fields blank to keep the current password unchanged.
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if(isset($user))
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="status" name="status" value="1"
                                            {{ old('status', $user->status ?? true) ? 'checked' : '' }}>
                                        <label class="form-check-label fw-medium" for="status">
                                            <i class="bx bx-check-circle me-1"></i>
                                            Active User Account
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="status" name="status" value="1" checked>
                                        <label class="form-check-label fw-medium" for="status">
                                            <i class="bx bx-check-circle me-1"></i>
                                            Active User Account
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif

                        <!-- Roles Section - Changed to Radio Buttons -->
                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="card border-0 bg-light">
                                    <div class="card-body">
                                        <label class="form-label fw-semibold mb-3">
                                            <i class="bx bx-shield-alt me-2"></i>
                                            System Role <span class="text-danger">*</span>
                                        </label>
                                        @error('role')
                                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                <i class="bx bx-error-circle me-2"></i>
                                                {{ $message }}
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                        @enderror

                                        <div class="row">
                                            @foreach($roles as $roleName => $roleDisplay)
                                            <div class="col-md-4 col-lg-3 mb-3">
                                                <div class="form-check card-role">
                                                    <input class="form-check-input" type="radio"
                                                        name="role" value="{{ $roleName }}"
                                                        id="role_{{ $roleName }}"
                                                        {{ (isset($userRole) && in_array($roleName, $userRole)) ? 'checked' : '' }}
                                                        {{ $roleName == 'Super Admin' && !auth()->user()->hasRole('Super Admin') ? 'disabled' : '' }}
                                                        {{ old('role') == $roleName ? 'checked' : '' }}>
                                                    <label class="form-check-label w-100" for="role_{{ $roleName }}">
                                                        <div class="d-flex align-items-center">
                                                            <i class="bx bx-shield-quarter me-2 text-primary"></i>
                                                            <span class="fw-medium">{{ $roleDisplay }}</span>
                                                        </div>
                                                        @if($roleName == 'Super Admin')
                                                            <small class="text-muted d-block mt-1">Full system access</small>
                                                        @elseif($roleName == 'State Admin')
                                                            <small class="text-muted d-block mt-1">State level access</small>
                                                        @elseif($roleName == 'District Admin')
                                                            <small class="text-muted d-block mt-1">District level access</small>
                                                        @elseif($roleName == 'Block Admin')
                                                            <small class="text-muted d-block mt-1">Block level access</small>
                                                        @elseif($roleName == 'School Admin')
                                                            <small class="text-muted d-block mt-1">School level access</small>
                                                        @endif
                                                    </label>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>

                                        @if(!auth()->user()->hasRole('Super Admin'))
                                        <div class="alert alert-warning mt-3 mb-0">
                                            <i class="bx bx-info-circle me-2"></i>
                                            <strong>Note:</strong> You cannot assign or modify Super Admin roles.
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer bg-transparent">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                @if(isset($user))
                                <small class="text-muted">
                                    <i class="bx bx-calendar-edit me-1"></i>
                                    Last updated: {{ $user->updated_at->format('M j, Y g:i A') }}
                                </small>
                                @endif
                            </div>
                            <div class="d-flex gap-2">
                                <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary">
                                    <i class="bx bx-x me-2"></i>
                                    Cancel
                                </a>
                                <button type="submit" class="btn btn-primary" id="submitBtn">
                                    <i class="bx {{ isset($user) ? 'bx-save' : 'bx-user-plus' }} me-2"></i>
                                    {{ isset($user) ? 'Update User' : 'Create User' }}
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('css')
<style>
.breadcrumb {
    background-color: #f8f9fa;
    border-radius: 0.375rem;
    padding: 0.75rem 1rem;
}

.breadcrumb-item a {
    color: var(--bs-primary);
    text-decoration: none;
    display: flex;
    align-items: center;
    gap: 0.25rem;
}

.breadcrumb-item a:hover {
    color: var(--bs-primary-dark);
}

.breadcrumb-item.active {
    color: var(--bs-secondary);
    display: flex;
    align-items: center;
    gap: 0.25rem;
}

.card-role {
    border: 1px solid #dee2e6;
    border-radius: 0.375rem;
    padding: 1rem;
    transition: all 0.2s ease;
    cursor: pointer;
}

.card-role:hover {
    border-color: var(--bs-primary);
    background-color: rgba(var(--bs-primary-rgb), 0.05);
}

.card-role .form-check-input:checked ~ .form-check-label {
    color: var(--bs-primary);
    font-weight: 600;
}

.card-role .form-check-input[type="radio"]:checked ~ .form-check-label {
    color: var(--bs-primary);
    font-weight: 600;
}

.form-check-input:checked {
    background-color: var(--bs-primary);
    border-color: var(--bs-primary);
}

.form-check-input[type="radio"]:checked {
    background-color: var(--bs-primary);
    border-color: var(--bs-primary);
}

.form-label {
    font-weight: 500;
    margin-bottom: 0.5rem;
}

.card-header {
    background-color: #f8f9fa;
    border-bottom: 1px solid #dee2e6;
}

.bg-light {
    background-color: #f8f9fa !important;
}

/* Password Strength Styles */
.password-strength .progress {
    background-color: #e9ecef;
}

.password-strength .progress-bar {
    transition: width 0.3s ease, background-color 0.3s ease;
}

.password-requirements li {
    transition: color 0.3s ease;
}

.password-requirements .valid {
    color: var(--bs-success) !important;
}

.password-requirements .valid i {
    color: var(--bs-success) !important;
}

.password-match .valid {
    color: var(--bs-success) !important;
}

.password-match .invalid {
    color: var(--bs-danger) !important;
}

/* Role Selection Styles */
.card-role.selected {
    border-color: var(--bs-primary);
    background-color: rgba(var(--bs-primary-rgb), 0.1);
    box-shadow: 0 0 0 2px rgba(var(--bs-primary-rgb), 0.25);
}

@media (max-width: 768px) {
    .card-header {
        flex-direction: column;
        align-items: flex-start !important;
    }

    .card-header .btn {
        margin-top: 0.5rem;
        align-self: flex-end;
    }

    .card-footer .d-flex {
        flex-direction: column;
        gap: 1rem !important;
    }

    .card-footer .d-flex > div:first-child {
        order: 2;
        text-align: center;
    }

    .card-footer .d-flex > div:last-child {
        order: 1;
    }
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const password = document.getElementById('password');
    const confirmPassword = document.getElementById('password_confirmation');
    const passwordStrengthBar = document.getElementById('password-strength-bar');
    const passwordStrengthText = document.getElementById('password-strength-text');
    const passwordMatchText = document.getElementById('password-match-text');
    const submitBtn = document.getElementById('submitBtn');
    const form = document.getElementById('userForm');

    // Password strength requirements
    const requirements = {
        length: document.getElementById('req-length'),
        uppercase: document.getElementById('req-uppercase'),
        lowercase: document.getElementById('req-lowercase'),
        number: document.getElementById('req-number'),
        special: document.getElementById('req-special')
    };

    // Password strength checker
    function checkPasswordStrength(password) {
        let strength = 0;
        const requirementsMet = {
            length: false,
            uppercase: false,
            lowercase: false,
            number: false,
            special: false
        };

        // Length requirement
        if (password.length >= 8) {
            strength += 20;
            requirementsMet.length = true;
        }

        // Uppercase requirement
        if (/[A-Z]/.test(password)) {
            strength += 20;
            requirementsMet.uppercase = true;
        }

        // Lowercase requirement
        if (/[a-z]/.test(password)) {
            strength += 20;
            requirementsMet.lowercase = true;
        }

        // Number requirement
        if (/[0-9]/.test(password)) {
            strength += 20;
            requirementsMet.number = true;
        }

        // Special character requirement
        if (/[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/.test(password)) {
            strength += 20;
            requirementsMet.special = true;
        }

        return { strength, requirementsMet };
    }

    // Update password strength UI
    function updatePasswordStrength() {
        const passwordValue = password.value;

        if (!passwordValue) {
            passwordStrengthBar.style.width = '0%';
            passwordStrengthBar.className = 'progress-bar';
            passwordStrengthText.textContent = 'Password strength: Very Weak';
            resetRequirements();
            return;
        }

        const { strength, requirementsMet } = checkPasswordStrength(passwordValue);

        // Update progress bar
        passwordStrengthBar.style.width = strength + '%';

        // Update strength text and color
        if (strength <= 20) {
            passwordStrengthBar.className = 'progress-bar bg-danger';
            passwordStrengthText.textContent = 'Password strength: Very Weak';
        } else if (strength <= 40) {
            passwordStrengthBar.className = 'progress-bar bg-warning';
            passwordStrengthText.textContent = 'Password strength: Weak';
        } else if (strength <= 60) {
            passwordStrengthBar.className = 'progress-bar bg-info';
            passwordStrengthText.textContent = 'Password strength: Fair';
        } else if (strength <= 80) {
            passwordStrengthBar.className = 'progress-bar bg-primary';
            passwordStrengthText.textContent = 'Password strength: Good';
        } else {
            passwordStrengthBar.className = 'progress-bar bg-success';
            passwordStrengthText.textContent = 'Password strength: Excellent';
        }

        // Update requirements UI
        updateRequirementsUI(requirementsMet);
    }

    // Update requirements checklist
    function updateRequirementsUI(requirementsMet) {
        Object.keys(requirementsMet).forEach(key => {
            const requirement = requirements[key];
            const icon = requirement.querySelector('i');

            if (requirementsMet[key]) {
                requirement.classList.add('valid');
                icon.className = 'bx bx-check text-success me-1';
            } else {
                requirement.classList.remove('valid');
                icon.className = 'bx bx-x text-danger me-1';
            }
        });
    }

    // Reset requirements UI
    function resetRequirements() {
        Object.values(requirements).forEach(requirement => {
            requirement.classList.remove('valid');
            const icon = requirement.querySelector('i');
            icon.className = 'bx bx-x text-danger me-1';
        });
    }

    // Check password match
    function checkPasswordMatch() {
        const passwordValue = password.value;
        const confirmValue = confirmPassword.value;

        if (!confirmValue) {
            passwordMatchText.innerHTML = '<i class="bx bx-info-circle me-1"></i> Passwords must match';
            passwordMatchText.className = 'form-text text-muted';
            return false;
        }

        if (passwordValue === confirmValue) {
            passwordMatchText.innerHTML = '<i class="bx bx-check-circle me-1"></i> Passwords match';
            passwordMatchText.className = 'form-text valid';
            return true;
        } else {
            passwordMatchText.innerHTML = '<i class="bx bx-x-circle me-1"></i> Passwords do not match';
            passwordMatchText.className = 'form-text invalid';
            return false;
        }
    }

    // Validate DISE code
    function validateDiseCode() {
        const diseCode = document.getElementById('dise_code').value;
        if (diseCode && !/^\d{11}$/.test(diseCode)) {
            alert('DISE code must be exactly 11 digits');
            return false;
        }
        return true;
    }

    // Validate form before submission
    function validateForm() {
        const passwordValue = password.value;
        const isEditMode = {{ isset($user) ? 'true' : 'false' }};

        // For new users, password is required
        if (!isEditMode && (!passwordValue || passwordValue.length < 8)) {
            alert('Please enter a strong password with at least 8 characters');
            password.focus();
            return false;
        }

        // For password changes, validate strength
        if (passwordValue && passwordValue.length > 0) {
            const { strength } = checkPasswordStrength(passwordValue);
            if (strength < 60) {
                alert('Please choose a stronger password. Password should include uppercase, lowercase, numbers, and special characters.');
                password.focus();
                return false;
            }

            if (!checkPasswordMatch()) {
                alert('Passwords do not match. Please confirm your password.');
                confirmPassword.focus();
                return false;
            }
        }

        // Validate DISE code
        if (!validateDiseCode()) {
            return false;
        }

        // Check if a role is selected
        const selectedRole = document.querySelector('input[name="role"]:checked');
        if (!selectedRole) {
            alert('Please select a role for the user.');
            return false;
        }

        return true;
    }

    // Enhanced role selection with visual feedback
    function initializeRoleSelection() {
        const roleRadios = document.querySelectorAll('input[name="role"]');

        roleRadios.forEach(radio => {
            const card = radio.closest('.card-role');

            // Add click event to entire card
            card.addEventListener('click', function(e) {
                if (!radio.disabled) {
                    radio.checked = true;
                    updateRoleSelectionUI();
                }
            });

            // Update UI when radio changes
            radio.addEventListener('change', function() {
                updateRoleSelectionUI();
            });

            // Initialize selected state
            if (radio.checked) {
                card.classList.add('selected');
            }
        });
    }

    // Update role selection UI
    function updateRoleSelectionUI() {
        const roleCards = document.querySelectorAll('.card-role');

        roleCards.forEach(card => {
            card.classList.remove('selected');
        });

        const selectedRadio = document.querySelector('input[name="role"]:checked');
        if (selectedRadio) {
            const selectedCard = selectedRadio.closest('.card-role');
            selectedCard.classList.add('selected');
        }
    }

    // Event listeners
    password.addEventListener('input', function() {
        updatePasswordStrength();
        checkPasswordMatch();
    });

    confirmPassword.addEventListener('input', checkPasswordMatch);

    // DISE code input validation (numbers only)
    document.getElementById('dise_code').addEventListener('input', function(e) {
        this.value = this.value.replace(/[^0-9]/g, '');
    });

    // Form submission
    form.addEventListener('submit', function(event) {
        if (!validateForm()) {
            event.preventDefault();
            event.stopPropagation();
            return false;
        }

        // Add loading state to submit button
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="bx bx-loader bx-spin me-2"></i> Processing...';
    });

    // Initialize role selection
    initializeRoleSelection();

    // Initialize password strength if password field has value
    if (password.value) {
        updatePasswordStrength();
        checkPasswordMatch();
    }
});
</script>
@endpush
