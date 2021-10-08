<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BahanBakuController extends Controller
{
    function index() {
        $page = "Master";
        $title = "Cerita Kopi - Bahan Baku";

        return view('master.bahan_baku', compact('page', 'title'));
    }
}
