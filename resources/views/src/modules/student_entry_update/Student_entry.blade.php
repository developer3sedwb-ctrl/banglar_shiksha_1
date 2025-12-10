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
    $bs_school_classwise_section = DB::table('bs_school_classwise_section')->pluck('id', 'id')->toArray();  

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



  <!-- ==========================DELETE PREVIOUS STUDENT ENTRY MODAL============================== -->
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



  <div class="modal fade" id="previewModal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">Preview</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body" id="previewModalBody">
        <!-- JS will fill this -->
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>


@endsection

@section('styles')
<!-- add custom styles here if needed -->
@endsection

@section('scripts')
@push('scripts')
<script src="{{ asset('assets/js/common.js') }}"></script>
<script>
  $(document).ready(function() {




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

 
  // ====================================
   




  // ======================================


  // =======================================================================

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
</script>

<script>
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
// {{-- FACILITIES AND OTHER DETAILS OF THE STUDENT Aziza End --}}
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
    const studentData = @json($data);
    
    document.getElementById('previewBtn').addEventListener('click', function () {
        let html = '';

        // ===== Basic Info =====
        if (studentData.basic_info) {
            html += `
                <h6>Basic Details</h6>
                <table class="table table-sm">
                    <tr><th>Name</th><td>${studentData.basic_info.student_name ?? ''}</td></tr>
                    <tr><th>Name (Aadhaar)</th><td>${studentData.basic_info.student_name_as_per_aadhaar ?? ''}</td></tr>
                    <tr><th>Gender</th><td>${studentData.basic_info.gender ?? ''}</td></tr>
                    <tr><th>DOB</th><td>${studentData.basic_info.dob ?? ''}</td></tr>
                    <tr><th>Father</th><td>${studentData.basic_info.father_name ?? ''}</td></tr>
                    <tr><th>Mother</th><td>${studentData.basic_info.mother_name ?? ''}</td></tr>
                </table>
                <hr>
            `;
        }

        // ===== Enrollment Info =====
        if (studentData.enrollment_info) {
            html += `
                <h6>Enrollment Details</h6>
                <table class="table table-sm">
                    <tr><th>Admission No</th><td>${studentData.enrollment_info.admission_no ?? ''}</td></tr>
                    <tr><th>Current Class</th><td>${studentData.enrollment_info.cur_class_code_fk ?? ''}</td></tr>
                    <tr><th>Section</th><td>${studentData.enrollment_info.cur_section_code_fk ?? ''}</td></tr>
                    <tr><th>Roll No</th><td>${studentData.enrollment_info.cur_roll_number ?? ''}</td></tr>
                    <tr><th>Admission Date</th><td>${studentData.enrollment_info.admission_date ?? ''}</td></tr>
                </table>
                <hr>
            `;
        }

        // ===== Vocational Details =====
        if (studentData.vocational) {
            html += `
                <h6>Vocational Details</h6>
                <table class="table table-sm">
                    <tr><th>Exposure</th><td>${studentData.vocational.exposure ?? ''}</td></tr>
                    <tr><th>Undertook Course</th><td>${studentData.vocational.undertook ?? ''}</td></tr>
                    <tr><th>Trade / Sector</th><td>${studentData.vocational.trade_sector ?? ''}</td></tr>
                    <tr><th>Job Role</th><td>${studentData.vocational.job_role ?? ''}</td></tr>
                    <tr><th>NSQF Level</th><td>${studentData.vocational.nsqf_level ?? ''}</td></tr>
                    <tr><th>Employment Status</th><td>${studentData.vocational.employment_status ?? ''}</td></tr>
                    <tr><th>Salary Offered</th><td>${studentData.vocational.salary_offered ?? ''}</td></tr>
                </table>
                <hr>
            `;
        }

        // ===== Contact Details =====
        if (studentData.student_contact) {
            html += `
                <h6>Contact Details (Student)</h6>
                <table class="table table-sm">
                    <tr><th>Address</th><td>${studentData.student_contact.stu_contact_address ?? ''}</td></tr>
                    <tr><th>District</th><td>${studentData.student_contact.stu_contact_district ?? ''}</td></tr>
                    <tr><th>Block</th><td>${studentData.student_contact.stu_contact_block ?? ''}</td></tr>
                    <tr><th>Mobile</th><td>${studentData.student_contact.stu_mobile_no ?? ''}</td></tr>
                    <tr><th>Email</th><td>${studentData.student_contact.stu_email ?? ''}</td></tr>
                </table>
                <hr>
            `;
        }

        // ===== Bank Details =====
        if (studentData.student_bank_details) {
            html += `
                <h6>Bank Details</h6>
                <table class="table table-sm">
                    <tr><th>Bank ID</th><td>${studentData.student_bank_details.bank_id_fk ?? ''}</td></tr>
                    <tr><th>Branch ID</th><td>${studentData.student_bank_details.branch_id_fk ?? ''}</td></tr>
                    <tr><th>IFSC</th><td>${studentData.student_bank_details.bank_ifsc ?? ''}</td></tr>
                    <tr><th>Account No</th><td>${studentData.student_bank_details.stu_bank_acc_no ?? ''}</td></tr>
                </table>
            `;
        }

        if (!html) {
            html = '<p>No data found for preview.</p>';
        }

        document.getElementById('previewModalBody').innerHTML = html;

        const modal = new bootstrap.Modal(document.getElementById('previewModal'));
        modal.show();
    });
</script>

@endpush
@endsection
