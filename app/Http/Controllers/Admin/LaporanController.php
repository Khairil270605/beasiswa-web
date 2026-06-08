<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HasilPerhitungan;
use App\Models\Periode;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    /* =========================
     * LAPORAN DHUAFA
     * ========================= */
    public function dhuafa(Request $request)
    {
        $periodeAktif = Periode::where('status', 'aktif')->first();

        $periodeId = $request->periode ?? $periodeAktif?->id;

        $query = HasilPerhitungan::with('alternatif.periode')
            ->whereHas('alternatif', function ($q) {
                $q->where('jenis_pendaftaran', 'dhuafa')
                    ->where('status_administrasi', 'lulus')
                    ->where('status_data', 'aktif');
            });

        // 🔥 FILTER PERIODE
        if ($periodeId) {
            $query->whereHas('alternatif', function ($q) use ($periodeId) {
                $q->where('periode_id', $periodeId);
            });
        }

        // 🔥 FILTER STATUS
        if ($request->status) {
            $query->whereHas('alternatif', function ($q) use ($request) {
                $q->where('status_beasiswa', $request->status);
            });
        }

        // 🔥 SORTING
        if ($request->sort) {

            switch ($request->sort) {

                case 'ranking_asc':
                    $query->orderBy('ranking', 'asc');
                    break;

                case 'score_desc':
                    $query->orderBy('nilai_akhir', 'desc');
                    break;

                case 'score_asc':
                    $query->orderBy('nilai_akhir', 'asc');
                    break;
            }

        } else {

            $query->orderBy('ranking', 'asc');
        }

        $hasilSeleksi = $query->get();

        $periodes = Periode::orderBy('created_at', 'desc')->get();

        return view('admin.laporan.dhuafa', [

            'hasilSeleksi' => $hasilSeleksi,
            'periodes' => $periodes,

            'periodeAktif' => $periodeAktif,
            'periodeTerpilih' => $periodeId,

            'totalPendaftar' => $hasilSeleksi->count(),

            'totalLulus' => $hasilSeleksi
                ->where('alternatif.status_beasiswa', 'diterima')
                ->count(),

            'totalTidakLulus' => $hasilSeleksi
                ->where('alternatif.status_beasiswa', 'tidak_diterima')
                ->count(),

            'persentaseLulus' => $hasilSeleksi->count() > 0
                ? round(
                    $hasilSeleksi
                        ->where('alternatif.status_beasiswa', 'diterima')
                        ->count()
                    / $hasilSeleksi->count() * 100
                )
                : 0,
        ]);
    }

    /* =========================
     * LAPORAN KADER
     * ========================= */
    public function kader(Request $request)
    {
        $periodeAktif = Periode::where('status', 'aktif')->first();

        $periodeId = $request->periode ?? $periodeAktif?->id;

        $query = HasilPerhitungan::with('alternatif.periode')
            ->whereHas('alternatif', function ($q) {
                $q->where('jenis_pendaftaran', 'kader')
                    ->where('status_administrasi', 'lulus')
                    ->where('status_data', 'aktif');
            });

        // 🔥 FILTER PERIODE
        if ($periodeId) {
            $query->whereHas('alternatif', function ($q) use ($periodeId) {
                $q->where('periode_id', $periodeId);
            });
        }

        // 🔥 FILTER STATUS
        if ($request->status) {
            $query->whereHas('alternatif', function ($q) use ($request) {
                $q->where('status_beasiswa', $request->status);
            });
        }

        // 🔥 SORTING
        if ($request->sort) {

            switch ($request->sort) {

                case 'ranking_asc':
                    $query->orderBy('ranking', 'asc');
                    break;

                case 'score_desc':
                    $query->orderBy('nilai_akhir', 'desc');
                    break;

                case 'score_asc':
                    $query->orderBy('nilai_akhir', 'asc');
                    break;
            }

        } else {

            $query->orderBy('ranking', 'asc');
        }

        $hasilSeleksi = $query->get();

        $periodes = Periode::orderBy('created_at', 'desc')->get();

        return view('admin.laporan.kader', [

            'hasilSeleksi' => $hasilSeleksi,
            'periodes' => $periodes,

            'periodeAktif' => $periodeAktif,
            'periodeTerpilih' => $periodeId,

            'totalPendaftar' => $hasilSeleksi->count(),

            'totalLulus' => $hasilSeleksi
                ->where('alternatif.status_beasiswa', 'diterima')
                ->count(),

            'totalTidakLulus' => $hasilSeleksi
                ->where('alternatif.status_beasiswa', 'tidak_diterima')
                ->count(),

            'persentaseLulus' => $hasilSeleksi->count() > 0
                ? round(
                    $hasilSeleksi
                        ->where('alternatif.status_beasiswa', 'diterima')
                        ->count()
                    / $hasilSeleksi->count() * 100
                )
                : 0,
        ]);
    }
}