<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <link href="https://fonts.googleapis.com/css2?family=Pixelify+Sans&display=swap" rel="stylesheet"><!--Da acceso para usar pixelify -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet"><!--Da acceso para usar FontAwessome -->
    <link rel="icon" href="../view/img/" type="image/png"><!--Declara el icono de la pagina-->
    <link rel="stylesheet" href="../view/stylesheets/Personajes.css"><!--Hace la conexion con el style-->
    <meta charset="UTF-8">
    <title>KiwiMangas</title><!--Titulo de la pagina-->
</head>
<body><!--Cuerpo de la pagina-->
    
    <!--barra de descuento-->
    <div class="promo-barra">
        <i>CÓDIGO DE DESCUENTO DE COMPRAS ACA 💖 Usa <b>"KIWI10"</b> para 10% off</i>
      </div>
      <button id="btnDarkMode" onclick="cambiarModo()">Cambiar modo 🌓</button>
    <!--Encabezado-->
    <header class="logo-container">
        <a href="PaginaMangaV2.php">
            <img src="../view/img/Logo.png" alt="Logo de la página de mangas"><!--Logo-->
        </a>
    </header><!--Fin del Encabezado-->
     <!--Login con carrito de compra uwu-->
     <div class="iconos-superiores"> 
    <div class="login-desplegable">
        <i class="fas fa-user"></i> 
        <?php if (isset($_SESSION['usuario'])): ?>
            <?php echo htmlspecialchars($_SESSION['usuario']['nombre']); ?>
        <?php else: ?>
            Iniciar sesión
        <?php endif; ?>

        <div class="formulario-login">
            <?php if (!isset($_SESSION['usuario'])): ?>
                <form action="../public/index.php?controller=Usuario&action=login" method="POST">
                    <input type="email" name="correo" placeholder="Correo" required>
                    <input type="password" name="clave" placeholder="Contraseña" required>
                    <button type="submit">Entrar</button>
                </form>
                <button onclick="location.href='registro.php'">Registrarse</button>

            <?php if (isset($_SESSION['mensajeError'])): ?>
                <script type="text/javascript">
                alert("<?php echo $_SESSION['mensajeError']; ?>");
                </script>
                <?php unset($_SESSION['mensajeError']); // Limpiar el mensaje después de mostrarlo ?>
            <?php endif; ?>
            <?php else: ?>
                <form action="../public/index.php?controller=Usuario&action=logout" method="POST">
                    <button type="submit">Cerrar sesión</button>
                    <?php if ($_SESSION['usuario']['admin'] === 'SI'): ?>
                    <button type="button" onclick="window.location.href='../admin/panel_admin.php'">Panel Admin</button>
                <?php endif; ?>
                </form>
            <?php endif; ?>
        </div>
    </div>
        <div class="carrito">
        <i class="fas fa-shopping-cart"></i>
        <span class="contador-carrito">(0)</span>
        </div>
    </div>
</div>
    <!--Navegacion-->
    <nav class="menu">
        <ul><!--Lista Principal del menu-->
            <li><a href="PaginaMangaV2.php">INICIO</a></li><!--Enlace a inicio-->
            <li><!--Lista-->
                <a href="Categorias.php">CATEGORIAS</a><!--Opcion con submenu-->
                <div class="Submenu"><!--Submenu-->
                    <ul><!--Lista de Categorias-->
                        <a href="Catalogo.php"><li>Populares ✨</li></a><!--Opcion Categorias-->
                        <a href="Catalogo.php?categoria=1"><li>Acción ✨</li></a><!--Opcion Categorias-->
                        <a href="Catalogo.php?categoria=4"><li>Comedia ✨</li></a><!--Opcion Categorias-->
                        <a href="Catalogo.php?categoria=22"><li>Romance ✨</li></a><!--Opcion Categorias-->
                        <a href="Catalogo.php?categoria=2"><li>Aventura ✨</li></a><!--Opcion Categorias-->
                        <a href="Catalogo.php?categoria=62"><li>Isekai ✨</li></a><!--Opcion Categorias-->
                        <a href="Catalogo.php?categoria=Publishing"><li>En emisión ✨</li></a><!--Opcion Categorias-->
                        <a href="Catalogo.php?categoria=Complete"><li>Finalizados ✨</li></a><!--Opcion Categorias-->
                    </ul><!--Fin Lista de Categorias-->
                </div><!--Fin Submenu-->
            </li>
            <li><a href="Catalogo.php">CATALOGO</a></li><!--Enlace a catalogo-->
            <li><a href="#">AYUDA</a></li><!--Enlace a Ayuda-->
        </ul><!--Fin de la lista principal-->
    </nav><!--Fin De navegacion-->
    <!--Seccion Principal-->
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
    <script src="../view/js/Personajes.js"></script>
    <script src="../view/js/DarkMode.js"></script> <!--darkmode-->
</body><!--Fin del cuerpo de pagina-->
</html>

