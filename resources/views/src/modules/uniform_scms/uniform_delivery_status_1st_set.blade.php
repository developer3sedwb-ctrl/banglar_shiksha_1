@extends('layouts.app')

@section('title', 'Uniform Delivery Status (1ST SET)')

@section('content')
<div class="container-fluid full-width-content">

 <!-- PAGE HEADING -->
  <div class="page-header mb-3 d-flex justify-content-between align-items-center">
    <h5 class="fw-bold mb-0">Uniform Delivery Status (1ST SET)</h5>
  </div>

 <!-- Student Search panel -->

  
 <!-- Table card -->
 <div class="card card-full mb-4  ">
    <div class="card-header fw-semibold custom-header-data-table">
          School wise Uniform Delivery Status
         <div class="btn-group float-end">
              <button type="button" class="dropdown-toggle btn-export btn btn-success " data-bs-toggle="dropdown" aria-expanded="false"><i class="bx bx-export"></i> Export</button>
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
        <th class="text-center">Sl No.</th>
        <th class="text-center">Dise Code</th>
        <th>School Name</th>
        <th class="text-center">Work Order Completed (YES/NO)</th>

        <!-- Required Uniforms -->
        <th class="text-center">Boys</th>
        <th class="text-center">Girls</th>
        <th class="text-center">Total</th>

        <!-- Delivered Uniforms -->
        <th class="text-center">Boys</th>
        <th class="text-center">Girls</th>
        <th class="text-center">Total</th>

        <th class="text-center">Pending</th>
        <th class="text-center no-export">Action</th>
    </tr>
</thead>

<tbody>
    <tr>
        <td class="text-center">1</td>
        <td class="text-center">1910100704</td>
        <td>ADHATA HIGH SCHOOL (H.S)</td>
        <td class="text-center">YES</td>

        <!-- Required Uniforms -->
        <td class="text-center">219</td>
        <td class="text-center">247</td>
        <td class="text-center">466</td>

        <!-- Delivered Uniforms -->
        <td class="text-center">0</td>
        <td class="text-center">0</td>
        <td class="text-center">0</td>

        <td class="text-center">466</td>

        <td class="text-center">
            <button class="btn btn-success btn-sm">
                <i class="bx bx-calendar"></i> Enter Delivery Schedule
            </button>
        </td>
    </tr>
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




