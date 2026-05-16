const API_BASE = "https://api.jikan.moe/v4";
const ROUTE_BASE = "index.php?controller=kiwi&action=";

function redirigirBusqueda() {
    const titulo = document.getElementById('buscarTitulo').value.trim();
    if (titulo) {
        window.location.href = ROUTE_BASE + "catalogo&q=" + encodeURIComponent(titulo);
    }
}