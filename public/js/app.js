/* عين عربية — تفاعلات الواجهة
 * - زنبركات (springs) قابلة للمقاطعة، تبدأ دائمًا من القيمة الحالية وتورث سرعة اللمس.
 * - لا اعتماد على مكتبات خارجية.
 */
(() => {
  'use strict';

  const reduceMotion = matchMedia('(prefers-reduced-motion: reduce)');
  const $ = (s, r = document) => r.querySelector(s);
  const $$ = (s, r = document) => [...r.querySelectorAll(s)];

  /* ---------- زنبرك: response بالثواني، damping=1 بلا ارتداد ---------- */
  class Spring {
    constructor(value = 0, onUpdate = () => {}) {
      this.x = value; this.v = 0; this.target = value; this.onUpdate = onUpdate; this.raf = 0;
    }
    to(target, { response = .4, damping = 1, velocity } = {}) {
      this.target = target;
      if (velocity !== undefined) this.v = velocity;           // نقل سرعة الإيماءة (velocity handoff)
      if (reduceMotion.matches) { this.set(target); return Promise.resolve(); }
      cancelAnimationFrame(this.raf);
      const k = (2 * Math.PI / response) ** 2;                  // الصلابة
      const c = 4 * Math.PI * damping / response;               // التخميد
      let last = performance.now();
      return new Promise(resolve => {
        const tick = now => {
          const dt = Math.min((now - last) / 1000, 1 / 30); last = now;
          const a = -k * (this.x - this.target) - c * this.v;
          this.v += a * dt; this.x += this.v * dt;
          this.onUpdate(this.x);
          if (Math.abs(this.x - this.target) < .05 && Math.abs(this.v) < .05) {
            this.x = this.target; this.v = 0; this.onUpdate(this.x); resolve(); return;
          }
          this.raf = requestAnimationFrame(tick);
        };
        this.raf = requestAnimationFrame(tick);
      });
    }
    set(x) { cancelAnimationFrame(this.raf); this.x = this.target = x; this.v = 0; this.onUpdate(x); }
    stop() { cancelAnimationFrame(this.raf); }
  }

  // مسافة التوقف المتوقعة من سرعة الإفلات (نفس دالة Apple: انحلال أسي)
  const project = (v, rate = .998) => (v / 1000) * rate / (1 - rate);
  const rubber = (over, dim, k = .55) => (over * dim * k) / (dim + k * Math.abs(over));

  /* ---------- الهيدر ---------- */
  const header = $('[data-header]');
  if (header) {
    const on = () => header.classList.toggle('is-scrolled', scrollY > 24);
    on(); addEventListener('scroll', on, { passive: true });
  }

  /* القوائم المنسدلة (للمس ولوحة المفاتيح) */
  $$('.nav__drop').forEach(drop => {
    const btn = $('button', drop);
    btn.addEventListener('click', () => {
      const open = drop.classList.toggle('is-open');
      btn.setAttribute('aria-expanded', open);
    });
  });
  document.addEventListener('click', e => {
    $$('.nav__drop.is-open').forEach(d => { if (!d.contains(e.target)) { d.classList.remove('is-open'); $('button', d).setAttribute('aria-expanded', 'false'); } });
  });

  /* ---------- القائمة الجانبية / bottom sheet ---------- */
  const sheet = $('[data-sheet]'), scrim = $('[data-scrim]');
  if (sheet && scrim) {
    const toggle = $('[data-sheet-open]');
    const mobile = matchMedia('(max-width: 600px)');
    const rtl = getComputedStyle(sheet).direction === 'rtl';
    let isOpen = false;
    const axis = () => mobile.matches ? 'y' : 'x';
    const size = () => axis() === 'y' ? sheet.offsetHeight : sheet.offsetWidth;
    const sign = () => axis() === 'y' ? 1 : (rtl ? 1 : -1);      // اتجاه الإغلاق
    const closedAt = () => sign() * (size() + 24);

    const apply = p => {                                          // p = الإزاحة بالبكسل
      sheet.style.transform = axis() === 'y' ? `translate3d(0,${p}px,0)` : `translate3d(${p}px,0,0)`;
      const prog = 1 - Math.min(1, Math.max(0, Math.abs(p) / (size() || 1)));
      scrim.style.opacity = prog;
    };
    const sp = new Spring(0, apply);

    const focusables = () => $$('a[href],button:not([disabled]),input,select,textarea', sheet).filter(el => el.offsetParent !== null);
    const open = () => {
      if (isOpen) return; isOpen = true;
      sheet.hidden = false; scrim.hidden = false;
      sp.set(closedAt());
      document.body.classList.add('is-locked');
      toggle?.setAttribute('aria-expanded', 'true');
      sp.to(0, { response: .42, damping: 1 });
      setTimeout(() => focusables()[0]?.focus({ preventScroll: true }), 60);
    };
    const close = (velocity) => {
      if (!isOpen) return; isOpen = false;
      toggle?.setAttribute('aria-expanded', 'false');
      document.body.classList.remove('is-locked');
      sp.to(closedAt(), { response: .38, damping: 1, velocity }).then(() => { if (!isOpen) { sheet.hidden = true; scrim.hidden = true; } });
      toggle?.focus({ preventScroll: true });
    };
    toggle?.addEventListener('click', open);
    $('[data-sheet-close]', sheet)?.addEventListener('click', () => close());
    scrim.addEventListener('click', () => close());
    $$('a', sheet).forEach(a => a.addEventListener('click', () => close()));
    addEventListener('keydown', e => {
      if (!isOpen) return;
      if (e.key === 'Escape') close();
      if (e.key === 'Tab') {                                       // حبس التركيز داخل القائمة
        const f = focusables(); if (!f.length) return;
        const first = f[0], last = f[f.length - 1];
        if (e.shiftKey && document.activeElement === first) { e.preventDefault(); last.focus(); }
        else if (!e.shiftKey && document.activeElement === last) { e.preventDefault(); first.focus(); }
      }
    });
    addEventListener('resize', () => { if (isOpen && !mobile.matches && innerWidth > 1100) close(); });

    /* سحب القائمة لإغلاقها: تتبع 1:1 + إسقاط الزخم + ارتداد عند الحد */
    const handle = $('.sheet__head', sheet), grip = $('.sheet__grip', sheet);
    [handle, grip].forEach(h => h && h.addEventListener('pointerdown', e => {
      if (e.target.closest('button')) return;
      sp.stop(); h.setPointerCapture(e.pointerId);
      const startPos = axis() === 'y' ? e.clientY : e.clientX, startX = sp.x, hist = [{ t: e.timeStamp, p: startPos }];
      const move = ev => {
        const pos = axis() === 'y' ? ev.clientY : ev.clientX;
        hist.push({ t: ev.timeStamp, p: pos }); if (hist.length > 6) hist.shift();
        let d = startX + (pos - startPos);
        const dir = sign(); const toward = d * dir;                // موجب = باتجاه الإغلاق
        if (toward < 0) d = -dir * rubber(-toward, size());        // مقاومة تدريجية عكس الاتجاه
        sp.x = d; apply(d);
      };
      const up = ev => {
        h.removeEventListener('pointermove', move); h.removeEventListener('pointerup', up); h.removeEventListener('pointercancel', up);
        const a = hist[0], b = hist[hist.length - 1];
        const v = b.t > a.t ? (b.p - a.p) / (b.t - a.t) * 1000 : 0; // بكسل/ثانية
        const end = sp.x + project(v);
        const shouldClose = end * sign() > size() * .5;
        sp.v = v;
        if (shouldClose) { isOpen = true; close(v); } else sp.to(0, { response: .32, damping: .85, velocity: v });
      };
      h.addEventListener('pointermove', move); h.addEventListener('pointerup', up); h.addEventListener('pointercancel', up);
    }));
    if (handle) handle.style.touchAction = 'none';
    if (grip) grip.style.touchAction = 'none';
  }

  /* ---------- شريط الأقسام: سحب بالماوس مع زخم ---------- */
  $$('[data-rail]').forEach(track => {
    let dragging = false, moved = 0, startX = 0, startScroll = 0, hist = [], raf = 0;
    track.addEventListener('pointerdown', e => {
      moved = 0;
      if (e.pointerType !== 'mouse' || e.button !== 0) return;      // اللمس يستخدم التمرير الأصلي
      cancelAnimationFrame(raf);
      dragging = true; moved = 0; startX = e.clientX; startScroll = track.scrollLeft; hist = [{ t: e.timeStamp, x: e.clientX }];
    });
    addEventListener('pointermove', e => {
      if (!dragging) return;
      const dx = e.clientX - startX; moved = Math.max(moved, Math.abs(dx));
      if (moved > 6) track.classList.add('is-dragging');           // عتبة حركة قبل الالتزام بالسحب
      track.scrollLeft = startScroll - dx;
      hist.push({ t: e.timeStamp, x: e.clientX }); if (hist.length > 6) hist.shift();
    });
    const end = () => {
      if (!dragging) return; dragging = false;
      const a = hist[0], b = hist[hist.length - 1];
      let v = b.t > a.t ? -(b.x - a.x) / (b.t - a.t) * 1000 : 0;    // بكسل/ثانية في اتجاه scrollLeft
      if (!reduceMotion.matches && Math.abs(v) > 60) {
        let last = performance.now();
        const step = now => {
          const dt = (now - last) / 1000; last = now;
          track.scrollLeft += v * dt; v *= Math.pow(.002, dt);      // انحلال أسي مماثل لتمرير iOS
          if (Math.abs(v) > 8) raf = requestAnimationFrame(step); else track.classList.remove('is-dragging');
        };
        raf = requestAnimationFrame(step);
      } else track.classList.remove('is-dragging');
      setTimeout(() => { if (!raf) track.classList.remove('is-dragging'); }, 0);
    };
    addEventListener('pointerup', end); addEventListener('pointercancel', end);
    track.addEventListener('click', e => { if (moved > 6) { e.preventDefault(); e.stopPropagation(); } }, true);
    track.addEventListener('wheel', () => cancelAnimationFrame(raf), { passive: true });
    // مركز العنصر النشط
    const active = $('.is-active', track);
    if (active) {                                                    // يعمل في RTL وLTR لأن scrollLeft يزيد دائمًا نحو اليمين
      const a = active.getBoundingClientRect(), t = track.getBoundingClientRect();
      track.scrollLeft += (a.left + a.width / 2) - (t.left + t.width / 2);
    }
  });

  /* ---------- ظهور العناصر عند التمرير ---------- */
  const items = $$('.reveal');
  if ('IntersectionObserver' in window && !reduceMotion.matches) {
    const io = new IntersectionObserver(es => es.forEach(e => { if (e.isIntersecting) { e.target.classList.add('is-in'); io.unobserve(e.target); } }), { rootMargin: '0px 0px -8% 0px', threshold: .08 });
    items.forEach(el => io.observe(el));
  } else items.forEach(el => el.classList.add('is-in'));

  /* ---------- بطاقات الهيرو: انجراف خفيف مع المؤشر ---------- */
  const hero = $('[data-parallax]');
  if (hero && !reduceMotion.matches && matchMedia('(hover: hover)').matches) {
    const cards = $$('[data-depth]', hero).map(el => {
      const d = parseFloat(el.dataset.depth);
      const sx = new Spring(0, () => paint()), sy = new Spring(0, () => paint());
      const paint = () => { el.style.transform = `translate3d(${sx.x}px,${sy.x}px,0)`; };
      return { d, sx, sy };
    });
    hero.addEventListener('pointermove', e => {
      const r = hero.getBoundingClientRect();
      const nx = (e.clientX - r.left) / r.width - .5, ny = (e.clientY - r.top) / r.height - .5;
      cards.forEach(c => { c.sx.to(nx * c.d, { response: .6 }); c.sy.to(ny * c.d, { response: .6 }); });
    });
    hero.addEventListener('pointerleave', () => cards.forEach(c => { c.sx.to(0, { response: .6 }); c.sy.to(0, { response: .6 }); }));
  }

  /* ---------- رسالة النجاح ---------- */
  const toast = $('[data-toast]');
  if (toast) setTimeout(() => { toast.style.transition = 'opacity .4s, transform .4s'; toast.style.opacity = 0; toast.style.transform = 'translateY(12px)'; setTimeout(() => toast.remove(), 450); }, 5200);
})();
