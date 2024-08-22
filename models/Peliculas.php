<?php

// Se requiere el archivo que contiene la clase de conexión
require_once './models/Conexion.php';

// Definición de la clase Peliculas
class Peliculas {
    // Propiedad para almacenar la conexión a la base de datos
    private $conexion;

    // Constructor de la clase, inicializa la conexión
    public function __construct() {
        $this->conexion = new Conexion(); // Crear una nueva instancia de la clase Conexion para establecer la conexión
    }

    // Método para obtener todas las películas de la base de datos
    public function obtenerPeliculas() {
        $query = "SELECT * FROM peliculas"; // Consulta SQL para seleccionar todas las películas
        $resultado = $this->conexion->conectar()->query($query); // Ejecutar la consulta en la base de datos

        return $resultado->fetch_all(MYSQLI_ASSOC); // Devolver todas las filas del resultado como un array asociativo
    }

    // Método para insertar una nueva película en la base de datos
    public function insertarPelicula($titulo, $director, $genero, $duracion, $clasificacion, $sinopsis, $fechaEstreno) {
        // Consulta SQL para insertar una nueva película con los datos proporcionados
        $query = "INSERT INTO peliculas (titulo, director, genero, duracion_minutos, clasificacion, sinopsis, fecha_estreno) 
                  VALUES ('$titulo', '$director', '$genero', $duracion, '$clasificacion', '$sinopsis', '$fechaEstreno')";
        // Ejecutar la consulta en la base de datos y devolver el resultado
        return $this->conexion->conectar()->query($query);
    }

    // Método para obtener los detalles de una película por su ID
    public function obtenerPeliculaPorId($id) {
        $query = "SELECT * FROM peliculas WHERE id_pelicula = $id"; // Consulta SQL para seleccionar una película por su ID
        $resultado = $this->conexion->conectar()->query($query); // Ejecutar la consulta en la base de datos

        return $resultado->fetch_assoc(); // Devolver la fila del resultado como un array asociativo
    }

    // Método para actualizar los detalles de una película
    public function actualizarPelicula($id, $titulo, $director, $genero, $duracion, $clasificacion, $sinopsis, $fechaEstreno) {
        // Consulta SQL para actualizar los detalles de una película con los datos proporcionados
        $query = "UPDATE peliculas SET titulo = '$titulo', director = '$director', genero = '$genero', duracion_minutos = $duracion, clasificacion = '$clasificacion', sinopsis = '$sinopsis', fecha_estreno = '$fechaEstreno' WHERE id_pelicula = $id";
        // Ejecutar la consulta en la base de datos y devolver el resultado
        return $this->conexion->conectar()->query($query);
    }

    // Método para eliminar una película de la base de datos por su ID
    public function eliminarPelicula($id) {
        $query = "DELETE FROM peliculas WHERE id_pelicula = $id"; // Consulta SQL para eliminar una película por su ID
        // Ejecutar la consulta en la base de datos y devolver el resultado
        return $this->conexion->conectar()->query($query);
    }
}
