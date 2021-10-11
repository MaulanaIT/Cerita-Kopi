<?php

namespace App\Http\Controllers\Laporan;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PembelianController extends Controller
{
    function index() {
        $page = "Laporan Pembelian";
        $title = "Cerita Kopi - Laporan Pembelian";

        $curDate = Carbon::now();

        return view('laporan.pembelian', compact('curDate', 'page', 'title'));
    }
}
