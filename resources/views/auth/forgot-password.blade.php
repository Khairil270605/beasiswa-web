@extends('layouts.app')

@section('title', 'Lupa Password')

@section('content')
<style>
    /* Samakan dengan style login */
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
        color: #c2410c;
    }

    .link-style {
        color: #ff6b35;
        transition: color 0.3s ease;
        text-decoration: none;
    }

    .link-style:hover {
        color: #f7931e;
    }
</style>

<div class="container-fluid login-container d-flex align-items-center justify-content-center"
     style="min-height: 100vh;">
    <div class="col-md-4">
        <div class="card form-container shadow p-4 rounded-4">
            <h3 class="text-center mb-2">Lupa Password</h3>
            <p class="text-center text-muted mb-4">Masukkan email akun Anda untuk menerima link reset password.</p>

            {{-- Sukses --}}
            @if(session('success'))
                <div class="success-message p-3 rounded mb-3 text-center">
                    <i class="fas fa-check-circle me-2"></i>
                    {{ session('success') }}
                </div>
            @endif

            {{-- Status (jika kamu masih pakai session('status')) --}}
            @if(session('status'))
                <div class="success-message p-3 rounded mb-3 text-center">
                    <i class="fas fa-check-circle me-2"></i>
                    {{ session('status') }}
                </div>
            @endif

            {{-- Error umum --}}
            @if(session('error'))
                <div class="error-message p-3 rounded mb-3 text-center">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    {{ session('error') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input id="email" type="email"
                           class="form-control input-field @error('email') is-invalid @enderror"
                           name="email" value="{{ old('email') }}" required autofocus>

                    @error('email')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-grid">
                    <button class="btn btn-primary rounded-pill" type="submit">
                        Kirim Link Reset
                    </button>
                </div>

                <div class="text-center mt-3">
                    <a class="link-style" href="{{ route('login') }}">Kembali ke Login</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
