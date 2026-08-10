<!DOCTYPE html>
<html lang="pt-AO">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Painel Administrativo') — Centro de Formação Tecnológica</title>

  <!-- Google Fonts: Space Grotesk (Títulos), Inter (Corpo), IBM Plex Mono (Dados) -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700&family=Inter:wght@400;500;600&family=IBM+Plex+Mono:wght@400;500;600&display=swap" rel="stylesheet">
  
  <!-- Dependências Externas -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.4/chart.umd.min.js"></script>
  <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
  @stack('styles')
</head>
<body>
<div class="app">
  <div class="sidebar-overlay" id="sidebarOverlay"></div>

  <!-- 1. SIDEBAR (Navegação com deteção de item ativo) -->
  @include('components.sidebar')

  <!-- 2. MAIN CONTENT (Topbar + Área Central) -->
  <main>
    @include('components.topbar')

    <!-- Ponto de Injeção das Views -->
    <div class="content-area">
      @yield('content')
    </div>
  </main>
</div>

<script src="{{ asset('js/dashboard.js') }}"></script>
@stack('scripts')
</body>
</html>
