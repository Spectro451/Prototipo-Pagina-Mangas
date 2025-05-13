<?php

error_reporting(1);

function Conexion()
{
    $host = "";
    $dbname ="manga";
    $username = "root";
    $password = "";

    try
    {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=UTF8", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }
    catch(PDOException $error)
    {
        die("Ta malo la conexion". $error->getMessage());
    }
    
}

?>