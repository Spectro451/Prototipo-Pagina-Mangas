<?php
error_reporting(1);
function Conexion()
{
    $host = getenv('DB_HOST');
    $dbname = getenv('DB_NAME');
    $username = getenv('DB_USER');
    $password = getenv('DB_PASS');
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=UTF8", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch(PDOException $error) {
        error_log("Error de conexión BD: " . $error->getMessage());
        die("Error de conexión a la base de datos.");
    }
}
?>
