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
      <div class="row">
        @if(isset($data['current_step']) && $data['current_step'] > 1)
        <div class="alert alert-danger d-flex justify-content-between align-items-center">
            <span>
                <strong>Resume Entry?</strong> You have an unfinished student entry at Step {{ $data['current_step'] }}.
            </span>

            <div>
                <!-- Resume Button -->
                <button id="resumeEntryBtn" class="btn btn-success btn-sm">
                    Resume from Step {{ $data['current_step'] }}
                </button>

                <!-- Start New Button -->
                <button id="startNewEntryBtn" class="btn btn-danger btn-sm">
                    Start New Entry
                </button>
            </div>
        </div>
        @endif
      </div>
    <div class="card-header d-flex align-items-center justify-content-between border-bottom">

      <ul class="nav nav-tabs mb-0" id="studentTab" role="tablist">
        <li class="nav-item" role="presentation">
          <button class="nav-link active" id="general_info-tab" data-bs-toggle="tab" data-bs-target="#general_info"
            type="button" role="tab">General Info</button>
        </li>

        <li class="nav-item" role="presentation">
          <button class="nav-link" id="enrollment_details-tab" data-bs-toggle="tab" data-bs-target="#enrollment_details"
            type="button" role="tab">Enrollment Details</button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="tab3-tab" data-bs-toggle="tab" data-bs-target="#tab3" type="button"
            role="tab">Facilities & Other Detais</button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="tab4-tab" data-bs-toggle="tab" data-bs-target="#tab4" type="button"
            role="tab">Vocational Details</button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="tab5-tab" data-bs-toggle="tab" data-bs-target="#tab5" type="button"
            role="tab">Contact Info</button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="tab6-tab" data-bs-toggle="tab" data-bs-target="#tab6" type="button"
            role="tab">Bank Details</button>
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
                  <label class="form-label small">Name of the Student <span class="text-danger"> *</span></label>
                  <div class="input-group">
                    <span class="input-group-text"><i class="bx bx-user"></i></span>
                    <input name="student_name" type="text" class="form-control" placeholder="Name of the student"
                      required>
                  </div>
                </div>

                <div class="mb-3">
                  <label class="form-label small">Gender <span class="text-danger"> *</span></label>
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
                    Date of Birth <span class="text-danger"> *</span>
                  </label>
                  <div class="input-group" id="dobGroup" style="cursor:pointer;">
                    <span class="input-group-text"><i class="bx bx-calendar"></i></span>
                    <input id="dobField" name="dob" type="date" class="form-control" required>
                  </div>
                </div>

                <div class="mb-3">
                  <label class="form-label small">Father's Name <span class="text-danger"> *</span></label>
                  <div class="input-group">
                    <span class="input-group-text"><i class="bx bx-user"></i></span>
                    <input name="father_name" type="text" class="form-control" placeholder="Father's name" required>
                  </div>
                </div>

                <div class="mb-3">
                  <label class="form-label small">Mother's Name <span class="text-danger"> *</span></label>
                  <div class="input-group">
                    <span class="input-group-text"><i class="bx bx-user"></i></span>
                    <input name="mother_name" type="text" class="form-control" placeholder="Mother's name" required>
                  </div>
                </div>

                <div class="mb-3">
                  <label class="form-label small">Guardian's Name <span class="text-danger"> *</span></label>
                  <div class="input-group">
                    <span class="input-group-text"><i class="bx bx-user"></i></span>
                    <input name="guardian_name" type="text" class="form-control" placeholder="Guardian's name" required>
                  </div>
                </div>

                <div class="mb-3">
                  <label class="form-label small">Aadhaar No of Child</label>
                  <div class="input-group">
                    <span class="input-group-text"><i class="bx bx-id-card"></i></span>
                    <input id="aadhaar_child" name="aadhaar_child" type="text" class="form-control"
                      placeholder="Aadhaar no of child" maxlength="12">
                  </div>
                </div>

                <div class="mb-3">
                  <label class="form-label small">Name of Student as Per Aadhaar</label>
                  <div class="input-group">
                    <span class="input-group-text"><i class="bx bx-id-card"></i></span>
                    <input name="student_name_as_per_aadhaar" type="text" class="form-control"
                      placeholder="Name of student as per Aadhaar">
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
                  <label class="form-label small">Social Category<span class="text-danger"> *</span></label>
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
                  <label class="form-label small">Religion <span class="text-danger"> *</span></label>
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
                    <input name="identification_mark" type="text" class="form-control"
                      placeholder="Identify mark (if any)">
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
                    <input name="admission_number" type="text" class="form-control"
                      placeholder="Admission number in school">
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
              <button class="btn btn-secondary me-2" data-bs-toggle="tab" data-bs-target="#general_info"
                type="button">Previous</button>
              <button class="btn btn-success" data-bs-toggle="tab" data-bs-target="#tab3" type="button">Next</button>
            </div>
          </form>
        </div>
        <!-- TAB 3: FACILITY AND OTHER DETAILS START BY AZIZA-->
        <div class="tab-pane fade" id="tab3" role="tabpanel" aria-labelledby="tab3-tab">

          @php
          $val = $data['facility'] ?? [];
          @endphp

          <form id="student_facility_other_dtls_form">
            @csrf

            <!-- ========================================================= -->
            <!-- FACILITIES PROVIDED -->
            <!-- ========================================================= -->
            <h6 class="card-header bg-heading-primary text-white py-2">
              FACILITIES AND OTHER DETAILS OF THE STUDENT
            </h6>

            <div class="row mt-3">

              {{-- Facilities Provided --}}
              <div class="col-md-6">
                <label for="facilities_provided_for_the_yeear" class="form-label small fw-bold">
                  Facilities provided to the student<span class="text-danger"> *</span>
                </label>
                <select id="facilities_provided_for_the_yeear" name="facilities_provided_for_the_yeear"
                  class="form-select" required>
                  <option value="">-Please Select-</option>
                  <option value="1" {{ ($val['facilities_provided_for_the_yeear'] ?? '' )==1 ? 'selected' : '' }}>YES
                  </option>
                  <option value="2" {{ ($val['facilities_provided_for_the_yeear'] ?? '' )==2 ? 'selected' : '' }}>NO
                  </option>
                </select>
              </div>

              {{-- FREE TRANSPORT FACILITY --}}
              <div class="col-md-6">
                <label for="free_transport_facility" class="form-label small fw-bold">Free Transport Facility<span class="text-danger"> *</span></label>
                <select id="free_transport_facility" name="free_transport_facility" class="form-select" required>
                  <option value="">-Please Select-</option>
                  <option value="1" {{ ($val['free_transport_facility'] ?? '' )==1 ? 'selected' : '' }}>YES</option>
                  <option value="2" {{ ($val['free_transport_facility'] ?? '' )==2 ? 'selected' : '' }}>NO</option>
                </select>
              </div>

              {{-- FREE HOST FACILITY --}}
              <div class="col-md-6">
                <label for="free_host_facility" class="form-label small fw-bold">Free Host Facility<span class="text-danger"> *</span></label>
                <select id="free_host_facility" name="free_host_facility" class="form-select" required>
                  <option value="">-Please Select-</option>
                  <option value="1" {{ ($val['free_host_facility'] ?? '' )==1 ? 'selected' : '' }}>YES</option>
                  <option value="2" {{ ($val['free_host_facility'] ?? '' )==2 ? 'selected' : '' }}>NO</option>
                </select>
              </div>

              {{-- FREE BICYCLE --}}
              <div class="col-md-6">
                <label for="free_bicycle" class="form-label small fw-bold">Free Bicycle<span class="text-danger">
                    *</span></label>
                <select id="free_bicycle" name="free_bicycle" class="form-select" required>
                  <option value="">-Please Select-</option>
                  <option value="1" {{ ($val['free_bicycle'] ?? '' )==1 ? 'selected' : '' }}>YES</option>
                  <option value="2" {{ ($val['free_bicycle'] ?? '' )==2 ? 'selected' : '' }}>NO</option>
                </select>
              </div>

              {{-- FREE UNIFORMS --}}
              <div class="col-md-6">
                <label for="free_uniforms" class="form-label small fw-bold">Free Uniforms<span class="text-danger">
                    *</span></label>
                <select id="free_uniforms" name="free_uniforms" class="form-select" required>
                  <option value="">-Please Select-</option>
                  <option value="1" {{ ($val['free_uniforms'] ?? '' )==1 ? 'selected' : '' }}>YES</option>
                  <option value="2" {{ ($val['free_uniforms'] ?? '' )==2 ? 'selected' : '' }}>NO</option>
                </select>
              </div>

              {{-- FREE ESCORT --}}
              <div class="col-md-6">
                <label for="free_escort" class="form-label small fw-bold">Free Escort<span class="text-danger">
                    *</span></label>
                <select id="free_escort" name="free_escort" class="form-select" required>
                  <option value="">-Please Select-</option>
                  <option value="1" {{ ($val['free_escort'] ?? '' )==1 ? 'selected' : '' }}>YES</option>
                  <option value="2" {{ ($val['free_escort'] ?? '' )==2 ? 'selected' : '' }}>NO</option>
                </select>
              </div>

              {{-- FREE SHOE --}}
              <div class="col-md-6">
                <label for="free_shoe" class="form-label small fw-bold">Free Shoe<span class="text-danger">
                    *</span></label>
                <select id="free_shoe" name="free_shoe" class="form-select" required>
                  <option value="">-Please Select-</option>
                  <option value="1" {{ ($val['free_shoe'] ?? '' )==1 ? 'selected' : '' }}>YES</option>
                  <option value="2" {{ ($val['free_shoe'] ?? '' )==2 ? 'selected' : '' }}>NO</option>
                </select>
              </div>

              {{-- FREE EXERCISE BOOK --}}
              <div class="col-md-6">
                <label for="free_exercise_book" class="form-label small fw-bold">Free Exercise Book<span class="text-danger"> *</span></label>
                <select id="free_exercise_book" name="free_exercise_book" class="form-select" required>
                  <option value="">-Please Select-</option>
                  <option value="1" {{ ($val['free_exercise_book'] ?? '' )==1 ? 'selected' : '' }}>YES</option>
                  <option value="2" {{ ($val['free_exercise_book'] ?? '' )==2 ? 'selected' : '' }}>NO</option>
                </select>
              </div>

              {{-- COMPLETE FREE BOOKS --}}
              <div class="col-md-6">
                <label for="complete_free_books" class="form-label small fw-bold">Complete Set of Free Books<span class="text-danger"> *</span></label>
                <select id="complete_free_books" name="complete_free_books" class="form-select" required>
                  <option value="">-Please Select-</option>
                  <option value="1" {{ ($val['complete_free_books'] ?? '' )==1 ? 'selected' : '' }}>YES</option>
                  <option value="2" {{ ($val['complete_free_books'] ?? '' )==2 ? 'selected' : '' }}>NO</option>
                </select>
              </div>

            </div>

            <!-- ========================================================= -->
            <!-- SCHOLARSHIP SECTION WITH PREFILL -->
            <!-- ========================================================= -->

            <h6 class="card-header bg-heading-primary text-white py-2 mt-3">SCHOLARSHIP RECEIVED BY STUDENT</h6>

            <div class="row mt-3">

              {{-- CENTRAL SCHOLARSHIP --}}
              <div class="col-md-6">
                <label for="central_scholarship" class="form-label small fw-bold">Central Scholarship<span class="text-danger"> *</span></label>
                <select id="central_scholarship" name="central_scholarship" class="form-select" required>
                  <option value="">-Select-</option>
                  <option value="1" {{ ($val['central_scholarship'] ?? '' )==1 ? 'selected' : '' }}>YES</option>
                  <option value="2" {{ ($val['central_scholarship'] ?? '' )==2 ? 'selected' : '' }}>NO</option>
                </select>
              </div>

              {{-- CENTRAL SCHOLARSHIP NAME --}}
              <div
                class="col-md-6 {{ isset($val['central_scholarship']) && $val['central_scholarship'] == 1 ? '' : 'd-none' }}">
                <label for="central_scholarship_name" class="form-label small fw-bold">Name of Central
                  Scholarship<span class="text-danger"> *</span></label>
                <select id="central_scholarship_name" name="central_scholarship_name" class="form-select">
                  <option value="">--Select Scholarship--</option>

                  @foreach ($data['centralScholarships'] as $sch)
                  <option value="{{ $sch->id }}" {{ ($val['central_scholarship_name'] ?? '' )==$sch->id ? 'selected' :
                    '' }}>
                    {{ $sch->name }}
                  </option>
                  @endforeach

                </select>
              </div>

              {{-- CENTRAL AMOUNT --}}
              <div
                class="col-md-6 {{ isset($val['central_scholarship']) && $val['central_scholarship'] == 1 ? '' : 'd-none' }}">
                <label for="central_scholarship_amount" class="form-label small fw-bold">Central Scholarship
                  Amount<span class="text-danger"> *</span></label>
                <input type="number" id="central_scholarship_amount" name="central_scholarship_amount"
                  class="form-control" value="{{ $val['central_scholarship_amount'] ?? '' }}">
              </div>

              {{-- STATE SCHOLARSHIP --}}
              <div class="col-md-6">
                <label for="state_scholarship" class="form-label small fw-bold">State Scholarship<span class="text-danger"> *</span></label>
                <select id="state_scholarship" name="state_scholarship" class="form-select" required>
                  <option value="">-Select-</option>
                  <option value="1" {{ ($val['state_scholarship'] ?? '' )==1 ? 'selected' : '' }}>YES</option>
                  <option value="2" {{ ($val['state_scholarship'] ?? '' )==2 ? 'selected' : '' }}>NO</option>
                </select>
              </div>

              {{-- STATE SCHOLARSHIP NAME --}}
              <div
                class="col-md-6 {{ isset($val['state_scholarship']) && $val['state_scholarship'] == 1 ? '' : 'd-none' }}">
                <label for="state_scholarship_name" class="form-label small fw-bold">State Scholarship Name<span class="text-danger"> *</span></label>
                <select id="state_scholarship_name" name="state_scholarship_name" class="form-select">
                  <option value="">-- Select Scholarship --</option>

                  @foreach ($data['stateScholarships'] as $sch)
                  <option value="{{ $sch->id }}" {{ ($val['state_scholarship_name'] ?? '' )==$sch->id ? 'selected' : ''
                    }}>
                    {{ $sch->name }}
                  </option>
                  @endforeach

                </select>
              </div>

              {{-- STATE AMOUNT --}}
              <div
                class="col-md-6 {{ isset($val['state_scholarship']) && $val['state_scholarship'] == 1 ? '' : 'd-none' }}">
                <label for="state_scholarship_amount" class="form-label small fw-bold">State Scholarship Amount <span class="text-danger">*</span></label>
                <input type="number" id="state_scholarship_amount" name="state_scholarship_amount" class="form-control"
                  value="{{ $val['state_scholarship_amount'] ?? '' }}">
              </div>
              {{-- Other SCHOLARSHIP NAME --}}
              <div
                class="col-md-6">
                <label for="state_scholarship_name" class="form-label small fw-bold">Other Scholarship<span class="text-danger"> *</span></label>
                <select id="other_scholarship" name="other_scholarship" class="form-select" required>
                  <option value="">-Select-</option>
                  <option value="1" {{ ($val['other_scholarship'] ?? '' )==1 ? 'selected' : '' }}>YES</option>
                  <option value="2" {{ ($val['other_scholarship'] ?? '' )==2 ? 'selected' : '' }}>NO</option>
                </select>
              </div>

              {{-- STATE AMOUNT --}}
              <div
                class="col-md-6 {{ isset($val['other_scholarship']) && $val['other_scholarship'] == 1 ? '' : 'd-none' }}">
                <label for="other_scholarship_amount" class="form-label small fw-bold">Other Scholarship Amount<span class="text-danger"> *</span></label>
                <input type="number" id="other_scholarship_amount" name="other_scholarship_amount" class="form-control"
                  value="{{ $val['other_scholarship_amount'] ?? '' }}">
              </div>

            </div>

            <!-- ========================================================= -->
            <!-- OTHER FIELDS, GIFTED, DIGITAL ACCESS... (SIMILAR FORMAT) -->
            <!-- ========================================================= -->

            <!-- ========================================================= -->
            <!-- GIFTED / TALENTED CHILD -->
            <!-- ========================================================= -->
            <h6 class="card-header bg-heading-primary text-white py-2 mt-3">
              GIFTED / TALENTED CHILD IDENTIFICATION
            </h6>

            <div class="row">
              <div class="col-md-6">
                <label for="child_hyperactive_disorder" class="form-label small fw-bold">
                  Whether child has been screened for Attention Deficit Hyperactive Disorder<span class="text-danger">
                    *</span>
                </label>
                <select id="child_hyperactive_disorder" name="child_hyperactive_disorder" class="form-select" required>
                  <option value="">-Select-</option>
                  <option value="1" {{ ($val['child_hyperactive_disorder'] ?? '' )==1 ? 'selected' : '' }}>YES</option>
                  <option value="2" {{ ($val['child_hyperactive_disorder'] ?? '' )==2 ? 'selected' : '' }}>NO</option>
                </select>
              </div>

              <div class="col-md-6">
                <label for="stu_extracurricular_activity" class="form-label small fw-bold">
                  Is the student involved in any extracurricular activity? <span class="text-danger">*</span>
                </label>
                <select id="stu_extracurricular_activity" name="stu_extracurricular_activity" class="form-select">
                  <option value="">-Select-</option>
                  <option value="1" {{ ($val['stu_extracurricular_activity'] ?? '' )==1 ? 'selected' : '' }}>YES
                  </option>
                  <option value="2" {{ ($val['stu_extracurricular_activity'] ?? '' )==2 ? 'selected' : '' }}>NO</option>
                </select>
              </div>
            </div>

            {{-- Gifted fields (auto show if extracurricular = YES) --}}
            <div class="row mt-3 {{ ($val['stu_extracurricular_activity'] ?? '') == 1 ? '' : 'd-none' }}"
              id="gifted_section">

              <div class="col-md-4">
                <label for="gifted_math" class="form-label small fw-bold">Mathematics<span class="text-danger"> *</span></label>
                <select id="gifted_math" name="gifted_math" class="form-select">
                  <option value="">-Select-</option>
                  <option value="1" {{ ($val['gifted_math'] ?? '' )==1 ? 'selected' : '' }}>YES</option>
                  <option value="2" {{ ($val['gifted_math'] ?? '' )==2 ? 'selected' : '' }}>NO</option>
                </select>
              </div>

              <div class="col-md-4">
                <label for="gifted_language" class="form-label small fw-bold">Language<span class="text-danger"> *</span></label>
                <select id="gifted_language" name="gifted_language" class="form-select">
                  <option value="">-Select-</option>
                  <option value="1" {{ ($val['gifted_language'] ?? '' )==1 ? 'selected' : '' }}>YES</option>
                  <option value="2" {{ ($val['gifted_language'] ?? '' )==2 ? 'selected' : '' }}>NO</option>
                </select>
              </div>

              <div class="col-md-4">
                <label for="gifted_science" class="form-label small fw-bold">Science<span class="text-danger"> *</span></label>
                <select id="gifted_science" name="gifted_science" class="form-select">
                  <option value="">-Select-</option>
                  <option value="1" {{ ($val['gifted_science'] ?? '' )==1 ? 'selected' : '' }}>YES</option>
                  <option value="2" {{ ($val['gifted_science'] ?? '' )==2 ? 'selected' : '' }}>NO</option>
                </select>
              </div>

              <div class="col-md-4 mt-3">
                <label for="gifted_technical" class="form-label small fw-bold">Technical<span class="text-danger"> *</span></label>
                <select id="gifted_technical" name="gifted_technical" class="form-select">
                  <option value="">-Select-</option>
                  <option value="1" {{ ($val['gifted_technical'] ?? '' )==1 ? 'selected' : '' }}>YES</option>
                  <option value="2" {{ ($val['gifted_technical'] ?? '' )==2 ? 'selected' : '' }}>NO</option>
                </select>
              </div>

              <div class="col-md-4 mt-3">
                <label for="gifted_sports" class="form-label small fw-bold">Sports<span class="text-danger"> *</span></label>
                <select id="gifted_sports" name="gifted_sports" class="form-select">
                  <option value="">-Select-</option>
                  <option value="1" {{ ($val['gifted_sports'] ?? '' )==1 ? 'selected' : '' }}>YES</option>
                  <option value="2" {{ ($val['gifted_sports'] ?? '' )==2 ? 'selected' : '' }}>NO</option>
                </select>
              </div>

              <div class="col-md-4 mt-3">
                <label for="gifted_art" class="form-label small fw-bold">Art<span class="text-danger"> *</span></label>
                <select id="gifted_art" name="gifted_art" class="form-select">
                  <option value="">-Select-</option>
                  <option value="1" {{ ($val['gifted_art'] ?? '' )==1 ? 'selected' : '' }}>YES</option>
                  <option value="2" {{ ($val['gifted_art'] ?? '' )==2 ? 'selected' : '' }}>NO</option>
                </select>
              </div>

            </div>
            <!-- ========================================================= -->
            <!-- OTHER DETAILS -->
            <!-- ========================================================= -->
            <h6 class="card-header bg-heading-primary text-white py-2 mt-3">OTHER DETAILS</h6>

            <div class="row mt-3">

              {{-- PROVIDED MENTORS --}}
              <div class="col-md-6">
                <label for="provided_mentors" class="form-label small fw-bold">Whether provided mentors<span class="text-danger"> *</span></label>
                <select id="provided_mentors" name="provided_mentors" class="form-select" required>
                  <option value="">-Select-</option>
                  <option value="1" {{ ($val['provided_mentors'] ?? '' )==1 ? 'selected' : '' }}>YES</option>
                  <option value="2" {{ ($val['provided_mentors'] ?? '' )==2 ? 'selected' : '' }}>NO</option>
                </select>
              </div>

              {{-- Nurturance Camp Main --}}
              <div class="col-md-6">
                <label for="whether_participated_nurturance_camp" class="form-label small fw-bold">
                  Whether participated in Nurturance Camps<span class="text-danger"> *</span>
                </label>
                <select id="whether_participated_nurturance_camp" name="whether_participated_nurturance_camp"
                  class="form-select" required>
                  <option value="">-Select-</option>
                  <option value="1" {{ ($val['whether_participated_nurturance_camp'] ?? '' )==1 ? 'selected' : '' }}>YES
                  </option>
                  <option value="2" {{ ($val['whether_participated_nurturance_camp'] ?? '' )==2 ? 'selected' : '' }}>NO
                  </option>
                </select>
              </div>

              {{-- State Nurturance --}}
              <div class="col-md-6 mt-3 {{ ($val['whether_participated_nurturance_camp'] ?? '') == 2 ? '' : 'd-none' }}"
                id="state_nurturance_div">
                <label for="state_nurturance" class="form-label small fw-bold">State Level<span class="text-danger"> *</span></label>
                <select id="state_nurturance" name="state_nurturance" class="form-select">
                  <option value="">-Select-</option>
                  <option value="1" {{ ($val['state_nurturance'] ?? '' )==1 ? 'selected' : '' }}>YES</option>
                  <option value="2" {{ ($val['state_nurturance'] ?? '' )==2 ? 'selected' : '' }}>NO</option>
                </select>
              </div>

              {{-- National Nurturance --}}
              <div class="col-md-6 mt-3 {{ ($val['whether_participated_nurturance_camp'] ?? '') == 2 ? '' : 'd-none' }}"
                id="national_nurturance_div">
                <label for="national_nurturance" class="form-label small fw-bold">National Level<span class="text-danger"> *</span></label>
                <select id="national_nurturance" name="national_nurturance" class="form-select">
                  <option value="">-Select-</option>
                  <option value="1" {{ ($val['national_nurturance'] ?? '' )==1 ? 'selected' : '' }}>YES</option>
                  <option value="2" {{ ($val['national_nurturance'] ?? '' )==2 ? 'selected' : '' }}>NO</option>
                </select>
              </div>

              {{-- COMPETITIONS --}}
              <div class="col-md-6 mt-3">
                <label for="participated_competitions" class="form-label small fw-bold">
                  Has the student appeared in competitions?<span class="text-danger"> *</span>
                </label>
                <select id="participated_competitions" name="participated_competitions" class="form-select" required>
                  <option value="">-Select-</option>
                  <option value="1" {{ ($val['participated_competitions'] ?? '' )==1 ? 'selected' : '' }}>YES</option>
                  <option value="2" {{ ($val['participated_competitions'] ?? '' )==2 ? 'selected' : '' }}>NO</option>
                </select>
              </div>

              {{-- NCC / NSS --}}
              <div class="col-md-6 mt-3">
                <label for="ncc_nss_guides" class="form-label small fw-bold">Participated in NCC/NSS/Guides?<span class="text-danger"> *</span></label>
                <select id="ncc_nss_guides" name="ncc_nss_guides" class="form-select" required>
                  <option value="">-Select-</option>
                  <option value="1" {{ ($val['ncc_nss_guides'] ?? '' )==1 ? 'selected' : '' }}>YES</option>
                  <option value="2" {{ ($val['ncc_nss_guides'] ?? '' )==2 ? 'selected' : '' }}>NO</option>
                </select>
              </div>

              {{-- RTE FREE EDUCATION --}}
              <div class="col-md-6 mt-3">
                <label for="rte_free_education" class="form-label small fw-bold">Free education as per RTE Act?<span class="text-danger"> *</span></label>
                <select id="rte_free_education" name="rte_free_education" class="form-select" required>
                  <option value="">-Select-</option>
                  <option value="1" {{ ($val['rte_free_education'] ?? '' )==1 ? 'selected' : '' }}>YES</option>
                  <option value="2" {{ ($val['rte_free_education'] ?? '' )==2 ? 'selected' : '' }}>NO</option>
                </select>
              </div>

              {{-- HOMELESS --}}
              <div class="col-md-6 mt-3">
                <label for="homeless" class="form-label small fw-bold">Whether child is Homeless?<span class="text-danger"> *</span></label>
                <select id="homeless" name="homeless" class="form-select" required>
                  <option value="">-Select-</option>
                  <option value="999" {{ ($val['homeless'] ?? '' )==999 ? 'selected' : '' }}>NOT APPLICABLE</option>
                  <option value="1" {{ ($val['homeless'] ?? '' )==1 ? 'selected' : '' }}>
                    HOMELESS WITH PARENT/GUARDIAN
                  </option>
                  <option value="2" {{ ($val['homeless'] ?? '' )==2 ? 'selected' : '' }}>
                    HOMELESS WITHOUT ADULT PROTECTION
                  </option>
                </select>
              </div>

              {{-- SPECIAL TRAINING --}}
              <div class="col-md-6 mt-3">
                <label for="special_training" class="form-label small fw-bold">Special Training Provided?<span class="text-danger"> *</span></label>
                <select id="special_training" name="special_training" class="form-select" required>
                  <option value="">-Select-</option>
                  <option value="1" {{ ($val['special_training'] ?? '' )==1 ? 'selected' : '' }}>YES</option>
                  <option value="2" {{ ($val['special_training'] ?? '' )==2 ? 'selected' : '' }}>NO</option>
                </select>
              </div>
              <div class="col-md-6 mt-3">
                <label for="able_to_handle_devices" class="form-label small fw-bold">
                  Capable of handling digital devices?<span class="text-danger"> *</span>
                </label>
                <select id="able_to_handle_devices" name="able_to_handle_devices" class="form-select" required>
                  <option value="">-Select-</option>
                  <option value="1" {{ ($val['able_to_handle_devices'] ?? '' )==1 ? 'selected' : '' }}>YES</option>
                  <option value="2" {{ ($val['able_to_handle_devices'] ?? '' )==2 ? 'selected' : '' }}>NO</option>
                </select>
              </div>

              <div class="col-md-6 mt-3">
                <label for="internet_access" class="form-label small fw-bold">
                  Whether child has access to Internet?<span class="text-danger"> *</span>
                </label>
                <select id="internet_access" name="internet_access" class="form-select" required>
                  <option value="">-Select-</option>
                  <option value="1" {{ ($val['internet_access'] ?? '' )==1 ? 'selected' : '' }}>YES</option>
                  <option value="2" {{ ($val['internet_access'] ?? '' )==2 ? 'selected' : '' }}>NO</option>
                </select>
              </div>

            </div>



            <!-- Buttons -->
            <div class="form-actions text-end mt-3">
              <button class="btn btn-secondary me-2" type="button" data-bs-toggle="tab"
                data-bs-target="#tab2">Previous</button>

              <button class="btn btn-success" type="button" id="save_facility_and_other_dtls">Next</button>
            </div>

          </form>
        </div>
        <!-- TAB 3: FACILITY AND OTHER DETAILS END BY AZIZA-->
        <!-- TAB 4: VOCATIONAL DETAILS START BY AZIZA-->
        <div class="tab-pane fade" id="tab4" role="tabpanel" aria-labelledby="tab4-tab">
          <form id="stu_vocational_dtls_form">
            @csrf

            <!-- Title -->
            <h6 class="card-header bg-heading-primary text-white py-2">
              VOCATIONAL EDUCATION DETAILS OF THE STUDENT
            </h6>

            <div class="row mt-3">

              <!-- Exposure to vocational activities -->
              <div class="col-md-6">
                <label class="form-label small fw-bold">
                  Was the student provided with any exposure to Vocational activities? <span class="text-danger">*</span>
                </label>
                <select name="exposure_vocational_activities_y_n" id="exposure_vocational_activities_y_n" class="form-select" required>
                  <option value="">-Please Select-</option>
                  <option value="1">YES</option>
                  <option value="2">NO</option>
                </select>
              </div>
              <!-- Undertook vocational course -->
              <div class="col-md-6">
                <label class="form-label small fw-bold">
                  Did the student undertake any vocational course? <span class="text-danger">*</span>
                </label>
                <select name="undertook_vocational_course" id="undertook_vocational_course" class="form-select" required>
                  <option value="">-Please Select-</option>
                  <option value="1">YES</option>
                  <option value="2">NO</option>
                </select>
              </div>
            </div>

              <div class="row d-none" id="vocational_course_div">
                <!-- Trade/Sector -->
                <div class="col-md-6 mt-3">
                  <label class="form-label small fw-bold">Trade/Sector <span class="text-danger">*</span></label>
                  <select name="trade_sector" id="trade_sector" class="form-select">
                    <option value="">-Select Trade/Sector-</option>
                  </select>
                </div>

                <!-- Job Role -->
                <div class="col-md-6 mt-3">
                  <label class="form-label small fw-bold">Job Role <span class="text-danger">*</span></label>
                  <select name="job_role" id="job_role" class="form-select">
                    <option value="">-Select Job Role-</option>
                  </select>
                </div>

                <!-- Duration of classes -->
                <h6 class="mt-4 mb-2 fw-bold text-primary">Duration of vocational classes attended by student</h6>

                <div class="col-md-6 mt-3">
                  <label class="form-label small fw-bold">Theory (Hours) <span class="text-danger">*</span></label>
                  <input type="number" name="theory_hours" id="theory_hours" class="form-control" placeholder="Hours">
                </div>

                <div class="col-md-6 mt-3">
                  <label class="form-label small fw-bold">Practical (Hours) <span class="text-danger">*</span></label>
                  <input type="number" name="practical_hours" id="practical_hours" class="form-control" placeholder="Hours">
                </div>

                <div class="col-md-6 mt-3">
                  <label class="form-label small fw-bold">Training in industry (Hours) <span class="text-danger">*</span></label>
                  <input type="number" name="industry_hours" id="industry_hours" class="form-control" placeholder="Hours">
                </div>

                <div class="col-md-6 mt-3">
                  <label class="form-label small fw-bold">Field Visit (Hours) <span class="text-danger">*</span></label>
                  <input type="number" name="field_visit_hours" id="field_visit_hours" class="form-control" placeholder="Hours">
                </div>

                <!-- Examination Appearance -->
                <div class="col-md-6 mt-3">
                  <label class="form-label small fw-bold">Whether Appeared for Examination in Previous Class for Vocational Subject <span class="text-danger">*</span></label>
                  <select name="appeared_exam" id="appeared_exam" class="form-select">
                    <option value="">-Please Select-</option>
                    <option value="1">Appeared and Passed</option>
                    <option value="2">Appeared and Not Passed</option>
                    <option value="4">Not  Appeared</option>
                    <option value="3">Not Applicable</option>
                  </select>
                </div>

                <!-- Marks Obtained -->
                <div class="col-md-6 mt-3 d-none">
                  <label class="form-label small fw-bold">% of Marks obtained <span class="text-danger">*</span></label>
                  <input type="number" name="marks_obtained" id="marks_obtained" class="form-control" placeholder="% of Marks obtained">
                </div>

                <!-- Placement Status -->
                <div class="col-md-6 mt-3">
                  <label class="form-label small fw-bold">Whether student applied for placement <span class="text-danger">*</span></label>
                  <select name="placement_applied" id="placement_applied" class="form-select">
                    <option value="">-Please Select-</option>
                    <option value="1">Applied and Placed</option>
                    <option value="2">Applied and Not Placed</option>
                    <option value="3">Not Applied</option>
                  </select>
                </div>

                <!-- Apprenticeship -->
                <div class="col-md-6 mt-3">
                  <label class="form-label small fw-bold">Whether student applied for apprenticeship <span class="text-danger">*</span></label>
                  <select name="apprenticeship_applied" id="apprenticeship_applied" class="form-select">
                    <option value="">-Please Select-</option>
                    <option value="1">Applied and Given Apprenticeship</option>
                    <option value="2">Applied But Not Given Apprenticeship</option>
                    <option value="3">Not Applied Yet</option>
                  </select>
                </div>

                <!-- NSQF Level -->
                <div class="col-md-6 mt-3">
                  <label class="form-label small fw-bold">Completed NSQF Level <span class="text-danger">*</span></label>
                  <select name="nsqf_level" id="nsqf_level" class="form-select">
                    <option value="">-Please Select-</option>
                    <option value="1">YES</option>
                    <option value="2">NO</option>
                  </select>
                </div>

                <!-- Employment / Placement Status -->
                <div class="col-md-6 mt-3">
                  <label class="form-label small fw-bold">Employment/placement Status <span class="text-danger">*</span></label>
                  <select name="employment_status" id="employment_status" class="form-select">
                    <option value="">-Please Select-</option>
                    <option value="1">YES</option>
                    <option value="2">NO</option>
                  </select>
                </div>

                <!-- Salary Offered -->
                <div class="col-md-6 mt-3 d-none">
                  <label class="form-label small fw-bold">Salary Offered <span class="text-danger">*</span></label>
                  <input type="number" name="salary_offered" id="salary_offered" class="form-control" placeholder="Salary Offered">
                </div>
              </div>


            <!-- Navigation Buttons -->
            <div class="form-actions text-end mt-3">
              <button class="btn btn-secondary me-2" data-bs-toggle="tab" data-bs-target="#tab3" type="button">Previous</button>
              <button class="btn btn-success" data-bs-toggle="tab" id="save_vocational_btn" data-bs-target="#tab5" type="button">Next</button>
            </div>

          </form>
        </div>
        <!-- TAB 4: VOCATIONAL DETAILS END BY AZIZA-->

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

  document.addEventListener("DOMContentLoaded", function () {
    let input = document.getElementById("aadhaar_child");

    input.addEventListener("input", function () {
      this.value = this.value.replace(/[^0-9]/g, "").slice(0, 12);
    });
  });
  $(function () {

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
        $enrollForm.find('input, select, textarea').each(function () {
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

        beforeSend: function () {
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

        complete: function () {
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
{{-- FACILITIES AND OTHER DETAILS OF THE STUDENT Aziza Start --}}
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
    let url = "{{ route('hoi.student.facility') }}";
    if (validateRequiredFields("#student_facility_other_dtls_form")) {
      sendRequest(url, "POST", "#student_facility_other_dtls_form")
        .then(res => {
            if (res && res.status) {
                alert(res.message);
                document.querySelector('[data-bs-target="#tab4"]').click();
            }
        })
        .catch(err => {
            console.error("Error saving vocational details:", err);
    });
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
    let url = "{{ route('save.vocational.details') }}"; // Add route in web.php
    if (validateRequiredFields("#stu_vocational_dtls_form")) {
    sendRequest(url, "POST", "#stu_vocational_dtls_form")
        .then(res => {
            if (res && res.status) {
                alert(res.message);
                document.querySelector('[data-bs-target="#tab5"]').click();

            }
        })
        .catch(err => {
            console.error("Error saving vocational details:", err);
    });
  }
});
// {{--Vocational DETAILS OF THE STUDENT Aziza End --}}
</script>
{{--RESUME AND NEW ENTRY BY AZIZA  --}}
<script>
  // Start New Entry Button
  document.getElementById("startNewEntryBtn")?.addEventListener("click", function() {

      if (!confirm("Are you sure? This will delete the previous entry permanently.")) {
          return;
      }

      let url = "{{ route('student.entry.reset') }}";

      sendRequest(url, "POST", null, { _method: "DELETE" })
          .then(data => {
              if (data) {
                  alert(data.message);
                  location.reload();
              }
          });
  });
</script>
{{--RESUME AND NEW ENTRY BY AZIZA  --}}


@endpush
@endsection