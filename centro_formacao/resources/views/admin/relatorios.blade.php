@extends('layout.admin')

@section('title', 'Relatórios')
@section('active', 'relatorios')
@section('page-title', 'Relatórios')
@section('page-subtitle', 'Indicadores operacionais e exportação de informação')

@section('content')
  @php($relatorios = $relatorios ?? [['titulo'=>'Desempenho por centro','descricao'=>'Matrículas, ocupação e conclusões por centro.','periodo'=>'Julho 2026'],['titulo'=>'Assiduidade de formandos','descricao'=>'Registo de presenças por curso e turma.','periodo'=>'2.º trimestre'],['titulo'=>'Certificações emitidas','descricao'=>'Certificados concluídos e em validação.','periodo'=>'Julho 2026'],['titulo'=>'Empregabilidade','descricao'=>'Inserção profissional até seis meses após a conclusão.','periodo'=>'Ano 2026']])
  <div class="grid-2"><div class="panel"><div class="panel-title">Conclusão média</div><div class="kpi-value mono-num" style="margin-top:18px;color:var(--teal)">87%</div><div class="panel-sub">+6 pontos percentuais face ao período anterior</div></div><div class="panel"><div class="panel-title">Empregabilidade</div><div class="kpi-value mono-num" style="margin-top:18px;color:var(--amber)">85%</div><div class="panel-sub">Formandos colocados até seis meses</div></div></div>
  <div class="panel"><div class="panel-head"><div><div class="panel-title">Relatórios disponíveis</div><div class="panel-sub">Gera uma versão atualizada com os dados selecionados</div></div><div class="panel-tag">4 modelos</div></div><div class="table-wrap"><table><thead><tr><th>Relatório</th><th>Descrição</th><th>Período</th><th></th></tr></thead><tbody>@foreach($relatorios as $relatorio)<tr><td class="cell-main">{{ $relatorio['titulo'] }}</td><td class="cell-sub">{{ $relatorio['descricao'] }}</td><td class="mono-num">{{ $relatorio['periodo'] }}</td><td><button class="btn-primary" type="button">Exportar</button></td></tr>@endforeach</tbody></table></div></div>
@endsection
