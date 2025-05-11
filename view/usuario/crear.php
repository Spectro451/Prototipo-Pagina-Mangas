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