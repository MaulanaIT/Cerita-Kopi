<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Master\BahanBakuModel;
use Illuminate\Http\Request;

class BahanBakuController extends Controller
{
    function index() {
        $page = "Bahan Baku";
        $title = "Cerita Kopi - Bahan Baku";

        return view('master.bahan_baku', compact('page', 'title'));
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
}
