<?php

namespace App\Models\Transaksi;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenjualanPembayaranModel extends Model
{
    use HasFactory;

    protected $table = 'penjualan_pembayaran';

    protected $fillable = [
        'jenis_pembayaran',
        'jumlah_pembayaran',
        'jenis_kartu',
        'tanggal'
    ];
}
