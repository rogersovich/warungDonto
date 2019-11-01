<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::latest()->paginate(25);

        return view('admin.categories.index')->with(compact('categories'));
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
