@props(['position' => 'top-end'])

@php
    $positions = [
        'top-start' => 'top-0 start-0',
        'top-center' => 'top-0 start-50 translate-middle-x',
        'top-end' => 'top-0 end-0',
        'middle-start' => 'top-50 start-0 translate-middle-y',
        'middle-center' => 'top-50 start-50 translate-middle',
        'middle-end' => 'top-50 end-0 translate-middle-y',
        'bottom-start' => 'bottom-0 start-0',
        'bottom-center' => 'bottom-0 start-50 translate-middle-x',
        'bottom-end' => 'bottom-0 end-0',
    ];

    $positionClass = $positions[$position] ?? $positions['top-end'];
@endphp

<div class="toast-container position-fixed {{ $positionClass }} p-3" id="toastContainer">
    <!-- Success Toast -->
    @if (session('toast_success'))
        <div class="toast align-items-center text-bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="5000">
            <div class="d-flex">
                <div class="toast-body">
                    <i class='bx bx-check-circle me-2'></i>
                    {{ session('toast_success') }}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>
        </div>
    @endif

    <!-- Error Toast -->
    @if (session('toast_error'))
        <div class="toast align-items-center text-bg-danger border-0" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="5000">
            <div class="d-flex">
                <div class="toast-body">
                    <i class='bx bx-error me-2'></i>
                    {{ session('toast_error') }}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>
        </div>
    @endif

    <!-- Warning Toast -->
    @if (session('toast_warning'))
        <div class="toast align-items-center text-bg-warning border-0" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="5000">
            <div class="d-flex">
                <div class="toast-body">
                    <i class='bx bx-error-circle me-2'></i>
                    {{ session('toast_warning') }}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>
        </div>
    @endif

    <!-- Info Toast -->
    @if (session('toast_info'))
        <div class="toast align-items-center text-bg-info border-0" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="5000">
            <div class="d-flex">
                <div class="toast-body">
                    <i class='bx bx-info-circle me-2'></i>
                    {{ session('toast_info') }}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>
        </div>
    @endif
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize all toasts
        const toastElList = document.querySelectorAll('.toast');
        const toastList = [...toastElList].map(toastEl => new bootstrap.Toast(toastEl));

        // Show all toasts
        toastList.forEach(toast => toast.show());

        // Auto-hide after 5 seconds if not already
        toastList.forEach(toast => {
            setTimeout(() => {
                if (toast._element && toast._element.classList.contains('show')) {
                    toast.hide();
                }
            }, 5000);
        });
    });
</script>
@endpush
