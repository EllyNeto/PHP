@extends('layout.admin')

@section('title', 'Turmas')
@section('active', 'turmas')
@section('page-title', 'Organização de Turmas')
@section('page-subtitle', 'Gestão de horários, ocupação de laboratórios e formadores responsáveis')

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
        <div class="panel-title">Turmas em Funcionamento</div>
        <div class="panel-sub">Lista completa de turmas e horários de aulas</div>
      </div>
      <button class="btn-primary" data-modal-target="modalNovaTurma">+ Nova Turma</button>
    </div>
    <div class="table-wrap">
      <table>
        <thead>
          <tr>
            <th>Código Turma</th>
            <th>Curso Associado</th>
            <th>Formador</th>
            <th>Horário</th>
            <th>Vagas / Ocupação</th>
            <th>Estado</th>
            <th>Acção</th>
          </tr>
        </thead>
        <tbody>
          @forelse($turmas ?? [] as $turma)
            @php
              $capacity = max(1, $turma->capacity);
              $enrolled = $turma->enrolled_count;
              $percent = min(100, round(($enrolled / $capacity) * 100));
              $barColor = $percent >= 90 ? 'var(--amber)' : ($percent >= 50 ? 'var(--teal)' : 'var(--green)');
              $statusClass = strtolower($turma->status) == 'a iniciar' ? 'ainiciar' : (strtolower($turma->status) == 'concluído' ? 'aprovado' : 'emcurso');
            @endphp
            <tr>
              <td class="mono-num" style="font-weight: 600; color: var(--amber);">{{ $turma->code }}</td>
              <td class="cell-main">{{ $turma->course_name ?? ($turma->course->name ?? 'N/D') }}</td>
              <td>{{ $turma->teacher_name ?? ($turma->teacher->name ?? 'N/D') }}</td>
              <td class="cell-sub">{{ $turma->schedule }}</td>
              <td>
                <div style="display:flex; align-items:center; gap: 0.5rem;">
                  <div style="width: 80px; height: 6px; background: var(--panel-2); border-radius: 999px; overflow:hidden;">
                    <div style="width: {{ $percent }}%; height:100%; background: {{ $barColor }};"></div>
                  </div>
                  <span class="mono-num" style="font-size: 0.75rem;">{{ $enrolled }}/{{ $capacity }}</span>
                </div>
              </td>
              <td><span class="pill {{ $statusClass }}">{{ $turma->status }}</span></td>
              <td>
                <button class="btn-primary btn-detalhes-turma" 
                        style="padding:0.35rem 0.75rem; font-size:0.78rem;" 
                        data-modal-target="modalDetalhesTurma"
                        data-id="{{ $turma->id }}"
                        data-code="{{ $turma->code }}"
                        data-course="{{ $turma->course_name }}"
                        data-teacher="{{ $turma->teacher_name }}"
                        data-schedule="{{ $turma->schedule }}"
                        data-enrolled="{{ $turma->enrolled_count }}"
                        data-capacity="{{ $turma->capacity }}"
                        data-status="{{ $turma->status }}">
                  Detalhes
                </button>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="7" style="text-align: center; padding: 2rem; color: var(--text-dim);">
                Nenhuma turma cadastrada.
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

  <!-- Modal Criar Turma -->
  <div class="overlay" id="modalNovaTurma">
    <div class="modal">
      <div class="modal-head">
        <h3>Criar Nova Turma</h3>
        <button class="modal-close" type="button">&times;</button>
      </div>
      <form action="{{ route('turmas.store') }}" method="POST">
        @csrf
        <div class="field">
          <label>Curso Associado</label>
          <select name="course_name" required>
            @forelse($cursos ?? [] as $c)
              <option value="{{ $c->name }}">{{ $c->name }}</option>
            @empty
              <option value="" disabled selected>Nenhum curso cadastrado</option>
            @endforelse
          </select>
        </div>
        <div class="field">
          <label>Formador Responsável</label>
          <select name="teacher_name" required>
            @forelse($formadores ?? ($docentes ?? []) as $d)
              <option value="{{ $d->name }}">{{ $d->name }}</option>
            @empty
              <option value="" disabled selected>Nenhum formador cadastrado</option>
            @endforelse
          </select>
        </div>
        <div class="field">
          <label>Horário das Aulas</label>
          <input type="text" name="schedule" placeholder="ex.: Seg/Qua/Sex · 08h–12h" required>
        </div>
        <div class="field">
          <label>Vagas Máximas</label>
          <input type="number" name="capacity" placeholder="25" min="1" required>
        </div>
        <div class="modal-actions">
          <button class="btn-secondary" type="button" data-modal-close>Cancelar</button>
          <button class="btn-primary" type="submit">Criar Turma</button>
        </div>
      </form>
    </div>
  </div>

  <!-- Modal Detalhes & Edição de Turma -->
  <div class="overlay" id="modalDetalhesTurma">
    <div class="modal" style="max-width: 580px;">
      <div class="modal-head">
        <div>
          <h3 id="detalhesTurmaModalTitle">Detalhes & Edição da Turma</h3>
          <p id="detalhesTurmaModalSub" style="font-size:0.75rem; color:var(--text-dim); margin-top:2px;">Código: T-TRM000-A</p>
        </div>
        <button class="modal-close" type="button">&times;</button>
      </div>

      <form id="formEditarTurma" action="" method="POST">
        @csrf
        @method('PUT')

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.85rem;">
          <div class="field" style="grid-column: span 2;">
            <label>Código da Turma (Inalterável)</label>
            <input type="text" id="detalhesTurmaCode" readonly disabled style="opacity: 0.7; background: var(--panel-2); font-weight: bold; color: var(--amber);">
          </div>

          <div class="field" style="grid-column: span 2;">
            <label>Curso Associado</label>
            <select id="detalhesTurmaCourse" name="course_name" required>
              @forelse($cursos ?? [] as $c)
                <option value="{{ $c->name }}">{{ $c->name }}</option>
              @empty
                <option value="" disabled selected>Nenhum curso cadastrado</option>
              @endforelse
            </select>
          </div>

          <div class="field" style="grid-column: span 2;">
            <label>Formador Responsável</label>
            <select id="detalhesTurmaTeacher" name="teacher_name" required>
              @forelse($formadores ?? ($docentes ?? []) as $d)
                <option value="{{ $d->name }}">{{ $d->name }}</option>
              @empty
                <option value="" disabled selected>Nenhum formador cadastrado</option>
              @endforelse
            </select>
          </div>

          <div class="field" style="grid-column: span 2;">
            <label>Horário das Aulas</label>
            <input type="text" id="detalhesTurmaSchedule" name="schedule" required>
          </div>

          <div class="field">
            <label>Inscritos Atuais (Automático)</label>
            <input type="number" id="detalhesTurmaEnrolled" readonly disabled style="opacity: 0.75; background: var(--panel-2); font-weight: 600;">
          </div>

          <div class="field">
            <label>Vagas Máximas</label>
            <input type="number" id="detalhesTurmaCapacity" name="capacity" min="1" required>
          </div>

          <div class="field" style="grid-column: span 2;">
            <label>Estado da Turma</label>
            <select id="detalhesTurmaStatus" name="status" required>
              <option value="Em Curso">Em Curso</option>
              <option value="A Iniciar">A Iniciar</option>
              <option value="Concluído">Concluído</option>
            </select>
          </div>
        </div>

        <div class="modal-actions" style="margin-top: 1rem; display: flex; justify-content: space-between; align-items: center;">
          <button class="btn-secondary btn-eliminar-turma-modal" type="button" 
                  style="color: #ef4444; border-color: rgba(239,68,68,0.3); background: rgba(239,68,68,0.06);">
            Eliminar Turma
          </button>
          <div style="display: flex; gap: 0.5rem;">
            <button class="btn-secondary" type="button" data-modal-close>Cancelar</button>
            <button class="btn-primary" type="submit">Guardar Alterações</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <!-- Modal Confirmar Eliminação de Turma -->
  <div class="overlay" id="modalEliminarTurma">
    <div class="modal" style="max-width: 450px;">
      <div class="modal-head">
        <h3 style="color: #ef4444; display: flex; align-items: center; gap: 0.4rem;">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 0V4a2 2 0 012-2h4a2 2 0 012 2v2"/><line x1="10" y1="11" x2="10" y2="17"/><line x1="14" y1="11" x2="14" y2="17"/></svg>
          Eliminar Turma
        </h3>
        <button class="modal-close" type="button">&times;</button>
      </div>
      <form id="formEliminarTurma" action="" method="POST">
        @csrf
        @method('DELETE')
        <div style="padding: 1rem 0; color: var(--text); font-size: 0.88rem; line-height: 1.5;">
          Tem certeza de que deseja eliminar a turma <strong id="eliminarCodeTurma" style="color: var(--text-heading);"></strong>? Esta acção moverá a turma para a lixeira (Soft Delete).
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
  let activeTurmaId = null;
  let activeTurmaCode = '';

  // Abrir Modal de Detalhes da Turma
  document.querySelectorAll('.btn-detalhes-turma').forEach(btn => {
    btn.addEventListener('click', function () {
      const id = this.getAttribute('data-id');
      const code = this.getAttribute('data-code');
      const course = this.getAttribute('data-course');
      const teacher = this.getAttribute('data-teacher');
      const schedule = this.getAttribute('data-schedule');
      const enrolled = this.getAttribute('data-enrolled');
      const capacity = this.getAttribute('data-capacity');
      const status = this.getAttribute('data-status');

      activeTurmaId = id;
      activeTurmaCode = code;

      const formEditar = document.getElementById('formEditarTurma');
      if (formEditar) formEditar.action = '/turmas/' + id;

      document.getElementById('detalhesTurmaModalTitle').textContent = `Detalhes da Turma ${code}`;
      document.getElementById('detalhesTurmaModalSub').textContent = `Código: ${code} (Inalterável)`;

      document.getElementById('detalhesTurmaCode').value = code || '';
      document.getElementById('detalhesTurmaCourse').value = course || '';
      document.getElementById('detalhesTurmaTeacher').value = teacher || '';
      document.getElementById('detalhesTurmaSchedule').value = schedule || '';
      document.getElementById('detalhesTurmaEnrolled').value = enrolled || '0';
      document.getElementById('detalhesTurmaCapacity').value = capacity || '25';
      document.getElementById('detalhesTurmaStatus').value = status || 'Em Curso';
    });
  });

  // Botão Eliminar dentro do Modal de Detalhes
  const btnEliminarTurmaModal = document.querySelector('.btn-eliminar-turma-modal');
  if (btnEliminarTurmaModal) {
    btnEliminarTurmaModal.addEventListener('click', function () {
      const modalDetalhes = document.getElementById('modalDetalhesTurma');
      if (modalDetalhes) modalDetalhes.classList.remove('show');

      if (activeTurmaId) {
        const formEliminar = document.getElementById('formEliminarTurma');
        if (formEliminar) formEliminar.action = '/turmas/' + activeTurmaId;

        const codeEl = document.getElementById('eliminarCodeTurma');
        if (codeEl) codeEl.textContent = activeTurmaCode;
      }

      const modalEliminar = document.getElementById('modalEliminarTurma');
      if (modalEliminar) modalEliminar.classList.add('show');
    });
  }
});
</script>
@endpush
