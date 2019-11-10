<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable= [
        'order_id',
        'jenis_laporan',
        'code_report',
        'tanggal',
    ];

    public function order()
    {
        return $this->belongsTo('App\Order');
    }
}
