<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SubKriteria;
use App\Models\Kriteria;
use Illuminate\Http\Request;

class SubKriteriaController extends Controller
{
    /* =======================
     *  HALAMAN KATEGORI
     * ======================= */

    public function dhuafa()
    {
        $pageTitle = 'Data Sub Kriteria Dhuafa';
        $subkriterias = SubKriteria::whereHas('kriteria', function($query) {
            $query->where('kategori', 'dhuafa');
        })->with('kriteria')->latest()->get();
        
        $kriterias = Kriteria::dhuafa()->get();

        return view('admin.subkriteria.dhuafa', compact('pageTitle', 'subkriterias', 'kriterias'));
    }

    public function kader()
    {
        $pageTitle = 'Data Sub Kriteria Kader';
        $subkriterias = SubKriteria::whereHas('kriteria', function($query) {
            $query->where('kategori', 'kader');
        })->with('kriteria')->latest()->get();
        
        $kriterias = Kriteria::kader()->get();

        return view('admin.subkriteria.kader', compact('pageTitle', 'subkriterias', 'kriterias'));
    }

    /* =======================
     *  HALAMAN CREATE
     * ======================= */

    public function createDhuafa()
    {
        $pageTitle = 'Tambah Sub Kriteria Dhuafa';
        $kategori = 'dhuafa';
        $kriterias = Kriteria::dhuafa()->get();

        return view('admin.subkriteria.create', compact('pageTitle', 'kategori', 'kriterias'));
    }

    public function createKader()
    {
        $pageTitle = 'Tambah Sub Kriteria Kader';
        $kategori = 'kader';
        $kriterias = Kriteria::kader()->get();

        return view('admin.subkriteria.create', compact('pageTitle', 'kategori', 'kriterias'));
    }

    /* =======================
     *  SIMPAN DATA
     * ======================= */

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kriteria_id' => 'required|exists:kriteria,id',
            'nama_subkriteria' => 'required|string|max:255',
            'nilai' => 'required|numeric|min:0',
            'kategori' => 'required|in:dhuafa,kader',
        ]);

        SubKriteria::create($validated);

        // Redirect ke halaman kategori yang sesuai
        $redirectRoute = $validated['kategori'] === 'dhuafa' 
            ? 'admin.subkriteria.dhuafa' 
            : 'admin.subkriteria.kader';

        return redirect()->route($redirectRoute)
            ->with('success', 'Sub Kriteria berhasil ditambahkan.');
    }

    /* =======================
     *  EDIT & UPDATE
     * ======================= */

    public function edit(SubKriteria $subkriteria)
    {
        $pageTitle = 'Edit Sub Kriteria';
        
        // Ambil kategori dari kriteria yang terkait
        $kategori = $subkriteria->kriteria->kategori;
        
        // Ambil kriteria sesuai kategori
        $kriterias = Kriteria::where('kategori', $kategori)->get();

        return view('admin.subkriteria.edit', compact('pageTitle', 'subkriteria', 'kriterias', 'kategori'));
    }

    public function update(Request $request, SubKriteria $subkriteria)
    {
        $validated = $request->validate([
            'kriteria_id' => 'required|exists:kriteria,id',
            'nama_subkriteria' => 'required|string|max:255',
            'nilai' => 'required|numeric|min:0',
        ]);

        $subkriteria->update($validated);

        // Redirect ke halaman kategori yang sesuai
        $kategori = $subkriteria->kriteria->kategori;
        $redirectRoute = $kategori === 'dhuafa' 
            ? 'admin.subkriteria.dhuafa' 
            : 'admin.subkriteria.kader';

        return redirect()->route($redirectRoute)
            ->with('success', 'Sub Kriteria berhasil diperbarui.');
    }

    /* =======================
     *  HAPUS DATA
     * ======================= */

    public function destroy(SubKriteria $subkriteria)
    {
        $kategori = $subkriteria->kriteria->kategori;
        $subkriteria->delete();

        // Redirect ke halaman kategori yang sesuai
        $redirectRoute = $kategori === 'dhuafa' 
            ? 'admin.subkriteria.dhuafa' 
            : 'admin.subkriteria.kader';

        return redirect()->route($redirectRoute)
            ->with('success', 'Sub Kriteria berhasil dihapus.');
    }
}