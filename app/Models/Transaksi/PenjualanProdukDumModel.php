<?php

namespace App\Models\Transaksi;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenjualanProdukDumModel extends Model
{
    use HasFactory;

    protected $table = 'penjualan_produk_dum';

    protected $fillable = [
        'kode_produk',
        'nama_produk',
        'hpp',
        'harga',
        'jumlah',
        'total_harga',
        'tanggal'
    ];
}
