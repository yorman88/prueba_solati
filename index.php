<?php

// Se incluye el controlador
require_once 'controllers/UserController.php';

// Se obtiene el metodo de la solicitud y la accion
$requestMethod = $_SERVER['REQUEST_METHOD'];
$action = isset($_GET['action']) ? $_GET['action'] : '';

// Se crea una instancia del controlador de usuarios
$userController = new UserController();

// Maneja las diferentes acciones según el método de solicitud
switch ($requestMethod) {
    case 'GET':
        // Si la acción es 'userList', obtiene la lista de usuarios
        // Si la acción es 'getUser', obtiene los detalles de un usuario específico
        // De lo contrario, muestra la vista de lista de usuarios
        if ($action == 'userList') {
            $userController->userList();
        } elseif ($action == 'getUser') {
            $id = $_GET['id'];
            $userController->getUser($id);
        } else {
            $userController->userListView();
        }
        break;
    case 'POST':
        // Si la acción es 'addUser', agrega un nuevo usuario
        // Si la acción es 'login', maneja la solicitud de inicio de sesión
        if ($action == 'addUser') {
            $userController->addUser();
        } elseif ($action == 'login') {
            // Obtiene los datos de inicio de sesión del cuerpo de la solicitud
            $data = json_decode(file_get_contents('php://input'), true);
            $username = $data['username'];
            $password = $data['password'];
            $userController->login($username, $password);
        }
        break;
    case 'PUT':
        parse_str(file_get_contents("php://input"), $_PUT);
        $userController->editUser($_PUT);
        break;
    case 'DELETE':
        $userId = isset($_GET['id']) ? $_GET['id'] : null;
        if ($userId !== null) {
            $userController->deleteUser($userId);
        } else {
            http_response_code(400);
            echo json_encode(['message' => 'No se proporcionó un ID de usuario válido']);
        }
        break;
    default:
        // Envía un mensaje de error si se utiliza un método no permitido
        header('HTTP/1.1 405 Method Not Allowed');
        echo json_encode(['message' => 'Method Not Allowed']);
        break;
}
