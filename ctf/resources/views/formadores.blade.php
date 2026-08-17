@extends('layout.admin')

@section('title', 'Formadores')
@section('active', 'formadores')
@section('page-title', 'Corpo de Formadores')
@section('page-subtitle', 'Gestão de formadores e instrutores técnicos do centro')

@section('content')
  @if(session('success'))
    <div class="alert alert-success" style="padding: 0.75rem 1rem; background: rgba(34, 197, 94, 0.15); border: 1px solid rgba(34, 197, 94, 0.3); color: #4ade80; border-radius: 6px; margin-bottom: 1rem; font-size: 0.85rem;">
      {{ session('success') }}
    </div>
  @endif

  <div class="panel">
    <div class="panel-head">
      <div>
        <div class="panel-title">Lista de Formadores</div>
        <div class="panel-sub">Instrutores técnicos registados</div>
      </div>
      <button class="btn-primary" data-modal-target="modalNovoFormador">+ Novo Formador</button>
    </div>
    <div class="panel-body">
      <div class="grid-3">
        @forelse($formadores ?? [] as $f)
          @php
            $words = explode(' ', trim($f->name ?? ''));
            $initials = '';
            if (count($words) >= 2) {
                $initials = mb_strtoupper(mb_substr($words[0], 0, 1) . mb_substr(end($words), 0, 1));
            } else {
                $initials = mb_strtoupper(mb_substr($f->name ?? 'F', 0, 2));
            }
            $turmasCount = $f->classes_count ?? ($f->classes ? $f->classes->count() : 0);
          @endphp
          <div class="panel" style="padding: 1.25rem; border: 1px solid var(--border); position: relative;">
            <div style="display:flex; align-items:center; justify-content:space-between; gap: 0.75rem;">
              <div style="display:flex; align-items:center; gap: 0.75rem;">
                <div class="avatar-mini" style="width: 42px; height: 42px; font-size: 1rem; background: var(--bg-hover); color: var(--primary); display:flex; align-items:center; justify-content:center; border-radius:50%; font-weight:700;">{{ $initials }}</div>
                <div>
                  <h4 style="font-size: 1rem; font-weight: 600; margin:0;">{{ $f->name }}</h4>
                  <p style="font-size: 0.78rem; color: var(--text-dim); margin:0;">{{ $f->email ?: ($f->bi ? 'BI: '.$f->bi : 'Instrutor Técnico') }}</p>
                </div>
              </div>
            </div>
            <div style="margin-top: 1rem; padding-top: 0.75rem; border-top: 1px solid var(--border-soft); display:flex; justify-content:space-between; align-items:center; font-size:0.78rem;">
              <span class="mono-num" style="color: var(--text-dim);">{{ $f->phone_number ?: ($f->bi ?: 'Sem contacto') }}</span>
              <span class="mono-num" style="color: var(--amber); font-weight:600;">{{ $turmasCount }} {{ $turmasCount == 1 ? 'Turma' : 'Turmas' }}</span>
            </div>
            <div style="margin-top: 0.75rem; display:flex; justify-content:flex-end; gap: 0.5rem;">
              <button class="btn-secondary btn-editar-formador" 
                      style="padding: 0.25rem 0.6rem; font-size: 0.75rem;"
                      data-modal-target="modalEditarFormador"
                      data-id="{{ $f->id }}"
                      data-name="{{ $f->name }}"
                      data-email="{{ $f->email }}"
                      data-bi="{{ $f->bi }}"
                      data-phone="{{ $f->phone_number }}">
                Editar
              </button>
              <button class="btn-secondary btn-eliminar-formador" 
                      style="padding: 0.25rem 0.6rem; font-size: 0.75rem; color: var(--danger); border-color: rgba(239, 68, 68, 0.3);"
                      data-modal-target="modalEliminarFormador"
                      data-id="{{ $f->id }}"
                      data-name="{{ $f->name }}">
                Eliminar
              </button>
            </div>
          </div>
        @empty
          <div style="grid-column: 1 / -1; text-align: center; padding: 2rem; color: var(--text-dim);">
            Nenhum formador registado.
          </div>
        @endforelse
      </div>
    </div>
  </div>

  <!-- Modal Criar Formador -->
  <div class="overlay" id="modalNovoFormador">
    <div class="modal">
      <div class="modal-head">
        <h3>Cadastrar Novo Formador</h3>
        <button class="modal-close" type="button">&times;</button>
      </div>
      <form action="{{ route('formadores.store') }}" method="POST">
        @csrf
        <div class="field">
          <label>Nome Completo *</label>
          <input type="text" name="name" placeholder="ex.: Carlos Muatxinene" required>
        </div>
        <div class="field">
          <label>E-mail</label>
          <input type="email" name="email" placeholder="ex.: carlos@ctf.ao">
        </div>
        <div class="field">
          <label>BI nº</label>
          <input type="text" name="bi" placeholder="ex.: 001234567LA042" maxlength="14">
        </div>
        <div class="field">
          <label>Telefone / WhatsApp</label>
          <input type="text" name="phone_number" placeholder="ex.: +244 923 000 111">
        </div>
        <div class="modal-actions">
          <button class="btn-secondary" type="button" data-modal-close>Cancelar</button>
          <button class="btn-primary" type="submit">Guardar Formador</button>
        </div>
      </form>
    </div>
  </div>

  <!-- Modal Editar Formador -->
  <div class="overlay" id="modalEditarFormador">
    <div class="modal">
      <div class="modal-head">
        <h3>Editar Formador</h3>
        <button class="modal-close" type="button">&times;</button>
      </div>
      <form id="formEditarFormador" action="" method="POST">
        @csrf
        @method('PUT')
        <div class="field">
          <label>Nome Completo *</label>
          <input type="text" id="editFormadorName" name="name" required>
        </div>
        <div class="field">
          <label>E-mail</label>
          <input type="email" id="editFormadorEmail" name="email">
        </div>
        <div class="field">
          <label>BI nº</label>
          <input type="text" id="editFormadorBi" name="bi" maxlength="14">
        </div>
        <div class="field">
          <label>Telefone / WhatsApp</label>
          <input type="text" id="editFormadorPhone" name="phone_number">
        </div>
        <div class="modal-actions">
          <button class="btn-secondary" type="button" data-modal-close>Cancelar</button>
          <button class="btn-primary" type="submit">Atualizar Formador</button>
        </div>
      </form>
    </div>
  </div>

  <!-- Modal Eliminar Formador -->
  <div class="overlay" id="modalEliminarFormador">
    <div class="modal">
      <div class="modal-head">
        <h3>Eliminar Formador</h3>
        <button class="modal-close" type="button">&times;</button>
      </div>
      <form id="formEliminarFormador" action="" method="POST">
        @csrf
        @method('DELETE')
        <div style="margin-bottom: 1.5rem; font-size: 0.9rem; color: var(--text-muted);">
          Tem certeza de que deseja eliminar o formador <strong id="eliminarFormadorName" style="color: var(--text-heading);"></strong>?
        </div>
        <div class="modal-actions">
          <button class="btn-secondary" type="button" data-modal-close>Cancelar</button>
          <button class="btn-primary" type="submit" style="background: var(--danger); border-color: var(--danger);">Eliminar</button>
        </div>
      </form>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', () => {
      document.querySelectorAll('.btn-editar-formador').forEach(btn => {
        btn.addEventListener('click', () => {
          const id = btn.dataset.id;
          const name = btn.dataset.name;
          const email = btn.dataset.email;
          const bi = btn.dataset.bi;
          const phone = btn.dataset.phone;

          const form = document.getElementById('formEditarFormador');
          if (form) form.action = '/formadores/' + id;

          document.getElementById('editFormadorName').value = name || '';
          document.getElementById('editFormadorEmail').value = email || '';
          document.getElementById('editFormadorBi').value = bi || '';
          document.getElementById('editFormadorPhone').value = phone || '';
        });
      });

      document.querySelectorAll('.btn-eliminar-formador').forEach(btn => {
        btn.addEventListener('click', () => {
          const id = btn.dataset.id;
          const name = btn.dataset.name;

          const form = document.getElementById('formEliminarFormador');
          if (form) form.action = '/formadores/' + id;

          document.getElementById('eliminarFormadorName').textContent = name || '';
        });
      });
    });
  </script>
@endsection
