document.addEventListener("DOMContentLoaded", () => {
  const textBox = document.querySelector(".text-box-slide");

  if (textBox) {
    // Existing slide in animation
    setTimeout(() => {
      textBox.classList.add("slide-in");
    }, 100);
  }

  // Toggle functionality for home page
  const toggle = document.querySelector(".text-box-toggle");
  const toggleableBox = document.querySelector(".text-box-slide--toggleable");

  if (toggle && toggleableBox) {
    toggle.addEventListener("click", () => {
      toggleableBox.classList.toggle("closed");
    });
  }

  // Sliding animation for other links
  const navElement = document.querySelector("[data-nav-position]");

  if (navElement) {
    const currentPosition = navElement.getAttribute("data-nav-position");
    const previousPosition = sessionStorage.getItem("navPosition");

    const isMobile = window.innerWidth <= 480;

    // Only animate if position changed
    if (previousPosition && previousPosition !== currentPosition && !isMobile) {
      navElement.classList.add("animate-in");

      // Remove animation class after it completes
      navElement.addEventListener(
        "animationend",
        () => {
          navElement.classList.remove("animate-in");
        },
        { once: true }
      );
    }

    // Store current position for next page
    sessionStorage.setItem("navPosition", currentPosition);
  }
});
