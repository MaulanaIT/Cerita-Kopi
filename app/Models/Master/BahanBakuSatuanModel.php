<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BahanBakuSatuanModel extends Model
{
    use HasFactory;

    protected $table = 'bahan_baku_satuan';

    protected $fillable = [
        'nama'
    ];
}
