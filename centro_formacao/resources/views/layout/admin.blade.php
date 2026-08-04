<!DOCTYPE html>
<html lang="pt-AO">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>@yield('title', 'Painel Administrativo') — Centro de Formação Tecnológica</title>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700&family=Inter:wght@400;500;600&family=IBM+Plex+Mono:wght@400;500;600&display=swap" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.4/chart.umd.min.js"></script>

<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@stack('styles')
</head>
<body>

<div class="app">

  <!-- Overlay do drawer da sidebar (mobile) -->
  <div class="sidebar-overlay" id="sidebarOverlay"></div>

  {{-- ==================== SIDEBAR ==================== --}}
  <aside class="sidebar" id="sidebar">
    <div class="brand">
      <div class="brand-mark">CFT</div>
      <div>
        <div class="brand-name">Centro de Formação<br>Tecnológica</div>
        <div class="brand-sub">Painel Administrativo</div>
      </div>
    </div>

    {{--
      NOTA: os links abaixo apontam para caminhos previsíveis (/admin/...).
      Quando criares routes/admin.php, troca por route('admin.xxx') se preferires
      rotas nomeadas — ou mantém url() e regista os URIs correspondentes.
      A secção activa é definida por @section('active', 'chave') em cada view.
    --}}
    @php $active = trim($__env->yieldContent('active', 'visao')); @endphp

    <nav id="nav">
      <div class="nav-label">Principal</div>

      <a href="dashboard" class="nav-item {{ $active === 'visao' ? 'active' : '' }}">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="9" rx="1.5"/><rect x="14" y="3" width="7" height="5" rx="1.5"/><rect x="14" y="12" width="7" height="9" rx="1.5"/><rect x="3" y="16" width="7" height="5" rx="1.5"/></svg>
        Visão Geral
      </a>
      <a href="formandos" class="nav-item {{ $active === 'formandos' ? 'active' : '' }}">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
        Formandos
      </a>
      <a href="cursos_turmas" class="nav-item {{ $active === 'formadores' ? 'active' : '' }}">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20.59 13.41L11 3.83V3H10.17L1 12.17V13h.83L11 22.17l9.59-9.59a2 2 0 0 0 0-2.83z"/><circle cx="6.5" cy="6.5" r="1"/></svg>
        Cursos &amp; Turmas
      </a>
      <a href="/matriculas" class="nav-item {{ $active === 'matriculas' ? 'active' : '' }}">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><path d="M14 2v6h6"/><path d="M9 15l2 2 4-4"/></svg>
        Matrículas
      </a>
      <a href="certificacoes" class="nav-item {{ $active === 'certificacoes' ? 'active' : '' }}">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="8" r="6"/><path d="M9 14.5L7 22l5-3 5 3-2-7.5"/></svg>
        Certificações
      </a>

      <div class="nav-label">Análise</div>
      <a href="relatorios" class="nav-item {{ $active === 'relatorios' ? 'active' : '' }}">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 3v18h18"/><path d="M18 17V9"/><path d="M13 17V5"/><path d="M8 17v-3"/></svg>
        Relatórios
      </a>
      <a href="definicoes" class="nav-item {{ $active === 'definicoes' ? 'active' : '' }}">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 1 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 1 1-2.83-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 1 1 2.83-2.83l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 1 1 2.83 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg>
        Definições
      </a>
    </nav>

    <div class="sidebar-foot">
      <div class="user-chip">
        <div class="avatar">{{ auth()->check() ? strtoupper(substr(auth()->user()->name,0,2)) : 'EN' }}</div>
        <div>
          <div class="user-name">{{ auth()->check() ? auth()->user()->name : 'Eliandra Neto' }}</div>
          <div class="user-role">Administradora</div>
        </div>
      </div>
    </div>
  </aside>

  {{-- ==================== MAIN ==================== --}}
  <main>
    <div class="topbar">
      <div class="topbar-left">
        <button class="hamburger" id="hamburger" aria-label="Abrir menu" aria-expanded="false" aria-controls="sidebar">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 6h18M3 12h18M3 18h18"/></svg>
        </button>
        <div class="topbar-title">
          <h1>@yield('page-title', 'Visão Geral')</h1>
          <p>@yield('page-subtitle', 'Talatona · Rangel · Huambo · Cabinda — ano formativo 2026')</p>
        </div>
      </div>
      <div class="topbar-right">
        <div class="search">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/></svg>
          <input type="text" placeholder="Procurar formando, turma, curso…">
        </div>
        <button class="icon-btn"><span class="dot"></span>
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg>
        </button>
      </div>
    </div>

    {{-- Conteúdo específico de cada página --}}
    @yield('content')

  </main>
