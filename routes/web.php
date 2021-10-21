<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Laporan\PembelianController as LaporanPembelianController;
use App\Http\Controllers\Laporan\ProdukController as LaporanProdukController;
use App\Http\Controllers\Master\BahanBakuController;
use App\Http\Controllers\Master\HPPProdukController;
use App\Http\Controllers\Master\PersediaanBahanBakuController;
use App\Http\Controllers\Master\ProdukController;
use App\Http\Controllers\Transaksi\PembelianController;
use App\Http\Controllers\Transaksi\PenjualanController;
use Illuminate\Support\Facades\Route;

Route::get('/', function() {
    return redirect()->to('/dashboard');
});
Route::get('/dashboard', [DashboardController::class, 'index']);

Route::group(['prefix' => 'master'], function() {

    Route::group(['prefix' => 'bahan-baku'], function() {
        Route::get('/', [BahanBakuController::class, 'index']);
        Route::get('/select-item/{nama}', [BahanBakuController::class, 'selectItem']);
        Route::post('/store', [BahanBakuController::class, 'store']);
    });

    Route::group(['prefix' => 'persediaan-bahan-baku'], function() {
        Route::get('/', [PersediaanBahanBakuController::class, 'index']);
        Route::post('/delete/{kode}', [PersediaanBahanBakuController::class, 'delete']);
        Route::post('/update', [PersediaanBahanBakuController::class, 'update']);
        Route::post('/store', [PersediaanBahanBakuController::class, 'store']);
    });

    Route::group(['prefix' => 'hpp-produk'], function() {
        Route::get('/', [HPPProdukController::class, 'index']);
        Route::get('/show/{kode}', [HPPProdukController::class, 'show']);
        Route::post('/delete', [HPPProdukController::class, 'delete']);
        Route::post('/save', [HPPProdukController::class, 'save']);
        Route::post('/store', [HPPProdukController::class, 'store']);
    });

    Route::group(['prefix' => 'produk'], function() {
        Route::get('/', [ProdukController::class, 'index']);
        Route::post('/delete/{kode}', [ProdukController::class, 'delete']);
        Route::post('/update', [ProdukController::class, 'update']);
        Route::post('/store', [ProdukController::class, 'store']);
    });
});

Route::group(['prefix' => 'transaksi'], function() {

    Route::group(['prefix' => 'pembelian'], function() {
        Route::get('/', [PembelianController::class, 'index']);
        Route::get('/show/{nomor}', [PembelianController::class, 'show']);
        Route::post('/delete', [PembelianController::class, 'delete']);
        Route::post('/save', [PembelianController::class, 'save']);
        Route::post('/store', [PembelianController::class, 'store']);
    });

    Route::group(['prefix' => 'penjualan'], function() {
        Route::get('/', [PenjualanController::class, 'index']);
        Route::post('/delete-pembayaran', [PenjualanController::class, 'deletePembayaran']);
        Route::post('/delete-produk', [PenjualanController::class, 'deleteProduk']);
        Route::post('/update-pembayaran', [PenjualanController::class, 'updatePembayaran']);
        Route::post('/update-produk', [PenjualanController::class, 'updateProduk']);
        Route::post('/import', [PenjualanController::class, 'import']);
        Route::post('/save', [PenjualanController::class, 'save']);
        Route::post('/store', [PenjualanController::class, 'store']);
    });
});

Route::group(['prefix' => 'laporan'], function() {

    Route::group(['prefix' => 'pembelian'], function() {
        Route::get('/', [LaporanPembelianController::class, 'index']);
        Route::post('/show', [LaporanPembelianController::class, 'show']);
    });

    Route::group(['prefix' => 'produk'], function() {
        Route::get('/', [LaporanProdukController::class, 'index']);
        Route::post('/show', [LaporanProdukController::class, 'show']);
    });
});
