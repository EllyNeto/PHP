@extends('layout.admin')

@section('title', 'Cursos')
@section('active', 'cursos')
@section('page-title', 'Catálogo de Cursos')
@section('page-subtitle', 'Gestão dos cursos técnicos e de especialização ministrados no CINFOTEC')

@section('content')
  <div class="panel">
    <div class="panel-head">
      <div>
        <div class="panel-title">Cursos Disponíveis</div>
        <div class="panel-sub">Áreas de informação, engenharia e tecnologia</div>
      </div>
      <button class="btn-primary" data-modal-target="modalNovoCurso">+ Novo Curso</button>
    </div>
    <div class="panel-body">
      <div class="grid-3">
        <div class="panel" style="padding: 1.25rem; border: 1px solid var(--border);">
          <div style="display: flex; justify-content: space-between; align-items: flex-start;">
            <span class="mono-num" style="font-size: 0.72rem; padding: 0.2rem 0.5rem; background: var(--bg); border-radius: 4px; border: 1px solid var(--border); color: var(--amber);">TIC-204</span>
            <span class="pill pendente">Técnico</span>
          </div>
          <h4 style="font-size: 1.05rem; margin-top: 0.85rem; font-weight: 600;">Redes e Infraestruturas de TI</h4>
          <p style="font-size: 0.78rem; color: var(--text-dim); margin-top: 0.25rem;">Tecnologias de Informação</p>
          <div style="margin-top: 1.25rem; display: flex; justify-content: space-between; align-items: center; font-size: 0.78rem; color: var(--text-dim);">
            <span>Duração: 9 meses</span>
            <a href="{{ url('/turmas') }}" class="mono-num" style="color: var(--amber); text-decoration:none;">3 Turmas Activas →</a>
          </div>
        </div>

        <div class="panel" style="padding: 1.25rem; border: 1px solid var(--border);">
          <div style="display: flex; justify-content: space-between; align-items: flex-start;">
            <span class="mono-num" style="font-size: 0.72rem; padding: 0.2rem 0.5rem; background: var(--bg); border-radius: 4px; border: 1px solid var(--border); color: var(--amber);">ELM-118</span>
            <span class="pill pendente">Técnico</span>
          </div>
          <h4 style="font-size: 1.05rem; margin-top: 0.85rem; font-weight: 600;">Electricidade Industrial</h4>
          <p style="font-size: 0.78rem; color: var(--text-dim); margin-top: 0.25rem;">Electricidade e Mecatrónica</p>
          <div style="margin-top: 1.25rem; display: flex; justify-content: space-between; align-items: center; font-size: 0.78rem; color: var(--text-dim);">
            <span>Duração: 6 meses</span>
            <a href="{{ url('/turmas') }}" class="mono-num" style="color: var(--amber); text-decoration:none;">2 Turmas Activas →</a>
          </div>
        </div>

        <div class="panel" style="padding: 1.25rem; border: 1px solid var(--border);">
          <div style="display: flex; justify-content: space-between; align-items: flex-start;">
            <span class="mono-num" style="font-size: 0.72rem; padding: 0.2rem 0.5rem; background: var(--bg); border-radius: 4px; border: 1px solid var(--border); color: var(--amber);">MPR-072</span>
            <span class="pill emcurso">Qualificação</span>
          </div>
          <h4 style="font-size: 1.05rem; margin-top: 0.85rem; font-weight: 600;">Soldagem e Caldeiraria</h4>
          <p style="font-size: 0.78rem; color: var(--text-dim); margin-top: 0.25rem;">Mecânica e Produção</p>
          <div style="margin-top: 1.25rem; display: flex; justify-content: space-between; align-items: center; font-size: 0.78rem; color: var(--text-dim);">
            <span>Duração: 4 meses</span>
            <a href="{{ url('/turmas') }}" class="mono-num" style="color: var(--amber); text-decoration:none;">2 Turmas Activas →</a>
          </div>
        </div>

        <div class="panel" style="padding: 1.25rem; border: 1px solid var(--border);">
          <div style="display: flex; justify-content: space-between; align-items: flex-start;">
            <span class="mono-num" style="font-size: 0.72rem; padding: 0.2rem 0.5rem; background: var(--bg); border-radius: 4px; border: 1px solid var(--border); color: var(--amber);">MET-031</span>
            <span class="pill aprovado">Aperfeiçoamento</span>
          </div>
          <h4 style="font-size: 1.05rem; margin-top: 0.85rem; font-weight: 600;">Metrologia Dimensional</h4>
          <p style="font-size: 0.78rem; color: var(--text-dim); margin-top: 0.25rem;">Metrologia</p>
          <div style="margin-top: 1.25rem; display: flex; justify-content: space-between; align-items: center; font-size: 0.78rem; color: var(--text-dim);">
            <span>Duração: 3 meses</span>
            <a href="{{ url('/turmas') }}" class="mono-num" style="color: var(--amber); text-decoration:none;">1 Turma Activa →</a>
          </div>
        </div>

        <div class="panel" style="padding: 1.25rem; border: 1px solid var(--border);">
          <div style="display: flex; justify-content: space-between; align-items: flex-start;">
            <span class="mono-num" style="font-size: 0.72rem; padding: 0.2rem 0.5rem; background: var(--bg); border-radius: 4px; border: 1px solid var(--border); color: var(--amber);">ENR-055</span>
            <span class="pill pendente">Técnico</span>
          </div>
          <h4 style="font-size: 1.05rem; margin-top: 0.85rem; font-weight: 600;">Sistemas Fotovoltaicos</h4>
          <p style="font-size: 0.78rem; color: var(--text-dim); margin-top: 0.25rem;">Energias Renováveis</p>
          <div style="margin-top: 1.25rem; display: flex; justify-content: space-between; align-items: center; font-size: 0.78rem; color: var(--text-dim);">
            <span>Duração: 6 meses</span>
            <a href="{{ url('/turmas') }}" class="mono-num" style="color: var(--amber); text-decoration:none;">2 Turmas Activas →</a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Criar Curso -->
  <div class="overlay" id="modalNovoCurso">
    <div class="modal">
      <div class="modal-head">
        <h3>Adicionar Novo Curso</h3>
        <button class="modal-close" type="button">&times;</button>
      </div>
      <form action="#" method="POST" onsubmit="event.preventDefault(); this.closest('.overlay').classList.remove('show');">
        <div class="field">
          <label>Nome do Curso</label>
          <input type="text" placeholder="ex.: Automação e Mecatrónica" required>
        </div>
        <div class="field">
          <label>Área Técnica</label>
          <select required>
            <option>Tecnologias de Informação</option>
            <option>Electricidade e Mecatrónica</option>
            <option>Mecânica e Produção</option>
            <option>Metrologia</option>
            <option>Energias Renováveis</option>
          </select>
        </div>
        <div class="field">
          <label>Duração (Meses)</label>
          <input type="text" placeholder="ex.: 6 meses" required>
        </div>
        <div class="modal-actions">
          <button class="btn-secondary" type="button" data-modal-close>Cancelar</button>
          <button class="btn-primary" type="submit">Guardar Curso</button>
        </div>
      </form>
    </div>
  </div>
@endsection
