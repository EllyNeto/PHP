<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CentroF_Controller extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function panel()
    {
        return view('index');
    }

    public function inscricoes()
    {
        return view('inscricoes');
    }

    public function alunos()
    {
        return view('alunos');
    }

    public function docentes()
    {
        return view('docentes');
    }

    public function turmas()
    {
        return view('turmas');
    }

    public function cursos()
    {
        return view('cursos');
    }

    public function financas()
    {
        return view('financas');
    }

    public function relatorios()
    {
        return view('relatorios');
    }

}
