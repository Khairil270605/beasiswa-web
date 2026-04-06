@extends('layouts.admin')

@section('title', 'Laporan Hasil Seleksi Dhuafa')

@section('content')
<style>
/* Laporan Dhuafa Styles - LAZISMU DIY */
:root {
    --primary-color: #ff6b35;
    --secondary-color: #f7931e;
    --success-color: #28a745;
    --danger-color: #dc3545;
    --info-color: #17a2b8;
}

.laporan-container {
    padding: 24px;
    background-color: #f8f9fa;
    min-height: 100vh;
}

/* Page Header */
.page-header {
    background: white;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    padding: 24px;
    margin-bottom: 24px;
    animation: slideInUp 0.5s ease-out;
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
    font-size: 0.95rem;
    margin: 0;
}

/* Filter Card */
.filter-card {
    background: white;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    padding: 24px;
    margin-bottom: 24px;
    animation: slideInUp 0.5s ease-out 0.1s backwards;
}

.filter-header {
    background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
    color: white;
    padding: 12px 20px;
    border-radius: 8px;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
}

.filter-header i {
    margin-right: 10px;
    font-size: 1.1rem;
}

.filter-header h5 {
    margin: 0;
    font-weight: 600;
    font-size: 1.1rem;
}

.filter-row {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 16px;
    margin-bottom: 20px;
}

.form-group {
    margin-bottom: 0;
}

.form-label {
    font-weight: 600;
    color: #495057;
    margin-bottom: 8px;
    font-size: 0.9rem;
    display: flex;
    align-items: center;
}

.form-label i {
    color: var(--primary-color);
    margin-right: 6px;
    font-size: 0.85rem;
}

.form-control, .form-select {
    border: 2px solid #e9ecef;
    border-radius: 8px;
    padding: 10px 14px;
    transition: all 0.3s ease;
}

.form-control:focus, .form-select:focus {
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px rgba(255, 107, 53, 0.1);
}

.filter-actions {
    display: flex;
    gap: 12px;
    justify-content: flex-end;
}

/* Statistics Cards */
.stats-row {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
    gap: 20px;
    margin-bottom: 24px;
}

.stat-card {
    background: white;
    border-radius: 10px;
    padding: 20px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    display: flex;
    align-items: center;
    transition: all 0.3s ease;
    animation: slideInUp 0.5s ease-out backwards;
}

.stat-card:nth-child(1) { animation-delay: 0.2s; }
.stat-card:nth-child(2) { animation-delay: 0.3s; }
.stat-card:nth-child(3) { animation-delay: 0.4s; }
.stat-card:nth-child(4) { animation-delay: 0.5s; }

.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 4px 20px rgba(255, 107, 53, 0.2);
}

.stat-icon {
    width: 60px;
    height: 60px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    margin-right: 16px;
}

.stat-icon.primary {
    background: linear-gradient(135deg, rgba(255, 107, 53, 0.2), rgba(247, 147, 30, 0.2));
    color: var(--primary-color);
}

.stat-icon.success {
    background: rgba(40, 167, 69, 0.15);
    color: var(--success-color);
}

.stat-icon.danger {
    background: rgba(220, 53, 69, 0.15);
    color: var(--danger-color);
}

.stat-icon.info {
    background: rgba(23, 162, 184, 0.15);
    color: var(--info-color);
}

.stat-content h3 {
    font-size: 1.8rem;
    font-weight: bold;
    margin: 0;
    color: #212529;
}

.stat-content p {
    margin: 4px 0 0 0;
    color: #6c757d;
    font-size: 0.9rem;
    font-weight: 500;
}

/* Table Card */
.table-card {
    background: white;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    overflow: hidden;
    animation: slideInUp 0.5s ease-out 0.6s backwards;
}

.table-header {
    background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
    color: white;
    padding: 16px 24px;
    display: flex;
    justify-content: space-between;
    align-items: center;
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

.table-actions {
    display: flex;
    gap: 10px;
}

.table-responsive {
    padding: 24px;
}

.data-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
}

.data-table thead th {
    background: #f8f9fa;
    color: #495057;
    font-weight: 600;
    text-transform: uppercase;
    font-size: 0.85rem;
    padding: 14px 12px;
    border-bottom: 2px solid #e9ecef;
    text-align: left;
    position: sticky;
    top: 0;
    z-index: 10;
}

.data-table tbody tr {
    transition: all 0.2s ease;
}

.data-table tbody tr:hover {
    background-color: rgba(255, 107, 53, 0.05);
}

