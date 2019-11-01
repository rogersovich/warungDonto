<?php

namespace App\Http\Controllers;

use App\Supplier;
use App\Product;
use Illuminate\Http\Request;

class SupplierController extends Controller
{

    public function index()
    {
        $suppliers = Supplier::with('Unit.Category')->latest()->paginate(25);

        return view('admin.suppliers.index')->with(compact('suppliers'));
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function edit(Supplier $supplier)
    {
        //
    }


    public function update(Request $request, Supplier $supplier)
    {
        //
    }


    public function destroy(Supplier $supplier)
    {
        //
    }
}
