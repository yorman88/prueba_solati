<?php


// Clase para manejar la conexion a la BD
class Connection {
    private static $instance;
    private $pdo;

    // Se definen las variables para la conexion a la BD
    private $db_host = 'localhost';
    private $db_name = 'prueba_solati';
    private $db_user = 'root';
    private $db_port = '5432';
    private $db_password = '';

    // Se define el constructor para manejar la conexion
    private function __construct() {

        try {

            //se establece la conexion a la BD
            $this->pdo = new PDO("pgsql:host=" . $this->db_host . ";port=" . $this->db_port . ";dbname=" . $this->db_name . ";user=" . $this->db_user . ";password=" . $this->db_password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo "conexion establecida con exito";
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

