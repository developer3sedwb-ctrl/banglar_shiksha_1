@extends('layouts.app')

@section('title', 'Add Student')

@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
@php
    $basic = $data['basic_info'] ?? [];
    $enrollment_info = $data['enrollment_info'] ?? [];
    $student_contact_info = $data['student_contact'] ?? [];

    $student_bank = $data['student_bank_details'] ?? [];

    $additional_info = $data['student_additional_details'] ?? []; 
@endphp

  <!-- @dump($additional_info) -->
  @php
    $dropdowns = config('student');

    $gender_master = DB::table('bs_gender_master')->pluck('name', 'id')->toArray();
    $mother_tongue_master = DB::table('bs_mother_tongue_master')->pluck('name', 'id')->toArray();
    $social_category_master = DB::table('bs_social_category_master')->pluck('name', 'id')->toArray();
            
    $religion_master = DB::table('bs_religion_master')->pluck('name', 'id')->toArray();
    $nationality_master = DB::table('bs_nationality_master')->pluck('name', 'id')->toArray();
    $blood_group_master = DB::table('bs_blood_group_master')->pluck('name', 'id')->toArray();  

    $guardian_relationship_master = DB::table('bs_guardian_relationship_master')->pluck('name', 'id')->toArray();
    $income_master = DB::table('bs_income_master')->pluck('name', 'id')->toArray();
    $guardian_qualification_master = DB::table('bs_guardian_qualification_master')->pluck('name', 'id')->toArray();  
    $bs_stu_disability_type_master = DB::table('bs_stu_disability_type_master')->pluck('name', 'id')->toArray();  
    $bs_child_mainstreamed_master = DB::table('bs_child_mainstreamed_master')->pluck('name', 'id')->toArray();  

   //============Start =====Enrollmnent==================== 

    $bs_previous_schooling_type_master = DB::table('bs_previous_schooling_type_master')->pluck('name', 'id')->toArray();  
    $bs_stu_appeared_master = DB::table('bs_stu_appeared_master')->pluck('name', 'id')->toArray(); 
    $bs_class_master = DB::table('bs_class_master')->pluck('name', 'id')->toArray(); 

    $bs_class_section_master = DB::table('bs_class_section_master')->pluck('name', 'id')->toArray(); 

    $bs_stream_master = DB::table('bs_stream_master')->pluck('name', 'id')->toArray(); 
 
    //============================================
    $bs_school_medium = DB::table('bs_school_master as sm')
    ->join('bs_medium_master as mm', 'mm.id', '=', 'sm.id')
    ->where('mm.id', 1)
    ->pluck('mm.name', 'mm.id')
    ->toArray();

    $bs_school_classwise_section = DB::table('bs_school_classwise_section')->pluck('class_code_fk', 'id')->toArray();  

    $bs_admission_type_master = DB::table('bs_admission_type_master')->pluck('name', 'id')->toArray(); 
      //========END=========Enrollmnent==================== 

        //========Start=========Contact ==================== 


    $bs_country_master = DB::table('bs_country_master')->pluck('name', 'id')->toArray(); 
    $state_master = DB::table('bs_state_master')->pluck('name', 'id')->toArray(); 
    $district_master = DB::table('bs_district_master')->pluck('name', 'id')->toArray(); 
    $block_munc_corp_master = DB::table('bs_block_munc_corp_master')->pluck('name', 'id')->toArray(); 

    //===========Bank=================
    $bank_branch_master = DB::table('bs_bank_branch_master')->pluck('name', 'id')->toArray(); 
    $bank_code_name_master = DB::table('bs_bank_code_name_master')->pluck('name', 'id')->toArray(); 

    
//================================================
//===============Addtional=================
  
    $bs_student_residence_to_school_distance = DB::table('bs_student_residence_to_school_distance')->pluck('name', 'id')->toArray(); 
  //==============================================
    $genders = $gender_master;
    $mother_tongue = $mother_tongue_master;

    $social_category = $social_category_master;
    $religion = $religion_master;

    $nationality = $nationality_master;
    $blood_group = $blood_group_master;

    $guardian_relationship = $guardian_relationship_master;
    $income = $income_master;

    $guardian_qualification = $guardian_qualification_master;
    $stu_disability_type_master = $bs_stu_disability_type_master;

    $child_mainstreamed_master = $bs_child_mainstreamed_master;
    $class_master = $bs_class_master;

    $school_classwise_section = $bs_school_classwise_section;

 //======Start===========Enrollmnent==================== 


    $previous_schooling_type_master = $bs_previous_schooling_type_master;
    $stu_appeared_master = $bs_stu_appeared_master;
    $class_section_master = $bs_class_section_master;
    $stream_master = $bs_stream_master;
    $school_medium = $bs_school_medium;

    $admission_type_master = $bs_admission_type_master;
@endphp

