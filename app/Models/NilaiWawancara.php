<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiWawancara extends Model
{
    use HasFactory;

    protected $table = 'nilai_wawancara';

    protected $fillable = [
        'alternatif_id',
        'komponen',
        'nilai',
        'pewawancara_id',
        'catatan',
        'status',
    ];

    /* ==========================
     * RELATIONS
     * ========================== */

    // Peserta / pendaftar
    public function alternatif()
    {
        return $this->belongsTo(Alternatif::class);
    }

    // Pewawancara (user)
    public function pewawancara()
    {
        return $this->belongsTo(User::class, 'pewawancara_id');
    }
}
