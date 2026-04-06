@extends('layouts.app')

@section('title', 'Profile - LAZISMU')

@section('content')
<style>
    :root {
        --primary-color: #ec6b0d;
        --secondary-color: #e8963c;
        --success-color: #28a745;
        --warning-color: #ffc107;
        --danger-color: #dc3545;
        --info-color: #17a2b8;
    }

    .page-header {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        color: white;
        padding: 3rem 0;
        margin: -2rem -15px 2rem -15px;
        position: relative;
        overflow: hidden;
    }

    .page-header::before {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        width: 300px;
        height: 300px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        transform: translate(50%, -50%);
    }

    .page-header h1 {
        font-weight: 700;
        font-size: 2.5rem;
        margin-bottom: 0.5rem;
        position: relative;
        z-index: 2;
    }

    .page-header p {
        font-size: 1.1rem;
        opacity: 0.9;
        position: relative;
        z-index: 2;
    }

    .profile-card {
        background: white;
        border-radius: 15px;
        padding: 2rem;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        margin-bottom: 2rem;
        position: relative;
        overflow: hidden;
    }

    .profile-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 5px;
        background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
    }

    .profile-header {
        text-align: center;
        margin-bottom: 2rem;
        padding-bottom: 2rem;
        border-bottom: 2px solid #f8f9fa;
    }

    .profile-avatar {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        border: 5px solid var(--primary-color);
        padding: 3px;
        margin: 0 auto 1rem;
        position: relative;
        overflow: hidden;
        background: white;
    }

    .profile-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 50%;
    }

    .profile-avatar .avatar-placeholder {
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 3rem;
        color: white;
        border-radius: 50%;
    }

    .profile-name {
        font-size: 1.8rem;
        font-weight: 700;
        color: #333;
        margin-bottom: 0.5rem;
    }

    .section-title {
        color: var(--primary-color);
        font-weight: 700;
        font-size: 1.3rem;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        border-bottom: 2px solid #f8f9fa;
        padding-bottom: 0.5rem;
    }

    .info-group {
        margin-bottom: 2rem;
    }

    .info-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1rem 0;
        border-bottom: 1px solid #f8f9fa;
        flex-wrap: wrap;
    }

    .info-item:last-child {
        border-bottom: none;
    }

    .info-label {
        font-weight: 600;
        color: #495057;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        min-width: 150px;
    }

    .info-value {
        color: #6c757d;
        flex: 1;
        text-align: right;
    }

    .btn-profile {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        color: white;
        padding: 0.8rem 2rem;
        border-radius: 25px;
        border: none;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        text-decoration: none;
    }

    .btn-profile:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(236, 107, 13, 0.3);
        color: white;
    }

    .btn-secondary {
        background: #6c757d;
        color: white;
    }

    .btn-secondary:hover {
        background: #5a6268;
        box-shadow: 0 5px 15px rgba(108, 117, 125, 0.3);
        color: white;
    }

    .form-control {
        border-radius: 8px;
        border: 2px solid #dee2e6;
        padding: 0.75rem 1rem;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 0.2rem rgba(236, 107, 13, 0.25);
    }

    .modal-header {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        color: white;
        border-radius: 0.375rem 0.375rem 0 0;
    }

    .modal-header .btn-close {
        filter: invert(1);
    }

    @media (max-width: 768px) {
        .page-header {
            padding: 2rem 0;
        }
        
        .page-header h1 {
            font-size: 2rem;
        }
        
        .profile-card {
            padding: 1.5rem;
        }
        
        .profile-avatar {
            width: 100px;
            height: 100px;
        }
        
        .info-item {
            flex-direction: column;
            align-items: flex-start;
            gap: 0.5rem;
        }
        
        .info-value {
            text-align: left;
        }
    }

    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .profile-card {
        animation: slideIn 0.6s ease-out;
    }
</style>

<!-- Page Header -->
<div class="page-header">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1><i class="fas fa-user-circle me-3"></i>Profile Saya</h1>
                <p class="mb-0">Kelola informasi pribadi dan pengaturan akun Anda</p>
            </div>
            <div class="col-md-4 text-md-end mt-3 mt-md-0">
                <button class="btn-profile" onclick="editProfile()">
                    <i class="fas fa-edit"></i>Edit Profile
                </button>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="profile-card">
                <div class="profile-header">
                    <div class="profile-avatar">
                        @if(Auth::user()->avatar)
                            <img src="{{ asset('storage/'.Auth::user()->avatar) }}" alt="Profile Avatar">
                        @else
                            <div class="avatar-placeholder">
                                <i class="fas fa-user"></i>
                            </div>
                        @endif
                    </div>
                    <div class="profile-name">{{ Auth::user()->name }}</div>
                </div>

                <!-- Personal Information -->
                <div class="info-group">
                    <h3 class="section-title">
                        <i class="fas fa-user"></i>
                        Informasi Pribadi
                    </h3>
                    
                    <div class="info-item">
                        <div class="info-label">
                            <i class="fas fa-envelope"></i>
                            Email
                        </div>
                        <div class="info-value">{{ Auth::user()->email }}</div>
                    </div>
                    
                    <div class="info-item">
                        <div class="info-label">
                            <i class="fas fa-calendar-plus"></i>
                            Bergabung Sejak
                        </div>
                        <div class="info-value">{{ Auth::user()->created_at->format('d F Y') }}</div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="text-center mt-4">
                    <button class="btn-profile me-3" onclick="changePassword()">
                        <i class="fas fa-key"></i>Ubah Password
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Profile -->
<div class="modal fade" id="editProfileModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-user-edit me-2"></i>Edit Profile
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('user.profile.update') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" name="name" value="{{ Auth::user()->name }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" value="{{ Auth::user()->email }}" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn-profile">
                        <i class="fas fa-save"></i>Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Change Password -->
<div class="modal fade" id="changePasswordModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-key me-2"></i>Ubah Password
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('user.profile.change-password') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Password Lama</label>
                        <input type="password" class="form-control" name="current_password" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password Baru</label>
                        <input type="password" class="form-control" name="new_password" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Konfirmasi Password Baru</label>
                        <input type="password" class="form-control" name="new_password_confirmation" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn-profile">
                        <i class="fas fa-save"></i>Update Password
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Edit profile function
    function editProfile() {
        new bootstrap.Modal(document.getElementById('editProfileModal')).show();
    }

    // Change password function
    function changePassword() {
        new bootstrap.Modal(document.getElementById('changePasswordModal')).show();
    }
</script>

@endsection