// // document.addEventListener('DOMContentLoaded', () => {
// //   const sidebar = document.getElementById('sidebar');
// //   const hamburger = document.getElementById('hamburger');
// //   const overlay = document.getElementById('overlay');

// //   function toggleSidebar(open){
// //     if (sidebar && overlay) {
// //       sidebar.classList.toggle('open', open);
// //       overlay.classList.toggle('show', open);
// //     }
// //   }

// //   if (hamburger) {
// //     hamburger.addEventListener('click', () => toggleSidebar(true));
// //   }

// //   if (overlay) {
// //     overlay.addEventListener('click', () => toggleSidebar(false));
// //   }

// //   document.querySelectorAll('.nav-item').forEach(item => {
// //     item.addEventListener('click', () => {
// //       document.querySelectorAll('.nav-item').forEach(i => i.classList.remove('active'));
// //       item.classList.add('active');
// //       if(window.innerWidth <= 900) toggleSidebar(false);
// //     });
// //   });
// // });

// // document.addEventListener('DOMContentLoaded', () => {
// //   /* ==========================================================================
// //      Navegação Dinâmica e Troca de Ecrãs
// //      ========================================================================== */
// //   const navButtons = document.querySelectorAll('#nav .nav-item');
// //   const sectionVisao = document.getElementById('section-visao');
// //   const sectionOther = document.getElementById('section-other');

// //   const pageTitle = document.getElementById('pageTitle');
// //   const pageSub = document.getElementById('pageSub');
// //   const otherTitle = document.getElementById('otherTitle');

// //   // Mapeamento exato dos títulos e subtítulos por botão
// //   const sectionInfo = {
// //     visao: {
// //       title: 'Visão Geral',
// //       sub: 'Talatona · Rangel · Huambo · Cabinda — ano formativo 2026'
// //     },
// //     formandos: {
// //       title: 'Formandos',
// //       sub: 'Gestão de formandos activos e histórico'
// //     },
// //     formadores: {
// //       title: 'Cursos & Turmas',
// //       sub: 'Catálogo de cursos e turmas por centro'
// //     },
// //     matriculas: {
// //       title: 'Matrículas',
// //       sub: 'Inscrições e processos em análise'
// //     },
// //     certificacoes: {
// //       title: 'Certificações',
// //       sub: 'Emissão e validação de certificados'
// //     },
// //     relatorios: {
// //       title: 'Relatórios',
// //       sub: 'Indicadores de desempenho e exportações'
// //     },
// //     definicoes: {
// //       title: 'Definições',
// //       sub: 'Configuração da conta e do centro'
// //     }
// //   };

// //   navButtons.forEach(button => {
// //     button.addEventListener('click', () => {
// //       const targetSection = button.dataset.section;
// //       if (!targetSection) return;

// //       // 1. Atualizar o botão ativo na Sidebar
// //       navButtons.forEach(btn => btn.classList.remove('active'));
// //       button.classList.add('active');

// //       // 2. Atualizar os textos do cabeçalho
// //       const info = sectionInfo[targetSection];
// //       if (info) {
// //         if (pageTitle) pageTitle.textContent = info.title;
// //         if (pageSub) pageSub.textContent = info.sub;
// //         if (otherTitle) otherTitle.textContent = info.title;
// //       }

// //       // 3. Alternar a exibição do conteúdo da tela
// //       if (targetSection === 'visao') {
// //         if (sectionVisao) {
// //           sectionVisao.style.display = 'block';
// //           sectionVisao.classList.add('active');
// //         }
// //         if (sectionOther) {
// //           sectionOther.style.display = 'none';
// //           sectionOther.classList.remove('active');
// //         }
// //       } else {
// //         if (sectionVisao) {
// //           sectionVisao.style.display = 'none';
// //           sectionVisao.classList.remove('active');
// //         }
// //         if (sectionOther) {
// //           sectionOther.style.display = 'block';
// //           sectionOther.classList.add('active');
// //         }
// //       }
// //     });
// //   });
// // });
// document.addEventListener('DOMContentLoaded', () => {
//   /* ==========================================================================
//      1. Gestão da Sidebar e Mobile Menu
//      ========================================================================== */
//   const sidebar = document.getElementById('sidebar');
//   const hamburger = document.getElementById('hamburger');
//   const overlay = document.getElementById('overlay');

//   function toggleSidebar(open) {
//     if (sidebar && overlay) {
//       sidebar.classList.toggle('open', open);
//       overlay.classList.toggle('show', open);
//     }
//   }

//   if (hamburger) {
//     hamburger.addEventListener('click', () => toggleSidebar(true));
//   }

//   if (overlay) {
//     overlay.addEventListener('click', () => toggleSidebar(false));
//   }

//   /* ==========================================================================
//      2. Navegação Dinâmica, Troca de Ecrãs e Atualização do Topbar
//      ========================================================================== */
//   const navButtons = document.querySelectorAll('#nav .nav-item');
//   const sectionVisao = document.getElementById('section-visao');
//   const sectionOther = document.getElementById('section-other');

