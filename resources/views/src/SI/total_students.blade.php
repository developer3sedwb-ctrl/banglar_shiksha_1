@extends('layouts.app')

@section('title', 'Total School')

@section('content')
<div @class(['container-fluid full-width-content' ])> <!-- full-width container -->
  <!-- PAGE HEADING -->
  <div class="page-header mb-3 d-flex justify-content-between align-items-center">
    {{-- <h5 class="fw-bold mb-0">Total School</h5> --}}
  </div>

  <!-- Student Search panel -->
  <div class="card card-full mb-4">
    <div class="card-header fw-semibold"> View School, Management & Category Wise Student</div>
    <div class="card-body">
      <form>
        <div class="row align-items-end">
          <div class="col-md-3">
            <label class="form-label small">Management</label>
            <div class="input-group">
              <span class="input-group-text"><i class="bx bx-building-house"></i></span>
              <select class="form-select">
                <option value="">-- Select Management --</option>
                @if(!empty($data['school_managements']))
                  @foreach($data['school_managements'] as $management)
                    <option value="{{ $management->id }}">{{ $management->name }}</option>
                  @endforeach
                @endif
              </select>
            </div>
          </div>
          <div class="col-md-3">
            <label class="form-label small">Social Category</label>
            <div class="input-group">
              <span class="input-group-text"><i class="bx bxs-group"></i></span>
              <select class="form-select">
                @if(!empty($data['social_categories']))
                  @foreach($data['social_categories'] as $category)
                    <option value="{{ $category['value'] }}">{{ $category['title'] }}</option>
                  @endforeach
                @endif
              </select>
            </div>
          </div>
          <div class="col-md-3">
            <button id="" type="button" class="btn btn-success">Search</button>
            <button id="" type="button" class="btn btn-secondary ms-2">Clear</button>
          </div>
        </div>
      </form>
    </div>
  </div>
  <!-- Table card -->
  <div @class(['card', 'card-full' , 'mb-4' ])>
    <div @class(['card-header', 'fw-semibold' ])>
      <div @class(['btn-group', 'float-end' ])>
        <button type="button" @class(['btn', 'btn-primary' , 'dropdown-toggle' , 'btn-export' ])
          data-bs-toggle="dropdown" aria-expanded="false"><i @class(['bx', 'bx-export' ])></i> Export</button>
        <ul @class(['dropdown-menu', 'dropdown-menu-end' , 'dropdown-export' ])>
          <li><a @class(['dropdown-item', 'text-primary' , 'export-print' ]) href="#"><i @class(['bx', 'bx-printer'
                , 'me-1' ])></i> Print</a></li>
          <li><a @class(['dropdown-item', 'text-info' , 'export-csv' ]) href="#"><i @class(['bx', 'bx-file' , 'me-1'
                ])></i> Csv</a></li>
          <li><a @class(['dropdown-item', 'text-success' , 'export-excel' ]) href="#"><i @class(['bx', 'bxs-file-export'
                , 'me-1' ])></i> Excel</a></li>
          <li><a @class(['dropdown-item', 'text-danger' , 'export-pdf' ]) href="#"><i @class(['bx', 'bxs-file-pdf'
                , 'me-1' ])></i> Pdf</a></li>
        </ul>

      </div>
    </div>

    <div @class(['card-body'])>
      <div class="row align-items-end">
        <div class="col-md-6">
          <a href="{{ route('si.school_class_gender_wise_enrollment_report') }}" class="btn btn-info ms-3 mb-3">School, Class & Gender Wise Enrollment Report</a>
        </div>
      </div>
      <div @class(['table-responsive'])>
        <table id="example" @class(['table', 'table-bordered', 'table-striped' ])>
          <thead>
            <tr>
              <th @class(['text-center'])>SL No.</th>
              <th>School Name</th>
              <th>DISE Code</th>
              <th>Pre Primary</th>
              <th>Class I</th>
              <th>Class II</th>
              <th>Class III</th>
              <th>Class IV</th>
              <th>Class V</th>
              <th>Class VI</th>
              <th>Class VII</th>
              <th>Class VIII</th>
              <th>Class IX</th>
              <th>Class X</th>
              <th>Class XI</th>
              <th>Class xII</th>
              <th>Class X 2024</th>
              <th>Class XI 2024</th>
              <th>Class XII 2024</th>
            </tr>
          </thead>
          <tbody>
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
  $(document).ready(function () {
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
    $(document).on('click', '.export-print', function (e) {
      e.preventDefault();
      table.button('.buttons-print').trigger();
    });

    $(document).on('click', '.export-csv', function (e) {
      e.preventDefault();
      table.button('.buttons-csv').trigger();
    });

    $(document).on('click', '.export-excel', function (e) {
      e.preventDefault();
      table.button('.buttons-excel').trigger();
    });

    $(document).on('click', '.export-pdf', function (e) {
      e.preventDefault();
      table.button('.buttons-pdf').trigger();
    });
  });
</script>
@endpush