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
            <table id="table-data-produk" class="table table-bordered table-striped table-hover text-nowrap w-100">
                <thead class="align-middle text-center">
                    <tr>
                        <th>No.</th>
                        <th>Nama</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Total Harga</th>
                        <th>Opsi</th>
                    </tr>
                </thead>
                <tbody class="align-middle">
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
                            <td>
                                <div id="nama-produk-{{ $data->id }}">{{ $data->nama_produk }}</div>
                                <input type="text" id="edit-nama-produk-{{ $data->id }}"
                                    name="edit-nama-produk-{{ $data->id }}" class="d-none form-control"
                                    value="{{ $data->nama_produk }}">
                            </td>
                            <td class="text-end">
                                <div id="harga-{{ $data->id }}">Rp. {{ $harga }}</div>
                                <input type="text" id="edit-harga-{{ $data->id }}" name="edit-harga-{{ $data->id }}"
                                    class="d-none form-control" value="{{ $data->harga }}"
                                    oninput="inputNumber(this.id)">
                            </td>
                            <td class="text-center">
                                <div id="jumlah-{{ $data->id }}">{{ $data->jumlah }}</div>
                                <input type="text" id="edit-jumlah-{{ $data->id }}"
                                    name="edit-jumlah-{{ $data->id }}" class="d-none form-control"
                                    value="{{ $data->jumlah }}" oninput="inputNumber(this.id)">
                            </td>
                            <td class="text-end">
                                <div id="total-harga-{{ $data->id }}">Rp. {{ $total_harga }}</div>
                            </td>
                            <td class="text-center">
                                <button id="ubah-data-produk-{{ $data->id }}" class="btn btn-warning"
                                    onclick="ubahDataProduk('{{ $data->id }}')"><i class="fas fa-edit"></i>
                                    Ubah</button>
                                <button id="terapkan-data-produk-{{ $data->id }}" class="btn btn-success d-none"
                                    onclick="terapkanDataProduk('{{ $data->id }}')"><i class="fas fa-check"></i>
                                    Terapkan</button>
                                <button id="hapus-data-produk-{{ $data->id }}" class="btn btn-danger"
                                    onclick="hapusDataProduk('{{ $data->id }}')"><i class="fas fa-trash"></i>
                                    Hapus</button>
                            </td>
                        </tr>
                    @endforeach
                    @php
                        $total = number_format($total, 2, ',', '.');
                    @endphp
                </tbody>
                <tr>
                    <td></td>
                    <td class="d-none"></td>
                    <td class="d-none"></td>
                    <th colspan="3" class="text-center">Total</th>
                    <td class="text-end text-nowrap">Rp. {{ $total }}</td>
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
                        <th>Opsi</th>
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
                            <td class="text-center">
                                <div id="jenis-pembayaran-{{ $data->id }}">{{ $data->jenis_pembayaran }}</div>
                                <input type="text" id="edit-jenis-pembayaran-{{ $data->id }}"
                                    name="edit-jenis-pembayaran-{{ $data->id }}" class="d-none form-control"
                                    value="{{ $data->jenis_pembayaran }}">
                            </td>
                            <td class="text-end text-nowrap">
                                <div id="jumlah-pembayaran-{{ $data->id }}">Rp. {{ $jumlah_pembayaran }}</div>
                                <input type="text" id="edit-jumlah-pembayaran-{{ $data->id }}"
                                    name="edit-jumlah-pembayaran-{{ $data->id }}" class="d-none form-control"
                                    value="{{ $data->jumlah_pembayaran }}" oninput="inputNumber(this.id)">
                            </td>
                            <td>
                                <div id="jenis-kartu-{{ $data->id }}">{{ $data->jenis_kartu }}</div>
                                <input type="text" id="edit-jenis-kartu-{{ $data->id }}"
                                    name="edit-jenis-kartu-{{ $data->id }}" class="d-none form-control"
                                    value="{{ $data->jenis_kartu }}">
                            </td>
                            <td class="text-center text-nowrap">
                                <div id="tanggal-{{ $data->id }}">{{ $data->tanggal }}</div>
                                <input type="text" id="edit-tanggal-{{ $data->id }}"
                                    name="edit-tanggal-{{ $data->id }}" class="d-none form-control"
                                    value="{{ $data->tanggal }}">
                            </td>
                            <td class="text-center">
                                <button id="ubah-data-pembayaran-{{ $data->id }}" class="btn btn-warning"
                                    onclick="ubahDataPembayaran('{{ $data->id }}')"><i class="fas fa-edit"></i>
                                    Ubah</button>
                                <button id="terapkan-data-pembayaran-{{ $data->id }}" class="btn btn-success d-none"
                                    onclick="terapkanDataPembayaran('{{ $data->id }}')"><i class="fas fa-check"></i>
                                    Terapkan</button>
                                <button id="hapus-data-pembayaran-{{ $data->id }}" class="btn btn-danger"
                                    onclick="hapusDataPembayaran('{{ $data->id }}')"><i class="fas fa-trash"></i>
                                    Hapus</button>
                            </td>
                        </tr>
                    @endforeach
                    @php
                        $total = number_format($total, 2, ',', '.');
                    @endphp
                </tbody>
                <tr>
                    <td></td>
                    <td class="d-none"></td>
                    <td class="d-none"></td>
                    <th colspan="3" class="text-center">Total</th>
                    <td class="text-end text-nowrap">Rp. {{ $total }}</td>
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

        function ubahDataProduk(id) {
            $('#nama-produk-' + id).addClass('d-none');
            $('#harga-' + id).addClass('d-none');
            $('#jumlah-' + id).addClass('d-none');

            $('#edit-nama-produk-' + id).removeClass('d-none');
            $('#edit-harga-' + id).removeClass('d-none');
            $('#edit-jumlah-' + id).removeClass('d-none');

            $('#ubah-data-produk-' + id).addClass('d-none');
            $('#terapkan-data-produk-' + id).removeClass('d-none');
        }

        function ubahDataPembayaran(id) {
            $('#jenis-pembayaran-' + id).addClass('d-none');
            $('#jumlah-pembayaran-' + id).addClass('d-none');
            $('#jenis-kartu-' + id).addClass('d-none');
            $('#tanggal-' + id).addClass('d-none');

            $('#edit-jenis-pembayaran-' + id).removeClass('d-none');
            $('#edit-jumlah-pembayaran-' + id).removeClass('d-none');
            $('#edit-jenis-kartu-' + id).removeClass('d-none');
            $('#edit-tanggal-' + id).removeClass('d-none');

            $('#ubah-data-pembayaran-' + id).addClass('d-none');
            $('#terapkan-data-pembayaran-' + id).removeClass('d-none');
        }

        function terapkanDataPembayaran(id) {
            $.ajax({
                url: '/transaksi/penjualan/update-pembayaran',
                type: 'POST',
                data: {
                    id: id,
                    jenis_pembayaran: $('#edit-jenis-pembayaran-' + id).val(),
                    jumlah_pembayaran: $('#edit-jumlah-pembayaran-' + id).val(),
                    jenis_kartu: $('#edit-jenis-kartu-' + id).val(),
                    tanggal: $('#edit-tanggal-' + id).val()
                },
                success: function(response) {
                    if (response.code == 200) {
                        $('#jenis-pembayaran-' + id).html($('#edit-jenis-pembayaran-' + id).val());
                        $('#jumlah-pembayaran-' + id).html(hargaFormat($('#edit-jumlah-pembayaran-' + id).val()));
                        $('#jenis-kartu-' + id).html($('#edit-jenis-kartu-' + id).val());
                        $('#tanggal-' + id).html($('#edit-tanggal-' + id).val());

                        $('#jenis-pembayaran-' + id).removeClass('d-none');
                        $('#jumlah-pembayaran-' + id).removeClass('d-none');
                        $('#jenis-kartu-' + id).removeClass('d-none');
                        $('#tanggal-' + id).removeClass('d-none');

                        $('#edit-jenis-pembayaran-' + id).addClass('d-none');
                        $('#edit-jumlah-pembayaran-' + id).addClass('d-none');
                        $('#edit-jenis-kartu-' + id).addClass('d-none');
                        $('#edit-tanggal-' + id).addClass('d-none');

                        $('#ubah-data-pembayaran-' + id).removeClass('d-none');
                        $('#terapkan-data-pembayaran-' + id).addClass('d-none');
                    }
                }
            });
        }

        function terapkanDataProduk(id) {
            $.ajax({
                url: '/transaksi/penjualan/update-produk',
                type: 'POST',
                data: {
                    id: id,
                    nama_produk: $('#edit-nama-produk-' + id).val(),
                    harga: $('#edit-harga-' + id).val(),
                    jumlah: $('#edit-jumlah-' + id).val()
                },
                success: function(response) {
                    if (response.code == 200) {
                        $('#nama-produk-' + id).html($('#edit-nama-produk-' + id).val());
                        $('#harga-' + id).html(hargaFormat($('#edit-harga-' + id).val()));
                        $('#jumlah-' + id).html($('#edit-jumlah-' + id).val());
                        $('#total-harga-' + id).html(hargaFormat(parseInt($('#edit-harga-' + id).val()) *
                            parseInt($('#edit-jumlah-' + id).val())));

                        $('#nama-produk-' + id).removeClass('d-none');
                        $('#harga-' + id).removeClass('d-none');
                        $('#jumlah-' + id).removeClass('d-none');

                        $('#edit-nama-produk-' + id).addClass('d-none');
                        $('#edit-harga-' + id).addClass('d-none');
                        $('#edit-jumlah-' + id).addClass('d-none');

                        $('#ubah-data-produk-' + id).removeClass('d-none');
                        $('#terapkan-data-produk-' + id).addClass('d-none');
                    }
                }
            });
        }

        function hapusDataProduk(id) {
            $.ajax({
                url: '/transaksi/penjualan/delete-produk',
                type: 'POST',
                data: {
                    id: id
                },
                success: function(response) {
                    if (response.code == 200) {
                        location.reload();
                    }
                }
            });
        }

        function hapusDataPembayaran(id) {
            $.ajax({
                url: '/transaksi/penjualan/delete-pembayaran',
                type: 'POST',
                data: {
                    id: id
                },
                success: function(response) {
                    if (response.code == 200) {
                        location.reload();
                    }
                }
            });
        }
    </script>
@endsection
