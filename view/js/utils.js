const API_BASE = "https://api.jikan.moe/v4";
const ROUTE_BASE = "index.php?controller=kiwi&action=";
const CACHE_TTL = 5 * 60 * 1000;
const JIKAN_MIN_INTERVAL = 400;

let jikanQueue = Promise.resolve();
let lastJikanRequest = 0;

function throttleJikan(fn) {
    const run = jikanQueue.then(async () => {
        const wait = JIKAN_MIN_INTERVAL - (Date.now() - lastJikanRequest);
        if (wait > 0) await new Promise(r => setTimeout(r, wait));
        lastJikanRequest = Date.now();
        return fn();
    });
    jikanQueue = run.catch(() => {});
    return run;
}

async function fetchWithRetry(url) {
    const maxRetries = 3;
    const retryableStatuses = [429, 502, 503, 504];
    const isJikan = url.startsWith(API_BASE);
    for (let attempt = 0; attempt <= maxRetries; attempt++) {
        if (attempt > 0) {
            await new Promise(r => setTimeout(r, 500 * Math.pow(2, attempt - 1)));
        }
        const res = isJikan ? await throttleJikan(() => fetch(url)) : await fetch(url);
        if (res.ok) return res;
        if (!retryableStatuses.includes(res.status) || attempt === maxRetries) {
            throw new Error(`HTTP ${res.status}`);
        }
    }
}

async function cachedFetch(url) {
    const key = 'api_' + url;
    const cached = localStorage.getItem(key);
    if (cached) {
        const { data, ts } = JSON.parse(cached);
        if (Date.now() - ts < CACHE_TTL) return data;
        localStorage.removeItem(key);
    }
    const res = await fetchWithRetry(url);
    const data = await res.json();
    try {
        localStorage.setItem(key, JSON.stringify({ data, ts: Date.now() }));
    } catch (e) {}
    return data;
}

function verificarFavorito(mangaId, onResult) {
    fetch('index.php?controller=favoritos&action=verificar', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ id: mangaId })
    })
    .then(r => r.json())
    .then(data => onResult(data.favorito))
    .catch(error => console.error('Error al verificar favorito:', error));
}

function toggleFavorito(mangaId, titulo, imagen, onResult) {
    fetch('index.php?controller=favoritos&action=toggleFavorito', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ id: mangaId, titulo, imagen })
    })
    .then(r => r.json())
    .then(data => {
        if (data.success) {
            onResult(data.estado, data.message);
        } else {
            alert('Error: ' + data.message);
        }
    })
    .catch(error => console.error('Error al modificar favorito:', error));
}

function redirigirBusqueda() {
    const titulo = document.getElementById('buscarTitulo').value.trim();
    if (titulo) {
        window.location.href = ROUTE_BASE + "catalogo&q=" + encodeURIComponent(titulo);
    }
}