@extends('layout.admin')

@section('title', 'Matrículas')
@section('active', 'matriculas')
@section('page-title', 'Matrículas em Turmas')
@section('page-subtitle', 'Atribuição de turma e formalização da matrícula dos candidatos pagos')

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

  <div class="kpi-row">
    <div class="kpi-card" style="--kpi-accent:var(--teal); --kpi-accent-dim:var(--teal-dim);">
      <div class="kpi-top">
        <div class="kpi-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><polyline points="16 11 18 13 22 9"/></svg>
        </div>
      </div>
      <div class="kpi-value mono-num">{{ $kpiMatriculados ?? 0 }}</div>
      <div class="kpi-label">Matrículas Efectuadas</div>
    </div>

    <div class="kpi-card" style="--kpi-accent:var(--amber); --kpi-accent-dim:var(--amber-dim);">
      <div class="kpi-top">
        <div class="kpi-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
        </div>
      </div>
      <div class="kpi-value mono-num">{{ $kpiAguardando ?? 0 }}</div>
      <div class="kpi-label">Candidatos Aprovados / Pagos</div>
    </div>
  </div>

  <div class="panel">
    <div class="panel-head">
      <div>
        <div class="panel-title">Matrículas e Atribuição de Turmas</div>
        <div class="panel-sub">Candidatos que completaram o Pagamento nas Finanças (Dados Carregados da Base de Dados)</div>
      </div>
      <button class="btn-primary" data-modal-target="modalNovaMatricula">+ Formalizar Matrícula</button>
    </div>
    <div class="table-wrap">
      <table>
        <thead>
          <tr>
            <th>Nº Matrícula</th>
            <th>Formando</th>
            <th>Curso</th>
            <th>Turma Atribuída</th>
            <th>Acções</th>
          </tr>
        </thead>
        <tbody>
          @forelse($matriculas ?? [] as $m)
            @php
              $matCode = 'MTR-2026-' . str_pad($m->id, 3, '0', STR_PAD_LEFT);
            @endphp
            <tr>
              <td class="mono-num" style="font-weight: 600; color: var(--amber);">{{ $matCode }}</td>
              <td>
                <div class="formador-cell">
                  <div>
                    <div class="cell-main">{{ $m->inscription->name ?? 'Aluno N/D' }}</div>
                    <div class="cell-sub">{{ $m->inscription->email ?? '' }}</div>
                  </div>
                </div>
              </td>
              <td>
                <div class="cell-main">{{ $m->inscription->course ?? 'N/D' }}</div>
              </td>
              <td>
                <div class="cell-main" style="color: var(--amber); font-weight: 600;">
                  {{ $m->classe->code ?? 'Aguardando Turma' }}
                </div>
                <div class="cell-sub">{{ $m->classe->schedule ?? '' }}</div>
              </td>
              <td>
                <button class="btn-primary btn-detalhes-matricula" 
                        style="padding:0.35rem 0.75rem; font-size:0.78rem;" 
                        data-modal-target="modalDetalhesMatricula"
                        data-id="{{ $m->id }}"
                        data-code="{{ $matCode }}"
                        data-aluno="{{ $m->inscription->name ?? 'Aluno N/D' }}"
                        data-curso="{{ $m->inscription->course ?? 'N/D' }}"
                        data-classe-id="{{ $m->classe_id }}">
                  Detalhes
                </button>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="5" style="text-align: center; padding: 2rem; color: var(--text-dim);">
                Nenhuma matrícula efectuada.
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

  <!-- Modal Nova Matrícula -->
  <div class="overlay" id="modalNovaMatricula">
    <div class="modal" style="max-width: 540px;">
      <div class="modal-head">
        <h3>Formalizar Matrícula em Turma</h3>
        <button class="modal-close" type="button">&times;</button>
      </div>
      <form action="{{ route('matriculas.store') }}" method="POST">
        @csrf
        <div class="field">
          <label>Candidato com Pagamento Liquidado</label>
          <select name="inscription_id" required>
            @forelse($candidatosPagos ?? [] as $cand)
              <option value="{{ $cand->id }}">{{ $cand->name }} — {{ $cand->course }} ({{ $cand->bi }})</option>
            @empty
              <option value="" disabled selected>Nenhum candidato encontrado</option>
            @endforelse
          </select>
        </div>
        <div class="field">
          <label>Atribuir a Turma</label>
          <select name="classe_id" required>
            @forelse($turmas ?? [] as $t)
              <option value="{{ $t->id }}">{{ $t->code }} ({{ $t->course_name }} · {{ $t->schedule }})</option>
            @empty
              <option value="" disabled selected>Nenhuma turma cadastrada</option>
            @endforelse
          </select>
        </div>
        <div class="modal-actions">
          <button class="btn-secondary" type="button" data-modal-close>Cancelar</button>
          <button class="btn-primary" type="submit">Concluir Matrícula</button>
        </div>
      </form>
    </div>
  </div>

  <!-- Modal Detalhes & Edição de Matrícula -->
  <div class="overlay" id="modalDetalhesMatricula">
    <div class="modal" style="max-width: 580px;">
      <div class="modal-head">
        <div>
          <h3 id="detalhesMatriculaModalTitle">Detalhes da Matrícula</h3>
          <p id="detalhesMatriculaModalSub" style="font-size:0.75rem; color:var(--text-dim); margin-top:2px;">Código: MTR-2026-000</p>
        </div>
        <button class="modal-close" type="button">&times;</button>
      </div>

      <form id="formEditarMatricula" action="" method="POST">
        @csrf
        @method('PUT')

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.85rem;">
          <div class="field" style="grid-column: span 2;">
            <label>Nº da Matrícula (Inalterável)</label>
            <input type="text" id="detalhesMatriculaCode" readonly disabled style="opacity: 0.7; background: var(--panel-2); font-weight: bold; color: var(--amber);">
          </div>

          <div class="field" style="grid-column: span 2;">
            <label>Formando / Aluno (Inalterável)</label>
            <input type="text" id="detalhesMatriculaAluno" readonly disabled style="opacity: 0.85; background: var(--panel-2);">
          </div>

          <div class="field" style="grid-column: span 2;">
            <label>Curso Pretendido (Inalterável)</label>
            <input type="text" id="detalhesMatriculaCurso" readonly disabled style="opacity: 0.85; background: var(--panel-2);">
          </div>

          <div class="field" style="grid-column: span 2;">
            <label>Turma Atribuída</label>
            <select id="detalhesMatriculaClasse" name="classe_id" required>
              @forelse($turmas ?? [] as $t)
                <option value="{{ $t->id }}">{{ $t->code }} ({{ $t->course_name }} · {{ $t->schedule }})</option>
              @empty
                <option value="" disabled selected>Nenhuma turma cadastrada</option>
              @endforelse
            </select>
          </div>
        </div>

        <div class="modal-actions" style="margin-top: 1rem; display: flex; justify-content: space-between; align-items: center;">
          <button class="btn-secondary btn-eliminar-matricula-modal" type="button" 
                  style="color: #ef4444; border-color: rgba(239,68,68,0.3); background: rgba(239,68,68,0.06);">
            Eliminar Matrícula
          </button>
          <div style="display: flex; gap: 0.5rem;">
            <button class="btn-secondary" type="button" data-modal-close>Cancelar</button>
            <button class="btn-primary" type="submit">Guardar Alterações</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <!-- Modal Confirmar Eliminação de Matrícula -->
  <div class="overlay" id="modalEliminarMatricula">
    <div class="modal" style="max-width: 450px;">
      <div class="modal-head">
        <h3 style="color: #ef4444; display: flex; align-items: center; gap: 0.4rem;">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 0V4a2 2 0 012-2h4a2 2 0 012 2v2"/><line x1="10" y1="11" x2="10" y2="17"/><line x1="14" y1="11" x2="14" y2="17"/></svg>
          Eliminar Matrícula
        </h3>
        <button class="modal-close" type="button">&times;</button>
      </div>
      <form id="formEliminarMatricula" action="" method="POST">
        @csrf
        @method('DELETE')
        <div style="padding: 1rem 0; color: var(--text); font-size: 0.88rem; line-height: 1.5;">
          Tem certeza de que deseja eliminar a matrícula <strong id="eliminarCodeMatricula" style="color: var(--text-heading);"></strong>? Esta acção aplicará o Soft Delete na matrícula.
        </div>
        <div class="modal-actions" style="margin-top: 0.5rem;">
          <button class="btn-secondary" type="button" data-modal-close>Cancelar</button>
          <button class="btn-primary" type="submit" style="background: #ef4444; border-color: #ef4444; color: #fff;">Confirmar Eliminação</button>
        </div>
      </form>
    </div>
  </div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
  let activeMatriculaId = null;
  let activeMatriculaCode = '';

  // Abrir Modal de Detalhes da Matrícula
  document.querySelectorAll('.btn-detalhes-matricula').forEach(btn => {
    btn.addEventListener('click', function () {
      const id = this.getAttribute('data-id');
      const code = this.getAttribute('data-code');
      const aluno = this.getAttribute('data-aluno');
      const curso = this.getAttribute('data-curso');
      const classeId = this.getAttribute('data-classe-id');

      activeMatriculaId = id;
      activeMatriculaCode = code;

      const formEditar = document.getElementById('formEditarMatricula');
      if (formEditar) formEditar.action = '/matriculas/' + id;

      document.getElementById('detalhesMatriculaModalTitle').textContent = `Detalhes da Matrícula ${code}`;
      document.getElementById('detalhesMatriculaModalSub').textContent = `Nº: ${code}`;

      document.getElementById('detalhesMatriculaCode').value = code || '';
      document.getElementById('detalhesMatriculaAluno').value = aluno || '';
      document.getElementById('detalhesMatriculaCurso').value = curso || '';
      document.getElementById('detalhesMatriculaClasse').value = classeId || '';
    });
  });

  // Botão Eliminar dentro do Modal de Detalhes
  const btnEliminarMatriculaModal = document.querySelector('.btn-eliminar-matricula-modal');
  if (btnEliminarMatriculaModal) {
    btnEliminarMatriculaModal.addEventListener('click', function () {
      const modalDetalhes = document.getElementById('modalDetalhesMatricula');
      if (modalDetalhes) modalDetalhes.classList.remove('show');

      if (activeMatriculaId) {
        const formEliminar = document.getElementById('formEliminarMatricula');
        if (formEliminar) formEliminar.action = '/matriculas/' + activeMatriculaId;

        const codeEl = document.getElementById('eliminarCodeMatricula');
        if (codeEl) codeEl.textContent = activeMatriculaCode;
      }

      const modalEliminar = document.getElementById('modalEliminarMatricula');
      if (modalEliminar) modalEliminar.classList.add('show');
    });
  }
});
</script>
@endpush
