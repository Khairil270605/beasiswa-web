<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Penilaian;
use App\Models\Alternatif;
use App\Models\Kriteria;
use App\Models\SubKriteria;
use Illuminate\Http\Request;

class PenilaianController extends Controller
{
    /* =======================
     *  HALAMAN PENILAIAN DHUAFA
     * ======================= */
    public function dhuafa()
    {
        $pageTitle = 'Penilaian Beasiswa Dhuafa';

        // ✅ Ambil peserta dhuafa yang LOLOS administrasi saja
        $alternatifs = Alternatif::where('jenis_pendaftaran', 'dhuafa')
            ->where('status_administrasi', 'lulus')
            ->get();

        // Ambil kriteria & sub kriteria berdasarkan kategori
        $kriterias = Kriteria::where('kategori', 'dhuafa')->get();
        $subkriterias = SubKriteria::where('kategori', 'dhuafa')->get();

        // ✅ Ambil penilaian hanya untuk peserta dhuafa yang LOLOS administrasi
        $penilaian = Penilaian::with('subKriteria')
            ->whereHas('alternatif', function ($query) {
                $query->where('jenis_pendaftaran', 'dhuafa')
                      ->where('status_administrasi', 'lulus');
            })
            ->get();

        // Susun array [alternatif_id][kriteria_id]
        $penilaianArray = [];
        foreach ($penilaian as $p) {
            $penilaianArray[$p->alternatif_id][$p->kriteria_id] = $p;
        }

        return view('admin.penilaian.dhuafa', compact(
            'pageTitle',
            'alternatifs',
            'kriterias',
            'subkriterias',
            'penilaianArray'
        ))->with('penilaian', $penilaianArray);
    }

    /* =======================
     *  HALAMAN PENILAIAN KADER
     * ======================= */
    public function kader()
    {
        $pageTitle = 'Penilaian Beasiswa Kader';

        // ✅ Ambil peserta kader yang LOLOS administrasi saja
        $alternatifs = Alternatif::where('jenis_pendaftaran', 'kader')
            ->where('status_administrasi', 'lulus')
            ->get();

        $kriterias = Kriteria::where('kategori', 'kader')->get();
        $subkriterias = SubKriteria::where('kategori', 'kader')->get();

        // ✅ Ambil penilaian hanya untuk peserta kader yang LOLOS administrasi
        $penilaian = Penilaian::with('subKriteria')
            ->whereHas('alternatif', function ($query) {
                $query->where('jenis_pendaftaran', 'kader')
                      ->where('status_administrasi', 'lulus');
            })
            ->get();

        $penilaianArray = [];
        foreach ($penilaian as $p) {
            $penilaianArray[$p->alternatif_id][$p->kriteria_id] = $p;
        }

        return view('admin.penilaian.kader', compact(
            'pageTitle',
            'alternatifs',
            'kriterias',
            'subkriterias',
            'penilaianArray'
        ))->with('penilaian', $penilaianArray);
    }

    /* =======================
     *  SIMPAN PENILAIAN
     * ======================= */
    public function store(Request $request)
    {
        $jenis = null;

        foreach ($request->nilai as $alternatif_id => $kriteria) {

            $alternatif = Alternatif::find($alternatif_id);
            if (!$alternatif) continue;

            // ✅ Kunci: hanya yang LOLOS administrasi boleh dinilai
            if ($alternatif->status_administrasi !== 'lulus') {
                continue; // bisa diganti return back()->with('error', 'Peserta belum lulus administrasi.');
            }

            if (!$jenis) {
                $jenis = $alternatif->jenis_pendaftaran;
            }

            foreach ($kriteria as $kriteria_id => $sub_id) {
                $sub = SubKriteria::find($sub_id);

                Penilaian::updateOrCreate(
                    [
                        'alternatif_id' => $alternatif_id,
                        'kriteria_id'   => $kriteria_id,
                    ],
                    [
                        'sub_kriteria_id' => $sub_id,
                        'nilai'           => $sub ? $sub->nilai : 0,
                    ]
                );
            }
        }

        return redirect()->route(
            $jenis === 'dhuafa'
                ? 'admin.penilaian.dhuafa'
                : 'admin.penilaian.kader'
        )->with('success', 'Penilaian berhasil disimpan.');
    }

    /* =======================
     *  FORM EDIT PENILAIAN
     * ======================= */
    public function edit($alternatif_id)
    {
        $alternatif = Alternatif::findOrFail($alternatif_id);

        // ✅ Kunci: tidak boleh edit kalau belum lulus administrasi
        if ($alternatif->status_administrasi !== 'lulus') {
            return redirect()->back()->with('error', 'Peserta belum lulus administrasi.');
        }

        $jenis = $alternatif->jenis_pendaftaran;
        $pageTitle = 'Edit Penilaian ' . ucfirst($jenis);

        $kriterias = Kriteria::where('kategori', $jenis)->get();
        $subkriterias = SubKriteria::where('kategori', $jenis)->get();

        $penilaian = Penilaian::with('subKriteria')
            ->where('alternatif_id', $alternatif_id)
            ->get();

        $penilaianArray = [];
        foreach ($penilaian as $p) {
            $penilaianArray[$p->kriteria_id] = $p;
        }

        return view('admin.penilaian.edit', compact(
            'pageTitle',
            'alternatif',
            'kriterias',
            'subkriterias',
            'penilaianArray'
        ))->with('penilaians', $penilaianArray);
    }

    /* =======================
     *  UPDATE PENILAIAN
     * ======================= */
    public function update(Request $request, $alternatif_id)
    {
        $alternatif = Alternatif::findOrFail($alternatif_id);

        // ✅ Kunci: tidak boleh update kalau belum lulus administrasi
        if ($alternatif->status_administrasi !== 'lulus') {
            return redirect()->back()->with('error', 'Peserta belum lulus administrasi.');
        }

        $jenis = $alternatif->jenis_pendaftaran;

        foreach ($request->nilai as $kriteria_id => $sub_id) {
            $sub = SubKriteria::find($sub_id);

            Penilaian::updateOrCreate(
                [
                    'alternatif_id' => $alternatif_id,
                    'kriteria_id'   => $kriteria_id,
                ],
                [
                    'sub_kriteria_id' => $sub_id,
                    'nilai'           => $sub ? $sub->nilai : 0,
                ]
            );
        }

        return redirect()->route(
            $jenis === 'dhuafa'
                ? 'admin.penilaian.dhuafa'
                : 'admin.penilaian.kader'
        )->with('success', 'Penilaian berhasil diperbarui.');
    }
}
