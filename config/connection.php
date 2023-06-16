<?php

//Requerimos el archivo donde estan las constantes de la base de datos
require_once 'config.php';


// Clase para manejar la conexion a la BD
class Connection {
    private static $instance;
    private $pdo;

    // Definimos el constructor para manejar la conexion
    private function __construct() {

        try {

            //establecemos la conexion a la BD
            $this->pdo = new PDO("pgsql:host=" . DB_HOST . ";port=" . DB_PORT . ";dbname=" . DB_NAME . ";user=" . DB_USER . ";password=" . DB_PASSWORD);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            // Si hay error se imprime el mensaje con el error
            echo 'Error de conexión: ' . $e->getMessage();
        }
    }

    // Se obtiene la instancia unica de la clase 
    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new Connection();
        }
        return self::$instance;
    }


    // Se obtiene la conexion a la BD
    public function getConnection() {
        return $this->pdo;
    }
}
