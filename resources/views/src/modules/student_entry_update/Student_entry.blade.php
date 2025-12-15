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
@endphp

  <!-- @dump($student_bank) -->
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
    $bs_school_medium = DB::table('bs_school_medium')->pluck('id', 'id')->toArray();
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
                // document.dispatchEvent(new CustomEvent('tabSaved', { detail: { tab: 6 } }));
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
              document.querySelector('[data-bs-target="#bank_dtls_tab"]').click();
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
        })
        .catch(err => {
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
          })
          .catch(err => {
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





// ===========================Student Entry Preview Modal Content====================================
    const studentData = @json($data);
    
    document.getElementById('previewBtn').addEventListener('click', function () {

      let html = `
        <div class="alert alert-warning text-center fw-bold" 
             style="top:0; z-index:20; padding:8px; border-radius:0;">
            ⚠️ Please check all details before final submit
        </div>
      `;
          // ===== Basic Info =====
          if (studentData.basic_info) {
              const b = studentData.basic_info;

              html += `
                  <h6 class="card-header bg-heading-primary text-white py-2">
                    Basic Details
                  </h6>
                  
                  <table class="table table-sm table-bordered">

                      <tr>
                          <th>Name</th><td>${b.student_name ?? ''}</td>
                          <th>Name (Aadhaar)</th><td>${b.student_name_as_per_aadhaar ?? ''}</td>
                      </tr>

                      <tr>
                          <th>Gender</th><td>${b.gender ?? ''}</td>
                          <th>DOB</th><td>${b.dob ?? ''}</td>
                      </tr>

                      <tr>
                          <th>Father Name</th><td>${b.father_name ?? ''}</td>
                          <th>Mother Name</th><td>${b.mother_name ?? ''}</td>
                      </tr>

                      <tr>
                          <th>Guardian Name</th><td>${b.guardian_name ?? ''}</td>
                          <th>Aadhaar Number</th><td>${b.aadhaar_child ?? ''}</td>
                      </tr>

                      <tr>
                          <th>Mother Tongue</th><td>${b.mother_tongue ?? ''}</td>
                          <th>Social Category</th><td>${b.social_category ?? ''}</td>
                      </tr>

                      <tr>
                          <th>Religion</th><td>${b.religion ?? ''}</td>
                          <th>Nationality</th><td>${b.nationality ?? ''}</td>
                      </tr>

                      <tr>
                          <th>Blood Group</th><td>${b.blood_group ?? ''}</td>
                          <th>BPL Beneficiary</th><td>${b.bpl_beneficiary ?? ''}</td>
                      </tr>

                      <tr>
                          <th>Antyodaya Anna Yojana</th><td>${b.antyodaya_anna_yojana ?? ''}</td>
                          <th>BPL Number</th><td>${b.bpl_number ?? ''}</td>
                      </tr>

                      <tr>
                          <th>Disadvantaged Group</th><td>${b.disadvantaged_group ?? ''}</td>
                          <th>CWSN</th><td>${b.cwsn ?? ''}</td>
                      </tr>

                      <tr>
                          <th>Type of Impairment</th><td>${b.type_of_impairment ?? ''}</td>
                          <th>Disability %</th><td>${b.disability_percentage ?? ''}</td>
                      </tr>

                      <tr>
                          <th>Out of School</th><td>${b.out_of_school ?? ''}</td>
                          <th>Mainstreamed</th><td>${b.mainstreamed ?? ''}</td>
                      </tr>

                      <tr>
                          <th>Birth Reg. No</th><td>${b.birth_reg_no ?? ''}</td>
                          <th>Identification Mark</th><td>${b.identification_mark ?? ''}</td>
                      </tr>

                      <tr>
                          <th>Health ID</th><td>${b.health_id ?? ''}</td>
                          <th>Relationship With Guardian</th><td>${b.relationship_with_guardian ?? ''}</td>
                      </tr>

                      <tr>
                          <th>Family Income</th><td>${b.family_income ?? ''}</td>
                          <th>Guardian Qualifications</th><td>${b.guardian_qualifications ?? ''}</td>
                      </tr>

                      <tr>
                          <th>Height (cm)</th><td>${b.student_height ?? ''}</td>
                          <th>Weight (kg)</th><td>${b.student_weight ?? ''}</td>
                      </tr>

                  </table>
                  <hr>
              `;
          }
          // ===== Enrollment Info =====
          if (studentData.enrollment_info) {
              const e = studentData.enrollment_info;

              html += `
                  <h6 class="card-header bg-heading-primary text-white py-2">
                  Enrollment Details
                  </h6>
                  <table class="table table-sm table-bordered">

                      <tr>
                          <th>Admission No</th><td>${e.admission_no ?? ''}</td>
                          <th>Status Previous Year</th><td>${e.status_pre_year ?? ''}</td>
                      </tr>

                      <tr>
                          <th>Prev Class Appeared Exam</th><td>${e.prev_class_appeared_exam ?? ''}</td>
                          <th>Prev Class Result</th><td>${e.prev_class_exam_result ?? ''}</td>
                      </tr>

                      <tr>
                          <th>Prev Class % Marks</th><td>${e.prev_class_marks_percent ?? ''}</td>
                          <th>Attendance Previous Year</th><td>${e.attendention_pre_year ?? ''}</td>
                      </tr>

                      <tr>
                          <th>Previous Class</th><td>${e.pre_class_code_fk ?? ''}</td>
                          <th>Previous Section</th><td>${e.pre_section_code_fk ?? ''}</td>
                      </tr>

                      <tr>
                          <th>Previous Stream</th><td>${e.pre_stream_code_fk ?? ''}</td>
                          <th>Previous Roll No</th><td>${e.pre_roll_number ?? ''}</td>
                      </tr>

                      <tr>
                          <th>Current Class</th><td>${e.cur_class_code_fk ?? ''}</td>
                          <th>Academic Year</th><td>${e.academic_year ?? ''}</td>
                      </tr>

                      <tr>
                          <th>Current Section</th><td>${e.cur_section_code_fk ?? ''}</td>
                          <th>Medium</th><td>${e.medium_code_fk ?? ''}</td>
                      </tr>

                      <tr>
                          <th>Current Roll No</th><td>${e.cur_roll_number ?? ''}</td>
                          <th>Admission Date</th><td>${e.admission_date ?? ''}</td>
                      </tr>

                      <tr>
                          <th>Current Stream</th><td>${e.cur_stream_code ?? ''}</td>
                          <th>Admission Type</th><td>${e.admission_type_code_fk ?? ''}</td>
                      </tr>

                  </table>
                  <hr>
              `;
          }
          // ===== Facility Info =====
          if (studentData.facility) {
              const f = studentData.facility;

              html += `
                  <h6 class="card-header bg-heading-primary text-white py-2">
                  Facility & Other Details
                  </h6>
                  <table class="table table-sm table-bordered">

                      <!-- Facilities Provided -->
                      <tr>
                          <th>Facilities Provided (Year)</th><td>${f.facilities_provided_for_the_yeear ?? ''}</td>
                          <th>Free Uniforms</th><td>${f.free_uniforms ?? ''}</td>
                      </tr>

                      <tr>
                          <th>Free Transport</th><td>${f.free_transport_facility ?? ''}</td>
                          <th>Free Escort</th><td>${f.free_escort ?? ''}</td>
                      </tr>

                      <tr>
                          <th>Free Hostel</th><td>${f.free_host_facility ?? ''}</td>
                          <th>Free Bicycle</th><td>${f.free_bicycle ?? ''}</td>
                      </tr>

                      <tr>
                          <th>Free Shoes</th><td>${f.free_shoe ?? ''}</td>
                          <th>Free Exercise Books</th><td>${f.free_exercise_book ?? ''}</td>
                      </tr>

                      <tr>
                          <th>Complete Free Books</th><td>${f.complete_free_books ?? ''}</td>
                          <th></th><td></td>
                      </tr>

                      <!-- Scholarships -->
                      <tr>
                          <th>Central Scholarship</th><td>${f.central_scholarship ?? ''}</td>
                          <th>Central Scholarship Name</th><td>${f.central_scholarship_name ?? ''}</td>
                      </tr>

                      <tr>
                          <th>Central Scholarship Amount</th><td>${f.central_scholarship_amount ?? ''}</td>
                          <th>State Scholarship</th><td>${f.state_scholarship ?? ''}</td>
                      </tr>

                      <tr>
                          <th>State Scholarship Name</th><td>${f.state_scholarship_name ?? ''}</td>
                          <th>State Scholarship Amount</th><td>${f.state_scholarship_amount ?? ''}</td>
                      </tr>

                      <tr>
                          <th>Other Scholarship</th><td>${f.other_scholarship ?? ''}</td>
                          <th>Other Scholarship Amount</th><td>${f.other_scholarship_amount ?? ''}</td>
                      </tr>

                      <!-- Gifted / Special Cases -->
                      <tr>
                          <th>Hyperactive Disorder</th><td>${f.child_hyperactive_disorder ?? ''}</td>
                          <th>Extra-curricular Activities</th><td>${f.stu_extracurricular_activity ?? ''}</td>
                      </tr>

                      <tr>
                          <th>Gifted in Mathematics</th><td>${f.gifted_math ?? ''}</td>
                          <th>Gifted in Language</th><td>${f.gifted_language ?? ''}</td>
                      </tr>

                      <tr>
                          <th>Gifted in Science</th><td>${f.gifted_science ?? ''}</td>
                          <th>Gifted in Technical</th><td>${f.gifted_technical ?? ''}</td>
                      </tr>

                      <tr>
                          <th>Gifted in Sports</th><td>${f.gifted_sports ?? ''}</td>
                          <th>Gifted in Art</th><td>${f.gifted_art ?? ''}</td>
                      </tr>

                      <!-- Other details -->
                      <tr>
                          <th>Provided Mentors</th><td>${f.provided_mentors ?? ''}</td>
                          <th>Participated in Nurturance Camp</th><td>${f.whether_participated_nurturance_camp ?? ''}</td>
                      </tr>

                      <tr>
                          <th>State Level Nurturance</th><td>${f.state_nurturance ?? ''}</td>
                          <th>National Level Nurturance</th><td>${f.national_nurturance ?? ''}</td>
                      </tr>

                      <tr>
                          <th>State/National Competitions</th><td>${f.participated_competitions ?? ''}</td>
                          <th>NCC/NSS/Guides</th><td>${f.ncc_nss_guides ?? ''}</td>
                      </tr>

                      <tr>
                          <th>RTE Free Education</th><td>${f.rte_free_education ?? ''}</td>
                          <th>Homeless</th><td>${f.homeless ?? ''}</td>
                      </tr>

                      <tr>
                          <th>Special Training</th><td>${f.special_training ?? ''}</td>
                          <th>Able to Handle Digital Devices</th><td>${f.able_to_handle_devices ?? ''}</td>
                      </tr>

                      <tr>
                          <th>Internet Access</th><td>${f.internet_access ?? ''}</td>
                          <th></th><td></td>
                      </tr>

                  </table>
                  <hr>
              `;
          }

          // ===== Vocational Info =====
          if (studentData.vocational) {
              const v = studentData.vocational;

              html += `
                
                  <h6 class="card-header bg-heading-primary text-white py-2">
                  Vocational Details
                  </h6>
                  <table class="table table-sm table-bordered">

                      <tr>
                          <th>Exposure to Vocational Activities</th><td>${v.exposure ?? ''}</td>
                          <th>Undertook Vocational Course</th><td>${v.undertook ?? ''}</td>
                      </tr>

                      <tr>
                          <th>Trade / Sector</th><td>${v.trade_sector ?? ''}</td>
                          <th>Job Role</th><td>${v.job_role ?? ''}</td>
                      </tr>

                      <tr>
                          <th>Theory Hours</th><td>${v.theory_hours ?? ''}</td>
                          <th>Practical Hours</th><td>${v.practical_hours ?? ''}</td>
                      </tr>

                      <tr>
                          <th>Industry Training Hours</th><td>${v.industry_hours ?? ''}</td>
                          <th>Field Visit Hours</th><td>${v.field_visit_hours ?? ''}</td>
                      </tr>

                      <tr>
                          <th>Appeared in Exam</th><td>${v.appeared_exam ?? ''}</td>
                          <th>Marks Obtained (%)</th><td>${v.marks_obtained ?? ''}</td>
                      </tr>

                      <tr>
                          <th>Placement Applied</th><td>${v.placement_applied ?? ''}</td>
                          <th>Apprenticeship Applied</th><td>${v.apprenticeship_applied ?? ''}</td>
                      </tr>

                      <tr>
                          <th>NSQF Level</th><td>${v.nsqf_level ?? ''}</td>
                          <th>Employment Status</th><td>${v.employment_status ?? ''}</td>
                      </tr>

                      <tr>
                          <th>Salary Offered</th><td>${v.salary_offered ?? ''}</td>
                          <th></th><td></td>
                      </tr>

                  </table>
                  <hr>
              `;
          }

          // ===== Student Contact Info =====
          if (studentData.student_contact) {
          const c = studentData.student_contact;

          html += `
          <h6 class="card-header bg-heading-primary text-white py-2">
          Student Contact Details
          </h6>
          <table class="table table-sm table-bordered">

          <tr>
          <th>Country Code</th><td>${c.stu_country_code ?? ''}</td>
          <th>State</th><td>${c.stu_state_code ?? ''}</td>
          </tr>

          <tr>
          <th>District</th><td>${c.stu_contact_district ?? ''}</td>
          <th>Block</th><td>${c.stu_contact_block ?? ''}</td>
          </tr>

          <tr>
          <th>Panchayat</th><td>${c.stu_contact_panchayat ?? ''}</td>
          <th>Habitation</th><td>${c.stu_contact_habitation ?? ''}</td>
          </tr>

          <tr>
          <th>Address</th><td>${c.stu_contact_address ?? ''}</td>
          <th>Police Station</th><td>${c.stu_police_station ?? ''}</td>
          </tr>

          <tr>
          <th>Post Office</th><td>${c.stu_post_office ?? ''}</td>
          <th>PIN Code</th><td>${c.stu_pin_code ?? ''}</td>
          </tr>

          <tr>
          <th>Mobile No</th><td>${c.stu_mobile_no ?? ''}</td>
          <th>Email</th><td>${c.stu_email ?? ''}</td>
          </tr>

          </table>

          <h6 class="card-header bg-heading-primary text-white py-2">
          Guardian Contact Details
          </h6>
          <table class="table table-sm table-bordered">

          <tr>
          <th>Country Code</th><td>${c.guardian_country_code ?? ''}</td>
          <th>State</th><td>${c.guardian_state_code ?? ''}</td>
          </tr>

          <tr>
          <th>District</th><td>${c.guardian_contact_district ?? ''}</td>
          <th>Block</th><td>${c.guardian_contact_block ?? ''}</td>
          </tr>

          <tr>
          <th>Panchayat</th><td>${c.guardian_contact_panchayat ?? ''}</td>
          <th>Habitation</th><td>${c.guardian_contact_habitation ?? ''}</td>
          </tr>

          <tr>
          <th>Address</th><td>${c.guardian_contact_address ?? ''}</td>
          <th>Police Station</th><td>${c.guardian_police_station ?? ''}</td>
          </tr>

          <tr>
          <th>Post Office</th><td>${c.guardian_post_office ?? ''}</td>
          <th>PIN Code</th><td>${c.guardian_pin_code ?? ''}</td>
          </tr>

          <tr>
          <th>Mobile No</th><td>${c.guardian_mobile_no ?? ''}</td>
          <th>Email</th><td>${c.guardian_email ?? ''}</td>
          </tr>

          </table>
          <hr>
          `;
          }

          // ===== Student Bank Details =====
          if (studentData.student_bank_details) {
          const b = studentData.student_bank_details;

          html += `
          <h6 class="card-header bg-heading-primary text-white py-2">
          Student Bank Details
          </h6>
          <table class="table table-sm table-bordered">

          <tr>
          <th>Bank</th><td>${b.bank_id_fk ?? ''}</td>
          <th>Branch</th><td>${b.branch_id_fk ?? ''}</td>
          </tr>

          <tr>
          <th>IFSC Code</th><td>${b.bank_ifsc ?? ''}</td>
          <th>Account Number</th><td>${b.stu_bank_acc_no ?? ''}</td>
          </tr>

          </table>
          <hr>
          `;
          }

        document.getElementById('previewModalBody').innerHTML = html;

        const modal = new bootstrap.Modal(document.getElementById('previewModal'));
        modal.show();
    });
// ===============================
// (function () {
//   // Map tabs to numeric steps
//   const tabMap = {
//     1: {btnSelector: 'button[data-bs-target="#general_info"]', target: '#general_info'},
//     2: {btnSelector: 'button[data-bs-target="#enrollment_details"]', target: '#enrollment_details'},
//     3: {btnSelector: 'button[data-bs-target="#facility_other_dtls_tab"]', target: '#facility_other_dtls_tab'},
//     4: {btnSelector: 'button[data-bs-target="#vocational_tab"]', target: '#vocational_tab'},
//     5: {btnSelector: 'button[data-bs-target="#contact_info_tab"]', target: '#contact_info_tab'},
//     6: {btnSelector: 'button[data-bs-target="#bank_dtls_tab"]', target: '#bank_dtls_tab'},
//     7: {btnSelector: 'button[data-bs-target="#additional_dtls"]', target: '#additional_dtls_tab'}
//   };

//   // Initialize savedState from server current step (tabs <= current_step considered saved)
//   var serverCurrent = {{ intval($data['current_step'] ?? 0) }}; // e.g. 0..7
//   var savedState = {};
//   for (let i = 1; i <= 7; i++) {
//     savedState[i] = (i <= serverCurrent); // true if server says current_step >= i
//   }

//   // optional visual: disable tabs that are locked (but don't remove pointer events; actual block by event)
//   function refreshTabUI() {
//     for (let i = 1; i <= 7; i++) {
//       let btn = $(tabMap[i].btnSelector);
//       if (!btn.length) continue;
//       if (!savedState[i]) {
//         btn.addClass('disabled').attr('aria-disabled', 'true');
//       } else {
//         btn.removeClass('disabled').removeAttr('aria-disabled');
//       }
//     }
//   }
//   refreshTabUI();

//   // Block navigation to a tab if any PREVIOUS tab (smaller index) is not saved
//   $('button[data-bs-toggle="tab"]').on('show.bs.tab', function (e) {
//     // find destination tab index
//     var dest = $(e.target).data('bsTarget') || $(e.target).attr('data-bs-target');
//     if (!dest) return; // nothing to do
//     // map dest to index
//     var destIndex = null;
//     for (let i = 1; i <= 7; i++) {
//       if (tabMap[i].target === dest) { destIndex = i; break; }
//     }
//     if (destIndex === null) return;

//     // allow navigating to same or earlier tabs (back navigation) always
//     // but only allow forward to destIndex if all previous tabs (1..destIndex-1) are saved
//     if (destIndex > 1) {
//       for (let j = 1; j < destIndex; j++) {
//         if (!savedState[j]) {
//           e.preventDefault();
//           if (window.toastr) toastr.warning('Please save previous steps before proceeding.');
//           else alert('Please save previous steps before proceeding.');
//           // focus on first unsaved tab's save button (heuristic)
//           switch(j) {
//             case 1: $('#basic_info_save_btn').focus(); break;
//             case 2: $('#enrollment_details_save_btn').focus(); break;
//             case 3: $('#save_facility_and_other_dtls').focus(); break;
//             case 4: $('#save_vocational_btn').focus(); break;
//             case 5: $('#contact_info_save_btn').focus(); break;
//             case 6: $('#bank_details_of_student').focus(); break;
//             // case 7: $('#additional_details').find('button[type="submit"]').focus(); break;

//             default: break;
//           }
//           return false;
//         }
//       }
//     }
//     // allowed
//   });

//   // Listener for custom event when a tab is saved
//   // dispatch with: document.dispatchEvent(new CustomEvent('tabSaved',{detail:{tab:N}}));
//   document.addEventListener('tabSaved', function (ev) {
//     try {
//       var idx = ev.detail && ev.detail.tab ? parseInt(ev.detail.tab) : null;
//       if (!idx || !(idx in savedState)) return;
//       savedState[idx] = true;
//       refreshTabUI();

//       // auto move to next tab if not in resumeMode and next exists
//       if (!window.resumeMode) {
//         var next = idx + 1;
//         if (next <= 7 && $(tabMap[next].btnSelector).length) {
//           // use bootstrap tab show
//           $(tabMap[next].btnSelector).tab('show');
//         }
//       }
//     } catch (err) {
//       console.error('tabSaved handler error', err);
//     }
//   });

//   // Convenience: expose a function to mark saved from console if needed
//   window.__markTabSaved = function(n) {
//     document.dispatchEvent(new CustomEvent('tabSaved', {detail: {tab: n}}));
//   };

//   // ---------------------------
//   // IMPORTANT: Integration points (where to call dispatch)
//   // ---------------------------
//   // In each tab's AJAX success callback you already have, add this line (after successful save & toast):
//   //
//   //    document.dispatchEvent(new CustomEvent('tabSaved', { detail: { tab: X } }));
//   //
//   // Replace X with:
//   //   Basic Info save success  -> X = 1
//   //   Enrollment save success  -> X = 2
//   //   Facility save success    -> X = 3
//   //   Vocational save success  -> X = 4
//   //   Contact save success     -> X = 5
//   //   Bank details success     -> X = 6
//   //   Additional details save  -> X = 7
//   //
//   // Example (Basic Info success): 
//   //   success: function(res) {
//   //     // ... your existing toast/alert ...
//   //     document.dispatchEvent(new CustomEvent('tabSaved', { detail: { tab: 1 } }));
//   //   }
//   //
//   // I will now list the exact insertion points in your existing handlers:
//   //
//   // 1) In your "#basic_info_save_btn" AJAX success -> add:
//   //    document.dispatchEvent(new CustomEvent('tabSaved', { detail: { tab: 1 } }));
//   //
//   // 2) In your "#enrollment_details_save_btn" AJAX success -> add:
//   //    document.dispatchEvent(new CustomEvent('tabSaved', { detail: { tab: 2 } }));
//   //
//   // 3) In the "save_facility_and_other_dtls" .then success -> add:
//   //    document.dispatchEvent(new CustomEvent('tabSaved', { detail: { tab: 3 } }));
//   //
//   // 4) In "#save_vocational_btn" .then success -> add:
//   //    document.dispatchEvent(new CustomEvent('tabSaved', { detail: { tab: 4 } }));
//   //
//   // 5) In your "#contact_info_save_btn" AJAX success -> add:
//   //    document.dispatchEvent(new CustomEvent('tabSaved', { detail: { tab: 5 } }));
//   //
//   // 6) In the bank-details AJAX success (the form with id #bank_details_of_student) -> add:
//   //    document.dispatchEvent(new CustomEvent('tabSaved', { detail: { tab: 6 } }));
//   //
//   // 7) If you have an "additional details" save handler, add tab:7 similarly.
//   //
//   // If you prefer, you can use the helper __markTabSaved(n) in place of dispatch.

// })(); 

</script>

@endpush
@endsection
