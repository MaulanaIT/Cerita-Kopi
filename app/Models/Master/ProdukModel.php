<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdukModel extends Model
{
    use HasFactory;

    protected $table = 'produk';

    protected $fillable = [
        'kode',
        'nama',
        'hpp',
        'harga_jual'
    ];
}
