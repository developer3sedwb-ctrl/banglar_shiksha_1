<style>
    .blink-text {
        animation: blinkText 1.4s infinite;
    }

    @keyframes blinkText {
        0% {
            color: #c71313ff;
            opacity: 1;
        }

        50% {
            color: #28a745;
            opacity: 0.3;
        }

        100% {
            color: #f53900ff;
            opacity: 1;
        }
    }
</style>

</style>
<nav class="layout-navbar container-fluid navbar navbar-expand-xl align-items-center sticky-navbar">
    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
            <i class="bx bx-menu bx-sm"></i>
        </a>
    </div>

    <div class="navbar-nav-right d-flex align-items-center w-100" id="navbar-collapse">
        <div class="navbar-nav flex-grow-1 d-flex justify-content-center align-items-center position-relative">

            <!-- Center Title Block -->
            <div class="text-center" style="line-height: 1.2;">
                <div style="font-size: 22px; font-weight: 700; color: white;">
                    School Education Department
                </div>
                <div style="font-size: 17px; font-weight: 400; color: white;">
                    Government of West Bengal
                </div>
            </div>
        </div>
        <ul class="navbar-nav flex-row align-items-center ms-auto">
            <!-- User Dropdown -->
            <li class="nav-item dropdown dropdown-user">
                <a class="nav-link dropdown-toggle hide-arrow" href="#" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <div class="avatar avatar-online rounded-circle text-primary">
                        <i class="bx bx-user fs-4"></i>
                    </div>
                </a>

                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item" href="#">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <span class="fw-semibold d-block" id="schoolName">
                                        {{ auth()->user()->school_name ?? 'ADHATA HIGH SCHOOL (H.S)' }}
                                    </span>
                                    <small class="text-muted" id="userRole">
                                        @auth
                                            @php
                                                $user = auth()->user();
                                                $roles = $user->roles ?? collect();
                                            @endphp

                                            @if ($roles->isNotEmpty())
                                                @foreach ($roles as $role)
                                                    <span class="badge bg-primary">{{ $role->name }}</span>
                                                @endforeach
                                            @else
                                                Head of Institution
                                            @endif
                                        @else
                                            Head of Institution
                                        @endauth
                                    </small>
                                    <small class="text-muted d-block mt-1" id="userName">
                                        <i class="bx bx-user me-1"></i>
                                        {{ auth()->user()->name ?? 'User Name' }}
                                    </small>
                                </div>
                            </div>
                        </a>
                    </li>

                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <!-- Account Management Section -->
                    <li>
                        <a class="dropdown-item" href="javascript:void(0)" data-bs-toggle="modal"
                            data-bs-target="#updateContactUdinModal">
                            <i class="bx bx-lock me-2"></i>
                            Update Contact No. in UDIN
                        </a>
                    </li>

                    <li>
                        <a class="dropdown-item" href="javascript:void(0)" data-bs-toggle="modal"
                            data-bs-target="#changePasswordModal">
                            <i class="bx bx-lock me-2"></i>
                            Change Password
                        </a>
                    </li>

                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item text-danger" href="javascript:void(0)" data-bs-toggle="modal"
                            data-bs-target="#logoutConfirmModal">
                            <i class="bx bx-power-off me-2"></i>
                            Log Out
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>


<!-- ======================= Logout Confirmation Modal ======================= -->
<div class="modal fade" id="logoutConfirmModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow-lg">

            <button type="button" class="btn-close position-absolute end-0 m-2" data-bs-dismiss="modal"
                aria-label="Close"></button>

            <div class="text-center p-4">
                <img src="{{ asset('images/logo/logout_icon.png') }}" width="80" height="80" alt="Logout Icon">
                <h5 class="fw-bold mt-3">Are you sure you want to Log Out?</h5>
                <p class="text-muted small">You will be signed out of your account.</p>
            </div>

            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="bx bx-x-circle me-1"></i> Cancel
                </button>

                <a class="btn btn-danger" href="javascript:void(0)"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="bx bx-power-off me-1"></i> Yes, Logout
                </a>
                <!-- Logout Form - You can change the action based on your route -->
                <form method="POST" action="{{ route('sso.logout') }}" id="logout-form" class="d-none">
                    @csrf
                </form>

            </div>
        </div>
    </div>
