<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable= [
        'jenis_laporan',
        'tanggal',
        'product_id',
        'code_report',
        'harga',
        'keterangan',
        'jumlah_awal',
        'jumlah_jual',
        'jumlah_akhir'
    ];

    public function product()
    {
        return $this->belongsTo('App\Product');
    }
}