.data-table tbody td {
    padding: 14px 12px;
    border-bottom: 1px solid #f1f3f5;
    vertical-align: middle;
}

.badge {
    padding: 6px 12px;
    border-radius: 20px;
    font-weight: 600;
    font-size: 0.8rem;
    display: inline-flex;
    align-items: center;
}

.badge i {
    margin-right: 4px;
    font-size: 0.75rem;
}

.badge.badge-success {
    background: rgba(40, 167, 69, 0.15);
    color: var(--success-color);
}

.badge.badge-danger {
    background: rgba(220, 53, 69, 0.15);
    color: var(--danger-color);
}

.badge.badge-warning {
    background: rgba(255, 193, 7, 0.15);
    color: #856404;
}

.badge.badge-secondary {
    background: rgba(108, 117, 125, 0.15);
    color: #6c757d;
}

.score-badge {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
    color: white;
    font-weight: bold;
    font-size: 1rem;
}

/* Buttons */
.btn {
    padding: 10px 20px;
    border-radius: 8px;
    font-weight: 500;
    border: none;
    cursor: pointer;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    text-decoration: none;
}

.btn-primary {
    background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
    color: white;
}

.btn-primary:hover {
    background: linear-gradient(135deg, #e55a2b, #e6841a);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(255, 107, 53, 0.3);
}

.btn-secondary {
    background: #6c757d;
    color: white;
}

.btn-secondary:hover {
    background: #5a6268;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(108, 117, 125, 0.3);
}

.btn-success {
    background: var(--success-color);
    color: white;
}

.btn-success:hover {
    background: #218838;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(40, 167, 69, 0.3);
}

.btn-sm {
    padding: 6px 12px;
    font-size: 0.85rem;
}

/* Empty State */
.empty-state {
    text-align: center;
    padding: 60px 20px;
}

.empty-state i {
    font-size: 4rem;
    color: #dee2e6;
    margin-bottom: 20px;
}

.empty-state h4 {
    color: #6c757d;
    margin-bottom: 10px;
}

.empty-state p {
    color: #adb5bd;
}

/* Print Styles */
@media print {
    .no-print {
        display: none !important;
    }
    
    .laporan-container {
        padding: 0;
        background: white;
    }
    
    .page-header,
    .filter-card,
    .stats-row {
        box-shadow: none;
        page-break-inside: avoid;
    }
    
    .table-card {
        box-shadow: none;
    }
    
    .data-table {
        font-size: 11px;
    }
    
    .data-table thead th {
        background: #f8f9fa !important;
        -webkit-print-color-adjust: exact;
        print-color-adjust: exact;
    }
}

/* Animations */
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

/* Responsive */
@media (max-width: 768px) {
    .laporan-container {
        padding: 16px;
    }
    
    .filter-row {
        grid-template-columns: 1fr;
    }
    
    .stats-row {
        grid-template-columns: 1fr;
    }
    
    .filter-actions {
        flex-direction: column;
    }
    
    .btn {
        width: 100%;
        justify-content: center;
    }
    
    .table-responsive {
        overflow-x: auto;
    }
    
    .data-table {
        min-width: 800px;
    }
    
    .table-actions {
        flex-direction: column;
        width: 100%;
    }
}
</style>

<div class="laporan-container">
    <div class="page-header no-print">
        <h1 class="page-title">
            <i class="fas fa-file-alt"></i>
            Laporan Hasil Seleksi Beasiswa Dhuafa
        </h1>
        <p class="page-subtitle">
            Laporan lengkap hasil seleksi dan penilaian calon penerima beasiswa dhuafa
        </p>
    </div>

    <!-- Filter Section -->
    <div class="filter-card no-print">
        <div class="filter-header">
            <i class="fas fa-filter"></i>
            <h5>Filter Laporan</h5>
        </div>

        <form action="{{ route('admin.laporan.dhuafa') }}" method="GET" id="filterForm">
            <div class="filter-row">
                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-calendar"></i>
                        Periode
                    </label>
                    <select name="periode" class="form-select">
                        <option value="">Semua Periode</option>
                        <option value="2024" {{ request('periode') == '2024' ? 'selected' : '' }}>2024</option>
                        <option value="2023" {{ request('periode') == '2023' ? 'selected' : '' }}>2023</option>
                        <option value="2022" {{ request('periode') == '2022' ? 'selected' : '' }}>2022</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-check-circle"></i>
                        Status
                    </label>
                    <select name="status" class="form-select">
                        <option value="">Semua Status</option>
                        <option value="diterima" {{ request('status') == 'diterima' ? 'selected' : '' }}>Diterima</option>
                        <option value="tidak_diterima" {{ request('status') == 'tidak_diterima' ? 'selected' : '' }}>Tidak Diterima</option>
                        <option value="menunggu" {{ request('status') == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-sort-amount-down"></i>
                        Urutkan
                    </label>
                    <select name="sort" class="form-select">
                        <option value="ranking_asc" {{ request('sort') == 'ranking_asc' ? 'selected' : '' }}>Ranking Terbaik</option>
                        <option value="score_desc" {{ request('sort') == 'score_desc' ? 'selected' : '' }}>Nilai Tertinggi</option>
                        <option value="score_asc" {{ request('sort') == 'score_asc' ? 'selected' : '' }}>Nilai Terendah</option>
                        <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Nama A-Z</option>
                        <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Nama Z-A</option>
                    </select>
                </div>
            </div>

            <div class="filter-actions">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-search"></i>
                    Terapkan Filter
                </button>
                <a href="{{ route('admin.laporan.dhuafa') }}" class="btn btn-secondary">
                    <i class="fas fa-redo"></i>
                    Reset
                </a>
            </div>
        </form>
    </div>

    <!-- Statistics -->
    <div class="stats-row no-print">
        <div class="stat-card">
            <div class="stat-icon primary">
                <i class="fas fa-users"></i>
            </div>
            <div class="stat-content">
                <h3>{{ $totalPendaftar ?? 0 }}</h3>
                <p>Total Pendaftar</p>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon success">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="stat-content">
                <h3>{{ $totalLulus ?? 0 }}</h3>
                <p>Diterima</p>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon danger">
                <i class="fas fa-times-circle"></i>
            </div>
            <div class="stat-content">
                <h3>{{ $totalTidakLulus ?? 0 }}</h3>
                <p>Tidak Diterima</p>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon info">
                <i class="fas fa-percent"></i>
            </div>
            <div class="stat-content">
                <h3>{{ $persentaseLulus ?? 0 }}%</h3>
                <p>Persentase Kelulusan</p>
            </div>
        </div>
    </div>

    <!-- Data Table -->
    <div class="table-card">
        <div class="table-header">
            <h3 class="table-title">
                <i class="fas fa-table"></i>
                Data Hasil Seleksi
            </h3>
            <div class="table-actions no-print">
                <button onclick="exportExcel()" class="btn btn-success btn-sm">
                    <i class="fas fa-file-excel"></i>
                    Export Excel
                </button>
                <button onclick="window.print()" class="btn btn-primary btn-sm">
                    <i class="fas fa-print"></i>
                    Cetak
                </button>
            </div>
        </div>

        <div class="table-responsive">
            @if(isset($hasilSeleksi) && count($hasilSeleksi) > 0)
                <table class="data-table" id="laporanTable">
                    <thead>
                        <tr>
                            <th style="width:50px;">No</th>
                            <th>Nama Lengkap</th>
                            <th>NIM</th>
                            <th style="width:140px;">Nilai SAW</th>
                            <th style="width:100px;">Ranking</th>
                            <th style="width:160px;">Status Beasiswa</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($hasilSeleksi as $index => $data)
                        <tr>
                            {{-- No --}}
                            <td>{{ $index + 1 }}</td>

                            {{-- Nama --}}
                            <td>
                                <strong>{{ $data->alternatif->nama }}</strong>
                            </td>

                            {{-- NIM --}}
                            <td>
                                {{ $data->alternatif->nim ?? 'N/A' }}
                            </td>

                            {{-- Nilai SAW --}}
                            <td>
                                <span class="score-value">{{ number_format($data->nilai_akhir, 4) }}</span>
                            </td>

                            {{-- Ranking --}}
                            <td>
                                <span class="rank-badge">
                                    #{{ $data->ranking }}
                                </span>
                            </td>

                            {{-- Status Beasiswa --}}
                            <td>
                                @if($data->alternatif->status_beasiswa === 'diterima')
                                    <span class="badge badge-success">
                                        <i class="fas fa-check-circle"></i>
                                        Diterima
                                    </span>
                                @elseif($data->alternatif->status_beasiswa === 'tidak_diterima')
                                    <span class="badge badge-danger">
                                        <i class="fas fa-times-circle"></i>
                                        Tidak Diterima
                                    </span>
                                @else
                                    <span class="badge badge-secondary">
                                        <i class="fas fa-clock"></i>
                                        Menunggu
                                    </span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="empty-state">
                    <i class="fas fa-inbox"></i>
                    <h4>Belum Ada Data</h4>
                    <p>Data hasil seleksi beasiswa dhuafa belum tersedia</p>
                </div>
            @endif
        </div>
    </div>
</div>

<script>
// Export to Excel (CSV format)
function exportExcel() {
    // Get data from PHP
    const hasilSeleksi = @json($hasilSeleksi ?? []);
    
    if (!hasilSeleksi || hasilSeleksi.length === 0) {
        alert('Tidak ada data untuk diekspor');
        return;
    }
    
    let csvContent = "data:text/csv;charset=utf-8,\uFEFF"; // Add BOM for Excel UTF-8
    
    // Header
    csvContent += "No,Nama Lengkap,NIM,Nilai SAW,Ranking,Status Beasiswa\n";
    
    // Data rows
    hasilSeleksi.forEach((data, index) => {
        const no = index + 1;
        const nama = (data.alternatif?.nama || 'N/A').replace(/"/g, '""'); // Escape quotes
        const nim = data.alternatif?.nim || 'N/A';
        const nilai = data.nilai_akhir ? parseFloat(data.nilai_akhir).toFixed(4) : '0.0000';
        const ranking = data.ranking || '-';
        
        // Status beasiswa
        let status = 'Menunggu';
        if (data.alternatif?.status_beasiswa === 'diterima') {
            status = 'Diterima';
        } else if (data.alternatif?.status_beasiswa === 'tidak_diterima') {
            status = 'Tidak Diterima';
        }
        
        csvContent += `"${no}","${nama}","${nim}","${nilai}","${ranking}","${status}"\n`;
    });
    
    // Create download link
    const encodedUri = encodeURI(csvContent);
    const link = document.createElement("a");
    link.setAttribute("href", encodedUri);
    link.setAttribute("download", `Laporan_Seleksi_Dhuafa_${getDateString()}.csv`);
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
    
    // Show success message
    showNotification('Excel berhasil diexport!', 'success');
}

// Export to PDF (using print)
function exportPDF() {
    showNotification('Gunakan fungsi Print dan pilih "Save as PDF"', 'info');
    setTimeout(() => {
        window.print();
    }, 1000);
}

// Get formatted date string
function getDateString() {
    const now = new Date();
    const year = now.getFullYear();
    const month = String(now.getMonth() + 1).padStart(2, '0');
    const day = String(now.getDate()).padStart(2, '0');
    return `${year}${month}${day}`;
}

// Show notification
function showNotification(message, type = 'success') {
    const notification = document.createElement('div');
    notification.className = `alert alert-${type}`;
    notification.style.position = 'fixed';
    notification.style.top = '20px';
    notification.style.right = '20px';
    notification.style.zIndex = '9999';
    notification.style.minWidth = '300px';
    notification.style.animation = 'slideInRight 0.5s ease';
    
    const icon = type === 'success' ? 'fa-check-circle' : 'fa-info-circle';
    notification.innerHTML = `
        <i class="fas ${icon}"></i>
        ${message}
    `;
    
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.style.animation = 'slideOutRight 0.5s ease';
        setTimeout(() => {
            document.body.removeChild(notification);
        }, 500);
    }, 3000);
}

// Print specific styling
window.addEventListener('beforeprint', () => {
    document.title = 'Laporan Hasil Seleksi Beasiswa Dhuafa - LAZISMU DIY';
});

window.addEventListener('afterprint', () => {
    document.title = 'Laporan Hasil Seleksi Dhuafa';
});

// Keyboard shortcuts
document.addEventListener('keydown', function(e) {
    // Ctrl + E untuk export Excel
    if (e.ctrlKey && e.key === 'e') {
        e.preventDefault();
        exportExcel();
    }
    // Ctrl + P untuk print
    if (e.ctrlKey && e.key === 'p') {
        e.preventDefault();
        window.print();
    }
});

console.log('📊 Laporan Dhuafa page loaded successfully!');
console.log('💡 Tips: Tekan Ctrl+E untuk export Excel, Ctrl+P untuk print');
</script>

<style>
@keyframes slideInRight {
    from {
        opacity: 0;
        transform: translateX(100%);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

@keyframes slideOutRight {
    from {
        opacity: 1;
        transform: translateX(0);
    }
    to {
        opacity: 0;
        transform: translateX(100%);
    }
}

.score-value {
    font-weight: 600;
    color: var(--primary-color);
}

.rank-badge {
    display: inline-block;
    background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
    color: white;
    padding: 4px 12px;
    border-radius: 20px;
    font-weight: 600;
    font-size: 0.85rem;
}
</style>

@endsection