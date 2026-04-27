@extends('layouts.admin')

@section('title', 'Manajemen Periode')

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
        text-decoration: none;
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

    /* Status badges */
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
        gap: 5px;
    }

    .badge-status-inactive {
        background-color: rgba(108, 117, 125, 0.1);
        color: #6c757d;
        border: 1px solid rgba(108, 117, 125, 0.2);
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        display: inline-flex;
        align-items: center;
        gap: 5px;
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
        display: inline-flex;
        align-items: center;
        gap: 4px;
        text-decoration: none;
    }

    .btn-action:hover {
        transform: scale(1.05);
    }

    .btn-aktifkan {
        background-color: var(--success-color);
        color: white;
    }

    .btn-aktifkan:hover {
        background-color: #218838;
        color: white;
    }

    .btn-nonaktifkan {
        background-color: #6c757d;
        color: white;
    }

    .btn-nonaktifkan:hover {
        background-color: #545b62;
        color: white;
    }

    .btn-edit {
        background-color: var(--warning-color);
        color: #212529;
    }

    .btn-edit:hover {
        background-color: #e0a800;
        color: #212529;
    }

    .btn-delete {
        background-color: var(--danger-color);
        color: white;
    }

    .btn-delete:hover {
        background-color: #c82333;
        color: white;
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

    .periode-name {
        font-weight: 600;
        color: #212529;
    }

    .date-range {
        display: flex;
        align-items: center;
        gap: 6px;
        color: #495057;
        font-size: 0.9rem;
    }

    .action-buttons {
        display: flex;
        gap: 6px;
        justify-content: center;
        align-items: center;
        flex-wrap: wrap;
    }

    /* Row highlight for active periode */
    .row-active {
        background-color: rgba(40, 167, 69, 0.03);
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
            justify-content: center;
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
                    <i class="fas fa-calendar-alt"></i> Manajemen Periode
                </h4>
                <p class="page-subtitle">Kelola periode pendaftaran atau penerimaan Lazismu</p>
            </div>
            <a href="{{ route('admin.periode.create') }}" class="btn btn-lazismu mt-3 mt-md-0">
                <i class="fas fa-plus-circle"></i> Tambah Periode
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

    <!-- Periode Table Card -->
    <div class="card card-custom">
        <div class="card-header card-header-custom">
            <h5>
                <i class="fas fa-list"></i> Daftar Periode
            </h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-custom mb-0">
                    <thead>
                        <tr>
                            <th width="60" class="text-center">No</th>
                            <th>
                                <i class="fas fa-tag me-2"></i>Nama Periode
                            </th>
                            <th>
                                <i class="fas fa-calendar-check me-2"></i>Tanggal Mulai
                            </th>
                            <th>
                                <i class="fas fa-calendar-times me-2"></i>Tanggal Selesai
                            </th>
                            <th width="130" class="text-center">
                                <i class="fas fa-toggle-on me-2"></i>Status
                            </th>
                            <th width="230" class="text-center">
                                <i class="fas fa-cog me-2"></i>Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($periodes as $index => $p)
                            <tr class="{{ $p->status == 'aktif' ? 'row-active' : '' }}">
                                <td class="text-center" data-label="No">
                                    <strong>{{ $index + 1 }}</strong>
                                </td>
                                <td data-label="Nama Periode">
                                    <span class="periode-name">{{ $p->nama_periode }}</span>
                                </td>
                                <td data-label="Tanggal Mulai">
                                    <div class="date-range">
                                        <i class="fas fa-play-circle text-success"></i>
                                        {{ \Carbon\Carbon::parse($p->tanggal_mulai)->format('d M Y') }}
                                    </div>
                                </td>
                                <td data-label="Tanggal Selesai">
                                    <div class="date-range">
                                        <i class="fas fa-stop-circle text-danger"></i>
                                        {{ \Carbon\Carbon::parse($p->tanggal_selesai)->format('d M Y') }}
                                    </div>
                                </td>
                                <td class="text-center" data-label="Status">
                                    @if($p->status == 'aktif')
                                        <span class="badge-status-active">
                                            <i class="fas fa-check-circle"></i> Aktif
                                        </span>
                                    @else
                                        <span class="badge-status-inactive">
                                            <i class="fas fa-times-circle"></i> Nonaktif
                                        </span>
                                    @endif
                                </td>
                                <td class="text-center" data-label="Aksi">
                                    <div class="action-buttons">
                                    <a href="{{ route('admin.periode.pendaftar', $p->id) }}" 
                                    class="btn btn-info btn-action">
                                    <i class="fas fa-users"></i> Pendaftar
                                    </a>
                                        {{-- Toggle Aktif / Nonaktif --}}
                                        @if($p->status == 'aktif')
                                            <button type="button"
                                                    class="btn btn-nonaktifkan btn-action"
                                                    onclick="confirmToggle({{ $p->id }}, 'nonaktifkan')"
                                                    title="Nonaktifkan Periode">
                                                <i class="fas fa-toggle-off"></i> Nonaktifkan
                                            </button>
                                        @else
                                            <button type="button"
                                                    class="btn btn-aktifkan btn-action"
                                                    onclick="confirmToggle({{ $p->id }}, 'aktifkan')"
                                                    title="Aktifkan Periode">
                                                <i class="fas fa-toggle-on"></i> Aktifkan
                                            </button>
                                        @endif

                                        {{-- Edit --}}
                                        <a href="{{ route('admin.periode.edit', $p->id) }}"
                                           class="btn btn-edit btn-action"
                                           title="Edit Periode">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>

                                        {{-- Hapus --}}
                                        <button type="button"
                                                class="btn btn-delete btn-action"
                                                onclick="confirmDelete({{ $p->id }})"
                                                title="Hapus Periode">
                                            <i class="fas fa-trash-alt"></i> Hapus
                                        </button>

                                        {{-- Hidden forms --}}
                                        <form id="toggle-form-{{ $p->id }}"
                                        action="{{ route('admin.periode.aktifkan', $p->id) }}"
                                        method="GET"
                                        style="display: none;">
                                        </form>

                                        <form id="delete-form-{{ $p->id }}"
                                              action="{{ route('admin.periode.destroy', $p->id) }}"
                                              method="POST"
                                              style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>

                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="border-0">
                                    <div class="empty-state">
                                        <div class="empty-icon">
                                            <i class="fas fa-calendar-plus"></i>
                                        </div>
                                        <p class="empty-title">Belum Ada Data Periode</p>
                                        <p class="empty-text">Silakan tambahkan periode pertama untuk memulai</p>
                                        <a href="{{ route('admin.periode.create') }}" class="btn btn-lazismu">
                                            <i class="fas fa-plus"></i> Tambah Periode Pertama
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
function confirmToggle(periodeId, action) {
    const label = action === 'aktifkan' ? 'mengaktifkan' : 'menonaktifkan';
    if (confirm('Apakah Anda yakin ingin ' + label + ' periode ini?')) {
        document.getElementById('toggle-form-' + periodeId).submit();
    }
}

function confirmDelete(periodeId) {
    if (confirm('Apakah Anda yakin ingin menghapus periode ini? Data yang dihapus tidak dapat dikembalikan.')) {
        document.getElementById('delete-form-' + periodeId).submit();
    }
}
</script>
@endsection