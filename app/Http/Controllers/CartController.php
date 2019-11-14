<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class CartController extends Controller
{

    public function __construct()
    {

        $this->middleware(function ($request, $next) {
            $user = Auth::user();
            $role = $user->roles->first()->pivot->role_id;

            if ($role == 2) {
                return redirect('home/');
            }else{
                if($user){
                    $data = collect([
                        'name' => $user->name,
                        'email' => $user->email,
                        'id' => $user->id,
                        'role_id' => $role,
                    ]);
                    Session::put('user', $data);
                }

                return $next($request);
            }
        });
    }

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


    public function create(Request $request)
    {
        $pesen = [];

        foreach ($request->pesen as $val) {

            $product = Product::with('Unit.Category')->find($val);
            //dd($product);
            $pesen[] = [
                'id' => $product->id,
                'name' => $product->name,
                'stok' => $product->stok,
                'unit' => $product->unit->name,
                'category' => $product->unit->category->name
            ];

            //dd($pesen);

        }


        return view('admin.carts.add', compact('pesen'));
    }


    public function store(Request $request)
    {
        //dd($request->all());


        foreach ($request->pesen as $val) {

            $product = Product::with('Unit.Category')->find($val['id']);
            $cart = Cart::where('product_id', $val['id'])->first();

            if($cart == null){
                Cart::create([
                    'product_id' => $val['id'],
                    'qty' => $val['qty']
                ]);

            }else{

                Cart::where(['id' => $cart->id])->update([
                    'qty' => $val['qty'] + $cart->qty
                ]);
            }

            Product::where('id', $val['id'])->update([
                'stok' => $product->stok - $val['qty']
            ]);

        }


        return redirect()->route('products.index');

        //batas

        // $cart = Cart::where('product_id', $request->product_id)->first();
        // $product = Product::where('id',$request->product_id)->first();

        // if($cart == null){
        //     Cart::create([
        //         'product_id' => $request->product_id,
        //         'qty' => $request->qty
        //     ]);

        // }else{

        //     Cart::where(['id' => $cart->id])->update([
        //         'qty' => $request->qty + $cart->qty
        //     ]);
        // }

        //$cartBaru = Cart::where('product_id', $request->product_id)->first();
        //dd($cartBaru);

        // Product::where('id', $request->product_id)->update([
        //     'stok' => $product->stok - $request->qty
        // ]);

        //return redirect()->route('products.index');
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
