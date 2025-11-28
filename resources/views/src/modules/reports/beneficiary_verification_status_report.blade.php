@extends('layouts.app')

@section('title', 'Students List')

@section('content')
<div class="container-fluid full-width-content">

 <!-- PAGE HEADING -->
  <div class="page-header mb-3 d-flex justify-content-between align-items-center">
    <h5 class="fw-bold mb-0">STUDENT WISE WISE BENEFICIARY VERIFICATION STATUS REPORT</h5>
  </div>

  

    
  
 <!-- Table card -->
<div class="card card-full mb-4">
    <div class="custom-header-data-table">
        <span class="fw-semibold">Reports</span>
        
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
                <th>Student Name</th>
                <th>Student Code</th>
                <th>Student Account No</th>
                <th>Student IFSC</th>
                <th>Guardian Mobile</th>
                <th>Bank & Contact Update</th>
                <th>NPCI Status</th>
                <th>SI Status</th>
                <th class="text-center no-export">Actions</th>
            </tr>
        </thead>

        <tbody>


            <tr>
                <td class="text-center">1</td>
                <td>ANKUSH BISWAS</td>
                <td>066047190000285</td>
                <td>427918210009782</td>
                <td>BKID0004279</td>
                <td>7469987105</td>
                <td><span class="badge bg-success">Updated</span></td>
                <td><span class="badge bg-success">Name matched & account is valid</span></td>
                <td><span class="badge bg-warning">NA</span></td>

                <td class="text-center">
                    <div class="dropdown">
                        <button class="btn table-dropdown-btn" type="button" data-bs-toggle="dropdown">
                            <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a href="#" class="dropdown-item table-dropdown"><i class="bx bx-edit"></i> Details</a>
                            <a href="#" class="dropdown-item table-dropdown"><i class="bx bx-box"></i> Archive</a>
                            <a href="#" class="dropdown-item text-danger table-dropdown"><i class="bx bxs-trash"></i> Delete</a>
                        </div>
                    </div>
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




