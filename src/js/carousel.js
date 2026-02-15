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
        const imageData = images[getIndex(offset)];
        const item = document.createElement("div");
        item.className = "carousel__item";
        if (offset === 0) {
          item.classList.add("active");
        }

        // Create image wrapper instead of setting background on item
        const imageWrapper = document.createElement("div");
        imageWrapper.className = "carousel__item-image";
        imageWrapper.style.backgroundImage = `url('${imageData.url}')`;
        item.appendChild(imageWrapper);

        // Add info overlay (only for active/center image)
        if (offset === 0 && (imageData.title || imageData.caption)) {
          const info = document.createElement("div");
          info.className = "carousel__info";

          if (imageData.title) {
            const title = document.createElement("h3");
            title.className = "carousel__info__title";
            title.textContent = imageData.title;
            info.appendChild(title);
          }

          if (imageData.caption) {
            const caption = document.createElement("p");
            caption.className = "carousel__info__caption";
            caption.textContent = imageData.caption;
            info.appendChild(caption);
          }

          item.appendChild(info);
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

      const isMobile = window.innerWidth <= 480;

      if (isMobile) {
        // Mobile: width is (100vw - nav-height) + gap is (nav-height / 4)
        track.style.transform =
          "translateX(calc(-1 * (100vw - var(--nav-height) + (var(--nav-height) / 4))))";
      } else {
        // Desktop: width is (100vw - 4 * nav-height) + gap is nav-height
        track.style.transform =
          "translateX(calc(-1 * (100vw - (4 * var(--nav-height)) + var(--nav-height))))";
      }

      setTimeout(() => {
        currentIndex = (currentIndex + 1) % images.length;
        buildCarousel();
        isAnimating = false;
      }, 500);
    };

    const goToPrev = () => {
      if (isAnimating) return;
      isAnimating = true;

      const isMobile = window.innerWidth <= 480;

      if (isMobile) {
        // Mobile: width is (100vw - nav-height) + gap is (nav-height / 4)
        track.style.transform =
          "translateX(calc(1 * (100vw - var(--nav-height) + (var(--nav-height) / 4))))";
      } else {
        // Desktop: width is (100vw - 4 * nav-height) + gap is nav-height
        track.style.transform =
          "translateX(calc(1 * (100vw - (4 * var(--nav-height)) + var(--nav-height))))";
      }

      setTimeout(() => {
        currentIndex = (currentIndex - 1 + images.length) % images.length;
        buildCarousel();
        isAnimating = false;
      }, 500);
    };

    // Create overlay divs
    const leftOverlay = document.createElement("div");
    leftOverlay.className = "carousel__overlay carousel__overlay--left";

    const rightOverlay = document.createElement("div");
    rightOverlay.className = "carousel__overlay carousel__overlay--right";

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

    carousel.appendChild(leftOverlay);
    carousel.appendChild(rightOverlay);
    carousel.appendChild(prevButton);
    carousel.appendChild(nextButton);

    buildCarousel();
  }
});
