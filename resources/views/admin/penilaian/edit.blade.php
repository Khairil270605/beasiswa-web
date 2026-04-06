@extends('layouts.admin')

@section('title', 'Edit Penilaian - ' . ($alternatif->nama ?? $alternatif->nama_siswa ?? 'Peserta'))

@section('content')
<style>
/* Edit Penilaian Page Styles - LAZISMU DIY Consistent Style */
:root {
    --primary-color: #ff6b35;
    --secondary-color: #f7931e;
    --success-color: #28a745;
    --danger-color: #dc3545;
    --warning-color: #ffc107;
    --info-color: #17a2b8;
}

.edit-penilaian-container {
    padding: 24px;
    background-color: #f8f9fa;
    min-height: 100vh;
}

.page-header {
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
    color: white;
    border-radius: 12px;
    box-shadow: 0 4px 15px rgba(255, 107, 53, 0.3);
    padding: 24px;
    margin-bottom: 24px;
}

.page-title {
    font-size: 1.8rem;
    font-weight: bold;
    margin-bottom: 8px;
    display: flex;
    align-items: center;
}

.page-title i {
    margin-right: 12px;
    font-size: 2rem;
}

.page-subtitle {
    font-size: 1rem;
    opacity: 0.9;
    margin: 0;
}

.breadcrumb-nav {
    background: white;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    padding: 16px 24px;
    margin-bottom: 24px;
}

.breadcrumb {
    margin: 0;
    background: transparent;
    padding: 0;
}

.breadcrumb-item {
    font-size: 0.9rem;
}

.breadcrumb-item.active {
    color: #6c757d;
}

.breadcrumb-item a {
    color: var(--primary-color);
    text-decoration: none;
    transition: color 0.3s ease;
}

.breadcrumb-item a:hover {
    color: var(--secondary-color);
}

.participant-info-card {
    background: white;
    border-radius: 12px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    padding: 24px;
    margin-bottom: 24px;
}

.participant-header {
    display: flex;
    align-items: center;
    gap: 20px;
    margin-bottom: 20px;
    padding-bottom: 20px;
    border-bottom: 2px solid #f8f9fa;
}

.participant-avatar-large {
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: bold;
    font-size: 2rem;
    flex-shrink: 0;
    box-shadow: 0 4px 15px rgba(255, 107, 53, 0.3);
}

.participant-details {
    flex: 1;
}

.participant-name {
    font-size: 1.5rem;
    font-weight: bold;
    color: #495057;
    margin-bottom: 8px;
}

.participant-meta {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 12px;
    color: #6c757d;
}

.participant-meta-item {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 0.9rem;
}

.participant-meta-item i {
    color: var(--primary-color);
    width: 16px;
}

.kategori-badge {
    display: inline-block;
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: bold;
    text-transform: uppercase;
    margin-top: 8px;
}

