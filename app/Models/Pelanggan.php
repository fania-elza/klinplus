<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    //
    protected $fillable = [
        'id_pelanggan',
        'nama_pelanggan',
        'nomor_telepon',
        'email',
        'alamat',
        'kota',
        'gmaps',
        'patokan'
    ];
    
    protected $primaryKey = 'id_pelanggan';
    public $incrementing = false;
    protected $keyType = 'string';
}



