<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
</head>
<body>
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
</body>
</html>
<style>
    * {
    box-sizing: border-box;
}
body {
    font-family: Arial, sans-serif;
    background-color:rgb(252, 207, 237);
    padding: 20px;
}

form {
    background-color:rgb(255, 183, 255);
    padding: 30px;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    width: 500px;
    height: 350px;
    margin: 0 auto;
}

input {
    width: 100%;
    padding: 10px;
    margin: 10px 0;
    border: 1px solid #ccc;
    border-radius: 5px;
}

button {
    padding: 10px 15px;
    background-color: #4CAF50;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    width: 100%;
    margin: 10px auto;
}

button:hover {
    background-color: #45a049;
}

h2 {
    text-align: center;
}

a {
    display: block;
    text-align: center;
    margin-top: 10px;
    color: #007BFF;
    text-decoration: none;
}

a:hover {
    text-decoration: underline;
}
@media only screen and (max-width: 1000px)
{
input {
   font-size: 18px;
}
button {
    font-size: 18px;
}

}
</style>