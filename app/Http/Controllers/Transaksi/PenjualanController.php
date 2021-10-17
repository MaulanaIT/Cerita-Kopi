<?php

namespace App\Http\Controllers\Transaksi;

use App\Http\Controllers\Controller;
use App\Imports\DaftarPembayaranImport;
use App\Imports\DaftarProdukImport;
use App\Models\Master\ProdukModel;
use App\Models\Transaksi\PenjualanPembayaranDumModel;
use App\Models\Transaksi\PenjualanPembayaranModel;
use App\Models\Transaksi\PenjualanProdukDumModel;
use App\Models\Transaksi\PenjualanProdukModel;
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

        $data_penjualan_pembayaran_detail = PenjualanPembayaranDumModel::orderBy('tanggal')->get();
        $data_penjualan_produk_detail = PenjualanProdukDumModel::orderBy('nama_produk')->get();

        return view('transaksi.penjualan', compact('curDate', 'data_penjualan_pembayaran_detail', 'data_penjualan_produk_detail', 'data_produk', 'page', 'title'));
    }

    function import(Request $request) {
        $data_penjualan_pembayaran = PenjualanPembayaranDumModel::all();
        $data_penjualan_produk = PenjualanProdukDumModel::all();

        if (count($data_penjualan_pembayaran) > 0) 
        PenjualanProdukDumModel::truncate();

        if (count($data_penjualan_produk) > 0) 
            PenjualanPembayaranDumModel::truncate();
        

        Excel::import(new DaftarProdukImport, $request->file('daftar-produk')->store('temp'));
        Excel::import(new DaftarPembayaranImport, $request->file('daftar-pembayaran')->store('temp'));

        return back();
    }

    function save() {
        $data_penjualan_pembayaran = PenjualanPembayaranDumModel::all();
        $data_penjualan_produk = PenjualanProdukDumModel::all();

        foreach ($data_penjualan_pembayaran as $data) {
            PenjualanPembayaranModel::create([
                'jenis_pembayaran' => $data->jenis_pembayaran,
                'jumlah_pembayaran' => $data->jumlah_pembayaran,
                'jenis_kartu' => $data->jenis_kartu,
                'tanggal' => $data->tanggal
            ]);
        }
        
        foreach ($data_penjualan_produk as $data) {
            PenjualanProdukModel::create([
                'nama_produk' => $data->nama_produk,
                'harga' => $data->harga,
                'jumlah' => $data->jumlah,
                'total_harga' => $data->total_harga
            ]);
        }

        PenjualanPembayaranDumModel::truncate();
        PenjualanProdukDumModel::truncate();

        return response()->json(['code' => 200]);
    }
}
