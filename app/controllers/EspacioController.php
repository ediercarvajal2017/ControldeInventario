<?php
// app/controllers/EspacioController.php
// Controlador para gestionar los espacios en el sistema de inventario

namespace App\Controllers;

require_once __DIR__ . '/../models/Espacio.php';
require_once __DIR__ . '/../models/Institucion.php';

use App\Models\Espacio;
use App\Models\Institucion;

class EspacioController {
    public function index() {
        $espacios = Espacio::getAll();
        include __DIR__ . '/../views/espacios/index.php';
    }

    public function create() {
        $instituciones = \App\Models\Institucion::getAll();
        include __DIR__ . '/../views/espacios/create.php';
    }

    public function store() {
        require_once __DIR__ . '/../../config/config.php';
        $error = '';
        if (
            empty($_POST['nombre']) ||
            empty($_POST['numeracion'])
        ) {
            $error = "Todos los campos son obligatorios.";
            include __DIR__ . '/../views/espacios/create.php';
            return;
        }

        $data = [
            'nombre' => $_POST['nombre'],
            'numeracion' => $_POST['numeracion']
        ];

        if (Espacio::create($data)) {
            if (session_status() === PHP_SESSION_NONE) session_start();
            $_SESSION['exito'] = '¡Espacio registrado exitosamente!';
            header('Location: ' . BASE_URL . 'espacios');
            exit;
        } else {
            $error = "Ocurrió un error al registrar el espacio.";
            include __DIR__ . '/../views/espacios/create.php';
        }
    }

    public function edit($id) {
        $espacio = Espacio::getById($id);
        include __DIR__ . '/../views/espacios/edit.php';
    }

    public function update($id) {
        require_once __DIR__ . '/../../config/config.php';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['nombre'] ?? '';
            $numeracion = $_POST['numeracion'] ?? '';
            Espacio::update($id, [
                'nombre' => $nombre,
                'numeracion' => $numeracion
            ]);
            if (session_status() === PHP_SESSION_NONE) session_start();
            $_SESSION['exito'] = '¡Espacio actualizado exitosamente!';
            header('Location: ' . BASE_URL . 'espacios');
            exit;
        }
    }

    public function delete($id) {
        require_once __DIR__ . '/../../config/config.php';
        Espacio::delete($id);
        if (session_status() === PHP_SESSION_NONE) session_start();
        $_SESSION['exito'] = '¡Espacio eliminado exitosamente!';
        header('Location: ' . BASE_URL . 'espacios');
        exit;
    }
}
