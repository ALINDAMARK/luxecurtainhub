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

  // Image details modal
  const modal = document.getElementById('image-modal');
  const modalImg = document.getElementById('image-modal-img');
  const modalTitle = document.getElementById('image-modal-title');
  const modalCategory = document.getElementById('image-modal-category');
  const modalDesc = document.getElementById('image-modal-desc');
  const modalKicker = document.getElementById('image-modal-kicker');
  const modalCount = document.getElementById('image-modal-count');
  const modalRequest = document.getElementById('image-modal-request');
  const modalPrev = document.getElementById('image-modal-prev');
  const modalNext = document.getElementById('image-modal-next');

  const modalItems = Array.from(document.querySelectorAll('.js-product-card, .js-gallery-card, .sig-card'));
  let modalIndex = 0;

  const getCardDetails = (card) => {
    const image = card.dataset.image || card.querySelector('img')?.src || '';
    const title = card.dataset.title || card.querySelector('h3')?.textContent?.trim() || card.querySelector('.sig-name')?.textContent?.trim() || 'Product details';
    const category = card.dataset.category || card.querySelector('.meta')?.textContent?.trim() || card.querySelector('.sig-tag')?.textContent?.trim() || '';
    const description = card.dataset.description || card.querySelector('p')?.textContent?.trim() || card.querySelector('.sig-desc')?.textContent?.trim() || 'Elegant curtain styling selected for timeless spaces.';

    return { image, title, category, description };
  };

  const renderModal = (card, index) => {
    if (!modal || !modalImg) return;
    const { image, title, category, description } = getCardDetails(card);

    modalImg.src = image;
    modalImg.alt = title;
    modalTitle.textContent = title;
    modalCategory.textContent = category;
    modalDesc.textContent = description;
    modalKicker.textContent = 'Tap image details';
    if (modalCount) {
      modalCount.textContent = `${String(index + 1).padStart(2, '0')} / ${String(modalItems.length).padStart(2, '0')}`;
    }
    if (modalRequest) {
      modalRequest.dataset.styleName = title;
      modalRequest.dataset.styleCategory = category;
      modalRequest.dataset.styleDescription = description;
    }

    modal.classList.add('is-open');
    modal.setAttribute('aria-hidden', 'false');
    document.body.classList.add('modal-open');
  };

  const openModalAt = (index) => {
    if (!modalItems.length) return;
    modalIndex = (index + modalItems.length) % modalItems.length;
    renderModal(modalItems[modalIndex], modalIndex);
  };

  const openModal = (card) => openModalAt(modalItems.indexOf(card));

  const closeModal = () => {
    if (!modal) return;
    modal.classList.remove('is-open');
    modal.setAttribute('aria-hidden', 'true');
    document.body.classList.remove('modal-open');
  };

  modalItems.forEach((card, index) => {
    card.addEventListener('click', () => openModal(card));
    card.addEventListener('keydown', (event) => {
      if (event.key === 'Enter' || event.key === ' ') {
        event.preventDefault();
        openModal(card);
      }
    });

    card.dataset.modalIndex = index;
  });

  modalPrev?.addEventListener('click', () => openModalAt(modalIndex - 1));
  modalNext?.addEventListener('click', () => openModalAt(modalIndex + 1));

  modalRequest?.addEventListener('click', () => {
    const name = modalRequest.dataset.styleName || 'This style';
    const category = modalRequest.dataset.styleCategory || 'curtain style';
    const description = modalRequest.dataset.styleDescription || '';
    const visionField = document.getElementById('vision');
    const contactSection = document.getElementById('contact');

    if (visionField) {
      visionField.value = `I want to request ${name}${category ? ` (${category})` : ''}. ${description}`.trim();
      visionField.focus({ preventScroll: true });
    }

    contactSection?.scrollIntoView({ behavior: 'smooth', block: 'start' });
    closeModal();
  });

  modal?.querySelectorAll('[data-modal-close]').forEach(control => {
    control.addEventListener('click', closeModal);
  });

  window.addEventListener('keydown', (event) => {
    if (event.key === 'Escape') {
      closeModal();
    }
    if (!modal?.classList.contains('is-open')) return;
    if (event.key === 'ArrowLeft') {
      event.preventDefault();
      openModalAt(modalIndex - 1);
    }
    if (event.key === 'ArrowRight') {
      event.preventDefault();
      openModalAt(modalIndex + 1);
    }
  });

  console.log('LuxeCurtain Hub animations initialized');
});
