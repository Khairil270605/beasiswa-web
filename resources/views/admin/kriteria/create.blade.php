@extends('layouts.admin')

@section('title', 'Tambah Kriteria')

@section('content')
<div class="kriteria-container">
    <!-- Header Section -->
    <div class="page-header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 class="page-title">Tambah Kriteria Baru</h1>
                <p class="page-subtitle">Masukkan informasi kriteria untuk sistem penilaian</p>
            </div>
           <a href="{{ $jenis === 'dhuafa' 
                ? route('admin.kriteria.dhuafa') 
                : route('admin.kriteria.kader') }}" 
            class="btn-back">
            </a>
        </div>
    </div>

    <!-- Form Section -->
    <div class="form-container">
        <div class="form-header">
            <h3 class="form-title">
                <i class="fas fa-plus-circle"></i>
                Form Tambah Kriteria
            </h3>
        </div>

        <form action="{{ route('admin.kriteria.store') }}" method="POST" class="form-content">
            @csrf
            <input type="hidden" name="kategori" value="{{ $jenis }}">
            <div class="row">
                <!-- Left Column -->
                <div class="col-md-6">
                    <!-- Kode Kriteria -->
                    <div class="form-group">
                        <label for="kode_kriteria" class="form-label">
                            <i class="fas fa-code text-primary"></i>
                            Kode Kriteria
                            <span class="required">*</span>
                        </label>
                        <input type="text" 
                               name="kode_kriteria" 
                               id="kode_kriteria" 
                               class="form-input {{ $errors->has('kode_kriteria') ? 'error' : '' }}" 
                               value="{{ old('kode_kriteria') }}"
                               placeholder="Contoh: KR01, KR02" 
                               required>
                        @error('kode_kriteria')
                            <div class="error-message">
                                <i class="fas fa-exclamation-circle"></i>
                                {{ $message }}
                            </div>
                        @enderror
                        <div class="form-help">
                            <i class="fas fa-info-circle"></i>
                            Kode unik untuk mengidentifikasi kriteria (misal: KR01, KR02)
                        </div>
                    </div>

                    <!-- Nama Kriteria -->
                    <div class="form-group">
                        <label for="nama_kriteria" class="form-label">
                            <i class="fas fa-tag text-success"></i>
                            Nama Kriteria
                            <span class="required">*</span>
                        </label>
                        <input type="text" 
                               name="nama_kriteria" 
                               id="nama_kriteria" 
                               class="form-input {{ $errors->has('nama_kriteria') ? 'error' : '' }}" 
                               value="{{ old('nama_kriteria') }}"
                               placeholder="Masukkan nama kriteria" 
                               required>
                        @error('nama_kriteria')
                            <div class="error-message">
                                <i class="fas fa-exclamation-circle"></i>
                                {{ $message }}
                            </div>
                        @enderror
                        <div class="form-help">
                            <i class="fas fa-info-circle"></i>
                            Nama deskriptif untuk kriteria penilaian
                        </div>
                    </div>
                </div>

                <!-- Right Column -->
                <div class="col-md-6">
                    <!-- Bobot -->
                    <div class="form-group">
                        <label for="bobot" class="form-label">
                            <i class="fas fa-weight-hanging text-warning"></i>
                            Bobot Kriteria
                            <span class="required">*</span>
                        </label>
                        <div class="input-group">
                            <input type="number" 
                                   step="0.01" 
                                   min="0" 
                                   max="1" 
                                   name="bobot" 
                                   id="bobot" 
                                   class="form-input {{ $errors->has('bobot') ? 'error' : '' }}" 
                                   value="{{ old('bobot') }}"
                                   placeholder="0.00" 
                                   required>
                            <span class="input-addon">%</span>
                        </div>
                        @error('bobot')
                            <div class="error-message">
                                <i class="fas fa-exclamation-circle"></i>
                                {{ $message }}
                            </div>
                        @enderror
                        <div class="form-help">
                            <i class="fas fa-info-circle"></i>
                            Nilai bobot antara 0.01 hingga 1.00 (total semua bobot harus = 1)
                        </div>
                    </div>

                    <!-- Jenis Kriteria -->
                    <div class="form-group">
                        <label for="jenis" class="form-label">
                            <i class="fas fa-list-alt text-info"></i>
                            Jenis Kriteria
                            <span class="required">*</span>
                        </label>
                        <select name="jenis" 
                                id="jenis" 
                                class="form-select {{ $errors->has('jenis') ? 'error' : '' }}" 
                                required>
                            <option value="">-- Pilih Jenis Kriteria --</option>
                            <option value="benefit" {{ old('jenis') == 'benefit' ? 'selected' : '' }}>
                                <i class="fas fa-arrow-up"></i> Benefit (Semakin Tinggi Semakin Baik)
                            </option>
                            <option value="cost" {{ old('jenis') == 'cost' ? 'selected' : '' }}>
                                <i class="fas fa-arrow-down"></i> Cost (Semakin Rendah Semakin Baik)
                            </option>
                        </select>
                        @error('jenis')
                            <div class="error-message">
                                <i class="fas fa-exclamation-circle"></i>
                                {{ $message }}
                            </div>
                        @enderror
                        <div class="form-help">
                            <i class="fas fa-info-circle"></i>
                            Benefit: nilai tinggi = baik | Cost: nilai rendah = baik
                        </div>
                    </div>
                </div>
            </div>

            <!-- Info Section -->
            <div class="info-section">
                <div class="info-card">
                    <div class="info-header">
                        <i class="fas fa-lightbulb"></i>
                        <h5>Tips Pengisian Form</h5>
                    </div>
                    <div class="info-content">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="tip-item">
                                    <div class="tip-icon benefit">
                                        <i class="fas fa-thumbs-up"></i>
                                    </div>
                                    <div class="tip-content">
                                        <strong>Kriteria Benefit</strong>
                                        <p>Gunakan untuk kriteria dimana nilai yang lebih tinggi lebih diinginkan. Contoh: IPK, Pengalaman, Prestasi.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="tip-item">
                                    <div class="tip-icon cost">
                                        <i class="fas fa-thumbs-down"></i>
                                    </div>
                                    <div class="tip-content">
                                        <strong>Kriteria Cost</strong>
                                        <p>Gunakan untuk kriteria dimana nilai yang lebih rendah lebih diinginkan. Contoh: Jarak, Biaya, Waktu.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="form-actions">
                <div class="d-flex justify-content-between align-items-center">
                    <a href="{{ $jenis === 'dhuafa' 
                        ? route('admin.kriteria.dhuafa') 
                        : route('admin.kriteria.kader') }}" 
                    class="btn-cancel">
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
                            Simpan Kriteria
                        </button>
                    </div>
                </div>
            </div>

            <!-- Preview Section -->
            <div class="preview-section" style="display: none;" id="previewSection">
                <div class="preview-header">
                    <h5><i class="fas fa-eye"></i> Preview Kriteria</h5>
                </div>
                <div class="preview-content" id="previewContent">
                    <!-- Preview akan muncul di sini -->
                </div>
            </div>
        </form>
    </div>
