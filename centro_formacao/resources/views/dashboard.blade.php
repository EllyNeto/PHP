@extends('layout.admin')

@section('title', 'Visão Geral')
@section('active', 'visao')
@section('page-title', 'Visão Geral')
@section('page-subtitle', 'Talatona · Rangel · Huambo · Cabinda — ano formativo 2026')

@section('content')

  {{--
    Dados de demonstração. Quando ligares o controller, passa estas mesmas
    variáveis (kpis, areasChart, conclusaoChart, empregabilidade, centros,
    turmas) para a view e podes apagar os valores por omissão abaixo.
  --}}
  @php
    $kpis = $kpis ?? [
      ['label' => 'Formandos activos',            'value' => '2 384', 'trend' => '↑ 6.4%',  'dir' => 'up',   'accent' => 'amber', 'icon' => 'formandos'],
      ['label' => 'Turmas em curso',               'value' => '96',    'trend' => '↑ 3.1%',  'dir' => 'up',   'accent' => 'teal',  'icon' => 'turmas'],
      ['label' => 'Certificações emitidas (mês)',  'value' => '612',   'trend' => '↑ 11.8%', 'dir' => 'up',   'accent' => 'green', 'icon' => 'certificacoes'],
      ['label' => 'Turmas com vagas em risco',     'value' => '14',    'trend' => '↓ 1.2%',  'dir' => 'down', 'accent' => 'red',   'icon' => 'alerta'],
    ];

    $areasChart = $areasChart ?? [
      'labels' => ['TI', 'Electric. & Mecat.', 'Mecânica & Prod.', 'Metrologia', 'Energias Renov.', 'Empreend.'],
      'data'   => [612, 498, 371, 205, 288, 410],
    ];

    $conclusaoChart = $conclusaoChart ?? [
      'labels' => ['T1', 'T2', 'T3', 'T4'],
      'data'   => [74, 79, 81, 87],
    ];

    $empregabilidade = $empregabilidade ?? 85; // percentagem

    $centros = $centros ?? [
      ['nome' => 'Talatona', 'pct' => 92],
      ['nome' => 'Rangel',   'pct' => 78],
      ['nome' => 'Huambo',   'pct' => 64],
      ['nome' => 'Cabinda',  'pct' => 31],
    ];

    $turmas = $turmas ?? [
      ['curso' => 'HCIA Data Communications', 'area' => 'Tecnologias de Informação', 'formador' => 'João Mateus', 'iniciais' => 'JM', 'formandos' => 24, 'inicio' => '03 Mar 2026', 'centro' => 'Talatona', 'estado' => 'emcurso', 'estado_label' => 'Em curso'],
      ['curso' => 'Electricidade de Manutenção Industrial', 'area' => 'Electricidade & Mecatrónica', 'formador' => 'Cristina Fumo', 'iniciais' => 'CF', 'formandos' => 18, 'inicio' => '17 Fev 2026', 'centro' => 'Rangel', 'estado' => 'emcurso', 'estado_label' => 'Em curso'],
      ['curso' => 'Metrologia Dimensional Aplicada', 'area' => 'Metrologia', 'formador' => 'Pedro Kiala', 'iniciais' => 'PK', 'formandos' => 15, 'inicio' => '05 Jan 2026', 'centro' => 'Talatona', 'estado' => 'concluida', 'estado_label' => 'Concluída'],
      ['curso' => 'Instalação de Sistemas Fotovoltaicos', 'area' => 'Energias Renováveis', 'formador' => 'Aurora Sachimbo', 'iniciais' => 'AS', 'formandos' => 21, 'inicio' => '22 Jul 2026', 'centro' => 'Huambo', 'estado' => 'planeada', 'estado_label' => 'Planeada'],
      ['curso' => 'Mecânica de Manutenção Industrial', 'area' => 'Mecânica & Produção', 'formador' => 'Domingos Luvualu', 'iniciais' => 'DL', 'formandos' => 9, 'inicio' => '14 Abr 2026', 'centro' => 'Cabinda', 'estado' => 'atencao', 'estado_label' => 'Vagas em risco'],
      ['curso' => 'Empreendedorismo e Plano de Negócio', 'area' => 'Empreendedorismo & Inovação', 'formador' => 'Nelson Bumba', 'iniciais' => 'NB', 'formandos' => 27, 'inicio' => '10 Jun 2026', 'centro' => 'Talatona', 'estado' => 'emcurso', 'estado_label' => 'Em curso'],
    ];

    $kpiIcons = [
      'formandos'      => '<path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>',
      'turmas'         => '<path d="M20.59 13.41L11 3.83V3H10.17L1 12.17V13h.83L11 22.17l9.59-9.59a2 2 0 0 0 0-2.83z"/><circle cx="6.5" cy="6.5" r="1"/>',
      'certificacoes'  => '<circle cx="12" cy="8" r="6"/><path d="M9 14.5L7 22l5-3 5 3-2-7.5"/>',
      'alerta'         => '<path d="M12 9v4"/><circle cx="12" cy="17" r=".5"/><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/>',
    ];
  @endphp

  <div class="kpi-row">
    @foreach($kpis as $kpi)
      <div class="kpi-card" style="--kpi-accent:var(--{{ $kpi['accent'] }}); --kpi-accent-dim:var(--{{ $kpi['accent'] }}-dim);">
        <div class="kpi-top">
          <div class="kpi-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">{!! $kpiIcons[$kpi['icon']] !!}</svg>
          </div>
          <div class="kpi-trend {{ $kpi['dir'] }}">{{ $kpi['trend'] }}</div>
        </div>
        <div class="kpi-value mono-num">{{ $kpi['value'] }}</div>
        <div class="kpi-label">{{ $kpi['label'] }}</div>
      </div>
    @endforeach
  </div>

  <div class="grid-2">
    <div class="panel">
      <div class="panel-head">
        <div>
          <div class="panel-title">Matrículas por área de formação</div>
          <div class="panel-sub">Ano formativo em curso, todos os centros</div>
        </div>
        <div class="panel-tag">{{ date('Y') }}</div>
      </div>
      <div class="chart-box"><canvas id="chartAreas"></canvas></div>
    </div>

    <div class="panel">
      <div class="panel-head">
        <div>
          <div class="panel-title">Empregabilidade</div>
          <div class="panel-sub">Formandos colocados até 6 meses</div>
        </div>
      </div>
      <div class="gauge-wrap">
        <svg width="220" height="130" viewBox="0 0 220 130">
          <path d="M14 116 A96 96 0 0 1 206 116" fill="none" stroke="#293742" stroke-width="14" stroke-linecap="round"/>
          <path id="gaugeArc" d="M14 116 A96 96 0 0 1 206 116" fill="none" stroke="var(--amber)" stroke-width="14" stroke-linecap="round"
                stroke-dasharray="301.6" stroke-dashoffset="301.6"/>
          <g id="gaugeTicks" stroke="#5C6B76" stroke-width="1.5"></g>
          <line id="gaugeNeedle" x1="110" y1="116" x2="110" y2="34" stroke="#E9EDF0" stroke-width="2.5" stroke-linecap="round" transform="rotate(-90 110 116)"/>
          <circle cx="110" cy="116" r="5" fill="#E9EDF0"/>
        </svg>
        <div class="gauge-value mono-num">{{ $empregabilidade }}%</div>
        <div class="gauge-caption">Índice de empregabilidade — cursos de qualificação e técnicos</div>
        <div class="gauge-scale"><span>0</span><span>25</span><span>50</span><span>75</span><span>100</span></div>
      </div>
    </div>
  </div>

  <div class="grid-2" style="grid-template-columns:1fr 1fr;">
    <div class="panel">
      <div class="panel-head">
        <div>
          <div class="panel-title">Taxa de conclusão trimestral</div>
          <div class="panel-sub">Cursos de qualificação e técnicos</div>
        </div>
        <div class="panel-tag">%</div>
      </div>
      <div class="chart-box"><canvas id="chartConclusao"></canvas></div>
    </div>

    <div class="panel">
      <div class="panel-head">
        <div>
          <div class="panel-title">Ocupação por centro</div>
          <div class="panel-sub">Capacidade instalada vs. inscrita</div>
        </div>
      </div>
      @foreach($centros as $centro)
        <div class="centro-row">
          <div class="centro-top"><span class="centro-name">{{ $centro['nome'] }}</span><span class="centro-pct mono-num">{{ $centro['pct'] }}%</span></div>
          <div class="bar-track">
            <div class="bar-fill" style="width:{{ $centro['pct'] }}%; {{ $centro['pct'] >= 85 ? 'background:var(--amber);' : ($centro['pct'] < 40 ? 'background:var(--red);' : '') }}"></div>
          </div>
        </div>
      @endforeach
    </div>
  </div>

  <div class="panel">
    <div class="panel-head">
      <div>
        <div class="panel-title">Turmas recentes</div>
        <div class="panel-sub">Actualizado hoje às {{ now()->format('H:i') }}</div>
      </div>
      <div class="panel-tag">{{ count($turmas) }} listadas</div>
    </div>
    <div class="table-wrap">
      <table>
        <thead>
          <tr><th>Curso</th><th>Formador</th><th>Formandos</th><th>Início</th><th>Centro</th><th>Estado</th></tr>
        </thead>
        <tbody>
          @forelse($turmas as $t)
            <tr>
              <td><div class="cell-main">{{ $t['curso'] }}</div><div class="cell-sub">{{ $t['area'] }}</div></td>
              <td><div class="formador-cell"><span class="avatar-mini">{{ $t['iniciais'] }}</span>{{ $t['formador'] }}</div></td>
              <td class="mono-num">{{ $t['formandos'] }}</td>
              <td class="mono-num">{{ $t['inicio'] }}</td>
              <td>{{ $t['centro'] }}</td>
              <td><span class="pill {{ $t['estado'] }}">{{ $t['estado_label'] }}</span></td>
            </tr>
          @empty
            <tr><td colspan="6" style="text-align:center; color:var(--text-faint); padding:24px;">Sem turmas para mostrar.</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

