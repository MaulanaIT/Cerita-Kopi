<?php

namespace App\Http\Controllers\Transaksi;

use App\Http\Controllers\Controller;
use App\Models\Master\BahanBakuModel;
use App\Models\Master\ProdukDetailModel;
use App\Models\Master\ProdukModel;
use App\Models\Transaksi\PembelianDetailModel;
use App\Models\Transaksi\PembelianModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PembelianController extends Controller
{
    function index() {
        $page = 'Pembelian';
        $title = 'Cerita Kopi - Pembelian';

        $curDate = Carbon::today()->toDateString();

        $data_item = BahanBakuModel::select('*')->orderBy('nama')->get();

        $data_pembelian = PembelianModel::all();
        $nomor_transaksi = 'B' . str_pad(count($data_pembelian) + 1, 6, '0', STR_PAD_LEFT);

        PembelianDetailModel::where('nomor', $nomor_transaksi)->delete();

        //Notification
        $expired = expiredBahanBaku();

        return view('transaksi.pembelian', compact('curDate', 'data_item', 'expired', 'nomor_transaksi', 'page', 'title'));
    }

    function show($nomor) {
        $data_pembelian_detail = PembelianDetailModel::select('*')->where('nomor', $nomor)->get();

        return response()->json(['code' => 200, 'data_pembelian_detail' => $data_pembelian_detail]);
    }

    function store(Request $request) {
        $nomor_transaksi = $request->input('nomor');
        $nama_item = $request->input('nama_item');
        $harga = $request->input('harga');
        $jumlah = $request->input('jumlah');
        $total_harga = $request->input('total_harga');
        $tanggal = $request->input('tanggal');

        $data_pembelian_detail = PembelianDetailModel::where('nomor', $nomor_transaksi)->where('nama_item', $nama_item)->where('harga', $harga)->get();

        if (count($data_pembelian_detail) > 0) {
            PembelianDetailModel::where('nomor', $nomor_transaksi)->where('nama_item', $nama_item)->where('harga', $harga)->update([
                'jumlah' => DB::raw('jumlah + ' . $jumlah),
                'total_harga' => DB::raw('total_harga + ' . $total_harga),
                'tanggal' => $tanggal
            ]);
        } else {
            PembelianDetailModel::create([
                'nomor' => $nomor_transaksi,
                'nama_item' => $nama_item,
                'harga' => $harga,
                'jumlah' => $jumlah,
                'total_harga' => $total_harga,
                'tanggal' => $tanggal
            ]);
        }

        return response()->json(['code' => 200]);
    }

    function save(Request $request) {
        $nomor_transaksi = $request->input('nomor');

        $data_pembelian_detail = PembelianDetailModel::where('nomor', $nomor_transaksi)->get();

        $total_harga = 0;

        foreach ($data_pembelian_detail as $data) {
            $total_harga += $data->total_harga;

            BahanBakuModel::where('nama', $data->nama_item)->update([
                'harga' => DB::raw('((harga * stok) + (' . $data->harga * $data->jumlah . ' * jumlah_per_pack)) / (stok + jumlah_per_pack * ' . $data->jumlah . ')'),
                'stok' => DB::raw('stok + (' . $data->jumlah . ' * jumlah_per_pack)'),
                'tanggal_expired' => $data->tanggal
            ]);
        }

        $data_bahan_baku = BahanBakuModel::all();

        foreach ($data_bahan_baku as $data) {
            ProdukDetailModel::where('nama_item', $data->nama)->update([
                'harga_per_item' => $data->harga/$data->jumlah_per_pack
            ]);
        }

        $data_produk = ProdukModel::all();

        foreach ($data_produk as $data) {
            $data_hpp = ProdukDetailModel::select(DB::raw('SUM(jumlah_dipakai * harga_per_item) AS hpp'))->where('kode', $data->kode)->first();

            ProdukModel::where('kode', $data->kode)->update([
                'hpp' => $data_hpp->hpp
            ]);
        }

        PembelianModel::create([
            'nomor' => $nomor_transaksi,
            'total_harga' => $total_harga,
            'tanggal' => $request->tanggal
        ]);

        return response()->json(['code' => 200]);
    }

    function delete(Request $request) {
        PembelianDetailModel::where('nama_item', $request->input('nama_item'))->where('nomor', $request->input('nomor'))->delete();

        return response()->json(['code' => 200]);
    }
}
