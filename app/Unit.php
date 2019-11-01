<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $fillable= [
        'name',
        'category_id',
        'code_category',
    ];

    public function category()
    {
        return $this->belongsTo('App\Category');
    }
}
