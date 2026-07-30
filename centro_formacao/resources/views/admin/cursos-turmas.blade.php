@extends('layout.admin')

@section('title', 'Cursos & Turmas')
@section('active', 'formadores')
@section('page-title', 'Cursos & Turmas')
@section('page-subtitle', 'Planeamento, ocupação e acompanhamento das turmas')

@section('content')
  @php($turmas = $turmas ?? [['curso'=>'HCIA Data Communications','codigo'=>'TI-2026-01','formandos'=>24,'vagas'=>1,'centro'=>'Talatona','estado'=>'Em curso'],['curso'=>'Eletricidade Industrial','codigo'=>'EM-2026-04','formandos'=>18,'vagas'=>6,'centro'=>'Rangel','estado'=>'Em curso'],['curso'=>'Metrologia Aplicada','codigo'=>'MT-2026-02','formandos'=>15,'vagas'=>0,'centro'=>'Talatona','estado'=>'Concluída'],['curso'=>'Sistemas Fotovoltaicos','codigo'=>'ER-2026-03','formandos'=>21,'vagas'=>4,'centro'=>'Huambo','estado'=>'Planeada']])
  <div class="kpi-row"><div class="kpi-card"><div class="kpi-value mono-num">96</div><div class="kpi-label">Turmas em curso</div></div><div class="kpi-card" style="--kpi-accent:var(--teal)"><div class="kpi-value mono-num">28</div><div class="kpi-label">Cursos disponíveis</div></div><div class="kpi-card" style="--kpi-accent:var(--green)"><div class="kpi-value mono-num">82%</div><div class="kpi-label">Ocupação média</div></div><div class="kpi-card" style="--kpi-accent:var(--red)"><div class="kpi-value mono-num">14</div><div class="kpi-label">Turmas com vagas em risco</div></div></div>
  <div class="panel"><div class="panel-head"><div><div class="panel-title">Turmas</div><div class="panel-sub">Calendário formativo de 2026</div></div><button class="btn-primary" type="button">Nova turma</button></div><div class="table-wrap"><table><thead><tr><th>Curso</th><th>Código</th><th>Formandos</th><th>Vagas</th><th>Centro</th><th>Estado</th></tr></thead><tbody>@foreach($turmas as $turma)<tr><td class="cell-main">{{ $turma['curso'] }}</td><td class="mono-num">{{ $turma['codigo'] }}</td><td class="mono-num">{{ $turma['formandos'] }}</td><td class="mono-num">{{ $turma['vagas'] }}</td><td>{{ $turma['centro'] }}</td><td><span class="pill {{ $turma['estado'] === 'Concluída' ? 'concluida' : ($turma['estado'] === 'Planeada' ? 'planeada' : 'emcurso') }}">{{ $turma['estado'] }}</span></td></tr>@endforeach</tbody></table></div></div>
@endsection
