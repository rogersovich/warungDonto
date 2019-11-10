<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable= [
        'code',
        'tanggal',
        'total_harga',
        'total_bayar',
        'kembalian',
    ];
}
