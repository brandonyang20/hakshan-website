/* Hakshan — page-specific JS: carousels, outlet modal, reservation form */
(function () {

  /* ============================================================
     GENERIC CAROUSEL
     Params: trackId, prevId, nextId, fillId, countId
     ============================================================ */
  function initCarousel(trackId, prevId, nextId, fillId, countId) {
    var track = document.getElementById(trackId);
    var prev  = document.getElementById(prevId);
    var next  = document.getElementById(nextId);
    var fill  = document.getElementById(fillId);
    var count = document.getElementById(countId);
    if (!track) return;

    var cards = track.children;

    function step() {
      var card  = cards[0];
      var style = getComputedStyle(track);
      var gap   = parseFloat(style.gap) || 24;
      return card.getBoundingClientRect().width + gap;
    }

    function update() {
      var s   = step();
      var idx = Math.round(track.scrollLeft / s);
      var max = Math.max(1, cards.length - 1);
      var pct = Math.min(100, (idx / max) * 100);
      if (fill)  fill.style.width = Math.max(10, pct) + '%';
      if (count) count.textContent = String(idx + 1).padStart(2, '0');
      if (prev)  prev.disabled = track.scrollLeft <= 4;
      if (next)  next.disabled = track.scrollLeft + track.clientWidth >= track.scrollWidth - 4;
    }

    if (prev) prev.addEventListener('click', function () { track.scrollBy({ left: -step(), behavior: 'smooth' }); });
    if (next) next.addEventListener('click', function () { track.scrollBy({ left:  step(), behavior: 'smooth' }); });
    track.addEventListener('scroll', update, { passive: true });
    window.addEventListener('resize', update);
    update();
  }

  /* ============================================================
     OUTLET MODAL
     OUTLETS object is expected to be defined on the page (PHP-rendered).
     ============================================================ */
  function initOutletModal() {
    var backdrop = document.getElementById('omBackdrop');
    if (!backdrop) return;
    var OUTLETS  = window.OUTLETS || {};

    function openOutlet(key) {
      var o = OUTLETS[key];
      if (!o) return;

      // Photo
      var ph = document.getElementById('omPh');
      if (ph) {
        if (o.photo) {
          ph.innerHTML = '<img src="' + escHtml(o.photo) + '" alt="' + escHtml(o.name) + '" />';
          ph.removeAttribute('data-label');
        } else {
          ph.setAttribute('data-label', o.name + ' · ' + o.city);
          ph.innerHTML = '';
        }
      }

      // Text fields
      setText('omCity',  o.city);
      setText('omTitle', o.name);
      setText('omCn',    o.cn);
      setText('omAddr',  o.addr);
      setText('omHours', o.hours);
      setText('omSeats', o.seats);
      setText('omPhone', o.phone);

      var dirLink = document.getElementById('omDir');
      if (dirLink && o.maps)  dirLink.href = o.maps;
      if (dirLink && !o.maps) dirLink.href = 'https://www.google.com/maps/search/?api=1&query=' + encodeURIComponent('Hakshan ' + o.name + ' ' + o.addr);

      backdrop.classList.add('is-open');
      backdrop.setAttribute('aria-hidden', 'false');
      document.body.style.overflow = 'hidden';
      history.replaceState(null, '', '#' + key);
    }

    function closeModal() {
      backdrop.classList.remove('is-open');
      backdrop.setAttribute('aria-hidden', 'true');
      document.body.style.overflow = '';
      if (location.hash) history.replaceState(null, '', location.pathname + location.search);
    }

    // Wire up grid cards and map-band links
    document.querySelectorAll('[data-open]').forEach(function (el) {
      el.addEventListener('click', function (e) {
        e.preventDefault();
        openOutlet(el.getAttribute('data-open'));
      });
    });

    var closeBtn = document.getElementById('omClose');
    if (closeBtn) closeBtn.addEventListener('click', closeModal);
    backdrop.addEventListener('click', function (e) { if (e.target === backdrop) closeModal(); });
    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape' && backdrop.classList.contains('is-open')) closeModal();
    });

    // Open from URL hash on load
    if (location.hash) {
      var key = location.hash.slice(1);
      if (OUTLETS[key]) setTimeout(function () { openOutlet(key); }, 150);
    }
  }

  /* ============================================================
     RESERVATION FORM — AJAX
     ============================================================ */
  function initReservationForm() {
    var form = document.getElementById('reservationForm');
    if (!form) return;

    // Outlet chip picker
    form.querySelectorAll('.pick-row .chip').forEach(function (chip) {
      chip.addEventListener('click', function () {
        form.querySelectorAll('.pick-row .chip').forEach(function (c) { c.classList.remove('is-on'); });
        chip.classList.add('is-on');
      });
    });

    form.addEventListener('submit', function (e) {
      e.preventDefault();
      var btn    = form.querySelector('[type="submit"]');
      var status = document.getElementById('reserveStatus');
      var selected = form.querySelector('.pick-row .chip.is-on');
      var outlet   = selected ? selected.getAttribute('data-val') : '';

      btn.disabled = true;
      btn.innerHTML = '<span data-en>Sending…</span><span data-zh>提交中…</span>';

      var data = new FormData();
      data.append('action',  'hakshan_reservation');
      data.append('nonce',   (window.HakshanData || {}).nonce || '');
      data.append('outlet',  outlet);
      data.append('date',    form.querySelector('[name="date"]').value);
      data.append('time',    form.querySelector('[name="time"]').value);
      data.append('party',   form.querySelector('[name="party"]').value);
      data.append('name',    form.querySelector('[name="name"]').value);
      data.append('phone',   form.querySelector('[name="phone"]').value);
      data.append('email',   form.querySelector('[name="email"]').value);
      data.append('notes',   form.querySelector('[name="notes"]').value);
      data.append('occasion',form.querySelector('[name="occasion"]').value);

      fetch((window.HakshanData || {}).ajaxUrl || '/wp-admin/admin-ajax.php', {
        method: 'POST', body: data
      })
      .then(function (r) { return r.json(); })
      .then(function (res) {
        if (status) {
          status.textContent = res.data && res.data.message ? res.data.message : (res.success ? 'Reservation received — we\'ll confirm shortly.' : 'Something went wrong. Please call +60 16-246 2970.');
          status.className = 'reserve-status ' + (res.success ? 'reserve-status--ok' : 'reserve-status--err');
        }
        if (res.success) form.reset();
      })
      .catch(function () {
        if (status) { status.textContent = 'Could not connect. Please call +60 16-246 2970.'; status.className = 'reserve-status reserve-status--err'; }
      })
      .finally(function () {
        btn.disabled = false;
        btn.innerHTML = '<span data-en>Reserve</span><span data-zh>提交预订</span><span class="arr">→</span>';
      });
    });
  }

  /* ============================================================
     TRAJECTORY CHART (investors page — pure CSS bars)
     ============================================================ */
  function initTrajChart() {
    var bars = document.querySelectorAll('.traj-bar[data-pct]');
    if (!bars.length) return;
    var io = new IntersectionObserver(function (entries) {
      entries.forEach(function (e) {
        if (e.isIntersecting) {
          e.target.style.height = e.target.getAttribute('data-pct') + '%';
          io.unobserve(e.target);
        }
      });
    }, { threshold: 0.3 });
    bars.forEach(function (b) { b.style.height = '0'; io.observe(b); });
  }

  /* ============================================================
     UTILITY
     ============================================================ */
  function setText(id, val) {
    var el = document.getElementById(id);
    if (el) el.textContent = val || '';
  }

  function escHtml(s) {
    return String(s).replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;');
  }

  /* ============================================================
     BOOT
     ============================================================ */
  function boot() {
    // Carousels (IDs expected on each page)
    initCarousel('scCarousel', 'scPrev', 'scNext', 'scFill', 'scCount');
    initCarousel('ocCarousel', 'ocPrev', 'ocNext', 'ocFill', 'ocCount');

    initOutletModal();
    initReservationForm();
    initTrajChart();
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', boot);
  } else {
    boot();
  }
})();