</div>

<script>
// Preview functionality
function updatePreview() {
    const kode = document.getElementById('kode_kriteria').value;
    const nama = document.getElementById('nama_kriteria').value;
    const bobot = document.getElementById('bobot').value;
    const jenis = document.getElementById('jenis').value;
    
    if (kode || nama || bobot || jenis) {
        document.getElementById('previewSection').style.display = 'block';
        
        const jenisLabel = jenis === 'benefit' ? 'Benefit (↑)' : jenis === 'cost' ? 'Cost (↓)' : '-';
        const jenisClass = jenis === 'benefit' ? 'badge-benefit' : 'badge-cost';
        
        document.getElementById('previewContent').innerHTML = `
            <div class="preview-item">
                <div class="preview-card">
                    <div class="d-flex justify-content-between align-items-start">
                        <div class="flex-grow-1">
                            <h6 class="preview-title">${kode || '[Kode]'} - ${nama || '[Nama Kriteria]'}</h6>
                            <div class="preview-details">
                                <span class="bobot-display">Bobot: ${bobot || '0.00'}</span>
                                <span class="badge-tipe ${jenisClass}">${jenisLabel}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `;
    } else {
        document.getElementById('previewSection').style.display = 'none';
    }
}

// Add event listeners
document.addEventListener('DOMContentLoaded', function() {
    const inputs = ['kode_kriteria', 'nama_kriteria', 'bobot', 'jenis'];
    inputs.forEach(id => {
        document.getElementById(id).addEventListener('input', updatePreview);
        document.getElementById(id).addEventListener('change', updatePreview);
    });
});

// Form validation
document.querySelector('form').addEventListener('submit', function(e) {
    const bobot = parseFloat(document.getElementById('bobot').value);
    
    if (bobot < 0.01 || bobot > 1) {
        e.preventDefault();
        alert('Bobot harus antara 0.01 hingga 1.00');
        document.getElementById('bobot').focus();
    }
});
</script>

<style>
/* Form Styles untuk Tambah Kriteria */
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

.preview-section {
    margin-top: 32px;
    border-top: 1px solid #e9ecef;
    padding-top: 24px;
}

.preview-header h5 {
    color: #495057;
    font-weight: 600;
    margin-bottom: 16px;
}

.preview-card {
    background-color: #f8f9fa;
    border: 1px solid #e9ecef;
    border-radius: 8px;
    padding: 16px;
}

.preview-title {
    color: #212529;
    font-weight: 600;
    margin-bottom: 8px;
}

.preview-details {
    display: flex;
    gap: 12px;
    align-items: center;
}

.bobot-display {
    font-weight: 600;
    color: #007bff;
}

.badge-tipe {
    padding: 4px 8px;
    border-radius: 12px;
    font-size: 0.75rem;
    font-weight: 500;
    text-transform: uppercase;
}

.badge-benefit {
    background-color: #d4edda;
    color: #155724;
}

.badge-cost {
    background-color: #f8d7da;
    color: #721c24;
}

@media (max-width: 768px) {
    .kriteria-container { padding: 16px; }
    .page-header { padding: 16px; }
    .form-content { padding: 20px; }
    .form-actions .d-flex { flex-direction: column; gap: 12px; }
    .form-actions .d-flex > div { align-self: stretch; }
    .form-actions .d-flex > div .d-flex { justify-content: space-between; }
}
</style>
@endsection