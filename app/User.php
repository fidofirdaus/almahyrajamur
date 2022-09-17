<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'password', 'role', 'lokasi', 'no_hp', 'jml_log', 'harga_log'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function panens()
    {
        return $this->hasMany(Panen::class, 'id_petani');
    }
    
    public function penjualans()
    {
        return $this->hasMany(Penjualan::class, 'id_pembeli');
    }
    
    public function sortirs()
    {
        return $this->hasMany(Sortirpanen::class, 'id_petani');
    }
}
