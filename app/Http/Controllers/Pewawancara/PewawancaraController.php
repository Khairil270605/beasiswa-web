<?php

namespace App\Http\Controllers\Pewawancara;

use App\Http\Controllers\Controller;
use App\Models\Alternatif;
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

        $peserta = Alternatif::where('status_administrasi', 'lulus')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pewawancara.dashboard', compact('pageTitle', 'peserta'));
    }
    public function kader()
{
    $pageTitle = 'Penilaian Wawancara Kader';

    $peserta = Alternatif::where('status_administrasi', 'lulus')
        ->where('jenis_pendaftaran', 'kader')
        ->orderBy('created_at', 'desc')
        ->get();

    return view('pewawancara.kader', compact('pageTitle', 'peserta'));
}

public function dhuafa()
{
    $pageTitle = 'Penilaian Wawancara Dhuafa';

    $peserta = Alternatif::where('status_administrasi', 'lulus')
        ->where('jenis_pendaftaran', 'dhuafa')
        ->orderBy('created_at', 'desc')
        ->get();

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

        // Validasi nilai: harus ada untuk setiap komponen, angka 1-5
        $request->validate([
            'nilai' => 'required|array',
        ]);

        foreach ($komponen as $k) {
            $request->validate([
                "nilai.$k" => 'required|integer|min:1|max:5',
                "catatan.$k" => 'nullable|string',
            ]);
        }

        $pewawancaraId = auth()->id();

        // Simpan / update per komponen (biar kalau ngisi ulang tidak dobel)
        foreach ($komponen as $k) {
            NilaiWawancara::updateOrCreate(
                [
                    'alternatif_id' => $alternatif->id,
                    'komponen' => $k,
                ],
                [
                    'nilai' => (int) $request->input("nilai.$k"),
                    'catatan' => $request->input("catatan.$k"),
                    'pewawancara_id' => $pewawancaraId,
                    'status' => 'draft',
                ]
            );
        }

        return redirect()
            ->route('pewawancara.dashboard')
            ->with('success', 'Nilai wawancara berhasil disimpan (draft).');
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