</div>

<!-- ==========================Change Password Modal============================== -->
<div class="modal fade" id="changePasswordModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow-lg">
            <button type="button" class="btn-close position-absolute end-0 m-2" data-bs-dismiss="modal"
                aria-label="Close"></button>
            <div class="text-center p-3">
                <img src="{{ asset('images/logo/reset-password.png') }}" width="80" height="80"
                    alt="Password Icon">
                <h5 class="fw-bold mt-2">Change Your Password</h5>
                <p class="text-muted small">Protect your personal data by keeping your password strong and updated.</p>
            </div>

            <div class="modal-body pt-0">
                <form id="changePasswordForm" action="{{ route('change.password') }}" method="POST">
                    @csrf
                    <!-- Current Password -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Current Password</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bx bx-lock"></i></span>
                            <input type="password" class="form-control password-field" name="current_password"
                                placeholder="Enter current password" required>
                            <span class="input-group-text toggle-password" style="cursor: pointer;">
                                <i class="bx bx-hide"></i>
                            </span>
                        </div>
                        <div class="invalid-feedback" id="currentPasswordError"></div>
                    </div>

                    <!-- New Password -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">New Password</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bx bx-key"></i></span>
                            <input type="password" class="form-control password-field" name="new_password"
                                placeholder="Enter new password" required>
                            <span class="input-group-text toggle-password" style="cursor: pointer;">
                                <i class="bx bx-hide"></i>
                            </span>
                        </div>
                        <div class="invalid-feedback" id="newPasswordError"></div>
                    </div>

                    <!-- Confirm Password -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Confirm Password</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bx bx-check-shield"></i></span>
                            <input type="password" class="form-control password-field"
                                name="new_password_confirmation" placeholder="Confirm new password" required>
                            <span class="input-group-text toggle-password" style="cursor: pointer;">
                                <i class="bx bx-hide"></i>
                            </span>
                        </div>
                        <div class="invalid-feedback" id="confirmPasswordError"></div>
                    </div>

                    <div class="alert alert-danger d-none" id="passwordErrorAlert"></div>
                    <div class="alert alert-success d-none" id="passwordSuccessAlert"></div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            <i class="bx bx-x-circle me-1"></i> Cancel
                        </button>
                        <button type="submit" class="btn btn-success">
                            <i class="bx bx-save me-1"></i> Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- ===================================Update Contact Details Udin===================================================== -->
