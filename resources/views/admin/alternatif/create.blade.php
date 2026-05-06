@extends('layouts.admin')

@section('title', 'Tambah Pendaftar Beasiswa')

@section('content')

<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=DM+Sans:wght@300;400;500&display=swap');

    :root {
        --primary: #e85d26;
        --primary-light: #f07a48;
        --primary-ultra-light: #fff4f0;
        --secondary: #f5a623;
        --success: #16a34a;
        --info: #0284c7;
        --danger: #dc2626;
        --surface: #ffffff;
        --surface-2: #fafafa;
        --surface-3: #f4f4f5;
        --border: #e4e4e7;
        --border-focus: #e85d26;
        --text-primary: #18181b;
        --text-secondary: #71717a;
        --text-muted: #a1a1aa;
        --shadow-sm: 0 1px 3px rgba(0,0,0,.06), 0 1px 2px rgba(0,0,0,.04);
        --shadow-md: 0 4px 12px rgba(0,0,0,.08), 0 2px 6px rgba(0,0,0,.04);
        --shadow-lg: 0 20px 40px rgba(0,0,0,.1);
        --radius-sm: 8px;
        --radius-md: 12px;
        --radius-lg: 16px;
        --radius-xl: 24px;
    }

    * { box-sizing: border-box; }

    body { font-family: 'DM Sans', sans-serif; }

    .page-wrap {
        background: #f1f0ef;
        min-height: 100vh;
        padding: 28px 20px 60px;
    }

    /* ── Header Card ── */
    .header-card {
        background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
        border-radius: var(--radius-xl);
        padding: 2rem 2.5rem;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 1.5rem;
        position: relative;
        overflow: hidden;
        box-shadow: 0 8px 32px rgba(232,93,38,.35);
    }

    .header-card::before {
        content: '';
        position: absolute;
        top: -60px; right: -60px;
        width: 200px; height: 200px;
        border-radius: 50%;
        background: rgba(255,255,255,.08);
    }

    .header-card::after {
        content: '';
        position: absolute;
        bottom: -40px; right: 80px;
        width: 130px; height: 130px;
        border-radius: 50%;
        background: rgba(255,255,255,.06);
    }

    .header-icon-wrap {
        width: 60px; height: 60px;
        background: rgba(255,255,255,.2);
        border-radius: var(--radius-md);
        display: flex; align-items: center; justify-content: center;
        font-size: 1.6rem;
        flex-shrink: 0;
    }

    .header-text h1 {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 1.5rem;
        font-weight: 800;
        color: white;
        margin: 0 0 4px;
        line-height: 1.2;
    }

    .header-text p { color: rgba(255,255,255,.8); margin: 0; font-size: .9rem; }

    .btn-back-pill {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: var(--surface);
        border: 1.5px solid var(--border);
        color: var(--text-secondary);
        padding: 8px 16px;
        border-radius: 99px;
        font-size: .85rem;
        font-weight: 600;
        text-decoration: none;
        transition: all .2s;
        margin-bottom: 20px;
    }

    .btn-back-pill:hover {
        background: var(--primary-ultra-light);
        border-color: var(--primary);
        color: var(--primary);
        text-decoration: none;
    }

    /* ── Kategori Selector ── */
    .kategori-card-wrap {
        background: var(--surface);
        border-radius: var(--radius-lg);
        padding: 1.5rem;
        margin-bottom: 20px;
        box-shadow: var(--shadow-sm);
        border: 1px solid var(--border);
    }

    .kategori-label {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: .75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .08em;
        color: var(--text-muted);
        margin-bottom: 1rem;
        display: block;
    }

    .kategori-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
    }

    .kat-option {
        border: 2px solid var(--border);
        border-radius: var(--radius-md);
        padding: 1.2rem;
        cursor: pointer;
        transition: all .25s;
        display: flex;
        align-items: center;
        gap: 1rem;
        background: var(--surface-2);
    }

    .kat-option input[type="radio"] { display: none; }

    .kat-option:hover {
        border-color: var(--primary-light);
        background: var(--primary-ultra-light);
    }

    .kat-option.active {
        border-color: var(--primary);
        background: var(--primary-ultra-light);
        box-shadow: 0 0 0 4px rgba(232,93,38,.08);
    }

    .kat-emoji {
        font-size: 2rem;
        line-height: 1;
        flex-shrink: 0;
    }

    .kat-info .kat-title {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-weight: 700;
        font-size: .95rem;
        color: var(--text-primary);
        margin: 0 0 2px;
    }

    .kat-info .kat-desc {
        font-size: .78rem;
        color: var(--text-secondary);
        margin: 0;
    }

    /* ── Main Layout: full width form ── */
    .form-layout {
        display: flex;
        flex-direction: column;
        gap: 16px;
    }

    /* ── Form Sections ── */
    .form-body { display: flex; flex-direction: column; gap: 16px; }

    .form-card {
        background: var(--surface);
        border-radius: var(--radius-lg);
        overflow: hidden;
        box-shadow: var(--shadow-sm);
        border: 1px solid var(--border);
    }

    .card-header {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 1.1rem 1.5rem;
        border-bottom: 1px solid var(--border);
        background: var(--surface-2);
    }

    .card-icon {
        width: 36px; height: 36px;
        border-radius: var(--radius-sm);
        display: flex; align-items: center; justify-content: center;
        font-size: .95rem;
        flex-shrink: 0;
    }

    .card-icon.orange { background: rgba(232,93,38,.12); color: var(--primary); }
    .card-icon.blue   { background: rgba(2,132,199,.12);   color: var(--info); }
    .card-icon.green  { background: rgba(22,163,74,.12);    color: var(--success); }
    .card-icon.amber  { background: rgba(245,166,35,.15);   color: #b45309; }
    .card-icon.rose   { background: rgba(220,38,38,.1);     color: var(--danger); }

    .card-title {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-weight: 700;
        font-size: .95rem;
        color: var(--text-primary);
        margin: 0;
    }

    .card-subtitle { font-size: .78rem; color: var(--text-secondary); margin: 2px 0 0; }

    .card-body { padding: 1.5rem; }

    /* ── Fields ── */
    .field-group {
        display: grid;
        gap: 14px;
        margin-bottom: 14px;
    }

    .field-group.cols-2 { grid-template-columns: 1fr 1fr; }
    .field-group.cols-3 { grid-template-columns: 1fr 1fr 1fr; }

    .field-wrap { display: flex; flex-direction: column; gap: 5px; }

    .field-label {
        font-size: .78rem;
        font-weight: 600;
        color: var(--text-secondary);
        letter-spacing: .01em;
    }

    .field-label .req { color: var(--danger); margin-left: 2px; }

    .field-control {
        width: 100%;
        border: 1.5px solid var(--border);
        border-radius: var(--radius-sm);
        padding: 9px 13px;
        font-size: .88rem;
        font-family: 'DM Sans', sans-serif;
        color: var(--text-primary);
        background: var(--surface);
        transition: all .2s;
        line-height: 1.5;
    }

    .field-control:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(232,93,38,.1);
        background: #fff;
    }

    textarea.field-control { resize: vertical; min-height: 90px; }

    .info-banner {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        background: #eff6ff;
        border: 1px solid #bfdbfe;
        border-radius: var(--radius-sm);
        padding: 10px 14px;
        font-size: .8rem;
        color: #1e40af;
        margin-bottom: 16px;
    }

    .info-banner i { margin-top: 1px; flex-shrink: 0; }

    /* ── Upload Grid (compact!) ── */
    .upload-section-title {
        display: flex;
        align-items: center;
        gap: 8px;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: .8rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .06em;
        color: var(--text-secondary);
        margin: 20px 0 12px;
        padding-bottom: 8px;
        border-bottom: 1px solid var(--border);
    }

    .upload-section-title:first-child { margin-top: 0; }

    .upload-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 10px;
    }

    .upload-tile {
        border: 1.5px dashed var(--border);
        border-radius: var(--radius-md);
        padding: 14px 10px;
        text-align: center;
        cursor: pointer;
        transition: all .25s;
        background: var(--surface-2);
        position: relative;
        min-height: 110px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 6px;
    }

    .upload-tile:hover {
        border-color: var(--primary-light);
        background: var(--primary-ultra-light);
    }

    .upload-tile.has-file {
        border-color: var(--success);
        border-style: solid;
        background: #f0fdf4;
    }

    .upload-tile input[type="file"] { display: none; }

    .upload-tile-icon {
        font-size: 1.4rem;
        color: var(--text-muted);
        transition: color .2s;
        line-height: 1;
    }

    .upload-tile:hover .upload-tile-icon { color: var(--primary); }
    .upload-tile.has-file .upload-tile-icon { color: var(--success); }

    .upload-tile-label {
        font-size: .72rem;
        font-weight: 600;
        color: var(--text-primary);
        line-height: 1.3;
    }

    .upload-tile-hint {
        font-size: .65rem;
        color: var(--text-muted);
        line-height: 1.3;
    }

    .upload-tile-filename {
        font-size: .65rem;
        color: var(--success);
        font-weight: 600;
        max-width: 100%;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        display: none;
    }

    .upload-tile.has-file .upload-tile-filename { display: block; }
    .upload-tile.has-file .upload-tile-hint { display: none; }

    .req-badge {
        position: absolute;
        top: 6px; right: 6px;
        width: 6px; height: 6px;
        border-radius: 50%;
        background: var(--danger);
        opacity: .6;
    }

    /* ── Section: kader only ── */
    .kader-section { display: none; }
    .kader-section.active { display: block; }
    .dhuafa-section { display: block; }
    .dhuafa-section.hidden { display: none; }

    /* ── Submit ── */
    .submit-card {
        background: var(--surface);
        border-radius: var(--radius-lg);
        padding: 1.5rem;
        box-shadow: var(--shadow-sm);
        border: 1px solid var(--border);
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
    }

    .submit-hint { font-size: .8rem; color: var(--text-secondary); }
    .submit-hint strong { color: var(--text-primary); display: block; font-weight: 600; font-size: .88rem; }

    .btn-submit {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        color: white;
        border: none;
        padding: 12px 28px;
        border-radius: 99px;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-weight: 700;
        font-size: .92rem;
        cursor: pointer;
        transition: all .25s;
        box-shadow: 0 4px 16px rgba(232,93,38,.35);
        white-space: nowrap;
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(232,93,38,.4);
    }

    /* ── Alert ── */
    .alert-err {
        background: #fef2f2;
        border: 1px solid #fecaca;
        color: var(--danger);
        border-radius: var(--radius-md);
        padding: 1rem 1.25rem;
        margin-bottom: 16px;
        font-size: .85rem;
    }

    .alert-err strong { display: block; margin-bottom: 6px; font-size: .9rem; }

    @media (max-width: 900px) {
        .upload-grid { grid-template-columns: repeat(2, 1fr); }
        .field-group.cols-3 { grid-template-columns: 1fr 1fr; }
    }

    @media (max-width: 580px) {
        .kategori-grid { grid-template-columns: 1fr; }
        .upload-grid { grid-template-columns: repeat(2, 1fr); }
        .field-group.cols-2, .field-group.cols-3 { grid-template-columns: 1fr; }
        .submit-card { flex-direction: column; }
        .btn-submit { width: 100%; justify-content: center; }
    }
