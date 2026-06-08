<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alternatif;
use App\Models\Periode;

class AdminWawancaraController extends Controller
{
    public function index()
    {
        $pageTitle = 'Hasil Wawancara';

        $periodeAktif = Periode::where('status', 'aktif')->first();

        if (!$periodeAktif) {

            $peserta = collect();

        } else {

            $peserta = Alternatif::whereHas('nilaiWawancara')
                ->where('periode_id', $periodeAktif->id)
                ->with(['nilaiWawancara.pewawancara'])
                ->orderBy('created_at', 'desc')
                ->get();

        }

        return view('admin.wawancara.index', compact(
            'pageTitle',
            'peserta',
            'periodeAktif'
        ));
    }
}