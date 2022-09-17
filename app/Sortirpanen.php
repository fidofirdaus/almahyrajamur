<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sortirpanen extends Model
{
    protected $fillable = ['tanggal', 'id_petani', 'berat', 'total_harga', 'status'];

    public function petani()
    {
        return $this->belongsTo(User::class, 'id_petani', 'id');
    }
}
