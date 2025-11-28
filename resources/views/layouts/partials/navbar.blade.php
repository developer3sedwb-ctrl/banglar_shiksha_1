
<style>
.blink-text {
    animation: blinkText 1.4s infinite;
}

@keyframes blinkText {
    0%   { color: #c71313ff; opacity: 1; }
    50%  { color: #28a745; opacity: 0.3; }
    100% { color: #f53900ff; opacity: 1; }
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
  <!-- EDUCATION FIRST (Right Side) -->
  <!-- <div class="d-none d-lg-flex"
      style="position: absolute; right: 120px; text-align: right; color: #04395e; align-items: center; gap: 8px;">

    <img src="/images/logo/shikha.png"
        alt="Education First Logo"
        style="height: 120px; width: auto;">
  </div> -->
</div>
    <ul class="navbar-nav flex-row align-items-center ms-auto">
      <!-- User Dropdown -->
      <li class="nav-item dropdown dropdown-user">
        <a class="nav-link dropdown-toggle hide-arrow" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          <div class="avatar avatar-online rounded-circle text-primary">
            <i class="bx bx-user fs-4"></i>
          </div>
        </a>

        <ul class="dropdown-menu dropdown-menu-end">
          <li>
            <a class="dropdown-item" href="#">
              <div class="d-flex">
                <div class="flex-grow-1">
                  <span class="fw-semibold d-block">ADHATA HIGH SCHOOL (H.S)</span>
                  <small class="text-muted">Head of Institution</small>
                </div>
              </div>
            </a>
          </li>

          <li><hr class="dropdown-divider"></li>

          <!-- Account Management Section -->


          <li>
            <a class="dropdown-item" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#updateContactUdinModal">
            <i class="bx bx-lock me-2"></i>
              Update Contact No. in UDIN
             </a>
          </li>

          <li>
          <a class="dropdown-item" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#changePasswordModal">
              <i class="bx bx-lock me-2"></i>
              Change Password
          </a>
          </li>

          <li><hr class="dropdown-divider"></li>

          <li>
           <a class="dropdown-item text-danger" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#logoutConfirmModal">
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

      <button type="button" class="btn-close position-absolute end-0 m-2"
              data-bs-dismiss="modal" aria-label="Close"></button>

      <div class="text-center p-4">
        <img src="{{ asset('images/logo/logout_icon.png') }}" width="80" height="80" alt="Logout Icon">
        <h5 class="fw-bold mt-3">Are you sure you want to Log Out?</h5>
        <p class="text-muted small">You will be signed out of your account.</p>
      </div>

      <div class="modal-footer justify-content-center">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
          <i class="bx bx-x-circle me-1"></i> Cancel
        </button>

        <a class="btn btn-danger" href="javescript;:"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="bx bx-power-off me-1"></i> Yes
        </a>
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
         <button type="button" class="btn-close position-absolute end-0 m-2" data-bs-dismiss="modal" aria-label="Close"></button>
        <div class="text-center p-3">
          <img src="{{ asset('images/logo/reset-password.png') }}"
              width="80" height="80"
              alt="Password Icon">
          <h5 class="fw-bold mt-2">Change Your Password</h5>
          <p class="text-muted small">Protect your personal data by keeping your password strong and updated.</p>
        </div>

        <div class="modal-body pt-0">
          <!-- Current Password -->
          <div class="mb-3">
            <label class="form-label fw-semibold">Current Password</label>
            <div class="input-group">
              <span class="input-group-text"><i class="bx bx-lock"></i></span>
              <input type="password" class="form-control password-field" placeholder="Enter current password">
              <span class="input-group-text toggle-password" style="cursor: pointer;">
                <i class="bx bx-hide"></i>
              </span>
            </div>
          </div>

          <!-- New Password -->
          <div class="mb-3">
            <label class="form-label fw-semibold">New Password</label>
            <div class="input-group">
              <span class="input-group-text"><i class="bx bx-key"></i></span>
              <input type="password" class="form-control password-field" placeholder="Enter new password">
              <span class="input-group-text toggle-password" style="cursor: pointer;">
                <i class="bx bx-hide"></i>
              </span>
            </div>
          </div>

          <!-- Confirm Password -->
          <div class="mb-3">
            <label class="form-label fw-semibold">Confirm Password</label>
            <div class="input-group">
              <span class="input-group-text"><i class="bx bx-check-shield"></i></span>
              <input type="password" class="form-control password-field" placeholder="Confirm new password">
              <span class="input-group-text toggle-password" style="cursor: pointer;">
                <i class="bx bx-hide"></i>
              </span>
            </div>
          </div>

        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
            <i class="bx bx-x-circle me-1"></i> Cancel
          </button>
          <button type="button" class="btn btn-success">
            <i class="bx bx-save me-1"></i> Save Changes
          </button>
        </div>

      </div>
    </div>
  </div>


<!-- ===================================Update Contact Details Udin===================================================== -->
 <div class="modal fade" id="updateContactUdinModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content shadow-lg">
         <button type="button" class="btn-close position-absolute end-0 m-2" data-bs-dismiss="modal" aria-label="Close"></button>

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
                <span class="form-control bg-light">121212121</span>
            </div>
          </div>

          <!-- Phone Number -->
          <div class="mb-3">
            <label class="form-label fw-semibold">Phone Number</label>
            <div class="input-group">
              <span class="input-group-text">
                <img src="{{ asset('images/logo/phone-no.png') }}" width="20">
              </span>
              <span class="form-control bg-light">121212121</span>
            </div>
          </div>

          <!-- Update Phone Button -->
        <div class="mb-3">
            <label class="form-label fw-semibold blink-text">
                Click here to update Phone Number to UDIN
            </label>
            <button type="button" class="btn btn-success w-100">
                <i class='bx bx-refresh-ccw'></i> Update Phone Number
            </button>
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





</script>


