<?php

// Se incluyen los archivos del modelo
require_once 'models/UserModel.php';

class UserController {
    // Método para obtener todos los usuarios
    public function userList() {
        $users = User::getAll();
        header('Content-Type: application/json');
        echo json_encode($users);
    }

    // Método para mostrar la vista de la lista de usuarios
    public function userListView() {
        $users = User::getAll();
        include 'views/user_list.php';
    }

    // Método para obtener un usuario por ID
    public function getUser($id) {
        $user = User::getById($id);
        header('Content-Type: application/json');
        echo json_encode($user);
    }

    // Método para procesar el formulario de agregar usuario
    public function addUser() {
        $data = json_decode(file_get_contents('php://input'), true);
        $nombre = $data['nombre'];
        $apellido = $data['apellido'];
        $email = $data['email'];
        
        try {
            User::create($nombre, $apellido, $email);
            // Si se agrega correctamente, envía una respuesta JSON con estado y mensaje
            header('Content-Type: application/json');
            echo json_encode(['status' => 'success', 'message' => 'Usuario creado']);
        } catch (Exception $e) {
            // Si hay un error, envía una respuesta JSON con estado y mensaje de error
            header('HTTP/1.1 500 Internal Server Error');
            header('Content-Type: application/json');
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    // Método para procesar el formulario de editar usuario
    public function editUser($id) {
        $data = json_decode(file_get_contents('php://input'), true);
        $nombre = $data['nombre'];
        $apellido = $data['apellido'];
        $email = $data['email'];
        $id = $data['id'];

        try {
            User::update($id, $nombre, $apellido, $email);
            header('Content-Type: application/json');
            echo json_encode(['status' => 'success', 'message' => 'Usuario actualizado']);
        } catch (Exception $e) {
            header('HTTP/1.1 500 Internal Server Error');
            header('Content-Type: application/json');
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    // Método para eliminar un usuario
    public function deleteUser($id) {
        try {
            User::delete($id);
            header('Content-Type: application/json');
            echo json_encode(['status' => 'success', 'message' => 'Usuario eliminado']);
        } catch (Exception $e) {
            header('HTTP/1.1 500 Internal Server Error');
            header('Content-Type: application/json');
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function login($username, $password) {
        // Verificar las credenciales del usuario
        $loginResult = User::authenticate($username, $password);
    
        // Enviar respuesta JSON
        header('Content-Type: application/json');
        echo json_encode($loginResult);
    }
}
