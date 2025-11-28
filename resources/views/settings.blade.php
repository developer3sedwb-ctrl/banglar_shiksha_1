@extends('layouts.app')

@section('title', 'Account Settings - ' . config('app.name'))
@section('page-title', 'Account Settings')
@section('page-subtitle', 'Manage your preferences, security, and application settings')

@push('css')
<style>
.settings-nav {
    position: sticky;
    top: 2rem;
}

.settings-nav .nav-link {
    border-radius: 8px;
    padding: 0.75rem 1rem;
    margin-bottom: 0.25rem;
    color: #6b7280;
    font-weight: 500;
    transition: all 0.2s;
}

.settings-nav .nav-link.active {
    background: var(--wb-light-blue);
    color: var(--wb-primary);
    border-left: 3px solid var(--wb-primary);
}

.settings-nav .nav-link:hover {
    background: #f8fafc;
    color: var(--wb-primary);
}

.settings-section {
    display: none;
}

.settings-section.active {
    display: block;
    animation: fadeIn 0.3s ease-in-out;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}

.theme-preview {
    border: 2px solid transparent;
    border-radius: 8px;
    padding: 1rem;
    cursor: pointer;
    transition: all 0.3s;
}

.theme-preview:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

.theme-preview.active {
    border-color: var(--wb-primary);
    background: var(--wb-light-blue);
}

.security-badge {
    background: #f8fafc;
    border: 1px solid #e5e7eb;
    border-radius: 6px;
    padding: 0.5rem;
    margin-bottom: 0.5rem;
}

.session-active {
    border-left: 3px solid var(--wb-green);
}

.session-inactive {
    border-left: 3px solid var(--wb-orange);
}

.danger-zone {
    border: 1px solid #fecaca;
    background: #fef2f2;
    border-radius: 8px;
    padding: 1.5rem;
}
</style>
@endpush

