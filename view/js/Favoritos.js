function redirigirBusqueda() 
{
    const titulo = document.getElementById('buscarTitulo').value.trim(); // Obtener el valor del input
    if (titulo) {
        window.location.href = `index.php?controller=kiwi&action=catalogo&q=${encodeURIComponent(titulo)}`; // Redirigir con el parámetro de búsqueda
    }
}