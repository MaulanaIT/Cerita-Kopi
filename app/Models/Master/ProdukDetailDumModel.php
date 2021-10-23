<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdukDetailDumModel extends Model
{
    use HasFactory;

    protected $table = 'produk_detail_dum';

    protected $fillable = [
        'kode',
        'nama',
        'kode_item',
        'nama_item',
        'jumlah_dipakai',
        'satuan_dipakai',
        'harga_per_item'
    ];
}
