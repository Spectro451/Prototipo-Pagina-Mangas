<head>
    <link rel="stylesheet" href="../view/stylesheets/Detalles.css"><!--Hace la conexion con el style-->
</head>
<body><!--Cuerpo de la pagina-->
    <main>
        <div class="Grid">
            <!-- Barra de búsqueda -->
            <div class="Busqueda">
                <input type="search" id="buscarTitulo" placeholder="Busca tu manga favorito" onchange="redirigirBusqueda()">
              </div>
            
            <!-- Sección de detalles del manga -->
            <section class="Detalles">
                <div class="imagenManga">
                </div>
                <div class="detallesManga">
                   
                </div>
                    <div class="estadisticas">
                    
                    </div>
                
            </section>
    
            <!-- Información adicional -->
            <section class="informacionManga">
                <div id="ranking">
                </div>
                <div id="sinopsis">

                </div>
                <div id="relacionados">
 
                </div>
                <div id="personajes">

                </div>
                <div id="foro">

                </div>
            </section>
        </div>
    </main><!-- Fin Sección Principal -->
    <!--Pie de pagina-->
   
    <script src="../view/js/Detalles.js"></script>

</body><!--Fin del cuerpo de pagina-->
</html>

