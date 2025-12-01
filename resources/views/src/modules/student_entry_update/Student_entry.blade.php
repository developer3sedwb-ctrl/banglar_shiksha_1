@extends('layouts.app')

@section('title', 'Add Student')

@section('content')

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

    $genders = $gender_master;
    $mother_tongue = $mother_tongue_master;
    
    $social_category = $social_category_master;
    $religion = $religion_master;

    $nationality = $nationality_master;
    $blood_group = $blood_group_master;
    
    $guardian_relationship = $guardian_relationship_master;
    $income = $income_master;

    $guardian_qualification = $guardian_qualification_master;

@endphp

<div class="container-fluid full-width-content">

  <!-- PAGE HEADING -->
 <div class="page-header mb-3 d-flex justify-content-between align-items-center">
  <div class="page-header mb-3">
    <h4 class="fw-bold"><i class="bx bx-user"></i> Add Student</h4>
  </div>
  <div class="d-flex gap-2">
    <a href="{{ route('student.bulk.upload') }}" class="btn btn-success">
        <i class="bx bx-upload"></i> Student Bulk Upload
    </a>
    <a href="{{ route('dashboard') }}" class="btn btn-primary">
      <i class="bx bx-arrow-back"></i> Back
    </a>
  </div>
</div>

  <!-- CARD WITH TABS -->
  <div class="card card-full">
    <div class="card-header d-flex align-items-center justify-content-between border-bottom">
      <ul class="nav nav-tabs mb-0" id="studentTab" role="tablist">
        <li class="nav-item" role="presentation">
          <button class="nav-link active" id="general_info-tab" data-bs-toggle="tab" data-bs-target="#general_info" type="button" role="tab">General Info</button>
        </li>

         <li class="nav-item" role="presentation">
          <button class="nav-link" id="enrollment_details-tab" data-bs-toggle="tab" data-bs-target="#enrollment_details" type="button" role="tab">Enrollment Details</button>
        </li>
      </ul>
    </div>

    <div class="card-body">
      <div class="tab-content" id="studentTabContent">
        <!-- ========================== -->
          <div class="tab-pane fade show active" id="general_info" role="tabpanel" aria-labelledby="general_info-tab">
            <form id="basic_info_of_student" method="POST" action="#" novalidate>
              @csrf
              <h6 class=" card-header bg-heading-primary text-white py-2">
              GENERAL INFORMATION OF THE STUDENT
              </h6>
              <div class="row form-row-gap">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label small">Name of the Student <span class="text-danger">*</span></label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="bx bx-user"></i></span>
                      <input name="student_name" type="text" class="form-control" placeholder="Name of the student" required>
                    </div>
                  </div>

                  <div class="mb-3">
                    <label class="form-label small">Gender <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bx bx-book"></i></span>
                        <select name="gender" class="form-select" required>
                            <option value="">-Please Select-</option>
                            @foreach($genders ?? [] as $val => $label)
                                <option value="{{ $val }}">{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                  </div>

                  <div class="mb-3">
                      <label class="form-label small" for="dobField">
                          Date of Birth <span class="text-danger">*</span>
                      </label>
                      <div class="input-group" id="dobGroup" style="cursor:pointer;">
                          <span class="input-group-text"><i class="bx bx-calendar"></i></span>
                          <input id="dobField" name="dob" type="date" class="form-control" required>
                      </div>
                  </div>

                  <div class="mb-3">
                    <label class="form-label small">Father's Name <span class="text-danger">*</span></label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="bx bx-user"></i></span>
                      <input name="father_name" type="text" class="form-control" placeholder="Father's name" required>
                    </div>
                  </div>

                  <div class="mb-3">
                    <label class="form-label small">Mother's Name <span class="text-danger">*</span></label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="bx bx-user"></i></span>
                      <input name="mother_name" type="text" class="form-control" placeholder="Mother's name" required>
                    </div>
                  </div>

                  <div class="mb-3">
                    <label class="form-label small">Guardian's  Name <span class="text-danger">*</span></label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="bx bx-user"></i></span>
                      <input name="guardian_name" type="text" class="form-control" placeholder="Guardian's name" required>
                    </div>
                  </div>

                  <div class="mb-3">
                    <label class="form-label small">Aadhaar No of Child</label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="bx bx-id-card"></i></span>
                      <input name="aadhaar_child" type="text" class="form-control" placeholder="Aadhaar no of child">
                    </div>
                  </div>

                  <div class="mb-3">
                    <label class="form-label small">Name of Student as Per Aadhaar</label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="bx bx-id-card"></i></span>
                    <input name="student_name_as_per_aadhaar" type="text" class="form-control" placeholder="Name of student as per Aadhaar">
                    </div>
                  </div>

                  <div class="mb-3">
                      <label class="form-label small">Mother Tongue of the Child</label>
                      <div class="input-group">
                          <span class="input-group-text"><i class="bx bx-message-alt-detail"></i></span>
                          <select name="mother_tongue" class="form-select">
                              <option value="">-Please Select-</option>
                                @foreach($mother_tongue ?? [] as $val => $label)
                                  <option value="{{ $val }}">{{ $label }}</option>
                              @endforeach
                          </select>
                      </div>
                  </div>

                  <div class="mb-3">
                    <label class="form-label small">Social Category<span class="text-danger">*</span></label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="bx bx-book"></i></span>
                    <select name="social_category" class="form-select" required>
                        <option value="">-Please Select-</option>
                        @foreach($social_category ?? [] as $val => $label)
                        
                            <option value="{{ $val }}">{{ $label }}</option>
                        @endforeach
                    </select>
                    </div>
                  </div>

                  <div class="mb-3">
                    <label class="form-label small">Religion <span class="text-danger">*</span></label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="bx bx-book"></i></span>
                      <select name="religion" class="form-select" required>
                        <option value="">-Please Select-</option>
                          @foreach($religion ?? [] as $val => $label)
                            <option value="{{ $val }}">{{ $label }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>

                  <div class="mb-3">
                    <label class="form-label small">Whether BPL Beneficiary?</label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="bx bx-check"></i></span>
                      <select name="bpl_beneficiary" class="form-select">
                        <option value="">-Please Select-</option>
                        @foreach($dropdowns['yes_no'] as $val => $label)
                            <option value="{{ $val }}">{{ $label }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>

                  <div class="mb-3">
                    <label class="form-label small">Whether belongs to EWS / Disadvantaged Group</label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="bx bx-wallet"></i></span>
                      <select name="disadvantaged_group" class="form-select">
                        <option value="">-Please Select-</option>
                            @foreach($dropdowns['yes_no'] as $val => $label)
                                <option value="{{ $val }}">{{ $label }}</option>
                            @endforeach
                      </select>
                    </div>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label small">Whether CWSN (Child with Special Needs)?</label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="bx bx-heart"></i></span>
                      <select name="cwsn" class="form-select">
                        <option value="">-Please Select-</option>
                            @foreach($dropdowns['yes_no'] as $val => $label)
                                <option value="{{ $val }}">{{ $label }}</option>
                            @endforeach
                      </select>
                    </div>
                  </div>

                  <div class="mb-3">
                    <label class="form-label small">Nationality</label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="bx bx-flag"></i></span>
                    <select name="nationality" class="form-select">
                        <option value="">-Please Select-</option>

                            @foreach($nationality ?? [] as $val => $label)
                                <option value="{{ $val }}">{{ $label }}</option>
                            @endforeach
                      </select>
                    </div>
                  </div>

                  <div class="mb-3">
                    <label class="form-label small">Is the Child enrolled as Out of School Child?</label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="bx bx-school"></i></span>
                      <select name="out_of_school" class="form-select">
                        <option value="">-Please Select-</option>
                        @foreach($dropdowns['yes_no'] as $val => $label)
                        
                            <option value="{{ $val }}">{{ $label }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>

                  <div class="mb-3">
                    <label class="form-label small">Blood Group</label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="bx bx-droplet"></i></span>
                      <select name="blood_group" class="form-select">
                        <option value="">-Please Select-</option>
                                  @foreach($blood_group ?? [] as $val => $label)
                              <option value="{{ $val }}">{{ $label }}</option>
                          @endforeach
                      </select>
                    </div>
                  </div>

                  <div class="mb-3">
                    <label class="form-label small">Birth Registration Number</label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="bx bx-spreadsheet"></i></span>
                      <input name="birth_reg_no" type="text" class="form-control" placeholder="Birth registration number">
                    </div>
                  </div>

                  <div class="mb-3">
                    <label class="form-label small">Identification Mark</label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="bx bx-id"></i></span>
                      <input name="identification_mark" type="text" class="form-control" placeholder="Identify mark (if any)">
                    </div>
                  </div>

                  <div class="mb-3">
                    <label class="form-label small">Health ID</label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="bx bx-link-alt"></i></span>
                      <input name="health_id" type="text" class="form-control" placeholder="Health ID">
                    </div>
                  </div>

                  <div class="mb-3">
                    <label class="form-label small">Relationship with Guardian</label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="bx bx-link-alt"></i></span>
                      <select name="relationship_with_guardian" class="form-select">
                        <option value="">-Please Select-</option>
                            @foreach($guardian_relationship ?? [] as $val => $label)
                              <option value="{{ $val }}">{{ $label }}</option>
                          @endforeach
                      </select>
                    </div>
                  </div>

                  <div class="mb-3">
                    <label class="form-label small">Anual Family income</label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="bx bx-school"></i></span>
                      <select name="family_income" class="form-select">
                        <option value="">-Please Select-</option>
                                @foreach($income ?? [] as $val => $label)
                                    <option value="{{ $val }}">{{ $label }}</option>
                                @endforeach
                      </select>
                    </div>
                  </div>

                  <div class="mb-3">
                    <label class="form-label small">Student Height(in cms)</label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="bx bx-link-alt"></i></span>
                      <input name="student_height" type="text" class="form-control" placeholder="Student Height">
                    </div>
                  </div>

                  <div class="mb-3">
                    <label class="form-label small">Student Weight(in Kg's)</label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="bx bx-link-alt"></i></span>
                      <input name="student_weight" type="text" class="form-control" placeholder="Student Weight">
                    </div>
                  </div>

                <div class="mb-3">
                    <label class="form-label small">Guardian's Qualification?</label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="bx bx-school"></i></span>
                    <select name="guardian_qualifications" class="form-select">
                        <option value="">-Please Select-</option>
                        @foreach($guardian_qualification ?? [] as $val => $label)
                        <option value="{{ $val }}">{{ $label }}</option>
                          @endforeach
                      </select>
                    </div>
                  </div>
                </div>
              </div>

              <div class="form-actions text-end mt-3">
                <button id="basic_info_save_btn" class="btn btn-success" type="button">Next</button>
              </div>
            </form>
          </div>
         <!-- ========================== -->
         <!-- TAB 2: ENROLMENT DETAILS -->
        <div class="tab-pane fade" id="enrollment_details" role="tabpanel" aria-labelledby="enrollment_details-tab">
          <form id="enrollment_details_form" method="POST" action="#" novalidate>
            @csrf

            <h6 class=" card-header bg-heading-primary text-white py-2">
            ENROLLMENT DETAILS OF STUDENT IN PRESENT SCHOOL FOR CURRENT YEAR
            </h6> 
            <div class="row">
              <div class="col-md-6">
                <!-- Admission Number in School -->
                <div class="mb-3">
                  <label class="form-label small">Admission Number in School</label>
                  <div class="input-group">
                    <span class="input-group-text"><i class="bx bx-hash"></i></span>
                    <input name="admission_number" type="text" class="form-control" placeholder="Admission number in school">
                  </div>
                </div>

                <!-- Status of Admission in Previous Academic Year / Year of Rejoining -->
                <div class="mb-3">
                  <label class="form-label small">Status of student in Previous Academic Year of Schooling *</label>
                  <div class="input-group">
                    <span class="input-group-text"><i class="bx bx-history"></i></span>
                    <select name="admission_status_prev" class="form-select">
                      <option value="">-Please Select-</option>
                      <option value="Continuing">Continuing</option>
                      <option value="Re-joined">Re-joined</option>
                      <option value="New Admission">New Admission</option>
                    </select>
                  </div>
                </div>

                <!-- Present Class -->
                <div class="mb-3">
                  <label class="form-label small">Present Class</label>
                  <div class="input-group">
                    <span class="input-group-text"><i class="bx bx-book-open"></i></span>
                    <select name="present_class" class="form-select">
                      <option value="">-Please Select-</option>
                      <option value="Nursery">Nursery</option>
                      <option value="KG">KG</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <!-- add more as needed -->
                    </select>
                  </div>
                </div>

                <!-- Academic Year -->
                <div class="mb-3">
                  <label class="form-label small">Academic Year</label>
                  <div class="input-group">
                    <span class="input-group-text"><i class="bx bx-calendar-alt"></i></span>
                    <input name="academic_year" type="text" class="form-control" placeholder="e.g. 2024-2025">
                  </div>
                </div>

                <!-- Present Section -->
                <div class="mb-3">
                  <label class="form-label small">Present Section</label>
                  <div class="input-group">
                    <span class="input-group-text"><i class="bx bx-layout"></i></span>
                    <input name="present_section" type="text" class="form-control" placeholder="Section (if any)">
                  </div>
                </div>

                <!-- Present Medium -->
                <div class="mb-3">
                  <label class="form-label small">Present Medium</label>
                  <div class="input-group">
                    <span class="input-group-text"><i class="bx bx-chat"></i></span>
                    <select name="present_medium" class="form-select">
                      <option value="">-Please Select-</option>
                      <option value="English">English</option>
                      <option value="Hindi">Hindi</option>
                      <option value="Regional">Regional</option>
                    </select>
                  </div>
                </div>

              </div>

              <div class="col-md-6">
                <!-- Admission Date in Present Class -->
                <div class="mb-3">
                  <label class="form-label small">Admission Date in Present Class</label>
                  <div class="input-group">
                    <span class="input-group-text"><i class="bx bx-calendar"></i></span>
                    <input name="admission_date_present" type="date" class="form-control">
                  </div>
                </div>


                <!-- Present Roll No -->
                <div class="mb-3">
                  <label class="form-label small">Present Roll No</label>
                  <div class="input-group">
                    <span class="input-group-text"><i class="bx bx-list-ol"></i></span>
                    <input name="present_roll_no" type="number" class="form-control" placeholder="Roll number">
                  </div>
                </div>

                <!-- Admission Type -->
                <div class="mb-3">
                  <label class="form-label small">Admission Type</label>
                  <div class="input-group">
                    <span class="input-group-text"><i class="bx bx-transfer-alt"></i></span>
                    <select name="admission_type" class="form-select">
                      <option value="">-Please Select-</option>
                      <option value="Regular">Regular</option>
                      <option value="Transfer">Transfer</option>
                      <option value="Other">Other</option>
                    </select>
                  </div>
                </div>

                <!-- Admission Category -->
              </div>
            </div>

            <div class="form-actions text-end mt-3">
              <button class="btn btn-secondary me-2" data-bs-toggle="tab" data-bs-target="#general_info" type="button">Previous</button>
              <button class="btn btn-success" data-bs-toggle="tab" data-bs-target="#tab3" type="button">Next</button>
            </div>
          </form>
        </div>
          <!-- ========================== -->
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
<script>
$(function() {

  function clearInlineErrors() {
    $('.is-invalid').removeClass('is-invalid');
    $('.invalid-feedback.js-dynamic').remove();
  }

  function getCsrfToken() {
    return $('meta[name="csrf-token"]').attr('content') || '';
  }

  $('#basic_info_save_btn').off('click').on('click', function () {
    var $btn = $(this);
    var $basicForm = $('#basic_info_of_student');
    var $enrollForm = $('#enrollment_details_form'); // must exist (see blade change)

    clearInlineErrors();

    $btn.prop('disabled', true).text('Saving...');

    // Start with FormData from basic info form
    var formData = new FormData($basicForm[0]);

    // If enrollment form exists, append its fields to the same FormData
    if ($enrollForm.length) {
      // Use native elements to include file inputs correctly and match browser behavior.
      // We'll append each input/select/textarea that has a name and is not disabled.
      $enrollForm.find('input, select, textarea').each(function() {
        var el = this;
        var $el = $(el);
        var name = $el.attr('name');

        if (!name || $el.prop('disabled')) return;

        // For checkboxes/radios: only append if checked
        if (el.type === 'checkbox' || el.type === 'radio') {
          if (!el.checked) return;
        }

        // For file inputs: append all files
        if (el.type === 'file') {
          var files = el.files;
          for (var i = 0; i < files.length; i++) {
            // Append multiple files using same field name (as browser does)
            formData.append(name, files[i]);
          }
        } else {
          // Normal inputs/selects/textareas: append value.
          // Note: if name already exists, FormData.append will create a second entry.
          formData.append(name, $el.val());
        }
      });
    }

    // Debug: list entries (optional, safe to remove in production)
    console.log("------ MERGED FORM DATA ------");
    for (let pair of formData.entries()) {
      console.log(pair[0] + ':', pair[1]);
    }
    console.log("------ END MERGED FORM DATA ------");

    $.ajax({
      url: "{{ route('student.store') }}",
      type: "POST",
      data: formData,
      processData: false,
      contentType: false,
      dataType: 'json',
      headers: {
        'X-CSRF-TOKEN': getCsrfToken(),
        'Accept': 'application/json'
      },
      timeout: 20000,

      beforeSend: function() {
        console.log('Sending merged AJAX to {{ route("student.store") }}');
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

@endpush
@endsection
