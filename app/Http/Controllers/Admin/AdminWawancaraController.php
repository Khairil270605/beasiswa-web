<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alternatif;

class AdminWawancaraController extends Controller
{
    public function index()
    {
        $pageTitle = 'Hasil Wawancara';

        $peserta = Alternatif::whereHas('nilaiWawancara')
            ->with(['nilaiWawancara.pewawancara'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.wawancara.index', compact('pageTitle', 'peserta'));
    }
}
