<?php

// Se importa la clase de conexión
require_once './models/Conexion.php';

class Clientes {
    // Se declara la propiedad para la conexión
    private $conexion;

    // Constructor que inicializa la conexión
    public function __construct() {
        $this->conexion = new Conexion();
    }

    // Método para obtener todos los clientes
    public function obtenerClientes() {
        // Consulta SQL para obtener todos los clientes
        $query = "SELECT * FROM clientes";
        // Se ejecuta la consulta y se obtiene el resultado
        $resultado = $this->conexion->conectar()->query($query);

        // Se retorna el resultado como un arreglo asociativo
        return $resultado->fetch_all(MYSQLI_ASSOC);
    }

    // Método para insertar un nuevo cliente
    public function insertarCliente($nombre, $apellido, $correo, $telefono, $fechaNacimiento) {
        // Consulta SQL para insertar un nuevo cliente en la base de datos
        $query = "INSERT INTO clientes (nombre, apellido, correo, telefono, fecha_nacimiento) VALUES ('$nombre', '$apellido', '$correo', '$telefono', '$fechaNacimiento')";
        // Se ejecuta la consulta y se retorna el resultado
        return $this->conexion->conectar()->query($query);
    }

    // Método para obtener un cliente por su ID
    public function obtenerClientePorId($id) {
        // Consulta SQL para obtener un cliente por su ID
        $query = "SELECT * FROM clientes WHERE id_cliente = $id";
        // Se ejecuta la consulta y se obtiene el resultado
        $resultado = $this->conexion->conectar()->query($query);

        // Se retorna el resultado como un arreglo asociativo
        return $resultado->fetch_assoc();
    }

    // Método para actualizar los datos de un cliente
    public function actualizarCliente($id, $nombre, $apellido, $correo, $telefono, $fechaNacimiento) {
        // Consulta SQL para actualizar los datos de un cliente en la base de datos
        $query = "UPDATE clientes SET nombre = '$nombre', apellido = '$apellido', correo = '$correo', telefono = '$telefono', fecha_nacimiento = '$fechaNacimiento' WHERE id_cliente = $id";
        // Se ejecuta la consulta y se retorna el resultado
        return $this->conexion->conectar()->query($query);
    }

    // Método para eliminar un cliente por su ID
    public function eliminarCliente($id) {
        // Consulta SQL para eliminar un cliente por su ID
        $query = "DELETE FROM clientes WHERE id_cliente = $id";
        // Se ejecuta la consulta y se retorna el resultado
        return $this->conexion->conectar()->query($query);
    }
}
