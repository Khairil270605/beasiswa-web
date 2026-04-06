<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title', 'Sistem Penerimaan Beasiswa Lazismu')</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet"/>
  <!-- OpenDyslexic Font for Accessibility -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/opendyslexic/0.91.12/opendyslexic-regular.min.css" rel="stylesheet"/>

  <style>
    body {
      background: #f8f9fa;
      min-height: 100vh;
    }
    
    .fixed-button {
      position: fixed;
      bottom: 20px;
      right: 20px;
      z-index: 9999;
    }

    /* Navbar White Style */
    .navbar-custom {
      background: white;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    .navbar-custom .navbar-brand {
      color: #ff6b35 !important;
    }

    .navbar-custom .nav-link {
      color: #495057 !important;
      font-weight: 500;
      transition: all 0.3s ease;
    }

    .navbar-custom .nav-link:hover {
      color: #ff6b35 !important;
    }

    .navbar-custom .btn-login {
      background: linear-gradient(45deg, #ff6b35, #f7931e);
      color: white;
      font-weight: 600;
      border-radius: 8px;
      padding: 8px 20px;
      border: none;
    }

    .navbar-custom .btn-login:hover {
      background: linear-gradient(45deg, #e55a2b, #e6841a);
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(255, 107, 53, 0.3);
    }

    .navbar-brand img {
      height: 48px;
    }

    /* Profile Dropdown Styles */
    .profile-dropdown {
      position: relative;
    }

    .profile-btn {
      background: linear-gradient(45deg, #ff6b35, #f7931e);
      border: none;
      color: white !important;
      border-radius: 8px;
      padding: 8px 12px;
      transition: all 0.3s ease;
      display: flex;
      align-items: center;
      gap: 8px;
      font-size: 14px;
    }

    .profile-btn:hover {
      background: linear-gradient(45deg, #e55a2b, #e6841a);
      color: white !important;
      transform: translateY(-1px);
      box-shadow: 0 4px 12px rgba(255, 107, 53, 0.3);
    }

    .profile-btn:focus {
      background: linear-gradient(45deg, #e55a2b, #e6841a);
      color: white !important;
      box-shadow: 0 0 0 2px rgba(255, 107, 53, 0.2);
    }

    .profile-icon {
      width: 20px;
      height: 20px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 16px;
      color: white;
    }

    .profile-dropdown .dropdown-menu {
      background: white;
      border: 1px solid rgba(0, 0, 0, 0.08);
      border-radius: 8px;
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
      padding: 4px 0;
      margin-top: 4px;
      min-width: 240px;
    }

    .profile-dropdown .dropdown-item {
      padding: 10px 16px;
      display: flex;
      align-items: center;
      gap: 10px;
      color: #374151;
      transition: all 0.2s ease;
      font-size: 14px;
    }

    .profile-dropdown .dropdown-item:hover {
      background: #f3f4f6;
      color: #1f2937;
    }

    .profile-dropdown .dropdown-item.text-danger:hover {
      background: #fef2f2;
      color: #dc2626;
    }

    .profile-dropdown .dropdown-item i {
      width: 16px;
      height: 16px;
      text-align: center;
      font-size: 14px;
      color: #6b7280;
    }

    .profile-dropdown .dropdown-item:hover i {
      color: inherit;
    }

    .profile-dropdown .dropdown-divider {
      margin: 4px 0;
      border-color: #e5e7eb;
    }

    .profile-dropdown .user-info {
      padding: 12px 16px 8px;
      border-bottom: 1px solid #e5e7eb;
      margin-bottom: 4px;
    }

    .profile-dropdown .user-name {
      font-weight: 600;
      color: #111827;
      margin-bottom: 2px;
      font-size: 14px;
    }

    .profile-dropdown .user-email {
      color: #6b7280;
      font-size: 12px;
      margin-bottom: 6px;
    }

    .profile-dropdown .user-role {
      display: inline-flex;
      align-items: center;
      gap: 4px;
      background: linear-gradient(45deg, #ff6b35, #f7931e);
      color: white;
      padding: 2px 8px;
      border-radius: 12px;
      font-size: 11px;
      font-weight: 500;
    }

    .profile-dropdown .user-role i {
      font-size: 10px;
    }

    /* Footer */
    .footer-lazismu {
      background: linear-gradient(135deg, #ff6b35 0%, #f7931e 50%, #dc3545 100%);
      color: white;
      padding-top: 3rem;
      padding-bottom: 2rem;
      margin-top: 4rem;
    }

    .footer-lazismu h5,
    .footer-lazismu strong {
      color: white;
    }

    .footer-lazismu p,
    .footer-lazismu li,
    .footer-lazismu small {
      color: #f5f5f5;
    }

    .footer-lazismu a {
      color: #ffe4b5;
      text-decoration: none;
    }

    .footer-lazismu a:hover {
      color: white;
      text-decoration: underline;
    }

    .footer-lazismu .box-info {
      background-color: rgba(0,0,0,0.2);
      color: #f5f5f5;
      padding: 1rem;
      border-radius: 0.5rem;
    }

    /* Dropdown hover only for pendaftaran */
    .nav-item.dropdown.hover-dropdown:hover .dropdown-menu {
      display: block;
      margin-top: 0;
    }

    /* Scroll to Top Button */
    .scroll-top-btn {
      position: fixed;
      bottom: 20px;
      left: 20px;
      z-index: 9999;
      display: none;
      width: 45px;
      height: 45px;
      border-radius: 50%;
      background: linear-gradient(45deg, #ffc107, #fd7e14);
      color: white;
      border: none;
      box-shadow: 0 4px 12px rgba(0,0,0,0.2);
      transition: all 0.3s ease;
    }

    .scroll-top-btn:hover {
      transform: translateY(-3px);
      box-shadow: 0 6px 20px rgba(0,0,0,0.3);
    }

    .skip-link {
      position: absolute;
      left: -9999px;
      z-index: 999;
      padding: 1em;
      background-color: #000;
      color: #fff;
      opacity: 0;
    }

    .skip-link:focus {
      left: 50%;
      transform: translateX(-50%);
      opacity: 1;
    }
  </style>

  @stack('styles')
</head>
<body>

<!-- Skip to Content Link -->
<a href="#main-content" class="skip-link">Lewati ke Konten Utama</a>

<!-- Accessibility Toolbar Component -->
@include('component.accessibility-toolbar')

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-custom sticky-top py-3" role="navigation" aria-label="Menu Utama">
  <div class="container">
    <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}" aria-label="Beranda Lazismu">
      <img src="{{ asset('lazismu-diy.jpeg') }}" alt="Logo Lazismu" class="me-2">
      <img src="{{ asset('logo.png') }}" alt="Logo Lazismu" class="me-2">
      <div>
        <!-- <div class="fw-bold" style="color: #ff6b35;">LAZISMU DIY</div>
        <small class="text-muted" style="font-size: 0.75rem;">Lembaga Amil Zakat Infaq Shodaqoh</small>
      </div> -->
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigasi">
      <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto align-items-lg-center">
        <li class="nav-item"><a class="nav-link fw-semibold" href="{{ url('/') }}">Beranda</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ url('/tentang') }}">Tentang</a></li>
        
        <!-- Dropdown Pendaftaran -->
        <li class="nav-item dropdown hover-dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="pendaftaranDropdown"
       role="button" data-bs-toggle="dropdown" aria-expanded="false" aria-haspopup="true">
        Pendaftaran
    </a>

    <ul class="dropdown-menu" aria-labelledby="pendaftaranDropdown">
        <li>
            <a class="dropdown-item" href="{{ route('info.dhuafa') }}">
                Beasiswa Dhuafa
            </a>
        </li>
        <li>
            <a class="dropdown-item" href="{{ route('info.kader') }}">
                Beasiswa Kader Muhammadiyah
            </a>
        </li>
    </ul>
</li>

        <li class="nav-item"><a class="nav-link" href="{{ url('/kontak') }}">Kontak</a></li>
        <li class="nav-item ms-3 d-flex align-items-center">
    <div id="google_translate_element"></div>
</li>

        <!-- Profile atau Login -->
        @auth
          <li class="nav-item dropdown profile-dropdown ms-lg-3">
            <a class="nav-link profile-btn dropdown-toggle" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" aria-haspopup="true" aria-label="Menu Profile {{ Auth::user()->first_name }}">
              <div class="profile-icon">
                <i class="fas fa-user" aria-hidden="true"></i>
              </div>
              <span class="d-none d-lg-inline">{{ Auth::user()->first_name }}</span>
              <i class="fas fa-chevron-down" style="font-size: 10px; margin-left: 4px;" aria-hidden="true"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
              <li class="user-info">
                <div class="user-name">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</div>
                <div class="user-email">{{ Auth::user()->email }}</div>
                <span class="user-role">
                  @if(Auth::user()->role === 'admin')
                    <i class="fas fa-crown" aria-hidden="true"></i> Admin
                  @else
                    <i class="fas fa-user" aria-hidden="true"></i> User
                  @endif
                </span>
              </li>
              
              @if(Auth::user()->role === 'admin')
                <li><a class="dropdown-item" href="{{ url('/admin/dashboard') }}">
                  <i class="fas fa-tachometer-alt" aria-hidden="true"></i> Dashboard Admin
                </a></li>
              @else
                <li><a class="dropdown-item" href="{{ route('home') }}">
                  <i class="fas fa-home" aria-hidden="true"></i> Beranda
                </a></li>
                <li><a class="dropdown-item" href="{{ route('user.beasiswa') }}">
                  <i class="fas fa-graduation-cap" aria-hidden="true"></i> Beasiswa Saya
                </a></li>
              @endif
              
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="{{ url('/profile') }}">
                <i class="fas fa-user-circle" aria-hidden="true"></i> Profile Saya
              </a></li>
              <li><hr class="dropdown-divider"></li>
              <li>
                <form method="POST" action="{{ route('logout') }}" class="d-inline">
                  @csrf
                  <button type="submit" class="dropdown-item text-danger">
                    <i class="fas fa-sign-out-alt" aria-hidden="true"></i> Logout
                  </button>
                </form>
              </li>
            </ul>
          </li>
        @else
          <li class="nav-item">
            <a href="{{ url('/login') }}" class="btn btn-login ms-lg-3">Login</a>
          </li>
        @endauth
      </ul>
    </div>
  </div>
</nav>

<!-- Main Content -->
<main id="main-content" class="container py-5">
  <!-- Flash Message -->
@if(session('success'))
  <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
    <i class="fas fa-check-circle me-2"></i>
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  </div>
@endif

@if(session('error'))
  <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
    <i class="fas fa-times-circle me-2"></i>
    {{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  </div>
@endif

    @yield('content')
</main>


<!-- Footer -->
<footer class="footer-lazismu" role="contentinfo">
  <div class="container">
    <div class="row gy-4">
      <div class="col-md-4">
        <h5>Lazismu Daerah Istimewa Yogyakarta</h5>
        <p>
          LAZISMU adalah lembaga amil zakat nasional dengan SK. Menteri Agama RI No. 90 Tahun 2022 yang berkhidmat dalam pemberdayaan masyarakat.
        </p>
        <p class="mt-3">
          <strong>Kantor:</strong><br>
          Jl. Gedongkuning No.152, Rejowinangun, Kotagede, Yogyakarta
        </p>
      </div>
      <div class="col-md-3">
        <h5>Tentang Kami</h5>
        <ul class="list-unstyled">
          <li><a href="https://lazismudiy.or.id/latar-belakang/">Latar Belakang</a></li>
          <li><a href="https://lazismudiy.or.id/visi-dan-misi/">Visi dan Misi</a></li>
          <li><a href="https://lazismudiy.or.id/susunan-lazismu/">Struktur Pengelola</a></li>
          <li><a href="https://lazismudiy.or.id/kebijakan-strategis/">Kebijakan Strategis</a></li>
          <li><a href="https://lazismudiy.or.id/kebijakan-mutu/">Kebijakan Mutu</a></li>
          <li><a href="https://lazismudiy.or.id/laporan/">Laporan</a></li>
        </ul>
      </div>
      <div class="col-md-2">
        <h5>Sosial Media</h5>
        <ul class="list-unstyled">
          <li><i class="fab fa-instagram me-2"></i>lazismudiy</li>
          <li><i class="fas fa-globe me-2"></i>jalanekabaikan.id</li>
          <li><i class="fab fa-whatsapp me-2"></i>+62 895-3635-20118</li>
          <li><i class="fab fa-facebook me-2"></i>Lazismu DIY</li>
        </ul>
      </div>
      <div class="col-md-3">
        <div class="box-info">
          <p class="small">
            Dana yang didonasikan melalui Lazismu Peduli bukan untuk tujuan pencucian uang (money laundry), termasuk terorisme maupun tindak kejahatan lainnya.
          </p>
        </div>
      </div>
    </div>
    <div class="text-center mt-4 border-top pt-3 border-light">
      <small>© 2025 Lazismu D.I. Yogyakarta</small>
    </div>
  </div>
</footer>

<!-- WhatsApp Button -->
<div class="fixed-button">
  <a href="https://wa.me/6289536352018" target="_blank" class="btn btn-success rounded-circle shadow p-3" aria-label="Hubungi kami via WhatsApp">
    <i class="fab fa-whatsapp fs-4" aria-hidden="true"></i>
  </a>
</div>

<!-- Scroll to Top Button -->
<button onclick="scrollToTop()" id="scrollTopBtn" class="scroll-top-btn" title="Kembali ke atas" aria-label="Kembali ke atas">
  <i class="fas fa-arrow-up" aria-hidden="true"></i>
</button>

<script>
  // Scroll to top functionality
  window.onscroll = function() {
    const btn = document.getElementById("scrollTopBtn");
    if (document.body.scrollTop > 300 || document.documentElement.scrollTop > 300) {
      btn.style.display = "block";
    } else {
      btn.style.display = "none";
    }
  };

  function scrollToTop() {
    window.scrollTo({ top: 0, behavior: 'smooth' });
  }
  setTimeout(() => {
    document.querySelectorAll('.alert').forEach(el => el.remove());
  }, 2000);

</script>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

@stack('scripts')

</body>
</html>