</style>

<div class="page-wrap">

    <!-- Header -->
    <div class="header-card">
        <div class="header-icon-wrap">🎓</div>
        <div class="header-text">
            <h1>Tambah Pendaftar Beasiswa</h1>
            <p>LAZISMU · Isi semua data dengan lengkap dan benar</p>
        </div>
    </div>

    <a href="{{ route('admin.pendaftar.index') }}" class="btn-back-pill">
        <i class="fas fa-arrow-left"></i> Kembali ke Daftar
    </a>

    @if($errors->any())
    <div class="alert-err">
        <strong><i class="fas fa-exclamation-triangle me-2"></i>Terjadi kesalahan:</strong>
        <ul class="mb-0 ps-3">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <!-- Kategori -->
    <div class="kategori-card-wrap">
        <span class="kategori-label"><i class="fas fa-layer-group me-1"></i>Kategori Beasiswa</span>
        <div class="kategori-grid">
            <label class="kat-option active" id="card-dhuafa">
                <input type="radio" name="jenis_pendaftaran_display" value="dhuafa" checked>
                <span class="kat-emoji">📋</span>
                <div class="kat-info">
                    <p class="kat-title">Beasiswa Dhuafa</p>
                    <p class="kat-desc">Mahasiswa dari keluarga kurang mampu</p>
                </div>
            </label>
            <label class="kat-option" id="card-kader">
                <input type="radio" name="jenis_pendaftaran_display" value="kader">
                <span class="kat-emoji">🕌</span>
                <div class="kat-info">
                    <p class="kat-title">Beasiswa Kader</p>
                    <p class="kat-desc">Kader aktif Muhammadiyah</p>
                </div>
            </label>
        </div>
    </div>

    <!-- Form -->
    <form id="createForm" action="{{ route('admin.alternatif.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="jenis_pendaftaran" id="jenis_pendaftaran" value="dhuafa">

        <div class="form-layout">

            <!-- Form Body (full width, no sidebar) -->
            <div class="form-body">

                <!-- ① Data Pribadi -->
                <div class="form-card" id="sec-pribadi">
                    <div class="card-header">
                        <div class="card-icon orange"><i class="fas fa-user"></i></div>
                        <div>
                            <p class="card-title">Data Pribadi</p>
                            <p class="card-subtitle">Sesuaikan dengan dokumen resmi</p>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="field-group cols-2">
                            <div class="field-wrap">
                                <label class="field-label">Nama Lengkap <span class="req">*</span></label>
                                <input type="text" name="nama" class="field-control" placeholder="Masukkan nama lengkap" required>
                            </div>
                            <div class="field-wrap">
                                <label class="field-label">NIK <span class="req">*</span></label>
                                <input type="text" name="nik" class="field-control" placeholder="16 digit NIK" maxlength="16" required>
                            </div>
                        </div>
                        <div class="field-group cols-2">
                            <div class="field-wrap">
                                <label class="field-label">Tempat Lahir <span class="req">*</span></label>
                                <input type="text" name="tempat_lahir" class="field-control" placeholder="Kota tempat lahir" required>
                            </div>
                            <div class="field-wrap">
                                <label class="field-label">Tanggal Lahir <span class="req">*</span></label>
                                <input type="date" name="tanggal_lahir" class="field-control" required>
                            </div>
                        </div>
                        <div class="field-group cols-3">
                            <div class="field-wrap">
                                <label class="field-label">Jenis Kelamin <span class="req">*</span></label>
                                <select name="jenis_kelamin" class="field-control" required>
                                    <option value="">Pilih</option>
                                    <option value="L">Laki-laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </div>
                            <div class="field-wrap">
                                <label class="field-label">No. Telepon <span class="req">*</span></label>
                                <input type="tel" name="no_telepon" class="field-control" placeholder="08xxxxxxxxxx" required>
                            </div>
                            <div class="field-wrap">
                                <label class="field-label">Alamat Email <span class="req">*</span></label>
                                <input type="email" name="email" class="field-control" placeholder="nama@email.com" required>
                            </div>
                        </div>
                        <div class="field-group">
                            <div class="field-wrap">
                                <label class="field-label">Alamat Lengkap <span class="req">*</span></label>
                                <textarea name="alamat" class="field-control" placeholder="Jalan, RT/RW, Kelurahan, Kecamatan, Kota" required></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ② Data Akademik -->
                <div class="form-card" id="sec-akademik">
                    <div class="card-header">
                        <div class="card-icon blue"><i class="fas fa-graduation-cap"></i></div>
                        <div>
                            <p class="card-title">Data Akademik</p>
                            <p class="card-subtitle">Sesuaikan dengan data di kampus</p>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="field-group cols-2">
                            <div class="field-wrap">
                                <label class="field-label">Asal Kampus/Universitas <span class="req">*</span></label>
                                <input type="text" name="asal_kampus" class="field-control" placeholder="Nama universitas" required>
                            </div>
                            <div class="field-wrap">
                                <label class="field-label">NIM <span class="req">*</span></label>
                                <input type="text" name="nim" class="field-control" placeholder="Nomor Induk Mahasiswa" required>
                            </div>
                        </div>
                        <div class="field-group cols-3">
                            <div class="field-wrap">
                                <label class="field-label">Fakultas <span class="req">*</span></label>
                                <input type="text" name="fakultas" class="field-control" placeholder="Nama fakultas" required>
                            </div>
                            <div class="field-wrap">
                                <label class="field-label">Program Studi <span class="req">*</span></label>
                                <input type="text" name="jurusan" class="field-control" placeholder="Nama prodi" required>
                            </div>
                            <div class="field-wrap">
                                <label class="field-label">Semester <span class="req">*</span></label>
                                <select name="semester" class="field-control" required>
                                    <option value="">Pilih</option>
                                    @for($i = 1; $i <= 8; $i++)
                                        <option value="{{ $i }}">Semester {{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <div class="field-group cols-2">
                            <div class="field-wrap">
                                <label class="field-label">IPK <span class="req">*</span></label>
                                <input type="number" name="ipk" class="field-control" placeholder="0.00 – 4.00" step="0.01" min="0" max="4" required>
                            </div>
                            <div class="field-wrap">
                                <label class="field-label">Tahun Masuk <span class="req">*</span></label>
                                <input type="number" name="tahun_masuk" class="field-control" placeholder="{{ date('Y') }}" min="2015" max="{{ date('Y') + 1 }}">
                            </div>
                        </div>
                        <div class="field-group">
                            <div class="field-wrap">
                                <label class="field-label">Prestasi Akademik/Non-Akademik <small style="font-weight:400;color:var(--text-muted)">(Opsional)</small></label>
                                <textarea name="prestasi" class="field-control" placeholder="Tuliskan prestasi yang pernah diraih..."></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ③ Organisasi (KADER ONLY) -->
                <div class="form-card kader-section" id="sec-organisasi">
                    <div class="card-header">
                        <div class="card-icon green"><i class="fas fa-users-cog"></i></div>
                        <div>
                            <p class="card-title">Data Organisasi Muhammadiyah</p>
                            <p class="card-subtitle">Khusus kader aktif organisasi</p>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="info-banner">
                            <i class="fas fa-mosque"></i>
                            Data ini khusus diisi oleh kader aktif Muhammadiyah dan organisasi otonom.
                        </div>
                        <div class="field-group cols-2">
                            <div class="field-wrap">
                                <label class="field-label">Jenis Organisasi <span class="req">*</span></label>
                                <select name="jenis_organisasi" id="jenis_organisasi" class="field-control">
                                    <option value="">Pilih organisasi</option>
                                    <option>Ranting Muhammadiyah</option>
                                    <option>Ranting Aisyiyah</option>
                                    <option>IPM</option>
                                    <option>IMM</option>
                                    <option>Pemuda Muhammadiyah</option>
                                    <option>Nasyiatul Aisyiyah</option>
                                    <option>Kokam</option>
                                    <option>HW</option>
                                    <option>Tapak Suci</option>
                                </select>
                            </div>
                            <div class="field-wrap">
                                <label class="field-label">Nama Organisasi/Ranting <span class="req">*</span></label>
                                <input type="text" name="nama_organisasi" id="nama_organisasi" class="field-control" placeholder="Nama ranting / cabang">
                            </div>
                        </div>
                        <div class="field-group cols-2">
                            <div class="field-wrap">
                                <label class="field-label">Jabatan <span class="req">*</span></label>
                                <input type="text" name="jabatan" id="jabatan" class="field-control" placeholder="Jabatan dalam organisasi">
                            </div>
                            <div class="field-wrap">
                                <label class="field-label">Tahun Bergabung <span class="req">*</span></label>
                                <input type="number" name="tahun_bergabung" id="tahun_bergabung" class="field-control" placeholder="2020" min="2010" max="{{ date('Y') }}">
                            </div>
                        </div>
                        <div class="field-group">
                            <div class="field-wrap">
                                <label class="field-label">Riwayat Aktivitas <span class="req">*</span></label>
                                <textarea name="riwayat_aktivitas" id="riwayat_aktivitas" class="field-control" placeholder="Aktivitas yang pernah diikuti dalam Muhammadiyah..."></textarea>
                            </div>
                        </div>
                        <div class="field-group cols-2">
                            <div class="field-wrap">
                                <label class="field-label">Kontribusi <span class="req">*</span></label>
                                <textarea name="kontribusi" id="kontribusi" class="field-control" style="min-height:80px" placeholder="Kontribusi nyata untuk organisasi..."></textarea>
                            </div>
                            <div class="field-wrap">
                                <label class="field-label">Rencana Masa Depan <span class="req">*</span></label>
                                <textarea name="rencana_masa_depan" id="rencana_masa_depan" class="field-control" style="min-height:80px" placeholder="Rencana ke depan untuk Muhammadiyah..."></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ④ Ekonomi Keluarga -->
                <div class="form-card" id="sec-ekonomi">
                    <div class="card-header">
                        <div class="card-icon amber"><i class="fas fa-home"></i></div>
                        <div>
                            <p class="card-title">Data Ekonomi Keluarga</p>
                            <p class="card-subtitle">Digunakan untuk penilaian kebutuhan beasiswa</p>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="field-group cols-2">
                            <div class="field-wrap">
                                <label class="field-label">Nama Ayah <span class="req">*</span></label>
                                <input type="text" name="nama_ayah" class="field-control" placeholder="Nama lengkap ayah" required>
                            </div>
                            <div class="field-wrap">
                                <label class="field-label">Pekerjaan Ayah <span class="req">*</span></label>
                                <input type="text" name="pekerjaan_ayah" class="field-control" placeholder="Pekerjaan ayah" required>
                            </div>
                        </div>
                        <div class="field-group cols-2">
                            <div class="field-wrap">
                                <label class="field-label">Nama Ibu <span class="req">*</span></label>
                                <input type="text" name="nama_ibu" class="field-control" placeholder="Nama lengkap ibu" required>
                            </div>
                            <div class="field-wrap">
                                <label class="field-label">Pekerjaan Ibu <span class="req">*</span></label>
                                <input type="text" name="pekerjaan_ibu" class="field-control" placeholder="Pekerjaan ibu" required>
                            </div>
                        </div>
                        <div class="field-group cols-3">
                            <div class="field-wrap">
                                <label class="field-label">Penghasilan Ayah (Rp/bln) <span class="req">*</span></label>
                                <input type="number" name="penghasilan_ayah" class="field-control" placeholder="0" min="0" required>
                            </div>
                            <div class="field-wrap">
                                <label class="field-label">Penghasilan Ibu (Rp/bln) <span class="req">*</span></label>
                                <input type="number" name="penghasilan_ibu" class="field-control" placeholder="0" min="0" required>
                            </div>
                            <div class="field-wrap">
                                <label class="field-label">Jumlah Tanggungan <span class="req">*</span></label>
                                <input type="number" name="jumlah_tanggungan" class="field-control" placeholder="0" min="1" required>
                            </div>
                        </div>
                        <div class="field-group cols-2">
                            <div class="field-wrap">
                                <label class="field-label">Status Kepemilikan Rumah <span class="req">*</span></label>
                                <select name="status_rumah" class="field-control" required>
                                    <option value="">Pilih status</option>
                                    <option>Milik Sendiri</option>
                                    <option>Sewa</option>
                                    <option>Menumpang</option>
                                    <option>Warisan</option>
                                </select>
                            </div>
                        </div>
                        <div class="field-group">
                            <div class="field-wrap">
                                <label class="field-label">Deskripsi Kondisi Ekonomi <span class="req">*</span></label>
                                <textarea name="kondisi_ekonomi" class="field-control" placeholder="Jelaskan kondisi ekonomi keluarga secara singkat..." required></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ⑤ Dokumen -->
                <div class="form-card" id="sec-dokumen">
                    <div class="card-header">
                        <div class="card-icon rose"><i class="fas fa-paperclip"></i></div>
                        <div>
                            <p class="card-title">Upload Dokumen</p>
                            <p class="card-subtitle">Format: JPG, PNG, PDF · Klik tile untuk upload</p>
                        </div>
                    </div>
                    <div class="card-body">

                        <!-- Identitas -->
                        <div class="upload-section-title">
                            <i class="fas fa-id-card" style="color:var(--primary)"></i> Dokumen Identitas
                        </div>
                        <div class="upload-grid">
                            <div class="upload-tile" onclick="triggerUpload('ktp')">
                                <span class="req-badge"></span>
                                <input type="file" id="ktp" name="ktp" accept=".jpg,.jpeg,.png,.pdf" required>
                                <div class="upload-tile-icon"><i class="fas fa-id-card"></i></div>
                                <div class="upload-tile-label">KTP <span style="color:var(--danger)">*</span></div>
                                <div class="upload-tile-hint">JPG, PNG, PDF · 2MB</div>
                                <div class="upload-tile-filename" id="ktp-name"></div>
                            </div>
                            <div class="upload-tile" onclick="triggerUpload('kk')">
                                <span class="req-badge"></span>
                                <input type="file" id="kk" name="kk" accept=".jpg,.jpeg,.png,.pdf" required>
                                <div class="upload-tile-icon"><i class="fas fa-users"></i></div>
                                <div class="upload-tile-label">Kartu Keluarga <span style="color:var(--danger)">*</span></div>
                                <div class="upload-tile-hint">JPG, PNG, PDF · 2MB</div>
                                <div class="upload-tile-filename" id="kk-name"></div>
                            </div>
                            <div class="upload-tile" onclick="triggerUpload('ktm')">
                                <span class="req-badge"></span>
                                <input type="file" id="ktm" name="ktm" accept=".jpg,.jpeg,.png" required>
                                <div class="upload-tile-icon"><i class="fas fa-id-badge"></i></div>
                                <div class="upload-tile-label">KTM <span style="color:var(--danger)">*</span></div>
                                <div class="upload-tile-hint">JPG, PNG · 2MB</div>
                                <div class="upload-tile-filename" id="ktm-name"></div>
                            </div>
                        </div>

                        <!-- Akademik -->
                        <div class="upload-section-title">
                            <i class="fas fa-graduation-cap" style="color:var(--info)"></i> Dokumen Akademik
                        </div>
                        <div class="upload-grid">
                            <div class="upload-tile" onclick="triggerUpload('transkrip')">
                                <span class="req-badge"></span>
                                <input type="file" id="transkrip" name="transkrip" accept=".pdf" required>
                                <div class="upload-tile-icon"><i class="fas fa-file-alt"></i></div>
                                <div class="upload-tile-label">Transkrip Nilai <span style="color:var(--danger)">*</span></div>
                                <div class="upload-tile-hint">PDF · 5MB</div>
                                <div class="upload-tile-filename" id="transkrip-name"></div>
                            </div>
                            <div class="upload-tile" onclick="triggerUpload('cv')">
                                <span class="req-badge"></span>
                                <input type="file" id="cv" name="cv" accept=".pdf,.doc,.docx" required>
                                <div class="upload-tile-icon"><i class="fas fa-file-user"></i></div>
                                <div class="upload-tile-label">CV <span style="color:var(--danger)">*</span></div>
                                <div class="upload-tile-hint">PDF, DOC · 2MB</div>
                                <div class="upload-tile-filename" id="cv-name"></div>
                            </div>
                            <div class="upload-tile" onclick="triggerUpload('motivation_letter')">
                                <span class="req-badge"></span>
                                <input type="file" id="motivation_letter" name="motivation_letter" accept=".pdf,.doc,.docx" required>
                                <div class="upload-tile-icon"><i class="fas fa-envelope-open-text"></i></div>
                                <div class="upload-tile-label">Motivation Letter <span style="color:var(--danger)">*</span></div>
                                <div class="upload-tile-hint">PDF, DOC · 2MB</div>
                                <div class="upload-tile-filename" id="motivation_letter-name"></div>
                            </div>
                        </div>

                        <!-- Ekonomi -->
                        <div class="upload-section-title">
                            <i class="fas fa-money-check-alt" style="color:#b45309"></i> Dokumen Ekonomi
                        </div>
                        <div class="upload-grid">
                            <div class="upload-tile" onclick="triggerUpload('surat_penghasilan')">
                                <span class="req-badge"></span>
                                <input type="file" id="surat_penghasilan" name="surat_penghasilan" accept=".pdf" required>
                                <div class="upload-tile-icon"><i class="fas fa-money-bill-wave"></i></div>
                                <div class="upload-tile-label">Surat Keterangan Penghasilan <span style="color:var(--danger)">*</span></div>
                                <div class="upload-tile-hint">PDF · 3MB</div>
                                <div class="upload-tile-filename" id="surat_penghasilan-name"></div>
                            </div>
                            <div class="upload-tile" onclick="triggerUpload('slip_gaji_ortu')">
                                <span class="req-badge"></span>
                                <input type="file" id="slip_gaji_ortu" name="slip_gaji_ortu" accept=".pdf,.jpg,.jpeg,.png" required>
                                <div class="upload-tile-icon"><i class="fas fa-receipt"></i></div>
                                <div class="upload-tile-label">Slip Gaji Orang Tua <span style="color:var(--danger)">*</span></div>
                                <div class="upload-tile-hint">PDF, JPG, PNG · 2MB</div>
                                <div class="upload-tile-filename" id="slip_gaji_ortu-name"></div>
                            </div>
                            <div class="upload-tile" onclick="triggerUpload('surat_tidak_menerima_beasiswa')">
                                <span class="req-badge"></span>
                                <input type="file" id="surat_tidak_menerima_beasiswa" name="surat_tidak_menerima_beasiswa" accept=".pdf,.jpg,.jpeg,.png" required>
                                <div class="upload-tile-icon"><i class="fas fa-file-contract"></i></div>
                                <div class="upload-tile-label">Surat Tidak Terima Beasiswa Lain <span style="color:var(--danger)">*</span></div>
                                <div class="upload-tile-hint">PDF, JPG, PNG · 2MB</div>
                                <div class="upload-tile-filename" id="surat_tidak_menerima_beasiswa-name"></div>
                            </div>
                        </div>

                        <!-- Dhuafa Only -->
                        <div class="dhuafa-section" id="doc-dhuafa">
                            <div class="upload-section-title">
                                <i class="fas fa-hand-holding-heart" style="color:var(--danger)"></i> Dokumen Khusus Dhuafa
                            </div>
                            <div class="upload-grid">
                                <div class="upload-tile" onclick="triggerUpload('surat_tidak_mampu')">
                                    <span class="req-badge"></span>
                                    <input type="file" id="surat_tidak_mampu" name="surat_tidak_mampu" accept=".pdf">
                                    <div class="upload-tile-icon"><i class="fas fa-file-medical"></i></div>
                                    <div class="upload-tile-label">SKTM <span style="color:var(--danger)">*</span></div>
                                    <div class="upload-tile-hint">Surat Tidak Mampu · PDF · 3MB</div>
                                    <div class="upload-tile-filename" id="surat_tidak_mampu-name"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Kader Only -->
                        <div class="kader-section" id="doc-kader">
                            <div class="upload-section-title">
                                <i class="fas fa-star-and-crescent" style="color:var(--success)"></i> Dokumen Khusus Kader
                            </div>
                            <div class="upload-grid">
                                <div class="upload-tile" onclick="triggerUpload('surat_aktif_organisasi')">
                                    <span class="req-badge"></span>
                                    <input type="file" id="surat_aktif_organisasi" name="surat_aktif_organisasi" accept=".pdf">
                                    <div class="upload-tile-icon"><i class="fas fa-file-signature"></i></div>
                                    <div class="upload-tile-label">SK Aktif Organisasi <span style="color:var(--danger)">*</span></div>
                                    <div class="upload-tile-hint">PDF · 3MB</div>
                                    <div class="upload-tile-filename" id="surat_aktif_organisasi-name"></div>
                                </div>
                                <div class="upload-tile" onclick="triggerUpload('surat_rekomendasi')">
                                    <span class="req-badge"></span>
                                    <input type="file" id="surat_rekomendasi" name="surat_rekomendasi" accept=".pdf">
                                    <div class="upload-tile-icon"><i class="fas fa-file-signature"></i></div>
                                    <div class="upload-tile-label">Surat Rekomendasi <span style="color:var(--danger)">*</span></div>
                                    <div class="upload-tile-hint">PDF · 2MB</div>
                                    <div class="upload-tile-filename" id="surat_rekomendasi-name"></div>
                                </div>
                                <div class="upload-tile" onclick="triggerUpload('ktam')">
                                    <span class="req-badge"></span>
                                    <input type="file" id="ktam" name="ktam" accept=".jpg,.jpeg,.png">
                                    <div class="upload-tile-icon"><i class="fas fa-id-card-alt"></i></div>
                                    <div class="upload-tile-label">KTAM <span style="color:var(--danger)">*</span></div>
                                    <div class="upload-tile-hint">Kartu Anggota · JPG, PNG · 2MB</div>
                                    <div class="upload-tile-filename" id="ktam-name"></div>
                                </div>
                                <div class="upload-tile" onclick="triggerUpload('sertifikat_prestasi')">
                                    <input type="file" id="sertifikat_prestasi" name="sertifikat_prestasi" accept=".pdf">
                                    <div class="upload-tile-icon"><i class="fas fa-certificate"></i></div>
                                    <div class="upload-tile-label">Sertifikat Prestasi</div>
                                    <div class="upload-tile-hint">Opsional · PDF · 5MB</div>
                                    <div class="upload-tile-filename" id="sertifikat_prestasi-name"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Foto Rumah -->
                        <div class="upload-section-title">
                            <i class="fas fa-home" style="color:#7c3aed"></i> Foto Kondisi Rumah
                        </div>
                        <div class="upload-grid">
                            <div class="upload-tile" onclick="triggerUpload('foto_rumah_depan')">
                                <span class="req-badge"></span>
                                <input type="file" id="foto_rumah_depan" name="foto_rumah_depan" accept=".jpg,.jpeg,.png" required>
                                <div class="upload-tile-icon"><i class="fas fa-house-user"></i></div>
                                <div class="upload-tile-label">Tampak Depan <span style="color:var(--danger)">*</span></div>
                                <div class="upload-tile-hint">JPG, PNG · 2MB</div>
                                <div class="upload-tile-filename" id="foto_rumah_depan-name"></div>
                            </div>
                            <div class="upload-tile" onclick="triggerUpload('foto_rumah_samping')">
                                <span class="req-badge"></span>
                                <input type="file" id="foto_rumah_samping" name="foto_rumah_samping" accept=".jpg,.jpeg,.png" required>
                                <div class="upload-tile-icon"><i class="fas fa-home"></i></div>
                                <div class="upload-tile-label">Tampak Samping <span style="color:var(--danger)">*</span></div>
                                <div class="upload-tile-hint">JPG, PNG · 2MB</div>
                                <div class="upload-tile-filename" id="foto_rumah_samping-name"></div>
                            </div>
                            <div class="upload-tile" onclick="triggerUpload('foto_ruang_tamu')">
                                <span class="req-badge"></span>
                                <input type="file" id="foto_ruang_tamu" name="foto_ruang_tamu" accept=".jpg,.jpeg,.png" required>
                                <div class="upload-tile-icon"><i class="fas fa-couch"></i></div>
                                <div class="upload-tile-label">Ruang Tamu <span style="color:var(--danger)">*</span></div>
                                <div class="upload-tile-hint">JPG, PNG · 2MB</div>
                                <div class="upload-tile-filename" id="foto_ruang_tamu-name"></div>
                            </div>
                            <div class="upload-tile" onclick="triggerUpload('foto_kamar_mandi')">
                                <span class="req-badge"></span>
                                <input type="file" id="foto_kamar_mandi" name="foto_kamar_mandi" accept=".jpg,.jpeg,.png" required>
                                <div class="upload-tile-icon"><i class="fas fa-bath"></i></div>
                                <div class="upload-tile-label">Kamar Mandi <span style="color:var(--danger)">*</span></div>
                                <div class="upload-tile-hint">JPG, PNG · 2MB</div>
                                <div class="upload-tile-filename" id="foto_kamar_mandi-name"></div>
                            </div>
                            <div class="upload-tile" onclick="triggerUpload('foto_dapur')">
                                <span class="req-badge"></span>
                                <input type="file" id="foto_dapur" name="foto_dapur" accept=".jpg,.jpeg,.png" required>
                                <div class="upload-tile-icon"><i class="fas fa-utensils"></i></div>
                                <div class="upload-tile-label">Dapur <span style="color:var(--danger)">*</span></div>
                                <div class="upload-tile-hint">JPG, PNG · 2MB</div>
                                <div class="upload-tile-filename" id="foto_dapur-name"></div>
                            </div>
                        </div>

                        <!-- Pendukung -->
                        <div class="upload-section-title">
                            <i class="fas fa-paperclip" style="color:var(--text-secondary)"></i> Dokumen Pendukung
                        </div>
                        <div class="upload-grid">
                            <div class="upload-tile" onclick="triggerUpload('pas_foto')">
                                <span class="req-badge"></span>
                                <input type="file" id="pas_foto" name="pas_foto" accept=".jpg,.jpeg,.png" required>
                                <div class="upload-tile-icon"><i class="fas fa-portrait"></i></div>
                                <div class="upload-tile-label">Pas Foto 3×4 <span style="color:var(--danger)">*</span></div>
                                <div class="upload-tile-hint">JPG, PNG · 2MB</div>
                                <div class="upload-tile-filename" id="pas_foto-name"></div>
                            </div>
                            <div class="upload-tile" onclick="triggerUpload('twibbon')">
                                <span class="req-badge"></span>
                                <input type="file" id="twibbon" name="twibbon" accept=".jpg,.jpeg,.png" required>
                                <div class="upload-tile-icon"><i class="fas fa-image"></i></div>
                                <div class="upload-tile-label">Twibbon <span style="color:var(--danger)">*</span></div>
                                <div class="upload-tile-hint">JPG, PNG · 2MB</div>
                                <div class="upload-tile-filename" id="twibbon-name"></div>
                            </div>
                            <div class="upload-tile" onclick="triggerUpload('surat_kesanggupan_relawan')">
                                <span class="req-badge"></span>
                                <input type="file" id="surat_kesanggupan_relawan" name="surat_kesanggupan_relawan" accept=".pdf,.jpg,.jpeg,.png" required>
                                <div class="upload-tile-icon"><i class="fas fa-hands-helping"></i></div>
                                <div class="upload-tile-label">Surat Kesanggupan Relawan <span style="color:var(--danger)">*</span></div>
                                <div class="upload-tile-hint">PDF, JPG, PNG · 2MB</div>
                                <div class="upload-tile-filename" id="surat_kesanggupan_relawan-name"></div>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Submit -->
                <div class="submit-card">
                    <div class="submit-hint">
                        <strong>Siap menyimpan?</strong>
                        Pastikan semua kolom bertanda <span style="color:var(--danger)">*</span> sudah terisi.
                    </div>
                    <button type="submit" class="btn-submit">
                        <i class="fas fa-paper-plane"></i> Simpan Data Pendaftar
                    </button>
                </div>

            </div><!-- end form-body -->
        </div><!-- end form-layout -->
    </form>
</div>

<script>
function triggerUpload(id) {
    document.getElementById(id).click();
}

document.addEventListener('DOMContentLoaded', function () {

    /* ── Kategori toggle ── */
    const cardDhuafa  = document.getElementById('card-dhuafa');
    const cardKader   = document.getElementById('card-kader');
    const hiddenInput = document.getElementById('jenis_pendaftaran');

    const kaderSections  = document.querySelectorAll('.kader-section');
    const dhuafaSections = document.querySelectorAll('.dhuafa-section');

    const fieldsKader = ['jenis_organisasi','nama_organisasi','jabatan','tahun_bergabung','riwayat_aktivitas','kontribusi','rencana_masa_depan'];
    const filesKader  = ['surat_aktif_organisasi','surat_rekomendasi','ktam'];
    const filesDhuafa = ['surat_tidak_mampu'];

    function toggleKategori(jenis) {
        hiddenInput.value = jenis;
        const isKader = jenis === 'kader';

        cardKader.classList.toggle('active', isKader);
        cardDhuafa.classList.toggle('active', !isKader);

        kaderSections.forEach(el => el.classList.toggle('active', isKader));
        dhuafaSections.forEach(el => el.classList.toggle('hidden', isKader));

        fieldsKader.forEach(id => {
            const el = document.getElementById(id);
            if (el) isKader ? el.setAttribute('required','') : el.removeAttribute('required');
        });
        filesKader.forEach(id => {
            const el = document.getElementById(id);
            if (el) isKader ? el.setAttribute('required','') : el.removeAttribute('required');
        });
        filesDhuafa.forEach(id => {
            const el = document.getElementById(id);
            if (el) isKader ? el.removeAttribute('required') : el.setAttribute('required','');
        });
    }

    cardDhuafa.addEventListener('click', () => toggleKategori('dhuafa'));
    cardKader.addEventListener('click',  () => toggleKategori('kader'));
    toggleKategori('dhuafa');

    /* ── File upload tile feedback ── */
    document.querySelectorAll('input[type="file"]').forEach(input => {
        input.addEventListener('change', function () {
            const file = this.files[0];
            if (!file) return;

            if (file.size > 5 * 1024 * 1024) {
                alert('File terlalu besar. Maksimal 5MB.');
                this.value = '';
                return;
            }

            const tile   = this.closest('.upload-tile');
            const nameEl = document.getElementById(this.id + '-name');
            const iconEl = tile.querySelector('.upload-tile-icon i');

            tile.classList.add('has-file');
            iconEl.className = 'fas fa-check-circle';
            if (nameEl) nameEl.textContent = file.name.length > 22
                ? file.name.substring(0, 19) + '…'
                : file.name;
        });
    });
});
</script>

@endsection