<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubKriteria extends Model
{
    use HasFactory;

    protected $table = 'sub_kriteria';

    protected $fillable = [
        'kriteria_id',
        'kategori',
        'nama_subkriteria',
        'nilai',
    ];

    /* =======================
     *  RELATIONSHIP
     * ======================= */

    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class, 'kriteria_id');
    }

    public function penilaian()
    {
        return $this->hasMany(Penilaian::class, 'sub_kriteria_id');
    }

    /* =======================
     *  QUERY SCOPE
     * ======================= */

    public function scopeDhuafa($query)
    {
        return $query->where('kategori', 'dhuafa');
    }

    public function scopeKader($query)
    {
        return $query->where('kategori', 'kader');
    }

    /* =======================
     *  ACCESSOR (DISPLAY)
     * ======================= */

    public function getKategoriLabelAttribute()
    {
        return $this->kategori === 'dhuafa'
            ? 'Dhuafa'
            : 'Kader Muhammadiyah';
    }

    public function getKategoriBadgeAttribute()
    {
        return $this->kategori === 'dhuafa'
            ? '<span class="badge bg-success">Dhuafa</span>'
            : '<span class="badge bg-primary">Kader</span>';
    }

    public function getNamaLengkapAttribute()
    {
        return optional($this->kriteria)->nama_kriteria
            . ' - '
            . $this->nama_subkriteria;
    }
}
