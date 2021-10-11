<?php

namespace App\Http\Controllers\Laporan;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PenjualanController extends Controller
{
    function index() {
        $page = "Laporan Penjualan";
        $title = "Cerita Kopi - Laporan Penjualan";

        $curDate = Carbon::now();

        return view('laporan.penjualan', compact('curDate', 'page', 'title'));
    }
}
