@extends('layouts.admin')

@section('title', 'Data Pendaftar - ' . $periode->nama_periode)

@section('content')
<style>
    :root {
        --primary-color: #ff6b35;
        --secondary-color: #f7931e;
        --success-color: #28a745;
        --danger-color: #dc3545;
        --warning-color: #ffc107;
        --info-color: #17a2b8;
    }

    .btn-export {
        background: linear-gradient(45deg, #1d6f42, #28a745);
        border: none;
        color: white;
        padding: 10px 22px;
        border-radius: 8px;
        font-weight: 500;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
        font-size: 0.9rem;
    }

    .btn-export:hover {
        background: linear-gradient(45deg, #165a34, #218838);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(40, 167, 69, 0.35);
    }

    .btn-back {
        background: #f8f9fa;
        border: 1px solid #dee2e6;
        color: #495057;
        padding: 10px 22px;
        border-radius: 8px;
        font-weight: 500;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
        font-size: 0.9rem;
    }

    .btn-back:hover {
        background: #e9ecef;
        color: #212529;
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(0,0,0,0.08);
    }

    .page-header {
        background: white;
        padding: 24px;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        margin-bottom: 24px;
        transition: all 0.3s ease;
    }

    .page-header:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 20px rgba(255,107,53,0.1);
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

    /* Stats row */
    .stats-row {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
        gap: 16px;
        margin-bottom: 24px;
    }

    .stat-card {
        background: white;
        border-radius: 10px;
        padding: 18px 20px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        display: flex;
        align-items: center;
        gap: 14px;
        transition: all 0.3s ease;
        animation: slideInUp 0.45s ease-out both;
    }

    .stat-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 18px rgba(0,0,0,0.1);
    }

    .stat-icon {
        width: 48px;
        height: 48px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        flex-shrink: 0;
    }

    .stat-icon.orange  { background: rgba(255,107,53,0.12); color: var(--primary-color); }
    .stat-icon.green   { background: rgba(40,167,69,0.12);  color: var(--success-color); }
    .stat-icon.yellow  { background: rgba(255,193,7,0.15);  color: #856404; }
    .stat-icon.blue    { background: rgba(23,162,184,0.12); color: var(--info-color); }
    .stat-icon.red     { background: rgba(220,53,69,0.1);   color: var(--danger-color); }

    .stat-info .stat-value {
        font-size: 1.6rem;
        font-weight: 700;
        color: #212529;
        line-height: 1;
    }

    .stat-info .stat-label {
        font-size: 0.8rem;
        color: #6c757d;
        margin-top: 3px;
    }

    /* Card */
    .card-custom {
        border: none;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        overflow: hidden;
    }

    .card-header-custom {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 50%, var(--danger-color) 100%);
        color: white;
        border: none;
        padding: 16px 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 10px;
    }

    .card-header-custom h5 {
        margin: 0;
        font-size: 1.2rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    /* Search box inside header */
    .header-search {
        position: relative;
    }

    .header-search input {
        background: rgba(255,255,255,0.15);
        border: 1px solid rgba(255,255,255,0.3);
        border-radius: 8px;
        color: white;
        padding: 7px 14px 7px 34px;
        font-size: 0.85rem;
        outline: none;
        transition: all 0.25s ease;
        width: 200px;
    }

    .header-search input::placeholder { color: rgba(255,255,255,0.7); }
    .header-search input:focus {
        background: rgba(255,255,255,0.25);
        border-color: rgba(255,255,255,0.6);
        width: 240px;
    }

    .header-search i {
        position: absolute;
        left: 10px;
        top: 50%;
        transform: translateY(-50%);
        color: rgba(255,255,255,0.8);
        font-size: 0.8rem;
        pointer-events: none;
    }

    /* Table */
    .table-custom thead th {
        background-color: #f8f9fa;
        border: none;
        padding: 14px 12px;
        font-weight: 600;
        color: #495057;
        font-size: 0.82rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .table-custom tbody tr {
        transition: all 0.25s ease;
    }

    .table-custom tbody tr:hover {
        background-color: rgba(255,107,53,0.04);
        transform: scale(1.005);
    }

    .table-custom tbody td {
        padding: 14px 12px;
        border-top: 1px solid #f0f0f0;
        vertical-align: middle;
        font-size: 0.92rem;
    }

    /* Avatar */
    .avatar-circle {
        width: 38px;
        height: 38px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 700;
        font-size: 0.95rem;
        flex-shrink: 0;
    }

    .user-info {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .user-name  { font-weight: 600; color: #212529; }
    .user-email { font-size: 0.82rem; color: #6c757d; }

    /* Jenis badge */
    .badge-jenis {
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }

    .badge-beasiswa {
        background: rgba(23,162,184,0.1);
        color: var(--info-color);
        border: 1px solid rgba(23,162,184,0.25);
    }

    .badge-reguler {
        background: rgba(247,147,30,0.1);
        color: #c07000;
        border: 1px solid rgba(247,147,30,0.3);
    }

    .badge-lainnya {
        background: rgba(108,117,125,0.1);
        color: #495057;
        border: 1px solid rgba(108,117,125,0.2);
    }

    /* Status badge */
    .badge-status {
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }

    .badge-lolos, .badge-diterima {
        background: rgba(40,167,69,0.1);
        color: var(--success-color);
        border: 1px solid rgba(40,167,69,0.2);
    }

    .badge-pending, .badge-proses {
        background: rgba(255,193,7,0.12);
        color: #856404;
        border: 1px solid rgba(255,193,7,0.3);
    }

    .badge-ditolak, .badge-gagal {
        background: rgba(220,53,69,0.08);
        color: var(--danger-color);
        border: 1px solid rgba(220,53,69,0.2);
    }

    .badge-default {
        background: rgba(108,117,125,0.1);
        color: #495057;
        border: 1px solid rgba(108,117,125,0.2);
    }

    /* Empty state */
    .empty-state {
        padding: 60px 20px;
        text-align: center;
    }

    .empty-icon {
        font-size: 4rem;
        color: rgba(255,107,53,0.25);
        margin-bottom: 16px;
    }

    .empty-title {
        font-size: 1.1rem;
        font-weight: 600;
        color: #495057;
        margin-bottom: 6px;
    }

    .empty-text {
        font-size: 0.92rem;
        color: #6c757d;
    }

    /* Periode info strip */
    .periode-strip {
        background: linear-gradient(135deg, rgba(255,107,53,0.06), rgba(247,147,30,0.06));
        border: 1px solid rgba(255,107,53,0.18);
        border-radius: 8px;
        padding: 12px 18px;
        margin-bottom: 24px;
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 0.88rem;
        color: #495057;
        flex-wrap: wrap;
    }

    .periode-strip i.pi { color: var(--primary-color); }

    .periode-strip .ps-item {
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .periode-strip .sep {
        color: #dee2e6;
        font-size: 1.1rem;
    }

    .ps-status-active {
        background: rgba(40,167,69,0.1);
        color: var(--success-color);
        border: 1px solid rgba(40,167,69,0.25);
        padding: 2px 10px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }

    .ps-status-inactive {
        background: rgba(108,117,125,0.1);
        color: #6c757d;
        border: 1px solid rgba(108,117,125,0.2);
        padding: 2px 10px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }

    /* Nomor urut */
    .no-urut {
        width: 28px;
        height: 28px;
        background: rgba(255,107,53,0.1);
        color: var(--primary-color);
        border-radius: 6px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 0.8rem;
    }

    /* Row hidden by search */
    .row-hidden { display: none; }

    /* Animation */
    @keyframes slideInUp {
        from { opacity: 0; transform: translateY(30px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    .page-header  { animation: slideInUp 0.45s ease-out forwards; }
    .stats-row .stat-card:nth-child(1) { animation-delay: 0.05s; }
    .stats-row .stat-card:nth-child(2) { animation-delay: 0.1s;  }
    .stats-row .stat-card:nth-child(3) { animation-delay: 0.15s; }
    .stats-row .stat-card:nth-child(4) { animation-delay: 0.2s;  }
    .card-custom  { animation: slideInUp 0.45s ease-out 0.15s both; }

    /* Responsive */
    @media (max-width: 768px) {
        .page-header h4 { font-size: 1.4rem; }
        .header-search input { width: 160px; }
        .header-search input:focus { width: 180px; }
    }

    @media (max-width: 576px) {
        .table-custom thead { display: none; }

        .table-custom tbody td {
            display: block;
            padding: 8px 16px;
            border: none;
            border-bottom: 1px solid #f0f0f0;
        }

        .table-custom tbody td:before {
            content: attr(data-label) ": ";
            font-weight: 700;
            color: var(--primary-color);
            margin-right: 6px;
        }

        .table-custom tbody tr {
            display: block;
            border: 1px solid #e9ecef;
            border-radius: 8px;
            margin-bottom: 14px;
            background: white;
            padding: 6px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.07);
        }

        .stats-row { grid-template-columns: 1fr 1fr; }

        .periode-strip { flex-direction: column; align-items: flex-start; gap: 6px; }
        .periode-strip .sep { display: none; }

        .header-search { width: 100%; }
        .header-search input,
        .header-search input:focus { width: 100%; }
    }
</style>

<div class="container-fluid" style="padding: 24px; background-color: #f8f9fa; min-height: 100vh;">

    <!-- Page Header -->
    <div class="page-header">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
                <h4>
                    <i class="fas fa-users"></i> Data Pendaftar
                </h4>
                <p class="page-subtitle">Periode: <strong>{{ $periode->nama_periode }}</strong></p>
            </div>
            <div class="d-flex gap-2 flex-wrap">
                <a href="{{ route('admin.periode.export', $periode->id) }}" class="btn-export">
                    <i class="fas fa-file-excel"></i> Export Excel
                </a>
                <a href="{{ route('admin.periode.index') }}" class="btn-back">
                    <i class="fas fa-arrow-left"></i> Kembali ke Periode
                </a>
            </div>
        </div>
    </div>

    <!-- Periode Info Strip -->
    <div class="periode-strip">
        <i class="fas fa-calendar-alt pi"></i>
        <div class="ps-item">
            <i class="fas fa-tag" style="color:#6c757d; font-size:0.8rem;"></i>
            <strong>{{ $periode->nama_periode }}</strong>
        </div>
        <span class="sep">|</span>
        <div class="ps-item">
            <i class="fas fa-play-circle" style="color: var(--success-color); font-size:0.8rem;"></i>
            {{ \Carbon\Carbon::parse($periode->tanggal_mulai)->format('d M Y') }}
        </div>
        <span class="sep">—</span>
        <div class="ps-item">
            <i class="fas fa-stop-circle" style="color: var(--danger-color); font-size:0.8rem;"></i>
            {{ \Carbon\Carbon::parse($periode->tanggal_selesai)->format('d M Y') }}
        </div>
        <span class="sep">|</span>
        @if($periode->status == 'aktif')
            <span class="ps-status-active"><i class="fas fa-check-circle"></i> Aktif</span>
        @else
            <span class="ps-status-inactive"><i class="fas fa-times-circle"></i> Nonaktif</span>
        @endif
    </div>

    <!-- Stats Row -->
    <div class="stats-row">
        <div class="stat-card">
            <div class="stat-icon orange">
                <i class="fas fa-users"></i>
            </div>
            <div class="stat-info">
                <div class="stat-value">{{ $pendaftar->count() }}</div>
                <div class="stat-label">Total Pendaftar</div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon green">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="stat-info">
                <div class="stat-value">
                    {{ $pendaftar->whereIn('status', ['lolos','diterima'])->count() }}
                </div>
                <div class="stat-label">Diterima / Lolos</div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon yellow">
                <i class="fas fa-clock"></i>
            </div>
            <div class="stat-info">
                <div class="stat-value">
                    {{ $pendaftar->whereIn('status', ['pending','proses'])->count() }}
                </div>
                <div class="stat-label">Pending / Proses</div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon red">
                <i class="fas fa-times-circle"></i>
            </div>
            <div class="stat-info">
                <div class="stat-value">
                    {{ $pendaftar->whereIn('status', ['ditolak','gagal'])->count() }}
                </div>
                <div class="stat-label">Ditolak / Gagal</div>
            </div>
        </div>
    </div>

    <!-- Table Card -->
    <div class="card card-custom">
        <div class="card-header-custom">
            <h5>
                <i class="fas fa-list"></i> Daftar Pendaftar
            </h5>
            <div class="header-search">
                <i class="fas fa-search"></i>
                <input type="text"
                       id="searchInput"
                       placeholder="Cari nama atau email..."
                       oninput="filterTable()">
            </div>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-custom mb-0" id="pendaftarTable">
                    <thead>
                        <tr>
                            <th width="60" class="text-center">No</th>
                            <th>
                                <i class="fas fa-user me-2"></i>Nama
                            </th>
                            <th>
                                <i class="fas fa-envelope me-2"></i>Email
                            </th>
                            <th width="160" class="text-center">
                                <i class="fas fa-layer-group me-2"></i>Jenis
                            </th>
                            <th width="150" class="text-center">
                                <i class="fas fa-info-circle me-2"></i>Status
                            </th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                        @forelse($pendaftar as $index => $p)
                            <tr>
                                <td class="text-center" data-label="No">
                                    <span class="no-urut">{{ $index + 1 }}</span>
                                </td>
                                <td data-label="Nama">
                                    <div class="user-info">
                                        <div class="avatar-circle">
                                            {{ strtoupper(substr($p->nama, 0, 1)) }}
                                        </div>
                                        <span class="user-name">{{ $p->nama }}</span>
                                    </div>
                                </td>
                                <td data-label="Email">
                                    <i class="fas fa-envelope text-muted me-1" style="font-size:0.8rem;"></i>
                                    {{ $p->email }}
                                </td>
                                <td class="text-center" data-label="Jenis">
                                    @php $jenis = strtolower($p->jenis_pendaftaran ?? ''); @endphp
                                    @if(str_contains($jenis, 'beasiswa'))
                                        <span class="badge-jenis badge-beasiswa">
                                            <i class="fas fa-graduation-cap"></i> {{ $p->jenis_pendaftaran }}
                                        </span>
                                    @elseif(str_contains($jenis, 'reguler'))
                                        <span class="badge-jenis badge-reguler">
                                            <i class="fas fa-user-check"></i> {{ $p->jenis_pendaftaran }}
                                        </span>
                                    @else
                                        <span class="badge-jenis badge-lainnya">
                                            <i class="fas fa-tag"></i> {{ $p->jenis_pendaftaran ?? '-' }}
                                        </span>
                                    @endif
                                </td>
                                <td class="text-center" data-label="Status">
                                    @php $status = strtolower($p->status ?? ''); @endphp
                                    @if(in_array($status, ['lolos','diterima']))
                                        <span class="badge-status badge-lolos">
                                            <i class="fas fa-check-circle"></i> {{ ucfirst($p->status) }}
                                        </span>
                                    @elseif(in_array($status, ['pending','proses']))
                                        <span class="badge-status badge-pending">
                                            <i class="fas fa-clock"></i> {{ ucfirst($p->status) }}
                                        </span>
                                    @elseif(in_array($status, ['ditolak','gagal']))
                                        <span class="badge-status badge-ditolak">
                                            <i class="fas fa-times-circle"></i> {{ ucfirst($p->status) }}
                                        </span>
                                    @else
                                        <span class="badge-status badge-default">
                                            <i class="fas fa-minus-circle"></i> {{ ucfirst($p->status ?? '-') }}
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr id="emptyRow">
                                <td colspan="5" class="border-0">
                                    <div class="empty-state">
                                        <div class="empty-icon">
                                            <i class="fas fa-user-slash"></i>
                                        </div>
                                        <p class="empty-title">Belum Ada Pendaftar</p>
                                        <p class="empty-text">Belum ada pendaftar untuk periode ini.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <!-- No result from search -->
                <div id="noResult" style="display:none;" class="empty-state">
                    <div class="empty-icon"><i class="fas fa-search"></i></div>
                    <p class="empty-title">Tidak Ditemukan</p>
                    <p class="empty-text">Tidak ada pendaftar yang cocok dengan pencarian.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function filterTable() {
    const query = document.getElementById('searchInput').value.toLowerCase();
    const rows  = document.querySelectorAll('#tableBody tr:not(#emptyRow)');
    let visible = 0;

    rows.forEach(row => {
        const text = row.innerText.toLowerCase();
        if (text.includes(query)) {
            row.classList.remove('row-hidden');
            visible++;
        } else {
            row.classList.add('row-hidden');
        }
    });

    document.getElementById('noResult').style.display =
        (visible === 0 && rows.length > 0) ? 'block' : 'none';
}
</script>
@endsection