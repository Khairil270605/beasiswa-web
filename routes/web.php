<?php

use Illuminate\Support\Facades\Route;

// =====================
// Controller Imports
// =====================
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TentangController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DaftarController;
use App\Http\Controllers\AccessibilityController;
use App\Http\Controllers\Pewawancara\PewawancaraController;

// Auth
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;

// Admin
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\KriteriaController;
use App\Http\Controllers\Admin\SubKriteriaController;
use App\Http\Controllers\Admin\PendaftarController;
use App\Http\Controllers\Admin\PenilaianController;
use App\Http\Controllers\Admin\HasilPerhitunganController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\InformasiController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\AdminWawancaraController;
use App\Http\Controllers\Admin\UserManagementController;


// =====================
// 🔓 PUBLIC ROUTES
// =====================
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/tentang', [TentangController::class, 'index'])->name('tentang');

Route::get('/kontak', [KontakController::class, 'index'])->name('kontak');
Route::post('/kontak', [KontakController::class, 'kirimPesan'])->name('kontak.kirim');

// =====================
// 🔐 AUTH
// =====================
Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [AuthController::class, 'registerForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');

// Forgot / Reset Password
Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])
    ->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])
    ->name('password.email');
Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])
    ->name('password.reset');
Route::post('/reset-password', [ResetPasswordController::class, 'reset'])
    ->name('password.update');

// =====================a
// ♿ ACCESSIBILITY
// =====================
Route::post('/accessibility/save', [AccessibilityController::class, 'saveSettings'])
    ->name('accessibility.save');
Route::get('/accessibility/get', [AccessibilityController::class, 'getSettings'])
    ->name('accessibility.get');
Route::post('/accessibility/reset', [AccessibilityController::class, 'resetSettings'])
    ->name('accessibility.reset');

// =====================
// 🔐 USER ROUTES (LOGIN)
// =====================
Route::middleware(['auth','role:user'])->group(function () {

    // Dashboard User
    Route::get('/beasiswa', [UserController::class, 'beasiswa'])->name('user.beasiswa');
    Route::get('/notifikasi', [UserController::class, 'notifikasi'])->name('user.notifikasi');

    // Profile
    Route::get('/profile', [UserController::class, 'profile'])->name('user.profile');
    Route::get('/profile/edit', [UserController::class, 'editProfile'])->name('user.profile.edit');
    Route::post('/profile/update', [UserController::class, 'updateProfile'])->name('user.profile.update');
    Route::post('/profile/change-password', [UserController::class, 'changePassword'])
        ->name('user.profile.change-password');

    Route::get('/pengaturan', [UserController::class, 'pengaturan'])->name('user.pengaturan');

    // =====================
    // 📌 INFO BEASISWA (LOGIN REQUIRED)
    // =====================
    Route::get('/info/dhuafa', function () {
        return view('daftar.info-dhuafa');
    })->name('info.dhuafa');

    Route::get('/info/kader', function () {
        return view('daftar.info-kader');
    })->name('info.kader');


    // =====================
    // 📝 FORM PENDAFTARAN (LOGIN REQUIRED)
    // =====================
    Route::get('/daftar/dhuafa', [DaftarController::class, 'dhuafa'])
        ->name('daftar.dhuafa');
    Route::post('/daftar/dhuafa', [DaftarController::class, 'storeDhuafa'])
        ->name('daftar.storeDhuafa');

    Route::get('/daftar/kader', [DaftarController::class, 'kader'])
        ->name('daftar.kader');
    Route::post('/daftar/kader', [DaftarController::class, 'storeKader'])
        ->name('daftar.storeKader');
});

