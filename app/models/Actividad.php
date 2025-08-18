<?php
/**
 * Modelo Actividad
 * 
 * Clase para gestionar operaciones CRUD en la tabla 'actividades'.
 * Permite registrar y consultar actividades relacionadas con los movimientos y asignaciones de elementos.
 * 
 * @package App\Models
 * @date 2025-08-11
 */

namespace App\Models;

use App\Models\Conexion;


/**
 * Clase Actividad
 * 
 * Propiedades:
 * @property int $id              ID de la actividad
 * @property int $usuario_id      ID del usuario que realiza la actividad
 * @property string $accion       Tipo de acción realizada
 * @property string $fecha        Fecha y hora de la actividad
 * @property string $descripcion  Descripción detallada de la actividad
 */
class Actividad {
    public $id;
    public $usuario_id;
    public $accion;
    public $fecha;
    public $descripcion;

    /**
     * Crea una nueva actividad en la base de datos.
     * @param array $data Datos de la actividad (usuario_id, accion, fecha, descripcion)
     * @return bool True si la inserción fue exitosa, False en caso contrario
     */
    public static function create($data) {
        $pdo = Conexion::getInstance()->getPdo();
        $stmt = $pdo->prepare('INSERT INTO actividad (usuario_id, accion, fecha, descripcion) VALUES (:usuario_id, :accion, :fecha, :descripcion)');
        return $stmt->execute($data);
    }

    /**
     * Obtiene todas las actividades registradas.
     * @return array Lista de actividades
     */
    public static function getAll() {
        $pdo = Conexion::getInstance()->getPdo();
        $stmt = $pdo->query('SELECT * FROM actividad');
        return $stmt->fetchAll();
    }

    /**
     * Obtiene una actividad por su ID.
     * @param int $id ID de la actividad
     * @return array|false Datos de la actividad o false si no existe
     */
    public static function getById($id) {
        $pdo = Conexion::getInstance()->getPdo();
        $stmt = $pdo->prepare('SELECT * FROM actividad WHERE id = :id');
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    /**
     * Elimina una actividad por su ID.
     * @param int $id ID de la actividad
     * @return bool True si la eliminación fue exitosa, False en caso contrario
     */
    public static function delete($id) {
        $pdo = Conexion::getInstance()->getPdo();
        $stmt = $pdo->prepare('DELETE FROM actividad WHERE id = :id');
        return $stmt->execute(['id' => $id]);
    }
}
