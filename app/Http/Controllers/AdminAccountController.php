<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Session;
use App\User;
use App\Role;
use App\Cart;


class AdminAccountController extends Controller
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
        $user = Auth::user();
        $accounts = User::latest()->paginate(5);

        $carts = Cart::with('Product')->paginate(15);
        $harga = [];
        foreach ($carts as $c) {
            $harga[] = $c->qty * $c->product->harga_jual;
        }

        $subtotal = array_sum($harga);

        $count = $carts->count();

        return view('admin.accounts.index')->with(compact('accounts','carts','count','subtotal'));
    }

    public function create()
    {
        $user = Auth::user();
        $roles = Role::all();

        return view('admin.accounts.add', compact('user','roles'));
    }

    public function store(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->roles()->attach(Role::where('id', $request->role_id)->first());

        return redirect()->route('adminAccount.index')->with('success','Account has added');
    }

    public function edit($id)
    {
        $user = Auth::user();
        $roles = Role::all();

        $admin = User::where('id',$id)->first();
        return view('admin.accounts.edit',compact('admin','user','roles'));
    }

    public function update(Request $request, $id)
    {

        $user = User::where(['email' => $request['email']])->first();

        //dd($request->all());

        $user->roles()->detach();

        if($request->password == null){
            User::where('id',$id)->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);
        }else{
            User::where('id',$id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
        }

        $user->roles()->attach(Role::where('id', $request->role_id)->first());
        $user->save();

        return redirect()->route('adminAccount.index')->with('success','Account has been updated');
    }


    public function destroy($id)
    {
        $user = User::find($id);
        $user->roles()->detach();

        $user->delete();
        return back()->with('success','Account has been deleted !');
    }
}
