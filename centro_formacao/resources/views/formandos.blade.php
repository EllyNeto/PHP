@extends('layout.admin')

@section('title', 'Formandos')
@section('active', 'formandos')
@section('page-title', 'Formandos')
@section('page-subtitle', 'Gestão de formandos ativos e respetivo percurso formativo')

@section('content')
  @if (session('success'))
    <div class="panel" role="status" style="margin-bottom:16px;color:var(--green)">
      {{ session('success') }}
    </div>
  @endif

  <div class="kpi-row">
    <div class="kpi-card">
      <div class="kpi-value mono-num">{{ $totalFormandos }}</div>
      <div class="kpi-label">Formandos aprovados</div>
    </div>
    <div class="kpi-card" style="--kpi-accent:var(--teal)">
      <div class="kpi-value mono-num">{{ $novosEsteMes }}</div>
      <div class="kpi-label">Novos formandos este mês</div>
    </div>
  </div>

  <div class="panel">
    <div class="panel-head">
      <div>
        <div class="panel-title">Lista de formandos</div>
        <div class="panel-sub">Apenas inscrições aprovadas</div>
      </div>
      <button class="btn-primary" id="openStudentModal" type="button">Adicionar formando</button>
    </div>
    <div class="table-wrap">
      <table>
        <thead><tr><th>Formando</th><th>Curso</th><th>Turma</th></tr></thead>
        <tbody>
          @forelse($formandos as $formando)
            <tr>
              <td>
                <div class="formador-cell">
                  <span class="avatar-mini">{{ strtoupper(substr($formando->name, 0, 2)) }}</span>
                  <div class="cell-main">{{ $formando->name }}</div>
                </div>
              </td>
              <td>{{ $formando->course }}</td>
              <td>{{ $formando->class_name }}</td>
            </tr>
          @empty
            <tr><td colspan="3" class="panel-sub">Ainda não existem formandos aprovados.</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

  <div class="overlay" id="studentModal">
    <div class="modal">
      <div class="modal-head">
        <h3>Adicionar formando</h3>
        <button class="modal-close" id="closeStudentModal" type="button" aria-label="Fechar">×</button>
      </div>
      <form method="POST" action="{{ route('formandos.store') }}">
        @csrf
        @if ($inscritosAprovados->isEmpty())
          <p class="panel-sub">Não existem inscrições aprovadas sem turma atribuída.</p>
        @elseif ($turmasDisponiveis->isEmpty())
          <p class="panel-sub">Não existem turmas disponíveis. Crie uma turma antes de adicionar o formando.</p>
        @else
          <div class="field">
            <label for="approved_enrollment">Inscrição aprovada</label>
            <select id="approved_enrollment" name="enrollment_id" required>
              <option value="">Selecione o aluno</option>
              @foreach ($inscritosAprovados as $inscrito)
                <option value="{{ $inscrito->id }}" {{ old('enrollment_id') == $inscrito->id ? 'selected' : '' }}>{{ $inscrito->name }} — {{ $inscrito->course }}</option>
              @endforeach
            </select>
          </div>
          <div class="field">
            <label for="available_class">Turmas disponíveis</label>
            <select id="available_class" name="class_id" required>
              <option value="">Selecione a turma</option>
              @foreach ($turmasDisponiveis as $turma)
                <option value="{{ $turma->id }}" {{ old('class_id') == $turma->id ? 'selected' : '' }}>{{ $turma->room }}{{ $turma->course_name ? ' — ' . $turma->course_name : '' }}</option>
              @endforeach
            </select>
          </div>
        @endif
        @if ($errors->any())<div class="field" role="alert">{{ $errors->first() }}</div>@endif
        <div class="modal-actions">
          <button class="btn-secondary" id="cancelStudentModal" type="button">Cancelar</button>
          @if ($inscritosAprovados->isNotEmpty() && $turmasDisponiveis->isNotEmpty())
            <button class="btn-primary" type="submit">Adicionar à turma</button>
          @endif
        </div>
      </form>
    </div>
  </div>
@endsection

@push('scripts')
  @if ($errors->any())
    <script>document.addEventListener('DOMContentLoaded', function () { document.getElementById('studentModal').classList.add('show'); });</script>
  @endif
@endpush
