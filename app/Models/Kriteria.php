<?php

// app/Models/Kriteria.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kriteria extends Model
{
    use HasFactory;

    protected $table = 'kriteria';

    protected $fillable = [
        'kode_kriteria', 
        'nama_kriteria', 
        'kategori',  // ← TAMBAHAN BARU
        'bobot', 
        'jenis'
    ];

    /**
     * Relasi ke Sub Kriteria
     */
    public function subKriteria()
    {
        return $this->hasMany(SubKriteria::class);
    }

    /**
     * Relasi ke Penilaian
     */
    public function penilaian()
    {
        return $this->hasMany(Penilaian::class);
    }

    /**
     * Scope untuk filter kategori Dhuafa
     */
    public function scopeDhuafa($query)
    {
        return $query->where('kategori', 'dhuafa');
    }

    /**
     * Scope untuk filter kategori Kader
     */
    public function scopeKader($query)
    {
        return $query->where('kategori', 'kader');
    }

    /**
     * Accessor untuk label kategori
     */
    public function getKategoriLabelAttribute()
    {
        return $this->kategori === 'dhuafa' ? 'Dhuafa' : 'Kader Muhammadiyah';
    }

    /**
     * Accessor untuk badge kategori (untuk view)
     */
    public function getKategoriBadgeAttribute()
    {
        return $this->kategori === 'dhuafa' 
            ? '<span class="badge bg-success">Dhuafa</span>' 
            : '<span class="badge bg-primary">Kader</span>';
    }

    /**
     * Accessor untuk jenis label
     */
    public function getJenisLabelAttribute()
    {
        return $this->jenis === 'benefit' ? 'Benefit' : 'Cost';
    }

    /**
     * Accessor untuk jenis badge
     */
    public function getJenisBadgeAttribute()
    {
        return $this->jenis === 'benefit' 
            ? '<span class="badge bg-info">Benefit</span>' 
            : '<span class="badge bg-warning">Cost</span>';
    }
}