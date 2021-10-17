@extends('layout')

@section('main')
<p class="fs-3 fw-bold m-0 text-secondary">Dashboard</p>
<p class="fs-6 m-0 text-secondary">Dashboard / <span class="text-dark">Dashboard</span></p>

<div class="pt-4 row">
        <div class="card">
            <div class="card-body shadow">
                <canvas id="chart-pendapatan" height="300px" width="300px"></canvas>
            </div>
        </div>
</div>
@endsection

@section('script')
    <script>
        var year = 2021;
        var user = "Pendapatan";
        var barChartData = {
            labels: year,
            datasets: [{
                label: 'User',
                backgroundColor: "pink",
                data: user
            }]
        };

        window.onload = function() {
            var ctx = document.getElementById("chart-pendapatan").getContext("2d");
            window.myBar = new Chart(ctx, {
                type: 'bar',
                data: barChartData,
                options: {
                    elements: {
                        rectangle: {
                            borderWidth: 2,
                            borderColor: '#c1c1c1',
                            borderSkipped: 'bottom'
                        }
                    },
                    responsive: true,
                    title: {
                        display: true,
                        text: 'Yearly User Joined'
                    }
                }
            });
        };
    </script>
@endsection