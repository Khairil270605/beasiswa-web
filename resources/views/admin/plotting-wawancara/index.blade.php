@extends('layouts.admin')

@section('title', $pageTitle)

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

    /* Panel Assign */
    .assign-panel {
        background: linear-gradient(135deg, rgba(255, 107, 53, 0.05) 0%, rgba(247, 147, 30, 0.05) 100%);
        border: 1px solid rgba(255, 107, 53, 0.15);
        border-radius: 10px;
        padding: 20px;
        margin: 20px;
    }

    .assign-panel label {
        font-weight: 600;
        color: #495057;
        margin-bottom: 8px;
        display: block;
    }

    .assign-panel .form-select {
        border: 1px solid rgba(255, 107, 53, 0.3);
        border-radius: 8px;
        padding: 10px 14px;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        background-color: white;
    }

    .assign-panel .form-select:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(255, 107, 53, 0.15);
        outline: none;
    }

    /* Search Box */
    .search-box-wrapper {
        position: relative;
    }

    .search-box-wrapper .search-icon {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: #adb5bd;
        font-size: 0.9rem;
        pointer-events: none;
        transition: color 0.3s ease;
    }

    .search-box-wrapper input:focus ~ .search-icon,
    .search-box-wrapper input:not(:placeholder-shown) ~ .search-icon {
        color: var(--primary-color);
    }

    .search-input {
        border: 1px solid rgba(255, 107, 53, 0.3);
        border-radius: 8px;
        padding: 10px 14px 10px 40px;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        width: 100%;
        background-color: white;
    }

    .search-input:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(255, 107, 53, 0.15);
        outline: none;
    }

    .search-input::placeholder {
        color: #adb5bd;
    }

    /* Filter Bar */
    .filter-bar {
        padding: 16px 20px;
        background: #fff;
        border-bottom: 1px solid #e9ecef;
        display: flex;
        gap: 12px;
        align-items: center;
        flex-wrap: wrap;
    }

    .filter-bar label {
        font-size: 0.85rem;
        font-weight: 600;
        color: #6c757d;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        white-space: nowrap;
        margin: 0;
    }

    .filter-select {
        border: 1px solid #dee2e6;
        border-radius: 8px;
        padding: 8px 12px;
        font-size: 0.85rem;
        color: #495057;
        transition: all 0.3s ease;
        background-color: white;
        cursor: pointer;
    }

    .filter-select:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(255, 107, 53, 0.15);
        outline: none;
    }

    /* Badges */
    .badge-kategori-beasiswa {
        background-color: rgba(255, 107, 53, 0.1);
        color: var(--primary-color);
        border: 1px solid rgba(255, 107, 53, 0.2);
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }

    .badge-kategori-reguler {
        background-color: rgba(23, 162, 184, 0.1);
        color: var(--info-color);
        border: 1px solid rgba(23, 162, 184, 0.2);
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }

    .badge-sudah-diplot {
        background-color: rgba(40, 167, 69, 0.1);
        color: var(--success-color);
        border: 1px solid rgba(40, 167, 69, 0.2);
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }

    .badge-belum-diplot {
        background-color: rgba(108, 117, 125, 0.1);
        color: #6c757d;
        border: 1px solid rgba(108, 117, 125, 0.2);
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }

    /* Checkbox custom */
    .custom-checkbox {
        width: 18px;
        height: 18px;
        accent-color: var(--primary-color);
        cursor: pointer;
    }

    .checkbox-cell {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* Avatar */
    .avatar-circle {
        width: 38px;
        height: 38px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: bold;
        font-size: 0.95rem;
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

    /* Counter info */
    .counter-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: var(--light-orange);
        color: var(--primary-color);
        border: 1px solid rgba(255, 107, 53, 0.2);
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
    }

    /* Empty state */
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

    /* Bulk action bar */
    .bulk-action-bar {
        display: none;
        background: linear-gradient(135deg, rgba(255, 107, 53, 0.08) 0%, rgba(247, 147, 30, 0.08) 100%);
        border: 1px dashed rgba(255, 107, 53, 0.4);
        border-radius: 8px;
        padding: 12px 16px;
        margin: 0 20px 12px;
        align-items: center;
        gap: 12px;
        flex-wrap: wrap;
    }

    .bulk-action-bar.visible {
        display: flex;
    }

    .bulk-action-bar span {
        font-size: 0.9rem;
        font-weight: 600;
        color: var(--primary-color);
    }

    /* Highlight on search */
    .highlight {
        background-color: rgba(255, 107, 53, 0.2);
        border-radius: 3px;
        padding: 1px 3px;
        font-weight: 600;
        color: var(--primary-color);
    }

    /* No result */
    #no-result-row {
        display: none;
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

        .filter-bar {
            flex-direction: column;
            align-items: flex-start;
        }

        .assign-panel .row {
            gap: 12px;
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
    }
</style>

<div class="container-fluid" style="padding: 24px; background-color: #f8f9fa; min-height: 100vh;">

    {{-- Page Header --}}
    <div class="page-header">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
                <h4>
                    <i class="fas fa-user-check"></i> Plot Pewawancara
                </h4>
                <p class="page-subtitle">Assign pewawancara ke peserta yang lulus administrasi</p>
            </div>
            <span class="counter-badge">
                <i class="fas fa-users"></i>
                <span id="totalPeserta">{{ $peserta->count() }}</span> Peserta
            </span>
        </div>
    </div>

    <!-- {{-- Session Alert --}}
    @if(session('success'))
        <div class="alert-lazismu mb-4" style="background: linear-gradient(45deg, rgba(40,167,69,0.1), rgba(40,167,69,0.05)); border: 1px solid rgba(40,167,69,0.2); color:#155724; padding:16px; border-radius:8px; display:flex; align-items:center;">
            <i class="fas fa-check-circle" style="color: var(--success-color); margin-right:12px; font-size:1.2rem;"></i>
            {{ session('success') }}
        </div>
    @endif -->

    {{-- Main Card --}}
    <div class="card card-custom">
        <div class="card-header card-header-custom">
            <h5>
                <i class="fas fa-calendar-check"></i> Daftar Peserta Lulus Administrasi
            </h5>
        </div>

        <form action="{{ route('admin.plotting-wawancara.bulk-update') }}" method="POST" id="plotForm">
            @csrf
            @method('PUT')

            {{-- Assign Panel --}}
            <div class="assign-panel">
                <div class="row align-items-end g-3">
                    <div class="col-md-5 col-lg-4">
                        <label>
                            <i class="fas fa-user-tie me-2" style="color: var(--primary-color);"></i>
                            Pilih Pewawancara
                        </label>
                        <select name="pewawancara_id" class="form-select" id="selectPewawancara" required>
                            <option value="">-- Pilih Pewawancara --</option>
                            @foreach($pewawancara as $pw)
                                <option value="{{ $pw->id }}">{{ $pw->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-auto">
                        <button type="submit" class="btn btn-lazismu" id="btnPlot" disabled>
                            <i class="fas fa-save"></i> Plot Peserta Terpilih
                        </button>
                    </div>
                </div>
            </div>

            {{-- Filter & Search Bar --}}
            <div class="filter-bar">
                {{-- Search --}}
                <div class="search-box-wrapper flex-grow-1" style="max-width: 360px;">
                    <input
                        type="text"
                        id="searchInput"
                        class="search-input"
                        placeholder="Cari nama peserta..."
                        autocomplete="off"
                    >
                    <i class="fas fa-search search-icon"></i>
                </div>

                {{-- Filter Kategori --}}
                <label>Filter:</label>
                <select id="filterKategori" class="filter-select">
                    <option value="">Semua Kategori</option>
                    <option value="dhuafa">Dhuafa</option>
                    <option value="kader">Kader</option>
                </select>

                {{-- Filter Status Plot --}}
                <select id="filterStatus" class="filter-select">
                    <option value="">Semua Status</option>
                    <option value="sudah">Sudah Diplot</option>
                    <option value="belum">Belum Diplot</option>
                </select>

                {{-- Result Count --}}
                <span class="counter-badge ms-auto" id="resultCount">
                    <i class="fas fa-filter"></i>
                    <span id="resultNumber">{{ $peserta->count() }}</span> ditampilkan
                </span>
            </div>

            {{-- Bulk Info Bar --}}
            <div class="bulk-action-bar" id="bulkBar">
                <i class="fas fa-check-square" style="color: var(--primary-color);"></i>
                <span><span id="selectedCount">0</span> peserta dipilih</span>
                <button type="button" class="btn btn-sm" style="background:rgba(255,107,53,0.1); color:var(--primary-color); border:1px solid rgba(255,107,53,0.2); border-radius:6px; padding:4px 12px;" onclick="clearSelection()">
                    <i class="fas fa-times me-1"></i> Batal Pilih
                </button>
            </div>

            {{-- Table --}}
            <div class="table-responsive">
                <table class="table table-custom mb-0" id="pesertaTable">
                    <thead>
                        <tr>
                            <th width="50" class="text-center">
                                <div class="checkbox-cell">
                                    <input type="checkbox" class="custom-checkbox" id="checkAll" title="Pilih Semua">
                                </div>
                            </th>
                            <th width="60" class="text-center">No</th>
                            <th>
                                <i class="fas fa-user me-2"></i>Nama Peserta
                            </th>
                            <th width="160" class="text-center">
                                <i class="fas fa-tags me-2"></i>Kategori
                            </th>
                            <th width="220" class="text-center">
                                <i class="fas fa-user-tie me-2"></i>Pewawancara Saat Ini
                            </th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                        @forelse($peserta as $item)
                            <tr class="peserta-row"
                                data-nama="{{ strtolower($item->nama) }}"
                                data-kategori="{{ strtolower($item->jenis_pendaftaran) }}"
                                data-status="{{ $item->pewawancara ? 'sudah' : 'belum' }}">

                                <td class="text-center" data-label="Pilih">
                                    <div class="checkbox-cell">
                                        <input type="checkbox"
                                               name="alternatif_ids[]"
                                               value="{{ $item->id }}"
                                               class="custom-checkbox checkItem">
                                    </div>
                                </td>

                                <td class="text-center" data-label="No">
                                    <strong>{{ $loop->iteration }}</strong>
                                </td>

                                <td data-label="Nama">
                                    <div class="user-info">
                                        <div class="avatar-circle">
                                            {{ strtoupper(substr($item->nama, 0, 1)) }}
                                        </div>
                                        <span class="user-name peserta-nama">{{ $item->nama }}</span>
                                    </div>
                                </td>

                                <td class="text-center" data-label="Kategori">
                                    @if(strtolower($item->jenis_pendaftaran) === 'beasiswa')
                                        <span class="badge-kategori-beasiswa">
                                            <i class="fas fa-graduation-cap"></i>
                                            Beasiswa
                                        </span>
                                    @else
                                        <span class="badge-kategori-reguler">
                                            <i class="fas fa-user"></i>
                                            {{ ucfirst($item->jenis_pendaftaran) }}
                                        </span>
                                    @endif
                                </td>

                                <td class="text-center" data-label="Pewawancara">
                                    @if($item->pewawancara)
                                        <span class="badge-sudah-diplot">
                                            <i class="fas fa-check-circle"></i>
                                            {{ $item->pewawancara->name }}
                                        </span>
                                    @else
                                        <span class="badge-belum-diplot">
                                            <i class="fas fa-clock"></i>
                                            Belum Diplot
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="border-0">
                                    <div class="empty-state">
                                        <div class="empty-icon">
                                            <i class="fas fa-user-slash"></i>
                                        </div>
                                        <p class="empty-title">Belum Ada Peserta</p>
                                        <p class="empty-text">Tidak ada peserta yang lulus administrasi saat ini</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse

                        {{-- No result row (hidden by default) --}}
                        <tr id="no-result-row">
                            <td colspan="5" class="border-0">
                                <div class="empty-state" style="padding: 40px 20px;">
                                    <div class="empty-icon" style="font-size: 3rem;">
                                        <i class="fas fa-search"></i>
                                    </div>
                                    <p class="empty-title">Peserta Tidak Ditemukan</p>
                                    <p class="empty-text">Coba ubah kata kunci atau filter pencarian</p>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </form>
    </div>
</div>

@endsection

@section('scripts')
<script>
    const rows          = document.querySelectorAll('.peserta-row');
    const checkAll      = document.getElementById('checkAll');
    const checkItems    = document.querySelectorAll('.checkItem');
    const btnPlot       = document.getElementById('btnPlot');
    const bulkBar       = document.getElementById('bulkBar');
    const selectedCount = document.getElementById('selectedCount');
    const searchInput   = document.getElementById('searchInput');
    const filterKat     = document.getElementById('filterKategori');
    const filterStatus  = document.getElementById('filterStatus');
    const noResultRow   = document.getElementById('no-result-row');
    const resultNumber  = document.getElementById('resultNumber');
    const selectPew     = document.getElementById('selectPewawancara');

    // ─── Enable / disable tombol plot ────────────────────────────────────────
    function updateBtnPlot() {
        const anyChecked = [...checkItems].some(c => c.checked && c.closest('tr').style.display !== 'none');
        const pewSelected = selectPew.value !== '';
        btnPlot.disabled = !(anyChecked && pewSelected);
    }

    selectPew.addEventListener('change', updateBtnPlot);

    // ─── Checkbox logic ───────────────────────────────────────────────────────
    function updateSelectionUI() {
        const checked = [...checkItems].filter(c => c.checked);
        selectedCount.textContent = checked.length;
        bulkBar.classList.toggle('visible', checked.length > 0);
        updateBtnPlot();
    }

    checkAll.addEventListener('change', function () {
        // Only check visible rows
        rows.forEach(row => {
            if (row.style.display !== 'none') {
                row.querySelector('.checkItem').checked = checkAll.checked;
            }
        });
        updateSelectionUI();
    });

    checkItems.forEach(item => {
        item.addEventListener('change', function () {
            updateSelectionUI();
            // Sync checkAll state
            const visibleItems = [...checkItems].filter(c => c.closest('tr').style.display !== 'none');
            checkAll.indeterminate = visibleItems.some(c => c.checked) && !visibleItems.every(c => c.checked);
            checkAll.checked = visibleItems.length > 0 && visibleItems.every(c => c.checked);
        });
    });

    function clearSelection() {
        checkItems.forEach(c => c.checked = false);
        checkAll.checked = false;
        checkAll.indeterminate = false;
        updateSelectionUI();
    }

    // ─── Search & Filter ──────────────────────────────────────────────────────
    function applyFilters() {
        const keyword  = searchInput.value.toLowerCase().trim();
        const kategori = filterKat.value.toLowerCase();
        const status   = filterStatus.value.toLowerCase();

        let visible = 0;

        rows.forEach(row => {
            const nama    = row.dataset.nama;
            const kat     = row.dataset.kategori;
            const stat    = row.dataset.status;

            const matchSearch   = keyword === '' || nama.includes(keyword);
            const matchKategori = kategori === '' || kat === kategori;
            const matchStatus   = status === '' || stat === status;

            if (matchSearch && matchKategori && matchStatus) {
                row.style.display = '';
                visible++;

                // Highlight keyword
                const nameEl = row.querySelector('.peserta-nama');
                if (keyword) {
                    const regex = new RegExp(`(${escapeRegex(keyword)})`, 'gi');
                    nameEl.innerHTML = nameEl.textContent.replace(regex, '<mark class="highlight">$1</mark>');
                } else {
                    nameEl.innerHTML = nameEl.textContent;
                }
            } else {
                row.style.display = 'none';
                row.querySelector('.checkItem').checked = false;
            }
        });

        // Show/hide no result
        noResultRow.style.display = visible === 0 ? '' : 'none';
        resultNumber.textContent  = visible;

        // Uncheck "check all" if some are hidden
        const visibleItems = [...checkItems].filter(c => c.closest('tr').style.display !== 'none');
        checkAll.checked = visibleItems.length > 0 && visibleItems.every(c => c.checked);
        checkAll.indeterminate = visibleItems.some(c => c.checked) && !visibleItems.every(c => c.checked);

        updateSelectionUI();
    }

    function escapeRegex(str) {
        return str.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
    }

    searchInput.addEventListener('input', applyFilters);
    filterKat.addEventListener('change', applyFilters);
    filterStatus.addEventListener('change', applyFilters);

    // ─── Form validation sebelum submit ──────────────────────────────────────
    document.getElementById('plotForm').addEventListener('submit', function (e) {
        const checked = [...checkItems].filter(c => c.checked);
        if (checked.length === 0) {
            e.preventDefault();
            alert('Pilih minimal satu peserta terlebih dahulu.');
            return;
        }
        if (!selectPew.value) {
            e.preventDefault();
            alert('Pilih pewawancara terlebih dahulu.');
        }
    });
</script>
@endsection