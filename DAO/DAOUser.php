<?php

// Requerimos el archivo de conexion y el modelo del Usuario
require_once 'config/connection.php';
require_once 'models/UserModel.php';


// Clase que maneja el acceso a los datos del usuario
class UserDAO {
    private $connection;

    //Obtenemos la instancia de la conexion a la base de datos
    public function __construct() {
        $this->connection = Connection::getInstance()->getConnection();
    }

    //Obtenemos los datos de la tabla en la base de datos
    public function listAllUsers() {
        $query = "SELECT * FROM tbl_usuarios";
        $statement = $this->connection->prepare($query);
        $statement->execute();

        $users = [];
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $user = new User(
                $row['usu_intid'],
                $row['usu_varnombre'],
                $row['usu_varapellido'],
                $row['usu_intidentificacion'],
                $row['usu_vartelefono'],
                $row['usu_varemail'],
                $row['usu_intedad'],
                $row['usu_varsexo'],
                $row['usu_varestadocivil'],
                $row['usu_intestado']
            );
            $users[] = $user;
        }

        return $users;
    }
}
