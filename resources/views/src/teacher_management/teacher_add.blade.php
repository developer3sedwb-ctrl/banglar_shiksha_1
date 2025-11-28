@extends('layouts.app')

@section('title', 'Add Teacher')

@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<div class="container-fluid full-width-content">

  <!-- PAGE HEADING -->
  <div class="page-header mb-3 d-flex justify-content-between align-items-center">
    <h5 class="fw-bold mb-0">SSK/MSK Teacher Add</h5>
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
            <button class="nav-link active" id="tab1-tab" data-bs-toggle="tab" data-bs-target="#tab1" type="button" role="tab">
                Primary Details
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="tab2-tab" data-bs-toggle="tab" data-bs-target="#tab2" type="button" role="tab">
                Personal Details
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="tab3-tab" data-bs-toggle="tab" data-bs-target="#tab3" type="button" role="tab">
                Contact Details
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="tab4-tab" data-bs-toggle="tab" data-bs-target="#tab4" type="button" role="tab">
                Upload Photo
            </button>
        </li>
      </ul>
    </div>

    <div class="card-body">
      <div class="tab-content" id="studentTabContent">

        <!-- TAB 1: GENERAL INFORMATION (expanded to match image) -->
        <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1-tab">
            <form method="POST" action="{{ route('teacher.addData')}}" novalidate>
                @csrf
                <div class="row form-row-gap">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label small">District</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bx bx-spreadsheet"></i></span>
                                <select name="district_id" id="district_id" class="select2 form-select2" required onchange="getBlocksByDistrict()">
                                    <option value="">-Please Select-</option>
                                    @foreach($data['districts'] as $district)
                                        <option value="{{ $district->id }}">{{ $district->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small">School</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bx bx-spreadsheet"></i></span>
                                <select name="school_id" id="school_id" class="select2 form-select2" required onchange="getSchoolByBlock()">
                                    <option value="">-Please Select-</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small">Cluster</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bx bx-spreadsheet"></i></span>
                                <input id="cluster_id" type="text" class="form-control" placeholder="Cluster Name" readonly>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label small">Applicant Name <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bx bx-user"></i></span>
                                <input name="teachername" type="text" class="form-control" placeholder="Applicant Name" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small">Gender</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bx bx-spreadsheet"></i></span>
                                <select name="gender_code_fk" id="gender_code_fk" class="select2 form-select2" required onchange="getBlocksByDistrict()">
                                    <option value="">-Please Select-</option>
                                    @foreach(config('constants.gender') as $item)
                                        <option value="{{ $item['value'] }}">{{ $item['title'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label small">
                                Opted for service
                            </label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bx bx-spreadsheet"></i></span>
                                <select name="service_duration_code_fk" class="select2 form-select2" required onchange="getBlocksByDistrict()">
                                    <option value="">-Please Select-</option>
                                    @foreach(config('constants.teacher_service_duration') as $item)
                                        <option value="{{ $item['value'] }}">{{ $item['title'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        


                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label small">
                                Block / Municipality / Corporation
                            </label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bx bx-spreadsheet"></i></span>
                                <select name="block_id" id="block_id" class="select2 form-select2" required onchange="getSchoolByBlock()">
                                    <option value="">-Please Select-</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small">Circle</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bx bx-spreadsheet"></i></span>
                                <input id="circle_id" type="text" class="form-control" placeholder="Circle Name"  readonly>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small">GS / Ward</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bx bx-spreadsheet"></i></span>
                                <input id="ward_id" type="text" class="form-control" placeholder="GS / Ward" readonly>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label small">Date Of Birth</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bx bx-calendar"></i></span>
                                <input name="dob" type="date" class="form-control" placeholder="Applicant DOB">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small">Caste</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bx bx-spreadsheet"></i></span>
                                <select name="gender_id" class="select2 form-select2" required onchange="getBlocksByDistrict()">
                                    <option value="">-Please Select-</option>
                                    @foreach(config('constants.caste') as $item)
                                        <option value="{{ $item['value'] }}">{{ $item['title'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small">
                                Retirement Date
                            </label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bx bx-calendar"></i></span>
                                <input name="emp_retirement_date" type="date" class="form-control" placeholder="Applicant DOB">
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
            <h6 class="mb-3 fw-semibold text-uppercase">
                ENROLMENT DETAILS OF STUDENT IN PRESENT SCHOOL FOR CURRENT YEAR
            </h6>
            <div class="row">
              <div class="col-md-6">
                
              </div>
              <div class="col-md-6">
                
              </div>
            </div>

            <div class="form-actions text-end mt-3">
              <button class="btn btn-secondary me-2" data-bs-toggle="tab" data-bs-target="#tab1" type="button">Previous</button>
              <button class="btn btn-success" data-bs-toggle="tab" data-bs-target="#tab3" type="button">Next</button>
            </div>
        </div>

        <!-- TAB 3: FACILITY AND OTHER DETAILS -->
        <div class="tab-pane fade" id="tab3" role="tabpanel" aria-labelledby="tab3-tab">
            <h6 class="mb-3 fw-semibold">FACILITY AND OTHER DETAILS OF THE STUDENT</h6>
            <div class="form-actions text-end mt-3">
              <button class="btn btn-secondary me-2" data-bs-toggle="tab" data-bs-target="#tab3" type="button">Previous</button>
              <button class="btn btn-success" data-bs-toggle="tab" data-bs-target="#tab5" type="button">Next</button>
            </div>
        </div>

        <div class="tab-pane fade" id="tab4" role="tabpanel" aria-labelledby="tab4-tab">
          <form id="form-tab4">
            @csrf
            <h6 class="mb-3 fw-semibold">VOCATIONAL EDUCATION DETAILS OF THE STUDENT</h6>


            <div class="form-actions text-end mt-3">
              <button class="btn btn-secondary me-2" data-bs-toggle="tab" data-bs-target="#tab3" type="button">Previous</button>
              <button class="btn btn-success" data-bs-toggle="tab" data-bs-target="#tab5" type="button">Next</button>
            </div>
          </form>
        </div>

        <!-- TAB 5: CONTACT INFORMATION (Student + Guardian) -->
        <div class="tab-pane fade" id="tab5" role="tabpanel" aria-labelledby="tab5-tab">
            <h6 class="mb-3 fw-semibold">CONTACT INFORMATION FOR STUDENT</h6>

            

            <div class="form-actions text-end mt-3">
              <button class="btn btn-secondary me-2" data-bs-toggle="tab" data-bs-target="#tab4" type="button">Previous</button>
              <button class="btn btn-success" data-bs-toggle="tab" data-bs-target="#tab6" type="button">Next</button>
            </div>
        </div>

        <!-- TAB 6: BANK DETAILS & UPLOAD -->
        <div class="tab-pane fade" id="tab6" role="tabpanel" aria-labelledby="tab6-tab">
            <h6 class="mb-3 fw-semibold">BANK DETAILS</h6>
           
            <div class="form-actions text-end mt-3">
              <button class="btn btn-secondary me-2" data-bs-toggle="tab" data-bs-target="#tab5" type="button">Previous</button>
              <button class="btn btn-success" type="submit">Save Details</button>
            </div>
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

    function getSchoolByBlock(){
        const blockData         = document.querySelector('select[name="block_id"]');
        const schoolData        = document.querySelector('select[name="school_id"]');

        const option            = document.createElement('option');
        option.value            = "";
        option.textContent      = "-Please Select-";
        schoolData.innerHTML    = '';
        schoolData.appendChild(option);
        
        if (blockData.value) {
            fetch(`/api/school/block/${blockData.value}`)
                .then(response => response.json())
                .then(data => {
                    data.data.forEach(school => {
                        const option = document.createElement('option');
                        option.value = school.id;
                        option.textContent = school.school_name;
                        schoolData.appendChild(option);
                    });
                })
                .catch(error => {
                    console.error('Error fetching blocks:', error);
                });
        }
    }
    
    function getBlocksByDistrict() {
        const districtSelect        = document.querySelector('select[name="district_id"]');
        const blockSelect           = document.querySelector('select[name="block_id"]');
        const selectedDistrictId    = districtSelect.value;

        blockSelect.innerHTML       = '';
        const option = document.createElement('option');
        option.value = "";
        option.textContent = "-Please Select-";
        blockSelect.appendChild(option);
        
        if (selectedDistrictId) {
            fetch(`/api/blocks/${selectedDistrictId}`)
                .then(response => response.json())
                .then(data => {
                    data.data.forEach(block => {
                        const option = document.createElement('option');
                        option.value = block.id;
                        option.textContent = block.name;
                        blockSelect.appendChild(option);
                    });
                })
                .catch(error => {
                    console.error('Error fetching blocks:', error);
                });
        }
    }
</script>

@endpush
<!----------------------->

@endsection
