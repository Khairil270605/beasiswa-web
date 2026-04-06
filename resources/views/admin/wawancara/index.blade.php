@extends('layouts.admin')

@section('title', $pageTitle ?? 'Nilai Wawancara')

@section('content')
<style>
/* LAZISMU DIY Consistent Style - Nilai Wawancara */
:root {
    --primary-color: #ff6b35;
    --secondary-color: #f7931e;
    --success-color: #28a745;
    --danger-color: #dc3545;
    --warning-color: #ffc107;
    --info-color: #17a2b8;
}

.wawancara-container {
    padding: 24px;
    background-color: #f8f9fa;
    min-height: 100vh;
}

/* Page Header - LAZISMU Style */
.page-header {
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    padding: 24px;
    margin-bottom: 24px;
    transition: all 0.3s ease;
    animation: slideInUp 0.5s ease-out forwards;
    color: white;
}

.page-header:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 20px rgba(255, 107, 53, 0.2);
}

.page-title {
    font-size: 1.8rem;
    font-weight: bold;
    color: white;
    margin-bottom: 8px;
    display: flex;
    align-items: center;
}

.page-title i {
    margin-right: 12px;
    font-size: 2rem;
}

.page-subtitle {
    color: rgba(255, 255, 255, 0.9);
    font-size: 1rem;
    margin: 0;
}

.total-count-badge {
    display: inline-block;
    background: rgba(255, 255, 255, 0.2);
    padding: 8px 20px;
    border-radius: 25px;
    font-size: 1rem;
    font-weight: 600;
    margin-top: 12px;
    border: 2px solid rgba(255, 255, 255, 0.3);
}

/* Filter Card - LAZISMU Style */
.filter-card {
    background: white;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    padding: 24px;
    margin-bottom: 24px;
    animation: slideInUp 0.5s ease-out forwards;
    animation-delay: 0.1s;
}

.filter-card .form-label {
    font-weight: 600;
    color: #495057;
    margin-bottom: 8px;
    display: block;
}

.filter-card .form-label i {
    color: var(--primary-color);
    margin-right: 6px;
}

.form-control, .form-select {
    border: 2px solid #e9ecef;
    border-radius: 8px;
    padding: 10px 14px;
    transition: all 0.3s ease;
}

.form-control:focus, .form-select:focus {
    border-color: var(--primary-color);
    box-shadow: 0 0 0 0.2rem rgba(255, 107, 53, 0.25);
    outline: none;
}

.btn-reset {
    background: linear-gradient(45deg, #6c757d, #868e96);
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 8px;
    font-weight: 600;
    transition: all 0.3s ease;
    cursor: pointer;
}

.btn-reset:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(108, 117, 125, 0.3);
}

/* Table Container - LAZISMU Style */
.table-container {
    background: white;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    overflow: hidden;
    animation: slideInUp 0.5s ease-out forwards;
    animation-delay: 0.2s;
}

