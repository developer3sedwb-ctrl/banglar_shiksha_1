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
      <form method="GET" action="{{ route('school.list') }}">
        <div class="row align-items-end">
          <div class="col-md-3">
              <label class="form-label small">District</label>
              <div class="input-group">
                <span class="input-group-text"><i class="bx bxs-calendar"></i></span>
                <select class="form-select" name="districtid">
                    <option value="">-Please Select-</option>
                    @foreach($data['districts'] as $district)
                        <option value="{{ Crypt::encrypt($district->id) }}"
                            {{ $selected_district_id == $district->id ? 'selected' : '' }}>
                            {{ $district->name }}
                        </option>
                    @endforeach
                </select>
              </div>
          </div>

          <div class="col-md-3">
            <label class="form-label small">Management</label>
            <div class="input-group">
              <span class="input-group-text"><i class="bx bxs-calendar"></i></span>
              <select class="form-select" name="managementid">
                  <option value="">-- Select Management --</option>
                  @foreach($data['school_managements'] as $management)
                      <option value="{{ Crypt::encrypt($management->id) }}"
                          {{ $selected_management_id == $management->id ? 'selected' : '' }}>
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
        <span class="fw-semibold">School List ({{ $data['school_list']->total() }} records found)</span>
        <div class="btn-group float-end">
            <button type="button" class="btn btn-success dropdown-toggle btn-export" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bx bx-export"></i> Export
            </button>
            <ul class="dropdown-menu dropdown-menu-end dropdown-export">
                <li><a class="dropdown-item text-primary export-print" href="#"><i class="bx bx-printer me-1"></i> Print</a></li>
                <li><a class="dropdown-item text-info export-csv" href="#"><i class="bx bx-file me-1"></i> CSV</a></li>
                <li><a class="dropdown-item text-success export-excel" href="#"><i class="bx bxs-file-export me-1"></i> Excel</a></li>
                <li><a class="dropdown-item text-danger export-pdf" href="#"><i class="bx bxs-file-pdf me-1"></i> PDF</a></li>
            </ul>
        </div>
    </div>

    <div class="card-body">
        <!-- Search Box -->
        <div class="row mb-3">
            <div class="col-md-4">
                <form method="GET" action="{{ route('school.list') }}" class="d-flex">
                    <input type="hidden" name="districtid" value="{{ $districtid_param }}">
                    <input type="hidden" name="managementid" value="{{ $managementid_param }}">
                    <input type="text"
                           name="search"
                           class="form-control"
                           placeholder="Search by school name, code or district..."
                           value="{{ $search_param }}">
                    <button type="submit" class="btn btn-outline-primary ms-2">
                        <i class="bx bx-search"></i>
                    </button>
                    @if($search_param)
                    <a href="{{ route('school.list', [
                        'districtid' => $districtid_param,
                        'managementid' => $managementid_param
                    ]) }}" class="btn btn-outline-danger ms-2">
                        <i class="bx bx-x"></i>
                    </a>
                    @endif
                </form>
            </div>

            <!-- Records per page selector -->
            <div class="col-md-3 ms-auto">
                <div class="input-group">
                    <span class="input-group-text">Show</span>
                    <select class="form-select" id="perPageSelect">
                        <option value="10" {{ $per_page == 10 ? 'selected' : '' }}>10</option>
                        <option value="20" {{ $per_page == 20 ? 'selected' : '' }}>20</option>
                        <option value="50" {{ $per_page == 50 ? 'selected' : '' }}>50</option>
                        <option value="100" {{ $per_page == 100 ? 'selected' : '' }}>100</option>
                    </select>
                    <span class="input-group-text">entries</span>
                </div>
            </div>
        </div>

        <!-- Show current filter info -->
        @if($selected_district_id || $selected_management_id || $search_param)
        <div class="alert alert-info mb-3">
            <strong>Filters Applied:</strong>
            @if($selected_district_id)
                District: {{ $data['districts']->where('id', $selected_district_id)->first()->name ?? 'N/A' }}
            @endif
            @if($selected_management_id)
                @if($selected_district_id) | @endif
                Management: {{ $data['school_managements']->where('id', $selected_management_id)->first()->name ?? 'N/A' }}
            @endif
            @if($search_param)
                @if($selected_district_id || $selected_management_id) | @endif
                Search: "{{ $search_param }}"
            @endif
            <a href="{{ route('school.list') }}" class="float-end text-danger">Clear All Filters</a>
        </div>
        @endif

        <div class="table-responsive">
            <table id="example" class="table table-striped table-hover">
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
                    @forelse($data['school_list'] as $key => $school)
                    <tr>
                        <td class="text-center">{{ ($data['school_list']->currentPage() - 1) * $data['school_list']->perPage() + $loop->iteration }}</td>
                        <td>{{ $school->school_name ?? 'N/A' }}</td>
                        <td>{{ $school->schcd ?? 'N/A' }}</td>
                        <td>{{ $school->district->name ?? 'N/A' }}</td>
                        <td>{{ $school->block->name ?? 'N/A' }}</td>
                        <td>{{ $school->ward->name ?? 'N/A' }}</td>
                        <td class="text-center">{{ $school->management->name ?? 'N/A' }}</td>
                        <td class="text-center">
                            <div class="dropdown">
                                <button class="btn table-dropdown-btn" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a href="{{ route('school.search', $school->schcd) }}" class="dropdown-item table-dropdown">
                                        <i class="bx bx-edit"></i> Details
                                    </a>
                                    <a href="{{ route('school.details', encrypt($school->id)) }}" class="dropdown-item table-dropdown">
                                        <i class="bx bx-show"></i> View
                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center">No schools found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Bootstrap 5 Pagination -->
        <div class="row mt-3">

            <div class="col-md-12">
                @if($data['school_list']->hasPages())
                    {{ $data['school_list']->onEachSide(1)->links('pagination::bootstrap-5') }}
                @endif
            </div>
        </div>
    </div>
  </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('css/datatables.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/common.css') }}">
