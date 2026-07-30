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
        // 1. Executa a validação
        $validated = $request->validate([
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        // 2. Cria e salva o usuário no banco de dados
        $user = User::create([
            'email'    => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role_id'  => 1, // Definindo a role padrão igual ao seu código original
        ]);

        // 3. Redireciona para o dashboard
        return redirect('/dashboard');
    }
}
