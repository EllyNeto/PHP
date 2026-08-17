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
      <div class="kpi-value mono-num">{{ $formandosActivos ?? 0 }}</div>
      <div class="kpi-label">Formandos Activos</div>
      <div class="kpi-trend up">↑ Registados no sistema</div>
    </div>

    <div class="kpi-card" style="--kpi-accent:var(--amber); --kpi-accent-dim:var(--amber-dim);">
      <div class="kpi-top">
        <div class="kpi-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
        </div>
      </div>
      <div class="kpi-value mono-num">{{ $turmasEmCurso ?? 0 }}</div>
      <div class="kpi-label">Turmas em Curso</div>
      <div class="kpi-trend up">↑ Turmas activas nas salas</div>
    </div>

    <div class="kpi-card" style="--kpi-accent:var(--green); --kpi-accent-dim:var(--green-dim);">
      <div class="kpi-top">
        <div class="kpi-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
        </div>
      </div>
      <div class="kpi-value mono-num">{{ $taxaOcupacao ?? 0 }}%</div>
      <div class="kpi-label">Taxa de Ocupação</div>
      <div class="kpi-trend up">↑ Ocupação total de vagas</div>
    </div>

    <div class="kpi-card" style="--kpi-accent:var(--red); --kpi-accent-dim:var(--red-dim);">
      <div class="kpi-top">
        <div class="kpi-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
        </div>
      </div>
      <div class="kpi-value mono-num">{{ $taxaInadimplencia ?? 0 }}%</div>
      <div class="kpi-label">Inadimplência</div>
      <div class="kpi-trend {{ ($taxaInadimplencia ?? 0) > 20 ? 'down' : 'up' }}">Taxa de pagamentos pendentes</div>
    </div>
  </div>

  <!-- ROW 2: Gráficos e Gauge Visual -->
  <div class="grid-2">
    <div class="panel">
      <div class="panel-head">
        <div>
          <div class="panel-title">Inscrições por Área / Curso</div>
          <div class="panel-sub">Distribuição dos candidatos registados por curso</div>
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
          <div class="panel-sub">Taxa de candidatos com inscrição aprovada</div>
        </div>
        <span class="panel-tag">CINFOTEC</span>
      </div>
      <div class="panel-body" style="display:flex; flex-direction:column; align-items:center; justify-content:center;">
        <div class="gauge-wrap">
          @php
            $dashOffset = 251.2 * (1 - (($taxaAprovados ?? 0) / 100));
          @endphp
          <svg class="gauge-svg" viewBox="0 0 100 100">
            <circle cx="50" cy="50" r="40" fill="none" stroke="var(--panel-2)" stroke-width="10" />
            <circle cx="50" cy="50" r="40" fill="none" stroke="var(--teal)" stroke-width="10" stroke-dasharray="251.2" stroke-dashoffset="{{ $dashOffset }}" stroke-linecap="round" transform="rotate(-90 50 50)" />
          </svg>
          <div class="gauge-text">
            <div class="gauge-val">{{ $taxaAprovados ?? 0 }}%</div>
            <div class="gauge-lbl">Aprovados</div>
          </div>
        </div>
        <p style="font-size: 0.78rem; color: var(--text-dim); text-align: center; margin-top: 0.5rem;">
          {{ $aprovadosCount ?? 0 }} de {{ $totalInscricoes ?? 0 }} candidatos com candidatura aprovada.
        </p>
      </div>
    </div>
  </div>

  <!-- ROW 3: Tabela de Inscrições Recentes -->
  <div class="panel">
    <div class="panel-head">
      <div>
        <div class="panel-title">Últimas Inscrições Registadas</div>
        <div class="panel-sub">Inscrições submetidas no portal</div>
      </div>
      <a href="{{ url('/inscricoes') }}" class="panel-tag" style="text-decoration:none;">Ver todas →</a>
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
          @forelse($ultimasInscricoes ?? [] as $insc)
            @php
              $words = explode(' ', trim($insc->name ?? ''));
              $initials = count($words) >= 2 ? mb_strtoupper(mb_substr($words[0], 0, 1) . mb_substr(end($words), 0, 1)) : mb_strtoupper(mb_substr($insc->name ?? 'C', 0, 2));
              $stLower = strtolower($insc->status ?? '');
              $statusClass = in_array($stLower, ['aprovado', 'aprovada', 'aprovada (pago)']) ? 'aprovado' : (in_array($stLower, ['rejeitado', 'rejeitada']) ? 'rejeitada' : 'pendente');
            @endphp
            <tr>
              <td>
                <div class="formador-cell">
                  <span class="avatar-mini">{{ $initials }}</span>
                  <div>
                    <div class="cell-main">{{ $insc->name }}</div>
                    <div class="cell-sub">BI: {{ $insc->bi ?? 'N/A' }}</div>
                  </div>
                </div>
              </td>
              <td>{{ $insc->course ?? 'Sem Curso' }}</td>
              <td class="mono-num">{{ $insc->created_at ? $insc->created_at->format('d/m/Y') : date('d/m/Y') }}</td>
              <td><span class="pill {{ $statusClass }}">{{ ucfirst($insc->status ?? 'Pendente') }}</span></td>
              <td><a href="{{ url('/inscricoes') }}" style="color: var(--amber); font-size: 0.78rem; font-weight:600; text-decoration:none;">Ver Ficha →</a></td>
            </tr>
          @empty
            <tr>
              <td colspan="5" style="text-align: center; color: var(--text-dim); padding: 1.5rem;">Nenhuma inscrição registada.</td>
            </tr>
          @endforelse
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
    const labels = {!! json_encode($chartLabels ?? []) !!};
    const data = {!! json_encode($chartData ?? []) !!};

    new Chart(ctx, {
      type: 'bar',
      data: {
        labels: labels.length > 0 ? labels : ['Sem Dados'],
        datasets: [{
          label: 'Inscrições',
          data: data.length > 0 ? data : [0],
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
          y: { grid: { color: 'rgba(255,255,255,0.05)' }, ticks: { color: '#8FA0AC', precision: 0 } }
        }
      }
    });
  }
});
</script>
@endpush
