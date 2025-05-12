<?php
require '../config/basePoto.php'; // Aquí podrías tener tu autoload, conexión, etc.

$controller = $_GET['controller'] ?? 'kiwi';
$action = $_GET['action'] ?? 'paginaManga';

$controllerFile = "../Controller/{$controller}Controller.php";
$controllerClass = "{$controller}Controller";

if (file_exists($controllerFile)) {
    require $controllerFile;
    if (class_exists($controllerClass)) {
        $obj = new $controllerClass();
        if (method_exists($obj, $action)) {
            $obj->$action();
        } else {
            die("Acción '$action' no encontrada en el controlador '$controllerClass'");
        }
    } else {
        die("Controlador '$controllerClass' no encontrado.");
    }
} else {
    die("Archivo del controlador '$controllerFile' no existe.");
}