.table-header {
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
    color: white;
    padding: 16px 20px;
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

/* Table Styling */
.wawancara-table {
    width: 100%;
    border-collapse: collapse;
    margin: 0;
}

.wawancara-table thead th {
    background-color: #f8f9fa;
    color: #495057;
    font-weight: 600;
    padding: 16px 12px;
    text-align: center;
    border: none;
    font-size: 0.9rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.wawancara-table tbody td {
    padding: 16px 12px;
    text-align: center;
    border-top: 1px solid #e9ecef;
    vertical-align: middle;
}

.wawancara-table tbody tr {
    transition: all 0.3s ease;
}

.wawancara-table tbody tr:hover {
    background-color: rgba(255, 107, 53, 0.05);
    transform: scale(1.002);
}

/* Sortable Headers */
.sortable {
    cursor: pointer;
    user-select: none;
    position: relative;
    transition: all 0.3s ease;
}

.sortable:hover {
    background-color: #e9ecef;
}

.sortable .sort-icon {
    opacity: 0.5;
    font-size: 0.8em;
    margin-left: 6px;
}

.sortable.active {
    background-color: #dee2e6;
}

.sortable.active .sort-icon {
    opacity: 1;
    color: var(--primary-color);
}

/* Badge Styling - LAZISMU Colors */
.badge {
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 0.85rem;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    gap: 4px;
}

.badge-kader {
    background: linear-gradient(45deg, #667eea, #764ba2);
    color: white;
}

.badge-dhuafa {
    background: linear-gradient(45deg, var(--info-color), #138496);
    color: white;
}

.score-badge-high {
    background: linear-gradient(45deg, var(--success-color), #20c997);
    color: white;
}

.score-badge-medium {
    background: linear-gradient(45deg, var(--warning-color), var(--secondary-color));
    color: #212529;
}

.score-badge-low {
    background: linear-gradient(45deg, var(--danger-color), #e74c3c);
    color: white;
}

/* Progress Bar - LAZISMU Style */
.progress-wrapper {
    display: flex;
    align-items: center;
    gap: 8px;
}

.progress {
    flex: 1;
    height: 24px;
    border-radius: 12px;
    background-color: #e9ecef;
    overflow: hidden;
}

.progress-bar {
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.75rem;
    font-weight: 600;
    color: white;
    transition: width 0.6s ease;
    border-radius: 12px;
}

.progress-bar-complete {
    background: linear-gradient(90deg, var(--success-color), #20c997);
}

.progress-bar-incomplete {
    background: linear-gradient(90deg, var(--warning-color), var(--secondary-color));
}

.progress-icon {
    font-size: 1.2rem;
}

.progress-icon.complete {
    color: var(--success-color);
}

.progress-icon.incomplete {
    color: var(--warning-color);
}

/* Buttons - LAZISMU Style */
.btn-detail {
    background: linear-gradient(45deg, var(--info-color), #138496);
    color: white;
    border: none;
    padding: 8px 16px;
    border-radius: 6px;
    font-size: 0.85rem;
    font-weight: 600;
    transition: all 0.3s ease;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 6px;
}

.btn-detail:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(23, 162, 184, 0.3);
}

/* Modal Styling - LAZISMU */
.modal-content {
    border-radius: 15px;
    overflow: hidden;
    border: none;
}

.modal-header {
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
    color: white;
    border: none;
    padding: 20px 24px;
}

.modal-title {
    font-weight: 700;
    display: flex;
    align-items: center;
    gap: 10px;
}

.modal-header .btn-close {
    filter: brightness(0) invert(1);
}

.modal-body {
    padding: 24px;
}

.summary-card {
    background: linear-gradient(135deg, rgba(255, 107, 53, 0.1), rgba(247, 147, 30, 0.05));
    border: 2px solid rgba(255, 107, 53, 0.2);
    border-radius: 12px;
    padding: 20px;
    margin-bottom: 24px;
}

.summary-card .row > div {
    padding: 12px;
}

.summary-card strong {
    color: var(--primary-color);
}

.summary-score {
    font-size: 2.5rem;
    font-weight: 800;
    margin: 8px 0;
}

.detail-table {
    border-radius: 8px;
    overflow: hidden;
}

.detail-table thead {
    background: linear-gradient(135deg, #f8f9fa, #e9ecef);
}

.detail-table thead th {
    font-weight: 600;
    color: #495057;
    border: none;
    padding: 14px;
}

.detail-table tbody tr {
    transition: all 0.3s ease;
}

.detail-table tbody tr:hover {
    background-color: rgba(255, 107, 53, 0.05);
}

/* Empty State */
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
    line-height: 1.6;
}

/* Participant Info */
.participant-name {
    font-weight: 700;
    color: #495057;
    display: flex;
    align-items: center;
    gap: 8px;
}

.participant-icon {
    color: var(--primary-color);
    font-size: 1.2rem;
}

/* Animation */
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

.fade-in {
    animation: slideInUp 0.5s ease-out;
}

/* Responsive */
@media (max-width: 768px) {
    .wawancara-container {
        padding: 16px;
    }
    
    .page-header {
        padding: 20px;
    }
    
    .page-title {
        font-size: 1.5rem;
    }
    
    .filter-card {
        padding: 20px;
    }
    
    .wawancara-table thead {
        display: none;
    }
    
    .wawancara-table tbody tr {
        display: block;
        border: 1px solid #e9ecef;
        border-radius: 8px;
        margin-bottom: 16px;
        padding: 16px;
        background: white;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    
    .wawancara-table tbody td {
        display: block;
        text-align: left;
        border: none;
        padding: 8px 0;
    }
    
    .wawancara-table tbody td:before {
        content: attr(data-label);
        font-weight: bold;
        color: var(--primary-color);
        display: block;
        margin-bottom: 4px;
    }
    
    .summary-score {
        font-size: 2rem;
    }
}
</style>

<div class="wawancara-container">
    <!-- Page Header -->
    <div class="page-header fade-in">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="page-title">
                    <i class="bi bi-clipboard-check"></i>
                    {{ $pageTitle ?? 'Nilai Wawancara' }}
                </h1>
                <p class="page-subtitle">
                    Rekapitulasi nilai wawancara peserta beasiswa berdasarkan komponen penilaian
                </p>
                <span class="total-count-badge">
                    <i class="bi bi-people-fill me-2"></i>
                    Total: <span id="totalCount">{{ count($peserta) }}</span> peserta
                </span>
            </div>
        </div>
    </div>

    <!-- Filter Card -->
    <div class="filter-card fade-in">
        <div class="row g-3">
            <!-- Search -->
            <div class="col-md-4">
                <label class="form-label">
                    <i class="bi bi-search"></i>Cari Peserta
                </label>
                <input type="text" 
                       id="searchInput" 
                       class="form-control" 
                       placeholder="Ketik nama peserta...">
            </div>

            <!-- Filter Jenis -->
            <div class="col-md-3">
                <label class="form-label">
                    <i class="bi bi-funnel"></i>Jenis Pendaftaran
                </label>
                <select id="filterJenis" class="form-select">
                    <option value="">Semua Jenis</option>
                    <option value="kader">Kader</option>
                    <option value="dhuafa">Dhuafa</option>
                </select>
            </div>

            <!-- Filter Progress -->
            <div class="col-md-3">
                <label class="form-label">
                    <i class="bi bi-bar-chart"></i>Status Progress
                </label>
                <select id="filterProgress" class="form-select">
                    <option value="">Semua Status</option>
                    <option value="complete">Lengkap</option>
                    <option value="incomplete">Belum Lengkap</option>
                </select>
            </div>

            <!-- Reset Button -->
            <div class="col-md-2">
                <label class="form-label">&nbsp;</label>
                <button type="button" 
                        id="resetFilter" 
                        class="btn btn-reset w-100">
                    <i class="bi bi-arrow-counterclockwise me-1"></i>Reset
                </button>
            </div>
        </div>
    </div>

    <!-- Table Container -->
    <div class="table-container fade-in">
        <div class="table-header">
            <h3 class="table-title">
                <i class="bi bi-table"></i>
                Data Nilai Wawancara Peserta
            </h3>
        </div>
        
        <div class="table-responsive">
            <table class="wawancara-table" id="pesertaTable">
                <thead>
                    <tr>
                        <th class="sortable" data-sort="nama">
                            <i class="bi bi-person-fill me-1"></i>Nama Peserta
                            <i class="bi bi-arrow-down-up sort-icon"></i>
                        </th>
                        <th class="sortable" data-sort="jenis">
                            <i class="bi bi-tag-fill me-1"></i>Jenis
                            <i class="bi bi-arrow-down-up sort-icon"></i>
                        </th>
                        <th class="sortable" data-sort="total">
                            <i class="bi bi-calculator me-1"></i>Total Nilai
                            <i class="bi bi-arrow-down-up sort-icon"></i>
                        </th>
                        <th class="sortable" data-sort="skor">
                            <i class="bi bi-award me-1"></i>Skor (0-100)
                            <i class="bi bi-arrow-down-up sort-icon"></i>
                        </th>
                        <th class="sortable" data-sort="progres">
                            <i class="bi bi-graph-up me-1"></i>Progress
                            <i class="bi bi-arrow-down-up sort-icon"></i>
                        </th>
                        <th>
                            <i class="bi bi-gear-fill me-1"></i>Aksi
                        </th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($peserta as $p)
                        @php
                            $total = $p->nilaiWawancara->sum('nilai');
                            $jumlahKomponen = $p->jenis_pendaftaran === 'kader' ? 10 : 8;
                            $maxTotal = $jumlahKomponen * 5;
                            $skorAkhir = $maxTotal > 0 ? ($total / $maxTotal) * 100 : 0;
                            $terisi = $p->nilaiWawancara->count();
                            $isComplete = $terisi == $jumlahKomponen;
                            $progressPercent = $jumlahKomponen > 0 ? ($terisi / $jumlahKomponen) * 100 : 0;
                        @endphp

                        <tr data-jenis="{{ $p->jenis_pendaftaran }}" 
                            data-complete="{{ $isComplete ? 'true' : 'false' }}"
                            data-total="{{ $total }}"
                            data-skor="{{ $skorAkhir }}"
                            data-progres="{{ $terisi }}">
                            
                            <td data-label="Nama Peserta">
                                <div class="participant-name">
                                    <i class="bi bi-person-circle participant-icon"></i>
                                    <span class="nama-text">{{ $p->nama }}</span>
                                </div>
                            </td>
                            
                            <td data-label="Jenis">
                                @if($p->jenis_pendaftaran === 'kader')
                                    <span class="badge badge-kader">
                                        <i class="bi bi-star-fill"></i>Kader
                                    </span>
                                @else
                                    <span class="badge badge-dhuafa">
                                        <i class="bi bi-person"></i>Dhuafa
                                    </span>
                                @endif
                            </td>
                            
                            <td data-label="Total Nilai">
                                <strong>{{ $total }}</strong> / {{ $maxTotal }}
                            </td>
                            
                            <td data-label="Skor">
                                <span class="badge {{ $skorAkhir >= 80 ? 'score-badge-high' : ($skorAkhir >= 60 ? 'score-badge-medium' : 'score-badge-low') }}">
                                    {{ number_format($skorAkhir, 2) }}
                                </span>
                            </td>
                            
                            <td data-label="Progress">
                                <div class="progress-wrapper">
                                    <div class="progress">
                                        <div class="progress-bar {{ $isComplete ? 'progress-bar-complete' : 'progress-bar-incomplete' }}" 
                                             role="progressbar" 
                                             style="width: {{ $progressPercent }}%">
                                            {{ $terisi }}/{{ $jumlahKomponen }}
                                        </div>
                                    </div>
                                    <i class="bi {{ $isComplete ? 'bi-check-circle-fill progress-icon complete' : 'bi-exclamation-circle-fill progress-icon incomplete' }}"></i>
                                </div>
                            </td>
                            
                            <td data-label="Aksi">
                                <button type="button"
                                        class="btn-detail"
                                        data-bs-toggle="modal"
                                        data-bs-target="#detailModal-{{ $p->id }}">
                                    <i class="bi bi-eye"></i>Detail
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Empty State -->
        <div id="emptyState" class="empty-state d-none">
            <div class="empty-icon">
                <i class="bi bi-inbox"></i>
            </div>
            <div class="empty-title">Tidak Ada Data</div>
            <div class="empty-text">
                Tidak ada data yang sesuai dengan filter yang Anda pilih.<br>
                Coba ubah filter atau reset pencarian.
            </div>
        </div>
    </div>
</div>

{{-- Modal Detail per Peserta --}}
@foreach($peserta as $p)
    @php
        $total = $p->nilaiWawancara->sum('nilai');
        $jumlahKomponen = $p->jenis_pendaftaran === 'kader' ? 10 : 8;
        $maxTotal = $jumlahKomponen * 5;
        $skorAkhir = $maxTotal > 0 ? ($total / $maxTotal) * 100 : 0;
    @endphp

    <div class="modal fade" id="detailModal-{{ $p->id }}" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="bi bi-clipboard-data"></i>
                        Detail Wawancara – {{ $p->nama }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <!-- Summary Card -->
                    <div class="summary-card">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <p class="mb-2">
                                    <i class="bi bi-tag-fill me-2"></i>
                                    <strong>Jenis:</strong> 
                                    <span class="badge {{ $p->jenis_pendaftaran === 'kader' ? 'badge-kader' : 'badge-dhuafa' }}">
                                        {{ ucfirst($p->jenis_pendaftaran) }}
                                    </span>
                                </p>
                                <p class="mb-0">
                                    <i class="bi bi-calculator me-2"></i>
                                    <strong>Total Nilai:</strong> {{ $total }} / {{ $maxTotal }}
                                </p>
                            </div>
                            <div class="col-md-6 text-md-end">
                                <p class="mb-2">
                                    <i class="bi bi-award-fill me-2"></i>
                                    <strong>Skor Akhir:</strong>
                                </p>
                                <div class="summary-score">
                                    <span class="badge {{ $skorAkhir >= 80 ? 'score-badge-high' : ($skorAkhir >= 60 ? 'score-badge-medium' : 'score-badge-low') }}">
                                        {{ number_format($skorAkhir, 2) }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Detail Table -->
                    <div class="table-responsive">
                        <table class="table detail-table table-bordered">
                            <thead>
                                <tr>
                                    <th width="40%">
                                        <i class="bi bi-list-check me-1"></i>Komponen
                                    </th>
                                    <th width="15%" class="text-center">
                                        <i class="bi bi-star-fill me-1"></i>Nilai
                                    </th>
                                    <th width="45%">
                                        <i class="bi bi-pencil-square me-1"></i>Catatan
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($p->nilaiWawancara as $nw)
                                    <tr>
                                        <td class="fw-semibold">{{ $nw->komponen }}</td>
                                        <td class="text-center">
                                            <span class="badge {{ $nw->nilai >= 4 ? 'score-badge-high' : ($nw->nilai >= 3 ? 'score-badge-medium' : 'score-badge-low') }}">
                                                {{ $nw->nilai }} / 5
                                            </span>
                                        </td>
                                        <td>
                                            @if($nw->catatan)
                                                <small>{{ $nw->catatan }}</small>
                                            @else
                                                <span class="text-muted fst-italic">-</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center py-4">
                                            <i class="bi bi-info-circle fs-4 text-muted d-block mb-2"></i>
                                            <span class="text-muted">Belum ada nilai wawancara.</span>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle me-1"></i>Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>
@endforeach

<script>
document.addEventListener('DOMContentLoaded', function() {
    const table = document.getElementById('pesertaTable');
    const tbody = table.querySelector('tbody');
    const searchInput = document.getElementById('searchInput');
    const filterJenis = document.getElementById('filterJenis');
    const filterProgress = document.getElementById('filterProgress');
    const resetFilter = document.getElementById('resetFilter');
    const emptyState = document.getElementById('emptyState');
    const totalCount = document.getElementById('totalCount');

    let sortDirection = {};

    // Search & Filter Function
    function filterTable() {
        const searchTerm = searchInput.value.toLowerCase();
        const jenisValue = filterJenis.value;
        const progressValue = filterProgress.value;
        
        let visibleCount = 0;
        const rows = tbody.querySelectorAll('tr');

        rows.forEach(row => {
            const nama = row.querySelector('.nama-text').textContent.toLowerCase();
            const jenis = row.dataset.jenis;
            const isComplete = row.dataset.complete === 'true';

            let showRow = true;

            if (searchTerm && !nama.includes(searchTerm)) {
                showRow = false;
            }

            if (jenisValue && jenis !== jenisValue) {
                showRow = false;
            }

            if (progressValue === 'complete' && !isComplete) {
                showRow = false;
            } else if (progressValue === 'incomplete' && isComplete) {
                showRow = false;
            }

            row.style.display = showRow ? '' : 'none';
            if (showRow) visibleCount++;
        });

        if (visibleCount === 0) {
            table.style.display = 'none';
            emptyState.classList.remove('d-none');
        } else {
            table.style.display = '';
            emptyState.classList.add('d-none');
        }

        totalCount.textContent = visibleCount;
    }

    // Sort Function
    function sortTable(column) {
        const rows = Array.from(tbody.querySelectorAll('tr'));
        const direction = sortDirection[column] === 'asc' ? 'desc' : 'asc';
        sortDirection = { [column]: direction };

        rows.sort((a, b) => {
            let aVal, bVal;

            switch(column) {
                case 'nama':
                    aVal = a.querySelector('.nama-text').textContent;
                    bVal = b.querySelector('.nama-text').textContent;
                    break;
                case 'jenis':
                    aVal = a.dataset.jenis;
                    bVal = b.dataset.jenis;
                    break;
                case 'total':
                    aVal = parseFloat(a.dataset.total);
                    bVal = parseFloat(b.dataset.total);
                    break;
                case 'skor':
                    aVal = parseFloat(a.dataset.skor);
                    bVal = parseFloat(b.dataset.skor);
                    break;
                case 'progres':
                    aVal = parseInt(a.dataset.progres);
                    bVal = parseInt(b.dataset.progres);
                    break;
            }

            if (typeof aVal === 'string') {
                return direction === 'asc' 
                    ? aVal.localeCompare(bVal) 
                    : bVal.localeCompare(aVal);
            } else {
                return direction === 'asc' 
                    ? aVal - bVal 
                    : bVal - aVal;
            }
        });

        rows.forEach(row => tbody.appendChild(row));

        document.querySelectorAll('.sortable').forEach(th => {
            th.classList.remove('active');
            const icon = th.querySelector('.sort-icon');
            icon.className = 'bi bi-arrow-down-up sort-icon';
        });

        const activeHeader = document.querySelector(`[data-sort="${column}"]`);
        activeHeader.classList.add('active');
        const activeIcon = activeHeader.querySelector('.sort-icon');
        activeIcon.className = direction === 'asc' 
            ? 'bi bi-arrow-up sort-icon' 
            : 'bi bi-arrow-down sort-icon';
    }

    // Event Listeners
    searchInput.addEventListener('input', filterTable);
    filterJenis.addEventListener('change', filterTable);
    filterProgress.addEventListener('change', filterTable);

    resetFilter.addEventListener('click', function() {
        searchInput.value = '';
        filterJenis.value = '';
        filterProgress.value = '';
        filterTable();
    });

    document.querySelectorAll('.sortable').forEach(header => {
        header.addEventListener('click', function() {
            const column = this.dataset.sort;
            sortTable(column);
        });
    });

    // Animation on load
    const elements = document.querySelectorAll('.fade-in');
    elements.forEach((element, index) => {
        element.style.opacity = '0';
        element.style.transform = 'translateY(20px)';
        setTimeout(() => {
            element.style.transition = 'all 0.6s ease';
            element.style.opacity = '1';
            element.style.transform = 'translateY(0)';
        }, index * 150);
    });

    // Animate progress bars
    setTimeout(() => {
        const progressBars = document.querySelectorAll('.progress-bar');
        progressBars.forEach(bar => {
            const width = bar.style.width;
            bar.style.width = '0%';
            setTimeout(() => {
                bar.style.width = width;
            }, 100);
        });
    }, 500);
});
</script>
@endsection