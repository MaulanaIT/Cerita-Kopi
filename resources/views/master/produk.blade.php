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
            </tr>
        </thead>
        <tbody class="align-middle">
            @if (count($data_produk) > 0)
                @php
                    $i = 0;
                @endphp
                @foreach($data_produk as $data)
                    @php
                        $hpp = number_format($data->hpp, 2, ',', '.');
                        $harga_jual = number_format($data->harga_jual, 2, ',', '.');
                    @endphp
                    <tr>
                        <td class="text-center">{{++$i}}.</td>
                        <td>{{$data->kode}}</td>
                        <td>{{$data->nama}}</td>
                        <td class="text-end">Rp. {{$hpp}}</td>
                        <td class="text-end">Rp. {{$harga_jual}}</td>
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
            $('#laba-produk').html('Laba Produk : ' + hargaFormat(parseInt($('#harga-jual-aktual').val()) - parseInt($('#hpp-aktual').val())));
        }
    </script>
@endsection