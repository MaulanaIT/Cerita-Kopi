<?php

namespace App\Http\Controllers\Laporan;

use App\Http\Controllers\Controller;
use App\Models\Transaksi\PenjualanPembayaranModel;
use App\Models\Transaksi\PenjualanProdukModel;
use App\Models\TypePembayaranModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenjualanController extends Controller
{
    function index() {
        $page = "Laporan Penjualan";
        $title = "Cerita Kopi - Laporan Penjualan";

        $curDate = Carbon::today()->toDateString();

        $data_type_pembayaran = TypePembayaranModel::orderBy('nama')->get();

        return view('laporan.penjualan', compact('curDate', 'data_type_pembayaran', 'page', 'title'));
    }

    function show(Request $request) {
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');

        if ($start_date && $end_date) {
            $data_penjualan_produk = PenjualanProdukModel::select('nama_produk', 'harga', DB::raw('SUM(jumlah) AS jumlah'), DB::raw('SUM(total_harga) AS total_harga'), 'tanggal')
                                                        ->whereBetween(DB::raw('DATE(tanggal)'), [$start_date, $end_date])
                                                        ->groupBy('nama_produk')
                                                        ->get();

            $data_penjualan_pembayaran = PenjualanPembayaranModel::select('jenis_pembayaran', DB::raw('SUM(jumlah_pembayaran) AS jumlah_pembayaran'), 'jenis_kartu', 'tanggal')
                                                                ->whereBetween(DB::raw('DATE(tanggal)'), [$start_date, $end_date])
                                                                ->groupBy('jenis_pembayaran')
                                                                ->get();
        } else {
            $data_penjualan_produk = [];
            $data_penjualan_pembayaran = [];
        }

        return response()->json(['code' => 200, 'data_penjualan_produk' => $data_penjualan_produk, 'data_penjualan_pembayaran' => $data_penjualan_pembayaran]);
    }
}