<div class="container-fluid full-width-content">
      <!-- PAGE HEADING -->
  <div class="page-header mb-3 d-flex justify-content-between align-items-center">
        <div class="page-header mb-3">
          <h4 class="fw-bold"><i class="bx bx-user"></i> Add Student</h4>
        </div>
          <div class="d-flex gap-2">
          <a href="" 
            class="d-flex align-items-center gap-2 p-2 rounded border text-decoration-none"
            data-bs-toggle="tooltip" 
            title="Download Student DCF">
              <span class="d-inline d-md-none"></span>
              <img src="{{ asset('images/pdf.png') }}" alt="PDF" style="height: 24px;">
              <span class="fw-semibold d-none d-md-inline"> Guideline</span>
          </a>
          <!-- ============================================= -->
            {{-- Bulk Upload Button --}}
            <a href="{{ route('student.bulk.upload') }}" class="btn btn-success">

                {{-- MOBILE: show "Bulk" --}}
                <span class="d-inline d-md-none">Bulk Upload</span>

                {{-- DESKTOP: show icon + full text --}}
                <span class="d-none d-md-inline">
                    <i class="bx bx-upload"></i>
                    Student Bulk Upload
                </span>
            </a>

            {{-- Back Button --}}
            <a href="{{ route('dashboard') }}" class="btn btn-primary">

                {{-- MOBILE: icon only --}}
                <span class="d-inline d-md-none">
                    <i class="bx bx-arrow-back"></i>
                </span>
                {{-- DESKTOP: icon + full text --}}
                <span class="d-none d-md-inline">
                    <i class="bx bx-arrow-back"></i>
                    Back
                </span>
            </a>
          </div>
        </div>
  
    <div class="alert-container">
          @if(isset($data['current_step']) && $data['current_step'] >= 1)
        <div class="entry-alert-box">
            <span class="entry-alert-text">
                <i class="bx bx-info-circle"></i>
                <strong> Resume Entry ?</strong>
                <span class="d-none d-md-inline">
                    You have a student entry that is still incomplete at Step {{ $data['current_step'] }}.
                </span>
            </span>

            <div class="entry-alert-actions">
            <button id="resumeEntryBtn" class="btn btn-success">

              {{-- MOBILE TEXT ONLY --}}
              <span class="d-inline d-md-none">
                  <i class="bx bx-play-circle"></i> Resume
              </span>

              {{-- DESKTOP FULL TEXT --}}
              <span class="d-none d-md-inline">
                  <i class="bx bx-play-circle"></i>
                  Resume from Step {{ $data['current_step'] }}
              </span>
            </button>


              <button id="startNewEntryBtn" class="btn btn-danger">

                {{-- ICON (mobile only) --}}
                <span class="d-inline d-md-none">
                    <i class="bx bx-trash"></i> 
                </span>

                {{-- FULL TEXT (desktop only) --}}
                <span class="d-none d-md-inline">
                    Start New Entry
                </span>

              </button>

            </div>
        </div>
      @endif
    </div>

    <!-- CARD WITH TABS -->
     <div class="card card-full">


      <div class="card-header d-flex align-items-center justify-content-between border-bottom">
        @php
            $current = $data['current_step'] ?? 1;
        @endphp

        <ul class="nav nav-tabs mb-0" id="studentTab" role="tablist">

            {{-- STEP 1 --}}
            <li class="nav-item" role="presentation">
                <button class="nav-link {{ $current >= 1 ? '' : '' }} active"
                    id="general_info-tab" data-bs-toggle="tab"
                    data-bs-target="#general_info" type="button" role="tab">
                    General Info
                </button>
            </li>

            {{-- STEP 2 --}}
            <li class="nav-item" role="presentation">
                <button class="nav-link {{ $current >= 2 ? '' : '' }}"
                    id="enrollment_details-tab" data-bs-toggle="tab"
                    data-bs-target="#enrollment_details" type="button" role="tab">
                    Enrollment Details
                </button>
            </li>

            {{-- STEP 3 --}}
            <li class="nav-item" role="presentation">
                <button class="nav-link {{ $current >= 3 ? '' : '' }}"
                    id="facility-other-dtls-tab" data-bs-toggle="tab"
                    data-bs-target="#facility_other_dtls_tab" type="button" role="tab">
                    Facilities & Other Details
                </button>
            </li>

            {{-- STEP 4 --}}
            <li class="nav-item" role="presentation">
                <button class="nav-link {{ $current >= 4 ? '' : '' }}"
                    id="vocational-tab" data-bs-toggle="tab"
                    data-bs-target="#vocational_tab" type="button" role="tab">
                    Vocational Details
                </button>
            </li>

            {{-- STEP 5 --}}
            <li class="nav-item" role="presentation">
                <button class="nav-link {{ $current >= 5 ? '' : '' }}"
                    id="contact_info_tab-tab" data-bs-toggle="tab"
                    data-bs-target="#contact_info_tab" type="button" role="tab">
                    Contact Info
                </button>
            </li>

            {{-- STEP 6 --}}
            <li class="nav-item" role="presentation">
                <button class="nav-link {{ $current >= 6 ? '' : '' }}"
                    id="bank_dtls-tab" data-bs-toggle="tab"
                    data-bs-target="#bank_dtls_tab" type="button" role="tab">
                    Bank Details
                </button>
            </li>
              {{-- STEP 7 --}}
            <li class="nav-item" role="presentation">
                <button class="nav-link {{ $current >= 7 ? '' : '' }}"
                    id="additional_dtls" data-bs-toggle="tab"
                    data-bs-target="#additional_dtls_tab" type="button" role="tab">
                    Additional Details
                </button>
            </li>
        </ul>
      </div>

      <div class="card-body">
        <div class="tab-content" id="studentTabContent">
          @include('src.modules.student_entry_update.student_entry_tabs.general-info')
          @include('src.modules.student_entry_update.student_entry_tabs.enrollment-details')
          @include('src.modules.student_entry_update.student_entry_tabs.facility-details')
          @include('src.modules.student_entry_update.student_entry_tabs.vocational-details')
          @include('src.modules.student_entry_update.student_entry_tabs.contact-info')
          @include('src.modules.student_entry_update.student_entry_tabs.bank-details')
          @include('src.modules.student_entry_update.student_entry_tabs.additional-details')
      </div>
    </div>
  </div>



  <!-- ==================DELETE PREVIOUS STUDENT ENTRY MODAL=========Subhajit Das===================== -->
  <div class="modal fade" id="delete_previous_student_entry" tabindex="-1">
      <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content shadow-lg">
              
              <button type="button" class="btn-close position-absolute end-0 m-2"
                  data-bs-dismiss="modal" aria-label="Close"></button>

              <div class="text-center p-3">
                  <img src="{{ asset('images/delete_student.png') }}"
                      width="80" height="80" alt="Icon">
                  <h5 class="fw-bold mt-2">
                  Are you sure you want to proceed?
                  </h5>
                  <h3 class="text-muted small"> The previous entry will be permanently deleted.</h3>
              </div>

              <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="confirmDeleteEntry">
                      <i class="bx bx-trash me-1"></i> Delete Previous Entry
                  </button>

                  <button type="button" class="btn btn-outline-secondary"
                      data-bs-dismiss="modal">
                      <i class="bx bx-x-circle me-1"></i> Cancel
                  </button>
              </div>

          </div>
      </div>
  </div>


  <!-- ================Final Submit Preview  MODAL= Subhajit Das============================= -->
  <div class="modal fade" id="previewModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title preview-title">
            <i class="bi bi-eye-fill me-2"></i> Preview
          </h5>

          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="previewModalBody">
          <!-- JS will fill this -->
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" data-bs-dismiss="modal">Final Submit</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <!-- =================END Final Submit Preview  MODAL======================================= -->
@endsection

@section('styles')
<!-- add custom styles here if needed -->
@endsection

@section('scripts')
@push('scripts')
<script src="{{ asset('assets/js/common.js') }}"></script>
<script>
  $(document).ready(function() {


  // =========Download Student DCF Tooltip===========================
  var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
  var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl)
  })



  // =============Store Bank Details======================

  $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#bank_details_of_student').on('submit', function (e) {
        e.preventDefault(); // stop normal form submit

        let form = $(this);

        $.ajax({
            url: form.attr('action'),      // "{{ route('student.bank_details_of_student') }}"
            type: 'POST',
            data: form.serialize(),
            dataType: 'json',              // expect JSON from controller
            beforeSend: function () {
                // Optional: disable button / show loader
                form.find('button[type="submit"]').prop('disabled', true).text('Saving...');
            },
            success: function (response) {
                // Example: show success message
                // You can customize this as per your UI
                alert(response.message || 'Bank details saved successfully!');
                document.dispatchEvent(new CustomEvent('tabSaved', { detail: { tab: 6 } }));
                
                // Optional: move to next tab, reset form, etc.
                // $('#next_tab_btn').click();
            },
            error: function (xhr) {
                // Basic error handling
                if (xhr.status === 422) {
                    // Laravel validation errors
                    let errors = xhr.responseJSON.errors;
                    let messages = [];

                    $.each(errors, function (key, val) {
                        messages.push(val[0]);
                    });

                    alert(messages.join('\n'));
                } else {
                    alert('Something went wrong. Please try again.');
                }
            },
            complete: function () {
                form.find('button[type="submit"]').prop('disabled', false).text('Save Details');
            }
        });
    });

  // ==========================================




  // =============================
    $('.select2').select2({
        width: '100%' // Tells JS to fill the container we defined in CSS
    });


    $("form").on("submit", function(e) {
    e.preventDefault(); // Stop page refresh always
    });

  });



  // =========================================================================
