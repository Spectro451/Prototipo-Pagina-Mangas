<?php

require_once '../model/Usuario.php';
require_once '../config/helpers.php';

class AuthController
{
    public function mostrarFormularioRegistro()
    {
        require '../view/usuario/crear.php';
    }

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
                    $usuarioModel->crearUsuario($nombre, $email, $passwordHash, 'NO');
                    $id = $usuarioModel->obtenerUsuarioPorNombre($nombre)['id'];
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

    public function listarUsuarios()
    {
        $this->requerirAdmin();
        $styles = '<link rel="stylesheet" href="../view/stylesheets/Listar.css">';
        $title = "ListaUsuarios";
        $usuarioModel = new Usuario();
        $usuarios = $usuarioModel->listarUsuario();
        $contenido = '../view/usuario/listar.php';
        require '../view/admin/plantilla.php';
    }

    public function registro()
    {
        $styles = '<link rel="stylesheet" href="../view/stylesheets/Registrar.css">';
        $title = "Registro";
        $contenido = '../view/usuario/crear.php';
        require '../view/admin/plantilla.php';
    }

    private function requerirAdmin()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['admin'] !== 'SI') {
            redirect('index.php?controller=kiwi&action=paginaManga');
        }
    }
}