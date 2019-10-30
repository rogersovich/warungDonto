<?php

namespace App\Http\Controllers;

use App\Unit;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function getUnits($category_id){

        $results = Unit::where('category_id' , $category_id)
            ->orderBy('name', 'asc')
            ->get();

        return response()->json([
            'results' => $results
        ]);

    }
}
