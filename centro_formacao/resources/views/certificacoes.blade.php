@extends('layout.admin')

@section('title', 'Certificações')
@section('active', 'certificacoes')
@section('page-title', 'Certificações')
@section('page-subtitle', 'Emissão, validação e histórico de certificados')

@section('content')
  @php($certificados = $certificados ?? [['numero'=>'CFT-2026-0612','formando'=>'Ana Paula Gomes','curso'=>'HCIA Data Communications','emissao'=>'29 Jul 2026','estado'=>'Emitido'],['numero'=>'CFT-2026-0611','formando'=>'Mário Kiala','curso'=>'Metrologia Aplicada','emissao'=>'28 Jul 2026','estado'=>'Emitido'],['numero'=>'CFT-2026-0610','formando'=>'Helena Tavares','curso'=>'Sistemas Fotovoltaicos','emissao'=>'28 Jul 2026','estado'=>'Em validação'],['numero'=>'CFT-2026-0609','formando'=>'José Manuel','curso'=>'Mecânica Industrial','emissao'=>'27 Jul 2026','estado'=>'Pendente']])
  <div class="kpi-row"><div class="kpi-card" style="--kpi-accent:var(--green)"><div class="kpi-value mono-num">612</div><div class="kpi-label">Emitidos este mês</div></div><div class="kpi-card"><div class="kpi-value mono-num">38</div><div class="kpi-label">Em validação</div></div><div class="kpi-card" style="--kpi-accent:var(--teal)"><div class="kpi-value mono-num">98%</div><div class="kpi-label">Processos concluídos</div></div><div class="kpi-card" style="--kpi-accent:var(--red)"><div class="kpi-value mono-num">7</div><div class="kpi-label">Requerem atenção</div></div></div>
  <div class="panel"><div class="panel-head"><div><div class="panel-title">Certificados recentes</div><div class="panel-sub">Documentos emitidos no ano formativo de 2026</div></div><button class="btn-primary" type="button">Emitir certificado</button></div><div class="table-wrap"><table><thead><tr><th>Número</th><th>Formando</th><th>Curso</th><th>Emissão</th><th>Estado</th></tr></thead><tbody>@foreach($certificados as $certificado)<tr><td class="mono-num">{{ $certificado['numero'] }}</td><td class="cell-main">{{ $certificado['formando'] }}</td><td>{{ $certificado['curso'] }}</td><td class="mono-num">{{ $certificado['emissao'] }}</td><td><span class="pill {{ $certificado['estado'] === 'Emitido' ? 'concluida' : ($certificado['estado'] === 'Em validação' ? 'emcurso' : 'atencao') }}">{{ $certificado['estado'] }}</span></td></tr>@endforeach</tbody></table></div></div>
@endsection
