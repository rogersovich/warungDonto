<?php

namespace App\Http\Controllers;

use App\Supplier;
use App\Product;
use App\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class SupplierController extends Controller
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

    public function pasok(Request $request)
    {
        $pasok = [];

        foreach ($request->pasok as $val) {

            // $product = Product::with('Unit.Category')->find($val);
            $product = Supplier::with('Product.Unit.Category')->find($val);
            //dd($product);
            $pasok[] = [
                'id' => $product->product->id,
                'harga' => $product->harga_beli,
                'name' => $product->product->name,
                'stok' => $product->product->stok,
                'unit' => $product->product->unit->name,
                'category' => $product->product->unit->category->name
            ];

        }


        return view('admin.suppliers.pasok', compact('pasok'));
    }

    public function store(Request $request)
    {

        foreach ($request->pasok as $val) {
            // dd($val);
            $product = Product::with('Unit.Category')->find($val['id']);
            Product::where(['id' => $val['id']])->update([
                'stok' => $product->stok + $val['qty']
            ]);

            Supplier::where(['product_id' => $val['id']])->update([
                'harga_beli' => $val['harga_beli']
            ]);

        }


        return redirect()->route('suppliers.index');
    }

    // public function pasok($id)
    // {
    //     $suppliers = Supplier::with('Product.Unit.Category')
    //         ->where('id', $id)
    //         ->first();

    //     return view('admin.suppliers.pasok')->with(compact('suppliers'));
    // }


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
