<?php

namespace App\Http\Controllers\Laporan;

use App\Http\Controllers\Controller;
use App\Models\Transaksi\PenjualanProdukModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProdukController extends Controller
{
    function index() {
        $page = "Laporan Produk";
        $title = "Cerita Kopi - Laporan Produk";

        $curDate = Carbon::today()->toDateString();

        return view('laporan.produk', compact('curDate', 'page', 'title'));
    }

    function show(Request $request) {
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');

        if ($start_date && $end_date) {
            $data_penjualan_produk = PenjualanProdukModel::select('nama_produk', 'hpp', 'harga', DB::raw('SUM(jumlah) AS jumlah'), DB::raw('SUM(total_harga) AS total_harga'), 'tanggal')
                                                        ->where(DB::raw('DATE(tanggal)'), '>=', $start_date)
                                                        ->where(DB::raw('DATE(tanggal)'), '<=', $end_date)
                                                        ->groupBy('nama_produk')
                                                        ->groupBy('hpp')
                                                        ->groupBy('harga')
                                                        ->get();
        } else {
            $data_penjualan_produk = [];
        }

        return response()->json(['code' => 200, 'data_penjualan_produk' => $data_penjualan_produk]);
    }
}