// =====================
// 🔐 ADMIN ROUTES
// =====================
Route::middleware(['auth','role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // =====================
// 👥 MANAJEMEN USER (ADMIN)
// =====================
  Route::resource('users', UserManagementController::class)->except(['show']);

    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

    // Banner
    Route::resource('banner', BannerController::class);

    // =====================
    // KRITERIA
    // =====================
    Route::get('/kriteria/dhuafa', [KriteriaController::class, 'dhuafa'])->name('kriteria.dhuafa');
    Route::get('/kriteria/kader', [KriteriaController::class, 'kader'])->name('kriteria.kader');

    Route::get('/kriteria/dhuafa/create', [KriteriaController::class, 'createDhuafa'])
        ->name('kriteria.dhuafa.create');
    Route::get('/kriteria/kader/create', [KriteriaController::class, 'createKader'])
        ->name('kriteria.kader.create');

    Route::post('/kriteria', [KriteriaController::class, 'store'])->name('kriteria.store');
    Route::get('/kriteria/{kriteria}/edit', [KriteriaController::class, 'edit'])->name('kriteria.edit');
    Route::put('/kriteria/{kriteria}', [KriteriaController::class, 'update'])->name('kriteria.update');
    Route::delete('/kriteria/{kriteria}', [KriteriaController::class, 'destroy'])->name('kriteria.destroy');

    // =====================
    // SUB KRITERIA
    // =====================
    Route::get('/subkriteria/dhuafa', [SubKriteriaController::class, 'dhuafa'])->name('subkriteria.dhuafa');
    Route::get('/subkriteria/kader', [SubKriteriaController::class, 'kader'])->name('subkriteria.kader');

    Route::get('/subkriteria/dhuafa/create', [SubKriteriaController::class, 'createDhuafa'])
        ->name('subkriteria.dhuafa.create');
    Route::get('/subkriteria/kader/create', [SubKriteriaController::class, 'createKader'])
        ->name('subkriteria.kader.create');

    Route::post('/subkriteria', [SubKriteriaController::class, 'store'])->name('subkriteria.store');
    Route::get('/subkriteria/{subkriteria}/edit', [SubKriteriaController::class, 'edit'])
        ->name('subkriteria.edit');
    Route::put('/subkriteria/{subkriteria}', [SubKriteriaController::class, 'update'])
        ->name('subkriteria.update');
    Route::delete('/subkriteria/{subkriteria}', [SubKriteriaController::class, 'destroy'])
        ->name('subkriteria.destroy');

    // =====================
    // PENDAFTAR / ALTERNATIF
    // =====================
    Route::resource('alternatif', PendaftarController::class);
    Route::get('/pendaftar', [PendaftarController::class, 'index'])->name('pendaftar.index');
    Route::post('/pendaftar/{alternatif}/status-administrasi', [PendaftarController::class, 'updateStatusAdministrasi'])
    ->name('pendaftar.statusAdministrasi');

    Route::get('/wawancara', [AdminWawancaraController::class, 'index'])
    ->name('wawancara.index');

    // =====================
    // PENILAIAN
    // =====================
    Route::get('/penilaian/dhuafa', [PenilaianController::class, 'dhuafa'])->name('penilaian.dhuafa');
    Route::get('/penilaian/kader', [PenilaianController::class, 'kader'])->name('penilaian.kader');

    Route::post('/penilaian', [PenilaianController::class, 'store'])->name('penilaian.store');
    Route::get('/penilaian/{alternatif}/edit', [PenilaianController::class, 'edit'])->name('penilaian.edit');
    Route::put('/penilaian/{alternatif}', [PenilaianController::class, 'update'])->name('penilaian.update');

    // =====================
    // HASIL SAW
    // =====================
    Route::get('/dhuafa', [HasilPerhitunganController::class, 'dhuafa'])->name('dhuafa');
    Route::post('/dhuafa/proses', [HasilPerhitunganController::class, 'prosesDhuafa'])->name('dhuafa.proses');
    Route::get('/dhuafa/detail/{id}', [HasilPerhitunganController::class, 'detailDhuafa'])
        ->name('dhuafa.detail');

    Route::get('/kader', [HasilPerhitunganController::class, 'kader'])->name('kader');
    Route::post('/kader/proses', [HasilPerhitunganController::class, 'prosesKader'])->name('kader.proses');
    Route::get('/kader/detail/{id}', [HasilPerhitunganController::class, 'detailKader'])
        ->name('kader.detail');

    Route::post('/hasil-saw/{alternatif}/status-beasiswa', 
    [HasilPerhitunganController::class, 'updateStatusBeasiswa']
    )->name('hasil.statusBeasiswa');


    // =====================
    // LAPORAN
    // =====================
    Route::get('/laporan/dhuafa', [LaporanController::class, 'dhuafa'])->name('laporan.dhuafa');
    Route::get('/laporan/kader', [LaporanController::class, 'kader'])->name('laporan.kader');

    Route::get('/laporan/dhuafa/export', [LaporanController::class, 'exportDhuafa'])
        ->name('laporan.dhuafa.export');
    Route::get('/laporan/kader/export', [LaporanController::class, 'exportKader'])
        ->name('laporan.kader.export');

    // Informasi
    Route::resource('informasi', InformasiController::class);

    // Profil Admin
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Settings
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::post('/settings/update', [SettingsController::class, 'update'])->name('settings.update');
});

// =====================
// 🎤 PEWAWANCARA ROUTES
// =====================
Route::middleware(['auth','role:pewawancara'])
    ->prefix('pewawancara')
    ->name('pewawancara.')
    ->group(function () {

        Route::get('/dashboard', [PewawancaraController::class, 'dashboard'])
            ->name('dashboard');

             Route::get('/kader', [PewawancaraController::class, 'kader'])
            ->name('kader');

            Route::get('/dhuafa', [PewawancaraController::class, 'dhuafa'])
            ->name('dhuafa');

        Route::get('/form/{id}', [PewawancaraController::class, 'form'])
            ->name('form');

       Route::post('/nilai/store/{id}', [PewawancaraController::class, 'store'])
    ->name('store');

            
            

    });