</div>

{{-- ==================== MODAL: NOVA MATRÍCULA ====================
     Partilhado por todas as páginas. A action aponta para um URI
     previsível — troca por route('admin.matriculas.store') quando
     criares essa rota/controller. --}}
<div class="overlay" id="overlay">
  <div class="modal">
    <div class="modal-head">
      <h3>Nova inscrição</h3>
      <button class="modal-close" id="closeModal" type="button">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 6L6 18M6 6l12 12"/></svg>
      </button>
    </div>
    <form method="POST" action="{{ route('matriculas.store') }}">
      @csrf
      <div class="field">
        <label for="formando_nome">Nome do formando</label>
        <input type="text" id="formando_nome" name="name" value="{{ old('name') }}" placeholder="Ex: Beatriz Kanda" required>
      </div>
      <div class="field">
        <label for="formando_email">Email</label>
        <input type="email" id="formando_email" name="email" value="{{ old('email') }}" placeholder="Ex: beatriz.kanda@example.com" required>
      </div>
      <div class="field">
        <label for="formando_bilhete">Bilhete de Identidade</label>
        <input type="text" id="formando_bilhete" name="bilhete_identidade" value="{{ old('bilhete_identidade') }}" maxlength="14" placeholder="Ex: 1234567890123" required>
      </div>
      <div class="field">
        <label for="formando_telefone">Telefone</label>
        <input type="tel" id="formando_telefone" name="phone" value="{{ old('phone') }}" maxlength="30" placeholder="Ex: 923 456 789" required>
      </div>
      <div class="field">
        <label for="curso_id">Curso</label>
        <select id="curso_id" name="course" required>
          <option value="" disabled {{ old('course') ? '' : 'selected' }}>Selecione um curso</option>
          @forelse($cursos ?? [] as $curso)
            <option value="{{ $curso->name }}" {{ old('course') == $curso->name ? 'selected' : '' }}>{{ $curso->name }}</option>
          @empty
            <option value="" disabled>Nenhum curso disponível no momento</option>
          @endforelse
        </select>
      </div>
      <div class="field">
        <label for="payment_status">Estado do pagamento</label>
        <select id="payment_status" name="payment_status" required>
          <option value="Pendente" {{ old('payment_status', 'Pendente') === 'Pendente' ? 'selected' : '' }}>Pendente</option>
          <option value="Confirmado" {{ old('payment_status') === 'Confirmado' ? 'selected' : '' }}>Confirmado</option>
          <option value="Rejeitado" {{ old('payment_status') === 'Rejeitado' ? 'selected' : '' }}>Rejeitado</option>
        </select>
      </div>
      @if (isset($errors) && $errors->any())
        <div class="field" role="alert">{{ $errors->first() }}</div>
      @endif
      <div class="modal-actions">
        <input class="btn-secondary" id="cancelModal" type="button" value="Cancelar">
        <input class="btn-primary" style="justify-content:center;" type="submit" value="Confirmar inscrição">
      </div>
    </form>
  </div>
</div>

<script src="{{ asset('js/dashboard.js') }}"></script>
@if (isset($errors) && $errors->any())
  <script>
    document.addEventListener('DOMContentLoaded', () => document.getElementById('overlay')?.classList.add('show'));
  </script>
@endif
@stack('scripts')
</body>
</html>
