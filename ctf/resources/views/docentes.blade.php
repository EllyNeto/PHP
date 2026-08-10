@extends('layout.admin')

@section('title', 'Docentes')
@section('active', 'docentes')
@section('page-title', 'Corpo Docente')
@section('page-subtitle', 'Gestão de formadores e instrutores técnicos do centro')

@section('content')
  <div class="panel">
    <div class="panel-head">
      <div>
        <div class="panel-title">Lista de Formadores</div>
        <div class="panel-sub">Instrutores técnicos activos por especialidade</div>
      </div>
      <button class="btn-primary" data-modal-target="modalNovoDocente">+ Novo Docente</button>
    </div>
    <div class="panel-body">
      <div class="grid-3">
        <div class="panel" style="padding: 1.25rem; border: 1px solid var(--border);">
          <div style="display:flex; align-items:center; gap: 0.75rem;">
            <div class="avatar-mini" style="width: 42px; height: 42px; font-size: 1rem;">JB</div>
            <div>
              <h4 style="font-size: 1rem; font-weight: 600;">João Baptista</h4>
              <p style="font-size: 0.78rem; color: var(--text-dim);">Redes e Telecomunicações</p>
            </div>
          </div>
          <div style="margin-top: 1rem; padding-top: 0.75rem; border-top: 1px solid var(--border-soft); display:flex; justify-content:space-between; font-size:0.78rem;">
            <span class="mono-num" style="color: var(--text-dim);">+244 923 000 111</span>
            <span class="mono-num" style="color: var(--amber);">2 Turmas</span>
          </div>
        </div>

        <div class="panel" style="padding: 1.25rem; border: 1px solid var(--border);">
          <div style="display:flex; align-items:center; gap: 0.75rem;">
            <div class="avatar-mini" style="width: 42px; height: 42px; font-size: 1rem;">MS</div>
            <div>
              <h4 style="font-size: 1rem; font-weight: 600;">Manuel Sacaia</h4>
              <p style="font-size: 0.78rem; color: var(--text-dim);">Instalações Eléctricas</p>
            </div>
          </div>
          <div style="margin-top: 1rem; padding-top: 0.75rem; border-top: 1px solid var(--border-soft); display:flex; justify-content:space-between; font-size:0.78rem;">
            <span class="mono-num" style="color: var(--text-dim);">+244 912 222 333</span>
            <span class="mono-num" style="color: var(--amber);">1 Turma</span>
          </div>
        </div>

        <div class="panel" style="padding: 1.25rem; border: 1px solid var(--border);">
          <div style="display:flex; align-items:center; gap: 0.75rem;">
            <div class="avatar-mini" style="width: 42px; height: 42px; font-size: 1rem;">IC</div>
            <div>
              <h4 style="font-size: 1rem; font-weight: 600;">Isabel Chindenga</h4>
              <p style="font-size: 0.78rem; color: var(--text-dim);">Soldagem Industrial</p>
            </div>
          </div>
          <div style="margin-top: 1rem; padding-top: 0.75rem; border-top: 1px solid var(--border-soft); display:flex; justify-content:space-between; font-size:0.78rem;">
            <span class="mono-num" style="color: var(--text-dim);">+244 934 444 555</span>
            <span class="mono-num" style="color: var(--amber);">1 Turma</span>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Criar Docente -->
  <div class="overlay" id="modalNovoDocente">
    <div class="modal">
      <div class="modal-head">
        <h3>Cadastrar Novo Docente</h3>
        <button class="modal-close" type="button">&times;</button>
      </div>
      <form action="#" method="POST" onsubmit="event.preventDefault(); this.closest('.overlay').classList.remove('show');">
        <div class="field">
          <label>Nome Completo</label>
          <input type="text" placeholder="ex.: Prof. Carlos Muatxinene" required>
        </div>
        <div class="field">
          <label>Especialidade Técnica</label>
          <input type="text" placeholder="ex.: Energias Renováveis" required>
        </div>
        <div class="field">
          <label>Telefone / WhatsApp</label>
          <input type="text" placeholder="+244 9XX XXX XXX" required>
        </div>
        <div class="modal-actions">
          <button class="btn-secondary" type="button" data-modal-close>Cancelar</button>
          <button class="btn-primary" type="submit">Guardar Formador</button>
        </div>
      </form>
    </div>
  </div>
@endsection
