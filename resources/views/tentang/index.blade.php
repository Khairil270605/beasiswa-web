@extends('layouts.app')

@section('title', 'Tentang Kami - LAZISMU DIY')

@section('content')
<style>
.hero-gradient {
    background: linear-gradient(135deg, #ff6b35, #f7931e, #dc3545);
}

.card-hover {
    transition: all 0.3s ease;
}

.card-hover:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
}

.icon-box {
    width: 80px;
    height: 80px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2.5rem;
    border-radius: 20px;
    margin: 0 auto 1.5rem;
}

.timeline-item {
    position: relative;
    padding-left: 3rem;
    margin-bottom: 2rem;
}

.timeline-item::before {
    content: '';
    position: absolute;
    left: 1rem;
    top: 0;
    width: 2px;
    height: 100%;
    background: linear-gradient(to bottom, #ff6b35, #f7931e);
}

.timeline-dot {
    position: absolute;
    left: 0.5rem;
    top: 0.5rem;
    width: 1rem;
    height: 1rem;
    background: #ff6b35;
    border-radius: 50%;
    border: 3px solid white;
    box-shadow: 0 0 10px rgba(255,107,53,0.3);
}

.feature-number {
    background: linear-gradient(45deg, #ff6b35, #f7931e);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    font-size: 4rem;
    font-weight: 800;
}

.floating-element {
    animation: float 3s ease-in-out infinite;
}

@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-10px); }
}

.stats-box {
    background: white;
    border-radius: 15px;
    padding: 2rem;
    text-align: center;
    box-shadow: 0 5px 15px rgba(0,0,0,0.08);
}

