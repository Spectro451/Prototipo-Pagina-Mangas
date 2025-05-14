const params = new URLSearchParams(window.location.search);
const categoria = params.get("categoria");
const busqueda = params.get("q");
const catalogo = document.querySelector(".Catalogo");
const verMas = document.getElementById("verMas");
let currentPage = 1;
let Buscado = false;
const paginasMaxima = 20;
var filtro = "";
var nsfw = false;

const easterEggs = [
  {
    keyword: "skibidi",
    video: "https://www.youtube.com/watch?v=uO1NPnoU2kQ",
    image:
      "https://i.pinimg.com/1200x/23/62/2e/23622e721a31b1bf7d58661f91856d7b.jpg",
    title: "Que se mejore",
    subtitle: "Antonio porfa matese",
  },
  {
    keyword: "homero",
    video: "https://www.youtube.com/watch?v=LOeL7WHFuiA",
    image:
      "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSDBp0Dwp-GL1_Xy197a47ZMIfSIuRYGS2B_A&s",
    title: "HOMERO HOMERO HOMERO 🗣️🗣️🗣️",
    subtitle: "CERVEZA 🗣️🗣️",
  },
  {
    keyword: "de guiken",
    video: "https://www.youtube.com/watch?v=MCW4eGoLX3s", // opción 2 https://www.youtube.com/shorts/le2yfNpjJh4 
    image:
      "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSppH9apT6gq-lpLNd7IG0mBMMvE8qCweNlZw&s",
    title: "de guiken",
    subtitle: "fin de semana",
  },
];

window.addEventListener("DOMContentLoaded", () => {
  if (busqueda) {
    document.getElementById("buscarTitulo").value = busqueda;
    buscarMangas();
  } else {
    cargarmangas();
  }
});

async function agregarAlCatalogo(url) {
  await fetch(url)
    .then((response) => response.json())
    .then((data) => {
      data.data.forEach((manga) => 
        {
          const Popular = document.createElement("div");
          const Favorito = document.createElement("div");
          const idManga = manga.mal_id;

          Favorito.innerHTML = `<i class="far fa-heart"></i>`;
          const icono = Favorito.querySelector("i");

          Favorito.classList.add("Favorito");
          Popular.classList.add("Popular");
          Popular.innerHTML = `
                            <a href="index.php?controller=kiwi&action=detalles&id=${manga.mal_id}">
                                <img src="${manga.images.jpg.image_url}" alt="${manga.title}" />
                                <p title="${manga.title}">
                                ${
                                  manga.title.length > 100
                                    ? manga.title.slice(0, 100) + "..."
                                    : manga.title
                                }
                                </p>
                            </a>
                        `;
       
            fetch('index.php?controller=favoritos&action=verificar', 
              {
                method: 'POST',
                headers: 
                {
                  'Content-Type': 'application/json'
                },
                  body: JSON.stringify({ id: idManga })
              })
            .then(response => response.json())
            .then(data => 
              {
                if (data.favorito) 
                {
                  icono.classList.remove('far');
                  icono.classList.add('fas');
                  icono.style.color = 'red';
                } 
                else 
                {
                  icono.classList.remove('fas');
                  icono.classList.add('far');
                  icono.style.color = 'gray';
                }
            })
            .catch(error => 
              {
                console.error('Error al verificar estado de favorito:', error);
              });
            Favorito.addEventListener('click', function () 
            {
              fetch('index.php?controller=favoritos&action=toggleFavorito', {
                  method: 'POST',
                  headers: {
                      'Content-Type': 'application/json'
                  },
                  body: JSON.stringify({
                      id: idManga,
                      titulo: manga.titles[0].title,
                      imagen: manga.images.jpg.image_url
                  })
              })
              .then(response => response.json())
              .then(data => {
                  if (data.success) {
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
                      }
                  } else {
                      alert('Error: ' + data.message);
                  }
              })
              .catch(error => {
                  console.error('Error al modificar favorito:', error);
              });
            });

        catalogo.appendChild(Popular);
        Popular.appendChild(Favorito);
      });
      crearPaginacion(data.pagination.last_visible_page);
    });
}

function agregarEasterEgg(link, img, p1, p2) {
  const Popular = document.createElement("div");
  Popular.classList.add("Popular");
  Popular.innerHTML = `
                <a href="${link}" target="_blank">
                <img src="${img}">
                <p>${p1}</p>
                <p>${p2}</p>
                </a>
            `;
  catalogo.appendChild(Popular);
  crearPaginacion(1);
  return;
}

