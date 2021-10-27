<?php

use App\Models\Master\BahanBakuModel;

function expiredBahanBaku() {
    return BahanBakuModel::where('tanggal_expired', '<=', 'CURDATE() + INTERVAL 3 DAY')->get();
}