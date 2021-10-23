<?php

namespace App\Http\Controllers\Laporan;

use App\Http\Controllers\Controller;
use App\Models\Transaksi\PenjualanPembayaranModel;
use App\Models\TypePembayaranModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PembayaranController extends Controller
{
    function index() {
        $page = "Laporan Pembayaran";
        $title = "Cerita Kopi - Laporan Pembayaran";

        $curDate = Carbon::today()->toDateString();
        $data_jenis_pembayaran = TypePembayaranModel::orderBy('nama')->get();

        return view('laporan.pembayaran', compact('curDate', 'data_jenis_pembayaran', 'page', 'title'));
    }

    function show(Request $request) {
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $jenis_pembayaran = $request->input('jenis_pembayaran');

        if ($start_date && $end_date) {
            if ($jenis_pembayaran == 'all' || $jenis_pembayaran == 'semua') {
                $data_penjualan_pembayaran = PenjualanPembayaranModel::select('jenis_pembayaran', 'jumlah_pembayaran', 'jenis_kartu', 'tanggal')
                                                            ->where(DB::raw('DATE(tanggal)'), '>=', $start_date)
                                                            ->where(DB::raw('DATE(tanggal)'), '<=', $end_date)
                                                            ->get();
            } else {
                $data_penjualan_pembayaran = PenjualanPembayaranModel::select('jenis_pembayaran', 'jumlah_pembayaran', 'jenis_kartu', 'tanggal')
                                                            ->where(DB::raw('DATE(tanggal)'), '>=', $start_date)
                                                            ->where(DB::raw('DATE(tanggal)'), '<=', $end_date)
                                                            ->where('jenis_pembayaran', $request->input('jenis_pembayaran'))
                                                            ->get();
            }
        } else {
            $data_penjualan_pembayaran = [];
        }

        return response()->json(['code' => 200, 'data_penjualan_pembayaran' => $data_penjualan_pembayaran]);
    }
}
