<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Master\BahanBakuController;
use App\Http\Controllers\Master\ProdukController;
use Illuminate\Support\Facades\Route;

Route::get('/', function() {
    return redirect()->to('/dashboard');
});
Route::get('/dashboard', [DashboardController::class, 'index']);

Route::get('/master/produk', [ProdukController::class, 'index']);
Route::get('/master/bahan-baku', [BahanBakuController::class, 'index']);
