@extends('layouts.admin')

@section('title', 'Data Pendaftar Beasiswa')

@section('content')
<style>
/* CSS dengan konsistensi warna LAZISMU DIY - UNIFIED VERSION */
:root {
    --primary-color: #ff6b35;      /* Orange LAZISMU */
    --secondary-color: #f7931e;    /* Kuning-orange */
    --success-color: #28a745;      /* Hijau */
    --danger-color: #dc3545;       /* Merah */
    --warning-color: #ffc107;      /* Kuning */
    --info-color: #17a2b8;         /* Biru info */
    --light-orange: rgba(255, 107, 53, 0.1);
    --light-secondary: rgba(247, 147, 30, 0.1);
}

.pendaftar-container {
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

.filter-section {
    background: white;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    padding: 20px;
    margin-bottom: 24px;
    transition: all 0.3s ease;
}

.filter-section:hover {
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
    cursor: pointer;
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

.filter-tabs {
    border-bottom: 2px solid #e9ecef;
    margin-bottom: 20px;
    display: flex;
    flex-wrap: wrap;
}
/* Status Administrasi Dropdown */
.form-control-sm {
    width: 100%;
    font-weight: 500;
}

.form-control-sm:focus {
    outline: none;
    border-color: var(--primary-color) !important;
    box-shadow: 0 0 0 0.2rem rgba(255, 107, 53, 0.25) !important;
}

.form-control-sm option {
    padding: 8px;
}

/* Color coding untuk status */
select[name="status_administrasi"] option[value="pending"] {
    background-color: rgba(255, 193, 7, 0.1);
    color: #856404;
}

select[name="status_administrasi"] option[value="lulus"] {
    background-color: rgba(40, 167, 69, 0.1);
    color: #155724;
}

select[name="status_administrasi"] option[value="tidak_lulus"] {
    background-color: rgba(220, 53, 69, 0.1);
    color: #721c24;
}

.filter-tab {
    background: none;
    border: none;
    padding: 12px 24px;
    font-weight: 500;
    color: #6c757d;
    cursor: pointer;
    transition: all 0.3s ease;
    border-bottom: 3px solid transparent;
    margin-right: 4px;
    border-radius: 8px 8px 0 0;
}

.filter-tab.active {
    color: var(--primary-color);
    border-bottom-color: var(--primary-color);
    background: var(--light-orange);
}

.filter-tab:hover {
    color: var(--primary-color);
    background-color: var(--light-orange);
}

.search-box {
    position: relative;
    max-width: 400px;
}

.search-input {
    width: 100%;
    padding: 12px 16px 12px 45px;
    border: 2px solid #e9ecef;
    border-radius: 8px;
    font-size: 0.95rem;
    transition: all 0.3s ease;
}

.search-input:focus {
    outline: none;
    border-color: var(--primary-color);
    box-shadow: 0 0 0 0.2rem rgba(255, 107, 53, 0.25);
}

.search-icon {
    position: absolute;
    left: 16px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--primary-color);
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
    padding: 16px 12px;
    font-weight: 600;
    color: #495057;
    font-size: 0.85rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    text-align: center;
}

.custom-table tbody td {
    padding: 16px 12px;
    border-top: 1px solid #e9ecef;
    vertical-align: middle;
    text-align: center;
}

.custom-table tbody tr {
    transition: all 0.3s ease;
}

.custom-table tbody tr:hover {
    background-color: rgba(255, 107, 53, 0.05);
    transform: scale(1.01);
}

.badge-jenis {
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
}

.badge-kader {
    background-color: rgba(40, 167, 69, 0.1);
    color: var(--success-color);
    border: 1px solid rgba(40, 167, 69, 0.2);
}

.badge-dhuafa {
    background-color: rgba(220, 53, 69, 0.1);
    color: var(--danger-color);
    border: 1px solid rgba(220, 53, 69, 0.2);
}

.action-buttons {
    display: flex;
    gap: 6px;
    justify-content: center;
    align-items: center;
}

.btn-view {
    background-color: var(--info-color);
    color: white;
    padding: 6px 12px;
    border-radius: 6px;
    text-decoration: none;
    font-size: 0.8rem;
    font-weight: 500;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
}

.btn-view:hover {
    background-color: #138496;
    color: white;
    text-decoration: none;
    transform: scale(1.05);
}

.btn-edit {
    background-color: var(--success-color);
    color: white;
    padding: 6px 12px;
    border-radius: 6px;
    text-decoration: none;
    font-size: 0.8rem;
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
    padding: 6px 12px;
    border-radius: 6px;
    font-size: 0.8rem;
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

.stat-number.blue, 
.stat-number.primary { 
    color: var(--primary-color); 
}

.stat-number.info { 
    color: var(--info-color); 
}

.stat-number.danger { 
    color: var(--danger-color); 
}

.stat-number.success { 
    color: var(--success-color); 
}

.stat-number.secondary { 
    color: var(--secondary-color); 
}

.stat-label {
    font-size: 0.9rem;
    color: #6c757d;
    font-weight: 500;
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

.contact-info {
    font-size: 0.85rem;
}

.badge-secondary {
    background-color: var(--secondary-color) !important;
    color: white !important;
    padding: 4px 8px;
    border-radius: 12px;
    font-size: 0.8rem;
    font-weight: 600;
    min-width: 24px;
    text-align: center;
    display: inline-block;
}

/* Modal Styles with LAZISMU Colors */
.detail-modal {
    display: none;
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0,0,0,0.5);
    animation: fadeIn 0.3s ease;
}

.modal-content {
    background-color: white;
    margin: 2% auto;
    padding: 0;
    border-radius: 10px;
    width: 95%;
    max-width: 900px;
    max-height: 90vh;
    overflow-y: auto;
    box-shadow: 0 10px 50px rgba(0,0,0,0.3);
}

.modal-header {
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
    color: white;
    padding: 20px 30px;
    border-radius: 10px 10px 0 0;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.modal-header h2 {
    margin: 0;
    font-size: 1.5rem;
    font-weight: 600;
}

.close-modal {
    color: white;
    font-size: 28px;
    font-weight: bold;
    cursor: pointer;
    background: none;
    border: none;
    padding: 0;
    line-height: 1;
    width: 30px;
    height: 30px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    transition: all 0.3s ease;
}

.close-modal:hover {
    background-color: rgba(255,255,255,0.1);
    transform: rotate(90deg);
}

.modal-body {
    padding: 30px;
}

.detail-section {
    margin-bottom: 30px;
    background: #f8f9fa;
    border-radius: 8px;
    padding: 20px;
    border-left: 4px solid var(--primary-color);
}

.detail-title {
    font-size: 1.2rem;
    font-weight: bold;
    color: var(--primary-color);
    margin-bottom: 16px;
    display: flex;
    align-items: center;
}

.detail-title i {
    margin-right: 10px;
    font-size: 1.1rem;
}

.detail-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 12px;
}

.detail-item {
    display: flex;
    align-items: flex-start;
    padding: 8px 0;
    border-bottom: 1px solid #e9ecef;
}

.detail-item:last-child {
    border-bottom: none;
}

.detail-label {
    font-weight: 600;
    color: #495057;
    width: 140px;
    flex-shrink: 0;
    font-size: 0.9rem;
}

.detail-value {
    color: #212529;
    flex: 1;
    font-size: 0.9rem;
    word-break: break-word;
}

.detail-value.empty {
    color: #6c757d;
    font-style: italic;
}

.badge-status {
    padding: 4px 8px;
    border-radius: 12px;
    font-size: 0.7rem;
    font-weight: 600;
    text-transform: uppercase;
}

.badge-ada {
    background-color: rgba(40, 167, 69, 0.1);
    color: var(--success-color);
    border: 1px solid rgba(40, 167, 69, 0.2);
}

.badge-tidak-ada {
    background-color: rgba(220, 53, 69, 0.1);
    color: var(--danger-color);
    border: 1px solid rgba(220, 53, 69, 0.2);
}

.file-status {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    gap: 4px;
}

.file-actions {
    display: flex;
    gap: 4px;
}

.btn-file-view,
.btn-file-download {
    background-color: var(--primary-color);
    color: white;
    padding: 2px 8px;
    border-radius: 4px;
    text-decoration: none;
    font-size: 0.7rem;
    font-weight: 500;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 4px;
}

.btn-file-view:hover,
.btn-file-download:hover {
    background-color: #e55a2b;
    color: white;
    text-decoration: none;
    transform: scale(1.05);
}

.btn-file-download {
    background-color: var(--success-color);
}

.btn-file-download:hover {
    background-color: #218838;
}

.file-preview-modal {
    display: none;
    position: fixed;
    z-index: 1100;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0,0,0,0.8);
    animation: fadeIn 0.3s ease;
}

.file-preview-content {
    background-color: white;
    margin: 2% auto;
    padding: 0;
    border-radius: 10px;
    width: 95%;
    max-width: 1000px;
    max-height: 95vh;
    overflow: hidden;
    box-shadow: 0 10px 50px rgba(0,0,0,0.5);
}

.file-preview-header {
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
    color: white;
    padding: 15px 25px;
    border-radius: 10px 10px 0 0;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.file-preview-body {
    padding: 0;
    height: calc(95vh - 70px);
    overflow: auto;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #f8f9fa;
}

.file-preview-iframe {
    width: 100%;
    height: 100%;
    border: none;
    background: white;
}

.file-preview-image {
    max-width: 100%;
    max-height: 100%;
    object-fit: contain;
    border-radius: 8px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.1);
}

.file-not-supported {
    text-align: center;
    padding: 60px 20px;
    color: #6c757d;
}

.file-not-supported i {
    font-size: 4rem;
    margin-bottom: 20px;
    color: rgba(255, 107, 53, 0.3);
}

.close-file-modal {
    color: white;
    font-size: 28px;
    font-weight: bold;
    cursor: pointer;
    background: none;
    border: none;
    padding: 0;
    line-height: 1;
    width: 30px;
    height: 30px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    transition: all 0.3s ease;
}

.close-file-modal:hover {
    background-color: rgba(255,255,255,0.1);
    transform: rotate(90deg);
}

/* Animasi untuk loading */
.loading {
    opacity: 0.5;
    pointer-events: none;
}

.fade-in {
    animation: fadeIn 0.3s ease;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
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
.filter-section,
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

/* Responsive */
@media (max-width: 768px) {
    .pendaftar-container { padding: 16px; }
    .page-header { padding: 16px; }
    .filter-section { padding: 16px; }
    .custom-table { font-size: 0.8rem; }
    .action-buttons { flex-direction: column; }
    .action-buttons .btn-view,
    .action-buttons .btn-edit,
    .action-buttons .btn-delete { width: 100%; margin-bottom: 4px; }
    .filter-tabs { flex-direction: column; }
    .filter-tab { width: 100%; text-align: center; margin-bottom: 8px; }
    
    .modal-content { 
        margin: 5% auto;
        width: 98%; 
    }
    .modal-body { padding: 20px; }
    .detail-section { padding: 15px; }
    .detail-grid { grid-template-columns: 1fr; }
}

@media (max-width: 576px) {
    .custom-table thead { display: none; }
    .custom-table tbody td {
        display: block;
        padding: 8px 16px;
        border: none;
        border-bottom: 1px solid #e9ecef;
        text-align: left;
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
        padding: 8px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    .custom-table tbody tr:hover {
        box-shadow: 0 4px 12px rgba(255, 107, 53, 0.15);
    }
}
</style>

<div class="pendaftar-container">
    <!-- Page Header -->
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="page-title">
                    <i class="fas fa-users mr-2"></i>
                    Data Pendaftar Beasiswa
                </h1>
                <p class="page-subtitle">
                    Kelola data pendaftar beasiswa kader dan dhuafa Muhammadiyah
                </p>
            </div>
            <div class="col-md-4 text-md-right">
                <a href="{{ route('admin.alternatif.create') ?? '#' }}" class="btn-add">
                    <i class="fas fa-plus"></i>
                    Tambah Pendaftar
                </a>
            </div>
        </div>
    </div>

    <!-- Success Alert -->
    <!-- @if(session('success'))
    <div class="alert-success">
        <i class="fas fa-check-circle"></i>
        {{ session('success') }}
    </div>
    @endif -->

    <!-- Filter Section -->
    <div class="filter-section">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="filter-tabs d-flex">
                    <button class="filter-tab active" data-filter="all">
                        <i class="fas fa-users mr-1"></i> Semua (<span id="count-all">0</span>)
                    </button>
                    <button class="filter-tab" data-filter="kader">
                        <i class="fas fa-graduation-cap mr-1"></i> Kader (<span id="count-kader">0</span>)
                    </button>
                    <button class="filter-tab" data-filter="dhuafa">
                        <i class="fas fa-hand-holding-heart mr-1"></i> Dhuafa (<span id="count-dhuafa">0</span>)
                    </button>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="search-box">
                    <i class="fas fa-search search-icon"></i>
                    <input type="text" class="search-input" id="searchInput" placeholder="Cari nama, NIM, email...">
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Row -->
    <div class="stats-row">
        <div class="row">
            <div class="col-md-4">
                <div class="stat-item">
                    <div class="stat-number blue" id="total-pendaftar">{{ count($alternatifs ?? []) }}</div>
                    <div class="stat-label">Total Pendaftar</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-item">
                    <div class="stat-number info" id="total-kader">0</div>
                    <div class="stat-label">Beasiswa Kader</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-item">
                    <div class="stat-number danger" id="total-dhuafa">0</div>
                    <div class="stat-label">Beasiswa Dhuafa</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Table Container -->
    <div class="table-container">
        <div class="table-header">
            <h3 class="table-title">
                <i class="fas fa-table"></i>
                <span id="table-title">Daftar Semua Pendaftar Beasiswa</span>
            </h3>
        </div>
        
        <div class="table-responsive">
            <table class="table custom-table">
                <thead>
                    <tr>
                        <th width="8%">No</th>
                        <th width="25%">Nama</th>
                        <th width="20%">Jenis Pendaftaran</th>
                        <th width="25%">Email</th>
                        <th width="20%">Status Administrasi</th>
                        <th width="7%">Aksi</th>
                    </tr>
                </thead>
                @php /** @var \App\Models\Alternatif $alternatif */ @endphp
                <tbody id="pendaftar-table">
                    @forelse($alternatifs ?? [] as $index => $alternatif)
                    <tr class="pendaftar-row" data-jenis="{{ $alternatif->jenis_pendaftaran ?? 'dhuafa' }}" data-search="{{ strtolower(($alternatif->nama ?? 'Nama Siswa') . ' ' . ($alternatif->nim ?? '000000') . ' ' . ($alternatif->email ?? 'email@example.com')) }}">
                        <td data-label="No">
                            <span class="badge badge-secondary">{{ $index + 1 }}</span>
                        </td>
                        <td data-label="Nama">
                            <strong>{{ $alternatif->nama ?? 'Nama Siswa' }}</strong>
                        </td>
                        <td data-label="Jenis Pendaftaran">
                            <span class="badge-jenis {{ ($alternatif->jenis_pendaftaran ?? 'dhuafa') == 'kader' ? 'badge-kader' : 'badge-dhuafa' }}">
                                {{ ucfirst($alternatif->jenis_pendaftaran ?? 'dhuafa') }}
                            </span>
                        </td>
                        <td data-label="Email">
                            <div class="contact-info">
                                <i class="fas fa-envelope"></i> {{ $alternatif->email ?? 'email@example.com' }}
                            </div>
                        </td>
                       <td data-label="Status Administrasi">
                            <form method="POST"
                                action="{{ route('admin.pendaftar.statusAdministrasi', $alternatif->id) }}"
                                style="display:inline;">
                                @csrf
                                <select name="status_administrasi"
                                        class="form-control form-control-sm"
                                        onchange="this.form.submit()"
                                        style="border: 2px solid #e9ecef; border-radius: 6px; padding: 6px 10px; font-size: 0.85rem; transition: all 0.3s ease;">
                                    <option value="pending" {{ ($alternatif->status_administrasi ?? 'pending') == 'pending' ? 'selected' : '' }}>
                                        ⏳ Menunggu verifikasi
                                    </option>
                                    <option value="lulus" {{ ($alternatif->status_administrasi ?? 'pending') == 'lulus' ? 'selected' : '' }}>
                                        ✅ Lulus administrasi
                                    </option>
                                    <option value="tidak_lulus" {{ ($alternatif->status_administrasi ?? 'pending') == 'tidak_lulus' ? 'selected' : '' }}>
                                        ❌ Tidak lulus administrasi
                                    </option>
                                </select>
                            </form>
                        </td>
                        <td data-label="Aksi">
                            <div class="action-buttons">
                                <button class="btn-view" onclick="viewDetail({{ json_encode($alternatif ?? []) }})">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <a href="{{ route('admin.alternatif.edit', $alternatif->id ?? 1) ?? '#' }}" class="btn-edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.alternatif.destroy', $alternatif->id) }}" method="POST" class="d-inline" 
                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus pendaftar ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr id="empty-state">
                        <td colspan="6">
                            <div class="empty-state">
                                <div class="empty-icon">
                                    <i class="fas fa-user-graduate"></i>
                                </div>
                                <div class="empty-title">Belum Ada Data Pendaftar</div>
                                <div class="empty-text">
                                    Mulai dengan menambahkan data pendaftar beasiswa pertama.
                                </div>
                                <a href="{{ route('admin.alternatif.create') ?? '#' }}" class="btn-add">
                                    <i class="fas fa-plus"></i>
                                    Tambah Pendaftar Pertama
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

<!-- File Preview Modal -->
<div id="filePreviewModal" class="file-preview-modal">
    <div class="file-preview-content">
        <div class="file-preview-header">
            <h3 id="file-preview-title">Preview File</h3>
            <button class="close-file-modal" onclick="closeFilePreview()">&times;</button>
        </div>
        <div class="file-preview-body" id="file-preview-body">
            <!-- File content will be loaded here -->
        </div>
    </div>
</div>

<!-- Detail Modal -->
<div id="detailModal" class="detail-modal">
    <div class="modal-content">
        <div class="modal-header">
            <h2 id="modal-title">Detail Pendaftar</h2>
            <button class="close-modal" onclick="closeModal()">&times;</button>
        </div>
        <div class="modal-body" id="modal-body">
            <!-- Content will be loaded dynamically -->
        </div>
    </div>
</div>

<!-- Font Awesome untuk Icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<!-- JavaScript untuk Filter dan Search -->

<script>
// JavaScript untuk Filter dan Search Tabel
document.addEventListener('DOMContentLoaded', function() {
    const filterTabs = document.querySelectorAll('.filter-tab');
    const searchInput = document.getElementById('searchInput');
    const tableRows = document.querySelectorAll('.pendaftar-row');
    const tableTitle = document.getElementById('table-title');
    
    let currentFilter = 'all';
    
    // Initialize counts saat halaman load
    updateCounts();
    
    // Event listener untuk filter tabs
    filterTabs.forEach(tab => {
        tab.addEventListener('click', function() {
            // Remove active class dari semua tabs
            filterTabs.forEach(t => t.classList.remove('active'));
            
            // Add active class ke tab yang diklik
            this.classList.add('active');
            
            currentFilter = this.dataset.filter;
            applyFilters();
        });
    });
    
    // Event listener untuk search input
    searchInput.addEventListener('keyup', function() {
        applyFilters();
    });
    
    // Fungsi utama untuk apply filter dan search
    function applyFilters() {
        const searchTerm = searchInput.value.toLowerCase();
        let visibleCount = 0;
        
        // Add loading effect
        document.querySelector('.table-container').classList.add('loading');
        
        setTimeout(() => {
            tableRows.forEach((row, index) => {
                const jenis = row.dataset.jenis;
                const searchData = row.dataset.search;
                
                let showRow = true;
                
                // Apply filter berdasarkan jenis
                if (currentFilter !== 'all' && jenis !== currentFilter) {
                    showRow = false;
                }
                
                // Apply search berdasarkan search term
                if (searchTerm && !searchData.includes(searchTerm)) {
                    showRow = false;
                }
                
                if (showRow) {
                    row.style.display = '';
                    row.classList.add('fade-in');
                    visibleCount++;
                    // Update nomor urut
                    const numberCell = row.querySelector('[data-label="No"] .badge, td:first-child .badge');
                    if (numberCell) numberCell.textContent = visibleCount;
                } else {
                    row.style.display = 'none';
                    row.classList.remove('fade-in');
                }
            });
            
            // Update judul tabel
            updateTableTitle(visibleCount);
            
            // Show/hide empty state jika tidak ada data
            const emptyState = document.getElementById('empty-state');
            if (emptyState) {
                emptyState.style.display = visibleCount === 0 ? '' : 'none';
            }
            
            // Remove loading effect
            document.querySelector('.table-container').classList.remove('loading');
        }, 100);
    }
    
    // Update judul tabel berdasarkan filter dan jumlah data
    function updateTableTitle(visibleCount) {
        let title = 'Daftar ';
        switch (currentFilter) {
            case 'kader':
                title += 'Pendaftar Beasiswa Kader';
                break;
            case 'dhuafa':
                title += 'Pendaftar Beasiswa Dhuafa';
                break;
            default:
                title += 'Semua Pendaftar Beasiswa';
        }
        title += ` (${visibleCount} data)`;
        tableTitle.textContent = title;
    }
    
    // Update counts di tabs dan statistics
    function updateCounts() {
        const allCount = tableRows.length;
        const kaderCount = document.querySelectorAll('[data-jenis="kader"]').length;
        const dhuafaCount = document.querySelectorAll('[data-jenis="dhuafa"]').length;
        
        // Update count di tabs
        const countAll = document.getElementById('count-all');
        const countKader = document.getElementById('count-kader');
        const countDhuafa = document.getElementById('count-dhuafa');
        
        if (countAll) countAll.textContent = allCount;
        if (countKader) countKader.textContent = kaderCount;
        if (countDhuafa) countDhuafa.textContent = dhuafaCount;
        
        // Update count di statistics section
        const totalPendaftar = document.getElementById('total-pendaftar');
        const totalKader = document.getElementById('total-kader');
        const totalDhuafa = document.getElementById('total-dhuafa');
        
        if (totalPendaftar) totalPendaftar.textContent = allCount;
        if (totalKader) totalKader.textContent = kaderCount;
        if (totalDhuafa) totalDhuafa.textContent = dhuafaCount;
    }
    
    // Animation saat load halaman
    const cards = document.querySelectorAll('.page-header, .filter-section, .stats-row, .table-container');
    cards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        setTimeout(() => {
            card.style.transition = 'all 0.5s ease';
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, index * 100);
    });
    
    // Event listener untuk menutup modal dengan tombol ESC
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape' || event.key === 'Esc') {
            closeModal();
            closeFilePreview();
        }
    });
});

