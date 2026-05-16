
  document.addEventListener("DOMContentLoaded", () => {
    const contenedor = document.getElementById("lista-generos");

    fetch(`${API_BASE}/genres/manga`)
    .then(response => response.json())
    .then(data => {
      const nombresUnicos = new Set();
      data.data.forEach(genero => {
        if (!nombresUnicos.has(genero.name)) {
          nombresUnicos.add(genero.name);
          const div = document.createElement("div");
          div.classList.add("genero");
          div.innerHTML = `
          <a href="index.php?controller=kiwi&action=catalogo&categoria=${genero.mal_id}">${genero.name}</a>
          `;
          contenedor.appendChild(div);
        }
      });
    })
    .catch(error => {
      console.error("Error al obtener los géneros:", error);
    });
  
  });

