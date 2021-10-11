<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Master\BahanBakuModel;
use App\Models\Master\BahanBakuSatuanModel;
use Illuminate\Http\Request;

class BahanBakuController extends Controller
{
    function index() {
        $page = "Bahan Baku";
        $title = "Cerita Kopi - Bahan Baku";

        $data_bahan_baku = BahanBakuModel::select('*')->orderBy('nama')->get();
        $data_bahan_baku_satuan = BahanBakuSatuanModel::select('*')->orderBy('nama')->get();

        return view('master.bahan_baku', compact('data_bahan_baku_satuan', 'data_bahan_baku', 'page', 'title'));
    }

    function store(Request $request) {
        $insert = BahanBakuModel::create([
            'nama' => $request->input('nama-item'),
            'jumlah_per_pack' => $request->input('jumlah-per-pack'),
            'satuan_per_pack' => $request->input('satuan-per-pack'),
            'stok_minimal' => $request->input('stok-minimal')
        ]);

        return redirect('/master/bahan-baku');
    }

    function storeAjax(Request $request) {
        BahanBakuModel::create([
            'nama' => $request->input('nama-item'),
            'jumlah_per_pack' => $request->input('jumlah-per-pack'),
            'satuan_per_pack' => $request->input('satuan-per-pack'),
            'stok_minimal' => $request->input('stok-minimal')
        ]);

        return response()->json(['success' => 'Insert Successfull']);
    }
}
