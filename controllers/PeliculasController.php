<?php

// Se requiere el archivo que contiene la clase Peliculas
require_once './models/Peliculas.php';

// Definición de la clase PeliculasController
class PeliculasController {
    private $peliculasModel;

    // Constructor de la clase, inicializa el modelo de películas
    public function __construct() {
        $this->peliculasModel = new Peliculas();
    }

    // Método para mostrar el listado de películas
    public function index() {
        // Obtener la lista de películas desde el modelo
        $peliculas = $this->peliculasModel->obtenerPeliculas();
        // Incluir la vista de listado de películas
        include './views/peliculas/index.php';
    }

    // Método para manejar la solicitud de alta de una nueva película
    public function alta() {
        // Verificar si la solicitud es de tipo POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Obtener los datos del formulario
            $titulo = $_POST['titulo'];
            $director = $_POST['director'];
            $genero = $_POST['genero'];
            $duracion = $_POST['duracion'];
            $clasificacion = $_POST['clasificacion'];
            $sinopsis = $_POST['sinopsis'];
            $fechaEstreno = $_POST['fecha_estreno'];
            // Insertar la nueva película utilizando el modelo
            $this->peliculasModel->insertarPelicula($titulo, $director, $genero, $duracion, $clasificacion, $sinopsis, $fechaEstreno);
            // Redirigir al listado de películas después de la inserción
            header("Location: index.php");
        } else {
            // Si la solicitud no es de tipo POST, mostrar el formulario de alta de película
            include './views/peliculas/alta.php';
        }
    }

    // Método para manejar la solicitud de edición de una película
    public function editar() {
        // Verificar si la solicitud es de tipo POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Obtener los datos del formulario de edición
            $id = $_POST['id_pelicula'];
            $titulo = $_POST['titulo'];
            $director = $_POST['director'];
            $genero = $_POST['genero'];
            $duracion = $_POST['duracion'];
            $clasificacion = $_POST['clasificacion'];
            $sinopsis = $_POST['sinopsis'];
            $fechaEstreno = $_POST['fecha_estreno'];
            // Actualizar la película utilizando el modelo
            $this->peliculasModel->actualizarPelicula($id, $titulo, $director, $genero, $duracion, $clasificacion, $sinopsis, $fechaEstreno);
            // Redirigir al listado de películas después de la actualización
            header("Location: index.php");
        } else {
            // Si la solicitud no es de tipo POST, obtener el ID de la película de la URL y mostrar el formulario de edición con los datos de la película
            $id = $_GET['id'];
            $pelicula = $this->peliculasModel->obtenerPeliculaPorId($id);
            include './views/peliculas/editar.php';
        }
    }

    // Método para manejar la solicitud de eliminación de una película
    public function eliminar() {
        // Obtener el ID de la película de la URL
        $id = $_GET['id'];
        // Eliminar la película utilizando el modelo
        $this->peliculasModel->eliminarPelicula($id);
        // Redirigir al listado de películas después de la eliminación
        header("Location: index.php");
    }
}

?>
