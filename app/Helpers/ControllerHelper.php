<?php

use App\Models\Master\BahanBakuModel;

function expiredBahanBaku() {
    return BahanBakuModel::all();
}