<?php

require_once '../config/base.php';

class Usuario
{
    private $pdo;
    function __construct()
    {
        $this->pdo = Conexion();
    }

    public function listarUsuario()
    {
        $query = "SELECT * From usuario";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function crearUsuario($nombre, $email, $passwordHash, $admin = 'NO')
    {
        $query = "INSERT INTO usuario(nombre, email, password, admin) VALUES (?,?,?,?)";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$nombre, $email, $passwordHash, $admin]);
        return (int) $this->pdo->lastInsertId();
    }
    public function obtenerUsuarioPorEmail($email)
    {
        $query = "SELECT * FROM usuario WHERE email = ?";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC); // retorna solo un usuario
    }
    public function obtenerUsuarioPorNombre($nombre) {
        $query = "SELECT * FROM usuario WHERE nombre = ?";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$nombre]);
        return $stmt->fetch(PDO::FETCH_ASSOC); // retorna solo un usuario
    }
        public function obtenerUsuarioid($id) 
        {
        $query = "SELECT * FROM usuario WHERE id = ?";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function eliminarUsuario($id)
    {
        try {
            $this->pdo->beginTransaction();

            $stmt1 = $this->pdo->prepare("DELETE FROM favoritos WHERE usuario_id = ?");
            $stmt1->execute([$id]);

            $stmt2 = $this->pdo->prepare("DELETE FROM usuario WHERE id = ?");
            $stmt2->execute([$id]);

            $this->pdo->commit();
            return $stmt2->rowCount() > 0;
        } catch (PDOException $e) {
            $this->pdo->rollBack();
            return false;
        }
    }
    public function modificarUsuario($id, $nombre, $email, $admin)
    {
        $query = "UPDATE usuario SET nombre = ?, email = ?, admin = ? WHERE id = ?";
        $stmt = $this->pdo->prepare($query);
        return $stmt->execute([$nombre, $email, $admin, $id]);
    }
}

?>