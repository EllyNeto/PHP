@extends('layout.admin')

@section('title', 'Certificações')
@section('active', 'certificacoes')
@section('page-title', 'Emissão de Certificados')
@section('page-subtitle', 'Gestão, validação e emissão de diplomas e certificados dos formandos')

@section('content')
  <div class="kpi-row">
    <div class="kpi-card" style="--kpi-accent:var(--teal); --kpi-accent-dim:var(--teal-dim);">
      <div class="kpi-top">
        <div class="kpi-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M12 15l-2 5l4 -2l4 2l-2 -5"/><circle cx="12" cy="9" r="6"/></svg>
        </div>
      </div>
      <div class="kpi-value mono-num">342</div>
      <div class="kpi-label">Certificados Emitidos (2026)</div>
    </div>

    <div class="kpi-card" style="--kpi-accent:var(--amber); --kpi-accent-dim:var(--amber-dim);">
      <div class="kpi-top">
        <div class="kpi-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
        </div>
      </div>
      <div class="kpi-value mono-num">18</div>
      <div class="kpi-label">Aguardando Validação Técnica</div>
    </div>
  </div>

  <div class="panel">
    <div class="panel-head">
      <div>
        <div class="panel-title">Formandos Aprovados e Aptos para Certificação</div>
        <div class="panel-sub">Alunos que concluíram a carga horária e avaliações</div>
      </div>
      <button class="btn-primary" data-modal-target="modalEmitirCertificado">+ Emitir Certificado</button>
    </div>
    <div class="table-wrap">
      <table>
        <thead>
          <tr>
            <th>Formando</th>
            <th>Curso Concluído</th>
            <th>Média Final</th>
            <th>Data Conclusão</th>
            <th>Estado Emissão</th>
            <th>Acções</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>
              <div class="formador-cell">
                <span class="avatar-mini">PS</span>
                <div>
                  <div class="cell-main">Pedro Sumbo</div>
                  <div class="cell-sub">Matrícula: CF-2025-0912</div>
                </div>
              </div>
            </td>
            <td>Metrologia Dimensional</td>
            <td class="mono-num" style="color: var(--green); font-weight:600;">17 / 20</td>
            <td class="mono-num">29/07/2026</td>
            <td><span class="pill aprovado">Pronto p/ Emissão</span></td>
            <td><button class="btn-primary" style="padding:0.3rem 0.6rem; font-size:0.75rem;">Emitir PDF</button></td>
          </tr>
          <tr>
            <td>
              <div class="formador-cell">
                <span class="avatar-mini">MC</span>
                <div>
                  <div class="cell-main">Marta Cassinda</div>
                  <div class="cell-sub">Matrícula: CF-2025-0844</div>
                </div>
              </div>
            </td>
            <td>Electricidade Industrial</td>
            <td class="mono-num" style="color: var(--green); font-weight:600;">16 / 20</td>
            <td class="mono-num">15/07/2026</td>
            <td><span class="pill pago">Emitido</span></td>
            <td><button class="btn-secondary" style="padding:0.3rem 0.6rem; font-size:0.75rem;">Descarregar</button></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

  <!-- Modal Emitir Certificado -->
  <div class="overlay" id="modalEmitirCertificado">
    <div class="modal">
      <div class="modal-head">
        <h3>Emitir Novo Certificado</h3>
        <button class="modal-close" type="button">&times;</button>
      </div>
      <form action="#" method="POST" onsubmit="event.preventDefault(); this.closest('.overlay').classList.remove('show');">
        <div class="field">
          <label>Selecione o Formando</label>
          <select required>
            <option>Pedro Sumbo — Metrologia Dimensional (Média: 17)</option>
            <option>Marta Cassinda — Electricidade Industrial (Média: 16)</option>
          </select>
        </div>
        <div class="field">
          <label>Código Único de Autenticação</label>
          <input type="text" value="CERT-CINFOTEC-2026-0941" readonly style="color: var(--amber); font-family: 'IBM Plex Mono', monospace;">
        </div>
        <div class="field">
          <label>Data de Homologação</label>
          <input type="date" value="2026-08-10" required>
        </div>
        <div class="modal-actions">
          <button class="btn-secondary" type="button" data-modal-close>Cancelar</button>
          <button class="btn-primary" type="submit">Gerar Diploma em PDF</button>
        </div>
      </form>
    </div>
  </div>
@endsection
