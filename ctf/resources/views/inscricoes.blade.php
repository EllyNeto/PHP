@extends('layout.admin')

@section('title', 'Inscrições')
@section('active', 'inscricoes')
@section('page-title', 'Inscrições')
@section('page-subtitle', 'Recepção das inscrições submetidas aos cursos')

@section('content')
  <!-- Alert de Notificação / Toast -->
  <div id="toastNotification" style="display: none; position: fixed; top: 1.5rem; right: 1.5rem; z-index: 1100; background: var(--panel); border: 1px solid var(--green); border-left: 4px solid var(--green); padding: 0.85rem 1.2rem; border-radius: 8px; box-shadow: 0 10px 25px rgba(0,0,0,0.2); font-size: 0.85rem; color: var(--text); align-items: center; gap: 0.6rem;">
    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--green)" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
    <span id="toastMessage">Operação realizada com sucesso!</span>
  </div>

  <div class="kpi-row">
    <div class="kpi-card" style="--kpi-accent:var(--amber); --kpi-accent-dim:var(--amber-dim);">
      <div class="kpi-top">
        <div class="kpi-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M9 11l3 3L22 4"/><path d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11"/></svg>
        </div>
      </div>
      <div class="kpi-value mono-num" id="kpiPendentes">{{ $kpiPendentes ?? 0 }}</div>
      <div class="kpi-label">Inscrições Pendentes</div>
    </div>

    <div class="kpi-card" style="--kpi-accent:var(--green); --kpi-accent-dim:var(--green-dim);">
      <div class="kpi-top">
        <div class="kpi-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
        </div>
      </div>
      <div class="kpi-value mono-num" id="kpiAprovadas">{{ $kpiAprovadas ?? 0 }}</div>
      <div class="kpi-label">Inscrições  Aprovadas</div>
    </div>

    <div class="kpi-card" style="--kpi-accent:var(--red); --kpi-accent-dim:var(--red-dim);">
      <div class="kpi-top">
        <div class="kpi-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>
        </div>
      </div>
      <div class="kpi-value mono-num" id="kpiRejeitadas">{{ $kpiRejeitadas ?? 0 }}</div>
      <div class="kpi-label">Inscrições Rejeitadas</div>
    </div>
  </div>

  <div class="panel">
    <div class="panel-head">
      <div>
        <div class="panel-title">Lista de Inscrições Submetidas</div>
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
          @forelse($inscricoes as $inscricao)
            @php
              $candId = 'INC-' . ($inscricao->created_at ? $inscricao->created_at->format('Y') : date('Y')) . '-' . str_pad($inscricao->id, 3, '0', STR_PAD_LEFT);
              $nameParts = array_filter(explode(' ', trim($inscricao->name)));
              $initials = count($nameParts) > 1 
                ? strtoupper(substr(reset($nameParts), 0, 1) . substr(end($nameParts), 0, 1))
                : strtoupper(substr(reset($nameParts), 0, 2));
            @endphp
            <tr data-candidato-id="{{ $candId }}">
              <td>
                <div class="formador-cell">
                  <span class="avatar-mini">{{ $initials }}</span>
                  <div>
                    <div class="cell-main candidato-nome">{{ $inscricao->name }}</div>
                    <div class="cell-sub candidato-sub">BI: {{ $inscricao->bi ?: 'N/D' }} • {{ $inscricao->phone ?: 'N/D' }}</div>
                  </div>
                </div>
              </td>
              <td class="candidato-curso">{{ $inscricao->course }}</td>
              <td class="mono-num candidato-data">{{ $inscricao->created_at ? $inscricao->created_at->format('d/m/Y') : date('d/m/Y') }}</td>
              <td class="candidato-estado-cell">
                @if(isset($inscricao->status) && in_array(strtolower($inscricao->status), ['aprovado', 'aprovada', 'aprovada (pago)']))
                  <span class="pill aprovado">Aprovada (Pago)</span>
                @elseif(isset($inscricao->status) && in_array(strtolower($inscricao->status), ['rejeitado', 'rejeitada']))
                  <span class="pill rejeitado">Rejeitada</span>
                @else
                  <span class="pill pendente">Pendente Avaliação</span>
                @endif
              </td>
              <td>
                <div style="display: flex; gap: 0.4rem; align-items: center;">
                  <button class="btn-primary btn-detalhes" 
                          style="padding:0.35rem 0.75rem; font-size:0.78rem;" 
                          data-modal-target="modalDetalhesInscricao"
                          data-db-id="{{ $inscricao->id }}"
                          data-id="{{ $candId }}"
                          data-nome="{{ $inscricao->name }}"
                          data-email="{{ $inscricao->email }}"
                          data-bi="{{ $inscricao->bi }}"
                          data-contacto="{{ $inscricao->phone }}"
                          data-curso="{{ $inscricao->course }}"
                          data-data="{{ $inscricao->created_at ? $inscricao->created_at->format('d/m/Y') : '' }}"
                          data-pagamento-info="{{ $inscricao->pagamento_info ?? '⏳ Pendente nas Finanças — Aguardando Pagamento' }}">
                    Detalhes
                  </button>
                  <button class="btn-secondary btn-eliminar" 
                          style="padding:0.35rem 0.65rem; font-size:0.78rem; color: #ef4444; border-color: rgba(239,68,68,0.3); background: rgba(239,68,68,0.06);" 
                          data-modal-target="modalEliminarInscricao"
                          data-db-id="{{ $inscricao->id }}"
                          data-nome="{{ $inscricao->name }}">
                    Eliminar
                  </button>
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="5" style="text-align: center; padding: 2rem; color: var(--text-dim);">
                Nenhuma candidatura encontrada.
              </td>
            </tr>
          @endforelse
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

      <form id="formEditarInscricao" action="" method="POST">
        @csrf
        @method('PUT')
        <!-- Informação sobre restrição de alterações financeiras -->
        <div style="background: var(--panel-2); border: 1px solid var(--border); border-left: 4px solid var(--amber); padding: 0.75rem 0.9rem; border-radius: 8px; font-size: 0.8rem; line-height: 1.4; color: var(--text); margin-bottom: 1rem;">
          <div style="font-weight: 600; margin-bottom: 0.25rem; display: flex; align-items: center; gap: 0.35rem; color: var(--amber);">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
            Edição Restrita a Dados Pessoais &amp; Académicos
          </div>
          Neste módulo pode alterar apenas os dados cadastrais do aluno. O estado e a liquidação financeira são <strong>geridos exclusivamente pela área de Finanças</strong>.
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.85rem;">
          <div class="field" style="grid-column: span 2;">
            <label>Nome Completo do Aluno</label>
            <input type="text" id="detalhesNome" name="name" required>
          </div>

          <div class="field">
            <label>Email do Aluno</label>
            <input type="email" id="detalhesEmail" name="email" required>
          </div>

          <div class="field">
            <label>Contacto Telefónico</label>
            <input type="text" id="detalhesContacto" name="phone" required>
          </div>

          <div class="field">
            <label>Nº de Bilhete de Identidade (BI)</label>
            <input type="text" id="detalhesBI" name="bi" required>
          </div>

          <div class="field">
            <label>Data de Inscrição</label>
            <input type="text" id="detalhesData" readonly style="opacity: 0.85; background: var(--panel-2);">
          </div>

          <div class="field" style="grid-column: span 2;">
            <label>Curso Pretendido</label>
            <select id="detalhesCurso" name="course" required>
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

        <div class="modal-actions" style="margin-top: 0.75rem; display: flex; justify-content: space-between; align-items: center;">
          <button class="btn-secondary btn-eliminar-modal" type="button" 
                  style="color: #ef4444; border-color: rgba(239,68,68,0.3); background: rgba(239,68,68,0.06);">
            Eliminar Inscrição
          </button>
          <div style="display: flex; gap: 0.5rem;">
            <button class="btn-secondary" type="button" data-modal-close>Cancelar</button>
            <button class="btn-primary" type="submit">Guardar Alterações</button>
          </div>
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
      <form id="formNovaInscricao" action="{{ route('inscricoes.store') }}" method="POST">
        @csrf
        <div class="field">
          <label>Nome do Candidato</label>
          <input type="text" id="novoNome" name="name" placeholder="ex.: Domingos Kiala" required>
        </div>
        <div class="field">
          <label>Email</label>
          <input type="email" id="novoEmail" name="email" placeholder="ex.: candidato@exemplo.com" required>
        </div>
        <div class="field">
          <label>Curso Pretendido</label>
          <select id="novoCurso" name="course" required>
            <option value="Redes e Infraestruturas de TI">Redes e Infraestruturas de TI</option>
            <option value="Electricidade Industrial">Electricidade Industrial</option>
            <option value="Soldagem e Caldeiraria">Soldagem e Caldeiraria</option>
            <option value="Sistemas Fotovoltaicos">Sistemas Fotovoltaicos</option>
            <option value="Automação Industrial">Automação Industrial</option>
          </select>
        </div>
        <div class="field">
          <label>Bilhete de Identidade (BI)</label>
          <input type="text" id="novoBI" name="bi" placeholder="00XXXXXXXXX000" required>
        </div>
        <div class="field">
          <label>Contacto Telefónico</label>
          <input type="text" id="novoContacto" name="phone" placeholder="+244 9XX XXX XXX" required>
        </div>
        <div class="modal-actions">
          <button class="btn-secondary" type="button" data-modal-close>Cancelar</button>
          <button class="btn-primary" type="submit">Submeter Candidatura</button>
        </div>
      </form>
    </div>
  </div>

  <!-- Modal Confirmar Eliminação -->
  <div class="overlay" id="modalEliminarInscricao">
    <div class="modal" style="max-width: 450px;">
      <div class="modal-head">
        <h3 style="color: #ef4444; display: flex; align-items: center; gap: 0.4rem;">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 0V4a2 2 0 012-2h4a2 2 0 012 2v2"/><line x1="10" y1="11" x2="10" y2="17"/><line x1="14" y1="11" x2="14" y2="17"/></svg>
          Eliminar Inscrição
        </h3>
        <button class="modal-close" type="button">&times;</button>
      </div>
      <form id="formEliminarInscricao" action="" method="POST">
        @csrf
        @method('DELETE')
        <div style="padding: 1rem 0; color: var(--text); font-size: 0.88rem; line-height: 1.5;">
          Tem certeza de que deseja eliminar permanentemente a inscrição de <strong id="eliminarNomeCandidato" style="color: var(--text-heading);"></strong>? Esta acção não poderá ser desfeita.
        </div>
        <div class="modal-actions" style="margin-top: 0.5rem;">
          <button class="btn-secondary" type="button" data-modal-close>Cancelar</button>
          <button class="btn-primary" type="submit" style="background: #ef4444; border-color: #ef4444; color: #fff;">Confirmar Eliminação</button>
        </div>
      </form>
    </div>
  </div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
  let activeDbId = null;
  let activeNome = '';

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

  @if(session('success'))
    showToast("{{ session('success') }}");
  @endif

  @if(session('error'))
    showToast("{{ session('error') }}");
  @endif

  // Preencher modal de Detalhes ao clicar no botão Detalhes
  document.querySelectorAll('.btn-detalhes').forEach(btn => {
    btn.addEventListener('click', function () {
      const dbId = this.getAttribute('data-db-id');
      const id = this.getAttribute('data-id');
      const nome = this.getAttribute('data-nome');
      const email = this.getAttribute('data-email');
      const bi = this.getAttribute('data-bi');
      const contacto = this.getAttribute('data-contacto');
      const curso = this.getAttribute('data-curso');
      const dataInsc = this.getAttribute('data-data');
      const pagamentoInfo = this.getAttribute('data-pagamento-info');

      activeDbId = dbId;
      activeNome = nome;

      const formEditar = document.getElementById('formEditarInscricao');
      if (formEditar) {
        formEditar.action = '/inscricoes/' + dbId;
      }

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

  // Setup do modal de eliminação pela tabela
  document.querySelectorAll('.btn-eliminar').forEach(btn => {
    btn.addEventListener('click', function () {
      const dbId = this.getAttribute('data-db-id');
      const nome = this.getAttribute('data-nome');
      activeDbId = dbId;
      activeNome = nome;

      const formEliminar = document.getElementById('formEliminarInscricao');
      if (formEliminar) {
        formEliminar.action = '/inscricoes/' + dbId;
      }
      const nomeEl = document.getElementById('eliminarNomeCandidato');
      if (nomeEl) {
        nomeEl.textContent = nome;
      }
    });
  });

  // Botão Eliminar dentro do Modal de Detalhes
  const btnEliminarModal = document.querySelector('.btn-eliminar-modal');
  if (btnEliminarModal) {
    btnEliminarModal.addEventListener('click', function () {
      const modalDetalhes = document.getElementById('modalDetalhesInscricao');
      if (modalDetalhes) modalDetalhes.classList.remove('show');

      const formEliminar = document.getElementById('formEliminarInscricao');
      if (formEliminar && activeDbId) {
        formEliminar.action = '/inscricoes/' + activeDbId;
      }
      const nomeEl = document.getElementById('eliminarNomeCandidato');
      if (nomeEl) {
        nomeEl.textContent = activeNome;
      }

      const modalEliminar = document.getElementById('modalEliminarInscricao');
      if (modalEliminar) modalEliminar.classList.add('show');
    });
  }
});
</script>
@endpush
