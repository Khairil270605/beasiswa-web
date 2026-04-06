<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penilaian extends Model
{
    use HasFactory;

    protected $table = 'penilaian';
    
    protected $fillable = [
        'alternatif_id', 
        'kriteria_id', 
        'sub_kriteria_id', 
        'nilai'
    ];

    /* =======================
     *  RELASI
     * ======================= */

    public function subKriteria()
    {
        return $this->belongsTo(SubKriteria::class, 'sub_kriteria_id');
    }

    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class, 'kriteria_id');
    }

    public function alternatif()
    {
        return $this->belongsTo(Alternatif::class, 'alternatif_id');
    }

    /* =======================
     *  SCOPE FILTER
     * ======================= */

    /**
     * Scope untuk filter penilaian kategori Dhuafa
     */
    public function scopeDhuafa($query)
    {
        return $query->whereHas('alternatif', function($q) {
            $q->where('kategori', 'dhuafa');
        });
    }

    /**
     * Scope untuk filter penilaian kategori Kader
     */
    public function scopeKader($query)
    {
        return $query->whereHas('alternatif', function($q) {
            $q->where('kategori', 'kader');
        });
    }

    /* =======================
     *  ACCESSOR
     * ======================= */

    /**
     * Accessor untuk mendapatkan kategori dari alternatif
     */
    public function getKategoriAttribute()
    {
        return $this->alternatif ? $this->alternatif->kategori : null;
    }

    /**
     * Accessor untuk label kategori
     */
    public function getKategoriLabelAttribute()
    {
        return $this->kategori === 'dhuafa' ? 'Dhuafa' : 'Kader Muhammadiyah';
    }

    /**
     * Accessor untuk nama alternatif
     */
    public function getNamaAlternatifAttribute()
    {
        return $this->alternatif ? $this->alternatif->nama : '-';
    }

    /**
     * Accessor untuk nama kriteria
     */
    public function getNamaKriteriaAttribute()
    {
        return $this->kriteria ? $this->kriteria->nama_kriteria : '-';
    }

    /**
     * Accessor untuk nama sub kriteria
     */
    public function getNamaSubKriteriaAttribute()
    {
        return $this->subKriteria ? $this->subKriteria->nama_subkriteria : '-';
    }
}