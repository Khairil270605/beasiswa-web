<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('alternatif', function (Blueprint $table) {
            $table->enum('status_beasiswa', ['menunggu','diterima','tidak_diterima'])
                ->default('menunggu')
                ->after('catatan_administrasi');

            $table->text('catatan_beasiswa')
                ->nullable()
                ->after('status_beasiswa');

            $table->date('tanggal_keputusan_beasiswa')
                ->nullable()
                ->after('catatan_beasiswa');
        });
    }

    public function down(): void
    {
        Schema::table('alternatif', function (Blueprint $table) {
            $table->dropColumn([
                'status_beasiswa',
                'catatan_beasiswa',
                'tanggal_keputusan_beasiswa',
            ]);
        });
    }
};
