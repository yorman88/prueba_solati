<?php

require_once 'config/connection.php';

class UserDAO {
    // Método para obtener todos los usuarios
    public static function getAllUsers() {
        $db = Connection::getInstance()->getConnection();
        $stmt = $db->query('SELECT * FROM users');
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($users) {
            return [
                'status' => 'success',
                'message' => 'Usuarios encontrados',
                'data' => $users
            ];
        } else {
            return [
                'status' => 'error',
                'message' => 'No seencontraron usuarios',
                'data' => []
            ];
        }
    }

    // Método para obtener un usuario por su ID
    public static function getUserById($id) {
        $db = Connection::getInstance()->getConnection();
        $stmt = $db->prepare('SELECT * FROM users WHERE id = :id');
        $stmt->execute(['id' => $id]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            return [
                'status' => 'success',
                'message' => 'Usuario obtenido',
                'data' => $user
            ];
        } else {
            return [
                'status' => 'error',
                'message' => 'Usuario no encontrado',
                'data' => []
            ];
        }
    }

    // Método para agregar un nuevo usuario
    public static function addUser($nombre, $apellido, $email, $password='admin123') {
        $db = Connection::getInstance()->getConnection();
        $stmt = $db->prepare('INSERT INTO users (nombre, apellido, email, password) VALUES (:nombre, :apellido, :email, :password)');
        $success = $stmt->execute(['nombre' => $nombre, 'apellido' => $apellido, 'email' => $email, 'password'=> $password]);

        if ($success) {
            return [
                'status' => 'success',
                'message' => 'User agregado correctamente',
                'data' => []
            ];
        } else {
            return [
                'status' => 'error',
                'message' => 'Fallo la operacion',
                'data' => []
            ];
        }
    }

    // Método para actualizar un usuario
    public static function updateUser($id, $nombre, $apellido, $email, $password='admin123') {
        $db = Connection::getInstance()->getConnection();
        $stmt = $db->prepare('UPDATE users SET nombre = :nombre, apellido = :apellido, email = :email, password = :password WHERE id = :id');
        $success = $stmt->execute(['id' => $id, 'nombre' => $nombre, 'apellido' => $apellido, 'email' => $email, 'password' => $password]);

        if ($success) {
            return [
                'status' => 'success',
                'message' => 'Usuario actualizado correctamente.',
                'data' => []
            ];
        } else {
            return [
                'status' => 'error',
                'message' => 'Fallo la actualizacion del usuario',
                'data' => []
            ];
        }
    }

    // Método para eliminar un usuario
    public static function deleteUser($id) {
        $db = Connection::getInstance()->getConnection();
        $stmt = $db->prepare('DELETE FROM users WHERE id = :id');
        $success = $stmt->execute(['id' => $id]);

        if ($success) {
            return [
                'status' => 'success',
                'message' => 'Usuario eliminado',
                'data' => []
            ];
        } else {
            return [
                'status' => 'error',
                'message' => 'Fallo la eliminacion del usuario',
                'data' => []
            ];
        }
    }

    // Método para iniciar sesion
    public static function checkLogin($username, $password) {
        $db = Connection::getInstance()->getConnection();
        $stmt = $db->prepare('SELECT * FROM users WHERE nombre = :username');
        $stmt->execute(['username' => $username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Se verifica, si se encuentra el usuario
        if ($user) {
            // Se verificasi lacontraseña coincide
            if ($password === $user['password']) {
                return [
                    'status' => 'success',
                    'message' => 'Inicio de sesión exitoso'
                ]; // Las credenciales son correctas
            }
        }

        return [
            'status' => 'error',
            'message' => 'Credenciales incorrectas'
        ]; // Las credenciales son incorrectas o el usuario no existe
    }
}
