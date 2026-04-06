@extends('layouts.admin')

@section('title', 'Tambah Sub Kriteria')

@section('content')
<div class="kriteria-container">
    <!-- Header Section -->
    <div class="page-header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 class="page-title">Tambah Sub Kriteria {{ ucfirst($kategori) }} Baru</h1>
                <p class="page-subtitle">Masukkan informasi sub kriteria untuk kriteria kategori <strong>{{ $kategori === 'dhuafa' ? 'Dhuafa' : 'Kader Muhammadiyah' }}</strong></p>
            </div>
            <a href="{{ route($kategori === 'dhuafa' ? 'admin.subkriteria.dhuafa' : 'admin.subkriteria.kader') }}" class="btn-back">
                <i class="fas fa-arrow-left"></i>
                Kembali ke Daftar
            </a>
        </div>
    </div>

    <!-- Form Section -->
    <div class="form-container">
        <div class="form-header">
            <h3 class="form-title">
                <i class="fas fa-plus-circle"></i>
                Form Tambah Sub Kriteria {{ ucfirst($kategori) }}
            </h3>
        </div>

        <form action="{{ route('admin.subkriteria.store') }}" method="POST" class="form-content">
            @csrf

            <!-- Hidden field untuk kategori -->
            <input type="hidden" name="kategori" value="{{ $kategori }}">

            <div class="row">
                <!-- Left Column -->
                <div class="col-md-6">
                    <!-- Pilih Kriteria -->
                    <div class="form-group">
                        <label for="kriteria_id" class="form-label">
                            <i class="fas fa-layer-group text-primary"></i>
                            Kriteria Induk ({{ ucfirst($kategori) }})
                            <span class="required">*</span>
                        </label>
                        <select name="kriteria_id" 
                                id="kriteria_id" 
                                class="form-select {{ $errors->has('kriteria_id') ? 'error' : '' }}" 
                                required>
                            <option value="">-- Pilih Kriteria {{ ucfirst($kategori) }} --</option>
                            @foreach($kriterias as $kriteria)
                                <option value="{{ $kriteria->id }}" {{ old('kriteria_id') == $kriteria->id ? 'selected' : '' }}>
                                    {{ $kriteria->kode_kriteria }} - {{ $kriteria->nama_kriteria }}
                                </option>
                            @endforeach
                        </select>
                        @error('kriteria_id')
                            <div class="error-message">
                                <i class="fas fa-exclamation-circle"></i>
                                {{ $message }}
                            </div>
                        @enderror
                        <div class="form-help">
                            <i class="fas fa-info-circle"></i>
                            Pilih kriteria induk untuk sub kriteria yang akan dibuat
                        </div>
                        @if($kriterias->count() == 0)
                        <div class="alert alert-warning mt-2">
                            <i class="fas fa-exclamation-triangle"></i>
                            Belum ada kriteria {{ $kategori }}. 
                            <a href="{{ route($kategori === 'dhuafa' ? 'admin.kriteria.dhuafa' : 'admin.kriteria.kader') }}" class="alert-link">
                                Buat kriteria terlebih dahulu
                            </a>
                        </div>
                        @endif
                    </div>

                    <!-- Nama Sub Kriteria -->
                    <div class="form-group">
                        <label for="nama_subkriteria" class="form-label">
                            <i class="fas fa-tag text-success"></i>
                            Nama Sub Kriteria
                            <span class="required">*</span>
                        </label>
                        <input type="text" 
                               name="nama_subkriteria" 
                               id="nama_subkriteria" 
                               class="form-input {{ $errors->has('nama_subkriteria') ? 'error' : '' }}" 
                               value="{{ old('nama_subkriteria') }}"
                               placeholder="Masukkan nama sub kriteria" 
                               required>
                        @error('nama_subkriteria')
                            <div class="error-message">
                                <i class="fas fa-exclamation-circle"></i>
                                {{ $message }}
                            </div>
                        @enderror
                        <div class="form-help">
                            <i class="fas fa-info-circle"></i>
                            Nama deskriptif untuk sub kriteria penilaian
                        </div>
                    </div>
                </div>

                <!-- Right Column -->
                <div class="col-md-6">
                    <!-- Nilai Sub Kriteria -->
                    <div class="form-group">
                        <label for="nilai" class="form-label">
                            <i class="fas fa-calculator text-warning"></i>
                            Nilai Sub Kriteria
                            <span class="required">*</span>
                        </label>
                        <div class="input-group">
                            <input type="number" 
                                   step="0.01" 
                                   min="0" 
                                   name="nilai" 
                                   id="nilai" 
                                   class="form-input {{ $errors->has('nilai') ? 'error' : '' }}" 
                                   value="{{ old('nilai') }}"
                                   placeholder="Contoh: 0.25, 1.00, 5.00" 
                                   required>
                            <span class="input-addon">
                                <i class="fas fa-hashtag"></i>
                            </span>
                        </div>
                        @error('nilai')
                            <div class="error-message">
                                <i class="fas fa-exclamation-circle"></i>
                                {{ $message }}
                            </div>
                        @enderror
                        <div class="form-help">
                            <i class="fas fa-info-circle"></i>
                            Nilai numerik untuk sub kriteria (dapat berupa desimal)
                        </div>
                    </div>

                    <!-- Deskripsi Sub Kriteria (Opsional) -->
                    <div class="form-group">
                        <label for="deskripsi" class="form-label">
                            <i class="fas fa-align-left text-info"></i>
                            Deskripsi
                            <span class="optional">(Opsional)</span>
                        </label>
                        <textarea name="deskripsi" 
                                  id="deskripsi" 
                                  class="form-input {{ $errors->has('deskripsi') ? 'error' : '' }}" 
                                  rows="3"
                                  placeholder="Deskripsi singkat tentang sub kriteria ini...">{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')
                            <div class="error-message">
                                <i class="fas fa-exclamation-circle"></i>
                                {{ $message }}
                            </div>
                        @enderror
                        <div class="form-help">
                            <i class="fas fa-info-circle"></i>
                            Penjelasan tambahan tentang sub kriteria (opsional)
                        </div>
                    </div>
                </div>
            </div>

            <!-- Info Section -->
            <div class="info-section">
                <div class="info-card">
                    <div class="info-header">
                        <i class="fas fa-lightbulb"></i>
                        <h5>Panduan Sub Kriteria {{ ucfirst($kategori) }}</h5>
                    </div>
                    <div class="info-content">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="tip-item">
                                    <div class="tip-icon benefit">
                                        <i class="fas fa-sitemap"></i>
                                    </div>
                                    <div class="tip-content">
                                        <strong>Hierarki</strong>
                                        <p>Sub kriteria adalah bagian dari kriteria induk yang membantu dalam penilaian yang lebih detail.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="tip-item">
                                    <div class="tip-icon cost">
                                        <i class="fas fa-balance-scale"></i>
                                    </div>
                                    <div class="tip-content">
                                        <strong>Nilai</strong>
                                        <p>Nilai sub kriteria menunjukkan tingkat kepentingan atau bobot dalam perhitungan penilaian.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="tip-item">
                                    <div class="tip-icon neutral">
                                        <i class="fas fa-list-ol"></i>
                                    </div>
                                    <div class="tip-content">
                                        <strong>Konsistensi</strong>
                                        <p>Pastikan nilai sub kriteria konsisten dengan jenis kriteria induk (benefit/cost).</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Selected Criteria Info -->
            <div class="selected-criteria-info" id="selectedCriteriaInfo" style="display: none;">
                <div class="criteria-card">
                    <div class="criteria-header">
                        <i class="fas fa-info-circle"></i>
                        <h6>Informasi Kriteria Terpilih</h6>
                    </div>
                    <div class="criteria-details" id="criteriaDetails">
                        <!-- Info kriteria akan muncul di sini via JavaScript -->
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="form-actions">
                <div class="d-flex justify-content-between align-items-center">
                    <a href="{{ route($kategori === 'dhuafa' ? 'admin.subkriteria.dhuafa' : 'admin.subkriteria.kader') }}" class="btn-cancel">
                        <i class="fas fa-times"></i>
                        Batal
                    </a>
                    
                    <div class="d-flex gap-2">
                        <button type="reset" class="btn-reset">
                            <i class="fas fa-undo"></i>
                            Reset Form
                        </button>
                        <button type="submit" class="btn-submit">
                            <i class="fas fa-save"></i>
                            Simpan Sub Kriteria
                        </button>
                    </div>
                </div>
            </div>

            <!-- Preview Section -->
            <div class="preview-section" style="display: none;" id="previewSection">
                <div class="preview-header">
                    <h5><i class="fas fa-eye"></i> Preview Sub Kriteria</h5>
                </div>
                <div class="preview-content" id="previewContent">
                    <!-- Preview akan muncul di sini -->
                </div>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const kriteriaSelect = document.getElementById('kriteria_id');
    const selectedInfo = document.getElementById('selectedCriteriaInfo');
    const criteriaDetails = document.getElementById('criteriaDetails');
    
    // Data kriteria (ini bisa dipass dari controller)
    const kriteriaData = {
        @foreach($kriterias as $kriteria)
        '{{ $kriteria->id }}': {
            kode: '{{ $kriteria->kode_kriteria }}',
            nama: '{{ $kriteria->nama_kriteria }}',
            bobot: '{{ $kriteria->bobot }}',
            jenis: '{{ $kriteria->jenis }}'
        },
        @endforeach
    };
    
    kriteriaSelect.addEventListener('change', function() {
        const selectedId = this.value;
        
        if (selectedId && kriteriaData[selectedId]) {
            const kriteria = kriteriaData[selectedId];
            const jenisIcon = kriteria.jenis === 'benefit' ? 'fa-arrow-up text-success' : 'fa-arrow-down text-danger';
            const jenisText = kriteria.jenis === 'benefit' ? 'Benefit (Semakin Tinggi Semakin Baik)' : 'Cost (Semakin Rendah Semakin Baik)';
            
            criteriaDetails.innerHTML = `
                <div class="row">
                    <div class="col-md-3">
                        <strong>Kode:</strong><br>
                        <span class="badge badge-primary">${kriteria.kode}</span>
                    </div>
                    <div class="col-md-4">
                        <strong>Nama:</strong><br>
                        ${kriteria.nama}
                    </div>
                    <div class="col-md-2">
                        <strong>Bobot:</strong><br>
                        ${parseFloat(kriteria.bobot * 100).toFixed(2)}%
                    </div>
                    <div class="col-md-3">
                        <strong>Jenis:</strong><br>
                        <i class="fas ${jenisIcon}"></i> ${jenisText}
                    </div>
                </div>
            `;
            
            selectedInfo.style.display = 'block';
        } else {
            selectedInfo.style.display = 'none';
        }
    });
    
    // Form validation dan preview
    const form = document.querySelector('.form-content');
    const inputs = form.querySelectorAll('input, select, textarea');
    
    inputs.forEach(input => {
        input.addEventListener('input', updatePreview);
    });
    
    function updatePreview() {
        const formData = new FormData(form);
        const previewSection = document.getElementById('previewSection');
        const previewContent = document.getElementById('previewContent');
        
        if (formData.get('kriteria_id') && formData.get('nama_subkriteria') && formData.get('nilai')) {
            const selectedKriteria = kriteriaData[formData.get('kriteria_id')];
            
            previewContent.innerHTML = `
                <div class="preview-card">
                    <div class="row">
                        <div class="col-md-6">
                            <strong>Kriteria Induk:</strong><br>
                            ${selectedKriteria.kode} - ${selectedKriteria.nama}
                        </div>
                        <div class="col-md-6">
                            <strong>Nama Sub Kriteria:</strong><br>
                            ${formData.get('nama_subkriteria')}
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <strong>Nilai:</strong><br>
                            <span class="badge badge-info">${formData.get('nilai')}</span>
                        </div>
                        <div class="col-md-6">
                            <strong>Deskripsi:</strong><br>
                            ${formData.get('deskripsi') || '<em>Tidak ada deskripsi</em>'}
                        </div>
                    </div>
                </div>
            `;
            
            previewSection.style.display = 'block';
        } else {
            previewSection.style.display = 'none';
        }
    }
});
</script>
<style>
   /* ===== SUB KRITERIA FORM STYLES ===== */

