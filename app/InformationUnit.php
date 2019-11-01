<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InformationUnit extends Model
{
    protected $fillable= [
        'category_id',
        'jumlah_awal',
        'satuan_awal',
        'jumlah_akhir',
        'satuan_akhir',
    ];
}
