<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Master\BahanBakuModel;
use App\Models\Master\BahanBakuSatuanModel;
use Illuminate\Http\Request;

class PersediaanBahanBakuController extends Controller
{
    function index() {
        $page = "Persediaan Bahan Baku";
        $title = "Cerita Kopi - Persediaan Bahan Baku";

        $data_bahan_baku = BahanBakuModel::select('*')->orderBy('nama')->get();
        $data_bahan_baku_satuan = BahanBakuSatuanModel::orderBy('nama')->get();

        //Notification
        $expired = expiredBahanBaku();

        return view('master.persediaan_bahan_baku', compact('data_bahan_baku', 'data_bahan_baku_satuan', 'expired', 'page', 'title'));
    }

    function update(Request $request) {
        BahanBakuModel::where('kode', $request->input('kode'))->update([
            'harga' => $request->input('harga'),
            'jumlah_per_pack' => $request->input('jumlah_per_pack'),
            'satuan_per_pack' => $request->input('satuan_per_pack'),
            'stok_minimal' => $request->input('stok_minimal'),
            'stok' => $request->input('stok'),
            'tanggal_expired' => $request->input('tanggal_expired')
        ]);

        return response()->json(['code' => 200]);
    }

    function delete($kode) {
        BahanBakuModel::where('kode', $kode)->delete();

        return response()->json(['code' => 200]);
    }
}
