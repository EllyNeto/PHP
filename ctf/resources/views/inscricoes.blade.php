@extends('layout.admin')

@section('title', 'Inscrições')
@section('active', 'inscricoes')
@section('page-title', 'Inscrições & Candidaturas')
@section('page-subtitle', 'Recepção e validação das candidaturas submetidas aos cursos')

@section('content')
  <!-- Alert de Notificação / Toast -->
  <div id="toastNotification" style="display: none; position: fixed; top: 1.5rem; right: 1.5rem; z-index: 1100; background: var(--panel); border: 1px solid var(--green); border-left: 4px solid var(--green); padding: 0.85rem 1.2rem; border-radius: 8px; box-shadow: 0 10px 25px rgba(0,0,0,0.2); font-size: 0.85rem; color: var(--text); align-items: center; gap: 0.6rem;">
    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--green)" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
    <span id="toastMessage">Dados do aluno alterados com sucesso!</span>
  </div>

  <div class="kpi-row">
    <div class="kpi-card" style="--kpi-accent:var(--amber); --kpi-accent-dim:var(--amber-dim);">
      <div class="kpi-top">
        <div class="kpi-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M9 11l3 3L22 4"/><path d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11"/></svg>
        </div>
      </div>
      <div class="kpi-value mono-num" id="kpiPendentes">2</div>
      <div class="kpi-label">Inscrições Pendentes</div>
    </div>

    <div class="kpi-card" style="--kpi-accent:var(--green); --kpi-accent-dim:var(--green-dim);">
      <div class="kpi-top">
        <div class="kpi-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
        </div>
      </div>
      <div class="kpi-value mono-num" id="kpiAprovadas">142</div>
      <div class="kpi-label">Candidaturas Aprovadas</div>
    </div>

    <div class="kpi-card" style="--kpi-accent:var(--red); --kpi-accent-dim:var(--red-dim);">
      <div class="kpi-top">
        <div class="kpi-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>
        </div>
      </div>
      <div class="kpi-value mono-num" id="kpiRejeitadas">12</div>
      <div class="kpi-label">Candidaturas Rejeitadas</div>
    </div>
  </div>

  <div class="panel">
    <div class="panel-head">
      <div>
        <div class="panel-title">Lista de Candidaturas Submetidas</div>
        <div class="panel-sub">Avaliação dos requisitos dos candidatos a cursos</div>
      </div>
      <button class="btn-primary" data-modal-target="modalNovaInscricao">+ Nova Inscrição</button>
    </div>
    <div class="table-wrap">
      <table id="tabelaInscricoes">
        <thead>
          <tr>
            <th>Candidato</th>
            <th>Curso Pretendido</th>
            <th>Data de Inscrição</th>
            <th>Estado da Inscrição</th>
            <th>Acção</th>
          </tr>
        </thead>
        <tbody>
          <tr data-candidato-id="INC-2026-034">
            <td>
              <div class="formador-cell">
                <span class="avatar-mini">DK</span>
                <div>
                  <div class="cell-main candidato-nome">Domingos Kiala</div>
                  <div class="cell-sub candidato-sub">BI: 004819231LA042 • +244 923 111 222</div>
                </div>
              </div>
            </td>
            <td class="candidato-curso">Redes e Infraestruturas de TI</td>
            <td class="mono-num candidato-data">05/08/2026</td>
            <td class="candidato-estado-cell">
              <span class="pill pendente">Pendente Avaliação</span>
            </td>
            <td>
              <button class="btn-primary btn-detalhes" 
                      style="padding:0.35rem 0.75rem; font-size:0.78rem;" 
                      data-modal-target="modalDetalhesInscricao"
                      data-id="INC-2026-034"
                      data-nome="Domingos Kiala"
                      data-email="domingos.kiala@gmail.com"
                      data-bi="004819231LA042"
                      data-contacto="+244 923 111 222"
                      data-curso="Redes e Infraestruturas de TI"
                      data-data="05/08/2026"
                      data-pagamento-info="⏳ Pendente nas Finanças — Aguardando Pagamento">
                Detalhes
              </button>
            </td>
          </tr>
          <tr data-candidato-id="INC-2026-029">
            <td>
              <div class="formador-cell">
                <span class="avatar-mini">AN</span>
                <div>
                  <div class="cell-main candidato-nome">Ana Paula Neto</div>
                  <div class="cell-sub candidato-sub">BI: 009218342LA012 • +244 912 333 444</div>
                </div>
              </div>
            </td>
            <td class="candidato-curso">Sistemas Fotovoltaicos</td>
            <td class="mono-num candidato-data">04/08/2026</td>
            <td class="candidato-estado-cell">
              <span class="pill aprovado">Aprovada (Pago)</span>
            </td>
            <td>
              <button class="btn-primary btn-detalhes" 
                      style="padding:0.35rem 0.75rem; font-size:0.78rem;" 
                      data-modal-target="modalDetalhesInscricao"
                      data-id="INC-2026-029"
                      data-nome="Ana Paula Neto"
                      data-email="ana.neto@hotmail.com"
                      data-bi="009218342LA012"
                      data-contacto="+244 912 333 444"
                      data-curso="Sistemas Fotovoltaicos"
                      data-data="04/08/2026"
                      data-pagamento-info="✅ Confirmado pelas Finanças — Pago">
                Detalhes
              </button>
            </td>
          </tr>
          <tr data-candidato-id="INC-2026-025">
            <td>
              <div class="formador-cell">
                <span class="avatar-mini">FB</span>
                <div>
                  <div class="cell-main candidato-nome">Fernando Bumba</div>
                  <div class="cell-sub candidato-sub">BI: 001928341LA099 • +244 934 555 666</div>
                </div>
              </div>
            </td>
            <td class="candidato-curso">Soldagem e Caldeiraria</td>
            <td class="mono-num candidato-data">03/08/2026</td>
            <td class="candidato-estado-cell">
              <span class="pill pendente">Pendente Avaliação</span>
            </td>
            <td>
              <button class="btn-primary btn-detalhes" 
                      style="padding:0.35rem 0.75rem; font-size:0.78rem;" 
                      data-modal-target="modalDetalhesInscricao"
                      data-id="INC-2026-025"
                      data-nome="Fernando Bumba"
                      data-email="fernando.bumba@outlook.com"
                      data-bi="001928341LA099"
                      data-contacto="+244 934 555 666"
                      data-curso="Soldagem e Caldeiraria"
                      data-data="03/08/2026"
                      data-pagamento-info="⏳ Pendente nas Finanças — Aguardando Pagamento">
                Detalhes
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

  <!-- Modal Detalhes & Edição de Dados do Aluno Inscrito -->
  <div class="overlay" id="modalDetalhesInscricao">
    <div class="modal" style="max-width: 580px;">
      <div class="modal-head">
        <div>
          <h3 id="detalhesModalTitle">Detalhes do Aluno Inscrito</h3>
          <p id="detalhesModalSub" style="font-size:0.75rem; color:var(--text-dim); margin-top:2px;">Inscrição #INC-2026-000</p>
        </div>
        <button class="modal-close" type="button">&times;</button>
      </div>

      <form id="formEditarInscricao" action="#" method="POST">
        <!-- Informação sobre restrição de alterações financeiras -->
        <div style="background: var(--panel-2); border: 1px solid var(--border); border-left: 4px solid var(--amber); padding: 0.75rem 0.9rem; border-radius: 8px; font-size: 0.8rem; line-height: 1.4; color: var(--text);">
          <div style="font-weight: 600; margin-bottom: 0.25rem; display: flex; align-items: center; gap: 0.35rem; color: var(--amber);">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
            Edição Restrita a Dados Pessoais &amp; Académicos
          </div>
          Neste módulo pode alterar apenas os dados cadastrais do aluno. O estado e a liquidação financeira são <strong>geridos exclusivamente pela área de Finanças</strong>.
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.85rem;">
          <div class="field" style="grid-column: span 2;">
            <label>Nome Completo do Aluno</label>
            <input type="text" id="detalhesNome" required>
          </div>

          <div class="field">
            <label>Email do Aluno</label>
            <input type="email" id="detalhesEmail" required>
          </div>

          <div class="field">
            <label>Contacto Telefónico</label>
            <input type="text" id="detalhesContacto" required>
          </div>

          <div class="field">
            <label>Nº de Bilhete de Identidade (BI)</label>
            <input type="text" id="detalhesBI" required>
          </div>

          <div class="field">
            <label>Data de Inscrição</label>
            <input type="text" id="detalhesData" readonly style="opacity: 0.85; background: var(--panel-2);">
          </div>

          <div class="field" style="grid-column: span 2;">
            <label>Curso Pretendido</label>
            <select id="detalhesCurso" required>
              <option value="Redes e Infraestruturas de TI">Redes e Infraestruturas de TI</option>
              <option value="Electricidade Industrial">Electricidade Industrial</option>
              <option value="Soldagem e Caldeiraria">Soldagem e Caldeiraria</option>
              <option value="Sistemas Fotovoltaicos">Sistemas Fotovoltaicos</option>
              <option value="Automação Industrial">Automação Industrial</option>
            </select>
          </div>

          <div class="field" style="grid-column: span 2;">
            <label>Situação Financeira (Informativo — Módulo de Finanças)</label>
            <input type="text" id="detalhesPagamentoInfo" readonly style="opacity: 0.85; background: var(--panel-2); font-weight: 500; color: var(--text);">
          </div>
        </div>

        <div class="modal-actions" style="margin-top: 0.75rem;">
          <button class="btn-secondary" type="button" data-modal-close>Cancelar</button>
          <button class="btn-primary" type="submit">Guardar Alterações</button>
        </div>
      </form>
    </div>
  </div>

  <!-- Modal Nova Inscrição -->
  <div class="overlay" id="modalNovaInscricao">
    <div class="modal">
      <div class="modal-head">
        <h3>Registar Candidatura</h3>
        <button class="modal-close" type="button">&times;</button>
      </div>
      <form id="formNovaInscricao" action="#" method="POST">
        <div class="field">
          <label>Nome do Candidato</label>
          <input type="text" id="novoNome" placeholder="ex.: Domingos Kiala" required>
        </div>
        <div class="field">
          <label>Email</label>
          <input type="email" id="novoEmail" placeholder="ex.: candidato@exemplo.com" required>
        </div>
        <div class="field">
          <label>Curso Pretendido</label>
          <select id="novoCurso" required>
            <option value="Redes e Infraestruturas de TI">Redes e Infraestruturas de TI</option>
            <option value="Electricidade Industrial">Electricidade Industrial</option>
            <option value="Soldagem e Caldeiraria">Soldagem e Caldeiraria</option>
            <option value="Sistemas Fotovoltaicos">Sistemas Fotovoltaicos</option>
            <option value="Automação Industrial">Automação Industrial</option>
          </select>
        </div>
        <div class="field">
          <label>Bilhete de Identidade (BI)</label>
          <input type="text" id="novoBI" placeholder="00XXXXXXXXX000" required>
        </div>
        <div class="field">
          <label>Contacto Telefónico</label>
          <input type="text" id="novoContacto" placeholder="+244 9XX XXX XXX" required>
        </div>
        <div class="modal-actions">
          <button class="btn-secondary" type="button" data-modal-close>Cancelar</button>
          <button class="btn-primary" type="submit">Submeter Candidatura</button>
        </div>
      </form>
    </div>
  </div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
  let activeBtn = null;
  let activeRow = null;

  function showToast(message) {
    const toast = document.getElementById('toastNotification');
    const toastMsg = document.getElementById('toastMessage');
    if (toast && toastMsg) {
      toastMsg.textContent = message;
      toast.style.display = 'flex';
      setTimeout(() => {
        toast.style.display = 'none';
      }, 3500);
    }
  }

  function getInitials(name) {
    if (!name) return 'AL';
    const parts = name.trim().split(' ').filter(Boolean);
    if (parts.length === 1) return parts[0].substring(0, 2).toUpperCase();
    return (parts[0][0] + parts[parts.length - 1][0]).toUpperCase();
  }

  // Preencher modal de Detalhes ao clicar no botão Detalhes
  document.querySelectorAll('.btn-detalhes').forEach(btn => {
    btn.addEventListener('click', function () {
      activeBtn = this;
      activeRow = this.closest('tr');

      const id = this.getAttribute('data-id');
      const nome = this.getAttribute('data-nome');
      const email = this.getAttribute('data-email');
      const bi = this.getAttribute('data-bi');
      const contacto = this.getAttribute('data-contacto');
      const curso = this.getAttribute('data-curso');
      const dataInsc = this.getAttribute('data-data');
      const pagamentoInfo = this.getAttribute('data-pagamento-info');

      document.getElementById('detalhesModalTitle').textContent = `Detalhes de ${nome}`;
      document.getElementById('detalhesModalSub').textContent = `Inscrição #${id}`;

      document.getElementById('detalhesNome').value = nome || '';
      document.getElementById('detalhesEmail').value = email || '';
      document.getElementById('detalhesContacto').value = contacto || '';
      document.getElementById('detalhesBI').value = bi || '';
      document.getElementById('detalhesData').value = dataInsc || '';
      document.getElementById('detalhesCurso').value = curso || '';
      document.getElementById('detalhesPagamentoInfo').value = pagamentoInfo || '⏳ Pendente nas Finanças — Aguardando Pagamento';
    });
  });

  // Guardar alterações apenas dos dados pessoais/académicos do aluno inscrito
  const formEditar = document.getElementById('formEditarInscricao');
  if (formEditar) {
    formEditar.addEventListener('submit', function (e) {
      e.preventDefault();

      if (!activeRow || !activeBtn) return;

      const novoNome = document.getElementById('detalhesNome').value.trim();
      const novoEmail = document.getElementById('detalhesEmail').value.trim();
      const novoContacto = document.getElementById('detalhesContacto').value.trim();
      const novoBI = document.getElementById('detalhesBI').value.trim();
      const novoCurso = document.getElementById('detalhesCurso').value;

      // Atualizar data attributes do botão
      activeBtn.setAttribute('data-nome', novoNome);
      activeBtn.setAttribute('data-email', novoEmail);
      activeBtn.setAttribute('data-contacto', novoContacto);
      activeBtn.setAttribute('data-bi', novoBI);
      activeBtn.setAttribute('data-curso', novoCurso);

      // Atualizar elementos da linha na tabela
      const avatarMini = activeRow.querySelector('.avatar-mini');
      if (avatarMini) avatarMini.textContent = getInitials(novoNome);

      const cellNome = activeRow.querySelector('.candidato-nome');
      if (cellNome) cellNome.textContent = novoNome;

      const cellSub = activeRow.querySelector('.candidato-sub');
      if (cellSub) cellSub.textContent = `BI: ${novoBI} • ${novoContacto}`;

      const cellCurso = activeRow.querySelector('.candidato-curso');
      if (cellCurso) cellCurso.textContent = novoCurso;

      // Fechar modal
      const modalOverlay = document.getElementById('modalDetalhesInscricao');
      if (modalOverlay) modalOverlay.classList.remove('show');

      showToast(`Dados do formando "${novoNome}" atualizados com sucesso!`);
    });
  }

  // Registar Nova Inscrição
  const formNova = document.getElementById('formNovaInscricao');
  if (formNova) {
    formNova.addEventListener('submit', function (e) {
      e.preventDefault();

      const nome = document.getElementById('novoNome').value.trim();
      const email = document.getElementById('novoEmail').value.trim();
      const curso = document.getElementById('novoCurso').value;
      const bi = document.getElementById('novoBI').value.trim();
      const contacto = document.getElementById('novoContacto').value.trim();

      const today = new Date();
      const dateStr = String(today.getDate()).padStart(2, '0') + '/' + String(today.getMonth() + 1).padStart(2, '0') + '/' + today.getFullYear();
      const idInc = 'INC-2026-0' + Math.floor(Math.random() * 90 + 10);

      const tbody = document.querySelector('#tabelaInscricoes tbody');
      if (tbody) {
        const tr = document.createElement('tr');
        tr.setAttribute('data-candidato-id', idInc);
        tr.innerHTML = `
          <td>
            <div class="formador-cell">
              <span class="avatar-mini">${getInitials(nome)}</span>
              <div>
                <div class="cell-main candidato-nome">${nome}</div>
                <div class="cell-sub candidato-sub">BI: ${bi} • ${contacto}</div>
              </div>
            </div>
          </td>
          <td class="candidato-curso">${curso}</td>
          <td class="mono-num candidato-data">${dateStr}</td>
          <td class="candidato-estado-cell">
            <span class="pill pendente">Pendente Avaliação</span>
          </td>
          <td>
            <button class="btn-primary btn-detalhes" 
                    style="padding:0.35rem 0.75rem; font-size:0.78rem;" 
                    data-modal-target="modalDetalhesInscricao"
                    data-id="${idInc}"
                    data-nome="${nome}"
                    data-email="${email}"
                    data-bi="${bi}"
                    data-contacto="${contacto}"
                    data-curso="${curso}"
                    data-data="${dateStr}"
                    data-pagamento-info="⏳ Pendente nas Finanças — Aguardando Pagamento">
              Detalhes
            </button>
          </td>
        `;

        tbody.prepend(tr);

        // Bind click handler to the new button
        const newBtn = tr.querySelector('.btn-detalhes');
        newBtn.addEventListener('click', function () {
          activeBtn = this;
          activeRow = this.closest('tr');

          document.getElementById('detalhesModalTitle').textContent = `Detalhes de ${nome}`;
          document.getElementById('detalhesModalSub').textContent = `Inscrição #${idInc}`;

          document.getElementById('detalhesNome').value = nome;
          document.getElementById('detalhesEmail').value = email;
          document.getElementById('detalhesContacto').value = contacto;
          document.getElementById('detalhesBI').value = bi;
          document.getElementById('detalhesData').value = dateStr;
          document.getElementById('detalhesCurso').value = curso;
          document.getElementById('detalhesPagamentoInfo').value = '⏳ Pendente nas Finanças — Aguardando Pagamento';

          const modalOverlay = document.getElementById('modalDetalhesInscricao');
          if (modalOverlay) modalOverlay.classList.add('show');
        });
      }

      // Limpar formulário e fechar modal
      formNova.reset();
      const modalNova = document.getElementById('modalNovaInscricao');
      if (modalNova) modalNova.classList.remove('show');

      showToast(`Nova candidatura de "${nome}" submetida com sucesso!`);
    });
  }
});
</script>
@endpush


