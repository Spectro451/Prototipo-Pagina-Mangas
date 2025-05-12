
<head>
    <link rel="stylesheet" href="../view/stylesheets/Personajes.css"><!--Hace la conexion con el style-->
</head>
<body><!--Cuerpo de la pagina-->
    <main>
        <div class="Grid">
            <!-- Barra de búsqueda -->
            <div class="Busqueda">
                <input type="search" id="buscarTitulo" placeholder="Busca tu manga favorito" onchange="redirigirBusqueda()">
              </div>
            <section class="Detalles">
                <div class="imagenPersonaje">
                </div>
                <div class="detallesPersonaje">
                </div>
                <div class="aparicionesAnime">
                </div>
                <div class="aparicionesManga">
                </div>
                <div class="estadisticas">
                </div>
            </section>
    
            <!-- Información adicional -->
            <section class="informacionPersonaje">
                <div id="info">
                    <h4>Info</h4>
                    <hr>
                   <!-- en la api es ranking -->
                </div>
                <h4>Actor de voz</h4>
                <div id="voz">
                    
                    
                    <!-- en la api es sinopsis -->
                </div>
            </section>
        </div>
    </main><!-- Fin Sección Principal -->
    <!--Pie de pagina-->
    
    <script src="../view/js/Personajes.js"></script>
</body><!--Fin del cuerpo de pagina-->
</html>

