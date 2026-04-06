@extends('layouts.admin')

@section('title', 'Data Penilaian')

@section('content')
<style>
/* Data Penilaian Page Styles - LAZISMU DIY Consistent Style */
:root {
    --primary-color: #ff6b35;
    --secondary-color: #f7931e;
    --success-color: #28a745;
    --danger-color: #dc3545;
    --warning-color: #ffc107;
    --info-color: #17a2b8;
}

.penilaian-container {
    padding: 24px;
    background-color: #f8f9fa;
    min-height: 100vh;
}

/* Page Header - LAZISMU DIY Style */
.page-header {
    background: white;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    padding: 24px;
    margin-bottom: 24px;
    transition: all 0.3s ease;
    animation: slideInUp 0.5s ease-out forwards;
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

/* Action Bar - LAZISMU DIY Style */
.action-bar {
    background: white;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    padding: 20px;
    margin-bottom: 24px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 12px;
    transition: all 0.3s ease;
    animation: slideInUp 0.5s ease-out forwards;
    animation-delay: 0.1s;
}

.action-bar:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 20px rgba(255, 107, 53, 0.1);
}

.filter-section {
    display: flex;
    gap: 12px;
    align-items: center;
    flex-wrap: wrap;
}

.search-box {
    position: relative;
    max-width: 300px;
    flex: 1;
}

.search-input {
    width: 100%;
    padding: 12px 16px 12px 40px;
    border: 2px solid #e9ecef;
    border-radius: 8px;
    font-size: 0.95rem;
    transition: all 0.3s ease;
    background-color: white;
}

.search-input:focus {
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px rgba(255, 107, 53, 0.1);
    outline: none;
}

.search-icon {
    position: absolute;
    left: 14px;
    top: 50%;
    transform: translateY(-50%);
    color: #6c757d;
}

.status-filter {
    padding: 12px 16px;
    border: 2px solid #e9ecef;
    border-radius: 8px;
    background: white;
    color: #495057;
    cursor: pointer;
    transition: all 0.3s ease;
    font-size: 0.95rem;
}

.status-filter:focus {
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px rgba(255, 107, 53, 0.1);
    outline: none;
}

.btn-group {
    display: flex;
    gap: 8px;
}

/* Button Styles - LAZISMU DIY */
.btn-action {
    padding: 12px 20px;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 500;
    display: inline-flex;
    align-items: center;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
    font-size: 0.95rem;
}

.btn-action i {
    margin-right: 8px;
}

.btn-primary {
    background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
    color: white;
}

.btn-primary:hover {
    background: linear-gradient(45deg, #e55a2b, #e6841a);
    color: white;
    text-decoration: none;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(255, 107, 53, 0.3);
}

.btn-success {
    background-color: var(--success-color);
    color: white;
}

.btn-success:hover {
    background-color: #218838;
    color: white;
    text-decoration: none;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(40, 167, 69, 0.3);
}

.btn-warning {
    background-color: var(--warning-color);
    color: #212529;
}

.btn-warning:hover {
    background-color: #e0a800;
    color: #212529;
    text-decoration: none;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(255, 193, 7, 0.3);
}

.btn-info {
    background-color: var(--info-color);
    color: white;
}

.btn-info:hover {
    background-color: #138496;
    color: white;
    text-decoration: none;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(23, 162, 184, 0.3);
}

.btn-secondary {
    background-color: #6c757d;
    color: white;
}

.btn-secondary:hover {
    background-color: #5a6268;
    color: white;
    text-decoration: none;
    transform: translateY(-2px);
}

/* Alert - LAZISMU DIY Style */
.alert-success {
    background: linear-gradient(45deg, rgba(40, 167, 69, 0.1), rgba(40, 167, 69, 0.05));
    border: 1px solid rgba(40, 167, 69, 0.2);
    color: #155724;
    padding: 16px 20px;
    border-radius: 8px;
    margin-bottom: 24px;
    display: flex;
    align-items: center;
}

.alert-success i {
    margin-right: 10px;
    color: var(--success-color);
}

.alert-info {
    background: linear-gradient(45deg, rgba(255, 107, 53, 0.1), rgba(247, 147, 30, 0.1));
    border: 1px solid rgba(255, 107, 53, 0.2);
    color: #495057;
    padding: 16px;
    border-radius: 8px;
    margin-bottom: 24px;
}

.alert-info i {
    margin-right: 8px;
    color: var(--primary-color);
}

/* Stats Cards - LAZISMU DIY Style */
.stats-row {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
    margin-bottom: 24px;
    animation: slideInUp 0.5s ease-out forwards;
    animation-delay: 0.1s;
}

.stat-card {
    background: white;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    padding: 20px;
    text-align: center;
    transition: all 0.3s ease;
}

.stat-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 20px rgba(255, 107, 53, 0.1);
}

