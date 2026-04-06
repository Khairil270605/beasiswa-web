@extends('layouts.app')

@section('title', 'Daftar Akun')

@section('content')
<style>
    /* .login-container {
        background: linear-gradient(135deg, #ff6b35, #f7931e, #dc3545);
        min-height: 100vh;
    } */

    .form-container {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .input-field {
        background: rgba(255, 255, 255, 0.9);
        border: 2px solid #e2e8f0;
        transition: all 0.3s ease;
    }

    .input-field:focus {
        background: rgba(255, 255, 255, 1);
        border-color: #ff6b35;
        box-shadow: 0 0 0 3px rgba(255, 107, 53, 0.1);
    }

    .btn-primary {
        background: linear-gradient(45deg, #ff6b35, #f7931e);
        transition: all 0.3s ease;
        border: none;
    }

    .btn-primary:hover {
        background: linear-gradient(45deg, #f7931e, #ff6b35);
        transform: scale(1.05);
        box-shadow: 0 8px 25px rgba(255, 107, 53, 0.3);
    }

    .error-message {
        background: linear-gradient(135deg, #fef2f2 0%, #fee2e2 100%);
        border: 1px solid #fca5a5;
        color: #dc2626;
    }

    .success-message {
        background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%);
        border: 1px solid #86efac;
        color: #16a34a;
    }

    .link-style {
        color: #ff6b35;
        transition: color 0.3s ease;
    }

    .link-style:hover {
        color: #f7931e;
    }

    .checkbox-custom {
        accent-color: #ff6b35;
    }

    .password-strength {
        height: 5px;
        border-radius: 3px;
        margin-top: 5px;
        transition: all 0.3s ease;
    }

    .strength-weak { background-color: #dc3545; }
    .strength-medium { background-color: #ffc107; }
    .strength-strong { background-color: #28a745; }
</style>

<div class="container-fluid login-container d-flex align-items-center justify-content-center">
    <div class="col-md-5">
        <div class="card form-container shadow p-4 rounded-4">
            <h3 class="text-center mb-4">Buat Akun Baru</h3>

            @if(session('error'))
                <div class="error-message p-3 rounded mb-3">
                    {{ session('error') }}
                </div>
            @endif

            @if(session('success'))
                <div class="success-message p-3 rounded mb-3">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('register.submit') }}">
                @csrf

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="first_name" class="form-label">Nama Depan</label>
                        <input id="first_name" type="text"
                               class="form-control input-field @error('first_name') is-invalid @enderror"
                               name="first_name" value="{{ old('first_name') }}" required autofocus>
                        @error('first_name')
                        <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="last_name" class="form-label">Nama Belakang</label>
                        <input id="last_name" type="text"
                               class="form-control input-field @error('last_name') is-invalid @enderror"
                               name="last_name" value="{{ old('last_name') }}" required>
                        @error('last_name')
                        <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input id="email" type="email"
                           class="form-control input-field @error('email') is-invalid @enderror"
                           name="email" value="{{ old('email') }}" required>
                    @error('email')
                    <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label">Nomor Telepon (Opsional)</label>
                    <input id="phone" type="text"
                           class="form-control input-field @error('phone') is-invalid @enderror"
                           name="phone" value="{{ old('phone') }}" placeholder="08xxxxxxxxxx">
                    @error('phone')
                    <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input id="password" type="password"
                           class="form-control input-field @error('password') is-invalid @enderror"
                           name="password" required>
                    <div id="password-strength" class="password-strength"></div>
                    <small class="text-muted">Minimal 8 karakter, gunakan kombinasi huruf, angka dan simbol</small>
                    @error('password')
                    <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                    <input id="password_confirmation" type="password"
                           class="form-control input-field @error('password_confirmation') is-invalid @enderror"
                           name="password_confirmation" required>
                    <small id="password-match" class="text-muted"></small>
                    @error('password_confirmation')
                    <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3 form-check">
                    <input class="form-check-input checkbox-custom @error('terms') is-invalid @enderror" 
                           type="checkbox" name="terms" id="terms" required>
                    <label class="form-check-label" for="terms">
                        Saya setuju dengan <a href="#" class="link-style">Syarat & Ketentuan</a> dan 
                        <a href="#" class="link-style">Kebijakan Privasi</a>
                    </label>
                    @error('terms')
                    <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary rounded-pill">Daftar Sekarang</button>
                </div>

                <div class="text-center mt-3">
                    <span class="text-muted">Sudah punya akun? </span>
                    <a class="link-style fw-bold" href="{{ route('login') }}">Masuk di sini</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// Password strength indicator
document.getElementById('password').addEventListener('input', function() {
    const password = this.value;
    const strengthBar = document.getElementById('password-strength');
    
    if (password.length === 0) {
        strengthBar.style.width = '0%';
        strengthBar.className = 'password-strength';
        return;
    }
    
    let strength = 0;
    
    // Length check
    if (password.length >= 8) strength++;
    if (password.length >= 12) strength++;
    
    // Character variety
    if (/[a-z]/.test(password)) strength++;
    if (/[A-Z]/.test(password)) strength++;
    if (/\d/.test(password)) strength++;
    if (/[^A-Za-z\d]/.test(password)) strength++;
    
    if (strength <= 2) {
        strengthBar.style.width = '33%';
        strengthBar.className = 'password-strength strength-weak';
    } else if (strength <= 4) {
        strengthBar.style.width = '66%';
        strengthBar.className = 'password-strength strength-medium';
    } else {
        strengthBar.style.width = '100%';
        strengthBar.className = 'password-strength strength-strong';
    }
});

// Password confirmation match
document.getElementById('password_confirmation').addEventListener('input', function() {
    const password = document.getElementById('password').value;
    const confirmation = this.value;
    const matchIndicator = document.getElementById('password-match');
    
    if (confirmation.length === 0) {
        matchIndicator.textContent = '';
        matchIndicator.className = 'text-muted';
        return;
    }
    
    if (password === confirmation) {
        matchIndicator.textContent = '✓ Password cocok';
        matchIndicator.className = 'text-success small';
    } else {
        matchIndicator.textContent = '✗ Password tidak cocok';
        matchIndicator.className = 'text-danger small';
    }
});
</script>
@endsection