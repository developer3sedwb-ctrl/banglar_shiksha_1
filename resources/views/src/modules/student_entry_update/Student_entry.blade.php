@extends('layouts.app')

@section('title', 'Add Student')

@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
@php
    $basic = $data['basic_info'] ?? [];
    $enrollment_info = $data['enrollment_info'] ?? [];
@endphp

<!-- @dump($enrollment_info) -->
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
          <a href="{{ route('student.bulk.upload') }}" class="btn btn-success">
              <i class="bx bx-upload"></i> Student Bulk Upload
          </a>
          <a href="{{ route('dashboard') }}" class="btn btn-primary">
            <i class="bx bx-arrow-back"></i> Back
          </a>
        </div>
      </div>
  
      <div class="alert-container">
          @if(isset($data['current_step']) && $data['current_step'] >= 1)
              <div class="entry-alert-box">
                  <span class="entry-alert-text">
                      <strong>Resume Entry ?</strong>
                      You have a student entry that is still incomplete at Step {{ $data['current_step'] }}.
                  </span>

                  <div class="entry-alert-actions">
                      <button id="resumeEntryBtn" class="btn btn-success">
                          Resume from Step {{ $data['current_step'] }}
                      </button>

                      <button id="startNewEntryBtn" class="btn btn-danger">
                          Start New Entry
                      </button>
                  </div>
              </div>
          @endif
      </div>

    <!-- CARD WITH TABS -->
     <div class="card card-full">
            <!-- ================================Student Previous Entry Delete====================================== -->




      <!-- ========================================================================================== -->
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
                <button class="nav-link {{ $current >= 6 ? '' : '' }}"
                    id="bank_dtls-tab" data-bs-toggle="tab"
                    data-bs-target="#bank_dtls_tab" type="button" role="tab">
                    Additional Details
                </button>
            </li>
        </ul>
      </div>

      <div class="card-body">
        <div class="tab-content" id="studentTabContent">
          <!-- =========TAB 1: Contact Info -- SUBHAJIT DAS--================================ -->
          <div class="tab-pane fade show active" id="general_info" role="tabpanel" aria-labelledby="general_info-tab">
            <form id="basic_info_of_student" method="POST" action="{{ route('student.store_student_entry_basic_details') }}" novalidate>

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
                      <input name="student_name" 
                      type="text" 
                      class="form-control" 
                      placeholder="Name of the student" 
                      value="{{ old('student_name', $basic['student_name'] ?? '') }}"
                      required>
                    </div>
                  </div>

                  <div class="mb-3">
                    <label class="form-label small">Gender <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bx bx-book"></i></span>
                        <select name="gender" class="form-select" required>
                            <option value="">-Please Select-</option>
                              @foreach($genders as $val => $label)
                                <option value="{{ $val }}" 
                                    {{ ($basic['gender'] ?? '') == $val ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
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
                         <input id="dobField" 
                          name="dob" 
                          type="date" 
                          class="form-control" 
                          value="{{ old('dob', $basic['dob'] ?? '') }}"
                          required>
                      </div>
                  </div>

                  <div class="mb-3">
                    <label class="form-label small">Father's Name <span class="text-danger">*</span></label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="bx bx-user"></i></span>
                     <input name="father_name" 
                      type="text" 
                      class="form-control" 
                      placeholder="Father's name" 
                      value="{{ old('father_name', $basic['father_name'] ?? '') }}"
                      required>

                    </div>
                  </div>

                  <div class="mb-3">
                    <label class="form-label small">Mother's Name <span class="text-danger">*</span></label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="bx bx-user"></i></span>
                 <input name="mother_name" 
                  type="text" 
                  class="form-control" 
                  placeholder="Mother's name" 
                  value="{{ old('mother_name', $basic['mother_name'] ?? '') }}"
                  required>

                    </div>
                  </div>

                  <div class="mb-3">
                    <label class="form-label small">Guardian's  Name <span class="text-danger">*</span></label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="bx bx-user"></i></span>
                      <input name="guardian_name" type="text" class="form-control" placeholder="Guardian's name" value="{{ old('guardian_name', $basic['guardian_name'] ?? '') }}" required>
                    </div>
                  </div>

                  <div class="mb-3">
                      <label class="form-label small">Aadhaar No of Child</label>
                      <div class="input-group">
                          <span class="input-group-text"><i class="bx bx-id-card"></i></span>
                          <input 
                              id="aadhaar_child"
                              name="aadhaar_child"
                              type="text"
                              class="form-control"
                              placeholder="Aadhaar no of child"
                              value="{{ old('aadhaar_child', $basic['aadhaar_child'] ?? '') }}"
                              maxlength="12"
                          >
                      </div>
                  </div>

                  <div class="mb-3">
                    <label class="form-label small">Name of Student as Per Aadhaar</label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="bx bx-id-card"></i></span>
                    <input name="student_name_as_per_aadhaar" type="text" class="form-control" placeholder="Name of student as per Aadhaar"   value="{{ old('student_name_as_per_aadhaar', $basic['student_name_as_per_aadhaar'] ?? '') }}">
                    </div>
                  </div>

                  <div class="mb-3">
                      <label class="form-label small">Mother Tongue of the Child</label>
                      <div class="input-group">
                          <span class="input-group-text"><i class="bx bx-message-alt-detail"></i></span>
                          <select name="mother_tongue" class="form-select">
                           <option value="">-Select-</option>
                            @foreach($mother_tongue as $val => $label)
                                <option value="{{ $val }}" 
                                    {{ ($basic['mother_tongue'] ?? '') == $val ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
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
                          <option value="{{ $val }}" 
                              {{ ($basic['social_category'] ?? '') == $val ? 'selected' : '' }}>
                              {{ $label }}
                          </option>
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
                              <option value="{{ $val }}"
                                  {{ ($basic['religion'] ?? '') == $val ? 'selected' : '' }}>
                                  {{ $label }}
                              </option>
                          @endforeach
                      </select>

                    </div>
                  </div>

                  <div class="mb-3">
                    <label class="form-label small">Whether BPL Beneficiary?<span class="text-danger">*</span></label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="bx bx-check"></i></span>
                    <select name="bpl_beneficiary" id="bpl_beneficiary" class="form-select">
                      <option value="">-Please Select-</option>
                      @foreach($dropdowns['yes_no'] as $val => $label)
                          <option value="{{ $val }}"
                              {{ ($basic['bpl_beneficiary'] ?? '') == $val ? 'selected' : '' }}>
                              {{ $label }}
                          </option>
                      @endforeach
                    </select>
                    </div>
                  </div>

                  
                  <div class="mb-3" id="aay_section" style="display:none;">
                      <label class="form-label small">Whether Antyodaya Anna Yojana (AAY) beneficiary?<span class="text-danger">*</span></label>
                      <div class="input-group">
                        <span class="input-group-text"><i class="bx bx-check"></i></span>
                        <select name="antyodaya_anna_yojana" id="antyodaya_anna_yojana" class="form-select">
                            <option value="">-Please Select-</option>

                             @foreach($dropdowns['yes_no'] as $val => $label)
                            <option value="{{ $val }}"
                                {{ ($basic['antyodaya_anna_yojana'] ?? '') == $val ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                            @endforeach

                        </select>
                      </div>
                  </div>

                  <div class="mb-3" id="bpl_numberID" style="display:none;">
                      <label class="form-label small">BPL Number<span class="text-danger">*</span></label>
                      <div class="input-group">
                        <span class="input-group-text"><i class="bx bx-check"></i></span>
                        <input name="bpl_number" id="bpl_number" type="text" class="form-control" placeholder="Enter Your BPL Number"  value="{{ old('bpl_number', $basic['bpl_number'] ?? '') }}">
                      </div>
                  </div>

                  <div class="mb-3">
                    <label class="form-label small">Whether belongs to EWS / Disadvantaged Group</label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="bx bx-wallet"></i></span>
                      <select name="disadvantaged_group" class="form-select">
                        <option value="">-Please Select-</option>
                             @foreach($dropdowns['yes_no'] as $val => $label)
                            <option value="{{ $val }}"
                                {{ ($basic['disadvantaged_group'] ?? '') == $val ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
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
                      <select name="cwsn" id ="cwsn"class="form-select">
                        <option value="">-Please Select-</option>
                            @foreach($dropdowns['yes_no'] as $val => $label)
                              <option value="{{ $val }}"
                                  {{ ($basic['cwsn'] ?? '') == $val ? 'selected' : '' }}>
                                  {{ $label }}
                              </option>
                            @endforeach
                      </select>
                    </div>
                  </div>


                  <div class="mb-3" id="impairment"  style="display:none;">
                    <label class="form-label small">(a) Type of Impairment</label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="bx bx-info-circle"></i></span>
                  <select name="type_of_impairment" id="type_of_impairment" class="form-select">
                    <option value="">-Please Select-</option>
                    @foreach($stu_disability_type_master ?? [] as $val => $label)
                        <option value="{{ $val }}"
                            {{ ($basic['type_of_impairment'] ?? '') == $val ? 'selected' : '' }}>
                            {{ $label }}
                        </option>
                    @endforeach
                  </select>
                    </div>
                  </div>


                    <div class="mb-3" id="disability"  style="display:none;">
                    <label class="form-label small">(b) Disability Percentage (in %)<span class="text-danger">*</span></label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="bx bx-info-circle"></i></span>
                        <input name="disability_percentage" id="disability_percentage" type="text" class="form-control" placeholder="Enter Disability in %"  value="{{ old('disability_percentage', $basic['disability_percentage'] ?? '') }}">
                    </div>
                  </div>

                  <div class="mb-3">
                    <label class="form-label small">Nationality</label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="bx bx-flag"></i></span>
                    <select name="nationality" class="form-select">
                        <option value="">-Please Select-</option>
                        @foreach($nationality ?? [] as $val => $label)
                            <option value="{{ $val }}"
                                {{ ($basic['nationality'] ?? '') == $val ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                      </select>
                    </div>
                  </div>

                  <div class="mb-3">
                    <label class="form-label small">Is the Child enrolled as Out of School Child?</label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="bx bx-school"></i></span>
                      <select name="out_of_school" id="out_of_school" class="form-select">
                        <option value="">-Please Select-</option>

                           @foreach($dropdowns['yes_no'] as $val => $label)
                              <option value="{{ $val }}"
                                  {{ ($basic['out_of_school'] ?? '') == $val ? 'selected' : '' }}>
                                  {{ $label }}
                              </option>
                            @endforeach
                      </select>
                    </div>
                  </div>

                    <div class="mb-3" id="mainstreamed_section" style="display:none;">
                    <label class="form-label small">When the child is mainstreamed</label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="bx bx-school"></i></span>
                      <select name="mainstreamed" id="mainstreamed" class="form-select">
                        <option value="">-Please Select-</option>
                           @foreach($child_mainstreamed_master ?? [] as $val => $label)
                            <option value="{{ $val }}"
                                {{ ($basic['mainstreamed'] ?? '') == $val ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
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
                            <option value="{{ $val }}"
                                {{ ($basic['blood_group'] ?? '') == $val ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                          @endforeach
                      </select>
                    </div>
                  </div>

                  <div class="mb-3">
                    <label class="form-label small">Birth Registration Number</label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="bx bx-spreadsheet"></i></span>
                      <input name="birth_reg_no" id="birth_reg_no" type="text" class="form-control" placeholder="Birth registration number"   value="{{ old('birth_reg_no', $basic['birth_reg_no'] ?? '') }}">
                    </div>
                  </div>

                  <div class="mb-3">
                    <label class="form-label small">Identification Mark</label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="bx bx-id"></i></span>
                        <input name="identification_mark" id="identification_mark" type="text" class="form-control" placeholder="Identify mark (if any)"   value="{{ old('identification_mark', $basic['identification_mark'] ?? '') }}">
                    </div>
                  </div>

                  <div class="mb-3">
                    <label class="form-label small">Health ID</label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="bx bx-link-alt"></i></span>
                      <input name="health_id" id="health_id" type="text" class="form-control" placeholder="Health ID"   value="{{ old('health_id', $basic['health_id'] ?? '') }}">
                    </div>
                  </div>

                  <div class="mb-3">
                    <label class="form-label small">Relationship with Guardian</label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="bx bx-link-alt"></i></span>
                      <select name="relationship_with_guardian" class="form-select">
                        <option value="">-Please Select-</option>
                          @foreach($guardian_relationship ?? [] as $val => $label)
                            <option value="{{ $val }}"
                                {{ ($basic['relationship_with_guardian'] ?? '') == $val ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
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
                            <option value="{{ $val }}"
                                {{ ($basic['family_income'] ?? '') == $val ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                          @endforeach
                      </select>
                    </div>
                  </div>

                  <div class="mb-3">
                    <label class="form-label small">Student Height(in cms)</label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="bx bx-link-alt"></i></span>
                      <input name="student_height" type="text" class="form-control" placeholder="Student Height"   value="{{ old('student_height', $basic['student_height'] ?? '') }}">
                    </div>
                  </div>

                  <div class="mb-3">
                    <label class="form-label small">Student Weight(in Kg's)</label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="bx bx-link-alt"></i></span>
                      <input name="student_weight" type="text" class="form-control" placeholder="Student Weight"   value="{{ old('student_weight', $basic['student_weight'] ?? '') }}">
                    </div>
                  </div>

                    <div class="mb-3">
                      <label class="form-label small">Guardian's Qualification?</label>
                      <div class="input-group">
                        <span class="input-group-text"><i class="bx bx-school"></i></span>
                      <select name="guardian_qualifications" class="form-select" required>
                      <option value="">-Select-</option>
                      <option value="1" {{ ($basic['guardian_qualifications'] ?? '' )==1 ? 'selected' : '' }}>GRADUATE</option>
                      <option value="2" {{ ($basic['guardian_qualifications'] ?? '' )==2 ? 'selected' : '' }}>BELOW GRADUATE</option>

                        <option value="2" {{ ($basic['guardian_qualifications'] ?? '' )==3 ? 'selected' : '' }}>POST GRADUATE </option>
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
          <!-- ======== TAB 2: ENROLMENT DETAILS  -- SUBHAJIT DAS========-- -->
          <div class="tab-pane fade" id="enrollment_details" role="tabpanel" aria-labelledby="enrollment_details-tab">
            <form id="student_enrollment_details" method="POST" action="{{ route('student.store_enrollment_details') }}" novalidate>

              @csrf

              <h6 class=" card-header bg-heading-primary text-white py-2">
              ENROLLMENT DETAILS OF STUDENT IN PRESENT SCHOOL FOR CURRENT YEAR
              </h6> 
              <div class="row">
                <div class="col-md-6">
                  <!-- Admission Number in School -->
                  <div class="mb-3">
                    <label class="form-label small">Admission Number in School<span class="text-danger">*</span></label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="bx bx-hash"></i></span>
                      <input name="admission_number" 
                        type="text" 
                        class="form-control" 
                        placeholder="Admission number in school"
                        maxlength="10"
                        pattern="\d*"
                        inputmode="numeric"
                        value="{{ old('admission_no', $enrollment_info['admission_no'] ?? '') }}">  
                    </div>
                  </div>

                  <!-- Status of Admission in Previous Academic Year -->
                  <div class="mb-3" id ="previous_school_status">
                    <label class="form-label small">Status of student in Previous Academic Year of Schooling<span class="text-danger">*</span></label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="bx bx-history"></i></span>
                      <select name="admission_status_prev"  id="admission_status_prev" class="form-select">
                        <option value="">-Please Select-</option> 
                          @foreach($previous_schooling_type_master ?? [] as $val => $label)
                          <option value="{{ $val }}"
                              {{ ($enrollment_info['status_pre_year'] ?? '') == $val ? 'selected' : '' }}>
                              {{ $label }}
                        </option>
                        @endforeach
                      </select>
                    </div>
                  </div>



                  <div class="mb-3"  id ="prev_class_studied_appeared_exam" style="display:none;">
                    <label class="form-label small">In the Previous class studied – whether appeared for examinations<span class="text-danger">*</span></label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="bx bx-history"></i></span>
                          <select name="prev_class_appeared_exam" id="prev_class_appeared_exam"  class="form-select">
                          <option value="">-Please Select-</option>
                          @foreach($dropdowns['prev_class_appeared_exam'] as $val => $label)
                          <option value="{{ $val }}"
                              {{ ($enrollment_info['prev_class_appeared_exam'] ?? '') == $val ? 'selected' : '' }}>
                              {{ $label }}
                          </option>
                          @endforeach
                        </select>
                    </div>
                  </div>


                  <div class="mb-3" id="previous_class_studied_result_examination" style="display:none;">
                    <label class="form-label small">In the previous class studied – Result of the examination<span class="text-danger">*</span></label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="bx bx-history"></i></span>
                        <select name="previous_class_result_examination" id="previous_class_result_examination" class="form-select">
                            <option value="">-Please Select-</option>
                        @foreach($stu_appeared_master ?? [] as $val => $label)
                          <option value="{{ $val }}"
                              {{ ($enrollment_info['prev_class_exam_result'] ?? '') == $val ? 'selected' : '' }}>
                              {{ $label }}
                          </option>
                        @endforeach
                      </select>
                    </div>
                  </div>


                  <div class="mb-3" id="percentage_of_overall_marks_section" style="display:none;">
                    <label class="form-label small">In the previous class studied - % of overall marks obtained in the examination<span class="text-danger">*</span></label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="bx bx-history"></i></span>
                        <input name="percentage_of_overall_marks" id="percentage_of_overall_marks"
                        type="text" 
                        class="form-control" 
                        placeholder="% of overall marks obtained"
                        maxlength="3"
                        pattern="\d*"
                        inputmode="numeric"
                         value="{{ old('prev_class_marks_percent', $enrollment_info['prev_class_marks_percent'] ?? '') }}"
                      >
                    </div>
                  </div>

                    <div class="mb-3" id="no_of_days_attended_section" style="display:none;">
                    <label class="form-label small">No. of days child attended school (in the previous academic year)<span class="text-danger">*</span></label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="bx bx-history"></i></span>
                    <input name="no_of_days_attended" id="no_of_days_attended" 
                        type="text" 
                        class="form-control" 
                        placeholder="No of days child attended school"
                        maxlength="3"
                        pattern="\d*"
                        inputmode="numeric"
                        value="{{ old('attendention_pre_year', $enrollment_info['attendention_pre_year'] ?? '') }}"
                      >
                    </div>
                  </div>
                    <div class="mb-3" id="previous_class_studied" style="display:none;">
                    <label class="form-label small">Grade/Class Studied in the Previous/Last Academic Year (Previous Class)*<span class="text-danger">*</span></label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="bx bx-history"></i></span>
                      <select name="previous_class" id="previous_class" class="form-select">
                            <option value="">-Please Select-</option>
                          @foreach($class_master ?? [] as $val => $label)
                            <option value="{{ $val }}"
                                {{ ($enrollment_info['pre_class_code_fk'] ?? '') == $val ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                          @endforeach
                      </select>
                    </div>
                  </div>
                    <div class="mb-3" id="previous_section_section" style="display:none;">
                    <label class="form-label small">Previous Section<span class="text-danger">*</span></label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="bx bx-history"></i></span>
                      <select name="class_section" id="class_section" class="form-select">
                            <option value="">-Please Select-</option>
                          @foreach($class_section_master ?? [] as $val => $label)
                            <option value="{{ $val }}"
                                {{ ($enrollment_info['pre_section_code_fk'] ?? '') == $val ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                          @endforeach
                      </select>
                    </div>
                  </div>
                    <div class="mb-3" id="previous_stream_section" style="display:none;">
                    <label class="form-label small">Previous Stream<span class="text-danger">*</span></label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="bx bx-history"></i></span>
                      <select name="student_stream" id="student_stream" class="form-select">
                            <option value="">-Please Select-</option>
                          @foreach($stream_master ?? [] as $val => $label)
                            <option value="{{ $val }}"
                                {{ ($enrollment_info['pre_stream_code_fk'] ?? '') == $val ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                          @endforeach
                      </select>
                    </div>
                  </div>
                    <div class="mb-3" id="previous_roll_no_section" style="display:none;">
                    <label class="form-label small">Previous Roll No.<span class="text-danger">*</span></label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="bx bx-history"></i></span>
                      <input name="previous_student_roll_no" id="previous_student_roll_no"
                        type="text" 
                        class="form-control" 
                        placeholder="Enter Previous Roll Number"
                        maxlength="10"
                        pattern="\d*"
                        inputmode="numeric"
                        value="{{ old('pre_roll_number', $enrollment_info['pre_roll_number'] ?? '') }}"
                      >
                    </div>
                  </div>

                  <!-- ================================================== -->

                  <!-- Present Class -->
                  <div class="mb-3">
                    <label class="form-label small">Present Class</label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="bx bx-book-open"></i></span>
                      <select name="present_class" id="present_class" class="form-select">
                          <option value="">-Please Select-</option>
                          @foreach($class_master ?? [] as $val => $label)
                            <option value="{{ $val }}"
                                {{ ($enrollment_info['cur_class_code_fk'] ?? '') == $val ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                          @endforeach
                      </select>
                    </div>
                  </div>

                  <!-- Academic Year -->
                  <div class="mb-3">
                    <label class="form-label small">Academic Year</label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="bx bx-calendar-alt"></i></span>
                    <select name="accademic_year" id="accademic_year"  class="form-select">
                          <option value="">-Please Select-</option>
                          @foreach($dropdowns['accademic_year'] as $val => $label)
                         <option value="{{ $val }}"
                                {{ ($enrollment_info['academic_year'] ?? '') == $val ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                          @endforeach
                        </select>
                    </div>
                  </div>

                  <!-- Present Section -->
                  <div class="mb-3">
                    <label class="form-label small">Present Section</label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="bx bx-layout"></i></span>
                        <select name="present_section" id="present_section" class="form-select">
                          <option value="">-Please Select-</option>
                             @foreach($school_classwise_section ?? [] as $val => $label)
                            <option value="{{ $val }}"
                                {{ ($enrollment_info['cur_section_code_fk'] ?? '') == $val ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                          @endforeach
                      </select>
                    </div>
                  </div>

                  <!-- Present Medium -->
                  <div class="mb-3">
                    <label class="form-label small">Medium</label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="bx bx-chat"></i></span>
                          <select name="school_medium" id="school_medium" class="form-select">
                          <option value="">-Please Select-</option>
                            @foreach($school_medium ?? [] as $val => $label)
                            <option value="{{ $val }}"
                                {{ ($enrollment_info['medium_code_fk'] ?? '') == $val ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                          @endforeach
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
                      <input name="admission_date_present" type="date" class="form-control" value="{{ old('admission_date', $enrollment_info['admission_date'] ?? '') }}">
                    </div>
                  </div>

                  <div class="mb-3" id="cur_stream_wrapper" style="display:none;">
    <label class="form-label small">
        Academic Stream opted by student (For Higher Secondary Classes only)
    </label>
    <div class="input-group">
        <span class="input-group-text"><i class="bx bx-calendar"></i></span>
        <select name="cur_stream_code" id="cur_stream_code" class="form-select">
            <option value="">-Please Select-</option>
            @foreach($stream_master ?? [] as $val => $label)
                <option value="{{ $val }}"
                    {{ ($enrollment_info['cur_stream_code'] ?? '') == $val ? 'selected' : '' }}>
                    {{ $label }}
                </option>
            @endforeach
        </select>
    </div>
</div>


                  <!-- Present Roll No -->
                  <div class="mb-3">
                    <label class="form-label small">Present Roll No</label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="bx bx-list-ol"></i></span>
                      <input name="present_roll_no" type="number" class="form-control" placeholder="Roll number" value="{{ old('cur_roll_number', $enrollment_info['cur_roll_number'] ?? '') }}">
                    </div>
                  </div>

                  <!-- Admission Type -->
                  <div class="mb-3">
                    <label class="form-label small">Admission Type</label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="bx bx-transfer-alt"></i></span> 
                          <select name="admission_type" id="admission_type" class="form-select" >
                          <option value="">-Please Select-</option>
                             @foreach($admission_type_master ?? [] as $val => $label)
                            <option value="{{ $val }}"
                                {{ ($enrollment_info['admission_type_code_fk'] ?? '') == $val ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                          @endforeach
                      </select>
                    </div>
                  </div>

                  <!-- Admission Category -->
                </div>
              </div>

              <div class="form-actions text-end mt-3">
                <button class="btn btn-secondary me-2" data-bs-toggle="tab" type="button">Previous</button>
                <button id="enrollment_details_save_btn" class="btn btn-success" data-bs-toggle="tab" type="button">Next</button>
              </div>

            </form>
          </div>
          <!-- ========TAB 3: FACILITY AND OTHER DETAILS START BY AZIZA ======-->
          <div class="tab-pane fade" id="facility_other_dtls_tab" role="tabpanel" aria-labelledby="tab3-tab">

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
              <button class="btn btn-secondary me-2" 
                      type="button" 
                      data-bs-toggle="tab"
                      data-bs-target="#enrollment_details">
                  Previous
              </button>


                <button class="btn btn-success" type="button" id="save_facility_and_other_dtls">Save & Next</button>
              </div>

            </form>
          </div>

          <!-- =========TAB 4: VOCATIONAL DETAILS START BY AZIZA ===========-->
          <div class="tab-pane fade" id="vocational_tab" role="tabpanel" aria-labelledby="tab4-tab">
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
                <button class="btn btn-secondary me-2" data-bs-toggle="tab" data-bs-target="#facility_other_dtls_tab" type="button">Previous</button>
                <button class="btn btn-success" data-bs-toggle="tab" id="save_vocational_btn" type="button">Save & Next</button>
              </div>

            </form>
          </div>
        
          <!-- ======= TAB 5: Contact Info -- SUBHAJIT DAS--================= -->
          <div class="tab-pane fade" id="contact_info_tab" role="tabpanel"    aria-labelledby="contact_info_tab-tab">
              <form id="contact_info_of_student_and_guardian" method="POST" action="{{ route('student.store_student_entry_contact_details') }}" novalidate>
              @csrf
              
              <h6 class=" card-header bg-heading-primary text-white py-2">
                CONTACT INFORMATION FOR STUDENT
              </h6> 
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3" id="student_country_section">
                    <label class="form-label small">Select Country</label>
                    <select name="student_country" id= "student_country" class="form-select">
                          <option value="">-Please Select-</option>
                          @foreach($bs_country_master ?? [] as $val => $label)
                          <option value="{{ $val }}">{{ $label }}</option>
                          @endforeach
                      </select>
                  </div>

                  <div class="mb-3">
                    <label class="form-label small">Address</label>
                    <input name="student_address" type="text" class="form-control" placeholder="Enter Address">
                  </div>

                
                  <div class="mb-3" id="student_district_section">
                    <label class="form-label small">District</label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="bx bx-spreadsheet"></i></span>
                    <select name="student_district" id= "student_district"  class="select2 form-select2">
                          <option value="">-Please Select-</option>
                          @foreach($district_master ?? [] as $val => $label)
                          <option value="{{ $val }}">{{ $label }}</option>
                          @endforeach
                      </select>
                    </div>
                  </div> 

                  <div class="mb-3">
                    <label class="form-label small">Panchayat</label>
                    <input name="student_panchayat" type="text" class="form-control" placeholder="Enter Panchayat / Ward">
                  </div>

                  <div class="mb-3">
                    <label class="form-label small">Police Station</label>
                    <input name="student_police_station" type="text" class="form-control" placeholder="Police station">
                  </div>
                  <div class="mb-3">
                    <label class="form-label small">Mobile Number (Student / Parent / Guardian)</label>
                  <input name="student_mobile"
                    type="text"
                    maxlength="10"
                    inputmode="numeric"
                    class="form-control"
                    placeholder="Mobile number"
                    oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                    required>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="mb-3" id="student_state_section">
                    <label class="form-label small">State</label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="bx bx-spreadsheet"></i></span>
                    <select name="student_state" id= "student_state"  class="select2 form-select2">
                          <option value="">-Please Select-</option>
                          @foreach($state_master ?? [] as $val => $label)
                          <option value="{{ $val }}">{{ $label }}</option>
                          @endforeach
                      </select>
                    </div>
                  </div> 


                  <div class="mb-3">
                    <label class="form-label small">Habitation / Locality</label>
                    <input name="student_locality" type="text" class="form-control" placeholder="Habitation / Locality">
                  </div>

                  <div class="mb-3" id="student_block_section">
                    <label class="form-label small">Block / Municipality</label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="bx bx-spreadsheet"></i></span>
                    <select name="student_block" id= "student_block"  class="select2 form-select2">
                          <option value="">-Please Select-</option>
                          @foreach($block_munc_corp_master ?? [] as $val => $label)
                          <option value="{{ $val }}">{{ $label }}</option>
                          @endforeach
                      </select>
                    </div>
                  </div> 

                  <div class="mb-3">
                    <label class="form-label small">Post Office</label>
                    <input name="student_post_office" type="text" class="form-control" placeholder="Post office">
                  </div>

                  <div class="mb-3">
                    <label class="form-label small">Pin Code</label>
                    <input name="student_pincode"
                    type="text"
                    maxlength="6"
                    inputmode="numeric"
                    class="form-control"
                    placeholder="Pin Code"
                    oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                    required>
                  </div>

                  <div class="mb-3">
                    <label class="form-label small">Contact email id (Student/Parent/Guardian)</label>
                    <input name="student_email" type="email" class="form-control" placeholder="Email">
                  </div>
                </div>
              </div>

              <hr class="my-3">

              <h6 class=" card-header bg-heading-primary text-white py-2">
                CONTACT INFORMATION FOR GUARDIAN
              </h6> 
              <div class="form-check mb-2">
                <input class="form-check-input" type="checkbox" id="same-as-student" />
                <label class="form-check-label small" for="same-as-student">Same as Student Address</label>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3" id="guardian_country_section">
                    <label class="form-label small">Select Country</label>
                    <select name="guardian_country" id= "guardian_country" class="form-select">
                          <option value="">-Please Select-</option>
                          @foreach($bs_country_master ?? [] as $val => $label)
                          <option value="{{ $val }}">{{ $label }}</option>
                          @endforeach
                      </select>
                  </div>

                  <div class="mb-3">
                    <label class="form-label small">Address</label>
                    <input name="guardian_address" type="text" class="form-control" placeholder="Guardian address">
                  </div>

                


                  <div class="mb-3" id="guardian_district_section">
                    <label class="form-label small">District</label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="bx bx-spreadsheet"></i></span>
                    <select name="guardian_district" id= "guardian_district"  class="select2 form-select2">
                          <option value="">-Please Select-</option>
                          @foreach($district_master ?? [] as $val => $label)
                          <option value="{{ $val }}">{{ $label }}</option>
                          @endforeach
                      </select>
                    </div>
                  </div> 

                  <div class="mb-3">
                    <label class="form-label small">Panchayat</label>
                    <input name="guardian_panchayat" type="text" class="form-control" placeholder="Panchayat / Ward">
                  </div>

                  <div class="mb-3">
                    <label class="form-label small">Police Station</label>
                    <input name="guardian_police_station" type="text" class="form-control" placeholder="Police station">
                  </div>

                  <div class="mb-3">
                    <label class="form-label small">Mobile Number (Guardian)</label>
                    <input name="guardian_mobile"
                    type="text"
                    maxlength="10"
                    inputmode="numeric"
                    class="form-control"
                    placeholder="Mobile number"
                    oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                    required>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="mb-3" id="guardian_state_section">
                    <label class="form-label small">State</label>
                      <div class="input-group">
                      <span class="input-group-text"><i class="bx bx-spreadsheet"></i></span>
                        <select name="guardian_state" id= "guardian_state"  class="select2  form-select2">
                          <option value="">-Please Select-</option>
                          @foreach($state_master ?? [] as $val => $label)
                          <option value="{{ $val }}">{{ $label }}</option>
                          @endforeach
                        </select>
                      </div>
                  </div> 

                  <div class="mb-3">
                    <label class="form-label small">Habitation / Locality</label>
                    <input name="guardian_locality" type="text" class="form-control" placeholder="Habitation / Locality">
                  </div>

                  <div class="mb-3" id="guardian_block_section">
                    <label class="form-label small">Block / Municipality</label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="bx bx-spreadsheet"></i></span>
                    <select name="guardian_block" id= "guardian_block" class="select2 form-select2">
                          <option value="">-Please Select-</option>
                          @foreach($block_munc_corp_master ?? [] as $val => $label)
                          <option value="{{ $val }}">{{ $label }}</option>
                          @endforeach
                      </select>
                    </div>
                  </div> 
                  
                  <div class="mb-3">
                    <label class="form-label small">Post Office</label>
                    <input name="guardian_post_office" type="text" class="form-control" placeholder="Post office">
                  </div>

                  <div class="mb-3">
                    <label class="form-label small">Pin Code</label>
                    <input name="guardian_pincode"
                    type="text"
                    maxlength="6"
                    inputmode="numeric"
                    class="form-control"
                    placeholder="Pin Code"
                    oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                    required>
                  </div>

                  <div class="mb-3">
                    <label class="form-label small">Contact email id (Guardian)</label>
                    <input name="guardian_email" type="email" class="form-control" placeholder="Email">
                  </div>
                </div>
              </div>

              <div class="form-actions text-end mt-3">
                <button class="btn btn-secondary me-2" data-bs-toggle="tab" type="button">Previous</button>
                <button id="contact_info_save_btn" class="btn btn-success" type="button">Next</button>
              </div>
            </form>
          </div>

          <!-- TAB 6: BANK DETAILS & UPLOAD  -- SUBHAJIT DAS-- -->
          <div class="tab-pane fade" id="bank_dtls_tab" role="tabpanel" aria-labelledby="bank_dtls-tab">
                  <form id="bank_details_of_student" method="POST" action="{{ route('student.bank_details_of_student') }}" novalidate>
                      @csrf

                      <h6 class="card-header bg-heading-primary text-white py-2">
                          BANK DETAILS
                      </h6>

                      <div class="row">

                          <!-- LEFT COLUMN -->
                          <div class="col-md-6">

                              <!-- Bank Name -->
                              <div class="mb-3">
                                  <label class="form-label small">Bank Name</label>
                                  <div class="input-group">
                                      <span class="input-group-text"><i class="bx bx-spreadsheet"></i></span>
                                      <select name="bank_name" id="bank_name" class="form-select select2">
                                          <option value="">-Please Select-</option>
                                          @foreach($bank_code_name_master ?? [] as $val => $label)
                                              <option value="{{ $val }}">{{ $label }}</option>
                                          @endforeach
                                      </select>
                                  </div>
                              </div>

                              <!-- Branch Name -->
                              <div class="mb-3">
                                  <label class="form-label small">Branch Name</label>
                                  <div class="input-group">
                                      <span class="input-group-text"><i class="bx bx-spreadsheet"></i></span>
                                      <select name="branch_name" id="branch_name" class="form-select select2">
                                          <option value="">-Please Select-</option>
                                          @foreach($bank_branch_master ?? [] as $val => $label)
                                              <option value="{{ $val }}">{{ $label }}</option>
                                          @endforeach
                                      </select>
                                  </div>
                              </div>

                              <!-- IFSC -->
                              <div class="mb-3">
                                  <label class="form-label small">IFSC</label>
                                  <input name="ifsc" id="ifsc" type="text" class="form-control" placeholder="IFSC code">
                              </div>

                          </div>

                          <!-- RIGHT COLUMN -->
                          <div class="col-md-6">

                              <!-- Account Number -->
                              <div class="mb-3">
                                  <label class="form-label small">Account Number</label>
                                  <input name="account_number" type="text" class="form-control" placeholder="Account number">
                              </div>


                              <!-- Confirm Account Number -->
                              <div class="mb-3">
                                  <label class="form-label small">Confirm Account Number</label>
                                  <input name="confirm_account_number" type="text" class="form-control" placeholder="Re-enter account number">
                              </div>

                          </div>
                      </div>

                      <div class="form-actions text-end mt-3">
                          <button class="btn btn-secondary me-2" data-bs-toggle="tab" data-bs-target="#tab5" type="button">
                              Previous
                          </button>

                          <button class="btn btn-success" type="submit">
                              Save Details
                          </button>
                      </div>

                  </form>
              </div>

              <!-- ==========End of Bank ================ -->
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
                <p class="text-muted small"> The previous entry will be deleted permanently.</p>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary"
                    data-bs-dismiss="modal">
                    <i class="bx bx-x-circle me-1"></i> Cancel
                </button>

                <button type="button" class="btn btn-danger" id="confirmDeleteEntry">
                    <i class="bx bx-trash me-1"></i> Delete Entry
                </button>
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
function toggleStreamField(value) {
    value = (value || '').toString().toLowerCase();
    // alert(value);

    // Treat both numeric and roman codes as XI / XII
    const isHigherSecondary =
        value === '11' || value === '12' || value === 'xi' || value === 'xii';

    if (isHigherSecondary) {
        $('#cur_stream_wrapper').show();
    } else {
        $('#cur_stream_wrapper').hide();
        $('#cur_stream_code').val('');  // clear if not XI/XII
    }
}

// Run when user changes Present Class
$('#present_class').on('change', function () {
    toggleStreamField($(this).val());
});

// 👇 IMPORTANT: also run once for the value loaded from DB
toggleStreamField($('#present_class').val());



    // ===================================

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
$(function () {
  // when bank changes -> request branches
  $('#bank_name').on('change', function () {
    var bankId = $(this).val();
    $('#ifsc').val('');
    $('#branch_name').html('<option value="">Loading...</option>');

    if (!bankId) {
      $('#branch_name').html('<option value="">-Please Select-</option>');
      return;
    }

    $.ajax({
      url: '/get-branches',
      type: 'GET',
      data: { bank_id: bankId },
      success: function (res) {
        // res may be { branches: [...] } or [...] — normalize to an array
        var branches = [];
        if (Array.isArray(res)) {
          branches = res;
        } else if (res && Array.isArray(res.branches)) {
          branches = res.branches;
        } else if (res && res.data && Array.isArray(res.data)) {
          // in case of resource-wrapped response
          branches = res.data;
        }

        $('#branch_name').empty().append('<option value="">-Please Select-</option>');

        if (!branches.length) {
          $('#branch_name').append('<option value="">No branches found</option>');
          return;
        }

        // branches expected format: [{id, name, branch_ifsc}, ...] or [{id, name}]
        branches.forEach(function (b) {
          var id = (b.id !== undefined) ? b.id : '';
          var name = (b.name !== undefined) ? b.name : (b.branch_name || '');
          var ifsc = (b.branch_ifsc !== undefined) ? String(b.branch_ifsc).trim() : '';
          // Make sure id is used as option value
          $('#branch_name').append(
            '<option value="' + id + '" data-ifsc="' + ifsc + '">' + name + '</option>'
          );
        });

        // optional: if only one real branch, auto-select it
        var realOpts = $('#branch_name').find('option').filter(function () {
          return $(this).val() !== '';
        });
        if (realOpts.length === 1) {
          $('#branch_name').val(realOpts.val()).trigger('change');
        }
      },
      error: function (xhr, status, err) {
        console.error('Failed to load branches', status, err);
        $('#branch_name').html('<option value="">Error loading</option>');
      }
    });
  });

  // when branch selected -> fill IFSC (fast path from data-ifsc)
  $('#branch_name').on('change', function () {
    var raw = $(this).val();

    // fast path: read data-ifsc from selected option (no AJAX)
    var ifscFromData = $(this).find('option:selected').data('ifsc');
    if (ifscFromData) {
      $('#ifsc').val(String(ifscFromData).trim());
      return;
    }

    // validate branch id before sending to server
    if (!raw || raw === '' || isNaN(parseInt(raw, 10))) {
      console.warn('Invalid branch id selected:', raw);
      $('#ifsc').val('');
      return;
    }

    var branchId = parseInt(raw, 10);
    $('#ifsc').val('Loading...');

    $.ajax({
      url: '/get-ifsc',
      type: 'GET',
      data: { branch_id: branchId },
      success: function (res) {
        // res expected { ifsc: '...' }
        var ifsc = (res && (res.ifsc !== undefined)) ? res.ifsc : (res.branch_ifsc || '');
        $('#ifsc').val(ifsc ? String(ifsc).trim() : '');
      },
      error: function () {
        $('#ifsc').val('');
      }
    });
  });
});



    // =============================
      $('.select2').select2({
          width: '100%' // Tells JS to fill the container we defined in CSS
      });
    $("form").on("submit", function(e) {
    e.preventDefault(); // Stop page refresh always
});

  });

  document.addEventListener("DOMContentLoaded", function () {
      let aadhaar_child = document.getElementById("aadhaar_child");

      aadhaar_child.addEventListener("input", function () {
          this.value = this.value.replace(/[^0-9]/g, "").slice(0, 12);
      });
  });
  // ====================================
   

document.addEventListener('DOMContentLoaded', function () {

    const bplSelect   = document.getElementById('bpl_beneficiary');
    const aaySection  = document.getElementById('aay_section');
    const bplNumberID = document.getElementById('bpl_numberID');
    const aayInput    = document.getElementById('antyodaya_anna_yojana');
    const bplInput    = document.getElementById('bpl_number');

    function toggleFields() {

        if (!bplSelect) return;
        let value = bplSelect.value;
        if (value === "1" || value.toLowerCase() === "yes") {

            if (aaySection) aaySection.style.display = "block";
            if (bplNumberID) bplNumberID.style.display = "block";

        } else {

            if (aaySection) aaySection.style.display = "none";
            if (aayInput)   aayInput.value = "";

            if (bplNumberID) bplNumberID.style.display = "none";
            if (bplInput)    bplInput.value = "";
        }
    }

    toggleFields();
    bplSelect.addEventListener("change", toggleFields);

});


  // ======================================

 document.addEventListener('DOMContentLoaded', function () {

    const cwsnSelect   = document.getElementById('cwsn');
    const impairment   = document.getElementById('impairment');
    const disPercent   = document.getElementById('disability');
    const impairmentVal = document.getElementById('type_of_impairment');
    const percentVal    = document.getElementById('disability_percentage');

    function toggleCWSNFields() {

        if (!cwsnSelect) return;

        let value = cwsnSelect.value;

        // YES = 1 (or "yes")
        if (value === '1' || value.toLowerCase() === 'yes') {

            if (impairment) impairment.style.display = 'block';
            if (disPercent) disPercent.style.display = 'block';

        } else {

            // Hide sections
            if (impairment) impairment.style.display = 'none';
            if (disPercent) disPercent.style.display = 'none';

            // Reset values
            if (impairmentVal) impairmentVal.value = '';
            if (percentVal) percentVal.value = '';
        }
    }

    // Run on page load (important for edit mode)
    toggleCWSNFields();

    // Run on change
    cwsnSelect.addEventListener('change', toggleCWSNFields);
});
  // =======================================================================
  document.addEventListener('DOMContentLoaded', function () {

    const outOfSchool     = document.getElementById('out_of_school');
    const mainstreamedSec = document.getElementById('mainstreamed_section');
    const mainstreamedVal = document.getElementById('mainstreamed');

    function toggleMainstreamed() {

        if (!outOfSchool) return;

        let value = outOfSchool.value;

        // If YES (1 or "yes")
        if (value === '1' || value.toLowerCase() === 'yes') {

            if (mainstreamedSec) mainstreamedSec.style.display = 'block';

        } else {

            if (mainstreamedSec) mainstreamedSec.style.display = 'none';

            // reset selected value
            if (mainstreamedVal) mainstreamedVal.value = '';
        }
    }

    // Run when page loads (important for edit mode)
    toggleMainstreamed();

    // Run whenever user changes Out of School field
    outOfSchool.addEventListener('change', toggleMainstreamed);

});
  // =========================================================================
$(document).ready(function () {

    function togglePrevFields(value) {
        value = (value || '').toString().toLowerCase();

        if (value === '1' || value === 'yes') {
            $('#prev_class_studied_appeared_exam').show();
            $('#no_of_days_attended_section').show();
            $('#previous_class_studied').show();
            $('#previous_section_section').show();
            $('#previous_roll_no_section').show();
            $('#previous_stream_section').show();
        } else {
            $('#prev_class_studied_appeared_exam').hide();
            $('#no_of_days_attended_section').hide();
            $('#previous_class_studied').hide();
            $('#previous_section_section').hide();
            $('#previous_roll_no_section').hide();
            $('#previous_stream_section').hide();

            // clear selection
            $('#prev_class_appeared_exam').val('');
            $('#no_of_days_attended').val('');  
            $('#previous_class').val('');  
            $('#class_section').val('');  
            $('#previous_student_roll_no').val('');  
            $('#student_stream').val(''); 
        }
    }

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

</script>

@endpush
@endsection
