<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kriteria;
use App\Models\Alternatif;
use App\Models\SubKriteria;
use App\Models\Penilaian;
use App\Models\Periode;

class AdminController extends Controller
{
    public function index()
    {
        // =====================
        // DATA PERIODE
        // =====================
        $periodeList = Periode::orderBy('created_at')->get();

        // =====================
        // DATA GRAFIK TOTAL PER PERIODE
        // =====================
        $labels = [];
        $data = [];

        foreach ($periodeList as $p) {
            $labels[] = $p->nama_periode;
            $data[] = Alternatif::where('periode_id', $p->id)->count();
        }

        // =====================
        // DATA GRAFIK (Dhuafa vs Kader)
        // =====================
        $chartData = Alternatif::selectRaw('
                periode_id,
                jenis_pendaftaran as kategori,
                COUNT(*) as total
            ')
            ->groupBy('periode_id', 'jenis_pendaftaran')
            ->with('periode:id,nama_periode')
            ->get()
            ->map(function ($row) {
                return [
                    'periode_id'   => $row->periode_id,
                    'nama_periode' => $row->periode->nama_periode ?? '-',
                    'kategori'     => $row->kategori,
                    'total'        => $row->total,
                ];
            });

        // =====================
        // TOTAL DATA SISTEM
        // =====================
        $totalKriteria = Kriteria::count();
        $totalSubKriteria = SubKriteria::count();
        $totalAlternatif = Alternatif::count();
        $totalPenilaian = Penilaian::count();

        // =====================
        // DATA DHUAFA
        // =====================
        $kriteriaDhuafa = Kriteria::where('kategori', 'dhuafa')->count();
        $subKriteriaDhuafa = SubKriteria::where('kategori', 'dhuafa')->count();
        $alternatifDhuafa = Alternatif::where('jenis_pendaftaran', 'dhuafa')->count();
        $penilaianDhuafa = Penilaian::whereHas('alternatif', function ($query) {
            $query->where('jenis_pendaftaran', 'dhuafa');
        })->count();

        // =====================
        // DATA KADER
        // =====================
        $kriteriaKader = Kriteria::where('kategori', 'kader')->count();
        $subKriteriaKader = SubKriteria::where('kategori', 'kader')->count();
        $alternatifKader = Alternatif::where('jenis_pendaftaran', 'kader')->count();
        $penilaianKader = Penilaian::whereHas('alternatif', function ($query) {
            $query->where('jenis_pendaftaran', 'kader');
        })->count();

        // =====================
        // RETURN VIEW
        // =====================
        return view('admin.dashboard', compact(
            // TOTAL
            'totalKriteria',
            'totalSubKriteria',
            'totalAlternatif',
            'totalPenilaian',

            // DHUAFA
            'kriteriaDhuafa',
            'subKriteriaDhuafa',
            'alternatifDhuafa',
            'penilaianDhuafa',

            // KADER
            'kriteriaKader',
            'subKriteriaKader',
            'alternatifKader',
            'penilaianKader',

            // GRAFIK
            'labels',
            'data',
            'chartData',
            'periodeList'
        ));
    }
}