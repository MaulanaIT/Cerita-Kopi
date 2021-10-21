@extends('layout')

@section('main')

    <p class="fs-3 fw-bold m-0 text-secondary">Produk</p>
    <p class="fs-6 m-0 text-secondary">Laporan / <span class="text-dark">Produk</span></p>

    <div class="pt-4 row">
        <div class="col-12 col-lg-6 p-0">
            <div class="card">
                <div class="card-body shadow">
                    <p class="fw-bold fs-5 m-0 text-secondary">Laporan Produk</p>
                    <div class="mt-2">
                        <label for="rentang-tanggal" class="col-form-label">Rentang Tanggal</label>
                        <input type="text" class="form-control" name="rentang-tanggal" id="rentang-tanggal">
                    </div>
                    <button class="btn btn-primary mt-4 w-100" onclick="tampilData()">Tampilkan</button>
                </div>
            </div>
        </div>
    </div>
    <div class="py-4 p-0 table-responsive">
        <table id="table-data" class="table table-bordered table-striped table-hover">
            <thead class="align-middle text-center text-nowrap">
                <tr>
                    <th>No.</th>
                    <th>Nama Produk</th>
                    <th>HPP</th>
                    <th>Harga Jual</th>
                    <th>Jumlah Produk</th>
                    <th>Total Harga</th>
                    <th>Laba</th>
                </tr>
            </thead>
            <tbody id="table-body-data" class="align-middle">
            </tbody>
            <tr>
                <td></td>
                <td class="fw-bold text-center">Total</td>
                <td id="rekap-hpp" class="text-end"></td>
                <td id="rekap-harga" class="text-end"></td>
                <td></td>
                <td id="rekap-total-harga" class="text-end"></td>
                <td id="rekap-laba" class="text-end"></td>
            </tr>
        </table>
    </div>
@endsection

@section('script')
    <script>
        let startDate = "{{ $curDate }}";
        let endDate = "{{ $curDate }}";

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
                url: '/laporan/produk/show',
                type: 'POST',
                data: {
                    start_date: startDate,
                    end_date: endDate
                },
                success: function(response) {
                    if (response.code == 200) {
                        $('#table-body-data').empty();

                        let hpp = 0;
                        let harga = 0;
                        let totalHarga = 0;
                        let totalLaba = 0;

                        $.each(response.data_penjualan_produk, function(index, value) {
                            $('#table-body-data').append(`<tr>` +
                                `<td class="text-center">` + ++index + `.</td>` +
                                `<td>` + value.nama_produk + `</td>` +
                                `<td class="text-end">` + hargaFormat(value.hpp) + `</td>` +
                                `<td class="text-end">` + hargaFormat(value.harga) + `</td>` +
                                `<td class="text-center">` + value.jumlah + `</td>` +
                                `<td class="text-end">` + hargaFormat(value.total_harga) + `</td>` +
                                `<td class="text-end">` + hargaFormat(value.laba) + `</td>` +
                            `</tr>`);

                            hpp += value.hpp;
                            harga += value.harga;
                            totalHarga += value.harga * value.jumlah;
                            totalLaba += value.laba;
                        });

                        $('#rekap-hpp').html(hargaFormat(hpp));
                        $('#rekap-harga').html(hargaFormat(harga));
                        $('#rekap-total-harga').html(hargaFormat(totalHarga));
                        $('#rekap-laba').html(hargaFormat(totalLaba));

                        $('#table-data').DataTable();
                    }
                }
            });
        }
    </script>
@endsection
