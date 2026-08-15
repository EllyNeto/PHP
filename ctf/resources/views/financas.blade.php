@extends('layout.admin')

@section('title', 'Finanças')
@section('active', 'financas')
@section('page-title', 'Finanças')
@section('page-subtitle', 'Propinas e pagamentos')

@push('styles')
<style>
  /* Banner Tesouraria adaptável para Modo Claro (White) e Escuro */
  .financas-banner {
    background: var(--panel);
    border: 1px solid var(--border);
    background-image: repeating-linear-gradient(
      -45deg,
      rgba(0, 0, 0, 0.02),
      rgba(0, 0, 0, 0.02) 12px,
      transparent 12px,
      transparent 24px
    );
    border-radius: 14px;
    padding: 1.5rem 1.8rem;
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 1.5rem;
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.04);
    transition: all 0.25s ease;
  }

  html.dark .financas-banner, body.dark .financas-banner {
    background: #0F1B2D;
    border-color: transparent;
    background-image: repeating-linear-gradient(
      -45deg,
      rgba(255, 255, 255, 0.035),
      rgba(255, 255, 255, 0.035) 12px,
      transparent 12px,
      transparent 24px
    );
    box-shadow: 0 8px 24px rgba(15, 27, 45, 0.18);
  }

  .financas-banner-left {
    display: flex;
    flex-direction: column;
    gap: 0.3rem;
  }

  .financas-banner-tag {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.72rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.09em;
    color: var(--amber);
  }

  .financas-banner-dots {
    display: inline-flex;
    align-items: center;
    gap: 4px;
  }

  .financas-banner-dot {
    width: 6px;
    height: 6px;
    border-radius: 50%;
    background: var(--amber);
  }

  .financas-banner-title {
    font-family: 'Space Grotesk', sans-serif;
    font-size: 1.35rem;
    font-weight: 700;
    color: var(--text);
    letter-spacing: -0.01em;
  }

  html.dark .financas-banner-title, body.dark .financas-banner-title {
    color: #FFFFFF;
  }

  .btn-banner-registar {
    background: var(--amber);
    color: #0F151B;
    border: none;
    padding: 0.65rem 1.35rem;
    border-radius: 9px;
    font-family: 'Inter', sans-serif;
    font-weight: 700;
    font-size: 0.88rem;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 0.45rem;
    transition: all 0.2s ease;
    box-shadow: 0 4px 14px rgba(217, 119, 6, 0.22);
  }

  .btn-banner-registar:hover {
    transform: translateY(-1px);
    filter: brightness(1.08);
  }

  /* Grelha de 3 KPIs */
  .financas-kpi-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 1.25rem;
    margin-bottom: 1.5rem;
  }

  .financas-kpi-card {
    background: var(--panel);
    border: 1px solid var(--border);
    border-radius: 14px;
    padding: 1.35rem 1.5rem;
    display: flex;
    flex-direction: column;
    gap: 0.6rem;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.02);
  }

  .financas-kpi-label {
    font-size: 0.72rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.07em;
    color: var(--text-dim);
  }

  .financas-kpi-val {
    font-family: 'Space Grotesk', sans-serif;
    font-size: 1.75rem;
    font-weight: 700;
    line-height: 1.1;
  }

  .financas-kpi-val.green { color: var(--green); }
  .financas-kpi-val.red { color: var(--red); }
  .financas-kpi-val.dark { color: var(--text); }

  /* Tabela de Pagamentos */
  .financas-table th {
    font-size: 0.72rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.06em;
    color: var(--text-dim);
    border-bottom: 1px solid var(--border);
    padding: 0.9rem 1.1rem;
  }

  .financas-table td {
    padding: 1.1rem 1.1rem;
    border-bottom: 1px solid var(--border);
    vertical-align: middle;
  }

  .aluno-nome {
    font-family: 'Space Grotesk', sans-serif;
    font-weight: 700;
    font-size: 0.95rem;
    color: var(--text);
    line-height: 1.3;
  }

  .curso-nome {
    font-size: 0.85rem;
    color: var(--text-dim);
    line-height: 1.35;
  }

  .valor-quant {
    font-family: 'Space Grotesk', monospace;
    font-weight: 700;
    font-size: 0.92rem;
    color: var(--text);
    line-height: 1.25;
  }

  .metodo-cell {
    font-size: 0.85rem;
    color: var(--text);
    font-weight: 500;
  }

  .data-cell {
    font-size: 0.83rem;
    color: var(--text-dim);
  }

  /* Status Pills */
  .pill.pago {
    background: rgba(16, 185, 129, 0.12);
    color: var(--green);
    border: 1px solid rgba(16, 185, 129, 0.3);
  }

  .pill.em-atraso {
    background: rgba(239, 68, 68, 0.12);
    color: var(--red);
    border: 1px solid rgba(239, 68, 68, 0.3);
  }

  .btn-confirmar-pagamento {
    background: #0F151B;
    color: #FFFFFF;
    border: none;
    padding: 0.65rem 1.35rem;
    border-radius: 9px;
    font-family: 'Inter', sans-serif;
    font-weight: 700;
    font-size: 0.88rem;
    cursor: pointer;
    transition: all 0.2s ease;
  }

  html.dark .btn-confirmar-pagamento, body.dark .btn-confirmar-pagamento {
    background: var(--amber);
    color: #0F151B;
  }
