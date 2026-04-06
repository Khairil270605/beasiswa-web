<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('hasil_perhitungan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('alternatif_id')->constrained('alternatif')->onDelete('cascade');
            $table->decimal('nilai_akhir', 8, 4);
            $table->integer('ranking');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('hasil_perhitungan');
    }
};

