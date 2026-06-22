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
  function detectBrowserLang() {
    // Returns "zh" if the browser's preferred language is any Chinese variant
    // (zh-CN, zh-TW, zh-HK, zh-Hans, zh-Hant…), otherwise "en". Falls through
    // safely on browsers where navigator.languages is missing.
    var candidates = [];
    if (navigator && navigator.languages && navigator.languages.length) {
      candidates = navigator.languages;
    } else if (navigator && navigator.language) {
      candidates = [navigator.language];
    }
    for (var i = 0; i < candidates.length; i++) {
      if (typeof candidates[i] === "string" && candidates[i].toLowerCase().indexOf("zh") === 0) {
        return "zh";
      }
    }
    return "en";
  }
  function initLang() {
    var saved = null;
    try { saved = localStorage.getItem(STORAGE_KEY); } catch (e) {}
    // If the user has already picked a language, that always wins. Otherwise
    // fall back to the browser's preferred language on first visit.
    var lang = saved || detectBrowserLang();
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

  // Live nav height as a CSS custom property on :root — read by any
  // sticky element that needs to dock under the nav (the menu TOC, the
  // story timeline left column, etc.). Runs on every page, not just
  // those that have a .menu-toc.
  function initNavHeightVar() {
    const nav = document.querySelector(".nav");
    if (!nav) return;
    const update = () => {
      const navH = Math.round(nav.getBoundingClientRect().height);
      document.documentElement.style.setProperty("--nav-h", navH + "px");
    };
    update();
    window.addEventListener("resize", update);
    window.addEventListener("load", update);
  }

  function initMenuToc() {
    const toc = document.querySelector(".menu-toc");
    const track = toc ? toc.querySelector(".menu-toc__inner") : null;
    if (!toc || !track) return;

    // Smooth-scroll a section to just below the sticky nav + sticky TOC.
    // Done manually (rather than relying on native #hash jumps) so the
    // landing position is always correct regardless of the two stacked
    // sticky bars, and so it works even though the drag handler below
    // suppresses the default anchor behaviour.
    const scrollToSection = (section) => {
      const navH = parseInt(
        getComputedStyle(document.documentElement).getPropertyValue("--nav-h"),
        10
      ) || 65;
      const tocH = toc.getBoundingClientRect().height;
      const y = section.getBoundingClientRect().top + window.scrollY - navH - tocH - 8;
      window.scrollTo({ top: Math.max(0, y), behavior: "smooth" });
    };

    // 1) Drag-to-scroll for MOUSE only. Touch + pen get native pan-x
    //    horizontal scrolling for free (overflow-x:auto + touch-action),
    //    so we don't double-handle them. Crucially we do NOT use
    //    setPointerCapture here — capturing the pointer retargets the
    //    subsequent click event to the track, which would swallow the
    //    link navigation entirely.
    let isDown = false;
    let startX = 0;
    let startScroll = 0;
    let moved = false;

    track.addEventListener("pointerdown", (e) => {
      if (e.pointerType !== "mouse") return;
      if (e.button !== 0) return;
      isDown = true;
      moved = false;
      startX = e.clientX;
      startScroll = track.scrollLeft;
      track.classList.add("is-dragging");
    });

    window.addEventListener("pointermove", (e) => {
      if (!isDown) return;
      const delta = e.clientX - startX;
      if (Math.abs(delta) > 6) moved = true;
      if (moved) track.scrollLeft = startScroll - delta;
    });

    const endGesture = () => {
      if (!isDown) return;
      isDown = false;
      track.classList.remove("is-dragging");
    };
    window.addEventListener("pointerup", endGesture);
    window.addEventListener("pointercancel", endGesture);

    // 2) Wheel → horizontal scroll, so a desktop scroll wheel / trackpad
    //    moves the filter sideways instead of being stuck. Hand vertical
    //    intent back to the page once the track hits either end.
    track.addEventListener(
      "wheel",
      (e) => {
        if (track.scrollWidth <= track.clientWidth) return;
        const dy = e.deltaY;
        if (dy === 0) return;
        const atStart = track.scrollLeft <= 0;
        const atEnd = track.scrollLeft + track.clientWidth >= track.scrollWidth - 1;
        if ((dy < 0 && atStart) || (dy > 0 && atEnd)) return;
        e.preventDefault();
        track.scrollLeft += dy;
      },
      { passive: false }
    );

    // 3) Click → controlled scroll. Delegated so it works no matter what
    //    the click target is; suppressed only after a genuine drag.
    track.addEventListener("click", (e) => {
      const a = e.target.closest("a[href^='#']");
      if (!a) return;
      e.preventDefault();
      if (moved) {
        moved = false;
        return;
      }
      const href = a.getAttribute("href");
      let section = null;
      try { section = document.querySelector(href); } catch (_) {}
      if (section) {
        scrollToSection(section);
        if (history.replaceState) history.replaceState(null, "", href);
      }
    });

    // 2) Scrollspy — highlight the link for the section currently under
    //    the sticky TOC. Walks all targets on every scroll tick (rAF
    //    throttled) instead of using IntersectionObserver, because
    //    sticky elements break naive root-based intersection logic.
    const links = Array.from(track.querySelectorAll("a[href^='#']"));
    const targets = [];
    for (const a of links) {
      const href = a.getAttribute("href");
      if (!href || href.length < 2) continue;
      let section = null;
      try { section = document.querySelector(href); } catch (_) {}
      if (section) targets.push({ a, section });
    }
    if (!targets.length) return;

    let activeLink = null;
    const setActive = (link) => {
      if (link === activeLink) return;
      activeLink = link;
      links.forEach((l) => l.classList.toggle("is-active", l === link));
      if (!link) return;
      const linkRect = link.getBoundingClientRect();
      const trackRect = track.getBoundingClientRect();
      if (linkRect.left < trackRect.left + 24 || linkRect.right > trackRect.right - 24) {
        const offset = link.offsetLeft - track.clientWidth / 2 + link.clientWidth / 2;
        track.scrollTo({ left: offset, behavior: "smooth" });
      }
    };

    const recomputeActive = () => {
      const tocBottom = toc.getBoundingClientRect().bottom;
      // Pick the LAST section whose top has crossed below the TOC bottom
      // (with a 4px lead-in so the active flips right as the heading
      // touches the TOC).
      let current = targets[0];
      for (const t of targets) {
        const top = t.section.getBoundingClientRect().top;
        if (top - tocBottom <= 4) {
          current = t;
        } else {
          break;
        }
      }
      setActive(current.a);
    };

    let rafId = null;
    const queueRecompute = () => {
      if (rafId !== null) return;
      rafId = window.requestAnimationFrame(() => {
        rafId = null;
        recomputeActive();
      });
    };

    window.addEventListener("scroll", queueRecompute, { passive: true });
    window.addEventListener("resize", queueRecompute);
    window.addEventListener("load", queueRecompute);
    recomputeActive();
  }

  // ---------- Tag bilingual spans with their language ----------
  // Helps search engines understand which span is which language without
  // requiring a per-template `lang="..."` attribute on every node.
  function initLangAttrs() {
    document.querySelectorAll("[data-en]:not([lang])").forEach(el => el.setAttribute("lang", "en"));
    document.querySelectorAll("[data-zh]:not([lang])").forEach(el => el.setAttribute("lang", "zh-Hans"));
  }

  function boot() {
    initLang();
    initLangAttrs();
    initReveal();
    initActiveNav();
    initDrawer();
    initNavHeightVar();
    initMenuToc();
  }
  if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", boot);
  } else {
    boot();
  }
})();
