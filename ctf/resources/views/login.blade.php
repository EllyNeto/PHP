@extends('layout.main')

@section('title', 'Autenticação — Centro de Formação Tecnológica')

@section('content')
<div style="min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 1.5rem;">
  <div style="width: 100%; max-width: 880px; background: var(--panel); border: 1px solid var(--border); border-radius: 16px; display: grid; grid-template-columns: 1fr 1.2fr; overflow: hidden; box-shadow: 0 24px 48px rgba(0,0,0,0.5);">
    
    <!-- Lado Esquerdo: Banner de Marca -->
    <div style="background: repeating-linear-gradient(135deg, #111A22, #111A22 2px, #16222D 2px, #16222D 10px); padding: 3rem 2rem; display: flex; flex-direction: column; justify-content: space-between; border-right: 1px solid var(--border-soft);">
      <div style="display: flex; align-items: center; gap: 0.75rem;">
        <div class="brand-logo" style="width: 44px; height: 44px; font-size: 1.25rem;">CF</div>
        <div class="brand-text">
          <h2 style="font-size: 1.1rem; color: var(--text);">Centro de Formação</h2>
          <p style="font-size: 0.72rem; color: var(--amber);">CINFOTEC · MAPTSS</p>
        </div>
      </div>

      <div style="margin: 2rem 0;">
        <h3 style="font-size: 1.5rem; font-weight: 700; color: var(--text); line-height: 1.3; margin-bottom: 0.75rem;">
          Sistema Integrado de Gestão Académica
        </h3>
        <p style="font-size: 0.85rem; color: var(--text-dim); line-height: 1.5;">
          Aceda à plataforma de administração para gerir cursos, turmas, matrículas e certificados dos formandos.
        </p>
      </div>

      <div style="font-size: 0.75rem; color: var(--text-faint); font-family: 'IBM Plex Mono', monospace;">
        Talatona, Luanda-Sul · Angola
      </div>
    </div>

    <!-- Lado Direito: Formuário de Autenticação -->
    <div style="padding: 3rem 2.5rem; display: flex; flex-direction: column; justify-content: center;">
      <h2 style="font-size: 1.35rem; font-weight: 600; margin-bottom: 0.25rem; color: var(--text);">Iniciar Sessão</h2>
      <p style="font-size: 0.82rem; color: var(--text-dim); margin-bottom: 1.75rem;">Insira as suas credenciais para aceder ao painel</p>

      <form action="{{ url('/dashboard') }}" method="GET" style="display: flex; flex-direction: column; gap: 1.15rem;">
        <div class="field">
          <label>Utilizador ou E-mail Institucional</label>
          <input type="text" placeholder="ex.: admin@cinfotec.co.ao" required style="width: 100%;">
        </div>

        <div class="field">
          <label>Palavra-passe</label>
          <input type="password" placeholder="••••••••••••" required style="width: 100%;">
        </div>

        <div style="display: flex; items-center; justify-content: space-between; font-size: 0.78rem; margin-top: 0.25rem;">
          <label style="display: flex; align-items: center; gap: 0.4rem; color: var(--text-dim); cursor: pointer;">
            <input type="checkbox" style="accent-color: var(--amber);"> Lembrar-me
          </label>
          <a href="#" style="color: var(--amber); text-decoration: none;">Esqueceu a palavra-passe?</a>
        </div>

        <button class="btn-primary" type="submit" style="width: 100%; padding: 0.75rem; margin-top: 0.5rem; font-size: 0.95rem;">Entrar no Sistema →</button>
      </form>
    </div>

  </div>
</div>
@endsection