.stat-icon {
    font-size: 2.5rem;
    margin-bottom: 12px;
}

.stat-icon.primary { color: var(--primary-color); }
.stat-icon.secondary { color: var(--secondary-color); }
.stat-icon.success { color: var(--success-color); }
.stat-icon.warning { color: var(--warning-color); }

.stat-number {
    font-size: 1.8rem;
    font-weight: bold;
    color: #495057;
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

/* Table Container - LAZISMU DIY Style */
.table-container {
    background: white;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    overflow: hidden;
    margin-bottom: 24px;
    animation: slideInUp 0.5s ease-out forwards;
    animation-delay: 0.2s;
}

.table-header {
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 50%, var(--danger-color) 100%);
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

.penilaian-table {
    width: 100%;
    border-collapse: collapse;
    margin: 0;
    border: none;
}

.penilaian-table thead th {
    background-color: #f8f9fa;
    color: #495057;
    font-weight: 600;
    padding: 16px 20px;
    text-align: center;
    border: none;
    font-size: 0.9rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.penilaian-table tbody td {
    padding: 16px 20px;
    border-top: 1px solid #e9ecef;
    vertical-align: middle;
}

.penilaian-table tbody tr {
    transition: all 0.3s ease;
}

.penilaian-table tbody tr:hover {
    background-color: rgba(255, 107, 53, 0.05);
}

/* Participant Card */
.participant-card {
    display: flex;
    align-items: center;
    gap: 12px;
}

.participant-avatar {
    width: 45px;
    height: 45px;
    background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: bold;
    font-size: 1.1rem;
    flex-shrink: 0;
}

.participant-info {
    flex: 1;
}

.participant-name {
    font-weight: 600;
    color: #495057;
    margin-bottom: 2px;
}

.participant-id {
    font-size: 0.8rem;
    color: #6c757d;
}

/* Penilaian Grid */
.penilaian-grid {
    display: grid;
    gap: 12px;
    max-width: 400px;
}

.penilaian-item {
    background: #f8f9fa;
    border-radius: 8px;
    padding: 12px;
    border-left: 4px solid #dee2e6;
    transition: all 0.3s ease;
}

.penilaian-item:hover {
    border-left-color: var(--primary-color);
    background: rgba(255, 107, 53, 0.05);
}

.kriteria-label {
    font-weight: 600;
    color: #495057;
    font-size: 0.85rem;
    margin-bottom: 4px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.subkriteria-value {
    color: #212529;
    font-size: 0.9rem;
    display: flex;
    align-items: center;
    gap: 6px;
}

.score-badge {
    background: linear-gradient(45deg, var(--success-color), #20c997);
    color: white;
    padding: 2px 8px;
    border-radius: 12px;
    font-size: 0.7rem;
    font-weight: bold;
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

/* Status Badges - LAZISMU DIY Style */
.status-badge {
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 500;
    text-transform: uppercase;
}

.status-complete {
    background-color: rgba(40, 167, 69, 0.1);
    color: var(--success-color);
    border: 1px solid rgba(40, 167, 69, 0.2);
}

.status-incomplete {
    background-color: rgba(220, 53, 69, 0.1);
    color: var(--danger-color);
    border: 1px solid rgba(220, 53, 69, 0.2);
}

.status-partial {
    background-color: rgba(255, 193, 7, 0.1);
    color: var(--warning-color);
    border: 1px solid rgba(255, 193, 7, 0.2);
}

/* Action Buttons - LAZISMU DIY Style */
.action-buttons {
    display: flex;
    gap: 8px;
    align-items: center;
    justify-content: center;
    flex-wrap: wrap;
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
    display: inline-flex;
    align-items: center;
    gap: 6px;
}

.btn-edit:hover {
    background-color: #218838;
    color: white;
    text-decoration: none;
    transform: scale(1.05);
}

.btn-view {
    background-color: #6c757d;
    color: white;
    padding: 8px 16px;
    border-radius: 6px;
    text-decoration: none;
    font-size: 0.85rem;
    font-weight: 500;
    transition: all 0.3s ease;
    border: none;
    display: inline-flex;
    align-items: center;
    gap: 6px;
}

.btn-view:hover {
    background-color: #5a6268;
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

/* Empty State - LAZISMU DIY Style */
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
    line-height: 1.6;
}

/* Progress Indicator */
.progress-indicator {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-top: 8px;
}

.progress-bar {
    flex: 1;
    height: 6px;
    background: #e9ecef;
    border-radius: 3px;
    overflow: hidden;
}

.progress-fill {
    height: 100%;
    border-radius: 3px;
    transition: width 0.5s ease;
}

.progress-complete { background: var(--success-color); }
.progress-partial { background: var(--warning-color); }
.progress-incomplete { background: var(--danger-color); }

.progress-text {
    font-size: 0.8rem;
    font-weight: 500;
    min-width: 45px;
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

/* Utility Classes */
.d-flex {
    display: flex;
}

.justify-content-between {
    justify-content: space-between;
}

.align-items-center {
    align-items: center;
}

.gap-2 {
    gap: 0.5rem;
}

.text-primary { color: var(--primary-color) !important; }
.text-success { color: var(--success-color) !important; }
.text-warning { color: var(--warning-color) !important; }
.text-info { color: var(--info-color) !important; }
.text-danger { color: var(--danger-color) !important; }

.mt-3 { margin-top: 1rem; }
.mb-3 { margin-bottom: 1rem; }
.mr-2 { margin-right: 0.5rem; }
.mx-2 { margin-left: 0.5rem; margin-right: 0.5rem; }

/* Loading states */
.loading {
    opacity: 0.6;
    pointer-events: none;
}

.fade-in {
    animation: fadeIn 0.5s ease;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

/* Animation untuk card entrance - LAZISMU DIY */
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

/* Responsive Design */
@media (max-width: 768px) {
    .penilaian-container { 
        padding: 16px; 
    }
    
    .page-header { 
        padding: 16px; 
    }
    
    .page-header .d-flex {
        flex-direction: column;
        gap: 16px;
        text-align: center;
    }
    
    .action-bar { 
        flex-direction: column;
        align-items: stretch;
        padding: 16px;
    }
    
    .filter-section {
        justify-content: center;
    }
    
    .stats-row { 
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); 
    }
    
    .penilaian-table { 
        font-size: 0.85rem; 
    }
    
    .participant-card { 
        flex-direction: column; 
        text-align: center; 
    }
    
    .penilaian-grid { 
        max-width: 100%; 
    }
    
    .action-buttons { 
        flex-direction: column; 
    }
    
    .action-buttons .btn-edit,
    .action-buttons .btn-view,
    .action-buttons .btn-delete { 
        width: 100%; 
        text-align: center; 
        margin-bottom: 4px; 
    }
    
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
    .btn-action {
        width: 100%;
        justify-content: center;
        margin-bottom: 10px;
    }
    
    .penilaian-table thead { display: none; }
    .penilaian-table tbody tr {
        display: block;
        border: 1px solid #e9ecef;
        border-radius: 8px;
        margin-bottom: 16px;
        background: white;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    .penilaian-table tbody tr:hover {
        box-shadow: 0 4px 12px rgba(255, 107, 53, 0.15);
    }
    .penilaian-table tbody td {
        display: block;
        text-align: left;
        border: none;
        padding: 8px 16px;
        border-bottom: 1px solid #e9ecef;
    }
    .penilaian-table tbody td:before {
        content: attr(data-label) ": ";
        font-weight: bold;
        color: var(--primary-color);
        display: inline-block;
        width: 100px;
    }
}

/* Print styles */
@media print {
    .action-bar, .page-header .btn-group { display: none; }
    .penilaian-container { padding: 0; background: white; }
    .table-container { box-shadow: none; }
    .page-header { background: white !important; color: #212529 !important; }
}
</style>

<div class="penilaian-container">

    <!-- Page Header -->
    <div class="page-header fade-in">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="page-title">
                    <i class="fas fa-clipboard-list"></i>
                    Penilaian Beasiswa Dhuafa
                </h1>
                <p class="page-subtitle">
                    Kelola penilaian kriteria peserta kategori Dhuafa
                </p>
            </div>
        </div>
    </div>

    <!-- Alert -->
    @if(session('success'))
        <div class="alert-success fade-in">
            <i class="fas fa-check-circle"></i>
            {{ session('success') }}
        </div>
    @endif

    <!-- Action Bar -->
    <div class="action-bar fade-in">
        <div class="filter-section">
            <div class="search-box">
                <i class="fas fa-search search-icon"></i>
                <input type="text" id="searchInput" class="search-input" placeholder="Cari peserta...">
            </div>
            <select id="statusFilter" class="status-filter">
                <option value="all">Semua Status</option>
                <option value="complete">Lengkap</option>
                <option value="partial">Sebagian</option>
                <option value="incomplete">Belum Dinilai</option>
            </select>
        </div>
        <div class="btn-group">
            <button onclick="exportData()" class="btn-action btn-success">
                <i class="fas fa-file-excel"></i> Export
            </button>
            <button onclick="printTable()" class="btn-action btn-info">
                <i class="fas fa-print"></i> Print
            </button>
        </div>
    </div>

    <!-- Statistik -->
    <div class="stats-row fade-in">
        <div class="stat-card">
            <div class="stat-icon primary">
                <i class="fas fa-users"></i>
            </div>
            <div class="stat-number primary">{{ count($alternatifs) }}</div>
            <div class="stat-label">Total Peserta</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon secondary">
                <i class="fas fa-clipboard-check"></i>
            </div>
            <div class="stat-number secondary">{{ count($kriterias) }}</div>
            <div class="stat-label">Total Kriteria</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon success">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="stat-number success" id="penilaian-lengkap">0</div>
            <div class="stat-label">Penilaian Lengkap</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon warning">
                <i class="fas fa-hourglass-half"></i>
            </div>
            <div class="stat-number" style="color: var(--warning-color);" id="penilaian-sebagian">0</div>
            <div class="stat-label">Penilaian Sebagian</div>
        </div>
    </div>

    <!-- Table -->
    <div class="table-container fade-in">
        <div class="table-header">
            <h3 class="table-title">
                <i class="fas fa-list-alt"></i>
                Daftar Penilaian Peserta
            </h3>
        </div>
        <div class="table-responsive">
            <table class="penilaian-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Peserta</th>
                        <th>Penilaian Kriteria</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                @forelse($alternatifs as $index => $alternatif)
                    @php
                        $totalKriteria = count($kriterias);
                        $lengkap = 0;

                        foreach($kriterias as $kriteria) {
                            if(isset($penilaian[$alternatif->id][$kriteria->id])) {
                                $lengkap++;
                            }
                        }

                        $persen = $totalKriteria > 0 ? ($lengkap / $totalKriteria) * 100 : 0;
                        
                        if($persen == 100) {
                            $status = 'Lengkap';
                            $statusClass = 'complete';
                            $progressClass = 'progress-complete';
                        } elseif($persen > 0) {
                            $status = 'Sebagian';
                            $statusClass = 'partial';
                            $progressClass = 'progress-partial';
                        } else {
                            $status = 'Belum Dinilai';
                            $statusClass = 'incomplete';
                            $progressClass = 'progress-incomplete';
                        }
                        
                        $searchData = strtolower($alternatif->nama . ' ' . ($alternatif->nisn ?? ''));
                    @endphp

                    <tr class="penilaian-row" data-status="{{ $statusClass }}" data-search="{{ $searchData }}">
                        <td data-label="No">
                            <span class="stat-number-indicator">{{ $index + 1 }}</span>
                        </td>

                        <td data-label="Peserta">
                            <div class="participant-card">
                                <div class="participant-avatar">
                                    {{ strtoupper(substr($alternatif->nama, 0, 1)) }}
                                </div>
                                <div class="participant-info">
                                    <div class="participant-name">{{ $alternatif->nama }}</div>
                                    <!-- <div class="participant-id">ID: {{ $alternatif->nisn ?? '-' }}</div> -->
                                </div>
                            </div>
                        </td>

                        <td data-label="Penilaian Kriteria">
                            <div class="penilaian-grid">
                                @foreach($kriterias as $kriteria)
                                    <div class="penilaian-item">
                                        <div class="kriteria-label">{{ $kriteria->nama_kriteria }}</div>
                                        <div class="subkriteria-value">
                                            @if(isset($penilaian[$alternatif->id][$kriteria->id]))
                                                {{ $penilaian[$alternatif->id][$kriteria->id]->subKriteria->nama_subkriteria }}
                                                <span class="score-badge">{{ $penilaian[$alternatif->id][$kriteria->id]->nilai }}</span>
                                            @else
                                                <span style="color: #999; font-style: italic;">Belum dinilai</span>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </td>

                        <td data-label="Status">
                            <span class="status-badge status-{{ $statusClass }}">
                                {{ $status }}
                            </span>
                            <div class="progress-indicator">
                                <div class="progress-bar">
                                    <div class="progress-fill {{ $progressClass }}" style="width: {{ $persen }}%;"></div>
                                </div>
                                <span class="progress-text">{{ number_format($persen, 0) }}%</span>
                            </div>
                        </td>

                        <td data-label="Aksi">
                            <div class="action-buttons">
                                <a href="{{ route('admin.penilaian.edit', $alternatif->id) }}" class="btn-edit">
                                    <i class="fas fa-edit"></i> Penilaian
                                </a>
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
                                <div class="empty-title">Belum Ada Data Penilaian</div>
                                <div class="empty-text">
                                    Belum ada data penilaian untuk kategori Dhuafa.<br>
                                    Silakan tambahkan penilaian terlebih dahulu.
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforelse
                </tbody>

            </table>
        </div>
        
        <!-- Empty State for Filter Results -->
        <div id="empty-state" class="empty-state" style="display: none;">
            <div class="empty-icon">
                <i class="fas fa-search"></i>
            </div>
            <div class="empty-title">Tidak Ada Hasil</div>
            <div class="empty-text">
                Tidak ada data yang cocok dengan filter yang Anda pilih.
            </div>
        </div>
    </div>

</div>

<!-- JavaScript -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const statusFilter = document.getElementById('statusFilter');
    const tableRows = document.querySelectorAll('.penilaian-row');
    
    // Initialize stats
    updateStats();
    
    // Search functionality
    if(searchInput) {
        searchInput.addEventListener('keyup', function() {
            applyFilters();
        });
    }
    
    // Status filter functionality
    if(statusFilter) {
        statusFilter.addEventListener('change', function() {
            applyFilters();
        });
    }
    
    function applyFilters() {
        const searchTerm = searchInput ? searchInput.value.toLowerCase() : '';
        const statusValue = statusFilter ? statusFilter.value : 'all';
        let visibleCount = 0;
        
        tableRows.forEach((row, index) => {
            const searchData = row.dataset.search || '';
            const statusData = row.dataset.status || '';
            
            let showRow = true;
            
            // Apply search filter
            if (searchTerm && !searchData.includes(searchTerm)) {
                showRow = false;
            }
            
            // Apply status filter
            if (statusValue !== 'all' && statusData !== statusValue) {
                showRow = false;
            }
            
            if (showRow) {
                row.style.display = '';
                visibleCount++;
                // Update row number
                const numberCell = row.querySelector('.stat-number-indicator');
                if (numberCell) numberCell.textContent = visibleCount;
            } else {
                row.style.display = 'none';
            }
        });
        
        // Show/hide empty state
        const emptyState = document.getElementById('empty-state');
        if (emptyState) {
            emptyState.style.display = visibleCount === 0 && tableRows.length > 0 ? '' : 'none';
        }
    }
    
    function updateStats() {
        const completeCount = document.querySelectorAll('[data-status="complete"]').length;
        const partialCount = document.querySelectorAll('[data-status="partial"]').length;
        
        const lengkapElement = document.getElementById('penilaian-lengkap');
        const sebagianElement = document.getElementById('penilaian-sebagian');
        
        if(lengkapElement) lengkapElement.textContent = completeCount;
        if(sebagianElement) sebagianElement.textContent = partialCount;
    }
    
    // Animation on load
    const elements = document.querySelectorAll('.fade-in');
    elements.forEach((element, index) => {
        if(element) {
            element.style.opacity = '0';
            element.style.transform = 'translateY(20px)';
            setTimeout(() => {
                element.style.transition = 'all 0.6s ease';
                element.style.opacity = '1';
                element.style.transform = 'translateY(0)';
            }, index * 150);
        }
    });
    
    // Animate progress bars
    setTimeout(() => {
        const progressFills = document.querySelectorAll('.progress-fill');
        progressFills.forEach(fill => {
            if(fill) {
                const width = fill.style.width;
                fill.style.width = '0%';
                setTimeout(() => {
                    fill.style.width = width;
                }, 100);
            }
        });
    }, 1000);
});

// Export functionality
function exportData() {
    const data = [];
    const rows = document.querySelectorAll('.penilaian-row[style=""], .penilaian-row:not([style])');
    
    rows.forEach((row, index) => {
        const namaElement = row.querySelector('.participant-name');
        const idElement = row.querySelector('.participant-id');
        const statusElement = row.querySelector('.status-badge');
        const progressElement = row.querySelector('.progress-text');
        
        if(namaElement && idElement && statusElement && progressElement) {
            const nama = namaElement.textContent || '';
            const nisn = idElement.textContent.replace(/.*ID:\s*/, '') || '';
            const status = statusElement.textContent.trim() || '';
            const progress = progressElement.textContent || '';
            
            data.push({
                no: index + 1,
                nama: nama,
                nisn: nisn,
                status: status,
                progress: progress
            });
        }
    });
    
    if (data.length === 0) {
        alert('Tidak ada data untuk diekspor');
        return;
    }

    let csvContent = "data:text/csv;charset=utf-8,";
    csvContent += "No,Nama,NISN/NIM,Status,Progress\n";
    
    data.forEach(item => {
        csvContent += `${item.no},"${item.nama}","${item.nisn}","${item.status}","${item.progress}"\n`;
    });
    
    const encodedUri = encodeURI(csvContent);
    const link = document.createElement("a");
    link.setAttribute("href", encodedUri);
    link.setAttribute("download", `data_penilaian_${new Date().toISOString().slice(0,10)}.csv`);
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
}

// Print functionality
function printTable() {
    const printContent = document.querySelector('.table-container');
    if(!printContent) {
        alert('Tidak ada data untuk dicetak');
        return;
    }
    
    const clonedContent = printContent.cloneNode(true);
    const printWindow = window.open('', '_blank');
    
    if(!printWindow) {
        alert('Popup diblokir. Mohon izinkan popup untuk mencetak.');
        return;
    }
    
    printWindow.document.write(`
        <html>
        <head>
            <title>Data Penilaian</title>
            <style>
                body { 
                    font-family: Arial, sans-serif; 
                    margin: 20px;
                }
                .table-header {
                    background: linear-gradient(135deg, #ff6b35 0%, #f7931e 50%, #dc3545 100%) !important;
                    color: white !important;
                    -webkit-print-color-adjust: exact;
                    padding: 15px;
                    margin-bottom: 20px;
                }
                table { 
                    width: 100%; 
                    border-collapse: collapse; 
                    margin-top: 20px;
                }
                th, td { 
                    border: 1px solid #ddd; 
                    padding: 8px; 
                    text-align: left; 
                }
                th { 
                    background-color: #f2f2f2; 
                    font-weight: bold;
                }
                .participant-card {
                    display: flex;
                    align-items: center;
                    gap: 10px;
                }
                .participant-avatar {
                    width: 30px;
                    height: 30px;
                    background: linear-gradient(45deg, #ff6b35, #f7931e);
                    border-radius: 50%;
                    color: white;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    font-weight: bold;
                }
                .penilaian-grid {
                    display: block;
                }
                .penilaian-item {
                    margin-bottom: 8px;
                    padding: 5px;
                    background: #f8f9fa;
                    border-left: 3px solid #ff6b35;
                }
                .kriteria-label {
                    font-weight: bold;
                    font-size: 0.8rem;
                    color: #495057;
                }
                .subkriteria-value {
                    font-size: 0.9rem;
                }
                .status-badge {
                    padding: 4px 8px;
                    border-radius: 12px;
                    font-size: 0.8rem;
                    font-weight: 500;
                }
                .status-complete { background: #d4edda; color: #155724; }
                .status-partial { background: #fff3cd; color: #856404; }
                .status-incomplete { background: #f8d7da; color: #721c24; }
                .action-buttons { display: none; }
                .progress-indicator { margin-top: 5px; }
                .progress-bar {
                    width: 100px;
                    height: 6px;
                    background: #e9ecef;
                    border-radius: 3px;
                    display: inline-block;
                    margin-right: 5px;
                }
                .progress-fill {
                    height: 100%;
                    border-radius: 3px;
                }
                .progress-complete { background: #28a745; }
                .progress-partial { background: #ffc107; }
                .progress-incomplete { background: #dc3545; }
                .score-badge {
                    background: linear-gradient(45deg, #28a745, #20c997);
                    color: white;
                    padding: 2px 6px;
                    border-radius: 10px;
                    font-size: 0.7rem;
                    font-weight: bold;
                }
            </style>
        </head>
        <body>
            <h2>Data Penilaian Beasiswa Dhuafa</h2>
            <p><strong>Dicetak pada:</strong> ${new Date().toLocaleString('id-ID')}</p>
            <p><strong>Total Data:</strong> ${document.querySelectorAll('.penilaian-row').length} peserta</p>
            ${clonedContent.innerHTML}
        </body>
        </html>
    `);
    
    printWindow.document.close();
    printWindow.print();
}

// Keyboard shortcuts
document.addEventListener('keydown', function(e) {
    // Ctrl/Cmd + F untuk focus search
    if ((e.ctrlKey || e.metaKey) && e.key === 'f') {
        e.preventDefault();
        const searchInput = document.getElementById('searchInput');
        if(searchInput) searchInput.focus();
    }
    
    // Ctrl + P untuk print
    if (e.ctrlKey && e.key === 'p') {
        e.preventDefault();
        printTable();
    }
    
    // Ctrl + E untuk export
    if (e.ctrlKey && e.key === 'e') {
        e.preventDefault();
        exportData();
    }
});

// Tooltip functionality
document.addEventListener('DOMContentLoaded', function() {
    const statusBadges = document.querySelectorAll('.status-badge');
    statusBadges.forEach(badge => {
        if(badge) {
            badge.addEventListener('mouseenter', function() {
                const status = this.textContent.trim();
                let tooltip = '';
                
                switch(status) {
                    case 'Lengkap':
                        tooltip = 'Semua kriteria sudah dinilai';
                        break;
                    case 'Sebagian':
                        tooltip = 'Beberapa kriteria belum dinilai';
                        break;
                    case 'Belum Dinilai':
                        tooltip = 'Belum ada kriteria yang dinilai';
                        break;
                }
                
                this.title = tooltip;
            });
        }
    });
});

// Performance monitoring
console.log('📊 Data Penilaian page loaded successfully!');
console.log('💡 Tips: Use Ctrl+F to search, Ctrl+P to print, Ctrl+E to export');
console.log(`📈 Loaded ${document.querySelectorAll('.penilaian-row').length} records`);
</script>

@endsection