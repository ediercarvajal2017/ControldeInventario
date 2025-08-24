<?php
namespace App\Controllers;
require_once __DIR__ . '/../models/Institucion.php';
use App\Models\Institucion;

class InstitucionController {
    // Muestra el listado de instituciones
    public function index() {
        $instituciones = Institucion::getAll();
        include __DIR__ . '/../views/instituciones/index.php';
    }

    // Muestra el formulario de creación
    public function create() {
        include __DIR__ . '/../views/instituciones/create.php';
    }

    // Guarda una nueva institución
    public function store() {
        $data = [
            'codigo_dane' => $_POST['codigo_dane'],
            'nombre' => $_POST['nombre'],
            'direccion' => $_POST['direccion'],
            'tipo_sede' => $_POST['tipo_sede'],
            'telefono1' => $_POST['telefono1'] ?? null,
            'telefono2' => $_POST['telefono2'] ?? null,
            'celular' => $_POST['celular'] ?? null,
            'email' => $_POST['email'] ?? null
        ];
        $existe = Institucion::getByCodigoDane($data['codigo_dane']);
        if ($existe) {
            $error = 'Ya existe una institución con ese código DANE.';
            include __DIR__ . '/../views/instituciones/create.php';
            return;
        }
        $resultado = Institucion::create($data);
        if ($resultado === true) {
            $_SESSION['mensaje_exito'] = 'Institución creada correctamente.';
            header('Location: ' . BASE_URL . 'instituciones');
            exit;
        } else {
            $error = is_string($resultado) ? $resultado : 'Error al crear la institución.';
            include __DIR__ . '/../views/instituciones/create.php';
            return;
        }
    }

    // Muestra el formulario de edición
    public function edit() {
        $id = $_GET['id'] ?? null;
        $institucion = Institucion::getById($id);
        include __DIR__ . '/../views/instituciones/edit.php';
    }

    // Actualiza una institución
    public function update() {
        $id = $_GET['id'] ?? null;
        $data = [
            'codigo_dane' => $_POST['codigo_dane'],
            'nombre' => $_POST['nombre'],
            'direccion' => $_POST['direccion'],
            'tipo_sede' => $_POST['tipo_sede'],
            'telefono1' => $_POST['telefono1'] ?? null,
            'telefono2' => $_POST['telefono2'] ?? null,
            'celular' => $_POST['celular'] ?? null,
            'email' => $_POST['email'] ?? null
        ];
        $resultado = Institucion::update($id, $data);
        if ($resultado === true) {
            $_SESSION['mensaje_exito'] = 'Institución actualizada correctamente.';
            header('Location: ' . BASE_URL . 'instituciones');
            exit;
        } else {
            $error = is_string($resultado) ? $resultado : 'Error al actualizar la institución.';
            $institucion = Institucion::getById($id);
            include __DIR__ . '/../views/instituciones/edit.php';
            return;
        }
    }

    // Elimina una institución
    public function delete() {
        $id = $_GET['id'] ?? null;
        $errorMsg = null;
        if (!Institucion::delete($id, $errorMsg)) {
            $_SESSION['mensaje_error'] = $errorMsg ?: 'No se pudo eliminar la institución.';
        } else {
            $_SESSION['mensaje_exito'] = 'Institución eliminada correctamente.';
        }
        header('Location: ' . BASE_URL . 'instituciones');
        exit;
    }
}
