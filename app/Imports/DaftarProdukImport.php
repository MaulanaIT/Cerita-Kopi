<?php

namespace App\Imports;

use App\Models\Transaksi\PenjualanDumModel;
use App\Models\Transaksi\PenjualanProdukDumModel;
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
        return PenjualanProdukDumModel::create([
            'nama_produk' => $row[0],
            'harga' => $row[2],
            'jumlah' => $row[1],
            'total_harga' => intval($row[1]) * intval($row[2])
        ]);
    }
}
