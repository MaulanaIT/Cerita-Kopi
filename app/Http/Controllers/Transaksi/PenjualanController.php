<?php

namespace App\Http\Controllers\Transaksi;

use App\Http\Controllers\Controller;
use App\Models\Master\ProdukModel;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PenjualanController extends Controller
{
    function index() {
        $page = 'Penjualan';
        $title = 'Cerita Kopi - Penjualan';

        $curDate = Carbon::now();

        $data_produk = ProdukModel::select('*')->orderBy('nama')->get();

        return view('transaksi.penjualan', compact('curDate', 'data_produk', 'page', 'title'));
    }
}
