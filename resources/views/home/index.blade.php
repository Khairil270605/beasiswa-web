@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
<style>
/* Banner Slider Styles */
.banner-slider {
    position: relative;
    width: 100%;
    height: 500px;
    overflow: hidden;
    border-radius: 0;
}

.banner-slide {
    position: absolute;
    width: 100%;
    height: 100%;
    opacity: 0;
    transition: opacity 1s ease-in-out;
}

.banner-slide.active {
    opacity: 1;
}

.banner-slide img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.banner-controls {
    position: absolute;
    bottom: 20px;
    left: 50%;
    transform: translateX(-50%);
    display: flex;
    gap: 10px;
    z-index: 10;
}

.banner-dot {
    width: 12px;
    height: 12px;
    border-radius: 50%;
    background: rgba(255,255,255,0.5);
    cursor: pointer;
    transition: all 0.3s ease;
    border: 2px solid white;
}

.banner-dot.active {
    background: white;
    width: 30px;
    border-radius: 6px;
}

.banner-nav-btn {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background: rgba(255,255,255,0.3);
    border: none;
    color: white;
    width: 50px;
    height: 50px;
    border-radius: 50%;
    cursor: pointer;
    transition: all 0.3s ease;
    z-index: 10;
    backdrop-filter: blur(5px);
}

.banner-nav-btn:hover {
    background: rgba(255,255,255,0.5);
}

.banner-nav-btn.prev {
    left: 20px;
}

.banner-nav-btn.next {
    right: 20px;
}

/* Card Hover Effects */
.card-hover {
    transition: all 0.3s ease;
    border: none;
    box-shadow: 0 2px 10px rgba(0,0,0,0.08);
}

.card-hover:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 35px rgba(0,0,0,0.15);
}

.btn-gradient {
    background: linear-gradient(45deg, #ff6b35, #f7931e);
    border: none;
    transition: all 0.3s ease;
    color: white;
    font-weight: 600;
}

.btn-gradient:hover {
    transform: scale(1.05);
    box-shadow: 0 8px 25px rgba(255,107,53,0.3);
    color: white;
}

/* Stats Cards */
.stat-card {
    background: white;
    border-radius: 12px;
    padding: 24px;
    text-align: center;
    box-shadow: 0 2px 10px rgba(0,0,0,0.08);
    transition: all 0.3s ease;
}

.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.12);
}

.stat-number {
    font-size: 2.5rem;
    font-weight: 700;
    background: linear-gradient(45deg, #ff6b35, #f7931e);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    margin-bottom: 8px;
}

.stat-label {
    color: #6c757d;
    font-weight: 500;
}

/* Icon Circles */
.icon-circle {
    width: 70px;
    height: 70px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    border-radius: 50%;
    margin: 0 auto 1.5rem;
    transition: all 0.3s ease;
}

.icon-circle:hover {
    transform: scale(1.1);
}

/* Step Circles */
.step-circle {
    width: 80px;
    height: 80px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    font-weight: bold;
    color: white;
    border-radius: 50%;
    margin: 0 auto 1rem;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(0,0,0,0.2);
}

.step-circle:hover {
    transform: scale(1.1);
}

/* Animations */
.floating-element {
    animation: float 3s ease-in-out infinite;
}

@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-20px); }
}

.pulse-element {
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0%, 100% { opacity: 0.8; }
    50% { opacity: 1; }
}

