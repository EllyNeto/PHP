@php
  $active = trim($__env->yieldContent('active', 'visao'));
@endphp

<aside class="sidebar" id="sidebar">
  <div class="brand">
    <div class="brand-logo">CF</div>
    <div class="brand-text">
      <h2>Centro de Formação</h2>
      <p>CINFOTEC · MAPTSS</p>
    </div>
  </div>

  <nav class="nav-group">
    <div class="nav-label">Menu Principal</div>

    <a href="{{ url('/dashboard') }}" class="nav-item {{ $active === 'visao' || $active === 'dashboard' ? 'active' : '' }}" data-section="visao">
      <span class="nav-icon">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><rect x="3" y="3" width="7" height="9" rx="1"/><rect x="14" y="3" width="7" height="5" rx="1"/><rect x="14" y="12" width="7" height="9" rx="1"/><rect x="3" y="16" width="7" height="5" rx="1"/></svg>
      </span>
      <span class="nav-text">Visão Geral</span>
    </a>

    <a href="{{ url('/cursos') }}" class="nav-item {{ $active === 'cursos' ? 'active' : '' }}" data-section="cursos">
      <span class="nav-icon">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M4 19.5A2.5 2.5 0 016.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 014 19.5v-15A2.5 2.5 0 016.5 2z"/></svg>
      </span>
      <span class="nav-text">Cursos</span>
    </a>

    <a href="{{ url('/turmas') }}" class="nav-item {{ $active === 'turmas' ? 'active' : '' }}" data-section="turmas">
      <span class="nav-icon">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
      </span>
      <span class="nav-text">Turmas</span>
    </a>

    <a href="{{ url('/docentes') }}" class="nav-item {{ $active === 'docentes' ? 'active' : '' }}" data-section="docentes">
      <span class="nav-icon">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
      </span>
      <span class="nav-text">Docentes</span>
    </a>

    <div class="nav-label">Admissões &amp; Formandos</div>

    <a href="{{ url('/inscricoes') }}" class="nav-item {{ $active === 'inscricoes' ? 'active' : '' }}" data-section="inscricoes">
      <span class="nav-icon">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M9 11l3 3L22 4"/><path d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11"/></svg>
      </span>
      <span class="nav-text">Inscrições</span>
      <span class="badge-count">5</span>
    </a>

    <a href="{{ url('/formandos') }}" class="nav-item {{ $active === 'formandos' || $active === 'alunos' ? 'active' : '' }}" data-section="formandos">
      <span class="nav-icon">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M22 10L12 5 2 10l10 5 10-5z"/><path d="M6 12v5c0 1.5 3 3 6 3s6-1.5 6-3v-5"/></svg>
      </span>
      <span class="nav-text">Formandos</span>
      <span class="badge-count">812</span>
    </a>

    <a href="{{ url('/matriculas') }}" class="nav-item {{ $active === 'matriculas' ? 'active' : '' }}" data-section="matriculas">
      <span class="nav-icon">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><circle cx="12" cy="12" r="9"/><path d="M12 7v10M9 9.5c0-1.5 1.5-2 3-2s3 .8 3 2-1.5 1.8-3 2-3 .7-3 2 1.5 2 3 2 3-.5 3-2"/></svg>
      </span>
      <span class="nav-text">Matrículas &amp; Propinas</span>
    </a>

    <div class="nav-label">Académico &amp; Gestão</div>

    <a href="{{ url('/certificacoes') }}" class="nav-item {{ $active === 'certificacoes' ? 'active' : '' }}" data-section="certificacoes">
      <span class="nav-icon">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M12 15l-2 5l4 -2l4 2l-2 -5"/><circle cx="12" cy="9" r="6"/></svg>
      </span>
      <span class="nav-text">Certificações</span>
    </a>

    <a href="{{ url('/relatorios') }}" class="nav-item {{ $active === 'relatorios' || $active === 'financas' ? 'active' : '' }}" data-section="relatorios">
      <span class="nav-icon">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M3 3v18h18"/><rect x="7" y="12" width="3" height="6"/><rect x="12" y="8" width="3" height="10"/><rect x="17" y="5" width="3" height="13"/></svg>
      </span>
      <span class="nav-text">Relatórios</span>
    </a>

    <a href="{{ url('/definicoes') }}" class="nav-item {{ $active === 'definicoes' ? 'active' : '' }}" data-section="definicoes">
      <span class="nav-icon">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg>
      </span>
      <span class="nav-text">Definições</span>
    </a>
  </nav>

  <div class="sidebar-footer">
    CINFOTEC · MAPTSS<br>Talatona, Luanda-Sul
  </div>
</aside>
