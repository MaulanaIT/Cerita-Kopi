<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Master\BahanBakuModel;
use App\Models\Master\BahanBakuSatuanModel;
use App\Models\Master\HPPProdukModel;
use App\Models\Master\ProdukDetailModel;
use App\Models\Master\ProdukModel;
use Illuminate\Http\Request;

class HPPProdukController extends Controller
{
    function index() {
        $page = "HPP Produk";
        $title = "Cerita Kopi - HPP Produk";

        $data_bahan_baku = BahanBakuModel::select('*')->orderBy('nama')->get();
        $data_bahan_baku_satuan = BahanBakuSatuanModel::select('*')->orderBy('nama')->get();

        return view ('master.hpp_produk', compact('data_bahan_baku', 'data_bahan_baku_satuan', 'page', 'title'));
    }

    function show($kode) {
        $data_produk_detail = ProdukDetailModel::select('*')->where('kode', $kode)->orderBy('created_at')->get();

        return response()->json(['code' => 200, 'data_produk_detail' => $data_produk_detail]);
    }

    function save(Request $request) {
        $insert = ProdukModel::create([
            'kode' => $request->input('kode'),
            'nama' => $request->input('nama'), 
            'hpp' => $request->input('hpp')
        ]);

        return response()->json(['code' => 200]);
    }

    function store(Request $request) {
        $insert = ProdukDetailModel::create([
            'kode' => $request->input('kode'),
            'nama_item' => $request->input('nama_item'), 
            'jumlah_dipakai' => $request->input('jumlah_dipakai'),
            'satuan_dipakai' => $request->input('satuan_dipakai'),
            'harga_per_item' => $request->input('harga_per_item')
        ]);

        return response()->json(['code' => 200]);
    }
}
