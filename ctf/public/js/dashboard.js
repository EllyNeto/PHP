// Theme initialization helper
function applyTheme() {
  const savedTheme = localStorage.getItem('theme');
  const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
  if (savedTheme === 'dark' || (!savedTheme && prefersDark)) {
    document.documentElement.classList.add('dark');
    document.body.classList.add('dark');
  } else {
    document.documentElement.classList.remove('dark');
    document.body.classList.remove('dark');
  }
}

// Global Theme Toggle Function
window.toggleTheme = function () {
  const isDark = document.documentElement.classList.contains('dark');
  if (isDark) {
    document.documentElement.classList.remove('dark');
    document.body.classList.remove('dark');
    localStorage.setItem('theme', 'light');
  } else {
    document.documentElement.classList.add('dark');
    document.body.classList.add('dark');
    localStorage.setItem('theme', 'dark');
  }
};

// Immediate theme execution on load
applyTheme();

document.addEventListener('DOMContentLoaded', function () {
  applyTheme();

  // Mobile Hamburger & Sidebar Overlay Toggle
  const hamburger = document.getElementById('hamburger');
  const sidebar = document.getElementById('sidebar');
  const overlay = document.getElementById('sidebarOverlay');

  if (hamburger && sidebar && overlay) {
    hamburger.addEventListener('click', function () {
      sidebar.classList.toggle('open');
      overlay.classList.toggle('active');
    });

    overlay.addEventListener('click', function () {
      sidebar.classList.remove('open');
      overlay.classList.remove('active');
    });
  }

  // Theme Toggle Buttons
  document.querySelectorAll('[data-theme-toggle]').forEach(btn => {
    btn.addEventListener('click', function () {
      window.toggleTheme();
    });
  });

  // Generic Modal Trigger Handling
  document.querySelectorAll('[data-modal-target]').forEach(trigger => {
    trigger.addEventListener('click', function () {
      const targetId = this.getAttribute('data-modal-target');
      const targetModal = document.getElementById(targetId);
      if (targetModal) {
        targetModal.classList.add('show');
      }
    });
  });

  document.querySelectorAll('.modal-close, [data-modal-close]').forEach(closeBtn => {
    closeBtn.addEventListener('click', function () {
      const overlayParent = this.closest('.overlay');
      if (overlayParent) {
        overlayParent.classList.remove('show');
      }
    });
  });

  document.querySelectorAll('.overlay').forEach(modalOverlay => {
    modalOverlay.addEventListener('click', function (e) {
      if (e.target === this) {
        this.classList.remove('show');
      }
    });
  });
});
