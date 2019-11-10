<?php

namespace App\Http\Controllers;

use App\Category;
use App\Cart;
use Illuminate\Http\Request;

class CategoryController extends Controller
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

        return view('admin.categories.index')->with(compact('categories','carts','count','subtotal'));
    }


    public function create()
    {
        return view('admin.categories.add');
    }

    public function store(Request $request)
    {
        Category::create([
            'name' => $request['name']
        ]);

        return redirect('/admin/categories');
    }

    public function edit(Category $category)
    {

        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        Category::where(['id' => $category->id])->update([
            'name' => $request->name
        ]);


        return redirect('admin/categories');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect('/admin/categories');
    }
}
