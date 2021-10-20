@extends('layout')

@section('main')
    <p class="fs-3 fw-bold m-0 text-secondary">HPP Produk</p>
    <p class="fs-6 m-0 text-secondary">Master / <span class="text-dark">HPP Produk</span></p>

    <div class="pt-4 row">
        <div class="col-12 col-lg-6 p-0 pe-lg-2">
            <div class="card">
                <div class="card-body shadow">
                    <p class="fw-bold fs-5 m-0 text-secondary">Tambah Data HPP Produk</p>
                    <div class="mt-2">
                        <label for="kode-produk" class="col-form-label">Kode Produk</label>
                        <input type="text" id="kode-produk" name="kode-produk" class="form-control" required>
                        <label for="nama-produk" class="col-form-label">Nama Produk</label>
                        <input type="text" id="nama-produk" name="nama-produk" class="form-control" required>
                        <label for="nama-item" class="col-form-label">Nama Item</label>
                        <select name="nama-item" id="nama-item" class="form-select" onchange="selectItem(this.id)" required>
                            <option value="">-- Pilih Item --</option>
                            @foreach ($data_bahan_baku as $data)
                                <option value="{{ $data->nama }}">{{ $data->nama }}</option>
                            @endforeach
                        </select>
                        <div class="px-0 row">
                            <div class="col-12 col-lg-4 px-0 pe-0 pe-lg-2">
                                <label for="harga-item" class="col-form-label">Harga Item</label>
                                <input type="number" id="harga-item" name="harga-item" class="form-control" readonly required>
                            </div>
                            <div class="col-12 col-lg-4 px-0 px-lg-2">
                                <label for="satuan-per-pack" class="col-form-label">Satuan Per Pack</label>
                                <input type="text" id="satuan-per-pack" name="satuan-per-pack" class="form-control"
                                    value="Satuan Item" readonly required>
                            </div>
                            <div class="col-12 col-lg-4 px-0 ps-0 ps-lg-2">
                                <label for="jumlah-per-pack" class="col-form-label">Jumlah Per Pack</label>
                                <input type="number" id="jumlah-per-pack" name="jumlah-per-pack" class="form-control"
                                    readonly required>
                            </div>
                        </div>
                        <div class="px-0 row">
                            <div class="col-12 col-lg-4 px-0 pe-0 pe-lg-2">
                                <label for="harga-item-per-unit" class="col-form-label">Harga Item Per Unit</label>
                                <input type="number" id="harga-item-per-unit" name="harga-item-per-unit"
                                    class="form-control" readonly required>
                            </div>
                            <div class="col-12 col-lg-4 px-0 px-lg-2">
                                <label for="satuan-dipakai" class="col-form-label">Satuan Dipakai</label>
                                <select name="satuan-dipakai" id="satuan-dipakai" class="form-select" required>
                                    @foreach ($data_bahan_baku_satuan as $data)
                                        <option value="{{ $data->nama }}">{{ $data->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12 col-lg-4 px-0 ps-0 ps-lg-2">
                                <label for="jumlah-dipakai" class="col-form-label">Jumlah Dipakai</label>
                                <input type="number" id="jumlah-dipakai" name="jumlah-dipakai" class="form-control"
                                    onchange="kalkulasiHargaPerItem()" required>
                            </div>
                        </div>
                        <button class="btn btn-primary mt-4 w-100" onclick="tambahItem()">Tambah</button>
                        <input class="btn btn-danger mt-2 w-100" value="Bersihkan">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6 mt-4 mt-lg-0 p-0 pe-lg-2">
            <div class="card">
                <div class="card-body shadow">
                    <p class="fw-bold fs-5 m-0 text-secondary">Kalkulator HPP</p>
                    <div class="mt-2">
                        <div class="row">
                            <div class="col-12 col-lg-6 px-0 pe-lg-2">
                                <label for="target-hpp" class="col-form-label">Target HPP</label>
                                <div class="input-group">
                                    <input type="number" id="target-hpp" class="form-control" onchange="kalkulasiHpp(); kalkulasiLaba();">
                                    <span class="input-group-text">%</span>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6 px-0 ps-lg-2">
                                <label for="target-harga-jual" class="col-form-label text-nowrap">Target Harga
                                    Jual</label>
                                <input type="number" id="target-harga-jual" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-lg-6 px-0 pe-lg-2">
                                <label for="hpp-aktual" class="col-form-label">HPP Aktual</label>
                                <input type="number" id="hpp-aktual" class="form-control" onchange="kalkulasiLaba()"
                                    readonly>
                            </div>
                            <div class="col-12 col-lg-6 px-0 ps-lg-2">
                                <label for="harga-jual-aktual" class="col-form-label text-nowrap">Harga Jual
                                    Aktual</label>
                                <input type="number" id="harga-jual-aktual" class="form-control"
                                    onchange="kalkulasiLaba()">
                            </div>
                        </div>
                        <p id="laba-produk" class="col-form-label text-end py-4">Laba Produk : <span>Rp. 0,00</span></p>
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
                    <th>Nama Item</th>
                    <th>Jumlah Dipakai</th>
                    <th>Satuan Dipakai</th>
                    <th>Harga Per Item</th>
                </tr>
            </thead>
            <tbody id="table-body-data" class="align-middle">
            </tbody>
        </table>
        <button class="btn btn-success my-4 w-100" onclick="simpanProduk()">Simpan</button>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            tampilItem();
        });

        function tampilItem() {
            let i = 0;
            let kodeProduk = $('#kode-produk').val();
            let hppAktual = 0;

            $.ajax({
                url: '/master/hpp-produk/show/' + kodeProduk,
                type: 'GET',
                success: function(response) {
                    if (response.code == 200) {
                        $('#table-body-data').empty();

                        $.each(response.data_produk_detail, function(index, value) {
                            $('#table-body-data').append(`<tr>` +
                                `<td class="text-center">` + ++i + `.</td>` +
                                `<td>` + value.nama_item + `</td>` +
                                `<td class="text-center">` + value.jumlah_dipakai + `</td>` +
                                `<td class="text-center">` + value.satuan_dipakai + `</td>` +
                                `<td class="text-center">` + value.harga_per_item + `</td>` +
                                `</tr>`);

                            hppAktual += value.harga_per_item;
                        });

                        //Kalkulasi HPP
                        $('#hpp-aktual').val(hppAktual);

                        kalkulasiLaba();
                        kalkulasiHpp();

                        //Mount DataTable
                        $('#table-data').DataTable();

                        //Set Input ReadOnly
                        $('#kode-produk').prop('readonly', true);
                        $('#nama-produk').prop('readonly', true);
                    }
                }
            })
        }

        function tambahItem() {
            $.ajax({
                url: '/master/hpp-produk/store',
                type: 'POST',
                data: {
                    kode: $('#kode-produk').val(),
                    nama: $('#nama-produk').val(),
                    nama_item: $('#nama-item').val(),
                    jumlah_dipakai: $('#jumlah-dipakai').val(),
                    satuan_dipakai: $('#satuan-dipakai').val(),
                    harga_per_item: $('#harga-item-per-unit').val(),
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.code == 200) {
                        tampilItem();
                    }
                }
            });
        }

        function simpanProduk() {
            $.ajax({
                url: '/master/hpp-produk/save',
                type: 'POST',
                data: {
                    kode: $('#kode-produk').val(),
                    nama: $('#nama-produk').val(),
                    hpp: $('#hpp-aktual').val(),
                    harga_jual: $('#harga-jual-aktual').val(),
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.code == 200) {
                        location.reload();
                    }
                }
            });
        }

        function selectItem(id) {
            let variable = $('#' + id).val();

            $.get(`bahan-baku/select-item/` + variable, function(data, status) {
                data.forEach(x => {
                    $('#harga-item').val(x.harga);
                    $('#satuan-per-pack').val(x.satuan_per_pack);
                    $('#jumlah-per-pack').val(x.jumlah_per_pack);

                    kalkulasiHargaPerItem();
                });
            });
        }

        function kalkulasiHpp() {
            $('#target-harga-jual').val(parseInt(100 / parseFloat($('#target-hpp').val()) * parseFloat($('#hpp-aktual')
            .val())));
            $('#harga-jual-aktual').val(parseInt(100 / parseFloat($('#target-hpp').val()) * parseFloat($('#hpp-aktual')
            .val())));
        }

        function kalkulasiHargaPerItem() {
            $('#harga-item-per-unit').val(parseInt(parseInt($('#jumlah-dipakai').val()) / parseInt($('#jumlah-per-pack').val()) *
                parseInt($('#harga-item').val())));
        }

        function kalkulasiLaba() {
            $('#laba-produk').html('Laba Produk : ' + hargaFormat(parseFloat($('#harga-jual-aktual').val()) - parseFloat($(
                '#hpp-aktual').val())));
        }
    </script>
@endsection
