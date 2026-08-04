@extends('layout.admin')

@section('title', 'Visão Geral')
@section('active', 'visao')
@section('page-title', 'Visão Geral')
@section('page-subtitle', 'Resumo atualizado a partir dos dados registados no sistema')

@section('content')
  <div class="kpi-row">
    @foreach($kpis as $kpi)
      <div class="kpi-card" style="--kpi-accent:var(--{{ $kpi['accent'] }}); --kpi-accent-dim:var(--{{ $kpi['accent'] }}-dim);">
        <div class="kpi-top"><div class="kpi-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            @if ($kpi['icon'] === 'formandos')<path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/>@endif
            @if ($kpi['icon'] === 'turmas')<path d="M20.59 13.41L11 3.83V3H10.17L1 12.17V13h.83L11 22.17l9.59-9.59a2 2 0 0 0 0-2.83z"/><circle cx="6.5" cy="6.5" r="1"/>@endif
            @if ($kpi['icon'] === 'vagas')<path d="M12 5v14M5 12h14"/><circle cx="12" cy="12" r="9"/>@endif
            @if ($kpi['icon'] === 'alerta')<path d="M12 9v4"/><circle cx="12" cy="17" r=".5"/><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/>@endif
          </svg>
        </div></div>
        <div class="kpi-value mono-num">{{ $kpi['value'] }}</div>
        <div class="kpi-label">{{ $kpi['label'] }}</div>
      </div>
    @endforeach
  </div>

  <div class="grid-2">
    <div class="panel">
      <div class="panel-head"><div><div class="panel-title">Inscrições por curso</div><div class="panel-sub">Dados registados no banco</div></div></div>
      <div class="chart-box"><canvas id="chartAreas"></canvas></div>
    </div>
    <div class="panel">
      <div class="panel-head"><div><div class="panel-title">Taxa de confirmação de pagamento</div><div class="panel-sub">Inscrições confirmadas sobre o total</div></div></div>
      <div class="gauge-wrap">
        <svg width="220" height="130" viewBox="0 0 220 130"><path d="M14 116 A96 96 0 0 1 206 116" fill="none" stroke="#293742" stroke-width="14" stroke-linecap="round"/><path id="gaugeArc" d="M14 116 A96 96 0 0 1 206 116" fill="none" stroke="var(--amber)" stroke-width="14" stroke-linecap="round" stroke-dasharray="301.6" stroke-dashoffset="301.6"/><g id="gaugeTicks" stroke="#5C6B76" stroke-width="1.5"></g><line id="gaugeNeedle" x1="110" y1="116" x2="110" y2="34" stroke="#E9EDF0" stroke-width="2.5" stroke-linecap="round" transform="rotate(-90 110 116)"/><circle cx="110" cy="116" r="5" fill="#E9EDF0"/></svg>
        <div class="gauge-value mono-num">{{ $taxaConfirmacao }}%</div><div class="gauge-caption">Estado de pagamento das inscrições</div><div class="gauge-scale"><span>0</span><span>25</span><span>50</span><span>75</span><span>100</span></div>
      </div>
    </div>
  </div>

  <div class="grid-2" style="grid-template-columns:1fr 1fr;">
    <div class="panel"><div class="panel-head"><div><div class="panel-title">Inscrições nos últimos meses</div><div class="panel-sub">Registos criados por mês</div></div></div><div class="chart-box"><canvas id="chartConclusao"></canvas></div></div>
    <div class="panel"><div class="panel-head"><div><div class="panel-title">Estado das inscrições</div><div class="panel-sub">Distribuição atual de pagamentos</div></div></div>
      @foreach($estadoInscricoes as $estado)
        <div class="centro-row"><div class="centro-top"><span class="centro-name">{{ $estado['nome'] }} ({{ $estado['total'] }})</span><span class="centro-pct mono-num">{{ $estado['pct'] }}%</span></div><div class="bar-track"><div class="bar-fill" style="width:{{ $estado['pct'] }}%; {{ $estado['nome'] === 'Pendentes' ? 'background:var(--amber);' : ($estado['nome'] === 'Rejeitadas' ? 'background:var(--red);' : '') }}"></div></div></div>
      @endforeach
    </div>
  </div>

  <div class="panel"><div class="panel-head"><div><div class="panel-title">Turmas recentes</div><div class="panel-sub">Registos mais recentes no banco de dados</div></div><div class="panel-tag">{{ $turmas->count() }} listadas</div></div>
    <div class="table-wrap"><table><thead><tr><th>Curso</th><th>Professor</th><th>Formandos</th><th>Capacidade</th><th>Turma</th><th>Estado</th></tr></thead><tbody>
      @forelse($turmas->take(6) as $turma)
        <tr><td class="cell-main">{{ $turma->course_name ?: 'Não definido' }}</td><td><div class="formador-cell"><span class="avatar-mini">{{ strtoupper(substr($turma->teacher_name ?: 'ND', 0, 2)) }}</span>{{ $turma->teacher_name ?: 'Não definido' }}</div></td><td class="mono-num">{{ $turma->student_count }}</td><td class="mono-num">{{ $turma->capacity }}</td><td>{{ $turma->room }}</td><td><span class="pill {{ $turma->status === 'Concluída' ? 'concluida' : ($turma->status === 'Planeada' ? 'planeada' : 'emcurso') }}">{{ $turma->status }}</span></td></tr>
      @empty
        <tr><td colspan="6" style="text-align:center; color:var(--text-faint); padding:24px;">Sem turmas para mostrar.</td></tr>
      @endforelse
    </tbody></table></div>
  </div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
  new Chart(document.getElementById('chartAreas'), { type: 'bar', data: { labels: @json($areasChart['labels']), datasets: [{ data: @json($areasChart['data']), backgroundColor: '#F2A93B', borderRadius: 4, maxBarThickness: 34 }] }, options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { display: false } }, scales: { x: { grid: { display: false } }, y: { beginAtZero: true } } } });
  new Chart(document.getElementById('chartConclusao'), { type: 'line', data: { labels: @json($conclusaoChart['labels']), datasets: [{ data: @json($conclusaoChart['data']), borderColor: '#4FB6A9', backgroundColor: 'rgba(79,182,169,0.12)', fill: true, tension: 0.35, pointBackgroundColor: '#4FB6A9', pointRadius: 4, borderWidth: 2.5 }] }, options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { display: false } }, scales: { y: { beginAtZero: true } } } });
  drawGauge({{ $taxaConfirmacao }});
});
</script>
@endpush
