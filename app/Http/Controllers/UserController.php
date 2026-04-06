<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function beranda()
    {
        return view('home.index');
    }

    public function beasiswa()
{
    $userEmail = Auth::user()->email;

    // Ambil pendaftaran user (tahap administrasi + wawancara + status_beasiswa + opsional hasil SAW)
    $aplikasiBeasiswa = Alternatif::with(['hasilPerhitungan', 'nilaiWawancara'])
        ->where('email', $userEmail)
        ->orderBy('created_at', 'desc')
        ->get();

    // Statistik berbasis STATUS ADMINISTRASI
    $totalAplikasi = $aplikasiBeasiswa->count();

    $menungguAdministrasi = $aplikasiBeasiswa->where('status_administrasi', 'pending')->count();
    $lulusAdministrasi    = $aplikasiBeasiswa->where('status_administrasi', 'lulus')->count();
    $tidakLulusAdministrasi = $aplikasiBeasiswa->where('status_administrasi', 'tidak_lulus')->count();

    // Statistik sudah dinilai wawancara
    $sudahDinilaiWawancara = $aplikasiBeasiswa->filter(function ($item) {
        return $item->nilaiWawancara && $item->nilaiWawancara->count() > 0;
    })->count();

    // TAMBAHAN: Statistik berdasarkan status_beasiswa (hasil akhir)
    $beasiswaDiterima = $aplikasiBeasiswa->where('status_beasiswa', 'diterima')->count();
    $beasiswaDitolak = $aplikasiBeasiswa->where('status_beasiswa', 'tidak_diterima')->count();
    $beasiswaMenunggu = $aplikasiBeasiswa->whereNull('status_beasiswa')->count();

    // Opsional (statistik SAW lama, kalau masih diperlukan)
    $sedangReview = $aplikasiBeasiswa->filter(function ($item) {
        return optional($item->hasilPerhitungan)->status === 'review';
    })->count();

    $disetujui = $aplikasiBeasiswa->filter(function ($item) {
        return optional($item->hasilPerhitungan)->status === 'approved';
    })->count();

    $ditolak = $aplikasiBeasiswa->filter(function ($item) {
        return optional($item->hasilPerhitungan)->status === 'rejected';
    })->count();

    return view('user.beasiswa', compact(
        'aplikasiBeasiswa',
        'totalAplikasi',
        'menungguAdministrasi',
        'lulusAdministrasi',
        'tidakLulusAdministrasi',
        'sudahDinilaiWawancara',
        'beasiswaDiterima',
        'beasiswaDitolak',
        'beasiswaMenunggu',
        'sedangReview',
        'disetujui',
        'ditolak'
    ));
}
    public function notifikasi()
    {
        return view('user.notifikasi');
    }

    public function profile()
    {
        $user = Auth::user();
        return view('user.profile', compact('user'));
    }

    public function editProfile()
    {
        $user = Auth::user();
        return view('user.edit-profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        $user->update($request->only(['name', 'email']));

        return redirect()->route('user.profile')
            ->with('success', 'Profile berhasil diperbarui');
    }

    public function pengaturan()
    {
        return view('user.pengaturan');
    }

    public function updatePengaturan(Request $request)
    {
        $user = Auth::user();
        $user->email_notifications = $request->has('email_notifications');
        $user->save();

        return redirect()->route('user.pengaturan')
            ->with('success', 'Pengaturan berhasil diperbarui');
    }

    public function changePassword(Request $request)
{
    $request->validate([
        'current_password' => 'required',
        'new_password' => 'required|min:8|confirmed',
    ]);

    $user = Auth::user();

    // Cek password lama
    if (!Hash::check($request->current_password, $user->password)) {
        return back()->withErrors([
            'current_password' => 'Password lama tidak sesuai',
        ]);
    }

    // Update password
    $user->password = Hash::make($request->new_password);
    $user->save();

    return back()->with('success', 'Password berhasil diubah');
}
}