$(document).ready(function () {

   

    // Run when user changes the dropdown
    $('#admission_status_prev').on('change', function () {
        togglePrevFields($(this).val());
    });

    // 👇 IMPORTANT: run once for the value loaded from DB
    togglePrevFields($('#admission_status_prev').val());



        function toggleExamFields(value) {
        value = (value || '').toString();

        if (value === "1") {
            $('#previous_class_studied_result_examination').show();
            $('#percentage_of_overall_marks_section').show();
        } else {
            $('#previous_class_studied_result_examination').hide();
            $('#percentage_of_overall_marks_section').hide();

            // Clear fields
            $('#previous_class_result_examination').val('');
            $('#percentage_of_overall_marks').val('');
        }
    }

    // Fire when user changes the dropdown
    $('#prev_class_appeared_exam').on('change', function () {
        toggleExamFields($(this).val());
    });

    // 🔥 IMPORTANT: Fire once on page load (DB value)
    toggleExamFields($('#prev_class_appeared_exam').val());
});


    // ================================
  $(function() {

      function clearInlineErrors() {
        $('.is-invalid').removeClass('is-invalid');
        $('.invalid-feedback.js-dynamic').remove();
      }

      function getCsrfToken() {
        return $('meta[name="csrf-token"]').attr('content') || '';
      }


      // ==================================
      // Student Basic  Details Save 
      $('#basic_info_save_btn').off('click').on('click', function () {
        var $btn = $(this);
        var $basicForm = $('#basic_info_of_student');
        var $enrollForm = $('#student_enrollment_details'); // must exist (see blade change)

        clearInlineErrors();

        $btn.prop('disabled', true).text('Saving...');

        // Start with FormData from basic info form
        var formData = new FormData($basicForm[0]);

      

        // Debug: list entries (optional, safe to remove in production)
        console.log("------ MERGED FORM DATA ------");
        for (let pair of formData.entries()) {
          console.log(pair[0] + ':', pair[1]);
        }
        console.log("------ END MERGED FORM DATA ------");

        $.ajax({
          url: "{{ route('student.store_student_entry_basic_details') }}",

          type: "POST",
          data: formData,
          processData: false,
          contentType: false,
          dataType: 'json',
          headers: {
            'X-CSRF-TOKEN': getCsrfToken(),
            'Accept': 'application/json'
          },
          // timeout: 20000,

          beforeSend: function() {
          console.log('Sending merged AJAX to {{ route("student.store_student_entry_basic_details") }}');
          },

          success: function (res, textStatus, jqXHR) {
            console.log("AJAX success", res);

            if (res && res.success) {
              if (window.toastr) {
                toastr.success(res.message || 'Saved successfully');
                
              } else {
                alert(res.message || 'Saved successfully');
              }
             document.dispatchEvent(new CustomEvent('tabSaved', { detail: { tab: 1 } }));
              // Move to enrollment details tab after successful save
              var $nextTabBtn = $('#enrollment_details-tab');
              if ($nextTabBtn.length) {
                $nextTabBtn.tab('show');
              }
            } else {
              console.warn('Unexpected body', res);
              alert(res.message || 'Saved but unexpected response. Check console.');
            }

            $btn.prop('disabled', false).text('Next');
          },

          error: function (jqXHR, textStatus, errorThrown) {
            console.error("AJAX error. Status:", jqXHR.status, errorThrown);

            clearInlineErrors();

            if (jqXHR.status === 422) {
              var resp = jqXHR.responseJSON || {};
              var errors = resp.errors || {};

              $.each(errors, function(field, messages) {
                var selector = '[name="'+field+'"]';
                var $el = $(selector);

                if (!$el.length) {
                  var alt = field.replace(/\.(\w+)/g, '[$1]');
                  $el = $('[name="'+alt+'"]');
                }

                if ($el.length) {
                  $el.addClass('is-invalid');
                  var $group = $el.closest('.input-group');
                  var messageHtml = '<div class="invalid-feedback d-block js-dynamic">' + (messages[0] || '') + '</div>';

                  if ($group.length) {
                    $group.after(messageHtml);
                  } else {
                    $el.after(messageHtml);
                  }
                } else {
                  console.warn('Field not found in DOM for error:', field, messages);
                }
              });

              var $first = $('.is-invalid').first();
              if ($first.length) {
                $('html, body').animate({ scrollTop: $first.offset().top - 90 }, 400);
                $first.focus();
              }
            } else if (jqXHR.status === 419) {
              alert('Session expired (419). Please reload the page and try again.');
            } else {
              alert('Something went wrong. See console & network tab for details.');
            }

            $btn.prop('disabled', false).text('Next');
          },

          complete: function() {
            console.log('AJAX complete');
          }
        });
      });


     // ==================================
      // Student Enrollment Details Save 
    $('#enrollment_details_save_btn').off('click').on('click', function () {
      var $btn = $(this);
      var $enrollForm = $('#student_enrollment_details');

      clearInlineErrors();

      $btn.prop('disabled', true).text('Saving...');

      // Build FormData only from enrollment form
      var formData = new FormData($enrollForm[0]);

      // Ensure a single CSRF token (optional, but avoids duplicate _token entries)
      formData.delete('_token');
      formData.append('_token', getCsrfToken());

      // Debug logging (optional)
      console.log("------ ENROLLMENT FORM DATA ------");
      for (let pair of formData.entries()) {
        console.log(pair[0] + ':', pair[1]);
      }
      console.log("------ END ENROLLMENT FORM DATA ------");

      $.ajax({
        url: "{{ route('student.store_enrollment_details') }}",
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,
        dataType: 'json',
        headers: {
          'X-CSRF-TOKEN': getCsrfToken(),
          'Accept': 'application/json'
        },
        // timeout: 20000,

        beforeSend: function () {
          console.log('Sending enrollment AJAX to {{ route("student.store_enrollment_details") }}');
        },

        success: function (res) {
          if (res && res.success) {
            if (window.toastr) toastr.success(res.message || 'Enrollment saved.');
            else alert(res.message || 'Enrollment saved.');

            // If you want to switch tabs programmatically after save, do it here:
          document.dispatchEvent(new CustomEvent('tabSaved', { detail: { tab: 2 } }));
          document.querySelector('[data-bs-target="#facility_other_dtls_tab"]').click();
          } else {
            console.warn('Unexpected body', res);
            alert(res.message || 'Saved but unexpected response.');
          }

          $btn.prop('disabled', false).text('Next');
        },

        error: function (jqXHR) {
          clearInlineErrors();

          if (jqXHR.status === 422) {
            var resp = jqXHR.responseJSON || {};
            var errors = resp.errors || {};

            $.each(errors, function (field, messages) {
              var selector = '[name="' + field + '"]';
              var $el = $(selector);
              if (!$el.length) {
                var alt = field.replace(/\.(\w+)/g, '[$1]');
                $el = $('[name="' + alt + '"]');
              }
              if ($el.length) {
                $el.addClass('is-invalid');
                var $group = $el.closest('.input-group');
                var messageHtml = '<div class="invalid-feedback d-block js-dynamic">' + (messages[0] || '') + '</div>';
                if ($group.length) $group.after(messageHtml); else $el.after(messageHtml);
              } else {
                console.warn('Field not found for error:', field, messages);
              }
            });

            var $first = $('.is-invalid').first();
            if ($first.length) {
              $('html, body').animate({ scrollTop: $first.offset().top - 90 }, 400);
              $first.focus();
            }
          } else if (jqXHR.status === 419) {
            alert('Session expired (419). Please reload the page and try again.');
          } else {
            alert('Something went wrong. See console & network tab for details.');
          }

          $btn.prop('disabled', false).text('Next');
        },

        complete: function () {
          console.log('Enrollment AJAX complete');
        }
      });
    });

    // ================================
   // Student Contact Details Save 
    (function($) {
      function clearInlineErrors() {
        $('.is-invalid').removeClass('is-invalid');
        $('.invalid-feedback.js-dynamic').remove();
      }
      function getCsrfToken() {
        return $('meta[name="csrf-token"]').attr('content') || '';
      }

      $('#contact_info_save_btn').off('click').on('click', function () {
        var $btn = $(this);
        var $form = $('#contact_info_of_student_and_guardian');

        clearInlineErrors();
        $btn.prop('disabled', true).text('Saving...');

        var formData = new FormData($form[0]);

        // ensure single _token
        formData.delete('_token');
        formData.append('_token', getCsrfToken());

        console.log("------ CONTACT FORM DATA ------");
        for (let pair of formData.entries()) {
          console.log(pair[0] + ':', pair[1]);
        }
        console.log("------ END CONTACT FORM DATA ------");

        $.ajax({
          url: "{{ route('student.store_student_entry_contact_details') }}", // fixed
          type: "POST",
          data: formData,
          processData: false,
          contentType: false,
          dataType: 'json',
          headers: {
            'X-CSRF-TOKEN': getCsrfToken(),
            'Accept': 'application/json'
          },
          // timeout: 20000,
          beforeSend: function () {
            console.log('Sending contact AJAX to {{ route("student.store_student_entry_contact_details") }}');
          },
          success: function (res) {
            if (res && res.success) {
              if (window.toastr) toastr.success(res.message || 'Contact info saved.');
              else alert(res.message || 'Contact info saved.');
        
              document.dispatchEvent(new CustomEvent('tabSaved', { detail: { tab: 5} }));
              // maybe move to next tab or reset
            } else {
              console.warn('Unexpected body', res);
              alert(res.message || 'Saved but unexpected response.');
            }
            $btn.prop('disabled', false).text('Next');
          },
          error: function (jqXHR) {
            clearInlineErrors();

            if (jqXHR.status === 422) {
              var resp = jqXHR.responseJSON || {};
              var errors = resp.errors || {};
              $.each(errors, function (field, messages) {
                var selector = '[name="' + field + '"]';
                var $el = $(selector);
                if (!$el.length) {
                  var alt = field.replace(/\.(\w+)/g, '[$1]');
                  $el = $('[name="' + alt + '"]');
                }
                if ($el.length) {
                  $el.addClass('is-invalid');
                  var $group = $el.closest('.input-group');
                  var messageHtml = '<div class="invalid-feedback d-block js-dynamic">' + (messages[0] || '') + '</div>';
                  if ($group.length) $group.after(messageHtml); else $el.after(messageHtml);
                } else {
                  console.warn('Field not found for error:', field, messages);
                }
              });

              var $first = $('.is-invalid').first();
              if ($first.length) {
                $('html, body').animate({ scrollTop: $first.offset().top - 90 }, 400);
                $first.focus();
              }
            } else if (jqXHR.status === 419) {
              alert('Session expired (419). Please reload the page and try again.');
            } else {
              alert('Something went wrong. See console & network tab for details.');
            }

            $btn.prop('disabled', false).text('Next');
          },
          complete: function () {
            console.log('Contact AJAX complete');
          }
        });
      });
    })(jQuery);

    // ----------------------------------------
      // Keep your clickable date-group behavior unchanged
      const dobGroup = document.getElementById('dobGroup');
      const dobField = document.getElementById('dobField');
    if (dobGroup && dobField) {
      dobGroup.addEventListener('click', () => {
        if (typeof dobField.showPicker === 'function') {
          dobField.showPicker();
        } else {
          dobField.focus();
        }
      });
    }
  });

  // ------------------------------
  // CENTRAL SCHOLARSHIP
  // ------------------------------
  function loadJobRoles(sector_id, selected_job_role = null) {

      let url = "{{ route('get.jobrole.by_vocational_trade.sector') }}";

      sendRequest(url, "POST", null, { sector_id: sector_id })
          .then(res => {

              let jobDropdown = $("#job_role");
              jobDropdown.html('<option value="">-- Select Job Role --</option>');

              if (!res || !res.data) return;

              $.each(res.data, function (i, item) {
                  let selected = (item.id == selected_job_role) ? "selected" : "";
                  jobDropdown.append(`<option value="${item.id}" ${selected}>${item.name}</option>`);
              });

          })
          .catch(err => console.error("Error loading job roles:", err));
  }

  document.addEventListener("DOMContentLoaded", function () {

    let v = @json($data['vocational']);
    // Helper function: Load job roles and preselect if needed

    if (!v) return; // nothing to preload

    // Exposure
    $("#exposure_vocational_activities_y_n").val(v.exposure);

    // Undertook?
    $("#undertook_vocational_course").val(v.undertook).trigger("change");

    if (v.undertook == 1) {
        $("#vocational_course_div").removeClass("d-none");

        // 1️⃣ Load trade sectors
        let trade_sector_url = "{{ route('get.vocational.trade.sector') }}";

        sendRequest(trade_sector_url, "GET")
            .then(res => {
                if (!res || !res.data) return;

                let dropdown = $("#trade_sector");
                dropdown.empty().append('<option value="">-- Select Trade Sector --</option>');

                $.each(res.data, function (i, item) {
                    let selected = (item.id == v.trade_sector) ? "selected" : "";
                    dropdown.append(`<option value="${item.id}" ${selected}>${item.name}</option>`);
                });

                // 2️⃣ Load corresponding job roles
                loadJobRoles(v.trade_sector, v.job_role);
            });
    }
    // Hours
    $("#theory_hours").val(v.theory_hours);
    $("#practical_hours").val(v.practical_hours);
    $("#industry_hours").val(v.industry_hours);
    $("#field_visit_hours").val(v.field_visit_hours);

    // Exam + Marks
    $("#appeared_exam").val(v.appeared_exam).trigger("change");
    $("#marks_obtained").val(v.marks_obtained);

    // Placement + apprenticeship
    $("#placement_applied").val(v.placement_applied);
    $("#apprenticeship_applied").val(v.apprenticeship_applied);

    // NSQF + employment
    $("#nsqf_level").val(v.nsqf_level);
    $("#employment_status").val(v.employment_status).trigger("change");

    // Salary offered
    $("#salary_offered").val(v.salary_offered);

  });

  $("#central_scholarship").on("change", function () {
    if ($(this).val() === "1") {

      $("#central_scholarship_name").attr("required", true);
      $("#central_scholarship_amount").attr("required", true);

      $("#central_scholarship_name").closest(".col-md-6").removeClass("d-none");
      $("#central_scholarship_amount").closest(".col-md-6").removeClass("d-none");

    } else {

      $("#central_scholarship_name").removeAttr("required").val("");
      $("#central_scholarship_amount").removeAttr("required").val("");

      $("#central_scholarship_name").closest(".col-md-6").addClass("d-none");
      $("#central_scholarship_amount").closest(".col-md-6").addClass("d-none");
    }
  });

  // ------------------------------
  // STATE SCHOLARSHIP
  // ------------------------------
  $("#state_scholarship").on("change", function () {
    if ($(this).val() === "1") {

      $("#state_scholarship_name").attr("required", true);
      $("#state_scholarship_amount").attr("required", true);

      $("#state_scholarship_name").closest(".col-md-6").removeClass("d-none");
      $("#state_scholarship_amount").closest(".col-md-6").removeClass("d-none");

    } else {

      $("#state_scholarship_name").removeAttr("required").val("");
      $("#state_scholarship_amount").removeAttr("required").val("");

      $("#state_scholarship_name").closest(".col-md-6").addClass("d-none");
      $("#state_scholarship_amount").closest(".col-md-6").addClass("d-none");
    }
  });

  // ------------------------------
  // OTHER SCHOLARSHIP
  // ------------------------------
  $("#other_scholarship").on("change", function () {
    if ($(this).val() === "1") {

      $("#other_scholarship_amount").attr("required", true);
      $("#other_scholarship_amount").closest(".col-md-6").removeClass("d-none");

    } else {

      $("#other_scholarship_amount").removeAttr("required").val("");
      $("#other_scholarship_amount").closest(".col-md-6").addClass("d-none");
    }
  });


  // ------------------------------
  // EXTRACURRICULAR → SHOW GIFTED BLOCK
  // ------------------------------
  $("#stu_extracurricular_activity").on("change", function () {

    let giftedBlock = $("#gifted_math").closest(".row"); // the entire gifted row container

    if ($(this).val() === "1") {

      giftedBlock.removeClass("d-none");

      $("#gifted_math").attr("required", true);
      $("#gifted_language").attr("required", true);
      $("#gifted_science").attr("required", true);
      $("#gifted_technical").attr("required", true);
      $("#gifted_sports").attr("required", true);
      $("#gifted_art").attr("required", true);

    } else {

      giftedBlock.addClass("d-none");

      $("#gifted_math").removeAttr("required").val("");
      $("#gifted_language").removeAttr("required").val("");
      $("#gifted_science").removeAttr("required").val("");
      $("#gifted_technical").removeAttr("required").val("");
      $("#gifted_sports").removeAttr("required").val("");
      $("#gifted_art").removeAttr("required").val("");
    }
  });


  // ------------------------------
  // NURTURANCE CAMP (State + National)
  // ------------------------------
  $("#whether_participated_nurturance_camp").on("change", function () {

    if ($(this).val() === "2") {  // NO = Show required fields

      $("#state_nurturance").attr("required", true);
      $("#national_nurturance").attr("required", true);

      $("#state_nurturance").closest(".col-md-6").removeClass("d-none");
      $("#national_nurturance").closest(".col-md-6").removeClass("d-none");

    } else {

      $("#state_nurturance").removeAttr("required").val("");
      $("#national_nurturance").removeAttr("required").val("");

      $("#state_nurturance").closest(".col-md-6").addClass("d-none");
      $("#national_nurturance").closest(".col-md-6").addClass("d-none");
    }
  });

  $("#save_facility_and_other_dtls").on("click", function () {
    if (!validateRequiredFields("#student_facility_other_dtls_form")) {
      return;
    }
    let $btn = $(this);
    $btn.prop('disabled', true).text('Saving...');
    let url = "{{ route('hoi.student.facility') }}";


    if (validateRequiredFields("#student_facility_other_dtls_form")) {
      sendRequest(url, "POST", "#student_facility_other_dtls_form")
        .then(res => {
            if (res && res.status) {
                alert(res.message);
                document.querySelector('[data-bs-target="#vocational_tab"]').click();
                document.dispatchEvent(new CustomEvent('tabSaved', { detail: { tab: 3 } }));
                $btn.prop('disabled', false).text('Save & Next');
            }
            else
            {
              alert('Error saving vocational details. Please try again.');
              $btn.prop('disabled', false).text('Save & Next');
            }
        })
        .catch(err => {
            $btn.prop('disabled', false).text('Save & Next');
            console.error("Error saving vocational details:", err);
      });
    }
    else
    {
      $btn.prop('disabled', false).text('Save & Next');
    }
  });