@section('content')
<div class="row">
    <!-- Settings Navigation -->
    <div class="col-lg-3">
        <div class="card settings-nav">
            <div class="card-body">
                <div class="nav flex-column">
                    <a href="#general" class="nav-link active" data-section="general">
                        <i class="ti ti-settings me-2"></i>General
                    </a>
                    <a href="#appearance" class="nav-link" data-section="appearance">
                        <i class="ti ti-palette me-2"></i>Appearance
                    </a>
                    <a href="#notifications" class="nav-link" data-section="notifications">
                        <i class="ti ti-bell me-2"></i>Notifications
                    </a>
                    <a href="#security" class="nav-link" data-section="security">
                        <i class="ti ti-shield-lock me-2"></i>Security
                    </a>
                    <a href="#sessions" class="nav-link" data-section="sessions">
                        <i class="ti ti-devices me-2"></i>Sessions
                    </a>
                    <a href="#privacy" class="nav-link" data-section="privacy">
                        <i class="ti ti-lock me-2"></i>Privacy
                    </a>
                    <div class="dropdown-divider my-2"></div>
                    <a href="#danger" class="nav-link text-danger" data-section="danger">
                        <i class="ti ti-trash me-2"></i>Danger Zone
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Settings Content -->
    <div class="col-lg-9">
        <!-- General Settings -->
        <div class="settings-section active" id="general-section">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="ti ti-settings me-2"></i>General Settings
                    </h3>
                    <div class="card-actions">
                        <button type="button" class="btn btn-primary btn-sm" onclick="saveSettings('general')">
                            <i class="ti ti-check me-1"></i>Save Changes
                        </button>
                    </div>
                </div>
                <form action="{{ route('settings.update') }}" method="POST" id="generalForm">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Language</label>
                                    <select class="form-select" name="language">
                                        <option value="en" {{ (old('language', $settings['language'] ?? 'en') == 'en') ? 'selected' : '' }}>English</option>
                                        <option value="hi" {{ (old('language', $settings['language'] ?? 'en') == 'hi') ? 'selected' : '' }}>Hindi</option>
                                        <option value="bn" {{ (old('language', $settings['language'] ?? 'en') == 'bn') ? 'selected' : '' }}>Bengali</option>
                                    </select>
                                    <small class="text-muted">Interface language for the application</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Timezone</label>
                                    <select class="form-select" name="timezone">
                                        <option value="Asia/Kolkata" {{ (old('timezone', $settings['timezone'] ?? 'Asia/Kolkata') == 'Asia/Kolkata') ? 'selected' : '' }}>Asia/Kolkata (IST)</option>
                                        <option value="UTC" {{ (old('timezone', $settings['timezone'] ?? 'Asia/Kolkata') == 'UTC') ? 'selected' : '' }}>UTC</option>
                                    </select>
                                    <small class="text-muted">Time display preference</small>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Date Format</label>
                                    <select class="form-select" name="date_format">
                                        <option value="Y-m-d" {{ (old('date_format', $settings['date_format'] ?? 'd/m/Y') == 'Y-m-d') ? 'selected' : '' }}>YYYY-MM-DD (2024-01-15)</option>
                                        <option value="d/m/Y" {{ (old('date_format', $settings['date_format'] ?? 'd/m/Y') == 'd/m/Y') ? 'selected' : '' }}>DD/MM/YYYY (15/01/2024)</option>
                                        <option value="m/d/Y" {{ (old('date_format', $settings['date_format'] ?? 'd/m/Y') == 'm/d/Y') ? 'selected' : '' }}>MM/DD/YYYY (01/15/2024)</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Items Per Page</label>
                                    <select class="form-select" name="items_per_page">
                                        <option value="10" {{ (old('items_per_page', $settings['items_per_page'] ?? '25') == '10') ? 'selected' : '' }}>10 items</option>
                                        <option value="25" {{ (old('items_per_page', $settings['items_per_page'] ?? '25') == '25') ? 'selected' : '' }}>25 items</option>
                                        <option value="50" {{ (old('items_per_page', $settings['items_per_page'] ?? '25') == '50') ? 'selected' : '' }}>50 items</option>
                                        <option value="100" {{ (old('items_per_page', $settings['items_per_page'] ?? '25') == '100') ? 'selected' : '' }}>100 items</option>
                                    </select>
                                    <small class="text-muted">Number of items to display in lists</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Appearance Settings -->
        <div class="settings-section" id="appearance-section">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="ti ti-palette me-2"></i>Appearance
                    </h3>
                </div>
                <form action="{{ route('settings.update') }}" method="POST" id="appearanceForm">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="mb-4">
                            <label class="form-label">Theme</label>
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <div class="theme-preview active" data-theme="light">
                                        <div class="text-center">
                                            <div class="bg-white border rounded p-3 mb-2">
                                                <div class="d-flex gap-1 mb-1">
                                                    <div class="bg-primary rounded" style="width: 20px; height: 10px;"></div>
                                                    <div class="bg-blue-lt rounded" style="width: 20px; height: 10px;"></div>
                                                    <div class="bg-success rounded" style="width: 20px; height: 10px;"></div>
                                                </div>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="theme" value="light"
                                                    {{ (old('theme', $settings['theme'] ?? 'light') == 'light') ? 'checked' : '' }}>
                                                <label class="form-check-label">Light</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="theme-preview" data-theme="dark">
                                        <div class="text-center">
                                            <div class="bg-dark border rounded p-3 mb-2">
                                                <div class="d-flex gap-1 mb-1">
                                                    <div class="bg-primary rounded" style="width: 20px; height: 10px;"></div>
                                                    <div class="bg-blue-lt rounded" style="width: 20px; height: 10px;"></div>
                                                    <div class="bg-success rounded" style="width: 20px; height: 10px;"></div>
                                                </div>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="theme" value="dark"
                                                    {{ (old('theme', $settings['theme'] ?? 'light') == 'dark') ? 'checked' : '' }}>
                                                <label class="form-check-label">Dark</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="theme-preview" data-theme="system">
                                        <div class="text-center">
                                            <div class="bg-gradient border rounded p-3 mb-2">
                                                <div class="d-flex gap-1 mb-1">
                                                    <div class="bg-primary rounded" style="width: 10px; height: 10px;"></div>
                                                    <div class="bg-dark rounded" style="width: 10px; height: 10px;"></div>
                                                </div>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="theme" value="system"
                                                    {{ (old('theme', $settings['theme'] ?? 'light') == 'system') ? 'checked' : '' }}>
                                                <label class="form-check-label">System</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Navigation Layout</label>
                                    <select class="form-select" name="nav_layout">
                                        <option value="vertical" {{ (old('nav_layout', $settings['nav_layout'] ?? 'vertical') == 'vertical') ? 'selected' : '' }}>Vertical</option>
                                        <option value="horizontal" {{ (old('nav_layout', $settings['nav_layout'] ?? 'vertical') == 'horizontal') ? 'selected' : '' }}>Horizontal</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Color Scheme</label>
                                    <select class="form-select" name="color_scheme">
                                        <option value="default" {{ (old('color_scheme', $settings['color_scheme'] ?? 'default') == 'default') ? 'selected' : '' }}>Default Blue</option>
                                        <option value="green" {{ (old('color_scheme', $settings['color_scheme'] ?? 'default') == 'green') ? 'selected' : '' }}>Green</option>
                                        <option value="purple" {{ (old('color_scheme', $settings['color_scheme'] ?? 'default') == 'purple') ? 'selected' : '' }}>Purple</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-footer">
                            <button type="button" class="btn btn-primary" onclick="saveSettings('appearance')">Save Changes</button>
                            <button type="reset" class="btn btn-secondary">Reset</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Security Settings -->
        <div class="settings-section" id="security-section">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="ti ti-shield-lock me-2"></i>Security Settings
                    </h3>
                </div>
                <div class="card-body">
                    <!-- Password Change -->
                    <div class="mb-4">
                        <h5 class="mb-3">Change Password</h5>
                        <form action="{{ route('settings.password') }}" method="POST" id="passwordForm">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Current Password</label>
                                        <input type="password" class="form-control @error('current_password') is-invalid @enderror"
                                               name="current_password" required>
                                        @error('current_password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">New Password</label>
                                        <input type="password" class="form-control @error('new_password') is-invalid @enderror"
                                               name="new_password" required>
                                        @error('new_password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Confirm New Password</label>
                                        <input type="password" class="form-control" name="new_password_confirmation" required>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="logout_other_devices">
                                    <label class="form-check-label">Logout from all other devices</label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Change Password</button>
                        </form>
                    </div>

                    <!-- Two-Factor Authentication -->
                    <div class="mb-4">
                        <h5 class="mb-3">Two-Factor Authentication</h5>
                        <div class="alert alert-info">
                            <div class="d-flex">
                                <div>
                                    <i class="ti ti-info-circle me-2"></i>
                                </div>
                                <div>
                                    <strong>Enhanced Security:</strong> Two-factor authentication adds an extra layer of security to your account.
                                    You'll need to enter a code from your authenticator app when signing in.
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-outline-primary">Enable 2FA</button>
                    </div>

                    <!-- Security Checklist -->
                    <div class="mb-3">
                        <h5 class="mb-3">Security Checklist</h5>
                        <div class="security-badge">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" checked disabled>
                                <label class="form-check-label"><strong>Strong Password</strong> - Your password meets security requirements</label>
                            </div>
                        </div>
                        <div class="security-badge">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" disabled>
                                <label class="form-check-label"><strong>Two-Factor Authentication</strong> - Add an extra layer of security</label>
                            </div>
                        </div>
                        <div class="security-badge">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" checked disabled>
                                <label class="form-check-label"><strong>Recent Activity</strong> - You've logged in recently</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Danger Zone -->
        <div class="settings-section" id="danger-section">
            <div class="card border-danger">
                <div class="card-header bg-danger text-white">
                    <h3 class="card-title text-white">
                        <i class="ti ti-alert-triangle me-2"></i>Danger Zone
                    </h3>
                </div>
                <div class="card-body">
                    <!-- Account Deletion -->
                    <div class="danger-zone mb-4">
                        <div class="row align-items-center">
                            <div class="col">
                                <h4 class="text-danger mb-2">Delete Account</h4>
                                <p class="text-muted mb-0">
                                    Permanently delete your account and all associated data. This action cannot be undone.
                                </p>
                            </div>
                            <div class="col-auto">
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteAccountModal">
                                    Delete Account
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Export Data -->
                    <div class="mb-4">
                        <h5 class="mb-3">Data Export</h5>
                        <p class="text-muted">Download all your personal data stored in our system.</p>
                        <button type="button" class="btn btn-outline-primary">
                            <i class="ti ti-download me-2"></i>Export My Data
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Account Modal -->
<div class="modal modal-blur fade" id="deleteAccountModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Account</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <div class="h1 text-danger mb-3">⚠️</div>
                    <h4>Are you sure?</h4>
                    <p class="text-muted">
                        This action cannot be undone. All your data will be permanently removed.
                    </p>
                    <div class="mt-3">
                        <input type="text" class="form-control" placeholder="Type 'DELETE' to confirm" id="deleteConfirm">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link link-secondary me-auto" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmDelete" disabled>Delete My Account</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Settings navigation
    const navLinks = document.querySelectorAll('.settings-nav .nav-link');
    const sections = document.querySelectorAll('.settings-section');

    navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();

            // Update active nav link
            navLinks.forEach(nl => nl.classList.remove('active'));
            this.classList.add('active');

            // Show corresponding section
            const sectionId = this.getAttribute('data-section');
            sections.forEach(section => {
                section.classList.remove('active');
                if (section.id === `${sectionId}-section`) {
                    section.classList.add('active');
                }
            });
        });
    });

    // Theme preview selection
    const themePreviews = document.querySelectorAll('.theme-preview');
    themePreviews.forEach(preview => {
        preview.addEventListener('click', function() {
            const theme = this.getAttribute('data-theme');
            const radio = this.querySelector('input[type="radio"]');
            radio.checked = true;

            themePreviews.forEach(p => p.classList.remove('active'));
            this.classList.add('active');
        });
    });

    // Delete account confirmation
    const deleteConfirm = document.getElementById('deleteConfirm');
    const confirmDelete = document.getElementById('confirmDelete');

    deleteConfirm.addEventListener('input', function() {
        confirmDelete.disabled = this.value !== 'DELETE';
    });

    confirmDelete.addEventListener('click', function() {
        if (confirm('Final confirmation! This will permanently delete your account.')) {
            // Simulate account deletion
            showToast('Account Deletion', 'Your account deletion request has been submitted.', 'warning');
            $('#deleteAccountModal').modal('hide');
        }
    });

    // Form submission handlers
    const forms = {
        general: document.getElementById('generalForm'),
        appearance: document.getElementById('appearanceForm'),
        security: document.getElementById('passwordForm')
    };

    window.saveSettings = function(section) {
        const form = forms[section];
        if (form) {
            const submitBtn = form.querySelector('button[type="submit"], .btn-primary');
            const originalText = submitBtn.innerHTML;

            submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status"></span> Saving...';
            submitBtn.disabled = true;

            // Simulate API call
            setTimeout(() => {
                form.submit();
            }, 1000);
        }
    };

    // Initialize forms
    Object.values(forms).forEach(form => {
        if (form) {
            form.addEventListener('submit', function(e) {
                const submitBtn = this.querySelector('button[type="submit"]');
                if (submitBtn) {
                    submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status"></span> Processing...';
                    submitBtn.disabled = true;
                }
            });
        }
    });

    // Show success/error messages
    @if(session('success'))
        showToast('Success', '{{ session('success') }}', 'success');
    @endif

    @if($errors->any())
        @foreach($errors->all() as $error)
            showToast('Error', '{{ $error }}', 'error');
        @endforeach
    @endif
});

function showToast(title, message, type = 'info') {
    const toast = document.createElement('div');
    toast.className = `alert alert-${type} alert-dismissible fade show position-fixed`;
    toast.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
    toast.innerHTML = `
        <strong>${title}:</strong> ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `;
    document.body.appendChild(toast);

    setTimeout(() => {
        toast.remove();
    }, 5000);
}
</script>
@endpush
