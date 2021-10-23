@extends('layout')

@section('main')

<p class="fs-3 fw-bold m-0 text-secondary">Pembelian</p>
<p class="fs-6 m-0 text-secondary">Laporan / <span class="text-dark">Pembelian</span></p>

<div class="pt-4 row">
    <div class="col-12 col-lg-6 p-0 pe-lg-2">
        <div class="card">
            <div class="card-body shadow">
                <p class="fw-bold fs-5 m-0 text-secondary">Laporan Pembelian</p>
                <div class="mt-2">
                    <label for="rentang-tanggal" class="col-form-label">Rentang Tanggal</label>
                    <input type="text" class="form-control" name="rentang-tanggal" id="rentang-tanggal">
                </div>
                <button class="btn btn-primary mt-4 w-100" onclick="tampilData()">Tampilkan</button>
            </div>
        </div>
    </div>
</div>
<div class="py-4 p-0 ps-lg-2 table-responsive">
    <table id="table-data" class="table table-bordered table-striped table-hover text-nowrap">
        <thead class="align-middle text-center">
            <tr>
                <th>No.</th>
                <th>Nomor Transaksi</th>
                <th>Nama Item</th>
                <th>Harga Item</th>
                <th>Jumlah Item</th>
                <th>Total Harga</th>
                <th>Tanggal Expired</th>
            </tr>
        </thead>
        <tbody id="table-body-data" class="align-middle">
        </tbody>
        <tr>
            <td></td>
            <td class="d-none"></td>
            <td colspan="2" class="fw-bold text-center">Total</td>
            <td id="rekap-harga" class="text-end"></td>
            <td id="rekap-jumlah" class="text-center"></td>
            <td id="rekap-total-harga" class="text-end"></td>
            <td></td>
        </tr>
    </table>
</div>
@endsection

@section('script')
<script>
let startDate = "{{$curDate}}";
let endDate = "{{$curDate}}";

    $(function() {
        $('#table-data').DataTable();

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
            url: '/laporan/pembelian/show',
            type: 'POST',
            data: {
                start_date: startDate,
                end_date: endDate
            },
            success: function(response) {
                if (response.code == 200) {
                    $('#table-data').DataTable().clear();
                    $('#table-data').DataTable().destroy();
                    $('#table-body-data').empty();

                    let harga = 0;
                    let jumlah = 0;
                    let totalHarga = 0;

                    $.each(response.data_pembelian_detail, function(index, value) {
                        $('#table-body-data').append(`<tr>` +
                            `<td class="text-center">` + ++index + `</td>` +
                            `<td class="text-center">` + value.nomor + `</td>` +
                            `<td>` + value.nama_item + `</td>` +
                            `<td class="text-end">` + hargaFormat(value.harga) + `</td>` +
                            `<td class="text-center">` + value.jumlah + `</td>` +
                            `<td class="text-end">` + hargaFormat(value.total_harga) + `</td>` +
                            `<td class="text-center">` + value.tanggal + `</td>` +
                        `</tr>`);

                        harga += value.harga;
                        jumlah += value.jumlah;
                        totalHarga += value.total_harga;
                    });

                    $('#rekap-harga').html(hargaFormat(harga));
                    $('#rekap-jumlah').html(jumlah);
                    $('#rekap-total-harga').html(hargaFormat(totalHarga));

                    $('#table-data').DataTable();
                }
            }
        });
    }
</script>
@endsection
