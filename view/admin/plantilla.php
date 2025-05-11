
<!DOCTYPE html>
<html lang="es">
<head>
    <link href="https://fonts.googleapis.com/css2?family=Pixelify+Sans&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500;700&display=swap" rel="stylesheet">
    <link rel="icon" href="../img/kitsune.png" type="image/png">
    <link rel="stylesheet" href="../stylesheets/style.css">
    <meta charset="UTF-8">
    <title>KiwiMangas</title>
</head>
<body>
    <!-- Encabezado -->
    <header class="logo-container">
        <a href="PaginaMangaV2.php">
            <img src="../img/Logo.png" alt="Logo de la página de mangas">
        </a>
    </header>
<main>
    <h2>Registro de Usuario</h2>

    <!-- Formulario de registro -->
    <form action="../public/index.php?controller=Usuario&action=registrarUsuario" method="POST">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" placeholder="Nombre" required>

        <label for="email">Correo:</label>
        <input type="email" name="email" id="email" placeholder="Correo electrónico" required>

        <label for="password">Contraseña:</label>
        <input type="password" name="password" id="password" placeholder="Contraseña" required>

        <button type="submit">Registrarse</button>
    </form>

    <p><a href="PaginaMangaV2.php">¿Ya tienes cuenta? Iniciar sesión</a></p>
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
                <img src="../img/Logo.png" alt="Logo de la página de mangas">
            </div>
        </div>
    </footer>

    <script src="../js/Populares.js"></script>
    <script src="../js/DarkMode.js"></script>
</body>
</html>
