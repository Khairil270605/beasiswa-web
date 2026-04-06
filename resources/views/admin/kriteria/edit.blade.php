@extends('layouts.admin')

@section('title', 'Edit Kriteria')

@section('content')
<div class="kriteria-container">
    <!-- Header Section -->
    <div class="page-header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 class="page-title">Edit Kriteria</h1>
                <p class="page-subtitle">Ubah informasi kriteria "{{ $kriteria->nama_kriteria }}"</p>
            </div>
            <a href="{{ $kriteria->kategori === 'dhuafa'
    ? route('admin.kriteria.dhuafa')
    : route('admin.kriteria.kader') }}"
   class="btn-back">
    <i class="fas fa-arrow-left"></i>
    Kembali
</a>

        </div>
    </div>

    <!-- Current Data Info -->
    <div class="current-data-section">
        <div class="current-data-header">
            <h5><i class="fas fa-info-circle"></i> Data Saat Ini</h5>
        </div>
        <div class="current-data-content">
            <div class="row">
                <div class="col-md-3">
                    <div class="current-item">
                        <strong>Kode:</strong>
                        <span>{{ $kriteria->kode_kriteria }}</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="current-item">
                        <strong>Nama:</strong>
                        <span>{{ $kriteria->nama_kriteria }}</span>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="current-item">
                        <strong>Bobot:</strong>
                        <span class="bobot-display">{{ $kriteria->bobot }}</span>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="current-item">
                        <strong>Tipe:</strong>
                        <span class="badge-tipe {{ $kriteria->tipe == 'benefit' ? 'badge-benefit' : 'badge-cost' }}">
                            {{ strtoupper($kriteria->tipe) }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Form Section -->
    <div class="form-container">
        <div class="form-header">
            <h3 class="form-title">
                <i class="fas fa-edit"></i>
                Form Edit Kriteria
            </h3>
        </div>

        <form action="{{ route('admin.kriteria.update', $kriteria) }}" method="POST" class="form-content">
    @csrf
    @method('PUT')


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
                               value="{{ old('kode_kriteria', $kriteria->kode_kriteria) }}"
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
                            Kode unik untuk mengidentifikasi kriteria
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
                               value="{{ old('nama_kriteria', $kriteria->nama_kriteria) }}"
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
                                   value="{{ old('bobot', $kriteria->bobot) }}"
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
                            Nilai bobot antara 0.01 hingga 1.00
                        </div>
                    </div>

                    <!-- Tipe Kriteria -->
                    <div class="form-group">
                        <label for="tipe" class="form-label">
                            <i class="fas fa-list-alt text-info"></i>
                            Tipe Kriteria
                            <span class="required">*</span>
                        </label>
                        <select name="jenis" 
                        id="jenis" 
                        class="form-select {{ $errors->has('jenis') ? 'error' : '' }}" 
                        required>
                    <option value="">-- Pilih Jenis Kriteria --</option>
                    <option value="benefit" {{ old('jenis', $kriteria->jenis) == 'benefit' ? 'selected' : '' }}>
                        Benefit (Semakin Tinggi Semakin Baik)
                    </option>
                    <option value="cost" {{ old('jenis', $kriteria->jenis) == 'cost' ? 'selected' : '' }}>
                        Cost (Semakin Rendah Semakin Baik)
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

            <!-- Change Summary -->
            <div class="change-summary" id="changeSummary" style="display: none;">
                <div class="change-header">
                    <h5><i class="fas fa-exchange-alt"></i> Ringkasan Perubahan</h5>
                </div>
                <div class="change-content" id="changeContent">
                    <!-- Changes will be shown here -->
                </div>
            </div>

            <!-- Warning Section for Related Data -->
            @if($kriteria->subkriterias && $kriteria->subkriterias->count() > 0)
            <div class="warning-section">
                <div class="warning-card">
                    <div class="warning-header">
                        <i class="fas fa-exclamation-triangle"></i>
                        <h5>Perhatian!</h5>
                    </div>
                    <div class="warning-content">
                        <p><strong>Kriteria ini memiliki {{ $kriteria->subkriterias->count() }} sub kriteria terkait:</strong></p>
                        <div class="related-items">
                            @foreach($kriteria->subkriterias->take(5) as $sub)
                                <span class="related-badge">{{ $sub->nama_subkriteria }}</span>
                            @endforeach
                            @if($kriteria->subkriterias->count() > 5)
                                <span class="related-more">+{{ $kriteria->subkriterias->count() - 5 }} lainnya</span>
                            @endif
                        </div>
                        <p class="warning-note">
                            <i class="fas fa-info-circle"></i>
                            Perubahan pada kriteria ini dapat mempengaruhi hasil perhitungan yang menggunakan sub kriteria tersebut.
                        </p>
                    </div>
                </div>
            </div>
            @endif

            <!-- Action Buttons -->
            <div class="form-actions">
                <div class="d-flex justify-content-between align-items-center">
                    <a href="{{ $kriteria->kategori === 'dhuafa'
    ? route('admin.kriteria.dhuafa')
    : route('admin.kriteria.kader') }}"
   class="btn-cancel">
    <i class="fas fa-times"></i>
    Batal
