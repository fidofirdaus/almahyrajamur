<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    protected $fillable = ['tanggal', 'id_pembeli', 'berat', 'total_harga', 'status'];

    public function pembeli()
    {
        return $this->belongsTo('User', 'id_pembeli', 'id');
    }
}
