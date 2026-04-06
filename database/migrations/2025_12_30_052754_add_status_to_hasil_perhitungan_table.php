<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('hasil_perhitungan', function (Blueprint $table) {
            $table->string('status')->default('diproses')->after('ranking');
            $table->text('catatan_admin')->nullable()->after('status');
            $table->date('tanggal_keputusan')->nullable()->after('catatan_admin');
        });
    }

    public function down(): void
    {
        Schema::table('hasil_perhitungan', function (Blueprint $table) {
            $table->dropColumn([
                'status',
                'catatan_admin',
                'tanggal_keputusan'
            ]);
        });
    }
};
