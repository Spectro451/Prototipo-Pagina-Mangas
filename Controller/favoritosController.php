<?php
require_once '../model/Favoritos.php';

class favoritosController
{
    public function agregar()
    {
        session_start();
        if (isset($_SESSION['usuario'])) 
        {
            $usuario_id = $_SESSION['usuario']['id'];
            $data = json_decode(file_get_contents('php://input'), true);

            if (isset($data['id'], $data['titulo'], $data['imagen'])) 
            {
                $manga_id = $data['id'];
                $titulo = $data['titulo'];
                $imagen = $data['imagen'];

                $favoritos = new Favoritos();

                $mangaExistente = $favoritos->verificarFavorito($usuario_id, $manga_id);
        
                if ($mangaExistente) 
                {
                    echo json_encode(['success' => false, 'message' => 'Este manga ya está en tus favoritos.']);
                } 
                else 
                {
                $resultado = $favoritos->agregarFavoritos($usuario_id, $manga_id, $titulo, $imagen);
                if ($resultado) 
                {
                    echo json_encode(['success' => true]);
                } 
                else 
                {
                    echo json_encode(['success' => false, 'message' => 'No se pudo agregar a favoritos']);
                }
                }
            }    
            else 
            {
                echo json_encode(['success' => false, 'message' => 'Datos incompletos']);
            }
        } 
        else 
        {
        echo json_encode(['success' => false, 'message' => 'Debe iniciar sesión para agregar favoritos']);
        }
    }
    public function eliminarFavorito()
    {
        if (isset($_SESSION['usuario'])) {
        $usuario_id = $_SESSION['usuario']['id'];
        
        // Recibimos los datos enviados desde el frontend (JavaScript)
        $data = json_decode(file_get_contents('php://input'), true);

        if (isset($data['id'])) {
            $manga_id = $data['id'];

            // Crear una instancia del modelo Favoritos
            $favoritos = new Favoritos();

            // Eliminar el manga de los favoritos del usuario
            $resultado = $favoritos->eliminarFavorito($usuario_id, $manga_id);

            if ($resultado) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'message' => 'No se pudo eliminar el manga de favoritos']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Datos incompletos']);
        }
        } 
        else 
        {
        echo json_encode(['success' => false, 'message' => 'Debe iniciar sesión para eliminar favoritos']);
        }
    }
}
?>