//   const pageTitle = document.getElementById('pageTitle');
//   const pageSub = document.getElementById('pageSub');
//   const otherTitle = document.getElementById('otherTitle');

//   // Mapeamento dos textos do Topbar e dos ecrãs
//   const sectionInfo = {
//     visao: {
//       title: 'Visão Geral',
//       sub: 'Talatona · Rangel · Huambo · Cabinda — ano formativo 2026'
//     },
//     formandos: {
//       title: 'Formandos',
//       sub: 'Gestão de formandos activos e histórico'
//     },
//     formadores: {
//       title: 'Cursos & Turmas',
//       sub: 'Catálogo de cursos e turmas por centro'
//     },
//     matriculas: {
//       title: 'Matrículas',
//       sub: 'Inscrições e processos em análise'
//     },
//     certificacoes: {
//       title: 'Certificações',
//       sub: 'Emissão e validação de certificados'
//     },
//     relatorios: {
//       title: 'Relatórios',
//       sub: 'Indicadores de desempenho e exportações'
//     },
//     definicoes: {
//       title: 'Definições',
//       sub: 'Configuração da conta e do centro'
//     }
//   };

//   navButtons.forEach(button => {
//     button.addEventListener('click', () => {
//       const targetSection = button.dataset.section;
//       if (!targetSection) return;

//       // A. Destacar o botão clicado na Sidebar
//       navButtons.forEach(btn => btn.classList.remove('active'));
//       button.classList.add('active');

//       // B. Atualizar os títulos e subtítulos no Topbar e na tela
//       const info = sectionInfo[targetSection];
//       if (info) {
//         if (pageTitle) pageTitle.textContent = info.title;
//         if (pageSub) pageSub.textContent = info.sub;
//         if (otherTitle) otherTitle.textContent = info.title;
//       }

//       // C. Alternar a visibilidade das secções
//       if (targetSection === 'visao') {
//         if (sectionVisao) {
//           sectionVisao.style.display = 'block';
//           sectionVisao.classList.add('active');
//         }
//         if (sectionOther) {
//           sectionOther.style.display = 'none';
//           sectionOther.classList.remove('active');
//         }
//       } else {
//         if (sectionVisao) {
//           sectionVisao.style.display = 'none';
//           sectionVisao.classList.remove('active');
//         }
//         if (sectionOther) {
//           sectionOther.style.display = 'block';
//           sectionOther.classList.add('active');
//         }
//       }

//       // D. Fechar a Sidebar automaticamente em ecrãs móveis ao clicar num item
//       if (window.innerWidth <= 900) {
//         toggleSidebar(false);
//       }
//     });
//   });
// });

// ---- Chart.js defaults ----
if (window.Chart) {
  Chart.defaults.font.family = "'IBM Plex Mono', monospace";
  Chart.defaults.color = '#8FA0AC';
  Chart.defaults.font.size = 10.5;
}

/**
 * Initialises the two dashboard charts and the employability gauge.
 */
function initDashboardCharts(data) {
  const areasCanvas = document.getElementById('chartAreas');
  if (areasCanvas) {
    new Chart(areasCanvas, {
      type: 'bar',
      data: {
        labels: data.areas.labels,
        datasets: [{
          data: data.areas.data,
          backgroundColor: '#F2A93B',
          borderRadius: 4,
          maxBarThickness: 34,
        }]
      },
      options: {
        responsive: true, maintainAspectRatio: false,
        plugins: { legend: { display: false } },
        scales: {
          x: { grid: { display: false }, ticks: { color: '#8FA0AC' } },
          y: { grid: { color: 'rgba(41,55,66,0.6)' }, ticks: { color: '#8FA0AC' }, beginAtZero: true }
        }
      }
    });
  }

  const conclusaoCanvas = document.getElementById('chartConclusao');
  if (conclusaoCanvas) {
    new Chart(conclusaoCanvas, {
      type: 'line',
      data: {
        labels: data.conclusao.labels,
        datasets: [{
          data: data.conclusao.data,
          borderColor: '#4FB6A9',
          backgroundColor: 'rgba(79,182,169,0.12)',
          fill: true,
          tension: 0.35,
          pointBackgroundColor: '#4FB6A9',
          pointRadius: 4,
          borderWidth: 2.5,
        }]
      },
      options: {
        responsive: true, maintainAspectRatio: false,
        plugins: { legend: { display: false } },
        scales: {
          x: { grid: { display: false } },
          y: { grid: { color: 'rgba(41,55,66,0.6)' }, suggestedMin: 60, suggestedMax: 100 }
        }
      }
    });
  }

  drawGauge(data.empregabilidade || 0);
}

