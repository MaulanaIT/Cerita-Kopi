<?php

namespace App\Imports;

use App\Models\Transaksi\PenjualanDumModel;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;

class DaftarProdukImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $data_penjualan = PenjualanDumModel::all();

        return new PenjualanDumModel([
            'id' => count($data_penjualan) + 1,
            'nama_produk' => $row[0],
            'harga' => $row[2],
            'jumlah' => $row[1],
            'total_harga' => intval($row[1]) * intval($row[2]),
            'jenis_pembayaran' => '',
            'jumlah_pembayaran' => 0,
            'jenis_kartu' => '',
            'tanggal' => Carbon::now()
        ]);
    }
}