.kategori-badge.dhuafa {
    background: linear-gradient(135deg, var(--info-color) 0%, #138496 100%);
    color: white;
}

.kategori-badge.kader {
    background: linear-gradient(135deg, var(--warning-color) 0%, #fd7e14 100%);
    color: #212529;
}

.form-container {
    background: white;
    border-radius: 12px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    overflow: hidden;
}

.form-header {
    background: linear-gradient(135deg, #495057 0%, #343a40 100%);
    color: white;
    padding: 20px 24px;
}

.form-title {
    font-size: 1.3rem;
    font-weight: 600;
    margin: 0;
    display: flex;
    align-items: center;
}

.form-title i {
    margin-right: 12px;
}

.form-body {
    padding: 24px;
}

.alert-info {
    background: linear-gradient(135deg, rgba(255, 107, 53, 0.1) 0%, rgba(247, 147, 30, 0.1) 100%);
    border: 1px solid rgba(255, 107, 53, 0.2);
    color: #495057;
    padding: 16px 20px;
    border-radius: 10px;
    margin-bottom: 24px;
    box-shadow: 0 2px 10px rgba(255, 107, 53, 0.1);
}

.alert-info i {
    margin-right: 10px;
    font-size: 1.1rem;
    color: var(--primary-color);
}

.alert-success {
    background: linear-gradient(135deg, rgba(40, 167, 69, 0.1), rgba(40, 167, 69, 0.05));
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

.alert-danger {
    background: linear-gradient(135deg, rgba(220, 53, 69, 0.1), rgba(220, 53, 69, 0.05));
    border: 1px solid rgba(220, 53, 69, 0.2);
    color: #721c24;
    padding: 16px 20px;
    border-radius: 8px;
    margin-bottom: 24px;
    display: flex;
    align-items: center;
}

.alert-danger i {
    margin-right: 10px;
    color: var(--danger-color);
}

.kriteria-section {
    margin-bottom: 32px;
    padding: 24px;
    background: #f8f9fa;
    border-radius: 12px;
    border-left: 5px solid var(--primary-color);
    transition: all 0.3s ease;
}

.kriteria-section:hover {
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    transform: translateY(-2px);
}

.kriteria-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 20px;
}

.kriteria-title {
    font-size: 1.2rem;
    font-weight: bold;
    color: #495057;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 12px;
}

.kriteria-icon {
    width: 40px;
    height: 40px;
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.1rem;
}

.kriteria-bobot {
    background: linear-gradient(135deg, var(--success-color) 0%, #20c997 100%);
    color: white;
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: bold;
    display: flex;
    align-items: center;
    gap: 4px;
}

.kriteria-description {
    color: #6c757d;
    font-size: 0.9rem;
    margin-bottom: 20px;
    line-height: 1.5;
}

.subkriteria-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 16px;
}

.subkriteria-option {
    background: white;
    border: 2px solid #e9ecef;
    border-radius: 10px;
    padding: 20px;
    cursor: pointer;
    transition: all 0.3s ease;
    position: relative;
}

.subkriteria-option:hover {
    border-color: var(--primary-color);
    box-shadow: 0 4px 12px rgba(255, 107, 53, 0.15);
    transform: translateY(-2px);
}

.subkriteria-option.selected {
    border-color: var(--primary-color);
    background: linear-gradient(135deg, rgba(255, 107, 53, 0.05) 0%, rgba(247, 147, 30, 0.05) 100%);
    box-shadow: 0 4px 15px rgba(255, 107, 53, 0.2);
}

.subkriteria-option input[type="radio"] {
    position: absolute;
    opacity: 0;
    cursor: pointer;
}

.subkriteria-content {
    display: flex;
    align-items: center;
    gap: 16px;
}

.subkriteria-radio {
    width: 24px;
    height: 24px;
    border: 2px solid #dee2e6;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    transition: all 0.3s ease;
}

.subkriteria-option.selected .subkriteria-radio {
    border-color: var(--primary-color);
    background: var(--primary-color);
}

.subkriteria-radio::after {
    content: '';
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: white;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.subkriteria-option.selected .subkriteria-radio::after {
    opacity: 1;
}

.subkriteria-info {
    flex: 1;
}

.subkriteria-name {
    font-weight: 600;
    color: #495057;
    margin-bottom: 6px;
    font-size: 1rem;
}

.subkriteria-description {
    color: #6c757d;
    font-size: 0.85rem;
    line-height: 1.4;
    margin-bottom: 8px;
}

.subkriteria-score {
    display: flex;
    align-items: center;
    gap: 8px;
}

.score-badge {
    background: linear-gradient(135deg, var(--warning-color) 0%, #fd7e14 100%);
    color: white;
    padding: 4px 10px;
    border-radius: 12px;
    font-size: 0.8rem;
    font-weight: bold;
    display: flex;
    align-items: center;
    gap: 4px;
}

.score-label {
    color: #6c757d;
    font-size: 0.8rem;
    font-weight: 500;
}

.form-actions {
    background: #f8f9fa;
    padding: 24px;
    border-top: 1px solid #e9ecef;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 16px;
}

.btn-group-actions {
    display: flex;
    gap: 12px;
}

.btn-action {
    padding: 12px 24px;
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
    background: linear-gradient(45deg, #007bff, #0056b3);
    color: white;
}

.btn-primary:hover {
    background: linear-gradient(45deg, #0056b3, #004085);
    color: white;
    text-decoration: none;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,123,255,0.3);
}

.btn-success {
    background: linear-gradient(45deg, var(--success-color), #20c997);
    color: white;
}

.btn-success:hover {
    background: linear-gradient(45deg, #218838, #17a673);
    color: white;
    text-decoration: none;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(40,167,69,0.3);
}

.btn-secondary {
    background-color: #6c757d;
    color: white;
}

.btn-secondary:hover {
    background-color: #545b62;
    color: white;
    text-decoration: none;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(108,117,125,0.3);
}

.btn-outline-secondary {
    background-color: transparent;
    color: #6c757d;
    border: 2px solid #6c757d;
}

.btn-outline-secondary:hover {
    background-color: #6c757d;
    color: white;
    text-decoration: none;
}

.progress-indicator {
    display: flex;
    align-items: center;
    gap: 12px;
    color: #6c757d;
    font-size: 0.9rem;
}

.progress-bar-wrapper {
    width: 200px;
    height: 8px;
    background: #e9ecef;
    border-radius: 4px;
    overflow: hidden;
}

.progress-fill {
    height: 100%;
    background: linear-gradient(90deg, var(--primary-color) 0%, var(--secondary-color) 100%);
    border-radius: 4px;
    transition: width 0.5s ease;
    width: 0%;
}

.validation-error {
    color: var(--danger-color);
    font-size: 0.8rem;
    margin-top: 8px;
    display: flex;
    align-items: center;
    gap: 6px;
}

.validation-error i {
    font-size: 0.9rem;
}

.current-score-display {
    background: white;
    border-radius: 10px;
    padding: 16px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    margin-top: 16px;
}

.current-score-title {
    font-weight: 600;
    color: #495057;
    margin-bottom: 12px;
    display: flex;
    align-items: center;
    gap: 8px;
}

.score-summary {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
    gap: 12px;
}

.score-item {
    text-align: center;
    padding: 12px;
    background: #f8f9fa;
    border-radius: 8px;
}

.score-value {
    font-size: 1.2rem;
    font-weight: bold;
    color: var(--primary-color);
}

.score-name {
    font-size: 0.8rem;
    color: #6c757d;
    margin-top: 4px;
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

/* Responsive */
@media (max-width: 768px) {
    .edit-penilaian-container { padding: 16px; }
    .page-header { padding: 20px; }
    .page-title { font-size: 1.5rem; }
    .participant-header { flex-direction: column; text-align: center; }
    .participant-meta { grid-template-columns: 1fr; }
    .subkriteria-grid { grid-template-columns: 1fr; }
    .form-actions { 
        flex-direction: column; 
        align-items: stretch; 
    }
    .btn-group-actions {
        flex-direction: column;
    }
    .btn-action {
        width: 100%;
        justify-content: center;
    }
    .progress-indicator {
        flex-direction: column;
        gap: 8px;
    }
    .progress-bar-wrapper { width: 100%; }
}

@media (max-width: 576px) {
    .participant-avatar-large { width: 60px; height: 60px; font-size: 1.5rem; }
    .participant-name { font-size: 1.3rem; }
    .kriteria-section { padding: 16px; }
    .subkriteria-content { flex-direction: column; text-align: center; }
    .score-summary { grid-template-columns: repeat(2, 1fr); }
}

/* Print styles */
@media print {
    .form-actions, .breadcrumb-nav { display: none; }
    .edit-penilaian-container { padding: 0; background: white; }
    .form-container { box-shadow: none; }
    .page-header { background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%) !important; -webkit-print-color-adjust: exact; }
}
</style>

<div class="edit-penilaian-container">
    @php
        // Gunakan jenis_pendaftaran dari alternatif (sesuai database schema)
        $jenis = $alternatif->jenis_pendaftaran ?? 'dhuafa';
        $jenisLabel = ucfirst($jenis);
        
        // Tentukan route berdasarkan jenis_pendaftaran
        if ($jenis === 'kader') {
            $backRoute = route('admin.penilaian.kader');
            $kriteriaRoute = route('admin.kriteria.kader');
        } else {
            $backRoute = route('admin.penilaian.dhuafa');
            $kriteriaRoute = route('admin.kriteria.dhuafa');
        }
        
        // Update route shared untuk kedua jenis
        $updateRoute = route('admin.penilaian.update', $alternatif->id);
    @endphp

    <!-- Breadcrumb Navigation -->
    <div class="breadcrumb-nav fade-in">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item">
                    <a href="{{ $backRoute }}">Penilaian {{ $jenisLabel }}</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Edit Penilaian</li>
            </ol>
        </nav>
    </div>

    <!-- Page Header -->
    <div class="page-header fade-in">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="page-title">
                    <i class="fas fa-edit"></i>
                    Edit Penilaian {{ $jenisLabel }}
                </h1>
                <p class="page-subtitle">
                    Ubah penilaian kriteria untuk calon penerima beasiswa kategori {{ $jenisLabel }}
                </p>
            </div>
            <div class="col-md-4 text-md-right mt-3 mt-md-0">
                <div class="progress-indicator">
                    <span>Progress:</span>
                    <div class="progress-bar-wrapper">
                        <div class="progress-fill" id="progress-fill"></div>
                    </div>
                    <span id="progress-text">0%</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Success/Error Messages -->
    @if(session('success'))
    <div class="alert alert-success fade-in">
        <i class="fas fa-check-circle"></i>
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger fade-in">
        <i class="fas fa-exclamation-triangle"></i>
        {{ session('error') }}
    </div>
    @endif

    <!-- Participant Information Card -->
    <div class="participant-info-card fade-in">
        <div class="participant-header">
            <div class="participant-avatar-large">
                {{ strtoupper(substr($alternatif->nama ?? $alternatif->nama_siswa ?? 'N', 0, 1)) }}
            </div>
            <div class="participant-details">
                <h2 class="participant-name">{{ $alternatif->nama ?? $alternatif->nama_siswa ?? 'Nama Peserta' }}</h2>
                <span class="kategori-badge {{ $jenis }}">
                    <i class="fas fa-tag"></i> {{ $jenisLabel }}
                </span>
                <div class="participant-meta">
                    <div class="participant-meta-item">
                        <i class="fas fa-id-card"></i>
                        <span>{{ $alternatif->nisn ?? $alternatif->nim ?? 'N/A' }}</span>
                    </div>
                    <div class="participant-meta-item">
                        <i class="fas fa-envelope"></i>
                        <span>{{ $alternatif->email ?? 'Email tidak tersedia' }}</span>
                    </div>
                    <div class="participant-meta-item">
                        <i class="fas fa-phone"></i>
                        <span>{{ $alternatif->no_hp ?? 'Telepon tidak tersedia' }}</span>
                    </div>
                    <div class="participant-meta-item">
                        <i class="fas fa-calendar-alt"></i>
                        <span>Terdaftar: {{ isset($alternatif->created_at) ? $alternatif->created_at->format('d M Y') : 'N/A' }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Current Score Display -->
        <div class="current-score-display">
            <div class="current-score-title">
                <i class="fas fa-chart-bar"></i>
                Penilaian Saat Ini
            </div>
            <div class="score-summary" id="score-summary">
                @forelse($kriterias ?? [] as $kriteria)
                <div class="score-item">
                    <div class="score-value" id="score-{{ $kriteria->id }}">
                        @if(isset($penilaians[$kriteria->id]) && 
                            $penilaians[$kriteria->id] && 
                            isset($penilaians[$kriteria->id]->subKriteria))
                            {{ $penilaians[$kriteria->id]->subKriteria->nilai ?? 0 }}
                        @else
                            0
                        @endif
                    </div>
                    <div class="score-name">{{ $kriteria->nama_kriteria ?? 'Kriteria' }}</div>
                </div>
                @empty
                <div class="col-12 text-center text-muted">
                    Tidak ada kriteria tersedia
                </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Form Container -->
    <div class="form-container fade-in">
        <div class="form-header">
            <h3 class="form-title">
                <i class="fas fa-clipboard-check"></i>
                Form Penilaian Kriteria
            </h3>
        </div>

        <form action="{{ $updateRoute }}" method="POST" id="penilaian-form">
            @csrf
            @method('PUT')
            <input type="hidden" name="jenis_pendaftaran" value="{{ $jenis }}">
            
            <div class="form-body">
                <div class="alert-info">
                    <i class="fas fa-info-circle"></i>
                    Berikan penilaian untuk setiap kriteria berdasarkan dokumen dan informasi yang telah diberikan oleh peserta. 
                    Pastikan penilaian objektif dan sesuai dengan ketentuan yang berlaku.
                </div>

                @forelse($kriterias ?? [] as $index => $kriteria)
                <div class="kriteria-section" data-kriteria="{{ $kriteria->id }}">
                    <div class="kriteria-header">
                        <div class="kriteria-title">
                            <div class="kriteria-icon">
                                <i class="fas fa-{{ ['star', 'trophy', 'medal', 'award', 'gem'][$index % 5] }}"></i>
                            </div>
                            <div>
                                {{ $kriteria->nama_kriteria ?? 'Kriteria' }}
                                @if(isset($kriteria->keterangan) && $kriteria->keterangan)
                                <div class="kriteria-description">{{ $kriteria->keterangan }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="kriteria-bobot">
                            <i class="fas fa-weight-hanging"></i>
                            Bobot: {{ $kriteria->bobot ?? 0 }}%
                        </div>
                    </div>

                    <div class="subkriteria-grid">
                        @php
                            // Filter subkriteria berdasarkan kriteria_id
                            $filteredSubkriterias = $subkriterias->where('kriteria_id', $kriteria->id);
                        @endphp
                        
                        @forelse($filteredSubkriterias as $subKriteria)
                        <div class="subkriteria-option {{ (isset($penilaians[$kriteria->id]) && 
                                                           $penilaians[$kriteria->id] && 
                                                           isset($penilaians[$kriteria->id]->sub_kriteria_id) &&
                                                           $penilaians[$kriteria->id]->sub_kriteria_id == $subKriteria->id) ? 'selected' : '' }}" 
                             data-kriteria="{{ $kriteria->id }}" 
                             data-subkriteria="{{ $subKriteria->id }}"
                             data-nilai="{{ $subKriteria->nilai ?? 0 }}">
                            
                            <input type="radio" 
                                   name="nilai[{{ $kriteria->id }}]" 
                                   value="{{ $subKriteria->id }}"
                                   {{ (isset($penilaians[$kriteria->id]) && 
                                       $penilaians[$kriteria->id] && 
                                       isset($penilaians[$kriteria->id]->sub_kriteria_id) &&
                                       $penilaians[$kriteria->id]->sub_kriteria_id == $subKriteria->id) ? 'checked' : '' }}>
                            
                            <div class="subkriteria-content">
                                <div class="subkriteria-radio"></div>
                                <div class="subkriteria-info">
                                    <div class="subkriteria-name">{{ $subKriteria->nama_subkriteria ?? 'Subkriteria' }}</div>
                                    @if(isset($subKriteria->keterangan) && $subKriteria->keterangan)
                                    <div class="subkriteria-description">{{ $subKriteria->keterangan }}</div>
                                    @endif
                                    <div class="subkriteria-score">
                                        <div class="score-badge">
                                            <i class="fas fa-star"></i>
                                            {{ $subKriteria->nilai ?? 0 }}
                                        </div>
                                        <span class="score-label">poin</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="col-12 text-center text-muted py-3">
                            Tidak ada subkriteria tersedia untuk {{ $kriteria->nama_kriteria ?? 'kriteria ini' }}
                        </div>
                        @endforelse
                    </div>

                    @error('nilai.' . $kriteria->id)
                    <div class="validation-error">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                @empty
                <div class="empty-state">
                    <div class="empty-icon">
                        <i class="fas fa-clipboard-list"></i>
                    </div>
                    <h4 class="text-muted">Tidak Ada Kriteria Tersedia</h4>
                    <p class="text-muted">Silakan tambahkan kriteria terlebih dahulu sebelum melakukan penilaian.</p>
                    <a href="{{ $kriteriaRoute }}" class="btn-action btn-primary">
                        <i class="fas fa-arrow-left"></i>
                        Kembali ke Daftar Kriteria
                    </a>
                </div>
                @endforelse
            </div>

            <!-- Form Actions -->
            <div class="form-actions">
                <div class="progress-indicator">
                    <i class="fas fa-tasks"></i>
                    <span>Kriteria dinilai: <span id="completed-count">0</span> dari <span id="total-count">{{ count($kriterias ?? []) }}</span></span>
                    <div class="progress-bar-wrapper">
                        <div class="progress-fill" id="criteria-progress"></div>
                    </div>
                </div>
                
                <div class="btn-group-actions">
                    <a href="{{ $backRoute }}" class="btn-action btn-outline-secondary">
                        <i class="fas fa-arrow-left"></i>
                        Kembali
                    </a>
                    <button type="button" class="btn-action btn-secondary" onclick="resetForm()">
                        <i class="fas fa-undo"></i>
                        Reset
                    </button>
                    <button type="submit" class="btn-action btn-success" id="submit-btn">
                        <i class="fas fa-save"></i>
                        Simpan Penilaian
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- JavaScript -->
<script>
let isSubmitting = false;

document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('penilaian-form');
    const subkriteriaOptions = document.querySelectorAll('.subkriteria-option');
    const submitBtn = document.getElementById('submit-btn');
    
    // Initialize
    updateProgress();
    updateScoreSummary();
    
    // Handle subkriteria option clicks
    subkriteriaOptions.forEach(option => {
        option.addEventListener('click', function() {
            const kriteriaId = this.dataset.kriteria;
            const subkriteriaId = this.dataset.subkriteria;
            const nilai = this.dataset.nilai;
            
            // Remove selected class from all options in the same criteria
            const sameKriteriaOptions = document.querySelectorAll(`[data-kriteria="${kriteriaId}"]`);
            sameKriteriaOptions.forEach(opt => opt.classList.remove('selected'));
            
            // Add selected class to clicked option
            this.classList.add('selected');
            
            // Check the radio button
            const radio = this.querySelector('input[type="radio"]');
            if (radio) radio.checked = true;
            
            // Update displays
            updateProgress();
            updateScoreSummary();
            
            // Update score display for this criteria
            const scoreElement = document.getElementById(`score-${kriteriaId}`);
            if (scoreElement) {
                scoreElement.textContent = nilai;
                scoreElement.style.color = '#28a745';
                setTimeout(() => {
                    scoreElement.style.color = '#ff6b35';
                }, 1000);
            }
        });
    });
    
    // Form submission
    if (form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Validate form
            if (!validateForm()) {
                return;
            }
            
            // Prevent double submission
            if (isSubmitting) {
                return;
            }
            
            isSubmitting = true;
            
            // Show loading state
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menyimpan...';
            
            // Submit the form
            this.submit();
        });
    }
    
    function updateProgress() {
        const totalKriteria = document.querySelectorAll('.kriteria-section').length;
        const completedKriteria = document.querySelectorAll('.subkriteria-option.selected').length;
        const percentage = totalKriteria > 0 ? (completedKriteria / totalKriteria) * 100 : 0;
        
        // Update progress bar
        const progressFill = document.getElementById('progress-fill');
        const criteriaProgress = document.getElementById('criteria-progress');
        const progressText = document.getElementById('progress-text');
        const completedCount = document.getElementById('completed-count');
        const totalCount = document.getElementById('total-count');
        
        if (progressFill) progressFill.style.width = percentage + '%';
        if (criteriaProgress) criteriaProgress.style.width = percentage + '%';
        if (progressText) progressText.textContent = Math.round(percentage) + '%';
        if (completedCount) completedCount.textContent = completedKriteria;
        if (totalCount) totalCount.textContent = totalKriteria;
        
        // Update progress bar color based on completion
        const progressElements = [progressFill, criteriaProgress];
        progressElements.forEach(element => {
            if (element) {
                if (percentage === 100) {
                    element.style.background = 'linear-gradient(90deg, #28a745 0%, #20c997 100%)';
                } else if (percentage > 0) {
                    element.style.background = 'linear-gradient(90deg, #ffc107 0%, #fd7e14 100%)';
                } else {
                    element.style.background = 'linear-gradient(90deg, #ff6b35 0%, #f7931e 100%)';
                }
            }
        });
        
        // Update submit button state
        if (submitBtn) {
            if (percentage === 100) {
                submitBtn.classList.remove('btn-secondary', 'btn-primary');
                submitBtn.classList.add('btn-success');
                submitBtn.disabled = false;
            } else if (percentage > 0) {
                submitBtn.classList.remove('btn-secondary', 'btn-success');
                submitBtn.classList.add('btn-primary');
                submitBtn.disabled = false;
            } else {
                submitBtn.classList.add('btn-secondary');
                submitBtn.classList.remove('btn-success', 'btn-primary');
                submitBtn.disabled = false; // Allow partial saves
            }
        }
    }
    
    function updateScoreSummary() {
        const scoreItems = document.querySelectorAll('.score-item');
        let totalScore = 0;
        
        scoreItems.forEach(item => {
            const scoreValue = item.querySelector('.score-value');
            if (scoreValue) {
                const score = parseInt(scoreValue.textContent) || 0;
                totalScore += score;
            }
        });
        
        console.log('Total Score:', totalScore);
    }
    
    function validateForm() {
        const requiredFields = document.querySelectorAll('input[type="radio"]:checked');
        
        if (requiredFields.length === 0) {
            showNotification('Mohon pilih minimal satu penilaian sebelum menyimpan.', 'error');
            return false;
        }
        
        return true;
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
});

// Reset form function
function resetForm() {
    if (confirm('Apakah Anda yakin ingin mereset semua penilaian? Perubahan yang belum disimpan akan hilang.')) {
        // Remove all selected classes
        const selectedOptions = document.querySelectorAll('.subkriteria-option.selected');
        selectedOptions.forEach(option => {
            option.classList.remove('selected');
        });
        
        // Uncheck all radio buttons
        const radioButtons = document.querySelectorAll('input[type="radio"]');
        radioButtons.forEach(radio => {
            radio.checked = false;
        });
        
        // Reset score displays
        const scoreElements = document.querySelectorAll('[id^="score-"]');
        scoreElements.forEach(element => {
            element.textContent = '0';
        });
        
        // Update progress
        updateProgress();
        updateScoreSummary();
        
        // Show notification
        showNotification('Form berhasil direset', 'info');
    }
}

// Notification system
function showNotification(message, type = 'info') {
    const existingNotifications = document.querySelectorAll('.notification');
    existingNotifications.forEach(notif => notif.remove());
    
    const notification = document.createElement('div');
    notification.className = `notification alert-${type} fade-in`;
    notification.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 9999;
        padding: 16px 24px;
        border-radius: 8px;
        color: white;
        font-weight: 500;
        box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        cursor: pointer;
    `;
    
    switch(type) {
        case 'success':
            notification.style.background = 'linear-gradient(135deg, #28a745 0%, #20c997 100%)';
            break;
        case 'error':
            notification.style.background = 'linear-gradient(135deg, #dc3545 0%, #e74c3c 100%)';
            break;
        case 'info':
        default:
            notification.style.background = 'linear-gradient(135deg, #ff6b35 0%, #f7931e 100%)';
            break;
    }
    
    notification.innerHTML = `<i class="fas fa-${type === 'success' ? 'check' : type === 'error' ? 'exclamation-triangle' : 'info'}-circle" style="margin-right: 8px;"></i>${message}`;
    
    document.body.appendChild(notification);
    
    setTimeout(() => {
        if (notification.parentNode) {
            notification.style.opacity = '0';
            notification.style.transform = 'translateX(100%)';
            setTimeout(() => notification.remove(), 300);
        }
    }, 5000);
    
    notification.addEventListener('click', () => {
        notification.style.opacity = '0';
        notification.style.transform = 'translateX(100%)';
        setTimeout(() => notification.remove(), 300);
    });
}

// Keyboard shortcuts
document.addEventListener('keydown', function(e) {
    // Ctrl + S untuk save
    if (e.ctrlKey && e.key === 's') {
        e.preventDefault();
        const form = document.getElementById('penilaian-form');
        if (form && !isSubmitting) {
            const submitBtn = document.getElementById('submit-btn');
            if (submitBtn && !submitBtn.disabled) {
                submitBtn.click();
            }
        }
    }
    
    // Ctrl + R untuk reset
    if (e.ctrlKey && e.key === 'r') {
        e.preventDefault();
        resetForm();
    }
    
    // Escape untuk kembali
    if (e.key === 'Escape') {
        const backBtn = document.querySelector('.btn-outline-secondary');
        if (backBtn && confirm('Apakah Anda yakin ingin keluar? Perubahan yang belum disimpan akan hilang.')) {
            window.location.href = backBtn.href;
        }
    }
});

// Prevent accidental page leave
window.addEventListener('beforeunload', function(e) {
    if (isSubmitting) return;

    const hasChanges = document.querySelectorAll('.subkriteria-option.selected').length > 0;
    if (hasChanges) {
        e.preventDefault();
        e.returnValue = '';
        return 'Anda memiliki perubahan yang belum disimpan. Apakah Anda yakin ingin keluar?';
    }
});

// Initialize tooltips
document.addEventListener('DOMContentLoaded', function() {
    const kriteriaSections = document.querySelectorAll('.kriteria-section');
    kriteriaSections.forEach((section) => {
        section.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-2px)';
        });
        
        section.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });
});

// Helper functions
function updateProgress() {
    const totalKriteria = document.querySelectorAll('.kriteria-section').length;
    const completedKriteria = document.querySelectorAll('.subkriteria-option.selected').length;
    const percentage = totalKriteria > 0 ? (completedKriteria / totalKriteria) * 100 : 0;
    
    const progressFill = document.getElementById('progress-fill');
    const criteriaProgress = document.getElementById('criteria-progress');
    const progressText = document.getElementById('progress-text');
    const completedCount = document.getElementById('completed-count');
    
    if (progressFill) progressFill.style.width = percentage + '%';
    if (criteriaProgress) criteriaProgress.style.width = percentage + '%';
    if (progressText) progressText.textContent = Math.round(percentage) + '%';
    if (completedCount) completedCount.textContent = completedKriteria;
}

function updateScoreSummary() {
    const scoreItems = document.querySelectorAll('.score-item');
    let totalScore = 0;
    
    scoreItems.forEach(item => {
        const scoreValue = item.querySelector('.score-value');
        if (scoreValue) {
            totalScore += parseInt(scoreValue.textContent) || 0;
        }
    });
    
    console.log('Total Score:', totalScore);
}

// Performance monitoring
console.log('📝 Edit Penilaian page loaded successfully!');
console.log('💡 Tips: Use Ctrl+S to save, Ctrl+R to reset, Escape to go back');
console.log(`📊 Total kriteria: ${document.querySelectorAll('.kriteria-section').length}`);
console.log(`🎯 Participant: ${document.querySelector('.participant-name')?.textContent || 'Unknown'}`);
</script>

@endsection