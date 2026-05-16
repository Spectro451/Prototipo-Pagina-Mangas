<?php

require_once __DIR__ . '/../config/helpers.php';

$rutas = [
    'kiwi' => [
        'paginaManga', 'catalogo', 'detalles', 'categorias',
        'personajes', 'ayuda', 'quienesSomos', 'afiliados',
        'politicas', 'terminos'
    ],
    'Auth' => [
        'mostrarFormularioRegistro', 'login', 'logout',
        'registrarUsuario', 'listarUsuarios', 'registro'
    ],
    'Admin' => [
        'listarUsuarios', 'modificarUsuario',
        'guardarModificacionUsuario', 'eliminarUsuario'
    ],
    'favoritos' => [
        'toggleFavorito', 'verificar', 'listarFavoritos'
    ]
];

$controller = $_GET['controller'] ?? 'kiwi';
$action = $_GET['action'] ?? 'paginaManga';

if (!isset($rutas[$controller]) || !in_array($action, $rutas[$controller])) {
    http_response_code(404);
    die('Página no encontrada.');
}

$controllerFile = "../Controller/{$controller}Controller.php";
$controllerClass = "{$controller}Controller";

require $controllerFile;
$obj = new $controllerClass();
$obj->$action();
