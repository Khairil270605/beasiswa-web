<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $pageTitle ?? 'Pewawancara' }} - LAZISMU DIY</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
    <style>
        :root {
            /* BRAND LAZISMU */
            --primary-color: #ff6b35;
            --secondary-color: #f7931e;
            --danger-color: #dc3545;
            --success: #198754;
            --warning: #f59e0b;
            --info: #198754;
            --light: #fff5f2;
            --dark: #212529;
            --primary-soft: #fff1ea;
            --success-soft: #eaf7f0;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f1f5f9;
        }

        .gradient-bg {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color), var(--danger-color));
        }

        .sidebar {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            z-index: 1000;
            width: 16rem;
            background: white;
            box-shadow: 0 0 2rem rgba(0,0,0,0.1);
            transform: translateX(-100%);
            transition: transform 0.3s ease;
        }

        .sidebar.show {
            transform: translateX(0);
        }

        @media (min-width: 992px) {
            .sidebar {
                transform: translateX(0);
            }
            
            .main-content {
                margin-left: 16rem;
            }
        }

        .sidebar-header {
            padding: 1.5rem;
            color: white;
        }

        .navbar-brand-icon {
            background: rgba(255,255,255,0.2);
            border-radius: 0.5rem;
            padding: 0.5rem;
            margin-right: 0.75rem;
        }

        .sidebar-nav {
            padding: 1.5rem 1rem;
        }

        .sidebar-nav ul {
            padding-left: 0;
            margin: 0;
            list-style: none;
        }

        .sidebar-nav li {
            list-style: none;
        }

        .sidebar-nav .nav-link {
            color: #6c757d;
            border-radius: 0.5rem;
            margin-bottom: 0.25rem;
            padding: 0.75rem 1rem;
            display: flex;
            align-items: center;
            font-weight: 500;
            transition: all 0.2s ease;
            text-decoration: none;
        }

        .sidebar-nav .nav-link:hover {
            background-color: #fff5f2;
            color: var(--primary-color);
        }

        .sidebar-nav .nav-link.active {
            background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
            color: white;
        }

        .sidebar-nav .nav-link i {
            width: 1.25rem;
            margin-right: 0.75rem;
            text-align: center;
        }

        .nav-header {
            padding: 1rem 1rem 0.5rem;
        }

        .nav-header small {
            color: #6c757d;
            opacity: 0.7;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .sidebar-footer {
            padding: 1rem;
            border-top: 1px solid #e9ecef;
            margin-top: auto;
        }

        .main-content {
            min-height: 100vh;
        }

        .topbar {
            background: white;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }

        .topbar h5 {
            margin: 0;
            color: var(--dark);
            font-weight: 600;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
        }

        .content-wrapper {
            padding: 2rem 1.5rem;
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            margin-bottom: 1.5rem;
        }

        .card-header {
            background: white;
            border-bottom: 1px solid #e2e8f0;
            padding: 1.25rem 1.5rem;
            font-weight: 600;
            border-radius: 10px 10px 0 0 !important;
        }

        .btn-logout {
            background-color: rgba(220, 53, 69, 0.1);
            color: var(--danger-color);
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            font-size: 0.9rem;
            transition: all 0.3s;
        }

        .btn-logout:hover {
            background-color: var(--danger-color);
            color: white;
        }

        .sidebar-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0,0,0,0.5);
            z-index: 999;
            display: none;
        }

        .sidebar-overlay.show {
            display: block;
        }

        .mobile-menu-toggle {
            display: block;
            background: none;
            border: none;
            font-size: 1.5rem;
            color: var(--dark);
        }

        @media (min-width: 992px) {
            .mobile-menu-toggle {
                display: none;
            }
        }

        .badge {
            padding: 0.4rem 0.75rem;
            font-weight: 500;
            font-size: 0.8rem;
        }

        .alert {
            border-radius: 8px;
            border: none;
        }

        .alert-success {
            background-color: var(--success-soft);
            color: var(--success);
        }

        .alert-danger {
            background-color: #fee;
            color: var(--danger-color);
        }
    </style>

    @stack('styles')
