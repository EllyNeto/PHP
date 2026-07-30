@extends('layout.main')

@section('tittle',  'Bem-vindo ao Centro de Formação Tecnológica')

@section('content')
    <main class="content">
      <div class="page-head">
        <div>
          <span class="eyebrow">Portal de Administração</span>
          <h1>Visão Geral do Centro</h1>
          <p>Acompanhe o desempenho das turmas, dados financeiros e matrículas do período.</p>
        </div>
        <div class="date-chip">Segunda-feira, 27 de julho de 2026</div>
      </div>

      <!-- CARDS DE METRICAS (KPI) -->
      <section class="kpi-grid">
        <div class="kpi-card">
          <div class="kpi-top">
            <div class="kpi-icon gold">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="9" cy="8" r="4"/><path d="M2 21v-2a5 5 0 0 1 5-5h4a5 5 0 0 1 5 5v2"/><circle cx="18" cy="8" r="3"/><path d="M22 21v-1.5a4 4 0 0 0-3-3.87"/></svg>
            </div>
            <div class="kpi-trend up">
              <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path d="M18 15l-6-6-6 6"/></svg>
              +12%
            </div>
          </div>
          <div class="kpi-value mono">512</div>
          <div class="kpi-label">Estudantes Inscritos</div>
        </div>

        <div class="kpi-card">
          <div class="kpi-top">
            <div class="kpi-icon teal">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2Z"/></svg>
            </div>
            <div class="kpi-trend up">
              <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path d="M18 15l-6-6-6 6"/></svg>
              +2
            </div>
          </div>
          <div class="kpi-value mono">28</div>
          <div class="kpi-label">Turmas Ativas</div>
        </div>

        <div class="kpi-card">
          <div class="kpi-top">
            <div class="kpi-icon coral">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="5" width="20" height="14" rx="2"/><path d="M2 10h20"/></svg>
            </div>
            <div class="kpi-trend up">
              <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path d="M18 15l-6-6-6 6"/></svg>
              +5.4%
            </div>
          </div>
          <div class="kpi-value mono">4.180.000 <span style="font-size:15px; color:var(--text-faint);">Kz</span></div>
          <div class="kpi-label">Faturação Mensal</div>
        </div>

        <div class="kpi-card">
          <div class="ring-wrap">
            <svg class="ring" viewBox="0 0 64 64">
              <circle class="track" cx="32" cy="32" r="26"/>
              <circle class="prog" cx="32" cy="32" r="26" stroke-dasharray="163.4" stroke-dashoffset="21.2"/>
              <text x="32" y="37" text-anchor="middle" class="ring-num">87%</text>
            </svg>
            <div>
              <div class="kpi-value mono" style="font-size:22px;">87%</div>
              <div class="kpi-label">Aproveitamento</div>
            </div>
          </div>
        </div>
      </section>

      <!-- GRÁFICO E TAXA DE OCUPAÇÃO -->
      <section class="panels-grid">
        <div class="panel">
          <div class="panel-head">
            <div>
              <h3>Adesão por Especialidade</h3>
              <div class="sub">Matrículas ativas vs. Conclusões</div>
            </div>
            <div class="link-more">Estatísticas</div>
          </div>
          <div class="chart">
            <div class="bar-col">
              <div class="bar-stack" style="height:100%;">
                <div class="bar-fill" style="height:45%;"></div>
                <div class="bar-fill alt" style="height:20%;"></div>
              </div>
              <div class="bar-label">Fev</div>
            </div>
            <div class="bar-col">
              <div class="bar-stack" style="height:100%;">
                <div class="bar-fill" style="height:52%;"></div>
                <div class="bar-fill alt" style="height:25%;"></div>
              </div>
              <div class="bar-label">Mar</div>
            </div>
            <div class="bar-col">
              <div class="bar-stack" style="height:100%;">
                <div class="bar-fill" style="height:40%;"></div>
                <div class="bar-fill alt" style="height:35%;"></div>
              </div>
              <div class="bar-label">Abr</div>
            </div>
            <div class="bar-col">
              <div class="bar-stack" style="height:100%;">
                <div class="bar-fill" style="height:65%;"></div>
                <div class="bar-fill alt" style="height:20%;"></div>
              </div>
              <div class="bar-label">Mai</div>
            </div>
            <div class="bar-col">
              <div class="bar-stack" style="height:100%;">
                <div class="bar-fill" style="height:58%;"></div>
                <div class="bar-fill alt" style="height:30%;"></div>
              </div>
              <div class="bar-label">Jun</div>
            </div>
            <div class="bar-col">
              <div class="bar-stack" style="height:100%;">
                <div class="bar-fill" style="height:72%;"></div>
                <div class="bar-fill alt" style="height:22%;"></div>
              </div>
              <div class="bar-label">Jul</div>
            </div>
          </div>
          <div class="chart-legend">
            <span><span class="legend-dot" style="background:var(--gold);"></span> Matrículas Novas</span>
            <span><span class="legend-dot" style="background:var(--teal);"></span> Certificados Emitidos</span>
          </div>
        </div>

        <div class="panel">
          <div class="panel-head">
            <div>
              <h3>Linguagens & Tecnologias</h3>
              <div class="sub">Distribuição de alunos</div>
            </div>
          </div>
          <div class="occ-list">
            <div class="occ-row">
              <div class="occ-top"><span class="name">C / C++ (Sistemas)</span><span class="pct">95%</span></div>
              <div class="occ-bar"><div class="occ-fill" style="width:95%;"></div></div>
            </div>
            <div class="occ-row">
              <div class="occ-top"><span class="name">Administração Linux (Debian)</span><span class="pct">88%</span></div>
              <div class="occ-bar"><div class="occ-fill" style="width:88%;"></div></div>
            </div>
            <div class="occ-row">
              <div class="occ-top"><span class="name">Segurança de Redes</span><span class="pct">74%</span></div>
              <div class="occ-bar"><div class="occ-fill" style="width:74%;"></div></div>
            </div>
            <div class="occ-row">
              <div class="occ-top"><span class="name">Desenvolvimento Web (Laravel)</span><span class="pct">60%</span></div>
              <div class="occ-bar"><div class="occ-fill" style="width:60%;"></div></div>
            </div>
          </div>
        </div>
      </section>

      <!-- TABELA DE ATIVIDADES -->
      <section class="panel">
        <div class="panel-head">
          <div>
            <h3>Atividade Recente</h3>
            <div class="sub">Últimas transações e registos</div>
          </div>
          <div class="link-more">Ver histórico</div>
        </div>
        <div class="table-wrap">
          <table>
            <thead>
              <tr>
                <th>Estudante</th>
                <th>Módulo</th>
                <th>Instrutor</th>
                <th>Data</th>
                <th>Propina</th>
                <th>Estado</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>
                  <div class="student-cell">
                    <div class="mini-avatar" style="background:var(--gold-soft);">LF</div>
                    <div>
                      <div class="student-name">Liedson Francisco</div>
                      <div class="student-id">#AL-1092</div>
                    </div>
                  </div>
                </td>
                <td>Programação C++</td>
                <td>Alexandre Tambo</td>
                <td class="mono">27 jul.</td>
                <td class="row-amount">90.000 Kz</td>
                <td><span class="status-pill ativo">Confirmado</span></td>
              </tr>
              <tr>
                <td>
                  <div class="student-cell">
                    <div class="mini-avatar" style="background:#8ee0d4;">AT</div>
                    <div>
                      <div class="student-name">Alexandre Tambo</div>
                      <div class="student-id">#AL-1093</div>
                    </div>
                  </div>
                </td>
                <td>Redes de Computadores</td>
                <td>Elly Neto</td>
                <td class="mono">26 jul.</td>
                <td class="row-amount">85.000 Kz</td>
                <td><span class="status-pill ativo">Confirmado</span></td>
              </tr>
              <tr>
                <td>
                  <div class="student-cell">
                    <div class="mini-avatar" style="background:#e39f9f;">MC</div>
                    <div>
                      <div class="student-name">Mateus Cassinda</div>
                      <div class="student-id">#AL-1094</div>
                    </div>
                  </div>
                </td>
                <td>Linux SysAdmin</td>
                <td>Alexandre Tambo</td>
                <td class="mono">25 jul.</td>
                <td class="row-amount">75.000 Kz</td>
                <td><span class="status-pill pendente">Pendente</span></td>
              </tr>
            </tbody>
          </table>
        </div>
      </section>

    </main>
  </div>
</div>

<!-- JS do Projeto -->
<script src="{{ asset('js/main.js') }}"></script>
@endsection
