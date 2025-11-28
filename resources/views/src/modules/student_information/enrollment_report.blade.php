@extends('layouts.app')

@section('title', 'Students List')

@section('content')
<div class="container-fluid full-width-content">

 <!-- PAGE HEADING -->
  <div class="page-header mb-3 d-flex justify-content-between align-items-center">
    <h5 class="fw-bold mb-0">Enrolment Report of academic session: [CATEGORY WISE]</h5>
  </div>

 <!-- Student Search panel -->
 
  
 <!-- Table card -->


<div class="card card-full mb-4">
  <div class="custom-header-data-table">
    <span class="fw-semibold">ENROLMENT SUMMARY : BOYS</span>

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
      <table id="example" class="table table-striped table-bordered styled-table">

        <thead>
          <tr class="table-top-row">
            <th rowspan="2" class="text-start">CLASS</th>
            <th colspan="6" class="text-center">CATEGORY WISE</th>
            <th colspan="2" class="text-center">OUT OF TOTAL</th>
          </tr>
          <tr class="table-sub-row">
            <th class="text-center">GENERAL</th>
            <th class="text-center">SC</th>
            <th class="text-center">ST</th>
            <th class="text-center">OBC-A</th>
            <th class="text-center">OBC-B</th>
            <th class="text-center">TOTAL</th>
            <th class="text-center">BPL</th>
            <th class="text-center">MINORITY</th>
          </tr>
        </thead>

        <tbody>
          <tr>
            <td class="text-start">CLASS V</td>
            <td class="text-center">22</td>
            <td class="text-center">3</td>
            <td class="text-center">0</td>
            <td class="text-center">8</td>
            <td class="text-center">1</td>
            <td class="text-center">34</td>
            <td class="text-center">0</td>
            <td class="text-center">25</td>
          </tr>
          <tr>
            <td class="text-start">CLASS VI</td>
            <td class="text-center">35</td>
            <td class="text-center">16</td>
            <td class="text-center">0</td>
            <td class="text-center">7</td>
            <td class="text-center">1</td>
            <td class="text-center">59</td>
            <td class="text-center">0</td>
            <td class="text-center">36</td>
          </tr>
          <tr>
            <td class="text-start">CLASS VII</td>
            <td class="text-center">31</td>
            <td class="text-center">25</td>
            <td class="text-center">3</td>
            <td class="text-center">1</td>
            <td class="text-center">2</td>
            <td class="text-center">62</td>
            <td class="text-center">1</td>
            <td class="text-center">25</td>
          </tr>
          <tr>
            <td class="text-start">CLASS VIII</td>
            <td class="text-center">53</td>
            <td class="text-center">19</td>
            <td class="text-center">3</td>
            <td class="text-center">3</td>
            <td class="text-center">0</td>
            <td class="text-center">78</td>
            <td class="text-center">0</td>
            <td class="text-center">41</td>
          </tr>
          <tr>
            <td class="text-start">CLASS IX</td>
            <td class="text-center">83</td>
            <td class="text-center">9</td>
            <td class="text-center">0</td>
            <td class="text-center">8</td>
            <td class="text-center">2</td>
            <td class="text-center">102</td>
            <td class="text-center">0</td>
            <td class="text-center">60</td>
          </tr>
          <tr>
            <td class="text-start">CLASS X</td>
            <td class="text-center">35</td>
            <td class="text-center">17</td>
            <td class="text-center">1</td>
            <td class="text-center">4</td>
            <td class="text-center">4</td>
            <td class="text-center">61</td>
            <td class="text-center">0</td>
            <td class="text-center">20</td>
          </tr>
          <tr>
            <td class="text-start">CLASS XI</td>
            <td class="text-center">39</td>
            <td class="text-center">12</td>
            <td class="text-center">0</td>
            <td class="text-center">5</td>
            <td class="text-center">4</td>
            <td class="text-center">60</td>
            <td class="text-center">0</td>
            <td class="text-center">32</td>
          </tr>
          <tr>
            <td class="text-start">CLASS XII</td>
            <td class="text-center">53</td>
            <td class="text-center">14</td>
            <td class="text-center">3</td>
            <td class="text-center">8</td>
            <td class="text-center">4</td>
            <td class="text-center">82</td>
            <td class="text-center">1</td>
            <td class="text-center">38</td>
          </tr>
        </tbody>

        <tfoot>
          <tr class="table-footer-row">
            <td class="text-start fw-semibold">Total</td>
            <td class="text-center fw-semibold">351</td>
            <td class="text-center fw-semibold">115</td>
            <td class="text-center fw-semibold">10</td>
            <td class="text-center fw-semibold">44</td>
            <td class="text-center fw-semibold">18</td>
            <td class="text-center fw-semibold">538</td>
            <td class="text-center fw-semibold">2</td>
            <td class="text-center fw-semibold">277</td>
          </tr>
        </tfoot>

      </table>
    </div>
  </div>
