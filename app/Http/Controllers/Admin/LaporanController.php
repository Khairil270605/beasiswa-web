<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HasilPerhitungan;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function dhuafa(Request $request)
    {
        $hasilSeleksi = HasilPerhitungan::with('alternatif')
            ->whereHas('alternatif', function ($q) {
                $q->where('jenis_pendaftaran', 'dhuafa');
            })
            ->orderBy('ranking')
            ->get();

        return view('admin.laporan.dhuafa', [
            'hasilSeleksi' => $hasilSeleksi,
            'totalPendaftar' => $hasilSeleksi->count(),
            'totalLulus' => $hasilSeleksi->where('alternatif.status_beasiswa', 'diterima')->count(),
            'totalTidakLulus' => $hasilSeleksi->where('alternatif.status_beasiswa', 'tidak_diterima')->count(),
            'persentaseLulus' => $hasilSeleksi->count() > 0
                ? round(
                    $hasilSeleksi->where('alternatif.status_beasiswa', 'diterima')->count()
                    / $hasilSeleksi->count() * 100
                )
                : 0,
        ]);
    }

    public function kader(Request $request)
    {
        $hasilSeleksi = HasilPerhitungan::with('alternatif')
            ->whereHas('alternatif', function ($q) {
                $q->where('jenis_pendaftaran', 'kader');
            })
            ->orderBy('ranking')
            ->get();

        return view('admin.laporan.kader', [
            'hasilSeleksi' => $hasilSeleksi,
            'totalPendaftar' => $hasilSeleksi->count(),
            'totalLulus' => $hasilSeleksi->where('alternatif.status_beasiswa', 'diterima')->count(),
            'totalTidakLulus' => $hasilSeleksi->where('alternatif.status_beasiswa', 'tidak_diterima')->count(),
            'persentaseLulus' => $hasilSeleksi->count() > 0
                ? round(
                    $hasilSeleksi->where('alternatif.status_beasiswa', 'diterima')->count()
                    / $hasilSeleksi->count() * 100
                )
                : 0,
        ]);
    }
}
