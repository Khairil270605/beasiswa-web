@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')
<style>
:root {
    --primary-color: #ff6b35;
    --secondary-color: #f7931e;
    --success-color: #28a745;
    --danger-color: #dc3545;
    --info-color: #17a2b8;
    --warning-color: #ffc107;
}

.dashboard-container {
    padding: 24px;
    background-color: #f8f9fa;
    min-height: 100vh;
}

/* Welcome Banner */
.welcome-banner {
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 50%, #e8521a 100%);
    border-radius: 16px;
    padding: 36px;
    color: white;
    margin-bottom: 28px;
    box-shadow: 0 8px 32px rgba(255, 107, 53, 0.25);
    position: relative;
    overflow: hidden;
}
.welcome-banner::before {
    content: '';
    position: absolute;
    top: -60px; right: -60px;
    width: 220px; height: 220px;
    border-radius: 50%;
    background: rgba(255,255,255,0.07);
    pointer-events: none;
}
.welcome-banner::after {
    content: '';
    position: absolute;
    bottom: -40px; right: 120px;
    width: 140px; height: 140px;
    border-radius: 50%;
    background: rgba(255,255,255,0.05);
    pointer-events: none;
}
.welcome-title {
    font-size: 1.9rem; font-weight: 700;
    margin-bottom: 10px; letter-spacing: -0.3px;
}
.welcome-text {
    font-size: 1rem; opacity: 0.92;
    margin-bottom: 20px; line-height: 1.65; max-width: 620px;
}
.feature-tag {
    background-color: rgba(255,255,255,0.18);
    border: 1px solid rgba(255,255,255,0.25);
    padding: 5px 13px; border-radius: 20px;
    font-size: 0.82rem; margin-right: 8px; margin-bottom: 8px;
    display: inline-block; font-weight: 500;
}

/* ===== CHART CARD (Interaktif) ===== */
.chart-card {
    background: white;
    border-radius: 14px;
    box-shadow: 0 2px 12px rgba(0,0,0,0.07);
    padding: 28px;
    margin-bottom: 28px;
}

/* Header chart */
.chart-card-header {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    margin-bottom: 18px;
    flex-wrap: wrap;
    gap: 12px;
}
.chart-card-title {
    font-size: 1.05rem; font-weight: 700;
    color: #343a40; margin: 0 0 3px;
}
.chart-card-subtitle {
    font-size: 0.82rem; color: #6c757d; margin: 0;
}

