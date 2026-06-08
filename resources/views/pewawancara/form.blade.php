@extends('layouts.pewawancara')

@section('content')
<div class="container-fluid">
    <!-- Info Peserta -->
    <div class="row mb-3">
        <div class="col-12">
            <div class="card info-peserta-card">
                <div class="card-body py-2 px-3">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center gap-3">
                            <div class="user-avatar-sm {{ $alternatif->jenis_pendaftaran === 'kader' ? 'avatar-kader' : 'avatar-dhuafa' }}">
                                {{ strtoupper(substr($alternatif->nama, 0, 1)) }}
                            </div>
                            <div>
                                <h6 class="mb-0 fw-bold">{{ $alternatif->nama }}</h6>
                                <div class="d-flex align-items-center gap-2 mt-1">
                                    <span class="badge bg-secondary" style="font-size:0.75rem;">{{ $alternatif->no_pendaftaran }}</span>
                                    @if($alternatif->jenis_pendaftaran === 'kader')
                                        <span class="badge badge-kategori-kader" style="font-size:0.75rem;"><i class="fas fa-user-graduate me-1"></i>Kader</span>
                                    @else
                                        <span class="badge badge-kategori-dhuafa" style="font-size:0.75rem;"><i class="fas fa-hands-helping me-1"></i>Dhuafa</span>
                                    @endif
                                    <span class="text-muted small">{{ $alternatif->email }}</span>
                                </div>
                            </div>
                        </div>
                        <a href="{{ $alternatif->jenis_pendaftaran === 'kader' ? route('pewawancara.kader') : route('pewawancara.dhuafa') }}" 
                           class="btn btn-sm btn-outline-secondary">
                            <i class="fas fa-arrow-left me-1"></i> Kembali
                        </a>
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

            $nilaiLabel = [1 => 'Kurang', 2 => 'Cukup', 3 => 'Baik', 4 => 'Sangat Baik', 5 => 'Excellent'];
        @endphp

        @foreach($komponenByKategori as $kategoriNama => $komponenList)
        <div class="card mb-3 card-kategori">
            <div class="card-header card-header-lazismu py-2 px-3">
                <h6 class="mb-0 d-flex align-items-center gap-2">
                    <i class="fas {{ $kategoriIcons[$kategoriNama] ?? 'fa-list-check' }}"></i>
                    {{ $kategoriNama }}
                    <span class="badge bg-white bg-opacity-25 ms-auto" style="font-size:0.7rem;">{{ count($komponenList) }} komponen</span>
                </h6>
            </div>
            <div class="card-body p-0">
                <table class="table table-komponen mb-0">
                    <thead>
                        <tr class="table-header-row">
                            <th style="width:35%">Komponen</th>
                            <th style="width:45%">Nilai</th>
                            <th style="width:20%">Catatan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($komponenList as $k)
                        @php
                            $existingNilai = $existing[$k] ?? null;
                            $komponenId = str_replace([' ', '&', '(', ')', ',', '/', '\''], '_', $k);
                        @endphp
                        <tr class="komponen-row">
                            <td class="komponen-name">
                                <span class="fw-semibold" style="font-size:0.875rem;">{{ $k }}</span>
                                <span class="text-danger ms-1">*</span>
                            </td>
                            <td>
                                <div class="rating-inline">
                                    @for($i = 1; $i <= 5; $i++)
                                    <input class="form-check-input d-none" 
                                           type="radio" 
                                           name="nilai[{{ $k }}]" 
                                           id="nilai_{{ $komponenId }}_{{ $i }}" 
                                           value="{{ $i }}"
                                           {{ $existingNilai && $existingNilai->nilai == $i ? 'checked' : '' }}
                                           required>
                                    <label class="rating-btn" 
                                           for="nilai_{{ $komponenId }}_{{ $i }}"
                                           title="{{ $nilaiLabel[$i] }}">
                                        <span class="rating-num">{{ $i }}</span>
                                        <span class="rating-lbl">{{ $nilaiLabel[$i] }}</span>
                                    </label>
                                    @endfor
                                </div>
                                @error("nilai.{$k}")
                                    <div class="text-danger" style="font-size:0.75rem;"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</div>
                                @enderror
                            </td>
                            <td>
                                <textarea name="catatan[{{ $k }}]" 
                                          class="form-control form-control-sm catatan-field" 
                                          rows="1"
                                          placeholder="Opsional...">{{ $existingNilai->catatan ?? '' }}</textarea>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endforeach
        <div class="card mb-3">
    <div class="card-header card-header-lazismu py-2 px-3">
        <h6 class="mb-0">
            <i class="fas fa-clipboard-list me-2"></i>
            Catatan Keseluruhan Pewawancara
        </h6>
    </div>
    <div class="card-body">
        <textarea
            name="catatan_akhir"
            class="form-control catatan-akhir"
            rows="4"
            placeholder="Tuliskan kesimpulan atau rekomendasi hasil wawancara peserta..."></textarea>
    </div>
