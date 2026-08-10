<div class="topbar">
  <div class="topbar-left">
    <button class="hamburger" id="hamburger" aria-label="Abrir menu">
      <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 12h18M3 6h18M3 18h18"/></svg>
    </button>
    <div class="topbar-title">
      <h1>@yield('page-title', 'Visão Geral')</h1>
      <p>@yield('page-subtitle', 'Resumo atualizado dos dados registados no sistema')</p>
    </div>
  </div>

  <div class="topbar-right">
    <div class="search">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
      <input type="text" placeholder="Pesquisar formando, curso, turma…">
    </div>

    <!-- Toggle Theme (Dark / Light) -->
    <button class="icon-btn" data-theme-toggle title="Alternar Modo Escuro / Claro">
      <svg class="sun-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <circle cx="12" cy="12" r="5"/><line x1="12" y1="1" x2="12" y2="3"/><line x1="12" y1="21" x2="12" y2="23"/><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"/><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"/><line x1="1" y1="12" x2="3" y2="12"/><line x1="21" y1="12" x2="23" y2="12"/><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"/><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"/>
      </svg>
    </button>

    <button class="icon-btn" title="Notificações">
      <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg>
      <span class="dot"></span>
    </button>

    <div class="user-profile">
      <div class="user-avatar">EN</div>
      <div class="user-info">
        <div class="user-name">Eliandra Neto</div>
        <div class="user-role">Administração</div>
      </div>
    </div>
  </div>
</div>
