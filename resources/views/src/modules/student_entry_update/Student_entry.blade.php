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
                          <input 
                              id="aadhaar_child"
                              name="aadhaar_child"
                              type="text"
                              class="form-control"
                              placeholder="Aadhaar no of child"
                              maxlength="12"
                          >
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
                    <label class="form-label small">Whether BPL Beneficiary?<span class="text-danger">*</span></label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="bx bx-check"></i></span>
                      <select name="bpl_beneficiary" id="bpl_beneficiary"  class="form-select">
                        <option value="">-Please Select-</option>
                        @foreach($dropdowns['yes_no'] as $val => $label)
                            <option value="{{ $val }}">{{ $label }}</option>
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
                              <option value="{{ $val }}">{{ $label }}</option>
                          @endforeach
                        </select>
                      </div>
                  </div>

                  <div class="mb-3" id="bpl_numberID" style="display:none;">
                      <label class="form-label small">BPL Number<span class="text-danger">*</span></label>
                      <div class="input-group">
                        <span class="input-group-text"><i class="bx bx-check"></i></span>
                        <input name="bpl_number" id ="bpl_number" type="text" class="form-control" placeholder="Enter Your BPL Number" required>
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
                      <select name="cwsn" id ="cwsn"class="form-select">
                        <option value="">-Please Select-</option>
                            @foreach($dropdowns['yes_no'] as $val => $label)
                                <option value="{{ $val }}">{{ $label }}</option>
                            @endforeach
                      </select>
                    </div>
                  </div>


                  <div class="mb-3" id="impairment"  style="display:none;">
                    <label class="form-label small">(a) Type of Impairment *</label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="bx bx-info-circle"></i></span>
                      <select name="type_of_impairment" id="type_of_impairment" class="form-select">
                        <option value="">-Please Select-</option>
                            @foreach($stu_disability_type_master ?? [] as $val => $label)
                          <option value="{{ $val }}">{{ $label }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>


                   <div class="mb-3" id="disability"  style="display:none;">
                    <label class="form-label small">(b) Disability Percentage (in %)<span class="text-danger">*</span></label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="bx bx-info-circle"></i></span>
                        <input name="disability_percentage"  id ="disability_percentage" type="text" class="form-control" placeholder="Enter Disability in %">
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
                      <select name="out_of_school" id="out_of_school" class="form-select">
                        <option value="">-Please Select-</option>
                        @foreach($dropdowns['yes_no'] as $val => $label)
                        
                            <option value="{{ $val }}">{{ $label }}</option>
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
                    >
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
                          <option value="{{ $val }}">{{ $label }}</option>
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
                            <option value="{{ $val }}">{{ $label }}</option>
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
                          <option value="{{ $val }}">{{ $label }}</option>
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
                          <option value="{{ $val }}">{{ $label }}</option>
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
                          <option value="{{ $val }}">{{ $label }}</option>
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
                          <option value="{{ $val }}">{{ $label }}</option>
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
                        <option value="{{ $val }}">{{ $label }}</option>
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
                            <option value="{{ $val }}">{{ $label }}</option>
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
                        <option value="{{ $val }}">{{ $label }}</option>
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
                        <option value="{{ $val }}">{{ $label }}</option>
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
                         <select name="admission_type" id="admission_type" class="form-select">
                        <option value="">-Please Select-</option>
                        @foreach($admission_type_master ?? [] as $val => $label)
                        <option value="{{ $val }}">{{ $label }}</option>
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

    document.addEventListener("DOMContentLoaded", function () {
        let aadhaar_child = document.getElementById("aadhaar_child");

        aadhaar_child.addEventListener("input", function () {
            this.value = this.value.replace(/[^0-9]/g, "").slice(0, 12);
        });
    });
    // ====================================
       document.getElementById('bpl_beneficiary').addEventListener('change', function () {
        let aay = document.getElementById('aay_section');
        let bplNumber = document.getElementById('bpl_numberID');
        
        if (this.value == '1' || this.value.toLowerCase() === 'yes') {
            aay.style.display = 'block';
            bplNumber.style.display = 'block';
        } else {
            aay.style.display = 'none';
            document.getElementById('antyodaya_anna_yojana').value = '';

            bplNumber.style.display = 'none';
            document.getElementById('bpl_number').value = '';
        }
    });
    // ======================================

    document.getElementById('cwsn').addEventListener('change', function () {
        let impairment = document.getElementById('impairment');
        let dis_percentage = document.getElementById('disability');
        if (this.value == '1' || this.value.toLowerCase() === 'yes') {
            impairment.style.display = 'block';
            dis_percentage.style.display = 'block';
        } else {
            impairment.style.display = 'none';
            dis_percentage.style.display = 'none';
            document.getElementById('type_of_impairment').value = '';
            document.getElementById('disability_percentage').value = '';
        }
    });

// =======================================================================
       document.getElementById('out_of_school').addEventListener('change', function () {
        let mainstreamed_sec = document.getElementById('mainstreamed_section');

        if (this.value == '1' || this.value.toLowerCase() === 'yes') {
            mainstreamed_sec.style.display = 'block';

        } else {
            mainstreamed_sec.style.display = 'none';

            document.getElementById('mainstreamed').value = '';
        }
    });

// =========================================================================
      $('#admission_status_prev').on('change', function () {

            let selected = $(this).val();
            let showValue = "1";

            if (selected === showValue) {
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
        });

        $('#prev_class_appeared_exam').on('change', function () {
          let value = $(this).val();

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
          timeout: 20000,

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
        timeout: 20000,

        beforeSend: function () {
          console.log('Sending enrollment AJAX to {{ route("student.store_enrollment_details") }}');
        },

        success: function (res) {
          if (res && res.success) {
            if (window.toastr) toastr.success(res.message || 'Enrollment saved.');
            else alert(res.message || 'Enrollment saved.');

            // If you want to switch tabs programmatically after save, do it here:
            // $('#someNextTabButton').tab('show');
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
