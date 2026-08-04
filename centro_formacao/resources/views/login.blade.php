 <!DOCTYPE html>
<html lang="pt-AO">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FORMA.ADMIN — Entrar</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,500;9..144,600;9..144,700&family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">

  <!-- Ficheiro CSS Externo -->
  <link rel="stylesheet" href="{{ asset('css/style_login.css') }}">
</head>
<body>

<div class="shell">
  <!-- ===== LEFT: brand storytelling pane ===== -->
  <aside class="brand-pane">
    <div class="brand">
      <div class="brand-mark">
        <svg viewBox="0 0 24 24" fill="none" stroke="#241c09" stroke-width="2"><path d="M12 3 2 8l10 5 10-5-10-5Z"/><path d="M6 10.5V16c0 1.5 2.7 3 6 3s6-1.5 6-3v-5.5"/></svg>
      </div>
      <div>
        <div class="brand-name">FORMA.ADMIN</div>
        <div class="brand-sub">Centro de Formação</div>
      </div>
    </div>

    <div class="hero">
      <span class="eyebrow">Painel administrativo</span>
      <h1>Cada matrícula, turma<br>e certificado, <em>num só lugar.</em></h1>
      <p>Acede ao painel para acompanhar alunos, turmas, formadores e o financeiro do centro de formação em tempo real.</p>

      <div class="stat-row">
        <div class="item">
          <div class="num">486</div>
          <div class="lbl">Alunos ativos</div>
        </div>
        <div class="item">
          <div class="num">24</div>
          <div class="lbl">Turmas em curso</div>
        </div>
        <div class="item">
          <div class="num">83%</div>
          <div class="lbl">Ocupação</div>
        </div>
      </div>
    </div>

    <div class="quote">
      <p>“O painel poupa-nos horas todas as semanas — vemos matrículas, pagamentos e turmas sem abrir cinco ficheiros diferentes.”</p>
      <span>— Coordenação Pedagógica</span>
    </div>
  </aside>

  <!-- ===== RIGHT: login form ===== -->
  <main class="form-pane">
    <div class="form-card">

      <div class="mobile-brand">
        <div class="brand-mark">
          <svg viewBox="0 0 24 24" fill="none" stroke="#241c09" stroke-width="2"><path d="M12 3 2 8l10 5 10-5-10-5Z"/><path d="M6 10.5V16c0 1.5 2.7 3 6 3s6-1.5 6-3v-5.5"/></svg>
        </div>
        <div>
          <div class="brand-name">FORMA.ADMIN</div>
          <div class="brand-sub">Centro de Formação</div>
        </div>
      </div>

      <div class="form-head">
        <span class="eyebrow">Bem-vinda de volta</span>
        <h2>Entrar no painel</h2>
        <p>Introduz as tuas credenciais de administradora para continuar.</p>
      </div>

      <div class="error-box" id="errorBox">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 8v5M12 16h.01"/></svg>
        <span>Email ou palavra-passe incorretos. Tenta novamente.</span>
      </div>

      <form id="loginForm" action='/EventController' method="POST" class="form-fields">
        @csrf
        <div class="field">
          <label for="email">Email</label>
          <div class="input-wrap">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="m22 6-10 7L2 6"/></svg>
            <input type="email" name="email" placeholder="example@gmail.com" required>
          </div>
        </div>

        <div class="field">
          <label for="password">Palavra-passe</label>
          <div class="input-wrap">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="10" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
            <input type="password" name="password" placeholder="••••••••••" required>
            <button type="button" class="toggle-pw" id="togglePw" aria-label="Mostrar palavra-passe">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7-11-7-11-7Z"/><circle cx="12" cy="12" r="3"/></svg>
            </button>
          </div>
        </div>

        {{-- <div class="row-between">
          <label class="remember" id="rememberLabel">
            <span class="checkbox" id="checkbox">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path d="M20 6 9 17l-5-5"/></svg>
            </span>
            Lembrar-me
          </label>
          <span class="forgot">Esqueceste a palavra-passe?</span>
        </div> --}}
    <a href="/dashboard" class="btn-primary" style="text-decoration: none;">
     Entrar
     <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
       <path d="M5 12h14M13 6l6 6-6 6"/>
      </svg>
    </a>
        {{-- <button type="submit" formnovalidate class="btn-primary" value="login">
          Entrar
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
        </button>
      </form> --}}

      <div class="divider"><div class="line"></div><span>ou</span><div class="line"></div></div>

      <p class="footnote">Precisas de acesso? <a>Contacta a administração</a></p>
    </div>
  </main>
</div>

// <script>
//   // Mostrar/ocultar palavra-passe
//   const pwInput = document.getElementById('password');
//   const togglePw = document.getElementById('togglePw');
//   togglePw.addEventListener('click', () => {
//     const isHidden = pwInput.type === 'password';
//     pwInput.type = isHidden ? 'text' : 'password';
//     togglePw.innerHTML = isHidden
//       ? '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17.94 17.94A10.94 10.94 0 0 1 12 20c-7 0-11-8-11-8a19.7 19.7 0 0 1 5.06-5.94M9.9 4.24A10.4 10.4 0 0 1 12 4c7 0 11 8 11 8a19.86 19.86 0 0 1-2.16 3.19M14.12 14.12a3 3 0 1 1-4.24-4.24"/><path d="M1 1l22 22"/></svg>'
//       : '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7-11-7-11-7Z"/><circle cx="12" cy="12" r="3"/></svg>';
//   });

//   // Checkbox "Lembrar-me"
//   const checkbox = document.getElementById('checkbox');
//   const rememberLabel = document.getElementById('rememberLabel');
//   rememberLabel.addEventListener('click', (e) => {
//     e.preventDefault();
//     checkbox.classList.toggle('checked');
//   });

//   // Simulação de validação simples
//   const form = document.getElementById('loginForm');
//   const errorBox = document.getElementById('errorBox');
//   form.addEventListener('submit', (e) => {
//     e.preventDefault();
//     const email = document.getElementById('email').value.trim();
//     const password = pwInput.value.trim();
//     if(!email || !password){
//       errorBox.classList.add('show');
//       return;
//     }
//     errorBox.classList.remove('show');
//     alert('Autenticação simulada — liga isto ao teu backend.');
//   });
// </script>

</body>
</html>
