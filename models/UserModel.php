<?php

require_once 'config/connection.php';
require_once 'models/UserDAO.php';

class User {
    private $id;
    private $username;
    private $email;

    public function __construct($id, $username, $email) {
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
    }

    // Métodos de la instancia del modelo
    public static function getAll() {
        return UserDAO::getAllUsers();
    }

    public static function getById($id) {
        return UserDAO::getUserById($id);
    }

    public static function create($nombre, $apellido, $email, $password = 'admin123') {
        return UserDAO::addUser($nombre, $apellido, $email, $password);
    }

    public static function update($id, $nombre, $apellido, $email, $password = 'admin123') {
        return UserDAO::updateUser($id, $nombre, $apellido, $email, $password);
    }

    public static function delete($id) {
        return UserDAO::deleteUser($id);
    }

    public static function authenticate($username, $password) {
        return UserDAO::checkLogin($username, $password);
    }
}
