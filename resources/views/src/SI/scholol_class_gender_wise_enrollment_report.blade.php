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
    <div class="card-header fw-semibold"> View School Class Gender Wise Enrollment</div>
    <div class="card-body">
      <form>
        <div class="row align-items-end">
          <div class="col-md-3">
            <label class="form-label small">Management</label>
            <div class="input-group">
              <span class="input-group-text"><i class="bx bxs-calendar"></i></span>
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

      <div @class(['table-responsive'])>
        <table id="example" @class(['table', 'table-bordered', 'table-striped' ])>
          <thead>
            <tr>
              <th rowspan="2">Sl. No</th>
              <th rowspan="2">School Name</th>
              <th rowspan="2">DISE Code</th>

              <!-- Each class has 4 columns -->
              <th colspan="4">Pre Primary</th>
              <th colspan="4">Class I</th>
              <th colspan="4">Class II</th>
              <th colspan="4">Class III</th>
              <th colspan="4">Class IV</th>
              <th colspan="4">Class V</th>
              <th colspan="4">Class VI</th>
              <th colspan="4">Class VII</th>
              <th colspan="4">Class VIII</th>
              <th colspan="4">Class IX</th>
              <th colspan="4">Class X</th>
              <th colspan="4">Class XI</th>
              <th colspan="4">Class XII</th>
              <th >Total</th>
              <!-- HS Appeared -->
              <th colspan="4">Class XII (HS Appeared)</th>
            </tr>

            <!-- Sub headers for all class columns -->
            <tr>
              <!-- Pre Primary -->
              <th>Boys</th><th>Girls</th><th>Others</th><th>Total</th>

              <!-- Class I -->
              <th>Boys</th><th>Girls</th><th>Others</th><th>Total</th>

              <!-- Class II -->
              <th>Boys</th><th>Girls</th><th>Others</th><th>Total</th>

              <!-- Class III -->
              <th>Boys</th><th>Girls</th><th>Others</th><th>Total</th>

              <!-- Class IV -->
              <th>Boys</th><th>Girls</th><th>Others</th><th>Total</th>

              <!-- Class V -->
              <th>Boys</th><th>Girls</th><th>Others</th><th>Total</th>

              <!-- Class VI -->
              <th>Boys</th><th>Girls</th><th>Others</th><th>Total</th>

              <!-- Class VII -->
              <th>Boys</th><th>Girls</th><th>Others</th><th>Total</th>

              <!-- Class VIII -->
              <th>Boys</th><th>Girls</th><th>Others</th><th>Total</th>

              <!-- Class IX -->
              <th>Boys</th><th>Girls</th><th>Others</th><th>Total</th>

              <!-- Class X -->
              <th>Boys</th><th>Girls</th><th>Others</th><th>Total</th>

              <!-- Class XI -->
              <th>Boys</th><th>Girls</th><th>Others</th><th>Total</th>

              <!-- Class XII -->
              <th>Boys</th><th>Girls</th><th>Others</th><th>Total</th>
              <th>Grand Total</th>

              <!-- HS Appeared -->
              <th>Boys</th><th>Girls</th><th>Others</th><th>Total</th>
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