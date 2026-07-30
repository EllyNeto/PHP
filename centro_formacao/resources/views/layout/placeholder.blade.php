@extends('layouts.admin')

{{--
  View genérica para qualquer secção que ainda não tenha o seu próprio
  controller/view. Passa $title, $subtitle e $active a partir do controller:

    return view('admin.placeholder', [
        'title'    => 'Formandos',
        'subtitle' => 'Gestão de formandos activos e histórico',
        'active'   => 'formandos',
    ]);
--}}

@section('title', $title ?? 'Secção')
@section('active', $active ?? '')
@section('page-title', $title ?? 'Secção')
@section('page-subtitle', $subtitle ?? '')

@section('content')
  <div class="placeholder">
    <div class="display">{{ $title ?? 'Secção' }}</div>
    <p>Esta área está em construção — cria o controller e a view dedicados quando estiveres pronta para a desenvolver.</p>
  </div>
@endsection
