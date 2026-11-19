/* SK04 · Restorasi Pita Analog — interaksi UI (vanilla JS, tanpa build step) */
(function () {
    'use strict';

    const $ = (sel, root = document) => root.querySelector(sel);
    const $$ = (sel, root = document) => Array.from(root.querySelectorAll(sel));
    const csrf = () => document.querySelector('meta[name="csrf-token"]')?.content ?? '';

    /* ---------- Tema terang/gelap ---------- */
    const html = document.documentElement;
    const savedTheme = localStorage.getItem('sk04-theme');
    if (savedTheme) html.dataset.bsTheme = savedTheme;
    const themeBtn = $('#theme-toggle');
    const syncThemeIcon = () => {
        const icon = themeBtn?.querySelector('i');
        if (icon) icon.className = html.dataset.bsTheme === 'dark' ? 'bi bi-sun' : 'bi bi-moon-stars';
    };
    themeBtn?.addEventListener('click', () => {
        html.dataset.bsTheme = html.dataset.bsTheme === 'dark' ? 'light' : 'dark';
        localStorage.setItem('sk04-theme', html.dataset.bsTheme);
        syncThemeIcon();
    });
    syncThemeIcon();

    /* ---------- Sidebar mobile ---------- */
    $('[data-sidebar-toggle]')?.addEventListener('click', () => $('#sidebar').classList.toggle('open'));

    /* ---------- Jam langsung ---------- */
    const clock = $('#live-clock');
    const tick = () => {
        if (clock) clock.textContent = new Date().toLocaleTimeString('id-ID', { timeZone: 'Asia/Jakarta' });
    };
    tick();
    setInterval(tick, 1000);

    /* ---------- Toast ---------- */
    function toast(message, type = 'success') {
        const host = $('#toastHost');
        if (!host) return;
        const el = document.createElement('div');
        el.className = `toast align-items-center text-bg-${type} border-0 show mb-2 shadow`;
        el.innerHTML = `<div class="d-flex"><div class="toast-body"></div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto"></button></div>`;
        el.querySelector('.toast-body').textContent = message;
        el.querySelector('button').addEventListener('click', () => el.remove());
        host.appendChild(el);
        setTimeout(() => el.remove(), 3800);
    }
    $$('[data-toast-message]').forEach((el) => toast(el.dataset.toastMessage));

    /* ---------- Hitung-naik angka statistik ---------- */
    $$('[data-count]').forEach((el) => {
        const target = parseInt(el.dataset.count, 10);
        if (Number.isNaN(target)) return;
        const start = performance.now();
        const step = (now) => {
            const p = Math.min((now - start) / 900, 1);
            el.textContent = Math.round(target * (1 - Math.pow(1 - p, 3)));
            if (p < 1) requestAnimationFrame(step);
        };
        requestAnimationFrame(step);
    });

    /* ---------- Progress bar proyek ---------- */
    $$('[data-progress]').forEach((el) => {
        const bar = el.querySelector('.reel-progress-bar');
        if (bar) requestAnimationFrame(() => (bar.style.width = el.dataset.progress + '%'));
    });

    /* ---------- Pilihan jamak: penghitung chip ---------- */
    function updateChipCounts() {
        $$('.chip-group[data-counter-target]').forEach((group) => {
            const target = $(group.dataset.counterTarget);
            if (target) target.textContent = $$('input:checked', group).length;
        });
    }
    $$('.chip-group input').forEach((i) => i.addEventListener('change', updateChipCounts));
    updateChipCounts();

    /* ---------- Pencarian & filter langsung (AJAX) ---------- */
    function buildUrl(form) {
        const params = new URLSearchParams(new FormData(form));
        for (const [k, v] of [...params.entries()]) if (v === '') params.delete(k);
        const qs = params.toString();
        return { action: form.action, qs };
    }

    async function refreshResults(form) {
        const resultsSel = form.dataset.results;
        const target = resultsSel ? $(resultsSel) : null;
        if (!target) { form.submit(); return; }

        const { action, qs } = buildUrl(form);
        const spinner = $('[data-search-spinner]', form);
        spinner?.classList.remove('d-none');
        target.classList.add('is-loading');

        try {
            const res = await fetch(`${action}?${qs}`, {
                headers: { 'X-Requested-With': 'XMLHttpRequest', Accept: 'application/json' },
            });
            if (!res.ok) throw new Error('HTTP ' + res.status);
            const json = await res.json();
            target.innerHTML = json.html;
            history.replaceState(null, '', qs ? `${action}?${qs}` : action);
            toast(`${json.total} data ditemukan`, 'info');
        } catch (err) {
            toast('Pencarian gagal, memuat ulang halaman…', 'danger');
            setTimeout(() => form.submit(), 600);
        } finally {
            spinner?.classList.add('d-none');
            target.classList.remove('is-loading');
        }
    }

    $$('[data-live-form]').forEach((form) => {
        const search = $('[data-live-search]', form);
        let timer;
        search?.addEventListener('input', () => {
            clearTimeout(timer);
            timer = setTimeout(() => refreshResults(form), 320);
        });
        search?.addEventListener('keydown', (e) => {
            if (e.key === 'Enter') { e.preventDefault(); clearTimeout(timer); refreshResults(form); }
        });
        $$('[data-auto-submit]', form).forEach((el) =>
            el.addEventListener('change', () => refreshResults(form))
        );
    });

    /* ---------- Konfirmasi sebelum hapus (modal Bootstrap) ---------- */
    const confirmModalEl = $('#confirmModal');
    const confirmModal = confirmModalEl ? new bootstrap.Modal(confirmModalEl) : null;
    let pendingForm = null;
    $$('form[data-confirm]').forEach((form) => {
        form.addEventListener('submit', (e) => {
            if (form.dataset.confirmed === '1') return;
            e.preventDefault();
            pendingForm = form;
            $('#confirmMessage').textContent = form.dataset.confirm;
            confirmModal?.show();
        });
    });
    $('#confirmAccept')?.addEventListener('click', () => {
        if (!pendingForm) return;
        pendingForm.dataset.confirmed = '1';
        confirmModal?.hide();
        pendingForm.submit();
    });

    /* ---------- Modal edit tahap restorasi ---------- */
    const detailModalEl = $('#detailModal');
    if (detailModalEl) {
        const detailModal = new bootstrap.Modal(detailModalEl);
        const form = $('#detailEditForm');
        $$('[data-detail-edit]').forEach((btn) => {
            btn.addEventListener('click', () => {
                form.action = btn.dataset.action;
                const map = {
                    tahap: btn.dataset.tahap,
                    tindakan: btn.dataset.tindakan,
                    tanggal: btn.dataset.tanggal,
                    durasi_menit: btn.dataset.durasi,
                    hasil: btn.dataset.hasil,
                };
                Object.entries(map).forEach(([name, value]) => {
                    const field = $(`[name="${name}"]`, form);
                    if (field) field.value = value ?? '';
                });
                detailModal.show();
            });
        });
    }

    /* ---------- Input uang: hanya angka, koma dan titik ---------- */
    $$('[data-money]').forEach((input) => {
        input.addEventListener('input', () => {
            input.value = input.value.replace(/[^0-9.,]/g, '');
        });
    });

    /* ---------- Animasi kemunculan baris ---------- */
    const io = 'IntersectionObserver' in window ? new IntersectionObserver((entries) => {
        entries.forEach((en) => { if (en.isIntersecting) { en.target.classList.add('in-view'); io.unobserve(en.target); } });
    }, { threshold: 0.08 }) : null;
    $$('.hover-lift, .timeline-item').forEach((el) => io?.observe(el));

    /* ---------- Gelombang efek klik pada tombol ---------- */
    $$('.btn').forEach((btn) => {
        btn.addEventListener('click', (e) => {
            const r = btn.getBoundingClientRect();
            const ripple = document.createElement('span');
            ripple.className = 'ripple';
            ripple.style.left = e.clientX - r.left + 'px';
            ripple.style.top = e.clientY - r.top + 'px';
            btn.appendChild(ripple);
            setTimeout(() => ripple.remove(), 600);
        });
    });
})();
