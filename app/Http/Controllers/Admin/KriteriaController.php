<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kriteria;
use Illuminate\Http\Request;

class KriteriaController extends Controller
{
    /* =======================
     *  HALAMAN KATEGORI
     * ======================= */

    public function dhuafa()
    {
        $pageTitle = 'Data Kriteria Dhuafa';
        $kriterias = Kriteria::dhuafa()->latest()->get();

        return view('admin.kriteria.dhuafa', compact('pageTitle', 'kriterias'));
    }

    public function kader()
    {
        $pageTitle = 'Data Kriteria Kader';
        $kriterias = Kriteria::kader()->latest()->get();

        return view('admin.kriteria.kader', compact('pageTitle', 'kriterias'));
    }

    /* =======================
     *  SIMPAN DATA
     * ======================= */

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_kriteria' => 'required|unique:kriteria,kode_kriteria',
            'nama_kriteria' => 'required|string|max:255',
            'bobot'         => 'required|numeric|min:0',
            'jenis'         => 'required|in:benefit,cost',
            'kategori'      => 'required|in:dhuafa,kader',
        ]);

        Kriteria::create($validated);

        return redirect()->route(
    $validated['kategori'] === 'dhuafa'
        ? 'admin.kriteria.dhuafa'
        : 'admin.kriteria.kader'
)->with('success', 'Kriteria berhasil ditambahkan.');

    }
public function createDhuafa()
{
    $pageTitle = 'Tambah Kriteria Dhuafa';
    $jenis = 'dhuafa';

    return view('admin.kriteria.create', compact('pageTitle', 'jenis'));
}

public function createKader()
{
    $pageTitle = 'Tambah Kriteria Kader';
    $jenis = 'kader';

    return view('admin.kriteria.create', compact('pageTitle', 'jenis'));
}

    /* =======================
     *  EDIT & UPDATE
     * ======================= */

    public function edit(Kriteria $kriteria)
    {
        $pageTitle = 'Edit Kriteria';

        return view('admin.kriteria.edit', compact('pageTitle', 'kriteria'));
    }

    public function update(Request $request, Kriteria $kriteria)
    {
        $validated = $request->validate([
            'kode_kriteria' => 'required|unique:kriteria,kode_kriteria,' . $kriteria->id,
            'nama_kriteria' => 'required|string|max:255',
            'bobot'         => 'required|numeric|min:0',
            'jenis'         => 'required|in:benefit,cost',
        ]);

        $kriteria->update($validated);

        return redirect()->back()
            ->with('success', 'Kriteria berhasil diperbarui.');
    }

    /* =======================
     *  HAPUS DATA
     * ======================= */

    public function destroy(Kriteria $kriteria)
    {
        $kriteria->subKriteria()->delete();
        $kriteria->penilaian()->delete();
        $kriteria->delete();

        return redirect()->back()
            ->with('success', 'Kriteria berhasil dihapus.');
    }
}
