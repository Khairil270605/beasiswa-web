@extends('layouts.app')

@section('title', 'Form Pendaftaran Beasiswa')

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

        .main-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            margin: 20px auto;
            max-width: 900px;
        }

        .header-section {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 2rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .header-section::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="75" cy="75" r="1.5" fill="rgba(255,255,255,0.05)"/><circle cx="50" cy="10" r="0.5" fill="rgba(255,255,255,0.1)"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>') repeat;
            animation: float 20s infinite linear;
        }

        @keyframes float {
            0% { transform: translate(-50%, -50%) rotate(0deg); }
            100% { transform: translate(-50%, -50%) rotate(360deg); }
        }

        .step-indicator {
            display: flex;
            justify-content: center;
            margin: 2rem 0;
            position: relative;
            z-index: 2;
        }

        .step {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 10px;
            color: white;
            font-weight: bold;
            transition: all 0.3s ease;
            position: relative;
        }

        .step.active {
            background: var(--warning-color);
            color: #000;
            transform: scale(1.2);
            box-shadow: 0 0 20px rgba(255, 193, 7, 0.5);
        }

        .step.completed { background: var(--success-color); }

        .step::after {
            content: '';
            position: absolute;
            width: 60px;
            height: 2px;
            background: rgba(255, 255, 255, 0.3);
            right: -35px;
            top: 50%;
            transform: translateY(-50%);
        }

        .step:last-child::after { display: none; }

        .form-section {
            padding: 2rem;
            display: none;
            animation: slideIn 0.5s ease-out;
        }

        .form-section.active { display: block; }

        @keyframes slideIn {
            from { opacity: 0; transform: translateY(30px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .form-floating { position: relative; margin-bottom: 1.5rem; }

        .form-floating input,
        .form-floating select,
        .form-floating textarea {
            border: 2px solid #e9ecef;
            border-radius: 15px;
            padding: 1rem 1.25rem;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.8);
        }

        .form-floating input:focus,
        .form-floating select:focus,
        .form-floating textarea:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(255, 107, 53, 0.25);
            background: white;
        }

        .form-floating label {
            padding: 1rem 1.25rem;
            color: #6c757d;
            font-weight: 500;
        }

        /* ---- Upload Grid (compact card style) ---- */
        .upload-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
            margin-bottom: 1.2rem;
        }

        .upload-card {
            border: 1.5px dashed #dee2e6;
            border-radius: 12px;
            padding: 0.75rem 0.6rem;
            text-align: center;
            transition: all 0.25s ease;
            background: rgba(255, 255, 255, 0.6);
            cursor: pointer;
            position: relative;
            min-height: 118px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 4px;
            margin: 0;
        }

        .upload-card:hover {
            border-color: var(--primary-color);
            background: rgba(255, 107, 53, 0.05);
        }

        .upload-card.done {
            border-style: solid;
            border-color: var(--success-color);
            background: rgba(40, 167, 69, 0.07);
        }

        .upload-card.error {
            border-style: solid;
            border-color: var(--accent-color);
            background: rgba(220, 53, 69, 0.07);
        }

        .upload-card .card-icon {
            font-size: 1.4rem;
            color: var(--primary-color);
            line-height: 1;
        }

        .upload-card.done .card-icon { color: var(--success-color); }

        .upload-card .card-label {
            font-size: 0.7rem;
            font-weight: 600;
            color: #495057;
            line-height: 1.3;
            margin: 0;
        }

        .upload-card .card-hint {
            font-size: 0.6rem;
            color: #adb5bd;
            margin: 0;
        }

        .upload-card .card-filename {
            font-size: 0.6rem;
            color: var(--success-color);
            font-weight: 600;
            word-break: break-all;
            max-width: 100%;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            padding: 0 4px;
        }

        .upload-card .remove-btn {
            position: absolute;
            top: 4px; right: 4px;
            background: var(--accent-color);
            border: none;
            color: white;
            width: 18px; height: 18px;
            border-radius: 50%;
            font-size: 0.55rem;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            padding: 0; line-height: 1;
        }

        .upload-card input[type="file"] { display: none; }

        .upload-group-label {
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: var(--secondary-color);
            border-bottom: 1.5px solid var(--secondary-color);
            padding-bottom: 4px;
            margin: 1rem 0 0.6rem;
        }

        /* ---- Navigation ---- */
        .navigation-buttons {
            display: flex;
            justify-content: space-between;
            padding: 2rem;
            background: rgba(248, 249, 250, 0.5);
        }

        .nav-btn {
            padding: 0.75rem 2rem;
            border-radius: 25px;
            border: none;
            font-weight: 600;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .btn-prev  { background: #6c757d; color: white; }
        .btn-next  { background: linear-gradient(135deg, var(--primary-color), var(--secondary-color)); color: white; }
        .btn-submit{ background: linear-gradient(135deg, var(--success-color), var(--info-color)); color: white; }

        .nav-btn:hover { transform: translateY(-2px); box-shadow: 0 10px 20px rgba(0,0,0,0.2); }

        /* ---- Misc ---- */
        .section-title {
            color: var(--primary-color);
            font-weight: 700;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .section-icon {
            width: 50px; height: 50px;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border-radius: 15px;
            display: flex; align-items: center; justify-content: center;
            color: white; font-size: 1.2rem;
        }

        .progress-bar-container {
            margin: 1rem 0;
            background: rgba(255,255,255,0.3);
            height: 6px; border-radius: 3px; overflow: hidden;
        }

        .progress-bar {
            height: 100%;
            background: linear-gradient(90deg, var(--warning-color), var(--success-color));
            width: 20%;
            transition: width 0.5s ease;
            border-radius: 3px;
        }

        .floating-particles {
            position: fixed; top: 0; left: 0;
            width: 100%; height: 100%;
            pointer-events: none; z-index: -1;
        }

        .particle {
            position: absolute;
            width: 4px; height: 4px;
            background: rgba(255,255,255,0.5);
            border-radius: 50%;
            animation: floatParticle 15s infinite linear;
        }

        @keyframes floatParticle {
            0%   { transform: translateY(100vh) translateX(0px) rotate(0deg); opacity: 0; }
            10%  { opacity: 1; }
            90%  { opacity: 1; }
            100% { transform: translateY(-10vh) translateX(100px) rotate(360deg); opacity: 0; }
        }

        .lazismu-brand { color: var(--warning-color); font-weight: 800; text-shadow: 2px 2px 4px rgba(0,0,0,0.3); }
        .required-star { color: var(--accent-color); }

        .form-info {
            background: rgba(255,255,255,0.9);
            border-left: 4px solid var(--info-color);
            padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem;
        }

        @media (max-width: 768px) {
            .main-container { margin: 10px; border-radius: 15px; }
            .header-section { padding: 1.5rem 1rem; }
            .form-section   { padding: 1.5rem 1rem; }
            .navigation-buttons { padding: 1.5rem 1rem; flex-direction: column; gap: 1rem; }
            .step-indicator { margin: 1rem 0; }
            .step { width: 35px; height: 35px; margin: 0 5px; }
            .upload-grid { grid-template-columns: repeat(2, 1fr); }
        }
    </style>

    <div class="floating-particles" id="particles"></div>

    <div class="container">
        <div class="main-container">

            <!-- Header -->
            <div class="header-section">
                <h1 class="mb-3">
                    <i class="fas fa-graduation-cap me-3"></i>
                    Form Pendaftaran Beasiswa <span class="lazismu-brand">LAZISMU</span>
                </h1>
                <h5 class="mb-3 opacity-90">Kategori: Kader Muhammadiyah</h5>
                <p class="mb-0">Silakan lengkapi semua data dengan benar dan upload dokumen yang diperlukan</p>

                <div class="progress-bar-container">
                    <div class="progress-bar" id="progressBar"></div>
                </div>

                <div class="step-indicator">
                    <div class="step active" data-step="1">1</div>
                    <div class="step" data-step="2">2</div>
                    <div class="step" data-step="3">3</div>
                    <div class="step" data-step="4">4</div>
                    <div class="step" data-step="5">5</div>
                </div>
            </div>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form id="kaderForm" action="/daftar/kader" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="jenis_pendaftaran" value="kader">

                <!-- ===================== STEP 1: Data Pribadi ===================== -->
                <div class="form-section active" data-step="1">
                    <h3 class="section-title">
                        <div class="section-icon"><i class="fas fa-user"></i></div>
                        Data Pribadi <span class="required-star">*</span>
                    </h3>

                    <div class="form-info">
                        <i class="fas fa-info-circle me-2 text-info"></i>
                        <strong>Petunjuk:</strong> Pastikan semua data pribadi sesuai dengan dokumen resmi yang dimiliki.
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Lengkap" required>
                                <label for="nama">Nama Lengkap <span class="required-star">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="nik" name="nik" placeholder="NIK" maxlength="16" required>
                                <label for="nik">NIK (Nomor Induk Kependudukan) <span class="required-star">*</span></label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" placeholder="Tempat Lahir" required>
                                <label for="tempat_lahir">Tempat Lahir <span class="required-star">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" required>
                                <label for="tanggal_lahir">Tanggal Lahir <span class="required-star">*</span></label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required>
                                    <option value="">Pilih Jenis Kelamin</option>
                                    <option value="L">Laki-laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                                <label for="jenis_kelamin">Jenis Kelamin <span class="required-star">*</span></label>
                            </div>
                        </div>
                    </div>

                    <div class="form-floating">
                        <textarea class="form-control" id="alamat" name="alamat" style="height:120px" placeholder="Alamat Lengkap" required></textarea>
                        <label for="alamat">Alamat Lengkap <span class="required-star">*</span></label>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="tel" class="form-control" id="no_telepon" name="no_telepon" placeholder="Nomor Telepon" required>
                                <label for="no_telepon">Nomor Telepon <span class="required-star">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="email" class="form-control" id="email" name="email"
                                       value="{{ auth()->user()->email }}" readonly>
                                <label for="email">Alamat Email <span class="required-star">*</span></label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ===================== STEP 2: Data Akademik ===================== -->
                <div class="form-section" data-step="2">
                    <h3 class="section-title">
                        <div class="section-icon"><i class="fas fa-book"></i></div>
                        Data Akademik <span class="required-star">*</span>
                    </h3>

                    <div class="form-info">
                        <i class="fas fa-university me-2 text-info"></i>
                        <strong>Info:</strong> Data akademik harus sesuai dengan data di kampus dan transkrip nilai.
                    </div>

                    <div class="form-floating">
                        <input type="text" class="form-control" id="asal_kampus" name="asal_kampus" placeholder="Asal Kampus" required>
                        <label for="asal_kampus">Asal Kampus/Universitas <span class="required-star">*</span></label>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="nim" name="nim" placeholder="NIM" required>
                                <label for="nim">NIM (Nomor Induk Mahasiswa) <span class="required-star">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select class="form-select" id="semester" name="semester" required>
                                    <option value="">Pilih Semester</option>
                                    @for($i=1;$i<=8;$i++)
                                        <option value="{{ $i }}">Semester {{ $i }}</option>
                                    @endfor
                                </select>
                                <label for="semester">Semester Saat Ini <span class="required-star">*</span></label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="fakultas" name="fakultas" placeholder="Fakultas" required>
                                <label for="fakultas">Fakultas <span class="required-star">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="jurusan" name="jurusan" placeholder="Jurusan" required>
                                <label for="jurusan">Program Studi/Jurusan <span class="required-star">*</span></label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="number" class="form-control" id="ipk" name="ipk" placeholder="IPK" step="0.01" min="0" max="4" required>
                                <label for="ipk">IPK (Indeks Prestasi Kumulatif) <span class="required-star">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="number" class="form-control" id="tahun_masuk" name="tahun_masuk" placeholder="Tahun Masuk" min="2015" max="2025" required>
                                <label for="tahun_masuk">Tahun Masuk <span class="required-star">*</span></label>
                            </div>
                        </div>
                    </div>

                    <div class="form-floating">
                        <textarea class="form-control" id="prestasi" name="prestasi" style="height:120px" placeholder="Prestasi Akademik/Non-Akademik (Optional)"></textarea>
                        <label for="prestasi">Prestasi Akademik/Non-Akademik (Jika Ada)</label>
                    </div>
                </div>

                <!-- ===================== STEP 3: Data Organisasi ===================== -->
                <div class="form-section" data-step="3">
                    <h3 class="section-title">
                        <div class="section-icon"><i class="fas fa-star-and-crescent"></i></div>
                        Data Organisasi Muhammadiyah <span class="required-star">*</span>
                    </h3>

                    <div class="form-info">
                        <i class="fas fa-mosque me-2 text-info"></i>
                        <strong>Khusus:</strong> Data ini khusus untuk kader Muhammadiyah yang aktif dalam organisasi.
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select class="form-select" id="jenis_organisasi" name="jenis_organisasi" required>
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
                                <label for="jenis_organisasi">Jenis Organisasi <span class="required-star">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="nama_organisasi" name="nama_organisasi" placeholder="Nama Organisasi" required>
                                <label for="nama_organisasi">Nama Organisasi/Ranting <span class="required-star">*</span></label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="jabatan" name="jabatan" placeholder="Jabatan dalam Organisasi" required>
                                <label for="jabatan">Jabatan dalam Organisasi <span class="required-star">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="number" class="form-control" id="tahun_bergabung" name="tahun_bergabung" placeholder="Tahun Bergabung" min="2010" max="2025" required>
                                <label for="tahun_bergabung">Tahun Bergabung <span class="required-star">*</span></label>
                            </div>
                        </div>
                    </div>

                    <div class="form-floating">
                        <textarea class="form-control" id="riwayat_aktivitas" name="riwayat_aktivitas" style="height:150px" placeholder="Riwayat Aktivitas dalam Muhammadiyah" required></textarea>
                        <label for="riwayat_aktivitas">Riwayat Aktivitas dalam Muhammadiyah <span class="required-star">*</span></label>
                    </div>

                    <div class="form-floating">
                        <textarea class="form-control" id="kontribusi" name="kontribusi" style="height:120px" placeholder="Kontribusi untuk Muhammadiyah" required></textarea>
                        <label for="kontribusi">Kontribusi yang telah diberikan untuk Muhammadiyah <span class="required-star">*</span></label>
                    </div>

                    <div class="form-floating">
                        <textarea class="form-control" id="rencana_masa_depan" name="rencana_masa_depan" style="height:120px" placeholder="Rencana masa depan untuk Muhammadiyah" required></textarea>
                        <label for="rencana_masa_depan">Rencana masa depan untuk berkontribusi pada Muhammadiyah <span class="required-star">*</span></label>
                    </div>
                </div>

                <!-- ===================== STEP 4: Data Ekonomi Keluarga ===================== -->
                <div class="form-section" data-step="4">
                    <h3 class="section-title">
                        <div class="section-icon"><i class="fas fa-home"></i></div>
                        Data Ekonomi Keluarga <span class="required-star">*</span>
                    </h3>

                    <div class="form-info">
                        <i class="fas fa-info-circle me-2 text-info"></i>
                        <strong>Penting:</strong> Data ekonomi keluarga akan digunakan untuk menilai kebutuhan beasiswa.
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="nama_ayah" name="nama_ayah" placeholder="Nama Ayah" required>
                                <label for="nama_ayah">Nama Ayah <span class="required-star">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="pekerjaan_ayah" name="pekerjaan_ayah" placeholder="Pekerjaan Ayah" required>
                                <label for="pekerjaan_ayah">Pekerjaan Ayah <span class="required-star">*</span></label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="nama_ibu" name="nama_ibu" placeholder="Nama Ibu" required>
                                <label for="nama_ibu">Nama Ibu <span class="required-star">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="pekerjaan_ibu" name="pekerjaan_ibu" placeholder="Pekerjaan Ibu" required>
                                <label for="pekerjaan_ibu">Pekerjaan Ibu <span class="required-star">*</span></label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="number" class="form-control" id="penghasilan_ayah" name="penghasilan_ayah" placeholder="Penghasilan Ayah" min="0" required>
                                <label for="penghasilan_ayah">Penghasilan Ayah (Rp/bulan) <span class="required-star">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="number" class="form-control" id="penghasilan_ibu" name="penghasilan_ibu" placeholder="Penghasilan Ibu" min="0">
                                <label for="penghasilan_ibu">Penghasilan Ibu (Rp/bulan)</label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="number" class="form-control" id="jumlah_tanggungan" name="jumlah_tanggungan" placeholder="Jumlah Tanggungan" min="1" required>
                                <label for="jumlah_tanggungan">Jumlah Tanggungan Keluarga <span class="required-star">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select class="form-select" id="status_rumah" name="status_rumah" required>
                                    <option value="">Pilih Status Rumah</option>
                                    <option value="Milik Sendiri">Milik Sendiri</option>
                                    <option value="Sewa">Sewa/Kontrak</option>
                                    <option value="Menumpang">Menumpang</option>
                                    <option value="Warisan">Warisan</option>
                                </select>
                                <label for="status_rumah">Status Kepemilikan Rumah <span class="required-star">*</span></label>
                            </div>
                        </div>
                    </div>

                    <div class="form-floating">
                        <textarea class="form-control" id="kondisi_ekonomi" name="kondisi_ekonomi" style="height:120px" placeholder="Kondisi Ekonomi Keluarga" required></textarea>
                        <label for="kondisi_ekonomi">Deskripsi Kondisi Ekonomi Keluarga <span class="required-star">*</span></label>
                    </div>
                </div>

                <!-- ===================== STEP 5: Upload Dokumen ===================== -->
                <div class="form-section" data-step="5">
                    <h3 class="section-title">
                        <div class="section-icon"><i class="fas fa-upload"></i></div>
                        Upload Dokumen <span class="required-star">*</span>
                    </h3>

                    <div class="form-info">
                        <i class="fas fa-file-upload me-2 text-info"></i>
                        <strong>Perhatian:</strong> Klik kartu untuk memilih file. Format JPG/PNG/PDF, ukuran sesuai keterangan.
                    </div>

                    <!-- Identitas -->
                    <p class="upload-group-label"><i class="fas fa-id-card me-1"></i> Dokumen Identitas</p>
                    <div class="upload-grid">

                        <label class="upload-card" id="card-ktp" for="ktp">
                            <i class="fas fa-id-card card-icon"></i>
                            <p class="card-label">KTP <span class="required-star">*</span></p>
                            <p class="card-hint">JPG/PNG/PDF · maks 2MB</p>
                            <span class="card-filename" id="name-ktp"></span>
                            <button type="button" class="remove-btn" id="rm-ktp" onclick="removeFileCard(event,'ktp')" style="display:none">✕</button>
                            <input type="file" id="ktp" name="ktp" accept=".jpg,.jpeg,.png,.pdf" required>
                        </label>

                        <label class="upload-card" id="card-kk" for="kk">
                            <i class="fas fa-users card-icon"></i>
                            <p class="card-label">Kartu Keluarga <span class="required-star">*</span></p>
                            <p class="card-hint">JPG/PNG/PDF · maks 2MB</p>
                            <span class="card-filename" id="name-kk"></span>
                            <button type="button" class="remove-btn" id="rm-kk" onclick="removeFileCard(event,'kk')" style="display:none">✕</button>
                            <input type="file" id="kk" name="kk" accept=".jpg,.jpeg,.png,.pdf" required>
                        </label>

                    </div>

                    <!-- Akademik -->
                    <p class="upload-group-label"><i class="fas fa-graduation-cap me-1"></i> Dokumen Akademik</p>
                    <div class="upload-grid">

                        <label class="upload-card" id="card-transkrip" for="transkrip">
                            <i class="fas fa-file-alt card-icon"></i>
                            <p class="card-label">Transkrip Nilai <span class="required-star">*</span></p>
                            <p class="card-hint">PDF · maks 5MB</p>
                            <span class="card-filename" id="name-transkrip"></span>
                            <button type="button" class="remove-btn" id="rm-transkrip" onclick="removeFileCard(event,'transkrip')" style="display:none">✕</button>
                            <input type="file" id="transkrip" name="transkrip" accept=".pdf" required>
                        </label>

                        <label class="upload-card" id="card-ktm" for="ktm">
                            <i class="fas fa-id-badge card-icon"></i>
                            <p class="card-label">KTM <span class="required-star">*</span></p>
                            <p class="card-hint">JPG/PNG · maks 2MB</p>
                            <span class="card-filename" id="name-ktm"></span>
                            <button type="button" class="remove-btn" id="rm-ktm" onclick="removeFileCard(event,'ktm')" style="display:none">✕</button>
                            <input type="file" id="ktm" name="ktm" accept=".jpg,.jpeg,.png" required>
                        </label>

                    </div>

                    <!-- Ekonomi -->
                    <p class="upload-group-label"><i class="fas fa-money-check-alt me-1"></i> Dokumen Ekonomi</p>
                    <div class="upload-grid">

                        <label class="upload-card" id="card-penghasilan" for="penghasilan">
                            <i class="fas fa-money-bill-wave card-icon"></i>
                            <p class="card-label">Surat Penghasilan <span class="required-star">*</span></p>
                            <p class="card-hint">PDF · maks 3MB</p>
                            <span class="card-filename" id="name-penghasilan"></span>
                            <button type="button" class="remove-btn" id="rm-penghasilan" onclick="removeFileCard(event,'penghasilan')" style="display:none">✕</button>
                            <input type="file" id="penghasilan" name="surat_penghasilan" accept=".pdf" required>
                        </label>

                        <label class="upload-card" id="card-slip_gaji" for="slip_gaji">
                            <i class="fas fa-receipt card-icon"></i>
                            <p class="card-label">Slip Gaji Ortu <span class="required-star">*</span></p>
                            <p class="card-hint">PDF/JPG/PNG · maks 2MB</p>
                            <span class="card-filename" id="name-slip_gaji"></span>
                            <button type="button" class="remove-btn" id="rm-slip_gaji" onclick="removeFileCard(event,'slip_gaji')" style="display:none">✕</button>
                            <input type="file" id="slip_gaji" name="slip_gaji_ortu" accept=".pdf,.jpg,.jpeg,.png" required>
                        </label>

                        <label class="upload-card" id="card-tidak_beasiswa" for="tidak_beasiswa">
                            <i class="fas fa-file-contract card-icon"></i>
                            <p class="card-label">Surat Tidak Beasiswa <span class="required-star">*</span></p>
                            <p class="card-hint">PDF/JPG/PNG · maks 2MB</p>
                            <span class="card-filename" id="name-tidak_beasiswa"></span>
                            <button type="button" class="remove-btn" id="rm-tidak_beasiswa" onclick="removeFileCard(event,'tidak_beasiswa')" style="display:none">✕</button>
                            <input type="file" id="tidak_beasiswa" name="surat_tidak_menerima_beasiswa" accept=".pdf,.jpg,.jpeg,.png" required>
                        </label>

                    </div>

                    <!-- Organisasi Muhammadiyah -->
                    <p class="upload-group-label"><i class="fas fa-star-and-crescent me-1"></i> Dokumen Organisasi Muhammadiyah</p>
                    <div class="upload-grid">

                        <label class="upload-card" id="card-surat_aktif" for="surat_aktif">
                            <i class="fas fa-star-and-crescent card-icon"></i>
                            <p class="card-label">Surat Aktif Organisasi <span class="required-star">*</span></p>
                            <p class="card-hint">PDF · maks 3MB</p>
                            <span class="card-filename" id="name-surat_aktif"></span>
                            <button type="button" class="remove-btn" id="rm-surat_aktif" onclick="removeFileCard(event,'surat_aktif')" style="display:none">✕</button>
                            <input type="file" id="surat_aktif" name="surat_aktif_organisasi" accept=".pdf" required>
                        </label>

                        <label class="upload-card" id="card-ktam" for="ktam">
                            <i class="fas fa-id-card-alt card-icon"></i>
                            <p class="card-label">KTAM <span class="required-star">*</span></p>
                            <p class="card-hint">JPG/PNG · maks 2MB</p>
                            <span class="card-filename" id="name-ktam"></span>
                            <button type="button" class="remove-btn" id="rm-ktam" onclick="removeFileCard(event,'ktam')" style="display:none">✕</button>
                            <input type="file" id="ktam" name="ktam" accept=".jpg,.jpeg,.png" required>
                        </label>

                        <label class="upload-card" id="card-surat_rekomendasi" for="surat_rekomendasi">
                            <i class="fas fa-file-signature card-icon"></i>
                            <p class="card-label">Surat Rekomendasi <span class="required-star">*</span></p>
                            <p class="card-hint">PDF/JPG/PNG · maks 2MB</p>
                            <span class="card-filename" id="name-surat_rekomendasi"></span>
                            <button type="button" class="remove-btn" id="rm-surat_rekomendasi" onclick="removeFileCard(event,'surat_rekomendasi')" style="display:none">✕</button>
                            <input type="file" id="surat_rekomendasi" name="surat_rekomendasi" accept=".pdf,.jpg,.jpeg,.png" required>
                        </label>

                        <label class="upload-card" id="card-sertifikat" for="sertifikat">
                            <i class="fas fa-certificate card-icon" style="color:var(--secondary-color)"></i>
                            <p class="card-label">Sertifikat/Piagam</p>
                            <p class="card-hint">PDF · maks 5MB · Opsional</p>
                            <span class="card-filename" id="name-sertifikat"></span>
                            <button type="button" class="remove-btn" id="rm-sertifikat" onclick="removeFileCard(event,'sertifikat')" style="display:none">✕</button>
                            <input type="file" id="sertifikat" name="sertifikat_prestasi" accept=".pdf">
                        </label>

                    </div>

                    <!-- Dokumen Pendukung -->
                    <p class="upload-group-label"><i class="fas fa-file-alt me-1"></i> Dokumen Pendukung Lainnya</p>
                    <div class="upload-grid">

                        <label class="upload-card" id="card-cv" for="cv">
                            <i class="fas fa-file-alt card-icon"></i>
                            <p class="card-label">CV <span class="required-star">*</span></p>
                            <p class="card-hint">PDF/DOC/DOCX · maks 2MB</p>
                            <span class="card-filename" id="name-cv"></span>
                            <button type="button" class="remove-btn" id="rm-cv" onclick="removeFileCard(event,'cv')" style="display:none">✕</button>
                            <input type="file" id="cv" name="cv" accept=".pdf,.doc,.docx" required>
                        </label>

                        <label class="upload-card" id="card-pas_foto" for="pas_foto">
                            <i class="fas fa-portrait card-icon"></i>
                            <p class="card-label">Pas Foto 3x4 <span class="required-star">*</span></p>
                            <p class="card-hint">JPG/PNG · maks 2MB</p>
                            <span class="card-filename" id="name-pas_foto"></span>
                            <button type="button" class="remove-btn" id="rm-pas_foto" onclick="removeFileCard(event,'pas_foto')" style="display:none">✕</button>
                            <input type="file" id="pas_foto" name="pas_foto" accept=".jpg,.jpeg,.png" required>
                        </label>

                        <label class="upload-card" id="card-motivation_letter" for="motivation_letter">
                            <i class="fas fa-envelope-open-text card-icon"></i>
                            <p class="card-label">Motivation Letter <span class="required-star">*</span></p>
                            <p class="card-hint">PDF/DOC/DOCX · maks 2MB</p>
                            <span class="card-filename" id="name-motivation_letter"></span>
                            <button type="button" class="remove-btn" id="rm-motivation_letter" onclick="removeFileCard(event,'motivation_letter')" style="display:none">✕</button>
                            <input type="file" id="motivation_letter" name="motivation_letter" accept=".pdf,.doc,.docx" required>
                        </label>

                        <label class="upload-card" id="card-twibbon" for="twibbon">
                            <i class="fas fa-image card-icon"></i>
                            <p class="card-label">Twibbon <span class="required-star">*</span></p>
                            <p class="card-hint">JPG/PNG · maks 2MB</p>
                            <span class="card-filename" id="name-twibbon"></span>
                            <button type="button" class="remove-btn" id="rm-twibbon" onclick="removeFileCard(event,'twibbon')" style="display:none">✕</button>
                            <input type="file" id="twibbon" name="twibbon" accept=".jpg,.jpeg,.png" required>
                        </label>

                        <label class="upload-card" id="card-bukti_twibbon" for="bukti_twibbon">
                            <i class="fas fa-share-alt card-icon"></i>
                            <p class="card-label">Bukti Twibbon <span class="required-star">*</span></p>
                            <p class="card-hint">JPG/PNG · maks 2MB</p>
                            <span class="card-filename" id="name-bukti_twibbon"></span>
                            <button type="button" class="remove-btn" id="rm-bukti_twibbon" onclick="removeFileCard(event,'bukti_twibbon')" style="display:none">✕</button>
                            <input type="file" id="bukti_twibbon" name="bukti_twibbon" accept=".jpg,.jpeg,.png" required>
                        </label>

                        <label class="upload-card" id="card-surat_relawan" for="surat_relawan">
                            <i class="fas fa-hands-helping card-icon"></i>
                            <p class="card-label">Surat Relawan <span class="required-star">*</span></p>
                            <p class="card-hint">PDF/JPG/PNG · maks 2MB</p>
                            <span class="card-filename" id="name-surat_relawan"></span>
                            <button type="button" class="remove-btn" id="rm-surat_relawan" onclick="removeFileCard(event,'surat_relawan')" style="display:none">✕</button>
                            <input type="file" id="surat_relawan" name="surat_kesanggupan_relawan" accept=".pdf,.jpg,.jpeg,.png" required>
                        </label>

                    </div>
                </div>

                <!-- Navigation Buttons -->
                <div class="navigation-buttons">
                    <button type="button" class="nav-btn btn-prev" id="prevBtn" style="display:none">
                        <i class="fas fa-arrow-left me-2"></i>Sebelumnya
                    </button>
                    <button type="button" class="nav-btn btn-next" id="nextBtn">
                        Selanjutnya<i class="fas fa-arrow-right ms-2"></i>
                    </button>
                    <button type="submit" class="nav-btn btn-submit" id="submitBtn" style="display:none">
                        <i class="fas fa-paper-plane me-2"></i>Kirim Pendaftaran
                    </button>
                </div>
            </form>
        </div>
    </div>

<script>
let currentStep = 1;
const totalSteps = 5;

/* ---- Particles ---- */
function createParticles() {
    const container = document.getElementById('particles');
    for (let i = 0; i < 20; i++) {
        const p = document.createElement('div');
        p.className = 'particle';
        p.style.left = Math.random() * 100 + '%';
        p.style.animationDelay    = Math.random() * 15 + 's';
        p.style.animationDuration = (Math.random() * 10 + 10) + 's';
        container.appendChild(p);
    }
}

/* ---- Progress ---- */
function updateProgress() {
    document.getElementById('progressBar').style.width = (currentStep / totalSteps * 100) + '%';
}

/* ---- Show step ---- */
function showStep(step) {
    document.querySelectorAll('.form-section').forEach(s => s.classList.remove('active'));
    document.querySelector(`.form-section[data-step="${step}"]`).classList.add('active');

    document.querySelectorAll('.step').forEach((el, idx) => {
        el.classList.remove('active', 'completed');
        if (idx + 1 < step) el.classList.add('completed');
        else if (idx + 1 === step) el.classList.add('active');
    });

    const prev   = document.getElementById('prevBtn');
    const next   = document.getElementById('nextBtn');
    const submit = document.getElementById('submitBtn');

    prev.style.display   = step === 1 ? 'none' : 'inline-block';
    next.style.display   = step === totalSteps ? 'none' : 'inline-block';
    submit.style.display = step === totalSteps ? 'inline-block' : 'none';

    updateProgress();
    window.scrollTo({ top: 0, behavior: 'smooth' });
}

/* ---- Validation error banner ---- */
function showValidationError(messages) {
    document.querySelector('.alert-danger.validation-error')?.remove();

    const div = document.createElement('div');
    div.className = 'alert alert-danger mt-3 validation-error';
    div.innerHTML = messages.length
        ? `<i class="fas fa-exclamation-triangle me-2"></i><strong>Mohon lengkapi field berikut:</strong><ul class="mb-0 mt-2">${messages.map(m=>`<li>${m}</li>`).join('')}</ul>`
        : `<i class="fas fa-exclamation-triangle me-2"></i><strong>Mohon lengkapi semua field yang wajib diisi.</strong>`;

    const section = document.querySelector(`.form-section[data-step="${currentStep}"]`);
    section.insertBefore(div, section.firstChild);
    div.scrollIntoView({ behavior: 'smooth', block: 'start' });
    setTimeout(() => div.remove(), 8000);
}

/* ---- File size limits ---- */
const fileSizeLimits = { transkrip: 5, sertifikat: 5, penghasilan: 3, surat_aktif: 3 };
function maxMB(id) { return fileSizeLimits[id] ?? 2; }

/* ---- Upload card: change handler ---- */
function handleFileUpload() {
    document.querySelectorAll('.upload-card input[type="file"]').forEach(input => {
        input.addEventListener('change', function () {
            const file = this.files[0];
            if (!file) return;

            const id     = this.id;
            const sizeMB = file.size / 1024 / 1024;

            if (sizeMB > maxMB(id)) {
                alert(`File terlalu besar. Maksimal ${maxMB(id)}MB`);
                this.value = '';
                return;
            }

            const card   = document.getElementById('card-' + id);
            const nameEl = document.getElementById('name-' + id);
            const rmBtn  = document.getElementById('rm-' + id);

            nameEl.textContent = file.name.length > 20 ? file.name.substring(0, 18) + '…' : file.name;
            card.classList.add('done');
            card.classList.remove('error');
            if (rmBtn) rmBtn.style.display = 'flex';
        });
    });
}

/* ---- Remove file from card ---- */
function removeFileCard(event, id) {
    event.preventDefault();
    event.stopPropagation();
    const input  = document.getElementById(id);
    const card   = document.getElementById('card-' + id);
    const nameEl = document.getElementById('name-' + id);
    const rmBtn  = document.getElementById('rm-' + id);

    input.value = '';
    nameEl.textContent = '';
    card.classList.remove('done', 'error');
    if (rmBtn) rmBtn.style.display = 'none';
}

/* ---- Validate step ---- */
function validateStep(step) {
    const section = document.querySelector(`.form-section[data-step="${step}"]`);
    let isValid = true;
    let errors  = [];

    section.querySelectorAll('[required]').forEach(field => {
        if (field.type === 'file') {
            const card = field.closest('.upload-card');
            if (!field.files || !field.files.length) {
                card?.classList.add('error');
                card?.classList.remove('done');
                isValid = false;
                const lbl = card?.querySelector('.card-label');
                if (lbl) errors.push(lbl.textContent.trim());
            } else {
                card?.classList.remove('error');
                card?.classList.add('done');
            }
        } else {
            if (!field.value.trim()) {
                field.classList.add('is-invalid');
                isValid = false;
                const lbl = field.previousElementSibling || field.parentElement.querySelector('label');
                if (lbl) errors.push(lbl.textContent.trim());
            } else {
                field.classList.remove('is-invalid');
            }
        }
    });

    if (step === 1) {
        const email = document.getElementById('email');
        if (email?.value && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email.value)) {
            email.classList.add('is-invalid'); isValid = false;
            if (!errors.some(m => m.includes('Email'))) errors.push('Alamat Email (format tidak valid)');
        }
        const nik = document.getElementById('nik');
        if (nik?.value && nik.value.length !== 16) {
            nik.classList.add('is-invalid'); isValid = false;
            if (!errors.some(m => m.includes('NIK'))) errors.push('NIK (harus 16 digit)');
        }
    }

    if (step === 2) {
        const ipk = document.getElementById('ipk');
        if (ipk?.value && (parseFloat(ipk.value) < 0 || parseFloat(ipk.value) > 4)) {
            ipk.classList.add('is-invalid'); isValid = false;
            if (!errors.some(m => m.includes('IPK'))) errors.push('IPK (harus antara 0–4)');
        }
    }

    if (!isValid) showValidationError(errors);
    return isValid;
}

/* ---- Navigation ---- */
document.getElementById('nextBtn').addEventListener('click', () => {
    if (validateStep(currentStep) && currentStep < totalSteps) {
        currentStep++;
        showStep(currentStep);
    }
});

document.getElementById('prevBtn').addEventListener('click', () => {
    if (currentStep > 1) { currentStep--; showStep(currentStep); }
});

/* ---- Submit ---- */
document.getElementById('kaderForm').addEventListener('submit', function (e) {
    let allValid = true;
    let firstBad = null;

    for (let i = 1; i <= totalSteps; i++) {
        if (!validateStep(i)) {
            allValid = false;
            if (!firstBad) firstBad = i;
        }
    }

    if (!allValid) {
        e.preventDefault();
        currentStep = firstBad;
        showStep(currentStep);
        alert('❌ Mohon lengkapi semua field yang wajib diisi!');
    } else if (!confirm('✅ Apakah Anda yakin semua data sudah benar?\n\nData yang sudah dikirim tidak dapat diubah.')) {
        e.preventDefault();
    }
});

/* ---- DOMContentLoaded ---- */
document.addEventListener('DOMContentLoaded', function () {
    createParticles();
    handleFileUpload();
    showStep(currentStep);

    /* Currency display */
    ['penghasilan_ayah', 'penghasilan_ibu'].forEach(id => {
        const el = document.getElementById(id);
        if (!el) return;
        el.addEventListener('input', e => { e.target.value = e.target.value.replace(/\D/g, ''); });
        el.addEventListener('blur', e => {
            if (!e.target.value) return;
            const old = e.target.parentElement.querySelector('small.currency-display');
            if (old) old.remove();
            const s = document.createElement('small');
            s.className = 'text-muted d-block mt-1 currency-display';
            s.textContent = 'Rp ' + parseInt(e.target.value).toLocaleString('id-ID');
            e.target.parentElement.appendChild(s);
        });
    });

    /* Auto capitalize name fields */
    ['nama','nama_ayah','nama_ibu','tempat_lahir','nama_organisasi'].forEach(id => {
        const el = document.getElementById(id);
        if (el) el.addEventListener('input', e => {
            e.target.value = e.target.value.replace(/\b\w/g, l => l.toUpperCase());
        });
    });

    /* NIK: digits only, max 16 */
    const nik = document.getElementById('nik');
    if (nik) nik.addEventListener('input', e => {
        e.target.value = e.target.value.replace(/\D/g, '').substring(0, 16);
    });

    /* Phone: digits + allowed chars */
    const phone = document.getElementById('no_telepon');
    if (phone) phone.addEventListener('input', e => {
        e.target.value = e.target.value.replace(/[^\d+\-\s]/g, '');
    });
});
</script>

@endsection