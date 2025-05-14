document.querySelectorAll('.Favorito').forEach(favorito => 
    {
        favorito.addEventListener('click', function () 
        {
            const icono = favorito.querySelector("i");
            const mangaId = favorito.dataset.id;
            const mangaTitulo = favorito.dataset.titulo;
            const mangaImagen = favorito.dataset.imagen;

           
            fetch('index.php?controller=favoritos&action=toggleFavorito', 
                {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        id: mangaId,
                        titulo: mangaTitulo,
                        imagen: mangaImagen,
                    }),
                })
            .then(response => response.json())
            .then(data => 
            {
                if (data.success) 
                    {
                        alert(data.message);

                        if (data.estado === 'agregado') 
                        {
                            icono.classList.remove('far');
                            icono.classList.add('fas');
                            icono.style.color = 'red';
                        } 
                        else if (data.estado === 'eliminado') 
                        {
                            icono.classList.remove('fas');
                            icono.classList.add('far');
                            icono.style.color = 'gray';
                            favorito.closest('.Popular').remove();
                        }
                    } 
                    else 
                    {
                        alert('Error: ' + data.message);
                    }
            })
            .catch(error => 
            {
                console.error('Error al modificar favorito:', error);
            });
        });
    });

function redirigirBusqueda() 
{
    const titulo = document.getElementById('buscarTitulo').value.trim(); // Obtener el valor del input
    if (titulo) {
        window.location.href = `index.php?controller=kiwi&action=catalogo&q=${encodeURIComponent(titulo)}`; // Redirigir con el parámetro de búsqueda
    }
}