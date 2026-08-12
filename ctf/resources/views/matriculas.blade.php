@extends('layout.admin')

@section('title', 'Matrículas')
@section('active', 'matriculas')
@section('page-title', 'Matrículas em Turmas')
@section('page-subtitle', 'Atribuição de turma e formalização da matrícula dos candidatos pagos')

@section('content')
  <div class="kpi-row">
    <div class="kpi-card" style="--kpi-accent:var(--teal); --kpi-accent-dim:var(--teal-dim);">
      <div class="kpi-top">
        <div class="kpi-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><polyline points="16 11 18 13 22 9"/></svg>
        </div>
      </div>
      <div class="kpi-value mono-num">812</div>
      <div class="kpi-label">Matrículas Efectuadas</div>
    </div>

    <div class="kpi-card" style="--kpi-accent:var(--amber); --kpi-accent-dim:var(--amber-dim);">
      <div class="kpi-top">
        <div class="kpi-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
        </div>
      </div>
      <div class="kpi-value mono-num">2</div>
      <div class="kpi-label">Candidatos com Pagamento Liquidado Aguardando Turma</div>
    </div>
  </div>

  <div class="panel">
    <div class="panel-head">
      <div>
        <div class="panel-title">Matrículas e Atribuição de Turmas</div>
        <div class="panel-sub">Candidatos que completaram o Pagamento nas Finanças (Passo 2) e estão aptos para ingressar na turma</div>
      </div>
      <button class="btn-primary" data-modal-target="modalNovaMatricula">+ Formalizar Matrícula</button>
    </div>
    <div class="table-wrap">
      <table>
        <thead>
          <tr>
            <th>Nº Matrícula</th>
            <th>Formando (Vindo do Pagamento)</th>
            <th>Curso / Turma Atribuída</th>
            <th>Comprovativo Financeiro</th>
            <th>Estado da Matrícula</th>
            <th>Acções</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="mono-num">CF-2026-0341</td>
            <td>
              <div class="formador-cell">
                <div>
                  <div class="cell-main">Domingos Kiala</div>
                </div>
              </div>
            </td>
            <td>
              <div class="cell-main">Redes e Infraestruturas de TI</div>
            </td>
            <td><span class="pill pago">Pago (TRX-948123)</span></td>
            <td><span class="pill aprovado">Matriculado</span></td>
            <td><button class="btn-secondary" style="padding:0.3rem 0.6rem; font-size:0.75rem;">Emitir Ficha →</button></td>
          </tr>
          <tr>
            <td class="mono-num">CF-2026-0298</td>
            <td>
              <div class="formador-cell">
                <div>
                  <div class="cell-main">Ana Paula Neto</div>
                </div>
              </div>
            </td>
            <td>
              <div class="cell-main">Sistemas Fotovoltaicos</div>
            </td>
            <td><span class="pill pago">Pago (TRX-812034)</span></td>
            <td><span class="pill aprovado">Matriculado</span></td>
            <td><button class="btn-secondary" style="padding:0.3rem 0.6rem; font-size:0.75rem;">Emitir Ficha →</button></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

  <!-- Modal Nova Matrícula -->
  <div class="overlay" id="modalNovaMatricula">
    <div class="modal">
      <div class="modal-head">
        <h3>Formalizar Matrícula em Turma</h3>
        <button class="modal-close" type="button">&times;</button>
      </div>
      <form action="#" method="POST" onsubmit="event.preventDefault(); window.location.href='{{ url('/formandos') }}';">
        <div class="field">
          <label>Candidato com Pagamento Liquidado nas Finanças</label>
          <select required>
            <option>Domingos Kiala — Redes de TI (Comprovativo TRX-948123)</option>
            <option>Ana Paula Neto — Sistemas Fotovoltaicos (Comprovativo TRX-812034)</option>
          </select>
        </div>
        <div class="field">
          <label>Atribuir a Turma</label>
          <select required>
            <option>T-TIC204-A (Redes e TI · Seg/Qua/Sex 08h-12h)</option>
            <option>T-ENR055-A (Sistemas Fotovoltaicos · Sáb 08h-17h)</option>
            <option>T-MPR072-A (Soldagem · Seg-Sex 07h-11h)</option>
          </select>
        </div>
        <div class="modal-actions">
          <button class="btn-secondary" type="button" data-modal-close>Cancelar</button>
          <button class="btn-primary" type="submit">Concluir Matrícula &amp; Ir p/ Formandos →</button>
        </div>
      </form>
    </div>
  </div>
@endsection
