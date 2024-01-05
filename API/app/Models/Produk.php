<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = 'produks';
    protected $fillable = [
        'kategori_id',
        'kode',
        'nama',
        'deskripsi',
        'qty',
        'satuan',
        'harga',
        'status',
    ];
}
