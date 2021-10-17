<?php

namespace App\Http\Controllers\Transaksi;

use App\Http\Controllers\Controller;
use App\Imports\DaftarPembayaranImport;
use App\Imports\DaftarProdukImport;
use App\Models\Master\ProdukModel;
use App\Models\Transaksi\PenjualanDumModel;
use App\Models\Transaksi\PenjualanModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class PenjualanController extends Controller
{
    function index() {
        $page = 'Penjualan';
        $title = 'Cerita Kopi - Penjualan';

        $curDate = Carbon::now();

        $data_produk = ProdukModel::select('*')->orderBy('nama')->get();

        $data_penjualan_detail = PenjualanDumModel::orderBy('nama_produk')->get();

        return view('transaksi.penjualan', compact('curDate', 'data_penjualan_detail', 'data_produk', 'page', 'title'));
    }

    function import(Request $request) {
        $data_penjualan = PenjualanDumModel::all();

        if (count($data_penjualan) > 0) 
            PenjualanDumModel::truncate();
        

        Excel::import(new DaftarProdukImport, $request->file('daftar-produk')->store('temp'));
        Excel::import(new DaftarPembayaranImport, $request->file('daftar-pembayaran')->store('temp'));

        return back();
    }

    function save() {
        $data_penjualan = PenjualanDumModel::all();

        foreach ($data_penjualan as $data) {
            PenjualanModel::create([
                'nama_produk' => $data->nama_produk,
                'harga' => $data->harga,
                'jumlah' => $data->jumlah,
                'total_harga' => $data->total_harga,
                'jenis_pembayaran' => $data->jenis_pembayaran,
                'jumlah_pembayaran' => $data->jumlah_pembayaran,
                'jenis_kartu' => $data->jenis_kartu,
                'tanggal' => $data->tanggal,
            ]);
        }

        PenjualanDumModel::truncate();

        return response()->json(['code' => 200]);
    }
}
