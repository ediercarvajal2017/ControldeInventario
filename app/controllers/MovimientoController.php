<?php
// Controlador para la gestión de movimientos de inventario
// Permite listar, crear, editar, actualizar y eliminar movimientos
namespace App\Controllers;

use App\Models\Movimiento;

class MovimientoController
{
    /**
     * Muestra el listado de movimientos
     */
    public function index()
    {
        require_once __DIR__ . '/../models/Movimiento.php';
        $movimientos = \App\Models\Movimiento::getAll();
        include __DIR__ . '/../views/movimientos/index.php';
    }

    /**
     * Muestra el formulario para crear un nuevo movimiento
     */
    public function create()
    {
        include __DIR__ . '/../views/movimientos/create.php';
    }

    /**
     * Procesa el formulario de creación de movimiento
     * @param array $data Datos del formulario
     */
    public function store()
    {
        // Carga diferida del modelo para no romper create()
        require_once __DIR__ . '/../models/Movimiento.php';
        $data = $_POST;

        if (empty($data)) {
            $error = "Datos inválidos.";
            include __DIR__ . '/../views/movimientos/create.php';
            return;
        }

        // Ajusta a tu API del modelo (create/insert/save)
        if (\App\Models\Movimiento::create($data)) {
            session_start();
            $_SESSION['exito'] = '¡Movimiento registrado!';
            header('Location: ' . BASE_URL . 'movimientos');
            exit;
        } else {
            $error = "No se pudo guardar el movimiento.";
            include __DIR__ . '/../views/movimientos/create.php';
        }
    }

    /**
     * Muestra el formulario para editar un movimiento existente
     * @param int $id ID del movimiento
     */
    public function edit($id)
    {
        require_once __DIR__ . '/../models/Movimiento.php';
    $movimiento = \App\Models\Movimiento::getById($id);
        if (!$movimiento) {
            echo "Movimiento no encontrado.";
            return;
        }
        include __DIR__ . '/../views/movimientos/edit.php'; // Incluir la vista
    }

    /**
     * Procesa el formulario de actualización de movimiento
     * @param int $id ID del movimiento
     * @param array $data Datos del formulario
     */
    public function update($id)
    {
        require_once __DIR__ . '/../models/Movimiento.php';
        $data = $_POST;

        if (\App\Models\Movimiento::update($id, $data)) {
            session_start();
            $_SESSION['exito'] = '¡Movimiento actualizado!';
            header('Location: ' . BASE_URL . 'movimientos');
            exit;
        } else {
            $error = "No se pudo actualizar.";
            $movimiento = \App\Models\Movimiento::getById($id);
            include __DIR__ . '/../views/movimientos/edit.php';
        }
    }

    /**
     * Elimina un movimiento
     * @param int $id ID del movimiento
     */
    public function delete($id)
    {
        require_once __DIR__ . '/../models/Movimiento.php';
        \App\Models\Movimiento::delete($id);
        session_start();
        $_SESSION['exito'] = '¡Movimiento eliminado!';
    header('Location: ' . BASE_URL . 'movimientos');
        exit;
    }
}
