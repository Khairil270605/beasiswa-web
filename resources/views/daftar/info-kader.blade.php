@extends('layouts.app')

@section('title', 'Informasi Beasiswa Kader Muhammadiyah - LAZISMU DIY')

@section('content')

<style>
    :root {
        --primary: #ff6b35;
        --secondary: #f7931e;
    }

    .hero-section {
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        color: white;
        padding: 4rem 0;
        position: relative;
        overflow: hidden;
    }

    .hero-section::before {
        content: '';
        position: absolute;
        width: 500px;
        height: 500px;
        background: rgba(255,255,255,0.1);
        border-radius: 50%;
        top: -200px;
        right: -100px;
    }

    .hero-content {
        position: relative;
        z-index: 2;
    }

    .info-card {
        background: white;
        border-radius: 15px;
        padding: 2rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        border-left: 4px solid var(--primary);
    }

    .info-card h3 {
        color: var(--primary);
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .info-card h3 i {
        width: 50px;
        height: 50px;
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
    }

    .requirements-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1rem;
        margin-top: 1rem;
    }

    .req-item {
        background: rgba(255, 107, 53, 0.05);
        padding: 1rem;
        border-radius: 10px;
        border-left: 3px solid #28a745;
    }

    .req-item i {
        color: #28a745;
        margin-right: 0.5rem;
    }

    .documents-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
        gap: 1rem;
        margin-top: 1rem;
    }

    .doc-card {
        background: white;
        border: 2px solid #e9ecef;
        border-radius: 10px;
        padding: 1.5rem 1rem;
        text-align: center;
        transition: all 0.3s;
    }

    .doc-card:hover {
        border-color: var(--primary);
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(255,107,53,0.2);
    }

    .doc-card i {
        font-size: 2.5rem;
        color: var(--primary);
        margin-bottom: 0.5rem;
    }

    .doc-card.optional {
        border: 2px dashed #dee2e6;
    }

    .doc-card.optional i {
        color: #6c757d;
    }

    .timeline {
        position: relative;
        padding: 2rem 0;
    }

    .timeline-item {
        display: flex;
        gap: 1.5rem;
        margin-bottom: 2rem;
        position: relative;
    }

    .timeline-item::before {
        content: '';
        position: absolute;
        left: 20px;
        top: 50px;
        bottom: -20px;
        width: 2px;
        background: #dee2e6;
    }

    .timeline-item:last-child::before {
        display: none;
    }

    .timeline-dot {
        width: 40px;
        height: 40px;
        background: var(--primary);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: bold;
        flex-shrink: 0;
        z-index: 2;
    }

    .timeline-content {
        flex: 1;
        background: white;
        padding: 1rem 1.5rem;
        border-radius: 10px;
        box-shadow: 0 3px 10px rgba(0,0,0,0.08);
    }

    .cta-section {
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        color: white;
        padding: 3rem 0;
        text-align: center;
        margin-top: 3rem;
        border-radius: 20px;
    }

    .btn-daftar {
        background: white;
        color: var(--primary);
        padding: 1rem 3rem;
        border-radius: 50px;
        font-weight: 700;
        font-size: 1.2rem;
        border: none;
        transition: all 0.3s;
        box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        text-decoration: none;
        display: inline-block;
    }

    .btn-daftar:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 40px rgba(0,0,0,0.3);
        color: var(--secondary);
    }

    .facilities-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1.5rem;
        margin-top: 1rem;
    }

    .facility-card {
        background: linear-gradient(135deg, rgba(255,107,53,0.1), rgba(247,147,30,0.1));
        border-radius: 15px;
        padding: 1.5rem;
        text-align: center;
        transition: all 0.3s;
    }

    .facility-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(255,107,53,0.2);
    }

    .facility-card i {
        font-size: 2.5rem;
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        margin-bottom: 1rem;
    }

    .sticky-cta {
        position: fixed;
        bottom: 20px;
        right: 20px;
        z-index: 1000;
        opacity: 0;
        transform: translateY(100px);
        transition: all 0.3s;
    }

    .sticky-cta.show {
        opacity: 1;
        transform: translateY(0);
    }

    .doc-section-title {
        color: var(--secondary);
        font-weight: 600;
        font-size: 1.1rem;
        margin: 2rem 0 1rem;
        padding-bottom: 0.5rem;
        border-bottom: 2px solid var(--secondary);
    }

    .org-list {
        background: rgba(255, 107, 53, 0.05);
        padding: 1.5rem;
        border-radius: 10px;
        margin-top: 1rem;
    }

    .org-list ul {
        margin-bottom: 0;
        columns: 2;
        -webkit-columns: 2;
        -moz-columns: 2;
    }

    .org-list li {
        margin-bottom: 0.5rem;
    }

    @media (max-width: 768px) {
        .hero-section {
            padding: 2rem 0;
        }
        
        .requirements-grid,
        .documents-grid,
        .facilities-grid {
            grid-template-columns: 1fr;
        }

        .org-list ul {
            columns: 1;
            -webkit-columns: 1;
            -moz-columns: 1;
        }
    }
