@extends('layouts.admin')

@section('title', 'Edit Pendaftar Beasiswa')

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

    /* ===== LAYOUT ===== */
    .create-container {
        padding: 20px;
        background-color: #f8f9fa;
        min-height: 100vh;
    }

    .main-container {
        background: white;
        border-radius: 16px;
        box-shadow: 0 4px 24px rgba(0,0,0,0.08);
        overflow: hidden;
        margin: 0 auto;
        max-width: 1000px;
    }

    /* ===== HEADER ===== */
    .header-section {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        color: white;
        padding: 1.5rem 2rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .header-section h1 {
        font-size: 1.4rem;
        font-weight: 700;
        margin: 0;
    }

    .header-section p {
        margin: 4px 0 0;
        font-size: 0.9rem;
        opacity: 0.85;
    }

    .btn-back {
        background: rgba(255,255,255,0.2);
        color: white;
        padding: 8px 16px;
        border-radius: 20px;
        border: 1px solid rgba(255,255,255,0.4);
        font-weight: 600;
        font-size: 0.85rem;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: all 0.2s ease;
        white-space: nowrap;
    }

    .btn-back:hover {
        background: rgba(255,255,255,0.35);
        color: white;
        text-decoration: none;
    }

    /* ===== KATEGORI SELECTOR ===== */
    .kategori-selector {
        padding: 1.5rem 2rem;
        border-bottom: 1px solid #f0f0f0;
        background: #fafafa;
    }

    .kategori-selector h3 {
        color: var(--primary-color);
        font-weight: 700;
        font-size: 1rem;
        margin-bottom: 1rem;
    }

    .kategori-options {
        display: flex;
        gap: 1rem;
    }

    .kategori-card {
        flex: 1;
        border: 2px solid #e9ecef;
        border-radius: 12px;
        padding: 1rem 1.25rem;
        cursor: pointer;
        transition: all 0.25s ease;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .kategori-card:hover {
        border-color: var(--primary-color);
        background: rgba(255,107,53,0.03);
    }

    .kategori-card input[type="radio"] {
        display: none;
    }

    .kategori-card.active {
        border-color: var(--primary-color);
        background: rgba(255,107,53,0.06);
    }

    .kategori-emoji {
        font-size: 2rem;
        line-height: 1;
    }

    .kategori-info .kategori-title {
        font-size: 1rem;
        font-weight: 700;
        color: #212529;
        margin-bottom: 2px;
    }

    .kategori-info .kategori-desc {
        color: #6c757d;
        font-size: 0.8rem;
    }

    /* ===== FORM CONTENT ===== */
    .form-content {
        padding: 1.5rem 2rem;
    }

    /* ===== FORM SECTION ===== */
    .form-section {
        background: #f8f9fa;
        border-radius: 12px;
        padding: 1.25rem 1.5rem;
        margin-bottom: 1.25rem;
        border-left: 4px solid var(--primary-color);
    }

    .section-title {
        color: var(--primary-color);
        font-weight: 700;
        font-size: 1rem;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .section-icon {
        width: 36px;
        height: 36px;
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1rem;
        flex-shrink: 0;
    }

    /* ===== FORM FLOATING ===== */
    .form-floating {
        position: relative;
        margin-bottom: 1rem;
    }

    .form-floating input,
    .form-floating select,
    .form-floating textarea {
        border: 2px solid #e9ecef;
        border-radius: 10px;
        padding: 0.85rem 1rem;
        font-size: 0.9rem;
        transition: all 0.25s ease;
        background: white;
        width: 100%;
    }

    .form-floating select {
        background-color: white;
    }

    .form-floating input:focus,
    .form-floating select:focus,
    .form-floating textarea:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(255,107,53,0.12);
        outline: none;
    }

    .form-floating label {
        padding: 0 0.4rem;
        color: #6c757d;
        font-weight: 500;
        font-size: 0.85rem;
        position: absolute;
        top: 0.9rem;
        left: 1rem;
        pointer-events: none;
        transition: all 0.25s ease;
        background: transparent;
    }

    .form-floating input:focus + label,
    .form-floating input:not(:placeholder-shown) + label,
    .form-floating select:focus + label,
    .form-floating textarea:focus + label,
    .form-floating textarea:not(:placeholder-shown) + label {
        top: -0.5rem;
        left: 0.85rem;
        font-size: 0.75rem;
        color: var(--primary-color);
        background: white;
        padding: 0 0.4rem;
    }

    .form-floating select + label {
        top: -0.5rem;
        left: 0.85rem;
        font-size: 0.75rem;
        color: var(--primary-color);
        background: white;
        padding: 0 0.4rem;
    }

    /* ===== FORM INFO ===== */
    .form-info {
        background: rgba(23,162,184,0.08);
        border-left: 3px solid var(--info-color);
        padding: 0.65rem 1rem;
        border-radius: 6px;
        margin-bottom: 1rem;
        color: #0c5460;
        font-size: 0.85rem;
    }

    /* ===== REQUIRED ===== */
    .required-star {
        color: var(--accent-color);
    }

    /* ===== SECTION KADER/DHUAFA ===== */
    .section-kader-only { display: none; }
    .section-kader-only.active { display: block; }
    .doc-dhuafa-only { display: none; }
    .doc-dhuafa-only.active { display: block; }
    .doc-kader-only { display: none; }
    .doc-kader-only.active { display: block; }

    /* ===== DOKUMEN SECTION — COMPACT ===== */
    .doc-section-title {
        font-size: 0.85rem;
        font-weight: 700;
        color: #495057;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 0.6rem 0;
        margin: 1rem 0 0.75rem;
        border-bottom: 2px solid var(--secondary-color);
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .doc-section-title i {
        color: var(--secondary-color);
    }

    /* ===== ACCORDION DOC GROUP ===== */
    .doc-accordion {
        border: 1px solid #e9ecef;
        border-radius: 10px;
        overflow: hidden;
        margin-bottom: 0.75rem;
    }

    .doc-accordion-header {
        background: white;
        padding: 0.85rem 1.25rem;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: space-between;
        transition: background 0.2s ease;
        user-select: none;
    }

    .doc-accordion-header:hover {
        background: rgba(255,107,53,0.04);
    }

    .doc-accordion-header.open {
        background: rgba(255,107,53,0.06);
        border-bottom: 1px solid #f0f0f0;
    }

    .doc-accordion-left {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .doc-accordion-icon {
        width: 32px;
        height: 32px;
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 0.85rem;
        flex-shrink: 0;
    }

    .doc-accordion-label {
        font-weight: 600;
        color: #212529;
        font-size: 0.9rem;
    }

    .doc-accordion-meta {
        font-size: 0.75rem;
        color: #6c757d;
        margin-top: 1px;
    }

    .doc-accordion-badges {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .badge-uploaded {
        background: rgba(40,167,69,0.1);
        color: var(--success-color);
        border: 1px solid rgba(40,167,69,0.2);
        padding: 2px 8px;
        border-radius: 10px;
        font-size: 0.72rem;
        font-weight: 600;
    }

    .badge-empty {
        background: rgba(108,117,125,0.1);
        color: #6c757d;
        border: 1px solid rgba(108,117,125,0.2);
        padding: 2px 8px;
        border-radius: 10px;
        font-size: 0.72rem;
        font-weight: 600;
    }

    .badge-required {
        background: rgba(220,53,69,0.1);
        color: var(--accent-color);
        border: 1px solid rgba(220,53,69,0.2);
        padding: 2px 8px;
        border-radius: 10px;
        font-size: 0.72rem;
        font-weight: 600;
    }

    .chevron {
        color: #adb5bd;
        transition: transform 0.25s ease;
        font-size: 0.8rem;
    }

    .chevron.open {
        transform: rotate(180deg);
    }

    .doc-accordion-body {
        display: none;
        padding: 1rem 1.25rem;
        background: #fafafa;
    }

    .doc-accordion-body.open {
        display: block;
    }

    /* ===== FILE UPLOAD COMPACT ===== */
    .upload-compact {
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
    }

    .current-file-compact {
        background: rgba(40,167,69,0.08);
        border: 1px solid rgba(40,167,69,0.25);
        border-radius: 8px;
        padding: 0.6rem 1rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 8px;
    }

    .current-file-info {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 0.82rem;
        color: #155724;
        font-weight: 500;
        overflow: hidden;
    }

    .current-file-info span {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 260px;
    }

    .file-actions {
        display: flex;
        gap: 6px;
        flex-shrink: 0;
    }

    .btn-view, .btn-download {
        padding: 3px 10px;
        border-radius: 6px;
        border: none;
        font-size: 0.75rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }

    .btn-view {
        background: var(--info-color);
        color: white;
    }

    .btn-view:hover { background: #138496; color: white; }

    .btn-download {
        background: var(--success-color);
        color: white;
    }

    .btn-download:hover { background: #218838; color: white; }

    .upload-row {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .file-input { display: none; }

    .upload-btn-compact {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        border: none;
        color: white;
        padding: 0.5rem 1.1rem;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.8rem;
        transition: all 0.25s ease;
        cursor: pointer;
        white-space: nowrap;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .upload-btn-compact:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(255,107,53,0.3);
    }

    .upload-hint {
        font-size: 0.75rem;
        color: #adb5bd;
    }

    .file-preview-compact {
        background: white;
        border: 1px solid rgba(40,167,69,0.3);
        border-radius: 8px;
        padding: 0.5rem 1rem;
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 0.82rem;
        color: var(--success-color);
        font-weight: 500;
    }

    /* ===== DOC GRID (untuk 2-kolom pada layar besar) ===== */
    .doc-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 0.75rem;
    }

    @media (max-width: 640px) {
        .doc-grid { grid-template-columns: 1fr; }
        .kategori-options { flex-direction: column; }
        .header-section { flex-direction: column; gap: 12px; text-align: center; }
    }

    /* ===== SUBMIT ===== */
    .btn-submit {
        background: linear-gradient(135deg, var(--success-color), #20c997);
        color: white;
        padding: 0.9rem 3rem;
        border-radius: 25px;
        border: none;
        font-weight: 700;
        font-size: 1rem;
        transition: all 0.3s ease;
        cursor: pointer;
        display: block;
        width: 100%;
        margin-top: 1.5rem;
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(40,167,69,0.3);
    }

    /* ===== PROGRESS BAR DOKUMEN ===== */
    .doc-progress-wrap {
        background: #e9ecef;
        border-radius: 6px;
        height: 6px;
        margin-top: 4px;
        overflow: hidden;
    }

    .doc-progress-bar {
        height: 100%;
        background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
        border-radius: 6px;
        transition: width 0.3s ease;
    }

    .doc-progress-label {
        font-size: 0.72rem;
        color: #6c757d;
        margin-top: 3px;
    }
</style>

<div class="create-container">
    <div class="main-container">

        <!-- Header -->
        <div class="header-section">
            <div>
                <h1><i class="fas fa-edit me-2"></i>Edit Data Pendaftar</h1>
                <p>{{ $alternatif->nama }} &mdash; LAZISMU</p>
            </div>
            <a href="{{ route('admin.pendaftar.index') }}" class="btn-back">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>

        <!-- Alert Errors -->
        @if($errors->any())
        <div class="alert alert-danger mx-4 mt-3">
            <strong>Terjadi kesalahan:</strong>
            <ul class="mb-0 mt-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        @if(session('success'))
        <div class="alert alert-success mx-4 mt-3">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
        @endif

        <!-- Kategori Selector -->
        <div class="kategori-selector">
            <h3><i class="fas fa-clipboard-list me-2"></i>Jenis Pendaftaran</h3>
            <div class="kategori-options">
                <label class="kategori-card" id="card-dhuafa">
                    <input type="radio" name="jenis_pendaftaran_display" value="dhuafa"
                        {{ old('jenis_pendaftaran', $alternatif->jenis_pendaftaran) == 'dhuafa' ? 'checked' : '' }}>
                    <div class="kategori-emoji">📋</div>
                    <div class="kategori-info">
                        <div class="kategori-title">Beasiswa Dhuafa</div>
                        <div class="kategori-desc">Mahasiswa dari keluarga kurang mampu</div>
                    </div>
                </label>
                <label class="kategori-card" id="card-kader">
                    <input type="radio" name="jenis_pendaftaran_display" value="kader"
                        {{ old('jenis_pendaftaran', $alternatif->jenis_pendaftaran) == 'kader' ? 'checked' : '' }}>
                    <div class="kategori-emoji">🎓</div>
                    <div class="kategori-info">
                        <div class="kategori-title">Beasiswa Kader</div>
                        <div class="kategori-desc">Kader aktif Muhammadiyah</div>
                    </div>
                </label>
            </div>
        </div>

        <!-- FORM -->
        <form id="editForm" action="{{ route('admin.alternatif.update', $alternatif->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" name="jenis_pendaftaran" id="jenis_pendaftaran" value="{{ old('jenis_pendaftaran', $alternatif->jenis_pendaftaran) }}">

            <div class="form-content">

                <!-- ===== DATA PRIBADI ===== -->
                <div class="form-section">
                    <h3 class="section-title">
                        <div class="section-icon"><i class="fas fa-user"></i></div>
                        Data Pribadi
                    </h3>
                    <div class="form-info"><i class="fas fa-info-circle me-1"></i> Pastikan data sesuai dokumen resmi.</div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" name="nama" placeholder=" " value="{{ old('nama', $alternatif->nama) }}" required>
                                <label>Nama Lengkap <span class="required-star">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" name="nik" placeholder=" " maxlength="16" value="{{ old('nik', $alternatif->nik) }}" required>
                                <label>NIK <span class="required-star">*</span></label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" name="tempat_lahir" placeholder=" " value="{{ old('tempat_lahir', $alternatif->tempat_lahir) }}" required>
                                <label>Tempat Lahir <span class="required-star">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="date" class="form-control" name="tanggal_lahir" placeholder=" " value="{{ old('tanggal_lahir', $alternatif->tanggal_lahir) }}" required>
                                <label>Tanggal Lahir <span class="required-star">*</span></label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select class="form-select" name="jenis_kelamin" required>
                                    <option value="">Pilih Jenis Kelamin</option>
                                    <option value="L" {{ old('jenis_kelamin', $alternatif->jenis_kelamin) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="P" {{ old('jenis_kelamin', $alternatif->jenis_kelamin) == 'P' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                                <label>Jenis Kelamin <span class="required-star">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="tel" class="form-control" name="no_telepon" placeholder=" " value="{{ old('no_telepon', $alternatif->no_telepon) }}" required>
                                <label>Nomor Telepon <span class="required-star">*</span></label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="email" class="form-control" name="email" placeholder=" " value="{{ old('email', $alternatif->email) }}" required>
                                <label>Email <span class="required-star">*</span></label>
                            </div>
                        </div>
                    </div>
                    <div class="form-floating">
                        <textarea class="form-control" name="alamat" placeholder=" " style="height: 90px" required>{{ old('alamat', $alternatif->alamat) }}</textarea>
                        <label>Alamat Lengkap <span class="required-star">*</span></label>
                    </div>
                </div>

                <!-- ===== DATA AKADEMIK ===== -->
                <div class="form-section">
                    <h3 class="section-title">
                        <div class="section-icon"><i class="fas fa-graduation-cap"></i></div>
                        Data Akademik
                    </h3>
                    <div class="form-floating">
                        <input type="text" class="form-control" name="asal_kampus" placeholder=" " value="{{ old('asal_kampus', $alternatif->asal_kampus) }}" required>
                        <label>Asal Kampus/Universitas <span class="required-star">*</span></label>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" name="nim" placeholder=" " value="{{ old('nim', $alternatif->nim) }}" required>
                                <label>NIM <span class="required-star">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select class="form-select" name="semester" required>
                                    <option value="">Pilih Semester</option>
                                    @for($i = 1; $i <= 8; $i++)
                                    <option value="{{ $i }}" {{ old('semester', $alternatif->semester) == $i ? 'selected' : '' }}>Semester {{ $i }}</option>
                                    @endfor
                                </select>
                                <label>Semester <span class="required-star">*</span></label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" name="fakultas" placeholder=" " value="{{ old('fakultas', $alternatif->fakultas) }}" required>
                                <label>Fakultas <span class="required-star">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" name="jurusan" placeholder=" " value="{{ old('jurusan', $alternatif->jurusan) }}" required>
                                <label>Program Studi <span class="required-star">*</span></label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="number" class="form-control" name="ipk" placeholder=" " step="0.01" min="0" max="4" value="{{ old('ipk', $alternatif->ipk) }}" required>
                                <label>IPK <span class="required-star">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="number" class="form-control" name="tahun_masuk" placeholder=" " min="2015" max="{{ date('Y') + 1 }}" value="{{ old('tahun_masuk', $alternatif->tahun_masuk) }}" required>
                                <label>Tahun Masuk <span class="required-star">*</span></label>
                            </div>
                        </div>
                    </div>
                    <div class="form-floating">
                        <textarea class="form-control" name="prestasi" placeholder=" " style="height: 80px">{{ old('prestasi', $alternatif->prestasi) }}</textarea>
                        <label>Prestasi (Opsional)</label>
                    </div>
                </div>

                <!-- ===== DATA ORGANISASI (KADER ONLY) ===== -->
                <div class="form-section section-kader-only" id="section-organisasi">
                    <h3 class="section-title">
                        <div class="section-icon"><i class="fas fa-users-cog"></i></div>
                        Data Organisasi Muhammadiyah
                    </h3>
                    <div class="form-info"><i class="fas fa-mosque me-1"></i> Khusus kader Muhammadiyah aktif.</div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select class="form-select" name="jenis_organisasi" id="jenis_organisasi">
                                    <option value="">Pilih Jenis Organisasi</option>
                                    @foreach(['Ranting Muhammadiyah','Ranting Aisyiyah','IPM','IMM','Pemuda Muhammadiyah','Nasyiatul Aisyiyah','Kokam','HW','Tapak Suci'] as $org)
                                    <option value="{{ $org }}" {{ old('jenis_organisasi', $alternatif->jenis_organisasi) == $org ? 'selected' : '' }}>{{ $org }}</option>
                                    @endforeach
                                </select>
                                <label>Jenis Organisasi <span class="required-star">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" name="nama_organisasi" id="nama_organisasi" placeholder=" " value="{{ old('nama_organisasi', $alternatif->nama_organisasi) }}">
                                <label>Nama Organisasi/Ranting <span class="required-star">*</span></label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" name="jabatan" id="jabatan" placeholder=" " value="{{ old('jabatan', $alternatif->jabatan) }}">
                                <label>Jabatan <span class="required-star">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="number" class="form-control" name="tahun_bergabung" id="tahun_bergabung" placeholder=" " min="2015" max="{{ date('Y') + 1 }}" value="{{ old('tahun_bergabung', $alternatif->tahun_bergabung) }}">
                                <label>Tahun Bergabung <span class="required-star">*</span></label>
                            </div>
                        </div>
                    </div>
                    <div class="form-floating">
                        <textarea class="form-control" name="riwayat_aktivitas" id="riwayat_aktivitas" placeholder=" " style="height: 90px">{{ old('riwayat_aktivitas', $alternatif->riwayat_aktivitas) }}</textarea>
                        <label>Riwayat Aktivitas <span class="required-star">*</span></label>
                    </div>
                    <div class="form-floating">
                        <textarea class="form-control" name="kontribusi" id="kontribusi" placeholder=" " style="height: 80px">{{ old('kontribusi', $alternatif->kontribusi) }}</textarea>
                        <label>Kontribusi untuk Muhammadiyah <span class="required-star">*</span></label>
                    </div>
                    <div class="form-floating">
                        <textarea class="form-control" name="rencana_masa_depan" id="rencana_masa_depan" placeholder=" " style="height: 80px">{{ old('rencana_masa_depan', $alternatif->rencana_masa_depan) }}</textarea>
                        <label>Rencana Masa Depan <span class="required-star">*</span></label>
                    </div>
                </div>

                <!-- ===== DATA EKONOMI ===== -->
                <div class="form-section">
                    <h3 class="section-title">
                        <div class="section-icon"><i class="fas fa-home"></i></div>
                        Data Ekonomi Keluarga
                    </h3>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" name="nama_ayah" placeholder=" " value="{{ old('nama_ayah', $alternatif->nama_ayah) }}" required>
                                <label>Nama Ayah <span class="required-star">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" name="pekerjaan_ayah" placeholder=" " value="{{ old('pekerjaan_ayah', $alternatif->pekerjaan_ayah) }}" required>
                                <label>Pekerjaan Ayah <span class="required-star">*</span></label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" name="nama_ibu" placeholder=" " value="{{ old('nama_ibu', $alternatif->nama_ibu) }}" required>
                                <label>Nama Ibu <span class="required-star">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" name="pekerjaan_ibu" placeholder=" " value="{{ old('pekerjaan_ibu', $alternatif->pekerjaan_ibu) }}" required>
                                <label>Pekerjaan Ibu <span class="required-star">*</span></label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="number" class="form-control" name="penghasilan_ayah" placeholder=" " min="0" value="{{ old('penghasilan_ayah', $alternatif->penghasilan_ayah) }}" required>
                                <label>Penghasilan Ayah (Rp/bln) <span class="required-star">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="number" class="form-control" name="penghasilan_ibu" placeholder=" " min="0" value="{{ old('penghasilan_ibu', $alternatif->penghasilan_ibu) }}" required>
                                <label>Penghasilan Ibu (Rp/bln) <span class="required-star">*</span></label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="number" class="form-control" name="jumlah_tanggungan" placeholder=" " min="1" value="{{ old('jumlah_tanggungan', $alternatif->jumlah_tanggungan) }}" required>
                                <label>Jumlah Tanggungan <span class="required-star">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select class="form-select" name="status_rumah" required>
                                    <option value="">Pilih Status Rumah</option>
                                    @foreach(['Milik Sendiri','Sewa','Menumpang','Warisan'] as $sr)
                                    <option value="{{ $sr }}" {{ old('status_rumah', $alternatif->status_rumah) == $sr ? 'selected' : '' }}>{{ $sr }}</option>
                                    @endforeach
                                </select>
                                <label>Status Rumah <span class="required-star">*</span></label>
                            </div>
                        </div>
                    </div>
                    <div class="form-floating">
                        <textarea class="form-control" name="kondisi_ekonomi" placeholder=" " style="height: 80px" required>{{ old('kondisi_ekonomi', $alternatif->kondisi_ekonomi) }}</textarea>
                        <label>Deskripsi Kondisi Ekonomi <span class="required-star">*</span></label>
                    </div>
                </div>

                <!-- ===== UPLOAD DOKUMEN ===== -->
                <div class="form-section">
                    <h3 class="section-title">
                        <div class="section-icon"><i class="fas fa-upload"></i></div>
                        Upload Dokumen
                    </h3>
                    <div class="form-info"><i class="fas fa-info-circle me-1"></i> Klik setiap kategori untuk membuka. Kosongkan jika tidak ingin mengubah file.</div>

                    <!-- Progress total dokumen -->
                    <div style="margin-bottom: 1rem;">
                        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:4px;">
                            <span style="font-size:0.82rem; font-weight:600; color:#495057;">Kelengkapan Dokumen</span>
                            <span style="font-size:0.82rem; color:var(--primary-color); font-weight:700;" id="doc-count-label">0 / 0 file</span>
                        </div>
                        <div class="doc-progress-wrap">
                            <div class="doc-progress-bar" id="doc-progress-bar" style="width: 0%"></div>
                        </div>
                    </div>

                    <!-- ===== DOKUMEN IDENTITAS ===== -->
                    <div class="doc-section-title"><i class="fas fa-id-card"></i> Dokumen Identitas</div>
                    <div class="doc-grid">

                        @php
                        $docs = [
                            ['id'=>'ktp','label'=>'KTP','icon'=>'fa-id-card','accept'=>'.jpg,.jpeg,.png,.pdf','hint'=>'JPG, PNG, PDF · 2MB','file'=>$alternatif->ktp,'required'=>true],
                            ['id'=>'kk','label'=>'Kartu Keluarga','icon'=>'fa-users','accept'=>'.jpg,.jpeg,.png,.pdf','hint'=>'JPG, PNG, PDF · 2MB','file'=>$alternatif->kk,'required'=>true],
                        ];
                        @endphp

                        @foreach($docs as $doc)
                        <div class="doc-accordion" data-doc-id="{{ $doc['id'] }}">
                            <div class="doc-accordion-header" onclick="toggleAccordion('{{ $doc['id'] }}')">
                                <div class="doc-accordion-left">
                                    <div class="doc-accordion-icon"><i class="fas {{ $doc['icon'] }}"></i></div>
                                    <div>
                                        <div class="doc-accordion-label">{{ $doc['label'] }}
                                            @if($doc['required']) <span class="required-star">*</span> @endif
                                        </div>
                                        <div class="doc-accordion-meta">{{ $doc['hint'] }}</div>
                                    </div>
                                </div>
                                <div class="doc-accordion-badges">
                                    @if($doc['file'])
                                        <span class="badge-uploaded"><i class="fas fa-check me-1"></i>Terupload</span>
                                    @elseif($doc['required'])
                                        <span class="badge-required">Wajib</span>
                                    @else
                                        <span class="badge-empty">Kosong</span>
                                    @endif
                                    <i class="fas fa-chevron-down chevron" id="chevron-{{ $doc['id'] }}"></i>
                                </div>
                            </div>
                            <div class="doc-accordion-body" id="body-{{ $doc['id'] }}">
                                <div class="upload-compact">
                                    @if($doc['file'])
                                    <div class="current-file-compact">
                                        <div class="current-file-info">
                                            <i class="fas fa-check-circle"></i>
                                            <span>{{ basename($doc['file']) }}</span>
                                        </div>
                                        <div class="file-actions">
                                            <a href="{{ asset('storage/' . $doc['file']) }}" target="_blank" class="btn-view"><i class="fas fa-eye"></i> Lihat</a>
                                            <a href="{{ asset('storage/' . $doc['file']) }}" download class="btn-download"><i class="fas fa-download"></i></a>
                                        </div>
                                    </div>
                                    @endif
                                    <div class="upload-row">
                                        <input type="file" id="{{ $doc['id'] }}" name="{{ $doc['id'] }}" class="file-input" accept="{{ $doc['accept'] }}">
                                        <button type="button" class="upload-btn-compact" onclick="document.getElementById('{{ $doc['id'] }}').click()">
                                            <i class="fas fa-cloud-upload-alt"></i>
                                            {{ $doc['file'] ? 'Ganti File' : 'Pilih File' }}
                                        </button>
                                        <span class="upload-hint">{{ $doc['hint'] }}</span>
                                    </div>
                                    <div id="{{ $doc['id'] }}-preview"></div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <!-- ===== DOKUMEN AKADEMIK ===== -->
                    <div class="doc-section-title"><i class="fas fa-graduation-cap"></i> Dokumen Akademik</div>
                    <div class="doc-grid">
                        @php
                        $docs_akademik = [
                            ['id'=>'transkrip','label'=>'Transkrip Nilai','icon'=>'fa-file-alt','accept'=>'.pdf','hint'=>'PDF · 5MB','file'=>$alternatif->transkrip,'required'=>true],
                        ];
                        @endphp
                        @foreach($docs_akademik as $doc)
                        <div class="doc-accordion" data-doc-id="{{ $doc['id'] }}">
                            <div class="doc-accordion-header" onclick="toggleAccordion('{{ $doc['id'] }}')">
                                <div class="doc-accordion-left">
                                    <div class="doc-accordion-icon"><i class="fas {{ $doc['icon'] }}"></i></div>
                                    <div>
                                        <div class="doc-accordion-label">{{ $doc['label'] }}@if($doc['required']) <span class="required-star">*</span>@endif</div>
                                        <div class="doc-accordion-meta">{{ $doc['hint'] }}</div>
                                    </div>
                                </div>
                                <div class="doc-accordion-badges">
                                    @if($doc['file']) <span class="badge-uploaded"><i class="fas fa-check me-1"></i>Terupload</span>
                                    @elseif($doc['required']) <span class="badge-required">Wajib</span>
                                    @else <span class="badge-empty">Kosong</span> @endif
                                    <i class="fas fa-chevron-down chevron" id="chevron-{{ $doc['id'] }}"></i>
                                </div>
                            </div>
                            <div class="doc-accordion-body" id="body-{{ $doc['id'] }}">
                                <div class="upload-compact">
                                    @if($doc['file'])
                                    <div class="current-file-compact">
                                        <div class="current-file-info"><i class="fas fa-check-circle"></i><span>{{ basename($doc['file']) }}</span></div>
                                        <div class="file-actions">
                                            <a href="{{ asset('storage/' . $doc['file']) }}" target="_blank" class="btn-view"><i class="fas fa-eye"></i> Lihat</a>
                                            <a href="{{ asset('storage/' . $doc['file']) }}" download class="btn-download"><i class="fas fa-download"></i></a>
                                        </div>
                                    </div>
                                    @endif
                                    <div class="upload-row">
                                        <input type="file" id="{{ $doc['id'] }}" name="{{ $doc['id'] }}" class="file-input" accept="{{ $doc['accept'] }}">
                                        <button type="button" class="upload-btn-compact" onclick="document.getElementById('{{ $doc['id'] }}').click()"><i class="fas fa-cloud-upload-alt"></i> {{ $doc['file'] ? 'Ganti File' : 'Pilih File' }}</button>
                                        <span class="upload-hint">{{ $doc['hint'] }}</span>
                                    </div>
                                    <div id="{{ $doc['id'] }}-preview"></div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <!-- ===== DOKUMEN EKONOMI ===== -->
                    <div class="doc-section-title"><i class="fas fa-money-check-alt"></i> Dokumen Ekonomi</div>
                    <div class="doc-grid">
                        @php
                        $docs_ekonomi = [
                            ['id'=>'surat_penghasilan','label'=>'Surat Keterangan Penghasilan','icon'=>'fa-money-bill-wave','accept'=>'.pdf,.jpg,.jpeg,.png','hint'=>'PDF, JPG, PNG · 2MB','file'=>$alternatif->surat_penghasilan,'required'=>false],
                            ['id'=>'slip_gaji_ortu','label'=>'Slip Gaji Orang Tua','icon'=>'fa-receipt','accept'=>'.pdf,.jpg,.jpeg,.png','hint'=>'PDF, JPG, PNG · 2MB','file'=>$alternatif->slip_gaji_ortu,'required'=>false],
                            ['id'=>'surat_tidak_menerima_beasiswa','label'=>'Surat Tidak Menerima Beasiswa','icon'=>'fa-file-contract','accept'=>'.pdf,.jpg,.jpeg,.png','hint'=>'PDF, JPG, PNG · 2MB','file'=>$alternatif->surat_tidak_menerima_beasiswa,'required'=>false],
                        ];
                        @endphp
                        @foreach($docs_ekonomi as $doc)
                        <div class="doc-accordion" data-doc-id="{{ $doc['id'] }}">
                            <div class="doc-accordion-header" onclick="toggleAccordion('{{ $doc['id'] }}')">
                                <div class="doc-accordion-left">
                                    <div class="doc-accordion-icon"><i class="fas {{ $doc['icon'] }}"></i></div>
                                    <div>
                                        <div class="doc-accordion-label">{{ $doc['label'] }}</div>
                                        <div class="doc-accordion-meta">{{ $doc['hint'] }}</div>
                                    </div>
                                </div>
                                <div class="doc-accordion-badges">
                                    @if($doc['file']) <span class="badge-uploaded"><i class="fas fa-check me-1"></i>Terupload</span>
                                    @else <span class="badge-empty">Kosong</span> @endif
                                    <i class="fas fa-chevron-down chevron" id="chevron-{{ $doc['id'] }}"></i>
                                </div>
                            </div>
                            <div class="doc-accordion-body" id="body-{{ $doc['id'] }}">
                                <div class="upload-compact">
                                    @if($doc['file'])
                                    <div class="current-file-compact">
                                        <div class="current-file-info"><i class="fas fa-check-circle"></i><span>{{ basename($doc['file']) }}</span></div>
                                        <div class="file-actions">
                                            <a href="{{ asset('storage/' . $doc['file']) }}" target="_blank" class="btn-view"><i class="fas fa-eye"></i> Lihat</a>
                                            <a href="{{ asset('storage/' . $doc['file']) }}" download class="btn-download"><i class="fas fa-download"></i></a>
                                        </div>
                                    </div>
                                    @endif
                                    <div class="upload-row">
                                        <input type="file" id="{{ $doc['id'] }}" name="{{ $doc['id'] }}" class="file-input" accept="{{ $doc['accept'] }}">
                                        <button type="button" class="upload-btn-compact" onclick="document.getElementById('{{ $doc['id'] }}').click()"><i class="fas fa-cloud-upload-alt"></i> {{ $doc['file'] ? 'Ganti File' : 'Pilih File' }}</button>
                                        <span class="upload-hint">{{ $doc['hint'] }}</span>
                                    </div>
                                    <div id="{{ $doc['id'] }}-preview"></div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <!-- ===== DOKUMEN KHUSUS DHUAFA ===== -->
                    <div class="doc-dhuafa-only">
                        <div class="doc-section-title"><i class="fas fa-hand-holding-heart"></i> Dokumen Khusus Dhuafa</div>
                        <div class="doc-grid">
                            @php
                            $docs_dhuafa = [
                                ['id'=>'surat_tidak_mampu','label'=>'Surat Keterangan Tidak Mampu','icon'=>'fa-file-medical','accept'=>'.pdf','hint'=>'PDF · 3MB','file'=>$alternatif->surat_tidak_mampu,'required'=>false],
                            ];
                            @endphp
                            @foreach($docs_dhuafa as $doc)
                            <div class="doc-accordion" data-doc-id="{{ $doc['id'] }}">
                                <div class="doc-accordion-header" onclick="toggleAccordion('{{ $doc['id'] }}')">
                                    <div class="doc-accordion-left">
                                        <div class="doc-accordion-icon"><i class="fas {{ $doc['icon'] }}"></i></div>
                                        <div>
                                            <div class="doc-accordion-label">{{ $doc['label'] }}</div>
                                            <div class="doc-accordion-meta">{{ $doc['hint'] }}</div>
                                        </div>
                                    </div>
                                    <div class="doc-accordion-badges">
                                        @if($doc['file']) <span class="badge-uploaded"><i class="fas fa-check me-1"></i>Terupload</span>
                                        @else <span class="badge-empty">Kosong</span> @endif
                                        <i class="fas fa-chevron-down chevron" id="chevron-{{ $doc['id'] }}"></i>
                                    </div>
                                </div>
                                <div class="doc-accordion-body" id="body-{{ $doc['id'] }}">
                                    <div class="upload-compact">
                                        @if($doc['file'])
                                        <div class="current-file-compact">
                                            <div class="current-file-info"><i class="fas fa-check-circle"></i><span>{{ basename($doc['file']) }}</span></div>
                                            <div class="file-actions">
                                                <a href="{{ asset('storage/' . $doc['file']) }}" target="_blank" class="btn-view"><i class="fas fa-eye"></i> Lihat</a>
                                                <a href="{{ asset('storage/' . $doc['file']) }}" download class="btn-download"><i class="fas fa-download"></i></a>
                                            </div>
                                        </div>
                                        @endif
                                        <div class="upload-row">
                                            <input type="file" id="{{ $doc['id'] }}" name="{{ $doc['id'] }}" class="file-input" accept="{{ $doc['accept'] }}">
                                            <button type="button" class="upload-btn-compact" onclick="document.getElementById('{{ $doc['id'] }}').click()"><i class="fas fa-cloud-upload-alt"></i> {{ $doc['file'] ? 'Ganti File' : 'Pilih File' }}</button>
                                            <span class="upload-hint">{{ $doc['hint'] }}</span>
                                        </div>
                                        <div id="{{ $doc['id'] }}-preview"></div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- ===== DOKUMEN KHUSUS KADER ===== -->
                    <div class="doc-kader-only">
                        <div class="doc-section-title"><i class="fas fa-star-and-crescent"></i> Dokumen Khusus Kader</div>
                        <div class="doc-grid">
                            @php
                            $docs_kader = [
                                ['id'=>'surat_aktif_organisasi','label'=>'Surat Aktif Organisasi','icon'=>'fa-file-signature','accept'=>'.pdf','hint'=>'PDF · 2MB','file'=>$alternatif->surat_aktif_organisasi,'required'=>true],
                                ['id'=>'sertifikat_prestasi','label'=>'Sertifikat/Piagam Prestasi','icon'=>'fa-certificate','accept'=>'.pdf','hint'=>'PDF · 5MB','file'=>$alternatif->sertifikat_prestasi,'required'=>false],
                                ['id'=>'surat_rekomendasi','label'=>'Surat Rekomendasi','icon'=>'fa-file-signature','accept'=>'.pdf','hint'=>'PDF · 2MB','file'=>$alternatif->surat_rekomendasi,'required'=>true],
                                ['id'=>'ktam','label'=>'KTAM','icon'=>'fa-id-card-alt','accept'=>'.jpg,.jpeg,.png','hint'=>'JPG, PNG · 2MB','file'=>$alternatif->ktam,'required'=>true],
                            ];
                            @endphp
                            @foreach($docs_kader as $doc)
                            <div class="doc-accordion" data-doc-id="{{ $doc['id'] }}">
                                <div class="doc-accordion-header" onclick="toggleAccordion('{{ $doc['id'] }}')">
                                    <div class="doc-accordion-left">
                                        <div class="doc-accordion-icon"><i class="fas {{ $doc['icon'] }}"></i></div>
                                        <div>
                                            <div class="doc-accordion-label">{{ $doc['label'] }}@if($doc['required']) <span class="required-star">*</span>@endif</div>
                                            <div class="doc-accordion-meta">{{ $doc['hint'] }}</div>
                                        </div>
                                    </div>
                                    <div class="doc-accordion-badges">
                                        @if($doc['file']) <span class="badge-uploaded"><i class="fas fa-check me-1"></i>Terupload</span>
                                        @elseif($doc['required']) <span class="badge-required">Wajib</span>
                                        @else <span class="badge-empty">Kosong</span> @endif
                                        <i class="fas fa-chevron-down chevron" id="chevron-{{ $doc['id'] }}"></i>
                                    </div>
                                </div>
                                <div class="doc-accordion-body" id="body-{{ $doc['id'] }}">
                                    <div class="upload-compact">
                                        @if($doc['file'])
                                        <div class="current-file-compact">
                                            <div class="current-file-info"><i class="fas fa-check-circle"></i><span>{{ basename($doc['file']) }}</span></div>
                                            <div class="file-actions">
                                                <a href="{{ asset('storage/' . $doc['file']) }}" target="_blank" class="btn-view"><i class="fas fa-eye"></i> Lihat</a>
                                                <a href="{{ asset('storage/' . $doc['file']) }}" download class="btn-download"><i class="fas fa-download"></i></a>
                                            </div>
                                        </div>
                                        @endif
                                        <div class="upload-row">
                                            <input type="file" id="{{ $doc['id'] }}" name="{{ $doc['id'] }}" class="file-input" accept="{{ $doc['accept'] }}">
                                            <button type="button" class="upload-btn-compact" onclick="document.getElementById('{{ $doc['id'] }}').click()"><i class="fas fa-cloud-upload-alt"></i> {{ $doc['file'] ? 'Ganti File' : 'Pilih File' }}</button>
                                            <span class="upload-hint">{{ $doc['hint'] }}</span>
                                        </div>
                                        <div id="{{ $doc['id'] }}-preview"></div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- ===== FOTO RUMAH ===== -->
                    <div class="doc-section-title"><i class="fas fa-home"></i> Foto Kondisi Rumah</div>
                    <div class="doc-grid">
                        @php
                        $docs_rumah = [
                            ['id'=>'foto_rumah_depan','label'=>'Tampak Depan','icon'=>'fa-home','accept'=>'.jpg,.jpeg,.png','hint'=>'JPG, PNG · 2MB','file'=>$alternatif->foto_rumah_depan],
                            ['id'=>'foto_rumah_samping','label'=>'Tampak Samping','icon'=>'fa-home','accept'=>'.jpg,.jpeg,.png','hint'=>'JPG, PNG · 2MB','file'=>$alternatif->foto_rumah_samping],
                            ['id'=>'foto_ruang_tamu','label'=>'Ruang Tamu','icon'=>'fa-couch','accept'=>'.jpg,.jpeg,.png','hint'=>'JPG, PNG · 2MB','file'=>$alternatif->foto_ruang_tamu],
                            ['id'=>'foto_kamar_mandi','label'=>'Kamar Mandi','icon'=>'fa-bath','accept'=>'.jpg,.jpeg,.png','hint'=>'JPG, PNG · 2MB','file'=>$alternatif->foto_kamar_mandi],
                            ['id'=>'foto_dapur','label'=>'Dapur','icon'=>'fa-utensils','accept'=>'.jpg,.jpeg,.png','hint'=>'JPG, PNG · 2MB','file'=>$alternatif->foto_dapur],
                        ];
                        @endphp
                        @foreach($docs_rumah as $doc)
                        <div class="doc-accordion" data-doc-id="{{ $doc['id'] }}">
                            <div class="doc-accordion-header" onclick="toggleAccordion('{{ $doc['id'] }}')">
                                <div class="doc-accordion-left">
                                    <div class="doc-accordion-icon"><i class="fas {{ $doc['icon'] }}"></i></div>
                                    <div>
                                        <div class="doc-accordion-label">Foto {{ $doc['label'] }}</div>
                                        <div class="doc-accordion-meta">{{ $doc['hint'] }}</div>
                                    </div>
                                </div>
                                <div class="doc-accordion-badges">
                                    @if($doc['file']) <span class="badge-uploaded"><i class="fas fa-check me-1"></i>Terupload</span>
                                    @else <span class="badge-empty">Kosong</span> @endif
                                    <i class="fas fa-chevron-down chevron" id="chevron-{{ $doc['id'] }}"></i>
                                </div>
                            </div>
                            <div class="doc-accordion-body" id="body-{{ $doc['id'] }}">
                                <div class="upload-compact">
                                    @if($doc['file'])
                                    <div class="current-file-compact">
                                        <div class="current-file-info"><i class="fas fa-check-circle"></i><span>{{ basename($doc['file']) }}</span></div>
                                        <div class="file-actions">
                                            <a href="{{ asset('storage/' . $doc['file']) }}" target="_blank" class="btn-view"><i class="fas fa-eye"></i> Lihat</a>
                                            <a href="{{ asset('storage/' . $doc['file']) }}" download class="btn-download"><i class="fas fa-download"></i></a>
                                        </div>
                                    </div>
                                    @endif
                                    <div class="upload-row">
                                        <input type="file" id="{{ $doc['id'] }}" name="{{ $doc['id'] }}" class="file-input" accept="{{ $doc['accept'] }}">
                                        <button type="button" class="upload-btn-compact" onclick="document.getElementById('{{ $doc['id'] }}').click()"><i class="fas fa-cloud-upload-alt"></i> {{ $doc['file'] ? 'Ganti Foto' : 'Pilih Foto' }}</button>
                                        <span class="upload-hint">{{ $doc['hint'] }}</span>
                                    </div>
                                    <div id="{{ $doc['id'] }}-preview"></div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <!-- ===== DOKUMEN PENDUKUNG ===== -->
                    <div class="doc-section-title"><i class="fas fa-file-alt"></i> Dokumen Pendukung</div>
                    <div class="doc-grid">
                        @php
                        $docs_pendukung = [
                            ['id'=>'cv','label'=>'CV (Curriculum Vitae)','icon'=>'fa-file-alt','accept'=>'.pdf,.doc,.docx','hint'=>'PDF, DOC · 2MB','file'=>$alternatif->cv],
                            ['id'=>'pas_foto','label'=>'Pas Foto 3×4','icon'=>'fa-portrait','accept'=>'.jpg,.jpeg,.png','hint'=>'JPG, PNG · 2MB','file'=>$alternatif->pas_foto],
                            ['id'=>'motivation_letter','label'=>'Motivation Letter','icon'=>'fa-envelope-open-text','accept'=>'.pdf,.doc,.docx','hint'=>'PDF, DOC · 2MB','file'=>$alternatif->motivation_letter],
                            ['id'=>'ktm','label'=>'KTM','icon'=>'fa-id-badge','accept'=>'.jpg,.jpeg,.png','hint'=>'JPG, PNG · 2MB','file'=>$alternatif->ktm],
                            ['id'=>'twibbon','label'=>'Twibbon','icon'=>'fa-image','accept'=>'.jpg,.jpeg,.png','hint'=>'JPG, PNG · 2MB','file'=>$alternatif->twibbon],
                            ['id'=>'surat_kesanggupan_relawan','label'=>'Surat Kesanggupan Relawan','icon'=>'fa-hands-helping','accept'=>'.pdf,.jpg,.jpeg,.png','hint'=>'PDF, JPG, PNG · 2MB','file'=>$alternatif->surat_kesanggupan_relawan],
                        ];
                        @endphp
                        @foreach($docs_pendukung as $doc)
                        <div class="doc-accordion" data-doc-id="{{ $doc['id'] }}">
                            <div class="doc-accordion-header" onclick="toggleAccordion('{{ $doc['id'] }}')">
                                <div class="doc-accordion-left">
                                    <div class="doc-accordion-icon"><i class="fas {{ $doc['icon'] }}"></i></div>
                                    <div>
                                        <div class="doc-accordion-label">{{ $doc['label'] }}</div>
                                        <div class="doc-accordion-meta">{{ $doc['hint'] }}</div>
                                    </div>
                                </div>
                                <div class="doc-accordion-badges">
                                    @if($doc['file']) <span class="badge-uploaded"><i class="fas fa-check me-1"></i>Terupload</span>
                                    @else <span class="badge-empty">Kosong</span> @endif
                                    <i class="fas fa-chevron-down chevron" id="chevron-{{ $doc['id'] }}"></i>
                                </div>
                            </div>
                            <div class="doc-accordion-body" id="body-{{ $doc['id'] }}">
                                <div class="upload-compact">
                                    @if($doc['file'])
                                    <div class="current-file-compact">
                                        <div class="current-file-info"><i class="fas fa-check-circle"></i><span>{{ basename($doc['file']) }}</span></div>
                                        <div class="file-actions">
                                            <a href="{{ asset('storage/' . $doc['file']) }}" target="_blank" class="btn-view"><i class="fas fa-eye"></i> Lihat</a>
                                            <a href="{{ asset('storage/' . $doc['file']) }}" download class="btn-download"><i class="fas fa-download"></i></a>
                                        </div>
                                    </div>
                                    @endif
                                    <div class="upload-row">
                                        <input type="file" id="{{ $doc['id'] }}" name="{{ $doc['id'] }}" class="file-input" accept="{{ $doc['accept'] }}">
                                        <button type="button" class="upload-btn-compact" onclick="document.getElementById('{{ $doc['id'] }}').click()"><i class="fas fa-cloud-upload-alt"></i> {{ $doc['file'] ? 'Ganti File' : 'Pilih File' }}</button>
                                        <span class="upload-hint">{{ $doc['hint'] }}</span>
                                    </div>
                                    <div id="{{ $doc['id'] }}-preview"></div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                </div><!-- end form-section dokumen -->

                <!-- Submit -->
                <div style="text-align: center; padding-bottom: 1rem;">
                    <button type="submit" class="btn-submit">
                        <i class="fas fa-save me-2"></i>Simpan Perubahan
                    </button>
                </div>

            </div><!-- end form-content -->
        </form>

    </div><!-- end main-container -->
</div>

<script>
// ===== ACCORDION =====
function toggleAccordion(id) {
    const body = document.getElementById('body-' + id);
    const chevron = document.getElementById('chevron-' + id);
    const header = body.previousElementSibling;

    const isOpen = body.classList.contains('open');
    body.classList.toggle('open', !isOpen);
    chevron.classList.toggle('open', !isOpen);
    header.classList.toggle('open', !isOpen);
}

// ===== KATEGORI TOGGLE =====
document.addEventListener('DOMContentLoaded', function() {
    const cardDhuafa = document.getElementById('card-dhuafa');
    const cardKader = document.getElementById('card-kader');
    const radioDhuafa = document.querySelector('input[name="jenis_pendaftaran_display"][value="dhuafa"]');
    const radioKader = document.querySelector('input[name="jenis_pendaftaran_display"][value="kader"]');
    const hiddenInput = document.getElementById('jenis_pendaftaran');
    const sectionOrganisasi = document.getElementById('section-organisasi');
    const docDhuafa = document.querySelector('.doc-dhuafa-only');
    const docKader = document.querySelector('.doc-kader-only');

    const fieldsKader = ['jenis_organisasi','nama_organisasi','jabatan','tahun_bergabung','riwayat_aktivitas','kontribusi','rencana_masa_depan'];

    function setRequired(ids, isRequired) {
        ids.forEach(id => {
            const el = document.getElementById(id);
            if (!el) return;
            if (isRequired) el.setAttribute('required', 'required');
            else el.removeAttribute('required');
        });
    }

    function toggleKategori(jenis) {
        hiddenInput.value = jenis;
        if (jenis === 'kader') {
            cardKader.classList.add('active');
            cardDhuafa.classList.remove('active');
            sectionOrganisasi?.classList.add('active');
            docKader?.classList.add('active');
            docDhuafa?.classList.remove('active');
            setRequired(fieldsKader, true);
        } else {
            cardDhuafa.classList.add('active');
            cardKader.classList.remove('active');
            sectionOrganisasi?.classList.remove('active');
            docKader?.classList.remove('active');
            docDhuafa?.classList.add('active');
            setRequired(fieldsKader, false);
        }
    }

    cardDhuafa.addEventListener('click', () => { radioDhuafa.checked = true; toggleKategori('dhuafa'); });
    cardKader.addEventListener('click', () => { radioKader.checked = true; toggleKategori('kader'); });

    const initialJenis = (radioKader && radioKader.checked) ? 'kader' : 'dhuafa';
    toggleKategori(initialJenis);

    // ===== FILE PREVIEW & PROGRESS =====
    function updateDocProgress() {
        const allDocs = document.querySelectorAll('.doc-accordion');
        const uploaded = document.querySelectorAll('.badge-uploaded, .file-preview-compact').length
            + document.querySelectorAll('.file-input[data-has-new="true"]').length;

        let total = allDocs.length;
        let done = document.querySelectorAll('.badge-uploaded').length;

        // Count newly selected
        document.querySelectorAll('.file-input').forEach(inp => {
            if (inp.files && inp.files.length > 0) {
                done++;
            }
        });

        const pct = total > 0 ? Math.round((done / total) * 100) : 0;
        document.getElementById('doc-progress-bar').style.width = pct + '%';
        document.getElementById('doc-count-label').textContent = done + ' / ' + total + ' file';
    }

    updateDocProgress();

    document.querySelectorAll('.file-input').forEach(input => {
        input.addEventListener('change', function(e) {
            const file = e.target.files[0];
            const previewDiv = document.getElementById(this.id + '-preview');
            if (!previewDiv) return;

            if (file) {
                const fileSize = file.size / 1024 / 1024;
                if (fileSize > 10) {
                    alert('File terlalu besar. Maksimal 10MB');
                    this.value = '';
                    previewDiv.innerHTML = '';
                    return;
                }
                previewDiv.innerHTML = `
                    <div class="file-preview-compact">
                        <i class="fas fa-check-circle"></i>
                        <span>${file.name}</span>
                        <span style="color:#adb5bd; margin-left:auto;">${fileSize.toFixed(2)} MB</span>
                    </div>`;

                // Update badge in header
                const accordion = this.closest('.doc-accordion');
                if (accordion) {
                    const badgeWrap = accordion.querySelector('.doc-accordion-badges');
                    const oldBadge = badgeWrap.querySelector('.badge-empty, .badge-required');
                    if (oldBadge) {
                        oldBadge.outerHTML = '<span class="badge-uploaded"><i class="fas fa-check me-1"></i>Dipilih</span>';
                    }
                }

                updateDocProgress();
            } else {
                previewDiv.innerHTML = '';
                updateDocProgress();
            }
        });
    });
});
</script>

@endsection