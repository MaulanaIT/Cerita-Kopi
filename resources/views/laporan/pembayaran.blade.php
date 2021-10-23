@extends('layout')

@section('main')

    <p class="fs-3 fw-bold m-0 text-secondary">Pembayaran</p>
    <p class="fs-6 m-0 text-secondary">Laporan / <span class="text-dark">Pembayaran</span></p>

    <div class="pt-4 row">
        <div class="col-12 col-lg-6 p-0">
            <div class="card">
                <div class="card-body shadow">
                    <p class="fw-bold fs-5 m-0 text-secondary">Laporan Pembayaran</p>
                    <div class="mt-2">
                        <label for="rentang-tanggal" class="col-form-label">Rentang Tanggal</label>
                        <input type="text" class="form-control" name="rentang-tanggal" id="rentang-tanggal">
                    </div>
                    <label for="jenis-pembayaran" class="col-form-label">Jenis Pembayaran</label>
                    <select name="jenis-pembayaran" id="jenis-pembayaran" class="form-select">
                        @if (count($data_jenis_pembayaran) > 0)
                            <option value="all">All</option>
                            @foreach ($data_jenis_pembayaran as $data)
                                <option value="{{$data->nama}}">{{$data->nama}}</option>
                            @endforeach
                        @else
                            <option value="">-- Data Jenis Pembayaran Tidak Ada --</option>
                        @endif
                    </select>
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
                    <th>Jenis Pembayaran</th>
                    <th>Jumlah Pembayaran</th>
                    <th>Jenis Kartu</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody id="table-body-data" class="align-middle">
            </tbody>
            <tr>
                <td></td>
                <td class="fw-bold text-center">Total</td>
                <td id="rekap-jumlah" class="text-end"></td>
                <td colspan="2"></td>
                <td class="d-none"></td>
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
                url: '/laporan/pembayaran/show',
                type: 'POST',
                data: {
                    start_date: startDate,
                    end_date: endDate,
                    jenis_pembayaran: $('#jenis-pembayaran').val()
                },
                success: function(response) {
                    if (response.code == 200) {
                        $('#table-data').DataTable().clear();
                        $('#table-data').DataTable().destroy();
                        $('#table-body-data').empty();

                        let jumlah = 0;

                        $.each(response.data_penjualan_pembayaran, function(index, value) {
                            $('#table-body-data').append(`<tr>` +
                                `<td class="text-center">` + ++index + `.</td>` +
                                `<td class="text-center">` + value.jenis_pembayaran + `</td>` +
                                `<td class="text-end">` + hargaFormat(value.jumlah_pembayaran) + `</td>` +
                                `<td class="text-center">` + value.jenis_kartu + `</td>` +
                                `<td class="text-center">` + value.tanggal + `</td>` +
                            `</tr>`);

                            jumlah += value.jumlah_pembayaran;
                        });

                        $('#rekap-jumlah').html(hargaFormat(jumlah));

                        $('#table-data').DataTable({
                            dom: 'Bfrtip',
                            buttons: [
                                {extend: 'excel', className: 'btn btn-success'}
                            ]
                        });
                    }
                }
            });
        }
    </script>
@endsection
