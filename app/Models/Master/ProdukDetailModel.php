<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdukDetailModel extends Model
{
    use HasFactory;

    protected $table = 'produk_detail';

    protected $fillable = [
        'kode',
        'nama_item',
        'jumlah_dipakai',
        'satuan_dipakai',
        'harga_per_item'
    ];
}