</div>

        <!-- Progress & Action Row -->
        <div class="card mb-3">
            <div class="card-body py-2 px-3">
                <div class="d-flex align-items-center gap-3 flex-wrap">
                    <!-- Progress -->
                    <div class="d-flex align-items-center gap-2 flex-grow-1">
                        <small class="text-muted text-nowrap">Progress:</small>
                        <div class="progress flex-grow-1" style="height:20px; border-radius:6px; background:#f1f5f9;">
                            <div class="progress-bar progress-bar-lazismu" 
                                 role="progressbar" 
                                 style="width: 0%; border-radius:6px;" 
                                 id="progressBar">
                                <span style="font-size:0.75rem; font-weight:600;" id="progressText">0%</span>
                            </div>
                        </div>
                        <small class="text-muted text-nowrap">
                            <span id="filledCount">0</span>/{{ count($komponen) }}
                        </small>
                    </div>
                    <!-- Actions -->
                    <div class="d-flex gap-2">
                        <button type="button" class="btn btn-sm btn-outline-secondary" onclick="resetForm()">
                            <i class="fas fa-undo me-1"></i>Reset
                        </button>
                        <a href="{{ $alternatif->jenis_pendaftaran === 'kader' ? route('pewawancara.kader') : route('pewawancara.dhuafa') }}" 
                           class="btn btn-sm btn-outline-danger">
                            <i class="fas fa-times me-1"></i>Batal
                        </a>
                        <button type="submit" class="btn btn-sm btn-lazismu">
                            <i class="fas fa-save me-1"></i>Simpan Penilaian
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
    .info-peserta-card {
        border: none;
        border-radius: 10px;
        box-shadow: 0 2px 6px rgba(0,0,0,0.07);
        border-left: 4px solid var(--primary-color);
    }

    .user-avatar-sm {
        width: 44px;
        height: 44px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 700;
        font-size: 1.1rem;
        flex-shrink: 0;
    }

    .avatar-kader { background: linear-gradient(135deg, #10b981, #059669); }
    .avatar-dhuafa { background: linear-gradient(135deg, #f59e0b, #d97706); }

    .badge-kategori-kader {
        background: linear-gradient(135deg, #10b981, #059669);
        color: white;
    }
    .badge-kategori-dhuafa {
        background: linear-gradient(135deg, #f59e0b, #d97706);
        color: white;
    }

    /* Card Kategori */
    .card-kategori {
        border: none;
        border-radius: 10px;
        box-shadow: 0 2px 6px rgba(0,0,0,0.07);
        overflow: hidden;
    }

    .card-header-lazismu {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        color: white;
        border: none;
    }

    /* Table */
    .table-komponen {
        font-size: 0.875rem;
    }

    .table-header-row th {
        background: #f8fafc;
        color: #64748b;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 0.5rem 0.75rem;
        border-bottom: 2px solid #e2e8f0;
    }

    .komponen-row td {
        padding: 0.6rem 0.75rem;
        vertical-align: middle;
        border-bottom: 1px solid #f1f5f9;
    }

    .komponen-row:last-child td {
        border-bottom: none;
    }

    .komponen-row:hover {
        background: #fafbfc;
    }

    /* Rating inline */
    .rating-inline {
        display: flex;
        gap: 0.35rem;
        flex-wrap: nowrap;
        align-items: center;
    }

    .rating-btn {
        cursor: pointer;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        width: 52px;
        padding: 0.3rem 0.25rem;
        border: 1.5px solid #e2e8f0;
        border-radius: 8px;
        background: white;
        transition: all 0.18s;
        user-select: none;
        line-height: 1.2;
          overflow: hidden; /* tambah ini */
    }

    .rating-btn:hover {
        border-color: var(--primary-color);
        background: #fff5f2;
        transform: translateY(-2px);
        box-shadow: 0 3px 8px rgba(255, 107, 53, 0.18);
    }

    input[type="radio"]:checked + .rating-btn {
        border-color: var(--primary-color);
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(255, 107, 53, 0.3);
    }

    input[type="radio"]:checked + .rating-btn .rating-num,
    input[type="radio"]:checked + .rating-btn .rating-lbl {
        color: white;
    }

    .rating-num {
        font-size: 1.1rem;
        font-weight: 700;
        color: var(--primary-color);
        line-height: 1;
    }

    .rating-lbl {
        font-size: 0.55rem;
        color: #94a3b8;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0px;
        margin-top: 2px;
        white-space: nowrap;
        overflow: hidden;           /* tambah ini */
    text-overflow: ellipsis;    /* tambah ini */
    max-width: 100%;
    }

    /* Catatan field */
    .catatan-field {
        resize: none;
        border-radius: 6px;
        border: 1.5px solid #e2e8f0;
        font-size: 0.8rem;
        min-height: 36px;
        transition: border-color 0.2s;
    }

    .catatan-field:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 0.2rem rgba(255, 107, 53, 0.12);
        background: #fffaf8;
    }
    .catatan-akhir {
    border-radius: 8px;
    border: 1.5px solid #e2e8f0;
    font-size: 0.9rem;
    min-height: 120px;
    resize: vertical;
    transition: border-color 0.2s;
}

.catatan-akhir:focus {
    border-color: var(--primary-color);
    box-shadow: 0 0 0 0.2rem rgba(255, 107, 53, 0.12);
    background: #fffaf8;
}

    /* Progress bar */
    .progress-bar-lazismu {
        background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
        transition: width 0.5s ease;
    }

    /* Simpan button */
    .btn-lazismu {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        color: white;
        border: none;
        font-weight: 600;
        box-shadow: 0 3px 8px rgba(255, 107, 53, 0.3);
        transition: all 0.2s;
    }

    .btn-lazismu:hover {
        transform: translateY(-1px);
        box-shadow: 0 5px 12px rgba(255, 107, 53, 0.4);
        color: white;
    }

    @media (max-width: 768px) {
        .rating-btn {
            width: 44px;
            padding: 0.25rem 0.2rem;
        }
        .rating-num { font-size: 1rem; }
        .table-komponen { font-size: 0.8rem; }
        
        /* Stack table ke card list di mobile */
        .table-komponen thead { display: none; }
        .table-komponen, .table-komponen tbody, .table-komponen tr, .table-komponen td {
            display: block;
            width: 100%;
        }
        .komponen-row td { border-bottom: none; padding: 0.4rem 0.75rem; }
        .komponen-row { border-bottom: 1px solid #f1f5f9; padding: 0.5rem 0; }
        .komponen-row:last-child { border-bottom: none; }
    }
</style>
@endpush

@push('scripts')
<script>
    function updateProgress() {
        const totalKomponen = {{ count($komponen) }};
        const checkedRadios = document.querySelectorAll('input[type="radio"]:checked').length;
        const progress = Math.round((checkedRadios / totalKomponen) * 100);
        
        document.getElementById('progressBar').style.width = progress + '%';
        document.getElementById('progressText').textContent = progress + '%';
        document.getElementById('filledCount').textContent = checkedRadios;
    }

    document.querySelectorAll('input[type="radio"]').forEach(radio => {
        radio.addEventListener('change', updateProgress);
    });

    function resetForm() {
        if (confirm('Apakah Anda yakin ingin mereset semua penilaian?')) {
            document.getElementById('formPenilaian').reset();
            updateProgress();
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }
    }

    document.getElementById('formPenilaian').addEventListener('submit', function(e) {
        const totalKomponen = {{ count($komponen) }};
        const checkedRadios = document.querySelectorAll('input[type="radio"]:checked').length;
        
        if (checkedRadios < totalKomponen) {
            e.preventDefault();
            alert('Mohon lengkapi semua penilaian!\n\nBaru terisi ' + checkedRadios + ' dari ' + totalKomponen + ' komponen.');
            
            const firstEmpty = document.querySelector('.komponen-row:has(input[type="radio"]:not(:checked)) td:first-child');
            if (firstEmpty) {
                firstEmpty.closest('.komponen-row').scrollIntoView({ behavior: 'smooth', block: 'center' });
                firstEmpty.closest('.komponen-row').style.background = '#fef2f2';
                setTimeout(() => { firstEmpty.closest('.komponen-row').style.background = ''; }, 2000);
            }
            return false;
        }

        if (!confirm('Simpan penilaian ini sebagai Draft?')) {
            e.preventDefault();
            return false;
        }
    });

    let formChanged = false;
    document.querySelectorAll('input, textarea').forEach(el => {
        el.addEventListener('change', () => formChanged = true);
    });

    window.addEventListener('beforeunload', function(e) {
        if (formChanged) {
            e.preventDefault();
            e.returnValue = '';
        }
    });

    document.getElementById('formPenilaian').addEventListener('submit', () => formChanged = false);

    updateProgress();
</script>
@endpush