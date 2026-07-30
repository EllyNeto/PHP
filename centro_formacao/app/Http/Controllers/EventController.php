<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;
use App\Models\Usr;
use App\Models\User;

class EventController extends Controller
{
    public function index()
    {
           return view('login');
    }

    public function dashboard()
    {
        return view('dashboard');
    }
       public function profile()
    {
        $userss = Usr::all();

        return view('profile', [
            'userss' => $userss,
        ]);
    }

public function store(Request $request)
{
    $request->validate([
        'email'    => 'required|email|unique:userss,email',
        'password' => 'required|min:6',
    ]);

    $usr = new Usr();
    $usr->email = $request->input('email');
    $usr->password = bcrypt($request->input('password'));
    $usr->role_id = 1;
    $usr->save();

    return redirect('/dashboard');
}
}
