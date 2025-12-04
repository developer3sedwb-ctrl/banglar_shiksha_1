@props(['errors' => null, 'type' => 'all'])

@php
    $errorTypes = [
        'success' => ['alert-success', 'bx-check-circle', 'Success!'],
        'error' => ['alert-danger', 'bx-error', 'Error!'],
        'warning' => ['alert-warning', 'bx-error-circle', 'Warning!'],
        'info' => ['alert-info', 'bx-info-circle', 'Info'],
        'validation' => ['alert-danger', 'bx-shield-x', 'Validation Error'],
    ];
@endphp

<div class="error-container" id="errorDisplay">
    <!-- Success Messages -->
    @if (($type === 'all' || $type === 'success') && session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <div class="d-flex align-items-center">
                <i class='bx bx-check-circle fs-4 me-2'></i>
                <div class="flex-grow-1">
                    <strong class="me-2">Success!</strong>
                    <span>{{ session('success') }}</span>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        </div>
    @endif

    <!-- Error Messages -->
    @if (($type === 'all' || $type === 'error') && session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <div class="d-flex align-items-center">
                <i class='bx bx-error fs-4 me-2'></i>
                <div class="flex-grow-1">
                    <strong class="me-2">Error!</strong>
                    <span>{{ session('error') }}</span>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        </div>
    @endif

    <!-- Warning Messages -->
    @if (($type === 'all' || $type === 'warning') && session('warning'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <div class="d-flex align-items-center">
                <i class='bx bx-error-circle fs-4 me-2'></i>
                <div class="flex-grow-1">
                    <strong class="me-2">Warning!</strong>
                    <span>{{ session('warning') }}</span>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        </div>
    @endif

    <!-- Info Messages -->
    @if (($type === 'all' || $type === 'info') && session('info'))
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            <div class="d-flex align-items-center">
                <i class='bx bx-info-circle fs-4 me-2'></i>
                <div class="flex-grow-1">
                    <strong class="me-2">Info</strong>
                    <span>{{ session('info') }}</span>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        </div>
    @endif

    <!-- Validation Errors -->
    @if (($type === 'all' || $type === 'validation') && $errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <div class="d-flex align-items-center">
                <i class='bx bx-shield-x fs-4 me-2'></i>
                <div class="flex-grow-1">
                    <strong class="me-2">Validation Error!</strong>
                    <span>Please fix the following errors:</span>
                    <ul class="mb-0 mt-2 small">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        </div>
    @endif

    <!-- Custom Error Messages -->
    @if (session('custom_errors'))
        <div class="alert alert-secondary alert-dismissible fade show" role="alert">
            <div class="d-flex align-items-center">
                <i class='bx bx-message-error fs-4 me-2'></i>
                <div class="flex-grow-1">
                    <strong class="me-2">Notice</strong>
                    <ul class="mb-0 mt-2 small">
                        @foreach (session('custom_errors') as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        </div>
    @endif
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Auto-dismiss alerts after 5 seconds
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(alert => {
            setTimeout(() => {
                if (alert) {
                    const bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                }
            }, 5000);
        });

        // Store dismissed alerts in sessionStorage
        document.querySelectorAll('.alert .btn-close').forEach(button => {
            button.addEventListener('click', function() {
                const alert = this.closest('.alert');
                const alertId = 'alert-' + Date.now();
                alert.dataset.alertId = alertId;
                sessionStorage.setItem(alertId, 'dismissed');
            });
        });

        // Restore dismissed alerts on page load
        const storedAlerts = Object.keys(sessionStorage).filter(key => key.startsWith('alert-'));
        storedAlerts.forEach(alertId => {
            const alert = document.querySelector(`[data-alert-id="${alertId}"]`);
            if (alert) {
                alert.remove();
            }
        });
    });
</script>
@endpush
