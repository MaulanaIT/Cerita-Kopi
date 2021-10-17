<?php

namespace App\Imports;

use App\Models\Transaksi\PenjualanPembayaranDumModel;
use Maatwebsite\Excel\Concerns\ToModel;

class DaftarPembayaranImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */

    public function model(array $row)
    {
        if (isset($row[3])) {
            PenjualanPembayaranDumModel::create([
                'jenis_pembayaran' => $row[1],
                'jumlah_pembayaran' => $row[2],
                'jenis_kartu' => $row[3],
                'tanggal' => explode('T', $row[0])[0]
            ]);
        } else {
            PenjualanPembayaranDumModel::create([
                'jenis_pembayaran' => $row[1],
                'jumlah_pembayaran' => $row[2],
                'tanggal' => explode('T', $row[0])[0]
            ]);
        }
    }
}