.stats-number {
    font-size: 3rem;
    font-weight: 800;
    background: linear-gradient(45deg, #ff6b35, #f7931e);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.mission-card {
    background: white;
    border-radius: 15px;
    padding: 1.5rem;
    height: 100%;
    border-left: 4px solid #ff6b35;
    box-shadow: 0 3px 10px rgba(0,0,0,0.05);
}
.lazismu-text {
    color: #ff7a00; /* Oranye Lazismu */
}

</style>

<!-- Hero Section -->
<section class="hero-gradient text-white py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8 mx-auto text-center">
                <h1 class="display-4 fw-bold mb-4">
                    Tentang <span class="text-warning">LAZISMU DIY</span>
                </h1>
                <p class="lead mb-4">
                    Lembaga Amil Zakat Infaq Shodaqoh Muhammadiyah DIY yang berkomitmen memberikan bantuan beasiswa untuk masa depan yang lebih cerah
                </p>
                <div class="floating-element">
                <div class="bg-white bg-opacity-75 rounded-pill px-4 py-2 d-inline-block lazismu-text">
                    <i class="fas fa-graduation-cap me-2"></i>
                    <span class="fw-semibold">Beasiswa Sang Surya</span>
                </div>
            </div>
            </div>
        </div>
    </div>
</section>

<!-- Tentang LAZISMU -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <div class="text-center mb-5">
                    <h2 class="display-6 fw-bold text-dark mb-3">
                        Mengenal <span class="text-warning">LAZISMU</span>
                    </h2>
                    <p class="lead text-muted">
                        Lembaga Amil Zakat Nasional yang dipercaya sejak 2002
                    </p>
                </div>

                <div class="card border-0 shadow-lg card-hover mb-4">
                    <div class="card-body p-5">
                        <div class="row align-items-center mb-4">
                            <div class="col-md-2 text-center">
                                <div class="icon-box bg-warning bg-opacity-10">
                                    🏛️
                                </div>
                            </div>
                            <div class="col-md-10">
                                <h3 class="fw-bold text-dark mb-3">Profil LAZISMU</h3>
                                <p class="text-muted mb-3">
                                    <strong>LAZISMU</strong> adalah lembaga amil zakat nasional yang berkhidmat dalam pemberdayaan masyarakat melalui pendayagunaan secara produktif dana zakat, infak, wakaf dan dana kedermawanan lainnya baik dari perusahaan, instansi, lembaga, perorangan dan lainnya.
                                </p>
                                <p class="text-muted mb-0">
                                    Didirikan oleh <strong>PP. Muhammadiyah pada tahun 2002</strong>, selanjutnya dikukuhkan oleh Menteri Agama Republik Indonesia sebagai Lembaga Amil Zakat Nasional melalui <strong>SK No. 457/21 November 2002</strong>. Saat ini telah dikukuhkan kembali melalui <strong>SK Menteri Agama RI Nomor 730 tahun 2016</strong>.
                                </p>
                            </div>
                        </div>

                        <!-- Stats -->
                        <div class="row g-3 mt-3">
                            <div class="col-md-4">
                                <div class="stats-box">
                                    <div class="stats-number">764</div>
                                    <p class="text-muted mb-0 fw-semibold">Kantor Se-Indonesia</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="stats-box">
                                    <div class="stats-number">2002</div>
                                    <p class="text-muted mb-0 fw-semibold">Tahun Berdiri</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="stats-box">
                                    <div class="stats-number">100%</div>
                                    <p class="text-muted mb-0 fw-semibold">Amanah & Transparan</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Visi Misi -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <div class="row g-4">
                    <!-- Visi -->
                    <div class="col-md-12">
                        <div class="card border-0 shadow-sm card-hover">
                            <div class="card-body p-5 text-center">
                                <div class="icon-box bg-warning bg-opacity-10 mx-auto">
                                    🎯
                                </div>
                                <h3 class="fw-bold text-warning mb-3">VISI</h3>
                                <p class="lead text-dark mb-0">
                                    "Menjadi lembaga amil zakat <strong>terpercaya</strong>"
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Misi -->
                    <div class="col-md-12">
                        <div class="card border-0 shadow-sm card-hover">
                            <div class="card-body p-5">
                                <div class="text-center mb-4">
                                    <div class="icon-box bg-primary bg-opacity-10 mx-auto">
                                        🚀
                                    </div>
                                    <h3 class="fw-bold text-primary mb-3">MISI</h3>
                                </div>
                                
                                <div class="row g-3">
                                    <div class="col-md-4">
                                        <div class="mission-card">
                                            <div class="d-flex align-items-start">
                                                <span class="badge bg-primary rounded-circle me-3" style="width: 30px; height: 30px; display: flex; align-items: center; justify-content: center;">1</span>
                                                <p class="mb-0 text-muted">
                                                    <strong>Optimalisasi pengelolaan ZIS</strong> yang amanah, profesional dan transparan
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mission-card">
                                            <div class="d-flex align-items-start">
                                                <span class="badge bg-primary rounded-circle me-3" style="width: 30px; height: 30px; display: flex; align-items: center; justify-content: center;">2</span>
                                                <p class="mb-0 text-muted">
                                                    <strong>Optimalisasi pendayagunaan ZIS</strong> yang kreatif, inovatif dan produktif
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mission-card">
                                            <div class="d-flex align-items-start">
                                                <span class="badge bg-primary rounded-circle me-3" style="width: 30px; height: 30px; display: flex; align-items: center; justify-content: center;">3</span>
                                                <p class="mb-0 text-muted">
                                                    <strong>Optimalisasi pelayanan donatur</strong>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Tentang Beasiswa Sang Surya -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <div class="text-center mb-5">
                    <h2 class="display-6 fw-bold text-dark mb-3">
                        Program <span class="text-warning">Beasiswa Sang Surya</span>
                    </h2>
                    <p class="lead text-muted">
                        Wujud nyata kepedulian LAZISMU DIY untuk pendidikan Indonesia
                    </p>
                </div>

                <!-- Latar Belakang -->
                <div class="card border-0 shadow-lg card-hover mb-4">
                    <div class="card-body p-5">
                        <h3 class="fw-bold text-dark mb-4">
                            <i class="fas fa-book-open text-warning me-2"></i>
                            Latar Belakang
                        </h3>
                        <p class="text-muted mb-3">
                            Pemerataan pendidikan masih menjadi problem klasik di tanah air. Kualitas pendidikan dan ketiadaan akses menjadi kendala tersendiri bagi masyarakat marginal. Mengutip data BPS pada statistik pendidikan 2018, <strong>"Hanya 18,59 persen penduduk usia 19-24 tahun di Indonesia yang melanjutkan ke jenjang perguruan tinggi"</strong>.
                        </p>
                        <p class="text-muted mb-3">
                            Penelitian Smeru Research Institute berjudul "Effect of Growing Up Poor on Labor Market Outcomes" menyatakan bahwa <strong>anak yang pada usia 8-17 tahun hidup dalam kemiskinan, ketika bekerja pendapatannya akan 87 persen lebih rendah</strong> dari mereka yang kecilnya tidak miskin.
                        </p>
                        <p class="text-muted mb-0">
                            <strong>Beasiswa Sang Surya</strong> merupakan program dari salah satu pilar pendidikan yaitu pemberian bantuan keringanan biaya mahasiswa kurang mampu/miskin dan mahasiswa yang aktif sebagai kader persyarikatan untuk jenjang pendidikan perguruan tinggi se-DIY dalam bentuk bantuan keringanan biaya SPP/UKT mahasiswa.
                        </p>
                    </div>
                </div>

                <!-- Tujuan Program -->
                <div class="card border-0 shadow-lg card-hover mb-4">
                    <div class="card-body p-5">
                        <h3 class="fw-bold text-dark mb-4">
                            <i class="fas fa-bullseye text-warning me-2"></i>
                            Tujuan Program
                        </h3>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <div class="text-center p-3 bg-light rounded">
                                    <div class="mb-3" style="font-size: 3rem;">💰</div>
                                    <p class="text-muted small mb-0">
                                        <strong>Menyediakan dana pendidikan</strong> demi terjaminnya keberlangsungan program pendidikan bagi golongan kurang mampu/miskin
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="text-center p-3 bg-light rounded">
                                    <div class="mb-3" style="font-size: 3rem;">🎓</div>
                                    <p class="text-muted small mb-0">
                                        <strong>Menyiapkan generasi penerus bangsa</strong> yang memiliki kedalaman ilmu pengetahuan dan keluhuran akhlak
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="text-center p-3 bg-light rounded">
                                    <div class="mb-3" style="font-size: 3rem;">🤝</div>
                                    <p class="text-muted small mb-0">
                                        <strong>Mengajak masyarakat</strong> terlibat dalam kampanye "Bangkitkan Generasi Merdeka & Berkemajuan"
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Jenis Beasiswa -->
                <div class="card border-0 shadow-lg card-hover">
                    <div class="card-body p-5">
                        <h3 class="fw-bold text-dark mb-4">
                            <i class="fas fa-users text-warning me-2"></i>
                            Sasaran Program
                        </h3>
                        <p class="text-muted mb-4">
                            Sasaran program beasiswa Sang Surya adalah mahasiswa di PTN/PTS di wilayah Daerah Istimewa Yogyakarta. Terdapat <strong>dua jenis beasiswa</strong>:
                        </p>
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="card border-warning border-2 h-100">
                                    <div class="card-body p-4 text-center">
                                        <div class="icon-box bg-warning bg-opacity-10 mx-auto">
                                            ⭐
                                        </div>
                                        <h4 class="fw-bold text-warning mb-3">Beasiswa Kader</h4>
                                        <p class="text-muted mb-3">
                                            Bantuan biaya pendidikan bagi mahasiswa yang <strong>aktif sebagai kader persyarikatan di Ortom Muhammadiyah</strong>
                                        </p>
                                        <a href="{{ route('info.kader') }}" class="btn btn-warning btn-sm">
                                            Lihat Detail <i class="fas fa-arrow-right ms-1"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card border-primary border-2 h-100">
                                    <div class="card-body p-4 text-center">
                                        <div class="icon-box bg-primary bg-opacity-10 mx-auto">
                                            🤲
                                        </div>
                                        <h4 class="fw-bold text-primary mb-3">Beasiswa Dhuafa</h4>
                                        <p class="text-muted mb-3">
                                            Bantuan biaya pendidikan bagi mahasiswa dari <strong>keluarga kurang mampu/miskin</strong>
                                        </p>
                                        <a href="{{ route('info.dhuafa') }}" class="btn btn-primary btn-sm">
                                            Lihat Detail <i class="fas fa-arrow-right ms-1"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Sistem Informasi -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <div class="text-center mb-5">
                    <h2 class="display-6 fw-bold text-dark mb-3">
                        Sistem Informasi <span class="text-warning">Pemilihan Beasiswa</span>
                    </h2>
                    <p class="lead text-muted">
                        Teknologi modern untuk seleksi yang transparan dan objektif
                    </p>
                </div>

                <div class="card border-0 shadow-lg card-hover mb-4">
                    <div class="card-body p-5">
                        <div class="row align-items-center">
                            <div class="col-md-8">
                                <h3 class="fw-bold text-dark mb-4">Tentang Sistem</h3>
                                <p class="text-muted mb-3">
                                    Sistem Informasi Pemilihan Beasiswa ini dirancang khusus untuk membantu proses seleksi penerima beasiswa secara <span class="text-warning fw-semibold">transparan, objektif, dan efisien</span>. 
                                </p>
                                <p class="text-muted mb-0">
                                    Sistem ini digunakan oleh LAZISMU DIY dalam menentukan penerima beasiswa kategori kader Muhammadiyah maupun dhuafa dengan menggunakan <strong>metode Simple Additive Weighting (SAW)</strong> yang telah teruji akurasinya.
                                </p>
                            </div>
                            <div class="col-md-4 text-center">
                                <div class="icon-box bg-primary bg-opacity-10">
                                    💻
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Metode SAW -->
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="card border-0 shadow card-hover h-100">
                            <div class="card-body p-4 text-center">
                                <div class="icon-box bg-success bg-opacity-10">
                                    🎯
                                </div>
                                <h4 class="fw-bold text-success mb-3">Akurasi Tinggi</h4>
                                <p class="text-muted mb-0">
                                    Metode SAW memberikan hasil perhitungan yang akurat berdasarkan kriteria-kriteria yang telah ditentukan dengan bobot yang sesuai
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card border-0 shadow card-hover h-100">
                            <div class="card-body p-4 text-center">
                                <div class="icon-box bg-info bg-opacity-10">
                                    ⚖️
                                </div>
                                <h4 class="fw-bold text-info mb-3">Objektif & Adil</h4>
                                <p class="text-muted mb-0">
                                    Sistem menggunakan perhitungan matematis yang objektif, menghilangkan bias subjektif dalam proses seleksi
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Fitur Sistem -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <div class="text-center mb-5">
                    <h2 class="display-6 fw-bold text-dark mb-3">Fitur Unggulan Sistem</h2>
                    <p class="lead text-muted">
                        Platform lengkap untuk manajemen beasiswa modern
                    </p>
                </div>

                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="card border-0 shadow card-hover h-100">
                            <div class="card-body p-4 text-center">
                                <div class="feature-number">01</div>
                                <h5 class="fw-bold mb-3">Pendaftaran Online</h5>
                                <p class="text-muted small">
                                    Sistem pendaftaran online yang mudah dan user-friendly untuk calon penerima beasiswa
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card border-0 shadow card-hover h-100">
                            <div class="card-body p-4 text-center">
                                <div class="feature-number">02</div>
                                <h5 class="fw-bold mb-3">Perhitungan SAW</h5>
                                <p class="text-muted small">
                                    Sistem perhitungan otomatis menggunakan metode SAW untuk hasil yang objektif
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card border-0 shadow card-hover h-100">
                            <div class="card-body p-4 text-center">
                                <div class="feature-number">03</div>
                                <h5 class="fw-bold mb-3">Laporan Transparan</h5>
                                <p class="text-muted small">
                                    Laporan hasil seleksi yang detail dan dapat dipertanggungjawabkan
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Penyelenggara -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <div class="text-center mb-4">
                    <h2 class="display-6 fw-bold text-dark mb-3">
                        Penyelenggara & <span class="text-warning">Mitra</span>
                    </h2>
                </div>
                <div class="card border-0 shadow-lg">
                    <div class="card-body p-5 text-center">
                        <p class="text-muted mb-4">
                            Beasiswa Sang Surya diselenggarakan oleh <strong>Lazismu DIY</strong> bekerja sama dengan:
                        </p>
                        <div class="row g-3">
                            <div class="col-md-3">
                                <div class="bg-light rounded p-3">
                                    <p class="mb-0 small fw-semibold">Dikdasmen PWM DIY</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="bg-light rounded p-3">
                                    <p class="mb-0 small fw-semibold">Ikatan Mahasiswa Muhammadiyah DIY</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="bg-light rounded p-3">
                                    <p class="mb-0 small fw-semibold">Universitas Ahmad Dahlan</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="bg-light rounded p-3">
                                    <p class="mb-0 small fw-semibold">Universitas Muhammadiyah Yogyakarta</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact CTA -->
<section class="hero-gradient py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center text-white">
                <h2 class="display-6 fw-bold mb-3">
                    Bergabung dengan Program Beasiswa LAZISMU
                </h2>
                <p class="lead mb-4">
                    Wujudkan impian pendidikan Anda bersama LAZISMU DIY
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
        </div>
    </div>
</section>
@endsection