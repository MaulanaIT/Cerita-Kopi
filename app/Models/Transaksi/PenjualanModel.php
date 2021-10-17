<?php

namespace App\Models\Transaksi;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenjualanModel extends Model
{
    use HasFactory;

    protected $table = 'penjualan';

    protected $fillable = [
        'nama_produk',
        'harga',
        'jumlah',
        'total_harga',
        'jenis_pembayaran',
        'jumlah_pembayaran',
        'jenis_kartu',
        'tanggal'
    ];
}
