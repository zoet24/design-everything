document.addEventListener("DOMContentLoaded", () => {
  const isHomePage = document.body.hasAttribute("data-home-loading");

  if (isHomePage) {
    // Check if animation has already been shown this session
    const hasSeenAnimation = sessionStorage.getItem("homeAnimationShown");

    if (hasSeenAnimation) {
      // Skip animation, show everything immediately
      document.body.classList.add("home-loaded");
      document.body.removeAttribute("data-home-loading");

      // Remove loading classes
      const header = document.querySelector(".site-header");
      const footer = document.querySelector(".site-footer");
      const textBox = document.querySelector(".text-box-slide--home-loading");
      const carousel = document.querySelector(".home-loading-carousel");
      const logoOverlay = document.querySelector(".home-hero__overlay");

      if (header) header.classList.remove("home-loading");
      if (footer) footer.classList.remove("home-loading");
      if (textBox) textBox.classList.remove("text-box-slide--home-loading");
      if (carousel) carousel.classList.remove("home-loading-carousel");
      if (logoOverlay) logoOverlay.style.display = "none";
    } else {
      // Mark animation as shown for this session
      sessionStorage.setItem("homeAnimationShown", "true");

      let hasTriggered = false;

      const triggerAnimation = () => {
        if (hasTriggered) return;
        hasTriggered = true;

        document.body.classList.add("home-loaded");

        // Wait for nav animations to complete
        setTimeout(() => {
          const toggle = document.querySelector(".text-box-toggle");
          const textBox = document.querySelector(
            ".text-box-slide--home-loading"
          );

          // Remove loading class FIRST to restore opacity
          if (textBox) {
            textBox.classList.remove("text-box-slide--home-loading");
          }

          // THEN click toggle after a brief delay to let opacity restore
          if (toggle) {
            setTimeout(() => {
              toggle.click(); // Simulate click to open the page intro
            }, 100); // Small delay to ensure opacity has restored
          }
        }, 1500);
      };

      // Trigger on interaction
      ["click", "mousemove", "touchstart", "keydown"].forEach((event) => {
        document.addEventListener(event, triggerAnimation, { once: true });
      });

      // Auto-trigger after 2 seconds
      setTimeout(triggerAnimation, 2000);
    }
  }
});
