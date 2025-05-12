<?php
session_start(); // Necesario para acceder a la sesión

require_once '../model/Favoritos.php';

class favoritosController
{
    public function agregar()
    {
        // Verificamos si el usuario está logueado
        if (isset($_SESSION['usuario'])) {
            $usuario_id = $_SESSION['usuario']['id']; // Asegúrate de que el ID esté en la sesión

            // Recibimos los datos desde el cuerpo de la solicitud (JSON)
            $data = json_decode(file_get_contents('php://input'), true);

            if (isset($data['id'], $data['titulo'], $data['imagen'])) {
                $manga_id = $data['id'];
                $titulo = $data['titulo'];
                $imagen = $data['imagen'];

                $favoritos = new Favoritos();
                $resultado = $favoritos->agregarFavoritos($usuario_id, $manga_id, $titulo, $imagen);

                if ($resultado) {
                    echo json_encode(['success' => true]);
                } else {
                    echo json_encode(['success' => false, 'message' => 'No se pudo guardar el favorito']);
                }
            } else {
                echo json_encode(['success' => false, 'message' => 'Datos incompletos']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Debe iniciar sesión para agregar favoritos']);
        }
    }
}
?>