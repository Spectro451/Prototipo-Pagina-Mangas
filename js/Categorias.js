const params = new URLSearchParams(window.location.search);
const categoria = params.get("categoria");
const catalogo = document.querySelector(".Catalogo");
const verMas = document.getElementById("verMas");
let currentPage = 1;

// por hacer = manejar rate limits, eliminar duplicados (problema del api), acomodar css

function buscarManga() {
  catalogo.innerHTML = "";
  const busqueda = document.getElementById("buscar").value.trim().toLowerCase();

  fetch(`https://api.jikan.moe/v4/manga?q=${busqueda}&sfw=true`)
    .then((response) => {
      return response.json();
    })
    .then((data) => {
      console.log(data);
      data.data.forEach((manga) => {
        const mangaDiv = document.createElement("div");
        const mangaLink = document.createElement("a");
        const mangaImg = document.createElement("img");
        const mangaTitulo = document.createElement("p");
        mangaLink.href = manga.url;
        mangaLink.target = "_blank";
        mangaImg.src = manga.images.webp.image_url;
        mangaImg.style.width = '200px';
        mangaImg.style.height = '300px';
        mangaTitulo.textContent = manga.title || manga.title_english;
        mangaLink.appendChild(mangaImg);
        mangaDiv.appendChild(mangaLink);
        mangaDiv.appendChild(mangaTitulo);
        catalogo.appendChild(mangaDiv);
      });
    })
    .catch((error) => {
      if (error.name === 'AbortError') {
        console.error("Request timed out");
      } else {
        console.error("Fetch error:", error);
      }
    });
}

function cargarmangas() {
  catalogo.innerHTML = "";
  switch (categoria) {
    case "populares":
      fetch(`https://api.jikan.moe/v4/top/manga?page=${currentPage}&limit=25`)
        .then((response) => response.json())
        .then((data) => {
          data.data.forEach((manga) => {
            const Popular = document.createElement("div");
            Popular.classList.add("Popular");
            Popular.innerHTML = `<a href="${manga.url}" target="_blank"><img src="${manga.images.jpg.image_url}" alt="${manga.title}"/><p>${manga.title}</p></a>`;
            catalogo.appendChild(Popular);
          });
        });
      break;

    case "Publishing":
    case "Complete":
      fetch(
        `https://api.jikan.moe/v4/manga?status=${categoria}&limit=25&page=${currentPage}`
      )
        .then((response) => response.json())
        .then((data) => {
          data.data.forEach((manga) => {
            const Popular = document.createElement("div");
            Popular.classList.add("Popular");
            Popular.innerHTML = `<a href="${manga.url}" target="_blank"><img src="${manga.images.jpg.image_url}" alt="${manga.title}"/><p>${manga.title}</p></a>`;
            catalogo.appendChild(Popular);
          });
        });
      break;

    default:
      fetch(
        `https://api.jikan.moe/v4/manga?genres=${categoria}&limit=25&page=${currentPage}`
      )
        .then((response) => response.json())
        .then((data) => {
          data.data.forEach((manga) => {
            const Popular = document.createElement("div");
            Popular.classList.add("Popular");
            Popular.innerHTML = `<a href="${manga.url}" target="_blank"><img src="${manga.images.jpg.image_url}" alt="${manga.title}"/><p>${manga.title}</p></a>`;
            catalogo.appendChild(Popular);
          });
        });
      break;
  }
}

cargarmangas();
function functionVerMas() {
  currentPage++;
  cargarmangas();
}

// Arrancar
verMas.addEventListener("click", functionVerMas);
cargarmangas();
