<?php

namespace App\Http\Controllers\Laporan;

use App\Http\Controllers\Controller;
use App\Models\Transaksi\PembelianDetailModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PembelianController extends Controller
{
    function index() {
        $page = "Laporan Pembelian";
        $title = "Cerita Kopi - Laporan Pembelian";

        $curDate = Carbon::today()->toDateString();

        //Notification
        $expired = expiredBahanBaku();

        return view('laporan.pembelian', compact('curDate', 'expired', 'page', 'title'));
    }

    function show(Request $request) {
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');

        if ($start_date && $end_date) {
            $data_pembelian_detail = PembelianDetailModel::where(DB::raw('DATE(created_at)'), '>=', $start_date)
                                                        ->where(DB::raw('DATE(created_at)'), '<=', $end_date)
                                                        ->orderBy('created_at')
                                                        ->get();
        } else {
            $data_pembelian_detail = [];
        }

        return response()->json(['code' => 200, 'data_pembelian_detail' => $data_pembelian_detail]);
    }
}
