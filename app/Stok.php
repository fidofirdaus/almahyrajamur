<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stok extends Model
{
    protected $fillable = ['tanggal', 'stok_awal', 'stok_sisa'];
}
