<?php

// Definición de la clase Conexion
class Conexion {
    // Propiedades para almacenar la información de conexión
    private $host = "localhost"; // Dirección del servidor de la base de datos
    private $user = "root"; // Usuario de la base de datos
    private $password = ""; // Contraseña de la base de datos
    private $database = "Cinepolilla"; // Nombre de la base de datos a la que se conectará

    // Método para establecer la conexión a la base de datos
    public function conectar() {
        // Crear una nueva instancia de mysqli con los datos de conexión
        $conexion = new mysqli($this->host, $this->user, $this->password, $this->database);

        // Verificar si ocurrió un error durante la conexión
        if ($conexion->connect_error) {
            // Si hay un error, se muestra un mensaje de error y se termina el script
            die("Error de conexión: " . $conexion->connect_error);
        }

        // Si la conexión se establece correctamente, se devuelve el objeto de conexión
        return $conexion;
    }
}
