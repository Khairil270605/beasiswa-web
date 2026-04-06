@extends('layouts.admin')

@section('title', 'Hasil Perhitungan SAW - Beasiswa Dhuafa')

@section('content')
<style>
/* SAW Results Page Styles - LAZISMU DIY Consistent Style */
:root {
    --primary-color: #ff6b35;      /* Orange LAZISMU */
    --secondary-color: #f7931e;    /* Kuning-orange */
    --success-color: #28a745;      /* Hijau */
    --danger-color: #dc3545;       /* Merah */
    --warning-color: #ffc107;      /* Kuning */
    --info-color: #17a2b8;         /* Biru info */
    --dhuafa-accent: #2ecc71;      /* Accent khusus Dhuafa */
}

.saw-container {
    padding: 24px;
    background-color: #f8f9fa;
    min-height: 100vh;
}

/* Page Header - LAZISMU DIY Style */
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

.badge-category {
    display: inline-block;
    background: rgba(255, 255, 255, 0.2);
    padding: 6px 16px;
    border-radius: 20px;
    font-size: 0.9rem;
    font-weight: 600;
    margin-top: 10px;
    border: 2px solid rgba(255, 255, 255, 0.3);
}

/* Action Buttons - LAZISMU DIY Style */
.action-buttons {
    display: flex;
    gap: 12px;
    margin-bottom: 24px;
    flex-wrap: wrap;
    animation: slideInUp 0.5s ease-out forwards;
    animation-delay: 0.1s;
}

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
    font-size: 0.9rem;
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
    transition: all 0.3s ease;
}

.btn-info:hover {
    background-color: #138496;
    color: white;
    text-decoration: none;
    transform: translateY(-2px);
}

.btn-export {
    background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
    color: white;
}

.btn-export:hover {
    background: linear-gradient(45deg, #e55a2b, #e6841a);
    color: white;
    text-decoration: none;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(255, 107, 53, 0.3);
}

.btn-print {
    background-color: var(--secondary-color);
    color: white;
}

.btn-print:hover {
    background-color: #e6841a;
    color: white;
    text-decoration: none;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(247, 147, 30, 0.3);
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

/* Stats Cards - LAZISMU DIY Style */
.stats-cards {
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
    position: relative;
    overflow: hidden;
}

.stat-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 4px;
    background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
}

.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 6px 20px rgba(255, 107, 53, 0.15);
}

.stat-icon {
    font-size: 2.5rem;
    margin-bottom: 12px;
}

.stat-icon.blue { color: var(--primary-color); }
.stat-icon.gold { color: var(--secondary-color); }
.stat-icon.green { color: var(--dhuafa-accent); }
.stat-icon.orange { color: var(--secondary-color); }

.stat-number {
    font-size: 1.8rem;
    font-weight: bold;
    color: #495057;
    margin-bottom: 4px;
}

.stat-label {
    font-size: 0.9rem;
    color: #6c757d;
    font-weight: 500;
}

/* Results Container - LAZISMU DIY Style */
.results-container {
    background: white;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    overflow: hidden;
    animation: slideInUp 0.5s ease-out forwards;
    animation-delay: 0.2s;
}

.results-header {
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
    color: white;
    padding: 16px 20px;
}

.results-title {
    font-size: 1.2rem;
    font-weight: 600;
    margin: 0;
    display: flex;
    align-items: center;
}

.results-title i {
    margin-right: 10px;
}

.table-responsive {
    overflow-x: auto;
}

.results-table {
    width: 100%;
    border-collapse: collapse;
    margin: 0;
    border: none;
}

