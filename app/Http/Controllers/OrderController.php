<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderDetail;
use App\Cart;
use App\Product;
use App\Report;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function index()
    {
        //
    }


    public function create()
    {
        $carts = Cart::with('Product')->paginate(15);
        $harga = [];
        foreach ($carts as $c) {
            $harga[] = $c->qty * $c->product->harga_jual;
        }

        $subtotal = array_sum($harga);

        $count = $carts->count();

        return view('admin.orders.add')->with(compact('carts','count','subtotal'));
    }

    public function store(Request $request)
    {
        //dd($request->Order);
        $date = Carbon::now()->format('Y-m-d');

        $kdOrder = Order::select(['code'])->max('code');

        $noUrut = (int) substr($kdOrder, 5, 3);

        $noUrut++;
        $char = "OR";
        $kdOrder = $char . sprintf("%05s", $noUrut);

        $order = Order::create([
            'code' => $kdOrder,
            'tanggal' => $date,
            'kembalian' => $request->duit - $request->subtotal,
            'total_bayar' => $request->duit,
            'total_harga' => $request->subtotal,
        ]);

        foreach($request->Order as $key){
                OrderDetail::create([
                    'order_id' => $order->id,
                    'product_id' => $key['product_id'],
                    'qty' => $key['qty']
            ]);
        }

        $kdReport = Report::select(['code_report'])->max('code_report');

        $noReport = (int) substr($kdReport, 5, 3);

        $noReport++;
        $charReport = "RP";
        $kdReport = $charReport . sprintf("%05s", $noReport);

        Report::create([
            'code_report' => $kdReport,
            'tanggal' => $date,
            'order_id' => $order->id,
            'jenis_laporan' => 'harian'
        ]);

        Cart::query()->truncate();

        return redirect()->route('orders.struk');

    }


    public function show(Order $order)
    {
        //
    }

    public function edit(Order $order)
    {
        //
    }

    public function update(Request $request, Order $order)
    {
        //
    }

    public function destroy($id)
    {
        $cart = Cart::find($id)->first();
        $product = Product::where('id', $cart->product_id)->first();

        Product::where('id', $cart->product_id)->update([
            'stok' => $cart->qty + $product->stok
        ]);

        $cart->delete();

        return redirect()->route('orders.create');
    }
}
