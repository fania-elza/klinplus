<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Layanan extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_pricelist',
        'nama_layanan',
        'durasi',
        'harga',
        'deskripsi'
    ];

    protected $casts = [
        'harga' => 'integer'
    ];
}


