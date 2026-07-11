    document.addEventListener("DOMContentLoaded", function () {
      const ListaPopulares = document.querySelector('.ListaPopulares.mangas');
      const PopularesPersonaje = document.querySelector('.ListaPopulares.personajes');
      let currentPage = 1;
  
      async function cargarPopularesManga(page) {
        ListaPopulares.innerHTML += '<p id="cargando">Cargando...</p>';

        try {
          const data = await cachedFetch(`${API_BASE}/top/manga?page=${page}&limit=25`);
          document.getElementById('cargando')?.remove();

          if (data.data && data.data.length > 0) {
            data.data.forEach(manga => {
              const Popular = document.createElement('div');
              Popular.classList.add('Popular');

              Popular.innerHTML = `
                  <a href="index.php?controller=kiwi&action=detalles&id=${manga.mal_id}">
                  <img src="${manga.images.jpg.image_url}" alt="${manga.title}" />
                  <p title="${manga.title}">
                    ${manga.title.length > 50 ? manga.title.slice(0, 35) + '...' : manga.title}
                  </p>
                  </a>
              `;

              ListaPopulares.appendChild(Popular);
            });
          }
        } catch (error) {
          console.error('Error:', error);
          document.getElementById('cargando')?.remove();
          ListaPopulares.innerHTML += '<p>Error al cargar los mangas populares.</p>';
        }
      }
    //Funcion cargar personajes populares
    async function cargarPersonajes(page) {
      PopularesPersonaje.innerHTML += '<p id="cargandos">Cargando...</p>';

      try {
        const data = await cachedFetch(`${API_BASE}/top/characters?page=${page}&limit=25`);
        document.getElementById('cargandos')?.remove();

        if (data.data && data.data.length > 0) {
          data.data.forEach(character => {
            const personajes = document.createElement('div');
            personajes.classList.add('Popular');

            personajes.innerHTML = `
                <a href="index.php?controller=kiwi&action=personajes&id=${character.mal_id}">
                <img src="${character.images.jpg.image_url}" alt="" />
                <p class="Nombre">${character.name}</p>
                </a>
                <p class="Seguidores">Gente a sus pies #${character.favorites}</p>
            `;

            PopularesPersonaje.appendChild(personajes);
          });
        }
      } catch (error) {
        console.error('Error:', error);
        document.getElementById('cargandos')?.remove();
        PopularesPersonaje.innerHTML += '<p>Error al cargar los personajes populares.</p>';
      }
    }

    async function cargarImagenesRecomendaciones() {
        const cards = document.querySelectorAll('.mangafoto a');
        for (const link of cards) {
            const params = new URLSearchParams(link.href.split('?')[1]);
            const id = params.get('id');
            if (!id) continue;
            try {
                const data = await cachedFetch(`${API_BASE}/manga/${id}`);
                const img = link.querySelector('img');
                if (img && data.data?.images?.jpg?.image_url) {
                    img.src = data.data.images.jpg.image_url;
                }
            } catch (e) {}
        }
    }

    // Cargar secuencialmente para no exceder el rate limit de Jikan (3 req/s)
    (async () => {
      await cargarPopularesManga(currentPage);
      await cargarPersonajes(currentPage);
      await cargarImagenesRecomendaciones();
    })();
  });

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
