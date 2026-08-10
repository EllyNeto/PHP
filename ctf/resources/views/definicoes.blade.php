@extends('layout.admin')

@section('title', 'Definições')
@section('active', 'definicoes')
@section('page-title', 'Configurações do Sistema')
@section('page-subtitle', 'Gestão de utilizadores, backups e parâmetros da instituição')

@section('content')
  <div class="grid-2">
    <div class="panel">
      <div class="panel-head">
        <div>
          <div class="panel-title">Dados Institucionais</div>
          <div class="panel-sub">Informações visíveis nos comprovativos e certificados</div>
        </div>
      </div>
      <div class="panel-body">
        <form action="#" method="POST" onsubmit="event.preventDefault(); alert('Configurações atualizadas!');">
          <div class="field" style="margin-bottom: 1rem;">
            <label>Nome do Centro de Formação</label>
            <input type="text" value="Centro de Formação Tecnológica (CINFOTEC)" required>
          </div>
          <div class="field" style="margin-bottom: 1rem;">
            <label>Entidade / Ministério Responsável</label>
            <input type="text" value="MAPTSS - Ministério do Trabalho, Emprego e Segurança Social" required>
          </div>
          <div class="field" style="margin-bottom: 1rem;">
            <label>Localização / Endereço</label>
            <input type="text" value="Talatona, Luanda-Sul, Angola" required>
          </div>
          <button class="btn-primary" type="submit" style="align-self: flex-start;">Salvar Alterações</button>
        </form>
      </div>
    </div>

    <div class="panel">
      <div class="panel-head">
        <div>
          <div class="panel-title">Manutenção &amp; Cópia de Segurança</div>
          <div class="panel-sub">Estado da base de dados e backups automatizados</div>
        </div>
      </div>
      <div class="panel-body" style="display:flex; flex-direction:column; gap: 1rem;">
        <div>
          <label style="font-size: 0.78rem; color: var(--text-dim);">Último Backup Realizado</label>
          <div class="mono-num" style="font-size: 1.1rem; font-weight: 600; color: var(--teal); margin-top: 0.25rem;">10/08/2026 às 04:00</div>
        </div>
        <p style="font-size: 0.85rem; color: var(--text-dim); line-height: 1.4;">
          As cópias de segurança da base de dados e ficheiros anexos são geradas automaticamente todos os dias às 04h.
        </p>
        <div style="display:flex; gap: 0.75rem;">
          <button class="btn-primary" type="button" onclick="alert('Backup iniciado com sucesso!');">Executar Backup Agora</button>
          <button class="btn-secondary" type="button">Histórico de Backups</button>
        </div>
      </div>
    </div>
  </div>
@endsection
