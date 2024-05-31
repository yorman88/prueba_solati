<?php

require_once 'connection.php';

// Función para crear tablas
function createTables() {
    // Obtener la conexión a la base de datos
    $db = Connection::getInstance()->getConnection();

    try {
        // SQL para crear la tabla de usuarios
        $sql = "CREATE TABLE IF NOT EXISTS users (
            id SERIAL PRIMARY KEY,
            nombre VARCHAR(100) NOT NULL,
            apellido VARCHAR(100) NOT NULL,
            email VARCHAR(100) NOT NULL UNIQUE,
            password VARCHAR(255) NOT NULL
        )";

        // Ejecutar la consulta
        $db->exec($sql);

        echo "Tabla 'users' creada correctamente.\n";

        // SQL para insertar un usuario por defecto
        $sqlInsert = "INSERT INTO users (nombre, apellido, email, password)
                      VALUES ('pruebas', 'prueba', 'prueba@gmail.com', 'prueba123')
                      ON CONFLICT (email) DO NOTHING"; // Evita duplicados

        // Ejecutar la consulta de inserción
        $db->exec($sqlInsert);

        echo "Usuario por defecto insertado correctamente.\n";
    } catch (PDOException $e) {
        echo "Error al crear la tabla o insertar el usuario por defecto: " . $e->getMessage() . "\n";
    }
}

// Llamar a la función para crear las tablas e insertar el usuario por defecto
createTables();

?>
