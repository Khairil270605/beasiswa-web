<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('nilai_wawancara', function (Blueprint $table) {
            $table->id();

            // peserta (pendaftar beasiswa)
            $table->foreignId('alternatif_id')
                ->constrained('alternatif')
                ->cascadeOnDelete();

            /**
             * Komponen wawancara (dinamis).
             * Kita simpan sebagai string dulu agar fleksibel,
             * karena kader & dhuafa komponen berbeda dan kamu belum tentu mau
             * bikin tabel kriteria_wawancara sekarang.
             *
             * Contoh isi:
             * - "Tajwid"
             * - "Makhraj"
             * - "Wawasan AIK"
             * - "Kesiapan Akademik"
             * - "Life plan"
             * - "Komitmen relawan Lazismu"
             */
            $table->string('komponen', 150);

            // nilai mentah wawancara (1-5)
            $table->unsignedTinyInteger('nilai');

            // pewawancara yang menilai
            $table->foreignId('pewawancara_id')
                ->constrained('users')
                ->cascadeOnDelete();

            // catatan pewawancara (opsional)
            $table->text('catatan')->nullable();

            // status nilai (draft = belum disahkan admin, final = sudah disahkan)
            $table->enum('status', ['draft', 'final'])->default('draft');

            $table->timestamps();

            // biar 1 peserta tidak dobel untuk komponen yang sama
            $table->unique(['alternatif_id', 'komponen']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('nilai_wawancara');
    }
};
