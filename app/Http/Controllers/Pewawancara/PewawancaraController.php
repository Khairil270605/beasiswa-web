<?php

namespace App\Http\Controllers\Pewawancara;

use App\Http\Controllers\Controller;
use App\Models\Alternatif;
use App\Models\Periode;
use App\Models\NilaiWawancara;
use Illuminate\Http\Request;

class PewawancaraController extends Controller
{
    /**
     * Dashboard Pewawancara
     * Menampilkan peserta yang lulus administrasi
     */
    public function dashboard()
{
    $pageTitle = 'Dashboard Pewawancara';

    $periodeAktif = Periode::where('status', 'aktif')->first();

    if (!$periodeAktif) {

        $peserta = collect();

    } else {

        $peserta = Alternatif::where('status_administrasi', 'lulus')
            ->where('periode_id', $periodeAktif->id)
            ->where('pewawancara_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();

    }

    return view('pewawancara.dashboard', compact('pageTitle', 'peserta'));
}
    public function kader()
{
    $pageTitle = 'Penilaian Wawancara Kader';

    $periodeAktif = Periode::where('status', 'aktif')->first();

    if (!$periodeAktif) {

        $peserta = collect();

    } else {

        $peserta = Alternatif::where('status_administrasi', 'lulus')
            ->where('periode_id', $periodeAktif->id)
            ->where('jenis_pendaftaran', 'kader')
            ->where('pewawancara_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();

    }

    return view('pewawancara.kader', compact('pageTitle', 'peserta'));
}

public function dhuafa()
{
    $pageTitle = 'Penilaian Wawancara Dhuafa';

    $periodeAktif = Periode::where('status', 'aktif')->first();

    if (!$periodeAktif) {

        $peserta = collect();

    } else {

        $peserta = Alternatif::where('status_administrasi', 'lulus')
            ->where('periode_id', $periodeAktif->id)
            ->where('jenis_pendaftaran', 'dhuafa')
            ->where('pewawancara_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();

    }

    return view('pewawancara.dhuafa', compact('pageTitle', 'peserta'));
}

    /**
     * Form input wawancara (per peserta)
     * Komponen wawancara ditentukan dari kategori peserta (kader / dhuafa)
     */
    public function form($alternatifId)
    {
        $pageTitle = 'Form Penilaian Wawancara';

        $alternatif = Alternatif::findOrFail($alternatifId);

        // Proteksi: hanya yang lulus administrasi boleh diwawancara
        if ($alternatif->status_administrasi !== 'lulus') {
            return back()->with('error', 'Peserta belum lulus administrasi, tidak bisa dinilai wawancara.');
        }

        // Komponen wawancara berdasarkan kategori
        $komponen = $this->komponenByKategori($alternatif->jenis_pendaftaran);

        // Ambil nilai yang sudah pernah disimpan (kalau ada)
        $existing = NilaiWawancara::where('alternatif_id', $alternatif->id)->get()
            ->keyBy('komponen'); // biar gampang akses existing['Tajwid']->nilai

        return view('pewawancara.form', compact('pageTitle', 'alternatif', 'komponen', 'existing'));
    }

    /**
     * Simpan nilai wawancara (status = draft)
     */
    public function store(Request $request, $alternatifId)
{
    $alternatif = Alternatif::findOrFail($alternatifId);

    // Proteksi: hanya yang lulus administrasi boleh diwawancara
    if ($alternatif->status_administrasi !== 'lulus') {
        return back()->with('error', 'Peserta belum lulus administrasi, tidak bisa dinilai wawancara.');
    }

    $komponen = $this->komponenByKategori($alternatif->jenis_pendaftaran);

    // Validasi
    $request->validate([
        'nilai' => 'required|array',
        'catatan_akhir' => 'nullable|string|max:5000',
    ]);

    foreach ($komponen as $k) {
        $request->validate([
            "nilai.$k" => 'required|integer|min:1|max:5',
            "catatan.$k" => 'nullable|string',
        ]);
    }

    $pewawancaraId = auth()->id();
    $catatanAkhir = $request->catatan_akhir;

    // Simpan / update per komponen
    foreach ($komponen as $k) {
        NilaiWawancara::updateOrCreate(
            [
                'alternatif_id' => $alternatif->id,
                'komponen'      => $k,
            ],
            [
                'nilai'          => (int) $request->input("nilai.$k"),
                'catatan'        => $request->input("catatan.$k"),
                'catatan_akhir'  => $catatanAkhir,
                'pewawancara_id' => $pewawancaraId,
                'status'         => 'draft',
            ]
        );
    }

    // Update status wawancara peserta
    $alternatif->status_wawancara = 'selesai';
    $alternatif->save();

    return redirect()
        ->route('pewawancara.dashboard')
        ->with('success', 'Nilai wawancara berhasil disimpan.');
}

    /**
     * Daftar komponen wawancara berdasarkan kategori
     * (sesuai form yang kamu kirim)
     */
    private function komponenByKategori(string $kategori): array
{
    if ($kategori === 'kader') {
        return [
            'Baca Al-Qur\'an',
            'Wawasan AIK',
            'Keaktifan dalam Persyarikatan / Ortom',

            'Visi, Misi, dan Tujuan',
            'Kesiapan Akademik',
            'Prestasi',

            'Life Plan (Rencana Masa Depan)',
            'Pengembangan Akademik',

            'Kontribusi Relawan Lazismu DIY',
            'Loyalitas Mengabdi di Muhammadiyah',
        ];
    }

    // DHUAFA (8)
    return [
        'Baca Al-Qur\'an',
        'Wawasan Keislaman',

        'Visi, Misi, dan Tujuan',
        'Kesiapan Akademik',
        'Prestasi',

        'Life Plan (Rencana Masa Depan)',
        'Pengembangan Akademik',

        'Kontribusi Relawan Lazismu DIY',
    ];
}
}
