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
                            <input type="file" id="daftar-produk" name="daftar-produk" class="form-control"
                                accept=".csv, .xls, .xlsx" required>
                        </div>
                        <div class="px-0 pt-2 row">
                            <p class="col-auto col-form-label m-0 px-0 text-secondary">Upload Daftar Pembayaran</p>
                            <input type="file" id="daftar-pembayaran" name="daftar-pembayaran" class="form-control"
                                accept=".csv, .xls, .xlsx" required>
                        </div>
                        <button type="submit" class="btn btn-success mt-4 w-100">Unggah</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="px-0 pt-4 row">
        <div class="col-12 col-lg-6 px-0 pe-0 pe-lg-2 table-responsive">
            <p class="col-form-label fw-bold fs-5 m-0 px-0 text-secondary">Tabel Produk</p>
            <table id="table-data-produk" class="table table-bordered table-striped table-hover w-100">
                <thead class="align-middle text-center text-nowrap">
                    <tr>
                        <th>No.</th>
                        <th>Nama</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Total Harga</th>
                    </tr>
                </thead>
                <tbody class="align-middle text-nowrap">
                    @php
                        $i = 0;
                        $total = 0;
                    @endphp
                    @foreach ($data_penjualan_produk_detail as $data)
                        @php
                            $total += $data->total_harga;
                            $harga = number_format($data->harga, 2, ',', '.');
                            $total_harga = number_format($data->total_harga, 2, ',', '.');
                        @endphp
                        <tr>
                            <td class="text-center">{{ ++$i }}.</td>
                            <td>{{ $data->nama_produk }}</td>
                            <td class="text-end text-nowrap">Rp. {{ $harga }}</td>
                            <td class="text-center">{{ $data->jumlah }}</td>
                            <td class="text-end text-nowrap">Rp. {{ $total_harga }}</td>
                        </tr>
                    @endforeach
                    @php
                        $total = number_format($total, 2, ',', '.');
                    @endphp
                </tbody>
                <tr>
                    <td class="d-none"></td>
                    <td class="d-none"></td>
                    <td class="d-none"></td>
                    <th colspan="4" class="text-center">Total</th>
                    <td class="text-end text-nowrap">Rp. {{$total}}</td>
                </tr>
            </table>
        </div>
        <div class="col-12 col-lg-6 px-0 ps-0 ps-lg-2 pt-4 pt-lg-0 table-responsive">
            <p class="col-form-label fw-bold fs-5 m-0 px-0 text-secondary">Tabel Pembayaran</p>
            <table id="table-data-pembayaran" class="table table-bordered table-striped table-hover w-100">
                <thead class="align-middle text-center text-nowrap">
                    <tr>
                        <th>No.</th>
                        <th>Jenis Pembayaran</th>
                        <th>Jumlah Pembayaran</th>
                        <th>Jenis Kartu</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody class="align-middle text-nowrap">
                    @php
                        $i = 0;
                        $total = 0;
                    @endphp
                    @foreach ($data_penjualan_pembayaran_detail as $data)
                        @php
                            $total += $data->jumlah_pembayaran;
                            $jumlah_pembayaran = number_format($data->jumlah_pembayaran, 2, ',', '.');
                        @endphp
                        <tr>
                            <td class="text-center">{{ ++$i }}.</td>
                            <td class="text-center">{{ $data->jenis_pembayaran }}</td>
                            <td class="text-end text-nowrap">Rp. {{ $jumlah_pembayaran }}</td>
                            <td>{{ $data->jenis_kartu }}</td>
                            <td class="text-center text-nowrap">{{ $data->tanggal }}</td>
                        </tr>
                    @endforeach
                    @php
                        $total = number_format($total, 2, ',', '.');
                    @endphp
                </tbody>
                <tr>
                    <td class="d-none"></td>
                    <td class="d-none"></td>
                    <td class="d-none"></td>
                    <th colspan="4" class="text-center">Total</th>
                    <td class="text-end text-nowrap">Rp. {{$total}}</td>
                </tr>
            </table>
        </div>
        <button class="btn btn-success my-4 w-100" onclick="simpanData()">Simpan</button>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#table-data-pembayaran').DataTable();
            $('#table-data-produk').DataTable();
        });

        function simpanData() {
            $.ajax({
                url: '/transaksi/penjualan/save',
                type: 'POST',
                success: function(response) {
                    if (response.code == 200) {
                        location.reload();
                    } else if (response.code == 406) {
                        alert('Terdapat produk belum tersedia di database.');
                    }
                }
            });
        }
    </script>
@endsection
