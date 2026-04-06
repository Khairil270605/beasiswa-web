<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('penilaian', function (Blueprint $table) {
            $table->id();
            $table->foreignId('alternatif_id')->constrained('alternatif')->onDelete('cascade');
            $table->foreignId('kriteria_id')->constrained('kriteria')->onDelete('cascade');
            $table->foreignId('sub_kriteria_id')->constrained('sub_kriteria')->onDelete('cascade');
            $table->decimal('nilai', 5, 2);
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('penilaian');
    }
};

