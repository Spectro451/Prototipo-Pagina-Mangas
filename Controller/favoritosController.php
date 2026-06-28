<?php
require_once '../model/Favoritos.php';
require_once '../config/helpers.php';

class favoritosController
{
    private $favoritos;

    public function __construct()
    {
        $this->favoritos = new Favoritos();
    }

    public function toggleFavorito()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['usuario'])) {
            respondJSON(['success' => false, 'message' => 'Debe iniciar sesión para modificar sus favoritos']);
        }
        $usuario_id = $_SESSION['usuario']['id'];
        $data = json_decode(file_get_contents('php://input'), true);

        if (!isset($data['id'], $data['titulo'], $data['imagen'])) {
            respondJSON(['success' => false, 'message' => 'Datos incompletos. Faltan ID, título o imagen']);
        }

        $manga_id = $data['id'];
        $titulo = $data['titulo'];
        $imagen = $data['imagen'];

        if ($this->favoritos->verificarFavorito($usuario_id, $manga_id)) {
            $resultado = $this->favoritos->eliminarFavorito($usuario_id, $manga_id);
            if ($resultado) {
                respondJSON(['success' => true, 'message' => 'Manga eliminado de favoritos', 'estado' => 'eliminado']);
            } else {
                respondJSON(['success' => false, 'message' => 'Error al eliminar el manga de favoritos']);
            }
        } else {
            $resultado = $this->favoritos->agregarFavoritos($usuario_id, $manga_id, $titulo, $imagen);
            if ($resultado) {
                respondJSON(['success' => true, 'message' => 'Manga agregado a favoritos', 'estado' => 'agregado']);
            } else {
                respondJSON(['success' => false, 'message' => 'Error al agregar el manga a favoritos']);
            }
        }
    }

    public function verificar()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['usuario'])) {
            respondJSON(['favorito' => false, 'message' => 'Usuario no autenticado']);
        }
        $usuario_id = $_SESSION['usuario']['id'];
        $data = json_decode(file_get_contents('php://input'), true);

        if (!isset($data['id'])) {
            respondJSON(['favorito' => false, 'message' => 'ID del manga no recibido']);
        }

        $manga_id = $data['id'];
        $existe = $this->favoritos->verificarFavorito($usuario_id, $manga_id);
        respondJSON(['favorito' => $existe]);
    }

    public function listarFavoritos()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['usuario'])) {
            redirect('index.php?controller=kiwi&action=paginaManga');
        }
        $usuario_id = $_SESSION['usuario']['id'];

        $favoritos = $this->favoritos->listarFavoritos($usuario_id);

        $title = "Favoritos";
        $styles = '<link rel="stylesheet" href="../view/stylesheets/Favoritos.css">';
        $scripts = '<script src="../view/js/Favoritos.js"></script>';
        $contenido = '../view/favoritos/Favoritos.php';
        require '../view/admin/plantilla.php';
    }
}
?>
