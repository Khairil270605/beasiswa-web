<?php

namespace App\Services;

use App\Models\Alternatif;
use App\Models\Kriteria;
use App\Models\HasilPerhitungan;

class SAWCalculationService
{
    /**
     * Hitung SAW berdasarkan kategori (dhuafa / kader)
     */
    public function calculateByKategori(string $kategori, $periodeId = null): array
    {
        // Ambil alternatif sesuai kategori
        $alternatifs = Alternatif::with('penilaian')
            ->where('jenis_pendaftaran', $kategori)
            ->where('status_administrasi', 'lulus')
            ->where('status_data', 'aktif')
            ->when($periodeId, function ($query) use ($periodeId) {
                $query->where('periode_id', $periodeId);
            })
            ->get();

        // Ambil kriteria sesuai kategori
        $kriterias = Kriteria::where('kategori', $kategori)->get();

        if ($alternatifs->isEmpty() || $kriterias->isEmpty()) {
            return [];
        }

        /* ==========================
         * STEP 1: MATRIX KEPUTUSAN
         * ========================== */
        $matrix = [];

        foreach ($alternatifs as $alt) {
            foreach ($kriterias as $k) {

                $nilai = $alt->penilaian
                    ->where('kriteria_id', $k->id)
                    ->first();

                $matrix[$alt->id][$k->id] = $nilai?->nilai ?? 0;
            }
        }

        /* ==========================
         * STEP 2: NORMALISASI
         * ========================== */
        $normalisasi = [];

        foreach ($kriterias as $k) {

            // Ambil semua nilai per kriteria
            $values = array_column($matrix, $k->id);

            // Ambil nilai valid (>0)
            $validValues = array_filter($values, fn ($v) => $v > 0);

            $max = !empty($validValues) ? max($validValues) : 1;
            $min = !empty($validValues) ? min($validValues) : 1;

            foreach ($matrix as $altId => $row) {

                $nilai = $row[$k->id];

                if ($k->jenis === 'benefit') {

                    $normalisasi[$altId][$k->id] = $nilai > 0
                        ? $nilai / $max
                        : 0;

                } else { // cost

                    $normalisasi[$altId][$k->id] = $nilai > 0
                        ? $min / $nilai
                        : 0;
                }
            }
        }

        /* ==========================
         * STEP 3: NILAI AKHIR
         * ========================== */
        $hasil = [];

        foreach ($alternatifs as $alt) {

            $total = 0;

            foreach ($kriterias as $k) {

                $total += $normalisasi[$alt->id][$k->id] * $k->bobot;
            }

            $hasil[] = [
                'alternatif_id' => $alt->id,
                'alternatif'    => $alt,
                'nilai_akhir'   => $total,
            ];
        }

        /* ==========================
         * STEP 4: RANKING
         * ========================== */
        usort($hasil, fn ($a, $b) => $b['nilai_akhir'] <=> $a['nilai_akhir']);

        foreach ($hasil as $i => &$row) {
            $row['ranking'] = $i + 1;
        }

        /* ==========================
         * STEP 5: SIMPAN HASIL
         * ========================== */
        $this->saveResults($hasil, $kategori, $periodeId);

        return $hasil;
    }

    /**
     * Simpan hasil perhitungan ke database
     */
    private function saveResults(array $hasil, string $kategori, $periodeId = null): void
    {
        // Hapus hasil lama sesuai kategori + periode
        HasilPerhitungan::whereHas('alternatif', function ($q) use ($kategori, $periodeId) {

            $q->where('jenis_pendaftaran', $kategori)
                ->where('status_administrasi', 'lulus')
                ->where('status_data', 'aktif');

            if ($periodeId) {
                $q->where('periode_id', $periodeId);
            }

        })->delete();

        foreach ($hasil as $row) {

            HasilPerhitungan::create([
                'alternatif_id' => $row['alternatif_id'],
                'nilai_akhir'   => $row['nilai_akhir'],
                'ranking'       => $row['ranking'],
            ]);
        }
    }
}