</a>

                    
                    <div class="d-flex gap-2">
                        <button type="button" class="btn-reset" onclick="resetToOriginal()">
                            <i class="fas fa-undo"></i>
                            Reset ke Asli
                        </button>
                        <button type="submit" class="btn-update">
                            <i class="fas fa-save"></i>
                            Update Kriteria
                        </button>
                    </div>
                </div>
            </div>

            <!-- Preview Section -->
            <div class="preview-section" id="previewSection">
                <div class="preview-header">
                    <h5><i class="fas fa-eye"></i> Preview Hasil Edit</h5>
                </div>
                <div class="preview-content" id="previewContent">
                    <!-- Preview akan muncul di sini -->
                </div>
            </div>
        </form>
    </div>
</div>

<script>
// Original data for comparison
const originalData = {
    kode_kriteria: '{{ $kriteria->kode_kriteria }}',
    nama_kriteria: '{{ $kriteria->nama_kriteria }}',
    bobot: '{{ $kriteria->bobot }}',
    tipe: '{{ $kriteria->tipe }}'
};

// Update preview and change summary
function updatePreviewAndChanges() {
    const currentData = {
        kode_kriteria: document.getElementById('kode_kriteria').value,
        nama_kriteria: document.getElementById('nama_kriteria').value,
        bobot: document.getElementById('bobot').value,
        tipe: document.getElementById('tipe').value
    };
    
    // Update preview
    updatePreview(currentData);
    
    // Update change summary
    updateChangeSummary(currentData);
}

function updatePreview(data) {
    const jenisLabel = data.tipe === 'benefit' ? 'Benefit (↑)' : data.tipe === 'cost' ? 'Cost (↓)' : '-';
    const jenisClass = data.tipe === 'benefit' ? 'badge-benefit' : 'badge-cost';
    
    document.getElementById('previewContent').innerHTML = `
        <div class="preview-item">
            <div class="preview-card">
                <div class="d-flex justify-content-between align-items-start">
                    <div class="flex-grow-1">
                        <h6 class="preview-title">${data.kode_kriteria || '[Kode]'} - ${data.nama_kriteria || '[Nama Kriteria]'}</h6>
                        <div class="preview-details">
                            <span class="bobot-display">Bobot: ${data.bobot || '0.00'}</span>
                            <span class="badge-tipe ${jenisClass}">${jenisLabel}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    `;
}

function updateChangeSummary(currentData) {
    const changes = [];
    
    Object.keys(originalData).forEach(key => {
        if (originalData[key] !== currentData[key] && currentData[key]) {
            let fieldName;
            switch(key) {
                case 'kode_kriteria': fieldName = 'Kode Kriteria'; break;
                case 'nama_kriteria': fieldName = 'Nama Kriteria'; break;
                case 'bobot': fieldName = 'Bobot'; break;
                case 'tipe': fieldName = 'Tipe'; break;
                default: fieldName = key;
            }
            
            changes.push({
                field: fieldName,
                from: originalData[key],
                to: currentData[key]
            });
        }
    });
    
    if (changes.length > 0) {
        document.getElementById('changeSummary').style.display = 'block';
        document.getElementById('changeContent').innerHTML = changes.map(change => `
            <div class="change-item">
                <div class="change-field">${change.field}:</div>
                <div class="change-values">
                    <span class="old-value">${change.from}</span>
                    <i class="fas fa-arrow-right"></i>
                    <span class="new-value">${change.to}</span>
                </div>
            </div>
        `).join('');
    } else {
        document.getElementById('changeSummary').style.display = 'none';
    }
}

function resetToOriginal() {
    document.getElementById('kode_kriteria').value = originalData.kode_kriteria;
    document.getElementById('nama_kriteria').value = originalData.nama_kriteria;
    document.getElementById('bobot').value = originalData.bobot;
    document.getElementById('tipe').value = originalData.tipe;
    
    updatePreviewAndChanges();
}

// Add event listeners
document.addEventListener('DOMContentLoaded', function() {
    // Initial update
    updatePreviewAndChanges();
    
    // Add listeners to all form fields
    const inputs = ['kode_kriteria', 'nama_kriteria', 'bobot', 'tipe'];
    inputs.forEach(id => {
        const element = document.getElementById(id);
        element.addEventListener('input', updatePreviewAndChanges);
        element.addEventListener('change', updatePreviewAndChanges);
    });
});

