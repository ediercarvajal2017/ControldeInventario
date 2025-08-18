<?php
/**
 * Modelo Movimiento
 * 
 * Clase para gestionar operaciones CRUD en la tabla 'movimientos'.
 * Permite registrar y consultar movimientos de inventario, incluyendo ingresos y egresos de elementos.
 * 
 * @package App\Models
 * @date 2025-08-11
 */

namespace App\Models;

use App\Models\Conexion;


/**
 * Clase Movimiento
 * 
 * Propiedades:
 * @property int $id                        ID del movimiento
 * @property int $elemento_id               ID del elemento movido
 * @property string $tipo_movimiento        Tipo de movimiento (ingreso, egreso, traslado, etc.)
 * @property string $fecha                  Fecha del movimiento
 * @property string $estado                 Estado del elemento durante el movimiento
 * @property int $usuario_movimiento_id     ID del usuario que realiza el movimiento
 * @property string $destino                Destino del elemento
 */
class Movimiento {
    public $id;
    public $elemento_id;
    public $tipo_movimiento;
    public $fecha;
    public $estado;
    public $usuario_movimiento_id;
    public $destino;

    /**
     * Crea un nuevo movimiento en la base de datos.
     * @param array $data Datos del movimiento
     * @return bool True si la inserción fue exitosa, False en caso contrario
     */
    public static function create($data) {
        require_once __DIR__ . '/Conexion.php';
        $pdo = Conexion::conectar();
        $params = [
            'elemento_id' => $data['elemento_id'] ?? 1,
            'tipo_movimiento' => $data['tipo_movimiento'] ?? '',
            'fecha' => $data['fecha'] ?? date('Y-m-d'),
            'estado' => $data['estado'] ?? '',
            'usuario_movimiento_id' => $data['usuario_movimiento_id'] ?? 1,
            'destino' => $data['destino'] ?? ''
        ];
        $stmt = $pdo->prepare('INSERT INTO movimientos (elemento_id, tipo_movimiento, fecha, estado, usuario_movimiento_id, destino) VALUES (:elemento_id, :tipo_movimiento, :fecha, :estado, :usuario_movimiento_id, :destino)');
        return $stmt->execute($params);
    }

    /**
     * Obtiene todos los movimientos registrados.
     * @return array Lista de movimientos
     */
    public static function getAll() {
        require_once __DIR__ . '/Conexion.php';
        $pdo = Conexion::conectar();
        $stmt = $pdo->query('SELECT * FROM movimientos');
        return $stmt->fetchAll();
    }

    /**
     * Obtiene un movimiento por su ID.
     * @param int $id ID del movimiento
     * @return array|false Datos del movimiento o false si no existe
     */
    public static function getById($id) {
        require_once __DIR__ . '/Conexion.php';
        $pdo = Conexion::conectar();
        $stmt = $pdo->prepare('SELECT * FROM movimientos WHERE id = :id');
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    /**
     * Actualiza los datos de un movimiento.
     * @param int $id ID del movimiento
     * @param array $data Datos actualizados
     * @return bool True si la actualización fue exitosa, False en caso contrario
     */
    public static function update($id, $data) {
        require_once __DIR__ . '/Conexion.php';
        $pdo = Conexion::conectar();
        $params = [
            'elemento_id' => $data['elemento_id'] ?? 1,
            'tipo_movimiento' => $data['tipo_movimiento'] ?? '',
            'fecha' => $data['fecha'] ?? date('Y-m-d'),
            'estado' => $data['estado'] ?? '',
            'usuario_movimiento_id' => $data['usuario_movimiento_id'] ?? 1,
            'destino' => $data['destino'] ?? '',
            'id' => $id
        ];
        $sql = 'UPDATE movimientos SET elemento_id=:elemento_id, tipo_movimiento=:tipo_movimiento, fecha=:fecha, estado=:estado, usuario_movimiento_id=:usuario_movimiento_id, destino=:destino WHERE id=:id';
        $stmt = $pdo->prepare($sql);
        return $stmt->execute($params);
    }

    /**
     * Elimina un movimiento por su ID.
     * @param int $id ID del movimiento
     * @return bool True si la eliminación fue exitosa, False en caso contrario
     */
    public static function delete($id) {
        require_once __DIR__ . '/Conexion.php';
        $pdo = Conexion::conectar();
        $stmt = $pdo->prepare('DELETE FROM movimientos WHERE id = :id');
        return $stmt->execute(['id' => $id]);
    }
}
