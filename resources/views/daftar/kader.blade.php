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

        .step.completed {
            background: var(--success-color);
        }

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

        .step:last-child::after {
            display: none;
        }

        .form-section {
            padding: 2rem;
            display: none;
            animation: slideIn 0.5s ease-out;
        }

        .form-section.active {
            display: block;
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

        .upload-area.dragover {
            border-color: var(--success-color);
            background: rgba(40, 167, 69, 0.1);
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

        .btn-prev {
            background: #6c757d;
            color: white;
        }

        .btn-next {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
        }

        .btn-submit {
            background: linear-gradient(135deg, var(--success-color), var(--info-color));
            color: white;
        }

        .nav-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
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

        .progress-bar-container {
            margin: 1rem 0;
            background: rgba(255, 255, 255, 0.3);
            height: 6px;
            border-radius: 3px;
            overflow: hidden;
        }

        .progress-bar {
            height: 100%;
            background: linear-gradient(90deg, var(--warning-color), var(--success-color));
            width: 20%;
            transition: width 0.5s ease;
            border-radius: 3px;
        }

        .floating-particles {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: -1;
        }

        .particle {
            position: absolute;
            width: 4px;
            height: 4px;
            background: rgba(255, 255, 255, 0.5);
            border-radius: 50%;
            animation: floatParticle 15s infinite linear;
        }

        @keyframes floatParticle {
            0% {
                transform: translateY(100vh) translateX(0px) rotate(0deg);
                opacity: 0;
            }
            10% {
                opacity: 1;
            }
            90% {
                opacity: 1;
            }
            100% {
                transform: translateY(-10vh) translateX(100px) rotate(360deg);
                opacity: 0;
            }
        }

        .lazismu-brand {
            color: var(--warning-color);
            font-weight: 800;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }

        .required-star {
            color: var(--accent-color);
        }

        .form-info {
            background: rgba(255, 255, 255, 0.9);
            border-left: 4px solid var(--info-color);
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
        }

        .upload-success {
            color: var(--success-color);
            font-weight: 600;
        }

        .file-name {
            color: var(--primary-color);
            font-weight: 600;
        }

        .upload-section-title {
            color: var(--secondary-color);
            font-weight: 600;
            margin: 2rem 0 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid var(--secondary-color);
        }

        @media (max-width: 768px) {
            .main-container {
                margin: 10px;
                border-radius: 15px;
            }
            
            .header-section {
                padding: 1.5rem 1rem;
            }
            
            .form-section {
                padding: 1.5rem 1rem;
            }
            
            .navigation-buttons {
                padding: 1.5rem 1rem;
                flex-direction: column;
                gap: 1rem;
            }
            
            .step-indicator {
                margin: 1rem 0;
            }
            
            .step {
                width: 35px;
                height: 35px;
                margin: 0 5px;
            }
        }
    </style>

    <div class="floating-particles" id="particles"></div>

    <div class="container">
        <div class="main-container">
            <!-- Header Section -->
            <div class="header-section">
                <h1 class="mb-3">
                    <i class="fas fa-graduation-cap me-3"></i>
                    Form Pendaftaran Beasiswa <span class="lazismu-brand">LAZISMU</span>
                </h1>
                <h5 class="mb-3 opacity-90">Kategori: Kader Muhammadiyah</h5>
                <p class="mb-0">Silakan lengkapi semua data dengan benar dan upload dokumen yang diperlukan</p>
                
                <!-- Progress Bar -->
                <div class="progress-bar-container">
                    <div class="progress-bar" id="progressBar"></div>
                </div>

                <!-- Step Indicator -->
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

                <!-- Step 1: Data Pribadi -->
                <div class="form-section active" data-step="1">
                    <h3 class="section-title">
                        <div class="section-icon">
                            <i class="fas fa-user"></i>
                        </div>
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
                        <textarea class="form-control" id="alamat" name="alamat" style="height: 120px" placeholder="Alamat Lengkap" required></textarea>
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
                                <input type="email"
       class="form-control"
       id="email"
       name="email"
       value="{{ auth()->user()->email }}"
       readonly>
                                <label for="email">Alamat Email <span class="required-star">*</span></label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Step 2: Data Akademik -->
                <div class="form-section" data-step="2">
                    <h3 class="section-title">
                        <div class="section-icon">
                            <i class="fas fa-book"></i>
                        </div>
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
                                    <option value="1">Semester 1</option>
                                    <option value="2">Semester 2</option>
                                    <option value="3">Semester 3</option>
                                    <option value="4">Semester 4</option>
                                    <option value="5">Semester 5</option>
                                    <option value="6">Semester 6</option>
                                    <option value="7">Semester 7</option>
                                    <option value="8">Semester 8</option>
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
                        <textarea class="form-control" id="prestasi" name="prestasi" style="height: 120px" placeholder="Prestasi Akademik/Non-Akademik (Optional)"></textarea>
                        <label for="prestasi">Prestasi Akademik/Non-Akademik (Jika Ada)</label>
                    </div>
                </div>

                <!-- Step 3: Data Organisasi -->
                <div class="form-section" data-step="3">
                    <h3 class="section-title">
                        <div class="section-icon">
                            <i class="fas fa-star-and-crescent"></i>
                        </div>
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
                        <textarea class="form-control" id="riwayat_aktivitas" name="riwayat_aktivitas" style="height: 150px" placeholder="Riwayat Aktivitas dalam Muhammadiyah" required></textarea>
                        <label for="riwayat_aktivitas">Riwayat Aktivitas dalam Muhammadiyah <span class="required-star">*</span></label>
                    </div>

                    <div class="form-floating">
                        <textarea class="form-control" id="kontribusi" name="kontribusi" style="height: 120px" placeholder="Kontribusi untuk Muhammadiyah" required></textarea>
                        <label for="kontribusi">Kontribusi yang telah diberikan untuk Muhammadiyah <span class="required-star">*</span></label>
                    </div>

                    <div class="form-floating">
                        <textarea class="form-control" id="rencana_masa_depan" name="rencana_masa_depan" style="height: 120px" placeholder="Rencana masa depan untuk Muhammadiyah" required></textarea>
                        <label for="rencana_masa_depan">Rencana masa depan untuk berkontribusi pada Muhammadiyah <span class="required-star">*</span></label>
                    </div>
                </div>

                <!-- Step 4: Data Ekonomi Keluarga -->
                <div class="form-section" data-step="4">
                    <h3 class="section-title">
                        <div class="section-icon">
                            <i class="fas fa-home"></i>
                        </div>
                        Data Ekonomi Keluarga <span class="required-star">*</span>
                    </h3>

                    <div class="form-info">
                        <i class="fas fa-family me-2 text-info"></i>
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
                        <textarea class="form-control" id="kondisi_ekonomi" name="kondisi_ekonomi" style="height: 120px" placeholder="Kondisi Ekonomi Keluarga" required></textarea>
                        <label for="kondisi_ekonomi">Deskripsi Kondisi Ekonomi Keluarga <span class="required-star">*</span></label>
                    </div>
                </div>

                <!-- Step 5: Upload Dokumen -->
                <div class="form-section" data-step="5">
                    <h3 class="section-title">
                        <div class="section-icon">
                            <i class="fas fa-upload"></i>
                        </div>
                        Upload Dokumen <span class="required-star">*</span>
                    </h3>

                    <div class="form-info">
                        <i class="fas fa-file-upload me-2 text-info"></i>
                        <strong>Perhatian:</strong> Pastikan file yang diupload jelas dan dapat dibaca. Format yang didukung: JPG, PNG, PDF.
                    </div>

                    <h5 class="upload-section-title"><i class="fas fa-id-card me-2"></i>Dokumen Identitas</h5>

                    <!-- KTP -->
                    <div class="upload-area" data-file-type="ktp">
                        <i class="fas fa-id-card fa-3x mb-3" style="color: var(--primary-color);"></i>
                        <h5>Upload KTP <span class="required-star">*</span></h5>
                        <p class="mb-3 text-muted">File format: JPG, PNG, PDF (Maksimal: 2MB)</p>
                        <input type="file" id="ktp" name="ktp" class="file-input" accept=".jpg,.jpeg,.png,.pdf" required>
                        <button type="button" class="upload-btn" onclick="document.getElementById('ktp').click()">
                            <i class="fas fa-cloud-upload-alt me-2"></i>Pilih File KTP
                        </button>
                        <div id="ktp-preview"></div>
                    </div>

                    <!-- Kartu Keluarga -->
                    <div class="upload-area" data-file-type="kk">
                        <i class="fas fa-users fa-3x mb-3" style="color: var(--primary-color);"></i>
                        <h5>Upload Kartu Keluarga <span class="required-star">*</span></h5>
                        <p class="mb-3 text-muted">File format: JPG, PNG, PDF (Maksimal: 2MB)</p>
                        <input type="file" id="kk" name="kk" class="file-input" accept=".jpg,.jpeg,.png,.pdf" required>
                        <button type="button" class="upload-btn" onclick="document.getElementById('kk').click()">
                            <i class="fas fa-cloud-upload-alt me-2"></i>Pilih File KK
                        </button>
                        <div id="kk-preview"></div>
                    </div>

                    <h5 class="upload-section-title"><i class="fas fa-graduation-cap me-2"></i>Dokumen Akademik</h5>

                    <!-- Transkrip Nilai -->
                    <div class="upload-area" data-file-type="transkrip">
                        <i class="fas fa-file-alt fa-3x mb-3" style="color: var(--primary-color);"></i>
                        <h5>Upload Transkrip Nilai <span class="required-star">*</span></h5>
                        <p class="mb-3 text-muted">File format: PDF (Maksimal: 5MB)</p>
                        <input type="file" id="transkrip" name="transkrip" class="file-input" accept=".pdf" required>
                        <button type="button" class="upload-btn" onclick="document.getElementById('transkrip').click()">
                            <i class="fas fa-cloud-upload-alt me-2"></i>Pilih File Transkrip
                        </button>
                        <div id="transkrip-preview"></div>
                    </div>

                    <!-- KTM -->
                    <div class="upload-area" data-file-type="ktm">
                        <i class="fas fa-id-badge fa-3x mb-3" style="color: var(--primary-color);"></i>
                        <h5>Upload KTM (Kartu Tanda Mahasiswa) <span class="required-star">*</span></h5>
                        <p class="mb-3 text-muted">Foto KTM - Format: JPG, PNG (Maksimal: 2MB)</p>
                        <input type="file" id="ktm" name="ktm" class="file-input" accept=".jpg,.jpeg,.png" required>
                        <button type="button" class="upload-btn" onclick="document.getElementById('ktm').click()">
                            <i class="fas fa-cloud-upload-alt me-2"></i>Pilih Foto KTM
                        </button>
                        <div id="ktm-preview"></div>
                    </div>

                    <h5 class="upload-section-title"><i class="fas fa-money-check-alt me-2"></i>Dokumen Ekonomi</h5>

                    <!-- Surat Keterangan Penghasilan -->
                    <div class="upload-area" data-file-type="penghasilan">
                        <i class="fas fa-money-bill-wave fa-3x mb-3" style="color: var(--primary-color);"></i>
                        <h5>Upload Surat Keterangan Penghasilan <span class="required-star">*</span></h5>
                        <p class="mb-3 text-muted">File format: PDF (Maksimal: 3MB)</p>
                        <input type="file" id="penghasilan" name="surat_penghasilan" class="file-input" accept=".pdf" required>
                        <button type="button" class="upload-btn" onclick="document.getElementById('penghasilan').click()">
                            <i class="fas fa-cloud-upload-alt me-2"></i>Pilih File Surat
                        </button>
                        <div id="penghasilan-preview"></div>
                    </div>

                    <!-- Slip Gaji Orang Tua -->
                    <div class="upload-area" data-file-type="slip_gaji">
                        <i class="fas fa-receipt fa-3x mb-3" style="color: var(--primary-color);"></i>
                        <h5>Upload Slip Gaji Orang Tua <span class="required-star">*</span></h5>
                        <p class="mb-3 text-muted">File format: PDF, JPG, PNG (Maksimal: 2MB)</p>
                        <input type="file" id="slip_gaji" name="slip_gaji_ortu" class="file-input" accept=".pdf,.jpg,.jpeg,.png" required>
                        <button type="button" class="upload-btn" onclick="document.getElementById('slip_gaji').click()">
                            <i class="fas fa-cloud-upload-alt me-2"></i>Pilih File Slip Gaji
                        </button>
                        <div id="slip_gaji-preview"></div>
                    </div>

                    <!-- Surat Tidak Menerima Beasiswa -->
                    <div class="upload-area" data-file-type="surat_tidak_beasiswa">
                        <i class="fas fa-file-contract fa-3x mb-3" style="color: var(--primary-color);"></i>
                        <h5>Upload Surat Tidak Menerima Beasiswa <span class="required-star">*</span></h5>
                        <p class="mb-3 text-muted">Surat keterangan tidak menerima beasiswa lain - Format: PDF (Maksimal: 2MB)</p>
                        <input type="file" id="surat_tidak_beasiswa" name="surat_tidak_menerima_beasiswa" class="file-input" accept=".pdf,.jpg,.jpeg,.png" required>
                        <button type="button" class="upload-btn" onclick="document.getElementById('surat_tidak_beasiswa').click()">
                            <i class="fas fa-cloud-upload-alt me-2"></i>Pilih File Surat
                        </button>
                        <div id="surat_tidak_beasiswa-preview"></div>
                    </div>

                    <h5 class="upload-section-title"><i class="fas fa-star-and-crescent me-2"></i>Dokumen Organisasi Muhammadiyah</h5>

                    <!-- Surat Aktif Organisasi -->
                    <div class="upload-area" data-file-type="surat_aktif">
                        <i class="fas fa-star-and-crescent fa-3x mb-3" style="color: var(--primary-color);"></i>
                        <h5>Upload Surat Keterangan Aktif Organisasi <span class="required-star">*</span></h5>
                        <p class="mb-3 text-muted">Surat dari pengurus organisasi Muhammadiyah - Format: PDF (Maksimal: 3MB)</p>
                        <input type="file" id="surat_aktif" name="surat_aktif_organisasi" class="file-input" accept=".pdf" required>
                        <button type="button" class="upload-btn" onclick="document.getElementById('surat_aktif').click()">
                            <i class="fas fa-cloud-upload-alt me-2"></i>Pilih File Surat Aktif
                        </button>
                        <div id="surat_aktif-preview"></div>
                    </div>

                    <!-- KTAM -->
                    <div class="upload-area" data-file-type="ktam">
                        <i class="fas fa-id-card-alt fa-3x mb-3" style="color: var(--primary-color);"></i>
                        <h5>Upload KTAM (Kartu Tanda Anggota Muhammadiyah) <span class="required-star">*</span></h5>
                        <p class="mb-3 text-muted">Foto KTAM - Format: JPG, PNG (Maksimal: 2MB)</p>
                        <input type="file" id="ktam" name="ktam" class="file-input" accept=".jpg,.jpeg,.png" required>
                        <button type="button" class="upload-btn" onclick="document.getElementById('ktam').click()">
                            <i class="fas fa-cloud-upload-alt me-2"></i>Pilih Foto KTAM
                        </button>
                        <div id="ktam-preview"></div>
                    </div>

                    <!-- Surat Rekomendasi -->
                    <div class="upload-area" data-file-type="surat_rekomendasi">
                        <i class="fas fa-file-signature fa-3x mb-3" style="color: var(--primary-color);"></i>
                        <h5>Upload Surat Rekomendasi <span class="required-star">*</span></h5>
                        <p class="mb-3 text-muted">Surat rekomendasi dari pengurus - Format: PDF (Maksimal: 2MB)</p>
                        <input type="file" id="surat_rekomendasi" name="surat_rekomendasi" class="file-input" accept=".pdf,.jpg,.jpeg,.png" required>
                        <button type="button" class="upload-btn" onclick="document.getElementById('surat_rekomendasi').click()">
                            <i class="fas fa-cloud-upload-alt me-2"></i>Pilih File Surat
                        </button>
                        <div id="surat_rekomendasi-preview"></div>
                    </div>

                    <!-- Sertifikat/Piagam (Optional) -->
                    <div class="upload-area" data-file-type="sertifikat">
                        <i class="fas fa-certificate fa-3x mb-3" style="color: var(--secondary-color);"></i>
                        <h5>Upload Sertifikat/Piagam Penghargaan</h5>
                        <p class="mb-3 text-muted">Sertifikat prestasi dalam organisasi (Opsional) - Format: PDF (Maksimal: 5MB)</p>
                        <input type="file" id="sertifikat" name="sertifikat_prestasi" class="file-input" accept=".pdf">
                        <button type="button" class="upload-btn" onclick="document.getElementById('sertifikat').click()">
                            <i class="fas fa-cloud-upload-alt me-2"></i>Pilih File Sertifikat
                        </button>
                        <div id="sertifikat-preview"></div>
                    </div>

                    <h5 class="upload-section-title"><i class="fas fa-home me-2"></i>Foto Kondisi Rumah</h5>

                    <!-- Foto Rumah Depan -->
                    <div class="upload-area" data-file-type="foto_rumah_depan">
                        <i class="fas fa-home fa-3x mb-3" style="color: var(--primary-color);"></i>
                        <h5>Upload Foto Rumah Tampak Depan <span class="required-star">*</span></h5>
                        <p class="mb-3 text-muted">Foto bagian depan rumah - Format: JPG, PNG (Maksimal: 2MB)</p>
                        <input type="file" id="foto_rumah_depan" name="foto_rumah_depan" class="file-input" accept=".jpg,.jpeg,.png" required>
                        <button type="button" class="upload-btn" onclick="document.getElementById('foto_rumah_depan').click()">
                            <i class="fas fa-cloud-upload-alt me-2"></i>Pilih Foto
                        </button>
                        <div id="foto_rumah_depan-preview"></div>
                    </div>

                    <!-- Foto Rumah Samping -->
                    <div class="upload-area" data-file-type="foto_rumah_samping">
                        <i class="fas fa-home fa-3x mb-3" style="color: var(--primary-color);"></i>
                        <h5>Upload Foto Rumah Tampak Samping <span class="required-star">*</span></h5>
                        <p class="mb-3 text-muted">Foto bagian samping rumah - Format: JPG, PNG (Maksimal: 2MB)</p>
                        <input type="file" id="foto_rumah_samping" name="foto_rumah_samping" class="file-input" accept=".jpg,.jpeg,.png" required>
                        <button type="button" class="upload-btn" onclick="document.getElementById('foto_rumah_samping').click()">
                            <i class="fas fa-cloud-upload-alt me-2"></i>Pilih Foto
                        </button>
                        <div id="foto_rumah_samping-preview"></div>
                    </div>

                    <!-- Foto Ruang Tamu -->
                    <div class="upload-area" data-file-type="foto_ruang_tamu">
                        <i class="fas fa-couch fa-3x mb-3" style="color: var(--primary-color);"></i>
                        <h5>Upload Foto Ruang Tamu <span class="required-star">*</span></h5>
                        <p class="mb-3 text-muted">Foto ruang tamu di dalam rumah - Format: JPG, PNG (Maksimal: 2MB)</p>
                        <input type="file" id="foto_ruang_tamu" name="foto_ruang_tamu" class="file-input" accept=".jpg,.jpeg,.png" required>
                        <button type="button" class="upload-btn" onclick="document.getElementById('foto_ruang_tamu').click()">
                            <i class="fas fa-cloud-upload-alt me-2"></i>Pilih Foto
                        </button>
                        <div id="foto_ruang_tamu-preview"></div>
                    </div>

                    <!-- Foto Kamar Mandi -->
                    <div class="upload-area" data-file-type="foto_kamar_mandi">
                        <i class="fas fa-bath fa-3x mb-3" style="color: var(--primary-color);"></i>
                        <h5>Upload Foto Kamar Mandi <span class="required-star">*</span></h5>
                        <p class="mb-3 text-muted">Foto kamar mandi - Format: JPG, PNG (Maksimal: 2MB)</p>
                        <input type="file" id="foto_kamar_mandi" name="foto_kamar_mandi" class="file-input" accept=".jpg,.jpeg,.png" required>
                        <button type="button" class="upload-btn" onclick="document.getElementById('foto_kamar_mandi').click()">
                            <i class="fas fa-cloud-upload-alt me-2"></i>Pilih Foto
                        </button>
                        <div id="foto_kamar_mandi-preview"></div>
                    </div>

                    <!-- Foto Dapur -->
                    <div class="upload-area" data-file-type="foto_dapur">
                        <i class="fas fa-utensils fa-3x mb-3" style="color: var(--primary-color);"></i>
                        <h5>Upload Foto Dapur <span class="required-star">*</span></h5>
                        <p class="mb-3 text-muted">Foto dapur - Format: JPG, PNG (Maksimal: 2MB)</p>
                        <input type="file" id="foto_dapur" name="foto_dapur" class="file-input" accept=".jpg,.jpeg,.png" required>
                        <button type="button" class="upload-btn" onclick="document.getElementById('foto_dapur').click()">
                            <i class="fas fa-cloud-upload-alt me-2"></i>Pilih Foto
                        </button>
                        <div id="foto_dapur-preview"></div>
                    </div>

                    <h5 class="upload-section-title"><i class="fas fa-file-alt me-2"></i>Dokumen Pendukung Lainnya</h5>

                    <!-- CV -->
                    <div class="upload-area" data-file-type="cv">
                        <i class="fas fa-file-alt fa-3x mb-3" style="color: var(--primary-color);"></i>
                        <h5>Upload CV (Curriculum Vitae) <span class="required-star">*</span></h5>
                        <p class="mb-3 text-muted">Curriculum Vitae - Format: PDF, DOC, DOCX (Maksimal: 2MB)</p>
                        <input type="file" id="cv" name="cv" class="file-input" accept=".pdf,.doc,.docx" required>
                        <button type="button" class="upload-btn" onclick="document.getElementById('cv').click()">
                            <i class="fas fa-cloud-upload-alt me-2"></i>Pilih File CV
                        </button>
                        <div id="cv-preview"></div>
                    </div>

                    <!-- Pas Foto -->
                    <div class="upload-area" data-file-type="pas_foto">
                        <i class="fas fa-portrait fa-3x mb-3" style="color: var(--primary-color);"></i>
                        <h5>Upload Pas Foto <span class="required-star">*</span></h5>
                        <p class="mb-3 text-muted">Pas foto 3x4 atau 4x6 - Format: JPG, PNG (Maksimal: 2MB)</p>
                        <input type="file" id="pas_foto" name="pas_foto" class="file-input" accept=".jpg,.jpeg,.png" required>
                        <button type="button" class="upload-btn" onclick="document.getElementById('pas_foto').click()">
                            <i class="fas fa-cloud-upload-alt me-2"></i>Pilih Pas Foto
                        </button>
                        <div id="pas_foto-preview"></div>
                    </div>

                    <!-- Motivation Letter -->
                    <div class="upload-area" data-file-type="motivation_letter">
                        <i class="fas fa-envelope-open-text fa-3x mb-3" style="color: var(--primary-color);"></i>
                        <h5>Upload Motivation Letter <span class="required-star">*</span></h5>
                        <p class="mb-3 text-muted">Surat motivasi - Format: PDF, DOC, DOCX (Maksimal: 2MB)</p>
                        <input type="file" id="motivation_letter" name="motivation_letter" class="file-input" accept=".pdf,.doc,.docx" required>
                        <button type="button" class="upload-btn" onclick="document.getElementById('motivation_letter').click()">
                            <i class="fas fa-cloud-upload-alt me-2"></i>Pilih File
                        </button>
                        <div id="motivation_letter-preview"></div>
                    </div>

                    <!-- Twibbon -->
                    <div class="upload-area" data-file-type="twibbon">
                        <i class="fas fa-image fa-3x mb-3" style="color: var(--primary-color);"></i>
                        <h5>Upload Twibbon <span class="required-star">*</span></h5>
                        <p class="mb-3 text-muted">Foto dengan twibbon beasiswa - Format: JPG, PNG (Maksimal: 2MB)</p>
                        <input type="file" id="twibbon" name="twibbon" class="file-input" accept=".jpg,.jpeg,.png" required>
                        <button type="button" class="upload-btn" onclick="document.getElementById('twibbon').click()">
                            <i class="fas fa-cloud-upload-alt me-2"></i>Pilih Foto Twibbon
                        </button>
                        <div id="twibbon-preview"></div>
                    </div>
                    
                    <div class="upload-area" data-file-type="bukti_twibbon">
                        <i class="fas fa-share-alt fa-3x mb-3" style="color: var(--primary-color);"></i>
                        <h5>Upload Bukti Twibbon (Screenshot Postingan) <span class="required-star">*</span></h5>
                        <p class="mb-3 text-muted">Screenshot bukti posting twibbon di media sosial - Format: JPG, PNG (Maksimal: 2MB)</p>
                        <input type="file" id="bukti_twibbon" name="bukti_twibbon" class="file-input" accept=".jpg,.jpeg,.png" required>
                        <button type="button" class="upload-btn" onclick="document.getElementById('bukti_twibbon').click()">
                            <i class="fas fa-cloud-upload-alt me-2"></i>Pilih File Bukti Twibbon
                        </button>
                        <div id="bukti_twibbon-preview"></div>
                    </div>

                    <!-- Surat Kesanggupan Relawan -->
                    <div class="upload-area" data-file-type="surat_relawan">
                        <i class="fas fa-hands-helping fa-3x mb-3" style="color: var(--primary-color);"></i>
                        <h5>Upload Surat Kesanggupan Relawan <span class="required-star">*</span></h5>
                        <p class="mb-3 text-muted">Surat kesanggupan menjadi relawan - Format: PDF (Maksimal: 2MB)</p>
                        <input type="file" id="surat_relawan" name="surat_kesanggupan_relawan" class="file-input" accept=".pdf,.jpg,.jpeg,.png" required>
                        <button type="button" class="upload-btn" onclick="document.getElementById('surat_relawan').click()">
                            <i class="fas fa-cloud-upload-alt me-2"></i>Pilih File Surat
                        </button>
                        <div id="surat_relawan-preview"></div>
                    </div>
                </div>

                <!-- Navigation Buttons -->
                <div class="navigation-buttons">
                    <button type="button" class="nav-btn btn-prev" id="prevBtn" style="display: none;">
                        <i class="fas fa-arrow-left me-2"></i>Sebelumnya
                    </button>
                    <button type="button" class="nav-btn btn-next" id="nextBtn">
                        Selanjutnya<i class="fas fa-arrow-right ms-2"></i>
                    </button>
                    <button type="submit" class="nav-btn btn-submit" id="submitBtn" style="display: none;">
                        <i class="fas fa-paper-plane me-2"></i>Kirim Pendaftaran
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
    let currentStep = 1;
    const totalSteps = 5;

    function createParticles() {
        const particleContainer = document.getElementById('particles');
        for (let i = 0; i < 20; i++) {
            const particle = document.createElement('div');
            particle.className = 'particle';
            particle.style.left = Math.random() * 100 + '%';
            particle.style.animationDelay = Math.random() * 15 + 's';
            particle.style.animationDuration = (Math.random() * 10 + 10) + 's';
            particleContainer.appendChild(particle);
        }
    }

    function updateProgress() {
        const progress = (currentStep / totalSteps) * 100;
        document.getElementById('progressBar').style.width = progress + '%';
    }

    function showStep(step) {
        document.querySelectorAll('.form-section').forEach(section => {
            section.classList.remove('active');
        });
        document.querySelector(`.form-section[data-step="${step}"]`).classList.add('active');

        document.querySelectorAll('.step').forEach((stepEl, index) => {
            stepEl.classList.remove('active', 'completed');
            if (index + 1 < step) {
                stepEl.classList.add('completed');
            } else if (index + 1 === step) {
                stepEl.classList.add('active');
            }
        });

        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');
        const submitBtn = document.getElementById('submitBtn');

        if (step === 1) {
            prevBtn.style.display = 'none';
            nextBtn.style.display = 'inline-block';
            submitBtn.style.display = 'none';
        } else if (step === totalSteps) {
            prevBtn.style.display = 'inline-block';
            nextBtn.style.display = 'none';
            submitBtn.style.display = 'inline-block';
        } else {
            prevBtn.style.display = 'inline-block';
            nextBtn.style.display = 'inline-block';
            submitBtn.style.display = 'none';
        }

        updateProgress();
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    function showValidationError(messages) {
        const existingError = document.querySelector('.alert-danger.validation-error');
        if (existingError) {
            existingError.remove();
        }
        
        const errorDiv = document.createElement('div');
        errorDiv.className = 'alert alert-danger mt-3 validation-error';
        
        if (messages.length > 0) {
            errorDiv.innerHTML = `
                <i class="fas fa-exclamation-triangle me-2"></i>
                <strong>Mohon lengkapi field berikut:</strong>
                <ul class="mb-0 mt-2">
                    ${messages.map(msg => `<li>${msg}</li>`).join('')}
                </ul>
            `;
        } else {
            errorDiv.innerHTML = '<i class="fas fa-exclamation-triangle me-2"></i><strong>Mohon lengkapi semua field yang wajib diisi dengan benar.</strong>';
        }
        
        const currentSection = document.querySelector(`.form-section[data-step="${currentStep}"]`);
        currentSection.insertBefore(errorDiv, currentSection.firstChild);
        
        errorDiv.scrollIntoView({ behavior: 'smooth', block: 'start' });
        
        setTimeout(() => {
            if (errorDiv.parentNode) {
                errorDiv.remove();
            }
        }, 8000);
    }

    function validateStep(step) {
        const currentSection = document.querySelector(`.form-section[data-step="${step}"]`);
        const requiredFields = currentSection.querySelectorAll('[required]');
        let isValid = true;
        let errorMessages = [];

        requiredFields.forEach(field => {
            if (field.type === 'file') {
                if (!field.files || field.files.length === 0) {
                    const uploadArea = field.closest('.upload-area');
                    uploadArea.style.borderColor = 'var(--accent-color)';
                    uploadArea.style.backgroundColor = 'rgba(220, 53, 69, 0.1)';
                    isValid = false;
                    
                    const label = uploadArea.querySelector('h5');
                    if (label) {
                        errorMessages.push(label.textContent.replace(' *', '').trim());
                    }
                } else {
                    const uploadArea = field.closest('.upload-area');
                    uploadArea.style.borderColor = 'var(--success-color)';
                    uploadArea.style.backgroundColor = 'rgba(40, 167, 69, 0.1)';
                }
            } else {
                if (!field.value.trim()) {
                    field.classList.add('is-invalid');
                    isValid = false;
                    
                    const label = field.previousElementSibling || field.parentElement.querySelector('label');
                    if (label) {
                        errorMessages.push(label.textContent.replace(' *', '').trim());
                    }
                } else {
                    field.classList.remove('is-invalid');
                }
            }
        });

        if (step === 1) {
            const emailField = document.getElementById('email');
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (emailField.value && !emailRegex.test(emailField.value)) {
                emailField.classList.add('is-invalid');
                isValid = false;
                if (!errorMessages.includes('Alamat Email')) {
                    errorMessages.push('Alamat Email (format tidak valid)');
                }
            }

            const nikField = document.getElementById('nik');
            if (nikField.value && nikField.value.length !== 16) {
                nikField.classList.add('is-invalid');
                isValid = false;
                if (!errorMessages.some(msg => msg.includes('NIK'))) {
                    errorMessages.push('NIK (harus 16 digit)');
                }
            }
        }

        if (step === 2) {
            const ipkField = document.getElementById('ipk');
            if (ipkField.value && (parseFloat(ipkField.value) < 0 || parseFloat(ipkField.value) > 4)) {
                ipkField.classList.add('is-invalid');
                isValid = false;
                if (!errorMessages.some(msg => msg.includes('IPK'))) {
                    errorMessages.push('IPK (harus antara 0-4)');
                }
            }
        }

        if (!isValid) {
            showValidationError(errorMessages);
        }

        return isValid;
    }

    function handleFileUpload() {
        const fileInputs = document.querySelectorAll('.file-input');
        
        fileInputs.forEach(input => {
            input.addEventListener('change', function(e) {
                const file = e.target.files[0];
                const previewDiv = document.getElementById(this.id + '-preview');
                const uploadArea = this.closest('.upload-area');

                if (file) {
                    const fileSize = file.size / 1024 / 1024;
                    let maxSize;
                    
                    if (this.id === 'transkrip' || this.id === 'sertifikat') {
                        maxSize = 5;
                    } else if (this.id === 'ktp' || this.id === 'kk') {
                        maxSize = 2;
                    } else {
                        maxSize = 3;
                    }

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
                                    <div class="file-name">${file.name}</div>
                                    <small class="text-muted">${(fileSize).toFixed(2)} MB</small>
                                </div>
                                <div class="upload-success">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                            </div>
                            <button type="button" class="btn btn-sm btn-outline-danger ms-2" onclick="removeFile('${this.id}')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    `;

                    uploadArea.style.borderColor = 'var(--success-color)';
                    uploadArea.style.backgroundColor = 'rgba(40, 167, 69, 0.1)';
                }
            });
        });
    }

    function removeFile(inputId) {
        const input = document.getElementById(inputId);
        const previewDiv = document.getElementById(inputId + '-preview');
        const uploadArea = input.closest('.upload-area');

        input.value = '';
        previewDiv.innerHTML = '';
        uploadArea.style.borderColor = '#dee2e6';
        uploadArea.style.backgroundColor = 'rgba(255, 255, 255, 0.5)';
    }

    function initDragDrop() {
        const uploadAreas = document.querySelectorAll('.upload-area');
        
        uploadAreas.forEach(area => {
            const input = area.querySelector('.file-input');

            area.addEventListener('dragover', (e) => {
                e.preventDefault();
                area.classList.add('dragover');
            });

            area.addEventListener('dragleave', () => {
                area.classList.remove('dragover');
            });

            area.addEventListener('drop', (e) => {
                e.preventDefault();
                area.classList.remove('dragover');

                const files = e.dataTransfer.files;
                if (files.length > 0) {
                    input.files = files;
                    input.dispatchEvent(new Event('change'));
                }
            });
        });
    }

    document.getElementById('nextBtn').addEventListener('click', () => {
        if (validateStep(currentStep)) {
            if (currentStep < totalSteps) {
                currentStep++;
                showStep(currentStep);
            }
        }
    });

    document.getElementById('prevBtn').addEventListener('click', () => {
        if (currentStep > 1) {
            currentStep--;
            showStep(currentStep);
        }
    });

    document.getElementById('kaderForm').addEventListener('submit', function(e) {
        let allValid = true;
        let firstInvalidStep = null;
        
        for (let i = 1; i <= totalSteps; i++) {
            if (!validateStep(i)) {
                allValid = false;
                if (firstInvalidStep === null) {
                    firstInvalidStep = i;
                }
            }
        }

        if (!allValid) {
            e.preventDefault();
            
            if (firstInvalidStep !== null) {
                currentStep = firstInvalidStep;
                showStep(currentStep);
            }
            
            alert('❌ Mohon lengkapi semua field yang wajib diisi!\n\nSilakan periksa kembali semua data yang telah Anda isi.');
        } else {
            if (!confirm('✅ Apakah Anda yakin semua data yang diisi sudah benar?\n\nData yang sudah dikirim tidak dapat diubah.')) {
                e.preventDefault();
            }
        }
    });

    document.addEventListener('DOMContentLoaded', function() {
        createParticles();
        handleFileUpload();
        initDragDrop();
        showStep(currentStep);

        const currencyInputs = ['penghasilan_ayah', 'penghasilan_ibu'];
        currencyInputs.forEach(id => {
            const input = document.getElementById(id);
            if (input) {
                input.addEventListener('input', function(e) {
                    let value = e.target.value.replace(/\D/g, '');
                    e.target.value = value;
                });
                
                input.addEventListener('blur', function(e) {
                    if (e.target.value) {
                        const formatted = parseInt(e.target.value).toLocaleString('id-ID');
                        const display = document.createElement('small');
                        display.className = 'text-muted d-block mt-1';
                        display.textContent = 'Rp ' + formatted;
                        
                        const oldDisplay = e.target.parentElement.querySelector('small.text-muted');
                        if (oldDisplay) oldDisplay.remove();
                        
                        e.target.parentElement.appendChild(display);
                    }
                });
            }
        });

        const nameInputs = ['nama', 'nama_ayah', 'nama_ibu', 'tempat_lahir', 'nama_organisasi'];
        nameInputs.forEach(id => {
            const input = document.getElementById(id);
            if (input) {
                input.addEventListener('input', function(e) {
                    e.target.value = e.target.value.replace(/\b\w/g, l => l.toUpperCase());
                });
            }
        });

        const nikInput = document.getElementById('nik');
        if (nikInput) {
            nikInput.addEventListener('input', function(e) {
                e.target.value = e.target.value.replace(/\D/g, '').substring(0, 16);
            });
        }

        const phoneInput = document.getElementById('no_telepon');
        if (phoneInput) {
            phoneInput.addEventListener('input', function(e) {
                e.target.value = e.target.value.replace(/[^\d\+\-\s]/g, '');
            });
        }
    });
</script>
@endsection