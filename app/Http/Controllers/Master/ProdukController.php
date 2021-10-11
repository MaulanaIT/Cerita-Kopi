<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Master\ProdukModel;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    function index() {
        $page = "Produk";
        $title = "Cerita Kopi - Master";

        $data_produk = ProdukModel::all();

        return view ('master.produk', compact('data_produk', 'page', 'title'));
    }

    function store(Request $request) {
        $insert = ProdukModel::create([
            'nama' => $request->input('nama-item'),
            'harga_beli' => $request->input('harga-beli'),
            'jumlah_per_pack' => $request->input('jumlah-per-pack'),
            'satuan_per_pack' => $request->input('satuan-per-pack'),
            'jumlah_dipakai_per_produk' => $request->input('jumlah-dipakai-per-produk'),
            'satuan_per_produk' => $request->input('satuan-per-produk'),
            'harga_per_item' => $request->input('harga-per-item')
        ]);

        return redirect('/master/produk');
    }
}
