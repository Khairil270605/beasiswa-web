@extends('layouts.admin')

@section('title', 'Tambah Banner')

@section('content')
<style>
/* Create Banner Page Styles - LAZISMU DIY Consistent Style */
:root {
    --primary-color: #ff6b35;
    --secondary-color: #f7931e;
    --success-color: #28a745;
    --danger-color: #dc3545;
    --warning-color: #ffc107;
    --info-color: #17a2b8;
}

.create-banner-container {
    padding: 24px;
    background-color: #f8f9fa;
    min-height: 100vh;
}

.form-wrapper {
    max-width: 800px;
    margin: 0 auto;
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
    font-size: 0.95rem;
    margin: 0;
}

/* Alert Error - LAZISMU DIY Style */
.alert-error {
    background: linear-gradient(45deg, rgba(220, 53, 69, 0.1), rgba(220, 53, 69, 0.05));
    border: 1px solid rgba(220, 53, 69, 0.2);
    color: #721c24;
    padding: 16px 20px;
    border-radius: 8px;
    margin-bottom: 24px;
    animation: slideInUp 0.5s ease-out forwards;
    animation-delay: 0.1s;
}

.alert-error i {
    color: var(--danger-color);
    margin-right: 8px;
}

.error-list {
    list-style: none;
    padding: 0;
    margin: 8px 0 0 0;
}

.error-list li {
    padding: 4px 0;
    display: flex;
    align-items: center;
}

.error-list li:before {
    content: "•";
    color: var(--danger-color);
    font-weight: bold;
    margin-right: 8px;
}

/* Form Container - LAZISMU DIY Style */
.form-container {
    background: white;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    overflow: hidden;
    animation: slideInUp 0.5s ease-out forwards;
    animation-delay: 0.2s;
}

.form-header {
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 50%, var(--danger-color) 100%);
    color: white;
    padding: 16px 20px;
}

.form-title {
    font-size: 1.2rem;
    font-weight: 600;
    margin: 0;
    display: flex;
    align-items: center;
}

.form-title i {
    margin-right: 10px;
}

.form-body {
    padding: 30px;
}

/* Form Group - LAZISMU DIY Style */
.form-group {
    margin-bottom: 24px;
}

.form-label {
    display: block;
    font-weight: 600;
    color: #495057;
    margin-bottom: 8px;
    font-size: 0.95rem;
}

.form-label i {
    color: var(--primary-color);
    margin-right: 6px;
}

.form-label .required {
    color: var(--danger-color);
    margin-left: 4px;
}

.form-input,
.form-textarea,
.form-select {
    width: 100%;
    padding: 12px 16px;
    border: 2px solid #e9ecef;
    border-radius: 8px;
    font-size: 0.95rem;
    transition: all 0.3s ease;
    background-color: white;
}

.form-input:focus,
.form-textarea:focus,
.form-select:focus {
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px rgba(255, 107, 53, 0.1);
    outline: none;
}

.form-textarea {
    resize: vertical;
    min-height: 100px;
}

.form-help {
    font-size: 0.85rem;
    color: #6c757d;
    margin-top: 6px;
    display: flex;
    align-items: center;
}

.form-help i {
    margin-right: 6px;
    color: var(--info-color);
}

/* File Input - LAZISMU DIY Style */
.file-input-wrapper {
    position: relative;
}

.file-input {
    width: 100%;
    padding: 12px 16px;
    border: 2px dashed #e9ecef;
    border-radius: 8px;
    background-color: #f8f9fa;
    cursor: pointer;
    transition: all 0.3s ease;
}

.file-input:hover {
    border-color: var(--primary-color);
    background-color: rgba(255, 107, 53, 0.05);
}

.file-input::file-selector-button {
    padding: 8px 16px;
    background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
    color: white;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    font-weight: 500;
    margin-right: 12px;
    transition: all 0.3s ease;
}

