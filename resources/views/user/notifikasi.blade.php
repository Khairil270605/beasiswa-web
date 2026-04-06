@extends('layouts.app')

@section('title', 'Notifikasi - LAZISMU')

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

    .notif-stats {
        background: white;
        border-radius: 15px;
        padding: 2rem;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        margin-bottom: 2rem;
    }

    .stat-item {
        text-align: center;
        padding: 1rem;
    }

    .stat-number {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }

    .stat-number.unread {
        color: var(--danger-color);
    }

    .stat-number.read {
        color: var(--success-color);
    }

    .stat-number.total {
        color: var(--primary-color);
    }

    .stat-label {
        color: #6c757d;
        font-weight: 600;
        font-size: 0.9rem;
    }

    .notif-section {
        background: white;
        border-radius: 15px;
        padding: 2rem;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        margin-bottom: 2rem;
    }

    .section-title {
        color: var(--primary-color);
        font-weight: 700;
        font-size: 1.5rem;
        margin-bottom: 1.5rem;
        display: flex;
        justify-content: between;
        align-items: center;
        border-bottom: 2px solid #f8f9fa;
        padding-bottom: 0.5rem;
    }

    .filter-tabs {
        display: flex;
        gap: 0.5rem;
        margin-bottom: 2rem;
        flex-wrap: wrap;
    }

    .filter-tab {
        padding: 0.6rem 1.5rem;
        border: 2px solid #dee2e6;
        background: white;
        color: #6c757d;
        border-radius: 25px;
        cursor: pointer;
        transition: all 0.3s ease;
        font-weight: 600;
        position: relative;
    }

    .filter-tab:hover,
    .filter-tab.active {
        border-color: var(--primary-color);
        background: var(--primary-color);
        color: white;
    }

    .filter-tab .badge {
        position: absolute;
        top: -8px;
        right: -8px;
        background: var(--danger-color);
        color: white;
        border-radius: 50%;
        font-size: 0.7rem;
        padding: 0.2rem 0.5rem;
        min-width: 20px;
        height: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .notif-item {
        padding: 1.5rem;
        border: 2px solid #f8f9fa;
        border-radius: 12px;
        margin-bottom: 1rem;
        transition: all 0.3s ease;
        position: relative;
        cursor: pointer;
    }

    .notif-item:hover {
        border-color: var(--primary-color);
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(236, 107, 13, 0.1);
    }

    .notif-item.unread {
        background: linear-gradient(90deg, rgba(236, 107, 13, 0.05), rgba(255, 255, 255, 1));
        border-left: 4px solid var(--primary-color);
    }

    .notif-item.read {
        background: #f8f9fa;
        opacity: 0.8;
    }

    .notif-item.unread::before {
        content: '';
        position: absolute;
        top: 1rem;
        right: 1rem;
        width: 10px;
        height: 10px;
        background: var(--danger-color);
        border-radius: 50%;
    }

    .notif-header {
        display: flex;
        justify-content: between;
        align-items: flex-start;
        margin-bottom: 1rem;
        flex-wrap: wrap;
    }

    .notif-type {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.3rem 1rem;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    .notif-type.pengumuman {
        background: rgba(23, 162, 184, 0.2);
        color: #0c5460;
    }

    .notif-type.beasiswa {
        background: rgba(40, 167, 69, 0.2);
        color: #155724;
    }

    .notif-type.sistem {
        background: rgba(255, 193, 7, 0.2);
        color: #856404;
    }

    .notif-type.penting {
        background: rgba(220, 53, 69, 0.2);
        color: #721c24;
    }

    .notif-title {
        font-weight: 700;
        font-size: 1.1rem;
        color: #333;
        margin-bottom: 0.5rem;
    }

    .notif-content {
        color: #6c757d;
        line-height: 1.6;
        margin-bottom: 1rem;
    }

    .notif-meta {
        display: flex;
        justify-content: between;
        align-items: center;
        flex-wrap: wrap;
        gap: 1rem;
        font-size: 0.85rem;
        color: #6c757d;
    }

    .notif-date {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .notif-actions {
        display: flex;
        gap: 0.5rem;
    }

    .btn-notif {
        padding: 0.3rem 0.8rem;
        border: none;
        border-radius: 15px;
        font-size: 0.8rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
    }

    .btn-read {
        background: var(--success-color);
        color: white;
    }

    .btn-read:hover {
        background: #218838;
        color: white;
    }

    .btn-delete {
        background: var(--danger-color);
        color: white;
    }

    .btn-delete:hover {
        background: #c82333;
        color: white;
    }

    .btn-mark-all {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        color: white;
        padding: 0.6rem 1.5rem;
        border-radius: 25px;
        border: none;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-mark-all:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(236, 107, 13, 0.3);
        color: white;
    }

    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        color: #6c757d;
    }

    .empty-state i {
        font-size: 4rem;
        color: var(--primary-color);
        margin-bottom: 2rem;
    }

    .empty-state h4 {
        margin-bottom: 1rem;
        color: #495057;
    }

    @media (max-width: 768px) {
        .page-header {
            padding: 2rem 0;
        }
        
        .page-header h1 {
            font-size: 2rem;
        }
        
        .notif-stats,
        .notif-section {
            padding: 1.5rem;
        }
        
        .notif-item {
            padding: 1rem;
        }
        
        .notif-header,
        .notif-meta {
            flex-direction: column;
            align-items: flex-start;
            gap: 0.5rem;
        }
        
        .filter-tabs {
            justify-content: center;
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

    .notif-item {
        animation: slideIn 0.5s ease-out;
    }
</style>

<!-- Page Header -->
<div class="page-header">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1><i class="fas fa-bell me-3"></i>Notifikasi</h1>
                <p class="mb-0">Pengumuman dan pemberitahuan dari admin LAZISMU</p>
            </div>
            <div class="col-md-4 text-md-end mt-3 mt-md-0">
                <button class="btn-mark-all" onclick="markAllAsRead()">
                    <i class="fas fa-check-double"></i>Tandai Semua Dibaca
                </button>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <!-- Statistik Notifikasi -->
    <div class="notif-stats">
        <div class="row">
            <div class="col-md-4 stat-item">
                <div class="stat-number total">{{ $totalNotifikasi ?? 0 }}</div>
                <div class="stat-label">Total Notifikasi</div>
            </div>
            <div class="col-md-4 stat-item">
                <div class="stat-number unread">{{ $belumDibaca ?? 0 }}</div>
                <div class="stat-label">Belum Dibaca</div>
            </div>
            <div class="col-md-4 stat-item">
                <div class="stat-number read">{{ $sudahDibaca ?? 0 }}</div>
                <div class="stat-label">Sudah Dibaca</div>
            </div>
        </div>
    </div>

    <!-- Daftar Notifikasi -->
    <div class="notif-section">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="section-title mb-0">
                <i class="fas fa-list me-2"></i>Daftar Notifikasi
            </h2>
        </div>

        <!-- Filter Tabs -->
        <div class="filter-tabs">
            <div class="filter-tab active" data-filter="all">
                Semua
                <span class="badge">{{ $totalNotifikasi ?? 0 }}</span>
            </div>
            <div class="filter-tab" data-filter="unread">
                Belum Dibaca
                @if(($belumDibaca ?? 0) > 0)
                <span class="badge">{{ $belumDibaca ?? 0 }}</span>
                @endif
            </div>
            <div class="filter-tab" data-filter="read">
                Sudah Dibaca
            </div>
            <div class="filter-tab" data-filter="pengumuman">
                Pengumuman
            </div>
            <div class="filter-tab" data-filter="beasiswa">
                Beasiswa
            </div>
        </div>

        <!-- Daftar Notifikasi -->
       <div class="notifikasi-list">
    @forelse($notifikasi ?? [] as $notif)
        <div class="notif-item {{ optional($notif)->is_read ? 'read' : 'unread' }}" 
             data-status="{{ optional($notif)->is_read ? 'read' : 'unread' }}"
             data-type="{{ optional($notif)->type ?? 'pengumuman' }}"
             onclick="openNotification({{ optional($notif)->id }})">
            
            <div class="notif-header">
                <div>
                    <div class="notif-type {{ optional($notif)->type ?? 'pengumuman' }}">
                        @if((optional($notif)->type ?? 'pengumuman') == 'pengumuman')
                            <i class="fas fa-bullhorn"></i> Pengumuman
                        @elseif(optional($notif)->type == 'beasiswa')
                            <i class="fas fa-graduation-cap"></i> Beasiswa
                        @elseif(optional($notif)->type == 'sistem')
                            <i class="fas fa-cog"></i> Sistem
                        @else
                            <i class="fas fa-exclamation-triangle"></i> Penting
                        @endif
                    </div>
                    <div class="notif-title">{{ optional($notif)->title ?? 'Judul Notifikasi' }}</div>
                </div>
            </div>

            <div class="notif-content">
                {{ Str::limit(optional($notif)->content ?? 'Isi notifikasi akan ditampilkan di sini...', 150) }}
            </div>

            <div class="notif-meta">
                <div class="notif-date">
                    <i class="fas fa-clock"></i>
                    <span>{{ optional($notif)->created_at ? optional($notif)->created_at->diffForHumans() : 'Baru saja' }}</span>
                </div>
                <div class="notif-actions">
                    @if(!optional($notif)->is_read)
                        <button class="btn-notif btn-read" onclick="event.stopPropagation(); markAsRead({{ optional($notif)->id }})">
                            <i class="fas fa-check"></i> Tandai Dibaca
                        </button>
                    @endif
                    <button class="btn-notif btn-delete" onclick="event.stopPropagation(); deleteNotification({{ optional($notif)->id }})">
                        <i class="fas fa-trash"></i> Hapus
                    </button>
                </div>
            </div>
        </div>
    @empty
        <div class="empty-state">
            <i class="fas fa-bell-slash"></i>
            <h4>Belum Ada Notifikasi</h4>
            <p>Anda belum memiliki notifikasi apapun. Notifikasi akan muncul di sini ketika admin mengirimkan pengumuman.</p>
        </div>
    @endforelse
</div>


<!-- Modal Detail Notifikasi -->
<div class="modal fade" id="notifModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="notifModalTitle">Detail Notifikasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="notifModalContent">
                <!-- Content akan diisi via JavaScript -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script>
    // Filter functionality
    document.querySelectorAll('.filter-tab').forEach(tab => {
        tab.addEventListener('click', function() {
            // Remove active class from all tabs
            document.querySelectorAll('.filter-tab').forEach(t => t.classList.remove('active'));
            
            // Add active class to clicked tab
            this.classList.add('active');
            
            const filter = this.getAttribute('data-filter');
            const items = document.querySelectorAll('.notif-item');
            
            items.forEach(item => {
                let show = false;
                
                if (filter === 'all') {
                    show = true;
                } else if (filter === 'read' || filter === 'unread') {
                    show = item.getAttribute('data-status') === filter;
                } else {
                    show = item.getAttribute('data-type') === filter;
                }
                
                if (show) {
                    item.style.display = 'block';
                    item.style.animation = 'slideIn 0.5s ease-out';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    });

    // Mark as read function
    function markAsRead(notifId) {
        // Simulasi AJAX request
        fetch(`/notifikasi/${notifId}/mark-read`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Update UI
                const notifItem = document.querySelector(`[onclick="openNotification(${notifId})"]`);
                notifItem.classList.remove('unread');
                notifItem.classList.add('read');
                notifItem.setAttribute('data-status', 'read');
                
                // Remove read button
                const readBtn = notifItem.querySelector('.btn-read');
                if (readBtn) {
                    readBtn.remove();
                }
                
                // Update statistics
                updateStats();
            }
        });
    }

    // Mark all as read
    function markAllAsRead() {
        if (confirm('Tandai semua notifikasi sebagai dibaca?')) {
            fetch('/notifikasi/mark-all-read', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Update all items
                    document.querySelectorAll('.notif-item.unread').forEach(item => {
                        item.classList.remove('unread');
                        item.classList.add('read');
                        item.setAttribute('data-status', 'read');
                        
                        const readBtn = item.querySelector('.btn-read');
                        if (readBtn) {
                            readBtn.remove();
                        }
                    });
                    
                    updateStats();
                    alert('Semua notifikasi telah ditandai sebagai dibaca');
                }
            });
        }
    }

    // Delete notification
    function deleteNotification(notifId) {
        if (confirm('Hapus notifikasi ini?')) {
            fetch(`/notifikasi/${notifId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Remove item from DOM
                    const notifItem = document.querySelector(`[onclick="openNotification(${notifId})"]`);
                    notifItem.style.animation = 'slideOut 0.3s ease-out';
                    setTimeout(() => {
                        notifItem.remove();
                        updateStats();
                    }, 300);
                }
            });
        }
    }

    // Open notification detail
    function openNotification(notifId) {
        // Mark as read if not already read
        const notifItem = document.querySelector(`[onclick="openNotification(${notifId})"]`);
        if (notifItem.classList.contains('unread')) {
            markAsRead(notifId);
        }
        
        // Fetch notification detail and show in modal
        fetch(`/notifikasi/${notifId}`)
        .then(response => response.json())
        .then(data => {
            document.getElementById('notifModalTitle').textContent = data.title;
            document.getElementById('notifModalContent').innerHTML = `
                <div class="notif-type ${data.type}">${data.type_label}</div>
                <p class="mt-3">${data.content}</p>
                <small class="text-muted">
                    <i class="fas fa-clock"></i> ${data.created_at}
                </small>
            `;
            
            // Show modal
            new bootstrap.Modal(document.getElementById('notifModal')).show();
        });
    }

    // Update statistics
    function updateStats() {
        const unreadCount = document.querySelectorAll('.notif-item.unread').length;
        const readCount = document.querySelectorAll('.notif-item.read').length;
        const totalCount = unreadCount + readCount;
        
        document.querySelector('.stat-number.total').textContent = totalCount;
        document.querySelector('.stat-number.unread').textContent = unreadCount;
        document.querySelector('.stat-number.read').textContent = readCount;
        
        // Update badges
        document.querySelector('[data-filter="all"] .badge').textContent = totalCount;
        const unreadBadge = document.querySelector('[data-filter="unread"] .badge');
        if (unreadCount > 0) {
            if (!unreadBadge) {
                const badge = document.createElement('span');
                badge.className = 'badge';
                badge.textContent = unreadCount;
                document.querySelector('[data-filter="unread"]').appendChild(badge);
            } else {
                unreadBadge.textContent = unreadCount;
            }
        } else if (unreadBadge) {
            unreadBadge.remove();
        }
    }

    // Add slideOut animation
    const style = document.createElement('style');
    style.textContent = `
        @keyframes slideOut {
            to {
                opacity: 0;
                transform: translateX(-100%);
            }
        }
    `;
    document.head.appendChild(style);
</script>

@endsection