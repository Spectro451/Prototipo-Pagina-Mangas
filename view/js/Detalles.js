
const parametros = new URLSearchParams(window.location.search);
const idManga = parametros.get('id');

//coso del html
const imagenManga= document.querySelector('.imagenManga');
const detallesManga = document.querySelector('.detallesManga');
const estadisticas = document.querySelector('.estadisticas');
if (idManga) {
    fetch(`https://api.jikan.moe/v4/manga/${idManga}/full`)
        .then(response => response.json())
        .then(data => {
            const manga = data.data;
            const relaciones = manga.relations || [];
            const img = document.createElement('img');
            const ranking = document.getElementById('ranking');
            const sinopsis = document.getElementById('sinopsis');
            const relacionados = document.getElementById('relacionados');
            const personajes = document.getElementById('personajes');
            const foro = document.getElementById('foro');
            const fechaInicio = new Date(manga.published?.from).toLocaleDateString();
            const fechaFin = manga.published?.to ? new Date(manga.published.to).toLocaleDateString() : 'hasta hoy';
            let sinopsisFormateada = 'Desconocida';

            if (manga.synopsis) {
                const sinopsisLimpia = manga.synopsis.replace(/\[Written by MAL Rewrite\]/, '');
                sinopsisFormateada = sinopsisLimpia
                    .split('\n\n')
                    .map(parrafo => `<p>${parrafo.trim()}</p>`)
                    .join('');
            }

            img.src=manga.images.jpg.image_url;
            img.alt=manga.title;
            
            detallesManga.innerHTML=
            `
            <h4>${manga.title}</h4>
            <hr>
            <h4>Títulos alternativos</h4>
            <ul>
            ${manga.titles
                .filter(titulo => titulo.type !== "Default")
                .map(titulo => `
                <li><p class="Info"><strong>${titulo.type}:</strong><span> ${titulo.title}</span></p></li>
                `).join('')}
            </ul>
            <hr>
            <h4>Información</h4>
            <p class="Info"><strong>Tipo:</strong><span> ${manga.type}</span></p>
            ${manga.demographics?.length > 0 ? `
                <p class="Info"><strong>Categoria:</strong> 
                  <span>
                    ${manga.demographics.map(categ => `<a href="Catalogo.php?categoria=${categ.mal_id}&type=demographics">${categ.name}</a>`).join(', ')}
                  </span>
                </p>` : ''}
              
              ${manga.genres?.length > 0 ? `
                <p class="Info"><strong>Genero/s:</strong> 
                  <span>
                    ${manga.genres.map(gen => `<a href="Catalogo.php?categoria=${gen.mal_id}&type=genres">${gen.name}</a>`).join(', ')}
                  </span>
                </p>` : ''}
              
              ${manga.themes?.length > 0 ? `
                <p class="Info"><strong>Tema/s:</strong> 
                  <span>
                    ${manga.themes.map(tem => `<a href="Catalogo.php?categoria=${tem.mal_id}&type=themes">${tem.name}</a>`).join(', ')}
                  </span>
                </p>` : ''}
            ${manga.authors?.length > 0 ?`<p class="Info"><strong>Autor:</strong> <span> ${manga.authors.map(autor => autor.name).join(', ')}</span></p>`: ''}
            <p class="Info"><strong>Capítulos:</strong><span> ${manga.chapters || 'N/A'}</span></p>
            <p class="Info"><strong>Volumenes:</strong> <span>${manga.volumes || 'N/A'}</span></p>
            <p class="Info"><strong>Estado:</strong> <span>${manga.status || 'N/A'}</span></p>
            <p class="Info"><strong>Editorial:</strong> <span>${(manga.serializations?.length > 0 ? manga.serializations.map(peo => peo.name).join(', ') : 'N/A')}</span></p>
            <p class="Info"><strong>Fecha de publicación:</strong> <span>${fechaInicio} - ${fechaFin}</span></p>
            <hr>
            `;
            estadisticas.innerHTML = `
            ${manga.score ? `<p class="Info"><strong>Puntuación:</strong><span> ${manga.score} (reseñado por <strong class ="peo">${manga.scored_by}</strong> usuarios)</span></p>` : ''}
            ${manga.rank ? `<p class="Info"><strong>Ranking:</strong><span> #${manga.rank}</span></p>` : ''}
            ${manga.popularity ? `<p class="Info"><strong>Ranking usuarios:</strong><span> #${manga.popularity}</span></p>` : ''}
            ${manga.favorites ? `<p class="Info"><strong>Favorito de:</strong><span> ${manga.favorites}</span></p>` : ''}
            ${(manga.score || manga.rank || manga.popularity || manga.favorites) ? '<hr>' : ''}
            `;
            ranking.innerHTML =
            `
            <div class="EstadisticasContainer">
                ${manga.score ? `
                <div class="EstadisticaColumna">
                <h4>Puntuación</h4>
                <p>${manga.score} (reseñado por <strong>${manga.scored_by}</strong> usuarios)</p>
                </div>` : ''}

                ${manga.rank ? `
                <div class="EstadisticaColumna">
                <h4>Ranking</h4>
                <p>#${manga.rank}</p>
                </div>` : ''}

                ${manga.popularity ? `
                <div class="EstadisticaColumna">
                <h4>Ranking usuarios</h4>
                <p>#${manga.popularity}</p>
                </div>` : ''}

                ${manga.favorites ? `
                <div class="EstadisticaColumna">
                <h4>Favorito de</h4>
                <p>${manga.favorites}</p>
                </div>` : ''}
            </div>
            `;
            sinopsis.innerHTML =
            `
            
            <h4>Sinopsis</h4> 
            <p>${sinopsisFormateada || 'Desconocida'}</p>
            <hr>
            `;
            relacionados.innerHTML =
            relaciones?.length > 0 ? 
            `
                <h4>Relacionado</h4> 
                <div class="relaciones-container">
                    ${relaciones
                        .map(rel => `
                            <div class="relacionTipo">
                                <strong>${rel.relation}:</strong> 
                                <div class="relacionNombre">
                                <ul>
                                    ${rel.entry
                                        .map(e => `<li><span>${e.name}</span></li>`)
                                        .join('<br>')}
                                        </ul>
                                </div>
                                
                            </div>
                        `)
                        .join('')}
                </div>
                <hr>
            ` : '';

            fetch(`https://api.jikan.moe/v4/manga/${manga.mal_id}/characters`)
            .then(res => res.json())
            .then(data => {
              data.data.forEach(personaje => {
                const divPersonaje = document.createElement('div');
                divPersonaje.innerHTML = 
                `
                <a href="Personajes.php?id=${personaje.character.mal_id}">
                    <img src="${personaje.character.images.jpg.image_url}" alt="${personaje.character.name}" />
                    <p>${personaje.character.name}</p>
                    <p>Rol: ${personaje.role}</p>
                </a>
                
                `;
                personajes.appendChild(divPersonaje);
              });
            });
            fetch(`https://api.jikan.moe/v4/manga/${manga.mal_id}/reviews`)
            .then(res => res.json())
            .then(data => {
                if (data.data && data.data.length > 0) {
                    const reseñas = data.data.slice(0, 3); // Limita a 3 reseñas
                    foro.innerHTML = `
                        <h4>Reseñas</h4>
                        <ul>
                            ${reseñas.map(review => {
                                let reseñaFormateada = review.review
                                    .split('\n')
                                    .map(parrafo => `<p>${parrafo.trim()}</p>`)
                                    .join('');
                                return `
                                    <li>
                                        <p><strong>Por:</strong> ${review.user.username} | <em>${review.tags.join(', ')}</em></p>
                                        ${reseñaFormateada}
                                        <hr>
                                    </li>
                                `;
                            }).join('')}
                        </ul>
                    `;
                } else {
                    foro.innerHTML = `
                        <strong>Reseñas</strong>
                        <p>No hay reseñas disponibles.</p>
                        
                    `;
                }
            })
            .catch(error => {
                foro.innerHTML = `
                    <strong>Reseñas</strong>
                    <p>Error al cargar las reseñas.</p>
                    <hr>
                `;
                console.error('Error al obtener las reseñas del manga:', error);
            });
        
            imagenManga.appendChild(img);
        })
        .catch(error => console.error('Error al obtener los datos del manga:', error));
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