@extends('layout.admin')

@section('title', 'Inscrições')
@section('active', 'inscricoes')
@section('page-title', 'Inscrições & Candidaturas')
@section('page-subtitle', 'Gestão e validação de candidaturas submetidas para novos cursos')

@section('content')
  <div class="kpi-row">
    <div class="kpi-card" style="--kpi-accent:var(--amber); --kpi-accent-dim:var(--amber-dim);">
      <div class="kpi-top">
        <div class="kpi-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M9 11l3 3L22 4"/><path d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11"/></svg>
        </div>
      </div>
      <div class="kpi-value mono-num">5</div>
      <div class="kpi-label">Inscrições Pendentes</div>
    </div>

    <div class="kpi-card" style="--kpi-accent:var(--green); --kpi-accent-dim:var(--green-dim);">
      <div class="kpi-top">
        <div class="kpi-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
        </div>
      </div>
      <div class="kpi-value mono-num">142</div>
      <div class="kpi-label">Candidaturas Aprovadas</div>
    </div>

    <div class="kpi-card" style="--kpi-accent:var(--red); --kpi-accent-dim:var(--red-dim);">
      <div class="kpi-top">
        <div class="kpi-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>
        </div>
      </div>
      <div class="kpi-value mono-num">12</div>
      <div class="kpi-label">Candidaturas Rejeitadas</div>
    </div>
  </div>

  <div class="panel">
    <div class="panel-head">
      <div>
        <div class="panel-title">Lista de Candidaturas Submetidas</div>
        <div class="panel-sub">Avaliação de requisitos e documentos de inscrição</div>
      </div>
      <button class="btn-primary" data-modal-target="modalNovaInscricao">+ Nova Inscrição</button>
    </div>
    <div class="table-wrap">
      <table>
        <thead>
          <tr>
            <th>Candidato</th>
            <th>Curso Pretendido</th>
            <th>Data de Inscrição</th>
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
            <td>
              <button class="btn-primary" style="padding:0.3rem 0.6rem; font-size:0.75rem; background:var(--green); color:#fff;" onclick="alert('Inscrição aprovada com sucesso!');">Aprovar</button>
              <button class="btn-secondary" style="padding:0.3rem 0.6rem; font-size:0.75rem; color:var(--red);" onclick="alert('Inscrição rejeitada.');">Rejeitar</button>
            </td>
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
            <td><span class="cell-sub">Matriculado</span></td>
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
            <td>
              <button class="btn-primary" style="padding:0.3rem 0.6rem; font-size:0.75rem; background:var(--green); color:#fff;" onclick="alert('Inscrição aprovada com sucesso!');">Aprovar</button>
              <button class="btn-secondary" style="padding:0.3rem 0.6rem; font-size:0.75rem; color:var(--red);" onclick="alert('Inscrição rejeitada.');">Rejeitar</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

  <!-- Modal Nova Inscrição -->
  <div class="overlay" id="modalNovaInscricao">
    <div class="modal">
      <div class="modal-head">
        <h3>Registar Candidatura</h3>
        <button class="modal-close" type="button">&times;</button>
      </div>
      <form action="#" method="POST" onsubmit="event.preventDefault(); this.closest('.overlay').classList.remove('show');">
        <div class="field">
          <label>Nome do Candidato</label>
          <input type="text" placeholder="ex.: Domingos Kiala" required>
        </div>
        <div class="field">
          <label>Curso Pretendido</label>
          <select required>
            <option>Redes e Infraestruturas de TI</option>
            <option>Electricidade Industrial</option>
            <option>Soldagem e Caldeiraria</option>
            <option>Sistemas Fotovoltaicos</option>
          </select>
        </div>
        <div class="field">
          <label>Bilhete de Identidade (BI)</label>
          <input type="text" placeholder="00XXXXXXXXX000" required>
        </div>
        <div class="field">
          <label>Contacto Telefónico</label>
          <input type="text" placeholder="+244 9XX XXX XXX" required>
        </div>
        <div class="modal-actions">
          <button class="btn-secondary" type="button" data-modal-close>Cancelar</button>
          <button class="btn-primary" type="submit">Submeter Inscrição</button>
        </div>
      </form>
    </div>
  </div>
@endsection
