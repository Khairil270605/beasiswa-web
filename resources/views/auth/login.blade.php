@extends('layouts.app')

@section('title', 'Login')

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

    .info-message {
    background: linear-gradient(135deg, #fff7ed 0%, #ffedd5 100%);
    border: 1px solid #fdba74;
    color: #c2410c; /* orange tua biar teks tetap kebaca */
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
</style>

<div class="container-fluid login-container d-flex align-items-center justify-content-center">
    <div class="col-md-4">
        <div class="card form-container shadow p-4 rounded-4">
            <h3 class="text-center mb-4">Login</h3>

            {{-- Pesan info untuk user yang harus login terlebih dahulu --}}
            @if(session('info'))
                <div class="info-message p-3 rounded mb-3 text-center">
                    <i class="fas fa-info-circle me-2"></i>
                    {{ session('info') }}
                </div>
            @endif

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

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input id="email" type="email"
                           class="form-control input-field @error('email') is-invalid @enderror"
                           name="email" value="{{ old('email') }}" required autofocus>
                    @error('email')
                    <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input id="password" type="password"
                           class="form-control input-field @error('password') is-invalid @enderror"
                           name="password" required>
                    @error('password')
                    <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3 form-check">
                    <input class="form-check-input checkbox-custom" type="checkbox" name="remember" id="remember">
                    <label class="form-check-label" for="remember">
                        Remember Me
                    </label>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary rounded-pill">Login</button>
                </div>

                <div class="text-center mt-3">
                    <a class="link-style" href="{{ route('password.request') }}">Lupa Password?</a>
                </div>

                <div class="text-center mt-2">
                    <span class="text-muted">Belum punya akun? </span>
                    <a class="link-style fw-bold" href="{{ route('register') }}">Daftar di sini</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection