@extends('layout')

@section('main')

<p class="fs-3 fw-bold m-0 text-secondary">Penjualan</p>
<p class="fs-6 m-0 text-secondary">Laporan / <span class="text-dark">Penjualan</span></p>

<div class="pt-4 row">
    <div class="col-12 col-lg-6 p-0 pe-lg-2">
        <div class="card">
            <div class="card-body shadow">
                <p class="fw-bold fs-5 m-0 text-secondary">Laporan Penjualan</p>
                <div class="mt-2">
                    <label for="rentang-tanggal" class="col-form-label">Rentang Tanggal</label>
                    <input type="text" class="form-control" name="rentang-tanggal" id="rentang-tanggal">
                </div>
                {{-- <div class="mt-2">
                    <label for="type-pembayaran" class="col-form-label">Type Pembayaran</label>
                    <select name="type-pembayaran" id="type-pembayaran" class="form-select">
                        @if (count($data_type_pembayaran) > 0)
                            @foreach ($data_type_pembayaran as $data)
                                <option value="{{$data->nama}}">{{$data->nama}}</option>
                            @endforeach
                        @else
                            <option value="">-- Daftar Type Pembayaran Tidak Tersedia --</option>
                        @endif
                    </select>
                </div> --}}
                <button class="btn btn-primary mt-4 w-100" onclick="tampilData()">Tampilkan</button>
            </div>
        </div>
    </div>
</div>
<div class="mt-4 p-0 ps-lg-2 table-responsive">
    <table id="table-data" class="table table-bordered table-striped table-hover">
        <thead class="align-middle text-center text-nowrap">
            <tr>
                <th>No.</th>
                <th>Nama Produk</th>
                <th>Jumlah Produk</th>
                <th>Uang Yang Diterima</th>
            </tr>
        </thead>
        <tbody id="table-body-data" class="align-middle">
        </tbody>
    </table>
</div>
@endsection

@section('script')
<script>
let startDate = "{{$curDate}}";
let endDate = "{{$curDate}}";

    $(function() {
        tampilData();

        $('#rentang-tanggal').daterangepicker({
            opens: 'left'
        }, function(start, end, label) {
            startDate = start.format('YYYY-MM-DD');
            endDate = end.format('YYYY-MM-DD');
        });
    });

    function tampilData() {
        var index = 0;

        $.ajax({
            url: '/laporan/penjualan/show',
            type: 'POST',
            data: {
                start_date: startDate,
                end_date: endDate
                // type_pembayaran: $('#type-pembayaran').val()
            },
            success: function(response) {
                if (response.code == 200) {
                    $('#table-body-data').empty();

                    $.each(response.data_penjualan_produk, function(index, value) {
                        if (index == 0) {
                            let pendapatan = '';

                            $.each(response.data_penjualan_pembayaran, function(index, values) {
                                pendapatan = pendapatan + `<div class="text-start">` + values.jenis_pembayaran + ` : </div><div class="pb-2 text-end">` + hargaFormat(values.jumlah_pembayaran) + `</div>`;
                            });

                            $('#table-body-data').append(`<tr>` +
                                `<td class="text-center">` + ++index + `.</td>` +
                                `<td>` + value.nama_produk + `</td>` +
                                `<td class="text-center">` + value.jumlah + `</td>` +
                                `<td rowspan='` + response.data_penjualan_produk.length + `'>` + 
                                    pendapatan +
                                `</td>` +
                            `</tr>`);
                        } else {
                            $('#table-body-data').append(`<tr>` +
                                `<td class="text-center">` + ++index + `.</td>` +
                                `<td>` + value.nama_produk + `</td>` +
                                `<td class="text-center">` + value.jumlah + `</td>` +
                                `<td class="d-none"></td>` +
                            `</tr>`);
                        }
                    });

                    $('#table-data').DataTable();
                }
            }
        });
    }
</script>
@endsection
