@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')
<!-- CSS LAZISMU DIY Consistent Style -->
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

.welcome-banner {
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 50%, var(--danger-color) 100%);
    border-radius: 12px;
    padding: 32px;
    color: white;
    margin-bottom: 30px;
    box-shadow: 0 4px 20px rgba(255, 107, 53, 0.3);
}

.welcome-title {
    font-size: 2rem;
    font-weight: bold;
    margin-bottom: 12px;
}

.welcome-text {
    font-size: 1.1rem;
    opacity: 0.95;
    margin-bottom: 20px;
    line-height: 1.6;
}

.feature-tag {
    background-color: rgba(255,255,255,0.2);
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 0.9rem;
    margin-right: 8px;
    margin-bottom: 8px;
    display: inline-block;
}

/* Category Section */
.category-section {
    background: white;
    border-radius: 12px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    padding: 24px;
    margin-bottom: 30px;
}

.category-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 24px;
    padding-bottom: 16px;
    border-bottom: 2px solid #f0f0f0;
}

.category-title {
    font-size: 1.5rem;
    font-weight: bold;
    display: flex;
    align-items: center;
    gap: 12px;
    margin: 0;
}

.category-icon {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
    color: white;
}

.category-icon.dhuafa {
    background: linear-gradient(135deg, var(--info-color) 0%, #138496 100%);
}

.category-icon.kader {
    background: linear-gradient(135deg, var(--warning-color) 0%, #fd7e14 100%);
}

.category-badge {
    padding: 8px 16px;
    border-radius: 20px;
    font-size: 0.85rem;
    font-weight: bold;
    text-transform: uppercase;
}

.category-badge.dhuafa {
    background: linear-gradient(135deg, var(--info-color) 0%, #138496 100%);
    color: white;
}

.category-badge.kader {
    background: linear-gradient(135deg, var(--warning-color) 0%, #fd7e14 100%);
    color: #212529;
}

/* Stats Cards */
.stats-row {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 16px;
    margin-bottom: 20px;
}

.stats-card {
    background: white;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.08);
    padding: 20px;
    border-left: 4px solid;
    transition: all 0.3s ease;
}

.stats-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 20px rgba(0,0,0,0.12);
}

.stats-card.primary { border-left-color: var(--primary-color); }
.stats-card.secondary { border-left-color: var(--secondary-color); }
.stats-card.success { border-left-color: var(--success-color); }
.stats-card.info { border-left-color: var(--info-color); }
.stats-card.warning { border-left-color: var(--warning-color); }
.stats-card.danger { border-left-color: var(--danger-color); }

.stats-number {
    font-size: 2rem;
    font-weight: bold;
    margin: 0;
    line-height: 1;
}

.stats-number.primary { color: var(--primary-color); }
.stats-number.secondary { color: var(--secondary-color); }
.stats-number.success { color: var(--success-color); }
.stats-number.info { color: var(--info-color); }
.stats-number.warning { color: var(--warning-color); }
.stats-number.danger { color: var(--danger-color); }

.stats-label {
    font-size: 0.9rem;
    color: #6c757d;
    margin-top: 8px;
    font-weight: 500;
}

.stats-icon-mini {
    font-size: 1.2rem;
    margin-right: 8px;
}

/* Quick Actions */
.quick-actions {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 16px;
    margin-top: 20px;
}

.action-card {
    background: white;
    border-radius: 10px;
    padding: 20px;
    text-decoration: none;
    color: #495057;
    border: 2px solid #e9ecef;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 16px;
}

.action-card:hover {
    text-decoration: none;
    color: var(--primary-color);
    border-color: var(--primary-color);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(255, 107, 53, 0.2);
}

.action-icon {
    width: 50px;
    height: 50px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    color: white;
    flex-shrink: 0;
}

.action-content {
    flex: 1;
}

.action-title {
    font-weight: 600;
    font-size: 1rem;
    margin-bottom: 4px;
}

.action-desc {
    font-size: 0.85rem;
    color: #6c757d;
    margin: 0;
}

/* Summary Card */
.summary-card {
    background: white;
    border-radius: 12px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    padding: 24px;
    margin-bottom: 30px;
}

.summary-title {
    font-size: 1.3rem;
    font-weight: bold;
    color: #495057;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.summary-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 16px;
}

.summary-item {
    text-align: center;
    padding: 16px;
    background: #f8f9fa;
    border-radius: 8px;
}

.summary-number {
    font-size: 1.8rem;
    font-weight: bold;
    color: var(--primary-color);
}

.summary-label {
    font-size: 0.9rem;
    color: #6c757d;
    margin-top: 4px;
}

/* Buttons */
.btn-action {
    padding: 10px 20px;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 500;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
    font-size: 0.9rem;
}

.btn-primary-gradient {
    background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
    color: white;
}

.btn-primary-gradient:hover {
    background: linear-gradient(45deg, #e55a2b, #e6841a);
    color: white;
    text-decoration: none;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(255, 107, 53, 0.3);
}

.btn-info-gradient {
    background: linear-gradient(45deg, var(--info-color), #138496);
    color: white;
}

.btn-info-gradient:hover {
    background: linear-gradient(45deg, #138496, #117a8b);
    color: white;
    text-decoration: none;
    transform: translateY(-2px);
}

.btn-warning-gradient {
    background: linear-gradient(45deg, var(--warning-color), #fd7e14);
    color: #212529;
}

.btn-warning-gradient:hover {
    background: linear-gradient(45deg, #e0a800, #e76b0c);
    color: #212529;
    text-decoration: none;
    transform: translateY(-2px);
}

/* Animations */
.fade-in {
    animation: fadeIn 0.5s ease;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

/* Responsive */
@media (max-width: 768px) {
    .dashboard-container { padding: 16px; }
    .welcome-title { font-size: 1.5rem; }
    .stats-number { font-size: 1.8rem; }
    .category-header { flex-direction: column; align-items: flex-start; gap: 12px; }
    .quick-actions { grid-template-columns: 1fr; }
}
</style>

<div class="dashboard-container">
    <!-- Welcome Banner -->
    <div class="welcome-banner fade-in">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h2 class="welcome-title">
                    <i class="fas fa-hand-sparkles"></i>
                    Selamat Datang, {{ auth()->user()->name ?? 'Admin' }}!
                </h2>
                <p class="welcome-text">
                    Kelola sistem pendaftaran dan penilaian beasiswa LAZISMU DIY dengan metode SAW (Simple Additive Weighting). 
                    Sistem ini membantu Anda dalam proses seleksi penerima beasiswa secara objektif dan terstruktur.
                </p>
                <div>
                    <span class="feature-tag"><i class="fas fa-users"></i> Kelola Peserta</span>
                    <span class="feature-tag"><i class="fas fa-clipboard-check"></i> Input Penilaian</span>
                    <span class="feature-tag"><i class="fas fa-chart-line"></i> Hasil SAW</span>
                    <span class="feature-tag"><i class="fas fa-file-pdf"></i> Generate Laporan</span>
                </div>
            </div>
            <div class="col-lg-4 text-center d-none d-lg-block">
                <div style="font-size: 120px; opacity: 0.2;">
                    <i class="fas fa-graduation-cap"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Summary Statistics -->
    <div class="summary-card fade-in">
        <div class="summary-title">
            <i class="fas fa-chart-pie"></i>
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

    <!-- SECTION: BEASISWA DHUAFA -->
    <div class="category-section fade-in">
        <div class="category-header">
            <div class="category-title">
                <div class="category-icon dhuafa">
                    <i class="fas fa-hands-helping"></i>
                </div>
                <span>Beasiswa Dhuafa</span>
            </div>
            <span class="category-badge dhuafa">
                <i class="fas fa-user-graduate"></i> Kategori Dhuafa
            </span>
        </div>

        <!-- Stats Dhuafa -->
        <div class="stats-row">
            <div class="stats-card info">
                <div class="stats-number info">
                    <i class="stats-icon-mini fas fa-list-alt"></i>
                    {{ $kriteriaDhuafa ?? 0 }}
                </div>
                <div class="stats-label">Kriteria Dhuafa</div>
            </div>
            <div class="stats-card success">
                <div class="stats-number success">
                    <i class="stats-icon-mini fas fa-tasks"></i>
                    {{ $subKriteriaDhuafa ?? 0 }}
                </div>
                <div class="stats-label">SubKriteria Dhuafa</div>
            </div>
            <div class="stats-card primary">
                <div class="stats-number primary">
                    <i class="stats-icon-mini fas fa-users"></i>
                    {{ $alternatifDhuafa ?? 0 }}
                </div>
                <div class="stats-label">Pendaftar Dhuafa</div>
            </div>
            <div class="stats-card warning">
                <div class="stats-number warning">
                    <i class="stats-icon-mini fas fa-star"></i>
                    {{ $penilaianDhuafa ?? 0 }}
                </div>
                <div class="stats-label">Penilaian Dhuafa</div>
            </div>
        </div>

        <!-- Quick Actions Dhuafa -->
        <div class="quick-actions">
            <a href="{{ route('admin.kriteria.dhuafa') }}" class="action-card">
                <div class="action-icon" style="background: linear-gradient(135deg, var(--info-color), #138496);">
                    <i class="fas fa-clipboard-list"></i>
                </div>
                <div class="action-content">
                    <div class="action-title">Kriteria Dhuafa</div>
                    <p class="action-desc">Kelola kriteria penilaian</p>
                </div>
            </a>

            <a href="{{ route('admin.subkriteria.dhuafa') }}" class="action-card">
                <div class="action-icon" style="background: linear-gradient(135deg, var(--success-color), #20c997);">
                    <i class="fas fa-list-ul"></i>
                </div>
                <div class="action-content">
                    <div class="action-title">SubKriteria Dhuafa</div>
                    <p class="action-desc">Kelola sub kriteria</p>
                </div>
            </a>

            <a href="{{ route('admin.penilaian.dhuafa') }}" class="action-card">
                <div class="action-icon" style="background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));">
                    <i class="fas fa-edit"></i>
                </div>
                <div class="action-content">
                    <div class="action-title">Penilaian Dhuafa</div>
                    <p class="action-desc">Input penilaian peserta</p>
                </div>
            </a>

        </div>
    </div>

    <!-- SECTION: BEASISWA KADER -->
    <div class="category-section fade-in">
        <div class="category-header">
            <div class="category-title">
                <div class="category-icon kader">
                    <i class="fas fa-user-tie"></i>
                </div>
                <span>Beasiswa Kader</span>
            </div>
            <span class="category-badge kader">
                <i class="fas fa-award"></i> Kategori Kader
            </span>
        </div>

        <!-- Stats Kader -->
        <div class="stats-row">
            <div class="stats-card warning">
                <div class="stats-number warning">
                    <i class="stats-icon-mini fas fa-list-alt"></i>
                    {{ $kriteriaKader ?? 0 }}
                </div>
                <div class="stats-label">Kriteria Kader</div>
            </div>
            <div class="stats-card success">
                <div class="stats-number success">
                    <i class="stats-icon-mini fas fa-tasks"></i>
                    {{ $subKriteriaKader ?? 0 }}
                </div>
                <div class="stats-label">SubKriteria Kader</div>
            </div>
            <div class="stats-card primary">
                <div class="stats-number primary">
                    <i class="stats-icon-mini fas fa-users"></i>
                    {{ $alternatifKader ?? 0 }}
                </div>
                <div class="stats-label">Pendaftar Kader</div>
            </div>
            <div class="stats-card danger">
                <div class="stats-number danger">
                    <i class="stats-icon-mini fas fa-star"></i>
                    {{ $penilaianKader ?? 0 }}
                </div>
                <div class="stats-label">Penilaian Kader</div>
            </div>
        </div>

        <!-- Quick Actions Kader -->
        <div class="quick-actions">
            <a href="{{ route('admin.kriteria.kader') }}" class="action-card">
                <div class="action-icon" style="background: linear-gradient(135deg, var(--warning-color), #fd7e14);">
                    <i class="fas fa-clipboard-list"></i>
                </div>
                <div class="action-content">
                    <div class="action-title">Kriteria Kader</div>
                    <p class="action-desc">Kelola kriteria penilaian</p>
                </div>
            </a>

            <a href="{{ route('admin.subkriteria.kader') }}" class="action-card">
                <div class="action-icon" style="background: linear-gradient(135deg, var(--success-color), #20c997);">
                    <i class="fas fa-list-ul"></i>
                </div>
                <div class="action-content">
                    <div class="action-title">SubKriteria Kader</div>
                    <p class="action-desc">Kelola sub kriteria</p>
                </div>
            </a>

            <a href="{{ route('admin.penilaian.kader') }}" class="action-card">
                <div class="action-icon" style="background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));">
                    <i class="fas fa-edit"></i>
                </div>
                <div class="action-content">
                    <div class="action-title">Penilaian Kader</div>
                    <p class="action-desc">Input penilaian peserta</p>
                </div>
            </a>

        
        </div>
    </div>

    <!-- Quick Access Global -->
    <div class="row">
        <div class="col-md-6 mb-3">
            <a href="{{ route('admin.alternatif.index') }}" class="btn btn-action btn-primary-gradient w-100">
                <i class="fas fa-users"></i>
                Kelola Semua Pendaftar
            </a>
        </div>
    </div>
</div>

<script>
// Animation on load
document.addEventListener('DOMContentLoaded', function() {
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
});
</script>

@endsection