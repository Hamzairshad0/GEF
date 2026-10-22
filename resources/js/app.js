// Front-end interactions for the Ghazali Education Foundation site (no framework).

const $ = (sel, root = document) => root.querySelector(sel);
const $$ = (sel, root = document) => [...root.querySelectorAll(sel)];
const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

/* ---------- Header: solid on scroll, floats over the hero on the home page ---------- */
function initHeader() {
    const header = $('[data-header]');
    if (!header) return;
    const overHero = header.dataset.overHero === 'true';
    const onScroll = () => {
        const scrolled = window.scrollY > 60;
        header.classList.toggle('is-scrolled', scrolled);
        header.classList.toggle('shadow-lg', scrolled);
        $('[data-header-inner]', header).classList.toggle('h-16', scrolled);
        $('[data-header-inner]', header).classList.toggle('h-20', !scrolled);
        if (overHero) {
            header.classList.toggle('fixed', scrolled);
            header.classList.toggle('absolute', !scrolled);
            header.classList.toggle('md:top-10', !scrolled);
        }
    };
    onScroll();
    window.addEventListener('scroll', onScroll, { passive: true });
}

/* ---------- Mobile menu drawer ---------- */
function initMenu() {
    const menu = $('[data-menu]');
    if (!menu) return;
    const panel = $('[data-menu-panel]', menu);
    const overlay = $('[data-menu-overlay]', menu);
    const open = () => {
        menu.hidden = false;
        document.body.style.overflow = 'hidden';
        requestAnimationFrame(() => {
            panel.classList.remove('translate-x-full');
            overlay.classList.remove('opacity-0');
        });
        $('[data-menu-close]', menu).focus();
    };
    const close = () => {
        panel.classList.add('translate-x-full');
        overlay.classList.add('opacity-0');
        document.body.style.overflow = '';
        setTimeout(() => (menu.hidden = true), 400);
    };
    $$('[data-menu-open]').forEach((b) => b.addEventListener('click', open));
    $('[data-menu-close]', menu).addEventListener('click', close);
    overlay.addEventListener('click', close);
    document.addEventListener('keydown', (e) => e.key === 'Escape' && !menu.hidden && close());
}

/* ---------- Hero slider ---------- */
function initHero() {
    const hero = $('[data-hero]');
    if (!hero) return;
    const slides = $$('[data-hero-slide]', hero);
    const images = $$('[data-hero-image]', hero);
    const tabs = $$('[data-hero-tab]', hero);
    const counter = $('[data-hero-current]', hero);
    const toggle = $('[data-hero-toggle]', hero);
    const duration = Number(hero.dataset.duration) || 7000;
    hero.style.setProperty('--hero-duration', `${duration}ms`);

    let index = 0;
    let timer = null;
    let userPaused = reducedMotion;
    let hoverPaused = false;
    let startedAt = 0;
    let remaining = duration;

    const go = (next) => {
        index = (next + slides.length) % slides.length;
        slides.forEach((s, i) => {
            s.classList.toggle('is-active', i === index);
            s.setAttribute('aria-hidden', i === index ? 'false' : 'true');
            s.querySelectorAll('a, button').forEach((el) => (el.tabIndex = i === index ? 0 : -1));
        });
        images.forEach((img, i) => img.classList.toggle('is-active', i === index));
        tabs.forEach((t, i) => {
            t.classList.remove('is-active');
            void t.offsetWidth; // restart the progress animation
            t.classList.toggle('is-active', i === index);
            t.setAttribute('aria-selected', i === index ? 'true' : 'false');
        });
        counter.textContent = String(index + 1).padStart(2, '0');
        remaining = duration;
        schedule();
    };

    const schedule = () => {
        clearTimeout(timer);
        if (userPaused || hoverPaused) return;
        startedAt = Date.now();
        timer = setTimeout(() => go(index + 1), remaining);
    };
    const pause = () => {
        clearTimeout(timer);
        remaining -= Date.now() - startedAt;
        hero.classList.add('hero-paused');
    };
    const resume = () => {
        if (userPaused || hoverPaused) return;
        hero.classList.remove('hero-paused');
        schedule();
    };

    const setUserPaused = (paused) => {
        userPaused = paused;
        $('[data-icon-pause]', toggle).classList.toggle('hidden', paused);
        $('[data-icon-play]', toggle).classList.toggle('hidden', !paused);
        toggle.setAttribute('aria-label', paused ? 'Play slideshow' : 'Pause slideshow');
        paused ? pause() : resume();
    };

    $('[data-hero-next]', hero).addEventListener('click', () => go(index + 1));
    $('[data-hero-prev]', hero).addEventListener('click', () => go(index - 1));
    tabs.forEach((t, i) => t.addEventListener('click', () => go(i)));
    toggle.addEventListener('click', () => setUserPaused(!userPaused));

    // Pause while the visitor reads the copy
    slides.forEach((el) => {
        el.addEventListener('mouseenter', () => { hoverPaused = true; pause(); });
        el.addEventListener('mouseleave', () => { hoverPaused = false; resume(); });
    });
    document.addEventListener('visibilitychange', () => (document.hidden ? pause() : resume()));

    // Keyboard when hero is in view
    document.addEventListener('keydown', (e) => {
        if (hero.getBoundingClientRect().bottom < 0 || e.target.closest('input, textarea, select')) return;
        if (e.key === 'ArrowRight') go(index + 1);
        if (e.key === 'ArrowLeft') go(index - 1);
    });

    // Swipe / drag
    let startX = null;
    hero.addEventListener('pointerdown', (e) => {
        if (e.target.closest('a, button')) return;
        startX = e.clientX;
    });
    hero.addEventListener('pointerup', (e) => {
        if (startX === null) return;
        const dx = e.clientX - startX;
        if (Math.abs(dx) > 50) go(index + (dx < 0 ? 1 : -1));
        startX = null;
    });

    if (userPaused) setUserPaused(true);
    go(0);
}

