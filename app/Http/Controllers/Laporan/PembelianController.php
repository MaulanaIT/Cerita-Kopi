<?php

namespace App\Http\Controllers\Laporan;

use App\Http\Controllers\Controller;
use App\Models\Transaksi\PembelianDetailModel;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PembelianController extends Controller
{
    function index() {
        $page = "Laporan Pembelian";
        $title = "Cerita Kopi - Laporan Pembelian";

        $curDate = Carbon::today()->toDateString();

        return view('laporan.pembelian', compact('curDate', 'page', 'title'));
    }

    function show(Request $request) {
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');

        if ($start_date && $end_date) {
            $data_pembelian_detail = PembelianDetailModel::where('created_at', '>=', $start_date)
                                                        ->where('created_at', '<=', $start_date)
                                                        ->orderBy('created_at')
                                                        ->get();
        } else {
            $data_pembelian_detail = [];
        }

        return response()->json(['code' => 200, 'data_pembelian_detail' => $data_pembelian_detail]);
    }
}
