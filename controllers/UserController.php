<?php

// Requerimos la clase DAO
require_once './DAO/DAOUser.php';

//Clase que maneja las acciones relacionadas con los usuarios
class UserController {
    private $userDAO;

    //Creamos el constructor
    public function __construct() {
        $this->userDAO = new UserDAO();
    }

    //Funcion para obtener los usuarios
    public function getAllUsers() {
        $users = $this->userDAO->listAllUsers();

        return $users;
    }
}
