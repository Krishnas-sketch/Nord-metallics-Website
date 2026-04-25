document.querySelectorAll(".menu-toggle").forEach((button) => {
  button.addEventListener("click", () => {
    const header = button.closest(".site-header");
    header.classList.toggle("nav-open");
  });
});

document.querySelectorAll(".toggle-panel-trigger").forEach((button) => {
  button.addEventListener("click", () => {
    const panelId = button.getAttribute("aria-controls");
    const panel = panelId ? document.getElementById(panelId) : null;

    if (!panel) {
      return;
    }

    const isOpen = button.getAttribute("aria-expanded") === "true";
    button.setAttribute("aria-expanded", String(!isOpen));
    panel.hidden = isOpen;
  });
});
