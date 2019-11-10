<?php

namespace App\Http\Controllers;

use App\Supplier;
use App\Product;
use App\Cart;
use Illuminate\Http\Request;

class SupplierController extends Controller
{

    public function index()
    {
        $suppliers = Supplier::with('Product.Unit.Category')->latest()->paginate(25);

        $carts = Cart::with('Product')->paginate(15);
        $harga = [];
        foreach ($carts as $c) {
            $harga[] = $c->qty * $c->product->harga_jual;
        }

        $subtotal = array_sum($harga);

        $count = $carts->count();

        return view('admin.suppliers.index')->with(compact('suppliers','carts','count','subtotal'));
    }

    public function pasok($id)
    {
        // dd($id);
        $suppliers = Supplier::with('Product.Unit.Category')
            ->where('id', $id)
            ->first();

        return view('admin.suppliers.pasok')->with(compact('suppliers'));
    }


    public function updatePasok(Request $request, $id)
    {

        $supplier = Supplier::where('id', $id)->first();
        $product = Product::where('id', $supplier->product_id)->first();

        Product::where(['id' => $supplier->product_id])->update([
            'stok' => $product->stok + $request->jumlah
        ]);


        return redirect()->route('suppliers.index');
    }


    public function edit(Supplier $supplier)
    {
        $suppliers = Supplier::with('Product.Unit.Category')
            ->where('id', $supplier->id)
            ->first();

        return view('admin.suppliers.edit')->with(compact('suppliers'));
    }


    public function update(Request $request, Supplier $supplier)
    {
        Supplier::where(['id' => $supplier->id])->update([
            'harga_beli' => $request->harga_beli
        ]);


        return redirect()->route('suppliers.index');
    }


    public function destroy(Supplier $supplier)
    {
        //
    }
}