// ---- Gauge (metrology-style dial) for employability index ----
function drawGauge(pct) {
  const arc = document.getElementById('gaugeArc');
  const needle = document.getElementById('gaugeNeedle');
  const ticksGroup = document.getElementById('gaugeTicks');
  if (!arc || !needle || !ticksGroup) return;

  const total = 301.6; // path length approx for the semicircle
  arc.style.strokeDashoffset = total - (total * pct / 100);

  const angle = -90 + (pct / 100) * 180;
  needle.setAttribute('transform', `rotate(${angle} 110 116)`);

  const cx = 110, cy = 116, r1 = 88, r2 = 96;
  ticksGroup.innerHTML = ''; // Limpa ticks pré-existentes para evitar duplicação

  for (let i = 0; i <= 10; i++) {
    const a = Math.PI - (i / 10) * Math.PI;
    const x1 = cx + r1 * Math.cos(a), y1 = cy - r1 * Math.sin(a);
    const x2 = cx + r2 * Math.cos(a), y2 = cy - r2 * Math.sin(a);
    const line = document.createElementNS('http://www.w3.org/2000/svg', 'line');
    line.setAttribute('x1', x1); line.setAttribute('y1', y1);
    line.setAttribute('x2', x2); line.setAttribute('y2', y2);
    ticksGroup.appendChild(line);
  }
}

// ---- Event Listener Único para o DOM ----
document.addEventListener('DOMContentLoaded', () => {

  /* ==========================================================================
     1. Gestão da Sidebar, Mobile Menu e Overlays
     ========================================================================== */
  const sidebar = document.getElementById('sidebar');
  const hamburger = document.getElementById('hamburger');
  const overlay = document.getElementById('overlay');

  function toggleSidebar(open) {
    if (sidebar) sidebar.classList.toggle('open', open);
    if (overlay) overlay.classList.toggle('show', open);
  }

  if (hamburger) {
    hamburger.addEventListener('click', () => toggleSidebar(true));
  }

  /* ==========================================================================
     2. Modal (Nova Matrícula)
     ========================================================================== */
  const openBtn = document.getElementById('openModal');
  const closeBtn = document.getElementById('closeModal');
  const cancelBtn = document.getElementById('cancelModal');

  if (openBtn) {
    openBtn.addEventListener('click', () => {
      if (overlay) overlay.classList.add('show');
    });
  }

  if (closeBtn) {
    closeBtn.addEventListener('click', () => {
      if (overlay) overlay.classList.remove('show');
    });
  }

  if (cancelBtn) {
    cancelBtn.addEventListener('click', () => {
      if (overlay) overlay.classList.remove('show');
    });
  }

  // Evento unificado do Overlay (Fecha Sidebar E/OU fecha Modal ao clicar fora)
  if (overlay) {
    overlay.addEventListener('click', (e) => {
      if (e.target === overlay) {
        toggleSidebar(false);
        overlay.classList.remove('show');
      }
    });
  }

  /* ==========================================================================
     3. Navegação Dinâmica, Troca de Ecrãs e Atualização do Topbar
     ========================================================================== */
  const navButtons = document.querySelectorAll('#nav .nav-item');
  const sectionVisao = document.getElementById('section-visao');
  const sectionOther = document.getElementById('section-other');

  const pageTitle = document.getElementById('pageTitle');
  const pageSub = document.getElementById('pageSub');
  const otherTitle = document.getElementById('otherTitle');

  // Mapeamento dos textos do Topbar e dos ecrãs
  const sectionInfo = {
    visao: {
      title: 'Visão Geral',
      sub: 'Talatona · Rangel · Huambo · Cabinda — ano formativo 2026'
    },
    formandos: {
      title: 'Formandos',
      sub: 'Gestão de formandos activos e histórico'
    },
    formadores: {
      title: 'Cursos & Turmas',
      sub: 'Catálogo de cursos e turmas por centro'
    },
    matriculas: {
      title: 'Matrículas',
      sub: 'Inscrições e processos em análise'
    },
    certificacoes: {
      title: 'Certificações',
      sub: 'Emissão e validação de certificados'
    },
    relatorios: {
      title: 'Relatórios',
      sub: 'Indicadores de desempenho e exportações'
    },
    definicoes: {
      title: 'Definições',
      sub: 'Configuração da conta e do centro'
    }
  };

  navButtons.forEach(button => {
    button.addEventListener('click', () => {
      const targetSection = button.dataset.section;
      if (!targetSection) return;

      // A. Destacar o botão clicado na Sidebar
      navButtons.forEach(btn => btn.classList.remove('active'));
      button.classList.add('active');

      // B. Atualizar os títulos e subtítulos no Topbar e na tela
      const info = sectionInfo[targetSection];
      if (info) {
        if (pageTitle) pageTitle.textContent = info.title;
        if (pageSub) pageSub.textContent = info.sub;
        if (otherTitle) otherTitle.textContent = info.title;
      }

      // C. Alternar a visibilidade das secções
      if (targetSection === 'visao') {
        if (sectionVisao) {
          sectionVisao.style.display = 'block';
          sectionVisao.classList.add('active');
        }
        if (sectionOther) {
          sectionOther.style.display = 'none';
          sectionOther.classList.remove('active');
        }
      } else {
        if (sectionVisao) {
          sectionVisao.style.display = 'none';
          sectionVisao.classList.remove('active');
        }
        if (sectionOther) {
          sectionOther.style.display = 'block';
          sectionOther.classList.add('active');
        }
      }

      // D. Fechar a Sidebar automaticamente em ecrãs móveis ao clicar num item
      if (window.innerWidth <= 900) {
        toggleSidebar(false);
      }
    });
  });
});
