<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Master\ProdukModel;

class ProdukController extends Controller
{
    function index() {
        $page = "Produk";
        $title = "Cerita Kopi - Produk";

        $data_produk = ProdukModel::select('*')->orderBy('nama')->get();

        return view ('master.produk', compact('data_produk', 'page', 'title'));
    }
}
