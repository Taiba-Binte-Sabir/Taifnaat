// =====================
// TOP SLIDER TEXT ROTATION
// =====================
const slides = document.querySelectorAll(".slide");

let topIndex = 0;

setInterval(() => {
  slides[topIndex].classList.remove("active");

  topIndex = (topIndex + 1) % slides.length;

  slides[topIndex].classList.add("active");
}, 2500);

// =====================
// SLIDER
// =====================
document.addEventListener("DOMContentLoaded", () => {

  const track = document.getElementById("track");
  const cards = document.querySelectorAll(".project-card");
  const next = document.getElementById("next");
  const prev = document.getElementById("prev");

  let currentIndex = 0;

  function updateSlider() {
    track.style.transform = `translateX(-${currentIndex * 100}%)`;
  }

  next.addEventListener("click", () => {
    currentIndex = (currentIndex + 1) % cards.length;
    updateSlider();
  });

  prev.addEventListener("click", () => {
    currentIndex = (currentIndex - 1 + cards.length) % cards.length;
    updateSlider();
  });

  // Auto slide
  let autoSlide = setInterval(() => {
    currentIndex = (currentIndex + 1) % cards.length;
    updateSlider();
  }, 3000);

  // Pause on hover
  track.addEventListener("mouseenter", () => clearInterval(autoSlide));

  track.addEventListener("mouseleave", () => {
    autoSlide = setInterval(() => {
      currentIndex = (currentIndex + 1) % cards.length;
      updateSlider();
    }, 3000);
  });

});


// =====================
// MENU TOGGLE
// =====================
const menuToggle = document.querySelector(".menu-toggle");
const menu = document.querySelector(".menu");

if (menuToggle) {
  menuToggle.addEventListener("click", () => {
    menu.classList.toggle("active");
  });
}


// =====================
// DROPDOWN MOBILE
// =====================
const dropdowns = document.querySelectorAll(".dropdown");

dropdowns.forEach(item => {
  item.addEventListener("click", () => {
    item.classList.toggle("active");
  });
});


// =====================
// SEARCH
// =====================
const searchIcon = document.getElementById("search-icon");
const searchBox = document.querySelector(".search-box");

if (searchIcon) {
  searchIcon.addEventListener("click", () => {
    searchBox.classList.toggle("active");
  });
}


// =====================
// INTERSECTION ANIMATION
// =====================
const section = document.querySelector('.bf-section');

if (section) {
  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        section.classList.add('show');
      }
    });
  });

  observer.observe(section);
}

// GLOBAL REVEAL ANIMATION

const reveals = document.querySelectorAll('.reveal, .reveal-left, .reveal-right, .reveal-zoom');

const revealObserver = new IntersectionObserver((entries) => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      entry.target.classList.add('show');
      revealObserver.unobserve(entry.target);
    }
  });
}, { threshold: 0.2 });

reveals.forEach(el => revealObserver.observe(el));