@extends('layouts.admin')

@section('title', 'Data Kriteria Kader Muhammadiyah')

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
}

.page-title {
    font-size: 1.8rem;
    font-weight: bold;
    color: #212529;
    margin-bottom: 8px;
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

.badge-jenis {
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
    margin-bottom: 24px;
}

.alert-info i {
    margin-right: 8px;
    color: var(--primary-color);
}

.content-card {
    background: white;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    padding: 20px;
}

.content-card h5 {
    color: #212529;
}

.content-card .fas.fa-arrow-right.text-primary {
    color: var(--primary-color) !important;
}

.content-card .fas.fa-arrow-right.text-danger {
    color: var(--danger-color) !important;
}

.content-card .fas.fa-balance-scale.text-warning {
    color: var(--warning-color) !important;
}

.content-card .fas.fa-lightbulb {
    color: var(--secondary-color);
}

.content-card .fas.fa-question-circle {
    color: var(--primary-color);
}

.content-card .fas.fa-check.text-success {
    color: var(--success-color) !important;
}

@media (max-width: 768px) {
    .kriteria-container { padding: 16px; }
    .page-header { padding: 16px; }
    .action-section { padding: 16px; }
    .custom-table { font-size: 0.85rem; }
    .action-buttons { flex-direction: column; }
    .action-buttons .btn-edit,
    .action-buttons .btn-delete { width: 100%; text-align: center; }
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
        color: #495057;
    }
    .custom-table tbody tr {
        display: block;
        border: 1px solid #e9ecef;
        border-radius: 8px;
        margin-bottom: 16px;
        background: white;
    }
}

/* Animation enhancements */
.stats-row:hover,
.page-header:hover,
.action-section:hover,
.content-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 20px rgba(255, 107, 53, 0.1);
    transition: all 0.3s ease;
}

.badge-secondary {
    background-color: var(--secondary-color);
    color: white;
    padding: 4px 8px;
    border-radius: 12px;
    font-size: 0.8rem;
}
</style>

