<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/css/bootstrap-select.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

    <link rel="stylesheet" href="{{asset('DataTables/datatables.min.css')}}"/>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/js/bootstrap-select.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script src="{{asset('DataTables/datatables.min.js')}}"></script>
</body>

<script>
let base_url = '';
let list = document.querySelectorAll('.list');

$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // for (let i = 0; i < list.length; i++) {
        // if (<?php echo json_encode($page); ?> == "Dashboard")
        //     list[0].className = "active list";
        // else if (<?php echo json_encode($page); ?> == "Bahan Baku")
        //     list[1].className = "active list";
        // else if (<?php echo json_encode($page); ?> == "Persediaan Bahan Baku")
        //     list[2].className = "active list";
        // else if (<?php echo json_encode($page); ?> == "Produk")
        //     list[3].className = "active list";
        // else if (<?php echo json_encode($page); ?> == "HPP Produk")
        //     list[4].className = "active list";
        // else if (<?php echo json_encode($page); ?> == "Pembelian")
        //     list[5].className = "active list";
        // else if (<?php echo json_encode($page); ?> == "Penjualan")
        //     list[6].className = "active list";
        // else if (<?php echo json_encode($page); ?> == "Laporan Pembelian")
        //     list[7].className = "active list";
        // else if (<?php echo json_encode($page); ?> == "Laporan Produk")
        //     list[8].className = "active list";
        // else if (<?php echo json_encode($page); ?> == "Laporan Pembayaran")
        //     list[9].className = "active list";

        // list[i].querySelector('a').onclick = function(event) {
        //     let j = 0;

        //     while (j < list.length) {
        //         list[j++].className = 'list';
        //     }

        //     list[i].className = 'list active';
        // }
    // }
    
    let listTitle = document.querySelectorAll('.list-title');

    if (window.innerWidth < 762) {
        document.getElementById('sidebar').classList.remove('active');
        document.getElementById('toggle').classList.remove('active');
        document.getElementById('content').classList.remove('active');
        document.getElementById('main').classList.remove('active');

        for (let i = 0; i < listTitle.length; i++) {
            listTitle[i].className = "d-none list-title";
        }
    }

    $("#table-data").DataTable();

    $("input[type='number']").val(0);
    $('input[type="number"]').focus(function() {
        if ($(this).val() == 0)
            $(this).val('')
    });
    $('input[type="number"]').focusout(function() {
        if ($(this).val() == '')
            $(this).val(0)
    });
});

window.addEventListener('resize', function() {
    let listTitle = document.querySelectorAll('.list-title');

    if (window.innerWidth < 762) {
        document.getElementById('sidebar').classList.remove('active');
        document.getElementById('toggle').classList.remove('active');
        document.getElementById('content').classList.remove('active');
        document.getElementById('main').classList.remove('active');

        for (let i = 0; i < listTitle.length; i++) {
            listTitle[i].className = "d-none list-title";
        }
    } else {
        document.getElementById('sidebar').classList.add('active');
        document.getElementById('toggle').classList.add('active');
        document.getElementById('content').classList.add('active');
        document.getElementById('main').classList.add('active');

        for (let i = 0; i < listTitle.length; i++) {
            listTitle[i].className = "list-title";
        }
    }
});

function toggleNavigation() {
    let listTitle = document.querySelectorAll('.list-title');

    if (document.getElementById('sidebar').classList.contains('active')) {
        document.getElementById('sidebar').classList.remove('active');
        document.getElementById('toggle').classList.remove('active');
        document.getElementById('content').classList.remove('active');
        document.getElementById('main').classList.remove('active');

        for (let i = 0; i < listTitle.length; i++) {
            listTitle[i].className = "d-none list-title";
        }
    } else {
        document.getElementById('sidebar').classList.add('active');
        document.getElementById('toggle').classList.add('active');
        document.getElementById('content').classList.add('active');
        document.getElementById('main').classList.add('active');

        for (let i = 0; i < listTitle.length; i++) {
            listTitle[i].className = "list-title";
        }
    }
}

function inputNumber(id) {
    document.getElementById(id).value = document.getElementById(id).value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');
}

function hargaFormat(harga) {
    var	reverse = harga.toString().split('').reverse().join('');
	ribuan 	= reverse.match(/\d{1,3}/g);
	ribuan	= ribuan.join('.').split('').reverse().join('');

    return 'Rp. ' + ribuan;
}

function dateFormat(date) {
    let args = date.split('-');
    let year = args[0];
    let month = args[1];
    let day = args[2];

    return day + '-' + month + '-' + year;
}
</script>

@yield('script')

</html>