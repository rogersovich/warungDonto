<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable= [
        'name',
        'category_id',
        'unit_id',
        'code_item',
        'harga_beli',
        'stok',
        'jumlah_awal',
    ];

    public function unit()
    {
        return $this->belongsTo('App\Unit');
    }

}
