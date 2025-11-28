<footer class="app-footer bg-dark border-top py-2 mt-auto position-relative text-white">
  <div class="container text-center small">

    <!-- Centered content: column on xs, row from sm upwards -->
    <div class="d-inline-flex align-items-center gap-2 flex-wrap footer-main flex-column flex-sm-row justify-content-center">

      <!-- NIC Logo -->
      <a href="https://www.nic.gov.in/" target="_blank" class="text-decoration-none d-inline-block">
        <img src="{{ asset('images/footer-logo.png') }}" alt="NIC Logo" class="footer-logo">
      </a>

      <!-- Text with NIC link -->
      <span class="footer-text">
        Designed &amp; Developed by
        <a href="https://www.nic.gov.in/" target="_blank" class="text-decoration-none fw-semibold text-white hover-underline">
          National Informatics Centre
        </a>,
        West Bengal State Centre
      </span>

      <span class="d-none d-sm-inline">|</span>

      <!-- Legal Disclaimer -->
      <a href="https://banglarshiksha.wb.gov.in/legal_disclaimer"
         class="text-white fw-semibold text-decoration-none hover-underline">
        Legal Disclaimer
      </a>

      <span class="d-none d-sm-inline">|</span>

      <span class="d-none d-sm-inline">© {{ date('Y') }}</span>
    </div>

    <!-- For small screens show year under main content -->
    <div class="d-block d-sm-none mt-1 small text-white">
      © {{ date('Y') }}
    </div>

    <!-- Version: right-corner on md+; hidden on xs and sm -->
    <div class="position-absolute end-0 top-50 translate-middle-y me-3 d-none d-md-block text-white fw-semibold">
      Version 4.0
    </div>

    <!-- Version: shown centered on small screens under content -->
    <div class="d-block d-md-none mt-1 text-white small fw-semibold">
      Version 4.0
    </div>

  </div>
</footer>
