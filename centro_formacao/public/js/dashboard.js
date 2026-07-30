// ---- Modal (Nova Matrícula) ----
document.addEventListener('DOMContentLoaded', () => {
  const overlay = document.getElementById('overlay');
  const openBtn = document.getElementById('openModal');
  const closeBtn = document.getElementById('closeModal');
  const cancelBtn = document.getElementById('cancelModal');

  if (openBtn) openBtn.addEventListener('click', () => overlay.classList.add('show'));
  if (closeBtn) closeBtn.addEventListener('click', () => overlay.classList.remove('show'));
  if (cancelBtn) cancelBtn.addEventListener('click', () => overlay.classList.remove('show'));
  if (overlay) overlay.addEventListener('click', (e) => { if (e.target === overlay) overlay.classList.remove('show'); });
});

// ---- Chart.js defaults ----
if (window.Chart) {
  Chart.defaults.font.family = "'IBM Plex Mono', monospace";
  Chart.defaults.color = '#8FA0AC';
  Chart.defaults.font.size = 10.5;
}

/**
 * Initialises the two dashboard charts and the employability gauge.
 * Called from resources/views/admin/dashboard.blade.php with data
 * serialised from the DashboardController via @json().
 *
 * @param {{areas: {labels: string[], data: number[]}, conclusao: {labels: string[], data: number[]}, empregabilidade: number}} data
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
