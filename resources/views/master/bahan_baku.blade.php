@extends('layout')

@section('main')
    <p class="fs-3 fw-bold m-0 text-secondary">Bahan Baku</p>
    <p class="fs-6 m-0 text-secondary">Master / <span class="text-dark">Bahan Baku</span></p>

    <div class="pt-4 row">
        <div class="col-12 col-lg-6 p-0 pe-lg-2">
            <div class="card">
                <div class="card-body shadow">
                    <p class="fw-bold fs-5 m-0 text-secondary">Tambah Data Bahan Baku</p>
                    <div class="mt-2">
                        <label for="kode-item" class="col-form-label">Kode Item</label>
                        <input type="text" id="kode-item" name="kode-item" class="form-control" maxlength="20" required>
                        <label for="nama-item" class="col-form-label">Nama Item</label>
                        <input type="text" id="nama-item" name="nama-item" class="form-control" maxlength="100" required>
                        <div class="row">
                            <div class="col-12 col-lg-4 px-0 pe-lg-2">
                                <label for="jumlah-per-pack" class="col-form-label text-nowrap">Jumlah Per Pack</label>
                                <input type="number" id="jumlah-per-pack" name="jumlah-per-pack" class="form-control"
                                    required>
                            </div>
                            <div class="col-12 col-lg-4 px-0 px-lg-2">
                                <label for="satuan-per-pack" class="col-form-label text-nowrap">Satuan Per Pack</label>
                                <select name="satuan-per-pack" id="satuan-per-pack"
                                    class="selectpicker show-menu-arrow w-100" data-live-search="true" required>
                                    @if (count($data_bahan_baku_satuan) > 0)
                                        @foreach ($data_bahan_baku_satuan as $data)
                                            <option value="{{ $data->nama }}">{{ $data->nama }}</option>
                                        @endforeach
                                    @else
                                        <option value="">-- Data Satuan Tidak Ada --</option>
                                    @endif
                                </select>
                            </div>
                            <div class="col-12 col-lg-4 px-0 ps-lg-2">
                                <label for="stok-minimal" class="col-form-label text-nowrap">Stok Minimal</label>
                                <input type="number" id="stok-minimal" name="stok-minimal" class="form-control" required>
                            </div>
                        </div>
                        <button class="btn btn-success mt-2 w-100" onclick="simpanData()">Simpan</button>
                        <button class="btn btn-danger mt-2 w-100" onclick="clearForm()">Bersihkan</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6 p-0 pt-4 pt-lg-0 ps-lg-2 table-responsive">
            <table id="table-data" class="table table-bordered table-striped table-hover">
                <thead class="align-middle text-center text-nowrap">
                    <tr>
                        <th>No.</th>
                        <th>Kode</th>
                        <th>Nama</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Satuan</th>
                        <th>Stok Minimal</th>
                        <th>Stok</th>
                        <th>Tanggal Expired</th>
                    </tr>
                </thead>
                <tbody class="align-middle">
                    @if (count($data_bahan_baku) > 0)
                        @php
                            $i = 0;
                        @endphp
                        @foreach ($data_bahan_baku as $data)
                            <tr>
                                <td class="text-center">{{ ++$i . '.' }}</td>
                                <td>{{ $data->kode }}</td>
                                <td>{{ $data->nama }}</td>
                                <td class="text-end text-nowrap">Rp. {{ number_format($data->harga, 2, ',', '.') }}</td>
                                <td class="text-center">{{ $data->jumlah_per_pack }}</td>
                                <td class="text-center">{{ $data->satuan_per_pack }}</td>
                                <td class="text-center">{{ $data->stok_minimal }}</td>
                                <td class="text-center">{{ $data->stok }}</td>
                                <td class="text-center">{{ date('d-m-Y', strtotime($data->tanggal_expired)) }}</td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function clearForm() {
            $("#kode-item").val('');
            $("#nama-item").val('');
            $("#jumlah-per-pack").val(0);
            $("#satuan-per-pack").prop("selectedIndex", 0);
            $("#stok-minimal").val(0);
        }

        function simpanData() {
            $.ajax({
                url: '/master/bahan-baku/store',
                type: 'POST',
                data: {
                    kode: $('#kode-item').val(),
                    nama: $('#nama-item').val(),
                    jumlah_per_pack: $('#kode-item').val(),
                    satuan_per_pack: $('#kode-item').val(),
                    stok_minimal: $('#kode-item').val(),
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.code == 200) {
                        location.reload();
                    } else if (response.code == 406) {
                        alert(`{{Session::get('failed')}}`);
                    }
                }
            });
        }
    </script>
@endsection
