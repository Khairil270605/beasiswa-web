@extends('layouts.admin')

@section('title', 'Tambah Pendaftar Beasiswa')

@section('content')

<style>
    :root {
        --primary-color: #ff6b35;
        --secondary-color: #f7931e;
        --accent-color: #dc3545;
        --success-color: #28a745;
        --warning-color: #ffc107;
        --info-color: #17a2b8;
    }

    .create-container {
        padding: 24px;
        background-color: #f8f9fa;
        min-height: 100vh;
    }

    .main-container {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border-radius: 20px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        margin: 20px auto;
        max-width: 1000px;
    }

    .header-section {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        color: white;
        padding: 2rem;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .header-section h1 {
        font-size: 1.8rem;
        font-weight: bold;
        margin: 0;
    }

    .kategori-selector {
        background: white;
        padding: 2rem;
        margin: 2rem;
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .kategori-selector h3 {
        color: var(--primary-color);
        font-weight: 700;
        margin-bottom: 1.5rem;
        text-align: center;
    }

    .kategori-options {
        display: flex;
        gap: 1.5rem;
        justify-content: center;
        flex-wrap: wrap;
    }

    .kategori-card {
        flex: 1;
        min-width: 250px;
        max-width: 350px;
        border: 3px solid #e9ecef;
        border-radius: 15px;
        padding: 2rem;
        cursor: pointer;
        transition: all 0.3s ease;
        text-align: center;
    }

    .kategori-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }

    .kategori-card input[type="radio"] {
        display: none;
    }

    .kategori-card input[type="radio"]:checked + .card-content {
        border-color: var(--primary-color);
    }

    .kategori-card input[type="radio"]:checked ~ .kategori-card {
        border-color: var(--primary-color);
        background: rgba(255, 107, 53, 0.05);
    }

    .kategori-card.active {
        border-color: var(--primary-color);
        background: rgba(255, 107, 53, 0.05);
    }

    .kategori-icon {
        font-size: 4rem;
        margin-bottom: 1rem;
    }

    .kategori-title {
        font-size: 1.3rem;
        font-weight: 700;
        color: #212529;
        margin-bottom: 0.5rem;
    }

    .kategori-desc {
        color: #6c757d;
        font-size: 0.9rem;
    }

    .form-content {
        padding: 2rem;
        display: none;
    }

    .form-content.active {
        display: block;
        animation: slideIn 0.5s ease-out;
    }

    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .form-section {
        background: #f8f9fa;
        border-radius: 15px;
        padding: 2rem;
        margin-bottom: 2rem;
        border-left: 4px solid var(--primary-color);
    }

    .section-title {
        color: var(--primary-color);
        font-weight: 700;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .section-icon {
        width: 50px;
        height: 50px;
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.2rem;
    }

    .form-floating {
        position: relative;
        margin-bottom: 1.5rem;
    }

    .form-floating input,
    .form-floating select,
    .form-floating textarea {
        border: 2px solid #e9ecef;
        border-radius: 15px;
        padding: 1rem 1.25rem;
        font-size: 1rem;
        transition: all 0.3s ease;
        background: rgba(255, 255, 255, 0.8);
        width: 100%;
    }

    .form-floating input:focus,
    .form-floating select:focus,
    .form-floating textarea:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 0.2rem rgba(255, 107, 53, 0.25);
        background: white;
        outline: none;
    }

    .form-floating label {
        padding: 0 0.5rem;
        color: #6c757d;
        font-weight: 500;
        position: absolute;
        top: 1rem;
        left: 1.25rem;
        pointer-events: none;
        transition: all 0.3s ease;
        background: transparent;
    }

    .form-floating input:focus + label,
    .form-floating input:not(:placeholder-shown) + label,
    .form-floating select:focus + label,
    .form-floating select:not([value=""]) + label,
    .form-floating textarea:focus + label,
    .form-floating textarea:not(:placeholder-shown) + label {
        top: -0.5rem;
        left: 1rem;
        font-size: 0.85rem;
        color: var(--primary-color);
    }

    .upload-area {
        border: 2px dashed #dee2e6;
        border-radius: 15px;
        padding: 2rem;
        text-align: center;
        transition: all 0.3s ease;
        background: rgba(255, 255, 255, 0.5);
        margin-bottom: 1.5rem;
    }

    .upload-area:hover {
        border-color: var(--primary-color);
        background: rgba(255, 107, 53, 0.05);
    }

    .file-input {
        display: none;
    }

    .upload-btn {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        border: none;
        color: white;
        padding: 0.75rem 2rem;
        border-radius: 25px;
        font-weight: 600;
        transition: all 0.3s ease;
        margin: 0.5rem;
        cursor: pointer;
    }

    .upload-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(255, 107, 53, 0.3);
    }

    .file-preview {
        background: rgba(255, 255, 255, 0.8);
        border-radius: 10px;
        padding: 1rem;
        margin: 0.5rem 0;
        display: flex;
        align-items: center;
        justify-content: space-between;
        border-left: 4px solid var(--success-color);
    }

    .required-star {
        color: var(--accent-color);
    }

    .btn-submit {
        background: linear-gradient(135deg, var(--success-color), var(--info-color));
        color: white;
        padding: 1rem 3rem;
        border-radius: 25px;
        border: none;
        font-weight: 600;
        font-size: 1.1rem;
        transition: all 0.3s ease;
        cursor: pointer;
        width: 100%;
        margin-top: 2rem;
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(40, 167, 69, 0.3);
    }

    .btn-back {
        background: #6c757d;
        color: white;
        padding: 0.75rem 2rem;
        border-radius: 25px;
        border: none;
        font-weight: 600;
        transition: all 0.3s ease;
        cursor: pointer;
        text-decoration: none;
        display: inline-block;
        margin-bottom: 1rem;
    }

    .btn-back:hover {
        background: #5a6268;
        color: white;
        text-decoration: none;
        transform: translateY(-2px);
    }

    .form-info {
        background: rgba(23, 162, 184, 0.1);
        border-left: 4px solid var(--info-color);
        padding: 1rem;
        border-radius: 8px;
        margin-bottom: 1.5rem;
        color: #0c5460;
    }

    /* Section khusus yang bisa di-hide */
    .section-kader-only {
        display: none;
    }

    .section-kader-only.active {
        display: block;
    }

    .doc-dhuafa-only {
        display: none;
    }

    .doc-dhuafa-only.active {
        display: block;
    }

    .doc-kader-only {
        display: none;
    }

    .doc-kader-only.active {
        display: block;
    }

    @media (max-width: 768px) {
        .main-container {
            margin: 10px;
            border-radius: 15px;
        }
        
        .kategori-options {
            flex-direction: column;
        }
        
        .kategori-card {
            max-width: 100%;
        }
    }