<div class="kriteria-container">
    <!-- Page Header -->
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="page-title">
                    <i class="fas fa-chart-bar mr-2" style="color: var(--primary-color);"></i>
                    Data Kriteria Kader Muhammadiyah
                </h1>
                <p class="page-subtitle">
                    Kelola kriteria penilaian untuk calon penerima <strong>Beasiswa Kader Muhammadiyah</strong>
                </p>
            </div>
            <div class="col-md-4 text-md-right">
                <div class="d-flex justify-content-md-end">
                    <div class="stat-item">
                        <div class="stat-number primary">{{ count($kriterias ?? []) }}</div>
                        <div class="stat-label">Total Kriteria Kader</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Alert Info -->
    <div class="alert-info">
        <i class="fas fa-info-circle"></i>
        <strong>Panduan:</strong>
        Kriteria Kader digunakan untuk menilai keaktifan organisasi, prestasi,
        dan komitmen terhadap nilai-nilai Muhammadiyah.
    </div>

    <!-- Action Section -->
    <div class="action-section">
        <div class="row align-items-center">
            <div class="col-md-6">
                <a href="{{ route('admin.kriteria.kader.create') }}" class="btn-add">
                    <i class="fas fa-plus"></i>
                    Tambah Kriteria Kader
                </a>
            </div>
            <div class="col-md-6 text-md-right mt-3 mt-md-0">
                <small class="text-muted">
                    <i class="fas fa-lightbulb mr-1" style="color: var(--secondary-color);"></i>
                    Prioritaskan kriteria keaktifan, kepemimpinan, dan prestasi
                </small>
            </div>
        </div>
    </div>

    <!-- Statistics Row -->
    @if(isset($kriterias) && count($kriterias) > 0)
    <div class="stats-row">
        <div class="row">
            <div class="col-md-4">
                <div class="stat-item">
                    <div class="stat-number success">
                        {{ collect($kriterias)->where('jenis', 'benefit')->count() }}
                    </div>
                    <div class="stat-label">Kriteria Benefit</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-item">
                    <div class="stat-number secondary">
                        {{ collect($kriterias)->where('jenis', 'cost')->count() }}
                    </div>
                    <div class="stat-label">Kriteria Cost</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-item">
                    <div class="stat-number primary">
                        {{ number_format(collect($kriterias)->sum('bobot'), 2) }}
                    </div>
                    <div class="stat-label">Total Bobot</div>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Table Container -->
    <div class="table-container">
        <div class="table-header">
            <h3 class="table-title">
                <i class="fas fa-table"></i>
                Daftar Kriteria Penilaian
            </h3>
        </div>
        
        <div class="table-responsive">
            <table class="table custom-table">
                <thead>
                    <tr>
                        <th width="8%">No</th>
                        <th width="30%">Nama Kriteria</th>
                        <th width="15%">Bobot</th>
                        <th width="15%">Tipe</th>
                        <th width="15%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($kriterias ?? [] as $index => $item)
                    <tr>
                        <td data-label="No">
                            <span class="badge-secondary">{{ $index + 1 }}</span>
                        </td>
                        <td data-label="Nama Kriteria">
                            <strong>{{ $item->nama_kriteria ?? 'Nama Kriteria' }}</strong>
                        </td>
                        <td data-label="Bobot">
                            <span class="bobot-display">{{ $item->bobot ?? '0.2' }}</span>
                        </td>
                       <td data-label="Jenis">
                        <span class="badge-jenis {{ ($item->jenis ?? 'benefit') == 'benefit' ? 'badge-benefit' : 'badge-cost' }}">
                            {{ ucfirst($item->jenis ?? 'benefit') }}
                        </span>
                        </td>
                        <!-- <td data-label="Deskripsi">
                            <small class="text-muted">
                                {{ $item->deskripsi ?? 'Deskripsi kriteria penilaian' }}
                            </small>
                        </td> -->
                        <td data-label="Aksi">
                            <div class="action-buttons">
                                <a href="{{ route('admin.kriteria.edit', $item->id ?? 1) ?? '#' }}" class="btn-edit">
                                    <i class="fas fa-edit mr-1"></i>Edit
                                </a>
                                <form action="{{ route('admin.kriteria.destroy', $item->id) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus kriteria ini?\n\nData yang terkait dengan kriteria ini juga akan terhapus!')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-delete">
                                        <i class="fas fa-trash mr-1"></i>Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6">
                            <div class="empty-state">
                                <div class="empty-icon">
                                    <i class="fas fa-inbox"></i>
                                </div>
                                <div class="empty-title">Belum Ada Data Kriteria</div>
                                <div class="empty-text">
                                    Mulai dengan menambahkan kriteria penilaian pertama untuk sistem SAW Anda.
                                </div>
                                <a href="{{ route('admin.kriteria.kader.create') }}" class="btn-add">
                                    <i class="fas fa-plus"></i>
                                    Tambah Kriteria Pertama
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Additional Info Card -->
    <div class="row mt-4">
        <div class="col-lg-6">
            <div class="content-card">
                <h5 class="font-weight-bold text-dark mb-3">
                    <i class="fas fa-question-circle mr-2"></i>
                    Tentang Kriteria
                </h5>
                <ul class="list-unstyled">
                    <li class="mb-2">
                        <i class="fas fa-arrow-right text-primary mr-2"></i>
                        <strong>Benefit:</strong> Semakin tinggi nilai semakin baik
                    </li>
                    <li class="mb-2">
                        <i class="fas fa-arrow-right text-danger mr-2"></i>
                        <strong>Cost:</strong> Semakin rendah nilai semakin baik
                    </li>
                    <li class="mb-2">
                        <i class="fas fa-balance-scale text-warning mr-2"></i>
                        <strong>Bobot:</strong> Tingkat kepentingan kriteria (0-1)
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="content-card">
                <h5 class="font-weight-bold text-dark mb-3">
                    <i class="fas fa-lightbulb mr-2"></i>
                    Tips Penggunaan
                </h5>
                <ul class="list-unstyled">
                    <li class="mb-2">
                        <i class="fas fa-check text-success mr-2"></i>
                        Pastikan nama kriteria jelas dan mudah dipahami
                    </li>
                    <li class="mb-2">
                        <i class="fas fa-check text-success mr-2"></i>
                        Total bobot semua kriteria harus = 1
                    </li>
                    <li class="mb-2">
                        <i class="fas fa-check text-success mr-2"></i>
                        Pilih jenis tipe yang sesuai dengan karakteristik kriteria
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- Font Awesome untuk Icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<!-- JavaScript untuk konfirmasi hapus yang lebih baik -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Animasi untuk cards
    const cards = document.querySelectorAll('.table-container, .page-header, .action-section, .stats-row');
    cards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        setTimeout(() => {
            card.style.transition = 'all 0.5s ease';
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, index * 100);
    });

    // Enhanced delete confirmation
    const deleteButtons = document.querySelectorAll('.btn-delete');
    deleteButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const form = this.closest('form');
            const namaElement = this.closest('tr').querySelector('[data-label="Nama Kriteria"] strong');
            const kriteriaNama = namaElement ? namaElement.textContent : 'Kriteria ini';

            if (confirm(`Apakah Anda yakin ingin menghapus kriteria "${kriteriaNama}"?\n\n⚠️ PERINGATAN:\n- Data sub-kriteria terkait akan ikut terhapus\n- Data penilaian terkait akan ikut terhapus\n- Aksi ini tidak dapat dibatalkan!`)) {
                form.submit();
            }
        });
    });

    // Tooltip untuk bobot
    const bobotElements = document.querySelectorAll('.bobot-display');
    bobotElements.forEach(element => {
        const bobot = parseFloat(element.textContent);
        const percentage = (bobot * 100).toFixed(1) + '%';
        element.title = `Bobot: ${percentage}`;
    });
});
</script>
@endsection