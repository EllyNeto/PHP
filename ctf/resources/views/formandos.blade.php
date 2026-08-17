@extends('layout.admin')

@section('title', 'Formandos')
@section('active', 'formandos')
@section('page-title', 'Gestão de Formandos')
@section('page-subtitle', 'Listagem e controlo dos alunos matriculados nos cursos')

@section('content')
  @if(session('success'))
    <div style="background: rgba(16, 185, 129, 0.1); border: 1px solid #10b981; border-left: 4px solid #10b981; color: #10b981; padding: 0.85rem 1.1rem; border-radius: 8px; margin-bottom: 1.25rem; font-size: 0.88rem;">
      {{ session('success') }}
    </div>
  @endif

  @if(session('error'))
    <div style="background: rgba(239, 68, 68, 0.12); border: 1px solid #ef4444; border-left: 4px solid #ef4444; color: #ef4444; padding: 0.85rem 1.1rem; border-radius: 8px; margin-bottom: 1.25rem; font-size: 0.88rem;">
      <strong style="display: block; margin-bottom: 0.2rem; font-weight: 700;">⚠️ Erro de Validação:</strong>
      {{ session('error') }}
    </div>
  @endif

  @if(isset($errors) && $errors->any())
    <div style="background: rgba(239, 68, 68, 0.12); border: 1px solid #ef4444; border-left: 4px solid #ef4444; color: #ef4444; padding: 0.85rem 1.1rem; border-radius: 8px; margin-bottom: 1.25rem; font-size: 0.88rem;">
      <strong style="display: block; margin-bottom: 0.4rem; font-weight: 700;">⚠️ Atenção: Foram encontrados erros no formulário que deves retificar:</strong>
      <ul style="margin: 0; padding-left: 1.2rem; display: flex; flex-direction: column; gap: 0.35rem;">
        @foreach($errors->all() as $err)
          <li>{{ $err }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <div class="kpi-row">
    <div class="kpi-card" style="--kpi-accent:var(--teal); --kpi-accent-dim:var(--teal-dim);">
      <div class="kpi-top">
        <div class="kpi-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
        </div>
      </div>
      <div class="kpi-value mono-num">{{ $totalMatriculados ?? 0 }}</div>
      <div class="kpi-label">Total de Matriculados</div>
    </div>

    <div class="kpi-card" style="--kpi-accent:var(--green); --kpi-accent-dim:var(--green-dim);">
      <div class="kpi-top">
        <div class="kpi-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
        </div>
      </div>
      <div class="kpi-value mono-num">{{ $propinasEmDia ?? 0 }}</div>
      <div class="kpi-label">Propinas em Dia</div>
    </div>

    <div class="kpi-card" style="--kpi-accent:var(--red); --kpi-accent-dim:var(--red-dim);">
      <div class="kpi-top">
        <div class="kpi-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
        </div>
      </div>
      <div class="kpi-value mono-num">{{ $propinasPendentes ?? 0 }}</div>
      <div class="kpi-label">Com Pagamento Pendente</div>
    </div>
  </div>

  <div class="panel">
    <div class="panel-head">
      <div>
        <div class="panel-title">Lista Geral de Formandos</div>
        <div class="panel-sub">Formandos com matrícula activa nas turmas</div>
      </div>
      <!-- Button removed per user request -->
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
          @forelse($formandos ?? [] as $f)
            @php
              $matCode = 'CF-2026-' . str_pad($f->id, 4, '0', STR_PAD_LEFT);
              $nome = $f->inscription->name ?? 'Formando sem Nome';
              $email = $f->inscription->email ?? 'N/D';
              $phone = $f->inscription->phone ?? 'N/D';
              $bi = $f->inscription->bi ?? 'N/D';
              $cursoName = $f->classe->course_name ?? $f->inscription->course ?? 'N/D';
              $turmaCode = $f->classe->code ?? 'Aguardando Turma';
              $status = strtolower($f->inscription->status ?? '');
              $info = strtolower($f->inscription->pagamento_info ?? '');
              
              $isPago = in_array($status, ['aprovado', 'aprovada', 'pago', 'em dia']) || 
                        strpos($info, 'pago') !== false || 
                        strpos($info, 'confirmado') !== false;
              $isAtraso = in_array($status, ['em_atraso', 'atraso', 'devedor']);

              $words = explode(' ', trim($nome));
              $initials = count($words) >= 2 
                ? mb_strtoupper(mb_substr($words[0], 0, 1) . mb_substr(end($words), 0, 1))
                : mb_strtoupper(mb_substr($nome, 0, 2));
            @endphp
            <tr>
              <td class="mono-num" style="font-weight: 600; color: var(--amber);">{{ $matCode }}</td>
              <td>
                <div class="formador-cell">
                  <span class="avatar-mini">{{ $initials }}</span>
                  <div>
                    <div class="cell-main">{{ $nome }}</div>
                    <div class="cell-sub">{{ $email }}</div>
                  </div>
                </div>
              </td>
              <td>
                <div class="cell-main">{{ $cursoName }}</div>
                <div class="cell-sub mono-num">Turma: {{ $turmaCode }}</div>
              </td>
              <td class="mono-num">{{ $phone }}</td>
              <td>
                @if($isPago)
                  <span class="pill pago">Em Dia</span>
                @elseif($isAtraso)
                  <span class="pill em-atraso">Em Atraso</span>
                @else
                  <span class="pill pendente">Pendente</span>
                @endif
              </td>
              <td>
                <button class="btn-secondary btn-detalhes-formando" 
                        style="padding: 0.3rem 0.6rem; font-size: 0.75rem;"
                        data-modal-target="modalDetalhesFormando"
                        data-id="{{ $f->id }}"
                        data-code="{{ $matCode }}"
                        data-nome="{{ $nome }}"
                        data-email="{{ $email }}"
                        data-phone="{{ $phone }}"
                        data-bi="{{ $bi }}"
                        data-curso="{{ $cursoName }}"
                        data-turma-code="{{ $turmaCode }}"
                        data-classe-id="{{ $f->classe_id }}"
                        data-pagamento-info="{{ $f->inscription->pagamento_info ?? 'N/D' }}">
                  Editar / Detalhes
                </button>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="6" style="text-align: center; padding: 2rem; color: var(--text-dim);">
                Nenhum formando registado.
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

  <!-- Modal Adicionar Formando (Matrícula) -->
  <div class="overlay" id="modalNovoFormando">
    <div class="modal" style="max-width: 540px;">
      <div class="modal-head">
        <h3>Registar / Formalizar Formando em Turma</h3>
        <button class="modal-close" type="button">&times;</button>
      </div>
      <form action="{{ route('formandos.store') }}" method="POST">
        @csrf
        <div class="field">
          <label>Seleccionar Candidato / Inscrito</label>
          <select name="inscription_id" required>
            @forelse($candidatosPagos ?? [] as $cand)
              <option value="{{ $cand->id }}">{{ $cand->name }} — {{ $cand->course }} ({{ $cand->bi ?? 'Sem BI' }})</option>
            @empty
              <option value="" disabled selected>Nenhum candidato disponível</option>
            @endforelse
          </select>
        </div>
        <div class="field">
          <label>Turma de Ingressão</label>
          <select name="classe_id" required>
            @forelse($turmas ?? [] as $t)
              <option value="{{ $t->id }}">{{ $t->code }} — {{ $t->course_name }} ({{ $t->schedule }})</option>
            @empty
              <option value="" disabled selected>Nenhuma turma registada</option>
            @endforelse
          </select>
        </div>
        <div class="modal-actions">
          <button class="btn-secondary" type="button" data-modal-close>Cancelar</button>
          <button class="btn-primary" type="submit">Guardar Formando</button>
        </div>
      </form>
    </div>
  </div>

  <!-- Modal Detalhes e Edição do Formando -->
  <div class="overlay" id="modalDetalhesFormando">
    <div class="modal" style="max-width: 560px;">
      <div class="modal-head">
        <div>
          <h3 id="detalhesFormandoTitle">Detalhes do Formando</h3>
          <div id="detalhesFormandoSub" style="font-size: 0.78rem; color: var(--text-dim); margin-top: 0.15rem;">Nº: CF-2026-0000</div>
        </div>
        <button class="modal-close" type="button">&times;</button>
      </div>
      <form id="formEditarFormando" action="" method="POST">
        @csrf
        @method('PUT')
        
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.75rem;">
          <div class="field">
            <label>Nº de Matrícula</label>
            <input type="text" id="detalhesFormandoCode" readonly style="opacity: 0.7; background: var(--bg-hover);">
          </div>
          <div class="field">
            <label>BI do Formando</label>
            <input type="text" id="detalhesFormandoBi" readonly style="opacity: 0.7; background: var(--bg-hover);">
          </div>
        </div>

        <div class="field">
          <label>Nome Completo</label>
          <input type="text" id="detalhesFormandoNome" readonly style="opacity: 0.7; background: var(--bg-hover);">
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.75rem;">
          <div class="field">
            <label>Email</label>
            <input type="text" id="detalhesFormandoEmail" readonly style="opacity: 0.7; background: var(--bg-hover);">
          </div>
          <div class="field">
            <label>Telefone / WhatsApp</label>
            <input type="text" id="detalhesFormandoPhone" readonly style="opacity: 0.7; background: var(--bg-hover);">
          </div>
        </div>

        <div class="field">
          <label>Curso de Formação</label>
          <input type="text" id="detalhesFormandoCurso" readonly style="opacity: 0.7; background: var(--bg-hover);">
        </div>

        <div class="field">
          <label>Reatribuir Turma Activa</label>
          <select name="classe_id" id="detalhesFormandoClasse" required>
            @foreach($turmas ?? [] as $t)
              <option value="{{ $t->id }}">{{ $t->code }} — {{ $t->course_name }} ({{ $t->schedule }})</option>
            @endforeach
          </select>
        </div>

        <div class="modal-actions" style="margin-top: 1rem; display: flex; justify-content: space-between; align-items: center;">
          <button class="btn-secondary btn-eliminar-formando-modal" type="button" 
                  style="color: #ef4444; border-color: rgba(239,68,68,0.3); background: rgba(239,68,68,0.06);">
            Eliminar Formando
          </button>
          <div style="display: flex; gap: 0.5rem;">
            <button class="btn-secondary" type="button" data-modal-close>Cancelar</button>
            <button class="btn-primary" type="submit">Guardar Alterações</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <!-- Modal Confirmar Eliminação de Formando -->
  <div class="overlay" id="modalEliminarFormando">
    <div class="modal" style="max-width: 450px;">
      <div class="modal-head">
        <h3 style="color: #ef4444; display: flex; align-items: center; gap: 0.4rem;">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 0V4a2 2 0 012-2h4a2 2 0 012 2v2"/><line x1="10" y1="11" x2="10" y2="17"/><line x1="14" y1="11" x2="14" y2="17"/></svg>
          Eliminar Formando
        </h3>
        <button class="modal-close" type="button">&times;</button>
      </div>
      <form id="formEliminarFormando" action="" method="POST">
        @csrf
        @method('DELETE')
        <div style="padding: 1rem 0; color: var(--text); font-size: 0.88rem; line-height: 1.5;">
          Tem certeza de que deseja eliminar a matrícula do formando <strong id="eliminarCodeFormando" style="color: var(--text-heading);"></strong>? Esta acção aplicará o Soft Delete no registo de formando.
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
  let activeFormandoId = null;
  let activeFormandoCode = '';

  document.querySelectorAll('.btn-detalhes-formando').forEach(btn => {
    btn.addEventListener('click', function () {
      const id = this.getAttribute('data-id');
      const code = this.getAttribute('data-code');
      const nome = this.getAttribute('data-nome');
      const email = this.getAttribute('data-email');
      const phone = this.getAttribute('data-phone');
      const bi = this.getAttribute('data-bi');
      const curso = this.getAttribute('data-curso');
      const classeId = this.getAttribute('data-classe-id');

      activeFormandoId = id;
      activeFormandoCode = code;

      const formEditar = document.getElementById('formEditarFormando');
      if (formEditar) formEditar.action = '/formandos/' + id;

      const titleEl = document.getElementById('detalhesFormandoTitle');
      if (titleEl) titleEl.textContent = `Detalhes de ${nome}`;

      const subEl = document.getElementById('detalhesFormandoSub');
      if (subEl) subEl.textContent = `Nº: ${code}`;

      document.getElementById('detalhesFormandoCode').value = code || '';
      document.getElementById('detalhesFormandoBi').value = bi || '';
      document.getElementById('detalhesFormandoNome').value = nome || '';
      document.getElementById('detalhesFormandoEmail').value = email || '';
      document.getElementById('detalhesFormandoPhone').value = phone || '';
      document.getElementById('detalhesFormandoCurso').value = curso || '';
      
      const classeSelect = document.getElementById('detalhesFormandoClasse');
      if (classeSelect) classeSelect.value = classeId || '';
    });
  });

  const btnEliminarModal = document.querySelector('.btn-eliminar-formando-modal');
  if (btnEliminarModal) {
    btnEliminarModal.addEventListener('click', function () {
      const modalDetalhes = document.getElementById('modalDetalhesFormando');
      if (modalDetalhes) modalDetalhes.classList.remove('show');

      if (activeFormandoId) {
        const formEliminar = document.getElementById('formEliminarFormando');
        if (formEliminar) formEliminar.action = '/formandos/' + activeFormandoId;

        const codeEl = document.getElementById('eliminarCodeFormando');
        if (codeEl) codeEl.textContent = activeFormandoCode;
      }

      const modalEliminar = document.getElementById('modalEliminarFormando');
      if (modalEliminar) modalEliminar.classList.add('show');
    });
  }
});
</script>
@endpush
