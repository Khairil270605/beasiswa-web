<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('banners', function (Blueprint $table) {
            $table->id();

            $table->string('title')->nullable(); // Judul banner
            $table->string('image');             // Nama file gambar
            $table->string('link')->nullable();  // Link tujuan (opsional)

            $table->boolean('is_active')->default(true); // Aktif / Nonaktif
            $table->integer('order')->default(1);        // Urutan tampil

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('banners');
    }
};
