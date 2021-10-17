<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Master\BahanBakuModel;
use Illuminate\Http\Request;

class PersediaanBahanBakuController extends Controller
{
    function index() {
        $page = "Persediaan Bahan Baku";
        $title = "Cerita Kopi - Persediaan Bahan Baku";

        $data_bahan_baku = BahanBakuModel::select('*')->orderBy('nama')->get();

        return view('master.persediaan_bahan_baku', compact('data_bahan_baku', 'page', 'title'));
    }

    function update(Request $request) {
        BahanBakuModel::where('kode', $request->input('kode'))->update([
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
