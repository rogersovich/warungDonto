<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use App\Unit;
use App\Supplier;
use App\InformationUnit;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index()
    {
        $products = Product::with('Unit.Category')->latest()->paginate(25);

        return view('admin.products.index')->with(compact('products'));
    }

    public function create()
    {
        $products = Product::all();
        $units = Unit::all();
        $categories = Category::all();
        $informations = InformationUnit::all();

        return view('admin.products.add')->with(compact('products','units','categories','informations'));
    }


    public function store(Request $request)
    {

        $kdBarang = Product::select(['code_item'])->max('code_item');

        $noUrut = (int) substr($kdBarang, 5, 3);

        $noUrut++;
        $char = "BR";
        $kdBarang = $char . sprintf("%05s", $noUrut);

        Product::create([
            'name' => $request['name'],
            'category_id' => $request['category_id'],
            'unit_id' => $request['unit_id'],
            'harga_jual' => $request['harga_jual'],
            'stok' => $request['stok'],
            'code_item' => $kdBarang,
            'information_unit_id' => $request->information_unit_id,
        ]);

        $getProduct = Product::orderBy('name', 'desc')->first();

        //dd($getProduct);

        Supplier::create([
            'product_id' => $getProduct->id,
            'harga_beli' => 0,
        ]);

        return redirect()->route('products.index');
    }

    public function edit(Product $product)
    {
        $units = Unit::all();
        $categories = Category::all();

        return view('admin.products.edit', compact('units','categories','product'));
    }

    public function update(Request $request, Product $product)
    {
        // dd( $request->category_id );

        Product::where(['id' => $product->id])->update([
            'name' => $request['name'],
            'category_id' => $request->category_id,
            'unit_id' => $request->unit_id,
            'harga_jual' => $request['harga_jual'],
            'stok' => $request['stok'],
            'code_item' => $request['code_item'],
        ]);


        return redirect()->route('products.index');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index');
    }
}
