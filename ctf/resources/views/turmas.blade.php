@extends('layout.admin')

@section('title', 'Turmas')
@section('active', 'turmas')
@section('page-title', 'Organização de Turmas')
@section('page-subtitle', 'Gestão de horários, ocupação de laboratórios e formadores responsáveis')

@section('content')
  <div class="panel">
    <div class="panel-head">
      <div>
        <div class="panel-title">Turmas em Funcionamento</div>
        <div class="panel-sub">Lista completa de turmas e horários de aulas</div>
      </div>
      <button class="btn-primary" data-modal-target="modalNovaTurma">+ Nova Turma</button>
    </div>
    <div class="table-wrap">
      <table>
        <thead>
          <tr>
            <th>Código Turma</th>
            <th>Curso Associado</th>
            <th>Docente / Formador</th>
            <th>Horário</th>
            <th>Vagas / Ocupação</th>
            <th>Estado</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="mono-num">T-TIC204-A</td>
            <td class="cell-main">Redes e Infraestruturas de TI</td>
            <td>João Baptista</td>
            <td class="cell-sub">Seg/Qua/Sex · 08h–12h</td>
            <td>
              <div style="display:flex; align-items:center; gap: 0.5rem;">
                <div style="width: 80px; height: 6px; background: var(--panel-2); border-radius: 999px; overflow:hidden;">
                  <div style="width: 96%; height:100%; background: var(--amber);"></div>
                </div>
                <span class="mono-num" style="font-size: 0.75rem;">24/25</span>
              </div>
            </td>
            <td><span class="pill emcurso">Em Curso</span></td>
          </tr>
          <tr>
            <td class="mono-num">T-ELM118-B</td>
            <td class="cell-main">Electricidade Industrial</td>
            <td>Manuel Sacaia</td>
            <td class="cell-sub">Ter/Qui · 14h–18h</td>
            <td>
              <div style="display:flex; align-items:center; gap: 0.5rem;">
                <div style="width: 80px; height: 6px; background: var(--panel-2); border-radius: 999px; overflow:hidden;">
                  <div style="width: 90%; height:100%; background: var(--amber);"></div>
                </div>
                <span class="mono-num" style="font-size: 0.75rem;">18/20</span>
              </div>
            </td>
            <td><span class="pill emcurso">Em Curso</span></td>
          </tr>
          <tr>
            <td class="mono-num">T-MPR072-A</td>
            <td class="cell-main">Soldagem e Caldeiraria</td>
            <td>Isabel Chindenga</td>
            <td class="cell-sub">Seg–Sex · 07h–11h</td>
            <td>
              <div style="display:flex; align-items:center; gap: 0.5rem;">
                <div style="width: 80px; height: 6px; background: var(--panel-2); border-radius: 999px; overflow:hidden;">
                  <div style="width: 83%; height:100%; background: var(--teal);"></div>
                </div>
                <span class="mono-num" style="font-size: 0.75rem;">15/18</span>
              </div>
            </td>
            <td><span class="pill ainiciar">A Iniciar</span></td>
          </tr>
          <tr>
            <td class="mono-num">T-ENR055-A</td>
            <td class="cell-main">Sistemas Fotovoltaicos</td>
            <td>Carlos Muatxinene</td>
            <td class="cell-sub">Sáb · 08h–17h</td>
            <td>
              <div style="display:flex; align-items:center; gap: 0.5rem;">
                <div style="width: 80px; height: 6px; background: var(--panel-2); border-radius: 999px; overflow:hidden;">
                  <div style="width: 90%; height:100%; background: var(--amber);"></div>
                </div>
                <span class="mono-num" style="font-size: 0.75rem;">20/22</span>
              </div>
            </td>
            <td><span class="pill emcurso">Em Curso</span></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

  <!-- Modal Criar Turma -->
  <div class="overlay" id="modalNovaTurma">
    <div class="modal">
      <div class="modal-head">
        <h3>Criar Nova Turma</h3>
        <button class="modal-close" type="button">&times;</button>
      </div>
      <form action="#" method="POST" onsubmit="event.preventDefault(); this.closest('.overlay').classList.remove('show');">
        <div class="field">
          <label>Curso Associado</label>
          <select required>
            <option>Redes e Infraestruturas de TI</option>
            <option>Electricidade Industrial</option>
            <option>Soldagem e Caldeiraria</option>
            <option>Sistemas Fotovoltaicos</option>
          </select>
        </div>
        <div class="field">
          <label>Docente / Formador Responsável</label>
          <input type="text" placeholder="ex.: Prof. João Baptista" required>
        </div>
        <div class="field">
          <label>Horário das Aulas</label>
          <input type="text" placeholder="ex.: Seg/Qua/Sex · 08h–12h" required>
        </div>
        <div class="field">
          <label>Vagas Máximas</label>
          <input type="number" placeholder="25" required>
        </div>
        <div class="modal-actions">
          <button class="btn-secondary" type="button" data-modal-close>Cancelar</button>
          <button class="btn-primary" type="submit">Criar Turma</button>
        </div>
      </form>
    </div>
  </div>
@endsection
