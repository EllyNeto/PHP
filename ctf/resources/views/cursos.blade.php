@extends('layout.admin')

@section('title', 'Cursos')
@section('active', 'cursos')
@section('page-title', 'Catálogo de Cursos')
@section('page-subtitle', 'Gestão dos cursos técnicos e de especialização ministrados no CINFOTEC')

@section('content')
  @if(session('success'))
    <div style="background: rgba(16, 185, 129, 0.1); border: 1px solid #10b981; border-left: 4px solid #10b981; color: #10b981; padding: 0.85rem 1.1rem; border-radius: 8px; margin-bottom: 1.25rem; font-size: 0.88rem;">
      {{ session('success') }}
    </div>
  @endif

  @if(session('error'))
    <div style="background: rgba(239, 68, 68, 0.12); border: 1px solid #ef4444; border-left: 4px solid #ef4444; color: #ef4444; padding: 0.85rem 1.1rem; border-radius: 8px; margin-bottom: 1.25rem; font-size: 0.88rem;">
      <strong style="display: block; margin-bottom: 0.2rem; font-weight: 700;">⚠️ Erro de Validação:</strong>
      {{ session('error') }}
    </div>
  @endif

  @if(isset($errors) && $errors->any())
    <div style="background: rgba(239, 68, 68, 0.12); border: 1px solid #ef4444; border-left: 4px solid #ef4444; color: #ef4444; padding: 0.85rem 1.1rem; border-radius: 8px; margin-bottom: 1.25rem; font-size: 0.88rem;">
      <strong style="display: block; margin-bottom: 0.4rem; font-weight: 700;">⚠️ Atenção: Foram encontrados erros no formulário que deves retificar:</strong>
      <ul style="margin: 0; padding-left: 1.2rem; display: flex; flex-direction: column; gap: 0.35rem;">
        @foreach($errors->all() as $err)
          <li>{{ $err }}</li>
        @endforeach
      </ul>
    </div>
  @endif

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
        @forelse($cursos ?? [] as $curso)
          <div class="panel" style="padding: 1.25rem; border: 1px solid var(--border); position: relative;">
            <div style="display: flex; justify-content: space-between; align-items: flex-start;">
              <span class="mono-num" style="font-size: 0.72rem; padding: 0.2rem 0.5rem; background: var(--bg); border-radius: 4px; border: 1px solid var(--border); color: var(--amber);">
                CRS-{{ sprintf('%03d', $curso->id) }}
              </span>
              <span class="pill {{ strtolower($curso->type) == 'técnico' ? 'pendente' : (strtolower($curso->type) == 'qualificação' ? 'emcurso' : 'aprovado') }}">
                {{ $curso->type }}
              </span>
            </div>
            <h4 style="font-size: 1.05rem; margin-top: 0.85rem; font-weight: 600;">{{ $curso->name }}</h4>
            <p style="font-size: 0.78rem; color: var(--text-dim); margin-top: 0.25rem;">{{ $curso->description }}</p>
            <div style="margin-top: 1.25rem; display: flex; justify-content: space-between; align-items: center; font-size: 0.78rem; color: var(--text-dim);">
              <span>Duração: {{ $curso->duration }} {{ is_numeric($curso->duration) ? ($curso->duration == 1 ? 'mês' : 'meses') : '' }}</span>
              <button class="btn-primary btn-detalhes-curso" 
                      style="padding: 0.35rem 0.75rem; font-size: 0.78rem;" 
                      data-modal-target="modalDetalhesCurso"
                      data-id="{{ $curso->id }}"
                      data-code="CRS-{{ sprintf('%03d', $curso->id) }}"
                      data-name="{{ $curso->name }}"
                      data-type="{{ $curso->type }}"
                      data-description="{{ $curso->description }}"
                      data-duration="{{ $curso->duration }}">
                Detalhes
              </button>
            </div>
          </div>
        @empty
          <div style="grid-column: 1 / -1; text-align: center; padding: 2rem; color: var(--text-dim);">
            Nenhum curso cadastrado. Clique em "+ Novo Curso" para adicionar.
          </div>
        @endforelse
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
      <form action="{{ route('cursos.store') }}" method="POST">
        @csrf
        <div class="field">
          <label>Nome do Curso</label>
          <input type="text" name="name" placeholder="ex.: Automação e Mecatrónica" required>
        </div>
        <div class="field">
          <label>Tipo do Curso</label>
          <select name="type" required>
            <option value="Técnico">Técnico</option>
            <option value="Qualificação">Qualificação</option>
            <option value="Aperfeiçoamento">Aperfeiçoamento</option>
            <option value="Especialização">Especialização</option>
          </select>
        </div>
        <div class="field">
          <label>Área Técnica / Descrição</label>
          <input type="text" name="description" placeholder="ex.: Tecnologias de Informação" required>
        </div>
        <div class="field">
          <label>Duração (Meses)</label>
          <input type="number" name="duration" min="1" placeholder="ex.: 6" required>
        </div>
        <div class="modal-actions">
          <button class="btn-secondary" type="button" data-modal-close>Cancelar</button>
          <button class="btn-primary" type="submit">Guardar Curso</button>
        </div>
      </form>
    </div>
  </div>

  <!-- Modal Detalhes e Edição do Curso -->
  <div class="overlay" id="modalDetalhesCurso">
    <div class="modal" style="max-width: 580px;">
      <div class="modal-head">
        <div>
          <h3 id="detalhesCursoModalTitle">Detalhes & Edição do Curso</h3>
          <p id="detalhesCursoModalSub" style="font-size:0.75rem; color:var(--text-dim); margin-top:2px;">ID: CRS-000</p>
        </div>
        <button class="modal-close" type="button">&times;</button>
      </div>

      <form id="formEditarCurso" action="" method="POST">
        @csrf
        @method('PUT')

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
          <div class="field" style="grid-column: span 2;">
            <label>ID do Curso (Inalterável)</label>
            <input type="text" id="detalhesCursoCode" readonly disabled style="opacity: 0.7; background: var(--panel-2); font-weight: bold; color: var(--amber);">
          </div>

          <div class="field" style="grid-column: span 2;">
            <label>Nome do Curso</label>
            <input type="text" id="detalhesCursoNome" name="name" required>
          </div>

          <div class="field">
            <label>Tipo do Curso</label>
            <select id="detalhesCursoTipo" name="type" required>
              <option value="Técnico">Técnico</option>
              <option value="Qualificação">Qualificação</option>
              <option value="Aperfeiçoamento">Aperfeiçoamento</option>
              <option value="Especialização">Especialização</option>
            </select>
          </div>

          <div class="field">
            <label>Duração (Meses)</label>
            <input type="number" id="detalhesCursoDuracao" name="duration" min="1" required>
          </div>

          <div class="field" style="grid-column: span 2;">
            <label>Área Técnica / Descrição</label>
            <input type="text" id="detalhesCursoDesc" name="description" required>
          </div>
        </div>

        <div class="modal-actions" style="margin-top: 1.25rem; display: flex; justify-content: space-between; align-items: center;">
          <button class="btn-secondary btn-eliminar-curso-modal" type="button" 
                  style="color: #ef4444; border-color: rgba(239,68,68,0.3); background: rgba(239,68,68,0.06);">
            Eliminar Curso
          </button>
          <div style="display: flex; gap: 0.5rem;">
            <button class="btn-secondary" type="button" data-modal-close>Cancelar</button>
            <button class="btn-primary" type="submit">Guardar Alterações</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <!-- Modal Eliminar Curso (Confirmação) -->
  <div class="overlay" id="modalEliminarCurso">
    <div class="modal" style="max-width: 450px;">
      <div class="modal-head">
        <h3 style="color: #ef4444; display: flex; align-items: center; gap: 0.4rem;">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 0V4a2 2 0 012-2h4a2 2 0 012 2v2"/><line x1="10" y1="11" x2="10" y2="17"/><line x1="14" y1="11" x2="14" y2="17"/></svg>
          Eliminar Curso
        </h3>
        <button class="modal-close" type="button">&times;</button>
      </div>
      <form id="formEliminarCurso" action="" method="POST">
        @csrf
        @method('DELETE')
        <p style="font-size: 0.9rem; color: var(--text-dim); margin-bottom: 1.25rem;">
          Tem certeza de que deseja eliminar o curso <strong id="eliminarNomeCurso" style="color: var(--text);"></strong>? Esta ação moverá o curso para a lixeira (Soft Delete).
        </p>
        <div class="modal-actions" style="display: flex; justify-content: flex-end; gap: 0.5rem;">
          <button class="btn-secondary" type="button" data-modal-close>Cancelar</button>
          <button class="btn-primary" type="submit" style="background: #ef4444; border-color: #ef4444; color: #fff;">Eliminar Curso</button>
        </div>
      </form>
    </div>
  </div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
  let activeCursoId = null;
  let activeCursoNome = '';

  // Abrir Modal de Detalhes & Edição
  document.querySelectorAll('.btn-detalhes-curso').forEach(btn => {
    btn.addEventListener('click', function () {
      const id = this.getAttribute('data-id');
      const code = this.getAttribute('data-code');
      const name = this.getAttribute('data-name');
      const type = this.getAttribute('data-type');
      const description = this.getAttribute('data-description');
      const duration = this.getAttribute('data-duration');

      activeCursoId = id;
      activeCursoNome = name;

      const formEditar = document.getElementById('formEditarCurso');
      if (formEditar) formEditar.action = '/cursos/' + id;

      const titleEl = document.getElementById('detalhesCursoModalTitle');
      if (titleEl) titleEl.textContent = `Detalhes de ${name}`;

      const subEl = document.getElementById('detalhesCursoModalSub');
      if (subEl) subEl.textContent = `ID do Curso: ${code} (Inalterável)`;

      document.getElementById('detalhesCursoCode').value = code || '';
      document.getElementById('detalhesCursoNome').value = name || '';
      document.getElementById('detalhesCursoTipo').value = type || 'Técnico';
      document.getElementById('detalhesCursoDesc').value = description || '';
      document.getElementById('detalhesCursoDuracao').value = duration || '';
    });
  });

  // Botão Eliminar dentro do Modal de Detalhes
  const btnEliminarModal = document.querySelector('.btn-eliminar-curso-modal');
  if (btnEliminarModal) {
    btnEliminarModal.addEventListener('click', function () {
      const modalDetalhes = document.getElementById('modalDetalhesCurso');
      if (modalDetalhes) modalDetalhes.classList.remove('show');

      if (activeCursoId) {
        const formEliminar = document.getElementById('formEliminarCurso');
        if (formEliminar) formEliminar.action = '/cursos/' + activeCursoId;

        const nomeEl = document.getElementById('eliminarNomeCurso');
        if (nomeEl) nomeEl.textContent = activeCursoNome;
      }

      const modalEliminar = document.getElementById('modalEliminarCurso');
      if (modalEliminar) modalEliminar.classList.add('show');
    });
  }
});
</script>
@endpush
