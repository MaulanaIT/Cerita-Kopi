<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    function index() {
        $page = "Transaksi";
        $title = "Cerita Kopi - Master";

        return view ('master.produk', compact('page', 'title'));
    }
}