</style>

<div class="create-container">
    <div class="main-container">
        <!-- Header -->
        <div class="header-section">
            <h1>
                <i class="fas fa-plus-circle me-3"></i>
                Tambah Pendaftar Beasiswa LAZISMU
            </h1>
            <p class="mb-0 mt-2">Silakan pilih kategori dan lengkapi semua data dengan benar</p>
        </div>

        <div style="padding: 2rem;">
            <a href="{{ route('admin.pendaftar.index') }}" class="btn-back">
                <i class="fas fa-arrow-left me-2"></i>Kembali ke Daftar
            </a>
        </div>

        <!-- Alert Errors -->
        @if($errors->any())
        <div class="alert alert-danger mx-4">
            <strong>Terjadi kesalahan:</strong>
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <!-- Kategori Selector -->
        <div class="kategori-selector">
            <h3><i class="fas fa-clipboard-list me-2"></i>Pilih Kategori Beasiswa</h3>
            <div class="kategori-options">
                <!-- Dhuafa -->
                <label class="kategori-card" id="card-dhuafa">
                    <input type="radio" name="jenis_pendaftaran_display" value="dhuafa" checked>
                    <div class="card-content">
                        <div class="kategori-icon">📋</div>
                        <div class="kategori-title">Beasiswa Dhuafa</div>
                        <div class="kategori-desc">Untuk mahasiswa dari keluarga kurang mampu</div>
                    </div>
                </label>

                <!-- Kader -->
                <label class="kategori-card" id="card-kader">
                    <input type="radio" name="jenis_pendaftaran_display" value="kader">
                    <div class="card-content">
                        <div class="kategori-icon">🎓</div>
                        <div class="kategori-title">Beasiswa Kader</div>
                        <div class="kategori-desc">Untuk kader aktif Muhammadiyah</div>
                    </div>
                </label>
            </div>
        </div>

        <!-- Form Content -->
        <form id="createForm" action="{{ route('admin.alternatif.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="jenis_pendaftaran" id="jenis_pendaftaran" value="dhuafa">

            <div class="form-content active">
                
                <!-- Data Pribadi -->
                <div class="form-section">
                    <h3 class="section-title">
                        <div class="section-icon">
                            <i class="fas fa-user"></i>
                        </div>
                        Data Pribadi <span class="required-star">*</span>
                    </h3>

                    <div class="form-info">
                        <i class="fas fa-info-circle me-2"></i>
                        <strong>Petunjuk:</strong> Pastikan semua data pribadi sesuai dengan dokumen resmi.
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" name="nama" placeholder=" " required>
                                <label>Nama Lengkap <span class="required-star">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" name="nik" placeholder=" " maxlength="16" required>
                                <label>NIK (Nomor Induk Kependudukan) <span class="required-star">*</span></label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" name="tempat_lahir" placeholder=" " required>
                                <label>Tempat Lahir <span class="required-star">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="date" class="form-control" name="tanggal_lahir" placeholder=" " required>
                                <label>Tanggal Lahir <span class="required-star">*</span></label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select class="form-select" name="jenis_kelamin" required>
                                    <option value="">Pilih Jenis Kelamin</option>
                                    <option value="L">Laki-laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                                <label>Jenis Kelamin <span class="required-star">*</span></label>
                            </div>
                        </div>
                    </div>

                    <div class="form-floating">
                        <textarea class="form-control" name="alamat" placeholder=" " style="height: 120px" required></textarea>
                        <label>Alamat Lengkap <span class="required-star">*</span></label>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="tel" class="form-control" name="no_telepon" placeholder=" " required>
                                <label>Nomor Telepon <span class="required-star">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="email" class="form-control" name="email" placeholder=" " required>
                                <label>Alamat Email <span class="required-star">*</span></label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Data Akademik -->
                <div class="form-section">
                    <h3 class="section-title">
                        <div class="section-icon">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        Data Akademik <span class="required-star">*</span>
                    </h3>

                    <div class="form-info">
                        <i class="fas fa-university me-2"></i>
                        <strong>Info:</strong> Data akademik harus sesuai dengan data di kampus.
                    </div>

                    <div class="form-floating">
                        <input type="text" class="form-control" name="asal_kampus" placeholder=" " required>
                        <label>Asal Kampus/Universitas <span class="required-star">*</span></label>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" name="nim" placeholder=" " required>
                                <label>NIM (Nomor Induk Mahasiswa) <span class="required-star">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select class="form-select" name="semester" required>
                                    <option value="">Pilih Semester</option>
                                    <option value="1">Semester 1</option>
                                    <option value="2">Semester 2</option>
                                    <option value="3">Semester 3</option>
                                    <option value="4">Semester 4</option>
                                    <option value="5">Semester 5</option>
                                    <option value="6">Semester 6</option>
                                    <option value="7">Semester 7</option>
                                    <option value="8">Semester 8</option>
                                </select>
                                <label>Semester Saat Ini <span class="required-star">*</span></label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" name="fakultas" placeholder=" " required>
                                <label>Fakultas <span class="required-star">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" name="jurusan" placeholder=" " required>
                                <label>Program Studi/Jurusan <span class="required-star">*</span></label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="number" class="form-control" name="ipk" placeholder=" " step="0.01" min="0" max="4" required>
                                <label>IPK (Indeks Prestasi Kumulatif) <span class="required-star">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="number" class="form-control" name="tahun_masuk" placeholder=" " min="2015" max="{{ date('Y') + 1 }}">
                                <label>Tahun Masuk <span class="required-star">*</span></label>
                            </div>
                        </div>
                    </div>

                    <div class="form-floating">
                        <textarea class="form-control" name="prestasi" placeholder=" " style="height: 120px"></textarea>
                        <label>Prestasi Akademik/Non-Akademik (Opsional)</label>
                    </div>
                </div>

                <!-- Data Organisasi (KHUSUS KADER) -->
                <div class="form-section section-kader-only" id="section-organisasi">
                    <h3 class="section-title">
                        <div class="section-icon">
                            <i class="fas fa-users-cog"></i>
                        </div>
                        Data Organisasi Muhammadiyah <span class="required-star">*</span>
                    </h3>

                    <div class="form-info">
                        <i class="fas fa-mosque me-2"></i>
                        <strong>Khusus:</strong> Data ini khusus untuk kader Muhammadiyah yang aktif dalam organisasi.
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select class="form-select" name="jenis_organisasi" id="jenis_organisasi">
                                    <option value="">Pilih Jenis Organisasi</option>
                                    <option value="Ranting Muhammadiyah">Ranting Muhammadiyah</option>
                                    <option value="Ranting Aisyiyah">Ranting Aisyiyah</option>
                                    <option value="IPM">Ikatan Pelajar Muhammadiyah (IPM)</option>
                                    <option value="IMM">Ikatan Mahasiswa Muhammadiyah (IMM)</option>
                                    <option value="Pemuda Muhammadiyah">Pemuda Muhammadiyah</option>
                                    <option value="Nasyiatul Aisyiyah">Nasyiatul Aisyiyah</option>
                                    <option value="Kokam">Kokam (Komando Kesiapsiagaan)</option>
                                    <option value="HW">Hizbul Wathan</option>
                                    <option value="Tapak Suci">Tapak Suci</option>
                                </select>
                                <label>Jenis Organisasi <span class="required-star">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" name="nama_organisasi" id="nama_organisasi" placeholder=" ">
                                <label>Nama Organisasi/Ranting <span class="required-star">*</span></label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" name="jabatan" id="jabatan" placeholder=" ">
                                <label>Jabatan dalam Organisasi <span class="required-star">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="number" class="form-control" name="tahun_bergabung" id="tahun_bergabung" placeholder=" " min="2010" max="2025">
                                <label>Tahun Bergabung <span class="required-star">*</span></label>
                            </div>
                        </div>
                    </div>

                    <div class="form-floating">
                        <textarea class="form-control" name="riwayat_aktivitas" id="riwayat_aktivitas" placeholder=" " style="height: 150px"></textarea>
                        <label>Riwayat Aktivitas dalam Muhammadiyah <span class="required-star">*</span></label>
                    </div>

                    <div class="form-floating">
                        <textarea class="form-control" name="kontribusi" id="kontribusi" placeholder=" " style="height: 120px"></textarea>
                        <label>Kontribusi untuk Muhammadiyah <span class="required-star">*</span></label>
                    </div>

                    <div class="form-floating">
                        <textarea class="form-control" name="rencana_masa_depan" id="rencana_masa_depan" placeholder=" " style="height: 120px"></textarea>
                        <label>Rencana masa depan untuk Muhammadiyah <span class="required-star">*</span></label>
                    </div>
                </div>

                <!-- Data Ekonomi Keluarga -->
                <div class="form-section">
                    <h3 class="section-title">
                        <div class="section-icon">
                            <i class="fas fa-home"></i>
                        </div>
                        Data Ekonomi Keluarga <span class="required-star">*</span>
                    </h3>

                    <div class="form-info">
                        <i class="fas fa-users me-2"></i>
                        <strong>Penting:</strong> Data ekonomi keluarga akan digunakan untuk menilai kebutuhan beasiswa.
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" name="nama_ayah" placeholder=" " required>
                                <label>Nama Ayah <span class="required-star">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" name="pekerjaan_ayah" placeholder=" " required>
                                <label>Pekerjaan Ayah <span class="required-star">*</span></label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" name="nama_ibu" placeholder=" " required>
                                <label>Nama Ibu <span class="required-star">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" name="pekerjaan_ibu" placeholder=" " required>
                                <label>Pekerjaan Ibu <span class="required-star">*</span></label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="number" class="form-control" name="penghasilan_ayah" placeholder=" " min="0" required>
                                <label>Penghasilan Ayah (Rp/bulan) <span class="required-star">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="number" class="form-control" name="penghasilan_ibu" placeholder=" " min="0" required>
                                <label>Penghasilan Ibu (Rp/bulan) <span class="required-star">*</span></label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="number" class="form-control" name="jumlah_tanggungan" placeholder=" " min="1" required>
                                <label>Jumlah Tanggungan Keluarga <span class="required-star">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select class="form-select" name="status_rumah" required>
                                    <option value="">Pilih Status Rumah</option>
                                    <option value="Milik Sendiri">Milik Sendiri</option>
                                    <option value="Sewa">Sewa/Kontrak</option>
                                    <option value="Menumpang">Menumpang</option>
                                    <option value="Warisan">Warisan</option>
                                </select>
                                <label>Status Kepemilikan Rumah <span class="required-star">*</span></label>
                            </div>
                        </div>
                    </div>

                    <div class="form-floating">
                        <textarea class="form-control" name="kondisi_ekonomi" placeholder=" " style="height: 120px" required></textarea>
                        <label>Deskripsi Kondisi Ekonomi Keluarga <span class="required-star">*</span></label>
                    </div>
                </div>

                <!-- Upload Dokumen -->
                <div class="form-section">
                    <h3 class="section-title">
                        <div class="section-icon">
                            <i class="fas fa-upload"></i>
                        </div>
                        Upload Dokumen <span class="required-star">*</span>
                    </h3>

                    <div class="form-info">
                        <i class="fas fa-file-upload me-2"></i>
                        <strong>Perhatian:</strong> Format yang didukung: JPG, PNG, PDF. Pastikan file jelas dan dapat dibaca.
                    </div>

                    <!-- Dokumen Umum (Semua Kategori) -->
                    <h5 style="color: var(--secondary-color); font-weight: 600; margin: 2rem 0 1rem; border-bottom: 2px solid var(--secondary-color); padding-bottom: 0.5rem;">
                        <i class="fas fa-id-card me-2"></i>Dokumen Identitas
                    </h5>

                    <!-- KTP -->
                    <div class="upload-area">
                        <i class="fas fa-id-card fa-3x mb-3" style="color: var(--primary-color);"></i>
                        <h5>Upload KTP <span class="required-star">*</span></h5>
                        <p class="mb-3 text-muted">Format: JPG, PNG, PDF (Maks: 2MB)</p>
                        <input type="file" id="ktp" name="ktp" class="file-input" accept=".jpg,.jpeg,.png,.pdf" required>
                        <button type="button" class="upload-btn" onclick="document.getElementById('ktp').click()">
                            <i class="fas fa-cloud-upload-alt me-2"></i>Pilih File KTP
                        </button>
                        <div id="ktp-preview"></div>
                    </div>

                    <!-- Kartu Keluarga -->
                    <div class="upload-area">
                        <i class="fas fa-users fa-3x mb-3" style="color: var(--primary-color);"></i>
                        <h5>Upload Kartu Keluarga <span class="required-star">*</span></h5>
                        <p class="mb-3 text-muted">Format: JPG, PNG, PDF (Maks: 2MB)</p>
                        <input type="file" id="kk" name="kk" class="file-input" accept=".jpg,.jpeg,.png,.pdf" required>
                        <button type="button" class="upload-btn" onclick="document.getElementById('kk').click()">
                            <i class="fas fa-cloud-upload-alt me-2"></i>Pilih File KK
                        </button>
                        <div id="kk-preview"></div>
                    </div>

                    <h5 style="color: var(--secondary-color); font-weight: 600; margin: 2rem 0 1rem; border-bottom: 2px solid var(--secondary-color); padding-bottom: 0.5rem;">
                        <i class="fas fa-graduation-cap me-2"></i>Dokumen Akademik
                    </h5>

                    <!-- Transkrip -->
                    <div class="upload-area">
                        <i class="fas fa-file-alt fa-3x mb-3" style="color: var(--primary-color);"></i>
                        <h5>Upload Transkrip Nilai <span class="required-star">*</span></h5>
                        <p class="mb-3 text-muted">Format: PDF (Maks: 5MB)</p>
                        <input type="file" id="transkrip" name="transkrip" class="file-input" accept=".pdf" required>
                        <button type="button" class="upload-btn" onclick="document.getElementById('transkrip').click()">
                            <i class="fas fa-cloud-upload-alt me-2"></i>Pilih File Transkrip
                        </button>
                        <div id="transkrip-preview"></div>
                    </div>

                    <h5 style="color: var(--secondary-color); font-weight: 600; margin: 2rem 0 1rem; border-bottom: 2px solid var(--secondary-color); padding-bottom: 0.5rem;">
                        <i class="fas fa-money-check-alt me-2"></i>Dokumen Ekonomi
                    </h5>

                    <!-- Surat Penghasilan -->
                    <div class="upload-area">
                        <i class="fas fa-money-bill-wave fa-3x mb-3" style="color: var(--primary-color);"></i>
                        <h5>Upload Surat Keterangan Penghasilan <span class="required-star">*</span></h5>
                        <p class="mb-3 text-muted">Format: PDF (Maks: 3MB)</p>
                        <input type="file" id="surat_penghasilan" name="surat_penghasilan" class="file-input" accept=".pdf" required>
                        <button type="button" class="upload-btn" onclick="document.getElementById('surat_penghasilan').click()">
                            <i class="fas fa-cloud-upload-alt me-2"></i>Pilih File Surat
                        </button>
                        <div id="surat_penghasilan-preview"></div>
                    </div>

                    <!-- Slip Gaji Ortu -->
                    <div class="upload-area">
                        <i class="fas fa-receipt fa-3x mb-3" style="color: var(--primary-color);"></i>
                        <h5>Upload Slip Gaji Orang Tua <span class="required-star">*</span></h5>
                        <p class="mb-3 text-muted">Format: PDF, JPG, PNG (Maks: 2MB)</p>
                        <input type="file" id="slip_gaji_ortu" name="slip_gaji_ortu" class="file-input" accept=".pdf,.jpg,.jpeg,.png" required>
                        <button type="button" class="upload-btn" onclick="document.getElementById('slip_gaji_ortu').click()">
                            <i class="fas fa-cloud-upload-alt me-2"></i>Pilih File Slip Gaji
                        </button>
                        <div id="slip_gaji_ortu-preview"></div>
                    </div>

                    <!-- Surat Tidak Menerima Beasiswa -->
                    <div class="upload-area">
                        <i class="fas fa-file-contract fa-3x mb-3" style="color: var(--primary-color);"></i>
                        <h5>Upload Surat Tidak Menerima Beasiswa Lain <span class="required-star">*</span></h5>
                        <p class="mb-3 text-muted">Format: PDF, JPG, PNG (Maks: 2MB)</p>
                        <input type="file" id="surat_tidak_menerima_beasiswa" name="surat_tidak_menerima_beasiswa" class="file-input" accept=".pdf,.jpg,.jpeg,.png" required>
                        <button type="button" class="upload-btn" onclick="document.getElementById('surat_tidak_menerima_beasiswa').click()">
                            <i class="fas fa-cloud-upload-alt me-2"></i>Pilih File Surat
                        </button>
                        <div id="surat_tidak_menerima_beasiswa-preview"></div>
                    </div>

                    <!-- DOKUMEN KHUSUS DHUAFA -->
                    <div class="doc-dhuafa-only active">
                        <h5 style="color: var(--danger-color); font-weight: 600; margin: 2rem 0 1rem; border-bottom: 2px solid var(--danger-color); padding-bottom: 0.5rem;">
                            <i class="fas fa-hand-holding-heart me-2"></i>Dokumen Khusus Dhuafa
                        </h5>

                        <!-- Surat Tidak Mampu -->
                        <div class="upload-area">
                            <i class="fas fa-file-medical fa-3x mb-3" style="color: var(--primary-color);"></i>
                            <h5>Upload Surat Keterangan Tidak Mampu <span class="required-star">*</span></h5>
                            <p class="mb-3 text-muted">Format: PDF (Maks: 3MB)</p>
                            <input type="file" id="surat_tidak_mampu" name="surat_tidak_mampu" class="file-input" accept=".pdf">
                            <button type="button" class="upload-btn" onclick="document.getElementById('surat_tidak_mampu').click()">
                                <i class="fas fa-cloud-upload-alt me-2"></i>Pilih File SKTM
                            </button>
                            <div id="surat_tidak_mampu-preview"></div>
                        </div>
                    </div>

                    <!-- DOKUMEN KHUSUS KADER -->
                    <div class="doc-kader-only">
                        <h5 style="color: var(--success-color); font-weight: 600; margin: 2rem 0 1rem; border-bottom: 2px solid var(--success-color); padding-bottom: 0.5rem;">
                            <i class="fas fa-star-and-crescent me-2"></i>Dokumen Khusus Kader Muhammadiyah
                        </h5>

                        <!-- Surat Aktif Organisasi -->
                        <div class="upload-area">
                            <i class="fas fa-file-signature fa-3x mb-3" style="color: var(--primary-color);"></i>
                            <h5>Upload Surat Keterangan Aktif Organisasi <span class="required-star">*</span></h5>
                            <p class="mb-3 text-muted">Format: PDF (Maks: 3MB)</p>
                            <input type="file" id="surat_aktif_organisasi" name="surat_aktif_organisasi" class="file-input" accept=".pdf">
                            <button type="button" class="upload-btn" onclick="document.getElementById('surat_aktif_organisasi').click()">
                                <i class="fas fa-cloud-upload-alt me-2"></i>Pilih File Surat
                            </button>
                            <div id="surat_aktif_organisasi-preview"></div>
                        </div>

                        <!-- Sertifikat Prestasi -->
                        <div class="upload-area">
                            <i class="fas fa-certificate fa-3x mb-3" style="color: var(--secondary-color);"></i>
                            <h5>Upload Sertifikat/Piagam Prestasi</h5>
                            <p class="mb-3 text-muted">Format: PDF (Maks: 5MB) - Opsional</p>
                            <input type="file" id="sertifikat_prestasi" name="sertifikat_prestasi" class="file-input" accept=".pdf">
                            <button type="button" class="upload-btn" onclick="document.getElementById('sertifikat_prestasi').click()">
                                <i class="fas fa-cloud-upload-alt me-2"></i>Pilih File Sertifikat
                            </button>
                            <div id="sertifikat_prestasi-preview"></div>
                        </div>

                        <!-- Surat Rekomendasi -->
                        <div class="upload-area">
                            <i class="fas fa-file-signature fa-3x mb-3" style="color: var(--primary-color);"></i>
                            <h5>Upload Surat Rekomendasi <span class="required-star">*</span></h5>
                            <p class="mb-3 text-muted">Format: PDF (Maks: 2MB)</p>
                            <input type="file" id="surat_rekomendasi" name="surat_rekomendasi" class="file-input" accept=".pdf">
                            <button type="button" class="upload-btn" onclick="document.getElementById('surat_rekomendasi').click()">
                                <i class="fas fa-cloud-upload-alt me-2"></i>Pilih File Surat
                            </button>
                            <div id="surat_rekomendasi-preview"></div>
                        </div>

                        <!-- KTAM -->
                        <div class="upload-area">
                            <i class="fas fa-id-card-alt fa-3x mb-3" style="color: var(--primary-color);"></i>
                            <h5>Upload KTAM (Kartu Tanda Anggota Muhammadiyah) <span class="required-star">*</span></h5>
                            <p class="mb-3 text-muted">Format: JPG, PNG (Maks: 2MB)</p>
                            <input type="file" id="ktam" name="ktam" class="file-input" accept=".jpg,.jpeg,.png">
                            <button type="button" class="upload-btn" onclick="document.getElementById('ktam').click()">
                                <i class="fas fa-cloud-upload-alt me-2"></i>Pilih Foto KTAM
                            </button>
                            <div id="ktam-preview"></div>
                        </div>
                    </div>

                    <h5 style="color: var(--secondary-color); font-weight: 600; margin: 2rem 0 1rem; border-bottom: 2px solid var(--secondary-color); padding-bottom: 0.5rem;">
                        <i class="fas fa-home me-2"></i>Foto Kondisi Rumah
                    </h5>

                    <!-- Foto Rumah Depan -->
                    <div class="upload-area">
                        <i class="fas fa-home fa-3x mb-3" style="color: var(--primary-color);"></i>
                        <h5>Upload Foto Rumah Tampak Depan <span class="required-star">*</span></h5>
                        <p class="mb-3 text-muted">Format: JPG, PNG (Maks: 2MB)</p>
                        <input type="file" id="foto_rumah_depan" name="foto_rumah_depan" class="file-input" accept=".jpg,.jpeg,.png" required>
                        <button type="button" class="upload-btn" onclick="document.getElementById('foto_rumah_depan').click()">
                            <i class="fas fa-cloud-upload-alt me-2"></i>Pilih Foto
                        </button>
                        <div id="foto_rumah_depan-preview"></div>
                    </div>

                    <!-- Foto Rumah Samping -->
                    <div class="upload-area">
                        <i class="fas fa-home fa-3x mb-3" style="color: var(--primary-color);"></i>
                        <h5>Upload Foto Rumah Tampak Samping <span class="required-star">*</span></h5>
                        <p class="mb-3 text-muted">Format: JPG, PNG (Maks: 2MB)</p>
                        <input type="file" id="foto_rumah_samping" name="foto_rumah_samping" class="file-input" accept=".jpg,.jpeg,.png" required>
                        <button type="button" class="upload-btn" onclick="document.getElementById('foto_rumah_samping').click()">
                            <i class="fas fa-cloud-upload-alt me-2"></i>Pilih Foto
                        </button>
                        <div id="foto_rumah_samping-preview"></div>
                    </div>

                    <!-- Foto Ruang Tamu -->
                    <div class="upload-area">
                        <i class="fas fa-couch fa-3x mb-3" style="color: var(--primary-color);"></i>
                        <h5>Upload Foto Ruang Tamu <span class="required-star">*</span></h5>
                        <p class="mb-3 text-muted">Format: JPG, PNG (Maks: 2MB)</p>
                        <input type="file" id="foto_ruang_tamu" name="foto_ruang_tamu" class="file-input" accept=".jpg,.jpeg,.png" required>
                        <button type="button" class="upload-btn" onclick="document.getElementById('foto_ruang_tamu').click()">
                            <i class="fas fa-cloud-upload-alt me-2"></i>Pilih Foto
                        </button>
                        <div id="foto_ruang_tamu-preview"></div>
                    </div>

                    <!-- Foto Kamar Mandi -->
                    <div class="upload-area">
                        <i class="fas fa-bath fa-3x mb-3" style="color: var(--primary-color);"></i>
                        <h5>Upload Foto Kamar Mandi <span class="required-star">*</span></h5>
                        <p class="mb-3 text-muted">Format: JPG, PNG (Maks: 2MB)</p>
                        <input type="file" id="foto_kamar_mandi" name="foto_kamar_mandi" class="file-input" accept=".jpg,.jpeg,.png" required>
                        <button type="button" class="upload-btn" onclick="document.getElementById('foto_kamar_mandi').click()">
                            <i class="fas fa-cloud-upload-alt me-2"></i>Pilih Foto
                        </button>
                        <div id="foto_kamar_mandi-preview"></div>
                    </div>

                    <!-- Foto Dapur -->
                    <div class="upload-area">
                        <i class="fas fa-utensils fa-3x mb-3" style="color: var(--primary-color);"></i>
                        <h5>Upload Foto Dapur <span class="required-star">*</span></h5>
                        <p class="mb-3 text-muted">Format: JPG, PNG (Maks: 2MB)</p>
                        <input type="file" id="foto_dapur" name="foto_dapur" class="file-input" accept=".jpg,.jpeg,.png" required>
                        <button type="button" class="upload-btn" onclick="document.getElementById('foto_dapur').click()">
                            <i class="fas fa-cloud-upload-alt me-2"></i>Pilih Foto
                        </button>
                        <div id="foto_dapur-preview"></div>
                    </div>

                    <h5 style="color: var(--secondary-color); font-weight: 600; margin: 2rem 0 1rem; border-bottom: 2px solid var(--secondary-color); padding-bottom: 0.5rem;">
                        <i class="fas fa-file-alt me-2"></i>Dokumen Pendukung Lainnya
                    </h5>

                    <!-- CV -->
                    <div class="upload-area">
                        <i class="fas fa-file-alt fa-3x mb-3" style="color: var(--primary-color);"></i>
                        <h5>Upload CV (Curriculum Vitae) <span class="required-star">*</span></h5>
                        <p class="mb-3 text-muted">Format: PDF, DOC, DOCX (Maks: 2MB)</p>
                        <input type="file" id="cv" name="cv" class="file-input" accept=".pdf,.doc,.docx" required>
                        <button type="button" class="upload-btn" onclick="document.getElementById('cv').click()">
                            <i class="fas fa-cloud-upload-alt me-2"></i>Pilih File CV
                        </button>
                        <div id="cv-preview"></div>
                    </div>

                    <!-- Pas Foto -->
                    <div class="upload-area">
                        <i class="fas fa-portrait fa-3x mb-3" style="color: var(--primary-color);"></i>
                        <h5>Upload Pas Foto 3x4 <span class="required-star">*</span></h5>
                        <p class="mb-3 text-muted">Format: JPG, PNG (Maks: 2MB)</p>
                        <input type="file" id="pas_foto" name="pas_foto" class="file-input" accept=".jpg,.jpeg,.png" required>
                        <button type="button" class="upload-btn" onclick="document.getElementById('pas_foto').click()">
                            <i class="fas fa-cloud-upload-alt me-2"></i>Pilih Pas Foto
                        </button>
                        <div id="pas_foto-preview"></div>
                    </div>

                    <!-- Motivation Letter -->
                    <div class="upload-area">
                        <i class="fas fa-envelope-open-text fa-3x mb-3" style="color: var(--primary-color);"></i>
                        <h5>Upload Motivation Letter <span class="required-star">*</span></h5>
                        <p class="mb-3 text-muted">Format: PDF, DOC, DOCX (Maks: 2MB)</p>
                        <input type="file" id="motivation_letter" name="motivation_letter" class="file-input" accept=".pdf,.doc,.docx" required>
                        <button type="button" class="upload-btn" onclick="document.getElementById('motivation_letter').click()">
                            <i class="fas fa-cloud-upload-alt me-2"></i>Pilih File
                        </button>
                        <div id="motivation_letter-preview"></div>
                    </div>

                    <!-- KTM -->
                    <div class="upload-area">
                        <i class="fas fa-id-badge fa-3x mb-3" style="color: var(--primary-color);"></i>
                        <h5>Upload Kartu Tanda Mahasiswa (KTM) <span class="required-star">*</span></h5>
                        <p class="mb-3 text-muted">Format: JPG, PNG (Maks: 2MB)</p>
                        <input type="file" id="ktm" name="ktm" class="file-input" accept=".jpg,.jpeg,.png" required>
                        <button type="button" class="upload-btn" onclick="document.getElementById('ktm').click()">
                            <i class="fas fa-cloud-upload-alt me-2"></i>Pilih File KTM
                        </button>
                        <div id="ktm-preview"></div>
                    </div>

                    <!-- Twibbon -->
                    <div class="upload-area">
                        <i class="fas fa-image fa-3x mb-3" style="color: var(--primary-color);"></i>
                        <h5>Upload Twibbon <span class="required-star">*</span></h5>
                        <p class="mb-3 text-muted">Format: JPG, PNG (Maks: 2MB)</p>
                        <input type="file" id="twibbon" name="twibbon" class="file-input" accept=".jpg,.jpeg,.png" required>
                        <button type="button" class="upload-btn" onclick="document.getElementById('twibbon').click()">
                            <i class="fas fa-cloud-upload-alt me-2"></i>Pilih File Twibbon
                        </button>
                        <div id="twibbon-preview"></div>
                    </div>

                    <!-- Surat Kesanggupan Relawan -->
                    <div class="upload-area">
                        <i class="fas fa-hands-helping fa-3x mb-3" style="color: var(--primary-color);"></i>
                        <h5>Upload Surat Kesanggupan Relawan <span class="required-star">*</span></h5>
                        <p class="mb-3 text-muted">Format: PDF, JPG, PNG (Maks: 2MB)</p>
                        <input type="file" id="surat_kesanggupan_relawan" name="surat_kesanggupan_relawan" class="file-input" accept=".pdf,.jpg,.jpeg,.png" required>
                        <button type="button" class="upload-btn" onclick="document.getElementById('surat_kesanggupan_relawan').click()">
                            <i class="fas fa-cloud-upload-alt me-2"></i>Pilih File Surat
                        </button>
                        <div id="surat_kesanggupan_relawan-preview"></div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="form-section" style="text-align: center;">
                    <button type="submit" class="btn-submit">
                        <i class="fas fa-paper-plane me-2"></i>Simpan Data Pendaftar
                    </button>
                </div>

            </div>
        </form>
    </div>
