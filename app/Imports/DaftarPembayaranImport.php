<?php

namespace App\Imports;

use App\Models\Transaksi\PenjualanDumModel;
use Maatwebsite\Excel\Concerns\ToModel;

class DaftarPembayaranImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */

    protected $index = 0;

    public function model(array $row)
    {
        PenjualanDumModel::where('id', ++$this->index)->update([
            'jenis_pembayaran' => $row[1],
            'jumlah_pembayaran' => $row[2],
            'jenis_kartu' => $row[3],
            'tanggal' => explode('T', $row[0])[0]
        ]);
    }
}
