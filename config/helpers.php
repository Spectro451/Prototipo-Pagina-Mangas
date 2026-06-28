<?php

function requerirAdmin() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['admin'] !== 'SI') {
        redirect('index.php?controller=kiwi&action=paginaManga');
    }
}

function redirect($url) {
    header("Location: $url");
    exit;
}

function respondJSON($data, $statusCode = 200) {
    http_response_code($statusCode);
    header('Content-Type: application/json');
    echo json_encode($data);
    exit;
}

function setFlash($key, $message) {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $_SESSION['flash'][$key] = $message;
}

function getFlash($key) {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $message = $_SESSION['flash'][$key] ?? null;
    unset($_SESSION['flash'][$key]);
    return $message;
}