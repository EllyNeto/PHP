@extends('layout.admin')

@section('title', 'Em Desenvolvimento')
@section('active', 'placeholder')
@section('page-title', 'Página em Construção')
@section('page-subtitle', 'Esta funcionalidade estará disponível em breve no sistema.')

@section('content')
<div class="panel">
  <div class="panel-body" style="text-align: center; padding: 4rem 2rem;">
    <div style="width: 64px; height: 64px; background: var(--amber-dim); color: var(--amber); border-radius: 16px; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 1rem;">
      <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg>
    </div>
    <h2 style="font-size: 1.25rem; font-weight: 600; margin-bottom: 0.5rem; color: var(--text);">Módulo em Desenvolvimento</h2>
    <p style="color: var(--text-dim); max-width: 420px; margin: 0 auto; font-size: 0.875rem;">
      Estamos a trabalhar para disponibilizar este módulo no Painel do Centro de Formação Tecnológica.
    </p>
  </div>
</div>
@endsection
