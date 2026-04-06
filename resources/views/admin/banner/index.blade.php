@extends('layouts.admin')

@section('title', 'Manajemen Banner')

@section('content')
<style>
/* Banner Management Page Styles - LAZISMU DIY Consistent Style */
:root {
    --primary-color: #ff6b35;
    --secondary-color: #f7931e;
    --success-color: #28a745;
    --danger-color: #dc3545;
    --warning-color: #ffc107;
    --info-color: #17a2b8;
}

.banner-container {
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

.header-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 16px;
}

.page-title {
    font-size: 1.8rem;
    font-weight: bold;
    color: #212529;
    margin: 0;
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
    margin-top: 8px;
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
}

.btn-danger {
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

.btn-danger:hover {
    background-color: #c82333;
    transform: scale(1.05);
}

.btn-edit {
    background-color: var(--info-color);
    color: white;
    padding: 8px 16px;
    border-radius: 6px;
    text-decoration: none;
    font-size: 0.85rem;
    font-weight: 500;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 6px;
}

.btn-edit:hover {
    background-color: #138496;
    color: white;
    text-decoration: none;
    transform: scale(1.05);
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
    animation: slideInUp 0.5s ease-out forwards;
    animation-delay: 0.1s;
}

.alert-success i {
    margin-right: 10px;
    color: var(--success-color);
    font-size: 1.2rem;
}

/* Table Container - LAZISMU DIY Style */
.table-container {
    background: white;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    overflow: hidden;
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

.banner-table {
    width: 100%;
    border-collapse: collapse;
    margin: 0;
    border: none;
}

.banner-table thead th {
    background-color: #f8f9fa;
    color: #495057;
    font-weight: 600;
    padding: 16px 12px;
    text-align: left;
    border: none;
    font-size: 0.9rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.banner-table thead th.text-center {
    text-align: center;
}

.banner-table tbody td {
    padding: 16px 12px;
    border-top: 1px solid #e9ecef;
    vertical-align: middle;
}

.banner-table tbody tr {
    transition: all 0.3s ease;
}

.banner-table tbody tr:hover {
    background-color: rgba(255, 107, 53, 0.05);
}

/* Number Badge */
.number-badge {
    background-color: var(--secondary-color);
    color: white;
    padding: 6px 12px;
    border-radius: 12px;
    font-size: 0.85rem;
    font-weight: 600;
    display: inline-block;
    min-width: 35px;
    text-align: center;
}

/* Banner Preview */
.banner-preview {
    width: 120px;
    height: 70px;
    object-fit: cover;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
    cursor: pointer;
}

.banner-preview:hover {
    transform: scale(1.05);
    box-shadow: 0 4px 12px rgba(255, 107, 53, 0.3);
}

/* Banner Info */
.banner-title {
    font-weight: 600;
    color: #495057;
    margin-bottom: 4px;
}

.banner-link {
    color: var(--info-color);
    text-decoration: none;
    font-size: 0.85rem;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 4px;
}

.banner-link:hover {
    color: #138496;
    text-decoration: underline;
}

.banner-link i {
    font-size: 0.75rem;
}

/* Order Badge */
.order-badge {
    background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
    color: white;
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 0.9rem;
    font-weight: 600;
    display: inline-block;
    min-width: 40px;
    text-align: center;
}

/* Status Badge - LAZISMU DIY Style */
.status-badge {
    padding: 6px 14px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 500;
    text-transform: uppercase;
    display: inline-block;
}

.status-active {
    background-color: rgba(40, 167, 69, 0.1);
    color: var(--success-color);
    border: 1px solid rgba(40, 167, 69, 0.2);
}

.status-inactive {
    background-color: rgba(220, 53, 69, 0.1);
    color: var(--danger-color);
    border: 1px solid rgba(220, 53, 69, 0.2);
}

/* Action Buttons */
.action-buttons {
    display: flex;
    gap: 8px;
    align-items: center;
    justify-content: center;
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

/* Stats Cards - Optional */
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
.stat-icon.success { color: var(--success-color); }
.stat-icon.danger { color: var(--danger-color); }

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

/* Image Modal */
.image-modal {
    display: none;
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0,0,0,0.8);
    justify-content: center;
    align-items: center;
}

.image-modal.active {
    display: flex;
}

.modal-image {
    max-width: 90%;
    max-height: 90%;
    border-radius: 10px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.5);
}

.close-modal {
    position: absolute;
    top: 20px;
    right: 30px;
    color: white;
    font-size: 40px;
    font-weight: bold;
    cursor: pointer;
}

.close-modal:hover {
    color: var(--primary-color);
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

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

.fade-in {
    animation: fadeIn 0.5s ease;
}

/* Responsive Design */
@media (max-width: 768px) {
    .banner-container {
        padding: 16px;
    }
    
    .page-header {
        padding: 16px;
    }
    
    .header-content {
        flex-direction: column;
        align-items: flex-start;
    }
    
    .page-title {
        font-size: 1.5rem;
    }
    
    .banner-table {
        font-size: 0.85rem;
    }
    
    .banner-preview {
        width: 100px;
        height: 60px;
    }
}

@media (max-width: 576px) {
    .btn-action {
        width: 100%;
        justify-content: center;
    }
    
    .banner-table thead {
        display: none;
    }
    
    .banner-table tbody tr {
        display: block;
        border: 1px solid #e9ecef;
        border-radius: 8px;
        margin-bottom: 16px;
        background: white;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        padding: 16px;
    }
    
    .banner-table tbody tr:hover {
        box-shadow: 0 4px 12px rgba(255, 107, 53, 0.15);
    }
    
    .banner-table tbody td {
        display: block;
        text-align: left;
        border: none;
        padding: 8px 0;
    }
    
    .banner-table tbody td:before {
        content: attr(data-label) ": ";
        font-weight: bold;
        color: var(--primary-color);
        display: inline-block;
        width: 100px;
    }
    
    .action-buttons {
        justify-content: flex-start;
    }
}

/* Print styles */
@media print {
    .page-header .btn-action,
    .action-buttons {
        display: none;
    }
    .banner-container {
        padding: 0;
        background: white;
    }
}
</style>

<div class="banner-container">
    <!-- Page Header -->
    <div class="page-header fade-in">
        <div class="header-content">
            <div>
                <h1 class="page-title">
                    <i class="fas fa-images"></i>
                    Manajemen Banner
                </h1>
                <p class="page-subtitle">
                    Kelola banner carousel untuk website LAZISMU DIY
                </p>
            </div>
            <a href="{{ route('admin.banner.create') }}" class="btn-action btn-primary">
                <i class="fas fa-plus"></i>
                Tambah Banner
            </a>
        </div>
    </div>

    <!-- Success Alert -->
    @if (session('success'))
        <div class="alert-success fade-in">
            <i class="fas fa-check-circle"></i>
            {{ session('success') }}
        </div>
    @endif

    <!-- Statistics Cards (Optional) -->
    @php
        $totalBanners = count($banners);
        $activeBanners = $banners->where('is_active', true)->count();
        $inactiveBanners = $banners->where('is_active', false)->count();
    @endphp
    <div class="stats-row fade-in">
        <div class="stat-card">
            <div class="stat-icon primary">
                <i class="fas fa-images"></i>
            </div>
            <div class="stat-number">{{ $totalBanners }}</div>
            <div class="stat-label">Total Banner</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon success">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="stat-number">{{ $activeBanners }}</div>
            <div class="stat-label">Banner Aktif</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon danger">
                <i class="fas fa-times-circle"></i>
            </div>
            <div class="stat-number">{{ $inactiveBanners }}</div>
            <div class="stat-label">Banner Nonaktif</div>
        </div>
    </div>

    <!-- Table -->
    <div class="table-container fade-in">
        <div class="table-header">
            <h3 class="table-title">
                <i class="fas fa-list"></i>
                Daftar Banner
            </h3>
        </div>
        
        <div class="table-responsive">
            <table class="banner-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Preview</th>
                        <th>Judul</th>
                        <th>Link</th>
                        <th class="text-center">Urutan</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($banners as $index => $banner)
                        <tr>
                            <td data-label="No">
                                <span class="number-badge">{{ $index + 1 }}</span>
                            </td>

                            <td data-label="Preview">
                                <img src="{{ asset('storage/' . $banner->image) }}"
                                     alt="Banner {{ $banner->title }}"
                                     class="banner-preview"
                                     onclick="showImageModal('{{ asset('storage/' . $banner->image) }}')">
                            </td>

                            <td data-label="Judul">
                                <div class="banner-title">
                                    {{ $banner->title ?? '-' }}
                                </div>
                            </td>

                            <td data-label="Link">
                                @if ($banner->link)
                                    <a href="{{ $banner->link }}"
                                       target="_blank"
                                       class="banner-link">
                                        {{ Str::limit($banner->link, 40) }}
                                        <i class="fas fa-external-link-alt"></i>
                                    </a>
                                @else
                                    <span style="color: #999;">-</span>
                                @endif
                            </td>

                            <td data-label="Urutan" class="text-center">
                                <span class="order-badge">{{ $banner->order }}</span>
                            </td>

                            <td data-label="Status" class="text-center">
                                @if ($banner->is_active)
                                    <span class="status-badge status-active">
                                        <i class="fas fa-check-circle"></i> Aktif
                                    </span>
                                @else
                                    <span class="status-badge status-inactive">
                                        <i class="fas fa-times-circle"></i> Nonaktif
                                    </span>
                                @endif
                            </td>

                            <td data-label="Aksi">
                                <div class="action-buttons">
                                    <a href="{{ route('admin.banner.edit', $banner->id) }}"
                                       class="btn-edit">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>

                                    <form action="{{ route('admin.banner.destroy', $banner->id) }}"
                                          method="POST"
                                          class="inline"
                                          onsubmit="return confirm('Yakin ingin menghapus banner ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-danger">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">
                                <div class="empty-state">
                                    <div class="empty-icon">
                                        <i class="fas fa-image"></i>
                                    </div>
                                    <div class="empty-title">Belum Ada Banner</div>
                                    <div class="empty-text">
                                        Belum ada banner yang ditambahkan.<br>
                                        Klik tombol "Tambah Banner" untuk membuat banner baru.
                                    </div>
                                    <a href="{{ route('admin.banner.create') }}" class="btn-action btn-primary">
                                        <i class="fas fa-plus"></i>
                                        Tambah Banner
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

<!-- Image Modal -->
<div id="imageModal" class="image-modal" onclick="closeImageModal()">
    <span class="close-modal">&times;</span>
    <img id="modalImage" class="modal-image" src="" alt="Banner Preview">
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
});

// Image Modal Functions
function showImageModal(imageSrc) {
    const modal = document.getElementById('imageModal');
    const modalImage = document.getElementById('modalImage');
    modalImage.src = imageSrc;
    modal.classList.add('active');
}

function closeImageModal() {
    const modal = document.getElementById('imageModal');
    modal.classList.remove('active');
}

// Close modal with ESC key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeImageModal();
    }
});

// Prevent modal close when clicking on image
document.getElementById('modalImage').addEventListener('click', function(e) {
    e.stopPropagation();
});

console.log('🎨 Banner Management page loaded successfully!');
console.log('📊 Total Banners: {{ $totalBanners }}');
</script>

@endsection