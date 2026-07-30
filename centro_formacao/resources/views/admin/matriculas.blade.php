@extends('layout.admin')

@section('title', 'Matrículas')
@section('active', 'matriculas')
@section('page-title', 'Matrículas')
@section('page-subtitle', 'Acompanhamento das inscrições e respetiva documentação')

@section('content')
  @php($matriculas = $matriculas ?? [['nome'=>'Beatriz Kanda','curso'=>'HCIA Data Communications','data'=>'28 Jul 2026','estado'=>'Confirmada'],['nome'=>'Carlos Mavungo','curso'=>'Eletricidade Industrial','data'=>'27 Jul 2026','estado'=>'Em análise'],['nome'=>'Sofia António','curso'=>'Metrologia Aplicada','data'=>'26 Jul 2026','estado'=>'Documentos pendentes'],['nome'=>'Daniel Chivela','curso'=>'Sistemas Fotovoltaicos','data'=>'24 Jul 2026','estado'=>'Confirmada']])
  <div class="grid-2"><div class="panel"><div class="panel-title">Inscrições recebidas</div><div class="kpi-value mono-num" style="margin-top:18px">164</div><div class="panel-sub">No mês atual, em todos os centros</div></div><div class="panel"><div class="panel-title">Taxa de confirmação</div><div class="kpi-value mono-num" style="margin-top:18px;color:var(--green)">91%</div><div class="panel-sub">Matrículas com processo concluído</div></div></div>
  <div class="panel"><div class="panel-head"><div><div class="panel-title">Matrículas recentes</div><div class="panel-sub">Pedidos submetidos nos últimos dias</div></div><button class="btn-primary" id="openModal" type="button">Nova matrícula</button></div><div class="table-wrap"><table><thead><tr><th>Formando</th><th>Curso</th><th>Data</th><th>Estado</th><th></th></tr></thead><tbody>@foreach($matriculas as $matricula)<tr><td class="cell-main">{{ $matricula['nome'] }}</td><td>{{ $matricula['curso'] }}</td><td class="mono-num">{{ $matricula['data'] }}</td><td><span class="pill {{ $matricula['estado'] === 'Confirmada' ? 'concluida' : ($matricula['estado'] === 'Em análise' ? 'emcurso' : 'atencao') }}">{{ $matricula['estado'] }}</span></td><td><button class="btn-secondary" type="button" style="padding:6px 10px">Detalhes</button></td></tr>@endforeach</tbody></table></div></div>
@endsection
