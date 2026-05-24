/* Hakshan — shared shell: language toggle, reveal-on-scroll, mobile drawer */
(function () {
  const STORAGE_KEY = 'hakshan-lang';

  // ---------- Language ----------
  function setLang(lang) {
    document.body.setAttribute('data-lang', lang);
    try { localStorage.setItem(STORAGE_KEY, lang); } catch (e) {}
    document.querySelectorAll('[data-lang-btn]').forEach(b => {
      b.classList.toggle('is-on', b.getAttribute('data-lang-btn') === lang);
    });
  }

  function initLang() {
    let lang = 'en';
    try { lang = localStorage.getItem(STORAGE_KEY) || 'en'; } catch (e) {}
    setLang(lang);
    document.querySelectorAll('[data-lang-btn]').forEach(b => {
      b.addEventListener('click', () => setLang(b.getAttribute('data-lang-btn')));
    });
  }

  // ---------- Reveal on scroll ----------
  function initReveal() {
    const els = document.querySelectorAll('[data-reveal]');
    const vh = window.innerHeight || document.documentElement.clientHeight;

    // Elements already in view → reveal immediately
    els.forEach(el => {
      const r = el.getBoundingClientRect();
      if (r.top < vh * 0.9 && r.bottom > 0) {
        el.classList.add('is-in');
        el.setAttribute('data-revealed', '');
      }
    });

    if (!('IntersectionObserver' in window)) {
      els.forEach(el => el.classList.add('is-in'));
      return;
    }

    const io = new IntersectionObserver((entries) => {
      entries.forEach(e => {
        if (e.isIntersecting) {
          e.target.classList.add('is-in');
          io.unobserve(e.target);
        }
      });
    }, { threshold: 0.12, rootMargin: '0px 0px -40px 0px' });

    els.forEach(el => {
      if (!el.hasAttribute('data-revealed')) io.observe(el);
    });

    // Fallback: show anything still in view after 600ms
    setTimeout(() => {
      els.forEach(el => {
        if (!el.classList.contains('is-in')) {
          const r = el.getBoundingClientRect();
          if (r.top < vh && r.bottom > 0) el.classList.add('is-in');
        }
      });
    }, 600);
  }

  // ---------- Active nav ----------
  function initActiveNav() {
    const path = location.pathname.replace(/\/$/, '').toLowerCase();
    document.querySelectorAll('.nav__links a, .drawer__links a').forEach(a => {
      const href = (a.getAttribute('href') || '').replace(/\/$/, '').toLowerCase();
      if (href && path.endsWith(href.replace(location.origin, ''))) {
        a.classList.add('is-active');
      }
    });
  }

  // ---------- Mobile drawer ----------
  function initDrawer() {
    const burger = document.querySelector('.nav__burger');
    const drawer = document.querySelector('.drawer');
    if (!burger || !drawer) return;
    const closeBtn  = drawer.querySelector('.drawer__close');
    const backdrop  = drawer.querySelector('.drawer__backdrop');

    function open()  {
      drawer.classList.add('is-open');
      drawer.setAttribute('aria-hidden', 'false');
      burger.setAttribute('aria-expanded', 'true');
      document.body.classList.add('drawer-open');
    }
    function close() {
      drawer.classList.remove('is-open');
      drawer.setAttribute('aria-hidden', 'true');
      burger.setAttribute('aria-expanded', 'false');
      document.body.classList.remove('drawer-open');
    }

    burger.addEventListener('click', open);
    if (closeBtn) closeBtn.addEventListener('click', close);
    if (backdrop) backdrop.addEventListener('click', close);
    drawer.querySelectorAll('.drawer__links a, .drawer__cta').forEach(a => {
      a.addEventListener('click', () => setTimeout(close, 80));
    });
    document.addEventListener('keydown', e => {
      if (e.key === 'Escape' && drawer.classList.contains('is-open')) close();
    });
    window.addEventListener('resize', () => {
      if (window.innerWidth > 800 && drawer.classList.contains('is-open')) close();
    });
  }

  // ---------- Sticky menu TOC highlight ----------
  function initMenuToc() {
    const toc = document.querySelector('.menu-toc');
    if (!toc) return;
    const links = toc.querySelectorAll('a[href^="#"]');
    if (!links.length) return;

    const sections = Array.from(links).map(a => document.querySelector(a.getAttribute('href'))).filter(Boolean);

    const io = new IntersectionObserver((entries) => {
      entries.forEach(e => {
        if (e.isIntersecting) {
          links.forEach(a => a.classList.toggle('is-active', a.getAttribute('href') === '#' + e.target.id));
        }
      });
    }, { rootMargin: '-20% 0px -70% 0px' });

    sections.forEach(s => io.observe(s));
  }

  function boot() {
    initLang();
    initReveal();
    initActiveNav();
    initDrawer();
    initMenuToc();
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', boot);
  } else {
    boot();
  }
})();
