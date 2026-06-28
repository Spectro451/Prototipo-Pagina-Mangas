const API_BASE = "https://api.jikan.moe/v4";
const ROUTE_BASE = "index.php?controller=kiwi&action=";
const CACHE_TTL = 5 * 60 * 1000;

async function cachedFetch(url) {
    const key = 'api_' + url;
    const cached = localStorage.getItem(key);
    if (cached) {
        const { data, ts } = JSON.parse(cached);
        if (Date.now() - ts < CACHE_TTL) return data;
        localStorage.removeItem(key);
    }
    const res = await fetch(url);
    if (res.status === 429) {
        const err = new Error('rate_limit');
        err.status = 429;
        throw err;
    }
    if (!res.ok) throw new Error(`HTTP ${res.status}`);
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