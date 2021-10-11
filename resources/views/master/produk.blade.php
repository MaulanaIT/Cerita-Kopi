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
                    <form action="/master/produk" method="POST">
                        @csrf
                        <label for="nama-item" class="col-form-label">Nama Item</label>
                        <input type="text" id="nama-item" name="nama-item" class="form-control">
                        <div class="px-0 row">
                            <div class="col-12 col-lg-6 px-0">
                                <label for="harga-beli" class="col-form-label">Harga Beli</label>
                                <input type="number" id="harga-beli" name="harga-beli" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-lg-6 px-0 pe-lg-2">
                                <label for="jumlah-per-pack" class="col-form-label text-nowrap">Jumlah Per Pack</label>
                                <input type="number" id="jumlah-per-pack" name="jumlah-per-pack" class="form-control">
                            </div>
                            <div class="col-12 col-lg-6 px-0 ps-lg-2">
                                <label for="stok-per-pack" class="col-form-label text-nowrap">Satuan Per Pack</label>
                                <input type="number" id="stok-per-pack" name="satuan-per-pack" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-lg-6 px-0 pe-lg-2">
                                <label for="jumlah-dipakai-per-produk" class="col-form-label text-nowrap">Jumlah Dipakai
                                    Per Produk</label>
                                <input type="number" id="jumlah-dipakai-per-produk" name="jumlah-dipakai-per-produk" class="form-control">
                            </div>
                            <div class="col-12 col-lg-6 px-0 ps-lg-2">
                                <label for="satuan-per-pack" class="col-form-label text-nowrap">Satuan Per Produk</label>
                                <input type="number" id="satuan-per-pack" name="satuan-per-produk" class="form-control">
                            </div>
                        </div>
                        <div class="px-0 row">
                            <div class="col-12 col-lg-6 px-0">
                                <label for="harga-per-item-yang-dipakai" class="col-form-label">Harga Per Item Yang
                                    Dipakai</label>
                                <input type="number" id="harga-per-item-yang-dipakai" name="harga-per-item" class="form-control">
                            </div>
                        </div>
                        <input type="submit" class="btn btn-success mt-4 w-100" value="Tambah">
                        <input type="button" class="btn btn-danger mt-2 w-100" value="Batal">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-6 mt-4 mt-lg-0 p-0 pe-lg-2">
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
    <table id="table-data" class="table table-bordered table-striped table-hover">
        <thead class="align-middle text-center text-nowrap">
            <tr>
                <th>No.</th>
                <th>Harga Beli</th>
                <th>Jumlah Per Pack</th>
                <th>Satuan Per Pack</th>
                <th>Jumlah Dipakai Per Produk</th>
                <th>Satuan Per Produk</th>
                <th>Harga Per Item Yang Dipakai</th>
            </tr>
        </thead>
        <tbody class="align-middle">
            @if (count($data_produk) > 0)
                @php
                    $i = 0;
                @endphp
                @foreach($data_produk as $data)
                    <tr>
                        <td>{{++$i}}</td>
                        <td>{{$data->nama}}</td>
                        <td>{{$data->harga_beli}}</td>
                        <td>{{$data->jumlah_per_pack}}</td>
                        <td>{{$data->satuan_per_pack}}</td>
                        <td>{{$data->jumlah_dipakai_per_produk}}</td>
                        <td>{{$data->satuan_per_produk}}</td>
                        <td>{{$data->harga_per_item}}</td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</div>
@endsection