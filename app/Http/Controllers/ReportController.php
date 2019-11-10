<?php

namespace App\Http\Controllers;

use PDF;
use Carbon\Carbon;
use App\Report;
use App\Order;
use App\Category;
use App\Cart;
use App\OrderDetail;
use Illuminate\Http\Request;

class ReportController extends Controller
{

    public function index()
    {

        $categories = Category::latest()->paginate(25);
        $carts = Cart::with('Product')->paginate(15);
        $harga = [];
        foreach ($carts as $c) {
            $harga[] = $c->qty * $c->product->harga_jual;
        }

        $subtotal = array_sum($harga);

        $count = $carts->count();

        $monthNow = Carbon::now()->format("Y-m");
        $weeks = Carbon::now()->format("W");
        $weekNow = Carbon::now()->format("Y").'-W'.$weeks;

        return view('admin.reports.index', compact('carts','count','subtotal','monthNow','weekNow'));

    }


    public function create()
    {
        //
    }

    public function struk()
    {
        $report = Report::where('jenis_laporan', 'harian')
            ->orderBy('id', 'desc')
            ->first();

        $order_details = OrderDetail::with('Product.Unit')
            ->where('order_id', $report->order_id)->get();

        $order = Order::where('id', $report->order_id)->first();

        return view('admin.orders.struk', compact('report','order','order_details'));
    }

    public function print($id)
    {
        // $calls = \DB::table('calls')
        //     ->where('owned_by_id', $report->id)
        //     ->whereBetween('created_at', [Carbon::now()->subWeek()->format("Y-m-d H:i:s"), Carbon::now()])
        //     ->get();
        // $report->callsCount = $calls->count();
        // $week =Carbon::now()->subWeek()->format("Y-m-d");
        // dd($week);

        $data = Report::find($id);
        $order_details = OrderDetail::with('Product.Unit')
            ->where('order_id', $data->order_id)->get();

        $order = Order::where('id', $data->order_id)->first();

        $pdf = PDF::loadView('pegawai_pdf', compact('data','order_details','order'));

        return $pdf->setPaper('a4', 'landscape')->save('test.pdf')->stream('haha.pdf');
    }


    public function store(Request $request)
    {
        //
    }

    public function edit(Report $report)
    {
        //
    }


    public function update(Request $request, Report $report)
    {
        //
    }

    public function destroy(Report $report)
    {
        //
    }
}
