<?php
/**
 * Modelo Espacio
 * 
 * Clase para gestionar operaciones CRUD en la tabla 'espacios'.
 * Permite gestionar información de espacios físicos o virtuales, y su asignación a instituciones o elementos de inventario.
 * 
 * @package App\Models
 * @date 2025-08-11
 */

namespace App\Models;

require_once __DIR__ . '/Conexion.php';
use App\Models\Conexion;

/**
 * Clase Espacio
 * 
 * Propiedades:
 * @property int $id                ID del espacio
 * @property string $nombre         Nombre del espacio
 * @property string $numeracion     Número o código identificador
 * @property int $institucion_id    ID de la institución asociada
 */
class Espacio {
    public $id;
    public $nombre;
    public $numeracion;

    /**
     * Crea un nuevo espacio en la base de datos.
     * @param array $data Datos del espacio (nombre, numeracion, institucion_id)
     * @return bool True si la inserción fue exitosa, False en caso contrario
     */
    public static function create($data)
    {
        $pdo = Conexion::conectar();
        // Si no se pasa institucion_id, usar null
        $institucion_id = array_key_exists('institucion_id', $data) ? $data['institucion_id'] : null;
        $stmt = $pdo->prepare("INSERT INTO espacios (nombre, numeracion, institucion_id) VALUES (?, ?, ?)");
        return $stmt->execute([
            $data['nombre'],
            $data['numeracion'],
            $institucion_id
        ]);
    }

    /**
     * Obtiene todos los espacios registrados.
     * @return array Lista de espacios
     */
    public static function getAll() {
        $pdo = Conexion::conectar();
        $stmt = $pdo->query('SELECT * FROM espacios');
        return $stmt->fetchAll();
    }

    /**
     * Obtiene un espacio por su ID.
     * @param int $id ID del espacio
     * @return array|false Datos del espacio o false si no existe
     */
    public static function getById($id) {
        $pdo = Conexion::conectar();
        $stmt = $pdo->prepare('SELECT * FROM espacios WHERE id = :id');
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    /**
     * Actualiza los datos de un espacio.
     * @param int $id ID del espacio
     * @param array $data Datos actualizados
     * @return bool True si la actualización fue exitosa, False en caso contrario
     */
    public static function update($id, $data) {
        $pdo = Conexion::conectar();
        $sql = 'UPDATE espacios SET nombre=:nombre, numeracion=:numeracion, institucion_id=:institucion_id WHERE id=:id';
        $stmt = $pdo->prepare($sql);
        $params = [
            'nombre' => $data['nombre'],
            'numeracion' => $data['numeracion'],
            'institucion_id' => $data['institucion_id'],
            'id' => $id
        ];
        return $stmt->execute($params);
    }

    /**
     * Elimina un espacio por su ID.
     * @param int $id ID del espacio
     * @return bool True si la eliminación fue exitosa, False en caso contrario
     */
    public static function delete($id) {
        $pdo = Conexion::conectar();
        $stmt = $pdo->prepare('DELETE FROM espacios WHERE id = :id');
        return $stmt->execute(['id' => $id]);
    }
}
