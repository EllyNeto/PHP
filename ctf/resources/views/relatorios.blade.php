@extends('layout.admin')

@section('title', 'Relatórios')
@section('active', 'relatorios')
@section('page-title', 'Relatórios Académicos e Financeiros')
@section('page-subtitle', 'Indicadores estatísticos, ocupação de turmas e relatórios executivos')

@section('content')
  <div class="grid-3">
    <div class="panel">
      <div class="panel-head">
        <div>
          <div class="panel-title">Taxa de Conclusão Académica</div>
          <div class="panel-sub">Formandos graduados por trimestre</div>
        </div>
      </div>
      <div class="panel-body" style="display:flex; flex-direction:column; justify-content:space-between; gap: 1rem;">
        <p style="font-size: 0.85rem; color: var(--text-dim); line-height: 1.5;">
          Relatório consolidado sobre a taxa de sucesso dos formandos nos cursos de qualificação e especialização técnica.
        </p>
        <button class="btn-primary" style="align-self: flex-start;">Exportar PDF →</button>
      </div>
    </div>

    <div class="panel">
      <div class="panel-head">
        <div>
          <div class="panel-title">Ocupação das Oficinas e Laboratórios</div>
          <div class="panel-sub">Análise de utilização do espaço físico</div>
        </div>
      </div>
      <div class="panel-body" style="display:flex; flex-direction:column; justify-content:space-between; gap: 1rem;">
        <p style="font-size: 0.85rem; color: var(--text-dim); line-height: 1.5;">
          Comparativo entre a capacidade instalada dos laboratórios do CINFOTEC e a ocupação efetiva por turma.
        </p>
        <button class="btn-primary" style="align-self: flex-start;">Exportar PDF →</button>
      </div>
    </div>

    <div class="panel">
      <div class="panel-head">
        <div>
          <div class="panel-title">Receita de Pagamentos de Cursos</div>
          <div class="panel-sub">Evolução financeira de cursos liquidados</div>
        </div>
      </div>
      <div class="panel-body" style="display:flex; flex-direction:column; justify-content:space-between; gap: 1rem;">
        <p style="font-size: 0.85rem; color: var(--text-dim); line-height: 1.5;">
          Balanço financeiro das receitas arrecadadas com o pagamento único dos cursos face aos valores pendentes de cobrança.
        </p>
        <button class="btn-primary" style="align-self: flex-start;">Exportar Excel →</button>
      </div>
    </div>
  </div>
@endsection