/* ---------- Program video tabs ---------- */
function initVideoTabs() {
    $$('[data-vtabs]').forEach((root) => {
        const videos = $$('[data-vtab-video]', root);
        const copies = $$('[data-vtab-copy]', root);
        const tabs = $$('[data-vtab]', root);
        const duration = Number(root.dataset.duration) || 9000;
        root.style.setProperty('--vtab-duration', `${duration}ms`);
        let index = 0;
        let timer = null;
        let visible = false;

        const go = (next) => {
            index = (next + tabs.length) % tabs.length;
            videos.forEach((v, i) => {
                const active = i === index;
                v.classList.toggle('opacity-100', active);
                v.classList.toggle('opacity-0', !active);
                if (active && visible) {
                    v.preload = 'auto';
                    v.play().catch(() => {});
                } else {
                    v.pause();
                }
            });
            copies.forEach((c, i) => {
                const active = i === index;
                c.classList.toggle('opacity-0', !active);
                c.classList.toggle('translate-y-4', !active);
                c.classList.toggle('absolute', !active);
                c.classList.toggle('inset-0', !active);
                c.classList.toggle('pointer-events-none', !active);
            });
            tabs.forEach((t, i) => {
                t.classList.remove('is-active');
                void t.offsetWidth;
                t.classList.toggle('is-active', i === index && visible);
                t.setAttribute('aria-selected', i === index ? 'true' : 'false');
            });
            clearTimeout(timer);
            if (visible && !reducedMotion) timer = setTimeout(() => go(index + 1), duration);
        };

        tabs.forEach((t, i) => t.addEventListener('click', () => go(i)));
        new IntersectionObserver(([entry]) => {
            visible = entry.isIntersecting;
            if (visible) go(index);
            else {
                clearTimeout(timer);
                videos.forEach((v) => v.pause());
            }
        }, { threshold: 0.35 }).observe(root);
    });
}

/* ---------- Animated counters ---------- */
function initCounters() {
    const io = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (!entry.isIntersecting) return;
            const el = entry.target;
            io.unobserve(el);
            const target = Number(el.dataset.count);
            const fmt = new Intl.NumberFormat('en-US');
            if (reducedMotion) return (el.textContent = fmt.format(target));
            const start = performance.now();
            const tick = (now) => {
                const p = Math.min((now - start) / 2000, 1);
                el.textContent = fmt.format(Math.round(target * (1 - Math.pow(1 - p, 4))));
                if (p < 1) requestAnimationFrame(tick);
            };
            requestAnimationFrame(tick);
        });
    }, { threshold: 0.6 });
    $$('[data-count]').forEach((el) => io.observe(el));
}

/* ---------- Scroll reveal ---------- */
function initReveal() {
    const io = new IntersectionObserver((entries) => {
        entries.forEach((e) => {
            if (e.isIntersecting) {
                e.target.classList.add('is-visible');
                io.unobserve(e.target);
            }
        });
    }, { threshold: 0.12, rootMargin: '0px 0px -40px 0px' });
    $$('.reveal').forEach((el) => io.observe(el));
}

/* ---------- Horizontal carousels (scroll-snap) ---------- */
function initCarousels() {
    $$('[data-carousel]').forEach((root) => {
        const track = $('[data-carousel-track]', root);
        const step = () => (track.firstElementChild?.offsetWidth || 300) + 24;
        $('[data-carousel-prev]', root)?.addEventListener('click', () => track.scrollBy({ left: -step(), behavior: 'smooth' }));
        $('[data-carousel-next]', root)?.addEventListener('click', () => track.scrollBy({ left: step(), behavior: 'smooth' }));
    });
}

