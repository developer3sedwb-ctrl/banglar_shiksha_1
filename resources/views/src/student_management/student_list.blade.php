@extends('layouts.app')

@section('title', 'School List')

@section('content')
<div class="container-fluid full-width-content">

 <!-- PAGE HEADING -->
  <div class="page-header mb-3 d-flex justify-content-between align-items-center">
    <h5 class="fw-bold mb-0">Search Student For Deactivation</h5>
  </div>

 <!-- Student Search panel -->
 <div class="card card-full mb-4">
    <div class="card-header fw-semibold custom-header-data-table">Student Search</div>
    <form method="POST" action="{{ route('student.deactivelist') }}" novalidate>
      @csrf
      <div class="card-body">
          <div class="row form-row-gap">
              <div class="col-md-6">
                  <div class="mb-2">
                      <label class="form-label small">Search Student DISE Code <span class="text-danger">*</span></label>
                      <div class="input-group">
                          <span class="input-group-text"><i class="bx bx-user"></i></span>
                          <input name="student_code" type="text" class="form-control" placeholder="Student DISE Code" value="{{$student_code}}"  required>
                      </div>
                  </div>
              </div>
              <div class="col-md-6">
                  <div class="mb-2">
                      <div class="form-actions mt-4">
                          <button class="btn btn-secondary me-2" type="submit" value="save_draft">Cancel</button>
                          <button class="btn btn-primary" type="submit" value="next">Search</button>
                      </div>
                  </div>
              </div>
          </div>
      </div>
    </form>
  </div>

  
 <!-- Table card -->
 @if(!empty($data['student_details']))
<div class="card card-full mb-4">
    <div class="custom-header-data-table">
        <span class="fw-semibold">Deactivated Student Details</span>
    </div>
    
    <div class="card-body">
      <div class="table-responsive">
        @if(count($data['student_details']) == 0)
        <h5>Student Not Found</h5>
        @else

      <table id="studentdata" class="table table-striped">
        <thead>
            <tr>
                <th class="text-center">SL No.</th>
                <th>Student Code</th>
                <th>Student Name</th>
                <th>DOB</th>
                <th>Guardian's Name</th>
                <th>Present Class</th>
                <th>Present Section</th>
                <th>Present Roll No</th>
                <th>Student Status</th>
                <th>Reason For Deactivation</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
          
            @foreach($data['student_details'] as $key=>$student)
              <tr>
                <td class="text-center">{{$key+1}}</td>
                <td>{{$student->student_code}}</td>
                <td>{{$student->studentname}}</td>
                <td>{{$student->dob}}</td>
                <td>{{$student->guardian_name}}</td>
                <td>{{$student->cur_class_code_fk}}</td>
                <td>{{$student->cur_section_code_fk}}</td>
                <td>{{$student->cur_roll_number}}</td>
                <td>
                  {{$student->status == 1 ? 'Active' : 'Deactivated'}}
                </td>
                <td>
                  <select>
                      <option value="">- Please Select -</option>
                  </select>
                </td>
                <td>
                  <button class="btn btn-primary" type="submit" value="next">Submit</button>
                </td>
              </tr>
            @endforeach
          
        </tbody>
      </table>
        @endif
      </div>
    </div>
  </div>
</div>
@endif


 <!-- Table card -->



<div class="card card-full mb-4">
    <div class="custom-header-data-table">
        <span class="fw-semibold">Deactivated Student List</span>
    </div>
    
    <div class="card-body">
      <div class="table-responsive">
      <table id="example" class="table table-striped">
        <thead>
            <tr>
                <th class="text-center">SL No.</th>
                <th>Student Code</th>
                <th>Student Name</th>
                <th>DOB</th>
                <th>Guardian's Name</th>
                <th>Present Class</th>
                <th>Present Section</th>
                <th>Present Roll No</th>
                <th>Deactivate Reason</th>
            </tr>
        </thead>
        <tbody>
          @if(!empty($data['student_deactive_list']))
            @foreach($data['student_deactive_list'] as $key=>$student)
              <tr>
                <td class="text-center">{{$key+1}}</td>
                <td>{{$student->student_code}}</td>
                <td>{{$student->studentname}}</td>
                <td>{{$student->dob}}</td>
                <td>{{$student->guardian_name}}</td>
                <td>{{$student->cur_class_code_fk}}</td>
                <td>{{$student->cur_section_code_fk}}</td>
                <td>{{$student->cur_roll_number}}</td>
                <td class="text-center">{{$key+1}}</td>
              </tr>
            @endforeach
          @endif            
        </tbody>
      </table>
      </div>
    </div>
  </div>
</div>
@endsection

@push('styles')


  <!-- Local DataTables CSS -->
  <link rel="stylesheet" href="{{ asset('css/datatables.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/common.css') }}">

@endpush

@push('scripts')
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/datatables.min.js') }}"></script>

<!-- Buttons extension -->
<script src="{{ asset('js/dataTables.buttons.min.js') }}"></script>

<!-- dependencies for HTML5 export (must load BEFORE buttons.html5) -->
<script src="{{ asset('js/jszip.min.js') }}"></script>
<script src="{{ asset('js/pdfmake.min.js') }}"></script>
<script src="{{ asset('js/vfs_fonts.js') }}"></script>

<!-- Buttons HTML5 / Print -->
<script src="{{ asset('js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('js/buttons.print.min.js') }}"></script>

<script>
  $(document).ready(function() {
      $('#studentdata').DataTable({
        paging: false,   // Disable pagination
        searching: false, // (optional) enable/disable search
        info: false      // Disable “showing X of Y entries”
    });
    let table = $('#example').DataTable({
      ordering: true,
      dom: '<"row mb-3"<"col-sm-6"l><"col-sm-6 text-end"f>>' +
           'rt' +
           '<"row mt-3"<"col-sm-6"i><"col-sm-6"p>>' +
           '<"d-none"B>',
      buttons: [
        {
          extend: 'print',
          title: 'Students',
          exportOptions: {
            // exclude the column that has class "no-export" (Actions)
            columns: ':not(.no-export)'
          }
        },
        {
          extend: 'csv',
          title: 'students_list',
          exportOptions: {
            columns: ':not(.no-export)'
          }
        },
        {
          extend: 'excel',
          title: 'students_list',
          exportOptions: {
            columns: ':not(.no-export)'
          }
        },
        {
          extend: 'pdf',
          title: 'students_list',
          exportOptions: {
            columns: ':not(.no-export)'
          }
        }
      ]
    });

    // Attach export buttons to your dropdown menu using Buttons API selectors
    $(document).on('click', '.export-print', function(e) {
      e.preventDefault();
      table.button('.buttons-print').trigger();
    });

    $(document).on('click', '.export-csv', function(e) {
      e.preventDefault();
      table.button('.buttons-csv').trigger();
    });

    $(document).on('click', '.export-excel', function(e) {
      e.preventDefault();
      table.button('.buttons-excel').trigger();
    });

    $(document).on('click', '.export-pdf', function(e) {
      e.preventDefault();
      table.button('.buttons-pdf').trigger();
    });
  });
</script>
@endpush




