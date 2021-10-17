@extends('layout')

@section('main')
<p class="fs-3 fw-bold m-0 text-secondary">Penjualan</p>
<p class="fs-6 m-0 text-secondary">Transaksi / <span class="text-dark">Penjualan</span></p>

<div class="pt-4 row">
    <div class="col-12 col-lg-6 p-0 pe-lg-2">
        <div class="card">
            <div class="card-body shadow">
                <form action="/transaksi/penjualan/import" method="POST" enctype="multipart/form-data">
                    @csrf
                    <p class="col-form-label fw-bold fs-5 m-0 px-0 text-secondary">Tambah Penjualan</p>
                    <div class="px-0 row">
                        <p class="col-auto col-form-label m-0 px-0 text-secondary">Upload Daftar Produk</p>
                        <input type="file" id="daftar-produk" name="daftar-produk" class="form-control" accept=".csv, .xls, .xlsx">
                    </div>
                    <div class="px-0 pt-2 row">
                        <p class="col-auto col-form-label m-0 px-0 text-secondary">Upload Daftar Pembayaran</p>
                        <input type="file" id="daftar-pembayaran" name="daftar-pembayaran" class="form-control" accept=".csv, .xls, .xlsx">
                    </div>
                    <button type="submit" class="btn btn-success mt-4 w-100">Unggah</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="pt-4 table-responsive">
    <table id="table-data" class="table table-bordered table-striped table-hover">
        <thead class="align-middle text-center text-nowrap">
            <tr>
                <th>No.</th>
                <th>Tanggal</th>
                <th>Nama</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Jenis Pembayaran</th>
                <th>Total Harga</th>
            </tr>
        </thead>
        <tbody class="align-middle">
            <tr>
                <td class=""></td>
                <td class=""></td>
                <td class=""></td>
                <td class=""></td>
                <td class="fw-bold text-center">Total </td>
                <td>Shopeepay</td>
                <td class="fw-bold text-end">Rp. 0,00</td>
            </tr>
        </tbody>
    </table>
    <button class="btn btn-success my-4 w-100">Simpan</button>
</div>
@endsection