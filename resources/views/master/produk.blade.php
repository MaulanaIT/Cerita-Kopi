@extends('layout')

@section('main')
    <p class="fs-3 fw-bold m-0 text-secondary">Produk</p>
    <p class="fs-6 m-0 text-secondary">Master / <span class="text-dark">Produk</span></p>

    <div class="p-0 pt-4 table-responsive">
        <table id="table-data" class="table table-bordered table-striped table-hover">
            <thead class="align-middle text-center text-nowrap">
                <tr>
                    <th>No.</th>
                    <th>Kode</th>
                    <th>Nama</th>
                    <th>HPP</th>
                    <th>Harga Jual</th>
                    <th>Opsi</th>
                </tr>
            </thead>
            <tbody class="align-middle">
                @if (count($data_produk) > 0)
                    @php
                        $i = 0;
                    @endphp
                    @foreach ($data_produk as $data)
                        @php
                            $hpp = number_format($data->hpp, 2, ',', '.');
                            $harga_jual = number_format($data->harga_jual, 2, ',', '.');
                        @endphp
                        <tr>
                            <td class="text-center">{{ ++$i }}.</td>
                            <td>{{ $data->kode }}</td>
                            <td>
                                <div id="nama-produk-{{ $data->kode }}">{{ $data->nama }}</div>
                                <input type="text" id="edit-nama-produk-{{ $data->kode }}"
                                    name="edit-nama-produk-{{ $data->kode }}" class="d-none form-control"
                                    value={{ $data->nama }}>
                            </td>
                            <td class="text-end">
                                <div id="hpp-{{ $data->kode }}">Rp. {{ $hpp }}</div>
                                <input type="text" id="edit-hpp-{{ $data->kode }}" name="edit-hpp-{{ $data->kode }}"
                                    class="d-none form-control" value={{ $data->hpp }}>
                            </td>
                            <td class="text-end">
                                <div id="harga-jual-{{ $data->kode }}">Rp. {{ $harga_jual }}</div>
                                <input type="text" id="edit-harga-jual-{{ $data->kode }}"
                                    name="edit-harga-jual-{{ $data->kode }}" class="d-none form-control"
                                    value={{ $data->harga_jual }}>
                            </td>
                            <td class="text-center text-nowrap">
                                <button id="terapkan-{{ $data->kode }}" class="btn btn-success d-none px-3"
                                    onclick="terapkanData('{{ $data->kode }}')"><i
                                        class="fas fa-check"></i>&ensp;Terapkan</button>
                                <a id="ubah-{{ $data->kode }}" class="btn btn-warning px-3"
                                    onclick="ubahData('{{ $data->kode }}')"><i class="fas fa-edit"></i>&ensp;Ubah</a>
                                <a id="hapus-{{ $data->kode }}" class="btn btn-danger px-3"
                                    onclick="hapusData('{{ $data->kode }}')"><i
                                        class="fas fa-trash"></i>&ensp;Hapus</a>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
@endsection

@section('script')
    <script>
        function kalkulasiLaba() {
            $('#laba-produk').html('Laba Produk : ' + hargaFormat(parseInt($('#harga-jual-aktual').val()) - parseInt($(
                '#hpp-aktual').val())));
        }

        function ubahData(kodeItem) {
            $('#nama-produk-' + kodeItem).addClass('d-none');
            $('#hpp-' + kodeItem).addClass('d-none');
            $('#harga-jual-' + kodeItem).addClass('d-none');

            $('#edit-nama-produk-' + kodeItem).removeClass('d-none');
            $('#edit-hpp-' + kodeItem).removeClass('d-none');
            $('#edit-harga-jual-' + kodeItem).removeClass('d-none');

            $('#ubah-' + kodeItem).addClass('d-none');
            $('#terapkan-' + kodeItem).removeClass('d-none');
        }

        function terapkanData(kodeItem) {
            $.ajax({
                url: '/master/produk/update/',
                type: 'POST',
                data: {
                    kode: kodeItem,
                    nama: $('#edit-nama-produk-' + kodeItem).val(),
                    hpp: $('#edit-hpp-' + kodeItem).val(),
                    harga_jual: $('#edit-harga-jual-' + kodeItem).val()
                },
                success: function(response) {
                    if (response.code == 200) {
                        $('#nama-produk-' + kodeItem).html($('#edit-nama-produk-' + kodeItem).val());
                        $('#hpp-' + kodeItem).html(hargaFormat($('#edit-hpp-' + kodeItem).val()));
                        $('#harga-jual-' + kodeItem).html(hargaFormat($('#edit-harga-jual-' + kodeItem).val()));

                        $('#edit-nama-produk-' + kodeItem).addClass('d-none');
                        $('#edit-hpp-' + kodeItem).addClass('d-none');
                        $('#edit-harga-jual-' + kodeItem).addClass('d-none');

                        $('#nama-produk-' + kodeItem).removeClass('d-none');
                        $('#hpp-' + kodeItem).removeClass('d-none');
                        $('#harga-jual-' + kodeItem).removeClass('d-none');

                        $('#ubah-' + kodeItem).removeClass('d-none');
                        $('#terapkan-' + kodeItem).addClass('d-none');
                    }
                }
            })
        }

        function hapusData(kodeItem) {
            $.ajax({
                url: '/master/produk/delete/' + kodeItem,
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
