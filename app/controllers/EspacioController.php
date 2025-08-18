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
            session_start();
            $_SESSION['exito'] = '¡Espacio registrado exitosamente!';
            header('Location: /ControldeInventario/public/espacios');
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
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['nombre'] ?? '';
            $numeracion = $_POST['numeracion'] ?? '';
            Espacio::update($id, [
                'nombre' => $nombre,
                'numeracion' => $numeracion
            ]);
            header('Location: /ControldeInventario/public/espacios');
            exit;
        }
    }

    public function delete($id) {
        Espacio::delete($id);
        header('Location: /ControldeInventario/public/espacios');
        exit;
    }
}
