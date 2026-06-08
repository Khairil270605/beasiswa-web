<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alternatif;
use App\Models\User;
use App\Models\Periode;
use Illuminate\Http\Request;

class PlottingWawancara extends Controller
{
    public function index()
    {
        $pageTitle = 'Plotting Pewawancara';

        $periodeAktif = Periode::where('status', 'aktif')->first();

        if (!$periodeAktif) {
            $peserta = collect();
        } else {
            $peserta = Alternatif::where('status_administrasi', 'lulus')
                ->where('periode_id', $periodeAktif->id)
                ->orderBy('created_at', 'desc')
                ->get();
        }

        $pewawancara = User::where('role', 'pewawancara')->get();

        return view('admin.plotting-wawancara.index', compact(
            'pageTitle',
            'peserta',
            'pewawancara',
            'periodeAktif'
        ));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'pewawancara_id' => 'required|exists:users,id',
        ]);

        $alternatif = Alternatif::findOrFail($id);
        $alternatif->pewawancara_id = $request->pewawancara_id;
        $alternatif->save();

        return back()->with('success', 'Pewawancara berhasil diplot.');
    }

    public function bulkUpdate(Request $request)
    {
        $request->validate([
            'alternatif_ids' => 'required|array',
            'alternatif_ids.*' => 'exists:alternatif,id',
            'pewawancara_id' => 'required|exists:users,id',
        ]);

        Alternatif::whereIn('id', $request->alternatif_ids)
            ->update([
                'pewawancara_id' => $request->pewawancara_id,
            ]);

        return redirect()
            ->route('admin.plotting-wawancara.index')
            ->with('success', 'Plotting pewawancara berhasil disimpan.');
    }
}