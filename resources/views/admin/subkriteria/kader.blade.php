@extends('layouts.admin')

@section('title', 'Data Sub Kriteria Kader')

@section('content')
<style>
/* CSS dengan konsistensi warna LAZISMU DIY */
:root {
    --primary-color: #ff6b35;      /* Orange LAZISMU */
    --secondary-color: #f7931e;    /* Kuning-orange */
    --success-color: #28a745;      /* Hijau */
    --danger-color: #dc3545;       /* Merah */
    --warning-color: #ffc107;      /* Kuning */
    --info-color: #17a2b8;         /* Biru info */
}

.kriteria-container {
    padding: 24px;
    background-color: #f8f9fa;
    min-height: 100vh;
}

.page-header {
    background: white;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    padding: 24px;
    margin-bottom: 24px;
    transition: all 0.3s ease;
}

.page-header:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 20px rgba(255, 107, 53, 0.1);
}

.page-title {
    font-size: 1.8rem;
    font-weight: bold;
    color: #212529;
    margin-bottom: 8px;
    display: flex;
    align-items: center;
}

.page-title i {
    color: var(--primary-color);
    margin-right: 12px;
}

.page-subtitle {
    color: #6c757d;
    font-size: 1rem;
    margin-bottom: 0;
}

.action-section {
    background: white;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    padding: 20px;
    margin-bottom: 24px;
    transition: all 0.3s ease;
}

.action-section:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 20px rgba(255, 107, 53, 0.1);
}

.btn-add {
    background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
    color: white;
    padding: 12px 24px;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 500;
    display: inline-flex;
    align-items: center;
    transition: all 0.3s ease;
    border: none;
}

.btn-add:hover {
    background: linear-gradient(45deg, #e55a2b, #e6841a);
    color: white;
    text-decoration: none;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(255, 107, 53, 0.3);
}

.btn-add i {
    margin-right: 8px;
}

.table-container {
    background: white;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    overflow: hidden;
}

.table-header {
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 50%, var(--danger-color) 100%);
    color: white;
    padding: 16px 20px;
    margin: 0;
}

.table-title {
    font-size: 1.2rem;
    font-weight: 600;
    margin: 0;
    display: flex;
    align-items: center;
}

.table-title i {
    margin-right: 10px;
}

.custom-table {
    margin: 0;
    border: none;
}

.custom-table thead th {
    background-color: #f8f9fa;
    border: none;
    padding: 16px 20px;
    font-weight: 600;
    color: #495057;
    font-size: 0.9rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.custom-table tbody td {
    padding: 16px 20px;
    border-top: 1px solid #e9ecef;
    vertical-align: middle;
}

.custom-table tbody tr:hover {
    background-color: rgba(255, 107, 53, 0.05);
}

.badge-tipe {
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 500;
    text-transform: uppercase;
}

.badge-benefit {
    background-color: rgba(40, 167, 69, 0.1);
    color: var(--success-color);
    border: 1px solid rgba(40, 167, 69, 0.2);
}

.badge-cost {
    background-color: rgba(220, 53, 69, 0.1);
    color: var(--danger-color);
    border: 1px solid rgba(220, 53, 69, 0.2);
}

.bobot-display {
    font-weight: 600;
    font-size: 1rem;
    color: var(--primary-color);
    padding: 4px 8px;
    background-color: rgba(255, 107, 53, 0.1);
    border-radius: 6px;
    display: inline-block;
}

.action-buttons {
    display: flex;
    gap: 8px;
    align-items: center;
}

.btn-edit {
    background-color: var(--success-color);
    color: white;
    padding: 8px 16px;
    border-radius: 6px;
    text-decoration: none;
    font-size: 0.85rem;
    font-weight: 500;
    transition: all 0.3s ease;
    border: none;
}

.btn-edit:hover {
    background-color: #218838;
    color: white;
    text-decoration: none;
    transform: scale(1.05);
}

.btn-delete {
    background-color: var(--danger-color);
    color: white;
    padding: 8px 16px;
    border-radius: 6px;
    font-size: 0.85rem;
    font-weight: 500;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
}

.btn-delete:hover {
    background-color: #c82333;
    transform: scale(1.05);
}

.empty-state {
    text-align: center;
    padding: 60px 20px;
    color: #6c757d;
}

.empty-icon {
    font-size: 4rem;
    color: rgba(255, 107, 53, 0.3);
    margin-bottom: 20px;
}

.empty-title {
    font-size: 1.2rem;
    font-weight: 600;
    margin-bottom: 8px;
    color: #495057;
}

.empty-text {
    font-size: 1rem;
    margin-bottom: 24px;
}

.stats-row {
    background: white;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    padding: 20px;
    margin-bottom: 24px;
    transition: all 0.3s ease;
}

.stats-row:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 20px rgba(255, 107, 53, 0.1);
}

