<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Admin Panel' }} - LAZISMU DIY</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #ff6b35;
            --secondary-color: #f7931e;
            --danger-color: #dc3545;
        }

        .gradient-bg {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color), var(--danger-color));
        }
        
        .card-hover {
            transition: all 0.3s ease;
            cursor: pointer;
        }
        
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 0.9375rem 2.1875rem rgba(0,0,0,0.1);
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

        .sidebar-nav {
            padding: 1.5rem 1rem;
        }

        /* ===== RESET SEMUA NAV ITEM ===== */
        .sidebar-nav ul {
            padding-left: 0;
            margin: 0;
            list-style: none;
        }

        .sidebar-nav li {
            list-style: none;
        }

        /* ===== STYLE UNTUK NAV-LINK BIASA (TANPA SUBMENU) ===== */
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

        /* ===== STYLE UNTUK MENU DENGAN SUBMENU (HAS-SUB) ===== */
        .menu-item.has-sub > .menu-link {
            display: flex;
            align-items: center;
            justify-content: space-between;
            color: #6c757d;
            padding: 0.75rem 1rem;
            border-radius: 0.5rem;
            cursor: pointer;
            font-weight: 500;
            text-decoration: none;
            margin-bottom: 0.25rem;
            transition: all 0.2s ease;
        }

        .menu-item.has-sub > .menu-link:hover {
            background-color: #fff5f2;
            color: var(--primary-color);
        }

        /* Wrapper untuk icon dan text agar tidak goyang */
        .menu-link-content {
            display: flex;
            align-items: center;
            flex: 1;
        }

        .menu-link-content i {
            width: 1.25rem;
            margin-right: 0.75rem;
            text-align: center;
        }

        /* Icon chevron di kanan */
        .menu-link .fa-chevron-down {
            margin-left: auto;
            transition: transform 0.2s ease;
        }

        .menu-item.open .fa-chevron-down {
            transform: rotate(180deg);
        }

        /* ===== SUBMENU STYLE ===== */
        .menu-item .submenu {
            display: none;
            padding-left: 2.5rem;
            margin-top: 0.25rem;
        }

        .menu-item.open .submenu {
            display: block;
        }

        .submenu li {
            margin-bottom: 0.25rem;
        }

        .submenu li a {
            display: block;
            padding: 0.5rem 1rem;
            font-size: 14px;
            color: #6c757d;
            text-decoration: none;
            border-radius: 0.25rem;
            transition: all 0.2s ease;
        }

        .submenu li a:hover {
            color: var(--primary-color);
            background-color: #fff5f2;
        }

        .submenu li a.active {
            color: var(--primary-color);
            font-weight: 600;
            background-color: #fff5f2;
        }

        .sidebar-header {
            padding: 1.5rem;
            color: white;
        }

        .sidebar-footer {
            padding: 1rem;
            border-top: 1px solid #e9ecef;
            margin-top: auto;
        }

        .navbar-brand-icon {
            background: rgba(255,255,255,0.2);
            border-radius: 0.5rem;
            padding: 0.5rem;
            margin-right: 0.75rem;
        }

        .floating-element {
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-5px); }
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

        .notification-badge {
            position: absolute;
            top: -0.5rem;
            right: -0.5rem;
            background: var(--danger-color);
            color: white;
            font-size: 0.75rem;
            border-radius: 50%;
            height: 1.25rem;
            width: 1.25rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .alert-dismissible {
            position: relative;
        }

        .btn-logout {
            background: var(--danger-color);
            border: none;
            color: white;
        }

        .btn-logout:hover {
            background: #c82333;
            color: white;
        }
    </style>
    
    @yield('styles')
</head>
<body class="bg-light">
    <!-- Sidebar Overlay -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- Sidebar -->
    <nav class="sidebar d-flex flex-column" id="sidebar">
        <!-- Logo -->
        <div class="sidebar-header gradient-bg">
            <div class="d-flex align-items-center">
                <div class="navbar-brand-icon">
                    <i class="fas fa-graduation-cap fs-4"></i>
                </div>
                <div>
                    <h5 class="mb-0 fw-bold">LAZISMU DIY</h5>
                    <small class="opacity-75">Admin Panel</small>
                </div>
            </div>
        </div>

        <!-- Navigation -->
        <div class="sidebar-nav flex-grow-1">
            <ul class="nav flex-column">
                <!-- Dashboard -->
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" 
                       class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="fas fa-tachometer-alt"></i>
                        Dashboard
                    </a>
                </li>

                <!-- Manajemen User -->
                <li class="nav-item">
                    <a href="{{ route('admin.users.index') }}" 
                       class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                        <i class="fas fa-users-cog"></i>
                        Manajemen User
                    </a>
                </li>

                <!-- Kelola Kriteria -->
                <li class="menu-item has-sub {{ request()->routeIs('admin.kriteria.*') ? 'open' : '' }}">
                    <a href="javascript:void(0)" class="menu-link">
                        <div class="menu-link-content">
                            <i class="fas fa-list-alt"></i>
                            <span>Kelola Kriteria</span>
                        </div>
                        <i class="fas fa-chevron-down small"></i>
                    </a>
                    <ul class="submenu">
                        <li>
                            <a href="{{ route('admin.kriteria.dhuafa') }}"
                               class="{{ request()->routeIs('admin.kriteria.dhuafa') ? 'active' : '' }}">
                                Kriteria Dhuafa
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.kriteria.kader') }}"
                               class="{{ request()->routeIs('admin.kriteria.kader') ? 'active' : '' }}">
                                Kriteria Kader
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Kelola Sub Kriteria -->
                <li class="menu-item has-sub {{ request()->routeIs('admin.subkriteria.*') ? 'open' : '' }}">
                    <a href="javascript:void(0)" class="menu-link">
                        <div class="menu-link-content">
                            <i class="fas fa-sitemap"></i>
                            <span>Kelola Sub Kriteria</span>
                        </div>
                        <i class="fas fa-chevron-down small"></i>
                    </a>
                    <ul class="submenu">
                        <li>
                            <a href="{{ route('admin.subkriteria.dhuafa') }}"
                               class="{{ request()->routeIs('admin.subkriteria.dhuafa*') ? 'active' : '' }}">
                                Sub Kriteria Dhuafa
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.subkriteria.kader') }}"
                               class="{{ request()->routeIs('admin.subkriteria.kader*') ? 'active' : '' }}">
                                Sub Kriteria Kader
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Pendaftar Beasiswa -->
                <li class="nav-item">
                    <a href="{{ route('admin.pendaftar.index') }}" 
                       class="nav-link {{ request()->routeIs('admin.pendaftar.*') ? 'active' : '' }}">
                        <i class="fas fa-users"></i>
                        Pendaftar Beasiswa
                    </a>
                </li>

                <!-- Nilai Wawancara -->
                <li class="nav-item">
                    <a href="{{ route('admin.wawancara.index') }}"
                       class="nav-link {{ request()->routeIs('admin.wawancara.*') ? 'active' : '' }}">
                        <i class="fas fa-clipboard-check"></i>
                        Nilai Wawancara
                    </a>
                </li>

                <!-- Penilaian -->
                <li class="menu-item has-sub {{ request()->routeIs('admin.penilaian.*') ? 'open' : '' }}">
                    <a href="javascript:void(0)" class="menu-link">
                        <div class="menu-link-content">
                            <i class="fas fa-star"></i>
                            <span>Penilaian</span>
                        </div>
                        <i class="fas fa-chevron-down small"></i>
                    </a>
                    <ul class="submenu">
                        <li>
                            <a href="{{ route('admin.penilaian.dhuafa') }}"
                               class="{{ request()->routeIs('admin.penilaian.dhuafa') ? 'active' : '' }}">
                                Penilaian Dhuafa
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.penilaian.kader') }}"
                               class="{{ request()->routeIs('admin.penilaian.kader') ? 'active' : '' }}">
                                Penilaian Kader
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Hasil SAW -->
                <li class="menu-item has-sub {{ request()->routeIs('admin.dhuafa') || request()->routeIs('admin.kader') ? 'open' : '' }}">
                    <a href="javascript:void(0)" class="menu-link">
                        <div class="menu-link-content">
                            <i class="fas fa-calculator"></i>
                            <span>Hasil SAW</span>
                        </div>
                        <i class="fas fa-chevron-down small"></i>
                    </a>
                    <ul class="submenu">
                        <li>
                            <a href="{{ route('admin.dhuafa') }}"
                               class="{{ request()->routeIs('admin.hasil.dhuafa') ? 'active' : '' }}">
                                Hasil Dhuafa
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.kader') }}"
                               class="{{ request()->routeIs('admin.hasil.kader') ? 'active' : '' }}">
                                Hasil Kader
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Laporan -->
                <li class="menu-item has-sub {{ request()->routeIs('admin.laporan.*') ? 'open' : '' }}">
                    <a href="javascript:void(0)" class="menu-link">
                        <div class="menu-link-content">
                            <i class="fas fa-file-alt"></i>
                            <span>Laporan</span>
                        </div>
                        <i class="fas fa-chevron-down small"></i>
                    </a>
                    <ul class="submenu">
                        <li>
                            <a href="{{ route('admin.laporan.dhuafa') }}"
                               class="{{ request()->routeIs('admin.laporan.dhuafa') ? 'active' : '' }}">
                                Laporan Dhuafa
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.laporan.kader') }}"
                               class="{{ request()->routeIs('admin.laporan.kader') ? 'active' : '' }}">
                                Laporan Kader
                            </a>
                        </li>
                    </ul>
                </li>
                            <!-- Manajemen Periode -->
                <li class="nav-item">
                    <a href="{{ route('admin.periode.index') }}" 
                    class="nav-link {{ request()->routeIs('admin.periode.*') ? 'active' : '' }}">
                        <i class="fas fa-calendar-alt"></i>
                        Manajemen Periode
                    </a>
                </li>
                                <!-- Banner / Slider -->
                <li class="nav-item">
                    <a href="{{ route('admin.banner.index') }}"
                       class="nav-link {{ request()->routeIs('admin.banner.*') ? 'active' : '' }}">
                        <i class="fas fa-images"></i>
                        Banner / Slider
                    </a>
                </li>
            </ul>
        </div>

        <!-- User Info -->
        <div class="sidebar-footer">
            <div class="d-flex align-items-center">
                <div class="bg-warning bg-opacity-25 rounded-circle p-2 me-3">
                    <i class="fas fa-user-shield text-warning"></i>
                </div>
                <div>
                    <div class="text-muted small">
                        Administrator
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Header -->
        <header class="bg-white shadow-sm border-bottom">
            <div class="container-fluid">
                <div class="row align-items-center py-3">
                    <div class="col-auto d-lg-none">
                        <button class="btn btn-link text-muted" id="sidebarToggle">
                            <i class="fas fa-bars fs-5"></i>
                        </button>
                    </div>
                    <div class="col">
                        <h2 class="mb-0 fw-bold text-dark">{{ $pageTitle ?? 'Admin Panel' }}</h2>
                    </div>
                    <div class="col-auto">
                        <div class="d-flex align-items-center">
                            <!-- User Menu -->
                            <div class="dropdown">
                                <button class="btn btn-link text-muted d-flex align-items-center" 
                                        type="button" id="userMenuDropdown" data-bs-toggle="dropdown">
                                    <i class="fas fa-user-circle fs-4 me-2"></i>
                                    <span class="d-none d-md-inline fw-medium">{{ auth()->user()->name ?? 'Admin' }}</span>
                                    <i class="fas fa-chevron-down ms-2 small"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('admin.profile.index') }}">
                                            <i class="fas fa-user me-2"></i>Account Setting
                                        </a>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <form action="{{ route('logout') }}" method="POST">
                                            @csrf
                                            <button type="submit" class="dropdown-item text-danger">
                                                <i class="fas fa-sign-out-alt me-2"></i>Logout
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
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

            @if(session('warning'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    {{ session('warning') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
        </div>

        <!-- Page Content -->
        <main class="container-fluid py-4">
            @yield('content')
        </main>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
    document.addEventListener('DOMContentLoaded', function () {

        // ===== MOBILE SIDEBAR TOGGLE =====
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

        window.addEventListener('resize', function () {
            if (window.innerWidth >= 992) {
                sidebar.classList.remove('show');
                sidebarOverlay.classList.remove('show');
            }
        });

        // ===== AUTO HIDE ALERT =====
        setTimeout(function () {
            document.querySelectorAll('.alert:not(.alert-permanent)')
                .forEach(alert => {
                    const bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                });
        }, 5000);

        // ===== DROPDOWN SIDEBAR =====
        document.querySelectorAll('.menu-item.has-sub > .menu-link')
            .forEach(menu => {
                menu.addEventListener('click', function (e) {
                    e.preventDefault();
                    this.parentElement.classList.toggle('open');
                });
            });

    });
    </script>
    
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    
    @yield('scripts')
    
</body>
</html>