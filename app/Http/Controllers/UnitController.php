<?php

namespace App\Http\Controllers;

use App\Unit;
use Illuminate\Http\Request;
use App\Category;
use Carbon\Traits\Units;

class UnitController extends Controller
{

    public function index()
    {
        $units = Unit::with('Category')->get();

        return view('admin.units.index')->with(compact('units'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.units.add')->with(compact('categories'));
    }

    public function store(Request $request)
    {
        Unit::create([
            'name' => $request['name'],
            'category_id' => $request['category_id'],
        ]);

        return redirect()->route('units.index');
    }

    public function edit(Unit $unit)
    {

        $categories = Category::all();
        return view('admin.units.edit', compact('unit','categories'));
    }

    public function update(Request $request, Unit $unit)
    {
        Unit::where(['id' => $unit->id])->update([
            'name' => $request->name,
            'category_id' => $request->category_id,
        ]);


        return redirect()->route('units.index');
    }
    public function destroy(Unit $unit)
    {
        $unit->delete();

        return redirect()->route('units.index');
    }
}
