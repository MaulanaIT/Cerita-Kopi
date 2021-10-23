@extends('layout')

@section('main')
    <p class="fs-3 fw-bold m-0 text-secondary">Dashboard</p>
    <p class="fs-6 m-0 text-secondary">Dashboard / <span class="text-dark">Dashboard</span></p>

    <div class="pt-4 row">
        <div class="card">
            <div class="card-body px-0 row">
                <div class="col-lg-6 pe-0 pe-lg-2">
                    <h6 style="text-align: center;">Penjualan Tahun {{ $year }}</h6>
                    <canvas id="chartPenjualan"></canvas>
                </div>
                <div class="col-lg-6 px-0 px-lg-2 pt-4 pt-lg-0">
                    <h6 style="text-align: center;">Pembelian Tahun {{ $year }}</h6>
                    <canvas id="chartPembelian"></canvas>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        var ctxPenjualan = document.getElementById('chartPenjualan').getContext('2d');
        var chartPenjualan = new Chart(ctxPenjualan, {
            type: 'bar',
            data: {
                labels: {!! json_encode($chartPenjualan->labels) !!},
                datasets: [{
                    label: 'Penjualan',
                    data: {!! json_encode($chartPenjualan->dataset) !!},
                    backgroundColor: {!! json_encode($chartPenjualan->colours) !!},
                    borderColor: {!! json_encode($chartPenjualan->borders) !!},
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });

        var ctxPembelian = document.getElementById('chartPembelian').getContext('2d');
        var chartPembelian = new Chart(ctxPembelian, {
            type: 'bar',
            data: {
                labels: {!! json_encode($chartPembelian->labels) !!},
                datasets: [{
                    label: 'Pembelian',
                    data: {!! json_encode($chartPembelian->dataset) !!},
                    backgroundColor: {!! json_encode($chartPembelian->colours) !!},
                    borderColor: {!! json_encode($chartPembelian->borders) !!},
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>
@endsection
