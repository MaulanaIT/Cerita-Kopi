@extends('layout')

@section('main')
<p class="fs-3 fw-bold m-0 text-secondary">Persediaan Bahan Baku</p>
<p class="fs-6 m-0 text-secondary">Master / <span class="text-dark">Persediaan Bahan Baku</span></p>

<div class="pt-4">
    <div class="table-responsive">
        <table id="table-data" class="table table-bordered table-striped table-hover w-100">
            <thead class="align-middle text-center text-nowrap">
                <tr>
                    <th>No.</th>
                    <th>Kode</th>
                    <th>Nama</th>
                    <th>Harga</th>
                    <th>Jumlah Per Pack</th>
                    <th>Satuan Per Pack</th>
                    <th>Stok Minimal</th>
                    <th>Stok Sesungguhnya</th>
                    <th>Tanggal Expired</th>
                    <th>Opsi</th>
                </tr>
            </thead>
            <tbody class="align-middle">
                @if (count($data_bahan_baku) > 0)
                    @php
                        $i = 0;
                    @endphp
                    @foreach ($data_bahan_baku as $data)
                        <tr>
                            <form>
                                <td class="text-center">{{++$i}}.</td>
                                <td>{{$data->kode}}</td>
                                <td class="text-nowrap">{{$data->nama}}</td>
                                <td class="text-center">
                                    <div id="harga-{{$data->kode}}">{{$data->harga}}</div>
                                    <input type="text" id="edit-harga-{{$data->kode}}" name="edit-harga-{{$data->kode}}" class="d-none form-control text-center" value="{{$data->harga}}" oninput="inputNumber(this.id)" required>
                                </td>
                                <td class="text-center">
                                    <div id="jumlah-per-pack-{{$data->kode}}">{{$data->jumlah_per_pack}}</div>
                                    <input type="text" id="edit-jumlah-per-pack-{{$data->kode}}" name="edit-jumlah-per-pack-{{$data->kode}}" class="d-none form-control text-center" value="{{$data->jumlah_per_pack}}" oninput="inputNumber(this.id)" required>
                                </td>
                                <td class="text-center">
                                    <div id="satuan-per-pack-{{$data->kode}}">{{$data->satuan_per_pack}}</div>
                                    <select name="edit-satuan-per-pack-{{$data->kode}}" id="edit-satuan-per-pack-{{$data->kode}}" class="d-none form-select">
                                        @foreach ($data_bahan_baku_satuan as $item)
                                            @if ($item->nama == $data->satuan_per_pack)
                                                <option value="{{$item->nama}}" selected>{{$item->nama}}</option>
                                            @else
                                                <option value="{{$item->nama}}">{{$item->nama}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </td>
                                <td class="text-center">
                                    <div id="stok-minimal-{{$data->kode}}">{{$data->stok_minimal}}</div>
                                    <input type="text" id="edit-stok-minimal-{{$data->kode}}" name="edit-stok-minimal-{{$data->kode}}" class="d-none form-control text-center" value="{{$data->stok_minimal}}" oninput="inputNumber(this.id)" required>
                                </td>
                                <td class="text-center">
                                    <div id="stok-{{$data->kode}}">{{$data->stok}}</div>
                                    <input type="text" id="edit-stok-{{$data->kode}}" name="edit-stok-{{$data->kode}}" class="d-none form-control text-center" value="{{$data->stok}}" oninput="inputNumber(this.id)" required>
                                </td>
                                <td class="text-center">
                                    <div id="tanggal-expired-{{$data->kode}}">{{date('d-m-Y', strtotime($data->tanggal_expired))}}</div>
                                    <input type="date" id="edit-tanggal-expired-{{$data->kode}}" name="edit-tanggal-expired-{{$data->kode}}" class="d-none form-control text-center" value="{{date('Y-m-d', strtotime($data->tanggal_expired))}}" required>
                                </td>
                                <td class="text-center text-nowrap">
                                    <button id="terapkan-{{$data->kode}}" class="btn btn-success d-none px-3" onclick="terapkanData('{{$data->kode}}')"><i class="fas fa-check"></i>&ensp;Terapkan</button>
                                    <a id="ubah-{{$data->kode}}" class="btn btn-warning px-3" onclick="ubahData('{{$data->kode}}')"><i class="fas fa-edit"></i>&ensp;Ubah</a>
                                    <a id="hapus-{{$data->kode}}" class="btn btn-danger px-3" onclick="hapusData('{{$data->kode}}')"><i class="fas fa-trash"></i>&ensp;Hapus</a>
                                </td>
                            </form>
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
        function ubahData(kodeItem) {
            $('#harga-' + kodeItem).addClass('d-none');
            $('#jumlah-per-pack-' + kodeItem).addClass('d-none');
            $('#satuan-per-pack-' + kodeItem).addClass('d-none');
            $('#stok-minimal-' + kodeItem).addClass('d-none');
            $('#stok-' + kodeItem).addClass('d-none');
            $('#tanggal-expired-' + kodeItem).addClass('d-none');

            $('#edit-harga-' + kodeItem).removeClass('d-none');
            $('#edit-jumlah-per-pack-' + kodeItem).removeClass('d-none');
            $('#edit-satuan-per-pack-' + kodeItem).removeClass('d-none');
            $('#edit-stok-minimal-' + kodeItem).removeClass('d-none');
            $('#edit-stok-' + kodeItem).removeClass('d-none');
            $('#edit-tanggal-expired-' + kodeItem).removeClass('d-none');

            $('#ubah-' + kodeItem).addClass('d-none');
            $('#terapkan-' + kodeItem).removeClass('d-none');
        }

        function terapkanData(kodeItem) {
            $.ajax({
                url: '/master/persediaan-bahan-baku/update/',
                type: 'POST',
                data: {
                    kode: kodeItem,
                    harga: $('#edit-harga-' + kodeItem).val(),
                    jumlah_per_pack: $('#edit-jumlah-per-pack-' + kodeItem).val(),
                    satuan_per_pack: $('#edit-satuan-per-pack-' + kodeItem).val(),
                    stok_minimal: $('#edit-stok-minimal-' + kodeItem).val(),
                    stok: $('#edit-stok-' + kodeItem).val(),
                    tanggal_expired: $('#edit-tanggal-expired-' + kodeItem).val()
                },
                success: function(response) {
                    if (response.code == 200) {
                        $('#stok-minimal-' + kodeItem).html($('#edit-stok-minimal-' + kodeItem).val());
                        $('#stok-' + kodeItem).html($('#edit-stok-' + kodeItem).val());
                        $('#tanggal-expired-' + kodeItem).html(dateFormat($('#edit-tanggal-expired-' + kodeItem).val()));


                        $('#edit-harga-' + kodeItem).addClass('d-none');
                        $('#edit-jumlah-per-pack-' + kodeItem).addClass('d-none');
                        $('#edit-satuan-per-pack-' + kodeItem).addClass('d-none');
                        $('#edit-stok-minimal-' + kodeItem).addClass('d-none');
                        $('#edit-stok-' + kodeItem).addClass('d-none');
                        $('#edit-tanggal-expired-' + kodeItem).addClass('d-none');

                        $('#harga-' + kodeItem).removeClass('d-none');
                        $('#jumlah-per-pack-' + kodeItem).removeClass('d-none');
                        $('#satuan-per-pack-' + kodeItem).removeClass('d-none');
                        $('#stok-minimal-' + kodeItem).removeClass('d-none');
                        $('#stok-' + kodeItem).removeClass('d-none');
                        $('#tanggal-expired-' + kodeItem).removeClass('d-none');

                        $('#ubah-' + kodeItem).removeClass('d-none');
                        $('#terapkan-' + kodeItem).addClass('d-none');
                    }
                }
            })
        }

        function hapusData(kodeItem) {
            $.ajax({
                url: '/master/persediaan-bahan-baku/delete/' + kodeItem,
                type: 'POST',
                success: function(response) {
                    if (response.code == 200) {
                        location.reload();
                    }
                }
            })
        }
    </script>
@endsection