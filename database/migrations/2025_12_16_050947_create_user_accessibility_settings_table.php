<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_accessibility_settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->enum('font_size', ['small', 'medium', 'large', 'extra-large'])->default('medium');
            $table->enum('contrast_mode', ['normal', 'high', 'dark'])->default('normal');
            $table->boolean('dyslexia_font')->default(false);
            $table->boolean('screen_reader_mode')->default(false);
            $table->boolean('keyboard_navigation')->default(true);
            $table->timestamps();

            $table->unique('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_accessibility_settings');
    }
};