@endsection

@push('scripts')
<script>
  document.addEventListener('DOMContentLoaded', function () {
    new Chart(document.getElementById('chartAreas'), {
      type: 'bar',
      data: {
        labels: @json($areasChart['labels']),
        datasets: [{
          data: @json($areasChart['data']),
          backgroundColor: '#F2A93B',
          borderRadius: 4,
          maxBarThickness: 34,
        }]
      },
      options: {
        responsive: true, maintainAspectRatio: false,
        plugins: { legend: { display: false } },
        scales: {
          x: { grid: { display: false }, ticks: { color: '#8FA0AC' } },
          y: { grid: { color: 'rgba(41,55,66,0.6)' }, ticks: { color: '#8FA0AC' }, beginAtZero: true }
        }
      }
    });

    new Chart(document.getElementById('chartConclusao'), {
      type: 'line',
      data: {
        labels: @json($conclusaoChart['labels']),
        datasets: [{
          data: @json($conclusaoChart['data']),
          borderColor: '#4FB6A9',
          backgroundColor: 'rgba(79,182,169,0.12)',
          fill: true,
          tension: 0.35,
          pointBackgroundColor: '#4FB6A9',
          pointRadius: 4,
          borderWidth: 2.5,
        }]
      },
      options: {
        responsive: true, maintainAspectRatio: false,
        plugins: { legend: { display: false } },
        scales: {
          x: { grid: { display: false } },
          y: { grid: { color: 'rgba(41,55,66,0.6)' }, suggestedMin: 60, suggestedMax: 100 }
        }
      }
    });

    drawGauge({{ (int) $empregabilidade }});
  });
</script>
@endpush
