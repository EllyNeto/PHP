@extends('layout.admin')

@section('title', 'Matrículas & Propinas')
@section('active', 'matriculas')
@section('page-title', 'Matrículas & Propinas')
@section('page-subtitle', 'Validação de candidaturas e gestão financeira de propinas')

@section('content')
  <div class="kpi-row">
    <div class="kpi-card" style="--kpi-accent:var(--green); --kpi-accent-dim:var(--green-dim);">
      <div class="kpi-top">
        <div class="kpi-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><circle cx="12" cy="12" r="9"/><path d="M12 7v10M9 9.5c0-1.5 1.5-2 3-2s3 .8 3 2-1.5 1.8-3 2-3 .7-3 2 1.5 2 3 2 3-.5 3-2"/></svg>
        </div>
      </div>
      <div class="kpi-value mono-num">Kz 4.280.000</div>
      <div class="kpi-label">Recebido Este Mês</div>
    </div>

    <div class="kpi-card" style="--kpi-accent:var(--red); --kpi-accent-dim:var(--red-dim);">
      <div class="kpi-top">
        <div class="kpi-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
        </div>
      </div>
      <div class="kpi-value mono-num">Kz 615.000</div>
      <div class="kpi-label">Propinas em Atraso</div>
    </div>

    <div class="kpi-card" style="--kpi-accent:var(--amber); --kpi-accent-dim:var(--amber-dim);">
      <div class="kpi-top">
        <div class="kpi-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
        </div>
      </div>
      <div class="kpi-value mono-num">5</div>
      <div class="kpi-label">Inscrições Pendentes</div>
    </div>
  </div>

  <div class="panel">
    <div class="panel-head">
      <div>
        <div class="panel-title">Registo de Matrículas e Propinas</div>
        <div class="panel-sub">Histórico recente de candidaturas e mensalidades</div>
      </div>
      <button class="btn-primary" data-modal-target="modalRegistarPagamento">+ Registar Pagamento</button>
    </div>
    <div class="table-wrap">
      <table>
        <thead>
          <tr>
            <th>Formando</th>
            <th>Curso</th>
            <th>Valor Mensal</th>
            <th>Método</th>
            <th>Data Registo</th>
            <th>Estado</th>
            <th>Acções</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>
              <div class="formador-cell">
                <span class="avatar-mini">DK</span>
                <div>
                  <div class="cell-main">Domingos Kiala</div>
                  <div class="cell-sub">Matrícula: CF-2026-0341</div>
                </div>
              </div>
            </td>
            <td>Redes e Infraestruturas de TI</td>
            <td class="mono-num">Kz 45.000</td>
            <td>Multicaixa Express</td>
            <td class="mono-num">05/08/2026</td>
            <td><span class="pill pago">Pago</span></td>
            <td><button class="btn-secondary" style="padding:0.3rem 0.6rem; font-size:0.75rem;">Recibo</button></td>
          </tr>
          <tr>
            <td>
              <div class="formador-cell">
                <span class="avatar-mini">AN</span>
                <div>
                  <div class="cell-main">Ana Paula Neto</div>
                  <div class="cell-sub">Matrícula: CF-2026-0298</div>
                </div>
              </div>
            </td>
            <td>Sistemas Fotovoltaicos</td>
            <td class="mono-num">Kz 38.000</td>
            <td>Transferência Bancária</td>
            <td class="mono-num">03/08/2026</td>
            <td><span class="pill pago">Pago</span></td>
            <td><button class="btn-secondary" style="padding:0.3rem 0.6rem; font-size:0.75rem;">Recibo</button></td>
          </tr>
          <tr>
            <td>
              <div class="formador-cell">
                <span class="avatar-mini">FB</span>
                <div>
                  <div class="cell-main">Fernando Bumba</div>
                  <div class="cell-sub">Matrícula: CF-2026-0255</div>
                </div>
              </div>
            </td>
            <td>Soldagem e Caldeiraria</td>
            <td class="mono-num">Kz 30.000</td>
            <td>Numerário</td>
            <td class="mono-num">20/07/2026</td>
            <td><span class="pill em-atraso">Em Atraso</span></td>
            <td><button class="btn-primary" style="padding:0.3rem 0.6rem; font-size:0.75rem;">Cobrar</button></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

  <!-- Modal Registar Pagamento -->
  <div class="overlay" id="modalRegistarPagamento">
    <div class="modal">
      <div class="modal-head">
        <h3>Registar Pagamento de Propina</h3>
        <button class="modal-close" type="button">&times;</button>
      </div>
      <form action="#" method="POST" onsubmit="event.preventDefault(); this.closest('.overlay').classList.remove('show');">
        <div class="field">
          <label>Formando / Aluno</label>
          <select required>
            <option>Domingos Kiala (CF-2026-0341)</option>
            <option>Ana Paula Neto (CF-2026-0298)</option>
            <option>Fernando Bumba (CF-2026-0255)</option>
          </select>
        </div>
        <div class="field">
          <label>Valor Pago (Kz)</label>
          <input type="number" placeholder="45000" required>
        </div>
        <div class="field">
          <label>Método de Pagamento</label>
          <select required>
            <option>Multicaixa Express</option>
            <option>Transferência Bancária</option>
            <option>Depósito Bancário</option>
            <option>Numerário / Caixas CINFOTEC</option>
          </select>
        </div>
        <div class="field">
          <label>Nº de Comprovativo / Referência</label>
          <input type="text" placeholder="ex.: TRX-948123" required>
        </div>
        <div class="modal-actions">
          <button class="btn-secondary" type="button" data-modal-close>Cancelar</button>
          <button class="btn-primary" type="submit">Confirmar Pagamento</button>
        </div>
      </form>
    </div>
  </div>
@endsection
