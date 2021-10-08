@extends('layout')

@section('main')
<p class="fs-3 fw-bold m-0 text-secondary">Produk</p>
<p class="fs-6 m-0 text-secondary">Master / <span class="text-dark">Produk</span></p>

<div class="pt-4 row">
    <div class="col-12 col-lg-6 p-0 pe-lg-2">
        <div class="card">
            <div class="card-body shadow">
                <p class="fw-bold fs-5 m-0 text-secondary">Tambah Data HPP Produk</p>
                <div class="mt-2">
                    <form action="" method="POST">
                        <label for="nama-item" class="col-form-label">Nama Item</label>
                        <input type="text" id="nama-item" class="form-control">
                        <div class="px-0 row">
                            <div class="col-12 col-lg-6 px-0">
                                <label for="harga-beli" class="col-form-label">Harga Beli</label>
                                <input type="number" id="harga-beli" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-lg-6 px-0 pe-lg-2">
                                <label for="jumlah-per-pack" class="col-form-label text-nowrap">Jumlah Per Pack</label>
                                <input type="number" id="jumlah-per-pack" class="form-control">
                            </div>
                            <div class="col-12 col-lg-6 px-0 ps-lg-2">
                                <label for="stok-per-pack" class="col-form-label text-nowrap">Satuan Per Pack</label>
                                <input type="number" id="stok-per-pack" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-lg-6 px-0 pe-lg-2">
                                <label for="jumlah-dipakai-per-produk" class="col-form-label text-nowrap">Jumlah Dipakai
                                    Per Produk</label>
                                <input type="number" id="jumlah-dipakai-per-produk" class="form-control">
                            </div>
                            <div class="col-12 col-lg-6 px-0 ps-lg-2">
                                <label for="satuan-per-pack" class="col-form-label text-nowrap">Satuan Per Pack</label>
                                <input type="number" id="satuan-per-pack" class="form-control">
                            </div>
                        </div>
                        <label for="harga-per-item-yang-dipakai" class="col-form-label">Harga Per Item Yang
                            Dipakai</label>
                        <input type="number" id="harga-per-item-yang-dipakai" class="form-control w-50">
                        <input type="submit" class="btn btn-sm btn-success mt-4 w-100" value="Tambah">
                        <input type="button" class="btn btn-sm btn-danger mt-2 w-100" value="Batal">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-6 p-0 pe-lg-2">
        <div class="card">
            <div class="card-body shadow">
                <p class="fw-bold fs-5 m-0 text-secondary">Kalkulator HPP</p>
                <div class="mt-2">
                    <form action="" method="POST">
                        <div class="row">
                            <div class="col-12 col-lg-6 px-0 pe-lg-2">
                                <label for="target-hpp" class="col-form-label">Target HPP</label>
                                <input type="number" id="target-hpp" class="form-control">
                            </div>
                            <div class="col-12 col-lg-6 px-0 ps-lg-2">
                                <label for="target-harga-jual" class="col-form-label text-nowrap">Target Harga
                                    Jual</label>
                                <input type="number" id="target-harga-jual" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-lg-6 px-0 pe-lg-2">
                                <label for="hpp-aktual" class="col-form-label">HPP Aktual</label>
                                <input type="number" id="hpp-aktual" class="form-control">
                            </div>
                            <div class="col-12 col-lg-6 px-0 ps-lg-2">
                                <label for="harga-jual-aktual" class="col-form-label text-nowrap">Harga Jual
                                    Aktual</label>
                                <input type="number" id="harga-jual-aktual" class="form-control">
                            </div>
                        </div>
                        <p class="col-form-label text-end py-4">Laba Produk : <span>Rp. 0.00</span></p>
                    </form>
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