</div>

<script>
// Toggle kategori
document.addEventListener('DOMContentLoaded', function() {
    const cardDhuafa = document.getElementById('card-dhuafa');
    const cardKader = document.getElementById('card-kader');
    const radioDhuafa = document.querySelector('input[value="dhuafa"]');
    const radioKader = document.querySelector('input[value="kader"]');
    const hiddenInput = document.getElementById('jenis_pendaftaran');
    
    const sectionOrganisasi = document.getElementById('section-organisasi');
    const docDhuafa = document.querySelector('.doc-dhuafa-only');
    const docKader = document.querySelector('.doc-kader-only');
    
    // Fields organisasi kader
    const fieldsKader = ['jenis_organisasi', 'nama_organisasi', 'jabatan', 'tahun_bergabung', 'riwayat_aktivitas', 'kontribusi', 'rencana_masa_depan'];
    const filesKader = ['surat_aktif_organisasi', 'surat_rekomendasi', 'ktam'];
    const filesDhuafa = ['surat_tidak_mampu'];
    
    function toggleKategori(jenis) {
        hiddenInput.value = jenis;
        
        if (jenis === 'kader') {
            // Visual
            cardKader.classList.add('active');
            cardDhuafa.classList.remove('active');
            
            // Show/Hide sections
            sectionOrganisasi.classList.add('active');
            docKader.classList.add('active');
            docDhuafa.classList.remove('active');
            
            // Set required untuk field kader
            fieldsKader.forEach(id => {
                const field = document.getElementById(id);
                if (field) field.setAttribute('required', 'required');
            });
            
            filesKader.forEach(id => {
                const field = document.getElementById(id);
                if (field) field.setAttribute('required', 'required');
            });
            
            // Remove required dari dhuafa
            filesDhuafa.forEach(id => {
                const field = document.getElementById(id);
                if (field) field.removeAttribute('required');
            });
            
        } else {
            // Visual
            cardDhuafa.classList.add('active');
            cardKader.classList.remove('active');
            
            // Show/Hide sections
            sectionOrganisasi.classList.remove('active');
            docKader.classList.remove('active');
            docDhuafa.classList.add('active');
            
            // Remove required dari field kader
            fieldsKader.forEach(id => {
                const field = document.getElementById(id);
                if (field) field.removeAttribute('required');
            });
            
            filesKader.forEach(id => {
                const field = document.getElementById(id);
                if (field) field.removeAttribute('required');
            });
            
            // Set required untuk dhuafa
            filesDhuafa.forEach(id => {
                const field = document.getElementById(id);
                if (field) field.setAttribute('required', 'required');
            });
        }
    }
    
    // Event listeners
    cardDhuafa.addEventListener('click', function() {
        radioDhuafa.checked = true;
        toggleKategori('dhuafa');
    });
    
    cardKader.addEventListener('click', function() {
        radioKader.checked = true;
        toggleKategori('kader');
    });
    
    // Initialize
    toggleKategori('dhuafa');
    
    // File upload preview
    const fileInputs = document.querySelectorAll('.file-input');
    fileInputs.forEach(input => {
        input.addEventListener('change', function(e) {
            const file = e.target.files[0];
            const previewDiv = document.getElementById(this.id + '-preview');
            
            if (file) {
                const fileSize = file.size / 1024 / 1024;
                const maxSize = 5;
                
                if (fileSize > maxSize) {
                    alert(`File terlalu besar. Maksimal ${maxSize}MB`);
                    this.value = '';
                    return;
                }
                
                previewDiv.innerHTML = `
                    <div class="file-preview">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-file me-3 text-success"></i>
                            <div class="flex-grow-1">
                                <div style="font-weight: 600; color: var(--primary-color);">${file.name}</div>
                                <small class="text-muted">${(fileSize).toFixed(2)} MB</small>
                            </div>
                            <div style="color: var(--success-color);">
                                <i class="fas fa-check-circle"></i>
                            </div>
                        </div>
                    </div>
                `;
            }
        });
    });
});
</script>

@endsection