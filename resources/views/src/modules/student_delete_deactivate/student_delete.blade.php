@extends('layouts.app')

@section('title', 'Students List')

@section('content')
<div class="container-fluid full-width-content">

 <!-- PAGE HEADING -->
  <div class="page-header mb-3 d-flex justify-content-between align-items-center">
    <h5 class="fw-bold mb-0">Search Student for Deletion</h5>
  </div>

  <!-- STUDENT SEARCH -->
  @include('src.modules.student_delete_deactivate.student_search')

 <!-- Table card -->
<div class="card card-full mb-4">
    <div class="custom-header-data-table">
        <span class="fw-semibold">Deleted Student's List</span>
        
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
                <th>SL No. </th>
                <th>Student Code</th>
                @if(optional($user->roles()->first())->name !== 'HOI Primary')
                <th>School</th>
                @endif
                <th>Name</th>
                <th>DOB</th>
                <th>Guardian Name</th>
                <th>Present Roll No.</th>
                <th>Delete Reason</th>
                @if(optional($user->roles()->first())->name === 'HOI Primary')
                <th>Student Status</th>
                @endif
                @if(optional($user->roles()->first())->name === 'Circle')
                <th>Action</th>
                @endif            
              </tr>
        </thead>

        <tbody>
          @if(!empty($deleted_students) && $deleted_students->count() > 0)
              @foreach($deleted_students as $student)
                  <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $student->student_code }}</td>
                      @if(optional($user->roles()->first())->name !== 'HOI Primary')
                      <td>{{ $student->schoolInfo->school_name ?? 'N/A' }}</td>
                      @endif
                      <td>{{ $student->student_name ?? 'N/A' }}</td>
                      <td>{{ $student->studentInfo->dob ?? 'N/A' }}</td>
                      <td>{{ $student->studentInfo->guardian_name ?? 'N/A' }}</td>
                      <td>{{ $student->studentInfo->cur_roll_number ?? 'N/A' }}</td>
                      <td>{{ $student->deleteReason->name ?? 'N/A' }}</td>
                      @if(optional($user->roles()->first())->name === 'HOI Primary')
                      <td>
                          @switch($student->status)
                              @case(1)
                                  <span class="badge bg-primary">Sent to SI</span>
                                  @break

                              @case(2)
                                  <span class="badge bg-danger">Deleted</span>
                                  @break

                              @case(3)
                                  <span class="badge bg-warning text-dark">Rejected</span>
                                  @break

                              @default
                                  <span class="badge bg-secondary">N/A</span>
                          @endswitch
                      </td>
                      @endif
                      @if(optional($user->roles()->first())->name === 'Circle')
                      @switch($student->status)
                        @case(1)
                          <td>
                            <div class="row g-2">
                                <div class="col-6 text-center">
                                    <button type="button"
                                        class="btn btn-warning btn-sm w-100 btn-reject" data-student-code="{{ $student->student_code }}" data-status="3">
                                        <i class="bx bx-x"></i> Reject
                                    </button>
                                </div>
                                <div class="col-6 text-center">
                                    <button type="button"
                                        class="btn btn-success btn-sm w-100 btn-approve" data-student-code="{{ $student->student_code }}" data-status="2">
                                        <i class="bx bx-check-circle"></i> Approve
                                    </button>
                                </div>
                            </div>
                          </td>
                          @break
                        @case(2)
                        <td>
                          <span class="badge bg-danger">Deleted</span>
                          @break
                        </td>

                      @case(3)
                        <td>
                          <span class="badge bg-warning text-dark">Rejected</span>
                          @break
                        </td>

                      @default
                      <td>
                          <span class="badge bg-secondary">N/A</span>
                      </td>
                      @break
                      @endswitch
                      @endif
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
const USER_ROLE = @json(optional($user->roles()->first())->name);
  let DELETE_REASONS = [];
  loadDeleteReasons();
  /* Fetch reasons only once */
