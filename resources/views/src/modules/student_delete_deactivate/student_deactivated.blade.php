@extends('layouts.app')

@section('title', 'Students List')

@section('content')
<div class="container-fluid full-width-content">

 <!-- PAGE HEADING -->
  <div class="page-header mb-3 d-flex justify-content-between align-items-center">
    <h5 class="fw-bold mb-0">Search Student for Dectivation</h5>
  </div>

  <!-- STUDENT SEARCH -->
  @include('src.modules.student_delete_deactivate.student_search')

 <!-- Table card -->
<div class="card card-full mb-4">
    <div class="custom-header-data-table">
        <span class="fw-semibold">Deactivated Student's List</span>
        
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
                <th>Student Code</th>
                <th>Name</th>
                <th>DOB</th>
                <th>Guardian Name</th>
                <th>Present Class</th>
                <th>Present Section</th>
                <th>Present Roll No.</th>
                <th>Student Status</th>
                <th>Deactivation Reason</th>
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
<script src="{{ asset('assets/js/common.js') }}"></script>

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
<script>
$(document).ready(function () {
  $("#btn_search_student").on("click", function (e) {
      e.preventDefault();

      if (!validateRequiredFields("#student_search_form")) {
          return;
      }

      let $btn = $(this);
      $btn.prop('disabled', true).text('Searching...');

      let url = "{{ route('search.student.by.student_code') }}";

      sendRequest(url, "POST", "#student_search_form")
          .then(res => {

              $btn.prop('disabled', false).text('Search');

              if (res.status === 'success') {
                  populateStudentRow(res.data);
              } else {
                  showEmptyRow(res.message || 'Student not found');
              }
          })
          .catch(err => {
              $btn.prop('disabled', false).text('Search');
              console.error(err);
              showEmptyRow('Something went wrong');
          });
  });
  function populateStudentRow(d) {
      console.log(d);

      // Build dropdown options
      let reasonOptions = '<option value="">Select Reason</option>';

      if (Array.isArray(d.deactivation_reasons)) {
          d.deactivation_reasons.forEach(r => {
              reasonOptions += `
                  <option value="${r.id}">
                      ${r.name}
                  </option>`;
          });
      }

      let row = `
          <tr>
              <td>${d.student_code ?? '-'}</td>
              <td>${d.studentname ?? '-'}</td>
              <td>${d.dob ?? '-'}</td>
              <td>${d.guardian_name ?? '-'}</td>
              <td>${d.current_class ?? '-'}</td>
              <td>${d.current_section ?? '-'}</td>
              <td>${d.cur_roll_number ?? '-'}</td>

              <td>
                  <select class="form-select form-select-sm deactivation-reason"
                          data-student-code="${d.student_code}">
                      ${reasonOptions}
                  </select>
              </td>

              <td>
                  <button class="btn btn-sm btn-warning deactivate-btn"
                          data-student-code="${d.student_code}" id="btn_deactivate">
                      Deactivate
                  </button>
              </td>
          </tr>
      `;

      $("#student_result_body").html(row); // replace old data
  }
  function showEmptyRow(message) {
      $("#student_result_body").html(`
          <tr>
              <td colspan="10" class="text-center text-danger">
                  ${message}
              </td>
          </tr>
      `);
  }
  $('#btn_deactivate').on('click', function(e) {
      e.preventDefault();
      alert('Deactivate button clicked');
  });
});
</script>
@endpush




