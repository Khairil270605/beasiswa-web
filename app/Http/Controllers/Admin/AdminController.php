<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kriteria;
use App\Models\Alternatif;
use App\Models\SubKriteria;
use App\Models\Penilaian;

class AdminController extends Controller
{
    public function index()
    {
        // Total keseluruhan sistem
        $totalKriteria = Kriteria::count();
        $totalSubKriteria = SubKriteria::count();
        $totalAlternatif = Alternatif::count();
        $totalPenilaian = Penilaian::count();

        // Data Beasiswa Dhuafa
        $kriteriaDhuafa = Kriteria::where('kategori', 'dhuafa')->count();
        $subKriteriaDhuafa = SubKriteria::where('kategori', 'dhuafa')->count();
        $alternatifDhuafa = Alternatif::where('jenis_pendaftaran', 'dhuafa')->count();
        $penilaianDhuafa = Penilaian::whereHas('alternatif', function($query) {
            $query->where('jenis_pendaftaran', 'dhuafa');
        })->count();

        // Data Beasiswa Kader
        $kriteriaKader = Kriteria::where('kategori', 'kader')->count();
        $subKriteriaKader = SubKriteria::where('kategori', 'kader')->count();
        $alternatifKader = Alternatif::where('jenis_pendaftaran', 'kader')->count();
        $penilaianKader = Penilaian::whereHas('alternatif', function($query) {
            $query->where('jenis_pendaftaran', 'kader');
        })->count();

        return view('admin.dashboard', compact(
            // Total System
            'totalKriteria',
            'totalSubKriteria',
            'totalAlternatif',
            'totalPenilaian',
            
            // Dhuafa
            'kriteriaDhuafa',
            'subKriteriaDhuafa',
            'alternatifDhuafa',
            'penilaianDhuafa',
            
            // Kader
            'kriteriaKader',
            'subKriteriaKader',
            'alternatifKader',
            'penilaianKader'
        ));
    }
}