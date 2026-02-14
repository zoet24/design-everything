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
});
