<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;

    protected $table = 'banners';

    protected $fillable = [
        'title',
        'image',
        'link',
        'is_active',
        'order',
    ];

    /**
     * Scope: hanya banner aktif
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope: urutkan banner
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc');
    }
}
