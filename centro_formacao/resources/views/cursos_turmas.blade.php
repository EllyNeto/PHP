@extends('layout.admin')

@section('title', 'Cursos e Turmas')
@section('active', 'formadores')
@section('page-title', 'Cursos e Turmas')
@section('page-subtitle', 'Planeamento, ocupação e acompanhamento das turmas')

@section('content')
  @if (session('success'))
    <div class="panel" role="status" style="margin-bottom:16px;color:var(--green)">{{ session('success') }}</div>
  @endif

  <div class="kpi-row">
    <div class="kpi-card"><div class="kpi-value mono-num">{{ $turmasEmCurso }}</div><div class="kpi-label">Turmas em curso</div></div>
    <div class="kpi-card" style="--kpi-accent:var(--teal)"><div class="kpi-value mono-num">{{ $turmas->count() }}</div><div class="kpi-label">Turmas registadas</div></div>
    <div class="kpi-card" style="--kpi-accent:var(--green)"><div class="kpi-value mono-num">{{ $ocupacaoMedia }}%</div><div class="kpi-label">Ocupação média</div></div>
    <div class="kpi-card" style="--kpi-accent:var(--red)"><div class="kpi-value mono-num">{{ $capacidadeTotal }}</div><div class="kpi-label">Capacidade total</div></div>
  </div>

  {{-- ==================== PAINEL: CURSOS ==================== --}}
  <div class="panel" style="margin-bottom:20px;">
    <div class="panel-head">
      <div>
        <div class="panel-title">Cursos Registados</div>
        <div class="panel-sub">Lista de cursos disponíveis no centro de formação</div>
      </div>
      <button class="btn-primary" id="openCourseModal" type="button">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" style="width:14px;height:14px;"><path d="M12 5v14M5 12h14"/></svg>
        <span>Adicionar Curso</span>
      </button>
    </div>
    <div class="table-wrap">
      <table>
        <thead>
          <tr>
            <th>Nome do Curso</th>
            <th>Duração</th>
            <th>Preço</th>
            <th>Descrição</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($cursos as $curso)
            <tr>
              <td class="cell-main">{{ $curso->name }}</td>
              <td class="mono-num">{{ $curso->duration }}h</td>
              <td class="mono-num">{{ number_format($curso->price, 2, ',', '.') }} Kz</td>
              <td style="max-width:280px; overflow:hidden; text-overflow:ellipsis; white-space:nowrap; color:var(--text-dim);">
                {{ $curso->description ?: 'Sem descrição' }}
              </td>
              <td>
                <button class="btn-secondary btn-detalhes-curso" type="button"
                  data-id="{{ $curso->id }}"
                  data-name="{{ $curso->name }}"
                  data-description="{{ $curso->description }}"
                  data-duration="{{ $curso->duration }}"
                  data-price="{{ $curso->price }}"
                  style="padding:6px 10px;">Detalhes</button>
              </td>
            </tr>
          @empty
            <tr><td colspan="5" class="panel-sub">Ainda não existem cursos registados.</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

  {{-- ==================== PAINEL: TURMAS ==================== --}}
  <div class="panel">
    <div class="panel-head">
      <div><div class="panel-title">Turmas</div><div class="panel-sub">Registos guardados na base de dados</div></div>
      <button class="btn-primary" id="openClassModal" type="button">Nova turma</button>
    </div>
    <div class="table-wrap">
      <table>
        <thead>
          <tr>
            <th>Curso</th>
            <th>Turma</th>
            <th>Professor</th>
            <th>Turno</th>
            <th>Horário</th>
            <th>Alunos</th>
            <th>Capacidade</th>
            <th>Estado</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($turmas as $turma)
            <tr>
              <td class="cell-main">{{ $turma->course_name ?: 'Não definido' }}</td>
              <td class="mono-num">{{ $turma->room }}</td>
              <td>{{ $turma->teacher_name ?: 'Não definido' }}</td>
              <td><span class="panel-tag">{{ $turma->shift ?: 'Manhã' }}</span></td>
              <td class="mono-num">{{ $turma->schedule ?: '-' }}</td>
              <td class="mono-num">{{ $turma->student_count }}</td>
              <td class="mono-num">{{ $turma->capacity }}</td>
              <td><span class="pill {{ $turma->status === 'Concluída' ? 'concluida' : ($turma->status === 'Planeada' ? 'planeada' : 'emcurso') }}">{{ $turma->status }}</span></td>
              <td>
                <button class="btn-secondary btn-detalhes-turma" type="button"
                  data-id="{{ $turma->id }}"
                  data-course="{{ $turma->course_name }}"
                  data-room="{{ $turma->room }}"
                  data-teacher="{{ $turma->teacher_name }}"
                  data-shift="{{ $turma->shift ?: 'Manhã' }}"
                  data-schedule="{{ $turma->schedule }}"
                  data-capacity="{{ $turma->capacity }}"
                  data-status="{{ $turma->status }}"
                  style="padding:6px 10px;">Detalhes</button>
              </td>
            </tr>
          @empty
            <tr><td colspan="9" class="panel-sub">Ainda não existem turmas registadas.</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

  {{-- ==================== MODAL: NOVA TURMA ==================== --}}
  <div class="overlay" id="classModal">
    <div class="modal">
      <div class="modal-head"><h3>Nova turma</h3><button class="modal-close" id="closeClassModal" type="button" aria-label="Fechar">×</button></div>
      <form method="POST" action="{{ route('turmas.store') }}">
        @csrf
        <div class="field">
          <label for="class_course">Curso</label>
          <select id="class_course" name="course_name" required {{ $cursos->isEmpty() ? 'disabled' : '' }}>
            @if ($cursos->isEmpty())
              <option value="">Adicione um curso primeiro</option>
            @else
              <option value="">Selecione o curso</option>
              @foreach ($cursos as $curso)
                <option value="{{ $curso->name }}" {{ old('course_name') === $curso->name ? 'selected' : '' }}>{{ $curso->name }}</option>
              @endforeach
            @endif
          </select>
        </div>
        <div class="field"><label for="class_room">Turma / código</label><input id="class_room" name="room" maxlength="20" value="{{ old('room') }}" placeholder="Ex: TI-2026-01" required></div>
        <div class="field"><label for="class_teacher">Nome do professor</label><input id="class_teacher" name="teacher_name" maxlength="255" value="{{ old('teacher_name') }}" required></div>
        <div class="field">
          <label for="class_shift">Turno</label>
          <select id="class_shift" name="shift" required>
            <option value="Manhã" {{ old('shift', 'Manhã') === 'Manhã' ? 'selected' : '' }}>Manhã</option>
            <option value="Tarde" {{ old('shift') === 'Tarde' ? 'selected' : '' }}>Tarde</option>
            <option value="Noite" {{ old('shift') === 'Noite' ? 'selected' : '' }}>Noite</option>
          </select>
        </div>
        <div class="field"><label for="class_schedule">Horário</label><input id="class_schedule" name="schedule" maxlength="100" value="{{ old('schedule') }}" placeholder="Ex: 08:00 - 12:00"></div>
        <div class="field"><label for="class_capacity">Capacidade de alunos</label><input id="class_capacity" type="number" name="capacity" min="1" max="1000" value="{{ old('capacity') }}" required></div>
        <div class="field">
          <label for="class_status">Estado</label>
          <select id="class_status" name="status" required>
            <option value="Planeada" {{ old('status', 'Planeada') === 'Planeada' ? 'selected' : '' }}>Planeada</option>
            <option value="Em curso" {{ old('status') === 'Em curso' ? 'selected' : '' }}>Em curso</option>
            <option value="Concluída" {{ old('status') === 'Concluída' ? 'selected' : '' }}>Concluída</option>
          </select>
        </div>
        @if ($errors->any())<div class="field" role="alert">{{ $errors->first() }}</div>@endif
        <div class="modal-actions"><button class="btn-secondary" id="cancelClassModal" type="button">Cancelar</button>@if ($cursos->isNotEmpty())<button class="btn-primary" type="submit">Guardar turma</button>@endif</div>
      </form>
    </div>
  </div>

  {{-- ==================== MODAL: ADICIONAR CURSO ==================== --}}
  <div class="overlay" id="courseModal">
    <div class="modal">
      <div class="modal-head"><h3>Adicionar curso</h3><button class="modal-close" id="closeCourseModal" type="button" aria-label="Fechar">×</button></div>
      <form method="POST" action="{{ route('cursos.store') }}">
        @csrf
        <div class="field"><label for="course_name">Nome do curso</label><input id="course_name" name="name" maxlength="100" value="{{ old('name') }}" required></div>
        <div class="field"><label for="course_description">Descrição</label><input id="course_description" name="description" value="{{ old('description') }}"></div>
        <div class="field"><label for="course_duration">Duração (horas)</label><input id="course_duration" type="number" name="duration" min="1" value="{{ old('duration') }}" required></div>
        <div class="field"><label for="course_price">Preço (Kz)</label><input id="course_price" type="number" name="price" min="0" step="0.01" value="{{ old('price') }}" required></div>
        <div class="modal-actions"><button class="btn-secondary" id="cancelCourseModal" type="button">Cancelar</button><button class="btn-primary" type="submit">Guardar curso</button></div>
      </form>
    </div>
  </div>

  {{-- ==================== MODAL: DETALHES / EDITAR CURSO ==================== --}}
  <div class="overlay" id="courseDetailsModal">
    <div class="modal">
      <div class="modal-head">
        <h3>Detalhes do Curso</h3>
        <button class="modal-close" id="closeCourseDetailsModal" type="button" aria-label="Fechar">×</button>
      </div>
      <form id="courseDetailsForm" method="POST" action="">
        @csrf
        @method('PUT')
        <div class="field"><label for="detail_course_name">Nome do curso</label><input id="detail_course_name" name="name" maxlength="100" required></div>
        <div class="field"><label for="detail_course_description">Descrição</label><input id="detail_course_description" name="description"></div>
        <div class="field"><label for="detail_course_duration">Duração (horas)</label><input id="detail_course_duration" type="number" name="duration" min="1" required></div>
        <div class="field"><label for="detail_course_price">Preço (Kz)</label><input id="detail_course_price" type="number" name="price" min="0" step="0.01" required></div>
        <div class="modal-actions" style="display:flex; justify-content:space-between; align-items:center; gap:8px;">
          <button type="submit" form="deleteCourseForm" class="btn-danger" onclick="return confirm('Tem a certeza que pretende eliminar este curso?');">Eliminar</button>
          <div style="display:flex; gap:8px; flex:1; justify-content:flex-end;">
            <button class="btn-secondary" id="cancelCourseDetailsModal" type="button" style="flex:initial; padding:10px 16px;">Cancelar</button>
            <button class="btn-primary" style="justify-content:center; flex:initial; padding:10px 16px;" type="submit">Guardar Alterações</button>
          </div>
        </div>
      </form>
      <form id="deleteCourseForm" method="POST" action="" style="display:none;">
        @csrf
        @method('DELETE')
      </form>
    </div>
  </div>

  {{-- ==================== MODAL: DETALHES / EDITAR TURMA ==================== --}}
  <div class="overlay" id="classDetailsModal">
    <div class="modal">
      <div class="modal-head">
        <h3>Detalhes da Turma</h3>
        <button class="modal-close" id="closeClassDetailsModal" type="button" aria-label="Fechar">×</button>
      </div>
      <form id="classDetailsForm" method="POST" action="">
        @csrf
        @method('PUT')
        <div class="field">
          <label for="detail_class_course">Curso</label>
          <select id="detail_class_course" name="course_name" required>
            @foreach ($cursos as $curso)
              <option value="{{ $curso->name }}">{{ $curso->name }}</option>
            @endforeach
          </select>
        </div>
        <div class="field"><label for="detail_class_room">Turma / código</label><input id="detail_class_room" name="room" maxlength="20" required></div>
        <div class="field"><label for="detail_class_teacher">Nome do professor</label><input id="detail_class_teacher" name="teacher_name" maxlength="255" required></div>
        <div class="field">
          <label for="detail_class_shift">Turno</label>
          <select id="detail_class_shift" name="shift" required>
            <option value="Manhã">Manhã</option>
            <option value="Tarde">Tarde</option>
            <option value="Noite">Noite</option>
          </select>
        </div>
        <div class="field"><label for="detail_class_schedule">Horário</label><input id="detail_class_schedule" name="schedule" maxlength="100" placeholder="Ex: 08:00 - 12:00"></div>
        <div class="field"><label for="detail_class_capacity">Capacidade de alunos</label><input id="detail_class_capacity" type="number" name="capacity" min="1" max="1000" required></div>
        <div class="field">
          <label for="detail_class_status">Estado</label>
          <select id="detail_class_status" name="status" required>
            <option value="Planeada">Planeada</option>
            <option value="Em curso">Em curso</option>
            <option value="Concluída">Concluída</option>
          </select>
        </div>
        <div class="modal-actions" style="display:flex; justify-content:space-between; align-items:center; gap:8px;">
          <button type="submit" form="deleteClassForm" class="btn-danger" onclick="return confirm('Tem a certeza que pretende eliminar esta turma?');">Eliminar</button>
          <div style="display:flex; gap:8px; flex:1; justify-content:flex-end;">
            <button class="btn-secondary" id="cancelClassDetailsModal" type="button" style="flex:initial; padding:10px 16px;">Cancelar</button>
            <button class="btn-primary" style="justify-content:center; flex:initial; padding:10px 16px;" type="submit">Guardar Alterações</button>
          </div>
        </div>
      </form>
      <form id="deleteClassForm" method="POST" action="" style="display:none;">
        @csrf
        @method('DELETE')
      </form>
    </div>
  </div>
@endsection

@push('scripts')
  @if ($errors->any())
    <script>document.addEventListener('DOMContentLoaded', function () { document.getElementById('{{ $errors->has('duration') || $errors->has('price') || $errors->has('description') ? 'courseModal' : 'classModal' }}').classList.add('show'); });</script>
  @endif
@endpush
