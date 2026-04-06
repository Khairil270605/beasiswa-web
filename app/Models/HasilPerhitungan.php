<?php

// app/Models/HasilPerhitungan.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HasilPerhitungan extends Model
{
    use HasFactory;

    protected $table = 'hasil_perhitungan';

    protected $fillable = [
        'alternatif_id', 'nilai_akhir', 'ranking'
    ];

    public function alternatif()
    {
        return $this->belongsTo(Alternatif::class);
    }
}
