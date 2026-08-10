@extends('layout.admin')

@section('title', 'Visão Geral')
@section('active', 'visao')
@section('page-title', 'Visão Geral')
@section('page-subtitle', 'Resumo atualizado dos dados registados no sistema')

@section('content')
  <!-- ROW 1: KPIs em Grelha Responsiva -->
  <div class="kpi-row">
    <div class="kpi-card" style="--kpi-accent:var(--teal); --kpi-accent-dim:var(--teal-dim);">
      <div class="kpi-top">
        <div class="kpi-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M22 10L12 5 2 10l10 5 10-5z"/><path d="M6 12v5c0 1.5 3 3 6 3s6-1.5 6-3v-5"/></svg>
        </div>
      </div>
      <div class="kpi-value mono-num">812</div>
      <div class="kpi-label">Formandos Activos</div>
      <div class="kpi-trend up">↑ +38 este trimestre</div>
    </div>

    <div class="kpi-card" style="--kpi-accent:var(--amber); --kpi-accent-dim:var(--amber-dim);">
      <div class="kpi-top">
        <div class="kpi-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
        </div>
      </div>
      <div class="kpi-value mono-num">27</div>
      <div class="kpi-label">Turmas em Curso</div>
      <div class="kpi-trend up">↑ 4 a iniciar brevemente</div>
    </div>

    <div class="kpi-card" style="--kpi-accent:var(--green); --kpi-accent-dim:var(--green-dim);">
      <div class="kpi-top">
        <div class="kpi-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
        </div>
      </div>
      <div class="kpi-value mono-num">86%</div>
      <div class="kpi-label">Taxa de Ocupação</div>
      <div class="kpi-trend up">↑ +5% face ao trimestre anterior</div>
    </div>

    <div class="kpi-card" style="--kpi-accent:var(--red); --kpi-accent-dim:var(--red-dim);">
      <div class="kpi-top">
        <div class="kpi-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
        </div>
      </div>
      <div class="kpi-value mono-num">12.6%</div>
      <div class="kpi-label">Inadimplência</div>
      <div class="kpi-trend down">↑ +1.2% em relação à meta</div>
    </div>
  </div>

  <!-- ROW 2: Gráficos e Gauge Visual -->
  <div class="grid-2">
    <div class="panel">
      <div class="panel-head">
        <div>
          <div class="panel-title">Inscrições por Área Técnica</div>
          <div class="panel-sub">Distribuição dos candidatos registados</div>
        </div>
        <span class="panel-tag">2026</span>
      </div>
      <div class="panel-body">
        <div class="chart-box">
          <canvas id="chartAreas"></canvas>
        </div>
      </div>
    </div>

    <div class="panel">
      <div class="panel-head">
        <div>
          <div class="panel-title">Aproveitamento Académico</div>
          <div class="panel-sub">Taxa média de aprovação global</div>
        </div>
        <span class="panel-tag">CINFOTEC</span>
      </div>
      <div class="panel-body" style="display:flex; flex-direction:column; align-items:center; justify-content:center;">
        <div class="gauge-wrap">
          <svg class="gauge-svg" viewBox="0 0 100 100">
            <circle cx="50" cy="50" r="40" fill="none" stroke="var(--panel-2)" stroke-width="10" />
            <circle cx="50" cy="50" r="40" fill="none" stroke="var(--teal)" stroke-width="10" stroke-dasharray="251.2" stroke-dashoffset="37.6" stroke-linecap="round" transform="rotate(-90 50 50)" />
          </svg>
          <div class="gauge-text">
            <div class="gauge-val">85%</div>
            <div class="gauge-lbl">Aprovados</div>
          </div>
        </div>
        <p style="font-size: 0.78rem; color: var(--text-dim); text-align: center; margin-top: 0.5rem;">
          690 de 812 formandos atingiram nota superior a 14 valores.
        </p>
      </div>
    </div>
  </div>

  <!-- ROW 3: Tabela de Inscrições Recentes -->
  <div class="panel">
    <div class="panel-head">
      <div>
        <div class="panel-title">Últimas Inscrições Registadas</div>
        <div class="panel-sub">Candidaturas submetidas no portal</div>
      </div>
      <a href="{{ url('/matriculas') }}" class="panel-tag" style="text-decoration:none;">Ver todas →</a>
    </div>
    <div class="table-wrap">
      <table>
        <thead>
          <tr>
            <th>Candidato</th>
            <th>Curso Pretendido</th>
            <th>Data</th>
            <th>Estado</th>
            <th>Acção</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>
              <div class="formador-cell">
                <span class="avatar-mini">DK</span>
                <div>
                  <div class="cell-main">Domingos Kiala</div>
                  <div class="cell-sub">BI: 004819231LA042</div>
                </div>
              </div>
            </td>
            <td>Redes e Infraestruturas de TI</td>
            <td class="mono-num">05/08/2026</td>
            <td><span class="pill pendente">Pendente</span></td>
            <td><a href="{{ url('/matriculas') }}" style="color: var(--amber); font-size: 0.78rem; font-weight:600; text-decoration:none;">Validar →</a></td>
          </tr>
          <tr>
            <td>
              <div class="formador-cell">
                <span class="avatar-mini">AN</span>
                <div>
                  <div class="cell-main">Ana Paula Neto</div>
                  <div class="cell-sub">BI: 009218342LA012</div>
                </div>
              </div>
            </td>
            <td>Sistemas Fotovoltaicos</td>
            <td class="mono-num">04/08/2026</td>
            <td><span class="pill aprovado">Aprovada</span></td>
            <td><a href="{{ url('/matriculas') }}" style="color: var(--teal); font-size: 0.78rem; font-weight:600; text-decoration:none;">Ver Ficha</a></td>
          </tr>
          <tr>
            <td>
              <div class="formador-cell">
                <span class="avatar-mini">FB</span>
                <div>
                  <div class="cell-main">Fernando Bumba</div>
                  <div class="cell-sub">BI: 001928341LA099</div>
                </div>
              </div>
            </td>
            <td>Soldagem e Caldeiraria</td>
            <td class="mono-num">03/08/2026</td>
            <td><span class="pill pendente">Pendente</span></td>
            <td><a href="{{ url('/matriculas') }}" style="color: var(--amber); font-size: 0.78rem; font-weight:600; text-decoration:none;">Validar →</a></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
  const ctx = document.getElementById('chartAreas');
  if (ctx) {
    new Chart(ctx, {
      type: 'bar',
      data: {
        labels: ['TI', 'Electricidade', 'Mecânica', 'Metrologia', 'Energias Ren.'],
        datasets: [{
          label: 'Inscrições',
          data: [210, 168, 140, 54, 76],
          backgroundColor: '#F2A93B',
          borderRadius: 6
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: { legend: { display: false } },
        scales: {
          x: { grid: { color: 'rgba(255,255,255,0.05)' }, ticks: { color: '#8FA0AC' } },
          y: { grid: { color: 'rgba(255,255,255,0.05)' }, ticks: { color: '#8FA0AC' } }
        }
      }
    });
  }
});
</script>
@endpush
