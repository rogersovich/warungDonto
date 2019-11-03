<?php

namespace App\Http\Controllers;

use App\InformationUnit;
use App\Unit;
use App\Category;
use Illuminate\Http\Request;

class InformationUnitController extends Controller
{

    public function index()
    {
        $informations = InformationUnit::with(['Category','UnitOne','UnitTwo'])
            ->latest()
            ->paginate(25);

        //dd($informations);

        return view('admin.informations.index')->with(compact('informations'));
    }


    public function create()
    {
        $units = Unit::all();
        $categories = Category::all();
        return view('admin.informations.add')->with(compact('units','categories'));
    }

    public function store(Request $request)
    {
        //dd($request->all());

        InformationUnit::create([
            'category_id' => $request->category_id,
            'jumlah_awal' => $request->jumlah_awal,
            'satuan_awal_id' => $request->satuan_awal_id,
            'jumlah_akhir' => $request->jumlah_akhir,
            'satuan_akhir_id' => $request->satuan_akhir_id,
        ]);

        return redirect('/admin/informations');
    }


    public function edit(InformationUnit $informationUnit)
    {
        //
    }


    public function update(Request $request, InformationUnit $informationUnit)
    {
        //
    }

    public function destroy(InformationUnit $informationUnit)
    {
        //
    }
}
