<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('dashboard');
    }
    public function profile()
    {
        return view('profile');
    }


    public function show_reset()
    {
        return view('password_reset');
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' =>'required|min:4|string|max:255',
            'email'=>'required|email|string|max:255',
            'phone' => ['required'],
        ]);
        
        $user = Auth::user();
        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->phone = $request['phone'];

        $user->save();
        return back()->with('success','Profile Updated');
        return view('profile');
    }
    public function reset_password(Request $request)
    {
        $request->validate([
            'password' => ['required', 'string', 'min:8', 'confirmed'],

        ]);
        
        $user = Auth::user();
        $user->password = Hash::make($request['password']);
        $user->save();
        return back()->with('success','Password sucessfully  Updated');
        return view('profile');
    }
    

    
}
