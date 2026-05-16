<?php

require_once '../model/Usuario.php';
require_once '../config/helpers.php';

class AdminController
{
    private function requerirAdmin()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['admin'] !== 'SI') {
            redirect('index.php?controller=kiwi&action=paginaManga');
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

    public function modificarUsuario()
    {
        $this->requerirAdmin();
        $title = "Modificar";
        $styles = '<link rel="stylesheet" href="../view/stylesheets/Modificar.css">';
        $id = $_POST['id_usuario'] ?? 0;
        $usuario = new Usuario();
        $usuarios = $usuario->obtenerUsuarioid($id);
        $contenido = '../view/usuario/modificar.php';
        require '../view/admin/plantilla.php';
    }

    public function guardarModificacionUsuario()
    {
        $this->requerirAdmin();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id_usuario'] ?? 0;
            $nombre = $_POST['nombre'] ?? '';
            $email = $_POST['email'] ?? '';
            $admin = $_POST['admin'] ?? 'NO';

            if ($id && $nombre && $email) {
                $usuarioModel = new Usuario();
                $usuarioModel->modificarUsuario($id, $nombre, $email, $admin);
                setFlash('success', 'Usuario modificado correctamente.');
                redirect('index.php?controller=Admin&action=listarUsuarios');
            } else {
                setFlash('error', 'Faltan datos para actualizar.');
                redirect('index.php?controller=Admin&action=listarUsuarios');
            }
        }
    }

    public function eliminarUsuario()
    {
        $this->requerirAdmin();
        $id = $_POST['id_usuario'] ?? 0;
        $usuario = new Usuario();
        $eliminado = $usuario->eliminarUsuario($id);
        if ($eliminado) {
            setFlash('success', 'Usuario eliminado correctamente.');
            redirect('index.php?controller=Admin&action=listarUsuarios');
        } else {
            setFlash('error', 'Error al borrar el usuario.');
            redirect('index.php?controller=Admin&action=listarUsuarios');
        }
    }
}