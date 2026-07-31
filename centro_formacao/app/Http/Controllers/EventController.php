<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Enrollment;

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
    public function matriculas()
    {
        $matriculas = Enrollment::latest('enrollment_date')->latest()->get()->map(function (Enrollment $enrollment) {
            return [
                'nome' => $enrollment->name,
                'curso' => $enrollment->course,
                'data' => $enrollment->enrollment_date->format('d M Y'),
                'estado' => $enrollment->status ? 'Confirmada' : 'Em análise',
            ];
        });

        return view('matriculas', compact('matriculas'));
    }
    public function relatorios()
    {
        return view('relatorios');
    }
        public function definicoes()
    {
        return view('definicoes');
    }
        public function certificacoes()
    {
        return view('certificacoes');
    }
    public function cursos_turmas()
    {
        return view('cursos_turmas');
    }
    public function formandos()
    {
        return view('formandos');
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:30'],
            'bilhete_identidade' => ['required', 'string', 'max:14'],
            'course' => ['required', 'string', 'max:100'],
        ]);

        Enrollment::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'bilhete_identidade' => $data['bilhete_identidade'],
            'course' => $data['course'],
            'status' => true,
            'enrollment_date' => now()->toDateString(),
        ]);

        return redirect('/matriculas')->with('success', 'Matrícula registada com sucesso.');
    }
}
