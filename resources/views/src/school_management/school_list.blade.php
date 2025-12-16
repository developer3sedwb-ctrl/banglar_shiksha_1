@extends('layouts.app')

@section('title', 'School List')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/datatables.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/common.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
    :root {
        --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        --success-gradient: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
        --info-gradient: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        --card-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        --card-hover-shadow: 0 15px 35px rgba(0, 0, 0, 0.12);
        --transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
    }

    .glass-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        box-shadow: var(--card-shadow);
        border-radius: 20px;
        transition: var(--transition);
    }

    .glass-card:hover {
        box-shadow: var(--card-hover-shadow);
        transform: translateY(-5px);
    }

    .gradient-header {
        background: var(--primary-gradient);
        color: white;
        border-radius: 15px 15px 0 0;
        padding: 20px 25px;
        margin: -1rem -1rem 1.5rem -1rem;
    }

    .stats-card {
        background: white;
        border-radius: 15px;
        padding: 20px;
        margin-bottom: 20px;
        box-shadow: var(--card-shadow);
        border-left: 5px solid #667eea;
        transition: var(--transition);
    }

    .stats-card:hover {
        transform: translateX(5px);
        box-shadow: var(--card-hover-shadow);
    }

    .stats-icon {
        width: 50px;
        height: 50px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        color: white;
        margin-bottom: 15px;
    }

    .stats-icon.schools { background: var(--success-gradient); }
    .stats-icon.districts { background: var(--primary-gradient); }
    .stats-icon.management { background: var(--info-gradient); }

    .stats-number {
        font-size: 28px;
        font-weight: 700;
        color: #2d3748;
        line-height: 1;
        margin-bottom: 5px;
    }

    .stats-label {
        font-size: 14px;
        color: #718096;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .search-container {
        position: relative;
        background: white;
        border-radius: 15px;
        padding: 20px;
        margin-bottom: 25px;
        box-shadow: var(--card-shadow);
    }

    .search-icon {
        position: absolute;
        left: 30px;
        top: 50%;
        transform: translateY(-50%);
        color: #667eea;
        font-size: 20px;
        z-index: 10;
    }

    .search-input {
        padding-left: 50px !important;
        border-radius: 12px !important;
        border: 2px solid #e2e8f0 !important;
        height: 52px;
        font-size: 16px;
        transition: var(--transition);
    }

    .search-input:focus {
        border-color: #667eea !important;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1) !important;
    }

    .filter-badge {
        display: inline-flex;
        align-items: center;
        background: linear-gradient(135deg, #667eea20 0%, #764ba220 100%);
        color: #667eea;
        padding: 8px 15px;
        border-radius: 50px;
        margin: 5px;
        font-size: 14px;
        font-weight: 500;
    }

    .filter-badge i {
        margin-right: 8px;
        font-size: 12px;
    }

    .filter-badge .close-filter {
        margin-left: 10px;
        cursor: pointer;
        opacity: 0.7;
        transition: var(--transition);
    }

    .filter-badge .close-filter:hover {
        opacity: 1;
        transform: scale(1.2);
    }

    .table-container {
        background: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: var(--card-shadow);
    }

    .table-header {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        padding: 20px 25px;
        border-bottom: 1px solid #e2e8f0;
    }

    .table-title {
        font-size: 18px;
        font-weight: 700;
        color: #2d3748;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .table-title i {
        color: #667eea;
    }

    .action-btn {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: white;
        text-decoration: none;
        margin: 0 3px;
        transition: var(--transition);
        border: none;
    }

    .action-btn.view {
        background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
    }

    .action-btn.details {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    .action-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .school-name {
        font-weight: 600;
        color: #2d3748;
        transition: var(--transition);
    }

    .school-name:hover {
        color: #667eea;
    }

    .dise-code {
        background: linear-gradient(135deg, #667eea10 0%, #764ba210 100%);
        padding: 4px 12px;
        border-radius: 20px;
        font-family: monospace;
        font-size: 12px;
        color: #667eea;
        font-weight: 500;
    }

    .pagination-container {
        background: white;
        padding: 20px;
        border-radius: 15px;
        margin-top: 20px;
        box-shadow: var(--card-shadow);
    }

    .pagination .page-link {
        border: none;
        border-radius: 10px !important;
        margin: 0 5px;
        color: #4a5568;
        font-weight: 500;
        min-width: 40px;
        text-align: center;
        transition: var(--transition);
    }

    .pagination .page-item.active .page-link {
        background: var(--primary-gradient);
        color: white;
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
    }

    .pagination .page-link:hover {
        background: #667eea20;
        color: #667eea;
        transform: translateY(-2px);
    }

    .no-data {
        text-align: center;
        padding: 50px 20px;
    }

    .no-data-icon {
        font-size: 60px;
        color: #e2e8f0;
        margin-bottom: 20px;
    }

    .no-data h5 {
        color: #718096;
        font-weight: 500;
    }

    .export-dropdown .dropdown-menu {
        border-radius: 15px;
        border: none;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        padding: 10px;
        min-width: 180px;
    }

    .export-dropdown .dropdown-item {
        padding: 10px 15px;
        border-radius: 10px;
        transition: var(--transition);
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .export-dropdown .dropdown-item:hover {
        background: linear-gradient(135deg, #667eea10 0%, #764ba210 100%);
        transform: translateX(5px);
    }

    .record-count {
        background: linear-gradient(135deg, #667eea10 0%, #764ba210 100%);
        padding: 8px 15px;
        border-radius: 20px;
        font-size: 14px;
        color: #667eea;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .record-count i {
        font-size: 12px;
    }

    .per-page-select {
        border-radius: 12px !important;
        border: 2px solid #e2e8f0 !important;
        height: 42px;
        font-size: 14px;
        transition: var(--transition);
        min-width: 100px;
    }

    .per-page-select:focus {
        border-color: #667eea !important;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1) !important;
    }

    @media (max-width: 768px) {
        .stats-card {
            margin-bottom: 15px;
        }

        .search-input {
            height: 48px;
        }

        .table-responsive {
            border-radius: 15px;
        }
    }
</style>
@endpush

@section('content')
<div class="container-fluid full-width-content py-4">

    <!-- Stats Cards -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="stats-card">
                <div class="stats-icon schools">
                    <i class="fas fa-school"></i>
                </div>
                <div class="stats-number">{{ $data['school_list']->total() }}</div>
                <div class="stats-label">Total Schools</div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stats-card">
                <div class="stats-icon districts">
                    <i class="fas fa-map-marker-alt"></i>
                </div>
                <div class="stats-number">{{ $data['districts']->count() }}</div>
                <div class="stats-label">Districts</div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stats-card">
                <div class="stats-icon management">
                    <i class="fas fa-university"></i>
                </div>
                <div class="stats-number">{{ $data['school_managements']->count() }}</div>
                <div class="stats-label">Management Types</div>
            </div>
        </div>
    </div>

    <!-- Search and Filters Card -->
    <div class="glass-card mb-4">
        <div class="gradient-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-1 fw-bold"><i class="fas fa-search me-2"></i> School Search & Filters</h5>
                    <p class="mb-0 opacity-75">Find schools using advanced filters</p>
                </div>
                <i class="fas fa-filter fa-2x opacity-50"></i>
            </div>
        </div>

        <div class="card-body">
            <form method="GET" action="{{ route('school.list') }}">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label fw-semibold text-muted mb-2">
                            <i class="fas fa-map-marked-alt me-2"></i>District
                        </label>
                        <select class="form-select form-select-lg" name="districtid" style="border-radius: 12px; height: 52px; border: 2px solid #e2e8f0;">
                            <option value="">Select District</option>
                            @foreach($data['districts'] as $district)
                                <option value="{{ Crypt::encrypt($district->id) }}"
                                    {{ $selected_district_id == $district->id ? 'selected' : '' }}>
                                    {{ $district->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-semibold text-muted mb-2">
                            <i class="fas fa-university me-2"></i>Management
                        </label>
                        <select class="form-select form-select-lg" name="managementid" style="border-radius: 12px; height: 52px; border: 2px solid #e2e8f0;">
                            <option value="">Select Management</option>
                            @foreach($data['school_managements'] as $management)
                                <option value="{{ Crypt::encrypt($management->id) }}"
                                    {{ $selected_management_id == $management->id ? 'selected' : '' }}>
                                    {{ $management->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4 d-flex align-items-end">
                        <button type="submit" class="btn btn-lg w-100" style="
                            background: var(--primary-gradient);
                            color: white;
                            border: none;
                            border-radius: 12px;
                            height: 52px;
                            font-weight: 600;
                            transition: var(--transition);
                        ">
                            <i class="fas fa-search me-2"></i> Search Schools
                        </button>
                    </div>
                </div>
            </form>

            <!-- Active Filters -->
            @if($selected_district_id || $selected_management_id || $search_param)
            <div class="mt-4 pt-3 border-top">
                <h6 class="fw-semibold text-muted mb-3"><i class="fas fa-filter me-2"></i>Active Filters</h6>
                <div class="d-flex flex-wrap">
                    @if($selected_district_id)
                    <div class="filter-badge">
                        <i class="fas fa-map-marker-alt"></i>
                        District: {{ $data['districts']->where('id', $selected_district_id)->first()->name ?? 'N/A' }}
                        <a href="{{ route('school.list', array_merge(request()->except('districtid'), ['districtid' => ''])) }}"
                           class="close-filter">
                            <i class="fas fa-times"></i>
                        </a>
                    </div>
                    @endif

                    @if($selected_management_id)
                    <div class="filter-badge">
                        <i class="fas fa-university"></i>
                        Management: {{ $data['school_managements']->where('id', $selected_management_id)->first()->name ?? 'N/A' }}
                        <a href="{{ route('school.list', array_merge(request()->except('managementid'), ['managementid' => ''])) }}"
                           class="close-filter">
                            <i class="fas fa-times"></i>
                        </a>
                    </div>
                    @endif

                    @if($search_param)
                    <div class="filter-badge">
                        <i class="fas fa-search"></i>
                        Search: "{{ $search_param }}"
                        <a href="{{ route('school.list', array_merge(request()->except('search'), ['search' => ''])) }}"
                           class="close-filter">
                            <i class="fas fa-times"></i>
                        </a>
                    </div>
                    @endif

                    @if($selected_district_id || $selected_management_id || $search_param)
                    <div class="filter-badge" style="background: linear-gradient(135deg, #f5656520 0%, #ed893620 100%); color: #f56565;">
                        <a href="{{ route('school.list') }}" class="text-decoration-none" style="color: inherit;">
                            <i class="fas fa-times-circle"></i> Clear All
                        </a>
                    </div>
                    @endif
                </div>
            </div>
            @endif
        </div>
    </div>

    <!-- Search Box -->
    <div class="search-container">
        <form method="GET" action="{{ route('school.list') }}">
            <div class="row g-3">
                <div class="col-md-8">
                    <div class="position-relative">
                        <i class="fas fa-search search-icon"></i>
                        <input type="text"
                               name="search"
                               class="form-control form-control-lg search-input"
                               placeholder="Search by school name, DISE code, district, or management..."
                               value="{{ $search_param }}">
                        <input type="hidden" name="districtid" value="{{ $districtid_param }}">
                        <input type="hidden" name="managementid" value="{{ $managementid_param }}">
                    </div>
                </div>
                <div class="col-md-4 d-flex gap-3">
                    <button type="submit" class="btn btn-lg flex-grow-1" style="
                        background: var(--success-gradient);
                        color: white;
                        border: none;
                        border-radius: 12px;
                        font-weight: 600;
                    ">
                        <i class="fas fa-search me-2"></i> Search
                    </button>

                    <div class="input-group" style="width: 180px;">
                        <span class="input-group-text bg-transparent border-end-0" style="border-radius: 12px 0 0 12px; border: 2px solid #e2e8f0;">
                            <i class="fas fa-list-ol"></i>
                        </span>
                        <select class="form-select per-page-select" id="perPageSelect" style="border-radius: 0 12px 12px 0; border-left: 0;">
                            <option value="10" {{ $per_page == 10 ? 'selected' : '' }}>10 per page</option>
                            <option value="20" {{ $per_page == 20 ? 'selected' : '' }}>20 per page</option>
                            <option value="50" {{ $per_page == 50 ? 'selected' : '' }}>50 per page</option>
                            <option value="100" {{ $per_page == 100 ? 'selected' : '' }}>100 per page</option>
                        </select>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Schools Table Card -->
    <div class="table-container">
        <div class="table-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="table-title">
                        <i class="fas fa-list"></i> School Directory
                        <span class="record-count ms-3">
                            <i class="fas fa-database"></i>
                            {{ $data['school_list']->total() }} Total Schools
                        </span>
                    </h5>
                </div>
                <div class="btn-group export-dropdown">
                    <button type="button" class="btn btn-lg" style="
                        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
                        color: white;
                        border: none;
                        border-radius: 12px;
                        font-weight: 600;
                        padding: 10px 20px;
                    " data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-download me-2"></i> Export
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item export-print" href="#">
                            <i class="fas fa-print text-primary"></i> Print
                        </a></li>
                        <li><a class="dropdown-item export-csv" href="#">
                            <i class="fas fa-file-csv text-info"></i> CSV
                        </a></li>
                        <li><a class="dropdown-item export-excel" href="#">
                            <i class="fas fa-file-excel text-success"></i> Excel
                        </a></li>
                        <li><a class="dropdown-item export-pdf" href="#">
                            <i class="fas fa-file-pdf text-danger"></i> PDF
                        </a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="card-body">
            @if($data['school_list']->count() > 0)
            <div class="table-responsive">
                <table id="example" class="table table-hover align-middle">
                    <thead>
                        <tr style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);">
                            <th class="text-center" style="border-radius: 10px 0 0 10px;">#</th>
                            <th>School Name</th>
                            <th>DISE Code</th>
                            <th>District</th>
                            <th>Block/Municipality</th>
                            <th>GS/Ward</th>
                            <th class="text-center">Management</th>
                            <th class="text-center no-export" style="border-radius: 0 10px 10px 0;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data['school_list'] as $key => $school)
                        <tr style="border-bottom: 1px solid #f1f1f1;">
                            <td class="text-center fw-bold" style="color: #667eea;">
                                {{ ($data['school_list']->currentPage() - 1) * $data['school_list']->perPage() + $loop->iteration }}
                            </td>
                            <td>
                                <div class="school-name">{{ $school->school_name ?? 'N/A' }}</div>
                                @if($school->address)
                                <small class="text-muted d-block mt-1" style="font-size: 12px;">
                                    <i class="fas fa-map-marker-alt me-1"></i> {{ Str::limit($school->address, 40) }}
                                </small>
                                @endif
                            </td>
                            <td>
                                <span class="dise-code">{{ $school->schcd ?? 'N/A' }}</span>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-map-marker-alt text-primary me-2"></i>
                                    <span>{{ $school->district->name ?? 'N/A' }}</span>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-building text-secondary me-2"></i>
                                    <span>{{ $school->block->name ?? 'N/A' }}</span>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-flag text-success me-2"></i>
                                    <span>{{ $school->ward->name ?? 'N/A' }}</span>
                                </div>
                            </td>
                            <td class="text-center">
                                <span class="badge rounded-pill" style="
                                    background: linear-gradient(135deg, #667eea20 0%, #764ba220 100%);
                                    color: #667eea;
                                    padding: 8px 15px;
                                    font-weight: 500;
                                ">
                                    <i class="fas fa-university me-1"></i>
                                    {{ $school->management->name ?? 'N/A' }}
                                </span>
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('school.search', $school->schcd) }}"
                                       class="action-btn details"
                                       title="View Details"
                                       data-bs-toggle="tooltip">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('school.details', encrypt($school->id)) }}"
                                       class="action-btn view"
                                       title="Full Profile"
                                       data-bs-toggle="tooltip">
                                        <i class="fas fa-external-link-alt"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="no-data">
                <div class="no-data-icon">
                    <i class="fas fa-school"></i>
                </div>
                <h5>No schools found</h5>
                <p class="text-muted">Try adjusting your search or filters</p>
                <a href="{{ route('school.list') }}" class="btn mt-3" style="
                    background: var(--primary-gradient);
                    color: white;
                    border: none;
                    border-radius: 12px;
                    padding: 10px 30px;
                    font-weight: 600;
                ">
                    <i class="fas fa-redo me-2"></i> Reset Filters
                </a>
            </div>
            @endif
        </div>
    </div>

    <!-- Pagination -->
    @if($data['school_list']->hasPages())
    <div class="pagination-container">
        <div class="row align-items-center">

            <div class="col-md-12 d-flex justify-content-center">
                <nav aria-label="Page navigation" class="float-md-end">
                    {{ $data['school_list']->onEachSide(1)->links('pagination::bootstrap-5') }}
                </nav>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection

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
    // Initialize DataTable
    let table = $('#example').DataTable({
        ordering: true,
        searching: true,
        paging: false,
        info: false,
        lengthChange: false,
        dom: '<"row"<"col-sm-12"f>>' +
             'rt' +
             '<"d-none"B>',
        language: {
            search: "<i class='fas fa-search'></i>",
            searchPlaceholder: "Search in current page..."
        },
        buttons: [
            {
                extend: 'print',
                title: 'School Directory - Complete List',
                exportOptions: {
                    columns: ':not(.no-export)'
                },
                customize: function (win) {
                    $(win.document.body).find('h1').css('text-align', 'center');
                    $(win.document.body).find('table').addClass('compact').css('font-size', '12px');
                }
            },
            {
                extend: 'csv',
                title: 'school_directory',
                exportOptions: {
                    columns: ':not(.no-export)'
                }
            },
            {
                extend: 'excel',
                title: 'school_directory',
                exportOptions: {
                    columns: ':not(.no-export)'
                }
            },
            {
                extend: 'pdf',
                title: 'school_directory',
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
        url.searchParams.set('page', 1); // Reset to first page
        window.location.href = url.toString();
    });

    // Export buttons
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

    // Initialize tooltips
    $('[data-bs-toggle="tooltip"]').tooltip({
        trigger: 'hover',
        placement: 'top'
    });

    // Smooth scroll to table on search
    $('form[method="GET"]').on('submit', function() {
        if ($(this).find('input[name="search"]').val() ||
            $(this).find('select[name="districtid"]').val() ||
            $(this).find('select[name="managementid"]').val()) {
            $('html, body').animate({
                scrollTop: $('.table-container').offset().top - 100
            }, 500);
        }
    });
});
</script>
@endpush