/* ---------- Tabs ---------- */
function initTabs() {
    $$('[data-tabs]').forEach((root) => {
        const tabs = $$('[data-tab]', root);
        const panels = $$('[data-tab-panel]', root);
        const activate = (name) => {
            tabs.forEach((t) => t.setAttribute('aria-selected', t.dataset.tab === name ? 'true' : 'false'));
            panels.forEach((p) => (p.hidden = p.dataset.tabPanel !== name));
        };
        tabs.forEach((t) => t.addEventListener('click', () => activate(t.dataset.tab)));
    });
}

/* ---------- Lightbox for photos and YouTube videos ---------- */
function initLightbox() {
    const box = $('[data-lightbox]');
    if (!box) return;
    const stage = $('[data-lightbox-stage]', box);
    const caption = $('[data-lightbox-caption]', box);
    let items = [];
    let index = 0;

    const render = () => {
        const item = items[index];
        stage.innerHTML = '';
        if (item.dataset.youtube) {
            stage.innerHTML = `<div class="aspect-video w-full overflow-hidden rounded-2xl bg-black"><iframe class="size-full" src="https://www.youtube-nocookie.com/embed/${item.dataset.youtube}?autoplay=1&rel=0" title="Video" allow="autoplay; encrypted-media; picture-in-picture" allowfullscreen></iframe></div>`;
        } else {
            const img = new Image();
            img.src = item.getAttribute('href');
            img.alt = item.dataset.caption || '';
            img.className = 'max-h-[80vh] w-auto rounded-2xl object-contain shadow-2xl';
            stage.append(img);
        }
        caption.textContent = items.length > 1 ? `${item.dataset.caption || ''}  ·  ${index + 1} / ${items.length}` : item.dataset.caption || '';
        $$('[data-lightbox-prev], [data-lightbox-next]', box).forEach((b) => (b.hidden = items.length < 2));
    };
    const open = (trigger) => {
        const group = trigger.dataset.group;
        items = group ? $$(`[data-lightbox-item][data-group="${group}"]`) : [trigger];
        index = items.indexOf(trigger);
        render();
        box.hidden = false;
        document.body.style.overflow = 'hidden';
        $('[data-lightbox-close]', box).focus();
    };
    const close = () => {
        box.hidden = true;
        stage.innerHTML = '';
        document.body.style.overflow = '';
    };
    const move = (d) => {
        index = (index + d + items.length) % items.length;
        render();
    };

    document.addEventListener('click', (e) => {
        const trigger = e.target.closest('[data-lightbox-item]');
        if (!trigger) return;
        e.preventDefault();
        open(trigger);
    });
    $('[data-lightbox-close]', box).addEventListener('click', close);
    $('[data-lightbox-prev]', box).addEventListener('click', () => move(-1));
    $('[data-lightbox-next]', box).addEventListener('click', () => move(1));
    box.addEventListener('click', (e) => e.target === box && close());
    document.addEventListener('keydown', (e) => {
        if (box.hidden) return;
        if (e.key === 'Escape') close();
        if (e.key === 'ArrowRight') move(1);
        if (e.key === 'ArrowLeft') move(-1);
    });
}

/* ---------- Donation amount chips ---------- */
function initDonateForms() {
    $$('[data-donate-form]').forEach((form) => {
        const input = $('[data-amount-input]', form);
        const chips = $$('[data-amount]', form);
        const sync = () => chips.forEach((c) => c.toggleAttribute('data-selected', c.dataset.amount === input.value));
        chips.forEach((chip) => chip.addEventListener('click', () => {
            input.value = chip.dataset.amount;
            sync();
        }));
        input.addEventListener('input', sync);
        sync();
    });
}

/* ---------- Copy-to-clipboard (bank details) ---------- */
function initCopy() {
    document.addEventListener('click', async (e) => {
        const btn = e.target.closest('[data-copy]');
        if (!btn) return;
        try {
            await navigator.clipboard.writeText(btn.dataset.copy);
            const label = btn.querySelector('[data-copy-label]');
            if (label) {
                const old = label.textContent;
                label.textContent = 'Copied!';
                setTimeout(() => (label.textContent = old), 1600);
            }
        } catch {
            /* clipboard unavailable — ignore */
        }
    });
}

/* ---------- Gallery filter on the media page ---------- */
function initFilters() {
    $$('[data-filter-root]').forEach((root) => {
        const buttons = $$('[data-filter]', root);
        const items = $$('[data-filter-item]', root);
        buttons.forEach((b) => b.addEventListener('click', () => {
            buttons.forEach((x) => x.setAttribute('aria-selected', x === b ? 'true' : 'false'));
            items.forEach((item) => (item.hidden = b.dataset.filter !== 'all' && item.dataset.filterItem !== b.dataset.filter));
        }));
    });
}

document.addEventListener('DOMContentLoaded', () => {
    initHeader();
    initMenu();
    initHero();
    initVideoTabs();
    initCounters();
    initReveal();
    initCarousels();
    initTabs();
    initLightbox();
    initDonateForms();
    initCopy();
    initFilters();
});
