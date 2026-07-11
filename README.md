# KiwiMangas

Este es un proyecto web que hice junto a [@camicarrascoi](http://github.com/camicarrascoi) en el cual mostramos un catalogo de mangas el cual proximamente sera tambien con interfaz para la venta de estos mismos, todo por uso de la api publica JikanApi(https://docs.api.jikan.moe)

# Qué hace esta página?

- Permite buscar mangas en tiempo real escribiendo en una barra de búsqueda.
- Muestra listas de mangas populares y personajes populares.
- Permite la muestra de un catalogo en base a categorias para agruparlos de manera sencilla.
- Se pueden aplicar filtros para ordenar por puntuación, fecha o temporada.
- La interfaz se adapta a distintos tamaños de pantalla.

# Menciones honoríficas

- Panchito (criticador de código)
- Antonio (apoyo emocional)
- Luchito S(entretención)

# Tecnologías usadas

- CSS
- JavaScript
- Jikan API (https://docs.api.jikan.moe)
- PHP
- MySQL
- Docker

# Cómo usarlo?

Si quieres descargarlo y probarlo localmente:

```bash
git clone https://github.com/Spectro451/Prototipo-Pagina-Mangas.git
cd Prototipo-Pagina-Mangas
docker compose up --build
```

Luego abre `http://localhost:8000`

lamentablemente la app depende de JikanApi, asi que si no cargan algunos datos favor no reportarlo como error

