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
use Illuminate\Support\Facades\Auth;
use Session;

class ReportController extends Controller
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

        $data = Report::find($id);
        $order_details = OrderDetail::with('Product.Unit')
            ->where('order_id', $data->order_id)->get();

        $order = Order::where('id', $data->order_id)->first();

        $pdf = PDF::loadView('pdf.harian_pdf', compact('data','order_details','order'));

        return $pdf->setPaper('a4', 'landscape')->save('test.pdf')->stream('haha.pdf');
    }


    public function store(Request $request)
    {
        //dd($request->all());

        $week = date_format(date_create($request->week), 'W');
        $month = date_format(date_create($request->month), 'm');
        $year = date_format(date_create($request->week), 'Y');
        $weekNow = Carbon::now()->format('W');
        $monthNow = Carbon::now()->format('m');
        //dd($month);

        if($request->jenis_laporan == 'mingguan'){

            if($request->laporan == 'pembelian'){

                if($week == $weekNow){
                    $reports = Report::whereBetween('tanggal',[Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                    ->get();

                    $pdf = PDF::loadView('pdf.mingguan_pdf', compact('reports'));

                    return $pdf->setPaper('a4', 'landscape')->save('test.pdf')->stream('haha.pdf');

                }else{
                    $weekFirst = Carbon::now()->setISODate($year, $week);
                    $weekLast = Carbon::now()->setISODate($year, $week, 7);
                    $reports = Report::whereBetween('tanggal', [$weekFirst, $weekLast])
                        ->get();

                }

            }else{

                if($week == $weekNow){
                    $reports = Report::whereBetween('tanggal',[Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                    ->get();

                }else{
                    $weekFirst = Carbon::now()->setISODate($year, $week);
                    $weekLast = Carbon::now()->setISODate($year, $week, 7);
                    $reports = Report::whereBetween('tanggal', [$weekFirst, $weekLast])
                        ->get();

                }
            }

        }else{

            if($request->laporan == 'pembelian'){

                if($month == $monthNow){
                    $reports = Report::whereMonth('tanggal',$monthNow)
                    ->get();

                }else{
                    $reports = Report::whereMonth('tanggal',$month)
                    ->get();

                }

            }else{

                if($month == $monthNow){
                    $reports = Report::whereMonth('tanggal',$monthNow)
                    ->get();

                }else{
                    $reports = Report::whereMonth('tanggal',$month)
                    ->get();

                }

            }

        }

        dd($reports);

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
