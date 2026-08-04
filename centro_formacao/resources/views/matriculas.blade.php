@extends('layout.admin')

@section('title', 'Inscrições e Matrículas')
@section('active', 'matriculas')
@section('page-title', 'Inscrições e Matrículas')
@section('page-subtitle', 'Acompanhamento das inscrições e respetiva documentação')

@section('content')
  @if (session('success'))
    <div class="panel" role="status" style="margin-bottom:16px;color:var(--green)">
      {{ session('success') }}
    </div>
  @endif
  <div class="grid-2">
    <div class="panel">
        <div class="panel-title">Inscrições recebidas</div>
        <div class="kpi-value mono-num" style="margin-top:18px">{{ count($matriculas) }}</div>
        <div class="panel-sub">No mês atual, em todos os centros</div>
    </div>
    <div class="panel">
        <div class="panel-title">Taxa de confirmação</div>
        <div class="kpi-value mono-num" style="margin-top:18px;color:var(--green)">{{ $paymentConfirmationRate }}%</div>
        <div class="panel-sub">Matrículas com processo concluído</div>
    </div>
</div>
  <div class="panel">
    <div class="panel-head">
        <div>
            <div class="panel-title">Inscrições recentes</div>
            <div class="panel-sub">Pedidos submetidos nos últimos dias</div>
        </div>
        <button class="btn-primary" id="openModal" type="button">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4"><path d="M12 5v14M5 12h14"/></svg>
          <span>Nova Inscrição</span>
        </button>
      </div>
        <div class="table-wrap">
            <table><thead><tr><th>Formando</th><th>Curso</th><th>Data</th><th>Estado</th><th>Ações</th></tr></thead><tbody>
                @foreach($matriculas as $matricula)
                <tr>
                    <td class="cell-main">{{ $matricula->name }}</td>
                    <td>{{ $matricula->course }}</td>
                    <td class="mono-num">{{ optional($matricula->enrollment_date)->format('d M Y') }}</td>
                    <td><span class="pill {{ $matricula->payment_status === 'Confirmado' ? 'concluida' : ($matricula->payment_status === 'Pendente' ? 'emcurso' : 'atencao') }}">{{ $matricula->payment_status }}</span></td>
                    <td>
                      <button class="btn-secondary btn-detalhes" type="button"
                        data-id="{{ $matricula->id }}"
                        data-nome="{{ $matricula->name }}"
                        data-email="{{ $matricula->email }}"
                        data-phone="{{ $matricula->phone }}"
                        data-bi="{{ $matricula->bilhete_identidade }}"
                        data-curso="{{ $matricula->course }}"
                        data-estado="{{ $matricula->payment_status }}"
                        style="padding:6px 10px">Detalhes</button>
                    </td>
                </tr>
                @endforeach
            </tbody></table>
        </div>
</div>

{{-- ==================== MODAL: DETALHES / ALTERAR ESTADO ==================== --}}
<div class="overlay" id="detailsModal">
  <div class="modal">
    <div class="modal-head">
      <h3>Detalhes da Inscrição</h3>
      <button class="modal-close" id="closeDetailsModal" type="button">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 6L6 18M6 6l12 12"/></svg>
      </button>
    </div>
    <form id="detailsForm" method="POST" action="">
      @csrf
      @method('PUT')
      <div class="field">
        <label>Nome do formando</label>
        <input type="text" id="detail_nome" name="name" readonly style="background:var(--bg);opacity:0.85;">
      </div>
      <div class="field">
        <label>Email</label>
        <input type="email" id="detail_email" name="email" readonly style="background:var(--bg);opacity:0.85;">
      </div>
      <div class="field">
        <label>Bilhete de Identidade</label>
        <input type="text" id="detail_bi" name="bilhete_identidade" readonly style="background:var(--bg);opacity:0.85;">
      </div>
      <div class="field">
        <label>Telefone</label>
        <input type="text" id="detail_phone" name="phone" readonly style="background:var(--bg);opacity:0.85;">
      </div>
      <div class="field">
        <label>Curso</label>
        <input type="text" id="detail_curso" name="course" readonly style="background:var(--bg);opacity:0.85;">
      </div>
      <div class="field">
        <label for="detail_estado">Estado do pagamento</label>
        <select id="detail_estado" name="payment_status" required>
          <option value="Confirmado">Confirmado</option>
          <option value="Pendente">Pendente</option>
          <option value="Rejeitado">Rejeitado</option>
        </select>
      </div>
      <div class="modal-actions" style="display:flex; justify-content:space-between; align-items:center; gap:8px;">
        <button type="submit" form="deleteForm" class="btn-danger" onclick="return confirm('Tem a certeza que pretende eliminar esta inscrição?');">Eliminar</button>
        <div style="display:flex; gap:8px; flex:1; justify-content:flex-end;">
          <input class="btn-secondary" id="cancelDetailsModal" type="button" value="Cancelar" style="flex:initial; padding:10px 16px;">
          <input class="btn-primary" style="justify-content:center; flex:initial; padding:10px 16px;" type="submit" value="Guardar Alterações">
        </div>
      </div>
    </form>
    <form id="deleteForm" method="POST" action="" style="display:none;">
      @csrf
      @method('DELETE')
    </form>
  </div>
</div>
@endsection
