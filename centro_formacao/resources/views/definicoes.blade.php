@extends('layout.admin')

@section('title', 'Definições')
@section('active', 'definicoes')
@section('page-title', 'Definições')
@section('page-subtitle', 'Configuração geral do painel e dados institucionais')

@section('content')
  <div class="grid-2" style="grid-template-columns:1fr 1fr"><div class="panel"><div class="panel-head"><div><div class="panel-title">Dados da instituição</div><div class="panel-sub">Informação exibida em documentos e certificados</div></div></div><div class="field"><label>Nome da instituição</label><input type="text" value="Centro de Formação Tecnológica"></div><div class="field"><label>E-mail institucional</label><input type="email" value="geral@cft.ao"></div><div class="field"><label>Telefone</label><input type="text" value="+244 900 000 000"></div><button class="btn-primary" type="button">Guardar alterações</button></div><div class="panel"><div class="panel-head"><div><div class="panel-title">Preferências do sistema</div><div class="panel-sub">Personaliza o funcionamento do painel</div></div></div><div class="centro-row"><div class="centro-top"><span class="centro-name">Notificações por e-mail</span><span class="pill emcurso">Ativas</span></div><div class="panel-sub">Receber alertas de matrículas e certificações.</div></div><div class="centro-row"><div class="centro-top"><span class="centro-name">Ano formativo</span><span class="mono-num">2026</span></div><div class="panel-sub">Período atualmente utilizado nos relatórios.</div></div><div class="centro-row"><div class="centro-top"><span class="centro-name">Idioma do painel</span><span>Português</span></div><div class="panel-sub">Formato de data e idioma da interface.</div></div></div></div>
@endsection
