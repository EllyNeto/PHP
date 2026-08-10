@extends('layout.admin')

@section('title', 'Finanças')
@section('active', 'financas')
@section('page-title', 'Finanças & Tesouraria')
@section('page-subtitle', 'Liquidação do pagamento único do curso do candidato')

@section('content')
  <div class="kpi-row">
    <div class="kpi-card" style="--kpi-accent:var(--green); --kpi-accent-dim:var(--green-dim);">
      <div class="kpi-top">
        <div class="kpi-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><circle cx="12" cy="12" r="9"/><path d="M12 7v10M9 9.5c0-1.5 1.5-2 3-2s3 .8 3 2-1.5 1.8-3 2-3 .7-3 2 1.5 2 3 2 3-.5 3-2"/></svg>
        </div>
      </div>
      <div class="kpi-value mono-num">Kz 4.280.000</div>
      <div class="kpi-label">Total Arrecadado (Cursos)</div>
    </div>

    <div class="kpi-card" style="--kpi-accent:var(--amber); --kpi-accent-dim:var(--amber-dim);">
      <div class="kpi-top">
        <div class="kpi-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
        </div>
      </div>
      <div class="kpi-value mono-num">Kz 615.000</div>
      <div class="kpi-label">Aguardando Pagamento do Curso</div>
    </div>

    <div class="kpi-card" style="--kpi-accent:var(--teal); --kpi-accent-dim:var(--teal-dim);">
      <div class="kpi-top">
        <div class="kpi-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
        </div>
      </div>
      <div class="kpi-value mono-num">745</div>
      <div class="kpi-label">Candidatos Prontos p/ Matrícula</div>
    </div>
  </div>

  <div class="panel">
    <div class="panel-head">
      <div>
        <div class="panel-title">Pagamentos dos Cursos Inscritos</div>
        <div class="panel-sub">Após pagamento confirmado, o candidato avança para a Matrícula na Turma (Passo 3)</div>
      </div>
      <button class="btn-primary" data-modal-target="modalRegistarPagamento">+ Liquidação de Curso</button>
    </div>
    <div class="table-wrap">
      <table>
        <thead>
          <tr>
            <th>Candidato (Vindo das Inscrições)</th>
            <th>Curso Pretendido</th>
            <th>Valor Único do Curso</th>
            <th>Método de Liquidação</th>
            <th>Estado Financeiro</th>
            <th>Próximo Passo (Fluxo)</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>
              <div class="formador-cell">
                <span class="avatar-mini">DK</span>
                <div>
                  <div class="cell-main">Domingos Kiala</div>
                  <div class="cell-sub">Inscrição #INC-2026-034</div>
                </div>
              </div>
            </td>
            <td>Redes e Infraestruturas de TI</td>
            <td class="mono-num">Kz 180.000</td>
            <td>Multicaixa Express</td>
            <td><span class="pill pago">Pago (Total)</span></td>
            <td>
              <a href="{{ url('/matriculas') }}" class="btn-primary" style="padding:0.3rem 0.65rem; font-size:0.75rem; text-decoration:none;">Efectuar Matrícula →</a>
            </td>
          </tr>
          <tr>
            <td>
              <div class="formador-cell">
                <span class="avatar-mini">AN</span>
                <div>
                  <div class="cell-main">Ana Paula Neto</div>
                  <div class="cell-sub">Inscrição #INC-2026-029</div>
                </div>
              </div>
            </td>
            <td>Sistemas Fotovoltaicos</td>
            <td class="mono-num">Kz 150.000</td>
            <td>Transferência Bancária</td>
            <td><span class="pill pago">Pago (Total)</span></td>
            <td>
              <a href="{{ url('/matriculas') }}" class="btn-primary" style="padding:0.3rem 0.65rem; font-size:0.75rem; text-decoration:none;">Efectuar Matrícula →</a>
            </td>
          </tr>
          <tr>
            <td>
              <div class="formador-cell">
                <span class="avatar-mini">FB</span>
                <div>
                  <div class="cell-main">Fernando Bumba</div>
                  <div class="cell-sub">Inscrição #INC-2026-025</div>
                </div>
              </div>
            </td>
            <td>Soldagem e Caldeiraria</td>
            <td class="mono-num">Kz 120.000</td>
            <td>Pendente</td>
            <td><span class="pill em-atraso">Aguardando Pagamento</span></td>
            <td>
              <button class="btn-secondary" style="padding:0.3rem 0.65rem; font-size:0.75rem; color:var(--amber);" data-modal-target="modalRegistarPagamento">Liquidar Agora</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

  <!-- Modal Registar Pagamento Único -->
  <div class="overlay" id="modalRegistarPagamento">
    <div class="modal">
      <div class="modal-head">
        <h3>Registar Pagamento Único do Curso</h3>
        <button class="modal-close" type="button">&times;</button>
      </div>
      <form action="#" method="POST" onsubmit="event.preventDefault(); window.location.href='{{ url('/matriculas') }}';">
        <div class="field">
          <label>Candidato Inscrito</label>
          <select required>
            <option>Fernando Bumba — Soldagem e Caldeiraria (Kz 120.000)</option>
            <option>Domingos Kiala — Redes e Infraestruturas de TI (Kz 180.000)</option>
          </select>
        </div>
        <div class="field">
          <label>Valor Total do Curso (Kz)</label>
          <input type="number" value="120000" required>
        </div>
        <div class="field">
          <label>Forma de Pagamento</label>
          <select required>
            <option>Multicaixa Express</option>
            <option>Transferência Bancária</option>
            <option>Depósito Bancário</option>
            <option>Numerário / Caixas CINFOTEC</option>
          </select>
        </div>
        <div class="field">
          <label>Nº de Comprovativo / Referência Bancária</label>
          <input type="text" placeholder="ex.: TRX-948123" required>
        </div>
        <div class="modal-actions">
          <button class="btn-secondary" type="button" data-modal-close>Cancelar</button>
          <button class="btn-primary" type="submit">Confirmar &amp; Avançar p/ Matrícula →</button>
        </div>
      </form>
    </div>
  </div>
@endsection
