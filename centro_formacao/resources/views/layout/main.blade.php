<!DOCTYPE html>
<html lang="pt-AO">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'FORMA.ADMIN — Sistema de Gestão')</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,500;9..144,600;9..144,700&family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

<div class="overlay" id="overlay"></div>

<div class="shell">
  <!-- 1. IMPORTAÇÃO DA SIDEBAR (Ficheiro isolado) -->
  @include('components.sidebar')

  <!-- 2. IMPORTAÇÃO DA TOPBAR (Ficheiro isolado) -->
    @include('components.topbar')

    <!-- ÁREA ONDE ENTRA O CONTEÚDO DE CADA PÁGINA -->
    <main class="content">
      @yield('content')
    </main>
  </div>
</div>

<script src="{{ asset('js/dashboard.js') }}"></script>
</body>
</html>
