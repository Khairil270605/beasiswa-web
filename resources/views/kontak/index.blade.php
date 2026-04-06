@extends('layouts.app')

@section('title', 'Kontak Kami')

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
    box-shadow: 0 15px 35px rgba(0,0,0,0.1);
}

.btn-gradient {
    background: linear-gradient(45deg, #ff6b35, #f7931e);
    border: none;
    transition: all 0.3s ease;
}

.btn-gradient:hover {
    transform: scale(1.05);
    box-shadow: 0 8px 25px rgba(255,107,53,0.3);
}

.contact-icon {
    width: 60px;
    height: 60px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    border-radius: 15px;
    margin-bottom: 1rem;
}

.form-control:focus {
    border-color: #ff6b35;
    box-shadow: 0 0 0 0.2rem rgba(255, 107, 53, 0.25);
}

.floating-element {
    animation: float 3s ease-in-out infinite;
}

@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-10px); }
}

.pulse-element {
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0%, 100% { opacity: 0.8; }
    50% { opacity: 1; }
}

.contact-info-card {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
}
</style>

<!-- Hero Section -->
<section class="hero-gradient text-white py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8 mx-auto text-center">
                <div class="floating-element">
                    <h1 class="display-4 fw-bold mb-4">
                        Hubungi <span class="text-warning">LAZISMU</span>
                    </h1>
                </div>
                <p class="lead mb-4">
                    Kami siap membantu Anda! Hubungi tim kami untuk informasi lebih lanjut tentang program beasiswa
                </p>
                <div class="d-flex justify-content-center gap-3">
                    <div class="bg-white bg-opacity-20 rounded-pill px-3 py-2">
                        <i class="fas fa-phone me-2"></i>
                        <span class="fw-semibold text-dark">24/7 Support</span>
                    </div>
                    <div class="bg-white bg-opacity-20 rounded-pill px-3 py-2">
                        <i class="fas fa-reply me-2"></i>
                        <span class="fw-semibold text-dark">Fast Response</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact Information -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center mb-5">
                <h2 class="display-6 fw-bold text-dark mb-3">
                    Informasi <span class="text-warning">Kontak</span>
                </h2>
                <p class="lead text-muted">
                    Berbagai cara untuk menghubungi tim LAZISMU DIY
                </p>
            </div>
        </div>

        <div class="row g-4 mb-5">

    <!-- Alamat -->
    <div class="col-md-3">
        <div class="card border-0 shadow card-hover h-100 text-center">
            <div class="card-body p-4">
                <div class="contact-icon bg-primary bg-opacity-10 mx-auto">📍</div>
                <h5 class="fw-bold text-primary mb-3">Alamat Kantor</h5>
                <p class="text-muted mb-0">
                    Jl. Kapas No. 7, Semaki,<br>
                    Umbulharjo, Kota Yogyakarta<br>
                    DIY 55166
                </p>
            </div>
        </div>
    </div>

    <!-- Telepon -->
    <div class="col-md-3">
        <div class="card border-0 shadow card-hover h-100 text-center">
            <div class="card-body p-4">
                <div class="contact-icon bg-success bg-opacity-10 mx-auto">📞</div>
                <h5 class="fw-bold text-success mb-3">Telepon</h5>
                <p class="text-muted mb-2">(0274) 387656</p>
                <p class="text-muted mb-0">+62 812-3456-7890</p>
            </div>
        </div>
    </div>

    <!-- Email -->
    <div class="col-md-3">
        <div class="card border-0 shadow card-hover h-100 text-center">
            <div class="card-body p-4">
                <div class="contact-icon bg-warning bg-opacity-10 mx-auto">✉️</div>
                <h5 class="fw-bold text-warning mb-3">Email</h5>
                <p class="text-muted mb-2">info@lazisnudiy.org</p>
                <p class="text-muted mb-0">beasiswa@lazisnudiy.org</p>
            </div>
        </div>
    </div>

    <!-- Jam Operasional -->
    <div class="col-md-3">
        <div class="card border-0 shadow card-hover h-100 text-center">
            <div class="card-body p-4">
                <div class="contact-icon bg-info bg-opacity-10 mx-auto">🕒</div>
                <h5 class="fw-bold text-info mb-3">Jam Operasional</h5>
                <p class="text-muted mb-1">Senin–Jumat<br>08.00–16.00</p>
                <p class="text-muted mb-0">Sabtu<br>08.00–12.00</p>
            </div>
        </div>
    </div>

</div>
                <!-- FAQ Section -->
                <div class="mt-5">
                    <div class="text-center mb-4">
                        <h3 class="fw-bold text-dark">
                            Pertanyaan yang Sering Diajukan
                        </h3>
                    </div>
                    
                    <div class="accordion" id="faqAccordion">
                        <div class="accordion-item border-0 shadow-sm mb-3">
                            <h2 class="accordion-header">
                                <button class="accordion-button fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                    📚 Kapan pendaftaran beasiswa dibuka?
                                </button>
                            </h2>
                            <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                                <div class="accordion-body text-muted">
                                    Pendaftaran beasiswa LAZISMU DIY biasanya dibuka setiap awal semester (Februari dan Agustus). Pantau terus website kami untuk informasi terbaru.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item border-0 shadow-sm mb-3">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                    💰 Berapa besar beasiswa yang diberikan?
                                </button>
                            </h2>
                            <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body text-muted">
                                    Besaran beasiswa bervariasi tergantung kategori: Kader Muhammadiyah (Rp 2-5 juta/semester) dan Dhuafa (Rp 1-3 juta/semester).
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item border-0 shadow-sm mb-3">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                    📋 Apa saja syarat pendaftaran?
                                </button>
                            </h2>
                            <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body text-muted">
                                    Syarat umum: Mahasiswa aktif, IPK minimal 3.5, surat keterangan tidak mampu, dan melengkapi dokumen pendukung lainnya.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Map Section (Optional) -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center mb-4">
                <h3 class="fw-bold text-dark mb-3">
                    Lokasi <span class="text-warning">Kantor Kami</span>
                </h3>
            </div>
        </div>
       <div class="row">
    <div class="col-lg-10 mx-auto">
        <div class="card border-0 shadow-lg">
            <div class="card-body p-0">
                <div class="ratio" style="--bs-aspect-ratio: 35%;">
                    <iframe
                        src="https://www.google.com/maps?q=Jl.%20Kapas%20No.%207,%20Semaki,%20Umbulharjo,%20Yogyakarta&output=embed"
                        style="border:0;"
                        allowfullscreen
                        loading="lazy">
                    </iframe>
                </div>
            </div>
        </div>
    </div>
</div>
    </div>
</section>
@endsection