<style>
    /* Custom pagination styling */
    .pagination .page-link {
        color: #28a745;
        border-color: #dee2e6;
    }
    .pagination .page-item.active .page-link {
        background-color: #28a745;
        border-color: #28a745;
        color: white;
    }
    .pagination .page-item:hover .page-link {
        background-color: #e9ecef;
        border-color: #dee2e6;
    }
    .table-hover tbody tr:hover {
        background-color: rgba(40, 167, 69, 0.05);
    }
</style>
@endpush

@push('scripts')
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/datatables.min.js') }}"></script>
<script src="{{ asset('js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('js/jszip.min.js') }}"></script>
<script src="{{ asset('js/pdfmake.min.js') }}"></script>
<script src="{{ asset('js/vfs_fonts.js') }}"></script>
<script src="{{ asset('js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('js/buttons.print.min.js') }}"></script>

<script>
$(document).ready(function() {
    // Initialize DataTable without pagination
    let table = $('#example').DataTable({
        ordering: true,
        searching: true,
        paging: false, // Disable DataTables pagination
        info: false, // Disable DataTables info
        lengthChange: false, // Disable length change
        dom: '<"row"<"col-sm-12"f>>' +
             'rt' +
             '<"d-none"B>',
        buttons: [
            {
                extend: 'print',
                title: 'Schools List',
                exportOptions: {
                    columns: ':not(.no-export)'
                },
                customize: function (win) {
                    $(win.document.body).find('h1').css('text-align', 'center');
                }
            },
            {
                extend: 'csv',
                title: 'schools_list',
                exportOptions: {
                    columns: ':not(.no-export)'
                }
            },
            {
                extend: 'excel',
                title: 'schools_list',
                exportOptions: {
                    columns: ':not(.no-export)'
                }
            },
            {
                extend: 'pdf',
                title: 'schools_list',
                exportOptions: {
                    columns: ':not(.no-export)'
                }
            }
        ]
    });

    // Records per page change handler
    $('#perPageSelect').change(function() {
        let perPage = $(this).val();
        let url = new URL(window.location.href);
        url.searchParams.set('per_page', perPage);
        window.location.href = url.toString();
    });

    // Attach export buttons to dropdown menu
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

    // Search within current page (optional client-side search)
    $('#example_filter input').on('keyup', function() {
        table.search(this.value).draw();
    });
});
</script>
@endpush
