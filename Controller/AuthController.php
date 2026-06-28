<?php

require_once '../model/Usuario.php';
require_once '../config/helpers.php';

class AuthController
{
    public function login() {
        $usuarioModel = new Usuario();

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['correo'], $_POST['clave'])) {
            $correo = $_POST['correo'];
            $clave = $_POST['clave'];

            $usuario = $usuarioModel->obtenerUsuarioPorEmail($correo);

            if ($usuario && password_verify($clave, $usuario['password'])) {
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }
                $_SESSION['usuario'] = [
                    'id' => $usuario['id'],
                    'nombre' => $usuario['nombre'],
                    'email' => $usuario['email'],
                    'admin' => $usuario['admin']
                ];
                redirect('index.php?controller=kiwi&action=paginaManga');
            } else {
                setFlash('error', 'Correo o contraseña incorrectos.');
                redirect('index.php?controller=kiwi&action=paginaManga');
            }
        }
    }

    public function logout() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        session_unset();
        session_destroy();
        redirect('index.php?controller=kiwi&action=paginaManga');
    }

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
                    setFlash('error', 'El correo ya está registrado.');
                    redirect('index.php?controller=Auth&action=registro');
                } elseif ($usuarioExistenteNombre) {
                    setFlash('error', 'El nombre de usuario ya está en uso.');
                    redirect('index.php?controller=Auth&action=registro');
                } else {
                    $id = $usuarioModel->crearUsuario($nombre, $email, $passwordHash, 'NO');
                    if (session_status() === PHP_SESSION_NONE) {
                        session_start();
                    }
                    $_SESSION['usuario'] = [
                        'id' => $id,
                        'nombre' => $nombre,
                        'email' => $email,
                        'admin' => 'NO',
                    ];
                    setFlash('success', 'Usuario registrado correctamente.');
                    redirect('index.php?controller=kiwi&action=paginaManga');
                }
            } else {
                setFlash('error', 'Todos los campos son obligatorios.');
                redirect('index.php?controller=Auth&action=registro');
            }
        }
    }

    public function registro()
    {
        $styles = '<link rel="stylesheet" href="../view/stylesheets/Registrar.css">';
        $title = "Registro";
        $contenido = '../view/usuario/crear.php';
        require '../view/admin/plantilla.php';
    }
}
