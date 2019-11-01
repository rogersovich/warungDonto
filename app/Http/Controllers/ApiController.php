<?php

namespace App\Http\Controllers;

use App\Category;
use App\Unit;
use App\Product;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function getConvert($id){

        $unit = Unit::where('id' , $id)
            ->first();

        //dd($unit);

        $results = Unit::where('id','<>', $id)
            ->where('category_id', $unit->category_id)
            ->get();

        return response()->json([
            'results' => $results
        ]);

    }

    public function getUnits($id){

        $results = Unit::where('category_id' , $id)
            ->orderBy('name', 'asc')
            ->get();

        return response()->json([
            'results' => $results
        ]);

    }

    public function handleConvert($id){

        $results = Product::with('Unit.Category')
            ->where('id' , $id)
            ->orderBy('id', 'asc')
            ->get();

        return response()->json([
            'results' => $results
        ]);

    }
}
