<?php

namespace App\Models\Transaksi;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenjualanProdukModel extends Model
{
    use HasFactory;

    protected $table = 'penjualan_produk';

    protected $fillable = [
        'nama_produk',
        'hpp',
        'harga',
        'jumlah',
        'total_harga',
        'tanggal'
    ];
}
