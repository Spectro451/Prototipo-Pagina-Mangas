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
}