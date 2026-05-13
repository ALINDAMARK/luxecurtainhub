// Smooth scroll and intersection observer for reveals
const observerOptions = {
  threshold: 0.1,
  rootMargin: '0px 0px -50px 0px'
};

const observer = new IntersectionObserver((entries) => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      entry.target.classList.add('active');
      observer.unobserve(entry.target);
    }
  });
}, observerOptions);

// Observe all reveal elements
document.querySelectorAll('.reveal-fade, .reveal-left, .reveal-right').forEach(el => {
  observer.observe(el);
});

// Scroll progress bar
const progressBar = document.getElementById('progress-bar') || (() => {
  const bar = document.createElement('div');
  bar.id = 'progress-bar';
  document.body.insertBefore(bar, document.body.firstChild);
  return bar;
})();

window.addEventListener('scroll', () => {
  const scrollHeight = document.documentElement.scrollHeight - window.innerHeight;
  const scrolled = (window.scrollY / scrollHeight) * 100;
  progressBar.style.width = scrolled + '%';
});

// Parallax effect for hero images
window.addEventListener('scroll', () => {
  const parallaxElements = document.querySelectorAll('.parallax');
  parallaxElements.forEach(el => {
    const scrollPosition = window.scrollY;
    const elementPosition = el.offsetTop;
    const distance = scrollPosition - elementPosition;
    if (distance < window.innerHeight * 0.8 && distance > -window.innerHeight) {
      el.style.transform = `translateY(${distance * 0.3}px)`;
    }
  });
});

// Stagger animation for card elements
const revealCards = document.querySelectorAll('.sig-card');
revealCards.forEach((card, index) => {
  card.style.opacity = '0';
  card.style.transform = 'translateY(30px)';
  setTimeout(() => {
    card.style.transition = 'opacity 0.8s ease, transform 0.8s ease';
    card.style.opacity = '1';
    card.style.transform = 'translateY(0)';
  }, 100 * (index + 1));
});

console.log('LuxeCurtain Hub animations loaded');
