<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Master\BahanBakuModel;
use App\Models\Master\BahanBakuSatuanModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BahanBakuController extends Controller
{
    function index() {
        $page = "Bahan Baku";
        $title = "Cerita Kopi - Bahan Baku";

        $data_bahan_baku = BahanBakuModel::select('*')->orderBy('nama')->get();
        $data_bahan_baku_satuan = BahanBakuSatuanModel::select('*')->orderBy('nama')->get();

        //Notification
        $expired = expiredBahanBaku();

        return view('master.bahan_baku', compact('data_bahan_baku_satuan', 'data_bahan_baku', 'expired', 'page', 'title'));
    }

    function store(Request $request) {
        $kode_item = $request->input('kode');

        $data_bahan_baku = BahanBakuModel::where('kode', $kode_item)->get();

        if (count($data_bahan_baku) == 0) {
            BahanBakuModel::create([
                'kode' => $kode_item,
                'nama' => $request->input('nama'),
                'jumlah_per_pack' => $request->input('jumlah_per_pack'),
                'satuan_per_pack' => $request->input('satuan_per_pack'),
                'stok_minimal' => $request->input('stok_minimal'),
                'stok' => 0,
                'tanggal_expired' => Carbon::now()
            ]);

            $code = 200;
            $status = 'Data Berhasil Ditambahkan';
        } else {
            $code = 406;
            $status = 'Kode Item Sudah Digunakan';
        }

        return response()->json(['code' => $code, 'status' => $status]);
    }

    function selectItem($nama) {
        $data = BahanBakuModel::select('*')->where('nama', $nama)->get();

        return $data;
    }
}
