<?php

namespace App\Http\Controllers;

use App\Models\ChartModel;
use App\Models\Transaksi\PembelianModel;
use App\Models\Transaksi\PenjualanProdukModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class DashboardController extends Controller
{
    public function index() {
        $page = "Dashboard";
        $title = "Cerita Kopi - Dashboard";

        $year = Carbon::now()->year;

        // Chart
        $list_bulan = [];
        $list_bulan[] = 'Januari';
        $list_bulan[] = 'Februari';
        $list_bulan[] = 'Maret';
        $list_bulan[] = 'April';
        $list_bulan[] = 'Mei';
        $list_bulan[] = 'Juni';
        $list_bulan[] = 'Juli';
        $list_bulan[] = 'Agustus';
        $list_bulan[] = 'September';
        $list_bulan[] = 'Oktober';
        $list_bulan[] = 'November';
        $list_bulan[] = 'Desember';
        
        $listPenjualan = PenjualanProdukModel::select(DB::raw("SUM((harga-hpp) * jumlah) AS jumlah"), DB::raw('MONTH(tanggal) AS tanggal'))
                                                ->where(DB::raw('YEAR(tanggal)'), now()->year)
                                                ->groupBy(DB::raw('MONTH(tanggal)'))
                                                ->get();

        foreach ($listPenjualan as $data) {
            $penjualan[$data->tanggal-1] = $data->jumlah;
        }

        for ($i = 0; $i < count($list_bulan); $i++) {
            if (!isset($penjualan[$i])) {
                $dataPenjualan[$i] = 0;
            } else {
                $dataPenjualan[$i] = $penjualan[$i];
            }
        }

        $coloursPenjualan = '#' . substr(str_shuffle('ABCDEF0123456789'), 0, 6) . '33';
        $bordersPenjualan = '#' . substr(str_shuffle('ABCDEF0123456789'), 0, 6) . 'FF';

        $chartPenjualan = new ChartModel();

        $chartPenjualan->labels = $list_bulan;
        $chartPenjualan->dataset = $dataPenjualan;
        $chartPenjualan->colours = $coloursPenjualan;
        $chartPenjualan->borders = $bordersPenjualan;

        $listPembelian = PembelianModel::select(DB::raw("SUM(total_harga) AS jumlah"), DB::raw('MONTH(tanggal) AS tanggal'))
                                                ->where(DB::raw('YEAR(tanggal)'), now()->year)
                                                ->groupBy(DB::raw('MONTH(tanggal)'))
                                                ->get();
        
        foreach ($listPembelian as $data) {
            $pembelian[$data->tanggal-1] = $data->jumlah;
        }

        for ($i = 0; $i < count($list_bulan); $i++) {
            if (!isset($pembelian[$i])) {
                $dataPembelian[$i] = 0;
            } else {
                $dataPembelian[$i] = $pembelian[$i];
            }
        }

        $coloursPembelian = '#' . substr(str_shuffle('ABCDEF0123456789'), 0, 6) . '33';
        $bordersPembelian = '#' . substr(str_shuffle('ABCDEF0123456789'), 0, 6) . 'FF';

        $chartPembelian = new ChartModel();

        $chartPembelian->labels = $list_bulan;
        $chartPembelian->dataset = $dataPembelian;
        $chartPembelian->colours = $coloursPembelian;
        $chartPembelian->borders = $bordersPembelian;

        //Notification
        $expired = expiredBahanBaku();

        return view ('dashboard', compact('chartPembelian', 'chartPenjualan', 'expired', 'page', 'title', 'year'));
    }
}
