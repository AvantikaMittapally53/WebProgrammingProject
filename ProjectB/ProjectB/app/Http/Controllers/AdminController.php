<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
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
        $users = User::where('role', 'user')->get();


        return view('admin', compact('users'));
    }
    public function update(Request $request)
    {
        // die($request->id);
        $user = User::find($request->id);

        // Make sure you've got the Page model
        if ($user) {
            $user->is_active = $user->is_active === "false" ? 'true' : 'false';
            $user->save();
        }

        return redirect()->back()->with('success', 'User updated sucessfully');
    }
}
