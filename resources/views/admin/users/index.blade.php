@extends('layouts.admin')

@section('title', 'Manajemen User')

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
    
    .lazismu-primary {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
    }
    
    .btn-lazismu {
        background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
        border: none;
        color: white;
        padding: 12px 24px;
        border-radius: 8px;
        font-weight: 500;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
    }
    
    .btn-lazismu:hover {
        background: linear-gradient(45deg, #e55a2b, #e6841a);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(255, 107, 53, 0.3);
    }
    
    .btn-lazismu i {
        margin-right: 8px;
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
    }
    
    .card-header-custom h5 i {
        margin-right: 10px;
    }
    
    .table-custom thead th {
        background-color: #f8f9fa;
        border: none;
        padding: 16px 12px;
        font-weight: 600;
        color: #495057;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .table-custom tbody tr {
        transition: all 0.3s ease;
    }
    
    .table-custom tbody tr:hover {
        background-color: rgba(255, 107, 53, 0.05);
        transform: scale(1.01);
    }
    
    .table-custom tbody td {
        padding: 16px 12px;
        border-top: 1px solid #e9ecef;
        vertical-align: middle;
    }
    
    .badge-lazismu-admin {
        background-color: rgba(255, 107, 53, 0.1);
        color: var(--primary-color);
        border: 1px solid rgba(255, 107, 53, 0.2);
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        display: inline-flex;
        align-items: center;
    }
    
    .badge-lazismu-admin i {
        margin-right: 6px;
    }
    
    .badge-lazismu-interviewer {
        background-color: rgba(23, 162, 184, 0.1);
        color: var(--info-color);
        border: 1px solid rgba(23, 162, 184, 0.2);
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        display: inline-flex;
        align-items: center;
    }
    
    .badge-lazismu-interviewer i {
        margin-right: 6px;
    }
    
    .badge-status-active {
        background-color: rgba(40, 167, 69, 0.1);
        color: var(--success-color);
        border: 1px solid rgba(40, 167, 69, 0.2);
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        display: inline-flex;
        align-items: center;
    }
    
    .badge-status-active i {
        margin-right: 6px;
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
    
    .alert-lazismu {
        background: linear-gradient(45deg, rgba(40, 167, 69, 0.1), rgba(40, 167, 69, 0.05));
        border: 1px solid rgba(40, 167, 69, 0.2);
        color: #155724;
        padding: 16px;
        border-radius: 8px;
        margin-bottom: 24px;
        display: flex;
        align-items: center;
    }
    
    .alert-lazismu i {
        color: var(--success-color);
        margin-right: 12px;
        font-size: 1.2rem;
    }
    
    .btn-action {
        padding: 6px 12px;
        font-size: 0.8rem;
        border-radius: 6px;
        transition: all 0.3s ease;
        font-weight: 500;
        border: none;
        cursor: pointer;
    }
    
    .btn-action:hover {
        transform: scale(1.05);
    }
    
    .btn-edit {
        background-color: var(--success-color);
        color: white;
    }
    
    .btn-edit:hover {
        background-color: #218838;
        color: white;
    }
    
    .btn-delete {
        background-color: var(--danger-color);
        color: white;
    }
    
    .btn-delete:hover {
        background-color: #c82333;
    }
    
    .empty-state {
        padding: 60px 20px;
        text-align: center;
    }
    
    .empty-icon {
        font-size: 4rem;
        color: rgba(255, 107, 53, 0.3);
        margin-bottom: 20px;
    }
    
    .empty-title {
        font-size: 1.2rem;
        font-weight: 600;
        margin-bottom: 8px;
        color: #495057;
    }
    
    .empty-text {
        font-size: 1rem;
        color: #6c757d;
        margin-bottom: 24px;
    }
    
    .avatar-circle {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: bold;
        font-size: 1rem;
        flex-shrink: 0;
    }
    
    .user-info {
        display: flex;
        align-items: center;
        gap: 12px;
    }
    
    .user-name {
        font-weight: 600;
        color: #212529;
    }
    
    .action-buttons {
        display: flex;
        gap: 6px;
        justify-content: center;
        align-items: center;
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
    .card-custom {
        animation: slideInUp 0.5s ease-out forwards;
    }
    
    .card-custom {
        animation-delay: 0.1s;
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .page-header {
            padding: 16px;
        }
        
        .page-header h4 {
            font-size: 1.4rem;
        }
        
        .table-custom {
            font-size: 0.85rem;
        }
        
        .action-buttons {
            flex-direction: column;
        }
        
        .btn-action {
            width: 100%;
        }
    }
    
    @media (max-width: 576px) {
        .table-custom thead {
            display: none;
        }
        
        .table-custom tbody td {
            display: block;
            padding: 8px 16px;
            border: none;
            border-bottom: 1px solid #e9ecef;
            text-align: left;
        }
        
        .table-custom tbody td:before {
            content: attr(data-label) ": ";
            font-weight: bold;
            color: var(--primary-color);
            display: inline-block;
            margin-right: 8px;
        }
        
        .table-custom tbody tr {
            display: block;
            border: 1px solid #e9ecef;
            border-radius: 8px;
            margin-bottom: 16px;
            background: white;
            padding: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }
        
        .table-custom tbody tr:hover {
            box-shadow: 0 4px 12px rgba(255, 107, 53, 0.15);
        }
        
        .user-info {
            justify-content: flex-start;
        }
        
        .action-buttons {
            justify-content: flex-start;
        }
    }
</style>

<div class="container-fluid" style="padding: 24px; background-color: #f8f9fa; min-height: 100vh;">
    <!-- Page Header -->
    <div class="page-header">
        <div class="d-flex justify-content-between align-items-center flex-wrap">
            <div>
                <h4>
                    <i class="fas fa-users-cog"></i> Manajemen User
                </h4>
                <p class="page-subtitle">Kelola data pengguna sistem Lazismu</p>
            </div>
            <a href="{{ route('admin.users.create') }}" class="btn btn-lazismu mt-3 mt-md-0">
                <i class="fas fa-user-plus"></i> Tambah User
            </a>
        </div>
    </div>

    <!-- Success Alert -->
    @if(session('success'))
        <div class="alert alert-lazismu alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i>
            <div class="flex-grow-1">
                <strong>Berhasil!</strong> {{ session('success') }}
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- User Table Card -->
    <div class="card card-custom">
        <div class="card-header card-header-custom">
            <h5>
                <i class="fas fa-list"></i> Daftar User
            </h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-custom mb-0">
                    <thead>
                        <tr>
                            <th width="60" class="text-center">No</th>
                            <th>
                                <i class="fas fa-user me-2"></i>Nama
                            </th>
                            <th>
                                <i class="fas fa-envelope me-2"></i>Email
                            </th>
                            <th width="150" class="text-center">
                                <i class="fas fa-user-tag me-2"></i>Role
                            </th>
                            <th width="120" class="text-center">
                                <i class="fas fa-toggle-on me-2"></i>Status
                            </th>
                            <th width="180" class="text-center">
                                <i class="fas fa-cog me-2"></i>Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $index => $user)
                            <tr>
                                <td class="text-center" data-label="No">
                                    <strong>{{ $index + 1 }}</strong>
                                </td>
                                <td data-label="Nama">
                                    <div class="user-info">
                                        <div class="avatar-circle">
                                            {{ strtoupper(substr($user->name, 0, 1)) }}
                                        </div>
                                        <span class="user-name">{{ $user->name }}</span>
                                    </div>
                                </td>
                                <td data-label="Email">
                                    <i class="fas fa-envelope text-muted me-2"></i>
                                    {{ $user->email }}
                                </td>
                                <td class="text-center" data-label="Role">
                                    @if($user->role === 'admin')
                                        <span class="badge-lazismu-admin">
                                            <i class="fas fa-user-shield"></i> Admin
                                        </span>
                                    @else
                                        <span class="badge-lazismu-interviewer">
                                            <i class="fas fa-user-tie"></i> Pewawancara
                                        </span>
                                    @endif
                                </td>
                                <td class="text-center" data-label="Status">
                                    <span class="badge-status-active">
                                        <i class="fas fa-check-circle"></i> Aktif
                                    </span>
                                </td>
                                <td class="text-center" data-label="Aksi">
                                    <div class="action-buttons">
                                        <a href="{{ route('admin.users.edit', $user->id) }}" 
                                           class="btn btn-edit btn-action" 
                                           title="Edit User">
                                            <i class="fas fa-edit me-1"></i> Edit
                                        </a>
                                        <button type="button" 
                                                class="btn btn-delete btn-action" 
                                                onclick="confirmDelete({{ $user->id }})"
                                                title="Hapus User">
                                            <i class="fas fa-trash-alt me-1"></i> Hapus
                                        </button>
                                    </div>
                                    
                                    <form id="delete-form-{{ $user->id }}" 
                                          action="{{ route('admin.users.destroy', $user->id) }}" 
                                          method="POST" 
                                          style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="border-0">
                                    <div class="empty-state">
                                        <div class="empty-icon">
                                            <i class="fas fa-users-slash"></i>
                                        </div>
                                        <p class="empty-title">Belum Ada Data User</p>
                                        <p class="empty-text">Silakan tambahkan user pertama untuk memulai</p>
                                        <a href="{{ route('admin.users.create') }}" class="btn btn-lazismu">
                                            <i class="fas fa-plus"></i> Tambah User Pertama
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
function confirmDelete(userId) {
    if (confirm('Apakah Anda yakin ingin menghapus user ini?')) {
        document.getElementById('delete-form-' + userId).submit();
    }
}
</script>
@endsection