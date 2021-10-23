<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Master\BahanBakuModel;
use App\Models\Master\BahanBakuSatuanModel;
use App\Models\Master\HPPProdukModel;
use App\Models\Master\ProdukDetailDumModel;
use App\Models\Master\ProdukDetailModel;
use App\Models\Master\ProdukModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HPPProdukController extends Controller
{
    function index() {
        $page = "HPP Produk";
        $title = "Cerita Kopi - HPP Produk";

        $data_bahan_baku = BahanBakuModel::select('*')->orderBy('nama')->get();
        $data_bahan_baku_satuan = BahanBakuSatuanModel::select('*')->orderBy('nama')->get();

        ProdukDetailModel::select('*')->whereNotIn('kode', ProdukModel::select(DB::raw('DISTINCT kode'))->get())->delete();

        ProdukDetailDumModel::truncate();

        return view ('master.hpp_produk', compact('data_bahan_baku', 'data_bahan_baku_satuan', 'page', 'title'));
    }

    function show($kode) {
        $data_produk_detail = ProdukDetailDumModel::select('*')->where('kode', $kode)->orderBy('created_at')->get();

        return response()->json(['code' => 200, 'data_produk_detail' => $data_produk_detail]);
    }

    function save(Request $request) {
        $data_produk_detail_dum = ProdukDetailDumModel::all();

        foreach ($data_produk_detail_dum as $data) {
            ProdukDetailModel::create([
                'kode' => $data->kode,
                'nama' => $data->nama,
                'kode_item' => $data->kode_item,
                'nama_item' => $data->nama_item, 
                'jumlah_dipakai' => $data->jumlah_dipakai,
                'satuan_dipakai' => $data->satuan_dipakai,
                'harga_per_item' => $data->harga_per_item
            ]);
        }

        ProdukModel::create([
            'kode' => $request->input('kode'),
            'nama' => $request->input('nama'), 
            'hpp' => $request->input('hpp'),
            'harga_jual' => $request->input('harga_jual')
        ]);

        return response()->json(['code' => 200]);
    }

    function store(Request $request) {
        $insert = ProdukDetailDumModel::create([
            'kode' => $request->input('kode'),
            'nama' => $request->input('nama'),
            'kode_item' => $request->input('kode_item'),
            'nama_item' => $request->input('nama_item'), 
            'jumlah_dipakai' => $request->input('jumlah_dipakai'),
            'satuan_dipakai' => $request->input('satuan_dipakai'),
            'harga_per_item' => $request->input('harga_per_item')
        ]);

        return response()->json(['code' => 200]);
    }

    function delete(Request $request) {
        ProdukDetailDumModel::where('nama_item', $request->input('nama_item'))->delete();

        return response()->json(['code' => 200]);
    }
}
