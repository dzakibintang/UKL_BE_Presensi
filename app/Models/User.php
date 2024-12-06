<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    // Daftar atribut yang dapat diisi
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    // Hidden attributes
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Mendapatkan identifier untuk JWT
     */
    public function getJWTIdentifier()
    {
        return $this->getKey(); // Biasanya primary key (id)
    }

    /**
     * Mendapatkan custom claims untuk JWT
     */
    public function getJWTCustomClaims()
    {
        return []; // Anda dapat menambahkan data tambahan di sini
    }
}
