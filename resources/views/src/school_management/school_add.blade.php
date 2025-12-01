@extends('layouts.app')

@section('title', 'Add School')

@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<div class="container-fluid full-width-content">

  <!-- PAGE HEADING -->
  <div class="page-header mb-3">
    <h4 class="fw-bold"><i class="bx bx-user-plus"></i> Add New School</h4>
  </div>

  <!-- GENERAL INFORMATION -->
  <div class="card card-full">
        @if(session('success'))
    <div class="card-header">
        <div class="alert alert-success alert-dismissible fade show mb-0" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
    @endif
    @if(session('error'))
    <div class="card-header">
        <div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
    @endif

    <div class="card-body">
      <form method="POST" action="{{ route('school.add') }}" novalidate>
        @csrf

        <div class="row form-row-gap">
            <div class="col-md-12">
                <div class="mb-2">
                    <label class="form-label small">School Name <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bx bx-user"></i></span>
                        <input name="school_name" type="text" class="form-control" placeholder="Name of the student" required>
                    </div>
                </div>
            </div>
        </div>


        <div class="row form-row-gap">
            <div class="col-md-4 mb-2">
                <label class="form-label small">District <span class="text-danger">*</span></label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bx bx-book"></i></span>
                    <select name="district_id" id="district_id" class="select2 form-select2" required onchange="getBlocksByDistrict()">
                        <option value="">-Please Select-</option>
                        @foreach($data['districts'] as $district)
                            <option value="{{ $district->id }}">{{ $district->name }}</option>
                        @endforeach
                    </select>
                </div> 
            </div>

            <div class="col-md-4 mb-2">
                <label class="form-label small">Sub-Division <span class="text-danger">*</span></label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bx bx-book"></i></span>
                    <select name="sub_division" class="select2 form-select2" required>
                    <option value="">-Please Select-</option>
                    </select>
                </div>
            </div>

            <div class="col-md-4 mb-2">
                <label class="form-label small">Block / Municipality / Corporation <span class="text-danger">*</span></label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bx bx-book"></i></span>
                    <select name="block_id" id="block_id" class="select2 form-select2"  required onchange="getWardsByBlock()">
                    <option value="">-Please Select-</option>
                    </select>
                </div>
            </div>

            <div class="col-md-4 mb-2">
                <label class="form-label small">Circle <span class="text-danger">*</span></label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bx bx-book"></i></span>
                    <select name="circle_id" id="circle_id" class="select2 form-select2" required>
                    <option value="">-Please Select-</option>
                    </select>
                </div>
            </div>

            <div class="col-md-4 mb-2">
                <label class="form-label small">Cluster <span class="text-danger">*</span></label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bx bx-book"></i></span>
                    <select name="cluster_id" id="cluster_id" class="select2 form-select2" required>
                    <option value="">-Please Select-</option>
                    </select>
                </div>
            </div>

            <div class="col-md-4 mb-2">
                <label class="form-label small">GS WARD <span class="text-danger">*</span></label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bx bx-book"></i></span>
                    <select name="ward_id" id="ward_id" class="select2 form-select2" required onchange="getDiseCode()">
                    <option value="">-Please Select-</option>
                    </select>
                </div>
            </div>

            <div class="col-md-4 mb-2">
                <label class="form-label small">School Dise Code <span class="text-danger">*</span></label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bx bx-book"></i></span>
                    <input name="school_dise_code" id="school_dise_code" type="text" class="form-control" placeholder="School Dise Code" required readonly>
                </div>
            </div>
            <div class="col-md-4 mb-2">
                <label class="form-label small">Year of Establishment <span class="text-danger">*</span></label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bx bx-book"></i></span>
                    <input name="school_establishment_year" type="number" min="1950" max="{{ date('Y') }}" class="form-control" placeholder="Year" required>
                </div>
            </div>
            <div class="col-md-4 mb-2">
                <label class="form-label small">Management <span class="text-danger">*</span></label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bx bx-book"></i></span>
                    <select name="school_management" class="select2 form-select2" required onchange="getSchoolCategoryTypes()">
                    <option value="">-Please Select-</option>
                    @foreach($data['school_managements'] as $management)
                        <option value="{{ $management->id }}">{{ $management->name }}</option>
                    @endforeach
                    </select>
                </div>
            </div>

            <div class="col-md-4 mb-2">
                <label class="form-label small">School Catagory Type <span class="text-danger">*</span></label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bx bx-book"></i></span>
                    <select name="sch_cat_type_code_fk" class="select2 form-select2" required>
                    <option value="">-Please Select-</option>                    
                    </select>
                </div>
            </div>
            <div class="col-md-4 mb-2">
                <label class="form-label small">School Type <span class="text-danger">*</span></label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bx bx-book"></i></span>
                    <select name="school_type" class="form-select" required>
                        <option value="">-Please Select-</option>
                        @foreach(config('constants.school_types') as $type)
                            <option value="{{ $type['value'] }}">{{ $type['title'] }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-4 mb-2">
                <label class="form-label small">School Category <span class="text-danger">*</span></label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bx bx-book"></i></span>
                    <select name="school_category_type" class="form-select" required>
                        <option value="">-Please Select-</option>
                        @foreach($data['school_categories'] as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-md-4 mb-2">
                <label class="form-label small">School Location <span class="text-danger">*</span></label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bx bx-book"></i></span>
                    <select name="school_location" class="form-select" required>
                    <option value="">-Please Select-</option>
                    @foreach(config('constants.school_locations') as $location)
                        <option value="{{ $location['value'] }}">{{ $location['title'] }}</option>
                    @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-4 mb-2">
                <label class="form-label small">High class <span class="text-danger">*</span></label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bx bx-book"></i></span>
                    <select name="high_class" class="select2 form-select2" required onchange="getLowClass()">
                    <option value="">-Please Select-</option>
                    @foreach($data['high_classes'] as $high_class)
                        <option value="{{ $high_class['value'] }}">{{ $high_class['title'] }}</option>
                    @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-4 mb-2">
                <label class="form-label small">Low class <span class="text-danger">*</span></label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bx bx-book"></i></span>
                    <select name="low_class" class="select2 form-select2" required onchange="setClassSectionRows()">
                    <option value="">-Please Select-</option>
                    </select>
                </div>
            </div>

            
            <div class="col-md-4 mb-2">
                <label class="form-label small">Student Lock/Unlock <span class="text-danger">*</span></label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bx bx-book"></i></span>
                    <select name="school_student_lock_status" class="form-select" required>
                    <option value="">-Please Select-</option>
                    @foreach(config('constants.school_student_lock_unlock') as $option)
                        <option value="{{ $option['value'] }}">{{ $option['title'] }}</option>
                    @endforeach
                    </select>
                </div>
            </div>

            <div class="col-md-4 mb-2">
                <label class="form-label small">Uniform status <span class="text-danger">*</span></label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bx bx-book"></i></span>
                    <select name="school_uniform_status" class="form-select" required>
                    <option value="">-Please Select-</option>
                    @foreach(config('constants.school_uniform_status') as $option)
                        <option value="{{ $option['value'] }}">{{ $option['title'] }}</option>
                    @endforeach
                    </select>
                </div>
            </div>

            <div class="col-md-4 mb-2">
                <label class="form-label small">Medium <span class="text-danger">*</span></label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bx bx-book"></i></span>
                    <select name="school_mediums[]" class="select2 form-select2" required multiple>
                    <option value="">-Please Select-</option>
                    @foreach($data['mediums'] as $medium)
                        <option value="{{ $medium->id }}">{{ $medium->name }}</option>
                    @endforeach
                    </select>
                </div>
            </div>
            
        </div>


        <div class="row form-row-gap">
            <div class="col-md-12 mb-2">
                <label class="form-label small">Number of sections by class (if the class is stand alone, has no section then put one)
            </div>
        </div>
        <div class="row form-row-gap class-sections-row">
        </div>

        <!-- FORM ACTIONS -->
        <div class="form-actions text-end mt-3">
          <button class="btn btn-secondary me-2" type="submit" name="action" value="save_draft">Cancel</button>
          <button class="btn btn-primary" type="submit" name="action" value="next">Save</button>
        </div>

      </form>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
    const preRoman = n => ["PRE PRIMARY","LKG","NURSERY"][n] || n;
    const toRoman = n => ["","I","II","III","IV","V","VI","VII","VIII","IX","X","XI","XII"][n] || n;
    const lowClasses    = <?php echo json_encode(config('constants.low_classes')); ?>;
    function getLowClass(){
        const highClassSelect   = document.querySelector('select[name="high_class"]');
        const lowClassSelect    = document.querySelector('select[name="low_class"]');
        lowClassSelect.innerHTML   = '';

        const option = document.createElement('option');
        option.value = '';
        option.textContent = '-Please Select-';
        lowClassSelect.appendChild(option);

        lowClasses.forEach(data => {
            if(data.value >= highClassSelect.value){
                return;
            }
            const option = document.createElement('option');
            option.value = data.value;
            option.textContent = data.title;
            lowClassSelect.appendChild(option);
        });
    }

    function getDiseCode(){
        const selectedWard  = document.querySelector('select[name="ward_id"]');
        const ward_id       = parseInt(selectedWard.value);
        fetch(`/api/getdisecode/${ward_id}`)
            .then(response => response.json())
            .then(data => {
                if(data.data && data.data.disecode){
                    document.querySelector('input[name="school_dise_code"]').value = data.data.disecode;
                } else {
                    document.querySelector('input[name="school_dise_code"]').value = '';
                }
            })
            .catch(error => {
                console.error('Error fetching school category types:', error);
            });
    }


    function setClassSectionRows(){
        // Get selected low class
        const lowClassSelect = document.querySelector('select[name="low_class"]');
        const highClassSelect = document.querySelector('select[name="high_class"]');

        const selectedLowClass = parseInt(lowClassSelect.value);
        const selectedHighClass = parseInt(highClassSelect.value);

        let classNumber = selectedLowClass
        let str = ''
        while (selectedHighClass >= classNumber){
            className = classNumber > 0 ? 'Class '+toRoman(classNumber) : preRoman(classNumber*(-1));
            str += `
            <div class="col-md-4 mb-2">
                <label class="form-label small">`+toRoman(className)+` <span class="text-danger">*</span></label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bx bx-book"></i></span>
                    <input name="schooL_class_sections[`+classNumber+`]" type="number" min="1" max="50" class="form-control" placeholder="Number of sections in `+toRoman(className)+`" required>
                </div>
            </div>`;
            classNumber++;
        }
        const classSectionsRow = document.querySelector('.class-sections-row');
        classSectionsRow.innerHTML = str;
    } 
    

    function getSchoolCategoryTypes(){
        const managementSelect   = document.querySelector('select[name="school_management"]');
        const categoryTypeSelect = document.querySelector('select[name="sch_cat_type_code_fk"]');
        const selectedManagementId = managementSelect.value;

        categoryTypeSelect.innerHTML   = '';

        if (selectedManagementId) {
            fetch(`/api/management-school-category-types/${selectedManagementId}`)
                .then(response => response.json())
                .then(data => {
                    data.data.forEach(categoryType => {
                        const option = document.createElement('option');
                        option.value = categoryType.id;
                        option.textContent = categoryType.name;
                        categoryTypeSelect.appendChild(option);
                    });
                })
                .catch(error => {
                    console.error('Error fetching school category types:', error);
                });
        }
    }

    function getWardsByBlock() {
        const blockSelect = document.querySelector('select[name="block_id"]');
        const wardSelect = document.querySelector('select[name="ward_id"]');
        const selectedBlockId = blockSelect.value;

        wardSelect.innerHTML   = '';
        const optionWard = document.createElement('option');
        optionWard.value = "";
        optionWard.textContent = "-Please Select-";
        wardSelect.appendChild(optionWard);

        if (selectedBlockId) {
            fetch(`/api/wards/${selectedBlockId}`)
                .then(response => response.json())
                .then(data => {
                    if(data.data.length < 1){
                        const option = document.createElement('option');
                        option.value = 0;
                        option.textContent = 'Not Available';
                        wardSelect.appendChild(option);
                    }
                    data.data.forEach(ward => {
                        const option = document.createElement('option');
                        option.value = ward.id;
                        option.textContent = ward.name;
                        wardSelect.appendChild(option);
                    });
                })
                .catch(error => {
                    console.error('Error fetching wards:', error);
                });
        }
    }   

    function getBlocksByDistrict() {
        const districtSelect = document.querySelector('select[name="district_id"]');
        const blockSelect = document.querySelector('select[name="block_id"]');
        const circleSelect = document.querySelector('select[name="circle_id"]');
        const clusterSelect = document.querySelector('select[name="cluster_id"]');
        const subdivisionSelect = document.querySelector('select[name="sub_division"]');
        
        const selectedDistrictId = districtSelect.value;

        blockSelect.innerHTML   = '';
        circleSelect.innerHTML  = '';
        clusterSelect.innerHTML = '';
        subdivisionSelect.innerHTML = '';

        const optionBlock = document.createElement('option');
        optionBlock.value = "";
        optionBlock.textContent = "-Please Select-";
        const optionCircle = document.createElement('option');
        optionCircle.value = "";
        optionCircle.textContent = "-Please Select-";
        const optionCluster = document.createElement('option');
        optionCluster.value = "";
        optionCluster.textContent = "-Please Select-";

        blockSelect.appendChild(optionBlock);
        circleSelect.appendChild(optionCircle);
        clusterSelect.appendChild(optionCluster);

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


            fetch(`/api/circles/${selectedDistrictId}`)
                .then(response => response.json())
                .then(data => {
                    data.data.forEach(circle => {
                        // console.log(circle);
                        const option = document.createElement('option');
                        option.value = circle.id;
                        option.textContent = circle.name;
                        circleSelect.appendChild(option);
                    });
                })
                .catch(error => {
                    console.error('Error fetching blocks:', error);
                });

            fetch(`/api/clusters/${selectedDistrictId}`)
                .then(response => response.json())
                .then(data => {
                    data.data.forEach(cluster => {
                        const option = document.createElement('option');
                        option.value = cluster.id;
                        option.textContent = cluster.name;
                        clusterSelect.appendChild(option);
                    });
                })
                .catch(error => {
                    console.error('Error fetching blocks:', error);
                });


            fetch(`/api/subdivisions/${selectedDistrictId}`)
                .then(response => response.json())
                .then(data => {
                    data.data.forEach(subdivision => {
                        const option = document.createElement('option');
                        option.value = subdivision.id;
                        option.textContent = subdivision.name;
                        subdivisionSelect.appendChild(option);
                    });
                })
                .catch(error => {
                    console.error('Error fetching blocks:', error);
                });

        }
    }

    // Custom validation for form submission
    function validateForm() {
        let isValid = true;
        const requiredFields = document.querySelectorAll('[required]');
        
        requiredFields.forEach(field => {
            const value = field.value.trim();
            
            if (field.type === 'select-multiple') {
                // For multiple selects, check if at least one option is selected
                if (field.selectedOptions.length === 0) {
                    isValid = false;
                    field.classList.add('is-invalid');
                } else {
                    field.classList.remove('is-invalid');
                }
            } else if (!value) {
                isValid = false;
                field.classList.add('is-invalid');
            } else {
                field.classList.remove('is-invalid');
            }
        });
        
        if (!isValid) {
            alert('Please fill in all required fields');
        }
        return isValid;
    }

    $(document).ready(function() {
        $('.select2').select2({
            width: '100%' // Tells JS to fill the container we defined in CSS
        });

        // Validate form on submit
        $('form').on('submit', function(e) {
            if (!validateForm()) {
                e.preventDefault();
                return false;
            }
        });
    });
</script>
@endpush