@extends('layout.admin')

@section('title', 'Formandos')
@section('active', 'formandos')
@section('page-title', 'Formandos')
@section('page-subtitle', 'Gestão de formandos ativos e respetivo percurso formativo')

@section('content')
  @php($formandos = $formandos ?? [['nome'=>'Ana Paula Gomes','iniciais'=>'AG','curso'=>'HCIA Data Communications','centro'=>'Talatona','estado'=>'Ativo'],['nome'=>'Mário Kiala','iniciais'=>'MK','curso'=>'Metrologia Dimensional','centro'=>'Rangel','estado'=>'Ativo'],['nome'=>'Helena Tavares','iniciais'=>'HT','curso'=>'Sistemas Fotovoltaicos','centro'=>'Huambo','estado'=>'Concluído'],['nome'=>'José Manuel','iniciais'=>'JM','curso'=>'Mecânica Industrial','centro'=>'Cabinda','estado'=>'Pendente']])
  <div class="kpi-row"><div class="kpi-card"><div class="kpi-value mono-num">2 384</div><div class="kpi-label">Formandos ativos</div></div><div class="kpi-card" style="--kpi-accent:var(--teal)"><div class="kpi-value mono-num">164</div><div class="kpi-label">Novas matrículas este mês</div></div><div class="kpi-card" style="--kpi-accent:var(--green)"><div class="kpi-value mono-num">87%</div><div class="kpi-label">Assiduidade média</div></div><div class="kpi-card" style="--kpi-accent:var(--red)"><div class="kpi-value mono-num">28</div><div class="kpi-label">Documentação pendente</div></div></div>
  <div class="panel"><div class="panel-head"><div><div class="panel-title">Lista de formandos</div><div class="panel-sub">Registos recentes do ano formativo atual</div></div><button class="btn-primary" type="button">Adicionar formando</button></div><div class="table-wrap"><table><thead><tr><th>Formando</th><th>Curso</th><th>Centro</th><th>Estado</th><th></th></tr></thead><tbody>@foreach($formandos as $formando)<tr><td><div class="formador-cell"><span class="avatar-mini">{{ $formando['iniciais'] }}</span><div class="cell-main">{{ $formando['nome'] }}</div></div></td><td>{{ $formando['curso'] }}</td><td>{{ $formando['centro'] }}</td><td><span class="pill emcurso">{{ $formando['estado'] }}</span></td><td><button class="btn-secondary" type="button" style="padding:6px 10px">Ver perfil</button></td></tr>@endforeach</tbody></table></div></div>
@endsection
