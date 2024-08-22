<?php

// Se requiere el archivo que contiene la clase de conexión
require_once './models/Conexion.php';

// Definición de la clase Trabajadores
class Trabajadores {
    // Propiedad para almacenar la conexión a la base de datos
    private $conexion;

    // Constructor de la clase, inicializa la conexión
    public function __construct() {
        $this->conexion = new Conexion(); // Crear una nueva instancia de la clase Conexion para establecer la conexión
    }

    // Método para obtener todos los trabajadores de la base de datos
    public function obtenerTrabajadores() {
        $query = "SELECT * FROM empleados"; // Consulta SQL para seleccionar todos los trabajadores
        $resultado = $this->conexion->conectar()->query($query); // Ejecutar la consulta en la base de datos

        return $resultado->fetch_all(MYSQLI_ASSOC); // Devolver todas las filas del resultado como un array asociativo
    }

    // Método para insertar un nuevo trabajador en la base de datos
    public function insertarTrabajador($nombre, $apellido, $puesto, $salario, $fechaContratacion) {
        // Consulta SQL para insertar un nuevo trabajador con los datos proporcionados
        $query = "INSERT INTO empleados (nombre, apellido, puesto, salario, fecha_contratacion) VALUES ('$nombre', '$apellido', '$puesto', '$salario', '$fechaContratacion')";
        // Ejecutar la consulta en la base de datos y devolver el resultado
        return $this->conexion->conectar()->query($query);
    }

    // Método para obtener los detalles de un trabajador por su ID
    public function obtenerTrabajadorPorId($id) {
        $query = "SELECT * FROM empleados WHERE id_empleado = $id"; // Consulta SQL para seleccionar un trabajador por su ID
        $resultado = $this->conexion->conectar()->query($query); // Ejecutar la consulta en la base de datos

        return $resultado->fetch_assoc(); // Devolver la fila del resultado como un array asociativo
    }

    // Método para actualizar los detalles de un trabajador
    public function actualizarTrabajador($id, $nombre, $apellido, $puesto, $salario, $fechaContratacion) {
        // Consulta SQL para actualizar los detalles de un trabajador con los datos proporcionados
        $query = "UPDATE empleados SET nombre = '$nombre', apellido = '$apellido', puesto = '$puesto', salario = '$salario', fecha_contratacion = '$fechaContratacion' WHERE id_empleado = $id";
        // Ejecutar la consulta en la base de datos y devolver el resultado
        return $this->conexion->conectar()->query($query);
    }

    // Método para eliminar un trabajador de la base de datos por su ID
    public function eliminarTrabajador($id) {
        $query = "DELETE FROM empleados WHERE id_empleado = $id"; // Consulta SQL para eliminar un trabajador por su ID
        // Ejecutar la consulta en la base de datos y devolver el resultado
        return $this->conexion->conectar()->query($query);
    }
}
?>
