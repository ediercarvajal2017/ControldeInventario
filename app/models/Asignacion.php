<?php
/**
 * Modelo Asignacion
 * 
 * Clase para gestionar operaciones CRUD en la tabla 'asignaciones'.
 * Incluye métodos para asignar elementos a usuarios, gestionar validaciones y generar reportes de asignación.
 * 
 * @package App\Models
 * @date 2025-08-11
 */

namespace App\Models;

require_once __DIR__ . '/Conexion.php';
use App\Models\Conexion;


/**
 * Clase Asignacion
 * 
 * Propiedades:
 * @property int $id                    ID de la asignación
 * @property int $elemento_id           ID del elemento asignado
 * @property int $espacio_id            ID del espacio asignado
 * @property int $responsable_id        ID del usuario responsable
 * @property string $fecha_asignacion   Fecha de la asignación
 * @property string $estado             Estado de la asignación
 * @property string $ubicacion          Ubicación física del elemento
 * @property int $usuario_asigna_id     ID del usuario que realiza la asignación
 */
class Asignacion {
    public $id;
    public $elemento_id;
    public $espacio_id;
    public $responsable_id;
    public $fecha_asignacion;
    public $estado;
    public $ubicacion;
    public $usuario_asigna_id;

    /**
     * Crea una nueva asignación en la base de datos.
     * @param array $data Datos de la asignación
     * @return bool True si la inserción fue exitosa, False en caso contrario
     */
    public static function create($data) {
        $pdo = Conexion::conectar();
        $stmt = $pdo->prepare('INSERT INTO asignaciones (elemento_id, espacio_id, responsable_id, fecha_asignacion, estado, ubicacion, usuario_asigna_id) VALUES (:elemento_id, :espacio_id, :responsable_id, :fecha_asignacion, :estado, :ubicacion, :usuario_asigna_id)');
        return $stmt->execute($data);
    }

    /**
     * Obtiene todas las asignaciones registradas.
     * @return array Lista de asignaciones
     */
    public static function getAll() {
        $pdo = Conexion::conectar();
        $stmt = $pdo->query('SELECT * FROM asignaciones');
        return $stmt->fetchAll();
    }

    /**
     * Obtiene una asignación por su ID.
     * @param int $id ID de la asignación
     * @return array|false Datos de la asignación o false si no existe
     */
    public static function getById($id) {
    $pdo = Conexion::conectar();
        $stmt = $pdo->prepare('SELECT * FROM asignaciones WHERE id = :id');
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    /**
     * Actualiza los datos de una asignación.
     * @param int $id ID de la asignación
     * @param array $data Datos actualizados
     * @return bool True si la actualización fue exitosa, False en caso contrario
     */
    public static function update($id, $data) {
    $pdo = Conexion::conectar();
        $sql = 'UPDATE asignaciones SET elemento_id=:elemento_id, espacio_id=:espacio_id, responsable_id=:responsable_id, fecha_asignacion=:fecha_asignacion, estado=:estado, ubicacion=:ubicacion, usuario_asigna_id=:usuario_asigna_id WHERE id=:id';
        $stmt = $pdo->prepare($sql);
        $data['id'] = $id;
        return $stmt->execute($data);
    }

    /**
     * Elimina una asignación por su ID.
     * @param int $id ID de la asignación
     * @return bool True si la eliminación fue exitosa, False en caso contrario
     */
    public static function delete($id) {
    $pdo = Conexion::conectar();
        $stmt = $pdo->prepare('DELETE FROM asignaciones WHERE id = :id');
        return $stmt->execute(['id' => $id]);
    }

    /**
     * Busca una asignación por elemento, espacio y fecha.
     * @param int $elemento_id
     * @param int $espacio_id
     * @param string $fecha_asignacion
     * @return array|false
     */
    public static function getByElementoEspacioFecha($elemento_id, $espacio_id, $fecha_asignacion) {
    $pdo = Conexion::conectar();
        $stmt = $pdo->prepare('SELECT * FROM asignaciones WHERE elemento_id = :elemento_id AND espacio_id = :espacio_id AND fecha_asignacion = :fecha_asignacion');
        $stmt->execute([
            'elemento_id' => $elemento_id,
            'espacio_id' => $espacio_id,
            'fecha_asignacion' => $fecha_asignacion
        ]);
        return $stmt->fetch();
    }
}
