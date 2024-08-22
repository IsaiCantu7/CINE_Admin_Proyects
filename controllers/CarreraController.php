<?php

require_once './models/Carrera.php';

class CarreraController {
    private $carreraModel;

    public function __construct() {
        $this->carreraModel = new Carrera();
    }

    public function index() {
        $carreras = $this->carreraModel->obtenerCarreras();
        include './views/carrera/index.php';
    }

    public function alta() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['nombre'];
            $this->carreraModel->insertarCarrera($nombre);
            header("Location: index.php");
        } else {
            include './views/carrera/alta.php';
        }
    }

    public function editar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $nombre = $_POST['nombre'];
            $this->carreraModel->actualizarCarrera($id, $nombre);
            header("Location: index.php");
        } else {
            $id = $_GET['id'];
            $carrera = $this->carreraModel->obtenerCarreraPorId($id);
            include './views/carrera/editar.php';
        }
    }

    public function eliminar() {
        $id = $_GET['id'];
        $this->carreraModel->eliminarCarrera($id);
        header("Location: index.php");
    }
}
