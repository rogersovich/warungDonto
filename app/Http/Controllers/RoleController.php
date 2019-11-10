<?php

namespace App\Http\Controllers;

use App\Role;
use App\Cart;
use Illuminate\Http\Request;

class RoleController extends Controller
{

    public function index()
    {
        $roles = Role::latest()->paginate(25);

        $carts = Cart::with('Product')->paginate(15);
        $harga = [];
        foreach ($carts as $c) {
            $harga[] = $c->qty * $c->product->harga_jual;
        }

        $subtotal = array_sum($harga);

        $count = $carts->count();

        return view('admin.roles.index')->with(compact('roles','carts','count','subtotal'));
    }


    public function create()
    {
        return view('admin.roles.add');
    }

    public function store(Request $request)
    {
        Role::create([
            'name' => $request['name']
        ]);

        return redirect()->route('roles.index');
    }


    public function edit(Role $role)
    {
        return view('admin.roles.edit', compact('role'));
    }


    public function update(Request $request, Role $role)
    {
        Role::where(['id' => $role->id])->update([
            'name' => $request->name
        ]);


        return redirect()->route('roles.index');
    }

    public function destroy(Role $role)
    {
        $role->delete();

        return redirect()->route('roles.index');
    }
}
