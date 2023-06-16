<?php

require_once 'controllers/UserController.php';
require_once 'views/user.php';

// Se Obtiene la ruta de la solicitud
$requestPath = $_SERVER['REQUEST_URI'];

// Se elimina el directorio base de la ruta
$basePath = '/php_rest';
$requestPath = str_replace($basePath, '', $requestPath);

// Se eliminan los slash principales y finales
$requestPath = trim($requestPath, '/');

// Se divide la ruta en segmentos
$segments = explode('/', $requestPath);

// Se verifica el segmento final
if ($segments[1] === 'users') {
    $userController = new UserController();
    $users = $userController->getAllUsers();
    renderUsers($users);
} else {
    // Se devuelve un estado 404 con un mensaje si el endpoint no se encuentra
    $errorMessage = [
        'status' => '404',
        'error' => 'Endpoint no encontrado'
    ];
    header('Content-Type: application/json');
    echo json_encode($errorMessage);
}

