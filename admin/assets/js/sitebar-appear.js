document.addEventListener("DOMContentLoaded", function () {
  const sidebar = document.getElementById("sidebar");
  const toggleBtn = document.getElementById("mobileSidebarToggle");
  const backdrop = document.getElementById("sidebarBackdrop");

  function openSidebar() {
    if (!sidebar || !backdrop) return; // حماية
    sidebar.classList.add("show");
    backdrop.classList.remove("d-none");
    backdrop.classList.add("d-block");
    document.body.classList.add("no-scroll");
  }

  function closeSidebar() {
    if (!sidebar || !backdrop) return; // حماية
    sidebar.classList.remove("show");
    backdrop.classList.remove("d-block");
    backdrop.classList.add("d-none");
    document.body.classList.remove("no-scroll");

    if (sidebar) {
      const openCollapses = sidebar.querySelectorAll(".collapse.show");
      openCollapses.forEach((c) => {
        try {
          const bs = bootstrap.Collapse.getInstance(c);
          if (bs) bs.hide();
          else new bootstrap.Collapse(c, { toggle: false }).hide();
        } catch (e) {
          c.classList.remove("show");
        }
      });
    }
  }

  // toggle on button
  if (toggleBtn) {
    toggleBtn.addEventListener("click", function () {
      if (sidebar && sidebar.classList.contains("show")) closeSidebar();
      else openSidebar();
    });
  }

  // click on backdrop closes sidebar
  if (backdrop) {
    backdrop.addEventListener("click", closeSidebar);
  }

  // close on escape
  document.addEventListener("keydown", function (e) {
    if (e.key === "Escape" && sidebar && sidebar.classList.contains("show")) {
      closeSidebar();
    }
  });

  // close sidebar automatically when resizing to desktop
  window.addEventListener("resize", function () {
    if (
      sidebar &&
      backdrop &&
      window.innerWidth >= 768 &&
      sidebar.classList.contains("show")
    ) {
      sidebar.classList.remove("show");
      backdrop.classList.remove("d-block");
      backdrop.classList.add("d-none");
    }
  });

  // close sidebar when clicking links
  if (sidebar) {
    sidebar.addEventListener("click", function (e) {
      const target = e.target.closest("a");
      if (!target) return;
      const isToggle = e.target.closest('[data-bs-toggle="collapse"]');
      if (!isToggle && window.innerWidth < 768) {
        closeSidebar();
      }
    });
  }
});