function   loadDeleteReasons() {
    return sendRequest(
        "{{ route('get.reason.for.deletion') }}",
        "GET"
    )
    .then(res => {
        if (res.status && Array.isArray(res.data)) {
            DELETE_REASONS = res.data;   // 
        } else {
            DELETE_REASONS = [];
        }
        return DELETE_REASONS;
    })
    .catch(err => {
        console.error(err);
        DELETE_REASONS = [];
        return [];
    });
}
function buildDeleteReasonOptions() {
    let options = `<option value="">Select Reason</option>`;

    if (DELETE_REASONS.length > 0) {
        DELETE_REASONS.forEach(item => {
            options += `<option value="${item.id}">${item.name}</option>`;
        });
    } else {
        options += `<option value="">No reasons available</option>`;
    }

    return options;
}
  $("#search_purpose").val('2');

  $("#btn_search_student").on("click", function (e) {
      if (!validateRequiredFields("#student_search_form")) {
          return;
      }

      let $btn = $(this);
      $btn.prop('disabled', true).text('Searching...');

      let url = "{{ route('search.student.by.student_code') }}";

      sendRequest(url, "POST", "#student_search_form")
          .then(res => {

              $btn.prop('disabled', false).text('Search');

              if (res.status) {
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
      let actionTd = '';

      if (USER_ROLE === 'Circle') {

          actionTd = `
              <td>
                  <div class="row g-2">
                      <div class="col-6 text-center">
                          <button type="button"
                              class="btn btn-warning btn-sm w-100 btn-reject" data-status="3" data-student-code="${d.student_code}">
                              <i class="bx bx-x"></i> Reject
                          </button>
                      </div>
                      <div class="col-6 text-center">
                          <button type="button"
                              class="btn btn-success btn-sm w-100 btn-approve" data-status="2" data-student-code="${d.student_code}">
                              <i class="bx bx-check-circle"></i> Approve
                          </button>
                      </div>
                  </div>
              </td>
          `;
      }
      else if (USER_ROLE === 'HOI Primary') {

          actionTd = `
                <td>
                    <select class="form-select form-select-sm delete-reason"
                            data-student-code="${d.student_code}">
                        ${buildDeleteReasonOptions()}
                    </select>
                </td>
                <td>
                  <button type="button"
                      class="btn btn-info w-100 btn-send-to-si" data-student-code="${d.student_code}" data-status="1">
                      <i class="bx bx-check-circle"></i> Send to SI
                  </button>
                    
              </td>
          `;

      } else {

          actionTd = `
              <td>
                  <span class="text-muted">No Action</span>
              </td>
          `;
      }

      let row = `
          <tr>
              <td class="student-code" data-student-code="${d.student_code}">
                  ${d.student_code}
              </td>
              <td>${d.studentname ?? '-'}</td>
              <td>${d.dob ?? '-'}</td>
              <td>${d.guardian_name ?? '-'}</td>
              <td>${d.current_class ?? '-'}</td>
              <td>${d.current_section ?? '-'}</td>
              <td>${d.cur_roll_number ?? '-'}</td>
              ${actionTd}
          </tr>
      `;

      $("#student_result_body").html(row); // replace existing rows
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
  $(document).on('click', '.btn-send-to-si', function (e) {
      e.preventDefault();

      let $btn = $(this);
      $btn.prop('disabled', true).text('Deleting...');

      // collect values (example: from hidden inputs)
      let student_code = $(this).data('student-code');
      let status = $(this).data('status');

      let delete_reason_code_fk = $('select.delete-reason').val();

      if (!delete_reason_code_fk) {
          alert('Please select a delete reason');
          $btn.prop('disabled', false).text('Delete');
          return;
      }
      let url = "{{ route('student.delete') }}";

      sendRequest(url, "POST", null,{
          student_code,
          delete_reason_code_fk,
          status,
          _token: "{{ csrf_token() }}"
      })
      .then(res => {
          $btn.prop('disabled', false).text('Delete');

          if (res.status === true) {
              alert(res.message);
              location.reload();

          } else {
              alert(res.message || 'Failed to delete student');
          }
      })
      .catch(err => {
          $btn.prop('disabled', false).text('Delete');
          console.error(err);
          alert('Something went wrong');
      });
  });
  $(document).on('click', '.btn-approve', function (e) {
      e.preventDefault();

      let $btn = $(this);
      $btn.prop('disabled', true).text('Approving...');

      // collect values (example: from hidden inputs)
      let student_code = $(this).data('student-code');
      let status = $(this).data('status');

      let url = "{{ route('student.delete') }}";

      sendRequest(url, "POST", null,{
          student_code,
          status,
          _token: "{{ csrf_token() }}"
      })
      .then(res => {
          $btn.prop('disabled', false).text('Approve');

          if (res.status === true) {
              alert(res.message);
              location.reload();

          } else {
              alert(res.message || 'Failed to approve');
          }
      })
      .catch(err => {
          $btn.prop('disabled', false).text('Approve');
          console.error(err);
          alert('Something went wrong');
      });
  });
    $(document).on('click', '.btn-reject', function (e) {
      e.preventDefault();

      let $btn = $(this);
      $btn.prop('disabled', true).text('Rejecting...');

      // collect values (example: from hidden inputs)
      let student_code = $(this).data('student-code');
      let status = $(this).data('status');

      let url = "{{ route('student.delete') }}";

      sendRequest(url, "POST", null,{
          student_code,
          status,
          _token: "{{ csrf_token() }}"
      })
      .then(res => {
          $btn.prop('disabled', false).text('Reject');

          if (res.status === true) {
              alert(res.message);
              location.reload();

          } else {
              alert(res.message || 'Failed to reject');
          }
      })
      .catch(err => {
          $btn.prop('disabled', false).text('Reject');
          console.error(err);
          alert('Something went wrong');
      });
  });
});
</script>
@endpush