// {{--Vocational DETAILS OF THE STUDENT Aziza Start --}}
  $("#undertook_vocational_course").on("change", function () {
    if ($(this).val() === "1") {  // YES
    let trade_sector_url = "{{ route('get.vocational.trade.sector') }}";

    sendRequest(trade_sector_url, "GET")
        .then(res => {
            if (!res || !res.data) return;

            let dropdown = $("#trade_sector");
            dropdown.empty().append('<option value="">-- Select Trade Sector --</option>');

            $.each(res.data, function (i, item) {
                dropdown.append(`<option value="${item.id}">${item.name}</option>`);
            });
        })
        .catch(err => {
            console.error("Error loading trade sectors:", err);
        });

      


      $("#trade_sector").attr("required", true);
      $("#job_role").attr("required", true);
      $("#theory_hours").attr("required", true);
      $("#practical_hours").attr("required", true);
      $("#industry_hours").attr("required", true);
      $("#field_visit_hours").attr("required", true);
      $("#appeared_exam").attr("required", true);
      $("#placement_applied").attr("required", true);
      $("#apprenticeship_applied").attr("required", true);
      $("#nsqf_level").attr("required", true);
      $("#employment_status").attr("required", true);

      $("#vocational_course_div").removeClass("d-none");

    } else {

      $("#trade_sector").removeAttr("required").val("");
      $("#job_role").removeAttr("required").val("");
      $("#theory_hours").removeAttr("required").val("");
      $("#practical_hours").removeAttr("required").val("");
      $("#industry_hours").removeAttr("required").val("");
      $("#field_visit_hours").removeAttr("required").val("");
      $("#appeared_exam").removeAttr("required").val("");
      $("#placement_applied").removeAttr("required").val("");
      $("#apprenticeship_applied").removeAttr("required").val("");
      $("#nsqf_level").removeAttr("required").val("");
      $("#employment_status").removeAttr("required").val("");
      $("#marks_obtained").removeAttr("required").val("");
      $("#vocational_course_div").addClass("d-none");
    }
  });
  // When Trade Sector changes
  $('#trade_sector').on('change', function() {
      loadJobRoles($(this).val());
  });
  $("#appeared_exam").on("change", function () {
    if ($(this).val() === "1" || $(this).val() === "2") {  // Not Applicable
      $("#marks_obtained").attr("required",true);
      $("#marks_obtained").closest(".col-md-6").removeClass("d-none");
    } else {
      $("#marks_obtained").removeAttr("required").val("");
      $("#marks_obtained").closest(".col-md-6").addClass("d-none");

    }
  });
  $("#employment_status").on("change", function () {
    if ($(this).val() === "1") {  // Not Applicable
      $("#salary_offered").attr("required",true);
      $("#salary_offered").closest(".col-md-6").removeClass("d-none");

    } else {
      $("#salary_offered").removeAttr("required").val("");
      $("#salary_offered").closest(".col-md-6").addClass("d-none");
    }
  });
  $("#save_vocational_btn").on("click", function (e) {
    if (!validateRequiredFields("#stu_vocational_dtls_form")) {
      return;
    }
    let $btn = $(this);
    $btn.prop('disabled', true).text('Saving...');
    let url = "{{ route('save.vocational.details') }}"; // Add route in web.php

    if (validateRequiredFields("#stu_vocational_dtls_form")) {
      sendRequest(url, "POST", "#stu_vocational_dtls_form")
          .then(res => {
              if (res && res.status) {
                  alert(res.message);
                  document.querySelector('[data-bs-target="#contact_info_tab"]').click();
                  document.dispatchEvent(new CustomEvent('tabSaved', { detail: { tab: 4 } }));
                  $btn.prop('disabled', false).text('Save & Next');
              }
              else{
                alert('Error saving vocational details. Please try again.');
                $btn.prop('disabled', false).text('Save & Next');
              }
          })
          .catch(err => {
              $btn.prop('disabled', false).text('Save & Next');
              console.error("Error saving vocational details:", err);
      });
    }
    else {
      $btn.prop('disabled', false).text('Save & Next');
    }
});
// {{--Vocational DETAILS OF THE STUDENT Aziza End --}}


    // Start New Entry Button
    $("#resumeEntryBtn").on("click", function () 
    {

      let step = {{ $data['current_step'] ?? 1 }};
      let tabSelector = "#general_info";

      switch (step) {
          case 1: tabSelector = "#general_info"; break;
          case 2: tabSelector = "#enrollment_details"; break;
          case 3: tabSelector = "#facility_other_dtls_tab"; break;
          case 4: tabSelector = "#vocational_tab"; break;
          case 5: tabSelector = "#contact_info_tab"; break;
          case 6: tabSelector = "#bank_dtls_tab"; break;
          case 7: tabSelector = "#additional_dtls_tab"; break;
      }

      // Remember resume mode to stop auto-tab switching
      window.resumeMode = true;

      // Activate tab using jQuery
      $(`button[data-bs-target='${tabSelector}']`).tab("show");

      // Scroll into view
      setTimeout(() => {
          $(tabSelector).get(0).scrollIntoView({ behavior: "smooth", block: "start" });
      }, 300);
    });

  // When clicking "Start New Entry" → open modal instead of confirm()
