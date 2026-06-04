/* Shared shell helpers: language toggle + reveal-on-scroll */
(function () {
  // ---------- Language ----------
  const STORAGE_KEY = "hakshan-lang";
  function setLang(lang) {
    document.body.setAttribute("data-lang", lang);
    try { localStorage.setItem(STORAGE_KEY, lang); } catch (e) {}
    document.querySelectorAll("[data-lang-btn]").forEach(b => {
      b.classList.toggle("is-on", b.getAttribute("data-lang-btn") === lang);
    });
  }
  function initLang() {
    let lang = "en";
    try { lang = localStorage.getItem(STORAGE_KEY) || "en"; } catch (e) {}
    setLang(lang);
    document.querySelectorAll("[data-lang-btn]").forEach(b => {
      b.addEventListener("click", () => setLang(b.getAttribute("data-lang-btn")));
    });
  }

  // ---------- Reveal on scroll ----------
  function initReveal() {
    const els = document.querySelectorAll("[data-reveal]");
    const vh = window.innerHeight || document.documentElement.clientHeight;

    // Pass 1 — anything already (mostly) in view reveals immediately,
    // so the page never paints blank above the fold.
    els.forEach(el => {
      const r = el.getBoundingClientRect();
      if (r.top < vh * 0.9 && r.bottom > 0) {
        el.classList.add("is-in");
        el.setAttribute("data-revealed", "");
      }
    });

    if (!("IntersectionObserver" in window)) {
      els.forEach(el => el.classList.add("is-in"));
      return;
    }
    const io = new IntersectionObserver((entries) => {
      entries.forEach(e => {
        if (e.isIntersecting) {
          e.target.classList.add("is-in");
          io.unobserve(e.target);
        }
      });
    }, { threshold: 0.12, rootMargin: "0px 0px -40px 0px" });
    // Only observe elements that aren't already revealed
    els.forEach(el => { if (!el.hasAttribute("data-revealed")) io.observe(el); });

    // Belt + suspenders: if for any reason IO never fires within a beat,
    // reveal everything still hidden so content is never stuck invisible.
    setTimeout(() => {
      els.forEach(el => {
        if (!el.classList.contains("is-in")) {
          const r = el.getBoundingClientRect();
          if (r.top < vh && r.bottom > 0) el.classList.add("is-in");
        }
      });
    }, 600);
  }

  // ---------- Mark active nav link ----------
  function initActiveNav() {
    const file = (location.pathname.split("/").pop() || "index.html").toLowerCase();
    document.querySelectorAll(".nav__links a, .drawer__links a").forEach(a => {
      const href = (a.getAttribute("href") || "").toLowerCase();
      if (href === file) a.classList.add("is-active");
    });
  }

  // ---------- Mobile drawer ----------
  function initDrawer() {
    const burger = document.querySelector(".nav__burger");
    const drawer = document.querySelector(".drawer");
    if (!burger || !drawer) return;
    const closeBtn = drawer.querySelector(".drawer__close");
    const backdrop = drawer.querySelector(".drawer__backdrop");

    function open() {
      drawer.classList.add("is-open");
      drawer.setAttribute("aria-hidden", "false");
      burger.setAttribute("aria-expanded", "true");
      document.body.classList.add("drawer-open");
    }
    function close() {
      drawer.classList.remove("is-open");
      drawer.setAttribute("aria-hidden", "true");
      burger.setAttribute("aria-expanded", "false");
      document.body.classList.remove("drawer-open");
    }

    burger.addEventListener("click", open);
    if (closeBtn) closeBtn.addEventListener("click", close);
    if (backdrop) backdrop.addEventListener("click", close);
    // Close on any nav-link tap inside the drawer (in case the link is a hash anchor)
    drawer.querySelectorAll(".drawer__links a, .drawer__cta").forEach(a => {
      a.addEventListener("click", () => setTimeout(close, 80));
    });
    // Close on Escape
    document.addEventListener("keydown", (e) => {
      if (e.key === "Escape" && drawer.classList.contains("is-open")) close();
    });
    // Close when resizing past mobile breakpoint
    window.addEventListener("resize", () => {
      if (window.innerWidth > 800 && drawer.classList.contains("is-open")) close();
    });
  }

  function initMenuToc() {
    const track = document.querySelector(".menu-toc__inner");
    if (!track) return;

    let isDown = false;
    let startX = 0;
    let startScroll = 0;
    let moved = false;
    let activePointerId = null;

    track.addEventListener("pointerdown", (e) => {
      // Ignore non-primary mouse buttons; allow touch and pen.
      if (e.pointerType === "mouse" && e.button !== 0) return;
      isDown = true;
      moved = false;
      startX = e.clientX;
      startScroll = track.scrollLeft;
      activePointerId = e.pointerId;
      try { track.setPointerCapture(e.pointerId); } catch (_) {}
      track.classList.add("is-dragging");
    });

    track.addEventListener("pointermove", (e) => {
      if (!isDown || e.pointerId !== activePointerId) return;
      const delta = e.clientX - startX;
      if (Math.abs(delta) > 4) moved = true;
      track.scrollLeft = startScroll - delta;
    });

    const endGesture = (e) => {
      if (e.pointerId !== activePointerId) return;
      isDown = false;
      activePointerId = null;
      track.classList.remove("is-dragging");
      try { track.releasePointerCapture(e.pointerId); } catch (_) {}
    };
    track.addEventListener("pointerup", endGesture);
    track.addEventListener("pointercancel", endGesture);

    // Suppress link navigation when the gesture was a drag, not a tap/click.
    track.querySelectorAll("a").forEach((a) => {
      a.addEventListener("click", (e) => {
        if (moved) {
          e.preventDefault();
          moved = false;
        }
      });
    });
  }

  function boot() {
    initLang();
    initReveal();
    initActiveNav();
    initDrawer();
    initMenuToc();
  }
  if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", boot);
  } else {
    boot();
  }
})();
