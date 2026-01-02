@extends('layouts.app')

@section('title', 'Edit Student')

@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<div class="container-fluid full-width-content">

    <!-- PAGE HEADING -->
    <div class="page-header mb-3 d-flex justify-content-between align-items-center">
        <h4 class="fw-bold"><i class="bx bx-user"></i> Edit Student</h4>

        <a href="{{ route('dashboard') }}" class="btn btn-primary">
            <i class="bx bx-arrow-back"></i> Back
        </a>
    </div>

    <!-- ===================== STUDENT SEARCH ===================== -->
    <div class="card mb-3" id="studentSearchSection">
        <div class="card-header bg-primary text-white py-2">
            Student Search
        </div>

        <div class="card-body p-3">
            <div class="row g-2 align-items-center">
                <div class="col-md-10">
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="bx bx-id-card"></i>
                        </span>
                     <input type="text"
       class="form-control"
       id="student_code"
       placeholder="Enter Student Code"
       inputmode="numeric"
       autocomplete="off"
          maxlength="14">

                    </div>
                </div>

                <div class="col-md-2">
                    <button class="btn btn-primary w-100"
                            id="searchStudentBtn">
                        Search
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- ===================== STUDENT DETAILS (HIDDEN INITIALLY) ===================== -->
<div id="studentDetailsSection"
     class="{{ empty($showDetails) ? 'd-none' : '' }}">
        <div class="card card-full">
            <!-- TABS -->
            <div class="card-header border-bottom">
                @php
                    $current = $data['current_step'] ?? 1;
                @endphp

                <ul class="nav nav-tabs" id="studentTab" role="tablist">

                    <li class="nav-item">
                        <button class="nav-link active"
                                id="general_info-tab"
                                data-bs-toggle="tab"
                                data-bs-target="#general_info"
                                type="button">
                            General Info
                        </button>
                    </li>

                    <li class="nav-item">
                        <button class="nav-link"
                                data-bs-toggle="tab"
                                data-bs-target="#enrollment_details"
                                type="button">
                            Enrollment Details
                        </button>
                    </li>

                    <li class="nav-item">
                        <button class="nav-link"
                                data-bs-toggle="tab"
                                data-bs-target="#facility_other_dtls_tab"
                                type="button">
                            Facilities & Other Details
                        </button>
                    </li>

                    <li class="nav-item">
                        <button class="nav-link"
                                data-bs-toggle="tab"
                                data-bs-target="#vocational_tab"
                                type="button">
                            Vocational Details
                        </button>
                    </li>

                    <li class="nav-item">
                        <button class="nav-link"
                                data-bs-toggle="tab"
                                data-bs-target="#contact_info_tab"
                                type="button">
                            Contact Info
                        </button>
                    </li>

                    <li class="nav-item">
                        <button class="nav-link"
                                data-bs-toggle="tab"
                                data-bs-target="#bank_dtls_tab"
                                type="button">
                            Bank Details
                        </button>
                    </li>

                    <li class="nav-item">
                        <button class="nav-link"
                                data-bs-toggle="tab"
                                data-bs-target="#additional_dtls_tab"
                                type="button">
                            Additional Details
                        </button>
                    </li>
                </ul>
            </div>

            <!-- TAB CONTENT -->
            <div class="card-body">
                <div class="tab-content">
                    @include('src.modules.student_entry_update.student_edit_tabs.general-info')
                    @include('src.modules.student_entry_update.student_edit_tabs.enrollment-details')
                    @include('src.modules.student_entry_update.student_edit_tabs.facility-details')
                    @include('src.modules.student_entry_update.student_edit_tabs.vocational-details')
                    @include('src.modules.student_entry_update.student_edit_tabs.contact-info')
                    @include('src.modules.student_entry_update.student_edit_tabs.bank-details')
                    @include('src.modules.student_entry_update.student_edit_tabs.additional-details')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
@push('scripts')

<script>
document.getElementById('student_code').addEventListener('input', function () {
    // allow only digits
    this.value = this.value.replace(/[^0-9]/g, '');

    // limit to 14 digits
    if (this.value.length > 14) {
        this.value = this.value.slice(0, 14);
    }
});


$(document).ready(function () {

    $('#searchStudentBtn').on('click', function () {

        let studentCode = $('#student_code').val().trim();
        if (!studentCode) {
            alert('Please enter Student Code');
            return;
        }

        // POST to SAME route for encryption
        $.ajax({
            url: "{{ route('student.edit') }}",
            type: "POST",
            dataType: "json",
            data: {
                student_code: studentCode,
                _token: "{{ csrf_token() }}"
            },
            success: function (res) {

                if (!res.status) {
                    alert(res.message);
                    return;
                }

                // redirect with encrypted code
                let url = "{{ route('student.edit') }}" +
                          "?student_code=" + encodeURIComponent(res.encrypted);

                window.location.href = url;
            },
            error: function () {
                alert('Server error');
            }
        });
    });

    // ENTER KEY SUPPORT
    $('#student_code').on('keypress', function (e) {
        if (e.which === 13) {
            $('#searchStudentBtn').click();
        }
    });

});
</script>


@endpush
@endsection
