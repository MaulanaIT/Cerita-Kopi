@extends('layout')

@section('main')
    <p class="fs-3 fw-bold m-0 text-secondary">Pembelian</p>
    <p class="fs-6 m-0 text-secondary">Transaksi / <span class="text-dark">Pembelian</span></p>

    <div class="pt-4 row">
        <div class="col-12 col-lg-6 p-0">
            <div class="card">
                <div class="card-body shadow">
                    <p class="fw-bold fs-5 m-0 text-secondary">Tambah Pembelian</p>
                    <div class="mt-2">
                        <div class="px-0 row">
                            <div class="col-12 col-lg-4 px-0">
                                <label for="tanggal" class="col-form-label">Tanggal</label>
                                <input type="date" id="tanggal" name="tanggal" class="form-control"
                                    value={{ $curDate }}>
                            </div>
                            <div class="ms-auto col-12 col-lg-4 px-0">
                                <label for="nomor-transaksi" class="col-form-label">Nomor Transaksi</label>
                                <input type="text" id="nomor-transaksi" name="nomor-transaksi" class="form-control"
                                    value="{{ $nomor_transaksi }}" readonly required>
                            </div>
                        </div>
                        <label for="nama-item" class="col-form-label">Nama Item</label>
                        <select name="nama-item" id="nama-item" class="form-select" required>
                            @if (count($data_item) > 0)
                                @foreach ($data_item as $data)
                                    <option value="{{ $data->nama }}">{{ $data->nama }}</option>
                                @endforeach
                            @else
                                <option value="">-- Data Item Tidak Ada --</option>
                            @endif
                        </select>
                        <div class="row">
                            <div class="col-12 col-lg-4 px-0 pe-lg-2">
                                <label for="harga-beli" class="col-form-label">Harga Beli</label>
                                <input type="number" id="harga-beli" name="harga-beli" class="form-control"
                                    onchange="kalkulasiTotalHarga()" required>
                            </div>
                            <div class="col-12 col-lg-4 px-0 px-lg-2">
                                <label for="jumlah" class="col-form-label text-nowrap">Jumlah</label>
                                <input type="number" id="jumlah" name="jumlah" class="form-control"
                                    onchange="kalkulasiTotalHarga()" required>
                            </div>
                            <div class="col-12 col-lg-4 px-0 ps-lg-2">
                                <label for="total-harga" class="col-form-label text-nowrap">Total Harga</label>
                                <input type="number" id="total-harga" name="total-harga" class="form-control" readonly
                                    required>
                            </div>
                        </div>
                        <label for="tanggal-expired" class="col-form-label">Tanggal Expired</label>
                        <input type="date" id="tanggal-expired" name="tanggal-expired" class="form-control"
                            min={{ $curDate }} value={{ $curDate }}>
                        <button class="btn btn-primary mt-4 w-100" onclick="tambahData()">Tambah</button>
                        <input class="btn btn-danger mt-2 w-100" value="Bersihkan" onclick="clearForm()">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="py-4 p-0 table-responsive">
        <table id="table-data" class="table table-bordered table-striped table-hover text-nowrap">
            <thead class="align-middle text-center">
                <tr>
                    <th>No.</th>
                    <th>Nama</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Total Harga</th>
                    <th>Tanggal Expired</th>
                    <th>Opsi</th>
                </tr>
            </thead>
            <tbody id="table-body-data" class="align-middle">
            </tbody>
            <tr id="table-total">
                <td></td>
                <td></td>
                <td id="rekap-harga" class="text-end">Rp. 0,00</td>
                <td id="rekap-jumlah" class="text-center">0</td>
                <td id="rekap-total-harga" class="text-end">Rp. 0,00</td>
                <td></td>
                <td></td>
            </tr>
        </table>
        <button class="btn btn-success my-4 w-100" onclick="simpanData()">Simpan</button>
    </div>
@endsection

@section('script')
    <script>
        function clearForm() {
            $("#nama-item").prop("selectedIndex", 0);
            $("#harga-beli").val(0);
            $("#jumlah").val(0);

            kalkulasiTotalHarga();
        }

        function tampilData() {
            let i = 0;
            let nomor = $('#nomor-transaksi').val();
            let totalHarga = 0;

            $.ajax({
                url: '/transaksi/pembelian/show/' + nomor,
                type: 'GET',
                success: function(response) {
                    if (response.code == 200) {
                        $('#table-body-data').empty();

                        let harga = 0;
                        let jumlah = 0;
                        let totalHarga = 0;

                        if (response.data_pembelian_detail.length > 0) {
                            $.each(response.data_pembelian_detail, function(index, value) {
                                $('#table-body-data').append(`<tr>` +
                                    `<td class="text-center">` + ++i + `.</td>` +
                                    `<td>` + value.nama_item + `</td>` +
                                    `<td class="text-end text-nowrap">` + hargaFormat(value.harga) +
                                    `</td>` +
                                    `<td class="text-center">` + value.jumlah + `</td>` +
                                    `<td class="text-end text-nowrap">` + hargaFormat(value
                                        .total_harga) + `</td>` +
                                    `<td class="text-center">` + value.tanggal + `</td>` +
                                    `<td class="text-center"><button class="btn btn-danger" onclick="hapusData('` +
                                    value.nama_item +
                                    `')"><i class="fas fa-trash"></i> Hapus</button></td>` +
                                    `</tr>`);

                                harga += value.harga;
                                jumlah += value.jumlah;
                                totalHarga += value.total_harga;
                            });

                            $('#rekap-harga').html(hargaFormat(harga));
                            $('#rekap-jumlah').html(jumlah);
                            $('#rekap-total-harga').html(hargaFormat(totalHarga));
                        }

                        $('#table-data').DataTable();
                    }
                }
            });
        }

        function tambahData() {
            $.ajax({
                url: '/transaksi/pembelian/store',
                type: 'POST',
                data: {
                    nomor: $('#nomor-transaksi').val(),
                    tanggal: $('#tanggal-expired').val(),
                    nama_item: $('#nama-item').val(),
                    harga: $('#harga-beli').val(),
                    jumlah: $('#jumlah').val(),
                    total_harga: $('#total-harga').val(),
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.code == 200) {
                        clearForm();
                        tampilData();
                    }
                }
            });
        }

        function simpanData() {
            $.ajax({
                url: '/transaksi/pembelian/save',
                type: 'POST',
                data: {
                    nomor: $('#nomor-transaksi').val(),
                    tanggal: $('#tanggal').val(),
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.code == 200) {
                        location.reload();
                    }
                }
            });
        }

        function hapusData(namaItem) {
            $.ajax({
                url: '/transaksi/pembelian/delete',
                type: 'POST',
                data: {
                    nomor: $('#nomor-transaksi').val(),
                    nama_item: namaItem
                },
                success: function(response) {
                    if (response.code == 200) {
                        tampilData();
                    }
                }
            });
        }

        function kalkulasiTotalHarga() {
            $('#total-harga').val(parseInt($('#harga-beli').val()) * parseInt($('#jumlah').val()));
        }
    </script>
@endsection