.stat-item {
    text-align: center;
}

.stat-number {
    font-size: 2rem;
    font-weight: bold;
    margin-bottom: 4px;
}

.stat-number.primary { color: var(--primary-color); }
.stat-number.success { color: var(--success-color); }
.stat-number.secondary { color: var(--secondary-color); }

.stat-label {
    font-size: 0.9rem;
    color: #6c757d;
    font-weight: 500;
}

.alert-info {
    background: linear-gradient(45deg, rgba(255, 107, 53, 0.1), rgba(247, 147, 30, 0.1));
    border: 1px solid rgba(255, 107, 53, 0.2);
    color: #495057;
    padding: 16px;
    border-radius: 8px;
    margin-bottom: 0;
}

.alert-info i {
    margin-right: 8px;
    color: var(--primary-color);
}

.alert-success {
    background: linear-gradient(45deg, rgba(40, 167, 69, 0.1), rgba(40, 167, 69, 0.05));
    border: 1px solid rgba(40, 167, 69, 0.2);
    color: #155724;
    padding: 16px;
    border-radius: 8px;
    margin-bottom: 24px;
}

.alert-success i {
    color: var(--success-color);
}

/* Number indicator styling */
.stat-number-indicator {
    background-color: var(--secondary-color);
    color: white;
    padding: 4px 8px;
    border-radius: 12px;
    font-size: 0.8rem;
    font-weight: 600;
    display: inline-block;
    min-width: 24px;
    text-align: center;
}

@media (max-width: 768px) {
    .kriteria-container { padding: 16px; }
    .page-header { padding: 16px; }
    .action-section { padding: 16px; }
    .custom-table { font-size: 0.85rem; }
    .action-buttons { flex-direction: column; }
    .action-buttons .btn-edit,
    .action-buttons .btn-delete { width: 100%; text-align: center; margin-bottom: 4px; }
    .d-flex.justify-content-between.align-items-center {
        flex-direction: column;
        align-items: stretch !important;
    }
    .alert-info.flex-grow-1.me-3.mb-0 {
        margin-bottom: 16px !important;
        margin-right: 0 !important;
    }
}

