<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css">
    <link rel="stylesheet" href="{{asset('css/sidebar.css')}}">
    <link rel="stylesheet" href="{{asset('css/header.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">

    @yield('css')

    <title>{{$title}}</title>

    <style>
    .row {
        margin: 0 !important;
    }
    </style>
</head>

<body style="height: 100vh;">
    <div class="h-100 row">
        @include('component.sidebar')
        <div class="col d-flex flex-column h-100 px-0">
            @include('component.header')
            <div id="content" class="justify-content-end overflow-auto pb-0 pt-4 px-4 row" style="flex: 1;">
                <div id="main" class="active">
                    @yield('main')
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
</body>

<script>
let list = document.querySelectorAll('.list');

$(document).ready(function() {
    for (let i = 0; i < list.length; i++) {
        if (<?php echo json_encode($page); ?> == "Dashboard")
            list[0].className = "active list";
        else if (<?php echo json_encode($page); ?> == "Bahan Baku")
            list[1].className = "active list";
        else if (<?php echo json_encode($page); ?> == "Produk")
            list[2].className = "active list";
        else if (<?php echo json_encode($page); ?> == "Pembelian")
            list[3].className = "active list";
        else if (<?php echo json_encode($page); ?> == "Penjualan")
            list[4].className = "active list";

        list[i].onclick = function(event) {
            let j = 0;

            while (j < list.length) {
                list[j++].className = 'list';
            }

            list[i].className = 'list active';
        }
    }
    
    $('.list > a').onclick(function() {
        alert('Success');
    })
});

function toggleNavigation() {
    if (document.getElementById('sidebar').classList.contains('active')) {
        document.getElementById('sidebar').classList.remove('active');
        document.getElementById('toggle').classList.remove('active');
        document.getElementById('content').classList.remove('active');
        document.getElementById('main').classList.remove('active');
    } else {
        document.getElementById('sidebar').classList.add('active');
        document.getElementById('toggle').classList.add('active');
        document.getElementById('content').classList.add('active');
        document.getElementById('main').classList.add('active');
    }
}
</script>

@yield('script')

</html>