<div class="modal fade" id="updateContactUdinModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow-lg">
            <button type="button" class="btn-close position-absolute end-0 m-2" data-bs-dismiss="modal"
                aria-label="Close"></button>

            <div class="text-center p-3">
                <img src="{{ asset('images/logo/update_contact_udin_logo.png') }}" width="80" height="80">
                <h5 class="fw-bold mt-2">Update Phone Number to UDIN</h5>
            </div>

            <div class="modal-body pt-0">
                <!-- AADHAAR Number -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">Aadhar Number</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <img src="{{ asset('images/logo/aadhaar-no.png') }}" width="20">
                        </span>
                        <span class="form-control bg-light" id="aadhaarNumber">
                            {{ auth()->user()->aadhaar_number ?? '121212121' }}
                        </span>
                    </div>
                </div>

                <!-- Phone Number -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">Phone Number</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <img src="{{ asset('images/logo/phone-no.png') }}" width="20">
                        </span>
                        <span class="form-control bg-light" id="phoneNumber">
                            {{ auth()->user()->phone_number ?? '121212121' }}
                        </span>
                    </div>
                </div>

                <!-- Update Phone Button -->
                <div class="mb-3">
                    <label class="form-label fw-semibold blink-text">
                        Click here to update Phone Number to UDIN
                    </label>
                    <button type="button" class="btn btn-success w-100" id="updatePhoneBtn">
                        <i class='bx bx-refresh-ccw'></i> Update Phone Number
                    </button>
                    <div class="alert alert-success mt-2 d-none" id="updateSuccessAlert"></div>
                    <div class="alert alert-danger mt-2 d-none" id="updateErrorAlert"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    <i class="bx bx-x-circle me-1"></i> Cancel
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Show / Hide Password Script -->
<script>
    document.querySelectorAll('.toggle-password').forEach(toggle => {
        toggle.addEventListener('click', function() {
            let input = this.parentElement.querySelector('.password-field');
            let icon = this.querySelector('i');

            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('bx-hide');
                icon.classList.add('bx-show');
            } else {
                input.type = 'password';
                icon.classList.remove('bx-show');
                icon.classList.add('bx-hide');
            }
        });
    });

    // Change Password Form Submission
    document.getElementById('changePasswordForm')?.addEventListener('submit', function(e) {
        e.preventDefault();

        const form = this;
        const submitBtn = form.querySelector('button[type="submit"]');
        const originalBtnText = submitBtn.innerHTML;

        submitBtn.innerHTML = '<i class="bx bx-loader bx-spin me-1"></i> Updating...';
        submitBtn.disabled = true;

        // Clear previous errors
        form.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
        document.getElementById('passwordErrorAlert').classList.add('d-none');
        document.getElementById('passwordSuccessAlert').classList.add('d-none');

        fetch(form.action, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                        'content')
                },
                body: JSON.stringify(Object.fromEntries(new FormData(form)))
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById('passwordSuccessAlert').textContent = data.message;
                    document.getElementById('passwordSuccessAlert').classList.remove('d-none');
                    form.reset();
                    setTimeout(() => {
                        bootstrap.Modal.getInstance(document.getElementById('changePasswordModal'))
                            .hide();
                    }, 2000);
                } else {
                    if (data.errors) {
                        Object.keys(data.errors).forEach(field => {
                            const input = form.querySelector(`[name="${field}"]`);
                            const errorDiv = document.getElementById(`${field}Error`);
                            if (input && errorDiv) {
                                input.classList.add('is-invalid');
                                errorDiv.textContent = data.errors[field][0];
                            }
                        });
                    } else {
                        document.getElementById('passwordErrorAlert').textContent = data.message;
                        document.getElementById('passwordErrorAlert').classList.remove('d-none');
                    }
                }
            })
            .catch(error => {
                console.error('Error:', error);
                document.getElementById('passwordErrorAlert').textContent =
                    'An error occurred. Please try again.';
                document.getElementById('passwordErrorAlert').classList.remove('d-none');
            })
            .finally(() => {
                submitBtn.innerHTML = originalBtnText;
                submitBtn.disabled = false;
            });
    });

    // Update Phone Number to UDIN
    document.getElementById('updatePhoneBtn')?.addEventListener('click', function() {
        const btn = this;
        const originalBtnText = btn.innerHTML;

        btn.innerHTML = '<i class="bx bx-loader bx-spin me-1"></i> Updating...';
        btn.disabled = true;

        // Clear previous alerts
        document.getElementById('updateSuccessAlert').classList.add('d-none');
        document.getElementById('updateErrorAlert').classList.add('d-none');

        // Simulate API call - replace with actual endpoint
        fetch('/api/update-phone-udin', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                        'content')
                },
                body: JSON.stringify({
                    aadhaar_number: document.getElementById('aadhaarNumber').textContent,
                    phone_number: document.getElementById('phoneNumber').textContent
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById('updateSuccessAlert').textContent = data.message;
                    document.getElementById('updateSuccessAlert').classList.remove('d-none');
                } else {
                    document.getElementById('updateErrorAlert').textContent = data.message;
                    document.getElementById('updateErrorAlert').classList.remove('d-none');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                document.getElementById('updateErrorAlert').textContent =
                    'An error occurred. Please try again.';
                document.getElementById('updateErrorAlert').classList.remove('d-none');
            })
            .finally(() => {
                btn.innerHTML = originalBtnText;
                btn.disabled = false;
            });
    });
</script>
