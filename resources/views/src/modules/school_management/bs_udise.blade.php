@extends('layouts.app')

@section('title', 'Add Student')

@section('content')

<div class="container-fluid full-width-content">

  <!-- PAGE HEADING -->
  <div class="page-header mb-3 d-flex justify-content-between align-items-center">
    <h5 class="fw-bold mb-0">Add Student</h5>
    <a href="{{ route('dashboard') }}" class="btn btn-primary">
      <i class="bx bx-arrow-back"></i> Back
    </a>
  </div>

  <!-- CARD WITH TABS -->
  <div class="card card-full">
    <div class="card-header d-flex align-items-center justify-content-between border-bottom">
      <!-- TABS NAVIGATION -->
      <ul class="nav nav-tabs mb-0" id="studentTab" role="tablist">
        <li class="nav-item" role="presentation">
          <button class="nav-link active" id="tab1-tab" data-bs-toggle="tab" data-bs-target="#tab1" type="button" role="tab">PHYSICAL FACILITIES AND EQUIPMENT IN SCHOOLS</button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="tab2-tab" data-bs-toggle="tab" data-bs-target="#tab2" type="button" role="tab">PHYSICAL FACILITIES AND EQUIPMENT IN SCHOOLS WITH SECONDARY / HIGHER SECONDARY SECTIONS</button>
        </li>

      </ul>
    </div>

    <div class="card-body">
      <div class="tab-content" id="studentTabContent">

        <!-- TAB 1: GENERAL INFORMATION (expanded to match image) -->
        <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1-tab">
          <form method="POST" action="#" novalidate>
            @csrf

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
                  <label class="form-label small">Date of Birth <span class="text-danger">*</span></label>
                  <div class="input-group">
                    <span class="input-group-text"><i class="bx bx-calendar"></i></span>
                    <input name="dob" type="date" class="form-control" required>
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
                  <label class="form-label small">Aadhaar No of Child</label>
                  <div class="input-group">
                    <span class="input-group-text"><i class="bx bx-id-card"></i></span>
                    <input name="aadhaar_child" type="text" class="form-control" placeholder="Aadhaar no of child">
                  </div>
                </div>

                <div class="mb-3">
                  <label class="form-label small">Mother Tongue of the Child</label>
                  <div class="input-group">
                    <span class="input-group-text"><i class="bx bx-message-alt-detail"></i></span>
                    <input name="mother_tongue" type="text" class="form-control" placeholder="Mother tongue">
                  </div>
                </div>

                <div class="mb-3">
                  <label class="form-label small">Religion <span class="text-danger">*</span></label>
                  <div class="input-group">
                    <span class="input-group-text"><i class="bx bx-book"></i></span>
                    <select name="religion" class="form-select" required>
                      <option value="">-Please Select-</option>
                      <option value="Hindu">Hindu</option>
                      <option value="Muslim">Muslim</option>
                      <option value="Christian">Christian</option>
                      <option value="Other">Other</option>
                    </select>
                  </div>
                </div>

                <div class="mb-3">
                  <label class="form-label small">Whether BPL Beneficiary?</label>
                  <div class="input-group">
                    <span class="input-group-text"><i class="bx bx-check"></i></span>
                    <select name="bpl_beneficiary" class="form-select">
                      <option value="">-Please Select-</option>
                      <option value="Yes">Yes</option>
                      <option value="No">No</option>
                    </select>
                  </div>
                </div>

                <div class="mb-3">
                  <label class="form-label small">Whether EWS / Economically Weaker?</label>
                  <div class="input-group">
                    <span class="input-group-text"><i class="bx bx-wallet"></i></span>
                    <select name="ews" class="form-select">
                      <option value="">-Please Select-</option>
                      <option value="Yes">Yes</option>
                      <option value="No">No</option>
                    </select>
                  </div>
                </div>
                <div class="mb-3">
                  <label class="form-label small">Blood Group</label>
                  <div class="input-group">
                    <span class="input-group-text"><i class="bx bx-droplet"></i></span>
                    <select name="blood_group" class="form-select">
                      <option value="">-Please Select-</option>
                      <option value="A+">A+</option>
                      <option value="A-">A-</option>
                      <option value="B+">B+</option>
                      <option value="B-">B-</option>
                      <option value="AB+">AB+</option>
                      <option value="AB-">AB-</option>
                      <option value="O+">O+</option>
                      <option value="O-">O-</option>
                    </select>
                  </div>
                </div>
                
                <div class="mb-3">
                  <label class="form-label small">Multi Select Dropdown</label>
                  <div class="input-group">
                    <span class="input-group-text"><i class="bx bx-spreadsheet"></i></span>
                    <select class="selectpicker form-select" multiple aria-label="Default select example" data-live-search="true">
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                    <option value="4">Four</option>
                  </select>
                  </div>
                </div> 
                
                
                <div class="mb-3">
                  <label class="form-label small">Multi Select Dropdown</label>
                  <div class="input-group">
                    <span class="input-group-text"><i class="bx bx-spreadsheet"></i></span>
                    <select class="select2 form-select2">
                        <option value="1">Option 1</option>
                        <option value="2">Option 2</option>
                        <option value="3">Option 3</option>
                        <option value="4">Option 4</option>
                        <option value="5">Option 5</option>
                        <option value="6">Option 6</option>
                        <option value="7">Option 7</option>
                        <option value="8">Option 8</option>
               		 </select>
                  </div>
                </div>        
                
              </div>

              <div class="col-md-6">
                <div class="mb-3">
                  <label class="form-label small">Mother's Name <span class="text-danger">*</span></label>
                  <div class="input-group">
                    <span class="input-group-text"><i class="bx bx-user"></i></span>
                    <input name="mother_name" type="text" class="form-control" placeholder="Mother's name" required>
                  </div>
                </div>

                <div class="mb-3">
                  <label class="form-label small">Gender <span class="text-danger">*</span></label>
                  <div class="input-group">
                    <span class="input-group-text"><i class="bx bx-male-female"></i></span>
                    <select name="gender" class="form-select" required>
                      <option value="">-Please Select-</option>
                      <option value="Male">Male</option>
                      <option value="Female">Female</option>
                      <option value="Other">Other</option>
                    </select>
                  </div>
                </div>

                <div class="mb-3">
                  <label class="form-label small">Whether CWSN (Child with Special Needs)?</label>
                  <div class="input-group">
                    <span class="input-group-text"><i class="bx bx-heart"></i></span>
                    <select name="cwsn" class="form-select">
                      <option value="">-Please Select-</option>
                      <option value="Yes">Yes</option>
                      <option value="No">No</option>
                    </select>
                  </div>
                </div>

                <div class="mb-3">
                  <label class="form-label small">Nationality</label>
                  <div class="input-group">
                    <span class="input-group-text"><i class="bx bx-flag"></i></span>
                    <input name="nationality" type="text" class="form-control" placeholder="Nationality">
                  </div>
                </div>

                <div class="mb-3">
                  <label class="form-label small">Is the Child enrolled as Out of School Child?</label>
                  <div class="input-group">
                    <span class="input-group-text"><i class="bx bx-school"></i></span>
                    <select name="out_of_school" class="form-select">
                      <option value="">-Please Select-</option>
                      <option value="Yes">Yes</option>
                      <option value="No">No</option>
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
                  <label class="form-label small">Relationship with Guardian</label>
                  <div class="input-group">
                    <span class="input-group-text"><i class="bx bx-link-alt"></i></span>
                    <input name="relationship_with_guardian" type="text" class="form-control" placeholder="Relationship with guardian">
                  </div>
                </div>

                <div class="mb-3">
                  <label class="form-label small">Annual Family Income</label>
                  <div class="input-group">
                    <span class="input-group-text"><i class="bx bx-rupee"></i></span>
                    <input name="annual_family_income" type="number" step="0.01" class="form-control" placeholder="Annual family income">
                  </div>
                </div> 
              </div>
            </div>

            <div class="form-actions text-end mt-3">
              <button class="btn btn-success" data-bs-toggle="tab" data-bs-target="#tab2" type="button">Next</button>
            </div>
          </form>
        </div>

        <!-- TAB 2: ENROLMENT DETAILS (recreated from image) -->
        <div class="tab-pane fade" id="tab2" role="tabpanel" aria-labelledby="tab2-tab">
          <form method="POST" action="#" novalidate>
            @csrf

              <h6 class="mb-3 fw-semibold text-uppercase">
        ENROLMENT DETAILS OF STUDENT IN PRESENT SCHOOL FOR CURRENT YEAR
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
                  <label class="form-label small">Status of Admission in Previous Academic Year / Year of Rejoining</label>
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

                <!-- Admission From (Previous School / Source) -->
                <div class="mb-3">
                  <label class="form-label small">Admission From (Previous School / Source)</label>
                  <div class="input-group">
                    <span class="input-group-text"><i class="bx bx-building"></i></span>
                    <input name="admission_from" type="text" class="form-control" placeholder="Previous school or source">
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
                <div class="mb-3">
                  <label class="form-label small">Admission Category</label>
                  <div class="input-group">
                    <span class="input-group-text"><i class="bx bx-category"></i></span>
                    <select name="admission_category" class="form-select">
                      <option value="">-Please Select-</option>
                      <option value="New">New</option>
                      <option value="Promotion">Promotion</option>
                      <option value="Re-admission">Re-admission</option>
                    </select>
                  </div>
                </div>

                <!-- Class at Admission -->
                <div class="mb-3">
                  <label class="form-label small">Class at Admission</label>
                  <div class="input-group">
                    <span class="input-group-text"><i class="bx bx-indent"></i></span>
                    <select name="class_at_admission" class="form-select">
                      <option value="">-Please Select-</option>
                      <option value="Nursery">Nursery</option>
                      <option value="KG">KG</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <!-- add more options -->
                    </select>
                  </div>
                </div>

              </div>
            </div>

            <div class="form-actions text-end mt-3">
              <button class="btn btn-secondary me-2" data-bs-toggle="tab" data-bs-target="#tab1" type="button">Previous</button>
              <button class="btn btn-success" data-bs-toggle="tab" data-bs-target="#tab3" type="button">Next</button>
            </div>
          </form>
        </div>

        <!-- TAB 3: FACILITY AND OTHER DETAILS -->
        <div class="tab-pane fade" id="tab3" role="tabpanel" aria-labelledby="tab3-tab">
          <form method="POST" action="#">
            @csrf

            <h6 class="mb-3 fw-semibold">FACILITY AND OTHER DETAILS OF THE STUDENT</h6>

            <div class="row">
              <div class="col-md-6">
                <div class="mb-3">
                  <label class="form-label small">Facilities provided to the Student (for year of study)</label>
                  <div class="input-group">
                    <span class="input-group-text"><i class="bx bx-gift"></i></span>
                    <input name="facilities_provided" type="text" class="form-control" placeholder="Facilities received">
                  </div>
                </div>

                <div class="mb-3">
                  <label class="form-label small">Free Textbooks?</label>
                  <select name="free_textbooks" class="form-select">
                    <option value="">-Please Select-</option>
                    <option>Yes</option>
                    <option>No</option>
                  </select>
                </div>

                <div class="mb-3">
                  <label class="form-label small">Free Uniform?</label>
                  <select name="free_uniform" class="form-select">
                    <option value="">-Please Select-</option>
                    <option>Yes</option>
                    <option>No</option>
                  </select>
                </div>

                <div class="mb-3">
                  <label class="form-label small">Free Transport?</label>
                  <select name="free_transport" class="form-select">
                    <option value="">-Please Select-</option>
                    <option>Yes</option>
                    <option>No</option>
                  </select>
                </div>

                <div class="mb-3">
                  <label class="form-label small">Free Bicycle?</label>
                  <select name="free_bicycle" class="form-select">
                    <option value="">-Please Select-</option>
                    <option>Yes</option>
                    <option>No</option>
                  </select>
                </div>
              </div>

              <div class="col-md-6">
                <div class="mb-3">
                  <label class="form-label small">Free Stationery?</label>
                  <select name="free_stationery" class="form-select">
                    <option value="">-Please Select-</option>
                    <option>Yes</option>
                    <option>No</option>
                  </select>
                </div>

                <div class="mb-3">
                  <label class="form-label small">Free School Bag?</label>
                  <select name="free_school_bag" class="form-select">
                    <option value="">-Please Select-</option>
                    <option>Yes</option>
                    <option>No</option>
                  </select>
                </div>

                <div class="mb-3">
                  <label class="form-label small">Free Shoes?</label>
                  <select name="free_shoes" class="form-select">
                    <option value="">-Please Select-</option>
                    <option>Yes</option>
                    <option>No</option>
                  </select>
                </div>

                <div class="mb-3">
                  <label class="form-label small">Free Midday Meal?</label>
                  <select name="free_midday_meal" class="form-select">
                    <option value="">-Please Select-</option>
                    <option>Yes</option>
                    <option>No</option>
                  </select>
                </div>
              </div>
            </div>

           

            <h6 class="mb-3 fw-semibold">Scholarship Received by Student</h6>

            <div class="row">
              <div class="col-md-6">
                <div class="mb-3">
                  <label class="form-label small">Central Scholarship</label>
                  <input name="central_scholarship" type="text" class="form-control" placeholder="Scholarship name">
                </div>

                <div class="mb-3">
                  <label class="form-label small">State Scholarship</label>
                  <input name="state_scholarship" type="text" class="form-control" placeholder="Scholarship name">
                </div>

                <div class="mb-3">
                  <label class="form-label small">District Scholarship</label>
                  <input name="district_scholarship" type="text" class="form-control" placeholder="Scholarship name">
                </div>

                <div class="mb-3">
                  <label class="form-label small">Other Scholarship</label>
                  <input name="other_scholarship" type="text" class="form-control" placeholder="Scholarship name">
                </div>
              </div>
            </div>

           

            <h6 class="mb-3 fw-semibold">Co-Curricular & Additional Information</h6>

            <div class="row">
              <div class="col-md-6">
                <div class="mb-3">
                  <label class="form-label small">Whether student has been assessed for Autism / Special Needs?</label>
                  <select name="assessed_special_needs" class="form-select">
                    <option value="">-Please Select-</option>
                    <option>Yes</option>
                    <option>No</option>
                  </select>
                </div>

                <div class="mb-3">
                  <label class="form-label small">Whether student has participated in extracurricular activity?</label>
                  <select name="participated_extracurricular" class="form-select">
                    <option value="">-Please Select-</option>
                    <option>Yes</option>
                    <option>No</option>
                  </select>
                </div>

                <div class="mb-3">
                  <label class="form-label small">Does the child participate in NCC / NSS / Scouts & Guides?</label>
                  <select name="ncc_participation" class="form-select">
                    <option value="">-Please Select-</option>
                    <option>Yes</option>
                    <option>No</option>
                  </select>
                </div>

                <div class="mb-3">
                  <label class="form-label small">Whether Child is Covered under RTE Act?</label>
                  <select name="rte_covered" class="form-select">
                    <option value="">-Please Select-</option>
                    <option>Yes</option>
                    <option>No</option>
                  </select>
                </div>
              </div>

              <div class="col-md-6">
                <div class="mb-3">
                  <label class="form-label small">Whether Student has a Digital Device?</label>
                  <select name="digital_device" class="form-select">
                    <option value="">-Please Select-</option>
                    <option>Yes</option>
                    <option>No</option>
                  </select>
                </div>

                <div class="mb-3">
                  <label class="form-label small">Whether Student has access to the Internet?</label>
                  <select name="internet_access" class="form-select">
                    <option value="">-Please Select-</option>
                    <option>Yes</option>
                    <option>No</option>
                  </select>
                </div>

                <div class="mb-3">
                  <label class="form-label small">Whether Student has participated in Sports at State / National Level?</label>
                  <select name="sports_participation" class="form-select">
                    <option value="">-Please Select-</option>
                    <option>Yes</option>
                    <option>No</option>
                  </select>
                </div>

                <div class="mb-3">
                  <label class="form-label small">Whether Student has received any Award / Recognition?</label>
                  <select name="awards_received" class="form-select">
                    <option value="">-Please Select-</option>
                    <option>Yes</option>
                    <option>No</option>
                  </select>
                </div>
              </div>
            </div>

            <div class="form-actions text-end mt-3">
              <button class="btn btn-secondary me-2" data-bs-toggle="tab" data-bs-target="#tab3" type="button">Previous</button>
              <button class="btn btn-success" data-bs-toggle="tab" data-bs-target="#tab5" type="button">Next</button>
            </div>
          </form>
        </div>

        <div class="tab-pane fade" id="tab4" role="tabpanel" aria-labelledby="tab4-tab">
          <form id="form-tab4">
            @csrf
            <h6 class="mb-3 fw-semibold">VOCATIONAL EDUCATION DETAILS OF THE STUDENT</h6>

            <div class="row">
              <div class="col-md-6">
                <div class="mb-3">
                  <label class="form-label small">Was the student provided any exposure to Vocational activities?</label>
                  <select name="vocational_exposure" class="form-select">
                    <option value="">-Please Select-</option>
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                  </select>
                </div>

                <div class="mb-3">
                  <label class="form-label small">Did the student undertake any vocational course?</label>
                  <select name="undertook_vocational_course" class="form-select">
                    <option value="">-Please Select-</option>
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                  </select>
                </div>

                <div class="mb-3">
                  <label class="form-label small">If yes, specify course name</label>
                  <input name="vocational_course_name" type="text" class="form-control" placeholder="Course name">
                </div>
              </div>
            </div>

            <div class="form-actions text-end mt-3">
              <button class="btn btn-secondary me-2" data-bs-toggle="tab" data-bs-target="#tab3" type="button">Previous</button>
              <button class="btn btn-success" data-bs-toggle="tab" data-bs-target="#tab5" type="button">Next</button>
            </div>
          </form>
        </div>

        <!-- TAB 5: CONTACT INFORMATION (Student + Guardian) -->
        <div class="tab-pane fade" id="tab5" role="tabpanel" aria-labelledby="tab5-tab">
          <form id="form-tab5">
            @csrf
            <h6 class="mb-3 fw-semibold">CONTACT INFORMATION FOR STUDENT</h6>

            <div class="row">
              <div class="col-md-6">
                <div class="mb-3">
                  <label class="form-label small">Select Country</label>
                  <select name="student_country" class="form-select">
                    <option value="">INDIA</option>
                    <!-- populate as needed -->
                  </select>
                </div>

                <div class="mb-3">
                  <label class="form-label small">Address</label>
                  <input name="student_address" type="text" class="form-control" placeholder="Address">
                </div>

                <div class="mb-3">
                  <label class="form-label small">District</label>
                  <input name="student_district" type="text" class="form-control" placeholder="District">
                </div>

                <div class="mb-3">
                  <label class="form-label small">Panchayat</label>
                  <input name="student_panchayat" type="text" class="form-control" placeholder="Panchayat / Ward">
                </div>

                <div class="mb-3">
                  <label class="form-label small">Police Station</label>
                  <input name="student_police_station" type="text" class="form-control" placeholder="Police station">
                </div>

                <div class="mb-3">
                  <label class="form-label small">Mobile Number (Student / Parent / Guardian)</label>
                  <input name="student_mobile" type="text" class="form-control" placeholder="Mobile number">
                </div>
              </div>

              <div class="col-md-6">
                <div class="mb-3">
                  <label class="form-label small">Select State</label>
                  <select name="student_state" class="form-select">
                    <option value="">WEST BENGAL</option>
                  </select>
                </div>

                <div class="mb-3">
                  <label class="form-label small">Habitation / Locality</label>
                  <input name="student_locality" type="text" class="form-control" placeholder="Habitation / Locality">
                </div>

                <div class="mb-3">
                  <label class="form-label small">Block/Municipal</label>
                  <input name="student_block" type="text" class="form-control" placeholder="Block / Municipality">
                </div>

                <div class="mb-3">
                  <label class="form-label small">Post Office</label>
                  <input name="student_post_office" type="text" class="form-control" placeholder="Post office">
                </div>

                <div class="mb-3">
                  <label class="form-label small">Pin Code</label>
                  <input name="student_pincode" type="text" class="form-control" placeholder="Pin Code">
                </div>

                <div class="mb-3">
                  <label class="form-label small">Contact email id (Student/Parent/Guardian)</label>
                  <input name="student_email" type="email" class="form-control" placeholder="Email">
                </div>
              </div>
            </div>

            <hr class="my-3">

            <h6 class="mb-3 fw-semibold">CONTACT INFORMATION FOR GUARDIAN</h6>

            <div class="form-check mb-2">
              <input class="form-check-input" type="checkbox" id="same-as-student" />
              <label class="form-check-label small" for="same-as-student">Same as Student Address</label>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="mb-3">
                  <label class="form-label small">Country</label>
                  <select name="guardian_country" class="form-select">
                    <option value="">INDIA</option>
                  </select>
                </div>

                <div class="mb-3">
                  <label class="form-label small">Address</label>
                  <input name="guardian_address" type="text" class="form-control" placeholder="Guardian address">
                </div>

                <div class="mb-3">
                  <label class="form-label small">District</label>
                  <input name="guardian_district" type="text" class="form-control" placeholder="District">
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
                  <input name="guardian_mobile" type="text" class="form-control" placeholder="Mobile number">
                </div>
              </div>

              <div class="col-md-6">
                <div class="mb-3">
                  <label class="form-label small">State</label>
                  <select name="guardian_state" class="form-select">
                    <option value="">WEST BENGAL</option>
                  </select>
                </div>

                <div class="mb-3">
                  <label class="form-label small">Habitation / Locality</label>
                  <input name="guardian_locality" type="text" class="form-control" placeholder="Habitation / Locality">
                </div>

                <div class="mb-3">
                  <label class="form-label small">Block / Municipality</label>
                  <input name="guardian_block" type="text" class="form-control" placeholder="Block / Municipality">
                </div>

                <div class="mb-3">
                  <label class="form-label small">Post Office</label>
                  <input name="guardian_post_office" type="text" class="form-control" placeholder="Post office">
                </div>

                <div class="mb-3">
                  <label class="form-label small">Pin Code</label>
                  <input name="guardian_pincode" type="text" class="form-control" placeholder="Pin Code">
                </div>

                <div class="mb-3">
                  <label class="form-label small">Contact email id (Guardian)</label>
                  <input name="guardian_email" type="email" class="form-control" placeholder="Email">
                </div>
              </div>
            </div>

            <div class="form-actions text-end mt-3">
              <button class="btn btn-secondary me-2" data-bs-toggle="tab" data-bs-target="#tab4" type="button">Previous</button>
              <button class="btn btn-success" data-bs-toggle="tab" data-bs-target="#tab6" type="button">Next</button>
            </div>
          </form>
        </div>

        <!-- TAB 6: BANK DETAILS & UPLOAD -->
        <div class="tab-pane fade" id="tab6" role="tabpanel" aria-labelledby="tab6-tab">
          <form id="form-tab6" method="POST" action="#" enctype="multipart/form-data">
            @csrf
            <h6 class="mb-3 fw-semibold">BANK DETAILS</h6>

            <div class="row">
              <div class="col-md-6">
                <div class="mb-3">
                  <label class="form-label small">Bank Name</label>
                  <input name="bank_name" type="text" class="form-control" placeholder="Bank name">
                </div>

                <div class="mb-3">
                  <label class="form-label small">IFSC</label>
                  <input name="ifsc" type="text" class="form-control" placeholder="IFSC code">
                </div>

                <div class="mb-3">
                  <label class="form-label small">Account Number</label>
                  <input name="account_number" type="text" class="form-control" placeholder="Account number">
                </div>

                <div class="mb-3">
                  <label class="form-label small">Confirm Account Number</label>
                  <input name="confirm_account_number" type="text" class="form-control" placeholder="Confirm account number">
                </div>
              </div>

              <div class="col-md-6">
                <div class="mb-3">
                  <label class="form-label small">Branch Name</label>
                  <input name="branch_name" type="text" class="form-control" placeholder="Branch name">
                </div>

                <div class="mb-3">
                  <label class="form-label small">Branch Code</label>
                  <input name="branch_code" type="text" class="form-control" placeholder="Branch code">
                </div>
              </div>
            </div>

           
            <div class="form-actions text-end mt-3">
              <button class="btn btn-secondary me-2" data-bs-toggle="tab" data-bs-target="#tab5" type="button">Previous</button>
              <button class="btn btn-success" type="submit">Save Details</button>
            </div>
          </form>
        </div>

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

<!-- add custom scripts here if needed -->
<script>
$(document).ready(function() {
    $('.select2').select2({
        width: '100%' // Tells JS to fill the container we defined in CSS
    });
});
</script>

@endpush
<!----------------------->

@endsection
