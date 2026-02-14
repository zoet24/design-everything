document.addEventListener("DOMContentLoaded", () => {
  const carousel = document.querySelector(".carousel");

  if (carousel) {
    const images = JSON.parse(carousel.getAttribute("data-images"));
    const track = carousel.querySelector(".carousel__track");

    let currentIndex = Math.floor(Math.random() * images.length);
    let isAnimating = false;

    const getIndex = (offset) => {
      return (currentIndex + offset + images.length) % images.length;
    };

    const buildCarousel = () => {
      track.innerHTML = "";

      // Build 5 images: -2, -1, 0 (center), 1, 2
      [-2, -1, 0, 1, 2].forEach((offset) => {
        const item = document.createElement("div");
        item.className = "carousel__item";
        item.style.backgroundImage = `url('${images[getIndex(offset)]}')`;

        if (offset === 0) {
          item.classList.add("active");
        }

        track.appendChild(item);
      });

      // Reset to center position
      track.style.transition = "none";
      track.style.transform = "translateX(0)";

      // Force reflow
      track.offsetHeight;

      // Re-enable transitions
      track.style.transition = "transform 0.5s ease-in-out";
    };

    const goToNext = () => {
      if (isAnimating) return;
      isAnimating = true;

      // Slide left by one image width + gap
      track.style.transform =
        "translateX(calc(-1 * (100vw - (4 * var(--nav-height)) + var(--nav-height))))";

      setTimeout(() => {
        currentIndex = (currentIndex + 1) % images.length;
        buildCarousel();
        isAnimating = false;
      }, 500);
    };

    const goToPrev = () => {
      if (isAnimating) return;
      isAnimating = true;

      // Slide right by one image width + gap
      track.style.transform =
        "translateX(calc(1 * (100vw - (4 * var(--nav-height)) + var(--nav-height))))";

      setTimeout(() => {
        currentIndex = (currentIndex - 1 + images.length) % images.length;
        buildCarousel();
        isAnimating = false;
      }, 500);
    };

    // Create navigation buttons
    const prevButton = document.createElement("button");
    prevButton.className = "carousel__nav carousel__nav--prev";
    prevButton.innerHTML = "←";
    prevButton.setAttribute("aria-label", "Previous image");
    prevButton.addEventListener("click", goToPrev);

    const nextButton = document.createElement("button");
    nextButton.className = "carousel__nav carousel__nav--next";
    nextButton.innerHTML = "→";
    nextButton.setAttribute("aria-label", "Next image");
    nextButton.addEventListener("click", goToNext);

    carousel.appendChild(prevButton);
    carousel.appendChild(nextButton);

    buildCarousel();
  }
});
