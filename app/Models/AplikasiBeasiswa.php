<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AplikasiBeasiswa extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama_beasiswa',
        'status',
        'tanggal_daftar',
        'tanggal_keputusan',
        'jumlah_beasiswa',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
