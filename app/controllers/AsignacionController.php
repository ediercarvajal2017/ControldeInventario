<?php
namespace App\Controllers;
require_once __DIR__ . '/../models/Asignacion.php';
require_once __DIR__ . '/../models/Elemento.php';
require_once __DIR__ . '/../models/Espacio.php';
use App\Models\Asignacion;
use App\Models\Elemento;
use App\Models\Espacio;

class AsignacionController {
    public function index() {
    // ...
        $asignaciones = Asignacion::getAll();
        if (!is_array($asignaciones)) {
            $asignaciones = [];
        }
        include __DIR__ . '/../views/asignaciones/index.php';
    }

    public function create() {
        $elementos = Elemento::getAll();
        $espacios = Espacio::getAll();
        include __DIR__ . '/../views/asignaciones/create.php';
    }

    public function store() {
        session_start();
        $elemento_id = $_POST['elemento_id'] ?? null;
        $espacio_id = $_POST['espacio_id'] ?? null;
        $responsable_id = $_POST['responsable_id'] ?? null;
        $fecha_asignacion = $_POST['fecha_asignacion'] ?? null;
        $estado = $_POST['estado'] ?? '';
        $ubicacion = $_POST['ubicacion'] ?? '';
        $usuario_asigna_id = $_POST['usuario_asigna_id'] ?? null;

        $data = [
            'elemento_id' => $elemento_id,
            'espacio_id' => $espacio_id,
            'responsable_id' => $responsable_id,
            'fecha_asignacion' => $fecha_asignacion,
            'estado' => $estado,
            'ubicacion' => $ubicacion,
            'usuario_asigna_id' => $usuario_asigna_id
        ];

        if (Asignacion::create($data)) {
            $_SESSION['exito'] = '¡Asignación registrada exitosamente!';
            header('Location: /ControldeInventario/asignaciones');
            exit;
        } else {
            $error = 'Ocurrió un error al registrar la asignación.';
            $elementos = Elemento::getAll();
            $espacios = Espacio::getAll();
            include __DIR__ . '/../views/asignaciones/create.php';
        }
    }

    public function edit($id) {
        $asignacion = Asignacion::getById($id);
        $elementos = Elemento::getAll();
        $espacios = Espacio::getAll();
        include __DIR__ . '/../views/asignaciones/edit.php';
    }

    public function update($id) {
        session_start();
        $data = [
            'elemento_id' => $_POST['elemento_id'] ?? null,
            'espacio_id' => $_POST['espacio_id'] ?? null,
            'responsable_id' => $_POST['responsable_id'] ?? null,
            'fecha_asignacion' => $_POST['fecha_asignacion'] ?? null,
            'estado' => $_POST['estado'] ?? '',
            'ubicacion' => $_POST['ubicacion'] ?? '',
            'usuario_asigna_id' => $_POST['usuario_asigna_id'] ?? null
        ];
        if (Asignacion::update($id, $data)) {
            $_SESSION['exito'] = '¡Asignación actualizada exitosamente!';
        } else {
            $_SESSION['error'] = 'Ocurrió un error al actualizar la asignación.';
        }
    header('Location: /ControldeInventario/asignaciones');
        exit;
    }

    public function delete($id) {
        session_start();
        if (Asignacion::delete($id)) {
            $_SESSION['exito'] = '¡Asignación eliminada exitosamente!';
        } else {
            $_SESSION['error'] = 'Ocurrió un error al eliminar la asignación.';
        }
    header('Location: /ControldeInventario/asignaciones');
        exit;
    }
}
