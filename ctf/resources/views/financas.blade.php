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
    letter-spacing: 0.08em;
    color: var(--text-dim);
    padding: 1rem 1.25rem;
    background: var(--panel-2);
  }

  .financas-table td {
    padding: 1.1rem 1.25rem;
    vertical-align: middle;
  }

  .aluno-nome {
    font-weight: 700;
    color: var(--text);
    font-size: 0.92rem;
    line-height: 1.25;
  }

  .curso-nome {
    color: var(--text-dim);
    font-size: 0.88rem;
    line-height: 1.3;
  }

  .valor-quant {
    font-family: 'Space Grotesk', sans-serif;
    font-weight: 700;
    font-size: 0.95rem;
    color: var(--text);
  }

  /* Botão de confirmação no modal adaptado a modo white */
  .btn-confirmar-pagamento {
    background: var(--amber);
    color: #0F151B;
    font-family: 'Inter', sans-serif;
    font-weight: 700;
    padding: 0.7rem 1.4rem;
    border-radius: 10px;
    border: none;
    font-size: 0.9rem;
    cursor: pointer;
    transition: all 0.2s ease;
  }

  .btn-confirmar-pagamento:hover {
    transform: translateY(-1px);
    filter: brightness(1.08);
  }

  html.dark .btn-confirmar-pagamento, body.dark .btn-confirmar-pagamento {
    background: #0F1B2D;
    color: #FFFFFF;
  }

  /* Responsividade */
  @media (max-width: 900px) {
    .financas-kpi-grid {
      grid-template-columns: 1fr;
    }
    .financas-banner {
      flex-direction: column;
      align-items: flex-start;
      gap: 1rem;
    }
    .btn-banner-registar {
      width: 100%;
      justify-content: center;
    }
  }
</style>
@endpush

@section('content')
  <!-- Notificação Toast -->
  <div id="toastFinancas" style="display: none; position: fixed; top: 1.5rem; right: 1.5rem; z-index: 1100; background: var(--panel); border: 1px solid var(--green); border-left: 4px solid var(--green); padding: 0.85rem 1.2rem; border-radius: 8px; box-shadow: 0 10px 25px rgba(0,0,0,0.2); font-size: 0.85rem; color: var(--text); align-items: center; gap: 0.6rem;">
    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--green)" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
    <span id="toastFinancasMsg">Pagamento registado com sucesso!</span>
  </div>

  <!-- 1. Banner Principal Tesouraria -->
  <div class="financas-banner">
    <div class="financas-banner-left">
      <div class="financas-banner-tag">
        <span class="financas-banner-dots">
          <span class="financas-banner-dot"></span>
          <span class="financas-banner-dot"></span>
        </span>
        TESOURARIA
      </div>
      <h2 class="financas-banner-title">Finanças &amp; Pagamentos</h2>
    </div>
    <button class="btn-banner-registar" data-modal-target="modalRegistarPagamento">
      + Registar pagamento
    </button>
  </div>

  <!-- 2. Grelha de 3 KPIs (Valores do Banco de Dados) -->
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
            </tr>
          @empty
            <tr>
              <td colspan="6" style="text-align: center; padding: 2rem; color: var(--text-dim);">
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
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
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
});
</script>
@endpush