// Form validation
document.querySelector('form').addEventListener('submit', function(e) {
    const bobot = parseFloat(document.getElementById('bobot').value);
    
    if (bobot < 0.01 || bobot > 1) {
        e.preventDefault();
        alert('Bobot harus antara 0.01 hingga 1.00');
        document.getElementById('bobot').focus();
        return;
    }
    
    // Show confirmation if there are changes
    const currentData = {
        kode_kriteria: document.getElementById('kode_kriteria').value,
        nama_kriteria: document.getElementById('nama_kriteria').value,
        bobot: document.getElementById('bobot').value,
        tipe: document.getElementById('tipe').value
    };
    
    const hasChanges = Object.keys(originalData).some(key => originalData[key] !== currentData[key]);
    
    if (hasChanges) {
        if (!confirm('Yakin ingin menyimpan perubahan ini?')) {
            e.preventDefault();
        }
    }
});
</script>

<style>
/* Form Styles untuk Edit Kriteria */
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

.current-data-section {
    background: white;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    margin-bottom: 24px;
    border-left: 4px solid #17a2b8;
}

.current-data-header {
    background-color: #d1ecf1;
    padding: 16px 24px;
    border-radius: 10px 10px 0 0;
    border-bottom: 1px solid #bee5eb;
}

.current-data-header h5 {
    margin: 0;
    color: #0c5460;
    font-weight: 600;
    display: flex;
    align-items: center;
}

.current-data-header i {
    margin-right: 8px;
}

.current-data-content {
    padding: 20px 24px;
}

.current-item {
    display: flex;
    flex-direction: column;
    gap: 4px;
}

.current-item strong {
    color: #495057;
    font-size: 0.9rem;
}

.current-item span {
    color: #212529;
    font-weight: 500;
}

.form-container {
    background: white;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    overflow: hidden;
    margin-bottom: 24px;
}

.form-header {
    background: linear-gradient(135deg, #28a745 0%, #20692e 100%);
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
    border-color: #28a745;
    box-shadow: 0 0 0 3px rgba(40,167,69,0.1);
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

.change-summary {
    margin: 32px 0;
    background: linear-gradient(135deg, #fff3cd 0%, #ffffff 100%);
    border: 1px solid #ffeaa7;
    border-radius: 10px;
    overflow: hidden;
}

.change-header {
    background-color: #ffc107;
    color: #212529;
    padding: 16px 20px;
    font-weight: 600;
}

.change-header h5 {
    margin: 0;
    font-size: 1.1rem;
    display: flex;
    align-items: center;
}

.change-header i {
    margin-right: 8px;
}

.change-content {
    padding: 20px;
}

.change-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 12px 0;
    border-bottom: 1px solid #e9ecef;
}

.change-item:last-child {
    border-bottom: none;
}

.change-field {
    font-weight: 600;
    color: #495057;
}

.change-values {
    display: flex;
    align-items: center;
    gap: 12px;
}

.old-value {
    color: #dc3545;
    text-decoration: line-through;
    background-color: #f8d7da;
    padding: 4px 8px;
    border-radius: 4px;
    font-size: 0.9rem;
}

.new-value {
    color: #28a745;
    font-weight: 600;
    background-color: #d4edda;
    padding: 4px 8px;
    border-radius: 4px;
    font-size: 0.9rem;
}

.warning-section {
    margin: 32px 0;
}

.warning-card {
    background: linear-gradient(135deg, #f8d7da 0%, #ffffff 100%);
    border: 1px solid #f5c6cb;
    border-radius: 10px;
    overflow: hidden;
}

.warning-header {
    background-color: #dc3545;
    color: white;
    padding: 16px 20px;
    font-weight: 600;
    display: flex;
    align-items: center;
}

.warning-header i {
    margin-right: 8px;
}

.warning-header h5 {
    margin: 0;
    font-size: 1.1rem;
}

.warning-content {
    padding: 20px;
}

.related-items {
    margin: 12px 0;
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
}

.related-badge {
    background-color: #e9ecef;
    color: #495057;
    padding: 4px 8px;
    border-radius: 12px;
    font-size: 0.8rem;
    font-weight: 500;
}

.related-more {
    background-color: #6c757d;
    color: white;
    padding: 4px 8px;
    border-radius: 12px;
    font-size: 0.8rem;
    font-weight: 500;
}

.warning-note {
    margin-top: 16px;
    padding: 12px;
    background-color: rgba(220,53,69,0.1);
    border-radius: 6px;
    font-size: 0.9rem;
    color: #721c24;
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

.btn-update {
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

.btn-update:hover {
    background-color: #218838;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(40,167,69,0.3);
}

.btn-cancel i,
.btn-reset i,
.btn-update i {
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
    .current-data-content { padding: 16px; }
    .form-actions .d-flex { flex-direction: column; gap: 12px; }
    .form-actions .d-flex > div { align-self: stretch; }
    .form-actions .d-flex > div .d-flex { justify-content: space-between; }
    
    .change-item {
        flex-direction: column;
        align-items: flex-start;
        gap: 8px;
    }
    
    .change-values {
        align-self: stretch;
        justify-content: space-between;
    }
}
</style>
@endsection