<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Master\BahanBakuModel;
use App\Models\Master\BahanBakuSatuanModel;
use App\Models\Master\ProdukDetailController;
use App\Models\Master\ProdukDetailModel;
use App\Models\Master\ProdukModel;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    function index() {
        $page = "Produk";
        $title = "Cerita Kopi - Produk";

        $data_produk = ProdukModel::select('*')->orderBy('nama')->get();

        return view ('master.produk', compact('data_produk', 'page', 'title'));
    }
}
