<script>
(() => {
    const pendingKey = 'pending-search-scroll';
    const searchSelector = 'input[type="search"], input[id^="cari" i], input[placeholder*="cari" i]';
    window.matchesAllSearchTerms = (query, ...values) => {
        const terms = query.toLocaleLowerCase().trim().split(/\s+/).filter(Boolean);
        const content = values.join(' ').toLocaleLowerCase().replace(/\s+/g, ' ');
        const labels = new Set(['nama', 'mata', 'pelajaran', 'kode', 'tingkat', 'kelas', 'jurusan', 'rombel', 'hari', 'jam', 'mulai', 'selesai', 'semester', 'guru', 'mapel', 'status', 'role', 'username', 'telepon', 'nisn', 'absen', 'no']);
        const remaining = [];

        for (let i = 0; i < terms.length; i++) {
            if (terms[i] === 'jam' && terms[i + 1] === 'ke' && terms[i + 2]) {
                if (!content.includes(`jam ke ${terms[i + 2]}`)) return false;
                i += 2;
            } else if (labels.has(terms[i]) && terms[i + 1]) {
                if (!content.includes(`${terms[i]} ${terms[i + 1]}`)) return false;
                i++;
            } else {
                remaining.push(terms[i]);
            }
        }

        return remaining.every(term => content.includes(term));
    };

    // Keep the current viewport steady while an on-page filter updates its results.
    let savedY = null;
    let restoreFrame = null;
    document.addEventListener('input', event => {
        if (!event.target.matches(searchSelector)) return;
        savedY = window.scrollY;
        if (restoreFrame) cancelAnimationFrame(restoreFrame);
        restoreFrame = requestAnimationFrame(() => {
            window.scrollTo(0, savedY);
            restoreFrame = null;
        });
    }, true);

    const rememberScroll = url => {
        sessionStorage.setItem(pendingKey, JSON.stringify({
            url: url.pathname + url.search,
            y: window.scrollY,
        }));
    };

    // Keep the viewport when paging through results (Laravel paginator links).
    document.addEventListener('click', event => {
        const link = event.target.closest('nav[role="navigation"] a, .pagination a, [aria-label*="Pagination"] a');
        if (!link || !link.href) return;

        const target = new URL(link.href, window.location.href);
        if (target.origin !== window.location.origin || target.pathname !== window.location.pathname) return;
        rememberScroll(target);
    }, true);

    // Remember the viewport for searches and actions that return to this list.
    document.addEventListener('submit', event => {
        const form = event.target;
        if (!(form instanceof HTMLFormElement)) return;

        if (form.method.toLowerCase() === 'get' && form.querySelector(searchSelector)) {
            const target = new URL(form.action || window.location.href, window.location.href);
            new FormData(form).forEach((value, name) => {
                if (typeof value === 'string') target.searchParams.set(name, value);
            });
            rememberScroll(target);
            return;
        }

        if (form.method.toLowerCase() !== 'get') {
            rememberScroll(new URL(window.location.href));
        }
    }, true);

    // Restore only after the submitted search lands on its destination URL.
    window.addEventListener('pageshow', () => {
        const pending = sessionStorage.getItem(pendingKey);
        if (!pending) return;

        sessionStorage.removeItem(pendingKey);
        try {
            const { url, y } = JSON.parse(pending);
            if (url === window.location.pathname + window.location.search) {
                requestAnimationFrame(() => requestAnimationFrame(() => window.scrollTo(0, Number(y) || 0)));
            }
        } catch (_) {
            // Ignore stale or malformed scroll state.
        }
    });
})();
</script>
