<?php

require_once '../model/Usuario.php';

class UsuarioController
{
    // Formulario de registro
    public function mostrarFormularioRegistro()
    {
        require '../view/registro.php';
    }

    public function login() {
        $usuarioModel = new Usuario();
            
        // Verificamos si el formulario fue enviado
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['correo'], $_POST['clave'])) {
            $correo = $_POST['correo'];
            $clave = $_POST['clave'];
        
            // Obtener el usuario de la base de datos
            $usuario = $usuarioModel->obtenerUsuarioPorEmail($correo);
            session_start();
            // Si el usuario existe y la contraseña es correcta
            if ($usuario && password_verify($clave, $usuario['password'])) {
                // Guardamos la información del usuario en la sesión
                $_SESSION['usuario'] = [
                    'nombre' => $usuario['nombre'],
                    'email' => $usuario['email'],
                    'admin' => $usuario['admin']
                ];
                // Redirigimos a la página principal (PaginaMangaV2.php)
                header('Location: index.php');
                exit;
            } else {
                // Si los datos son incorrectos, mostramos un mensaje de error
                $_SESSION['mensajeError'] = 'Correo o contraseña incorrectos.';
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                exit;
            }
        }
    }

    public function logout() {
    // Iniciar la sesión
    session_start();

    // Destruir la sesión y limpiar las variables de sesión
    session_unset(); // Elimina todas las variables de sesión
    session_destroy(); // Destruye la sesión

    // Redirigir al usuario a la página de inicio o login
    header('Location: index.php');
    exit;
    }

    // Registro del usuario
    public function registrarUsuario()
    {
        $usuarioModel = new Usuario();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['nombre'] ?? '';
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            if ($nombre && $email && $password) {
                $passwordHash = password_hash($password, PASSWORD_DEFAULT);

                $usuarioExistenteEmail = $usuarioModel->obtenerUsuarioPorEmail($email);
                $usuarioExistenteNombre = $usuarioModel->obtenerUsuarioPorNombre($nombre);

                if ($usuarioExistenteEmail) {
                    echo "<script>alert('El correo ya está registrado.'); window.location.href = '../public/index.php?controller=Usuario&action=mostrarFormularioRegistro';</script>";
                    exit;
                } elseif ($usuarioExistenteNombre) {
                    echo "<script>alert('El nombre de usuario ya está en uso.'); window.location.href = '../public/index.php?controller=Usuario&action=mostrarFormularioRegistro';</script>";
                    exit;
                } else {
                    $resultado = $usuarioModel->crearUsuario($nombre, $email, $passwordHash, 'NO'); 
                    session_start();
                    $_SESSION['usuario'] = [
                        'nombre' => $nombre,
                        'email' => $email
                    ];
                    header('Location: ../view/PaginaMangaV2.php');
                    echo $resultado;
                    exit;
                }
            }
        }
    }
}
