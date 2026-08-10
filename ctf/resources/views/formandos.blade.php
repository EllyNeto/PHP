@extends('layout.admin')

@section('title', 'Formandos')
@section('active', 'formandos')
@section('page-title', 'Gestão de Formandos')
@section('page-subtitle', 'Listagem e controlo dos alunos matriculados nos cursos')

@section('content')
  <div class="kpi-row">
    <div class="kpi-card" style="--kpi-accent:var(--teal); --kpi-accent-dim:var(--teal-dim);">
      <div class="kpi-top">
        <div class="kpi-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
        </div>
      </div>
      <div class="kpi-value mono-num">812</div>
      <div class="kpi-label">Total de Matriculados</div>
    </div>

    <div class="kpi-card" style="--kpi-accent:var(--green); --kpi-accent-dim:var(--green-dim);">
      <div class="kpi-top">
        <div class="kpi-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
        </div>
      </div>
      <div class="kpi-value mono-num">745</div>
      <div class="kpi-label">Propinas em Dia</div>
    </div>

    <div class="kpi-card" style="--kpi-accent:var(--red); --kpi-accent-dim:var(--red-dim);">
      <div class="kpi-top">
        <div class="kpi-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
        </div>
      </div>
      <div class="kpi-value mono-num">67</div>
      <div class="kpi-label">Com Pagamento Pendente</div>
    </div>
  </div>

  <div class="panel">
    <div class="panel-head">
      <div>
        <div class="panel-title">Lista Geral de Formandos</div>
        <div class="panel-sub">Formandos com matrícula activa nas turmas</div>
      </div>
      <button class="btn-primary" data-modal-target="modalNovoFormando">+ Novo Formando</button>
    </div>
    <div class="table-wrap">
      <table>
        <thead>
          <tr>
            <th>Matrícula</th>
            <th>Formando</th>
            <th>Curso / Turma</th>
            <th>Contacto</th>
            <th>Estado Pagamento</th>
            <th>Acções</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="mono-num">CF-2026-0341</td>
            <td>
              <div class="formador-cell">
                <span class="avatar-mini">DK</span>
                <div>
                  <div class="cell-main">Domingos Kiala</div>
                  <div class="cell-sub">domingos.kiala@gmail.com</div>
                </div>
              </div>
            </td>
            <td>
              <div class="cell-main">Redes e Infraestruturas de TI</div>
              <div class="cell-sub mono-num">Turma: T-TIC204-A</div>
            </td>
            <td class="mono-num">+244 923 111 222</td>
            <td><span class="pill pago">Em Dia</span></td>
            <td><button class="btn-secondary" style="padding: 0.3rem 0.6rem; font-size: 0.75rem;">Editar</button></td>
          </tr>
          <tr>
            <td class="mono-num">CF-2026-0298</td>
            <td>
              <div class="formador-cell">
                <span class="avatar-mini">AN</span>
                <div>
                  <div class="cell-main">Ana Paula Neto</div>
                  <div class="cell-sub">ana.neto@hotmail.com</div>
                </div>
              </div>
            </td>
            <td>
              <div class="cell-main">Sistemas Fotovoltaicos</div>
              <div class="cell-sub mono-num">Turma: T-ENR055-A</div>
            </td>
            <td class="mono-num">+244 912 333 444</td>
            <td><span class="pill pago">Em Dia</span></td>
            <td><button class="btn-secondary" style="padding: 0.3rem 0.6rem; font-size: 0.75rem;">Editar</button></td>
          </tr>
          <tr>
            <td class="mono-num">CF-2026-0255</td>
            <td>
              <div class="formador-cell">
                <span class="avatar-mini">FB</span>
                <div>
                  <div class="cell-main">Fernando Bumba</div>
                  <div class="cell-sub">fernando.bumba@outlook.com</div>
                </div>
              </div>
            </td>
            <td>
              <div class="cell-main">Soldagem e Caldeiraria</div>
              <div class="cell-sub mono-num">Turma: T-MPR072-A</div>
            </td>
            <td class="mono-num">+244 934 555 666</td>
            <td><span class="pill em-atraso">Em Atraso</span></td>
            <td><button class="btn-secondary" style="padding: 0.3rem 0.6rem; font-size: 0.75rem;">Editar</button></td>
          </tr>
          <tr>
            <td class="mono-num">CF-2026-0212</td>
            <td>
              <div class="formador-cell">
                <span class="avatar-mini">MC</span>
                <div>
                  <div class="cell-main">Marta Cassinda</div>
                  <div class="cell-sub">marta.cassinda@gmail.com</div>
                </div>
              </div>
            </td>
            <td>
              <div class="cell-main">Electricidade Industrial</div>
              <div class="cell-sub mono-num">Turma: T-ELM118-B</div>
            </td>
            <td class="mono-num">+244 945 777 888</td>
            <td><span class="pill pago">Em Dia</span></td>
            <td><button class="btn-secondary" style="padding: 0.3rem 0.6rem; font-size: 0.75rem;">Editar</button></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

  <!-- Modal Adicionar Formando -->
  <div class="overlay" id="modalNovoFormando">
    <div class="modal">
      <div class="modal-head">
        <h3>Registar Novo Formando</h3>
        <button class="modal-close" type="button">&times;</button>
      </div>
      <form action="#" method="POST" onsubmit="event.preventDefault(); this.closest('.overlay').classList.remove('show');">
        <div class="field">
          <label>Nome Completo</label>
          <input type="text" placeholder="ex.: Domingos Kiala" required>
        </div>
        <div class="field">
          <label>Nº de Bilhete de Identidade (BI)</label>
          <input type="text" placeholder="00XXXXXXXXX000" required>
        </div>
        <div class="field">
          <label>Email</label>
          <input type="email" placeholder="ex.: aluno@exemplo.com" required>
        </div>
        <div class="field">
          <label>Telefone / WhatsApp</label>
          <input type="text" placeholder="+244 9XX XXX XXX" required>
        </div>
        <div class="field">
          <label>Turma de Ingressão</label>
          <select required>
            <option value="">Selecione uma turma...</option>
            <option>T-TIC204-A (Redes de TI)</option>
            <option>T-ENR055-A (Sistemas Fotovoltaicos)</option>
            <option>T-ELM118-B (Electricidade Industrial)</option>
            <option>T-MPR072-A (Soldagem e Caldeiraria)</option>
          </select>
        </div>
        <div class="modal-actions">
          <button class="btn-secondary" type="button" data-modal-close>Cancelar</button>
          <button class="btn-primary" type="submit">Guardar Formando</button>
        </div>
      </form>
    </div>
  </div>
@endsection