document.getElementById("startNewEntryBtn")?.addEventListener("click", function () {
    let modal = new bootstrap.Modal(document.getElementById("delete_previous_student_entry"));
    modal.show();
});

// When clicking Delete inside modal
document.getElementById("confirmDeleteEntry")?.addEventListener("click", function () {

    let url = "{{ route('student.entry.reset') }}";

    sendRequest(url, "POST", null, { _method: "DELETE" })
        .then(data => {
            if (data) {
                alert(data.message);
                location.reload();
            }
        });
});



// ================= PREVIEW MASTER MAPS =================
// ================= YES / NO =================
const YES_NO_MAP = { 1: 'Yes', 2: 'No' };
const yesNo = v => YES_NO_MAP[v] ?? '';

// ================= MAP HELPER =================
const mapValue = (map, key) => map?.[key] ?? '';

// ================= MASTER MAPS =================
const GENDER_MAP        = @json($gender_master);
const MOTHER_TONGUE_MAP = @json($mother_tongue_master);
const SOCIAL_CAT_MAP    = @json($social_category_master);
const RELIGION_MAP      = @json($religion_master);
const NATIONALITY_MAP   = @json($nationality_master);
const BLOOD_GROUP_MAP   = @json($blood_group_master);

const GUARDIAN_REL_MAP  = @json($guardian_relationship_master);
const INCOME_MAP        = @json($income_master);
const GUARDIAN_QUAL_MAP = @json($guardian_qualification_master);
const DISABILITY_MAP    = @json($bs_stu_disability_type_master);

const CLASS_MAP         = @json($bs_class_master);
const SECTION_MAP       = @json($bs_class_section_master);
const STREAM_MAP        = @json($bs_stream_master);
const ADMISSION_MAP     = @json($bs_admission_type_master);

const COUNTRY_MAP       = @json($bs_country_master);
const STATE_MAP         = @json($state_master);
const DISTRICT_MAP      = @json($district_master);
const BLOCK_MAP         = @json($block_munc_corp_master);

const BANK_MAP          = @json($bank_code_name_master);
const BRANCH_MAP        = @json($bank_branch_master);

const DISTANCE_MAP      = @json($bs_student_residence_to_school_distance);



const PREV_STATUS_MAP   = @json($bs_previous_schooling_type_master);
const APPEARED_MAP      = @json($bs_stu_appeared_master);

const SCHOOL_MEDIUM_MAP = @json($bs_school_medium);

// ================= DATA =================
const studentData = @json($data);

