@extends('layouts.app')

@section('title', isset($user) ? 'Edit User' : 'Create User')
@section('page-title', isset($user) ? 'Edit User' : 'Create User')
@section('page-subtitle', isset($user) ? 'Update user information' : 'Add a new user to the system')

@push('css')
<style>
    .card-sm {
        border-radius: 0.5rem;
        border: 1px solid #dee2e6;
    }

    .breadcrumb-item a {
        text-decoration: none;
    }

    .breadcrumb-item.active {
        color: #6c757d;
    }

    .role-card {
        border: 1px solid #dee2e6;
        border-radius: 0.375rem;
        padding: 0.75rem;
        margin-bottom: 0.75rem;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .role-card:hover {
        border-color: #0d6efd;
        background-color: rgba(13, 110, 253, 0.05);
    }

    .role-card.selected {
        border-color: #0d6efd;
        background-color: rgba(13, 110, 253, 0.1);
        box-shadow: 0 0 0 1px rgba(13, 110, 253, 0.25);
    }

    .role-card.disabled {
        opacity: 0.5;
        cursor: not-allowed;
        background-color: #f8f9fa;
    }

    .role-card.disabled:hover {
        border-color: #dee2e6;
        background-color: #f8f9fa;
    }

    .form-check-input:checked {
        background-color: #0d6efd;
        border-color: #0d6efd;
    }

    .password-strength {
        margin-top: 0.5rem;
    }

    .progress {
        height: 4px;
    }

    .password-requirements li {
        font-size: 0.75rem;
        margin-bottom: 0.125rem;
    }

    .password-requirements .valid {
        color: #198754;
    }

    .password-requirements .invalid {
        color: #dc3545;
    }

    .requirement-icon {
        width: 16px;
        display: inline-block;
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    <!-- Breadcrumb -->
    <div class="row mb-3">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">Users</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ isset($user) ? 'Edit' : 'Create' }}</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Error Display -->
    <x-error-display />

    <div class="row">
        <div class="col-12">
            <div class="card card-sm">
                <div class="card-header bg-white py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0 fs-6 fw-bold">
                            <i class='bx {{ isset($user) ? "bx-edit" : "bx-user-plus" }} me-2'></i>
                            {{ isset($user) ? 'Edit User' : 'Create New User' }}
                        </h5>
                        <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary btn-sm">
                            <i class='bx bx-arrow-back me-1'></i>Back
                        </a>
                    </div>
                </div>

                <form method="POST" action="{{ isset($user) ? route('admin.users.update', $user->id) : route('admin.users.store') }}" id="userForm">
                    @csrf
                    @if(isset($user))
                        @method('PUT')
                    @endif

                    <div class="card-body">
                        <!-- Basic Information -->
                        <div class="row mb-4">
                            <div class="col-12 mb-3">
                                <h6 class="fw-bold border-bottom pb-2 mb-3">
                                    <i class='bx bx-user-circle me-2'></i>Basic Information
                                </h6>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label small fw-bold">Full Name <span class="text-danger">*</span></label>
                                    <input type="text"
                                           class="form-control form-control-sm @error('name') is-invalid @enderror"
                                           id="name"
                                           name="name"
                                           value="{{ old('name', $user->name ?? '') }}"
                                           placeholder="Enter full name"
                                           required>
                                    @error('name')
                                        <div class="invalid-feedback small">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label small fw-bold">Email <span class="text-danger">*</span></label>
                                    <input type="email"
                                           class="form-control form-control-sm @error('email') is-invalid @enderror"
                                           id="email"
                                           name="email"
                                           value="{{ old('email', $user->email ?? '') }}"
                                           placeholder="Enter email address"
                                           required>
                                    @error('email')
                                        <div class="invalid-feedback small">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label small fw-bold">Phone Number</label>
                                    <input type="text"
                                           class="form-control form-control-sm @error('phone') is-invalid @enderror"
                                           id="phone"
                                           name="phone"
                                           value="{{ old('phone', $user->phone ?? '') }}"
                                           placeholder="Enter phone number"
                                           maxlength="15">
                                    @error('phone')
                                        <div class="invalid-feedback small">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label small fw-bold">DISE Code</label>
                                    <input type="text"
                                           class="form-control form-control-sm @error('dise_code') is-invalid @enderror"
                                           id="dise_code"
                                           name="dise_code"
                                           value="{{ old('dise_code', $user->dise_code ?? '') }}"
                                           placeholder="Enter 11-digit DISE code"
                                           maxlength="11"
                                           pattern="[0-9]{11}">
                                    @error('dise_code')
                                        <div class="invalid-feedback small">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">11-digit DISE code starting with 192</small>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label small fw-bold">Department</label>
                                    <input type="text"
                                           class="form-control form-control-sm @error('department') is-invalid @enderror"
                                           id="department"
                                           name="department"
                                           value="{{ old('department', $user->department ?? '') }}"
                                           placeholder="Enter department">
                                    @error('department')
                                        <div class="invalid-feedback small">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label small fw-bold">Designation</label>
                                    <input type="text"
                                           class="form-control form-control-sm @error('designation') is-invalid @enderror"
                                           id="designation"
                                           name="designation"
                                           value="{{ old('designation', $user->designation ?? '') }}"
                                           placeholder="Enter designation">
                                    @error('designation')
                                        <div class="invalid-feedback small">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Password Section -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h6 class="fw-bold border-bottom pb-2 mb-3">
                                    <i class='bx bx-lock me-2'></i>Password Settings
                                </h6>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label small fw-bold">
                                                {{ isset($user) ? 'New Password' : 'Password' }}
                                                @if(!isset($user))<span class="text-danger">*</span>@endif
                                            </label>
                                            <input type="password"
                                                   class="form-control form-control-sm @error('password') is-invalid @enderror"
                                                   id="password"
                                                   name="password"
                                                   placeholder="{{ isset($user) ? 'Leave blank to keep current' : 'Enter strong password' }}"
                                                   {{ !isset($user) ? 'required' : '' }}
                                                   minlength="8">
                                            @error('password')
                                                <div class="invalid-feedback small">{{ $message }}</div>
                                            @enderror

                                            <!-- Password Strength -->
                                            <div class="password-strength">
                                                <div class="progress">
                                                    <div class="progress-bar" id="password-strength-bar" role="progressbar"></div>
                                                </div>
                                                <small class="text-muted" id="password-strength-text">Password strength</small>
                                            </div>

                                            <!-- Requirements -->
                                            <div class="password-requirements mt-2">
                                                <small class="text-muted d-block mb-1">Requirements:</small>
                                                <ul class="list-unstyled mb-0">
                                                    <li id="req-length" class="invalid">
                                                        <span class="requirement-icon"><i class='bx bx-x'></i></span>
                                                        At least 8 characters
                                                    </li>
                                                    <li id="req-uppercase" class="invalid">
                                                        <span class="requirement-icon"><i class='bx bx-x'></i></span>
                                                        One uppercase letter
                                                    </li>
                                                    <li id="req-lowercase" class="invalid">
                                                        <span class="requirement-icon"><i class='bx bx-x'></i></span>
                                                        One lowercase letter
                                                    </li>
                                                    <li id="req-number" class="invalid">
                                                        <span class="requirement-icon"><i class='bx bx-x'></i></span>
                                                        One number
                                                    </li>
                                                    <li id="req-special" class="invalid">
                                                        <span class="requirement-icon"><i class='bx bx-x'></i></span>
                                                        One special character
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label small fw-bold">
                                                {{ isset($user) ? 'Confirm New Password' : 'Confirm Password' }}
                                                @if(!isset($user))<span class="text-danger">*</span>@endif
                                            </label>
                                            <input type="password"
                                                   class="form-control form-control-sm @error('password_confirmation') is-invalid @enderror"
                                                   id="password_confirmation"
                                                   name="password_confirmation"
                                                   placeholder="{{ isset($user) ? 'Confirm new password' : 'Confirm password' }}"
                                                   {{ !isset($user) ? 'required' : '' }}>
                                            @error('password_confirmation')
                                                <div class="invalid-feedback small">{{ $message }}</div>
                                            @enderror

                                            <!-- Match Indicator -->
                                            <div class="mt-2">
                                                <small id="password-match-text" class="text-muted">
                                                    <i class='bx bx-info-circle'></i> Passwords must match
                                                </small>
                                            </div>
                                        </div>

                                        @if(isset($user))
                                        <div class="alert alert-light border small mt-3">
                                            <i class='bx bx-info-circle me-1'></i>
                                            Leave password fields blank to keep current password
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Status -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="status" name="status" value="1"
                                           {{ old('status', isset($user) ? $user->status : true) ? 'checked' : '' }}>
                                    <label class="form-check-label small fw-bold" for="status">
                                        <i class='bx bx-check-circle me-1'></i>
                                        Active User Account
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Role Selection -->
                        <div class="row">
                            <div class="col-12">
                                <h6 class="fw-bold border-bottom pb-2 mb-3">
                                    <i class='bx bx-shield-alt me-2'></i>System Role <span class="text-danger">*</span>
                                </h6>

                                @error('role')
                                    <div class="alert alert-danger small mb-3">{{ $message }}</div>
                                @enderror

                                <div class="row" id="roleSelection">
                                    @foreach($roles as $role)
                                        @php
                                            $roleDisplay = $role->name;
                                            $roleDescription = '';
                                            if ($role->name === 'Super Admin') {
                                                $roleDisplay = 'Super Admin';
                                                $roleDescription = 'Full system access';
                                            } elseif ($role->name === 'State Admin') {
                                                $roleDisplay = 'State Admin';
                                                $roleDescription = 'State level access';
                                            } elseif ($role->name === 'District Admin') {
                                                $roleDisplay = 'District Admin';
                                                $roleDescription = 'District level access';
                                            } elseif ($role->name === 'Block Admin') {
                                                $roleDisplay = 'Block Admin';
                                                $roleDescription = 'Block level access';
                                            } elseif ($role->name === 'School Admin') {
                                                $roleDisplay = 'School Admin';
                                                $roleDescription = 'School level access';
                                            } else {
                                                $roleDisplay = $role->name;
                                                $roleDescription = $role->description ?? 'System role';
                                            }

                                            $isDisabled = $role->name === 'Super Admin' && !auth()->user()->hasRole('Super Admin');
                                            $isSelected = isset($userRole) && in_array($role->name, $userRole) || old('role') == $role->name;
                                        @endphp

                                        <div class="col-md-4 col-lg-3">
                                            <div class="role-card {{ $isDisabled ? 'disabled' : '' }} {{ $isSelected ? 'selected' : '' }}"
                                                 data-role="{{ $role->name }}">
                                                <div class="form-check mb-0">
                                                    <input class="form-check-input"
                                                           type="radio"
                                                           name="role"
                                                           value="{{ $role->name }}"
                                                           id="role_{{ $role->name }}"
                                                           {{ $isSelected ? 'checked' : '' }}
                                                           {{ $isDisabled ? 'disabled' : '' }}>
                                                    <label class="form-check-label w-100" for="role_{{ $role->name }}">
                                                        <div class="d-flex align-items-center mb-1">
                                                            <i class='bx bx-shield-quarter me-2 text-primary'></i>
                                                            <span class="fw-semibold small">{{ $roleDisplay }}</span>
                                                        </div>
                                                        @if($roleDescription)
                                                            <small class="text-muted d-block">{{ $roleDescription }}</small>
                                                        @endif
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                @if(!auth()->user()->hasRole('Super Admin'))
                                <div class="alert alert-warning small mt-3">
                                    <i class='bx bx-info-circle me-1'></i>
                                    <strong>Note:</strong> You cannot assign or modify Super Admin roles.
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="card-footer bg-white py-3 border-top">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="small text-muted">
                                @if(isset($user))
                                    User ID: #{{ $user->id }}
                                    <span class="mx-2">•</span>
                                    Last updated: {{ $user->updated_at->format('M d, Y') }}
                                @endif
                            </div>
                            <div class="btn-group">
                                <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary btn-sm">
                                    <i class='bx bx-x me-1'></i>Cancel
                                </a>
                                <button type="submit" class="btn btn-primary btn-sm" id="submitBtn">
                                    <i class='bx {{ isset($user) ? "bx-save" : "bx-user-plus" }} me-1'></i>
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

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Elements
        const password = document.getElementById('password');
        const confirmPassword = document.getElementById('password_confirmation');
        const passwordStrengthBar = document.getElementById('password-strength-bar');
        const passwordStrengthText = document.getElementById('password-strength-text');
        const passwordMatchText = document.getElementById('password-match-text');
        const submitBtn = document.getElementById('submitBtn');
        const form = document.getElementById('userForm');

        // Role selection
        const roleCards = document.querySelectorAll('.role-card:not(.disabled)');

        // Password strength checker
        function checkPasswordStrength(pass) {
            let strength = 0;
            const requirements = {
                length: pass.length >= 8,
                uppercase: /[A-Z]/.test(pass),
                lowercase: /[a-z]/.test(pass),
                number: /[0-9]/.test(pass),
                special: /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/.test(pass)
            };

            // Calculate strength (0-100)
            strength += requirements.length ? 20 : 0;
            strength += requirements.uppercase ? 20 : 0;
            strength += requirements.lowercase ? 20 : 0;
            strength += requirements.number ? 20 : 0;
            strength += requirements.special ? 20 : 0;

            return { strength, requirements };
        }

        // Update password strength UI
        function updatePasswordStrength() {
            const pass = password.value;
            const { strength, requirements } = checkPasswordStrength(pass);

            // Update progress bar
            passwordStrengthBar.style.width = strength + '%';

            // Update color and text
            if (strength <= 20) {
                passwordStrengthBar.className = 'progress-bar bg-danger';
                passwordStrengthText.textContent = 'Very Weak';
            } else if (strength <= 40) {
                passwordStrengthBar.className = 'progress-bar bg-warning';
                passwordStrengthText.textContent = 'Weak';
            } else if (strength <= 60) {
                passwordStrengthBar.className = 'progress-bar bg-info';
                passwordStrengthText.textContent = 'Fair';
            } else if (strength <= 80) {
                passwordStrengthBar.className = 'progress-bar bg-primary';
                passwordStrengthText.textContent = 'Good';
            } else {
                passwordStrengthBar.className = 'progress-bar bg-success';
                passwordStrengthText.textContent = 'Excellent';
            }

            // Update requirement indicators
            Object.keys(requirements).forEach(req => {
                const element = document.getElementById(`req-${req}`);
                const icon = element.querySelector('i');

                if (requirements[req]) {
                    element.classList.remove('invalid');
                    element.classList.add('valid');
                    icon.className = 'bx bx-check';
                } else {
                    element.classList.remove('valid');
                    element.classList.add('invalid');
                    icon.className = 'bx bx-x';
                }
            });
        }

        // Check password match
        function checkPasswordMatch() {
            const pass = password.value;
            const confirm = confirmPassword.value;

            if (!confirm) {
                passwordMatchText.innerHTML = '<i class="bx bx-info-circle"></i> Passwords must match';
                passwordMatchText.className = 'text-muted';
                return false;
            }

            if (pass === confirm) {
                passwordMatchText.innerHTML = '<i class="bx bx-check-circle text-success"></i> Passwords match';
                passwordMatchText.className = 'text-success';
                return true;
            } else {
                passwordMatchText.innerHTML = '<i class="bx bx-x-circle text-danger"></i> Passwords do not match';
                passwordMatchText.className = 'text-danger';
                return false;
            }
        }

        // Validate DISE code
        function validateDiseCode() {
            const code = document.getElementById('dise_code').value;
            if (code && !/^\d{11}$/.test(code)) {
                showToast('DISE code must be exactly 11 digits', 'error');
                return false;
            }
            return true;
        }

        // Validate form
        function validateForm() {
            const isEdit = {{ isset($user) ? 'true' : 'false' }};
            const pass = password.value;

            // Password validation for new users
            if (!isEdit) {
                const { strength } = checkPasswordStrength(pass);
                if (strength < 60) {
                    showToast('Please choose a stronger password. Include uppercase, lowercase, numbers, and special characters.', 'error');
                    password.focus();
                    return false;
                }

                if (!checkPasswordMatch()) {
                    showToast('Passwords do not match. Please confirm your password.', 'error');
                    confirmPassword.focus();
                    return false;
                }
            }

            // Password validation for edits (if provided)
            if (pass) {
                const { strength } = checkPasswordStrength(pass);
                if (strength < 60) {
                    showToast('New password is too weak. Include uppercase, lowercase, numbers, and special characters.', 'error');
                    password.focus();
                    return false;
                }

                if (!checkPasswordMatch()) {
                    showToast('Passwords do not match. Please confirm your new password.', 'error');
                    confirmPassword.focus();
                    return false;
                }
            }

            // Validate DISE code
            if (!validateDiseCode()) {
                return false;
            }

            // Check role selection
            const selectedRole = document.querySelector('input[name="role"]:checked');
            if (!selectedRole) {
                showToast('Please select a role for the user.', 'error');
                return false;
            }

            return true;
        }

        // Role selection handling
        roleCards.forEach(card => {
            card.addEventListener('click', function() {
                const radio = this.querySelector('input[type="radio"]');
                if (!radio.disabled) {
                    radio.checked = true;
                    updateRoleSelection();
                }
            });
        });

        function updateRoleSelection() {
            roleCards.forEach(card => {
                card.classList.remove('selected');
            });

            const selectedRadio = document.querySelector('input[name="role"]:checked');
            if (selectedRadio) {
                const selectedCard = selectedRadio.closest('.role-card');
                if (selectedCard) {
                    selectedCard.classList.add('selected');
                }
            }
        }

        // Initialize role selection
        updateRoleSelection();

        // Event listeners
        password.addEventListener('input', function() {
            updatePasswordStrength();
            checkPasswordMatch();
        });

        confirmPassword.addEventListener('input', checkPasswordMatch);

        // DISE code numeric only
        document.getElementById('dise_code').addEventListener('input', function(e) {
            this.value = this.value.replace(/[^0-9]/g, '');
        });

        // Form submission
        form.addEventListener('submit', function(e) {
            if (!validateForm()) {
                e.preventDefault();
                return false;
            }

            // Add loading state
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span>Processing...';
        });

        // Initialize password strength if password exists
        if (password.value) {
            updatePasswordStrength();
            checkPasswordMatch();
        }

        // Toast notification function
        function showToast(message, type = 'info') {
            const event = new CustomEvent('show-toast', {
                detail: { message, type }
            });
            window.dispatchEvent(event);
        }
    });
</script>
@endpush
