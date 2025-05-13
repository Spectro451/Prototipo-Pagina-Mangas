<?php
session_start();
require_once '../model/Favoritos.php';

class favoritosController
{
    private $favoritos;

    public function __construct()
    {
        $this->favoritos = new Favoritos();
    }

    public function toggleFavorito()
    {
        if (isset($_SESSION['usuario'])) {
            $usuario_id = $_SESSION['usuario']['id'];
            $data = json_decode(file_get_contents('php://input'), true);

            if (isset($data['id'], $data['titulo'], $data['imagen'])) {
                $manga_id = $data['id'];
                $titulo = $data['titulo'];
                $imagen = $data['imagen'];

                if ($this->favoritos->verificarFavorito($usuario_id, $manga_id)) {
                    // Ya está en favoritos, eliminarlo
                    $resultado = $this->favoritos->eliminarFavorito($usuario_id, $manga_id);

                    if ($resultado) {
                        echo json_encode(['success' => true, 'message' => 'Manga eliminado de favoritos', 'estado' => 'eliminado']);
                    } else {
                        echo json_encode(['success' => false, 'message' => 'Error al eliminar el manga de favoritos']);
                    }
                } else {
                    // No está en favoritos, agregarlo
                    $resultado = $this->favoritos->agregarFavoritos($usuario_id, $manga_id, $titulo, $imagen);

                    if ($resultado) {
                        echo json_encode(['success' => true, 'message' => 'Manga agregado a favoritos', 'estado' => 'agregado']);
                    } else {
                        echo json_encode(['success' => false, 'message' => 'Error al agregar el manga a favoritos']);
                    }
                }
            } else {
                echo json_encode(['success' => false, 'message' => 'Datos incompletos. Faltan ID, título o imagen']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Debe iniciar sesión para modificar sus favoritos']);
        }
    }
    public function verificar()
    {
        if (isset($_SESSION['usuario'])) {
            $usuario_id = $_SESSION['usuario']['id'];
            $data = json_decode(file_get_contents('php://input'), true);

            if (isset($data['id'])) {
                $manga_id = $data['id'];
                $existe = $this->favoritos->verificarFavorito($usuario_id, $manga_id);
                echo json_encode(['favorito' => $existe]);
            } else {
                echo json_encode(['favorito' => false, 'message' => 'ID del manga no recibido']);
            }
        } else {
            echo json_encode(['favorito' => false, 'message' => 'Usuario no autenticado']);
        }
    }
    public function listarFavoritos() 
    {
        
        
        $usuario_id = $_SESSION['usuario']['id'];
        
        $modelo = new Favoritos();
        $favoritos = $modelo->listarFavoritos($usuario_id);
        
        $title = "Favoritos";
        $styles = '<link rel="stylesheet" href="../view/stylesheets/Favoritos.css">';
        $scripts = '<script src="../view/js/Favoritos.js"></script>';
        $contenido = '../view/favoritos/Favoritos.php';
        require '../view/admin/plantilla.php';
        
    }
}
?>
