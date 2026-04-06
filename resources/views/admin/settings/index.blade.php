@extends('layouts.admin')

@section('title', 'Pengaturan Admin')

@section('styles')
<style>
    .settings-gradient-bg {
        background: linear-gradient(135deg, #6f42c1, #495057);
    }
    
    .settings-card {
        border-radius: 1rem;
        overflow: hidden;
        box-shadow: 0 0.5rem 1.5rem rgba(0,0,0,0.1);
        border: none;
    }
    
    .settings-avatar {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, #6f42c1, #495057);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem auto;
        position: relative;
        animation: pulse-settings 2s infinite;
    }
    
    @keyframes pulse-settings {
        0% { box-shadow: 0 0 0 0 rgba(111, 66, 193, 0.4); }
        70% { box-shadow: 0 0 0 10px rgba(111, 66, 193, 0); }
        100% { box-shadow: 0 0 0 0 rgba(111, 66, 193, 0); }
    }
    
    .form-control-secure {
        border: 2px solid #e9ecef;
        border-radius: 0.75rem;
        padding: 0.75rem 3rem 0.75rem 1rem;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        background: #f8f9fa;
        position: relative;
    }
    
    .form-control-secure:focus {
        border-color: #6f42c1;
        box-shadow: 0 0 0 0.2rem rgba(111, 66, 193, 0.1);
        background: white;
        transform: translateY(-1px);
    }
    
    .form-control-secure:hover {
        border-color: #dee2e6;
        background: white;
    }
    
    .btn-settings {
        background: linear-gradient(135deg, #6f42c1, #495057);
        border: none;
        border-radius: 0.75rem;
        padding: 0.75rem 2rem;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 0.25rem 0.75rem rgba(111, 66, 193, 0.3);
    }
    
    .btn-settings:hover {
        transform: translateY(-2px);
        box-shadow: 0 0.5rem 1rem rgba(111, 66, 193, 0.4);
        background: linear-gradient(135deg, #5a2d91, #3a3d42);
    }
    
    .security-card {
        border-radius: 1rem;
        border: none;
        box-shadow: 0 0.25rem 1rem rgba(0,0,0,0.05);
        transition: all 0.3s ease;
    }
    
    .security-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 0.5rem 1.5rem rgba(0,0,0,0.1);
    }
    
    .security-icon {
        width: 50px;
        height: 50px;
        border-radius: 0.75rem;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .input-group-secure {
        position: relative;
    }
    
    .password-toggle {
        position: absolute;
        top: 50%;
        right: 1rem;
        transform: translateY(-50%);
        background: none;
        border: none;
        color: #6c757d;
        z-index: 10;
        cursor: pointer;
        transition: color 0.2s ease;
    }
    
    .password-toggle:hover {
        color: #6f42c1;
    }
    
    .strength-meter {
        height: 4px;
        border-radius: 2px;
        overflow: hidden;
        background: #e9ecef;
        margin-top: 0.5rem;
    }
    
    .strength-bar {
        height: 100%;
        transition: all 0.3s ease;
        border-radius: 2px;
    }
    
    .strength-weak { background: linear-gradient(90deg, #dc3545, #fd7e14); width: 25%; }
    .strength-fair { background: linear-gradient(90deg, #fd7e14, #ffc107); width: 50%; }
    .strength-good { background: linear-gradient(90deg, #ffc107, #20c997); width: 75%; }
    .strength-strong { background: linear-gradient(90deg, #20c997, #198754); width: 100%; }
    
    .section-divider {
        position: relative;
        text-align: center;
        margin: 2rem 0;
    }
    
    .section-divider::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 0;
        right: 0;
        height: 1px;
        background: #dee2e6;
    }
    
    .section-divider span {
        background: white;
        padding: 0 1rem;
        color: #6c757d;
        font-weight: 500;
    }
    
    .preference-switch {
        transform: scale(1.2);
    }
    
    .tab-content-custom {
        border-radius: 0 1rem 1rem 1rem;
        border: 1px solid #dee2e6;
        background: white;
    }
    
    .nav-tabs-custom .nav-link {
        border-radius: 1rem 1rem 0 0;
        border: 1px solid transparent;
        color: #6c757d;
        font-weight: 500;
    }
    
    .nav-tabs-custom .nav-link.active {
        background: white;
        border-color: #dee2e6 #dee2e6 white;
        color: #6f42c1;
    }
</style>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-12">
        <!-- Header Section -->
        <div class="text-center mb-5">
            <div class="settings-avatar">
                <i class="fas fa-cog text-white" style="font-size: 2rem;"></i>
            </div>
            <h1 class="h2 fw-bold text-dark mb-2">Pengaturan Admin</h1>
            <p class="text-muted">Kelola keamanan dan preferensi akun Anda</p>
        </div>

        <!-- Tabs Navigation -->
        <ul class="nav nav-tabs nav-tabs-custom mb-0" id="settingsTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="security-tab" data-bs-toggle="tab" data-bs-target="#security" type="button" role="tab">
                    <i class="fas fa-shield-alt me-2"></i>Keamanan
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="preferences-tab" data-bs-toggle="tab" data-bs-target="#preferences" type="button" role="tab">
                    <i class="fas fa-sliders-h me-2"></i>Preferensi
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="notifications-tab" data-bs-toggle="tab" data-bs-target="#notifications" type="button" role="tab">
                    <i class="fas fa-bell me-2"></i>Notifikasi
                </button>
            </li>
        </ul>

        <!-- Tab Content -->
        <div class="tab-content tab-content-custom p-4" id="settingsTabContent">
            <!-- Security Tab -->
            <div class="tab-pane fade show active" id="security" role="tabpanel">
                <div class="row">
                    <div class="col-lg-8 mb-4">
                        <div class="card settings-card">
                            <div class="card-header settings-gradient-bg text-white py-4">
                                <div class="d-flex align-items-center">
                                    <div class="bg-white bg-opacity-20 rounded-3 p-2 me-3">
                                        <i class="fas fa-key"></i>
                                    </div>
                                    <div>
                                        <h4 class="mb-0 fw-bold">Ubah Password</h4>
                                        <small class="opacity-75">Update password untuk keamanan akun</small>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body p-4">
                                <form action="{{ route('admin.settings.update') }}" method="POST">
                                    @csrf

                                    <!-- Current Password -->
                                    <div class="mb-4">
                                        <label for="current_password" class="form-label fw-semibold text-dark mb-2">
                                            <i class="fas fa-lock text-secondary me-2"></i>
                                            Password Saat Ini
                                        </label>
                                        <div class="input-group-secure">
                                            <input 
                                                type="password" 
                                                name="current_password" 
                                                id="current_password" 
                                                class="form-control form-control-secure" 
                                                placeholder="Masukkan password saat ini"
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
                                        <label for="password" class="form-label fw-semibold text-dark mb-2">
                                            <i class="fas fa-key text-primary me-2"></i>
                                            Password Baru
                                        </label>
                                        <div class="input-group-secure">
                                            <input 
                                                type="password" 
                                                name="password" 
                                                id="password" 
                                                class="form-control form-control-secure" 
                                                placeholder="Masukkan password baru"
                                                onkeyup="checkPasswordStrength(this.value)"
                                            >
                                            <button type="button" class="password-toggle" onclick="togglePassword('password')">
                                                <i class="fas fa-eye" id="password_icon"></i>
                                            </button>
                                        </div>
                                        <!-- Password Strength Meter -->
                                        <div class="strength-meter">
                                            <div class="strength-bar" id="strengthBar"></div>
                                        </div>
                                        <small class="text-muted mt-1 d-block" id="strengthText">
                                            Password minimal 8 karakter dengan kombinasi huruf dan angka
                                        </small>
                                        @error('password')
                                            <div class="text-danger small mt-2 d-flex align-items-center">
                                                <i class="fas fa-exclamation-circle me-1"></i>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <!-- Confirm Password -->
                                    <div class="mb-4">
                                        <label for="password_confirmation" class="form-label fw-semibold text-dark mb-2">
                                            <i class="fas fa-check-double text-success me-2"></i>
                                            Konfirmasi Password
                                        </label>
                                        <div class="input-group-secure">
                                            <input 
                                                type="password" 
                                                name="password_confirmation" 
                                                id="password_confirmation" 
                                                class="form-control form-control-secure" 
                                                placeholder="Konfirmasi password baru"
                                                onkeyup="checkPasswordMatch()"
                                            >
                                            <button type="button" class="password-toggle" onclick="togglePassword('password_confirmation')">
                                                <i class="fas fa-eye" id="password_confirmation_icon"></i>
                                            </button>
                                        </div>
                                        <div id="passwordMatchMessage" class="small mt-2"></div>
                                    </div>

                                    <!-- Submit Button -->
                                    <div class="d-flex gap-3 pt-3">
                                        <button type="submit" class="btn btn-settings text-white flex-fill">
                                            <i class="fas fa-save me-2"></i>
                                            Update Password
                                        </button>
                                        <button type="button" onclick="window.history.back()" class="btn btn-outline-secondary flex-fill">
                                            <i class="fas fa-arrow-left me-2"></i>
                                            Kembali
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Security Status Sidebar -->
                    <div class="col-lg-4">
                        <div class="card security-card mb-4">
                            <div class="card-body text-center p-4">
                                <div class="security-icon bg-success bg-opacity-10 mx-auto mb-3">
                                    <i class="fas fa-shield-check text-success fs-4"></i>
                                </div>
                                <h5 class="card-title">Keamanan Akun</h5>
                                <p class="text-success fw-bold mb-0">Sangat Aman</p>
                                <small class="text-muted">Terakhir diubah: Tidak pernah</small>
                            </div>
                        </div>

                        <div class="card security-card">
                            <div class="card-body p-4">
                                <h6 class="fw-bold mb-3">
                                    <i class="fas fa-lightbulb text-warning me-2"></i>
                                    Tips Keamanan
                                </h6>
                                <ul class="list-unstyled small">
                                    <li class="mb-2">
                                        <i class="fas fa-check text-success me-2"></i>
                                        Gunakan kombinasi huruf besar, kecil, angka
                                    </li>
                                    <li class="mb-2">
                                        <i class="fas fa-check text-success me-2"></i>
                                        Minimal 8 karakter
                                    </li>
                                    <li class="mb-2">
                                        <i class="fas fa-check text-success me-2"></i>
                                        Hindari informasi personal
                                    </li>
                                    <li class="mb-0">
                                        <i class="fas fa-check text-success me-2"></i>
                                        Ganti password secara berkala
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Preferences Tab -->
            <div class="tab-pane fade" id="preferences" role="tabpanel">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card settings-card">
                            <div class="card-header bg-info text-white py-4">
                                <div class="d-flex align-items-center">
                                    <div class="bg-white bg-opacity-20 rounded-3 p-2 me-3">
                                        <i class="fas fa-sliders-h"></i>
                                    </div>
                                    <div>
                                        <h4 class="mb-0 fw-bold">Preferensi Sistem</h4>
                                        <small class="opacity-75">Atur tampilan dan perilaku sistem</small>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-4">
                                <form action="{{ route('admin.preferences.update') }}" method="POST">
                                    @csrf
                                    
                                    <div class="row g-4">
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">
                                                <i class="fas fa-palette text-info me-2"></i>
                                                Tema Tampilan
                                            </label>
                                            <select class="form-select form-control-custom">
                                                <option value="light">Terang</option>
                                                <option value="dark">Gelap</option>
                                                <option value="auto">Otomatis</option>
                                            </select>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">
                                                <i class="fas fa-list text-info me-2"></i>
                                                Item per Halaman
                                            </label>
                                            <select class="form-select form-control-custom">
                                                <option value="10">10 item</option>
                                                <option value="25" selected>25 item</option>
                                                <option value="50">50 item</option>
                                                <option value="100">100 item</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="section-divider">
                                        <span>Pengaturan Dashboard</span>
                                    </div>

                                    <div class="row g-4">
                                        <div class="col-12">
                                            <div class="d-flex justify-content-between align-items-center p-3 bg-light rounded-3">
                                                <div>
                                                    <div class="fw-medium">Auto-refresh Dashboard</div>
                                                    <small class="text-muted">Perbarui data dashboard secara otomatis</small>
                                                </div>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input preference-switch" type="checkbox" checked>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-12">
                                            <div class="d-flex justify-content-between align-items-center p-3 bg-light rounded-3">
                                                <div>
                                                    <div class="fw-medium">Animasi Interface</div>
                                                    <small class="text-muted">Aktifkan animasi dan transisi</small>
                                                </div>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input preference-switch" type="checkbox" checked>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="pt-4">
                                        <button type="submit" class="btn btn-info text-white">
                                            <i class="fas fa-save me-2"></i>
                                            Simpan Preferensi
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="card security-card">
                            <div class="card-body text-center p-4">
                                <div class="security-icon bg-info bg-opacity-10 mx-auto mb-3">
                                    <i class="fas fa-palette text-info fs-4"></i>
                                </div>
                                <h5 class="card-title">Tema Interface</h5>
                                <p class="text-muted small mb-0">Pilih tema yang nyaman untuk mata Anda</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Notifications Tab -->
            <div class="tab-pane fade" id="notifications" role="tabpanel">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card settings-card">
                            <div class="card-header bg-warning text-dark py-4">
                                <div class="d-flex align-items-center">
                                    <div class="bg-dark bg-opacity-10 rounded-3 p-2 me-3">
                                        <i class="fas fa-bell"></i>
                                    </div>
                                    <div>
                                        <h4 class="mb-0 fw-bold">Pengaturan Notifikasi</h4>
                                        <small class="opacity-75">Atur jenis notifikasi yang ingin Anda terima</small>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-4">
                                <form action="{{ route('admin.notifications.update') }}" method="POST">
                                    @csrf
                                    
                                    <div class="row g-4">
                                        <div class="col-12">
                                            <div class="d-flex justify-content-between align-items-center p-3 bg-light rounded-3">
                                                <div>
                                                    <div class="fw-medium">Email Notifikasi</div>
                                                    <small class="text-muted">Terima notifikasi melalui email</small>
                                                </div>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input preference-switch" type="checkbox" checked>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-12">
                                            <div class="d-flex justify-content-between align-items-center p-3 bg-light rounded-3">
                                                <div>
                                                    <div class="fw-medium">Notifikasi Pendaftar Baru</div>
                                                    <small class="text-muted">Alert ketika ada pendaftar beasiswa baru</small>
                                                </div>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input preference-switch" type="checkbox" checked>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-12">
                                            <div class="d-flex justify-content-between align-items-center p-3 bg-light rounded-3">
                                                <div>
                                                    <div class="fw-medium">Laporan Mingguan</div>
                                                    <small class="text-muted">Ringkasan aktivitas mingguan</small>
                                                </div>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input preference-switch" type="checkbox">
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-12">
                                            <div class="d-flex justify-content-between align-items-center p-3 bg-light rounded-3">
                                                <div>
                                                    <div class="fw-medium">Backup Otomatis</div>
                                                    <small class="text-muted">Notifikasi hasil backup data</small>
                                                </div>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input preference-switch" type="checkbox" checked>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="pt-4">
                                        <button type="submit" class="btn btn-warning text-dark">
                                            <i class="fas fa-save me-2"></i>
                                            Simpan Pengaturan
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="card security-card">
                            <div class="card-body text-center p-4">
                                <div class="security-icon bg-warning bg-opacity-10 mx-auto mb-3">
                                    <i class="fas fa-bell text-warning fs-4"></i>
                                </div>
                                <h5 class="card-title">Status Notifikasi</h5>
                                <p class="text-warning fw-bold mb-1">4 Aktif</p>
                                <small class="text-muted">dari 5 jenis notifikasi</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Password toggle functionality
function togglePassword(fieldId) {
    const field = document.getElementById(fieldId);
    const icon = document.getElementById(fieldId + '_icon');
    
    if (field.type === 'password') {
        field.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        field.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
}

// Password strength checker
function checkPasswordStrength(password) {
    const strengthBar = document.getElementById('strengthBar');
    const strengthText = document.getElementById('strengthText');
    
    let strength = 0;
    let message = '';
    
    if (password.length >= 8) strength++;
    if (password.match(/[a-z]/)) strength++;
    if (password.match(/[A-Z]/)) strength++;
    if (password.match(/[0-9]/)) strength++;
    if (password.match(/[^a-zA-Z0-9]/)) strength++;
    
    // Remove all strength classes
    strengthBar.className = 'strength-bar';
    
    switch(strength) {
        case 0:
        case 1:
            strengthBar.classList.add('strength-weak');
            message = 'Password terlalu lemah';
            break;
        case 2:
            strengthBar.classList.add('strength-fair');
            message = 'Password cukup kuat';
            break;
        case 3:
        case 4:
            strengthBar.classList.add('strength-good');
            message = 'Password kuat';
            break;
        case 5:
            strengthBar.classList.add('strength-strong');
            message = 'Password sangat kuat';
            break;
        default:
            message = 'Password minimal 8 karakter dengan kombinasi huruf dan angka';
    }
    
    strengthText.textContent = message;
    strengthText.className = `text-muted mt-1 d-block ${strength <= 1 ? 'text-danger' : strength <= 2 ? 'text-warning' : 'text-success'}`;
}

// Password match checker
function checkPasswordMatch() {
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('password_confirmation').value;
    const matchMessage = document.getElementById('passwordMatchMessage');
    
    if (confirmPassword === '') {
        matchMessage.innerHTML = '';
        return;
    }
    
    if (password === confirmPassword) {
        matchMessage.innerHTML = '<div class="text-success d-flex align-items-center"><i class="fas fa-check me-1"></i> Password cocok</div>';
    } else {
        matchMessage.innerHTML = '<div class="text-danger d-flex align-items-center"><i class="fas fa-times me-1"></i> Password tidak cocok</div>';
    }
}

// Auto-hide alerts
document.addEventListener('DOMContentLoaded', function() {
    setTimeout(function() {
        const alerts = document.querySelectorAll('.alert:not(.alert-permanent)');
        alerts.forEach(function(alert) {
            const bsAlert = new bootstrap.Alert(alert);
            if (bsAlert) {
                bsAlert.close();
            }
        });
    }, 5000);
});
</script>
@endsection