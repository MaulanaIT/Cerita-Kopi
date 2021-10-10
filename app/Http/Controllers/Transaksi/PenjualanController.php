<?php

namespace App\Http\Controllers\Transaksi;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PenjualanController extends Controller
{
    function index() {
        $page = 'Penjualan';
        $title = 'Cerita Kopi - Penjualan';

        $curDate = Carbon::now();

        return view('transaksi.penjualan', compact('curDate', 'page', 'title'));
    }
}