// Function untuk menutup detail modal
function closeModal() {
    const modal = document.getElementById('detailModal');
    modal.style.display = 'none';
}

// Function untuk menutup file preview modal
function closeFilePreview() {
    const filePreviewModal = document.getElementById('filePreviewModal');
    const filePreviewBody = document.getElementById('file-preview-body');
    
    // Clear content
    filePreviewBody.innerHTML = '';
    
    // Hide modal
    filePreviewModal.style.display = 'none';
}

// Base URL untuk file
window.fileBaseUrl = "{{ asset('storage') }}";
console.log('File base URL:', window.fileBaseUrl);

// Function untuk menampilkan detail modal
function viewDetail(alternatif) {
    const modal = document.getElementById('detailModal');
    const modalTitle = document.getElementById('modal-title');
    const modalBody = document.getElementById('modal-body');
    
    // Set title
    modalTitle.textContent = `Detail Pendaftar: ${alternatif.nama || 'Nama Siswa'}`;
    
    // Function helper untuk format value
    function formatValue(value, defaultValue = 'Tidak diisi') {
        if (value === null || value === undefined || value === '' || value === 'null') {
            return `<span class="detail-value empty">${defaultValue}</span>`;
        }
        return `<span class="detail-value">${value}</span>`;
    }
    
    function formatFileStatus(value, filename = '', columnName = '') {
        console.log(`File ${columnName}:`, value);
        
        if (!value || value === null || value === undefined || value === '' || value === 'null') {
            return `<span class="badge-status badge-tidak-ada">Tidak Ada</span>`;
        }
        
        let fileIcon = 'fas fa-file';
        let fileExtension = '';
        if (value) {
            fileExtension = value.split('.').pop().toLowerCase();
            switch(fileExtension) {
                case 'pdf':
                    fileIcon = 'fas fa-file-pdf text-danger';
                    break;
                case 'jpg':
                case 'jpeg':
                case 'png':
                case 'gif':
                case 'webp':
                    fileIcon = 'fas fa-file-image text-info';
                    break;
                case 'doc':
                case 'docx':
                    fileIcon = 'fas fa-file-word text-primary';
                    break;
                default:
                    fileIcon = 'fas fa-file text-secondary';
            }
        }
        
        return `
            <div class="file-status">
                <span class="badge-status badge-ada">Ada</span>
                <div class="file-actions mt-1">
                    <button class="btn-file-view" onclick="viewFile('${value}', '${filename}', '${columnName}')" title="Lihat File">
                        <i class="${fileIcon}"></i> Lihat
                    </button>
                    <a href="${window.fileBaseUrl}/${value}" class="btn-file-download" target="_blank" title="Download File">
                        <i class="fas fa-download"></i> Download
                    </a>
                </div>
            </div>
        `;
    }
    
    function formatCurrency(value) {
        if (value === null || value === undefined || value === '' || value === 'null') {
            return formatValue(value, 'Tidak diisi');
        }
        const formatted = parseInt(value).toLocaleString('id-ID');
        return `<span class="detail-value">Rp ${formatted}</span>`;
    }
    
    // Create modal content
    const modalContent = `
        <!-- Data Pribadi -->
        <div class="detail-section">
            <div class="detail-title">
                <i class="fas fa-user"></i>
                Data Pribadi
            </div>
            <div class="detail-grid">
                <div class="detail-item">
                    <span class="detail-label">Nama:</span>
                    ${formatValue(alternatif.nama)}
                </div>
                <div class="detail-item">
                    <span class="detail-label">NIK:</span>
                    ${formatValue(alternatif.nik)}
                </div>
                <div class="detail-item">
                    <span class="detail-label">Tempat Lahir:</span>
                    ${formatValue(alternatif.tempat_lahir)}
                </div>
                <div class="detail-item">
                    <span class="detail-label">Tanggal Lahir:</span>
                    ${formatValue(alternatif.tanggal_lahir)}
                </div>
                <div class="detail-item">
                    <span class="detail-label">Jenis Kelamin:</span>
                    ${formatValue(alternatif.jenis_kelamin)}
                </div>
                <div class="detail-item">
                    <span class="detail-label">Alamat:</span>
                    ${formatValue(alternatif.alamat)}
                </div>
                <div class="detail-item">
                    <span class="detail-label">No Telepon:</span>
                    ${formatValue(alternatif.no_telepon)}
                </div>
                <div class="detail-item">
                    <span class="detail-label">Email:</span>
                    ${formatValue(alternatif.email)}
                </div>
            </div>
        </div>

        <!-- Data Akademik -->
        ${(
            alternatif.nim ||
            alternatif.kelas ||
            alternatif.semester ||
            alternatif.fakultas ||
            alternatif.jurusan ||
            alternatif.ipk ||
            alternatif.tahun_masuk ||
            alternatif.prestasi ||
            alternatif.asal_kampus
        ) ? `
        <div class="detail-section">
            <div class="detail-title">
                <i class="fas fa-graduation-cap"></i>
                Data Akademik
            </div>
            <div class="detail-grid">
                <div class="detail-item">
                    <span class="detail-label">Asal Kampus:</span>
                    ${formatValue(alternatif.asal_kampus)}
                </div>
                <div class="detail-item">
                    <span class="detail-label">NIM:</span>
                    ${formatValue(alternatif.nim)}
                </div>
                <div class="detail-item">
                    <span class="detail-label">Kelas:</span>
                    ${formatValue(alternatif.kelas)}
                </div>
                <div class="detail-item">
                    <span class="detail-label">Semester:</span>
                    ${formatValue(alternatif.semester)}
                </div>
                <div class="detail-item">
                    <span class="detail-label">Fakultas:</span>
                    ${formatValue(alternatif.fakultas)}
                </div>
                <div class="detail-item">
                    <span class="detail-label">Jurusan:</span>
                    ${formatValue(alternatif.jurusan)}
                </div>
                <div class="detail-item">
                    <span class="detail-label">IPK:</span>
                    ${formatValue(alternatif.ipk)}
                </div>
                <div class="detail-item">
                    <span class="detail-label">Tahun Masuk:</span>
                    ${formatValue(alternatif.tahun_masuk)}
                </div>
                <div class="detail-item">
                    <span class="detail-label">Prestasi:</span>
                    ${formatValue(alternatif.prestasi)}
                </div>
            </div>
        </div>
        ` : ''}

        <!-- Data Organisasi - Hanya untuk Kader -->
        ${(alternatif.jenis_pendaftaran === 'kader') ? `
        <div class="detail-section">
            <div class="detail-title">
                <i class="fas fa-users-cog"></i>
                Data Organisasi Muhammadiyah
            </div>
            <div class="detail-grid">
                <div class="detail-item">
                    <span class="detail-label">Jenis Organisasi:</span>
                    ${formatValue(alternatif.jenis_organisasi)}
                </div>
                <div class="detail-item">
                    <span class="detail-label">Nama Organisasi:</span>
                    ${formatValue(alternatif.nama_organisasi)}
                </div>
                <div class="detail-item">
                    <span class="detail-label">Jabatan:</span>
                    ${formatValue(alternatif.jabatan)}
                </div>
                <div class="detail-item">
                    <span class="detail-label">Tahun Bergabung:</span>
                    ${formatValue(alternatif.tahun_bergabung)}
                </div>
                ${alternatif.riwayat_aktivitas ? `
                <div class="detail-item">
                    <span class="detail-label">Riwayat Aktivitas:</span>
                    ${formatValue(alternatif.riwayat_aktivitas)}
                </div>
                ` : ''}
                ${alternatif.kontribusi ? `
                <div class="detail-item">
                    <span class="detail-label">Kontribusi:</span>
                    ${formatValue(alternatif.kontribusi)}
                </div>
                ` : ''}
                ${alternatif.rencana_masa_depan ? `
                <div class="detail-item">
                    <span class="detail-label">Rencana Masa Depan:</span>
                    ${formatValue(alternatif.rencana_masa_depan)}
                </div>
                ` : ''}
            </div>
        </div>
        ` : ''}

        <!-- Data Keluarga -->
        <div class="detail-section">
            <div class="detail-title">
                <i class="fas fa-home"></i>
                Data Keluarga
            </div>
            <div class="detail-grid">
                <div class="detail-item">
                    <span class="detail-label">Nama Ayah:</span>
                    ${formatValue(alternatif.nama_ayah)}
                </div>
                <div class="detail-item">
                    <span class="detail-label">Pekerjaan Ayah:</span>
                    ${formatValue(alternatif.pekerjaan_ayah)}
                </div>
                <div class="detail-item">
                    <span class="detail-label">Penghasilan Ayah:</span>
                    ${formatCurrency(alternatif.penghasilan_ayah)}
                </div>
                <div class="detail-item">
                    <span class="detail-label">Nama Ibu:</span>
                    ${formatValue(alternatif.nama_ibu)}
                </div>
                <div class="detail-item">
                    <span class="detail-label">Pekerjaan Ibu:</span>
                    ${formatValue(alternatif.pekerjaan_ibu)}
                </div>
                <div class="detail-item">
                    <span class="detail-label">Penghasilan Ibu:</span>
                    ${formatCurrency(alternatif.penghasilan_ibu)}
                </div>
                <div class="detail-item">
                    <span class="detail-label">Jumlah Tanggungan:</span>
                    ${formatValue(alternatif.jumlah_tanggungan)}
                </div>
                <div class="detail-item">
                    <span class="detail-label">Status Rumah:</span>
                    ${formatValue(alternatif.status_rumah)}
                </div>
                <div class="detail-item">
                    <span class="detail-label">Kondisi Ekonomi:</span>
                    ${formatValue(alternatif.kondisi_ekonomi)}
                </div>
            </div>
        </div>

        <!-- Data Dokumen Utama -->
        <div class="detail-section">
            <div class="detail-title">
                <i class="fas fa-file-alt"></i>
                Status Dokumen Utama
            </div>
            <div class="detail-grid">
                <div class="detail-item">
                    <span class="detail-label">KTP:</span>
                    ${formatFileStatus(alternatif.ktp, 'KTP', 'ktp')}
                </div>
                <div class="detail-item">
                    <span class="detail-label">Kartu Keluarga:</span>
                    ${formatFileStatus(alternatif.kk, 'Kartu Keluarga', 'kk')}
                </div>
                <div class="detail-item">
                    <span class="detail-label">Transkrip Nilai:</span>
                    ${formatFileStatus(alternatif.transkrip, 'Transkrip Nilai', 'transkrip')}
                </div>
                <div class="detail-item">
                    <span class="detail-label">Surat Penghasilan:</span>
                    ${formatFileStatus(alternatif.surat_penghasilan, 'Surat Penghasilan', 'surat_penghasilan')}
                </div>
                
                ${(alternatif.jenis_pendaftaran === 'kader') ? `
                <div class="detail-item">
                    <span class="detail-label">Surat Aktif Organisasi:</span>
                    ${formatFileStatus(alternatif.surat_aktif_organisasi, 'Surat Aktif Organisasi', 'surat_aktif_organisasi')}
                </div>
                <div class="detail-item">
                    <span class="detail-label">Sertifikat Prestasi:</span>
                    ${formatFileStatus(alternatif.sertifikat_prestasi, 'Sertifikat Prestasi', 'sertifikat_prestasi')}
                </div>
                <div class="detail-item">
                    <span class="detail-label">Surat Rekomendasi:</span>
                    ${formatFileStatus(alternatif.surat_rekomendasi, 'Surat Rekomendasi', 'surat_rekomendasi')}
                </div>
                <div class="detail-item">
                    <span class="detail-label">KTAM:</span>
                    ${formatFileStatus(alternatif.ktam, 'KTAM', 'ktam')}
                </div>
                ` : ''}
                
                ${(alternatif.jenis_pendaftaran === 'dhuafa') ? `
                <div class="detail-item">
                    <span class="detail-label">Surat Tidak Mampu:</span>
                    ${formatFileStatus(alternatif.surat_tidak_mampu, 'Surat Tidak Mampu', 'surat_tidak_mampu')}
                </div>
                ` : ''}
            </div>
        </div>

        <!-- Dokumen Tambahan -->
        <div class="detail-section">
            <div class="detail-title">
                <i class="fas fa-folder-open"></i>
                Dokumen Tambahan
            </div>
            <div class="detail-grid">
                <div class="detail-item">
                    <span class="detail-label">Surat Tidak Menerima Beasiswa:</span>
                    ${formatFileStatus(alternatif.surat_tidak_menerima_beasiswa, 'Surat Tidak Menerima Beasiswa', 'surat_tidak_menerima_beasiswa')}
                </div>
                <div class="detail-item">
                    <span class="detail-label">Slip Gaji Orang Tua:</span>
                    ${formatFileStatus(alternatif.slip_gaji_ortu, 'Slip Gaji Orang Tua', 'slip_gaji_ortu')}
                </div>
                <div class="detail-item">
                    <span class="detail-label">CV:</span>
                    ${formatFileStatus(alternatif.cv, 'CV', 'cv')}
                </div>
                <div class="detail-item">
                    <span class="detail-label">Pas Foto 3x4:</span>
                    ${formatFileStatus(alternatif.pas_foto, 'Pas Foto', 'pas_foto')}
                </div>
                <div class="detail-item">
                    <span class="detail-label">Motivation Letter:</span>
                    ${formatFileStatus(alternatif.motivation_letter, 'Motivation Letter', 'motivation_letter')}
                </div>
                <div class="detail-item">
                    <span class="detail-label">Kartu Tanda Mahasiswa:</span>
                    ${formatFileStatus(alternatif.ktm, 'KTM', 'ktm')}
                </div>
                <div class="detail-item">
                    <span class="detail-label">Twibbon:</span>
                    ${formatFileStatus(alternatif.twibbon, 'Twibbon', 'twibbon')}
                </div>
                <div class="detail-item">
            <span class="detail-label">Bukti Twibbon (Screenshot):</span>
            ${formatFileStatus(alternatif.bukti_twibbon, 'Bukti Twibbon', 'bukti_twibbon')}
                 </div>
                <div class="detail-item">
                    <span class="detail-label">Surat Kesanggupan Relawan:</span>
                    ${formatFileStatus(alternatif.surat_kesanggupan_relawan, 'Surat Kesanggupan Relawan', 'surat_kesanggupan_relawan')}
                </div>
            </div>
        </div>

        <!-- Foto Kondisi Rumah -->
        <div class="detail-section">
            <div class="detail-title">
                <i class="fas fa-home"></i>
                Foto Kondisi Rumah
            </div>
            <div class="detail-grid">
                <div class="detail-item">
                    <span class="detail-label">Tampak Depan:</span>
                    ${formatFileStatus(alternatif.foto_rumah_depan, 'Foto Rumah Depan', 'foto_rumah_depan')}
                </div>
                <div class="detail-item">
                    <span class="detail-label">Tampak Samping:</span>
                    ${formatFileStatus(alternatif.foto_rumah_samping, 'Foto Rumah Samping', 'foto_rumah_samping')}
                </div>
                <div class="detail-item">
                    <span class="detail-label">Ruang Tamu:</span>
                    ${formatFileStatus(alternatif.foto_ruang_tamu, 'Foto Ruang Tamu', 'foto_ruang_tamu')}
                </div>
                <div class="detail-item">
                    <span class="detail-label">Kamar Mandi:</span>
                    ${formatFileStatus(alternatif.foto_kamar_mandi, 'Foto Kamar Mandi', 'foto_kamar_mandi')}
                </div>
                <div class="detail-item">
                    <span class="detail-label">Dapur:</span>
                    ${formatFileStatus(alternatif.foto_dapur, 'Foto Dapur', 'foto_dapur')}
                </div>
            </div>
        </div>

        <!-- Jenis Pendaftaran -->
        <div class="detail-section">
            <div class="detail-title">
                <i class="fas fa-clipboard-check"></i>
                Informasi Pendaftaran
            </div>
            <div class="detail-grid">
                <div class="detail-item">
                    <span class="detail-label">Jenis Pendaftaran:</span>
                    <span class="badge-jenis ${(alternatif.jenis_pendaftaran || 'dhuafa') == 'kader' ? 'badge-kader' : 'badge-dhuafa'}">
                        ${alternatif.jenis_pendaftaran
                            ? alternatif.jenis_pendaftaran.charAt(0).toUpperCase() + alternatif.jenis_pendaftaran.slice(1)
                            : 'Dhuafa'}
                    </span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Tanggal Daftar:</span>
                    ${formatValue(alternatif.created_at ? new Date(alternatif.created_at).toLocaleDateString('id-ID') : null)}
                </div>
                <div class="detail-item">
                    <span class="detail-label">Terakhir Update:</span>
                    ${formatValue(alternatif.updated_at ? new Date(alternatif.updated_at).toLocaleDateString('id-ID') : null)}
                </div>
            </div>
        </div>
    `;
    
    // Set modal body content
    modalBody.innerHTML = modalContent;
    
    // Show modal
    modal.style.display = 'block';
    
    // Add event listener untuk close modal ketika klik di luar modal
    modal.onclick = function(event) {
        if (event.target === modal) {
            closeModal();
        }
    }
}

