@extends('layouts.app')

@section('title', 'School List')

@section('content')
<div class="container-fluid full-width-content">

 <!-- PAGE HEADING -->
  <div class="page-header mb-3 d-flex justify-content-between align-items-center">
    <h5 class="fw-bold mb-0">School Information List</h5>
  </div>

 <!-- Student Search panel -->
 <div class="card card-full mb-4">
    <div class="card-header fw-semibold custom-header-data-table"> School Search</div>
    <div class="card-body">
      <form method="GET" action="{{ route('school.search.redirect') }}">
        <div class="row align-items-end">
          <div class="col-md-3">
              <label class="form-label small">District</label>
              <div class="input-group">
                <span class="input-group-text"><i class="bx bxs-calendar"></i></span>
                <select class="form-select" name="district_id">
                    <option value="">-Please Select-</option>
                    @foreach($data['districts'] as $district)
                        <option value="{{ $district->id }}"
                            {{ isset($selected_district_id) && $selected_district_id == $district->id ? 'selected' : '' }}>
                            {{ $district->name }}
                        </option>
                    @endforeach
                </select>

              </div>
          </div>

          {{-- <div class="col-md-3">
              <label class="form-label small">Block / Municipality / Corporation</label>
              <div class="input-group">
                <span class="input-group-text"><i class="bx bx-book"></i></span>
                <select class="form-select">
                  <option>-Please Select-</option>
                  <option value="Nursery">Nursery</option>
                  <option value="KG">KG</option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                </select>
              </div>
        </div> --}}

        {{-- <div class="col-md-3">
              <label class="form-label small">GS / WARD </label>
              <div class="input-group">
                <span class="input-group-text"><i class="bx bx-book"></i></span>
                <select class="form-select">
                  <option>-Please Select-</option>
                </select>
              </div>
        </div> --}}
          <div class="col-md-3">
            <label class="form-label small">Management</label>
            <div class="input-group">
              <span class="input-group-text"><i class="bx bxs-calendar"></i></span>
              <select class="form-select" name="management_id">
                  <option value="">-- Select Management --</option>
                  @foreach($data['school_managements'] as $management)
                      <option value="{{ $management->id }}"
                          {{ isset($selected_management_id) && $selected_management_id == $management->id ? 'selected' : '' }}>
                          {{ $management->name }}
                      </option>
                  @endforeach
              </select>

            </div>
          </div>

          <div class="col-md-3">
              <button type="submit" class="btn btn-success">Search School</button>
          </div>


        </div>
      </form>
    </div>
  </div>

 <!-- Table card -->
<div class="card card-full mb-4">
    <div class="custom-header-data-table">
        <span class="fw-semibold">Student List</span>

         <div class="btn-group float-end ">
              <button type="button" class="btn btn-success dropdown-toggle btn-export " data-bs-toggle="dropdown" aria-expanded="false"><i class="bx bx-export"></i> Export</button>
            <ul class="dropdown-menu dropdown-menu-end dropdown-export">
                <li><a class="dropdown-item text-primary export-print" href="#"><i class="bx bx-printer me-1"></i> Print</a></li>
                <li><a class="dropdown-item text-info export-csv" href="#"><i class="bx bx-file me-1"></i> Csv</a></li>
                <li><a class="dropdown-item text-success export-excel" href="#"><i class="bx bxs-file-export me-1"></i> Excel</a></li>
                <li><a class="dropdown-item text-danger export-pdf" href="#"><i class="bx bxs-file-pdf me-1"></i> Pdf</a></li>
            </ul>

         </div>
    </div>

    <div class="card-body">
      <div class="table-responsive">
      <table id="example" class="table table-striped">
        <thead>
            <tr>
                <th class="text-center">SL No.</th>
                <th>School Name</th>
                <th>School Dise Code</th>
                <th>District</th>
                <th>Block / Municipality / Corporation</th>
                <th>GS / WARD</th>
                <th class="text-center">Management</th>
                <th class="text-center no-export">Actions</th>
            </tr>
        </thead>
        <tbody>
          @if(!empty($data['school_list']))
            @foreach($data['school_list'] as $key=>$school)
            <tr>
                <td class="text-center">{{$key+1}}</td>
                <td>{{$school->school_name}}</td>
                <td>{{$school->schcd}}</td>
                <td>{{$school->district->name}}</td>
                <td>{{$school->block->name}}</td>
                <td>{{$school->ward->name}}</td>
                <td>{{$school->management->name}}</td>
                <td class="text-center">
                    <div class="dropdown">
                      <button class="btn table-dropdown-btn" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="bx bx-dots-vertical-rounded"></i>
                      </button>
                      <div class="dropdown-menu dropdown-menu-end">
                        <a href="{{ route('school.search', $school->schcd) }}" class="dropdown-item table-dropdown"><i class="bx bx-edit"></i>  Details</a>
                        <a href="{{ route('school.details', encrypt($school->id)) }}" class="dropdown-item table-dropdown"><i class="bx bx-edit"></i> View</a>
                      </div>
                    </div>
                </td>
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




