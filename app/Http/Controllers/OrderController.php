<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderDetail;
use App\Debt;
use App\DebtDetail;
use App\Cart;
use App\Product;
use App\Report;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class OrderController extends Controller
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
        //dd($request->all());
        $date = Carbon::now()->format('Y-m-d');


        // CODE ORDER
        $kdOrder = Order::select(['code'])->max('code');

        $noUrut = (int) substr($kdOrder, 5, 3);

        $noUrut++;
        $char = "OR";
        $kdOrder = $char . sprintf("%05s", $noUrut);

        // CODE DEBT
        $kdDebt = Debt::select(['code_debt'])->max('code_debt');

        $noDebt = (int) substr($kdDebt, 5, 3);

        $noDebt++;
        $charDebt = "DB";
        $kdDebt = $charDebt . sprintf("%05s", $noDebt);


        $order = Order::create([
            'code' => $kdOrder,
            'tanggal' => $date,
            'kembalian' => $request->duit - $request->subtotal,
            'total_bayar' => $request->duit,
            'total_harga' => $request->subtotal,
        ]);

        if(!$request->nama == null){

            $sisa = $request->subtotal - $request->duit;

            $debt = Debt::create([
                'name' => $request->nama,
                'order_id' => $order->id,
                'code_debt' => $kdDebt,
                'tanggal' => $date,
                'total_sebelumnya' => $request->subtotal,
                'sudah_bayar' => $request->duit,
                'sisa_bayar' => $sisa,
                'total_bayar' => 0,
                'kembalian' => 0,
            ]);

            foreach($request->Order as $key){
                DebtDetail::create([
                    'debt_id' => $debt->id,
                    'product_id' => $key['product_id'],
                    'qty' => $key['qty']
                ]);
            }

            

        }

        foreach($request->Order as $key){
            OrderDetail::create([
                'order_id' => $order->id,
                'product_id' => $key['product_id'],
                'qty' => $key['qty']
            ]);

            $reports = $order->orderDetails()->latest()->get();

            foreach ($reports as $r) {

                // CODE Report
                $kdReport = Report::select(['code_report'])->max('code_report');

                $noUrut = (int) substr($kdReport, 5, 3);

                $noUrut++;
                $char = "RP";
                $kdReport = $char . sprintf("%05s", $noUrut);


                $report = Report::where('product_id',$r->product_id)->first();

                //dd($report);

                if ($report) {

                    $report_now = Report::where('product_id',$r->product_id)->first();

                    Report::create([
                        'product_id' => $r->product_id,
                        'tanggal' => $date,
                        'jumlah_awal' => $report_now->jumlah_awal,
                        'jumlah_jual' => $r->qty + $report_now->jumlah_jual,
                        'jumlah_akhir' => $report_now->jumlah_awal - ($r->qty + $report_now->jumlah_jual),
                        'harga' => $report_now->harga,
                        'keterangan' => null,
                        'code_report' => $kdReport,
                        'jenis_laporan' => 'barang'
                    ]);

                    $report_back = Report::where('product_id', $r->product_id)
                        ->orderBy('code_report','asc')
                        ->select('code_report','product_id')
                        ->first();

                    $report_now_banget = Report::where('product_id', $r->product_id)
                        ->orderBy('code_report','desc')
                        ->first();

                    //dd($report_now_banget);

                    Report::where(['id' => $report_back->id])->update([
                        'jumlah_jual' => $report_now_banget->jumlah_jual,
                        'jumlah_akhir' => $report_now_banget->jumlah_akhir
                    ]);




                }else{

                    $product = Product::where('id',$r->product_id)->first();

                    Report::create([
                        'product_id' => $r->product_id,
                        'tanggal' => $date,
                        'jumlah_awal' => $product->stok,
                        'jumlah_jual' => $r->qty,
                        'jumlah_akhir' => $product->stok - $r->qty,
                        'harga' => $product->harga_jual,
                        'keterangan' => null,
                        'code_report' => $kdReport,
                        'jenis_laporan' => 'barang'
                    ]);
                }


            }

        }

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