.file-input::file-selector-button:hover {
    background: linear-gradient(45deg, #e55a2b, #e6841a);
    transform: translateY(-1px);
}

/* Checkbox Style - LAZISMU DIY */
.checkbox-wrapper {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 16px;
    background: #f8f9fa;
    border-radius: 8px;
    border: 2px solid #e9ecef;
    transition: all 0.3s ease;
}

.checkbox-wrapper:hover {
    background: rgba(255, 107, 53, 0.05);
    border-color: var(--primary-color);
}

.custom-checkbox {
    width: 20px;
    height: 20px;
    cursor: pointer;
    accent-color: var(--primary-color);
}

.checkbox-label {
    font-weight: 500;
    color: #495057;
    cursor: pointer;
    margin: 0;
}

/* Button Styles - LAZISMU DIY */
.form-actions {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 12px;
    padding-top: 24px;
    border-top: 2px solid #e9ecef;
    margin-top: 24px;
}

.btn {
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

.btn i {
    margin-right: 8px;
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
    box-shadow: 0 4px 12px rgba(108, 117, 125, 0.3);
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

/* Info Box - LAZISMU DIY Style */
.info-box {
    background: linear-gradient(45deg, rgba(23, 162, 184, 0.1), rgba(23, 162, 184, 0.05));
    border: 1px solid rgba(23, 162, 184, 0.2);
    border-radius: 8px;
    padding: 16px;
    margin-bottom: 24px;
    display: flex;
    align-items: start;
}

.info-box i {
    color: var(--info-color);
    font-size: 1.2rem;
    margin-right: 12px;
    margin-top: 2px;
}

.info-box-content {
    flex: 1;
}

.info-box-title {
    font-weight: 600;
    color: #495057;
    margin-bottom: 4px;
}

.info-box-text {
    color: #6c757d;
    font-size: 0.9rem;
    line-height: 1.5;
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

/* Image Preview */
.image-preview-wrapper {
    margin-top: 16px;
}

.image-preview-label {
    font-weight: 600;
    color: #495057;
    margin-bottom: 12px;
    display: block;
}

.image-preview {
    max-width: 100%;
    max-height: 300px;
    border-radius: 10px;
    border: 3px solid #e9ecef;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
}

.image-preview:hover {
    transform: scale(1.02);
    box-shadow: 0 4px 20px rgba(255, 107, 53, 0.2);
}

/* Responsive Design */
@media (max-width: 768px) {
    .create-banner-container {
        padding: 16px;
    }
    
    .page-header {
        padding: 16px;
    }
    
    .page-title {
        font-size: 1.5rem;
    }
    
    .form-body {
        padding: 20px;
    }
    
    .form-actions {
        flex-direction: column-reverse;
    }
    
    .btn {
        width: 100%;
        justify-content: center;
    }
}

@media (max-width: 576px) {
    .image-preview {
        max-height: 200px;
    }
}
</style>

<div class="create-banner-container">
    <!-- Page Header -->
    <div class="form-wrapper">
        <div class="page-header fade-in">
            <h1 class="page-title">
                <i class="fas fa-plus-circle"></i>
                Tambah Banner
            </h1>
            <p class="page-subtitle">
                Banner akan ditampilkan di halaman beranda sebagai slider
            </p>
        </div>

        <!-- Error Validation -->
        @if ($errors->any())
            <div class="alert-error fade-in">
                <div style="display: flex; align-items: center; margin-bottom: 8px;">
                    <i class="fas fa-exclamation-triangle"></i>
                    <strong>Terdapat kesalahan pada form:</strong>
                </div>
                <ul class="error-list">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Info Box -->
        <div class="info-box fade-in">
            <i class="fas fa-info-circle"></i>
            <div class="info-box-content">
                <div class="info-box-title">Tips Membuat Banner</div>
                <div class="info-box-text">
                    Gunakan gambar dengan resolusi tinggi (minimal 1920x600px) dan pastikan ukuran file tidak lebih dari 2MB untuk performa optimal website.
                </div>
            </div>
        </div>

        <!-- Form -->
        <div class="form-container fade-in">
            <div class="form-header">
                <h3 class="form-title">
                    <i class="fas fa-image"></i>
                    Form Tambah Banner
                </h3>
            </div>

            <div class="form-body">
                <form action="{{ route('admin.banner.store') }}"
                      method="POST"
                      enctype="multipart/form-data"
                      id="bannerForm">
                    @csrf

                    <!-- Judul -->
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-heading"></i>
                            Judul Banner
                            <span class="required">*</span>
                        </label>
                        <input type="text"
                               name="title"
                               value="{{ old('title') }}"
                               class="form-input"
                               placeholder="Masukkan judul banner"
                               required>
                        <div class="form-help">
                            <i class="fas fa-info-circle"></i>
                            Judul akan ditampilkan di banner carousel
                        </div>
                    </div>

                    <!-- Deskripsi -->
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-align-left"></i>
                            Deskripsi
                        </label>
                        <textarea name="description"
                                  class="form-textarea"
                                  rows="4"
                                  placeholder="Masukkan deskripsi banner (opsional)">{{ old('description') }}</textarea>
                        <div class="form-help">
                            <i class="fas fa-info-circle"></i>
                            Deskripsi singkat tentang banner (maksimal 200 karakter)
                        </div>
                    </div>

                    <!-- Link -->
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-link"></i>
                            Link URL
                        </label>
                        <input type="url"
                               name="link"
                               value="{{ old('link') }}"
                               class="form-input"
                               placeholder="https://contoh.com">
                        <div class="form-help">
                            <i class="fas fa-info-circle"></i>
                            URL tujuan ketika banner diklik (opsional)
                        </div>
                    </div>

                    <!-- Upload Gambar -->
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-cloud-upload-alt"></i>
                            Gambar Banner
                            <span class="required">*</span>
                        </label>
                        <input type="file"
                               name="image"
                               accept="image/jpeg,image/png,image/jpg,image/webp"
                               class="file-input"
                               onchange="previewImage(event)"
                               required>
                        <div class="form-help">
                            <i class="fas fa-info-circle"></i>
                            Format: JPG, PNG, WEBP. Ukuran maksimal: 2MB. Rekomendasi: 1920x600 px
                        </div>
                        
                        <!-- Preview Gambar -->
                        <div id="imagePreview" class="image-preview-wrapper" style="display: none;">
                            <label class="image-preview-label">
                                <i class="fas fa-eye"></i>
                                Preview Gambar:
                            </label>
                            <img id="previewImg" src="" alt="Preview" class="image-preview">
                        </div>
                    </div>

                    <!-- Urutan -->
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-sort-numeric-up"></i>
                            Urutan Banner
                            <span class="required">*</span>
                        </label>
                        <input type="number"
                               name="order"
                               min="1"
                               value="{{ old('order', 1) }}"
                               class="form-input"
                               placeholder="1"
                               required>
                        <div class="form-help">
                            <i class="fas fa-info-circle"></i>
                            Urutan tampil banner (angka lebih kecil akan tampil lebih dulu)
                        </div>
                    </div>

                    <!-- Status -->
                    <div class="form-group">
                        <div class="checkbox-wrapper">
                            <input type="checkbox"
                                   name="is_active"
                                   value="1"
                                   id="is_active"
                                   {{ old('is_active', true) ? 'checked' : '' }}
                                   class="custom-checkbox">
                            <label for="is_active" class="checkbox-label">
                                <i class="fas fa-check-circle" style="color: var(--success-color); margin-right: 6px;"></i>
                                Banner Aktif (Tampilkan di website)
                            </label>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="form-actions">
                        <a href="{{ route('admin.banner.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i>
                            Kembali
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i>
                            Simpan Banner
                        </button>
                    </div>
                </form>
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
});

// Preview image before upload
function previewImage(event) {
    const file = event.target.files[0];
    if (file) {
        // Check file size (2MB max)
        if (file.size > 2 * 1024 * 1024) {
            alert('Ukuran file terlalu besar! Maksimal 2MB');
            event.target.value = '';
            return;
        }
        
        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.getElementById('imagePreview');
            const img = document.getElementById('previewImg');
            img.src = e.target.result;
            preview.style.display = 'block';
        }
        reader.readAsDataURL(file);
    }
}

// Form validation before submit
document.getElementById('bannerForm').addEventListener('submit', function(e) {
    const title = document.querySelector('input[name="title"]').value.trim();
    const order = document.querySelector('input[name="order"]').value;
    const image = document.querySelector('input[name="image"]').files[0];
    
    if (!title) {
        e.preventDefault();
        alert('Judul banner harus diisi!');
        return false;
    }
    
    if (!order || order < 1) {
        e.preventDefault();
        alert('Urutan banner harus diisi dengan angka minimal 1!');
        return false;
    }
    
    if (!image) {
        e.preventDefault();
        alert('Gambar banner harus diupload!');
        return false;
    }
    
    return true;
});

console.log('✨ Create Banner page loaded successfully!');
</script>

@endsection