</style>
@endpush

@section('content')
  <!-- Toast Notificação -->
  <div id="toastFinancas" style="display: none; position: fixed; top: 1.5rem; right: 1.5rem; z-index: 1100; background: var(--panel); border: 1px solid var(--green); border-left: 4px solid var(--green); padding: 0.85rem 1.2rem; border-radius: 8px; box-shadow: 0 10px 25px rgba(0,0,0,0.2); font-size: 0.85rem; color: var(--text); align-items: center; gap: 0.6rem;">
    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--green)" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
    <span id="toastFinancasMsg">Operação realizada com sucesso!</span>
  </div>
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

  <!-- 1. Banner Tesouraria -->
  <div class="financas-banner">
    <div class="financas-banner-left">
      <div class="financas-banner-tag">
        <span class="financas-banner-dots">
          <span class="financas-banner-dot"></span>
          <span class="financas-banner-dot" style="opacity: 0.5;"></span>
        </span>
        TESOURARIA CINFOTEC
      </div>
      <div class="financas-banner-title">Gestão de Mensalidades &amp; Emissão de Recibos</div>
    </div>
    <button class="btn-banner-registar" data-modal-target="modalRegistarPagamento">
      <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
      Registar pagamento
    </button>
  </div>

  <!-- 2. Grelha de 3 KPIs -->
  <div class="financas-kpi-grid">
    <div class="financas-kpi-card">
      <div class="financas-kpi-label">RECEBIDO ESTE MÊS</div>
      <div class="financas-kpi-val green" id="kpiRecebido">Kz {{ number_format($kpiRecebido ?? 0, 0, ',', '.') }}</div>
    </div>

    <div class="financas-kpi-card">
      <div class="financas-kpi-label">EM ATRASO</div>
      <div class="financas-kpi-val red" id="kpiAtraso">Kz {{ number_format($kpiAtraso ?? 0, 0, ',', '.') }}</div>
    </div>

    <div class="financas-kpi-card">
      <div class="financas-kpi-label">PROPINAS POR COBRAR</div>
      <div class="financas-kpi-val dark" id="kpiPropinas">Kz {{ number_format($kpiPropinas ?? 0, 0, ',', '.') }}</div>
    </div>
  </div>

  <!-- 3. Tabela Principal de Pagamentos Dinâmica -->
  <div class="panel">
    <div class="table-wrap">
      <table class="financas-table" id="tabelaPagamentos">
        <thead>
          <tr>
            <th>ALUNO</th>
            <th>CURSO</th>
            <th>VALOR</th>
            <th>MÉTODO</th>
            <th>DATA</th>
            <th>ESTADO</th>
            <th>ACÇÃO</th>
          </tr>
        </thead>
        <tbody>
          @forelse($pagamentos as $pagamento)
            @php
              $nameParts = array_filter(explode(' ', trim($pagamento->student_name)));
              $nameFormatted = implode('<br>', array_slice($nameParts, 0, 2));
              $courseFormatted = str_replace(' e ', ' e<br>', e($pagamento->course));
              $dateFormatted = $pagamento->payment_date 
                ? \Carbon\Carbon::parse($pagamento->payment_date)->format('d/m/Y') 
                : ($pagamento->created_at ? $pagamento->created_at->format('d/m/Y') : date('d/m/Y'));
              $pagCode = 'PAG-' . str_pad($pagamento->id, 3, '0', STR_PAD_LEFT);
            @endphp
            <tr data-pagamento-id="{{ $pagamento->id }}">
              <td>
                <div class="aluno-nome">{!! $nameFormatted !!}</div>
              </td>
              <td class="curso-nome">{!! $courseFormatted !!}</td>
              <td class="valor-quant">Kz<br>{{ number_format($pagamento->amount, 0, ',', '.') }}</td>
              <td class="metodo-cell">{{ $pagamento->method }}</td>
              <td class="mono-num data-cell">{{ $dateFormatted }}</td>
              <td class="estado-cell">
                @if(in_array(strtolower($pagamento->status), ['pago', '1', 'confirmado']))
                  <span class="pill pago">Pago</span>
                @elseif(in_array(strtolower($pagamento->status), ['em_atraso', 'em-atraso', 'em atraso']))
                  <span class="pill em-atraso">Em atraso</span>
                @else
                  <span class="pill pendente">Pendente</span>
                @endif
              </td>
              <td>
                <button class="btn-primary btn-detalhes-pagamento" 
                        style="padding:0.35rem 0.75rem; font-size:0.78rem;" 
                        data-modal-target="modalDetalhesPagamento"
                        data-id="{{ $pagamento->id }}"
                        data-code="{{ $pagCode }}"
                        data-student-name="{{ $pagamento->student_name }}"
                        data-course="{{ $pagamento->course }}"
                        data-amount="{{ $pagamento->amount }}"
                        data-method="{{ $pagamento->method }}"
                        data-status="{{ $pagamento->status }}">
                  Detalhes
                </button>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="7" style="text-align: center; padding: 2rem; color: var(--text-dim);">
                Nenhum registo financeiro encontrado.
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

  <!-- 4. Modal "Registar pagamento" -->
  <div class="overlay" id="modalRegistarPagamento">
    <div class="modal" style="max-width: 480px; border-radius: 16px; padding: 0.2rem;">
      <div class="modal-head" style="border-bottom: none; padding: 1.5rem 1.5rem 0.5rem 1.5rem;">
        <h3 style="font-size: 1.25rem; font-weight: 700; color: var(--text);">Registar pagamento</h3>
        <button class="modal-close" type="button">&times;</button>
      </div>

      <form id="formRegistarPagamento" action="{{ route('financas.store') }}" method="POST" style="padding: 1rem 1.5rem 1.5rem 1.5rem; gap: 1.1rem;">
        @csrf
        <div class="field">
          <label style="font-size: 0.83rem; font-weight: 600; color: var(--text-dim); margin-bottom: 0.2rem;">Aluno</label>
          <select id="pagamentoAluno" name="student_info" required style="padding: 0.65rem 0.85rem; border-radius: 10px; background: var(--bg); color: var(--text); border: 1px solid var(--border); font-size: 0.9rem;">
            @if(isset($alunos) && count($alunos) > 0)
              @foreach($alunos as $aluno)
                <option value="{{ $aluno->id }}|{{ $aluno->name }}|{{ $aluno->course }}">{{ $aluno->name }} — {{ $aluno->course }}</option>
              @endforeach
            @else
              <option value="" disabled selected>Nenhum aluno encontrado nas inscrições</option>
            @endif
          </select>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.85rem;">
          <div class="field">
            <label style="font-size: 0.83rem; font-weight: 600; color: var(--text-dim); margin-bottom: 0.2rem;">Valor (Kz)</label>
            <input type="number" id="pagamentoValor" name="amount" placeholder="35000" required style="padding: 0.65rem 0.85rem; border-radius: 10px; background: var(--bg); color: var(--text); border: 1px solid var(--border); font-size: 0.9rem;">
          </div>

          <div class="field">
            <label style="font-size: 0.83rem; font-weight: 600; color: var(--text-dim); margin-bottom: 0.2rem;">Método</label>
            <select id="pagamentoMetodo" name="method" required style="padding: 0.65rem 0.85rem; border-radius: 10px; background: var(--bg); color: var(--text); border: 1px solid var(--border); font-size: 0.9rem;">
              <option value="Transferência">Transferência</option>
              <option value="Multicaixa">Multicaixa</option>
              <option value="Numerário">Numerário</option>
              <option value="Depósito Bancário">Depósito Bancário</option>
            </select>
          </div>
        </div>

        <div class="modal-actions" style="margin-top: 1rem; display: flex; align-items: center; justify-content: flex-end; gap: 0.85rem;">
          <button class="btn-secondary" type="button" data-modal-close style="border: none; background: transparent; font-weight: 600; color: var(--text-dim); padding: 0.6rem 1rem;">
            Cancelar
          </button>
          <button class="btn-confirmar-pagamento" type="submit">
            Confirmar pagamento
          </button>
        </div>
      </form>
    </div>
  </div>

  <!-- 5. Modal Detalhes & Edição de Pagamento / Aluno -->
  <div class="overlay" id="modalDetalhesPagamento">
    <div class="modal" style="max-width: 580px;">
      <div class="modal-head">
        <div>
          <h3 id="detalhesPagamentoModalTitle">Detalhes do Registo Financeiro</h3>
          <p id="detalhesPagamentoModalSub" style="font-size:0.75rem; color:var(--text-dim); margin-top:2px;">Registo #PAG-000</p>
        </div>
        <button class="modal-close" type="button">&times;</button>
      </div>

      <form id="formEditarPagamento" action="" method="POST">
        @csrf
        @method('PUT')

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.85rem;">
          <div class="field" style="grid-column: span 2;">
            <label>ID do Pagamento (Inalterável)</label>
            <input type="text" id="detalhesPagamentoCode" readonly disabled style="opacity: 0.7; background: var(--panel-2); font-weight: bold; color: var(--amber);">
          </div>

          <div class="field" style="grid-column: span 2;">
            <label>Nome Completo do Aluno</label>
            <input type="text" id="detalhesStudentName" name="student_name" required>
          </div>

          <div class="field" style="grid-column: span 2;">
            <label>Curso</label>
            <input type="text" id="detalhesCourse" name="course" required>
          </div>

          <div class="field">
            <label>Valor (Kz)</label>
            <input type="number" id="detalhesAmount" name="amount" min="0" step="0.01" required>
          </div>

          <div class="field">
            <label>Método de Pagamento</label>
            <select id="detalhesMethod" name="method" required>
              <option value="Transferência">Transferência</option>
              <option value="Multicaixa">Multicaixa</option>
              <option value="Numerário">Numerário</option>
              <option value="Depósito Bancário">Depósito Bancário</option>
            </select>
          </div>

          <div class="field" style="grid-column: span 2;">
            <label>Estado do Pagamento</label>
            <select id="detalhesStatus" name="status" required>
              <option value="pago">Pago / Confirmado</option>
              <option value="pendente">Pendente</option>
              <option value="em_atraso">Em atraso</option>
            </select>
          </div>
        </div>

        <div class="modal-actions" style="margin-top: 1rem; display: flex; justify-content: space-between; align-items: center;">
          <button class="btn-secondary btn-eliminar-pagamento-modal" type="button" 
                  style="color: #ef4444; border-color: rgba(239,68,68,0.3); background: rgba(239,68,68,0.06);">
            Eliminar Registo
          </button>
          <div style="display: flex; gap: 0.5rem;">
            <button class="btn-secondary" type="button" data-modal-close>Cancelar</button>
            <button class="btn-primary" type="submit">Guardar Alterações</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <!-- 6. Modal Confirmar Eliminação do Pagamento -->
  <div class="overlay" id="modalEliminarPagamento">
    <div class="modal" style="max-width: 450px;">
      <div class="modal-head">
        <h3 style="color: #ef4444; display: flex; align-items: center; gap: 0.4rem;">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 0V4a2 2 0 012-2h4a2 2 0 012 2v2"/><line x1="10" y1="11" x2="10" y2="17"/><line x1="14" y1="11" x2="14" y2="17"/></svg>
          Eliminar Registo Financeiro
        </h3>
        <button class="modal-close" type="button">&times;</button>
      </div>
      <form id="formEliminarPagamento" action="" method="POST">
        @csrf
        @method('DELETE')
        <div style="padding: 1rem 0; color: var(--text); font-size: 0.88rem; line-height: 1.5;">
          Tem certeza de que deseja eliminar o registo financeiro do aluno <strong id="eliminarNomePagamento" style="color: var(--text-heading);"></strong>? Esta acção aplicará o Soft Delete no registo.
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
  let activePagamentoId = null;
  let activePagamentoNome = '';

  function showToast(message) {
    const toast = document.getElementById('toastFinancas');
    const toastMsg = document.getElementById('toastFinancasMsg');
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

  // Abrir Modal de Detalhes do Pagamento
  document.querySelectorAll('.btn-detalhes-pagamento').forEach(btn => {
    btn.addEventListener('click', function () {
      const id = this.getAttribute('data-id');
      const code = this.getAttribute('data-code');
      const studentName = this.getAttribute('data-student-name');
      const course = this.getAttribute('data-course');
      const amount = this.getAttribute('data-amount');
      const method = this.getAttribute('data-method');
      const status = this.getAttribute('data-status');

      activePagamentoId = id;
      activePagamentoNome = studentName;

      const formEditar = document.getElementById('formEditarPagamento');
      if (formEditar) formEditar.action = '/financas/' + id;

      document.getElementById('detalhesPagamentoModalTitle').textContent = `Detalhes de ${studentName}`;
      document.getElementById('detalhesPagamentoModalSub').textContent = `Registo #${code}`;

      document.getElementById('detalhesPagamentoCode').value = code || '';
      document.getElementById('detalhesStudentName').value = studentName || '';
      document.getElementById('detalhesCourse').value = course || '';
      document.getElementById('detalhesAmount').value = amount || '';
      document.getElementById('detalhesMethod').value = method || 'Transferência';
      document.getElementById('detalhesStatus').value = status || 'pago';
    });
  });

  // Botão Eliminar dentro do Modal de Detalhes
  const btnEliminarPagamentoModal = document.querySelector('.btn-eliminar-pagamento-modal');
  if (btnEliminarPagamentoModal) {
    btnEliminarPagamentoModal.addEventListener('click', function () {
      const modalDetalhes = document.getElementById('modalDetalhesPagamento');
      if (modalDetalhes) modalDetalhes.classList.remove('show');

      if (activePagamentoId) {
        const formEliminar = document.getElementById('formEliminarPagamento');
        if (formEliminar) formEliminar.action = '/financas/' + activePagamentoId;

        const nomeEl = document.getElementById('eliminarNomePagamento');
        if (nomeEl) nomeEl.textContent = activePagamentoNome;
      }

      const modalEliminar = document.getElementById('modalEliminarPagamento');
      if (modalEliminar) modalEliminar.classList.add('show');
    });
  }
});
</script>
@endpush
