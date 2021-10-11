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
                    <button class="btn btn-primary mt-4 w-100">Tambah</button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-6 mt-4 mt-lg-0 p-0 pe-lg-2 table-responsive">
        <table id="table-data" class="table table-bordered table-striped table-hover">
            <thead class="align-middle text-center text-nowrap">
                <tr>
                    <th>No.</th>
                    <th>Nama</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Total Harga</th>
                </tr>
            </thead>
            <tbody class="align-middle">
                <tr>
                    <td class="d-none"></td>
                    <td class="d-none"></td>
                    <td class="d-none"></td>
                    <td colspan="4" class="fw-bold text-center">Total </td>
                    <td class="fw-bold text-end">Rp. 0,00</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection