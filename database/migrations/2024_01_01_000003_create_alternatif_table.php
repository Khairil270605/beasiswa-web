<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('alternatif', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 100);
            $table->string('nik', 20)->nullable();
            $table->string('tempat_lahir', 50)->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->enum('jenis_kelamin', ['L', 'P'])->nullable();
            $table->text('alamat')->nullable();
            $table->string('no_telepon', 20)->nullable();
            $table->string('email', 100)->nullable();
            $table->string('nim', 50)->nullable();
            $table->string('semester', 10)->nullable();
            $table->string('fakultas', 100)->nullable();
            $table->string('jurusan', 100)->nullable();
            $table->decimal('ipk', 3, 2)->nullable();
            $table->year('tahun_masuk')->nullable();
            $table->text('prestasi')->nullable();
            $table->string('jenis_organisasi', 100)->nullable();
            $table->string('nama_organisasi', 100)->nullable();
            $table->string('jabatan', 100)->nullable();
            $table->year('tahun_bergabung')->nullable();
            $table->text('riwayat_aktivitas')->nullable();
            $table->text('kontribusi')->nullable();
            $table->text('rencana_masa_depan')->nullable();
            $table->string('nama_ayah', 100)->nullable();
            $table->string('pekerjaan_ayah', 100)->nullable();
            $table->string('nama_ibu', 100)->nullable();
            $table->string('pekerjaan_ibu', 100)->nullable();
            $table->integer('penghasilan_ayah')->nullable();
            $table->integer('penghasilan_ibu')->nullable();
            $table->integer('jumlah_tanggungan')->nullable();
            $table->string('status_rumah', 50)->nullable();
            $table->text('kondisi_ekonomi')->nullable();
            $table->string('ktp', 255)->nullable();
            $table->string('kk', 255)->nullable();
            $table->string('transkrip', 255)->nullable();
            $table->string('surat_penghasilan', 255)->nullable();
            $table->string('surat_tidak_mampu', 255)->nullable();
            $table->string('surat_aktif_organisasi', 255)->nullable();
            $table->string('sertifikat_prestasi', 255)->nullable();

            // Penanda jenis pendaftaran
            $table->enum('jenis_pendaftaran', ['kader', 'dhuafa'])->default('dhuafa');

            // Tambahan untuk riwayat beasiswa
            $table->enum('status', ['pending','review','approved','rejected'])->default('pending');
            $table->date('tanggal_keputusan')->nullable();
            $table->integer('jumlah_beasiswa')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('alternatif');
    }
};