// Function untuk preview file
function viewFile(filename, displayName, columnName) {
    const filePreviewModal = document.getElementById('filePreviewModal');
    const filePreviewTitle = document.getElementById('file-preview-title');
    const filePreviewBody = document.getElementById('file-preview-body');
    
    console.log('viewFile called with:', {
        filename: filename,
        displayName: displayName,
        columnName: columnName,
        baseUrl: window.fileBaseUrl
    });
    
    if (!filename || filename === 'null' || filename === null) {
        alert('File tidak tersedia');
        return;
    }
    
    // Set title
    filePreviewTitle.textContent = `Preview: ${displayName}`;
    
    // Get file extension
    const fileExtension = filename.split('.').pop().toLowerCase();
    
    const filePath = `${window.fileBaseUrl}/${filename}`;
    
    console.log('File path:', filePath);
    
    let previewContent = '';
    
    // Show loading first
    filePreviewBody.innerHTML = `
        <div class="file-not-supported">
            <i class="fas fa-spinner fa-spin"></i>
            <h4>Memuat file...</h4>
            <p>Mohon tunggu sebentar.</p>
            <small>Path: ${filePath}</small>
        </div>
    `;
    
    // Handle different file types
    setTimeout(() => {
        switch(fileExtension) {
            case 'pdf':
                previewContent = `
                    <iframe class="file-preview-iframe" src="${filePath}" type="application/pdf">
                        <div class="file-not-supported">
                            <i class="fas fa-file-pdf"></i>
                            <h4>PDF Preview tidak tersedia</h4>
                            <p>Browser Anda tidak mendukung preview PDF inline.</p>
                            <p><small>File: ${filename}</small></p>
                            <div style="margin-top: 15px;">
                                <a href="${filePath}" class="btn-file-download" target="_blank">
                                    <i class="fas fa-external-link-alt"></i> Buka di Tab Baru
                                </a>
                            </div>
                        </div>
                    </iframe>
                `;
                break;
                
            case 'jpg':
            case 'jpeg':
            case 'png':
            case 'gif':
            case 'webp':
                previewContent = `
                    <img class="file-preview-image" src="${filePath}" alt="${displayName}" 
                         onload="console.log('Image loaded successfully: ${filename}')"
                         onerror="console.error('Failed to load image: ${filename}'); this.parentElement.innerHTML='<div class=\\"file-not-supported\\"><i class=\\"fas fa-image\\"></i><h4>Gambar tidak dapat dimuat</h4><p>File: ${filename}</p><p>Path: <code>${filePath}</code></p><div style=\\"margin-top: 15px;\\"><a href=\\"${filePath}\\" class=\\"btn-file-download\\" target=\\"_blank\\"><i class=\\"fas fa-external-link-alt\\"></i> Coba Buka di Tab Baru</a></div></div>'">
                `;
                break;
                
            case 'doc':
            case 'docx':
                previewContent = `
                    <div class="file-not-supported">
                        <i class="fas fa-file-word"></i>
                        <h4>Preview Dokumen Word</h4>
                        <p>File: ${filename}</p>
                        <p>Untuk melihat dokumen ini, gunakan salah satu opsi berikut:</p>
                        <div style="margin-top: 20px; display: flex; gap: 10px; flex-wrap: wrap; justify-content: center;">
                            <a href="${filePath}" class="btn-file-download" target="_blank">
                                <i class="fas fa-download"></i> Download File
                            </a>
                            <a href="https://view.officeapps.live.com/op/view.aspx?src=${encodeURIComponent(window.location.origin + filePath)}" 
                               class="btn-file-view" target="_blank">
                                <i class="fas fa-external-link-alt"></i> Office Online
                            </a>
                        </div>
                    </div>
                `;
                break;
                
            default:
                previewContent = `
                    <div class="file-not-supported">
                        <i class="fas fa-file"></i>
                        <h4>Preview tidak tersedia</h4>
                        <p>File dengan format .${fileExtension} tidak dapat di-preview secara langsung.</p>
                        <p>File: ${filename}</p>
                        <p>Path: <code>${filePath}</code></p>
                        <div style="margin-top: 15px;">
                            <a href="${filePath}" class="btn-file-download" target="_blank">
                                <i class="fas fa-download"></i> Download / Buka File
                            </a>
                        </div>
                    </div>
                `;
                break;
        }
        
        // Set content
        filePreviewBody.innerHTML = previewContent;
    }, 300);
    
    // Show modal
    filePreviewModal.style.display = 'block';
    
    // Close modal when clicking outside
    filePreviewModal.onclick = function(event) {
        if (event.target === filePreviewModal) {
            closeFilePreview();
        }
    }
}
</script>
@endsection