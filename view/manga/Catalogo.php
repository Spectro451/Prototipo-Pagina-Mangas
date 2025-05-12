<?php
session_start();
?> 

<!DOCTYPE html>
<html lang="es">
<head>
    <link href="https://fonts.googleapis.com/css2?family=Pixelify+Sans&display=swap" rel="stylesheet"><!--Da acceso para usar pixelify -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet"><!--Da acceso para usar FontAwessome -->
    <link rel="icon" href="../view/img/kitsune.png" type="image/png"><!--Declara el icono de la pagina-->
    <link rel="stylesheet" href="../view/stylesheets/Catalogo.css"><!--Hace la conexion con el style-->
    <meta charset="UTF-8">
    <title>KiwiMangas</title><!--Titulo de la pagina-->
</head>
<body><!--Cuerpo de la pagina-->
    
    <!--barra de descuento-->
    <div class="promo-barra">
        <i>CÓDIGO DE DESCUENTO DE COMPRAS ACA 💖 Usa <b>"NIGERIA10"</b> para 100% de aumento</i>
      </div>
          <!--Darkmode-->
    <button id="btnDarkMode" onclick="cambiarModo()">Cambiar modo 🌓</button>

    <!--Encabezado-->
    <header class="logo-container">
        <a href="PaginaMangaV2.php">
            <img src="../view/img/Logo.png" alt="Logo de la página de mangas"><!--Logo-->
        </a>
    </header><!--Fin del Encabezado-->
     <!--Login con carrito de compra uwu-->

    <!--Seccion Principal-->
    <main>
       <div class="Grid">
            <div class="Busqueda">
                <input type="search" name="peo" id="buscar" placeholder="Busca tu manga Favorito" onchange="buscarMangas()">
                
            </div>
            <div class="Filtros">
                <form id="form-filtros">
                    <fieldset class="filtro-categoria" id="filtro-tipo">
                        <legend>Tipo</legend>
                        <label><input type="radio" name="tipo" value="manga" onchange="aplicarFiltros()"> Manga</label><br>
                        <label><input type="radio" name="tipo" value="novel" onchange="aplicarFiltros()"> Novela</label><br>
                        <label><input type="radio" name="tipo" value="lightnovel" onchange="aplicarFiltros()"> Light Novel</label><br>
                        <label><input type="radio" name="tipo" value="manhwa" onchange="aplicarFiltros()"> Manhwa</label><br>
                        <label><input type="radio" name="tipo" value="manhua" onchange="aplicarFiltros()"> Manhua</label>
                    </fieldset>
                </form>
                <form id="form-filtros2">
                    <fieldset class="filtro-categoria" id="filtro-tipo">
                        <legend>Tipo</legend>
                        <label><input type="checkbox" name="tipo" value="paja" onchange="aplicarNsfw()"> Paja</label><br>
                    </fieldset>
                </form>
                <form id="form-filtros2">
                    <fieldset class="filtro-categoria" id="filtro-tipo">
                        <legend>Tipo</legend>
                        <label><input id="fechaInicio" type="text" name="tipo" value="1934" style="width: 40px;" onkeydown="cambioFecha(event)"> Año de Inicio</label><br>
                        <label><input id="fechaFinal" type="text" name="tipo" value="2025" style="width: 40px;" onkeydown="cambioFecha(event)"> Año ......Final</label><br> <!-- Alineado con psint -->
                    </fieldset>
                </form>
            </div> 
            
            <div class="Catalogo">
               
            </div>
            
            <div class="Paginacion">
                
                
            </div>
       </div>
       
       
       
    </main><!--Fin Seccion Principal-->
   
    <!--Pie de pagina-->
    <footer>
        <!--ContenedorContacto-->
        <div class="ContainerContacto">
            <!--Contenedor Columna-->
            <div class="FooterColumna">
                <h4>Informacion</h4><!--Titulo-->
                <p><a href="#">Quienes Somos?</a></p><!--Parrafo con enlace-->
                <p><a href="#">Tiendas Afiliadas</a></p><!--Parrafo con enlace-->
                <p><a href="https://www.nyan.cat/" target="_blank">Secretito</a></p><!--Parrafo con enlace-->
            </div><!--Fin del Contenedo Columna-->
            <!--Contenedor Columna-->
            <div class="FooterColumna">
                <h4>Servicio al Cliente</h4><!--Titulo-->
                <p><a href="#">Politica de Devoluciones</a></p><!--Parrafo con enlace-->
                <p><a href="#">Terminos y condiciones</a></p><!--Parrafo con enlace-->
                <p><a href="#">Condiciones GiftCard</a></p><!--Parrafo con enlace-->
            </div><!--Fin del Contenedor Columna-->
            <!--Contenedor Columna-->
            <div class="FooterColumna">
                <h4>Contactanos</h4><!--Titulo-->
                <!--Contenedor Social-->
                <div class="Social">
                    <p><!--Parrafo-->
                        <a href="https://facebook.com" target="_blank" class="social-icon"><!--Enlace-->
                            <i class="fab fa-facebook"></i> KiwiMangasUwU<!--Uso del icono-->
                        </a><!--Fin Enlace-->
                    </p><!--Fin Parrafo-->
                    <p><!--Parrafo-->
                        <a href="https://twitter.com" target="_blank" class="social-icon"><!--Enlace-->
                            <i class="fab fa-twitter"></i> Pilin<!--Uso del icono-->
                        </a><!--Fin Enlace-->
                    </p><!--Fin Parrafo-->
                    <p><!--Parrafo-->
                        <a href="https://www.instagram.com/kiwimangas_/" target="_blank" class="social-icon"><!--Enlace-->
                            <i class="fab fa-instagram"></i> @KiwiMangas<!--Uso del icono-->
                        </a><!--Fin Enlace-->
                    </p><!--Fin Parrafo-->
                    <p><!--Parrafo-->
                        <a href="https://linkedin.com" target="_blank" class="social-icon"><!--Enlace-->
                            <i class="fab fa-linkedin"></i> KiwiMangas<!--Uso del icono-->
                        </a><!--Fin Enlace-->
                    </p><!--Fin Parrafo-->
                </div><!--Fin del Contenedor Social-->
            </div><!--Fin del Contenedor Columna-->
            <!--Contenedor Columna-->
            <div class="FooterColumna">
                <img src="../view/img/Logo.png" alt="Logo de la página de mangas"  alt=""><!--Logo-->
            </div><!--Fin del Contenedor Columna-->
        </div><!--Fin del ContenedorContacto-->
    </footer><!--Fin del Pie de pagina-->
    <script src="../view/js/Catalogo.js" defer></script>
    <script src="../view/js/DarkMode.js"></script> <!--darkmode-->
</body><!--Fin del cuerpo de pagina-->
</html>