.results-table thead th {
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

.results-table tbody td {
    padding: 16px 12px;
    text-align: center;
    border-top: 1px solid #e9ecef;
    vertical-align: middle;
}

.results-table tbody tr {
    transition: all 0.3s ease;
}

.results-table tbody tr:hover {
    background-color: rgba(255, 107, 53, 0.05);
}

/* Rank Badges - LAZISMU DIY Style */
.rank-badge {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    font-weight: bold;
    font-size: 1rem;
    color: white;
}

.rank-1 { 
    background: linear-gradient(135deg, #ffd700 0%, #ffed4e 100%); 
    color: #8b4513;
    box-shadow: 0 4px 10px rgba(255, 215, 0, 0.4);
}
.rank-2 { 
    background: linear-gradient(135deg, #c0c0c0 0%, #e0e0e0 100%); 
    color: #495057;
    box-shadow: 0 4px 10px rgba(192, 192, 192, 0.4);
}
.rank-3 { 
    background: linear-gradient(135deg, #cd7f32 0%, #daa520 100%); 
    color: white;
    box-shadow: 0 4px 10px rgba(205, 127, 50, 0.4);
}
.rank-other { 
    background: linear-gradient(135deg, #6c757d 0%, #868e96 100%); 
}

/* Score Bars - LAZISMU DIY Style */
.score-bar {
    background: #e9ecef;
    height: 8px;
    border-radius: 4px;
    overflow: hidden;
    margin-top: 4px;
}

.score-fill {
    height: 100%;
    border-radius: 4px;
    transition: width 0.8s ease;
}

.score-high { background: linear-gradient(90deg, var(--dhuafa-accent) 0%, #20c997 100%); }
.score-medium { background: linear-gradient(90deg, var(--warning-color) 0%, var(--secondary-color) 100%); }
.score-low { background: linear-gradient(90deg, var(--danger-color) 0%, #e74c3c 100%); }

.participant-info {
    text-align: left;
}

.participant-name {
    font-weight: 600;
    color: #495057;
    margin-bottom: 4px;
}

.participant-details {
    font-size: 0.8rem;
    color: #6c757d;
}

.score-value {
    font-weight: bold;
    font-size: 1.1rem;
    color: var(--primary-color);
}

/* Medal Icons - LAZISMU DIY Style */
.medal-icon {
    font-size: 1.5rem;
    margin-left: 8px;
}

.medal-gold { color: #ffd700; }
.medal-silver { color: #c0c0c0; }
.medal-bronze { color: #cd7f32; }

/* Calculation Info - LAZISMU DIY Style */
.calculation-info {
    background: linear-gradient(45deg, rgba(46, 204, 113, 0.1), rgba(46, 204, 113, 0.05));
    border: 1px solid rgba(46, 204, 113, 0.2);
    border-radius: 8px;
    padding: 20px;
    margin-bottom: 24px;
}

.calculation-info h4 {
    color: var(--dhuafa-accent);
    margin-bottom: 12px;
    font-weight: 600;
}

.calculation-info p {
    color: #495057;
    margin-bottom: 8px;
    line-height: 1.6;
}

.calculation-info i {
    margin-right: 8px;
    color: var(--dhuafa-accent);
}

/* Detail Section - LAZISMU DIY Style */
.detail-section {
    margin-bottom: 25px;
}

.detail-section h6 {
    color: #495057;
    font-weight: 600;
    border-bottom: 2px solid var(--primary-color);
    padding-bottom: 8px;
    margin-bottom: 15px;
}

.detail-table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 15px;
}

.detail-table th,
.detail-table td {
    padding: 8px 12px;
    text-align: center;
    border: 1px solid #dee2e6;
}

.detail-table th {
    background-color: #f8f9fa;
    font-weight: 600;
    color: #495057;
}

.detail-table tbody tr:nth-child(even) {
    background-color: rgba(46, 204, 113, 0.05);
}

.nilai-asli { color: var(--danger-color); }
.nilai-normalisasi { color: var(--primary-color); }
.nilai-bobot { color: var(--dhuafa-accent); }
.nilai-akhir { 
    color: var(--primary-color); 
    font-weight: bold; 
    font-size: 1.1em;
}

.calculation-step {
    background: #f8f9fa;
    border-left: 4px solid var(--dhuafa-accent);
    padding: 15px;
    margin: 10px 0;
    border-radius: 0 8px 8px 0;
}

.step-title {
    font-weight: 600;
    color: #495057;
    margin-bottom: 10px;
}

.step-formula {
    background: #e9ecef;
    padding: 8px 12px;
    border-radius: 4px;
    font-family: 'Courier New', monospace;
    margin: 8px 0;
}

/* Export Options */
.export-options {
    display: flex;
    gap: 8px;
    flex-wrap: wrap;
}

/* Empty State - LAZISMU DIY Style */
.empty-state {
    text-align: center;
    padding: 60px 20px;
    color: #6c757d;
}

.empty-icon {
    font-size: 4rem;
    color: rgba(46, 204, 113, 0.3);
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

/* Modal */
.modal-lg {
    max-width: 900px;
}

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
    .saw-container { 
        padding: 16px; 
    }
    
    .page-header { 
        padding: 20px; 
    }
    
    .page-title { 
        font-size: 1.5rem; 
    }
    
    .action-buttons { 
        justify-content: center; 
    }
    
    .stats-cards { 
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); 
    }
    
    .stat-card { 
        padding: 16px; 
    }
    
    .results-table { 
        font-size: 0.8rem; 
    }
    
    .participant-info { 
        text-align: center; 
    }
    
    .rank-badge { 
        width: 35px; 
        height: 35px; 
        font-size: 0.9rem; 
    }
    
    .modal-lg {
        max-width: 95%;
        margin: 10px auto;
    }
    
    .detail-table {
        font-size: 0.8rem;
    }
    
    .detail-table th,
    .detail-table td {
        padding: 6px 8px;
    }
}

@media (max-width: 576px) {
    .btn-action {
        width: 100%;
        justify-content: center;
        margin-bottom: 10px;
    }
    
    .export-options {
        width: 100%;
    }
    
    .export-options .btn-action {
        flex: 1;
    }
    
    .results-table thead { display: none; }
    .results-table tbody tr {
        display: block;
        border: 1px solid #e9ecef;
        border-radius: 8px;
        margin-bottom: 16px;
        background: white;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        padding: 16px;
    }
    .results-table tbody tr:hover {
        box-shadow: 0 4px 12px rgba(46, 204, 113, 0.15);
    }
    .results-table tbody td {
        display: block;
        text-align: left;
        border: none;
        padding: 8px 0;
    }
    .results-table tbody td:before {
        content: attr(data-label) ": ";
        font-weight: bold;
        color: var(--dhuafa-accent);
        display: inline-block;
        width: 100px;
    }
}

/* Print styles */
@media print {
    .action-buttons, .calculation-info { display: none; }
    .saw-container { padding: 0; background: white; }
    .results-container { box-shadow: none; }
    .page-header { 
        background: white !important; 
        color: #212529 !important; 
        border: 2px solid var(--primary-color);
    }
    .page-title, .page-subtitle { color: #212529 !important; }
}
</style>

<div class="saw-container">
    <!-- Page Header -->
    <div class="page-header fade-in">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="page-title">
                    <i class="fas fa-hand-holding-heart"></i>
                    Hasil Perhitungan SAW - Beasiswa Dhuafa
                </h1>
                <p class="page-subtitle">
                    Perangkingan calon penerima beasiswa dhuafa berdasarkan metode Simple Additive Weighting
                </p>
                <span class="badge-category">
                    <i class="fas fa-tags mr-1"></i>
                    KATEGORI: DHUAFA
                </span>
            </div>
            <div class="col-md-4 text-md-right">
                <div class="export-options">
                    <button class="btn-action btn-print" onclick="printResults()">
                        <i class="fas fa-print"></i>
                        Cetak
                    </button>
                    <button class="btn-action btn-export" onclick="exportResults()">
                        <i class="fas fa-file-excel"></i>
                        Export
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Success Alert -->
    @if(session('success'))
    <div class="alert-success fade-in">
        <i class="fas fa-check-circle"></i>
        {{ session('success') }}
    </div>
    @endif

    <!-- Action Buttons -->
    <div class="action-buttons fade-in">
        <a href="{{ route('admin.dhuafa') }}" class="btn-action btn-primary">
            <i class="fas fa-calculator"></i>
            Hitung Ulang
        </a>
        <a href="{{ route('admin.alternatif.index') }}" class="btn-action btn-success">
            <i class="fas fa-users"></i>
            Data Pendaftar Dhuafa
        </a>
        <a href="{{ route('admin.kriteria.dhuafa') }}" class="btn-action btn-warning">
            <i class="fas fa-cogs"></i>
            Kelola Kriteria Dhuafa
        </a>
        <a href="{{ route('admin.kader') }}" class="btn-action btn-info">
            <i class="fas fa-exchange-alt"></i>
            Lihat Hasil Kader
        </a>
    </div>

    <!-- Statistics Cards -->
    @php
        $totalPeserta = count($hasil);
        $nilaiTertinggi = $totalPeserta > 0 ? $hasil[0]['nilai_akhir'] : 0;
        $rataRata = $totalPeserta > 0 ? collect($hasil)->avg('nilai_akhir') : 0;
    @endphp
    <div class="stats-cards fade-in">
        <div class="stat-card">
            <div class="stat-icon blue">
                <i class="fas fa-users"></i>
            </div>
            <div class="stat-number">{{ $totalPeserta }}</div>
            <div class="stat-label">Total Peserta Dhuafa</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon gold">
                <i class="fas fa-medal"></i>
            </div>
            <div class="stat-number">{{ $totalPeserta > 0 ? '1' : '0' }}</div>
            <div class="stat-label">Peringkat Tertinggi</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon green">
                <i class="fas fa-star"></i>
            </div>
            <div class="stat-number">{{ number_format($nilaiTertinggi, 4) }}</div>
            <div class="stat-label">Nilai Tertinggi</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon orange">
                <i class="fas fa-chart-line"></i>
            </div>
            <div class="stat-number">{{ number_format($rataRata, 4) }}</div>
            <div class="stat-label">Rata-rata Nilai</div>
        </div>
    </div>

    <!-- Calculation Info -->
    <div class="calculation-info fade-in">
        <h4><i class="fas fa-info-circle"></i>Informasi Perhitungan Beasiswa Dhuafa</h4>
        <p><strong>Metode:</strong> Simple Additive Weighting (SAW)</p>
        <p><strong>Kategori:</strong> Beasiswa Dhuafa - untuk mahasiswa dari keluarga kurang mampu</p>
        <p><strong>Prinsip:</strong> Menormalisasi nilai kriteria dan mengalikan dengan bobot untuk mendapatkan skor akhir</p>
        <p><strong>Tanggal Perhitungan:</strong> {{ now()->format('d F Y, H:i') }} WIB</p>
    </div>

    <!-- Results Table -->
    <div class="results-container fade-in">
        <div class="results-header">
            <h3 class="results-title">
                <i class="fas fa-trophy"></i>
                Peringkat Penerima Beasiswa Dhuafa
            </h3>
        </div>
        
        <div class="table-responsive">
            <table class="results-table">
                <thead>
                    <tr>
                        <th>Peringkat</th>
                        <th>Peserta</th>
                        <th>Nilai SAW</th>
                        <th>Status Beasiswa</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
    @forelse($hasil as $item)
    @php
    $statusBeasiswa = $item['alternatif']['status_beasiswa'] ?? 'menunggu';
@endphp


    <tr class="result-row"
        data-rank="{{ $item['ranking'] }}"
        style="
            @if($statusBeasiswa === 'diterima') background: rgba(40,167,69,.06);
            @elseif($statusBeasiswa === 'tidak_diterima') background: rgba(220,53,69,.06);
            @endif
        "
    >
        {{-- PERINGKAT --}}
        <td data-label="Peringkat">
            <div class="rank-badge rank-{{ $item['ranking'] <= 3 ? $item['ranking'] : 'other' }}">
                {{ $item['ranking'] }}
            </div>

            @if($item['ranking'] === 1)
                <i class="fas fa-trophy medal-icon medal-gold"></i>
            @elseif($item['ranking'] === 2)
                <i class="fas fa-medal medal-icon medal-silver"></i>
            @elseif($item['ranking'] === 3)
                <i class="fas fa-award medal-icon medal-bronze"></i>
            @endif
        </td>

        {{-- PESERTA --}}
        <td data-label="Peserta">
            <div class="participant-info">
                <div class="participant-name">{{ $item['alternatif']['nama'] }}</div>
                <div class="participant-details">
                    <i class="fas fa-id-card"></i>
                    NIM: {{ $item['alternatif']['nim'] ?? 'N/A' }}
                    @if(isset($item['alternatif']['jurusan']))
                        <br><i class="fas fa-graduation-cap"></i>{{ $item['alternatif']['jurusan'] }}
                    @endif
                </div>
            </div>
        </td>

        {{-- NILAI SAW --}}
        <td data-label="Nilai SAW">
            <div class="score-value">{{ number_format($item['nilai_akhir'], 4) }}</div>
        </td>

        {{-- VISUALISASI --}}

        {{-- STATUS BEASISWA --}}
        <td data-label="Status Beasiswa">
            <form method="POST" action="{{ route('admin.hasil.statusBeasiswa', $item['alternatif']['id']) }}">
                @csrf
                <select name="status_beasiswa"
                        class="form-select form-select-sm"
                        onchange="this.form.submit()">
                    <option value="menunggu" {{ $statusBeasiswa === 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                    <option value="diterima" {{ $statusBeasiswa === 'diterima' ? 'selected' : '' }}>✅ Diterima</option>
                    <option value="tidak_diterima" {{ $statusBeasiswa === 'tidak_diterima' ? 'selected' : '' }}>❌ Tidak Diterima</option>
                </select>

                <input type="hidden" name="catatan_beasiswa" value="{{ $item['alternatif']['catatan_beasiswa'] ?? '' }}">
            </form>

            <small class="text-muted d-block mt-1">
                {{ $item['alternatif']['tanggal_keputusan_beasiswa'] ?? '' }}
            </small>
        </td>

        {{-- AKSI --}}
        <td data-label="Aksi">
            <div class="d-flex gap-2 flex-wrap">
                <button class="btn btn-info btn-sm"
                        onclick="showDetail({{ $item['alternatif']['id'] }}, '{{ $item['alternatif']['nama'] }}')"
                        title="Lihat Detail Perhitungan">
                    <i class="fas fa-eye"></i> Detail
                </button>

                {{-- Catatan (pakai Bootstrap 4 modal karena detailModal kamu Bootstrap 4) --}}
                <button type="button"
                        class="btn btn-secondary btn-sm"
                        data-toggle="modal"
                        data-target="#catatanModal-{{ $item['alternatif']['id'] }}">
                    <i class="fas fa-sticky-note"></i> Catatan
                </button>
            </div>

            {{-- Modal Catatan (Bootstrap 4) --}}
            <div class="modal fade" id="catatanModal-{{ $item['alternatif']['id'] }}" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <form class="modal-content" method="POST"
                          action="{{ route('admin.hasil.statusBeasiswa', $item['alternatif']['id']) }}">
                        @csrf

                        <div class="modal-header">
                            <h5 class="modal-title">Keputusan Beasiswa - {{ $item['alternatif']['nama'] }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Status Beasiswa</label>
                                <select name="status_beasiswa" class="form-control">
                                    <option value="menunggu" {{ $statusBeasiswa === 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                                    <option value="diterima" {{ $statusBeasiswa === 'diterima' ? 'selected' : '' }}>Diterima</option>
                                    <option value="tidak_diterima" {{ $statusBeasiswa === 'tidak_diterima' ? 'selected' : '' }}>Tidak Diterima</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Catatan Admin</label>
                                <textarea name="catatan_beasiswa" class="form-control" rows="4"
                                          placeholder="Masukkan catatan keputusan...">{{ $item['alternatif']['catatan_beasiswa'] ?? '' }}</textarea>
                            </div>

                            <div class="small text-muted">
                                Tanggal keputusan: {{ $item['alternatif']['tanggal_keputusan_beasiswa'] ?? '-' }}
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </td>
    </tr>
@empty
                    <tr>
                        <td colspan="5">
                            <div class="empty-state">
                                <div class="empty-icon">
                                    <i class="fas fa-hand-holding-heart"></i>
                                </div>
                                <div class="empty-title">Belum Ada Hasil Perhitungan Beasiswa Dhuafa</div>
                                <div class="empty-text">
                                    Silakan lakukan perhitungan SAW terlebih dahulu untuk melihat hasil peringkat.<br>
                                    Pastikan data alternatif dan kriteria dhuafa sudah lengkap.
                                </div>
                                <a href="{{ route('admin.dhuafa') }}" class="btn-action btn-primary">
                                    <i class="fas fa-calculator"></i>
                                    Mulai Perhitungan Dhuafa
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Detail Perhitungan -->
<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background: linear-gradient(135deg, #2ecc71 0%, #27ae60 100%); color: white;">
                <h5 class="modal-title" id="detailModalLabel">
                    <i class="fas fa-calculator mr-2"></i>
                    Detail Perhitungan SAW - Dhuafa
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="detailContent">
                    <div class="text-center">
                        <div class="spinner-border text-success" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <p class="mt-2">Memuat data perhitungan...</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="fas fa-times mr-1"></i>
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript -->
<script>
document.addEventListener('DOMContentLoaded', function() {
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

    // Animate score bars
    setTimeout(() => {
        const scoreFills = document.querySelectorAll('.score-fill');
        scoreFills.forEach(fill => {
            const width = fill.style.width;
            fill.style.width = '0%';
            setTimeout(() => {
                fill.style.width = width;
            }, 100);
        });
    }, 1000);

    // Highlight top 3
    const rows = document.querySelectorAll('.result-row');
    rows.forEach((row, index) => {
        const rank = parseInt(row.getAttribute('data-rank'));
        if (rank <= 3) {
            setTimeout(() => {
                row.style.background = 'linear-gradient(90deg, rgba(46, 204, 113, 0.1) 0%, #ffffff 100%)';
                row.style.borderLeft = '4px solid #2ecc71';
            }, rank * 300);
        }
    });
});

// Print functionality
function printResults() {
    window.print();
}

// Export functionality (to CSV)
function exportResults() {
    const results = @json($hasil);
    
    if (results.length === 0) {
        alert('Tidak ada data untuk diekspor');
        return;
    }

    let csvContent = "data:text/csv;charset=utf-8,";
    csvContent += "Peringkat,Nama,NIM,Nilai SAW\n";
    
    results.forEach((item) => {
        const nim = item.alternatif.nim || 'N/A';
        csvContent += `${item.ranking},"${item.alternatif.nama}","${nim}",${item.nilai_akhir}\n`;
    });
    
    const encodedUri = encodeURI(csvContent);
    const link = document.createElement("a");
    link.setAttribute("href", encodedUri);
    link.setAttribute("download", `hasil_saw_dhuafa_${new Date().toISOString().slice(0,10)}.csv`);
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
}

// Show detail calculation modal
function showDetail(alternatifId, namaAlternatif) {
    // Update modal title
    document.getElementById('detailModalLabel').innerHTML = `
        <i class="fas fa-calculator mr-2"></i>
        Detail Perhitungan SAW Dhuafa - ${namaAlternatif}
    `;
    
    // Show modal
    $('#detailModal').modal('show');
    
    // Simulate loading - replace with actual AJAX call
    setTimeout(() => {
        loadDetailData(alternatifId, namaAlternatif);
    }, 500);
}

// Load detail data (replace with actual AJAX call to your backend)
function loadDetailData(alternatifId, namaAlternatif) {
    // Sample data for Dhuafa - replace with actual AJAX call
    const detailData = {
        nama: namaAlternatif,
        kriteria: [
            { 
                nama: 'IPK', 
                bobot: 0.3, 
                nilai_asli: 3.75, 
                normalisasi: 0.9375, 
                bobot_x_normalisasi: 0.28125,
                tipe: 'benefit'
            },
            { 
                nama: 'Penghasilan Orang Tua', 
                bobot: 0.3, 
                nilai_asli: 1500000, 
                normalisasi: 0.9, 
                bobot_x_normalisasi: 0.27,
                tipe: 'cost'
            },
            { 
                nama: 'Jumlah Tanggungan', 
                bobot: 0.2, 
                nilai_asli: 5, 
                normalisasi: 1.0, 
                bobot_x_normalisasi: 0.2,
                tipe: 'benefit'
            },
            { 
                nama: 'Kondisi Rumah', 
                bobot: 0.15, 
                nilai_asli: 75, 
                normalisasi: 0.75, 
                bobot_x_normalisasi: 0.1125,
                tipe: 'benefit'
            },
            { 
                nama: 'Prestasi', 
                bobot: 0.05, 
                nilai_asli: 80, 
                normalisasi: 0.8, 
                bobot_x_normalisasi: 0.04,
                tipe: 'benefit'
            }
        ]
    };
    
    // Calculate total
    const totalAkhir = detailData.kriteria.reduce((sum, item) => sum + item.bobot_x_normalisasi, 0);
    
    // Generate HTML content
    let html = `
        <div class="detail-section">
            <h6><i class="fas fa-hand-holding-heart mr-2"></i>Informasi Peserta Dhuafa</h6>
            <p><strong>Nama:</strong> ${detailData.nama}</p>
            <p><strong>Kategori:</strong> <span class="badge badge-success">Dhuafa</span></p>
            <p><strong>Total Nilai Akhir:</strong> <span class="nilai-akhir">${totalAkhir.toFixed(4)}</span></p>
        </div>
        
        <div class="detail-section">
            <h6><i class="fas fa-table mr-2"></i>Detail Perhitungan per Kriteria</h6>
            <div class="table-responsive">
                <table class="detail-table">
                    <thead>
                        <tr>
                            <th>Kriteria</th>
                            <th>Bobot</th>
                            <th>Nilai Asli</th>
                            <th>Normalisasi</th>
                            <th>Bobot × Normalisasi</th>
                        </tr>
                    </thead>
                    <tbody>
    `;
    
    detailData.kriteria.forEach(kriteria => {
        html += `
            <tr>
                <td><strong>${kriteria.nama}</strong></td>
                <td>${kriteria.bobot}</td>
                <td class="nilai-asli">${typeof kriteria.nilai_asli === 'number' && kriteria.nilai_asli > 1000 ? kriteria.nilai_asli.toLocaleString('id-ID') : kriteria.nilai_asli}</td>
                <td class="nilai-normalisasi">${kriteria.normalisasi.toFixed(4)}</td>
                <td class="nilai-bobot">${kriteria.bobot_x_normalisasi.toFixed(4)}</td>
            </tr>
        `;
    });
    
    html += `
                    </tbody>
                </table>
            </div>
        </div>
        
        <div class="detail-section">
            <h6><i class="fas fa-calculator mr-2"></i>Langkah Perhitungan SAW</h6>
            
            <div class="calculation-step">
                <div class="step-title">1. Normalisasi Nilai</div>
                <p>Untuk kriteria <strong>benefit</strong> (semakin besar semakin baik):</p>
                <div class="step-formula">R<sub>ij</sub> = X<sub>ij</sub> / Max(X<sub>ij</sub>)</div>
                
                <p>Untuk kriteria <strong>cost</strong> (semakin kecil semakin baik):</p>
                <div class="step-formula">R<sub>ij</sub> = Min(X<sub>ij</sub>) / X<sub>ij</sub></div>
            </div>
            
            <div class="calculation-step">
                <div class="step-title">2. Perhitungan Nilai Akhir</div>
                <div class="step-formula">V<sub>i</sub> = Σ(W<sub>j</sub> × R<sub>ij</sub>)</div>
                <p>Dimana:</p>
                <ul>
                    <li>V<sub>i</sub> = Nilai akhir alternatif ke-i</li>
                    <li>W<sub>j</sub> = Bobot kriteria ke-j</li>
                    <li>R<sub>ij</sub> = Nilai normalisasi</li>
                </ul>
            </div>
            
            <div class="calculation-step">
                <div class="step-title">3. Hasil Akhir untuk Kategori Dhuafa</div>
                <div class="step-formula">
                    V = ${detailData.kriteria.map(k => `(${k.bobot} × ${k.normalisasi.toFixed(4)})`).join(' + ')}
                </div>
                <div class="step-formula">
                    V = ${detailData.kriteria.map(k => k.bobot_x_normalisasi.toFixed(4)).join(' + ')} = <strong>${totalAkhir.toFixed(4)}</strong>
                </div>
            </div>
        </div>
    `;
    
    document.getElementById('detailContent').innerHTML = html;
}

// Real implementation - uncomment and modify this for actual AJAX call
/*
function loadDetailData(alternatifId, namaAlternatif) {
    fetch(`/admin/hasil/dhuafa/detail/${alternatifId}`)
        .then(response => response.json())
        .then(data => {
            // Process the real data from your backend
            generateDetailHTML(data);
        })
        .catch(error => {
            console.error('Error:', error);
            document.getElementById('detailContent').innerHTML = `
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-triangle mr-2"></i>
                    Terjadi kesalahan saat memuat data detail.
                </div>
            `;
        });
}
*/

// Keyboard shortcuts
document.addEventListener('keydown', function(e) {
    if (e.ctrlKey && e.key === 'p') {
        e.preventDefault();
        printResults();
    }
    if (e.ctrlKey && e.key === 'e') {
        e.preventDefault();
        exportResults();
    }
});

console.log('🏆 SAW Dhuafa Results page loaded successfully!');
console.log('💡 Tips: Use Ctrl+P to print, Ctrl+E to export');
</script>
@endsection