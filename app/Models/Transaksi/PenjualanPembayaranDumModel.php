<?php

namespace App\Models\Transaksi;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenjualanPembayaranDumModel extends Model
{
    use HasFactory;

    protected $table = 'penjualan_pembayaran_dum';

    protected $fillable = [
        'jenis_pembayaran',
        'jumlah_pembayaran',
        'jenis_kartu',
        'tanggal'
    ];
}