/* Filter period buttons */
.chart-filter-group {
    display: flex; gap: 6px; flex-wrap: wrap;
}
.chart-filter-btn {
    padding: 5px 14px;
    font-size: 0.78rem;
    border: 1px solid #dee2e6;
    background: #fff;
    color: #6c757d;
    border-radius: 20px;
    cursor: pointer;
    transition: all .2s;
    font-weight: 500;
}
.chart-filter-btn:hover { border-color: #adb5bd; color: #343a40; }
.chart-filter-btn.active {
    background: var(--info-color);
    border-color: var(--info-color);
    color: #fff;
}

/* Stat cards row */
.chart-stats-row {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 10px;
    margin-bottom: 18px;
}
.chart-stat-card {
    background: #f8f9fa;
    border-radius: 10px;
    padding: 14px 16px;
    position: relative;
    overflow: hidden;
    cursor: pointer;
    transition: all .25s;
    border: 1.5px solid #e9ecef;
    user-select: none;
}
.chart-stat-card:hover { transform: translateY(-2px); border-color: #adb5bd; }
.chart-stat-card.active-series { border-width: 2px; }
.chart-stat-card.inactive-series { opacity: 0.45; border-color: #e9ecef !important; }
.chart-stat-label {
    font-size: 0.7rem; color: #868e96;
    text-transform: uppercase; letter-spacing: .5px;
    margin-bottom: 4px;
}
.chart-stat-number { font-size: 1.6rem; font-weight: 700; line-height: 1; }
.chart-stat-number.dhuafa { color: var(--info-color); }
.chart-stat-number.kader  { color: #fd7e14; }
.chart-stat-number.total  { color: var(--primary-color); }
.chart-stat-badge {
    display: inline-block;
    font-size: 0.68rem; font-weight: 600;
    padding: 2px 8px; border-radius: 10px; margin-top: 5px;
}
.chart-stat-badge.dhuafa { background: rgba(23,162,184,.12); color: #0c7a8a; }
.chart-stat-badge.kader  { background: rgba(253,126,20,.12);  color: #b35500; }
.chart-stat-badge.total  { background: rgba(255,107,53,.12);  color: #c53b0e; }
.chart-stat-bar {
    position: absolute; bottom: 0; left: 0;
    height: 3px; border-radius: 0 2px 2px 0;
    transition: width .6s ease;
}
.chart-stat-bar.dhuafa { background: var(--info-color); }
.chart-stat-bar.kader  { background: #fd7e14; }
.chart-stat-bar.total  { background: var(--primary-color); width: 100% !important; }

/* Chart type toggle */
.chart-type-group {
    display: flex; gap: 6px; flex-wrap: wrap;
    margin-bottom: 14px;
}
.chart-type-btn {
    display: flex; align-items: center; gap: 5px;
    padding: 6px 14px;
    font-size: 0.78rem;
    border: 1px solid #dee2e6;
    background: #fff; color: #6c757d;
    border-radius: 8px; cursor: pointer;
    transition: all .2s; font-weight: 500;
}
.chart-type-btn i { font-size: 0.75rem; opacity: 0.7; }
.chart-type-btn:hover { border-color: #adb5bd; color: #343a40; }
.chart-type-btn.active {
    border-color: #343a40;
    color: #343a40;
    background: #fff;
    font-weight: 600;
}

/* Canvas wrapper */
.chart-canvas-wrap {
    position: relative; width: 100%; height: 260px;
    transition: height .3s;
}

/* Custom tooltip */
.chart-tooltip-custom {
    position: absolute; pointer-events: none;
    background: #fff;
    border: 1px solid rgba(0,0,0,0.1);
    border-radius: 10px;
    padding: 10px 14px;
    font-size: 0.78rem;
    box-shadow: 0 4px 16px rgba(0,0,0,0.1);
    display: none;
    min-width: 150px;
    z-index: 10;
}
.chart-tooltip-custom .tt-period {
    font-weight: 700; font-size: 0.85rem;
    color: #343a40; margin-bottom: 6px;
}
.chart-tooltip-custom .tt-row {
    display: flex; justify-content: space-between;
    gap: 16px; margin-bottom: 3px; color: #6c757d;
    align-items: center;
}
.tt-dot {
    width: 8px; height: 8px; border-radius: 2px;
    display: inline-block; margin-right: 4px; flex-shrink: 0;
}
.chart-tooltip-custom .tt-total {
    margin-top: 6px; padding-top: 6px;
    border-top: 1px solid #f0f0f0;
    display: flex; justify-content: space-between;
    font-size: 0.72rem; color: #868e96;
}

/* Legend */
.chart-legend-row {
    display: flex; gap: 16px; flex-wrap: wrap;
    margin-top: 14px; padding-top: 12px;
    border-top: 1px solid #f0f0f0;
    align-items: center;
}
.legend-item {
    display: flex; align-items: center;
    gap: 6px; font-size: 0.78rem; color: #6c757d; font-weight: 500;
}
.legend-dot {
    width: 10px; height: 10px; border-radius: 2px; flex-shrink: 0;
}
.legend-hint {
    margin-left: auto; font-size: 0.7rem; color: #adb5bd;
    display: flex; align-items: center; gap: 4px;
}

/* Summary Card */
.summary-card {
    background: white; border-radius: 14px;
    box-shadow: 0 2px 12px rgba(0,0,0,0.07);
    padding: 26px; margin-bottom: 28px;
}
.summary-title {
    font-size: 1rem; font-weight: 700; color: #343a40;
    margin-bottom: 18px;
    display: flex; align-items: center; gap: 9px;
}
.summary-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
    gap: 14px;
}
.summary-item {
    text-align: center; padding: 18px 12px;
    background: #f8f9fa; border-radius: 10px; transition: transform 0.2s;
}
.summary-item:hover { transform: translateY(-2px); }
.summary-number {
    font-size: 1.85rem; font-weight: 700;
    color: var(--primary-color); line-height: 1; margin-bottom: 6px;
}
.summary-label { font-size: 0.8rem; color: #6c757d; font-weight: 500; }

/* Category Section */
.category-section {
    background: white; border-radius: 14px;
    box-shadow: 0 2px 12px rgba(0,0,0,0.07);
    padding: 26px; margin-bottom: 28px;
}
.category-header {
    display: flex; align-items: center;
    justify-content: space-between;
    margin-bottom: 22px; padding-bottom: 16px;
    border-bottom: 1.5px solid #f0f0f0;
    flex-wrap: wrap; gap: 12px;
}
.category-title {
    font-size: 1.2rem; font-weight: 700;
    display: flex; align-items: center; gap: 12px;
    margin: 0; color: #343a40;
}
.category-icon {
    width: 46px; height: 46px; border-radius: 12px;
    display: flex; align-items: center; justify-content: center;
    font-size: 20px; color: white; flex-shrink: 0;
}
.category-icon.dhuafa { background: linear-gradient(135deg, var(--info-color) 0%, #138496 100%); }
.category-icon.kader  { background: linear-gradient(135deg, #fd7e14 0%, var(--warning-color) 100%); }
.category-badge {
    padding: 6px 14px; border-radius: 20px;
    font-size: 0.78rem; font-weight: 700;
    text-transform: uppercase; letter-spacing: 0.3px;
}
.category-badge.dhuafa { background: #e3f6f9; color: #0c7a8a; }
.category-badge.kader  { background: #fff3cd; color: #856404; }

/* Stats Cards */
.stats-row {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
    gap: 14px; margin-bottom: 22px;
}
.stats-card {
    background: #f8f9fa; border-radius: 12px;
    padding: 18px 20px; border-left: 4px solid;
    transition: all .25s ease; position: relative; overflow: hidden;
}
.stats-card::after {
    content: ''; position: absolute;
    top: -20px; right: -20px;
    width: 70px; height: 70px;
    border-radius: 50%; opacity: 0.06;
}
.stats-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 16px rgba(0,0,0,0.1);
    background: white;
}
.stats-card.primary   { border-left-color: var(--primary-color); }
.stats-card.primary::after   { background: var(--primary-color); }
.stats-card.secondary { border-left-color: var(--secondary-color); }
.stats-card.success   { border-left-color: var(--success-color); }
.stats-card.success::after   { background: var(--success-color); }
.stats-card.info      { border-left-color: var(--info-color); }
.stats-card.info::after      { background: var(--info-color); }
.stats-card.warning   { border-left-color: var(--warning-color); }
.stats-card.warning::after   { background: var(--warning-color); }
.stats-card.danger    { border-left-color: var(--danger-color); }
.stats-card.danger::after    { background: var(--danger-color); }
.stats-number { font-size: 1.9rem; font-weight: 700; margin: 0; line-height: 1; }
.stats-number.primary   { color: var(--primary-color); }
.stats-number.secondary { color: var(--secondary-color); }
.stats-number.success   { color: var(--success-color); }
.stats-number.info      { color: var(--info-color); }
.stats-number.warning   { color: #c79200; }
.stats-number.danger    { color: var(--danger-color); }
.stats-label { font-size: 0.8rem; color: #868e96; margin-top: 6px; font-weight: 500; }
.stats-icon-mini { font-size: 0.85rem; margin-right: 5px; opacity: 0.7; }

/* Quick Actions */
.quick-actions {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 14px;
}
.action-card {
    background: #f8f9fa; border-radius: 12px; padding: 18px;
    text-decoration: none; color: #495057;
    border: 1.5px solid #e9ecef; transition: all .25s ease;
    display: flex; align-items: center; gap: 14px;
}
.action-card:hover {
    text-decoration: none; color: var(--primary-color);
    border-color: var(--primary-color); background: white;
    transform: translateY(-2px);
    box-shadow: 0 4px 14px rgba(255,107,53,0.15);
}
.action-icon {
    width: 46px; height: 46px; border-radius: 11px;
    display: flex; align-items: center; justify-content: center;
    font-size: 18px; color: white; flex-shrink: 0;
}
.action-content { flex: 1; }
.action-title { font-weight: 600; font-size: 0.95rem; margin-bottom: 3px; line-height: 1.3; }
.action-desc  { font-size: 0.8rem; color: #868e96; margin: 0; }

/* Bottom Buttons */
.btn-action {
    padding: 12px 22px; border-radius: 10px; text-decoration: none;
    font-weight: 600; display: inline-flex; align-items: center;
    justify-content: center; gap: 8px; transition: all .25s ease;
    border: none; cursor: pointer; font-size: 0.9rem;
}
.btn-primary-gradient {
    background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
    color: white; box-shadow: 0 4px 14px rgba(255,107,53,0.3);
}
.btn-primary-gradient:hover {
    background: linear-gradient(45deg, #e55a2b, #e6841a);
    color: white; text-decoration: none;
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(255,107,53,0.35);
}

/* Fade-in */
.fade-in { opacity: 0; transform: translateY(18px); }

@media (max-width: 768px) {
    .dashboard-container { padding: 14px; }
    .welcome-title { font-size: 1.4rem; }
    .welcome-banner { padding: 24px; }
    .stats-number { font-size: 1.6rem; }
    .category-header { flex-direction: column; align-items: flex-start; }
    .quick-actions { grid-template-columns: 1fr; }
    .chart-stats-row { grid-template-columns: 1fr 1fr 1fr; }
    .chart-card-header { flex-direction: column; }
    .chart-type-group { gap: 4px; }
    .chart-type-btn { padding: 5px 10px; font-size: 0.72rem; }
    .legend-hint { display: none; }
}
</style>

<div class="dashboard-container">

    {{-- ===== WELCOME BANNER ===== --}}
    <div class="welcome-banner fade-in">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h2 class="welcome-title">
                    <i class="fas fa-hand-sparkles me-2"></i>
                    Selamat Datang, {{ auth()->user()->name ?? 'Admin' }}!
                </h2>
                <p class="welcome-text">
                    Kelola sistem pendaftaran dan penilaian beasiswa LAZISMU DIY dengan metode SAW (Simple Additive Weighting).
                    Sistem ini membantu Anda dalam proses seleksi penerima beasiswa secara objektif dan terstruktur.
                </p>
                <div>
                    <span class="feature-tag"><i class="fas fa-users me-1"></i> Kelola Peserta</span>
                    <span class="feature-tag"><i class="fas fa-clipboard-check me-1"></i> Input Penilaian</span>
                    <span class="feature-tag"><i class="fas fa-chart-line me-1"></i> Hasil SAW</span>
                    <span class="feature-tag"><i class="fas fa-file-pdf me-1"></i> Generate Laporan</span>
                </div>
            </div>
            <div class="col-lg-4 text-center d-none d-lg-block">
                <i class="fas fa-graduation-cap" style="font-size:110px;opacity:0.15;"></i>
            </div>
        </div>
    </div>

    {{-- ===== CHART CARD (Interaktif) ===== --}}
    <div class="chart-card fade-in">

        {{-- Header & Filter Periode --}}
        <div class="chart-card-header">
            <div>
                <p class="chart-card-title">
                    <i class="fas fa-chart-bar me-2" style="color:var(--primary-color);"></i>
                    Grafik Pendaftar per Periode
                </p>
                <p class="chart-card-subtitle">Perbandingan jumlah pendaftar Beasiswa Dhuafa dan Kader</p>
            </div>
            <div class="chart-filter-group" id="filterGroup">
                <button class="chart-filter-btn active" data-filter="all">Semua</button>
                <button class="chart-filter-btn" data-filter="5">5 Terakhir</button>
                <button class="chart-filter-btn" data-filter="3">3 Terakhir</button>
            </div>
        </div>

        {{-- Stat Cards (klik untuk show/hide seri) --}}
        <div class="chart-stats-row">
            <div class="chart-stat-card active-series" id="sc-dhuafa" onclick="toggleSeries('dhuafa')" style="border-color:#17a2b8;">
                <div class="chart-stat-label">Dhuafa</div>
                <div class="chart-stat-number dhuafa" id="sv-dhuafa">–</div>
                <span class="chart-stat-badge dhuafa">pendaftar</span>
                <div class="chart-stat-bar dhuafa" id="bar-dhuafa" style="width:60%;"></div>
            </div>
            <div class="chart-stat-card active-series" id="sc-kader" onclick="toggleSeries('kader')" style="border-color:#fd7e14;">
                <div class="chart-stat-label">Kader</div>
                <div class="chart-stat-number kader" id="sv-kader">–</div>
                <span class="chart-stat-badge kader">pendaftar</span>
                <div class="chart-stat-bar kader" id="bar-kader" style="width:40%;"></div>
            </div>
            <div class="chart-stat-card" id="sc-total" style="border-color:#e9ecef;cursor:default;">
                <div class="chart-stat-label">Total</div>
                <div class="chart-stat-number total" id="sv-total">–</div>
                <span class="chart-stat-badge total">keseluruhan</span>
                <div class="chart-stat-bar total"></div>
            </div>
        </div>

        {{-- Toggle Tipe Chart --}}
        <div class="chart-type-group" id="typeGroup">
            <button class="chart-type-btn active" data-type="bar">
                <i class="fas fa-chart-bar"></i> Batang
            </button>
            <button class="chart-type-btn" data-type="line">
                <i class="fas fa-chart-line"></i> Garis
            </button>
            <button class="chart-type-btn" data-type="radar">
                <i class="fas fa-spider"></i> Radar
            </button>
            <button class="chart-type-btn" data-type="doughnut">
                <i class="fas fa-circle-notch"></i> Proporsi
            </button>
        </div>

        {{-- Canvas --}}
        <div style="position:relative;">
            <div class="chart-canvas-wrap" id="chartWrap">
                <canvas id="mainChart"
                    role="img"
                    aria-label="Chart perbandingan pendaftar Beasiswa Dhuafa dan Kader per periode">
                    Data pendaftar per periode.
                </canvas>
            </div>
            {{-- Custom Tooltip --}}
            <div class="chart-tooltip-custom" id="chartTooltip">
                <div class="tt-period" id="tt-period"></div>
                <div class="tt-row">
                    <span><span class="tt-dot" style="background:#17a2b8;"></span>Dhuafa</span>
                    <strong id="tt-d" style="color:#17a2b8;">–</strong>
                </div>
                <div class="tt-row">
                    <span><span class="tt-dot" style="background:#fd7e14;"></span>Kader</span>
                    <strong id="tt-k" style="color:#fd7e14;">–</strong>
                </div>
                <div class="tt-total">
                    <span>Total</span>
                    <strong id="tt-t" style="color:#343a40;"></strong>
                </div>
            </div>
        </div>

        {{-- Legend --}}
        <div class="chart-legend-row">
            <span class="legend-item">
                <span class="legend-dot" style="background:#17a2b8;"></span>Dhuafa
            </span>
            <span class="legend-item">
                <span class="legend-dot" style="background:#fd7e14;"></span>Kader
            </span>
            <span class="legend-hint">
                <i class="fas fa-hand-pointer" style="font-size:10px;"></i>
                Klik stat card untuk sembunyikan/tampilkan seri
            </span>
        </div>
    </div>

    {{-- ===== RINGKASAN SISTEM ===== --}}
    <div class="summary-card fade-in">
        <div class="summary-title">
            <i class="fas fa-chart-pie" style="color:var(--primary-color);"></i>
            Ringkasan Sistem
        </div>
        <div class="summary-grid">
            <div class="summary-item">
                <div class="summary-number">{{ $totalKriteria ?? 0 }}</div>
                <div class="summary-label">Total Kriteria</div>
            </div>
            <div class="summary-item">
                <div class="summary-number">{{ $totalSubKriteria ?? 0 }}</div>
                <div class="summary-label">Total SubKriteria</div>
            </div>
            <div class="summary-item">
                <div class="summary-number">{{ $totalAlternatif ?? 0 }}</div>
                <div class="summary-label">Total Pendaftar</div>
            </div>
            <div class="summary-item">
                <div class="summary-number">{{ $totalPenilaian ?? 0 }}</div>
                <div class="summary-label">Total Penilaian</div>
            </div>
        </div>
    </div>

    {{-- ===== BEASISWA DHUAFA ===== --}}
    <div class="category-section fade-in">
        <div class="category-header">
            <div class="category-title">
                <div class="category-icon dhuafa">
                    <i class="fas fa-hands-helping"></i>
                </div>
                <span>Beasiswa Dhuafa</span>
            </div>
            <span class="category-badge dhuafa">
                <i class="fas fa-user-graduate me-1"></i> Kategori Dhuafa
            </span>
        </div>
        <div class="stats-row">
            <div class="stats-card info">
                <div class="stats-number info">
                    <i class="stats-icon-mini fas fa-list-alt"></i>{{ $kriteriaDhuafa ?? 0 }}
                </div>
                <div class="stats-label">Kriteria Dhuafa</div>
            </div>
            <div class="stats-card success">
                <div class="stats-number success">
                    <i class="stats-icon-mini fas fa-tasks"></i>{{ $subKriteriaDhuafa ?? 0 }}
                </div>
                <div class="stats-label">SubKriteria Dhuafa</div>
            </div>
            <div class="stats-card primary">
                <div class="stats-number primary">
                    <i class="stats-icon-mini fas fa-users"></i>{{ $alternatifDhuafa ?? 0 }}
                </div>
                <div class="stats-label">Pendaftar Dhuafa</div>
            </div>
            <div class="stats-card warning">
                <div class="stats-number warning">
                    <i class="stats-icon-mini fas fa-star"></i>{{ $penilaianDhuafa ?? 0 }}
                </div>
                <div class="stats-label">Penilaian Dhuafa</div>
            </div>
        </div>
        <div class="quick-actions">
            <a href="{{ route('admin.kriteria.dhuafa') }}" class="action-card">
                <div class="action-icon" style="background:linear-gradient(135deg,var(--info-color),#138496);">
                    <i class="fas fa-clipboard-list"></i>
                </div>
                <div class="action-content">
                    <div class="action-title">Kriteria Dhuafa</div>
                    <p class="action-desc">Kelola kriteria penilaian</p>
                </div>
            </a>
            <a href="{{ route('admin.subkriteria.dhuafa') }}" class="action-card">
                <div class="action-icon" style="background:linear-gradient(135deg,var(--success-color),#20c997);">
                    <i class="fas fa-list-ul"></i>
                </div>
                <div class="action-content">
                    <div class="action-title">SubKriteria Dhuafa</div>
                    <p class="action-desc">Kelola sub kriteria</p>
                </div>
            </a>
            <a href="{{ route('admin.penilaian.dhuafa') }}" class="action-card">
                <div class="action-icon" style="background:linear-gradient(135deg,var(--primary-color),var(--secondary-color));">
                    <i class="fas fa-edit"></i>
                </div>
                <div class="action-content">
                    <div class="action-title">Penilaian Dhuafa</div>
                    <p class="action-desc">Input penilaian peserta</p>
                </div>
            </a>
        </div>
    </div>

    {{-- ===== BEASISWA KADER ===== --}}
    <div class="category-section fade-in">
        <div class="category-header">
            <div class="category-title">
                <div class="category-icon kader">
                    <i class="fas fa-user-tie"></i>
                </div>
                <span>Beasiswa Kader</span>
            </div>
            <span class="category-badge kader">
                <i class="fas fa-award me-1"></i> Kategori Kader
            </span>
        </div>
        <div class="stats-row">
            <div class="stats-card warning">
                <div class="stats-number warning">
                    <i class="stats-icon-mini fas fa-list-alt"></i>{{ $kriteriaKader ?? 0 }}
                </div>
                <div class="stats-label">Kriteria Kader</div>
            </div>
            <div class="stats-card success">
                <div class="stats-number success">
                    <i class="stats-icon-mini fas fa-tasks"></i>{{ $subKriteriaKader ?? 0 }}
                </div>
                <div class="stats-label">SubKriteria Kader</div>
            </div>
            <div class="stats-card primary">
                <div class="stats-number primary">
                    <i class="stats-icon-mini fas fa-users"></i>{{ $alternatifKader ?? 0 }}
                </div>
                <div class="stats-label">Pendaftar Kader</div>
            </div>
            <div class="stats-card danger">
                <div class="stats-number danger">
                    <i class="stats-icon-mini fas fa-star"></i>{{ $penilaianKader ?? 0 }}
                </div>
                <div class="stats-label">Penilaian Kader</div>
            </div>
        </div>
        <div class="quick-actions">
            <a href="{{ route('admin.kriteria.kader') }}" class="action-card">
                <div class="action-icon" style="background:linear-gradient(135deg,#fd7e14,var(--warning-color));">
                    <i class="fas fa-clipboard-list"></i>
                </div>
                <div class="action-content">
                    <div class="action-title">Kriteria Kader</div>
                    <p class="action-desc">Kelola kriteria penilaian</p>
                </div>
            </a>
            <a href="{{ route('admin.subkriteria.kader') }}" class="action-card">
                <div class="action-icon" style="background:linear-gradient(135deg,var(--success-color),#20c997);">
                    <i class="fas fa-list-ul"></i>
                </div>
                <div class="action-content">
                    <div class="action-title">SubKriteria Kader</div>
                    <p class="action-desc">Kelola sub kriteria</p>
                </div>
            </a>
            <a href="{{ route('admin.penilaian.kader') }}" class="action-card">
                <div class="action-icon" style="background:linear-gradient(135deg,var(--primary-color),var(--secondary-color));">
                    <i class="fas fa-edit"></i>
                </div>
                <div class="action-content">
                    <div class="action-title">Penilaian Kader</div>
                    <p class="action-desc">Input penilaian peserta</p>
                </div>
            </a>
        </div>
    </div>

    {{-- ===== QUICK ACCESS GLOBAL ===== --}}
    <div class="row">
        <div class="col-md-6 mb-3">
            <a href="{{ route('admin.alternatif.index') }}" class="btn btn-action btn-primary-gradient w-100">
                <i class="fas fa-users"></i>
                Kelola Semua Pendaftar
            </a>
        </div>
    </div>

</div>

{{-- ===== SCRIPTS ===== --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {

    // ── Fade-in stagger ────────────────────────────────────────
    document.querySelectorAll('.fade-in').forEach((el, i) => {
        setTimeout(() => {
            el.style.transition = 'opacity 0.55s ease, transform 0.55s ease';
            el.style.opacity    = '1';
            el.style.transform  = 'translateY(0)';
        }, i * 120);
    });

    // ── Data dari controller ───────────────────────────────────
    const RAW = @json($chartData ?? []);

    // Bangun map periode → { dhuafa, kader }
    const map = {};
    RAW.forEach(item => {
        if (!map[item.nama_periode]) map[item.nama_periode] = { dhuafa: 0, kader: 0 };
        if (item.kategori === 'dhuafa') map[item.nama_periode].dhuafa = item.total;
        if (item.kategori === 'kader')  map[item.nama_periode].kader  = item.total;
    });

    const ALL_LABELS = Object.keys(map).length ? Object.keys(map) : ['Belum ada data'];
    const ALL_DHUAFA = ALL_LABELS.map(p => map[p]?.dhuafa ?? 0);
    const ALL_KADER  = ALL_LABELS.map(p => map[p]?.kader  ?? 0);

    // ── State ──────────────────────────────────────────────────
    let activeFilter  = 'all';
    let activeType    = 'bar';
    let seriesVisible = { dhuafa: true, kader: true };
    let myChart       = null;

    // ── Ambil data sesuai filter ───────────────────────────────
    function getFiltered() {
        const n = activeFilter === 'all'
            ? ALL_LABELS.length
            : Math.min(parseInt(activeFilter), ALL_LABELS.length);
        const start = ALL_LABELS.length - n;
        return {
            labels: ALL_LABELS.slice(start),
            dhuafa: ALL_DHUAFA.slice(start),
            kader:  ALL_KADER.slice(start)
        };
    }

    // ── Update stat cards ──────────────────────────────────────
    function updateStats(d) {
        const sd = d.dhuafa.reduce((a, b) => a + b, 0);
        const sk = d.kader.reduce((a, b) => a + b, 0);
        const st = sd + sk;
        document.getElementById('sv-dhuafa').textContent = sd;
        document.getElementById('sv-kader').textContent  = sk;
        document.getElementById('sv-total').textContent  = st;
        document.getElementById('bar-dhuafa').style.width = st ? Math.round(sd / st * 100) + '%' : '0%';
        document.getElementById('bar-kader').style.width  = st ? Math.round(sk / st * 100) + '%' : '0%';
    }

    // ── Build datasets ─────────────────────────────────────────
    function buildDatasets(d) {
        const isDoughnut = activeType === 'doughnut';
        const isLine     = activeType === 'line';
        const isRadar    = activeType === 'radar';

        if (isDoughnut) {
            const sd = seriesVisible.dhuafa ? d.dhuafa.reduce((a, b) => a + b, 0) : 0;
            const sk = seriesVisible.kader  ? d.kader.reduce((a, b) => a + b, 0)  : 0;
            return [{
                data: [sd, sk],
                backgroundColor: ['rgba(23,162,184,.85)', 'rgba(253,126,20,.85)'],
                borderColor:     ['#17a2b8', '#fd7e14'],
                borderWidth: 2,
                hoverOffset: 10,
                hoverBorderColor: ['#fff', '#fff'],
                hoverBorderWidth: 3
            }];
        }

        const ds = [];
        if (seriesVisible.dhuafa) {
            ds.push({
                label: 'Dhuafa',
                data: d.dhuafa,
                backgroundColor: activeType === 'bar'
                    ? 'rgba(23,162,184,.82)'
                    : 'rgba(23,162,184,.15)',
                borderColor: '#17a2b8',
                borderWidth: activeType === 'bar' ? 1.5 : 2,
                borderRadius: activeType === 'bar' ? 7 : undefined,
                borderSkipped: false,
                hoverBackgroundColor: activeType === 'bar'
                    ? 'rgba(23,162,184,1)' : undefined,
                fill: isLine || isRadar,
                tension: .45,
                pointRadius: isLine ? 5 : 3,
                pointHoverRadius: isLine ? 9 : 5,
                pointBackgroundColor: '#17a2b8',
                pointBorderColor: '#fff',
                pointBorderWidth: isLine ? 2 : 1,
                pointStyle: 'circle'
            });
        }
        if (seriesVisible.kader) {
            ds.push({
                label: 'Kader',
                data: d.kader,
                backgroundColor: activeType === 'bar'
                    ? 'rgba(253,126,20,.82)'
                    : 'rgba(253,126,20,.15)',
                borderColor: '#fd7e14',
                borderWidth: activeType === 'bar' ? 1.5 : 2,
                borderRadius: activeType === 'bar' ? 7 : undefined,
                borderSkipped: false,
                hoverBackgroundColor: activeType === 'bar'
                    ? 'rgba(253,126,20,1)' : undefined,
                fill: isLine || isRadar,
                tension: .45,
                pointRadius: isLine ? 5 : 3,
                pointHoverRadius: isLine ? 9 : 5,
                pointBackgroundColor: '#fd7e14',
                pointBorderColor: '#fff',
                pointBorderWidth: isLine ? 2 : 1,
                pointStyle: 'rectRounded'
            });
        }
        return ds;
    }

    // ── Build options ──────────────────────────────────────────
    function buildOptions(d) {
        const isDoughnut = activeType === 'doughnut';
        const isRadar    = activeType === 'radar';

        const tooltipPlugin = {
            enabled: false,
            external(ctx) {
                const tt = document.getElementById('chartTooltip');
                if (ctx.tooltip.opacity === 0) {
                    tt.style.display = 'none';
                    return;
                }
                const pts = ctx.tooltip.dataPoints;

                if (isDoughnut) {
                    const idx  = pts[0].dataIndex;
                    const name = idx === 0 ? 'Dhuafa' : 'Kader';
                    const val  = pts[0].raw;
                    document.getElementById('tt-period').textContent = name;
                    document.getElementById('tt-d').textContent = idx === 0 ? val : '–';
                    document.getElementById('tt-k').textContent = idx === 1 ? val : '–';
                    document.getElementById('tt-t').textContent = val;
                } else {
                    const byDs = {};
                    pts.forEach(pt => { byDs[pt.dataset.label] = pt.raw; });
                    document.getElementById('tt-period').textContent = pts[0]?.label ?? '';
                    document.getElementById('tt-d').textContent = byDs['Dhuafa'] ?? '–';
                    document.getElementById('tt-k').textContent = byDs['Kader']  ?? '–';
                    document.getElementById('tt-t').textContent =
                        (byDs['Dhuafa'] || 0) + (byDs['Kader'] || 0);
                }

                const wrap = document.getElementById('chartWrap');
                const pos  = ctx.tooltip;
                let x = pos.caretX + 14;
                let y = pos.caretY - 24;
                if (x + 170 > wrap.offsetWidth) x = pos.caretX - 180;
                if (y < 0) y = 4;
                tt.style.left    = x + 'px';
                tt.style.top     = y + 'px';
                tt.style.display = 'block';
            }
        };

        const base = {
            responsive: true,
            maintainAspectRatio: false,
            animation: { duration: 700, easing: 'easeOutQuart' },
            plugins: {
                legend: { display: false },
                tooltip: tooltipPlugin
            },
            interaction: { mode: 'index', intersect: false }
        };

        if (isDoughnut) {
            base.cutout = '62%';
            base.plugins.tooltip = { ...base.plugins.tooltip, mode: 'nearest', intersect: true };
            base.interaction = { mode: 'nearest', intersect: true };
            return base;
        }

        if (isRadar) {
            base.scales = {
                r: {
                    beginAtZero: true,
                    grid: { color: 'rgba(0,0,0,0.07)' },
                    ticks: { color: '#999', font: { size: 10 }, stepSize: 10, backdropColor: 'transparent' },
                    pointLabels: { color: '#666', font: { size: 11 } },
                    angleLines: { color: 'rgba(0,0,0,0.07)' }
                }
            };
            return base;
        }

        // bar / line
        base.scales = {
            x: {
                grid: { display: false },
                ticks: { color: '#999', font: { size: 11 }, autoSkip: false, maxRotation: 0 },
                border: { display: false }
            },
            y: {
                beginAtZero: true,
                grid: { color: 'rgba(0,0,0,0.05)', drawBorder: false },
                ticks: {
                    color: '#999',
                    font: { size: 11 },
                    stepSize: 5,
                    callback: v => Math.round(v)
                },
                border: { display: false }
            }
        };
        return base;
    }

    // ── Build / rebuild chart ──────────────────────────────────
    function buildChart() {
        const d          = getFiltered();
        const isDoughnut = activeType === 'doughnut';

        updateStats(d);

        document.getElementById('chartWrap').style.height = isDoughnut ? '300px' : '260px';

        const labels = isDoughnut ? ['Dhuafa', 'Kader'] : d.labels;

        if (myChart) { myChart.destroy(); myChart = null; }

        myChart = new Chart(document.getElementById('mainChart'), {
            type: activeType === 'doughnut' ? 'doughnut' : activeType,
            data: { labels, datasets: buildDatasets(d) },
            options: buildOptions(d)
        });

        // Sembunyikan tooltip saat chart diganti
        document.getElementById('chartTooltip').style.display = 'none';
    }

    // ── Filter periode ─────────────────────────────────────────
    document.getElementById('filterGroup')
        .querySelectorAll('.chart-filter-btn')
        .forEach(btn => {
            btn.addEventListener('click', () => {
                document.querySelectorAll('.chart-filter-btn')
                    .forEach(b => b.classList.remove('active'));
                btn.classList.add('active');
                activeFilter = btn.dataset.filter;
                buildChart();
            });
        });

    // ── Tipe chart ─────────────────────────────────────────────
    document.getElementById('typeGroup')
        .querySelectorAll('.chart-type-btn')
        .forEach(btn => {
            btn.addEventListener('click', () => {
                document.querySelectorAll('.chart-type-btn')
                    .forEach(b => b.classList.remove('active'));
                btn.classList.add('active');
                activeType = btn.dataset.type;
                buildChart();
            });
        });

    // ── Toggle seri (klik stat card) ───────────────────────────
    window.toggleSeries = function (series) {
        seriesVisible[series] = !seriesVisible[series];
        const card  = document.getElementById('sc-' + series);
        const color = series === 'dhuafa' ? '#17a2b8' : '#fd7e14';

        if (seriesVisible[series]) {
            card.classList.remove('inactive-series');
            card.classList.add('active-series');
            card.style.borderColor = color;
        } else {
            card.classList.remove('active-series');
            card.classList.add('inactive-series');
            card.style.borderColor = '#e9ecef';
        }
        buildChart();
    };

    // ── Init ───────────────────────────────────────────────────
    buildChart();
});
</script>
@endsection