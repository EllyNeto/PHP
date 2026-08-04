// ---- Modal (Nova Matrícula) ----
document.addEventListener('DOMContentLoaded', () => {
  const sidebar = document.getElementById('sidebar');
  const sidebarOverlay = document.getElementById('sidebarOverlay');
  const hamburger = document.getElementById('hamburger');
  const overlay = document.getElementById('overlay');
  const openBtn = document.getElementById('openModal');
  const closeBtn = document.getElementById('closeModal');
  const cancelBtn = document.getElementById('cancelModal');

  const closeSidebar = () => {
    if (sidebar) sidebar.classList.remove('open');
    if (sidebarOverlay) sidebarOverlay.classList.remove('show');
    if (hamburger) hamburger.setAttribute('aria-expanded', 'false');
  };

  if (hamburger) hamburger.addEventListener('click', () => {
    const isOpen = sidebar.classList.toggle('open');
    if (sidebarOverlay) sidebarOverlay.classList.toggle('show', isOpen);
    hamburger.setAttribute('aria-expanded', String(isOpen));
  });
  if (sidebarOverlay) sidebarOverlay.addEventListener('click', closeSidebar);
  document.querySelectorAll('.nav-item').forEach((item) => item.addEventListener('click', closeSidebar));

  document.addEventListener('click', (e) => {
    if (e.target.closest('#openModal')) {
      if (overlay) overlay.classList.add('show');
    }
  });
  if (closeBtn) closeBtn.addEventListener('click', () => overlay.classList.remove('show'));
  if (cancelBtn) cancelBtn.addEventListener('click', () => overlay.classList.remove('show'));
  if (overlay) overlay.addEventListener('click', (e) => { if (e.target === overlay) overlay.classList.remove('show'); });

  const detailsModal = document.getElementById('detailsModal');
  const detailsForm = document.getElementById('detailsForm');
  const closeDetailsModal = document.getElementById('closeDetailsModal');
  const cancelDetailsModal = document.getElementById('cancelDetailsModal');
  const closeDetails = () => detailsModal?.classList.remove('show');

  document.querySelectorAll('.btn-detalhes').forEach((button) => {
    button.addEventListener('click', () => {
      const { id, nome, email, bi, phone, curso, estado } = button.dataset;

      document.getElementById('detail_nome').value = nome || '';
      document.getElementById('detail_email').value = email || '';
      document.getElementById('detail_bi').value = bi || '';
      document.getElementById('detail_phone').value = phone || '';
      document.getElementById('detail_curso').value = curso || '';
      document.getElementById('detail_estado').value = estado || 'Pendente';

      detailsForm.action = `/matriculas/${id}`;
      const deleteForm = document.getElementById('deleteForm');
      if (deleteForm) {
        deleteForm.action = `/matriculas/${id}`;
      }
      detailsModal?.classList.add('show');
    });
  });

  closeDetailsModal?.addEventListener('click', closeDetails);
  cancelDetailsModal?.addEventListener('click', closeDetails);
  detailsModal?.addEventListener('click', (e) => { if (e.target === detailsModal) closeDetails(); });

  const studentModal = document.getElementById('studentModal');
  const openStudentModal = document.getElementById('openStudentModal');
  const closeStudentModal = document.getElementById('closeStudentModal');
  const cancelStudentModal = document.getElementById('cancelStudentModal');
  const closeStudent = () => studentModal?.classList.remove('show');

  openStudentModal?.addEventListener('click', () => studentModal?.classList.add('show'));
  closeStudentModal?.addEventListener('click', closeStudent);
  cancelStudentModal?.addEventListener('click', closeStudent);
  studentModal?.addEventListener('click', (e) => { if (e.target === studentModal) closeStudent(); });

  const classModal = document.getElementById('classModal');
  const openClassModal = document.getElementById('openClassModal');
  const closeClassModal = document.getElementById('closeClassModal');
  const cancelClassModal = document.getElementById('cancelClassModal');
  const closeClass = () => classModal?.classList.remove('show');

  openClassModal?.addEventListener('click', () => classModal?.classList.add('show'));
  closeClassModal?.addEventListener('click', closeClass);
  cancelClassModal?.addEventListener('click', closeClass);
  classModal?.addEventListener('click', (e) => { if (e.target === classModal) closeClass(); });

  const courseModal = document.getElementById('courseModal');
  const openCourseModal = document.getElementById('openCourseModal');
  const closeCourseModal = document.getElementById('closeCourseModal');
  const cancelCourseModal = document.getElementById('cancelCourseModal');
  const closeCourse = () => courseModal?.classList.remove('show');

  openCourseModal?.addEventListener('click', () => courseModal?.classList.add('show'));
  closeCourseModal?.addEventListener('click', closeCourse);
  cancelCourseModal?.addEventListener('click', closeCourse);
  courseModal?.addEventListener('click', (e) => { if (e.target === courseModal) closeCourse(); });

  const courseDetailsModal = document.getElementById('courseDetailsModal');
  const courseDetailsForm = document.getElementById('courseDetailsForm');
  const deleteCourseForm = document.getElementById('deleteCourseForm');
  const closeCourseDetailsModal = document.getElementById('closeCourseDetailsModal');
  const cancelCourseDetailsModal = document.getElementById('cancelCourseDetailsModal');
  const closeCourseDetails = () => courseDetailsModal?.classList.remove('show');

  document.querySelectorAll('.btn-detalhes-curso').forEach((button) => {
    button.addEventListener('click', () => {
      const { id, name, description, duration, price } = button.dataset;

      const nameInput = document.getElementById('detail_course_name');
      const descInput = document.getElementById('detail_course_description');
      const durationInput = document.getElementById('detail_course_duration');
      const priceInput = document.getElementById('detail_course_price');

      if (nameInput) nameInput.value = name || '';
      if (descInput) descInput.value = description || '';
      if (durationInput) durationInput.value = duration || '';
      if (priceInput) priceInput.value = price || '';

      if (courseDetailsForm) courseDetailsForm.action = `/cursos/${id}`;
      if (deleteCourseForm) deleteCourseForm.action = `/cursos/${id}`;

      courseDetailsModal?.classList.add('show');
    });
  });

  closeCourseDetailsModal?.addEventListener('click', closeCourseDetails);
  cancelCourseDetailsModal?.addEventListener('click', closeCourseDetails);
  courseDetailsModal?.addEventListener('click', (e) => { if (e.target === courseDetailsModal) closeCourseDetails(); });

  const classDetailsModal = document.getElementById('classDetailsModal');
  const classDetailsForm = document.getElementById('classDetailsForm');
  const deleteClassForm = document.getElementById('deleteClassForm');
  const closeClassDetailsModal = document.getElementById('closeClassDetailsModal');
  const cancelClassDetailsModal = document.getElementById('cancelClassDetailsModal');
  const closeClassDetails = () => classDetailsModal?.classList.remove('show');

  document.querySelectorAll('.btn-detalhes-turma').forEach((button) => {
    button.addEventListener('click', () => {
      const { id, course, room, teacher, shift, schedule, capacity, status } = button.dataset;

      const courseSelect = document.getElementById('detail_class_course');
      const roomInput = document.getElementById('detail_class_room');
      const teacherInput = document.getElementById('detail_class_teacher');
      const shiftSelect = document.getElementById('detail_class_shift');
      const scheduleInput = document.getElementById('detail_class_schedule');
      const capacityInput = document.getElementById('detail_class_capacity');
      const statusSelect = document.getElementById('detail_class_status');

      if (courseSelect) courseSelect.value = course || '';
      if (roomInput) roomInput.value = room || '';
      if (teacherInput) teacherInput.value = teacher || '';
      if (shiftSelect) shiftSelect.value = shift || 'Manhã';
      if (scheduleInput) scheduleInput.value = schedule || '';
      if (capacityInput) capacityInput.value = capacity || '';
      if (statusSelect) statusSelect.value = status || 'Planeada';

      if (classDetailsForm) classDetailsForm.action = `/turmas/${id}`;
      if (deleteClassForm) deleteClassForm.action = `/turmas/${id}`;

      classDetailsModal?.classList.add('show');
    });
  });

  closeClassDetailsModal?.addEventListener('click', closeClassDetails);
  cancelClassDetailsModal?.addEventListener('click', closeClassDetails);
  classDetailsModal?.addEventListener('click', (e) => { if (e.target === classDetailsModal) closeClassDetails(); });
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
