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
                <div class="mt-2">
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
                </div>
                <button class="btn btn-primary mt-4 w-100" onclick="tampilData()">Tampilkan</button>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-6 mt-4 mt-lg-0 p-0 ps-lg-2 table-responsive">
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
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>
                        <p class="fw-bold text-start">Tunai :</p>
                        <p class="text-end">Rp. 0,00</p>
                        <p class="fw-bold text-start">Online :</p>
                        <p class="text-start">Gofood/Gopay :</p>
                        <p class="text-end">Rp. 0,00</p>
                        <p class="text-start">Gopay (QRIS) :</p>
                        <p class="text-end">Rp. 0,00</p>
                        <p class="text-start">OVO/Shopeepay :</p>
                        <p class="text-end">Rp. 0,00</p>
                        <p class="text-start">QRIS (Dana, BRI, BCA) :</p>
                        <p class="text-end">Rp. 0,00</p>
                        <p class="text-start">Debit :</p>
                        <p class="text-end">Rp. 0,00</p>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('script')
<script>
let startDate;
let endDate;

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
                end_date: endDate,
                type_pembayaran: $('#type-pembayaran').val()
            },
            success: function(response) {
                if (response.code == 200) {
                    $('#table-body-data').empty();

                    $.each(response.data_laporan_penjualan, function(index, value) {
                        $('#table-body-data').append(`<tr>` +
                            `<td>` + ++$i + `.</td>` +
                            `<td></td>` +
                            `<td></td>` +
                            `<td></td>` +
                        `</tr>`);
                    });

                    $('#table-data').DataTable();
                }
            }
        });
    }
</script>
@endsection
