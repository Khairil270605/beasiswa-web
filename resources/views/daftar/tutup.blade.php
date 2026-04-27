@extends('layouts.app')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
<style>
    :root {
        --primary-color: #ff6b35;
        --secondary-color: #f7931e;
        --accent-color: #dc3545;
        --success-color: #28a745;
        --warning-color: #ffc107;
        --info-color: #17a2b8;
    }

    .tutup-page {
        min-height: 80vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2rem 1rem;
        font-family: 'Lato', sans-serif;
        position: relative;
        overflow: hidden;
    }

    .floating-particles { position: absolute; inset: 0; pointer-events: none; overflow: hidden; }
    .particle {
        position: absolute;
        width: 4px; height: 4px;
        background: rgba(255, 107, 53, 0.3);
        border-radius: 50%;
        animation: floatParticle 15s infinite linear;
    }
    @keyframes floatParticle {
        0%   { transform: translateY(100%) translateX(0) rotate(0deg); opacity: 0; }
        10%  { opacity: 1; }
        90%  { opacity: 1; }
        100% { transform: translateY(-10%) translateX(100px) rotate(360deg); opacity: 0; }
    }

    .tutup-card {
        background: rgba(255,255,255,0.98);
        backdrop-filter: blur(10px);
        border-radius: 20px;
        box-shadow: 0 20px 40px rgba(0,0,0,0.12);
        overflow: hidden;
        max-width: 540px;
        width: 100%;
        position: relative;
        z-index: 2;
    }

    .tutup-header {
        background: linear-gradient(135deg, #ff6b35, #f7931e) !important;
        padding: 2.2rem 2rem 1.8rem !important;
        text-align: center;
        position: relative;
        overflow: hidden;
        border: none !important;
    }
    .tutup-header::before {
        content: '';
        position: absolute;
        top: -50%; right: -50%;
        width: 200%; height: 200%;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="g" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="75" cy="75" r="1.5" fill="rgba(255,255,255,0.05)"/><circle cx="50" cy="10" r="0.5" fill="rgba(255,255,255,0.1)"/></pattern></defs><rect width="100" height="100" fill="url(%23g)"/></svg>') repeat;
        animation: tutupFloat 20s infinite linear;
        pointer-events: none;
    }
    @keyframes tutupFloat {
        0%   { transform: translate(-50%,-50%) rotate(0deg); }
        100% { transform: translate(-50%,-50%) rotate(360deg); }
    }

    .tutup-header-badge {
        position: relative; z-index: 2;
        display: inline-block;
        background: rgba(255,255,255,0.2);
        border: 1px solid rgba(255,255,255,0.4);
        color: white !important;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 0.12em;
        text-transform: uppercase;
        padding: 4px 16px;
        border-radius: 40px;
        margin-bottom: 1.2rem;
    }

    .tutup-lock-wrap {
        position: relative; z-index: 2;
        display: inline-flex; align-items: center; justify-content: center;
        width: 80px; height: 80px;
        border-radius: 50%;
        background: rgba(255,255,255,0.2);
        border: 2px solid rgba(255,255,255,0.5);
        margin-bottom: 1.2rem;
        animation: tutupPulseLock 2.4s ease-in-out infinite;
    }
    @keyframes tutupPulseLock {
        0%, 100% { box-shadow: 0 0 0 0 rgba(255,255,255,0.35); }
        50%       { box-shadow: 0 0 0 14px rgba(255,255,255,0.0); }
    }
    .tutup-lock-wrap svg { width: 38px; height: 38px; }

    .tutup-title {
        position: relative; z-index: 2;
        font-family: 'Playfair Display', serif !important;
        font-size: 22px !important;
        font-weight: 700 !important;
        color: white !important;
        margin: 0 !important;
        text-shadow: 0 2px 6px rgba(0,0,0,0.15);
    }

    .tutup-body { padding: 2rem; }

    .tutup-divider {
        display: flex; align-items: center; gap: 10px;
        margin-bottom: 1.4rem;
    }
    .tutup-divider-line {
        flex: 1; height: 1px;
        background: linear-gradient(to right, transparent, rgba(247,147,30,0.4), transparent);
    }
    .tutup-divider-dot {
        width: 5px; height: 5px;
        border-radius: 50%;
        background: #f7931e;
    }

    .tutup-desc {
        font-size: 15px;
        color: #495057;
        line-height: 1.75;
        text-align: center;
        margin: 0 0 1.5rem;
        font-weight: 300;
    }
    .tutup-desc strong { color: #ff6b35; font-weight: 700; }

    .tutup-info-row {
        background: rgba(23,162,184,0.06);
        border-left: 4px solid #17a2b8;
        border-radius: 0 10px 10px 0;
        padding: 14px 16px;
        display: flex;
        align-items: flex-start;
        gap: 10px;
    }
    .tutup-info-text { font-size: 13.5px; color: #495057; line-height: 1.6; margin: 0; }
    .tutup-info-text strong { color: #17a2b8; }

    .tutup-progress-wrap {
        height: 6px; border-radius: 3px;
        background: #e9ecef; overflow: hidden;
        margin: 1.5rem 0 0;
    }
    .tutup-progress-fill {
        height: 100%; width: 0%;
        border-radius: 3px;
        background: linear-gradient(90deg, #ff6b35, #f7931e);
        animation: tutupFillWait 3s ease-in-out infinite;
    }
    @keyframes tutupFillWait {
        0%   { width: 0%; }
        50%  { width: 65%; }
        100% { width: 0%; }
    }
    .tutup-progress-label {
        font-size: 11px; color: #adb5bd;
        text-align: center; margin-top: 6px;
        letter-spacing: 0.04em;
    }

    @media (max-width: 768px) {
        .tutup-header { padding: 1.5rem 1rem 1.2rem !important; }
        .tutup-body   { padding: 1.5rem 1rem; }
        .tutup-title  { font-size: 18px !important; }
    }
</style>
@endpush

@section('content')
<div class="tutup-page">

    <div class="floating-particles">
        <div class="particle" style="left:10%; animation-delay:0s;  animation-duration:12s;"></div>
        <div class="particle" style="left:25%; animation-delay:2s;  animation-duration:17s;"></div>
        <div class="particle" style="left:45%; animation-delay:5s;  animation-duration:13s;"></div>
        <div class="particle" style="left:65%; animation-delay:8s;  animation-duration:15s;"></div>
        <div class="particle" style="left:80%; animation-delay:3s;  animation-duration:11s;"></div>
        <div class="particle" style="left:92%; animation-delay:6s;  animation-duration:18s;"></div>
    </div>

    <div class="tutup-card">

        {{-- Header gradient --}}
        <div class="tutup-header">
            <div class="tutup-header-badge">Informasi Pendaftaran</div>
            <br>
            <div class="tutup-lock-wrap">
                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect x="5" y="11" width="14" height="10" rx="2.5"
                          fill="rgba(255,255,255,0.25)" stroke="white" stroke-width="1.5"/>
                    <path d="M8 11V7.5C8 5.567 9.79 4 12 4s4 1.567 4 3.5V11"
                          stroke="white" stroke-width="1.5" stroke-linecap="round"/>
                    <circle cx="12" cy="16" r="1.5" fill="white"/>
                    <line x1="12" y1="17.5" x2="12" y2="19"
                          stroke="white" stroke-width="1.4" stroke-linecap="round"/>
                </svg>
            </div>
            <h2 class="tutup-title">Pendaftaran Belum Dibuka</h2>
        </div>

        {{-- Body --}}
        <div class="tutup-body">
            <div class="tutup-divider">
                <div class="tutup-divider-line"></div>
                <div class="tutup-divider-dot"></div>
                <div class="tutup-divider-line"></div>
            </div>

            <p class="tutup-desc">
                Mohon maaf, pendaftaran beasiswa saat ini <strong>belum tersedia</strong>.<br>
                Pantau terus pengumuman resmi kami untuk informasi<br>
                pembukaan periode berikutnya.
            </p>

            <div class="tutup-info-row">
                <span style="font-size:15px; flex-shrink:0; margin-top:2px;">💡</span>
                <p class="tutup-info-text">
                    <strong>Butuh bantuan?</strong>
                    Hubungi tim kami melalui halaman kontak atau pantau pengumuman
                    di laman utama untuk mendapatkan informasi terbaru.
                </p>
            </div>

            <div class="tutup-progress-wrap">
                <div class="tutup-progress-fill"></div>
            </div>
            <p class="tutup-progress-label">Menunggu pembukaan periode berikutnya…</p>
        </div>

    </div>
</div>
@endsection