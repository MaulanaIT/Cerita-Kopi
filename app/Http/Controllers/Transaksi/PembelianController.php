<?php

namespace App\Http\Controllers\Transaksi;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PembelianController extends Controller
{
    function index() {
        $page = 'Pembelian';
        $title = 'Cerita Kopi - Pembelian';

        $curDate = Carbon::now();

        return view('transaksi.pembelian', compact('curDate', 'page', 'title'));
    }
}
