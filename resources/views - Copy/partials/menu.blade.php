<!-- resources/views/partials/menu.blade.php -->
<ul class="navbar-nav pt-3">
    <!-- Dashboard -->
    @can('view dashboard')
    <li class="nav-item">
        <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
            <span class="nav-link-icon d-md-none d-lg-inline-block">
                <i class="ti ti-dashboard"></i>
            </span>
            <span class="nav-link-title">Dashboard</span>
        </a>
    </li>
    @endcan

    <!-- Administration -->
    @canany(['view users', 'view roles', 'view permissions'])
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle {{ Request::is('admin/*') ? 'active' : '' }}" href="#navbar-admin" data-bs-toggle="dropdown">
            <span class="nav-link-icon d-md-none d-lg-inline-block">
                <i class="ti ti-users"></i>
            </span>
            <span class="nav-link-title">Administration</span>
        </a>
        <div class="dropdown-menu">
            @can('view users')
            <a class="dropdown-item {{ Request::is('admin/users*') ? 'active' : '' }}" href="{{ route('admin.users.index') }}">
                <i class="ti ti-user me-2"></i>User Management
            </a>
            @endcan

            @can('view roles')
            <a class="dropdown-item {{ Request::is('admin/roles*') ? 'active' : '' }}" href="{{ route('admin.roles.index') }}">
                <i class="ti ti-shield me-2"></i>Role Management
            </a>
            @endcan

            @can('view permissions')
            <a class="dropdown-item {{ Request::is('admin/permissions*') ? 'active' : '' }}" href="{{ route('admin.permissions.index') }}">
                <i class="ti ti-key me-2"></i>Permission Management
            </a>
            @endcan
        </div>
    </li>
    @endcanany

    <!-- School Management -->
    @canany(['view schools', 'create schools', 'edit schools', 'delete schools'])
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle {{ Request::is('schools*') ? 'active' : '' }}" href="#navbar-schools" data-bs-toggle="dropdown">
            <span class="nav-link-icon">
                <i class="ti ti-school"></i>
            </span>
            <span class="nav-link-title">Schools</span>
        </a>
        <div class="dropdown-menu">
            @can('view schools')
            <a class="dropdown-item {{ Request::is('schools') ? 'active' : '' }}" href="#">
                <i class="ti ti-list me-2"></i>All Schools
            </a>
            @endcan
            @can('create schools')
            <a class="dropdown-item {{ Request::is('schools/create') ? 'active' : '' }}" href="#">
                <i class="ti ti-plus me-2"></i>Add School
            </a>
            @endcan
            @canany(['view schools', 'edit schools'])
            <a class="dropdown-item {{ Request::is('schools/*/edit') ? 'active' : '' }}" href="#">
                <i class="ti ti-edit me-2"></i>Manage Schools
            </a>
            @endcanany
        </div>
    </li>
    @endcanany

    <!-- Student Management -->
    @canany(['view students', 'create students', 'edit students', 'delete students'])
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle {{ Request::is('students*') ? 'active' : '' }}" href="#navbar-students" data-bs-toggle="dropdown">
            <span class="nav-link-icon">
                <i class="ti ti-users"></i>
            </span>
            <span class="nav-link-title">Students</span>
        </a>
        <div class="dropdown-menu">
            @can('view students')
            <a class="dropdown-item {{ Request::is('students') ? 'active' : '' }}" href="#">
                <i class="ti ti-list me-2"></i>All Students
            </a>
            @endcan
            @can('create students')
            <a class="dropdown-item {{ Request::is('students/create') ? 'active' : '' }}" href="#">
                <i class="ti ti-plus me-2"></i>Add Student
            </a>
            @endcan
            @canany(['view students', 'edit students'])
            <a class="dropdown-item {{ Request::is('students/*/edit') ? 'active' : '' }}" href="#">
                <i class="ti ti-edit me-2"></i>Manage Students
            </a>
            @endcanany
        </div>
    </li>
    @endcanany

    <!-- Teacher Management -->
    @canany(['view teachers', 'create teachers', 'edit teachers', 'delete teachers'])
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle {{ Request::is('teachers*') ? 'active' : '' }}" href="#navbar-teachers" data-bs-toggle="dropdown">
            <span class="nav-link-icon">
                <i class="ti ti-chalkboard"></i>
            </span>
            <span class="nav-link-title">Teachers</span>
        </a>
        <div class="dropdown-menu">
            @can('view teachers')
            <a class="dropdown-item {{ Request::is('teachers') ? 'active' : '' }}" href="#">
                <i class="ti ti-list me-2"></i>All Teachers
            </a>
            @endcan
            @can('create teachers')
            <a class="dropdown-item {{ Request::is('teachers/create') ? 'active' : '' }}" href="#">
                <i class="ti ti-plus me-2"></i>Add Teacher
            </a>
            @endcan
            @canany(['view teachers', 'edit teachers'])
            <a class="dropdown-item {{ Request::is('teachers/*/edit') ? 'active' : '' }}" href="#">
                <i class="ti ti-edit me-2"></i>Manage Teachers
            </a>
            @endcanany
        </div>
    </li>
    @endcanany

    <!-- Reports -->
    @canany(['view reports', 'generate reports', 'export reports'])
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle {{ Request::is('reports*') ? 'active' : '' }}" href="#navbar-reports" data-bs-toggle="dropdown">
            <span class="nav-link-icon">
                <i class="ti ti-report-analytics"></i>
            </span>
            <span class="nav-link-title">Reports</span>
        </a>
        <div class="dropdown-menu">
            @can('view reports')
            <a class="dropdown-item {{ Request::is('reports') ? 'active' : '' }}" href="#">
                <i class="ti ti-chart-bar me-2"></i>View Reports
            </a>
            @endcan
            @can('generate reports')
            <a class="dropdown-item {{ Request::is('reports/generate') ? 'active' : '' }}" href="#">
                <i class="ti ti-refresh me-2"></i>Generate Reports
            </a>
            @endcan
            @can('export reports')
            <a class="dropdown-item {{ Request::is('reports/export') ? 'active' : '' }}" href="#">
                <i class="ti ti-download me-2"></i>Export Reports
            </a>
            @endcan
        </div>
    </li>
    @endcanany

    <!-- Financial Management -->
    @canany(['view finances', 'create finances', 'edit finances', 'delete finances'])
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle {{ Request::is('finances*') ? 'active' : '' }}" href="#navbar-finances" data-bs-toggle="dropdown">
            <span class="nav-link-icon">
                <i class="ti ti-cash"></i>
            </span>
            <span class="nav-link-title">Finances</span>
        </a>
        <div class="dropdown-menu">
            @can('view finances')
            <a class="dropdown-item {{ Request::is('finances') ? 'active' : '' }}" href="#">
                <i class="ti ti-list me-2"></i>Financial Records
            </a>
            @endcan
            @can('create finances')
            <a class="dropdown-item {{ Request::is('finances/create') ? 'active' : '' }}" href="#">
                <i class="ti ti-plus me-2"></i>Add Record
            </a>
            @endcan
        </div>
    </li>
    @endcanany

    <!-- Planning & Budget -->
    @canany(['view planning', 'create planning', 'edit planning', 'delete planning'])
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle {{ Request::is('planning*') ? 'active' : '' }}" href="#navbar-planning" data-bs-toggle="dropdown">
            <span class="nav-link-icon">
                <i class="ti ti-planning"></i>
            </span>
            <span class="nav-link-title">Planning & Budget</span>
        </a>
        <div class="dropdown-menu">
            @can('view planning')
            <a class="dropdown-item {{ Request::is('planning') ? 'active' : '' }}" href="#">
                <i class="ti ti-file-text me-2"></i>View Plans
            </a>
            @endcan
            @can('create planning')
            <a class="dropdown-item {{ Request::is('planning/create') ? 'active' : '' }}" href="#">
                <i class="ti ti-plus me-2"></i>Create Plan
            </a>
            @endcan
        </div>
    </li>
    @endcanany

    <!-- Monitoring -->
    @canany(['view monitoring', 'create monitoring', 'edit monitoring', 'delete monitoring'])
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle {{ Request::is('monitoring*') ? 'active' : '' }}" href="#navbar-monitoring" data-bs-toggle="dropdown">
            <span class="nav-link-icon">
                <i class="ti ti-eye"></i>
            </span>
            <span class="nav-link-title">Monitoring</span>
        </a>
        <div class="dropdown-menu">
            @can('view monitoring')
            <a class="dropdown-item {{ Request::is('monitoring') ? 'active' : '' }}" href="#">
                <i class="ti ti-chart-line me-2"></i>Monitoring Data
            </a>
            @endcan
            @can('create monitoring')
            <a class="dropdown-item {{ Request::is('monitoring/create') ? 'active' : '' }}" href="#">
                <i class="ti ti-plus me-2"></i>Add Monitoring
            </a>
            @endcan
        </div>
    </li>
    @endcanany

    <!-- Infrastructure -->
    @canany(['view infrastructure', 'create infrastructure', 'edit infrastructure', 'delete infrastructure'])
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle {{ Request::is('infrastructure*') ? 'active' : '' }}" href="#navbar-infrastructure" data-bs-toggle="dropdown">
            <span class="nav-link-icon">
                <i class="ti ti-building-bank"></i>
            </span>
            <span class="nav-link-title">Infrastructure</span>
        </a>
        <div class="dropdown-menu">
            @can('view infrastructure')
            <a class="dropdown-item {{ Request::is('infrastructure') ? 'active' : '' }}" href="#">
                <i class="ti ti-list me-2"></i>Infrastructure List
            </a>
            @endcan
            @can('create infrastructure')
            <a class="dropdown-item {{ Request::is('infrastructure/create') ? 'active' : '' }}" href="#">
                <i class="ti ti-plus me-2"></i>Add Infrastructure
            </a>
            @endcan
        </div>
    </li>
    @endcanany

    <!-- Academic -->
    @canany(['view academic', 'create academic', 'edit academic', 'delete academic'])
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle {{ Request::is('academic*') ? 'active' : '' }}" href="#navbar-academic" data-bs-toggle="dropdown">
            <span class="nav-link-icon">
                <i class="ti ti-book"></i>
            </span>
            <span class="nav-link-title">Academic</span>
        </a>
        <div class="dropdown-menu">
            @can('view academic')
            <a class="dropdown-item {{ Request::is('academic') ? 'active' : '' }}" href="#">
                <i class="ti ti-list me-2"></i>Academic Records
            </a>
            @endcan
            @can('create academic')
            <a class="dropdown-item {{ Request::is('academic/create') ? 'active' : '' }}" href="#">
                <i class="ti ti-plus me-2"></i>Add Academic
            </a>
            @endcan
        </div>
    </li>
    @endcanany

    <!-- Settings -->
    @canany(['view settings', 'edit settings'])
    <li class="nav-item">
        <a class="nav-link {{ Request::is('settings*') ? 'active' : '' }}" href="#">
            <span class="nav-link-icon">
                <i class="ti ti-settings"></i>
            </span>
            <span class="nav-link-title">Settings</span>
        </a>
    </li>
    @endcanany
</ul>
