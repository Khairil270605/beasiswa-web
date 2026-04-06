@extends('layouts.admin')

@section('title', 'Edit User')

@section('content')
<style>
    :root {
        --primary-color: #ff6b35;
        --secondary-color: #f7931e;
        --success-color: #28a745;
        --danger-color: #dc3545;
        --warning-color: #ffc107;
        --info-color: #17a2b8;
        --light-orange: rgba(255, 107, 53, 0.1);
        --light-secondary: rgba(247, 147, 30, 0.1);
    }
    
    .user-edit-container {
        padding: 24px;
        background-color: #f8f9fa;
        min-height: 100vh;
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
    
    .card-form {
        background: white;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        border: none;
        overflow: hidden;
    }
    
    .card-header-form {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 50%, var(--danger-color) 100%);
        color: white;
        padding: 20px 24px;
        border: none;
    }
    
    .card-header-form h5 {
        margin: 0;
        font-size: 1.3rem;
        font-weight: 600;
    }
    
    .card-body-form {
        padding: 30px 24px;
    }
    
    .form-group {
        margin-bottom: 24px;
    }
    
    .form-group label {
        font-weight: 600;
        color: #495057;
        margin-bottom: 8px;
        font-size: 0.95rem;
        display: block;
    }
    
    .form-group label .required {
        color: var(--danger-color);
        margin-left: 4px;
    }
    
    .form-control-custom {
        border: 2px solid #e9ecef;
        border-radius: 8px;
        padding: 12px 16px;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        width: 100%;
    }
    
    .form-control-custom:focus {
        outline: none;
        border-color: var(--primary-color);
        box-shadow: 0 0 0 0.2rem rgba(255, 107, 53, 0.25);
        background-color: #fff;
    }
    
    .form-control-custom.is-invalid {
        border-color: var(--danger-color);
    }
    
    .form-control-custom.is-invalid:focus {
        box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
    }
    
    .invalid-feedback {
        display: block;
        color: var(--danger-color);
        font-size: 0.85rem;
        margin-top: 6px;
    }
    
    .form-text {
        color: #6c757d;
        font-size: 0.85rem;
        margin-top: 6px;
    }
    
    .btn-back {
        background-color: #6c757d;
        color: white;
        padding: 12px 24px;
        border-radius: 8px;
        font-weight: 500;
        border: none;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        text-decoration: none;
    }
    
    .btn-back:hover {
        background-color: #5a6268;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(108, 117, 125, 0.3);
        text-decoration: none;
    }
    
    .btn-back i {
        margin-right: 8px;
    }
    
    .btn-submit {
        background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
        color: white;
        padding: 12px 24px;
        border-radius: 8px;
        font-weight: 500;
        border: none;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        cursor: pointer;
    }
    
    .btn-submit:hover {
        background: linear-gradient(45deg, #e55a2b, #e6841a);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(255, 107, 53, 0.3);
    }
    
    .btn-submit i {
        margin-right: 8px;
    }
    
    .form-actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 32px;
        padding-top: 24px;
        border-top: 2px solid #e9ecef;
    }
    
    .password-toggle {
        position: absolute;
        right: 16px;
        top: 50%;
        transform: translateY(-50%);
        color: #6c757d;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    
    .password-toggle:hover {
        color: var(--primary-color);
    }
    
    .password-wrapper {
        position: relative;
    }
    
    .role-options {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 16px;
    }
    
    .role-option {
        padding: 16px;
        border: 2px solid #e9ecef;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        background: white;
    }
    
    .role-option:hover {
        border-color: var(--primary-color);
        background-color: var(--light-orange);
    }
    
    .role-option input[type="radio"] {
        width: 20px;
        height: 20px;
        margin-right: 12px;
        cursor: pointer;
        accent-color: var(--primary-color);
    }
    
    .role-option.selected {
        border-color: var(--primary-color);
        background-color: var(--light-orange);
    }
    
    .role-info h6 {
        margin: 0 0 4px 0;
        font-weight: 600;
        color: #212529;
        font-size: 1rem;
    }
    
    .role-info p {
        margin: 0;
        font-size: 0.85rem;
        color: #6c757d;
    }
    
    .info-box {
        background-color: #e7f3ff;
        border-left: 4px solid var(--info-color);
        padding: 16px;
        border-radius: 8px;
        margin-bottom: 24px;
    }
    
    .info-box i {
        color: var(--info-color);
        margin-right: 8px;
    }
    
    .info-box p {
        margin: 0;
        color: #495057;
        font-size: 0.9rem;
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
    
    .page-header,
    .card-form {
        animation: slideInUp 0.5s ease-out forwards;
    }
    
    .card-form {
        animation-delay: 0.1s;
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .user-edit-container {
            padding: 16px;
        }
        
        .page-header {
            padding: 16px;
        }
        
        .page-header h4 {
            font-size: 1.4rem;
        }
        
        .card-body-form {
            padding: 20px 16px;
        }
        
        .form-actions {
            flex-direction: column-reverse;
            gap: 12px;
        }
        
        .btn-back,
        .btn-submit {
            width: 100%;
            justify-content: center;
        }
        
        .role-options {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="user-edit-container">
    <!-- Page Header -->
    <div class="page-header">
        <h4>
            <i class="fas fa-user-edit"></i> Edit User
        </h4>
        <p class="page-subtitle">Perbarui informasi pengguna sistem Lazismu</p>
    </div>

    <!-- Form Card -->
    <div class="card-form">
        <div class="card-header-form">
            <h5>Form Edit Data User</h5>
        </div>
        <div class="card-body-form">
            <form action="{{ route('admin.users.update', $user->id) }}" method="POST" id="userForm">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6">
                        <!-- Nama Lengkap -->
                        <div class="form-group">
                            <label>
                                Nama Lengkap
                                <span class="required">*</span>
                            </label>
                            <input type="text" 
                                   name="name"
                                   class="form-control-custom @error('name') is-invalid @enderror"
                                   value="{{ old('name', $user->name) }}" 
                                   placeholder="Masukkan nama lengkap"
                                   required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <!-- Email -->
                        <div class="form-group">
                            <label>
                                Email
                                <span class="required">*</span>
                            </label>
                            <input type="email" 
                                   name="email"
                                   class="form-control-custom @error('email') is-invalid @enderror"
                                   value="{{ old('email', $user->email) }}" 
                                   placeholder="contoh@email.com"
                                   required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text">
                                Email akan digunakan untuk login ke sistem
                            </small>
                        </div>
                    </div>
                </div>

                <!-- Role -->
                <div class="form-group">
                    <label>
                        Role Pengguna
                        <span class="required">*</span>
                    </label>
                    
                    <div class="role-options">
                        <div class="role-option {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}" onclick="selectRole('admin')">
                            <input type="radio" 
                                   name="role" 
                                   value="admin" 
                                   id="role-admin"
                                   {{ old('role', $user->role) == 'admin' ? 'checked' : '' }}
                                   required>
                            <div class="role-info">
                                <h6>Administrator</h6>
                                <p>Akses penuh ke semua fitur sistem</p>
                            </div>
                        </div>
                        
                        <div class="role-option {{ old('role', $user->role) == 'pewawancara' ? 'selected' : '' }}" onclick="selectRole('pewawancara')">
                            <input type="radio" 
                                   name="role" 
                                   value="pewawancara" 
                                   id="role-pewawancara"
                                   {{ old('role', $user->role) == 'pewawancara' ? 'checked' : '' }}
                                   required>
                            <div class="role-info">
                                <h6>Pewawancara</h6>
                                <p>Dapat melakukan wawancara dan menilai pendaftar</p>
                            </div>
                        </div>
                    </div>
                    
                    @error('role')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Password Section -->
                <div class="info-box">
                    <i class="fas fa-info-circle"></i>
                    <strong>Informasi Password:</strong>
                    <p>Kosongkan jika tidak ingin mengubah password. Isi hanya jika ingin mengganti password lama.</p>
                </div>

                <!-- Password -->
                <div class="form-group">
                    <label>
                        Password Baru
                    </label>
                    <div class="password-wrapper">
                        <input type="password" 
                               name="password"
                               id="password"
                               class="form-control-custom @error('password') is-invalid @enderror"
                               placeholder="Kosongkan jika tidak ingin mengubah password">
                        <i class="fas fa-eye password-toggle" id="togglePassword" onclick="togglePassword()"></i>
                    </div>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="form-text">
                        Password harus mengandung minimal 8 karakter, huruf besar, kecil, angka & simbol
                    </small>
                </div>

                <!-- Confirm Password -->
                <div class="form-group">
                    <label>
                        Konfirmasi Password Baru
                    </label>
                    <div class="password-wrapper">
                        <input type="password" 
                               name="password_confirmation"
                               id="password_confirmation"
                               class="form-control-custom"
                               placeholder="Ulangi password baru">
                        <i class="fas fa-eye password-toggle" id="togglePasswordConfirmation" onclick="togglePasswordConfirmation()"></i>
                    </div>
                    <small class="form-text">
                        Masukkan ulang password untuk konfirmasi
                    </small>
                </div>

                <!-- Form Actions -->
                <div class="form-actions">
                    <a href="{{ route('admin.users.index') }}" class="btn-back">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                    <button type="submit" class="btn-submit">
                        <i class="fas fa-save"></i> Update User
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// Toggle Password Visibility
function togglePassword() {
    const passwordInput = document.getElementById('password');
    const toggleIcon = document.getElementById('togglePassword');
    
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        toggleIcon.classList.remove('fa-eye');
        toggleIcon.classList.add('fa-eye-slash');
    } else {
        passwordInput.type = 'password';
        toggleIcon.classList.remove('fa-eye-slash');
        toggleIcon.classList.add('fa-eye');
    }
}

// Toggle Password Confirmation Visibility
function togglePasswordConfirmation() {
    const passwordInput = document.getElementById('password_confirmation');
    const toggleIcon = document.getElementById('togglePasswordConfirmation');
    
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        toggleIcon.classList.remove('fa-eye');
        toggleIcon.classList.add('fa-eye-slash');
    } else {
        passwordInput.type = 'password';
        toggleIcon.classList.remove('fa-eye-slash');
        toggleIcon.classList.add('fa-eye');
    }
}

// Select Role
function selectRole(role) {
    // Remove all selected classes
    document.querySelectorAll('.role-option').forEach(option => {
        option.classList.remove('selected');
    });
    
    // Check the radio button
    document.getElementById('role-' + role).checked = true;
    
    // Add selected class to clicked option
    event.currentTarget.classList.add('selected');
}

// Form validation animation
document.getElementById('userForm').addEventListener('submit', function(e) {
    const submitBtn = document.querySelector('.btn-submit');
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Memperbarui...';
    submitBtn.disabled = true;
});
</script>
@endsection