</head>
<body>
    <!-- Sidebar Overlay -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- Sidebar -->
    <nav class="sidebar d-flex flex-column" id="sidebar">
        <!-- Logo -->
        <div class="sidebar-header gradient-bg">
            <div class="d-flex align-items-center">
                <div class="navbar-brand-icon">
                    <i class="fas fa-user-tie fs-4"></i>
                </div>
                <div>
                    <h5 class="mb-0 fw-bold">PEWAWANCARA</h5>
                    <small class="opacity-75">LAZISMU DIY</small>
                </div>
            </div>
        </div>

        <!-- Navigation -->
        <div class="sidebar-nav flex-grow-1">
            <ul class="nav flex-column">
                <!-- Dashboard -->
                <li class="nav-item">
                    <a class="nav-link {{ Request::routeIs('pewawancara.dashboard') ? 'active' : '' }}" 
                       href="{{ route('pewawancara.dashboard') }}">
                        <i class="fas fa-tachometer-alt"></i>
                        Dashboard
                    </a>
                </li>
                
                <!-- Section Header -->
                <li class="nav-item mt-3">
                    <div class="nav-header">
                        <small>Penilaian</small>
                    </div>
                </li>
                
                <!-- Penilaian Kader -->
                <li class="nav-item">
                    <a class="nav-link {{ Request::routeIs('pewawancara.kader') ? 'active' : '' }}" 
                       href="{{ route('pewawancara.kader') }}">
                        <i class="fas fa-user-graduate"></i>
                        Penilaian Kader
                    </a>
                </li>
                
                <!-- Penilaian Dhuafa -->
                <li class="nav-item">
                    <a class="nav-link {{ Request::routeIs('pewawancara.dhuafa') ? 'active' : '' }}" 
                       href="{{ route('pewawancara.dhuafa') }}">
                        <i class="fas fa-hands-helping"></i>
                        Penilaian Dhuafa
                    </a>
                </li>
            </ul>
        </div>

        <!-- User Info -->
        <div class="sidebar-footer">
            <div class="d-flex align-items-center">
                <div class="bg-warning bg-opacity-25 rounded-circle p-2 me-3">
                    <i class="fas fa-user-tie text-warning"></i>
                </div>
                <div>
                    <div class="fw-medium">{{ Auth::user()->name }}</div>
                    <div class="text-muted small">Pewawancara</div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Header -->
        <header class="topbar">
            <div class="container-fluid">
                <div class="row align-items-center py-3">
                    <div class="col-auto d-lg-none">
                        <button class="mobile-menu-toggle" id="sidebarToggle">
                            <i class="fas fa-bars"></i>
                        </button>
                    </div>
                    <div class="col">
                        <h5>{{ $pageTitle ?? 'Dashboard' }}</h5>
                    </div>
                    <div class="col-auto">
                        <div class="user-info">
                            <div class="d-none d-md-block text-end">
                                <div style="font-weight: 600; font-size: 0.9rem;">{{ Auth::user()->name }}</div>
                                <div style="font-size: 0.8rem; color: #6c757d;">Pewawancara</div>
                            </div>
                            <div class="user-avatar">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                            <form method="POST" action="{{ route('logout') }}" class="d-inline">
                                @csrf
                                <button type="submit" class="btn-logout">
                                    <i class="fas fa-sign-out-alt"></i> 
                                    <span class="d-none d-md-inline">Keluar</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Flash Messages -->
        <div class="container-fluid mt-3">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    <strong>Terdapat kesalahan:</strong>
                    <ul class="mb-0 mt-2">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
        </div>

        <!-- Content -->
        <div class="content-wrapper">
            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Mobile Sidebar Toggle
            const sidebarToggle = document.getElementById('sidebarToggle');
            const sidebar = document.getElementById('sidebar');
            const sidebarOverlay = document.getElementById('sidebarOverlay');

            function toggleSidebar() {
                sidebar.classList.toggle('show');
                sidebarOverlay.classList.toggle('show');
            }

            if (sidebarToggle) {
                sidebarToggle.addEventListener('click', toggleSidebar);
            }

            if (sidebarOverlay) {
                sidebarOverlay.addEventListener('click', toggleSidebar);
            }

            // Close sidebar on window resize
            window.addEventListener('resize', function () {
                if (window.innerWidth >= 992) {
                    sidebar.classList.remove('show');
                    sidebarOverlay.classList.remove('show');
                }
            });

            // Auto hide alerts after 5 seconds
            setTimeout(function() {
                document.querySelectorAll('.alert:not(.alert-permanent)').forEach(alert => {
                    const bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                });
            }, 5000);
        });
    </script>

    @stack('scripts')
</body>
</html>