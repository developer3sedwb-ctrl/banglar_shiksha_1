<!-- resources/views/dashboard.blade.php -->
@extends('layouts.app')

@section('title', 'Dashboard - ' . config('app.name'))
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Welcome back, ' . Auth::user()->name)

@section('page-actions')
<div class="btn-list">
    <a href="#" class="btn btn-primary d-none d-sm-inline-block">
        <i class="ti ti-report-analytics me-2"></i>
        Generate Report
    </a>
    <a href="#" class="btn btn-outline-primary">
        <i class="ti ti-plus me-2"></i>
        New Entry
    </a>
</div>
@endsection

@section('content')
<div class="row row-deck row-cards">
    <!-- Welcome Card -->
    <div class="col-12">
        <div class="card card-lg">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <span class="avatar avatar-xl avatar-rounded user-avatar" style="font-size: 1.75rem; font-weight: 600;">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </span>
                    </div>
                    <div class="col">
                        <h2 class="card-title mb-1">Welcome, {{ Auth::user()->name }}!</h2>
                        <div class="text-muted">
                            <span class="badge badge-gov">{{ $role ?? 'User' }}</span> |
                            Last login: {{ Auth::user()->last_login_at ? Auth::user()->last_login_at->format('M j, Y g:i A') : 'First time login' }} |
                            <span class="status-completed"><i class="ti ti-circle-check me-1"></i>Active</span>
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="btn-list">
                            <a href="#" class="btn btn-primary">
                                <i class="ti ti-dashboard me-2"></i>
                                Quick Stats
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Key Performance Indicators -->
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="ti ti-chart-line me-2"></i>
                    Key Performance Indicators
                </h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6 col-lg-3">
                        <div class="card card-sm">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <span class="bg-primary text-white avatar">
                                            <i class="ti ti-school"></i>
                                        </span>
                                    </div>
                                    <div class="col">
                                        <div class="font-weight-medium h2">{{ number_format(1248) }}</div>
                                        <div class="text-muted">Total Schools</div>
                                    </div>
                                </div>
                                <div class="progress progress-sm mt-2">
                                    <div class="progress-bar bg-success" style="width: 75%"></div>
                                </div>
                                <small class="text-success">
                                    <i class="ti ti-chevron-up"></i>
                                    8% increase this quarter
                                </small>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-lg-3">
                        <div class="card card-sm">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <span class="bg-green text-white avatar">
                                            <i class="ti ti-users"></i>
                                        </span>
                                    </div>
                                    <div class="col">
                                        <div class="font-weight-medium h2">{{ number_format(45678) }}</div>
                                        <div class="text-muted">Total Students</div>
                                    </div>
                                </div>
                                <div class="progress progress-sm mt-2">
                                    <div class="progress-bar bg-blue" style="width: 85%"></div>
                                </div>
                                <small class="text-success">
                                    <i class="ti ti-chevron-up"></i>
                                    12% enrollment growth
                                </small>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-lg-3">
                        <div class="card card-sm">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <span class="bg-orange text-white avatar">
                                            <i class="ti ti-checklist"></i>
                                        </span>
                                    </div>
                                    <div class="col">
                                        <div class="font-weight-medium h2">23</div>
                                        <div class="text-muted">Pending Tasks</div>
                                    </div>
                                </div>
                                <div class="progress progress-sm mt-2">
                                    <div class="progress-bar bg-warning" style="width: 60%"></div>
                                </div>
                                <small class="text-danger">
                                    <i class="ti ti-alert-triangle"></i>
                                    5 urgent tasks
                                </small>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-lg-3">
                        <div class="card card-sm">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <span class="bg-blue text-white avatar">
                                            <i class="ti ti-thumb-up"></i>
                                        </span>
                                    </div>
                                    <div class="col">
                                        <div class="font-weight-medium h2">94%</div>
                                        <div class="text-muted">Approval Rate</div>
                                    </div>
                                </div>
                                <div class="progress progress-sm mt-2">
                                    <div class="progress-bar bg-primary" style="width: 94%"></div>
                                </div>
                                <small class="text-success">
                                    <i class="ti ti-trending-up"></i>
                                    2% improvement
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Role-specific Content -->
    @role('State Admin')
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="ti ti-shield me-2"></i>
                    System Administration Overview
                </h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6 col-lg-3">
                        <div class="card card-sm">
                            <div class="card-body text-center">
                                <div class="h1 text-primary">{{ \App\Models\User::count() }}</div>
                                <div class="text-muted">Total Users</div>
                                <small class="text-success">
                                    {{ \App\Models\User::where('status', true)->count() }} active
                                </small>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-lg-3">
                        <div class="card card-sm">
                            <div class="card-body text-center">
                                <div class="h1 text-green">{{ \Spatie\Permission\Models\Role::count() }}</div>
                                <div class="text-muted">System Roles</div>
                                <small>Access levels configured</small>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-lg-3">
                        <div class="card card-sm">
                            <div class="card-body text-center">
                                <div class="h1 text-blue">{{ \Spatie\Permission\Models\Permission::count() }}</div>
                                <div class="text-muted">Permissions</div>
                                <small>System access controls</small>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-lg-3">
                        <div class="card card-sm">
                            <div class="card-body text-center">
                                <div class="h1 text-orange">{{ \App\Models\User::whereDate('last_login_at', today())->count() }}</div>
                                <div class="text-muted">Today's Logins</div>
                                <small>Active sessions</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endrole

    <!-- Recent Activity & Quick Actions -->
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="ti ti-activity me-2"></i>
                    Recent Government Activities
                </h3>
            </div>
            <div class="card-body">
                <div class="timeline timeline-activity">
                    <div class="timeline-item">
                        <div class="timeline-line"></div>
                        <div class="timeline-icon">
                            <span class="bg-red text-white">
                                <i class="ti ti-refresh"></i>
                            </span>
                        </div>
                        <div class="timeline-content">
                            <div class="timeline-header">
                                <span class="text-muted float-end">2 hours ago</span>
                                System Maintenance Completed
                            </div>
                            <div class="timeline-body">
                                Scheduled system update has been successfully completed. All services are running normally.
                            </div>
                        </div>
                    </div>

                    <div class="timeline-item">
                        <div class="timeline-line"></div>
                        <div class="timeline-icon">
                            <span class="bg-green text-white">
                                <i class="ti ti-user-plus"></i>
                            </span>
                        </div>
                        <div class="timeline-content">
                            <div class="timeline-header">
                                <span class="text-muted float-end">5 hours ago</span>
                                New District Coordinator Registered
                            </div>
                            <div class="timeline-body">
                                A new district coordinator has been registered and assigned to the Northern Region.
                            </div>
                        </div>
                    </div>

                    <div class="timeline-item">
                        <div class="timeline-line"></div>
                        <div class="timeline-icon">
                            <span class="bg-blue text-white">
                                <i class="ti ti-file-text"></i>
                            </span>
                        </div>
                        <div class="timeline-content">
                            <div class="timeline-header">
                                <span class="text-muted float-end">1 day ago</span>
                                Monthly Education Report Generated
                            </div>
                            <div class="timeline-body">
                                Education performance report for the previous month has been automatically generated and sent to stakeholders.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="ti ti-rocket me-2"></i>
                    Government Quick Links
                </h3>
            </div>
            <div class="list-group list-group-flush">
                <a href="#" class="list-group-item list-group-item-action d-flex align-items-center">
                    <i class="ti ti-school me-3 text-blue"></i>
                    School Management Portal
                    <i class="ti ti-chevron-right ms-auto text-muted"></i>
                </a>
                <a href="#" class="list-group-item list-group-item-action d-flex align-items-center">
                    <i class="ti ti-report-analytics me-3 text-green"></i>
                    Education Reports
                    <i class="ti ti-chevron-right ms-auto text-muted"></i>
                </a>
                <a href="#" class="list-group-item list-group-item-action d-flex align-items-center">
                    <i class="ti ti-users me-3 text-orange"></i>
                    Staff Directory
                    <i class="ti ti-chevron-right ms-auto text-muted"></i>
                </a>
                <a href="#" class="list-group-item list-group-item-action d-flex align-items-center">
                    <i class="ti ti-building-community me-3 text-purple"></i>
                    Infrastructure Projects
                    <i class="ti ti-chevron-right ms-auto text-muted"></i>
                </a>
                <a href="#" class="list-group-item list-group-item-action d-flex align-items-center">
                    <i class="ti ti-help me-3 text-cyan"></i>
                    Government Support
                    <i class="ti ti-chevron-right ms-auto text-muted"></i>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
