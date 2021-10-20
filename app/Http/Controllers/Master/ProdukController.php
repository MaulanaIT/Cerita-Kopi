<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Master\ProdukModel;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    function index() {
        $page = "Produk";
        $title = "Cerita Kopi - Produk";

        $data_produk = ProdukModel::select('*')->orderBy('nama')->get();

        return view ('master.produk', compact('data_produk', 'page', 'title'));
    }

    function update(Request $request) {
        ProdukModel::where('kode', $request->input('kode'))->update([
            'nama' => $request->input('nama'),
            'hpp' => $request->input('hpp'),
            'harga_jual' => $request->input('harga_jual')
        ]);

        return response()->json(['code' => 200]);
    }

    function delete($kode) {
        ProdukModel::where('kode', $kode)->delete();

        return response()->json(['code' => 200]);
    }
}