</div>

<div class="card card-full mb-4">
  <div class="custom-header-data-table">
    <span class="fw-semibold">ENROLMENT SUMMARY : GIRLS</span>

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
      <table id="example2" class="table table-striped table-bordered styled-table">

        <thead>
          <tr class="table-top-row">
            <th rowspan="2" class="text-start">CLASS</th>
            <th colspan="6" class="text-center">CATEGORY WISE</th>
            <th colspan="2" class="text-center">OUT OF TOTAL</th>
          </tr>
          <tr class="table-sub-row">
            <th class="text-center">GENERAL</th>
            <th class="text-center">SC</th>
            <th class="text-center">ST</th>
            <th class="text-center">OBC-A</th>
            <th class="text-center">OBC-B</th>
            <th class="text-center">TOTAL</th>
            <th class="text-center">BPL</th>
            <th class="text-center">MINORITY</th>
          </tr>
        </thead>

        <tbody>
          <tr>
            <td class="text-start">CLASS V</td>
            <td class="text-center">22</td>
            <td class="text-center">3</td>
            <td class="text-center">0</td>
            <td class="text-center">8</td>
            <td class="text-center">1</td>
            <td class="text-center">34</td>
            <td class="text-center">0</td>
            <td class="text-center">25</td>
          </tr>
          <tr>
            <td class="text-start">CLASS VI</td>
            <td class="text-center">35</td>
            <td class="text-center">16</td>
            <td class="text-center">0</td>
            <td class="text-center">7</td>
            <td class="text-center">1</td>
            <td class="text-center">59</td>
            <td class="text-center">0</td>
            <td class="text-center">36</td>
          </tr>
          <tr>
            <td class="text-start">CLASS VII</td>
            <td class="text-center">31</td>
            <td class="text-center">25</td>
            <td class="text-center">3</td>
            <td class="text-center">1</td>
            <td class="text-center">2</td>
            <td class="text-center">62</td>
            <td class="text-center">1</td>
            <td class="text-center">25</td>
          </tr>
          <tr>
            <td class="text-start">CLASS VIII</td>
            <td class="text-center">53</td>
            <td class="text-center">19</td>
            <td class="text-center">3</td>
            <td class="text-center">3</td>
            <td class="text-center">0</td>
            <td class="text-center">78</td>
            <td class="text-center">0</td>
            <td class="text-center">41</td>
          </tr>
          <tr>
            <td class="text-start">CLASS IX</td>
            <td class="text-center">83</td>
            <td class="text-center">9</td>
            <td class="text-center">0</td>
            <td class="text-center">8</td>
            <td class="text-center">2</td>
            <td class="text-center">102</td>
            <td class="text-center">0</td>
            <td class="text-center">60</td>
          </tr>
          <tr>
            <td class="text-start">CLASS X</td>
            <td class="text-center">35</td>
            <td class="text-center">17</td>
            <td class="text-center">1</td>
            <td class="text-center">4</td>
            <td class="text-center">4</td>
            <td class="text-center">61</td>
            <td class="text-center">0</td>
            <td class="text-center">20</td>
          </tr>
          <tr>
            <td class="text-start">CLASS XI</td>
            <td class="text-center">39</td>
            <td class="text-center">12</td>
            <td class="text-center">0</td>
            <td class="text-center">5</td>
            <td class="text-center">4</td>
            <td class="text-center">60</td>
            <td class="text-center">0</td>
            <td class="text-center">32</td>
          </tr>
          <tr>
            <td class="text-start">CLASS XII</td>
            <td class="text-center">53</td>
            <td class="text-center">14</td>
            <td class="text-center">3</td>
            <td class="text-center">8</td>
            <td class="text-center">4</td>
            <td class="text-center">82</td>
            <td class="text-center">1</td>
            <td class="text-center">38</td>
          </tr>
        </tbody>

        <tfoot>
          <tr class="table-footer-row">
            <td class="text-start fw-semibold">Total</td>
            <td class="text-center fw-semibold">351</td>
            <td class="text-center fw-semibold">115</td>
            <td class="text-center fw-semibold">10</td>
            <td class="text-center fw-semibold">44</td>
            <td class="text-center fw-semibold">18</td>
            <td class="text-center fw-semibold">538</td>
            <td class="text-center fw-semibold">2</td>
            <td class="text-center fw-semibold">277</td>
          </tr>
        </tfoot>

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

let table2 = $('#example2').DataTable({
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




