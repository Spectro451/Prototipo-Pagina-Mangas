const params = new URLSearchParams(window.location.search);
const categoria = params.get("categoria");
const catalogo = document.querySelector(".Catalogo");
const busqueda = document.getElementById('buscar');
let currentPage = 1;

// Nota por favor dejar de llamar todo peo

function buscarManga() {
  for (let i = 0; i < catalogo.children.length; i++) {
    if (!catalogo.children[i].innerText.toLowerCase().includes(busqueda.value.toLowerCase())) {
      catalogo.children[i].style.display = 'none';
    } else {
        catalogo.children[i].style.display = '';
    }
  }
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
            Popular.innerHTML = `
                                <a href="${manga.url}" target="_blank">
                                    <img src="${manga.images.jpg.image_url}" alt="${manga.title}" />
                                    <p>${manga.title}</p>
                                </a>
                                `;
            catalogo.appendChild(Popular);
          });
        });
      break;

    case "Publishing":
    case "Complete":
      fetch(`https://api.jikan.moe/v4/manga?status=${categoria}&limit=25`)
        .then((response) => response.json())
        .then((data) => {
          data.data.forEach((manga) => {
            const Popular = document.createElement("div");
            Popular.classList.add("Popular");
            Popular.innerHTML = `
                                <a href="${manga.url}" target="_blank">
                                    <img src="${manga.images.jpg.image_url}" alt="${manga.title}" />
                                    <p>${manga.title}</p>
                                </a>
                            `;
            catalogo.appendChild(Popular);
          });
        });
      break;

    default:
      fetch(`https://api.jikan.moe/v4/manga?genres=${categoria}&limit=25`)
        .then((response) => response.json())
        .then((data) => {
          data.data.forEach((manga) => {
            const Popular = document.createElement("div");
            Popular.classList.add("Popular");
            Popular.innerHTML = `
                                <a href="${manga.url}" target="_blank">
                                    <img src="${manga.images.jpg.image_url}" alt="${manga.title}" />
                                    <p>${manga.title}</p>
                                </a>
                            `;
            catalogo.appendChild(Popular);
          });
        });
      break;
  }
}

cargarmangas();