// ================= PREVIEW =================
document.getElementById('previewBtn').addEventListener('click', function () {

let html = `
<div class="alert alert-warning text-center fw-bold">
⚠️ Please check all details before final submit
</div>`;

// ================= 1. BASIC =================
if (studentData.basic_info) {
const b = studentData.basic_info;
html += `
<h6 class="card-header bg-heading-primary text-white">Basic Details</h6>
<table class="table table-sm table-bordered">
<tr><th>Name</th><td>${b.student_name ?? ''}</td><th>Aadhaar Name</th><td>${b.student_name_as_per_aadhaar ?? ''}</td></tr>
<tr><th>Gender</th><td>${mapValue(GENDER_MAP,b.gender)}</td><th>DOB</th><td>${b.dob ?? ''}</td></tr>
<tr><th>Father</th><td>${b.father_name ?? ''}</td><th>Mother</th><td>${b.mother_name ?? ''}</td></tr>
<tr><th>Guardian</th><td>${b.guardian_name ?? ''}</td><th>Aadhaar</th><td>${b.aadhaar_child ?? ''}</td></tr>
<tr><th>Mother Tongue</th><td>${mapValue(MOTHER_TONGUE_MAP,b.mother_tongue)}</td><th>Category</th><td>${mapValue(SOCIAL_CAT_MAP,b.social_category)}</td></tr>
<tr><th>Religion</th><td>${mapValue(RELIGION_MAP,b.religion)}</td><th>Nationality</th><td>${mapValue(NATIONALITY_MAP,b.nationality)}</td></tr>
<tr><th>Blood Group</th><td>${mapValue(BLOOD_GROUP_MAP,b.blood_group)}</td><th>BPL</th><td>${yesNo(b.bpl_beneficiary)}</td></tr>
<tr><th>Antyodaya</th><td>${yesNo(b.antyodaya_anna_yojana)}</td><th>BPL No</th><td>${b.bpl_number ?? ''}</td></tr>
<tr><th>Disadvantaged</th><td>${yesNo(b.disadvantaged_group)}</td><th>CWSN</th><td>${yesNo(b.cwsn)}</td></tr>
<tr><th>Disability</th><td>${mapValue(DISABILITY_MAP,b.type_of_impairment)}</td><th>%</th><td>${b.disability_percentage ?? ''}</td></tr>
<tr><th>Out of School</th><td>${yesNo(b.out_of_school)}</td><th>Mainstreamed</th><td>${yesNo(b.mainstreamed)}</td></tr>
<tr><th>Health ID</th><td>${b.health_id ?? ''}</td><th>Guardian Relation</th><td>${mapValue(GUARDIAN_REL_MAP,b.relationship_with_guardian)}</td></tr>
<tr><th>Family Income</th><td>${mapValue(INCOME_MAP,b.family_income)}</td><th>Guardian Qualification</th><td>${mapValue(GUARDIAN_QUAL_MAP,b.guardian_qualifications)}</td></tr>
</table><hr>`;
}
// ================= HELPER =================
function hasValue(v) {
    return v !== null &&
           v !== undefined &&
           v !== '' &&
           !(typeof v === 'string' && v.trim() === '');
}

// ================= 2. ENROLLMENT =================
if (studentData.enrollment_info) {
    const e = studentData.enrollment_info;

    html += `
    <h6 class="card-header bg-heading-primary text-white">Enrollment Details</h6>
    <table class="table table-sm table-bordered">`;

    if (hasValue(e.admission_no) || hasValue(e.academic_year)) {
        html += `
        <tr>
            <th>Admission No</th><td>${e.admission_no ?? ''}</td>
            <th>Academic Year</th><td>${e.academic_year ?? ''}</td>
        </tr>`;
    }

    if (hasValue(e.status_pre_year) || hasValue(e.admission_date)) {
        html += `
        <tr>
            <th>Previous Year Status</th>
            <td>${mapValue(PREV_STATUS_MAP, e.status_pre_year)}</td>
            <th>Admission Date</th>
            <td>${e.admission_date ?? ''}</td>
        </tr>`;
    }

    if (hasValue(e.prev_class_appeared_exam) || hasValue(e.prev_class_exam_result)) {
        html += `
        <tr>
            <th>Prev Appeared</th>
            <td>${mapValue(APPEARED_MAP, e.prev_class_appeared_exam)}</td>
            <th>Prev Result</th>
            <td>${e.prev_class_exam_result ?? ''}</td>
        </tr>`;
    }

    if (hasValue(e.prev_class_marks_percent) || hasValue(e.attendention_pre_year)) {
        html += `
        <tr>
            <th>Prev % Marks</th>
            <td>${e.prev_class_marks_percent ?? ''}</td>
            <th>Attendance (Prev Year)</th>
            <td>${e.attendention_pre_year ?? ''}</td>
        </tr>`;
    }

    if (hasValue(e.pre_class_code_fk) || hasValue(e.pre_section_code_fk)) {
        html += `
        <tr>
            <th>Previous Class</th>
            <td>${mapValue(CLASS_MAP, e.pre_class_code_fk)}</td>
            <th>Previous Section</th>
            <td>${mapValue(SECTION_MAP, e.pre_section_code_fk)}</td>
        </tr>`;
    }

    if (hasValue(e.pre_stream_code_fk) || hasValue(e.pre_roll_number)) {
        html += `
        <tr>
            <th>Previous Stream</th>
            <td>${mapValue(STREAM_MAP, e.pre_stream_code_fk)}</td>
            <th>Previous Roll</th>
            <td>${e.pre_roll_number ?? ''}</td>
        </tr>`;
    }

    if (hasValue(e.cur_class_code_fk) || hasValue(e.cur_section_code_fk)) {
        html += `
        <tr>
            <th>Current Class</th>
            <td>${mapValue(CLASS_MAP, e.cur_class_code_fk)}</td>
            <th>Current Section</th>
            <td>${mapValue(SECTION_MAP, e.cur_section_code_fk)}</td>
        </tr>`;
    }

    if (hasValue(e.cur_stream_code) || hasValue(e.admission_type_code_fk)) {
        html += `
        <tr>
            <th>Current Stream</th>
            <td>${mapValue(STREAM_MAP, e.cur_stream_code)}</td>
            <th>Admission Type</th>
            <td>${mapValue(ADMISSION_MAP, e.admission_type_code_fk)}</td>
        </tr>`;
    }

    if (hasValue(e.cur_roll_number) || hasValue(e.medium_code_fk)) {
        html += `
        <tr>
            <th>Current Roll</th>
            <td>${e.cur_roll_number ?? ''}</td>
            <th>Medium</th>
            <td>${mapValue(SCHOOL_MEDIUM_MAP, e.medium_code_fk)}</td>
        </tr>`;
    }

    html += `</table><hr>`;
}

// ================= 3. FACILITY =================
// ================= FACILITY & OTHER DETAILS =================
if (studentData.facility) {
    const f = studentData.facility;

    if (Object.values(f).some(v => hasValue(v))) {

        html += `
        <h6 class="card-header bg-heading-primary text-white">
            Facility & Other Details
        </h6>
        <table class="table table-sm table-bordered">`;

        /* ================= FACILITIES ================= */
        if (hasValue(f.facilities_provided_for_the_yeear)) {
            html += `
            <tr class="table-secondary fw-bold">
                <td colspan="4">Facilities Provided</td>
            </tr>
            <tr>
                <th>Facilities provided to the student</th>
                <td colspan="3">${yesNo(f.facilities_provided_for_the_yeear)}</td>
            </tr>`;
        }

        if (hasValue(f.free_transport_facility) || hasValue(f.free_host_facility)) {
            html += `
            <tr>
                <th>Free Transport Facility</th><td>${yesNo(f.free_transport_facility)}</td>
                <th>Free Host Facility</th><td>${yesNo(f.free_host_facility)}</td>
            </tr>`;
        }

        if (hasValue(f.free_bicycle) || hasValue(f.free_uniforms)) {
            html += `
            <tr>
                <th>Free Bicycle</th><td>${yesNo(f.free_bicycle)}</td>
                <th>Free Uniforms</th><td>${yesNo(f.free_uniforms)}</td>
            </tr>`;
        }

        if (hasValue(f.free_escort) || hasValue(f.free_shoe)) {
            html += `
            <tr>
                <th>Free Escort</th><td>${yesNo(f.free_escort)}</td>
                <th>Free Shoe</th><td>${yesNo(f.free_shoe)}</td>
            </tr>`;
        }

        if (hasValue(f.free_exercise_book) || hasValue(f.complete_free_books)) {
            html += `
            <tr>
                <th>Free Exercise Book</th><td>${yesNo(f.free_exercise_book)}</td>
                <th>Complete Set of Free Books</th><td>${yesNo(f.complete_free_books)}</td>
            </tr>`;
        }

        /* ================= SCHOLARSHIP ================= */
        if (
            hasValue(f.central_scholarship) ||
            hasValue(f.state_scholarship) ||
            hasValue(f.other_scholarship)
        ) {
            html += `
            <tr class="table-secondary fw-bold">
                <td colspan="4">Scholarship Received</td>
            </tr>`;
        }

        if (hasValue(f.central_scholarship)) {
            html += `
            <tr>
                <th>Central Scholarship</th><td>${yesNo(f.central_scholarship)}</td>
                <th>Amount</th><td>${f.central_scholarship_amount ?? ''}</td>
            </tr>`;
        }

        if (hasValue(f.state_scholarship)) {
            html += `
            <tr>
                <th>State Scholarship</th><td>${yesNo(f.state_scholarship)}</td>
                <th>Amount</th><td>${f.state_scholarship_amount ?? ''}</td>
            </tr>`;
        }

        if (hasValue(f.other_scholarship)) {
            html += `
            <tr>
                <th>Other Scholarship</th><td>${yesNo(f.other_scholarship)}</td>
                <th>Amount</th><td>${f.other_scholarship_amount ?? ''}</td>
            </tr>`;
        }

        /* ================= GIFTED ================= */
        if (
            hasValue(f.child_hyperactive_disorder) ||
            hasValue(f.stu_extracurricular_activity) ||
            hasValue(f.gifted_math) ||
            hasValue(f.gifted_language) ||
            hasValue(f.gifted_science) ||
            hasValue(f.gifted_technical) ||
            hasValue(f.gifted_sports) ||
            hasValue(f.gifted_art)
        ) {
            html += `
            <tr class="table-secondary fw-bold">
                <td colspan="4">Gifted / Talented Child</td>
            </tr>`;
        }

        if (hasValue(f.child_hyperactive_disorder)) {
            html += `
            <tr>
                <th>Screened for ADHD</th>
                <td colspan="3">${yesNo(f.child_hyperactive_disorder)}</td>
            </tr>`;
        }

        if (hasValue(f.stu_extracurricular_activity)) {
            html += `
            <tr>
                <th>Extracurricular Activity</th>
                <td colspan="3">${yesNo(f.stu_extracurricular_activity)}</td>
            </tr>`;
        }

        if (
            hasValue(f.gifted_math) ||
            hasValue(f.gifted_language) ||
            hasValue(f.gifted_science)
        ) {
            html += `
            <tr>
                <th>Mathematics</th><td>${yesNo(f.gifted_math)}</td>
                <th>Language</th><td>${yesNo(f.gifted_language)}</td>
            </tr>
            <tr>
                <th>Science</th><td>${yesNo(f.gifted_science)}</td>
                <th>Technical</th><td>${yesNo(f.gifted_technical)}</td>
            </tr>
            <tr>
                <th>Sports</th><td>${yesNo(f.gifted_sports)}</td>
                <th>Art</th><td>${yesNo(f.gifted_art)}</td>
            </tr>`;
        }

        /* ================= OTHER DETAILS ================= */
        if (
            hasValue(f.provided_mentors) ||
            hasValue(f.whether_participated_nurturance_camp) ||
            hasValue(f.participated_competitions) ||
            hasValue(f.ncc_nss_guides) ||
            hasValue(f.rte_free_education) ||
            hasValue(f.homeless) ||
            hasValue(f.special_training) ||
            hasValue(f.able_to_handle_devices) ||
            hasValue(f.internet_access)
        ) {
            html += `
            <tr class="table-secondary fw-bold">
                <td colspan="4">Other Details</td>
            </tr>`;
        }

        if (hasValue(f.provided_mentors)) {
            html += `<tr><th>Provided Mentors</th><td colspan="3">${yesNo(f.provided_mentors)}</td></tr>`;
        }

        if (hasValue(f.whether_participated_nurturance_camp)) {
            html += `<tr><th>Nurturance Camp</th><td colspan="3">${yesNo(f.whether_participated_nurturance_camp)}</td></tr>`;
        }

        if (hasValue(f.participated_competitions) || hasValue(f.ncc_nss_guides)) {
            html += `
            <tr>
                <th>Competitions</th><td>${yesNo(f.participated_competitions)}</td>
                <th>NCC / NSS / Guides</th><td>${yesNo(f.ncc_nss_guides)}</td>
            </tr>`;
        }

        if (hasValue(f.rte_free_education)) {
            html += `<tr><th>RTE Free Education</th><td colspan="3">${yesNo(f.rte_free_education)}</td></tr>`;
        }

        if (hasValue(f.homeless)) {
            html += `<tr><th>Homeless Status</th><td colspan="3">${f.homeless}</td></tr>`;
        }

        if (hasValue(f.special_training)) {
            html += `<tr><th>Special Training</th><td colspan="3">${yesNo(f.special_training)}</td></tr>`;
        }

        if (hasValue(f.able_to_handle_devices) || hasValue(f.internet_access)) {
            html += `
            <tr>
                <th>Digital Devices</th><td>${yesNo(f.able_to_handle_devices)}</td>
                <th>Internet Access</th><td>${yesNo(f.internet_access)}</td>
            </tr>`;
        }

        html += `</table><hr>`;
    }
}


// ================= 4. VOCATIONAL =================
// ================= VOCATIONAL DETAILS =================
if (studentData.vocational) {
    const v = studentData.vocational;

    if (Object.values(v).some(val => hasValue(val))) {

        html += `
        <h6 class="card-header bg-heading-primary text-white">
            Vocational Details
        </h6>
        <table class="table table-sm table-bordered">`;

        /* ================= BASIC ================= */
        if (hasValue(v.exposure) || hasValue(v.undertook)) {
            html += `
            <tr class="table-secondary fw-bold">
                <td colspan="4">General</td>
            </tr>
            <tr>
                <th>Exposure to Vocational Activities</th>
                <td>${yesNo(v.exposure)}</td>
                <th>Undertook Vocational Course</th>
                <td>${yesNo(v.undertook)}</td>
            </tr>`;
        }

        /* ================= COURSE DETAILS ================= */
        if (hasValue(v.trade_sector) || hasValue(v.job_role)) {
            html += `
            <tr class="table-secondary fw-bold">
                <td colspan="4">Course Details</td>
            </tr>
            <tr>
                <th>Trade Sector</th>
                <td>${mapValue(TRADE_SECTOR_MAP, v.trade_sector)}</td>
                <th>Job Role</th>
                <td>${mapValue(JOB_ROLE_MAP, v.job_role)}</td>
            </tr>`;
        }

        /* ================= ATTENDANCE / HOURS ================= */
        if (
            hasValue(v.theory_hours) ||
            hasValue(v.practical_hours) ||
            hasValue(v.industry_hours) ||
            hasValue(v.field_visit_hours)
        ) {
            html += `
            <tr class="table-secondary fw-bold">
                <td colspan="4">Class Attendance (Hours)</td>
            </tr>
            <tr>
                <th>Theory</th><td>${v.theory_hours ?? ''}</td>
                <th>Practical</th><td>${v.practical_hours ?? ''}</td>
            </tr>
            <tr>
                <th>Industry Training</th><td>${v.industry_hours ?? ''}</td>
                <th>Field Visit</th><td>${v.field_visit_hours ?? ''}</td>
            </tr>`;
        }

        /* ================= EXAM ================= */
        if (hasValue(v.appeared_exam) || hasValue(v.marks_obtained)) {
            html += `
            <tr class="table-secondary fw-bold">
                <td colspan="4">Examination</td>
            </tr>
            <tr>
                <th>Appeared in Exam</th>
                <td>${yesNo(v.appeared_exam)}</td>
                <th>Marks (%)</th>
                <td>${v.marks_obtained ?? ''}</td>
            </tr>`;
        }

        /* ================= PLACEMENT ================= */
        if (
            hasValue(v.placement_applied) ||
            hasValue(v.apprenticeship_applied) ||
            hasValue(v.nsqf_level) ||
            hasValue(v.employment_status) ||
            hasValue(v.salary_offered)
        ) {
            html += `
            <tr class="table-secondary fw-bold">
                <td colspan="4">Placement / Employment</td>
            </tr>`;
        }

        if (hasValue(v.placement_applied) || hasValue(v.apprenticeship_applied)) {
            html += `
            <tr>
                <th>Applied for Placement</th>
                <td>${yesNo(v.placement_applied)}</td>
                <th>Applied for Apprenticeship</th>
                <td>${yesNo(v.apprenticeship_applied)}</td>
            </tr>`;
        }

        if (hasValue(v.nsqf_level) || hasValue(v.employment_status)) {
            html += `
            <tr>
                <th>NSQF Level</th>
                <td>${v.nsqf_level ?? ''}</td>
                <th>Employment Status</th>
                <td>${yesNo(v.employment_status)}</td>
            </tr>`;
        }

        if (hasValue(v.salary_offered)) {
            html += `
            <tr>
                <th>Salary Offered</th>
                <td colspan="3">${v.salary_offered}</td>
            </tr>`;
        }

        html += `</table><hr>`;
    }
}


// ================= 5. CONTACT =================
if (studentData.student_contact) {
const c = studentData.student_contact;
html += `
<h6 class="card-header bg-heading-primary text-white">Contact Details</h6>
<table class="table table-sm table-bordered">
<tr><th>Country</th><td>${mapValue(COUNTRY_MAP,c.stu_country_code)}</td><th>State</th><td>${mapValue(STATE_MAP,c.stu_state_code)}</td></tr>
<tr><th>District</th><td>${mapValue(DISTRICT_MAP,c.stu_contact_district)}</td><th>Block</th><td>${mapValue(BLOCK_MAP,c.stu_contact_block)}</td></tr>
<tr><th>Mobile</th><td>${c.stu_mobile_no ?? ''}</td><th>Email</th><td>${c.stu_email ?? ''}</td></tr>
</table><hr>`;
}

// ================= 6. BANK =================
if (studentData.student_bank_details) {
const b = studentData.student_bank_details;
html += `
<h6 class="card-header bg-heading-primary text-white">Bank Details</h6>
<table class="table table-sm table-bordered">
<tr><th>Bank</th><td>${mapValue(BANK_MAP,b.bank_id_fk)}</td><th>Branch</th><td>${mapValue(BRANCH_MAP,b.branch_id_fk)}</td></tr>
<tr><th>IFSC</th><td>${b.bank_ifsc ?? ''}</td><th>Account</th><td>${b.stu_bank_acc_no ?? ''}</td></tr>
</table><hr>`;
}

// ================= 7. ADDITIONAL =================
if (studentData.student_additional_details) {
const a = studentData.student_additional_details;
html += `
<h6 class="card-header bg-heading-primary text-white">Additional Details</h6>
<table class="table table-sm table-bordered">
<tr><th>RTE Amount</th><td>${a.rte_entitlement_claimed_amount ?? ''}</td><th>Distance</th><td>${mapValue(DISTANCE_MAP,a.stu_residance_sch_distance_code_fk)}</td></tr>
<tr><th>Appeared</th><td>${yesNo(a.cur_class_appeared_exam)}</td><th>Marks %</th><td>${a.cur_class_marks_percent ?? ''}</td></tr>
<tr><th>Attendance</th><td>${a.attendention_cur_year ?? ''}</td><th></th><td></td></tr>
</table><hr>`;
}

document.getElementById('previewModalBody').innerHTML = html;
new bootstrap.Modal(document.getElementById('previewModal')).show();
});
  // ===============================