</style>

<!-- Hero Section -->
<div class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8 mx-auto text-center hero-content">
                <i class="fas fa-star-and-crescent" style="font-size: 4rem; margin-bottom: 1rem;"></i>
                <h1 class="display-4 fw-bold mb-3">Beasiswa Kader Muhammadiyah</h1>
                <h3 class="mb-4">Beasiswa Sang Surya LAZISMU DIY 2024/2025</h3>
                <p class="lead mb-4">
                    Bantuan biaya pendidikan bagi mahasiswa yang aktif sebagai kader persyarikatan di Ortom Muhammadiyah
                </p>
                <a href="#daftar" class="btn btn-daftar">
                    <i class="fas fa-arrow-down me-2"></i>Lihat Persyaratan
                </a>
            </div>
        </div>
    </div>
</div>

<div class="container my-5">
    <!-- Tentang Program -->
    <div class="info-card">
        <h3>
            <i class="fas fa-info-circle"></i>
            Tentang Program
        </h3>
        <p class="mb-0">
            Beasiswa Kader Muhammadiyah merupakan program khusus untuk mendukung kader-kader muda Persyarikatan Muhammadiyah yang aktif berorganisasi sekaligus berprestasi dalam bidang akademik. Program ini bertujuan menyiapkan generasi penerus bangsa yang memiliki kedalaman ilmu pengetahuan dan keluhuran akhlak, serta mampu menjadi penggerak perubahan di masyarakat melalui nilai-nilai kemuhammadiyahan.
        </p>
    </div>

    <!-- Fasilitas -->
    <div class="info-card">
        <h3>
            <i class="fas fa-gift"></i>
            Fasilitas yang Didapat
        </h3>
        <div class="facilities-grid">
            <div class="facility-card">
                <i class="fas fa-money-bill-wave"></i>
                <h6 class="fw-bold">Bantuan Dana Pendidikan</h6>
                <p class="small text-muted mb-0">Bantuan biaya kuliah/UKT</p>
            </div>
            <div class="facility-card">
                <i class="fas fa-chalkboard-teacher"></i>
                <h6 class="fw-bold">Pelatihan & Mentoring</h6>
                <p class="small text-muted mb-0">Pelatihan AIK, kepemimpinan, dan pengembangan diri</p>
            </div>
            <div class="facility-card">
                <i class="fas fa-users"></i>
                <h6 class="fw-bold">Networking</h6>
                <p class="small text-muted mb-0">Jaringan sesama kader Muhammadiyah</p>
            </div>
            <div class="facility-card">
                <i class="fas fa-mosque"></i>
                <h6 class="fw-bold">Wawasan Keislaman</h6>
                <p class="small text-muted mb-0">Penambahan wawasan keislaman dan kemuhammadiyahan</p>
            </div>
            <div class="facility-card">
                <i class="fas fa-hands"></i>
                <h6 class="fw-bold">Relawan Lazismu</h6>
                <p class="small text-muted mb-0">Kesempatan menjadi relawan</p>
            </div>
        </div>
    </div>

    <!-- Persyaratan Umum -->
    <div class="info-card">
        <h3>
            <i class="fas fa-clipboard-check"></i>
            Persyaratan Umum
        </h3>
        <div class="requirements-grid">
            <div class="req-item">
                <i class="fas fa-check-circle"></i>
                <strong>Mahasiswa aktif PTN/PTS di D.I. Yogyakarta</strong>
            </div>
            <div class="req-item">
                <i class="fas fa-check-circle"></i>
                <strong>Semester 2 s.d. 6 saat mendaftar</strong>
            </div>
            <div class="req-item">
                <i class="fas fa-check-circle"></i>
                <strong>IPK minimal 3,50 dari skala 4,00</strong>
            </div>
            <div class="req-item">
                <i class="fas fa-check-circle"></i>
                <strong>Tidak sedang mendapatkan beasiswa dari lembaga manapun</strong>
            </div>
            <div class="req-item">
                <i class="fas fa-check-circle"></i>
                <strong>Follow Instagram @lazismu_diy</strong>
            </div>
            <div class="req-item">
                <i class="fas fa-check-circle"></i>
                <strong>Bersedia menjadi relawan LAZISMU</strong>
            </div>
        </div>
    </div>

    <!-- Persyaratan Khusus -->
    <div class="info-card">
        <h3>
            <i class="fas fa-star-and-crescent"></i>
            Persyaratan Khusus Beasiswa Kader Muhammadiyah
        </h3>
        <div class="requirements-grid">
            <div class="req-item">
                <i class="fas fa-check-circle"></i>
                <strong>Aktif sebagai kader di salah satu Ortom Muhammadiyah</strong>
            </div>
            <div class="req-item">
                <i class="fas fa-check-circle"></i>
                <strong>Memiliki KTAM (Kartu Tanda Anggota Muhammadiyah) yang masih berlaku</strong>
            </div>
            <div class="req-item">
                <i class="fas fa-check-circle"></i>
                <strong>Surat keterangan aktif organisasi dari pengurus Ortom</strong>
            </div>
            <div class="req-item">
                <i class="fas fa-check-circle"></i>
                <strong>Surat rekomendasi dari Pimpinan Muhammadiyah atau pengurus Ortom</strong>
            </div>
            <div class="req-item">
                <i class="fas fa-check-circle"></i>
                <strong>Memiliki riwayat aktivitas dan kontribusi untuk Muhammadiyah</strong>
            </div>
            <div class="req-item">
                <i class="fas fa-check-circle"></i>
                <strong>Melampirkan foto kondisi rumah (5 foto)</strong>
            </div>
        </div>

        <div class="org-list">
            <h6 class="fw-bold mb-3 text-primary">
                <i class="fas fa-users me-2"></i>Ortom Muhammadiyah yang Dimaksud:
            </h6>
            <ul>
                <li><i class="fas fa-check text-success me-2"></i>Ranting Muhammadiyah</li>
                <li><i class="fas fa-check text-success me-2"></i>Ranting Aisyiyah</li>
                <li><i class="fas fa-check text-success me-2"></i>IPM (Ikatan Pelajar Muhammadiyah)</li>
                <li><i class="fas fa-check text-success me-2"></i>IMM (Ikatan Mahasiswa Muhammadiyah)</li>
                <li><i class="fas fa-check text-success me-2"></i>Pemuda Muhammadiyah</li>
                <li><i class="fas fa-check text-success me-2"></i>Nasyiatul Aisyiyah</li>
                <li><i class="fas fa-check text-success me-2"></i>Kokam (Komando Kesiapsiagaan Angkatan Muda)</li>
                <li><i class="fas fa-check text-success me-2"></i>Hizbul Wathan</li>
                <li><i class="fas fa-check text-success me-2"></i>Tapak Suci</li>
            </ul>
        </div>
    </div>

    <!-- Dokumen -->
    <div class="info-card">
        <h3>
            <i class="fas fa-folder-open"></i>
            Dokumen yang Harus Disiapkan
        </h3>
        <p class="text-muted mb-3">Siapkan dokumen-dokumen berikut dalam format softcopy sebelum mengisi formulir:</p>
        
        <h6 class="doc-section-title"><i class="fas fa-id-card me-2"></i>Dokumen Identitas</h6>
        <div class="documents-grid">
            <div class="doc-card">
                <i class="fas fa-id-card"></i>
                <h6 class="small fw-bold mb-1">KTP</h6>
                <small class="text-muted">JPG/PNG/PDF<br>Max: 2MB</small>
            </div>
            <div class="doc-card">
                <i class="fas fa-users"></i>
                <h6 class="small fw-bold mb-1">Kartu Keluarga</h6>
                <small class="text-muted">JPG/PNG/PDF<br>Max: 2MB</small>
            </div>
        </div>

        <h6 class="doc-section-title"><i class="fas fa-graduation-cap me-2"></i>Dokumen Akademik</h6>
        <div class="documents-grid">
            <div class="doc-card">
                <i class="fas fa-file-alt"></i>
                <h6 class="small fw-bold mb-1">Transkrip Nilai</h6>
                <small class="text-muted">PDF<br>Max: 5MB</small>
            </div>
            <div class="doc-card">
                <i class="fas fa-id-badge"></i>
                <h6 class="small fw-bold mb-1">KTM</h6>
                <small class="text-muted">JPG/PNG<br>Max: 2MB</small>
            </div>
        </div>

        <h6 class="doc-section-title"><i class="fas fa-money-check-alt me-2"></i>Dokumen Ekonomi</h6>
        <div class="documents-grid">
            <div class="doc-card">
                <i class="fas fa-money-bill-wave"></i>
                <h6 class="small fw-bold mb-1">Surat Penghasilan</h6>
                <small class="text-muted">PDF<br>Max: 3MB</small>
            </div>
            <div class="doc-card">
                <i class="fas fa-receipt"></i>
                <h6 class="small fw-bold mb-1">Slip Gaji Ortu</h6>
                <small class="text-muted">PDF/JPG/PNG<br>Max: 2MB</small>
            </div>
            <div class="doc-card">
                <i class="fas fa-file-contract"></i>
                <h6 class="small fw-bold mb-1">Surat Tidak Beasiswa Lain</h6>
                <small class="text-muted">PDF/JPG/PNG<br>Max: 2MB</small>
            </div>
        </div>

        <h6 class="doc-section-title"><i class="fas fa-star-and-crescent me-2"></i>Dokumen Organisasi Muhammadiyah</h6>
        <div class="documents-grid">
            <div class="doc-card">
                <i class="fas fa-star-and-crescent"></i>
                <h6 class="small fw-bold mb-1">Surat Aktif Organisasi</h6>
                <small class="text-muted">PDF<br>Max: 3MB</small>
            </div>
            <div class="doc-card">
                <i class="fas fa-id-card-alt"></i>
                <h6 class="small fw-bold mb-1">KTAM</h6>
                <small class="text-muted">JPG/PNG<br>Max: 2MB</small>
            </div>
            <div class="doc-card">
                <i class="fas fa-file-signature"></i>
                <h6 class="small fw-bold mb-1">Surat Rekomendasi</h6>
                <small class="text-muted">PDF/JPG/PNG<br>Max: 2MB</small>
            </div>
            <div class="doc-card optional">
                <i class="fas fa-certificate"></i>
                <h6 class="small fw-bold mb-1">Sertifikat/Piagam</h6>
                <small class="text-muted">PDF (Opsional)<br>Max: 5MB</small>
            </div>
        </div>

        <h6 class="doc-section-title"><i class="fas fa-home me-2"></i>Foto Kondisi Rumah</h6>
        <div class="documents-grid">
            <div class="doc-card">
                <i class="fas fa-home"></i>
                <h6 class="small fw-bold mb-1">Foto Rumah Depan</h6>
                <small class="text-muted">JPG/PNG<br>Max: 2MB</small>
            </div>
            <div class="doc-card">
                <i class="fas fa-home"></i>
                <h6 class="small fw-bold mb-1">Foto Rumah Samping</h6>
                <small class="text-muted">JPG/PNG<br>Max: 2MB</small>
            </div>
            <div class="doc-card">
                <i class="fas fa-couch"></i>
                <h6 class="small fw-bold mb-1">Foto Ruang Tamu</h6>
                <small class="text-muted">JPG/PNG<br>Max: 2MB</small>
            </div>
            <div class="doc-card">
                <i class="fas fa-bath"></i>
                <h6 class="small fw-bold mb-1">Foto Kamar Mandi</h6>
                <small class="text-muted">JPG/PNG<br>Max: 2MB</small>
            </div>
            <div class="doc-card">
                <i class="fas fa-utensils"></i>
                <h6 class="small fw-bold mb-1">Foto Dapur</h6>
                <small class="text-muted">JPG/PNG<br>Max: 2MB</small>
            </div>
        </div>

        <h6 class="doc-section-title"><i class="fas fa-file-alt me-2"></i>Dokumen Pendukung Lainnya</h6>
        <div class="documents-grid">
            <div class="doc-card">
                <i class="fas fa-file-alt"></i>
                <h6 class="small fw-bold mb-1">CV</h6>
                <small class="text-muted">PDF/DOC/DOCX<br>Max: 2MB</small>
            </div>
            <div class="doc-card">
                <i class="fas fa-portrait"></i>
                <h6 class="small fw-bold mb-1">Pas Foto</h6>
                <small class="text-muted">JPG/PNG<br>Max: 2MB</small>
            </div>
            <div class="doc-card">
                <i class="fas fa-envelope-open-text"></i>
                <h6 class="small fw-bold mb-1">Motivation Letter</h6>
                <small class="text-muted">PDF/DOC/DOCX<br>Max: 2MB</small>
            </div>
            <div class="doc-card">
                <i class="fas fa-image"></i>
                <h6 class="small fw-bold mb-1">Twibbon</h6>
                <small class="text-muted">JPG/PNG<br>Max: 2MB</small>
            </div>
            <div class="doc-card">
                <i class="fas fa-hands-helping"></i>
                <h6 class="small fw-bold mb-1">Surat Kesanggupan Relawan</h6>
                <small class="text-muted">PDF/JPG/PNG<br>Max: 2MB</small>
            </div>
        </div>

        <div class="alert alert-info mt-4 mb-0">
            <i class="fas fa-info-circle me-2"></i>
            <strong>Catatan Penting:</strong> 
            <ul class="mb-0 mt-2">
                <li>Pastikan semua dokumen terlihat jelas dan dapat dibaca</li>
                <li>Ukuran file tidak melebihi batas maksimal yang ditentukan</li>
                <li>Format file sesuai dengan yang diminta</li>
                <li>Nama file sebaiknya sesuai dengan jenis dokumen (misal: KTAM_NamaAnda.jpg)</li>
                <li>Sertifikat/Piagam bersifat opsional (jika ada)</li>
            </ul>
        </div>
    </div>

    <!-- Timeline -->
    <div class="info-card">
        <h3>
            <i class="fas fa-calendar-alt"></i>
            Timeline Pendaftaran & Seleksi
        </h3>
        <div class="timeline">
            <div class="timeline-item">
                <div class="timeline-dot">1</div>
                <div class="timeline-content">
                    <h6 class="fw-bold mb-1">Pendaftaran Online</h6>
                    <p class="text-muted small mb-1">Periode pendaftaran beasiswa dibuka</p>
                    <p class="text-muted small mb-0">Calon penerima mengisi formulir online dan upload dokumen</p>
                </div>
            </div>
            <div class="timeline-item">
                <div class="timeline-dot">2</div>
                <div class="timeline-content">
                    <h6 class="fw-bold mb-1">Seleksi Administrasi</h6>
                    <p class="text-muted small mb-1">Verifikasi kelengkapan dan keabsahan dokumen</p>
                    <p class="text-muted small mb-0">Tim akan memeriksa semua berkas yang telah diupload</p>
                </div>
            </div>
            <div class="timeline-item">
                <div class="timeline-dot">3</div>
                <div class="timeline-content">
                    <h6 class="fw-bold mb-1">Pengumuman Lolos Administrasi</h6>
                    <p class="text-muted small mb-1">Pengumuman hasil seleksi administrasi</p>
                    <p class="text-muted small mb-0">Akan diinformasikan melalui email dan website</p>
                </div>
            </div>
            <div class="timeline-item">
                <div class="timeline-dot">4</div>
                <div class="timeline-content">
                    <h6 class="fw-bold mb-1">Wawancara & Verifikasi</h6>
                    <p class="text-muted small mb-1">Wawancara dengan calon penerima</p>
                    <p class="text-muted small mb-0">Verifikasi keaktifan organisasi dan kontribusi di Muhammadiyah</p>
                </div>
            </div>
            <div class="timeline-item">
                <div class="timeline-dot">5</div>
                <div class="timeline-content">
                    <h6 class="fw-bold mb-1">Pengumuman Penerima Beasiswa</h6>
                    <p class="text-muted small mb-1">Pengumuman final penerima beasiswa</p>
                    <p class="text-muted small mb-0">Penerima beasiswa akan dihubungi langsung</p>
                </div>
            </div>
        </div>
        <div class="alert alert-warning mt-3 mb-0">
            <i class="fas fa-exclamation-triangle me-2"></i>
            <strong>Perhatian:</strong> Timeline detail akan diinformasikan lebih lanjut. Pastikan untuk selalu mengecek email dan website resmi LAZISMU DIY.
        </div>
    </div>

    <!-- Kewajiban Penerima -->
    <div class="info-card">
        <h3>
            <i class="fas fa-tasks"></i>
            Kewajiban Penerima Beasiswa
        </h3>
        <div class="requirements-grid">
            <div class="req-item">
                <i class="fas fa-check-circle"></i>
                <strong>Tetap aktif di organisasi Muhammadiyah selama menerima beasiswa</strong>
            </div>
            <div class="req-item">
                <i class="fas fa-check-circle"></i>
                <strong>Mengikuti kegiatan pembinaan yang diadakan LAZISMU</strong>
            </div>
            <div class="req-item">
                <i class="fas fa-check-circle"></i>
                <strong>Bersedia menjadi relawan LAZISMU sesuai kemampuan</strong>
            </div>
            <div class="req-item">
                <i class="fas fa-check-circle"></i>
                <strong>Menjaga nama baik LAZISMU dan Muhammadiyah</strong>
            </div>
            <div class="req-item">
                <i class="fas fa-check-circle"></i>
                <strong>Membuat laporan perkembangan studi dan kegiatan organisasi setiap semester</strong>
            </div>
            <div class="req-item">
                <i class="fas fa-check-circle"></i>
                <strong>Mempertahankan IPK minimal 3,50</strong>
            </div>
        </div>
    </div>

    <!-- Kontak -->
    <div class="info-card">
        <h3>
            <i class="fas fa-phone-alt"></i>
            Informasi & Kontak
        </h3>
        <p class="mb-3">Jika ada pertanyaan terkait beasiswa, silakan hubungi:</p>
        <div class="row">
            <div class="col-md-6 mb-3">
                <div class="d-flex align-items-center">
                    <i class="fas fa-whatsapp fa-2x text-success me-3"></i>
                    <div>
                        <strong>WhatsApp</strong><br>
                        <a href="https://wa.me/6281234567890" class="text-decoration-none">0812-3456-7890</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="d-flex align-items-center">
                    <i class="fas fa-envelope fa-2x text-primary me-3"></i>
                    <div>
                        <strong>Email</strong><br>
                        <a href="mailto:beasiswa@lazismudiy.org" class="text-decoration-none">beasiswa@lazismudiy.org</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="d-flex align-items-center">
                    <i class="fab fa-instagram fa-2x text-danger me-3"></i>
                    <div>
                        <strong>Instagram</strong><br>
                        <a href="https://instagram.com/lazismu_diy" target="_blank" class="text-decoration-none">@lazismu_diy</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="d-flex align-items-center">
                    <i class="fas fa-map-marker-alt fa-2x text-info me-3"></i>
                    <div>
                        <strong>Alamat</strong><br>
                        Kantor LAZISMU DIY
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- CTA Section -->
<div class="container mb-5" id="daftar">
    <div class="cta-section">
        <i class="fas fa-rocket" style="font-size: 3rem; margin-bottom: 1rem;"></i>
        <h2 class="fw-bold mb-3">Siap Mendaftar Beasiswa Kader Muhammadiyah?</h2>
        <p class="lead mb-4">Pastikan semua dokumen sudah disiapkan sebelum mengisi formulir pendaftaran</p>
        <a href="{{ route('daftar.kader') }}" class="btn btn-daftar">
            <i class="fas fa-edit me-2"></i>Mulai Pendaftaran
        </a>
    </div>
</div>

<!-- Sticky CTA (muncul saat scroll) -->
<div class="sticky-cta" id="stickyCTA">
    <a href="{{ route('daftar.kader') }}" class="btn btn-daftar">
        <i class="fas fa-edit me-2"></i>Daftar Sekarang
    </a>
</div>

<script>
// Show sticky CTA on scroll
window.addEventListener('scroll', function() {
    const stickyCTA = document.getElementById('stickyCTA');
    if (window.scrollY > 500) {
        stickyCTA.classList.add('show');
    } else {
        stickyCTA.classList.remove('show');
    }
});

// Smooth scroll
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
    });
});
</script>

@endsection