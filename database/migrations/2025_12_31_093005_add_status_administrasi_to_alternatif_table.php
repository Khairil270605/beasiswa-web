<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('alternatif', function (Blueprint $table) {
            $table->enum('status_administrasi', [
                'pending',
                'lulus',
                'tidak_lulus'
            ])->default('pending')->after('jenis_pendaftaran');

            $table->text('catatan_administrasi')
                  ->nullable()
                  ->after('status_administrasi');
        });
    }

    public function down(): void
    {
        Schema::table('alternatif', function (Blueprint $table) {
            $table->dropColumn([
                'status_administrasi',
                'catatan_administrasi'
            ]);
        });
    }
};
