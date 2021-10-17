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
                                <td>{{$data->nama}}</td>
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
        function clearForm() {
            $("#kode-item").val('');
            $("#nama-item").val('');
            $("#stok-minimal").val(0);
            $("#stok-sesungguhnya").val(0);
            $("#tanggal-expired").val('');
        }

        function ubahData(kodeItem) {
            $('#stok-minimal-' + kodeItem).addClass('d-none');
            $('#stok-' + kodeItem).addClass('d-none');
            $('#tanggal-expired-' + kodeItem).addClass('d-none');

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
                    stok_minimal: $('#edit-stok-minimal-' + kodeItem).val(),
                    stok: $('#edit-stok-' + kodeItem).val(),
                    tanggal_expired: $('#edit-tanggal-expired-' + kodeItem).val()
                },
                success: function(response) {
                    if (response.code == 200) {
                        $('#stok-minimal-' + kodeItem).html($('#edit-stok-minimal-' + kodeItem).val());
                        $('#stok-' + kodeItem).html($('#edit-stok-' + kodeItem).val());
                        $('#tanggal-expired-' + kodeItem).html(dateFormat($('#edit-tanggal-expired-' + kodeItem).val()));

                        $('#edit-stok-minimal-' + kodeItem).addClass('d-none');
                        $('#edit-stok-' + kodeItem).addClass('d-none');
                        $('#edit-tanggal-expired-' + kodeItem).addClass('d-none');

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