async function cargarmangas() {
  catalogo.innerHTML = "";
  switch (categoria) {
    case "populares":
      agregarAlCatalogo(
        `https://api.jikan.moe/v4/top/manga?page=${currentPage}&limit=25&sfw=true`
      );
      break;
    case "Publishing":
      agregarAlCatalogo(
        `https://api.jikan.moe/v4/manga?status=Publishing&limit=25&page=${currentPage}&sfw=true`
      );
      break;
    case "Complete":
      agregarAlCatalogo(
        `https://api.jikan.moe/v4/manga?status=Complete&limit=25&page=${currentPage}&sfw=true`
      );
      break;
    default:
      agregarAlCatalogo(
        `https://api.jikan.moe/v4/manga?genres=${categoria}&limit=25&page=${currentPage}&sfw=true`
      );
      break;
  }
  const url = new URL(window.location.href);
url.searchParams.set("pagina", currentPage); // ejemplo
history.replaceState(null, '', url);
}
async function buscarMangas(resetPage = true) {
  Buscado = true;
  const urlParams = new URLSearchParams(window.location.search);
  if (resetPage) currentPage = 1;
  catalogo.innerHTML = "";
  const busqueda = document.getElementById("buscarTitulo").value.trim().toLowerCase();

  //if (busqueda === "" && filtro === "" && !nsfw) {
  //  // Remove all URL parameters
  //  const baseUrl = window.location.origin + window.location.pathname;
  //  window.history.replaceState({}, document.title, baseUrl);
//
  //  return cargarmangas();
  //}
  if (busqueda != "") {
    urlParams.set("q", busqueda); // Actualiza el parámetro 'q'
    window.history.pushState({}, "", "?" + urlParams.toString()); // Cambia la URL sin recargar
  }

  easterEggs.forEach(({ keyword, video, image, title, subtitle }) => {
    if (busqueda.includes(keyword)) {
      agregarEasterEgg(video, image, title, subtitle);
    }
  });

  let url = `https://api.jikan.moe/v4/manga`;

  const fechaInicio = document.getElementById('fechaInicio').value;
  const fechaFinal = document.getElementById('fechaFinal').value;

  const params = new URLSearchParams();
  
  if (busqueda) params.set("q", busqueda);
  if (filtro) params.set("type", filtro);
  nsfw ? params.set("sfw", "false") : params.set("sfw", "true");
  params.set("page", currentPage);
  isNaN(parseInt(fechaInicio)) ? params.append("start_date", `1934-01-01`) : params.append("start_date", `${fechaInicio}-01-01`);
  isNaN(parseInt(fechaFinal)) ? params.append("end_date", `2025-12-31`) : params.append("end_date", `${fechaFinal}-12-31`);

  url += `?${params.toString()}`;
  agregarAlCatalogo(url);
}

function crearPaginacion(totalPaginas) {
  const container = document.querySelector(".Paginacion");
  container.innerHTML = "";

  const tolerancia = 5;
  if (currentPage - tolerancia > 0) {
    // Mostrar flecha de mierda
    const span = document.createElement("span");
    span.textContent = "←";
    span.classList.add("numeroPagina");
    span.addEventListener("click", () => cambiarPagina(1));
    container.appendChild(span);
  }
  for (
    let i = currentPage - tolerancia;
    i <= currentPage + tolerancia;
    i++ // Añadir siguientes páginas
  ) {
    if (i <= 0 || i > totalPaginas) continue;
    const span = document.createElement("span");
    span.textContent = i;
    span.classList.add("numeroPagina");

    if (i === currentPage) {
      span.classList.add("activo");
    }

    span.addEventListener("click", () => cambiarPagina(i));
    container.appendChild(span);
  }

  if (totalPaginas > currentPage + tolerancia) {
    // Mostrar flecha de mierda
    const span = document.createElement("span");
    span.textContent = "→";
    span.classList.add("numeroPagina");
    span.addEventListener("click", () => cambiarPagina(totalPaginas));
    container.appendChild(span);
  }
}
function cambiarPagina(nuevaPagina) {
  currentPage = nuevaPagina;
  if (Buscado) {
    buscarMangas(false);
  } else {
    cargarmangas();
  }
}

function aplicarFiltros() {
  const form = document.getElementById("form-filtros");
  const selectedRadio = form.querySelector('input[name="tipo"]:checked');
  const selectedValue = selectedRadio ? selectedRadio.value : null;

  const urlParams = new URLSearchParams(window.location.search);
  urlParams.delete("type");

  if (selectedValue) {
    urlParams.set("type", selectedValue);
  }

  filtro = selectedValue;
  const newUrl = urlParams.toString()
    ? "?" + urlParams.toString()
    : window.location.pathname;
  window.history.pushState({}, "", newUrl);
  buscarMangas();
}

function aplicarNsfw() {
  nsfw = !nsfw;
  const urlParams = new URLSearchParams(window.location.search);
  urlParams.delete("sfw");

  urlParams.append("sfw", !nsfw);

  const newUrl = urlParams.toString()
    ? "?" + urlParams.toString()
    : window.location.pathname;
  window.history.pushState({}, "", newUrl);
  buscarMangas();
}

function cambioFecha(e) {
  if (!/^[0-9]$/.test(e.key) && !["Backspace", "ArrowLeft", "ArrowRight", "Tab", "Enter"].includes(e.key)) {
    e.preventDefault();
    return;
  }
  const fechaInicio = document.getElementById('fechaInicio').value;
  const fechaFinal = document.getElementById('fechaFinal').value;

  // Evitar que el input tenga más de 4 dígitos
  if ((fechaInicio.length >= 4 && e.target === document.getElementById('fechaInicio') && e.key !== "Backspace") ||
      (fechaFinal.length >= 4 && e.target === document.getElementById('fechaFinal') && e.key !== "Backspace")) {
    e.preventDefault();  // Bloquear la tecla si ya hay 4 dígitos
  }

  if (e.key !== "Enter") return;
  const urlParams = new URLSearchParams(window.location.search);
  urlParams.delete("start_date");
  urlParams.delete("end_date");


  if (!/^\d{4}$/.test(fechaInicio) || !/^\d{4}$/.test(fechaFinal)) {
    return;
  }

  if(isNaN(parseInt(fechaInicio)) || isNaN(parseInt(fechaFinal))) return;
  urlParams.append("start_date", `${fechaInicio}-01-01`);
  urlParams.append("end_date", `${fechaFinal}-12-31`);
  
  const newUrl = urlParams.toString()
    ? "?" + urlParams.toString()
    : window.location.pathname;
  window.history.pushState({}, "", newUrl);
  buscarMangas();
}
