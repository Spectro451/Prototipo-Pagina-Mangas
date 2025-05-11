    document.addEventListener("DOMContentLoaded", function () {
      const ListaPopulares = document.querySelector('.ListaPopulares.mangas');
      const PopularesPersonaje = document.querySelector('.ListaPopulares.personajes');
      let currentPage = 1;
  
      function cargarPopularesManga(page) {
        ListaPopulares.innerHTML += '<p id="cargando">Cargando...</p>';
  
        fetch(`https://api.jikan.moe/v4/top/manga?page=${page}&limit=25`)
          .then(response => response.json())
          .then(data => {
            document.getElementById('cargando')?.remove();
  
            if (data.data && data.data.length > 0) {
              data.data.forEach(manga => {
                const Popular = document.createElement('div');
                Popular.classList.add('Popular');
  
                Popular.innerHTML = `
                    <a href="Detalles.php?id=${manga.mal_id}">
                    <img src="${manga.images.jpg.image_url}" alt="${manga.title}" />
                    <p title="${manga.title}">
                      ${manga.title.length > 50 ? manga.title.slice(0, 35) + '...' : manga.title}
                    </p>
                    </a>

                `;
  
                ListaPopulares.appendChild(Popular);
              });
            } 
          })
          .catch(error => {
            console.error('Error:', error);
            ListaPopulares.innerHTML += '<p>Error al cargar los mangas populares.</p>';
          });
      }
    //Funcion cargar personajes populares
    function cargarPersonajes(page) {
      PopularesPersonaje.innerHTML += '<p id="cargandos">Cargando...</p>';

      fetch(`https://api.jikan.moe/v4/top/characters?page=${page}&limit=25`)
        .then(response => response.json())
        .then(data => {
          document.getElementById('cargandos')?.remove();

          if (data.data && data.data.length > 0) {
            data.data.forEach(character => {
              const personajes = document.createElement('div');
              personajes.classList.add('Popular');

              personajes.innerHTML = `
                  <a href="Personajes.php?id=${character.mal_id}">
                  <img src="${character.images.jpg.image_url}" alt="" />
                  <p class="Nombre">${character.name}</p>
                  </a>
                  <p class="Seguidores">Gente a sus pies #${character.favorites}</p>
              `;

              PopularesPersonaje.appendChild(personajes);
            });
          } 
        })
        .catch(error => {
          console.error('Error:', error);
          ListaPopulares.innerHTML += '<p>Error al cargar los mangas populares.</p>';
        });
    }
    // Cargar la primera página al iniciar
    cargarPersonajes(currentPage);
    cargarPopularesManga(currentPage);
  });
  function redirigirBusqueda() {
    const titulo = document.getElementById('buscarTitulo').value.trim(); // Obtener el valor del input
    if (titulo) {
        window.location.href = `Catalogo.php?q=${encodeURIComponent(titulo)}`; // Redirigir con el parámetro de búsqueda
    }
}
let scrollContainers = document.querySelectorAll('.ListaPopulares');

scrollContainers.forEach((container) => {
  let scrollTimer;

  function autoScroll() {
   
    if (container.scrollLeft + container.offsetWidth >= container.scrollWidth) {
      container.scrollLeft = 0; 
    } else {
      container.scrollLeft += 1; 
    }
  }

  
  scrollTimer = setInterval(autoScroll, 20);

 
  container.addEventListener('mouseenter', () => clearInterval(scrollTimer));

 
  container.addEventListener('mouseleave', () => {
    scrollTimer = setInterval(autoScroll, 20);
  });
});
