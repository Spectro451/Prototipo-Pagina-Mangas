<head>
    <link rel="stylesheet" href="../view/stylesheets/Categorias.css"><!--Hace la conexion con el style-->
</head>
<body><!--Cuerpo de la pagina-->
 
    <main>
       <div class="Grid">
        <div class="Busqueda">
            <input type="search" id="buscarTitulo" placeholder="Busca tu manga favorito" onchange="redirigirBusqueda()">
          </div>
            <section class="contenedor-generos">
                <h2>Explora por Géneros</h2>
                <div class="grid-generos" id="lista-generos">
                  <!-- Los géneros se insertarán aquí con JavaScript -->
                </div>
              </section>
       </div>
    </main><!--Fin Seccion Principal-->
    <script src="../view/js/Categorias.js"></script>
</body><!--Fin del cuerpo de pagina-->
</html>

