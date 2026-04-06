@extends('layouts.pewawancara')

@section('content')
<div class="container-fluid">
    <!-- Info Peserta -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card info-peserta-card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <div class="d-flex align-items-center">
                                <div class="user-avatar-large {{ $alternatif->jenis_pendaftaran === 'kader' ? 'avatar-kader' : 'avatar-dhuafa' }}">
                                    {{ strtoupper(substr($alternatif->nama, 0, 1)) }}
                                </div>
                                <div>
                                    <h4 class="mb-2 fw-bold">{{ $alternatif->nama }}</h4>
                                    <div class="mb-2">
                                        <span class="badge badge-no bg-secondary me-2">
                                            <i class="fas fa-hashtag me-1"></i>{{ $alternatif->no_pendaftaran }}
                                        </span>
                                        @if($alternatif->jenis_pendaftaran === 'kader')
                                            <span class="badge badge-kategori badge-kategori-kader">
                                                <i class="fas fa-user-graduate"></i> Kader
                                            </span>
                                        @else
                                            <span class="badge badge-kategori badge-kategori-dhuafa">
                                                <i class="fas fa-hands-helping"></i> Dhuafa
                                            </span>
                                        @endif
                                    </div>
                                    <p class="mb-0 text-muted">
                                        <i class="fas fa-envelope me-1"></i> {{ $alternatif->email }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 text-md-end mt-3 mt-md-0">
                            <a href="{{ $alternatif->jenis_pendaftaran === 'kader' ? route('pewawancara.kader') : route('pewawancara.dhuafa') }}" 
                               class="btn btn-outline-secondary btn-kembali">
                                <i class="fas fa-arrow-left me-1"></i> Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Form Penilaian -->
    <form action="{{ route('pewawancara.store', $alternatif->id) }}" method="POST" id="formPenilaian">
        @csrf

        @php
            $komponenByKategori = [];
            
            if ($alternatif->jenis_pendaftaran === 'kader') {
                $komponenByKategori = [
                    'Al-Islam & Kemuhammadiyahan' => [
                        'Baca Al-Qur\'an',
                        'Wawasan AIK',
                        'Keaktifan dalam Persyarikatan / Ortom',
                    ],
                    'Orientasi Kuliah' => [
                        'Visi, Misi, dan Tujuan',
                        'Kesiapan Akademik',
                        'Prestasi',
                    ],
                    'Komitmen Pasca Kuliah' => [
                        'Life Plan (Rencana Masa Depan)',
                        'Pengembangan Akademik',
                    ],
                    'Loyalitas & Pengabdian' => [
                        'Kontribusi Relawan Lazismu DIY',
                        'Loyalitas Mengabdi di Muhammadiyah',
                    ],
                ];
            } else {
                // DHUAFA
                $komponenByKategori = [
                    'Al-Islam' => [
                        'Baca Al-Qur\'an',
                        'Wawasan Keislaman',
                    ],
                    'Orientasi Kuliah' => [
                        'Visi, Misi, dan Tujuan',
                        'Kesiapan Akademik',
                        'Prestasi',
                    ],
                    'Komitmen Pasca Kuliah' => [
                        'Life Plan (Rencana Masa Depan)',
                        'Pengembangan Akademik',
                    ],
                    'Loyalitas & Pengabdian' => [
                        'Kontribusi Relawan Lazismu DIY',
                    ],
                ];
            }
            
            $kategoriIcons = [
                'Al-Islam & Kemuhammadiyahan' => 'fa-book-quran',
                'Al-Islam' => 'fa-book-quran',
                'Orientasi Kuliah' => 'fa-graduation-cap',
                'Komitmen Pasca Kuliah' => 'fa-star',
                'Loyalitas & Pengabdian' => 'fa-heart'
            ];
        @endphp

        @foreach($komponenByKategori as $kategoriNama => $komponenList)
        <div class="card mb-4 card-kategori">
            <div class="card-header card-header-lazismu">
                <h5 class="mb-0">
                    <i class="fas {{ $kategoriIcons[$kategoriNama] ?? 'fa-list-check' }} me-2"></i>
                    {{ $kategoriNama }}
                </h5>
                <small class="text-white-50">{{ count($komponenList) }} komponen penilaian</small>
            </div>
            <div class="card-body">
                @foreach($komponenList as $k)
                @php
                    $existingNilai = $existing[$k] ?? null;
                    $komponenId = str_replace([' ', '&', '(', ')', ',', '/', '\''], '_', $k);
                @endphp
                <div class="komponen-item {{ $loop->last ? '' : 'mb-4 pb-4 border-bottom' }}">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <div class="komponen-header">
                                <i class="fas fa-clipboard-check text-primary me-2"></i>
                                <label class="form-label fw-semibold mb-0">
                                    {{ $k }}
                                    <span class="text-danger">*</span>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <!-- Rating -->
                            <div class="mb-3">
                                <label class="form-label text-muted small mb-2">
                                    <i class="fas fa-star me-1"></i>Pilih Nilai (1-5)
                                </label>
                                <div class="rating-wrapper">
                                    @for($i = 1; $i <= 5; $i++)
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" 
                                               type="radio" 
                                               name="nilai[{{ $k }}]" 
                                               id="nilai_{{ $komponenId }}_{{ $i }}" 
                                               value="{{ $i }}"
                                               {{ $existingNilai && $existingNilai->nilai == $i ? 'checked' : '' }}
                                               required>
                                        <label class="form-check-label rating-label" 
                                               for="nilai_{{ $komponenId }}_{{ $i }}">
                                            <span class="rating-number">{{ $i }}</span>
                                            <span class="rating-star">
                                                @for($s = 1; $s <= $i; $s++)
                                                <i class="fas fa-star text-warning"></i>
                                                @endfor
                                            </span>
                                            <small class="rating-text">
                                                @if($i == 1) Kurang
                                                @elseif($i == 2) Cukup
                                                @elseif($i == 3) Baik
                                                @elseif($i == 4) Sangat Baik
                                                @else Excellent
                                                @endif
                                            </small>
                                        </label>
                                    </div>
                                    @endfor
                                </div>
                                @error("nilai.{$k}")
                                    <div class="alert alert-danger alert-sm mt-2">
                                        <i class="fas fa-exclamation-circle me-1"></i> {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Catatan -->
                            <div>
                                <label class="form-label text-muted small mb-2">
                                    <i class="fas fa-pencil-alt me-1"></i>Catatan Pewawancara (Opsional)
                                </label>
                                <textarea name="catatan[{{ $k }}]" 
                                          class="form-control form-control-custom" 
                                          rows="3" 
                                          placeholder="Tambahkan catatan penilaian untuk komponen {{ $k }}...">{{ $existingNilai->catatan ?? '' }}</textarea>
                                @error("catatan.{$k}")
                                    <div class="alert alert-danger alert-sm mt-2">
                                        <i class="fas fa-exclamation-circle me-1"></i> {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endforeach

        <!-- Progress Info -->
        <div class="card mb-4 card-progress">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-md-7">
                        <div class="d-flex align-items-start">
                            <div class="info-icon">
                                <i class="fas fa-info-circle"></i>
                            </div>
                            <div>
                                <h6 class="mb-2 fw-semibold">Informasi Penilaian</h6>
                                <ul class="info-list mb-0">
                                    <li>Total komponen: <strong>{{ count($komponen) }} komponen</strong></li>
                                    <li>Skala penilaian: <strong>1 (Kurang)</strong> - <strong>5 (Excellent)</strong></li>
                                    <li>Status: Disimpan sebagai <span class="badge bg-warning text-dark">Draft</span></li>
                                    <li>Catatan bersifat opsional namun membantu evaluasi</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 mt-3 mt-md-0">
                        <div class="progress-info-wrapper">
                            <div class="progress-label mb-2">
                                <span class="fw-semibold">Progress Penilaian</span>
                                <span class="text-muted">
                                    <span id="filledCount">0</span> / {{ count($komponen) }}
                                </span>
                            </div>
                            <div class="progress progress-custom" style="height: 28px;">
                                <div class="progress-bar progress-bar-lazismu" 
                                     role="progressbar" 
                                     style="width: 0%" 
                                     id="progressBar">
                                    <span class="fw-semibold" id="progressText">0%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="card card-actions">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                    <div>
                        <button type="button" class="btn btn-outline-secondary btn-reset" onclick="resetForm()">
                            <i class="fas fa-undo me-1"></i> Reset Form
                        </button>
                    </div>
                    <div class="d-flex gap-2 flex-wrap">
                        <a href="{{ $alternatif->jenis_pendaftaran === 'kader' ? route('pewawancara.kader') : route('pewawancara.dhuafa') }}" 
                           class="btn btn-outline-danger">
                            <i class="fas fa-times me-1"></i> Batal
                        </a>
                        <button type="submit" class="btn btn-lazismu btn-lg">
                            <i class="fas fa-save me-1"></i> Simpan Penilaian
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@push('styles')
<style>
    /* Info Peserta Card */
    .info-peserta-card {
        border: none;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        border-left: 4px solid var(--primary-color);
    }

    .user-avatar-large {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 700;
        font-size: 2rem;
        flex-shrink: 0;
        box-shadow: 0 4px 8px rgba(0,0,0,0.15);
        margin-right: 1.5rem;
    }

    .avatar-kader {
        background: linear-gradient(135deg, #10b981, #059669);
    }

    .avatar-dhuafa {
        background: linear-gradient(135deg, #f59e0b, #d97706);
    }

    .badge-no {
        padding: 0.5rem 1rem;
        font-size: 0.85rem;
        font-weight: 500;
    }

    .badge-kategori {
        padding: 0.5rem 1rem;
        font-size: 0.85rem;
        font-weight: 500;
    }

    .badge-kategori-kader {
        background: linear-gradient(135deg, #10b981, #059669);
        color: white;
    }

    .badge-kategori-dhuafa {
        background: linear-gradient(135deg, #f59e0b, #d97706);
        color: white;
    }

    .btn-kembali {
        padding: 0.6rem 1.5rem;
        border-radius: 8px;
        font-weight: 500;
        transition: all 0.3s;
    }

    .btn-kembali:hover {
        transform: translateX(-4px);
    }

    /* Card Kategori */
    .card-kategori {
        border: none;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        overflow: hidden;
    }

    .card-header-lazismu {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        color: white;
        padding: 1.25rem 1.5rem;
        border: none;
    }

    .card-header-lazismu h5 {
        font-size: 1.15rem;
        font-weight: 600;
        margin: 0;
    }

    /* Komponen Item */
    .komponen-item {
        background: #fafbfc;
        padding: 1.5rem;
        border-radius: 10px;
        transition: all 0.3s;
    }

    .komponen-item:hover {
        background: #f8fafc;
        box-shadow: 0 2px 6px rgba(0,0,0,0.05);
    }

    .komponen-header {
        display: flex;
        align-items: center;
        margin-bottom: 0.75rem;
    }

    .komponen-header .form-label {
        font-size: 1rem;
        color: #1e293b;
    }

    /* Rating Wrapper */
    .rating-wrapper {
        display: flex;
        gap: 0.75rem;
        flex-wrap: wrap;
    }

    .form-check-inline {
        margin-right: 0;
    }

    .rating-label {
        cursor: pointer;
        padding: 1rem 1.25rem;
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        transition: all 0.3s;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 0.5rem;
        min-width: 95px;
        background: white;
    }

    .rating-label:hover {
        border-color: var(--primary-color);
        background: linear-gradient(135deg, #fff5f2, #ffe8df);
        transform: translateY(-4px);
        box-shadow: 0 6px 12px rgba(255, 107, 53, 0.2);
    }

    .form-check-input:checked + .rating-label {
        border-color: var(--primary-color);
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        color: white;
        transform: translateY(-4px) scale(1.05);
        box-shadow: 0 8px 16px rgba(255, 107, 53, 0.3);
    }

    .form-check-input:checked + .rating-label .rating-number {
        color: white;
    }

    .form-check-input:checked + .rating-label .rating-text {
        color: white;
    }

    .rating-number {
        font-size: 1.75rem;
        font-weight: 700;
        color: var(--primary-color);
    }

    .rating-star {
        font-size: 0.8rem;
        white-space: nowrap;
    }

    .rating-text {
        font-size: 0.7rem;
        color: #64748b;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .form-check-input {
        display: none;
    }

    /* Form Control Custom */
    .form-control-custom {
        resize: vertical;
        min-height: 80px;
        border-radius: 10px;
        border: 2px solid #e2e8f0;
        padding: 0.75rem 1rem;
        transition: all 0.3s;
    }

    .form-control-custom:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 0.25rem rgba(255, 107, 53, 0.15);
        background-color: #fffaf8;
    }

    /* Alert Custom */
    .alert-sm {
        padding: 0.5rem 0.75rem;
        font-size: 0.85rem;
        border-radius: 6px;
    }

    /* Progress Card */
    .card-progress {
        border: 2px solid #fef3c7;
        border-radius: 12px;
        background: linear-gradient(135deg, #fffbeb, #fef3c7);
    }

    .info-icon {
        width: 48px;
        height: 48px;
        background: linear-gradient(135deg, #fbbf24, #f59e0b);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.5rem;
        margin-right: 1rem;
        flex-shrink: 0;
    }

    .info-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .info-list li {
        padding: 0.4rem 0;
        color: #78716c;
        font-size: 0.9rem;
    }

    .info-list li i {
        color: #f59e0b;
        margin-right: 0.5rem;
    }

    .progress-info-wrapper {
        background: white;
        padding: 1.25rem;
        border-radius: 10px;
        box-shadow: 0 2px 6px rgba(0,0,0,0.05);
    }

    .progress-label {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 0.9rem;
    }

    .progress-custom {
        background-color: #f1f5f9;
        border-radius: 8px;
        overflow: hidden;
    }

    .progress-bar-lazismu {
        background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
        transition: width 0.6s ease;
    }

    /* Action Card */
    .card-actions {
        border: none;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        position: sticky;
        bottom: 20px;
        z-index: 100;
        background: white;
    }

    .btn-reset {
        padding: 0.6rem 1.5rem;
        border-radius: 8px;
        font-weight: 500;
        transition: all 0.3s;
    }

    .btn-reset:hover {
        background-color: #f1f5f9;
        transform: rotate(-360deg);
    }

    .btn-lazismu {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        color: white;
        border: none;
        padding: 0.75rem 2rem;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s;
        box-shadow: 0 4px 8px rgba(255, 107, 53, 0.3);
    }

    .btn-lazismu:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 12px rgba(255, 107, 53, 0.4);
        color: white;
    }

    /* Border Bottom */
    .border-bottom {
        border-bottom: 2px solid #f1f5f9 !important;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .user-avatar-large {
            width: 60px;
            height: 60px;
            font-size: 1.5rem;
            margin-right: 1rem;
        }

        .rating-wrapper {
            gap: 0.5rem;
        }
        
        .rating-label {
            min-width: 75px;
            padding: 0.75rem 1rem;
        }
        
        .rating-number {
            font-size: 1.5rem;
        }

        .card-actions {
            position: static;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    // Update progress bar
    function updateProgress() {
        const totalKomponen = {{ count($komponen) }};
        const checkedRadios = document.querySelectorAll('input[type="radio"]:checked').length;
        const progress = Math.round((checkedRadios / totalKomponen) * 100);
        
        document.getElementById('progressBar').style.width = progress + '%';
        document.getElementById('progressText').textContent = progress + '%';
        document.getElementById('filledCount').textContent = checkedRadios;
    }

    // Event listener untuk semua radio button
    document.querySelectorAll('input[type="radio"]').forEach(radio => {
        radio.addEventListener('change', updateProgress);
    });

    // Reset form dengan animasi
    function resetForm() {
        if (confirm('⚠️ Apakah Anda yakin ingin mereset semua penilaian?\n\nData yang sudah diisi akan hilang dan tidak dapat dikembalikan.')) {
            document.getElementById('formPenilaian').reset();
            updateProgress();
            
            // Scroll to top dengan smooth animation
            window.scrollTo({ top: 0, behavior: 'smooth' });
            
            // Show notification
            const notification = document.createElement('div');
            notification.className = 'alert alert-info position-fixed top-0 start-50 translate-middle-x mt-3';
            notification.style.zIndex = '9999';
            notification.innerHTML = '<i class="fas fa-check-circle me-2"></i>Form berhasil direset!';
            document.body.appendChild(notification);
            
            setTimeout(() => {
                notification.remove();
            }, 3000);
        }
    }

    // Konfirmasi sebelum submit
    document.getElementById('formPenilaian').addEventListener('submit', function(e) {
        const totalKomponen = {{ count($komponen) }};
        const checkedRadios = document.querySelectorAll('input[type="radio"]:checked').length;
        
        if (checkedRadios < totalKomponen) {
            e.preventDefault();
            alert('⚠️ Mohon lengkapi semua penilaian!\n\nAnda baru mengisi ' + checkedRadios + ' dari ' + totalKomponen + ' komponen.\n\nSilakan lengkapi komponen yang masih kosong.');
            
            // Scroll ke komponen pertama yang belum diisi
            const firstEmpty = document.querySelector('input[type="radio"]:not(:checked)');
            if (firstEmpty) {
                firstEmpty.closest('.komponen-item').scrollIntoView({ 
                    behavior: 'smooth', 
                    block: 'center' 
                });
                
                // Highlight komponen yang belum diisi
                const komponenItem = firstEmpty.closest('.komponen-item');
                komponenItem.style.backgroundColor = '#fef2f2';
                komponenItem.style.border = '2px solid #ef4444';
                
                setTimeout(() => {
                    komponenItem.style.backgroundColor = '';
                    komponenItem.style.border = '';
                }, 2000);
            }
            return false;
        }

        if (!confirm('✅ Konfirmasi Penyimpanan\n\nApakah Anda yakin ingin menyimpan penilaian ini sebagai Draft?\n\nAnda masih dapat mengedit penilaian ini nanti.')) {
            e.preventDefault();
            return false;
        }
    });

    // Konfirmasi sebelum meninggalkan halaman jika ada perubahan
    let formChanged = false;
    document.querySelectorAll('input, textarea').forEach(element => {
        element.addEventListener('change', function() {
            formChanged = true;
        });
    });

    window.addEventListener('beforeunload', function(e) {
        if (formChanged) {
            e.preventDefault();
            e.returnValue = 'Anda memiliki perubahan yang belum disimpan. Yakin ingin meninggalkan halaman?';
        }
    });

    // Reset flag saat form di-submit
    document.getElementById('formPenilaian').addEventListener('submit', function() {
        formChanged = false;
    });

    // Initialize progress on page load
    updateProgress();

    // Add smooth scroll behavior
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({ behavior: 'smooth' });
            }
        });
    });
</script>
@endpush