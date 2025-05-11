<?php
session_start();
?>



<!DOCTYPE html>
<html lang="es">
<head>
    <link href="https://fonts.googleapis.com/css2?family=Pixelify+Sans&display=swap" rel="stylesheet"><!--Da acceso para usar pixelify -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet"><!--Da acceso para usar FontAwessome -->
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500;700&display=swap" rel="stylesheet">
    <link rel="icon" href="../view/img/kitsune.png" type="image/png"><!--Declara el icono de la pagina-->
    <link rel="stylesheet" href="../view/stylesheets/style.css"><!--Hace la conexion con el style-->
    <meta charset="UTF-8">
    <title>KiwiMangas</title><!--Titulo de la pagina-->
</head>
<body><!--Cuerpo de la pagina-->

    <!--barra de descuento-->
    <div class="promo-barra">
        <i>CÓDIGO DE DESCUENTO DE COMPRAS ACA 💖 Usa <b>"KIWI10"</b> para 10% off</i>
      </div>
    
    <!--Darkmode-->
    <button id="btnDarkMode" onclick="cambiarModo()">Cambiar modo 🌓</button>

    <!--Encabezado-->
    <header class="logo-container">
        <a href="PaginaMangaV2.php">
            <img src="../view/img/Logo.png" alt="Logo de la página de mangas"><!--Logo-->
        </a>
    </header>
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
                <!-- Formulario de Cerrar Sesión -->
                <form action="../public/index.php?controller=Usuario&action=logout" method="POST">
                    <button type="submit">Cerrar sesión</button>
                    
                    <?php if (!empty($_SESSION['usuario']['admin']) && $_SESSION['usuario']['admin'] === 'SI'): ?>
                        <!-- Botón Panel Admin con type="button" para no enviar el formulario -->
                        <button type="button" onclick="window.location.href='../public/index.php?controller=Usuario&action=listarUsuarios'">Panel Admin</button>
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

</div>
    <!--Seccion Principal-->
    <main>
        <div class="Busqueda">
            <input type="search" id="buscarTitulo" placeholder="Busca tu manga favorito" onchange="redirigirBusqueda()">
          </div>
        <!--Contenedor recomendaciones-->
        <div class="Recomm">
            <p>Nuestras Recomendaciones UwU</p><!--Parrafo-->
        </div><!--Fin del Contenedor peo-->
        <!--ContenedorImagenes-->
        <div class="contenedorImagenes">
           <!--Contenedor MangaFoto-->
            <div class="mangafoto">
                <a href="Detalles.php?id=4632">
                <img src="https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEjHfz13bXceGVN-pF5clN1F8VOyliDaY0oszbjyKT0utdU47awlgrdwtw0rC2C2wK1Q_mlvax6BMZ7YxXZs7psAHTtiSwu3j1vUGsu5wCx0va3MXB1vLCo4SdN33Fw-hM40qYXAi10lsgY/s1600/punpun.png" alt=""><!--Imagen-->
                <p class="Titulo">Oyasumin Punpun</p><!--Parrafo-->
                </a>
            </div><!--Fin del Contenedor MangaFoto-->
            <!--Contenedor MangaFoto-->
            <div class="mangafoto">
                <a href="Detalles.php?id=2">
                <img src="https://cdn.myanimelist.net/images/about_me/main_visual/18524224-de15dfc4-330e-4944-afd3-959eecfcec03.png?t=1734909623" alt=""><!--Imagen-->
                <p class="Titulo">Berserk</p><!--Parrafo-->
                </a>
            </div><!--Fin del Contenedor MangaFoto-->
            <!--Contenedor MangaFoto-->
            <div class="mangafoto">
                <a href="Detalles.php?id=28">
                <img src="https://areajugones.sport.es/wp-content/uploads/2025/01/nana-hiatus-manga-1.jpg" alt=""><!--Imagen-->
                <p class="Titulo">Nana</p><!--Parrafo-->
                </a>
            </div><!--Fin del Contenedor MangaFoto-->
            <!--Contenedor MangaFoto-->
            <div class="mangafoto">
                <a href="Detalles.php?id=116778">
                <img src="https://i0.wp.com/elpalomitron.com/wp-content/uploads/2020/10/Resena-de-Chainsaw-Man-destacada-El-Palomitron.jpg?resize=1000%2C600&ssl=1" alt=""><!--Imagen-->
                <p class="Titulo">MotoSierra</p><!--Parrafo-->
                </a>
            </div><!--Fin del Contenedor MangaFoto-->
            <!--Contenedor MangaFoto-->
            <div class="mangafoto">
                <a href="Detalles.php?id=26">
                <img src="https://lavacajaponesa.com/wp-content/uploads/2024/10/91f6iVYeN0L._SL1500_.jpg" alt=""><!--Imagen-->
                <p class="Titulo">HunterxHunter</p><!--Parrafo-->
                </a>
            </div><!--Fin del Contenedor MangaFoto-->
            <!--Contenedor MangaFoto-->
            <div class="mangafoto">
                <a href="Detalles.php?id=126287">
                <img src="https://www.anmosugoi.com/wp-content/uploads/2022/08/Sousou-no-Frieren-manga-vol-9-min.jpg" alt=""><!--Imagen-->
                <p class="Titulo">Frieren</p><!--Parrafo-->
                </a>
            </div><!--Fin del Contenedor MangaFoto-->
        </div><!--Fin del ContenedorImagenes-->
    </main><!--Fin Seccion Principal-->
    <section class="Populares">
        <div class="Container">
          <p>Populares🔥</p>
        </div>
        <div class="ListaPopulares mangas"></div>
    </section>
    <section class="Populares">
        <div class="Container">
          <p>Los personajes mas aclamados❤️</p> 
        </div>
        <div class="ListaPopulares personajes"></div>
    </section>
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
    <script src="../view/js/Populares.js"></script>
    <script src="../view/js/DarkMode.js"></script> <!--darkmode-->
</body><!--Fin del cuerpo de pagina-->
</html>