@media (max-width: 576px) {
    .custom-table thead { display: none; }
    .custom-table tbody td {
        display: block;
        padding: 8px 16px;
        border: none;
        border-bottom: 1px solid #e9ecef;
    }
    .custom-table tbody td:before {
        content: attr(data-label) ": ";
        font-weight: bold;
        color: var(--primary-color);
        display: inline-block;
        width: 100px;
    }
    .custom-table tbody tr {
        display: block;
        border: 1px solid #e9ecef;
        border-radius: 8px;
        margin-bottom: 16px;
        background: white;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    .custom-table tbody tr:hover {
        box-shadow: 0 4px 12px rgba(255, 107, 53, 0.15);
    }
}

/* Animation untuk card entrance */
@keyframes slideInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.page-header,
.action-section,
.stats-row,
.table-container {
    animation: slideInUp 0.5s ease-out forwards;
}

.stats-row {
    animation-delay: 0.1s;
}

.table-container {
    animation-delay: 0.2s;
}
</style>

<div class="kriteria-container">
    <!-- Header Section -->
    <div class="page-header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 class="page-title">
                    <i class="fas fa-sitemap"></i>
                    Data Sub Kriteria Kader Muhammadiyah
                </h1>
                <p class="page-subtitle">Kelola sub kriteria penilaian untuk calon penerima <strong>Beasiswa Kader Muhammadiyah</strong></p>
            </div>
        </div>
    </div>

    <!-- Alert Success -->
    <!-- @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif -->

    <!-- Action Section -->
    <div class="action-section">
        <div class="d-flex justify-content-between align-items-center">
            <div class="alert-info flex-grow-1 me-3 mb-0">
                <i class="fas fa-info-circle"></i>
                <strong>Panduan:</strong> Sub kriteria adalah detail penilaian dari setiap kriteria utama kategori Kader Muhammadiyah.
            </div>
            <a href="{{ route('admin.subkriteria.kader.create') }}" class="btn-add">
                <i class="fas fa-plus"></i>
                Tambah Sub Kriteria Kader
            </a>
        </div>
    </div>

    <!-- Statistics Row -->
    <div class="stats-row">
        <div class="row">
            <div class="col-md-4">
                <div class="stat-item">
                    <div class="stat-number primary">{{ $subkriterias->count() }}</div>
                    <div class="stat-label">Total Sub Kriteria Kader</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-item">
                    <div class="stat-number success">{{ $kriterias->count() }}</div>
                    <div class="stat-label">Jumlah Kriteria</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-item">
                    <div class="stat-number secondary">{{ $subkriterias->count() > 0 ? number_format($subkriterias->avg('nilai'), 1) : 0 }}</div>
                    <div class="stat-label">Rata-rata Nilai</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Data Table -->
    <div class="table-container">
        <div class="table-header">
            <h3 class="table-title">
                <i class="fas fa-list-alt"></i>
                Daftar Sub Kriteria Kader Muhammadiyah
            </h3>
        </div>

        <div class="table-responsive">
            <table class="table custom-table">
                <thead>
                    <tr>
                        <th style="width: 60px;">No</th>
                        <th>Kriteria</th>
                        <th>Nama Sub Kriteria</th>
                        <th style="width: 120px;">Nilai</th>
                        <th style="width: 180px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($subkriterias as $index => $subkriteria)
                        <tr>
                            <td data-label="No">
                                <span class="stat-number-indicator">{{ $index + 1 }}</span>
                            </td>
                            <td data-label="Kriteria">
                                <strong>{{ $subkriteria->kriteria->nama_kriteria }}</strong>
                                <br>
                                <small class="text-muted">
                                    <span class="badge-tipe {{ $subkriteria->kriteria->jenis == 'benefit' ? 'badge-benefit' : 'badge-cost' }}">
                                        {{ strtoupper($subkriteria->kriteria->jenis) }}
                                    </span>
                                </small>
                            </td>
                            <td data-label="Nama Sub Kriteria">
                                <strong>{{ $subkriteria->nama_subkriteria }}</strong>
                                <br>
                                <small class="text-muted">ID: {{ $subkriteria->id }}</small>
                            </td>
                            <td data-label="Nilai">
                                <span class="bobot-display">{{ $subkriteria->nilai }}</span>
                            </td>
                            <td data-label="Aksi">
                                <div class="action-buttons">
                                    <a href="{{ route('admin.subkriteria.edit', $subkriteria->id) }}" 
                                       class="btn-edit" title="Edit Sub Kriteria">
                                        <i class="fas fa-edit me-1"></i> Edit
                                    </a>
                                    <form action="{{ route('admin.subkriteria.destroy', $subkriteria->id) }}" 
                                          method="POST" class="d-inline"
                                          onsubmit="return confirm('Yakin ingin menghapus sub kriteria {{ $subkriteria->nama_subkriteria }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-delete" title="Hapus Sub Kriteria">
                                            <i class="fas fa-trash me-1"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">
                                <div class="empty-state">
                                    <div class="empty-icon">
                                        <i class="fas fa-inbox"></i>
                                    </div>
                                    <h3 class="empty-title">Belum Ada Data Sub Kriteria Kader</h3>
                                    <p class="empty-text">
                                        Silakan tambahkan sub kriteria untuk kategori Kader Muhammadiyah terlebih dahulu.
                                        @if($kriterias->count() == 0)
                                        <br><small class="text-danger"><i class="fas fa-exclamation-triangle"></i> Pastikan sudah membuat Kriteria Kader terlebih dahulu</small>
                                        @endif
                                    </p>
                                    @if($kriterias->count() > 0)
                                    <a href="{{ route('admin.subkriteria.kader.create') }}" class="btn-add">
                                        <i class="fas fa-plus"></i>
                                        Tambah Sub Kriteria Pertama
                                    </a>
                                    @else
                                    <a href="{{ route('admin.kriteria.kader') }}" class="btn-add">
                                        <i class="fas fa-arrow-left me-1"></i>
                                        Buat Kriteria Kader Terlebih Dahulu
                                    </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection