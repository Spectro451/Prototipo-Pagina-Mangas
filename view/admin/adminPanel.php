<?php
session_start();
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['admin'] !== 'SI') {
    header('Location: ../view/PaginaMangaV2.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <link href="https://fonts.googleapis.com/css2?family=Pixelify+Sans&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500;700&display=swap" rel="stylesheet">
    <link rel="icon" href="../view/img/kitsune.png" type="image/png">
    <link rel="stylesheet" href="../view/stylesheets/style.css">
    <meta charset="UTF-8">
    <title>KiwiMangas - Panel Admin</title>
</head>
<body>
    <!-- Encabezado -->
    <header class="logo-container">
        <a href="../view/PaginaMangaV2.php">
            <img src="../view/img/Logo.png" alt="Logo de la página de mangas">
        </a>
    </header>
<main>
    <h2>Panel de Administración</h2>
    <a href="?controller=Usuario&action=listarUsuarios">Listar Usuarios</a>
    <a href="?controller=Usuario&action=registro">Crear Usuarios</a>
    <a href="?controller=Usuario&action=logout">Cerrar sesion</a>
    <?php require $contenido; ?>
</main>

    <!-- Pie de página -->
    <footer>
        <div class="ContainerContacto">
            <div class="FooterColumna">
                <h4>Información</h4>
                <p><a href="#">Quiénes Somos?</a></p>
                <p><a href="#">Tiendas Afiliadas</a></p>
                <p><a href="https://www.nyan.cat/" target="_blank">Secretito</a></p>
            </div>
            <div class="FooterColumna">
                <h4>Servicio al Cliente</h4>
                <p><a href="#">Política de Devoluciones</a></p>
                <p><a href="#">Términos y condiciones</a></p>
                <p><a href="#">Condiciones GiftCard</a></p>
            </div>
            <div class="FooterColumna">
                <h4>Contáctanos</h4>
                <div class="Social">
                    <p><a href="https://facebook.com" target="_blank"><i class="fab fa-facebook"></i> KiwiMangas</a></p>
                    <p><a href="https://twitter.com" target="_blank"><i class="fab fa-twitter"></i> Pilin</a></p>
                    <p><a href="https://www.instagram.com/kiwimangas_/" target="_blank"><i class="fab fa-instagram"></i> @KiwiMangas</a></p>
                    <p><a href="https://linkedin.com" target="_blank"><i class="fab fa-linkedin"></i> KiwiMangas</a></p>
                </div>
            </div>
            <div class="FooterColumna">
                <img src="../view/img/Logo.png" alt="Logo de la página de mangas">
            </div>
        </div>
    </footer>

    <script src="../view/js/Populares.js"></script>
    <script src="../view/js/DarkMode.js"></script>
</body>
</html>
