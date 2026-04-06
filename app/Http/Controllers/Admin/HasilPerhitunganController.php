<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\SAWCalculationService;
use App\Models\Alternatif;
use App\Models\Kriteria;
use Illuminate\Http\Request;

class HasilPerhitunganController extends Controller
{
    /* ============================
     *  HASIL SAW BEASISWA DHUAFA
     * ============================ */
    public function dhuafa(SAWCalculationService $saw)
{
    $kategori = 'dhuafa';

    // TIDAK ADA parameter tambahan
    $hasil = $saw->calculateByKategori($kategori);

    $pageTitle = 'Hasil Perhitungan SAW Beasiswa Dhuafa';

    return view('admin.hasil.dhuafa', compact(
        'hasil',
        'kategori',
        'pageTitle'
    ));
}


    /* ============================
     *  HASIL SAW BEASISWA KADER
     * ============================ */
  public function kader(SAWCalculationService $saw)
{
    $kategori = 'kader';

    $hasil = $saw->calculateByKategori($kategori);

    $pageTitle = 'Hasil Perhitungan SAW Beasiswa Kader';

    return view('admin.hasil.kader', compact(
        'hasil',
        'kategori',
        'pageTitle'
    ));
}
public function updateStatusBeasiswa(Request $request, Alternatif $alternatif)
{
    $request->validate([
        'status_beasiswa' => 'required|in:menunggu,diterima,tidak_diterima',
        'catatan_beasiswa' => 'nullable|string',
    ]);

    $status = $request->status_beasiswa;

    $alternatif->status_beasiswa = $status;
    $alternatif->catatan_beasiswa = $request->catatan_beasiswa;

    // auto isi tanggal keputusan kalau diterima / tidak_diterima
    if ($status === 'menunggu') {
        $alternatif->tanggal_keputusan_beasiswa = null;
    } else {
        $alternatif->tanggal_keputusan_beasiswa = now()->toDateString();
    }

    $alternatif->save();

    return back()->with('success', 'Status beasiswa berhasil diperbarui.');
}



    /* =================================
     *  DETAIL PERHITUNGAN PER ALTERNATIF
     * ================================= */
    public function detail($id)
    {
        try {
            $alternatif = Alternatif::findOrFail($id);
            $kategori = $alternatif->jenis_pendaftaran;

            $kriteria = Kriteria::where('kategori', $kategori)->get();
            $semuaAlternatif = Alternatif::where('jenis_pendaftaran', $kategori)
    ->where('status_administrasi', 'lulus')
    ->get();


            $nilaiEkstrim = [];
            foreach ($kriteria as $k) {
                $field = $k->field;
                $values = $semuaAlternatif->pluck($field)->filter()->toArray();

                $nilaiEkstrim[$field] = [
                    'max' => !empty($values) ? max($values) : 1,
                    'min' => !empty($values) ? min($values) : 1,
                ];
            }

            $detail = [];
            $totalAkhir = 0;

            foreach ($kriteria as $k) {
                $field = $k->field;
                $nilaiAsli = $alternatif->{$field} ?? 0;

                if ($k->tipe === 'benefit') {
                    $normalisasi = $nilaiEkstrim[$field]['max'] > 0
                        ? $nilaiAsli / $nilaiEkstrim[$field]['max']
                        : 0;
                } else {
                    $normalisasi = $nilaiAsli > 0
                        ? $nilaiEkstrim[$field]['min'] / $nilaiAsli
                        : 0;
                }

                $hasilBobot = $k->bobot * $normalisasi;
                $totalAkhir += $hasilBobot;

                $detail[] = [
                    'nama_kriteria' => $k->nama_kriteria,
                    'bobot' => $k->bobot,
                    'tipe' => $k->tipe,
                    'nilai_asli' => $nilaiAsli,
                    'normalisasi' => round($normalisasi, 4),
                    'bobot_x_normalisasi' => round($hasilBobot, 4),
                ];
            }

            return response()->json([
                'success' => true,
                'data' => [
                    'alternatif' => $alternatif,
                    'kategori' => $kategori,
                    'detail' => $detail,
                    'total_nilai' => round($totalAkhir, 4),
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
