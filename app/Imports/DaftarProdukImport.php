<?php

namespace App\Imports;

use App\Models\Master\ProdukModel;
use App\Models\Transaksi\PenjualanDumModel;
use App\Models\Transaksi\PenjualanProdukDumModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
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
            'kode_produk' => ProdukModel::where('nama', $row[0])->first()->kode,
            'nama_produk' => $row[0],
            'hpp' => ProdukModel::where('nama', $row[0])->first()->hpp,
            'harga' => $row[2],
            'jumlah' => $row[1],
            'total_harga' => intval($row[1]) * intval($row[2])
        ]);
    }
}
