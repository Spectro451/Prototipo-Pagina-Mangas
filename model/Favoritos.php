<?php
require_once '../config/base.php';
class Favoritos
{
    private $pdo;
    function __construct()
    {
        $this->pdo = Conexion();
    }
    public function agregarFavoritos($usuario_id, $manga_id, $titulo, $imagen)
    {
        $query = "INSERT INTO favoritos(usuario_id, manga_id, titulo, imagen) VALUES (?,?,?,?)";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$usuario_id, $manga_id, $titulo, $imagen]);
        return $stmt;
    }
     public function listarFavoritos($usuario_id)
    {
        $query = "SELECT * FROM favoritos WHERE usuario_id = ?";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$usuario_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function verificarFavorito($usuario_id, $manga_id)
    {
        $query = "SELECT COUNT(*) FROM favoritos WHERE usuario_id = ? AND manga_id = ?";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$usuario_id, $manga_id]);
        
        // Si el conteo es mayor que 0, significa que el manga ya está en los favoritos
        return $stmt->fetchColumn() > 0;
    }
    public function eliminarFavorito($usuario_id, $manga_id)
    {
        $query = "DELETE FROM favoritos WHERE usuario_id = ? AND manga_id = ?";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$usuario_id, $manga_id]);

        return $stmt->rowCount() > 0; // Si se eliminó una fila, devuelve true
    }

}