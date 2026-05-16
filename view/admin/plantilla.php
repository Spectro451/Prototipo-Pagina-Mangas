<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <link href="https://fonts.googleapis.com/css2?family=Pixelify+Sans&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500;700&display=swap" rel="stylesheet">
    <link rel="icon" href="../view/img/kitsune.png" type="image/png">
    <link rel="stylesheet" href="../view/stylesheets/plantilla.css">
    <?php if (isset($styles)) echo $styles; ?>
    <meta charset="UTF-8">
    <title><?= isset($title) ? $title : 'KiwiMangas' ?></title>
</head>
<body>
    <?php
    $flashError = getFlash('error');
    $flashSuccess = getFlash('success');
    if ($flashError): ?>
        <div class="flash-message flash-error"><?= htmlspecialchars($flashError) ?></div>
    <?php endif; ?>
    <?php if ($flashSuccess): ?>
        <div class="flash-message flash-success"><?= htmlspecialchars($flashSuccess) ?></div>
    <?php endif; ?>
    <!--barra de descuento-->
    <div class="promo-barra">
        <i>CÓDIGO DE DESCUENTO DE COMPRAS ACA 💖 Usa <b>"KIWI10"</b> para 10% off</i>
      </div>
    <!--Darkmode-->
    <button id="btnDarkMode" onclick="cambiarModo()">Cambiar modo 🌓</button>
    <!-- Encabezado -->
    <header class="logo-container">
        <a href="index.php?controller=kiwi&action=paginaManga">
            <img src="../view/img/Logo.png" alt="Logo de la página de mangas">
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
                <form action="../public/index.php?controller=Auth&action=login" method="POST">
                    <input type="email" name="correo" placeholder="Correo" required>
                    <input type="password" name="clave" placeholder="Contraseña" required>
                    <button type="submit">Entrar</button>
                </form>
                <button type="button" onclick="window.location.href='../public/index.php?controller=Auth&action=registro'">Registrarse</button>
            <?php endif; ?>
            <?php if (isset($_SESSION['usuario'])): ?>
                <form action="../public/index.php?controller=Auth&action=logout" method="POST">
                    <button type="submit">Cerrar sesión</button>
                    
                    <?php if (!empty($_SESSION['usuario']['admin']) && $_SESSION['usuario']['admin'] === 'SI'): ?>
                        <button type="button" onclick="window.location.href='../public/index.php?controller=Admin&action=listarUsuarios'">Panel Admin</button>
                    <?php endif; ?>
                </form>
            <?php endif; ?>
        </div>
    </div>
</div>
    <!--Navegacion-->
<nav class="menu">
    <ul><!--Lista Principal del menu-->
        <li><a href="index.php?controller=kiwi&action=paginaManga">INICIO</a></li><!--Enlace a inicio-->
        <li><!--Lista-->
            <a href="index.php?controller=kiwi&action=categorias">CATEGORIAS</a><!--Opcion con submenu-->
            <div class="Submenu"><!--Submenu-->
                <ul><!--Lista de Categorias-->
                    <a href="index.php?controller=kiwi&action=catalogo&categoria=populares"><li>Populares ✨</li></a>
                    <a href="index.php?controller=kiwi&action=catalogo&categoria=1"><li>Acción ✨</li></a>
                    <a href="index.php?controller=kiwi&action=catalogo&categoria=4"><li>Comedia ✨</li></a>
                    <a href="index.php?controller=kiwi&action=catalogo&categoria=22"><li>Romance ✨</li></a>
                    <a href="index.php?controller=kiwi&action=catalogo&categoria=2"><li>Aventura ✨</li></a>
                    <a href="index.php?controller=kiwi&action=catalogo&categoria=62"><li>Isekai ✨</li></a>
                    <a href="index.php?controller=kiwi&action=catalogo&categoria=Publishing"><li>En emisión ✨</li></a>
                    <a href="index.php?controller=kiwi&action=catalogo&categoria=Complete"><li>Finalizados ✨</li></a>
                </ul><!--Fin Lista de Categorias-->
            </div><!--Fin Submenu-->
        </li>
        <li><a href="index.php?controller=kiwi&action=catalogo&categoria=populares">CATALOGO</a></li><!--Enlace a catalogo-->
        <?php if (isset($_SESSION['usuario'])): ?>
<li><a href="index.php?controller=favoritos&action=listarFavoritos">FAVORITOS</a></li><!--Enlace a catalogo-->
        <li><a href="index.php?controller=kiwi&action=ayuda">AYUDA</a></li><!--Enlace a Ayuda-->
        
        <?php if (!empty($_SESSION['usuario']['admin']) && $_SESSION['usuario']['admin'] === 'SI'): ?>
            <li>
                <a href="../public/index.php?controller=Admin&action=listarUsuarios">PANEL ADMIN</a>
                <div class="Submenu"><!--Submenu-->
                <ul><!--Lista de Categorias-->
                    <a href="?controller=Admin&action=listarUsuarios"><li>Listar Usuarios</li></a>
                    <a href="?controller=Auth&action=registro"><li>Crear Usuarios</li></a>
                </ul><!--Fin Lista de Categorias-->
                </div><!--Fin Submenu-->
            </li>
        <?php endif; ?>

    </ul><!--Fin de la lista principal-->
</nav><!--Fin De navegacion-->

    <!-- Contenido principal -->
    <main>
        <?php require $contenido; ?>
    </main>

    <!-- Pie de página -->
    <footer>
        <div class="ContainerContacto">
            <div class="FooterColumna">
                <h4>Información</h4>
                <p><a href="index.php?controller=kiwi&action=quienesSomos">Quiénes Somos?</a></p>
                <p><a href="index.php?controller=kiwi&action=afiliados">Tiendas Afiliadas</a></p>
                <p><a href="https://www.nyan.cat/" target="_blank">Secretito</a></p>
            </div>
            <div class="FooterColumna">
                <h4>Servicio al Cliente</h4>
                <p><a href="index.php?controller=kiwi&action=politicas">Política de Devoluciones</a></p>
                <p><a href="index.php?controller=kiwi&action=terminos">Términos y condiciones</a></p>
                
            </div>
            <div class="FooterColumna">
                <h4>Contáctanos</h4>
                <div class="Social">
                    <p><a href="https://facebook.com" target="_blank"><i class="fab fa-facebook"></i> KiwiMangas</a></p>
                    <p><a href="https://twitter.com" target="_blank"><i class="fab fa-twitter"></i> KiwiMangas</a></p>
                    <p><a href="https://www.instagram.com/kiwimangas_/" target="_blank"><i class="fab fa-instagram"></i> @kiwimangas_</a></p>
                    <p><a href="https://www.linkedin.com/in/kiwi-mangas-5a15ba365/" target="_blank"><i class="fab fa-linkedin"></i> KiwiMangas</a></p>
                </div>
            </div>
            <div class="FooterColumna">
                <img src="../view/img/Logo.png" alt="Logo de la página de mangas">
            </div>
        </div>
    </footer>
    <script>
        window.usuario_id = <?php echo isset($_SESSION['usuario']['id']) ? $_SESSION['usuario']['id'] : 'null'; ?>;
    </script>
    <script src="../view/js/DarkMode.js"></script>
    <?php if (isset($scripts)) echo $scripts; ?>
</body>
</html>
