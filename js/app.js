/**
 * ============================================================
 *  DIYAR ESTATES — Main JavaScript
 *  www.diyarestes.com
 * ============================================================
 */

(function () {
  'use strict';

  /* ===================================================
   *  1. NAVIGATION — scroll effect + mobile menu
   * =================================================== */
  const navbar     = document.getElementById('navbar');
  const menuBtn    = document.getElementById('menuBtn');
  const closeBtn   = document.getElementById('closeMenuBtn');
  const mobileMenu = document.getElementById('mobileMenu');

  // Sticky nav on scroll
  if (navbar) {
    const onScroll = () => {
      navbar.classList.toggle('scrolled', window.scrollY > 60);
    };
    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll(); // run once on load
  }

  // Open mobile menu
  if (menuBtn && mobileMenu) {
    menuBtn.addEventListener('click', () => {
      mobileMenu.classList.add('open');
      document.body.style.overflow = 'hidden';
    });
  }

  // Close mobile menu
  const closeMenu = () => {
    if (mobileMenu) {
      mobileMenu.classList.remove('open');
      document.body.style.overflow = '';
    }
  };
  if (closeBtn) closeBtn.addEventListener('click', closeMenu);
  document.querySelectorAll('#mobileMenu a').forEach(a => a.addEventListener('click', closeMenu));

  /* ===================================================
   *  2. SCROLL REVEAL — IntersectionObserver
   * =================================================== */
  const revealSelectors = '[data-reveal], [data-reveal-left], [data-reveal-right]';
  const revealEls = document.querySelectorAll(revealSelectors);

  if (revealEls.length) {
    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          const el    = entry.target;
          const delay = parseInt(el.dataset.delay || '0', 10);
          setTimeout(() => el.classList.add('revealed'), delay);
          observer.unobserve(el);
        }
      });
    }, { threshold: 0.1, rootMargin: '0px 0px -60px 0px' });

    revealEls.forEach(el => observer.observe(el));
  }

  /* ===================================================
   *  3. COUNTER ANIMATION
   * =================================================== */
  const counters = document.querySelectorAll('[data-counter]');

  const animateCounter = (el) => {
    const target   = parseFloat(el.dataset.counter);
    const prefix   = el.dataset.prefix  || '';
    const suffix   = el.dataset.suffix  || '';
    const decimals = Number.isInteger(target) ? 0 : 1;
    const duration = 2200;
    const start    = performance.now();

    const step = (timestamp) => {
      const progress = Math.min((timestamp - start) / duration, 1);
      const eased    = 1 - Math.pow(1 - progress, 3); // ease-out-cubic
      const val      = eased * target;
      el.textContent = prefix + val.toFixed(decimals) + suffix;
      if (progress < 1) requestAnimationFrame(step);
      else el.textContent = prefix + target.toFixed(decimals) + suffix;
    };
    requestAnimationFrame(step);
  };

  if (counters.length) {
    const cObserver = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting && !entry.target.dataset.counted) {
          entry.target.dataset.counted = 'true';
          animateCounter(entry.target);
        }
      });
    }, { threshold: 0.6 });
    counters.forEach(el => cObserver.observe(el));
  }

  /* ===================================================
   *  4. ACCORDION / FAQ
   * =================================================== */
  document.querySelectorAll('.accordion-trigger').forEach(trigger => {
    trigger.addEventListener('click', () => {
      const item    = trigger.closest('.accordion-item');
      const body    = item.querySelector('.accordion-body');
      const inner   = item.querySelector('.accordion-inner');
      const isOpen  = item.classList.contains('active');

      // Close all
      document.querySelectorAll('.accordion-item.active').forEach(open => {
        open.classList.remove('active');
        const b = open.querySelector('.accordion-body');
        if (b) b.style.maxHeight = '0';
      });

      // Toggle clicked
      if (!isOpen) {
        item.classList.add('active');
        if (body && inner) body.style.maxHeight = inner.scrollHeight + 'px';
      }
    });
  });

  /* ===================================================
   *  5. GALLERY LIGHTBOX
   * =================================================== */
  const galleryItems = document.querySelectorAll('.gallery-item[data-lightbox]');

  if (galleryItems.length) {
    // Build modal once
    const lbModal = document.createElement('div');
    lbModal.className = 'modal-overlay';
    lbModal.id = 'lightboxModal';
    lbModal.innerHTML = `
      <button class="modal-close" id="lbClose" aria-label="Close">&times;</button>
      <img id="lbImg" src="" alt="" style="max-width:92vw; max-height:88vh; object-fit:contain; display:block;">
    `;
    document.body.appendChild(lbModal);

    const lbImg   = lbModal.querySelector('#lbImg');
    const lbClose = lbModal.querySelector('#lbClose');

    const openLb  = (src, alt) => { lbImg.src = src; lbImg.alt = alt; lbModal.classList.add('open'); document.body.style.overflow = 'hidden'; };
    const closeLb = () => { lbModal.classList.remove('open'); document.body.style.overflow = ''; };

    galleryItems.forEach(item => {
      item.addEventListener('click', () => {
        const img = item.querySelector('img');
        if (img) openLb(img.src, img.alt);
      });
    });

    lbClose.addEventListener('click', closeLb);
    lbModal.addEventListener('click', e => { if (e.target === lbModal) closeLb(); });
    document.addEventListener('keydown', e => { if (e.key === 'Escape') closeLb(); });
  }

  /* ===================================================
   *  6. VIDEO MODAL
   * =================================================== */
  document.querySelectorAll('[data-video]').forEach(trigger => {
    trigger.addEventListener('click', () => {
      const url = trigger.dataset.video;
      const vm  = document.createElement('div');
      vm.className = 'modal-overlay open';
      vm.innerHTML = `
        <button class="modal-close" style="top:16px;right:24px;" aria-label="Close">&times;</button>
        <div style="width:900px;max-width:95vw;">
          <div style="position:relative;padding-bottom:56.25%;">
            <iframe src="${url}?autoplay=1&rel=0" allowfullscreen
              style="position:absolute;inset:0;width:100%;height:100%;border:none;"
              allow="autoplay;encrypted-media"></iframe>
          </div>
        </div>
      `;
      document.body.appendChild(vm);
      document.body.style.overflow = 'hidden';
      vm.querySelector('.modal-close').addEventListener('click', () => { vm.remove(); document.body.style.overflow = ''; });
      vm.addEventListener('click', e => { if (e.target === vm) { vm.remove(); document.body.style.overflow = ''; } });
    });
  });

  /* ===================================================
   *  7. SMOOTH ANCHOR SCROLL
   * =================================================== */
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
      const id = this.getAttribute('href');
      if (id === '#') return;
      const target = document.querySelector(id);
      if (target) {
        e.preventDefault();
        const top = target.getBoundingClientRect().top + window.scrollY - 90;
        window.scrollTo({ top, behavior: 'smooth' });
      }
    });
  });

  /* ===================================================
   *  8. FORM VALIDATION & FEEDBACK
   * =================================================== */
  document.querySelectorAll('form[data-form]').forEach(form => {
    form.addEventListener('submit', e => {
      e.preventDefault();
      let valid = true;

      form.querySelectorAll('[required]').forEach(field => {
        if (!field.value.trim()) {
          valid = false;
          field.style.borderColor = '#E53E3E';
          field.addEventListener('input', () => { field.style.borderColor = ''; }, { once: true });
        }
      });

      if (!valid) return;

      const btn = form.querySelector('[type="submit"]');
      const orig = btn.textContent;
      btn.textContent = 'Sending…';
      btn.disabled = true;

      // Simulate async (replace with real fetch in Laravel)
      setTimeout(() => {
        btn.textContent = 'Message Sent ✓';
        btn.style.cssText = 'background:rgba(72,187,120,0.15);border-color:#48BB78;color:#48BB78;';
        form.reset();
        setTimeout(() => {
          btn.textContent = orig;
          btn.disabled = false;
          btn.style.cssText = '';
        }, 3500);
      }, 1400);
    });
  });

  /* ===================================================
   *  9. TAB SWITCHER
   * =================================================== */
  document.querySelectorAll('[data-tabs]').forEach(group => {
    const btns   = group.querySelectorAll('.tab-btn');
    const panels = group.querySelectorAll('[data-panel]');

    // Show first panel by default
    if (panels.length) {
      panels.forEach((p, i) => p.style.display = i === 0 ? '' : 'none');
    }

    btns.forEach(btn => {
      btn.addEventListener('click', () => {
        const target = btn.dataset.tab;
        btns.forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
        panels.forEach(p => p.style.display = p.dataset.panel === target ? '' : 'none');
      });
    });
  });

  /* ===================================================
   *  10. DOWNLOAD BROCHURE (placeholder)
   * =================================================== */
  document.querySelectorAll('[data-download]').forEach(btn => {
    btn.addEventListener('click', e => {
      e.preventDefault();
      const label = btn.dataset.download || 'DIYAR_Estates_Brochure';
      // In Laravel: window.location.href = '/downloads/' + label + '.pdf';
      console.info('Download triggered:', label);
      btn.textContent = 'Preparing Download…';
      setTimeout(() => { btn.textContent = btn.dataset.label || 'Download Brochure'; }, 2000);
    });
  });

})();
