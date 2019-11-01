<?php

namespace App\Http\Controllers;

use App\InformationUnit;
use App\Unit;
use App\Category;
use Illuminate\Http\Request;

class InformationUnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $informations = InformationUnit::latest()->paginate(25);

        return view('admin.informations.index')->with(compact('informations'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $units = Unit::all();
        $categories = Category::all();
        return view('admin.informations.add')->with(compact('units','categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\InformationUnit  $informationUnit
     * @return \Illuminate\Http\Response
     */
    public function show(InformationUnit $informationUnit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\InformationUnit  $informationUnit
     * @return \Illuminate\Http\Response
     */
    public function edit(InformationUnit $informationUnit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\InformationUnit  $informationUnit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InformationUnit $informationUnit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\InformationUnit  $informationUnit
     * @return \Illuminate\Http\Response
     */
    public function destroy(InformationUnit $informationUnit)
    {
        //
    }
}
