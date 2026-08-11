<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CentroF_Controller extends Controller
{
    public function index()
    {
        return view('dashboard');
    }

    public function dashboard()
    {
        return view('dashboard');
    }

    public function financas()
    {
        return view('financas');
    }

    public function cursos()
    {
        return view('cursos');
    }

    public function turmas()
    {
        return view('turmas');
    }

    public function docentes()
    {
        return view('docentes');
    }

    public function inscricoes()
    {
        return view('inscricoes');
    }

    public function formandos()
    {
        return view('formandos');
    }

    public function matriculas()
    {
        return view('matriculas');
    }

    public function certificacoes()
    {
        return view('certificacoes');
    }

    public function relatorios()
    {
        return view('relatorios');
    }

    public function definicoes()
    {
        return view('definicoes');
    }

    public function login()
    {
        return view('login');
    }
}
