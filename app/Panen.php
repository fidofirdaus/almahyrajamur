<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Panen extends Model
{
    protected $fillable = ['tanggal', 'id_petani', 'berat', 'hasil_penjualan', 'status'];

    public function petani()
    {
        return $this->belongsTo(User::class, 'id_petani');
    }
}
