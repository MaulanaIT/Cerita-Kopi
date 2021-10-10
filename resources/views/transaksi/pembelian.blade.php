@extends('layout')

@section('main')
<p class="fs-3 fw-bold m-0 text-secondary">Pembelian</p>
<p class="fs-6 m-0 text-secondary">Transaksi / <span class="text-dark">Pembelian</span></p>

<div class="pt-4 row">
    <div class="col-12 col-lg-6 p-0 pe-lg-2">
        <div class="card">
            <div class="card-body shadow">
                <p class="fw-bold fs-5 m-0 text-secondary">Tambah Pembelian</p>
                <div class="mt-2">
                    <div class="px-0 row">
                        <label for="tanggal" class="col-form-label">Tanggal</label>
                        <input type="date" id="tanggal" name="tanggal" class="form-control" value={{$curDate}}>
                    </div>
                    <label for="nama-item" class="col-form-label">Nama Item</label>
                    <input type="text" id="nama-item" name="nama-item" class="form-control">
                    <div class="row">
                        <div class="col-12 col-lg-4 px-0 pe-lg-2">
                            <label for="harga" class="col-form-label">Harga</label>
                            <input type="number" id="harga" name="harga" class="form-control">
                        </div>
                        <div class="col-12 col-lg-4 px-0 px-lg-2">
                            <label for="jumlah" class="col-form-label text-nowrap">Jumlah</label>
                            <input type="number" id="jumlah" name="jumlah" class="form-control">
                        </div>
                        <div class="col-12 col-lg-4 px-0 ps-lg-2">
                            <label for="total-harga" class="col-form-label text-nowrap">Total Harga</label>
                            <input type="number" id="total-harga" name="total-harga" class="form-control">
                        </div>
                    </div>
                    <button class="btn btn-sm btn-primary mt-4 w-100">Tambah</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="p-0 pt-4 table-responsive">
    <table class="table table-bordered table-striped table-hover">
        <thead class="align-middle text-center">
            <tr>
                <th>No.</th>
                <th>Nama</th>
                <th>Jumlah</th>
                <th>Satuan</th>
                <th>Stok Minimal</th>
            </tr>
        </thead>
        <tbody class="align-middle">
            <tr>
                <th class="text-center">1.</th>
                <td>Coffee Blend (Essp)</td>
                <td class="text-center">10</td>
                <td class="text-center">Gr</td>
                <td class="text-center">5</td>
            </tr>
            <tr>
                <th class="text-center">2.</th>
                <td>Water 1 (Essp)</td>
                <td class="text-center">20</td>
                <td class="text-center">Mltr</td>
                <td class="text-center">8</td>
            </tr>
            <tr>
                <th class="text-center">3.</th>
                <td>Susu Low Fat</td>
                <td class="text-center">5</td>
                <td class="text-center">Ltr</td>
                <td class="text-center">2</td>
            </tr>
            <tr>
                <th class="text-center">4.</th>
                <td>Botol + Stiker</td>
                <td class="text-center">6</td>
                <td class="text-center">Botol</td>
                <td class="text-center">3</td>
            </tr>
            <tr>
                <th class="text-center">5.</th>
                <td>SKM</td>
                <td class="text-center">15</td>
                <td class="text-center">Gr</td>
                <td class="text-center">6</td>
            </tr>
        </tbody>
    </table>
</div>
@endsection