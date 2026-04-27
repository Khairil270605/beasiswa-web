<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Periode;
use Illuminate\Http\Request;
use App\Models\Alternatif;

class PeriodeController extends Controller
{
    public function index()
    {
        $periodes = Periode::latest()->get();
        return view('admin.periode.index', compact('periodes'));
    }

    public function create()
    {
        return view('admin.periode.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_periode' => 'required',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date',
        ]);

        Periode::create($request->all());

        return redirect()->route('admin.periode.index')
            ->with('success', 'Periode berhasil ditambahkan');
    }

    public function edit($id)
    {
        $periode = Periode::findOrFail($id);
        return view('admin.periode.edit', compact('periode'));
    }

    public function update(Request $request, $id)
    {
        $periode = Periode::findOrFail($id);

        $periode->update($request->all());

        return redirect()->route('admin.periode.index')
            ->with('success', 'Periode berhasil diupdate');
    }

    public function destroy($id)
    {
        Periode::destroy($id);

        return back()->with('success', 'Periode dihapus');
    }
    public function aktifkan($id)
{
    $periode = Periode::findOrFail($id);

    if ($periode->status == 'aktif') {
        // kalau sedang aktif → jadikan nonaktif
        $periode->update(['status' => 'tidak_aktif']);

        return back()->with('success', 'Periode berhasil dinonaktifkan');
    }

    // kalau tidak aktif → aktifkan dan nonaktifkan yang lain
    Periode::query()->update(['status' => 'tidak_aktif']);

    $periode->update(['status' => 'aktif']);

    return back()->with('success', 'Periode berhasil diaktifkan');
}
public function pendaftar($id)
{
    $periode = Periode::findOrFail($id);

    $pendaftar = Alternatif::where('periode_id', $id)->get();

    return view('admin.periode.pendaftar', compact('periode', 'pendaftar'));
}
public function export($id)
{
    $periode = Periode::findOrFail($id);
    $pendaftar = Alternatif::where('periode_id', $id)->get();

    $filename = "pendaftar_" . str_replace('/', '-', $periode->nama_periode) . ".xls";

    $headers = [
        "Content-type" => "application/vnd-ms-excel",
        "Content-Disposition" => "attachment; filename=$filename"
    ];

    $content = view('admin.periode.export_excel', compact('pendaftar'));

    return response($content, 200, $headers);
}

}

