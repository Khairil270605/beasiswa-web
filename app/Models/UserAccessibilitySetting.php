<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAccessibilitySetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'font_size',
        'contrast_mode',
        'dyslexia_font',
        'screen_reader_mode',
        'keyboard_navigation',
    ];

    protected $casts = [
        'dyslexia_font' => 'boolean',
        'screen_reader_mode' => 'boolean',
        'keyboard_navigation' => 'boolean',
    ];

    /**
     * Relasi ke User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
} 