<?php

// app/Models/User.php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'role',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Relasi ke UserAccessibilitySetting
     */
    public function accessibilitySetting()
    {
        return $this->hasOne(UserAccessibilitySetting::class);
    }

    /**
     * Check apakah user adalah admin
     */
    public function isAdmin()
    {
        return $this->role === 'admin';
    }
    public function nilaiWawancara()
    {
        return $this->hasMany(\App\Models\NilaiWawancara::class, 'pewawancara_id');
    }

}