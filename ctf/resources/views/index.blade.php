{{--
    View principal do painel. Este template não define rotas Laravel próprias
    além da que o serve: a navegação entre abas (Cursos, Turmas, etc.) é feita
    inteiramente no cliente com Alpine.js (x-show), sem recarregar a página.

    Para servir esta view, basta uma única rota:
        Route::get('/painel', fn () => view('painel.index'));
--}}

@extends('layouts.app')

@section('titulo', 'Painel de Gestão — Centro de Formação')

@section('conteudo')
    @include('painel.partials.dashboard')
    @include('painel.partials.cursos')
    @include('painel.partials.turmas')
    @include('painel.partials.docentes')
    @include('painel.partials.inscricoes')
    @include('painel.partials.alunos')
    @include('painel.partials.financas')
    @include('painel.partials.relatorios')
@endsection
