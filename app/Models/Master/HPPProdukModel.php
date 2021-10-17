<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HPPProdukModel extends Model
{
    use HasFactory;

    protected $table = 'produk_hpp';

    protected $fillable = [
        'nama',
        'harga_beli',
        'jumlah_per_pack',
        'satuan_per_pack',
        'jumlah_dipakai_per_produk',
        'satuan_per_produk',
        'harga_per_item'
    ];
}
