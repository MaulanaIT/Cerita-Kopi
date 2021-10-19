<?php

namespace App\Models\Transaksi;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenjualanProdukDumModel extends Model
{
    use HasFactory;

    protected $table = 'penjualan_produk_dum';

    protected $fillable = [
        'nama_produk',
        'harga',
        'jumlah',
        'total_harga'
    ];
}
