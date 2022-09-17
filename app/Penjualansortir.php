<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Penjualansortir extends Model
{
    protected $fillable = ['tanggal', 'id_pembeli', 'id_panen', 'berat_awal', 'berat_terjual', 'total_harga', 'status'];

    public function pembeli()
    {
        return $this->belongsTo(User::class, 'id_pembeli', 'id');
    }
    
    public function panen()
    {
        return $this->belongsTo(Sortirpanen::class, 'id_panen', 'id');
    }
}
