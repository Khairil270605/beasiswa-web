@extends('layouts.app')

@section('title', 'Beasiswa Saya - LAZISMU')

@section('content')
<style>
    :root {
        --primary-color: #ec6b0d;
        --secondary-color: #e8963c;
        --success-color: #28a745;
        --warning-color: #ffc107;
        --danger-color: #dc3545;
        --info-color: #17a2b8;
        --muted-color: #6c757d;
        --purple-color: #6f42c1;
    }

    .page-header {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        color: white;
        padding: 3rem 0;
        margin: -2rem -15px 2rem -15px;
    }

    .page-header h1 {
        font-weight: 700;
        font-size: 2.2rem;
        margin-bottom: 0.5rem;
    }

    .page-header p {
        font-size: 1.05rem;
        opacity: 0.9;
        margin: 0;
    }

    .stats-overview {
        background: white;
        border-radius: 15px;
        padding: 2rem;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        margin-bottom: 2rem;
    }

    .stat-item {
        text-align: center;
        padding: 1rem;
        border-right: 1px solid #e9ecef;
    }
    .stat-item:last-child { border-right: none; }

    .stat-number {
        font-size: 2rem;
        font-weight: 800;
        color: var(--primary-color);
        margin-bottom: 0.4rem;
    }

    .stat-label {
        color: var(--muted-color);
        font-weight: 600;
        font-size: 0.9rem;
    }

    .riwayat-section {
        background: white;
        border-radius: 15px;
        padding: 2rem;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        margin-bottom: 2rem;
    }

    .section-title {
        color: var(--primary-color);
        font-weight: 800;
        font-size: 1.4rem;
        margin-bottom: 1.25rem;
        border-bottom: 2px solid #f8f9fa;
        padding-bottom: 0.5rem;
    }

    .riwayat-item {
        padding: 1.25rem;
        border: 2px solid #f8f9fa;
        border-radius: 12px;
        margin-bottom: 1rem;
        transition: all 0.25s ease;
        position: relative;
    }

    .riwayat-item:hover {
        border-color: rgba(236, 107, 13, 0.35);
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(236, 107, 13, 0.08);
    }

    .riwayat-item::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        width: 4px;
        height: 100%;
        border-radius: 0 4px 4px 0;
        background: #e9ecef;
    }

    /* Border berdasarkan STATUS BEASISWA (prioritas lebih tinggi) */
    .riwayat-item.beasiswa-diterima::before { background: var(--purple-color); }
    .riwayat-item.beasiswa-ditolak::before { background: var(--danger-color); }
    
    /* Border berdasarkan STATUS ADMINISTRASI (jika belum ada status beasiswa) */
    .riwayat-item.admin-pending::before { background: var(--warning-color); }
    .riwayat-item.admin-lulus::before { background: var(--success-color); }
    .riwayat-item.admin-tidak_lulus::before { background: var(--danger-color); }

    .beasiswa-nama {
        font-weight: 800;
        font-size: 1.15rem;
        color: #333;
        margin-bottom: 0.4rem;
    }

    .badge-pill {
        display: inline-flex;
        align-items: center;
        padding: 0.35rem 0.9rem;
        border-radius: 999px;
        font-weight: 700;
        font-size: 0.8rem;
        gap: 0.4rem;
        margin-top: 0.4rem;
        margin-right: 0.5rem;
    }

    .badge-wait { background: rgba(255, 193, 7, 0.18); color: #856404; }
    .badge-pass { background: rgba(40, 167, 69, 0.18); color: #155724; }
    .badge-fail { background: rgba(220, 53, 69, 0.18); color: #721c24; }
    .badge-info { background: rgba(23, 162, 184, 0.18); color: #0c5460; }
    .badge-purple { background: rgba(111, 66, 193, 0.18); color: #4a2682; }

    .badge-beasiswa-diterima {
        background: linear-gradient(135deg, var(--purple-color), #8e44ad);
        color: white;
        font-size: 0.9rem;
        padding: 0.5rem 1.2rem;
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.05); }
    }

    .divider {
        border-top: 1px dashed #dee2e6;
        margin: 1rem 0;
    }

    .meta {
        margin-top: 0.9rem;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 0.6rem;
        color: var(--muted-color);
        font-size: 0.92rem;
    }

    .meta .item {
        display: flex;
        gap: 0.5rem;
        align-items: center;
    }

    .meta i {
        color: var(--primary-color);
        width: 16px;
    }

    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        color: var(--muted-color);
    }

    .btn-primary-custom {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        color: white;
        padding: 0.6rem 1.5rem;
        border-radius: 25px;
        text-decoration: none;
        font-weight: 700;
        transition: all 0.25s ease;
        border: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-primary-custom:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(236, 107, 13, 0.25);
        color: white;
    }

    .alert-custom {
        border-radius: 10px;
        border: none;
        padding: 1rem 1.25rem;
        margin-top: 1rem;
    }

    .alert-custom strong {
        display: block;
        margin-bottom: 0.5rem;
    }

    @media (max-width: 768px) {
        .page-header { padding: 2rem 0; }
        .page-header h1 { font-size: 1.8rem; }
        .stats-overview { padding: 1.25rem; }
        .stat-item { border-right: none; border-bottom: 1px solid #e9ecef; }
        .stat-item:last-child { border-bottom: none; }
        .riwayat-section { padding: 1.25rem; }
        .meta { grid-template-columns: 1fr; }
    }

    /* Timeline Progress */
.timeline-section {
    background: white;
    border-radius: 15px;
    padding: 2rem;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
    margin-bottom: 2rem;
}

.timeline-item {
    background: #f8f9fa;
    border-radius: 12px;
    padding: 1.5rem;
    margin-bottom: 1.5rem;
}

.timeline-item:last-child {
    margin-bottom: 0;
}

.timeline-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1.5rem;
    padding-bottom: 0.75rem;
    border-bottom: 2px solid #dee2e6;
}

.timeline-header strong {
    font-size: 1.1rem;
    color: #333;
}

.progress-timeline {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 1rem;
    position: relative;
}

.progress-timeline::before {
    content: '';
    position: absolute;
    top: 30px;
    left: 10%;
    right: 10%;
    height: 3px;
    background: #dee2e6;
    z-index: 0;
}

.timeline-step {
    text-align: center;
    position: relative;
    z-index: 1;
}

.step-icon {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background: #e9ecef;
    color: #6c757d;
    margin: 0 auto 0.75rem;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    border: 4px solid white;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
}

.step-label {
    font-weight: 700;
    font-size: 0.9rem;
    color: #6c757d;
    margin-bottom: 0.25rem;
}

.step-date {
    font-size: 0.8rem;
    color: #adb5bd;
}

/* Status: Completed (Hijau) */
.timeline-step.completed .step-icon {
    background: linear-gradient(135deg, #28a745, #20c997);
    color: white;
}

.timeline-step.completed .step-label {
    color: #28a745;
}

.timeline-step.completed .step-date {
    color: #28a745;
}

/* Status: Active (Oranye) */
.timeline-step.active .step-icon {
    background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
    color: white;
    animation: pulse-ring 2s infinite;
}

.timeline-step.active .step-label {
    color: var(--primary-color);
    font-weight: 800;
}

.timeline-step.active .step-date {
    color: var(--primary-color);
}

@keyframes pulse-ring {
    0%, 100% {
        box-shadow: 0 0 0 0 rgba(236, 107, 13, 0.4);
    }
    50% {
        box-shadow: 0 0 0 15px rgba(236, 107, 13, 0);
    }
}

/* Status: Rejected (Merah) */
.timeline-step.rejected .step-icon {
    background: linear-gradient(135deg, #dc3545, #c82333);
    color: white;
}

.timeline-step.rejected .step-label {
    color: #dc3545;
}

.timeline-step.rejected .step-date {
    color: #dc3545;
}

/* Status: Disabled (Abu-abu) */
.timeline-step.disabled .step-icon {
    background: #e9ecef;
    color: #adb5bd;
}

.timeline-step.disabled .step-label {
    color: #adb5bd;
}

/* Responsive */
@media (max-width: 768px) {
    .progress-timeline {
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }
    
    .progress-timeline::before {
        display: none;
    }
    
    .timeline-step {
        display: flex;
        align-items: center;
        text-align: left;
        gap: 1rem;
    }
    
    .step-icon {
        width: 50px;
        height: 50px;
        margin: 0;
        flex-shrink: 0;
    }
    
    .step-label {
        margin-bottom: 0.25rem;
    }
}
</style>

<!-- Header -->
<div class="page-header">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1><i class="fas fa-graduation-cap me-3"></i>Beasiswa Saya</h1>
                <p>Pantau status verifikasi administrasi dan hasil akhir beasiswa.</p>
            </div>
            <div class="col-md-4 text-md-end mt-3 mt-md-0">
                <a href="{{ url('/daftar/dhuafa') }}" class="btn-primary-custom">
                    <i class="fas fa-plus"></i>Daftar Beasiswa Baru
                </a>
            </div>
        </div>
    </div>
</div>

<div class="container">

    <!-- Statistik singkat -->
    <div class="stats-overview">
        <div class="row">
            <div class="col-md-3 col-6 stat-item">
                <div class="stat-number">{{ $totalAplikasi ?? 0 }}</div>
                <div class="stat-label">Total Pendaftaran</div>
            </div>
            <div class="col-md-3 col-6 stat-item">
                <div class="stat-number">{{ $menungguAdministrasi ?? 0 }}</div>
                <div class="stat-label">Menunggu Verifikasi</div>
            </div>
            <div class="col-md-3 col-6 stat-item">
                <div class="stat-number">{{ $lulusAdministrasi ?? 0 }}</div>
                <div class="stat-label">Lulus Verifikasi</div>
            </div>
            <div class="col-md-3 col-6 stat-item">
                <div class="stat-number">{{ $beasiswaDiterima ?? 0 }}</div>
                <div class="stat-label">Beasiswa Diterima</div>
            </div>
        </div>

        @if(($beasiswaDitolak ?? 0) > 0)
            <div class="mt-3">
                <span class="badge-pill badge-fail">
                    <i class="fas fa-times-circle"></i>
                    {{ $beasiswaDitolak }} pendaftaran tidak diterima.
                </span>
            </div>
        @endif
    </div>
    <!-- Progress Timeline untuk setiap aplikasi -->
<!-- Progress Timeline untuk setiap aplikasi -->
@if($aplikasiBeasiswa->count() > 0)
<div class="timeline-section">
    <h2 class="section-title">
        <i class="fas fa-chart-line me-2"></i>Progress Tahapan Beasiswa
    </h2>

    @foreach($aplikasiBeasiswa as $aplikasi)
        @php
            $statusAdm = $aplikasi->status_administrasi ?? 'pending';
            $statusBeasiswa = $aplikasi->status_beasiswa ?? null;
            
            // Cek apakah sudah ada keputusan akhir (diterima/ditolak)
            $adaKeputusanAkhir = in_array($statusBeasiswa, ['diterima', 'lulus', 'ditolak', 'tidak_diterima', 'gagal', 'tidak_lulus']);
        @endphp

        <div class="timeline-item">
            <div class="timeline-header">
                <strong>{{ $aplikasi->nama }}</strong>
                <span class="text-muted">#{{ str_pad($aplikasi->id ?? 0, 6, '0', STR_PAD_LEFT) }}</span>
            </div>
            
            <div class="progress-timeline">
                <!-- Tahap 1: Pendaftaran (SELALU SELESAI) -->
                <div class="timeline-step completed">
                    <div class="step-icon">
                        <i class="fas fa-check"></i>
                    </div>
                    <div class="step-label">Pendaftaran</div>
                    <div class="step-date">{{ $aplikasi->created_at ? \Carbon\Carbon::parse($aplikasi->created_at)->format('d M Y') : '-' }}</div>
                </div>

                <!-- Tahap 2: Verifikasi Administrasi -->
                <div class="timeline-step {{ $statusAdm === 'lulus' ? 'completed' : ($statusAdm === 'tidak_lulus' ? 'rejected' : 'active') }}">
                    <div class="step-icon">
                        @if($statusAdm === 'lulus')
                            <i class="fas fa-check"></i>
                        @elseif($statusAdm === 'tidak_lulus')
                            <i class="fas fa-times"></i>
                        @else
                            <i class="fas fa-hourglass-half"></i>
                        @endif
                    </div>
                    <div class="step-label">Verifikasi Administrasi</div>
                    <div class="step-date">
                        @if($statusAdm === 'lulus')
                            {{ $aplikasi->updated_at ? \Carbon\Carbon::parse($aplikasi->updated_at)->format('d M Y') : 'Lulus' }}
                        @elseif($statusAdm === 'tidak_lulus')
                            Tidak Lulus
                        @else
                            Sedang diproses...
                        @endif
                    </div>
                </div>

                <!-- Tahap 3: Wawancara -->
                @php
                    // Logika wawancara yang benar:
                    if($statusAdm !== 'lulus') {
                        // Belum/tidak lulus admin → disabled
                        $wawancaraClass = 'disabled';
                        $wawancaraIcon = 'fa-lock';
                        $wawancaraText = '-';
                    } elseif($adaKeputusanAkhir) {
                        // Lulus admin + sudah ada keputusan → completed
                        $wawancaraClass = 'completed';
                        $wawancaraIcon = 'fa-check';
                        $wawancaraText = 'Selesai';
                    } else {
                        // Lulus admin tapi belum ada keputusan → active (SEDANG BERJALAN)
                        $wawancaraClass = 'active';
                        $wawancaraIcon = 'fa-user-tie';
                        $wawancaraText = '🔄 Sedang Berjalan';
                    }
                @endphp
                
                <div class="timeline-step {{ $wawancaraClass }}">
                    <div class="step-icon">
                        <i class="fas {{ $wawancaraIcon }}"></i>
                    </div>
                    <div class="step-label">Wawancara</div>
                    <div class="step-date">{{ $wawancaraText }}</div>
                </div>

                <!-- Tahap 4: Hasil Akhir -->
                @php
                    if($statusBeasiswa === 'diterima' || $statusBeasiswa === 'lulus') {
                        $hasilClass = 'completed';
                        $hasilIcon = 'fa-trophy';
                        $hasilBadge = '<span class="badge bg-success">✅ DITERIMA</span>';
                    } elseif(in_array($statusBeasiswa, ['ditolak', 'tidak_diterima', 'gagal', 'tidak_lulus'])) {
                        $hasilClass = 'rejected';
                        $hasilIcon = 'fa-times';
                        $hasilBadge = '<span class="badge bg-danger">❌ Tidak Diterima</span>';
                    } else {
                        $hasilClass = 'disabled';
                        $hasilIcon = 'fa-lock';
                        $hasilBadge = 'Belum diumumkan';
                    }
                @endphp
                
                <div class="timeline-step {{ $hasilClass }}">
                    <div class="step-icon">
                        <i class="fas {{ $hasilIcon }}"></i>
                    </div>
                    <div class="step-label">Hasil Akhir</div>
                    <div class="step-date">{!! $hasilBadge !!}</div>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endif

    <!-- Riwayat pendaftaran -->
    <div class="riwayat-section">
        <h2 class="section-title">
            <i class="fas fa-list me-2"></i>Riwayat Pendaftaran
        </h2>

        <div class="riwayat-list">
            @forelse($aplikasiBeasiswa as $aplikasi)
                @php
                    $statusAdm = $aplikasi->status_administrasi ?? 'pending';
                    $statusBeasiswa = $aplikasi->status_beasiswa ?? null;
                    
                    // Tentukan class border (prioritas: status_beasiswa > status_administrasi)
                    if($statusBeasiswa === 'diterima') {
                        $borderClass = 'beasiswa-diterima';
                    } elseif($statusBeasiswa === 'ditolak') {
                        $borderClass = 'beasiswa-ditolak';
                    } else {
                        $borderClass = 'admin-' . $statusAdm;
                    }
                @endphp

                <div class="riwayat-item {{ $borderClass }}">
                    <div class="beasiswa-nama">{{ $aplikasi->nama ?? '-' }}</div>

                    {{-- BAGIAN 1: STATUS ADMINISTRASI --}}
                    <div class="mb-2">
                        <small class="text-muted d-block mb-1"><strong>Status Verifikasi Administrasi:</strong></small>
                        @if($statusAdm === 'pending')
                            <span class="badge-pill badge-wait">
                                <i class="fas fa-hourglass-half"></i>Menunggu Verifikasi
                            </span>
                        @elseif($statusAdm === 'lulus')
                            <span class="badge-pill badge-pass">
                                <i class="fas fa-check-circle"></i>Lulus Verifikasi
                            </span>
                        @else
                            <span class="badge-pill badge-fail">
                                <i class="fas fa-times-circle"></i>Tidak Lulus Verifikasi
                            </span>
                        @endif
                    </div>

                    <div class="divider"></div>

                    {{-- BAGIAN 2: STATUS BEASISWA (HASIL AKHIR) --}}
                    <div class="mt-2">
                        <small class="text-muted d-block mb-1"><strong>Status Hasil Akhir Beasiswa:</strong></small>
                        
                        @if($statusAdm === 'pending')
                            {{-- Masih menunggu verifikasi administrasi, belum masuk tahap beasiswa --}}
                            <span class="badge-pill badge-wait">
                                <i class="fas fa-hourglass-half"></i>Menunggu Verifikasi Administrasi Terlebih Dahulu
                            </span>
                            
                        @elseif($statusAdm === 'tidak_lulus')
                            {{-- Tidak lulus administrasi, otomatis tidak bisa lanjut --}}
                            <span class="badge-pill badge-fail">
                                <i class="fas fa-times-circle"></i>Tidak Dapat Dilanjutkan (Tidak Lulus Administrasi)
                            </span>
                            
                        @elseif($statusAdm === 'lulus')
                            {{-- Lulus administrasi, cek status beasiswa --}}
                            @if($statusBeasiswa === 'diterima' || $statusBeasiswa === 'lulus')
                                {{-- DITERIMA --}}
                                <span class="badge-pill badge-beasiswa-diterima">
                                    <i class="fas fa-trophy"></i>🎉 BEASISWA DITERIMA
                                </span>
                                <div class="alert alert-success alert-custom mt-2 mb-0">
                                    <strong><i class="fas fa-check-circle"></i> Selamat!</strong>
                                    Anda telah diterima sebagai penerima beasiswa. Silakan menunggu informasi lebih lanjut dari admin terkait pencairan dana beasiswa.
                                </div>
                            @elseif($statusBeasiswa === 'ditolak' || $statusBeasiswa === 'tidak_diterima' || $statusBeasiswa === 'gagal' || $statusBeasiswa === 'tidak_lulus')
                                {{-- TIDAK DITERIMA --}}
                                <span class="badge-pill badge-fail">
                                    <i class="fas fa-ban"></i>Tidak Diterima
                                </span>
                                <div class="alert alert-danger alert-custom mt-2 mb-0">
                                    <strong><i class="fas fa-info-circle"></i> Mohon Maaf</strong>
                                    Anda belum berhasil pada seleksi beasiswa kali ini. 
                                    @if(!empty($aplikasi->catatan_admin))
                                        <br><br><strong>Catatan Admin:</strong><br>{{ $aplikasi->catatan_admin }}
                                    @endif
                                </div>
                            @else
                                {{-- BELUM ADA KEPUTUSAN - Tahap Wawancara --}}
                                <span class="badge-pill badge-purple">
                                    <i class="fas fa-user-tie"></i>Tahap Wawancara
                                </span>
                                <div class="alert alert-info alert-custom mt-2 mb-0">
                                    <strong><i class="fas fa-info-circle"></i> Informasi</strong>
                                    Anda telah lulus verifikasi administrasi dan akan mengikuti tahap wawancara. Silakan menunggu informasi jadwal wawancara dari admin. Hasil akhir akan diumumkan setelah proses wawancara selesai.
                                </div>
                            @endif
                        @endif
                    </div>

                    {{-- Metadata --}}
                    <div class="meta">
                        <div class="item">
                            <i class="fas fa-calendar-alt"></i>
                            <span>
                                Tanggal Daftar:
                                {{ $aplikasi->created_at ? \Carbon\Carbon::parse($aplikasi->created_at)->format('d M Y') : '-' }}
                            </span>
                        </div>

                        <div class="item">
                            <i class="fas fa-id-card"></i>
                            <span>ID Pendaftaran: #{{ str_pad($aplikasi->id ?? 0, 6, '0', STR_PAD_LEFT) }}</span>
                        </div>

                        <div class="item">
                            <i class="fas fa-user-tag"></i>
                            <span>Jenis: {{ ucfirst($aplikasi->jenis_pendaftaran ?? '-') }}</span>
                        </div>
                    </div>
                </div>
            @empty
                <div class="empty-state">
                    <i class="fas fa-inbox" style="font-size:4rem; color: var(--primary-color);"></i>
                    <h4 class="mt-3">Belum Ada Riwayat Pendaftaran</h4>
                    <p>Anda belum pernah mendaftar beasiswa. Mulai daftarkan diri Anda sekarang!</p>
                    <a href="{{ url('/daftar/dhuafa') }}" class="btn-primary-custom">
                        <i class="fas fa-plus"></i>Daftar Beasiswa Sekarang
                    </a>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection