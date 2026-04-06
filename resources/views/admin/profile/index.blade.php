@extends('layouts.admin')

@section('title', 'Profil Admin')

@section('styles')
<style>
    .profile-gradient-bg {
        background: linear-gradient(135deg, #ff6b35, #f7931e);
    }
    
    .profile-card {
        border-radius: 1rem;
        overflow: hidden;
        box-shadow: 0 0.5rem 1.5rem rgba(0,0,0,0.1);
    }
    
    .profile-avatar {
        width: 100px;
        height: 100px;
        background: linear-gradient(135deg, #ff6b35, #f7931e);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem auto;
        position: relative;
        animation: pulse-border 2s infinite;
    }
    
    @keyframes pulse-border {
        0% { box-shadow: 0 0 0 0 rgba(255, 107, 53, 0.4); }
        70% { box-shadow: 0 0 0 10px rgba(255, 107, 53, 0); }
        100% { box-shadow: 0 0 0 0 rgba(255, 107, 53, 0); }
    }
    
    .form-control-custom {
        border: 2px solid #e9ecef;
        border-radius: 0.75rem;
        padding: 0.75rem 1rem;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        background: #f8f9fa;
    }
    
    .form-control-custom:focus {
        border-color: #ff6b35;
        box-shadow: 0 0 0 0.2rem rgba(255, 107, 53, 0.1);
        background: white;
        transform: translateY(-1px);
    }
    
    .form-control-custom:hover {
        border-color: #dee2e6;
        background: white;
    }
    
    .btn-gradient {
        background: linear-gradient(135deg, #ff6b35, #f7931e);
        border: none;
        border-radius: 0.75rem;
        padding: 0.75rem 2rem;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 0.25rem 0.75rem rgba(255, 107, 53, 0.3);
    }
    
    .btn-gradient:hover {
        transform: translateY(-2px);
        box-shadow: 0 0.5rem 1rem rgba(255, 107, 53, 0.4);
        background: linear-gradient(135deg, #e55a2b, #e0831a);
    }
    
    .stats-card {
        border-radius: 1rem;
        border: none;
        box-shadow: 0 0.25rem 1rem rgba(0,0,0,0.05);
        transition: all 0.3s ease;
        height: 100%;
    }
    
    .stats-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 0.5rem 1.5rem rgba(0,0,0,0.1);
    }
    
    .stats-icon {
        width: 50px;
        height: 50px;
        border-radius: 0.75rem;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .input-group-custom {
        position: relative;
    }
    
    .input-icon {
        position: absolute;
        top: 50%;
        right: 1rem;
        transform: translateY(-50%);
        color: #6c757d;
        z-index: 10;
        pointer-events: none;
    }
    
    /* Password Toggle Button */
    .password-toggle {
        position: absolute;
        top: 50%;
        right: 1rem;
        transform: translateY(-50%);
        background: none;
        border: none;
        color: #6c757d;
        cursor: pointer;
        padding: 0.5rem;
        z-index: 10;
        transition: color 0.2s ease;
    }
    
    .password-toggle:hover {
        color: #ff6b35;
    }
    
    .success-alert {
        background: linear-gradient(135deg, #d4edda, #c3e6cb);
        border: 1px solid #b8d4ba;
        border-radius: 0.75rem;
        animation: slideInDown 0.5s ease;
    }
    
    @keyframes slideInDown {
        from { opacity: 0; transform: translateY(-20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    .section-title {
        position: relative;
        padding-bottom: 0.5rem;
        margin-bottom: 2rem;
    }
    
    .section-title::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 50px;
        height: 3px;
        background: linear-gradient(135deg, #ff6b35, #f7931e);
        border-radius: 2px;
    }
    
    /* Section Divider */
    .section-divider {
        border: none;
        border-top: 2px solid #e9ecef;
        margin: 2rem 0;
    }
    
    .section-header {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        margin-bottom: 1.5rem;
        padding-bottom: 0.75rem;
        border-bottom: 2px solid #f1f3f5;
    }
    
    .section-header i {
        color: #ff6b35;
        font-size: 1.25rem;
    }
    
    .section-header h5 {
        margin: 0;
        font-weight: 600;
        color: #212529;
    }
    
    .form-help-text {
        font-size: 0.85rem;
        color: #6c757d;
        display: flex;
        align-items: start;
        gap: 0.5rem;
        margin-top: 0.5rem;
    }
    
    .form-help-text i {
        margin-top: 0.15rem;
    }
</style>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-12">
        <!-- Header Section -->
        <div class="text-center mb-5">
            <div class="profile-avatar">
                <i class="fas fa-user text-white" style="font-size: 2.5rem;"></i>
            </div>
            <h1 class="section-title h2 fw-bold text-dark mb-0">Profil Saya</h1>
            <p class="text-muted">Kelola informasi akun administrator Anda</p>
        </div>

        <!-- Success message akan ditampilkan oleh layout admin -->

        <div class="row">
            <!-- Main Profile Form -->
            <div class="col-lg-8 mb-4">
                <div class="card profile-card border-0">
                    <!-- Card Header -->
                    <div class="card-header profile-gradient-bg text-white border-0 py-4">
                        <div class="d-flex align-items-center">
                            <div class="bg-white bg-opacity-20 rounded-3 p-2 me-3">
                                <i class="fas fa-edit"></i>
                            </div>
                            <div>
                                <h4 class="mb-0 fw-bold">Edit Profil</h4>
                                <small class="opacity-75">Update informasi personal Anda</small>
                            </div>
                        </div>
                    </div>

                    <!-- Card Body -->
                    <div class="card-body p-5">
                        <form action="{{ route('admin.profile.update') }}" method="POST">
                            @csrf
                            @method('PUT')

                            <!-- SECTION: Informasi Dasar -->
                            <div class="section-header">
                                <i class="fas fa-user-circle"></i>
                                <h5>Informasi Dasar</h5>
                            </div>

                            <!-- Name Field -->
                            <div class="mb-4">
                                <label for="name" class="form-label fw-semibold text-dark mb-2">
                                    <i class="fas fa-user text-primary me-2"></i>
                                    Nama Lengkap
                                </label>
                                <div class="input-group-custom">
                                    <input 
                                        type="text" 
                                        name="name" 
                                        id="name" 
                                        value="{{ old('name', $user->name) }}" 
                                        class="form-control form-control-custom" 
                                        placeholder="Masukkan nama lengkap Anda"
                                        required
                                    >
                                    <i class="fas fa-user input-icon"></i>
                                </div>
                                @error('name')
                                    <div class="text-danger small mt-2 d-flex align-items-center">
                                        <i class="fas fa-exclamation-circle me-1"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Email Field -->
                            <div class="mb-4">
                                <label for="email" class="form-label fw-semibold text-dark mb-2">
                                    <i class="fas fa-envelope text-primary me-2"></i>
                                    Alamat Email
                                </label>
                                <div class="input-group-custom">
                                    <input 
                                        type="email" 
                                        name="email" 
                                        id="email" 
                                        value="{{ old('email', $user->email) }}" 
                                        class="form-control form-control-custom" 
                                        placeholder="contoh@email.com"
                                        required
                                    >
                                    <i class="fas fa-envelope input-icon"></i>
                                </div>
                                @error('email')
                                    <div class="text-danger small mt-2 d-flex align-items-center">
                                        <i class="fas fa-exclamation-circle me-1"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Section Divider -->
                            <hr class="section-divider">

                            <!-- SECTION: Ganti Password -->
                            <div class="section-header">
                                <i class="fas fa-lock"></i>
                                <h5>Ganti Password</h5>
                            </div>

                            <div class="alert alert-info border-0 mb-4" style="background: rgba(23, 162, 184, 0.1);">
                                <div class="d-flex align-items-start">
                                    <i class="fas fa-info-circle text-info me-2 mt-1"></i>
                                    <small class="text-muted mb-0">
                                        Kosongkan field password jika tidak ingin mengubah password. 
                                        Isi semua field password di bawah untuk mengganti password.
                                    </small>
                                </div>
                            </div>

                            <!-- Current Password -->
                            <div class="mb-4">
                                <label for="current_password" class="form-label fw-semibold text-dark mb-2">
                                    <i class="fas fa-key text-primary me-2"></i>
                                    Password Saat Ini
                                </label>
                                <div class="input-group-custom">
                                    <input 
                                        type="password" 
                                        name="current_password" 
                                        id="current_password" 
                                        class="form-control form-control-custom" 
                                        placeholder="••••••••••••••"
                                    >
                                    <button type="button" class="password-toggle" onclick="togglePassword('current_password')">
                                        <i class="fas fa-eye" id="current_password_icon"></i>
                                    </button>
                                </div>
                                @error('current_password')
                                    <div class="text-danger small mt-2 d-flex align-items-center">
                                        <i class="fas fa-exclamation-circle me-1"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- New Password -->
                            <div class="mb-4">
                                <label for="new_password" class="form-label fw-semibold text-dark mb-2">
                                    <i class="fas fa-lock text-primary me-2"></i>
                                    Password Baru
                                </label>
                                <div class="input-group-custom">
                                    <input 
                                        type="password" 
                                        name="new_password" 
                                        id="new_password" 
                                        class="form-control form-control-custom" 
                                        placeholder="••••••••••••••"
                                    >
                                    <button type="button" class="password-toggle" onclick="togglePassword('new_password')">
                                        <i class="fas fa-eye" id="new_password_icon"></i>
                                    </button>
                                </div>
                                <div class="form-help-text">
                                    <i class="fas fa-info-circle text-info"></i>
                                    <span>Password minimal 8 karakter</span>
                                </div>
                                @error('new_password')
                                    <div class="text-danger small mt-2 d-flex align-items-center">
                                        <i class="fas fa-exclamation-circle me-1"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Confirm New Password -->
                            <div class="mb-4">
                                <label for="new_password_confirmation" class="form-label fw-semibold text-dark mb-2">
                                    <i class="fas fa-check-circle text-primary me-2"></i>
                                    Konfirmasi Password Baru
                                </label>
                                <div class="input-group-custom">
                                    <input 
                                        type="password" 
                                        name="new_password_confirmation" 
                                        id="new_password_confirmation" 
                                        class="form-control form-control-custom" 
                                        placeholder="••••••••••••••"
                                    >
                                    <button type="button" class="password-toggle" onclick="togglePassword('new_password_confirmation')">
                                        <i class="fas fa-eye" id="new_password_confirmation_icon"></i>
                                    </button>
                                </div>
                                <div class="form-help-text">
                                    <i class="fas fa-info-circle text-info"></i>
                                    <span>Ulangi password baru untuk konfirmasi</span>
                                </div>
                                @error('new_password_confirmation')
                                    <div class="text-danger small mt-2 d-flex align-items-center">
                                        <i class="fas fa-exclamation-circle me-1"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Action Buttons -->
                            <div class="d-flex flex-column flex-sm-row gap-3 pt-3">
                                <button type="submit" class="btn btn-gradient text-white flex-fill">
                                    <i class="fas fa-save me-2"></i>
                                    Simpan Perubahan
                                </button>
                                <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary flex-fill">
                                    <i class="fas fa-arrow-left me-2"></i>
                                    Kembali
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Sidebar Info -->
            <div class="col-lg-4">
                <!-- Account Stats -->
                <div class="row g-3 mb-4">
                    <div class="col-12">
                        <div class="card stats-card text-center">
                            <div class="card-body p-4">
                                <div class="stats-icon bg-success bg-opacity-10 mx-auto mb-3">
                                    <i class="fas fa-shield-check text-success"></i>
                                </div>
                                <h6 class="card-title text-muted mb-1">Status Akun</h6>
                                <h4 class="text-success fw-bold mb-0">Aktif</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="card stats-card text-center">
                            <div class="card-body p-4">
                                <div class="stats-icon bg-primary bg-opacity-10 mx-auto mb-3">
                                    <i class="fas fa-user-shield text-primary"></i>
                                </div>
                                <h6 class="card-title text-muted mb-1">Role</h6>
                                <h4 class="text-primary fw-bold mb-0">Administrator</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="card stats-card text-center">
                            <div class="card-body p-4">
                                <div class="stats-icon bg-warning bg-opacity-10 mx-auto mb-3">
                                    <i class="fas fa-clock text-warning"></i>
                                </div>
                                <h6 class="card-title text-muted mb-1">Terakhir Login</h6>
                                <h4 class="text-warning fw-bold mb-0">Hari ini</h4>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Security Tips -->
                <div class="card border-0" style="background: linear-gradient(135deg, #fff5f2, #fef7f0);">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-start">
                            <div class="bg-warning bg-opacity-20 rounded-3 p-2 me-3 flex-shrink-0">
                                <i class="fas fa-lightbulb text-warning"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold text-dark mb-2">
                                    <i class="fas fa-shield-alt text-warning me-1"></i>
                                    Tips Keamanan
                                </h6>
                                <p class="small text-muted mb-0">
                                    Pastikan email yang Anda gunakan masih aktif untuk menerima notifikasi penting dari sistem.
                                    Ganti password secara berkala untuk keamanan akun Anda.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Toggle password visibility
function togglePassword(fieldId) {
    const input = document.getElementById(fieldId);
    const icon = document.getElementById(fieldId + '_icon');
    
    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        input.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
}

console.log('✅ Profile page loaded successfully!');
</script>
@endsection