document.addEventListener("DOMContentLoaded", () => {
  const textBox = document.querySelector(".text-box-slide");

  if (textBox) {
    // Trigger slide in after a short delay
    setTimeout(() => {
      textBox.classList.add("slide-in");
    }, 100);

    // Optional: Click anywhere to dismiss
    textBox.addEventListener("click", () => {
      textBox.style.animation = "none";
      textBox.style.transform = textBox
        .getAttribute("data-origin")
        .includes("top")
        ? "translate(-50%, -100%)"
        : "translateY(100%)";
    });
  }
});