<style>
/* Form Styles untuk Sub Kriteria (Create & Edit) */
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

.btn-back {
    background-color: #6c757d;
    color: white;
    padding: 12px 20px;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 500;
    display: inline-flex;
    align-items: center;
    transition: all 0.3s ease;
    border: none;
}

.btn-back:hover {
    background-color: #5a6268;
    color: white;
    text-decoration: none;
    transform: translateY(-2px);
}

.btn-back i {
    margin-right: 8px;
}

.form-container {
    background: white;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    overflow: hidden;
    margin-bottom: 24px;
}

.form-header {
    background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
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

.form-content {
    padding: 32px;
}

.form-group {
    margin-bottom: 24px;
}

.form-label {
    display: flex;
    align-items: center;
    font-weight: 600;
    color: #495057;
    margin-bottom: 8px;
    font-size: 0.95rem;
}

.form-label i {
    margin-right: 8px;
    width: 16px;
}

.required {
    color: #dc3545;
    margin-left: 4px;
}

.optional {
    color: #6c757d;
    font-weight: 400;
    font-style: italic;
    font-size: 0.85rem;
    margin-left: 4px;
}

.form-input,
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
.form-select:focus {
    border-color: #007bff;
    box-shadow: 0 0 0 3px rgba(0,123,255,0.1);
    outline: none;
}

.form-input.error,
.form-select.error {
    border-color: #dc3545;
}

.input-group {
    display: flex;
    align-items: center;
}

.input-group .form-input {
    border-radius: 8px 0 0 8px;
    margin-right: 0;
}

.input-addon {
    background-color: #e9ecef;
    border: 2px solid #e9ecef;
    border-left: none;
    padding: 12px 16px;
    border-radius: 0 8px 8px 0;
    font-weight: 600;
    color: #6c757d;
    display: flex;
    align-items: center;
    justify-content: center;
    min-width: 50px;
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
    font-size: 0.8rem;
}

.error-message {
    color: #dc3545;
    font-size: 0.85rem;
    margin-top: 6px;
    display: flex;
    align-items: center;
}

.error-message i {
    margin-right: 6px;
}

/* Info Section untuk Tips */
.info-section {
    margin: 32px 0;
}

.info-card {
    background: linear-gradient(135deg, #fff3cd 0%, #ffffff 100%);
    border: 1px solid #ffeaa7;
    border-radius: 10px;
    overflow: hidden;
}

.info-header {
    background-color: #ffc107;
    color: #212529;
    padding: 16px 20px;
    font-weight: 600;
    display: flex;
    align-items: center;
}

.info-header i {
    margin-right: 8px;
}

.info-header h5 {
    margin: 0;
    font-size: 1.1rem;
}

.info-content {
    padding: 20px;
}

.tip-item {
    display: flex;
    align-items: flex-start;
    margin-bottom: 16px;
}

.tip-item:last-child {
    margin-bottom: 0;
}

.tip-icon {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 16px;
    flex-shrink: 0;
}

.tip-icon.benefit {
    background-color: #d4edda;
    color: #155724;
}

.tip-icon.cost {
    background-color: #f8d7da;
    color: #721c24;
}

.tip-icon.neutral {
    background-color: #d1ecf1;
    color: #0c5460;
}

.tip-icon.warning {
    background-color: #fff3cd;
    color: #856404;
}

.tip-content strong {
    display: block;
    margin-bottom: 4px;
    color: #495057;
}

.tip-content p {
    margin: 0;
    font-size: 0.9rem;
    color: #6c757d;
    line-height: 1.4;
}

/* Selected Criteria Info */
.selected-criteria-info {
    margin: 24px 0;
}

.criteria-card {
    background: linear-gradient(135deg, #e8f4fd 0%, #ffffff 100%);
    border: 1px solid #bee5eb;
    border-radius: 10px;
    overflow: hidden;
}

.criteria-header {
    background-color: #17a2b8;
    color: white;
    padding: 16px 20px;
    font-weight: 600;
    display: flex;
    align-items: center;
}

.criteria-header i {
    margin-right: 8px;
}

.criteria-header h6 {
    margin: 0;
    font-size: 1rem;
}

.criteria-details {
    padding: 20px;
}

/* Current Data Section (untuk Edit) */
.current-data-section {
    margin: 32px 0;
}

.current-data-card {
    background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
    border: 1px solid #dee2e6;
    border-radius: 10px;
    overflow: hidden;
}

.current-data-header {
    background-color: #6c757d;
    color: white;
    padding: 16px 20px;
    font-weight: 600;
    display: flex;
    align-items: center;
}

.current-data-header i {
    margin-right: 8px;
}

.current-data-header h5 {
    margin: 0;
    font-size: 1.1rem;
}

.current-data-content {
    padding: 20px;
}

.data-item {
    margin-bottom: 16px;
}

.data-item:last-child {
    margin-bottom: 0;
}

.data-label {
    font-weight: 600;
    color: #495057;
    font-size: 0.85rem;
    margin-bottom: 5px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.data-value {
    color: #212529;
    font-size: 0.95rem;
    line-height: 1.4;
}

/* Change Summary (untuk Edit) */
.change-summary {
    margin: 32px 0;
}

.change-summary .summary-header {
    background-color: #dc3545;
    color: white;
    padding: 16px 20px;
    font-weight: 600;
    display: flex;
    align-items: center;
    border-radius: 10px 10px 0 0;
}

.change-summary .summary-header i {
    margin-right: 8px;
}

.change-summary .summary-header h5 {
    margin: 0;
    font-size: 1.1rem;
}

.summary-content {
    background: #f8f9fa;
    border: 1px solid #dc3545;
    border-top: none;
    border-radius: 0 0 10px 10px;
    padding: 20px;
}

.changes-list {
    display: flex;
    flex-direction: column;
    gap: 16px;
}

.change-item {
    padding: 16px;
    background: white;
    border-radius: 8px;
    border: 1px solid #e9ecef;
}

.change-field {
    margin-bottom: 8px;
    font-weight: 600;
    color: #495057;
    font-size: 0.9rem;
}

.change-values {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 0.85rem;
    flex-wrap: wrap;
}

.old-value {
    color: #dc3545;
    background-color: #f8d7da;
    padding: 4px 8px;
    border-radius: 4px;
    font-weight: 500;
}

.new-value {
    color: #155724;
    background-color: #d4edda;
    padding: 4px 8px;
    border-radius: 4px;
    font-weight: 500;
}

/* Preview Section */
.preview-section {
    margin-top: 32px;
    border-top: 1px solid #e9ecef;
    padding-top: 24px;
}

.preview-header h5 {
    color: #495057;
    font-weight: 600;
    margin-bottom: 16px;
    display: flex;
    align-items: center;
}

.preview-header h5 i {
    margin-right: 8px;
    color: #28a745;
}

.preview-card {
    background-color: #f8f9fa;
    border: 1px solid #e9ecef;
    border-radius: 8px;
    padding: 20px;
}

/* Badges */
.badge {
    display: inline-block;
    padding: 4px 8px;
    font-size: 0.75rem;
    font-weight: 600;
    line-height: 1;
    color: #fff;
    text-align: center;
    white-space: nowrap;
    vertical-align: baseline;
    border-radius: 6px;
    margin-right: 5px;
}

.badge-primary {
    background-color: #007bff;
}

.badge-info {
    background-color: #17a2b8;
}

.badge-success {
    background-color: #28a745;
}

.badge-warning {
    background-color: #ffc107;
    color: #212529;
}

/* Form Actions */
.form-actions {
    border-top: 1px solid #e9ecef;
    padding-top: 24px;
    margin-top: 32px;
}

.btn-cancel {
    background-color: #6c757d;
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

.btn-cancel:hover {
    background-color: #5a6268;
    color: white;
    text-decoration: none;
    transform: translateY(-2px);
}

.btn-reset {
    background-color: #ffc107;
    color: #212529;
    padding: 12px 24px;
    border-radius: 8px;
    font-weight: 500;
    display: inline-flex;
    align-items: center;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
}

.btn-reset:hover {
    background-color: #e0a800;
    transform: translateY(-2px);
}

.btn-submit {
    background-color: #28a745;
    color: white;
    padding: 12px 24px;
    border-radius: 8px;
    font-weight: 500;
    display: inline-flex;
    align-items: center;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
}

.btn-submit:hover {
    background-color: #218838;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(40,167,69,0.3);
}

.btn-cancel i,
.btn-reset i,
.btn-submit i {
    margin-right: 8px;
}

/* Custom Select Styling */
.form-select {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23495057' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m1 6 7 7 7-7'/%3e%3c/svg%3e");
    background-repeat: no-repeat;
    background-position: right 0.75rem center;
    background-size: 16px 12px;
    appearance: none;
    padding-right: 2.25rem;
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

.text-primary { color: #007bff !important; }
.text-success { color: #28a745 !important; }
.text-warning { color: #ffc107 !important; }
.text-info { color: #17a2b8 !important; }
.text-danger { color: #dc3545 !important; }

.mt-3 { margin-top: 1rem; }
.mb-3 { margin-bottom: 1rem; }
.mr-2 { margin-right: 0.5rem; }
.mx-2 { margin-left: 0.5rem; margin-right: 0.5rem; }

/* Responsive Design */
@media (max-width: 768px) {
    .kriteria-container { 
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
    
    .form-content { 
        padding: 20px; 
    }
    
    .form-actions .d-flex { 
        flex-direction: column; 
        gap: 12px; 
    }
    
    .form-actions .d-flex > div { 
        align-self: stretch; 
    }
    
    .form-actions .d-flex > div .d-flex { 
        justify-content: space-between; 
    }
    
    .tip-item {
        flex-direction: column;
        text-align: center;
        align-items: center;
    }
    
    .tip-icon {
        margin-right: 0;
        margin-bottom: 10px;
    }
    
    .change-values {
        flex-direction: column;
        align-items: flex-start;
        gap: 5px;
    }
    
    .change-values i {
        display: none;
    }
    
    .input-group {
        flex-direction: column;
    }
    
    .input-group .form-input {
        border-radius: 8px;
        border: 2px solid #e9ecef;
        margin-bottom: 5px;
    }
    
    .input-addon {
        border-radius: 8px;
        border: 2px solid #e9ecef;
        width: 100%;
    }
}

@media (max-width: 576px) {
    .btn-cancel, .btn-reset, .btn-submit {
        width: 100%;
        justify-content: center;
        margin-bottom: 10px;
    }
    
    .form-actions .d-flex:last-child {
        flex-direction: column;
    }
}
</style>
@endsection