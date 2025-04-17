function toggleSidebar() {
  const sidebar = document.getElementById('sidebar');
  const overlay = document.getElementById('mobile-overlay');
  const main = document.getElementById('main-content');

  if (window.innerWidth <= 768) {
    sidebar.classList.toggle('mobile-open');
    overlay.classList.toggle('show');
  } else {
    sidebar.classList.toggle('collapsed');
    main.classList.toggle('collapsed');
  }
}

function closeSidebar() {
  const sidebar = document.getElementById('sidebar');
  const overlay = document.getElementById('mobile-overlay');

  sidebar.classList.remove('mobile-open');
  overlay.classList.remove('show');
}

window.addEventListener('resize', () => {
  if (window.innerWidth > 768) {
    closeSidebar();
  }
});

// 🔐 Close sidebar when clicking outside
document.addEventListener('click', function (e) {
  const sidebar = document.getElementById('sidebar');
  const toggleBtn = document.querySelector('.toggle-btn');
  const overlay = document.getElementById('mobile-overlay');

  const isSidebarOpen = sidebar.classList.contains('mobile-open');
  const clickedInsideSidebar = sidebar.contains(e.target);
  const clickedToggleButton = toggleBtn.contains(e.target);

  if (window.innerWidth <= 768 && isSidebarOpen && !clickedInsideSidebar && !clickedToggleButton) {
    closeSidebar();
  }
});


