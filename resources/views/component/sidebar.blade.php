<div id="sidebar" class="active cerita-kopi-color h-100 navigation position-fixed" style="z-index: 2;">
    <div class="align-items-center cerita-kopi-logo py-3 px-2 position-relative">
        <img src="{{ asset('image/Logo.png') }}" alt="Logo Cerita Kopi" height="48px">
        <span class="col-form-label ps-3 position-absolute">
            <img src="{{ asset('image/Title.png') }}" alt="Logo Cerita Kopi" height="36px">
        </span>
    </div>
    <div class="overflow-auto ps-3">
        <ul>
            <div class="list-title">Dashboard</div>
            <li class="list">
                <a href="/dashboard" class="col fw-bold text-decoration-none text-white">
                    <i class="icon fas fa-boxes text-white"></i>
                    <span class="title">Dashboard</span>
                </a>
            </li>
            @if (auth()->user()->role == 'Owner')
                <div class="list-title">Master</div>
                <li class="list">
                    <a href="/master/user" class="col fw-bold text-decoration-none text-white">
                        <i class="icon fas fa-user text-white"></i>
                        <span class="title">User</span>
                    </a>
                </li>
                <li class="list">
                    <a href="/master/bahan-baku" class="col fw-bold text-decoration-none text-white">
                        <i class="icon fas fa-box-open text-white"></i>
                        <span class="title">Bahan Baku</span>
                    </a>
                </li>
                <li class="list">
                    <a href="/master/persediaan-bahan-baku" class="col fw-bold text-decoration-none text-white">
                        <i class="icon fas fa-cubes">
                            @php
                                $totalNotif = 0;
                            @endphp
                            @foreach ($expired as $data)
                                @php
                                    $timeExpired = (strtotime($data->tanggal_expired) - strtotime(date('d-m-Y'))) / 216000;
                                    
                                    if ($timeExpired <= 3) {
                                        $totalNotif++;
                                    }
                                @endphp
                            @endforeach
                            @if ($totalNotif > 99)
                                <div class="align-items-center bg-danger justify-content-center position-absolute row text-center text-size-2"
                                    style="border-radius: 50%; color: white !important; height: 20px; width: 20px;">
                                    99
                                </div>
                            @endif
                        </i>
                        <span class="title">Persediaan Bahan Baku</span>
                    </a>
                </li>
                <li class="list">
                    <a href="/master/produk" class="col fw-bold text-decoration-none text-white">
                        <i class="icon fas fa-dolly-flatbed text-white"></i>
                        <span class="title">Produk</span>
                    </a>
                </li>
                <li class="list">
                    <a href="/master/hpp-produk" class="col fw-bold text-decoration-none text-white">
                        <i class="icon fas fa-clipboard-list text-white"></i>
                        <span class="title">HPP Produk</span>
                    </a>
                </li>
                <div class="list-title">Transaksi</div>
                <li class="list">
                    <a href="/transaksi/pembelian" class="col fw-bold text-decoration-none text-white">
                        <i class="icon fas fa-shopping-cart text-white"></i>
                        <span class="title">Pembelian</span>
                    </a>
                </li>
                <li class="list">
                    <a href="/transaksi/penjualan" class="col fw-bold text-decoration-none text-white">
                        <i class="icon fas fa-hand-holding-usd text-white"></i>
                        <span class="title">Penjualan</span>
                    </a>
                </li>
                <div class="list-title">Laporan</div>
                <li class="list">
                    <a href="/laporan/pembelian" class="col fw-bold text-decoration-none text-white">
                        <i class="icon fas fa-receipt text-white"></i>
                        <span class="title">Pembelian</span>
                    </a>
                </li>
                <li class="list">
                    <a href="/laporan/produk" class="col fw-bold text-decoration-none text-white">
                        <i class="icon fas fa-file-invoice-dollar text-white"></i>
                        <span class="title">Penjualan Produk</span>
                    </a>
                </li>
                <li class="list">
                    <a href="/laporan/pembayaran" class="col fw-bold text-decoration-none text-white">
                        <i class="icon fas fa-coins text-white"></i>
                        <span class="title">Pembayaran</span>
                    </a>
                </li>
            @elseif (auth()->user()->role == "Gudang")
                <div class="list-title">Master</div>
                <li class="list">
                    <a href="/master/bahan-baku" class="col fw-bold text-decoration-none text-white">
                        <i class="icon fas fa-box-open text-white"></i>
                        <span class="title">Bahan Baku</span>
                    </a>
                </li>
                <li class="list">
                    <a href="/master/persediaan-bahan-baku" class="col fw-bold text-decoration-none text-white">
                        <i class="icon fas fa-cubes">
                            @php
                                $totalNotif = 0;
                            @endphp
                            @foreach ($expired as $data)
                                @php
                                    $timeExpired = (strtotime($data->tanggal_expired) - strtotime(date('d-m-Y'))) / 216000;
                                    
                                    if ($timeExpired <= 3) {
                                        $totalNotif++;
                                    }
                                @endphp
                            @endforeach
                            @if ($totalNotif > 99)
                                <div class="align-items-center bg-danger justify-content-center position-absolute row text-center text-size-2"
                                    style="border-radius: 50%; color: white !important; height: 20px; width: 20px;">
                                    99
                                </div>
                            @endif
                        </i>
                        <span class="title">Persediaan Bahan Baku</span>
                    </a>
                </li>
                <div class="list-title">Transaksi</div>
                <li class="list">
                    <a href="/transaksi/pembelian" class="col fw-bold text-decoration-none text-white">
                        <i class="icon fas fa-shopping-cart text-white"></i>
                        <span class="title">Pembelian</span>
                    </a>
                </li>
            @elseif (auth()->user()->role == "Kasir")
                <div class="list-title">Master</div>
                <li class="list">
                    <a href="/master/produk" class="col fw-bold text-decoration-none text-white">
                        <i class="icon fas fa-dolly-flatbed text-white"></i>
                        <span class="title">Produk</span>
                    </a>
                </li>
                <li class="list">
                    <a href="/master/hpp-produk" class="col fw-bold text-decoration-none text-white">
                        <i class="icon fas fa-clipboard-list text-white"></i>
                        <span class="title">HPP Produk</span>
                    </a>
                </li>
                <div class="list-title">Transaksi</div>
                <li class="list">
                    <a href="/transaksi/penjualan" class="col fw-bold text-decoration-none text-white">
                        <i class="icon fas fa-hand-holding-usd text-white"></i>
                        <span class="title">Penjualan</span>
                    </a>
                </li>
            @endif
        </ul>
    </div>
</div>
