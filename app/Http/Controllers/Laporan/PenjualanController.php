<?php

namespace App\Http\Controllers\Laporan;

use App\Http\Controllers\Controller;
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

        $curDate = Carbon::now();

        $data_type_pembayaran = TypePembayaranModel::orderBy('nama')->get();

        return view('laporan.penjualan', compact('curDate', 'data_type_pembayaran', 'page', 'title'));
    }

    function show(Request $request) {
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');

        if ($start_date && $end_date) {
            $data_penjualan_produk = PenjualanProdukModel::select(DB::raw('nama_produk, harga, SUM(jumlah) AS jumlah, SUM(total_harga) AS total_harga, tanggal'))
                                                        ->groupBy('nama_produk')
                                                        ->whereBetween('tanggal', [$start_date, $end_date])
                                                        ->get();
        } else {
            $data_penjualan_produk = [];
        }

        return response()->json(['code' => 200, 'data_penjualan_produk' => $data_penjualan_produk]);
    }
}
