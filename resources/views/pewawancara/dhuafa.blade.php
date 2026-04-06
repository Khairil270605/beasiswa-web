@extends('layouts.pewawancara')

@section('content')
<div class="container-fluid">
    <!-- Header Banner -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card header-banner banner-dhuafa">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="banner-icon banner-icon-dhuafa">
                            <i class="fas fa-hands-helping"></i>
                        </div>
                        <div>
                            <h4 class="mb-1 fw-bold">Penilaian Wawancara Dhuafa</h4>
                            <p class="mb-0 text-muted">Daftar peserta kategori Dhuafa yang lulus administrasi</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="card stat-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="stat-label mb-2">Total Peserta Dhuafa</p>
                            <h2 class="stat-value mb-0 text-warning">{{ $peserta->count() }}</h2>
                            <small class="text-muted">
                                <i class="fas fa-users me-1"></i>
                                Jalur dhuafa
                            </small>
                        </div>
                        <div class="stat-icon stat-icon-warning">
                            <i class="fas fa-users"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card stat-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="stat-label mb-2">Sudah Dinilai</p>
                            <h2 class="stat-value mb-0 text-primary">
                                {{ $peserta->filter(function($p) { 
                                    return $p->nilaiWawancara->count() > 0; 
                                })->count() }}
                            </h2>
                            <small class="text-muted">
                                <i class="fas fa-check-circle me-1"></i>
                                Selesai penilaian
                            </small>
                        </div>
                        <div class="stat-icon stat-icon-primary">
                            <i class="fas fa-check-circle"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card stat-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="stat-label mb-2">Belum Dinilai</p>
                            <h2 class="stat-value mb-0 text-danger">
                                {{ $peserta->filter(function($p) { 
                                    return $p->nilaiWawancara->count() == 0; 
                                })->count() }}
                            </h2>
                            <small class="text-muted">
                                <i class="fas fa-hourglass-half me-1"></i>
                                Menunggu penilaian
                            </small>
                        </div>
                        <div class="stat-icon stat-icon-danger">
                            <i class="fas fa-hourglass-half"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel Peserta -->
    <div class="card">
        <div class="card-header">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3">
                <div>
                    <h5 class="mb-1">
                        <i class="fas fa-hands-helping me-2 text-warning"></i>Daftar Peserta Dhuafa
                    </h5>
                    <small class="text-muted">Kelola penilaian wawancara peserta jalur dhuafa</small>
                </div>
                <a href="{{ route('pewawancara.dashboard') }}" class="btn btn-outline-secondary btn-back">
                    <i class="fas fa-arrow-left me-1"></i> Kembali ke Dashboard
                </a>
            </div>
        </div>
        <div class="card-body">
            @if($peserta->isEmpty())
                <div class="empty-state">
                    <div class="empty-icon">
                        <i class="fas fa-inbox"></i>
                    </div>
                    <h5 class="empty-title">Belum Ada Peserta</h5>
                    <p class="empty-text">Belum ada peserta Dhuafa yang lulus tahap administrasi</p>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th width="15%">No. Pendaftaran</th>
                                <th width="20%">Nama Lengkap</th>
                                <th width="18%">Komponen</th>
                                <th width="12%">Status</th>
                                <th width="15%">Progress</th>
                                <th width="15%" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($peserta as $index => $p)
                            <tr>
                                <td class="text-muted fw-medium">{{ $index + 1 }}</td>
                                <td>
                                    <span class="badge badge-no-pendaftaran badge-dhuafa">{{ $p->no_pendaftaran }}</span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="user-avatar-small user-avatar-dhuafa me-2">
                                            {{ strtoupper(substr($p->nama, 0, 1)) }}
                                        </div>
                                        <div>
                                            <div class="fw-semibold text-dark">{{ $p->nama }}</div>
                                            <small class="text-muted">
                                                <i class="fas fa-envelope me-1"></i>{{ $p->email }}
                                            </small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="komponen-info">
                                        <span class="badge badge-outline-warning">
                                            <i class="fas fa-list-check me-1"></i>8 Komponen
                                        </span>
                                        <small class="d-block text-muted mt-1">
                                            Al-Islam, Orientasi, Komitmen
                                        </small>
                                    </div>
                                </td>
                                <td>
                                    @php
                                        $nilaiWawancara = $p->nilaiWawancara;
                                        $isDraft = $nilaiWawancara->where('status', 'draft')->count() > 0;
                                        $isFinal = $nilaiWawancara->where('status', 'final')->count() > 0;
                                    @endphp

                                    @if($isFinal)
                                        <span class="badge badge-status badge-final">
                                            <i class="fas fa-check-circle"></i> Final
                                        </span>
                                    @elseif($isDraft)
                                        <span class="badge badge-status badge-draft">
                                            <i class="fas fa-edit"></i> Draft
                                        </span>
                                    @else
                                        <span class="badge badge-status badge-pending">
                                            <i class="fas fa-hourglass-half"></i> Belum
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    @php
                                        $totalKomponen = 8;
                                        $sudahDinilai = $nilaiWawancara->count();
                                        $progress = $sudahDinilai > 0 ? round(($sudahDinilai / $totalKomponen) * 100) : 0;
                                        $progressClass = $progress == 100 ? 'bg-success' : 'bg-warning';
                                    @endphp
                                    <div class="progress-wrapper">
                                        <div class="progress" style="height: 22px;">
                                            <div class="progress-bar {{ $progressClass }}" 
                                                 role="progressbar" 
                                                 style="width: {{ $progress }}%"
                                                 aria-valuenow="{{ $progress }}" 
                                                 aria-valuemin="0" 
                                                 aria-valuemax="100">
                                                <span class="fw-semibold">{{ $progress }}%</span>
                                            </div>
                                        </div>
                                        <small class="text-muted d-block mt-1">
                                            {{ $sudahDinilai }}/{{ $totalKomponen }} komponen
                                        </small>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('pewawancara.form', $p->id) }}" 
                                       class="btn btn-sm btn-action btn-action-dhuafa"
                                       title="Penilaian Wawancara">
                                        <i class="fas fa-clipboard-check me-1"></i> Nilai
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>

    <!-- Info Komponen Dhuafa -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card info-card">
                <div class="card-header info-card-header">
                    <h6 class="mb-0">
                        <i class="fas fa-info-circle me-2"></i>Komponen Penilaian Dhuafa
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row g-4">
                        <div class="col-md-4">
                            <div class="komponen-group">
                                <div class="komponen-header">
                                    <div class="komponen-icon bg-warning bg-opacity-10 text-warning">
                                        <i class="fas fa-book-quran"></i>
                                    </div>
                                    <h6 class="fw-bold mb-0">Al-Islam</h6>
                                </div>
                                <ul class="komponen-list">
                                    <li><i class="fas fa-check-circle text-warning"></i> Tajwid</li>
                                    <li><i class="fas fa-check-circle text-warning"></i> Makhraj</li>
                                    <li><i class="fas fa-check-circle text-warning"></i> Rukun Islam & Iman</li>
                                    <li><i class="fas fa-check-circle text-warning"></i> Aktivitas Ibadah</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="komponen-group">
                                <div class="komponen-header">
                                    <div class="komponen-icon bg-info bg-opacity-10 text-info">
                                        <i class="fas fa-graduation-cap"></i>
                                    </div>
                                    <h6 class="fw-bold mb-0">Orientasi Kuliah</h6>
                                </div>
                                <ul class="komponen-list">
                                    <li><i class="fas fa-check-circle text-info"></i> Visi, Misi, Tujuan</li>
                                    <li><i class="fas fa-check-circle text-info"></i> Kesiapan Akademik</li>
                                    <li><i class="fas fa-check-circle text-info"></i> Prestasi</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="komponen-group">
                                <div class="komponen-header">
                                    <div class="komponen-icon bg-success bg-opacity-10 text-success">
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <h6 class="fw-bold mb-0">Komitmen Pasca Kuliah</h6>
                                </div>
                                <ul class="komponen-list">
                                    <li><i class="fas fa-check-circle text-success"></i> Life Plan</li>
                                    <li><i class="fas fa-check-circle text-success"></i> Pengembangan Akademik</li>
                                    <li><i class="fas fa-check-circle text-success"></i> Kontribusi Relawan Lazismu</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    /* Header Banner */
    .header-banner {
        border: none;
        border-radius: 12px;
        overflow: hidden;
    }

    .banner-dhuafa {
        border-left: 4px solid #f59e0b;
    }

    .banner-icon {
        width: 60px;
        height: 60px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.8rem;
        margin-right: 1rem;
    }

    .banner-icon-dhuafa {
        background: linear-gradient(135deg, #f59e0b, #d97706);
        color: white;
    }

    /* Stats Card */
    .stat-card {
        border: none;
        border-radius: 12px;
        transition: all 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 16px rgba(0,0,0,0.12);
    }

    .stat-label {
        color: #64748b;
        font-size: 0.875rem;
        font-weight: 500;
        margin: 0;
    }

    .stat-value {
        font-size: 2rem;
        font-weight: 700;
    }

    .stat-icon {
        width: 56px;
        height: 56px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
    }

    .stat-icon-warning {
        background: linear-gradient(135deg, #f59e0b, #d97706);
        color: white;
    }

    .stat-icon-primary {
        background: linear-gradient(135deg, #3b82f6, #2563eb);
        color: white;
    }

    .stat-icon-danger {
        background: linear-gradient(135deg, #ef4444, #dc2626);
        color: white;
    }

    /* Button Back */
    .btn-back {
        border-radius: 8px;
        padding: 0.5rem 1rem;
        font-weight: 500;
        transition: all 0.3s;
    }

    .btn-back:hover {
        transform: translateX(-4px);
    }

    /* User Avatar Dhuafa */
    .user-avatar-small {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 600;
        font-size: 0.95rem;
        flex-shrink: 0;
    }

    .user-avatar-dhuafa {
        background: linear-gradient(135deg, #f59e0b, #d97706);
    }

    /* Badge No Pendaftaran */
    .badge-no-pendaftaran {
        font-weight: 500;
        padding: 0.45rem 0.85rem;
        font-size: 0.8rem;
        border-radius: 6px;
    }

    .badge-dhuafa {
        background-color: #fef3c7;
        color: #92400e;
    }

    /* Badge Outline */
    .badge-outline-warning {
        background-color: #fef3c7;
        color: #92400e;
        border: 1px solid #fde68a;
        font-weight: 500;
        padding: 0.4rem 0.75rem;
        font-size: 0.8rem;
        border-radius: 6px;
    }

    /* Komponen Info */
    .komponen-info small {
        font-size: 0.75rem;
        line-height: 1.2;
    }

    /* Badge Status */
    .badge-status {
        font-weight: 500;
        padding: 0.45rem 0.85rem;
        font-size: 0.8rem;
        border-radius: 6px;
    }

    .badge-final {
        background-color: #dbeafe;
        color: #1e40af;
    }

    .badge-draft {
        background-color: #fef3c7;
        color: #92400e;
    }

    .badge-pending {
        background-color: #f1f5f9;
        color: #64748b;
    }

    /* Progress Bar */
    .progress-wrapper .progress {
        background-color: #f1f5f9;
        border-radius: 6px;
        overflow: hidden;
    }

    .progress-wrapper .progress-bar {
        font-size: 0.75rem;
        transition: width 0.6s ease;
    }

    /* Action Button Dhuafa */
    .btn-action-dhuafa {
        background: linear-gradient(135deg, #f59e0b, #d97706);
        color: white;
        border: none;
        padding: 0.5rem 1rem;
        border-radius: 6px;
        font-weight: 500;
        transition: all 0.3s;
    }

    .btn-action-dhuafa:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(245, 158, 11, 0.3);
        color: white;
    }

    /* Table */
    .table thead {
        background-color: #f8fafc;
    }

    .table thead th {
        font-weight: 600;
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #64748b;
        border-bottom: 2px solid #e2e8f0;
        padding: 1rem 0.75rem;
    }

    .table tbody tr {
        transition: all 0.2s ease;
        border-bottom: 1px solid #f1f5f9;
    }

    .table tbody tr:hover {
        background-color: #fafbfc;
        transform: scale(1.01);
    }

    .table tbody td {
        padding: 1rem 0.75rem;
        vertical-align: middle;
    }

    /* Info Card */
    .info-card {
        border: 2px solid #fef3c7;
        border-radius: 12px;
    }

    .info-card-header {
        background: linear-gradient(135deg, #fef3c7, #fde68a);
        color: #92400e;
        border-bottom: 2px solid #fde68a;
        padding: 1rem 1.5rem;
        border-radius: 10px 10px 0 0 !important;
    }

    /* Komponen Group */
    .komponen-group {
        height: 100%;
    }

    .komponen-header {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        margin-bottom: 1rem;
        padding-bottom: 0.75rem;
        border-bottom: 2px solid #f1f5f9;
    }

    .komponen-icon {
        width: 40px;
        height: 40px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
    }

    .komponen-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .komponen-list li {
        padding: 0.5rem 0;
        font-size: 0.9rem;
        color: #475569;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .komponen-list li i {
        font-size: 0.85rem;
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
    }

    .empty-icon {
        font-size: 4rem;
        color: #cbd5e1;
        margin-bottom: 1.5rem;
    }

    .empty-title {
        color: #64748b;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    .empty-text {
        color: #94a3b8;
        font-size: 0.95rem;
        margin: 0;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .stat-value {
            font-size: 1.5rem;
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            font-size: 1.25rem;
        }

        .banner-icon {
            width: 50px;
            height: 50px;
            font-size: 1.5rem;
        }
    }
</style>
@endpush