/* CTA Section */
.cta-section {
    background: linear-gradient(135deg, #ff6b35, #f7931e, #dc3545);
    border-radius: 20px;
    padding: 60px 30px;
    color: white;
    margin: 40px 0;
}

/* Responsive */
@media (max-width: 768px) {
    .banner-slider {
        height: 300px;
    }
    
    .banner-nav-btn {
        width: 40px;
        height: 40px;
    }
    
    .stat-number {
        font-size: 2rem;
    }
}
</style>

<!-- Banner Slider -->
<div class="banner-slider">
    @if(isset($banners) && count($banners) > 0)
        @foreach($banners as $index => $banner)
        <div class="banner-slide {{ $index === 0 ? 'active' : '' }}">
            <img src="{{ asset($banner->image) }}" alt="{{ $banner->title ?? 'Banner ' . ($index + 1) }}">
        </div>
        @endforeach
        
        <!-- Navigation Buttons -->
        <button class="banner-nav-btn prev" onclick="changeBanner(-1)" aria-label="Banner sebelumnya">
            <i class="fas fa-chevron-left"></i>
        </button>
        <button class="banner-nav-btn next" onclick="changeBanner(1)" aria-label="Banner selanjutnya">
            <i class="fas fa-chevron-right"></i>
        </button>
        
        <!-- Dots Navigation -->
        <div class="banner-controls">
            @foreach($banners as $index => $banner)
            <span class="banner-dot {{ $index === 0 ? 'active' : '' }}" onclick="setBanner({{ $index }})"></span>
            @endforeach
        </div>
    @else
        <!-- Default Banner jika belum ada upload -->
        <div class="banner-slide active">
            <img src="{{ asset('images/default-banner.jpg') }}" alt="Banner Default">
        </div>
    @endif
</div>

<div class="container py-5">
    <!-- Stats Section -->
    <section class="py-5">
        <div class="row g-4">
            <div class="col-6 col-md-3">
                <div class="stat-card">
                    <div class="stat-number">1000+</div>
                    <div class="stat-label">Mahasiswa Terdaftar</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-card">
                    <div class="stat-number">95%</div>
                    <div class="stat-label">Tingkat Kepuasan</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-card">
                    <div class="stat-number">500+</div>
                    <div class="stat-label">Beasiswa Tersalurkan</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-card">
                    <div class="stat-number">24/7</div>
                    <div class="stat-label">Layanan Online</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-5">
        <div class="row">
            <div class="col-12 text-center mb-5">
                <h2 class="display-5 fw-bold text-dark mb-3">
                    Mengapa Memilih <span style="background: linear-gradient(45deg, #ff6b35, #f7931e); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">LAZISMU?</span>
                </h2>
                <p class="lead text-muted">
                    Sistem beasiswa modern dengan teknologi terdepan untuk proses seleksi yang adil dan transparan
                </p>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="card border-0 card-hover h-100">
                    <div class="card-body text-center p-4">
                        <div class="icon-circle" style="background: linear-gradient(135deg, #ff6b35, #f7931e);">
                            <i class="fas fa-balance-scale" style="color: white;"></i>
                        </div>
                        <h4 class="card-title fw-bold mb-3" style="color: #ff6b35;">Kriteria Seleksi Objektif</h4>
                        <p class="card-text text-muted">
                            Kami menggunakan kriteria terukur dan adil dalam menilai setiap pendaftar beasiswa dengan standar yang konsisten.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card border-0 card-hover h-100">
                    <div class="card-body text-center p-4">
                        <div class="icon-circle" style="background: linear-gradient(135deg, #17a2b8, #138496);">
                            <i class="fas fa-calculator" style="color: white;"></i>
                        </div>
                        <h4 class="card-title fw-bold mb-3" style="color: #17a2b8;">Metode SAW</h4>
                        <p class="card-text text-muted">
                            Menggunakan metode Simple Additive Weighting (SAW) untuk perhitungan yang objektif dan akurat.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card border-0 card-hover h-100">
                    <div class="card-body text-center p-4">
                        <div class="icon-circle" style="background: linear-gradient(135deg, #28a745, #20c997);">
                            <i class="fas fa-chart-line" style="color: white;"></i>
                        </div>
                        <h4 class="card-title fw-bold mb-3" style="color: #28a745;">Laporan Transparan</h4>
                        <p class="card-text text-muted">
                            Hasil seleksi dapat diakses secara terbuka untuk menjaga transparansi proses seleksi beasiswa.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Process Steps -->
    <section class="py-5">
        <div class="row">
            <div class="col-12 text-center mb-5">
                <h2 class="display-5 fw-bold text-dark mb-3">Langkah Mudah Mendaftar</h2>
                <p class="lead text-muted">Hanya 4 langkah untuk mendapatkan beasiswa impian Anda</p>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-md-3 col-6 text-center">
                <div class="step-circle floating-element" style="background: linear-gradient(135deg, #ff6b35, #f7931e);">1</div>
                <h5 class="fw-bold mb-2">Daftar Akun</h5>
                <p class="text-muted small">Buat akun dengan data diri yang valid</p>
            </div>
            <div class="col-md-3 col-6 text-center">
                <div class="step-circle pulse-element" style="background: linear-gradient(135deg, #17a2b8, #138496);">2</div>
                <h5 class="fw-bold mb-2">Lengkapi Data</h5>
                <p class="text-muted small">Upload dokumen dan isi formulir</p>
            </div>
            <div class="col-md-3 col-6 text-center">
                <div class="step-circle floating-element" style="background: linear-gradient(135deg, #28a745, #20c997);">3</div>
                <h5 class="fw-bold mb-2">Proses Seleksi</h5>
                <p class="text-muted small">Sistem memproses dengan metode SAW</p>
            </div>
            <div class="col-md-3 col-6 text-center">
                <div class="step-circle pulse-element" style="background: linear-gradient(135deg, #ffc107, #fd7e14);">4</div>
                <h5 class="fw-bold mb-2">Hasil Seleksi</h5>
                <p class="text-muted small">Lihat hasil dan status beasiswa</p>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-5">
        <div class="cta-section text-center">
            <h2 class="display-5 fw-bold mb-3">
                Siap Memulai Perjalanan Beasiswa Anda?
            </h2>
            <p class="lead mb-4 opacity-75">
                Bergabunglah dengan ribuan mahasiswa yang telah mempercayai LAZISMU
            </p>
            <div class="d-flex flex-column flex-md-row gap-3 justify-content-center">
    <a href="{{ route('info.dhuafa') }}" class="btn btn-light btn-lg px-5 py-3 rounded-pill fw-bold">
        🤲 Beasiswa Dhuafa
    </a>
    <a href="{{ route('info.kader') }}" class="btn btn-warning btn-lg px-5 py-3 rounded-pill fw-bold">
        ⭐ Beasiswa Kader
    </a>
</div>
        </div>
    </section>
</div>

<script>
// Banner Slider Logic
let currentBanner = 0;
const banners = document.querySelectorAll('.banner-slide');
const dots = document.querySelectorAll('.banner-dot');
let bannerInterval;

function showBanner(index) {
    // Remove active class from all
    banners.forEach(banner => banner.classList.remove('active'));
    dots.forEach(dot => dot.classList.remove('active'));
    
    // Add active class to current
    if (banners[index]) {
        banners[index].classList.add('active');
        dots[index].classList.add('active');
    }
}

function changeBanner(direction) {
    currentBanner += direction;
    
    if (currentBanner >= banners.length) {
        currentBanner = 0;
    } else if (currentBanner < 0) {
        currentBanner = banners.length - 1;
    }
    
    showBanner(currentBanner);
    resetInterval();
}

function setBanner(index) {
    currentBanner = index;
    showBanner(currentBanner);
    resetInterval();
}

function autoChangeBanner() {
    currentBanner++;
    if (currentBanner >= banners.length) {
        currentBanner = 0;
    }
    showBanner(currentBanner);
}

function resetInterval() {
    clearInterval(bannerInterval);
    bannerInterval = setInterval(autoChangeBanner, 5000);
}

// Start auto slide setiap 5 detik
if (banners.length > 1) {
    bannerInterval = setInterval(autoChangeBanner, 5000);
}

// Pause on hover
const bannerSlider = document.querySelector('.banner-slider');
if (bannerSlider) {
    bannerSlider.addEventListener('mouseenter', () => {
        clearInterval(bannerInterval);
    });
    
    bannerSlider.addEventListener('mouseleave', () => {
        resetInterval();
    });
}
</script>

@endsection