@extends('layouts.pewawancara')

@section('content')
<div class="container-fluid">
    <!-- Stats Cards -->
    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="card stat-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="stat-label mb-2">Total Peserta Lulus Administrasi</p>
                            <h2 class="stat-value mb-0">{{ $peserta->count() }}</h2>
                            <small class="text-muted">
                                <i class="fas fa-users me-1"></i>
                                Keseluruhan peserta
                            </small>
                        </div>
                        <div class="stat-icon stat-icon-primary">
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
                            <p class="stat-label mb-2">Peserta Kader</p>
                            <h2 class="stat-value mb-0 text-success">{{ $peserta->where('jenis_pendaftaran', 'kader')->count() }}</h2>
                            <small class="text-muted">
                                <i class="fas fa-user-graduate me-1"></i>
                                Jalur kader
                            </small>
                        </div>
                        <div class="stat-icon stat-icon-success">
                            <i class="fas fa-user-graduate"></i>
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
                            <p class="stat-label mb-2">Peserta Dhuafa</p>
                            <h2 class="stat-value mb-0 text-warning">{{ $peserta->where('jenis_pendaftaran', 'dhuafa')->count() }}</h2>
                            <small class="text-muted">
                                <i class="fas fa-hands-helping me-1"></i>
                                Jalur dhuafa
                            </small>
                        </div>
                        <div class="stat-icon stat-icon-warning">
                            <i class="fas fa-hands-helping"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter & Table Card -->
    <div class="card">
        <div class="card-header">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3">
                <div>
                    <h5 class="mb-1"><i class="fas fa-list-ul me-2"></i>Daftar Peserta</h5>
                    <small class="text-muted">Kelola penilaian wawancara peserta</small>
                </div>
                <div class="btn-group filter-group" role="group">
                    <input type="radio" class="btn-check" name="filter" id="filterAll" autocomplete="off" checked>
                    <label class="btn btn-outline-primary" for="filterAll" onclick="filterTable('all')">
                        <i class="fas fa-list-ul"></i>
                        <span class="ms-1">Semua</span>
                    </label>

                    <input type="radio" class="btn-check" name="filter" id="filterKader" autocomplete="off">
                    <label class="btn btn-outline-success" for="filterKader" onclick="filterTable('kader')">
                        <i class="fas fa-user-graduate"></i>
                        <span class="ms-1">Kader</span>
                    </label>

                    <input type="radio" class="btn-check" name="filter" id="filterDhuafa" autocomplete="off">
                    <label class="btn btn-outline-warning" for="filterDhuafa" onclick="filterTable('dhuafa')">
                        <i class="fas fa-hands-helping"></i>
                        <span class="ms-1">Dhuafa</span>
                    </label>
                </div>
            </div>
        </div>
        <div class="card-body">
            @if($peserta->isEmpty())
                <div class="empty-state">
                    <div class="empty-icon">
                        <i class="fas fa-inbox"></i>
                    </div>
                    <h5 class="empty-title">Belum Ada Peserta</h5>
                    <p class="empty-text">Belum ada peserta yang lulus tahap administrasi</p>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover align-middle" id="pesertaTable">
                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th width="15%">No. Pendaftaran</th>
                                <th width="25%">Nama Lengkap</th>
                                <th width="15%">Kategori</th>
                                <th width="15%">Status</th>
                                <th width="15%">Tgl Daftar</th>
                                <th width="10%" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($peserta as $index => $p)
                            <tr data-kategori="{{ $p->jenis_pendaftaran }}">
                                <td class="text-muted fw-medium">{{ $index + 1 }}</td>
                                <td>
                                    <span class="badge bg-secondary bg-opacity-75">{{ $p->no_pendaftaran }}</span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="user-avatar-small me-2">
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
                                    @if($p->jenis_pendaftaran === 'kader')
                                        <span class="badge badge-kategori badge-kader">
                                            <i class="fas fa-user-graduate"></i> Kader
                                        </span>
                                    @else
                                        <span class="badge badge-kategori badge-dhuafa">
                                            <i class="fas fa-hands-helping"></i> Dhuafa
                                        </span>
                                    @endif
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
                                            <i class="fas fa-hourglass-half"></i> Belum Dinilai
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    <small class="text-muted">
                                        <i class="fas fa-calendar-alt me-1"></i>
                                        {{ $p->created_at->format('d M Y') }}
                                    </small>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('pewawancara.form', $p->id) }}" 
                                       class="btn btn-sm btn-action"
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
</div>
@endsection

@push('styles')
<style>
    /* Stats Card Styling */
    .stat-card {
        border: none;
        border-radius: 12px;
        transition: all 0.3s ease;
        overflow: hidden;
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
        color: var(--dark);
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

    .stat-icon-primary {
        background: linear-gradient(135deg, #ff6b35, #f7931e);
        color: white;
    }

    .stat-icon-success {
        background: linear-gradient(135deg, #10b981, #059669);
        color: white;
    }

    .stat-icon-warning {
        background: linear-gradient(135deg, #f59e0b, #d97706);
        color: white;
    }

    /* Filter Group */
    .filter-group {
        box-shadow: 0 2px 4px rgba(0,0,0,0.06);
        border-radius: 8px;
        overflow: hidden;
    }

    .filter-group .btn {
        padding: 0.5rem 1rem;
        font-weight: 500;
        border: none;
        transition: all 0.2s;
    }

    .filter-group .btn-check:checked + .btn {
        box-shadow: inset 0 2px 4px rgba(0,0,0,0.1);
    }

    /* User Avatar */
    .user-avatar-small {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 600;
        font-size: 0.95rem;
        flex-shrink: 0;
    }

    /* Table Styling */
    .table {
        margin-bottom: 0;
    }

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

    /* Badge Kategori */
    .badge-kategori {
        font-weight: 500;
        padding: 0.45rem 0.85rem;
        font-size: 0.8rem;
        border-radius: 6px;
    }

    .badge-kader {
        background: linear-gradient(135deg, #10b981, #059669);
        color: white;
    }

    .badge-dhuafa {
        background: linear-gradient(135deg, #f59e0b, #d97706);
        color: white;
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

    /* Action Button */
    .btn-action {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        color: white;
        border: none;
        padding: 0.5rem 1rem;
        border-radius: 6px;
        font-weight: 500;
        transition: all 0.3s;
    }

    .btn-action:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(255, 107, 53, 0.3);
        color: white;
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

        .filter-group .btn span {
            display: none;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    function filterTable(kategori) {
        const rows = document.querySelectorAll('#pesertaTable tbody tr');
        
        rows.forEach(row => {
            const rowKategori = row.getAttribute('data-kategori');
            
            if (kategori === 'all') {
                row.style.display = '';
            } else {
                row.style.display = rowKategori === kategori ? '' : 'none';
            }
        });

        updateRowNumbers();
    }

    function updateRowNumbers() {
        const visibleRows = document.querySelectorAll('#pesertaTable tbody tr:not([style*="display: none"])');
        visibleRows.forEach((row, index) => {
            row.querySelector('td:first-child').textContent = index + 1;
        });
    }
</script>
@endpush