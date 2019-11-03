<?php

namespace App\Http\Controllers;

use App\Convert;
use App\Product;
use App\Unit;
use App\Category;
use Illuminate\Http\Request;

class ConvertController extends Controller
{

    public function index()
    {
        $converts = Convert::with('Product.Unit.Category')->latest()->paginate(10);


        return view('admin.converts.index')->with(compact('converts'));
    }

    public function create()
    {
        $products = Product::all();
        $units = Unit::all();
        $categories = Category::all();

        return view('admin.converts.add')->with(compact('products','units','categories'));
    }

    public function store(Request $request)
    {

        //dd($request->all());

        $product = Product::where('id', $request->product_id)->first(); // stok 10 bal

        $unit = Unit::where('id', $request->convert_awal)->first();

        $stok = 0;

        if($unit->tingkat == 1){

            if($product->jumlah_awal == 10){
                $satuan_sebelumnya = 10;

                $stok = $request->stok * $satuan_sebelumnya;
            }elseif($product->jumlah_awal == 20){
                $satuan_sebelumnya = 20;

                $stok = $request->stok * $satuan_sebelumnya;
            }

        }

        $satuan_akhir = Unit::where('id', $request->convert_akhir)->first();

        $product_convert = Product::where('unit_id',$satuan_akhir->id)->first(); // stok 20 pack

        if($product_convert == null){
            return redirect()->route('converts.index');
        }

        Product::where(['id' => $product_convert->id])->update([
            'stok' => $product_convert->stok + $stok,
        ]);

        Product::where(['id' => $product->id])->update([
            'stok' => $product->stok - $request->stok,
        ]);

        //dd($product_convert);


        Convert::create([
            'product_id' => $request->product_id,
            'category_id' => $request->category_id,
            'convert_awal' => $unit->name,
            'convert_akhir' => $satuan_akhir->name,
            'stok' => $request->stok
        ]);

        return redirect()->route('converts.index');
    }

    public function edit(Convert $convert)
    {
        //
    }

    public function update(Request $request, Convert $convert)
    {
        //
    }

    public function destroy(Convert $convert)
    {
        //
    }
}
