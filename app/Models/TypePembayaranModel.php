<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypePembayaranModel extends Model
{
    use HasFactory;

    protected $table = 'type_pembayaran';

    protected $fillable = [
        'nama'
    ];
}
