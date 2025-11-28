@extends('layouts.app')

@section('title', 'My Profile - ' . config('app.name'))
@section('page-title', 'My Profile')
@section('page-subtitle', 'Manage your account information and preferences')

@push('css')
<style>
.profile-avatar {
    width: 120px;
    height: 120px;
    border: 4px solid var(--wb-light-blue);
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

.stats-card {
    background: linear-gradient(135deg, var(--wb-primary) 0%, var(--wb-dark-blue) 100%);
    color: white;
    border: none;
}

.stats-number {
    font-size: 2rem;
    font-weight: 700;
}

.info-item {
    border-bottom: 1px solid #e5e7eb;
    padding: 1rem 0;
}

.info-item:last-child {
    border-bottom: none;
}

.badge-role {
    background: var(--wb-primary);
    color: white;
    font-size: 0.8rem;
}
</style>
@endpush

@section('content')
<div class="row">
    <!-- Left Sidebar - Profile Summary -->
    <div class="col-md-4">
        <div class="card">
            <div class="card-body text-center p-4">
                <div class="mb-3">
                    <div class="avatar avatar-xl profile-avatar mx-auto d-flex align-items-center justify-content-center">
                        <span class="avatar-initials display-4 text-white">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </span>
                    </div>
                </div>

                <h3 class="mb-1">{{ Auth::user()->name }}</h3>
                <p class="text-muted mb-2">{{ Auth::user()->email }}</p>

                <div class="mb-3">
                    <span class="badge badge-role">
                        <i class="ti ti-badge me-1"></i>
                        {{ Auth::user()->getRoleNames()->first() ?? 'User' }}
                    </span>
                </div>

                <div class="d-grid gap-2">
                    <a href="{{ route('settings') }}" class="btn btn-primary">
                        <i class="ti ti-settings me-2"></i>Account Settings
                    </a>
                </div>
            </div>
        </div>

        <!-- Quick Stats -->
        <div class="card mt-4">
            <div class="card-header">
                <h4 class="card-title mb-0">Quick Stats</h4>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-6">
                        <div class="mb-3">
                            <div class="h3 text-primary mb-1">{{ Auth::user()->created_at->format('M Y') }}</div>
                            <div class="text-muted small">Member Since</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <div class="h3 text-success mb-1">{{ \Carbon\Carbon::now()->diffInDays(Auth::user()->created_at) }}</div>
                            <div class="text-muted small">Days Active</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="col-md-8">
        <!-- Personal Information Card -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="ti ti-user me-2"></i>Personal Information
                </h3>
                <div class="card-actions">
                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                        <i class="ti ti-edit me-1"></i>Edit Profile
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="info-item">
                            <label class="form-label text-muted small mb-1">Full Name</label>
                            <div class="fw-semibold">{{ Auth::user()->name }}</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-item">
                            <label class="form-label text-muted small mb-1">Email Address</label>
                            <div class="fw-semibold">{{ Auth::user()->email }}</div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="info-item">
                            <label class="form-label text-muted small mb-1">User ID</label>
                            <div class="fw-semibold">#{{ Auth::user()->id }}</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-item">
                            <label class="form-label text-muted small mb-1">Account Status</label>
                            <div>
                                <span class="badge bg-success">
                                    <i class="ti ti-circle-check me-1"></i>Active
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="info-item">
                            <label class="form-label text-muted small mb-1">Last Login</label>
                            <div class="fw-semibold">
                                {{ Auth::user()->last_login_at ? Auth::user()->last_login_at->format('M j, Y g:i A') : 'Never' }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-item">
                            <label class="form-label text-muted small mb-1">Registration Date</label>
                            <div class="fw-semibold">{{ Auth::user()->created_at->format('M j, Y') }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Role & Permissions Card -->
        <div class="card mt-4">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="ti ti-shield me-2"></i>Role & Permissions
                </h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label text-muted small mb-1">Primary Role</label>
                            <div class="fw-semibold">{{ Auth::user()->getRoleNames()->first() ?? 'User' }}</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label text-muted small mb-1">Permission Count</label>
                            <div class="fw-semibold">{{ Auth::user()->getAllPermissions()->count() }} Permissions</div>
                        </div>
                    </div>
                </div>

                @if(Auth::user()->getAllPermissions()->count() > 0)
                <div class="mt-3">
                    <label class="form-label text-muted small mb-2">Available Permissions</label>
                    <div class="d-flex flex-wrap gap-2">
                        @foreach(Auth::user()->getAllPermissions()->take(10) as $permission)
                        <span class="badge bg-blue-lt">{{ $permission->name }}</span>
                        @endforeach
                        @if(Auth::user()->getAllPermissions()->count() > 10)
                        <span class="badge bg-secondary">+{{ Auth::user()->getAllPermissions()->count() - 10 }} more</span>
                        @endif
                    </div>
                </div>
                @endif
            </div>
        </div>

        <!-- System Information Card -->
        <div class="card mt-4">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="ti ti-device-desktop me-2"></i>System Information
                </h3>
            </div>
            <div class="card-body">
                <div class="alert alert-info">
                    <div class="d-flex">
                        <div>
                            <i class="ti ti-info-circle me-2"></i>
                        </div>
                        <div>
                            <strong>SSO Integration:</strong> Your profile is managed through the central authentication system.
                            Some information may be synchronized from the main identity provider.
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label text-muted small mb-1">Authentication Method</label>
                            <div class="fw-semibold">Single Sign-On (SSO)</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label text-muted small mb-1">Session Active Since</label>
                            <div class="fw-semibold">{{ \Carbon\Carbon::now()->subMinutes(30)->format('g:i A') }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Edit Profile Modal -->
<div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProfileModalLabel">Edit Profile Information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('profile.update') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Full Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                               id="name" name="name" value="{{ old('name', Auth::user()->name) }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                               id="email" name="email" value="{{ old('email', Auth::user()->email) }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone Number</label>
                        <input type="tel" class="form-control @error('phone') is-invalid @enderror"
                               id="phone" name="phone" value="{{ old('phone', Auth::user()->phone) }}">
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update Profile</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Profile picture upload preview (if you add this feature later)
    const profilePictureInput = document.getElementById('profile_picture');
    if (profilePictureInput) {
        profilePictureInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('profilePreview').src = e.target.result;
                }
                reader.readAsDataURL(file);
            }
        });
    }

    // Initialize tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    });
});
</script>
@endpush
