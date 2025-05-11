//trata de hacer un enlace de las demographics y categoria al catalogo porque seria god uwu
const parametros = new URLSearchParams(window.location.search);
const idPersonaje = parametros.get('id');

//coso del html
const imagenPersonaje= document.querySelector('.imagenPersonaje');
const detallesPersonaje = document.querySelector('.detallesPersonaje');
const estadisticas = document.querySelector('.estadisticas');
const anime = document.querySelector('.aparicionesAnime');
const manga = document.querySelector('.aparicionesManga');
if (idPersonaje) {
    fetch(`https://api.jikan.moe/v4/characters/${idPersonaje}/full`)
        .then(response => response.json())
        .then(data => {
            const Personaje = data.data;
            const img = document.createElement('img');
            const info = document.getElementById('info');
            const voz = document.getElementById('voz');
            const sobre = Personaje.about || '';
            let atributosHTML = '';
            let biografiaHTML = '';
            
            if (sobre) {
                const lineas = sobre.split('\n');
            
                lineas.forEach(linea => {
                    const lineaLimpia = linea.trim();
            
                    
                    if (lineaLimpia.startsWith('(Source:')) return;
            
                    if (lineaLimpia.includes(':') && !lineaLimpia.startsWith('(')) {
                        const [clave, valor] = lineaLimpia.split(':').map(p => p.trim());
                        if (clave && valor) {
                            atributosHTML += `<li><strong>${clave}:</strong> <span>${valor}</span></li>`;
                        }
                    } else if (lineaLimpia) {
                        biografiaHTML += `<p>${lineaLimpia}</p>`;
                    }
                });
            }
            img.src=Personaje.images.jpg.image_url;
            img.alt=Personaje.name;
            
            detallesPersonaje.innerHTML=
            `
            <h4>${Personaje.name}</h4>
            <h6>(${Personaje.name_kanji})</h6>
            <hr>
            `;
            anime.innerHTML = 
            Personaje.anime?.length > 0 ? `
              <h4>Apariciones Anime</h4>
              <div class="listaAnime">
                ${Personaje.anime.map(m => `
                  <div class="itemAnime">
                    <img src="${m.anime.images.jpg.image_url}" alt="${m.anime.title}">
                    <span>${m.anime.title}, (${m.role})</span>
                  </div>
                `).join('')}
              </div>
              <hr>
            ` : '';
            manga.innerHTML =
            Personaje.manga?.length > 0 ? `
            <h4>Apariciones Manga</h4>
            <div class="listaManga">
              ${Personaje.manga.map(m => `
                <div class="itemManga">
                  <a href="Detalles.php?id=${m.manga.mal_id}">
                  <img src="${m.manga.images.jpg.image_url}" alt="${m.manga.title}">
                  <span>${m.manga.title}, (${m.role})</span>
                  </a>
                </div>
              `).join('')}
            </div>
            <hr>
            `:'';
            estadisticas.innerHTML =
            `
            <p><strong>Favorito de:</strong> ${Personaje.favorites || 'Desconocida'}</p>
            `;
            info.innerHTML = `
            <h3>Sobre el personaje</h3>
            <div class="informacionContainer">
                <div class="atributosColumna">
                    <h4>Atributos</h4>
                    <ul>${atributosHTML || 'Aun no registrados srry'}</ul>
                </div>
                <div class="biografiaColumna">
                    <h4>Biografía</h4>
                    ${biografiaHTML || '<p>Aun no registrados srry</p>'}
                </div>
            </div>
            
        `;
        if (Personaje.voices?.length > 0) {
            Personaje.voices.forEach(actor => {
              const divActor = document.createElement('div');
              divActor.innerHTML = `
                
                  <img src="${actor.person.images.jpg.image_url}" alt="${actor.person.name}" />
                  <p>${actor.person.name}</p>
                  <p>Idioma: ${actor.language}</p>
                
              `;
              voz.appendChild(divActor);
            });
          } else {
            voz.innerHTML = '<p>Por el momento no presenta actor de voz</p>';
          }
            imagenPersonaje.appendChild(img);
        })
        .catch(error => console.error('Error al obtener los datos del Personaje:', error));
}
if (!parametros.has("id")) {
       
    window.location.href = window.location.pathname + "?id=1";
  }
    function redirigirBusqueda() {
    const titulo = document.getElementById('buscarTitulo').value.trim(); // Obtener el valor del input
    if (titulo) {
        window.location.href = `Catalogo.php?q=${encodeURIComponent(titulo)}`; // Redirigir con el parámetro de búsqueda
    }
}