(function () {
  // Map tabs to numeric steps
  const tabMap = {
    1: {btnSelector: 'button[data-bs-target="#general_info"]', target: '#general_info'},
    2: {btnSelector: 'button[data-bs-target="#enrollment_details"]', target: '#enrollment_details'},
    3: {btnSelector: 'button[data-bs-target="#facility_other_dtls_tab"]', target: '#facility_other_dtls_tab'},
    4: {btnSelector: 'button[data-bs-target="#vocational_tab"]', target: '#vocational_tab'},
    5: {btnSelector: 'button[data-bs-target="#contact_info_tab"]', target: '#contact_info_tab'},
    6: {btnSelector: 'button[data-bs-target="#bank_dtls_tab"]', target: '#bank_dtls_tab'},
    7: {btnSelector: 'button[data-bs-target="#additional_dtls_tab"]', target: '#additional_dtls_tab'}
  };

  // Initialize savedState from server current step (tabs <= current_step considered saved)
  var serverCurrent = {{ intval($data['current_step'] ?? 0) }}; // e.g. 0..7
  var savedState = {};
  for (let i = 1; i <= 7; i++) {
    savedState[i] = (i <= serverCurrent); // true if server says current_step >= i
  }

  // optional visual: disable tabs that are locked (but don't remove pointer events; actual block by event)
  function refreshTabUI() {
    for (let i = 1; i <= 7; i++) {
      let btn = $(tabMap[i].btnSelector);
      if (!btn.length) continue;
      if (!savedState[i]) {
        btn.addClass('disabled').attr('aria-disabled', 'true');
      } else {
        btn.removeClass('disabled').removeAttr('aria-disabled');
      }
    }
  }
  refreshTabUI();

  // Block navigation to a tab if any PREVIOUS tab (smaller index) is not saved
  $('button[data-bs-toggle="tab"]').on('show.bs.tab', function (e) {
    // find destination tab index
    var dest = $(e.target).data('bsTarget') || $(e.target).attr('data-bs-target');
    if (!dest) return; // nothing to do
    // map dest to index
    var destIndex = null;
    for (let i = 1; i <= 7; i++) {
      if (tabMap[i].target === dest) { destIndex = i; break; }
    }
    if (destIndex === null) return;

    // allow navigating to same or earlier tabs (back navigation) always
    // but only allow forward to destIndex if all previous tabs (1..destIndex-1) are saved
    if (destIndex > 1) {
      for (let j = 1; j < destIndex; j++) {
        if (!savedState[j]) {
          e.preventDefault();
          if (window.toastr) toastr.warning('Please save previous steps before proceeding.');
          else alert('Please save previous steps before proceeding.');
          // focus on first unsaved tab's save button (heuristic)
          switch(j) {
            case 1: $('#basic_info_save_btn').focus(); break;
            case 2: $('#enrollment_details_save_btn').focus(); break;
            case 3: $('#save_facility_and_other_dtls').focus(); break;
            case 4: $('#save_vocational_btn').focus(); break;
            case 5: $('#contact_info_save_btn').focus(); break;
            case 6: $('#bank_details_of_student').focus(); break;
            case 7: $('#saveAdditionalDetails').find('button[type="submit"]').focus(); break;

            default: break;
          }
          return false;
        }
      }
    }
    // allowed
  });

  // Listener for custom event when a tab is saved
  // dispatch with: document.dispatchEvent(new CustomEvent('tabSaved',{detail:{tab:N}}));
  document.addEventListener('tabSaved', function (ev) {
    try {
      var idx = ev.detail && ev.detail.tab ? parseInt(ev.detail.tab) : null;
      if (!idx || !(idx in savedState)) return;
      savedState[idx] = true;
      refreshTabUI();

      // auto move to next tab if not in resumeMode and next exists
      if (!window.resumeMode) {
        var next = idx + 1;
        if (next <= 7 && $(tabMap[next].btnSelector).length) {
          // use bootstrap tab show
          $(tabMap[next].btnSelector).tab('show');
        }
      }
    } catch (err) {
      console.error('tabSaved handler error', err);
    }
  });

  // Convenience: expose a function to mark saved from console if needed
  window.__markTabSaved = function(n) {
    document.dispatchEvent(new CustomEvent('tabSaved', {detail: {tab: n}}));
  };

  // ---------------------------
  // IMPORTANT: Integration points (where to call dispatch)
  // ---------------------------
  // In each tab's AJAX success callback you already have, add this line (after successful save & toast):
  //
  //    document.dispatchEvent(new CustomEvent('tabSaved', { detail: { tab: X } }));
  //
  // Replace X with:
  //   Basic Info save success  -> X = 1
  //   Enrollment save success  -> X = 2
  //   Facility save success    -> X = 3
  //   Vocational save success  -> X = 4
  //   Contact save success     -> X = 5
  //   Bank details success     -> X = 6
  //   Additional details save  -> X = 7
  //
  // Example (Basic Info success): 
  //   success: function(res) {
  //     // ... your existing toast/alert ...
  //     document.dispatchEvent(new CustomEvent('tabSaved', { detail: { tab: 1 } }));
  //   }
  //
  // I will now list the exact insertion points in your existing handlers:
  //
  // 1) In your "#basic_info_save_btn" AJAX success -> add:
  //    document.dispatchEvent(new CustomEvent('tabSaved', { detail: { tab: 1 } }));
  //
  // 2) In your "#enrollment_details_save_btn" AJAX success -> add:
  //    document.dispatchEvent(new CustomEvent('tabSaved', { detail: { tab: 2 } }));
  //
  // 3) In the "save_facility_and_other_dtls" .then success -> add:
  //    document.dispatchEvent(new CustomEvent('tabSaved', { detail: { tab: 3 } }));
  //
  // 4) In "#save_vocational_btn" .then success -> add:
  //    document.dispatchEvent(new CustomEvent('tabSaved', { detail: { tab: 4 } }));
  //
  // 5) In your "#contact_info_save_btn" AJAX success -> add:
  //    document.dispatchEvent(new CustomEvent('tabSaved', { detail: { tab: 5 } }));
  //
  // 6) In the bank-details AJAX success (the form with id #bank_details_of_student) -> add:
  //    document.dispatchEvent(new CustomEvent('tabSaved', { detail: { tab: 6 } }));
  //
  // 7) If you have an "additional details" save handler, add tab:7 similarly.
  //
  // If you prefer, you can use the helper __markTabSaved(n) in place of dispatch.

})(); 

</script>

@endpush
@endsection
