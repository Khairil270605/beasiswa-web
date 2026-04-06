<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('alternatif', function (Blueprint $table) {

            // =====================
            // DATA AKADEMIK
            // =====================
            $table->string('asal_kampus', 150)->nullable()->after('nim');

            // =====================
            // FILE UMUM (KADER & DHUAFA)
            // =====================
            $table->string('surat_tidak_menerima_beasiswa')->nullable()->after('surat_tidak_mampu');

            // Foto kondisi rumah
            $table->string('foto_rumah_depan')->nullable();
            $table->string('foto_rumah_samping')->nullable();
            $table->string('foto_ruang_tamu')->nullable();
            $table->string('foto_kamar_mandi')->nullable();
            $table->string('foto_dapur')->nullable();

            // Dokumen pendukung
            $table->string('slip_gaji_ortu')->nullable();
            $table->string('cv')->nullable();
            $table->string('pas_foto')->nullable();
            $table->string('motivation_letter')->nullable();
            $table->string('ktm')->nullable();
            $table->string('twibbon')->nullable();
            $table->string('surat_kesanggupan_relawan')->nullable();

            // =====================
            // KHUSUS KADER
            // =====================
            $table->string('surat_rekomendasi')->nullable();
            $table->string('ktam')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('alternatif', function (Blueprint $table) {
            $table->dropColumn([
                // Akademik
                'asal_kampus',

                // File umum
                'surat_tidak_menerima_beasiswa',

                'foto_rumah_depan',
                'foto_rumah_samping',
                'foto_ruang_tamu',
                'foto_kamar_mandi',
                'foto_dapur',

                'slip_gaji_ortu',
                'cv',
                'pas_foto',
                'motivation_letter',
                'ktm',
                'twibbon',
                'surat_kesanggupan_relawan',

                // Khusus kader
                'surat_rekomendasi',
                'ktam',
            ]);
        });
    }
};
