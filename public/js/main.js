// Enhanced animations, reveals, progress and hero word cycling
document.addEventListener('DOMContentLoaded', () => {
  const observerOptions = { threshold: 0.12, rootMargin: '0px 0px -80px 0px' };

  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('active');
        observer.unobserve(entry.target);
      }
    });
  }, observerOptions);

  document.querySelectorAll('.reveal-fade, .reveal-left, .reveal-right, .reveal-scale').forEach(el => observer.observe(el));

  // Progress bar
  const progressBar = document.getElementById('progress-bar') || (() => {
    const bar = document.createElement('div');
    bar.id = 'progress-bar';
    document.body.insertBefore(bar, document.body.firstChild);
    return bar;
  })();

  const updateProgress = () => {
    const scrollHeight = document.documentElement.scrollHeight - window.innerHeight;
    const scrolled = (window.scrollY / Math.max(scrollHeight, 1)) * 100;
    progressBar.style.width = scrolled + '%';
  };

  window.addEventListener('scroll', () => requestAnimationFrame(updateProgress));
  updateProgress();

  // Parallax (throttled via rAF)
  const parallaxEls = document.querySelectorAll('.parallax');
  const handleParallax = () => {
    parallaxEls.forEach(el => {
      const rect = el.getBoundingClientRect();
      const inView = rect.top < window.innerHeight && rect.bottom > 0;
      if (inView) {
        const translate = (rect.top - window.innerHeight / 2) * -0.04;
        el.style.transform = `translateY(${translate}px)`;
      }
    });
  };
  window.addEventListener('scroll', () => requestAnimationFrame(handleParallax));

  // Stagger entry for signature cards
  const sigCards = document.querySelectorAll('.sig-card');
  sigCards.forEach((card, i) => {
    card.style.opacity = 0;
    card.style.transform = 'translateY(24px)';
    setTimeout(() => {
      card.style.transition = 'opacity .6s cubic-bezier(.2,.9,.2,1), transform .6s cubic-bezier(.2,.9,.2,1)';
      card.style.opacity = 1;
      card.style.transform = 'translateY(0)';
    }, 120 * (i + 1));
  });

  // Nav subtle entrance
  document.querySelectorAll('.nav-link').forEach((n, i) => {
    n.style.opacity = 0;
    n.style.transform = 'translateY(6px)';
    setTimeout(() => {
      n.style.transition = 'opacity .45s ease, transform .45s ease';
      n.style.opacity = 1;
      n.style.transform = 'translateY(0)';
    }, 80 * (i + 1));
  });

  // Hero words cycling
  const heroWords = document.querySelectorAll('.hero-words .word');
  if (heroWords.length > 1) {
    let idx = 0;
    setInterval(() => {
      heroWords.forEach((w, i) => w.classList.remove('active'));
      idx = (idx + 1) % heroWords.length;
      heroWords[idx].classList.add('active');
    }, 2200);
  }

  console.log('LuxeCurtain Hub animations initialized');
});
