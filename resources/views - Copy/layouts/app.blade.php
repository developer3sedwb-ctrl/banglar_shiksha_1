<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', config('app.name'))</title>

    <!-- Tabler CSS -->
    <link href="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta17/dist/css/tabler.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">

    <style>
        :root {
            --wb-primary: #1a4480;
            --wb-secondary: #2c5aa0;
            --wb-accent: #3a7bd5;
            --wb-gold: #d4af37;
            --wb-light-blue: #e8f0fe;
            --wb-dark-blue: #0a2e5c;
            --wb-green: #2e7d32;
            --wb-red: #c62828;
            --wb-orange: #ef6c00;
        }

        body {
            background-color: #f8fafc;
        }

        /* Government Header - Compact Style */
        .government-header {
            background: linear-gradient(135deg, var(--wb-primary) 0%, var(--wb-dark-blue) 100%);
            color: white;
            padding: 0.4rem 0;
            border-bottom: 3px solid var(--wb-gold);
            font-family: Arial, sans-serif;
        }

        .gov-logo-container {
            display: flex;
            align-items: center;
        }

        .gov-logo {
            height: 35px;
            margin-right: 10px;
        }

        .gov-main-text {
            font-weight: 700;
            font-size: 1.1rem;
            line-height: 1.2;
        }

        .gov-sub-text {
            font-size: 0.75rem;
            opacity: 0.9;
            line-height: 1.1;
        }

        .system-title {
            font-weight: 700;
            font-size: 1.2rem;
            text-align: center;
            line-height: 1.2;
        }

        .system-subtitle {
            font-size: 0.75rem;
            text-align: center;
            line-height: 1.1;
            opacity: 0.9;
        }

        .initiative-text {
            font-size: 0.75rem;
            text-align: right;
            line-height: 1.1;
            opacity: 0.9;
        }

        /* Premium Sidebar */
        .navbar-vertical.navbar-dark {
            background: linear-gradient(180deg, var(--wb-primary) 0%, var(--wb-dark-blue) 100%) !important;
            border-right: 1px solid rgba(255,255,255,0.1);
        }

        .navbar-brand {
            border-bottom: 1px solid rgba(255,255,255,0.2);
            padding: 1rem 0.75rem;
        }

        .navbar-brand a {
            color: white;
            font-weight: 700;
            font-size: 1.1rem;
        }

        .nav-link {
            color: rgba(255,255,255,0.85);
            font-weight: 500;
            padding: 0.75rem 1rem;
            margin: 0.1rem 0.5rem;
            border-radius: 6px;
            transition: all 0.2s;
        }

        .nav-link:hover {
            color: white;
            background: rgba(255,255,255,0.1);
        }

        .nav-link.active {
            background: var(--wb-accent) !important;
            color: white !important;
            box-shadow: 0 2px 8px rgba(0,0,0,0.2);
        }

        .nav-link .nav-link-icon {
            margin-right: 10px;
            opacity: 0.9;
        }

        /* Premium Header */
        .navbar-light {
            background: white !important;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
            border-bottom: 1px solid #e5e7eb;
        }

        .user-avatar {
            background: var(--wb-primary);
            color: white;
            font-weight: 600;
        }

        /* Page Header Enhancement */
        .page-header {
            background: white;
            border-radius: 8px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            border-left: 4px solid var(--wb-primary);
        }

        .page-title {
            color: var(--wb-primary);
            font-weight: 700;
            margin-bottom: 0.25rem;
        }

        .page-subtitle {
            color: #6b7280;
            font-size: 0.95rem;
        }

        /* Premium Cards */
        .card {
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            transition: all 0.2s;
        }

        .card:hover {
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        }

        .card-header {
            background: var(--wb-light-blue);
            border-bottom: 1px solid #e5e7eb;
            font-weight: 600;
            color: var(--wb-primary);
        }

        /* Government Badges */
        .badge-gov {
            background: var(--wb-primary);
            color: white;
        }

        .badge-gov-green {
            background: var(--wb-green);
            color: white;
        }

        .badge-gov-orange {
            background: var(--wb-orange);
            color: white;
        }

        /* Progress Bars */
        .progress {
            background-color: #e5e7eb;
        }

        .progress-bar {
            background-color: var(--wb-primary);
        }

        /* Buttons */
        .btn-primary {
            background: var(--wb-primary);
            border-color: var(--wb-primary);
        }

        .btn-primary:hover {
            background: var(--wb-secondary);
            border-color: var(--wb-secondary);
        }

        /* Status Indicators */
        .status-completed {
            color: var(--wb-green);
        }

        .status-pending {
            color: var(--wb-orange);
        }

        .status-delayed {
            color: var(--wb-red);
        }

        /* Timeline */
        .timeline-activity .timeline-item {
            padding: 1rem 0;
        }

        .timeline-icon {
            background: var(--wb-primary);
        }

        /* Responsive fixes */
        @media (max-width: 768px) {
            .government-header {
                padding: 0.3rem 0;
            }

            .gov-main-text {
                font-size: 0.9rem;
            }

            .system-title {
                font-size: 0.9rem;
            }

            .initiative-text {
                display: none;
            }

            .gov-sub-text {
                font-size: 0.7rem;
            }

            .system-subtitle {
                font-size: 0.65rem;
            }
        }

        @media (max-width: 576px) {
            .government-header {
                padding: 0.2rem 0;
            }

            .gov-main-text {
                font-size: 0.8rem;
            }

            .system-title {
                font-size: 0.8rem;
            }

            .gov-sub-text {
                display: none;
            }

            .system-subtitle {
                display: none;
            }

            .gov-logo {
                height: 30px;
                margin-right: 5px;
            }
        }


        .impersonation-banner {
            position: sticky;
            top: 0;
            z-index: 9999;
            border-bottom: 2px solid #f59e0b;
            animation: slideDown 0.3s ease-out;
        }

        @keyframes slideDown {
            from {
                transform: translateY(-100%);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .impersonation-banner .btn {
            font-size: 0.75rem;
            padding: 0.25rem 0.75rem;
        }
    </style>
    @stack('css')
</head>
<body>
    @if(Auth::check())

     <!-- Impersonation Banner -->
    @if(Auth::user()->isImpersonated())
    <div class="impersonation-banner bg-warning text-dark py-2">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col">
                    <div class="d-flex align-items-center justify-content-center">
                        <i class="ti ti-user-switch me-2"></i>
                        <strong>You are currently impersonating:</strong>
                        <span class="mx-2">{{ Auth::user()->name }} ({{ Auth::user()->email }})</span>
                        <form method="POST" action="{{ route('admin.users.stop-impersonate') }}" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm ms-2">
                                <i class="ti ti-user-off me-1"></i>Back to Super Admin
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    <!-- Government Header Strip - Compact Style -->
    {{-- <div class="government-header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <!-- Left: Government Info -->
                <div class="col-md-4">
                    <div class="gov-logo-container">
                        <svg class="gov-logo" viewBox="0 0 100 50" fill="white">
                            <path d="M20,10 L80,10 L80,40 L20,40 Z" fill="none" stroke="currentColor" stroke-width="2"/>
                            <circle cx="50" cy="25" r="15" fill="none" stroke="currentColor" stroke-width="2"/>
                            <path d="M35,25 L65,25 M50,15 L50,35" stroke="currentColor" stroke-width="2"/>
                        </svg>
                        <div>
                            <div class="gov-main-text">Government of West Bengal</div>
                            <div class="gov-sub-text">School Education Department</div>
                        </div>
                    </div>
                </div>

                <!-- Center: System Title -->
                <div class="col-md-4">
                    <div class="system-title">School Management System</div>
                    <div class="system-subtitle">Unified Digital Platform for Educational Excellence</div>
                </div>

                <!-- Right: Initiative -->
                <div class="col-md-4">
                    <div class="initiative-text">Digital India Initiative</div>
                </div>
            </div>
        </div>
    </div> --}}

    <div class="page">
        <!-- Sidebar -->
        <aside class="navbar navbar-vertical navbar-expand-lg navbar-dark">
            <div class="container-fluid">
                <div class="d-flex align-items-center justify-content-between w-100 d-lg-none">
                    <h1 class="navbar-brand navbar-brand-autodark mb-0">
                        <a href="{{ route('dashboard') }}">
                            <i class="ti ti-school me-2"></i>
                            {{ config('app.name') }}
                        </a>
                    </h1>

                    <div class="d-flex align-items-center">
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar-menu">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="nav-item dropdown ms-2">
                            <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown">
                                <span class="avatar avatar-sm user-avatar">
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                </span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="{{ route('profile') }}">
                                    <i class="ti ti-user me-2"></i>Profile & Account
                                </a>
                                <a class="dropdown-item" href="{{ route('settings') }}">
                                    <i class="ti ti-settings me-2"></i>Settings
                                </a>
                                <div class="dropdown-divider"></div>
                                <form method="POST" action="{{ route('sso.logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="ti ti-logout me-2"></i>Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="collapse navbar-collapse" id="sidebar-menu">
                    <!-- Brand for desktop -->
                    <h1 class="navbar-brand navbar-brand-autodark d-none d-lg-block">
                        <a href="{{ route('dashboard') }}">
                            <i class="ti ti-school me-2"></i>
                            {{ config('app.name') }}
                        </a>
                    </h1>

                    @include('partials.menu')
                </div>
            </div>
        </aside>

        <!-- Header -->
        <header class="navbar navbar-expand-md navbar-light d-none d-lg-flex">
            <div class="container-fluid">
                <div class="navbar-nav  d-flex justify-content-end order-md-last">
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown">
                            <span class="avatar avatar-sm user-avatar">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </span>
                            <div class="d-none d-xl-block ps-2">
                                <div>{{ Auth::user()->name }}</div>
                                <div class="mt-1 small text-muted">
                                    <i class="ti ti-badge me-1"></i>
                                    {{ Auth::user()->getRoleNames()->first() }}
                                </div>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item" href="{{ route('profile') }}">
                                <i class="ti ti-user me-2"></i>Profile & Account
                            </a>
                            <a class="dropdown-item" href="{{ route('settings') }}">
                                <i class="ti ti-settings me-2"></i>Settings
                            </a>
                            <div class="dropdown-divider"></div>
                            <form method="POST" action="{{ route('sso.logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item">
                                    <i class="ti ti-logout me-2"></i>Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <div class="page-wrapper">
            <div class="container-fluid">
                <div class="page-header d-print-none">
                    <div class="row align-items-center">
                        <div class="col">
                            <h2 class="page-title">@yield('page-title', 'Dashboard')</h2>
                            <div class="text-muted mt-1">@yield('page-subtitle', 'Welcome to your dashboard')</div>
                        </div>
                        <div class="col-auto">
                            @yield('page-actions')
                        </div>
                    </div>
                </div>
            </div>

            <div class="page-body">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="page">
        @yield('content')
    </div>
    @endif

    <!-- Tabler JS -->
    <script src="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta17/dist/js/tabler.min.js"></script>
    @stack('scripts')
</body>
</html>
