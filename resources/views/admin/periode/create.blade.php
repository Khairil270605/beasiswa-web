@extends('layouts.admin')

@section('title', 'Tambah Periode')

@section('content')
<style>
    :root {
        --primary-color: #ff6b35;
        --secondary-color: #f7931e;
        --success-color: #28a745;
        --danger-color: #dc3545;
        --warning-color: #ffc107;
    }

    .btn-lazismu {
        background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
        border: none;
        color: white;
        padding: 12px 28px;
        border-radius: 8px;
        font-weight: 500;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
        font-size: 0.95rem;
    }

    .btn-lazismu:hover {
        background: linear-gradient(45deg, #e55a2b, #e6841a);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(255, 107, 53, 0.35);
    }

    .btn-back {
        background: #f8f9fa;
        border: 1px solid #dee2e6;
        color: #495057;
        padding: 12px 28px;
        border-radius: 8px;
        font-weight: 500;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
        font-size: 0.95rem;
    }

    .btn-back:hover {
        background: #e9ecef;
        color: #212529;
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
    }

    .page-header {
        background: white;
        padding: 24px;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        margin-bottom: 24px;
        transition: all 0.3s ease;
    }

    .page-header:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 20px rgba(255, 107, 53, 0.1);
    }

    .page-header h4 {
        color: #212529;
        font-weight: bold;
        font-size: 1.8rem;
        margin: 0 0 8px 0;
        display: flex;
        align-items: center;
    }

    .page-header h4 i {
        color: var(--primary-color);
        margin-right: 12px;
    }

    .page-subtitle {
        color: #6c757d;
        font-size: 1rem;
        margin: 0;
    }

    .card-custom {
        border: none;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    .card-header-custom {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 50%, var(--danger-color) 100%);
        color: white;
        border: none;
        padding: 16px 20px;
    }

    .card-header-custom h5 {
        margin: 0;
        font-size: 1.2rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .form-section {
        padding: 28px;
    }

    .form-group-custom {
        margin-bottom: 24px;
    }

    .form-label-custom {
        font-weight: 600;
        color: #343a40;
        font-size: 0.9rem;
        margin-bottom: 8px;
        display: flex;
        align-items: center;
        gap: 7px;
    }

    .form-label-custom i {
        color: var(--primary-color);
        width: 16px;
        text-align: center;
    }

    .form-label-custom .required-mark {
        color: var(--danger-color);
        font-size: 0.85rem;
    }

    .form-control-custom {
        border: 1.5px solid #dee2e6;
        border-radius: 8px;
        padding: 12px 16px;
        font-size: 0.95rem;
        color: #212529;
        background-color: #fff;
        transition: all 0.25s ease;
        width: 100%;
        outline: none;
        appearance: none;
        -webkit-appearance: none;
    }

    .form-control-custom:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(255, 107, 53, 0.15);
    }

    .form-control-custom.is-invalid {
        border-color: var(--danger-color);
        box-shadow: 0 0 0 3px rgba(220, 53, 69, 0.1);
    }

    .form-control-custom::placeholder {
        color: #adb5bd;
    }

    /* Input wrapper with icon */
    .input-wrapper {
        position: relative;
    }

    .input-wrapper .input-icon {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: #adb5bd;
        font-size: 0.9rem;
        pointer-events: none;
        transition: color 0.25s ease;
    }

    .input-wrapper .form-control-custom {
        padding-left: 40px;
    }

    .input-wrapper:focus-within .input-icon {
        color: var(--primary-color);
    }

    .invalid-feedback-custom {
        color: var(--danger-color);
        font-size: 0.82rem;
        margin-top: 6px;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .form-hint {
        color: #6c757d;
        font-size: 0.82rem;
        margin-top: 6px;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    /* Divider */
    .form-divider {
        border: none;
        border-top: 1px dashed #e9ecef;
        margin: 28px 0;
    }

    /* Date grid */
    .date-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    /* Action bar */
    .form-actions {
        display: flex;
        align-items: center;
        gap: 12px;
        padding-top: 8px;
        flex-wrap: wrap;
    }

    /* Alert error */
    .alert-error {
        background: rgba(220, 53, 69, 0.07);
        border: 1px solid rgba(220, 53, 69, 0.25);
        color: #842029;
        padding: 14px 18px;
        border-radius: 8px;
        margin-bottom: 20px;
        display: flex;
        align-items: flex-start;
        gap: 10px;
        font-size: 0.9rem;
    }

    .alert-error i {
        color: var(--danger-color);
        margin-top: 2px;
        flex-shrink: 0;
    }

    .alert-error ul {
        margin: 4px 0 0 0;
        padding-left: 16px;
    }

    /* Animation */
    @keyframes slideInUp {
        from { opacity: 0; transform: translateY(30px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    .page-header  { animation: slideInUp 0.45s ease-out forwards; }
    .card-custom  { animation: slideInUp 0.45s ease-out 0.1s both; }

    /* Responsive */
    @media (max-width: 576px) {
        .date-grid {
            grid-template-columns: 1fr;
        }

        .form-section {
            padding: 20px 16px;
        }

        .form-actions {
            flex-direction: column;
        }

        .btn-lazismu,
        .btn-back {
            width: 100%;
            justify-content: center;
        }

        .page-header h4 {
            font-size: 1.4rem;
        }
    }
</style>

<div class="container-fluid" style="padding: 24px; background-color: #f8f9fa; min-height: 100vh;">

    <!-- Page Header -->
    <div class="page-header">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
                <h4>
                    <i class="fas fa-calendar-plus"></i> Tambah Periode
                </h4>
                <p class="page-subtitle">Buat periode baru untuk pendaftaran atau penerimaan Lazismu</p>
            </div>
            <a href="{{ route('admin.periode.index') }}" class="btn-back">
                <i class="fas fa-arrow-left"></i> Kembali ke Daftar
            </a>
        </div>
    </div>

    <!-- Form Card -->
    <div class="card card-custom" style="max-width: 760px;">
        <div class="card-header card-header-custom">
            <h5>
                <i class="fas fa-plus-circle"></i> Form Tambah Periode
            </h5>
        </div>

        <div class="form-section">

            {{-- Validation Errors --}}
            @if($errors->any())
                <div class="alert-error">
                    <i class="fas fa-exclamation-circle"></i>
                    <div>
                        <strong>Terdapat kesalahan input:</strong>
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <form action="{{ route('admin.periode.store') }}" method="POST" novalidate>
                @csrf

                {{-- Nama Periode --}}
                <div class="form-group-custom">
                    <label class="form-label-custom">
                        <i class="fas fa-tag"></i>
                        Nama Periode
                        <span class="required-mark">*</span>
                    </label>
                    <div class="input-wrapper">
                        <i class="fas fa-pen input-icon"></i>
                        <input type="text"
                               name="nama_periode"
                               class="form-control-custom {{ $errors->has('nama_periode') ? 'is-invalid' : '' }}"
                               placeholder="Contoh: 2025/2026"
                               value="{{ old('nama_periode') }}"
                               required>
                    </div>
                    @error('nama_periode')
                        <div class="invalid-feedback-custom">
                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                        </div>
                    @enderror
                    <div class="form-hint">
                        <i class="fas fa-info-circle"></i>
                        Gunakan format tahun seperti 2025/2026 atau nama deskriptif lainnya.
                    </div>
                </div>

                <hr class="form-divider">

                {{-- Tanggal Mulai & Selesai --}}
                <div class="date-grid">

                    <div class="form-group-custom" style="margin-bottom: 0;">
                        <label class="form-label-custom">
                            <i class="fas fa-play-circle" style="color: var(--success-color);"></i>
                            Tanggal Mulai
                            <span class="required-mark">*</span>
                        </label>
                        <div class="input-wrapper">
                            <i class="fas fa-calendar input-icon"></i>
                            <input type="date"
                                   name="tanggal_mulai"
                                   class="form-control-custom {{ $errors->has('tanggal_mulai') ? 'is-invalid' : '' }}"
                                   value="{{ old('tanggal_mulai') }}"
                                   required>
                        </div>
                        @error('tanggal_mulai')
                            <div class="invalid-feedback-custom">
                                <i class="fas fa-exclamation-circle"></i> {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group-custom" style="margin-bottom: 0;">
                        <label class="form-label-custom">
                            <i class="fas fa-stop-circle" style="color: var(--danger-color);"></i>
                            Tanggal Selesai
                            <span class="required-mark">*</span>
                        </label>
                        <div class="input-wrapper">
                            <i class="fas fa-calendar input-icon"></i>
                            <input type="date"
                                   name="tanggal_selesai"
                                   class="form-control-custom {{ $errors->has('tanggal_selesai') ? 'is-invalid' : '' }}"
                                   value="{{ old('tanggal_selesai') }}"
                                   required>
                        </div>
                        @error('tanggal_selesai')
                            <div class="invalid-feedback-custom">
                                <i class="fas fa-exclamation-circle"></i> {{ $message }}
                            </div>
                        @enderror
                    </div>

                </div>

                <div class="form-hint mt-2">
                    <i class="fas fa-info-circle"></i>
                    Pastikan tanggal selesai lebih besar dari tanggal mulai.
                </div>

                <hr class="form-divider">

                {{-- Actions --}}
                <div class="form-actions">
                    <button type="submit" class="btn-lazismu">
                        <i class="fas fa-save"></i> Simpan Periode
                    </button>
                    <a href="{{ route('admin.periode.index') }}" class="btn-back">
                        <i class="fas fa-times"></i> Batal
                    </a>
                </div>

            </form>
        </div>
    </div>

</div>

<script>
    // Validate: tanggal_selesai must be after tanggal_mulai
    document.querySelector('form').addEventListener('submit', function (e) {
        const mulai   = document.querySelector('[name="tanggal_mulai"]').value;
        const selesai = document.querySelector('[name="tanggal_selesai"]').value;

        if (mulai && selesai && selesai <= mulai) {
            e.preventDefault();
            alert('Tanggal selesai harus lebih besar dari tanggal mulai.');
            document.querySelector('[name="tanggal_selesai"]').focus();
        }
    });

    // Auto set min for tanggal_selesai based on tanggal_mulai
    document.querySelector('[name="tanggal_mulai"]').addEventListener('change', function () {
        const selesaiInput = document.querySelector('[name="tanggal_selesai"]');
        selesaiInput.min = this.value;
        if (selesaiInput.value && selesaiInput.value <= this.value) {
            selesaiInput.value = '';
        }
    });
</script>
@endsection