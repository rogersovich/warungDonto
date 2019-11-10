<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{

    public function index()
    {
        $carts = Cart::with('Product')->paginate(15);
        $harga = [];
        foreach ($carts as $c) {
            $harga[] = $c->qty * $c->product->harga_jual;
        }

        $subtotal = array_sum($harga);

        $count = $carts->count();

        return view('admin.carts.index')->with(compact('carts','count','subtotal'));
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //dd($request->all());
        $cart = Cart::where('product_id', $request->product_id)->first();
        $product = Product::where('id',$request->product_id)->first();

        if($cart == null){
            Cart::create([
                'product_id' => $request->product_id,
                'qty' => $request->qty
            ]);

        }else{

            Cart::where(['id' => $cart->id])->update([
                'qty' => $request->qty + $cart->qty
            ]);
        }

        //$cartBaru = Cart::where('product_id', $request->product_id)->first();
        //dd($cartBaru);

        Product::where('id', $request->product_id)->update([
            'stok' => $product->stok - $request->qty
        ]);

        return redirect()->route('products.index');
    }


    public function edit($id)
    {
        $product = Product::find($id);
        // dd($product);
        $cart = Cart::where('product_id', $id)->first();
        $qty = null;

        return view('admin.carts.edit', compact('product','qty'));

    }


    public function update(Request $request, Cart $cart)
    {
        //
    }


    public function destroy(Cart $cart)
    {
        //
    }
}