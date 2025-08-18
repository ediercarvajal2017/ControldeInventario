<?php
/**
 * Modelo Elemento
 * 
 * Clase para gestionar operaciones CRUD en la tabla 'elementos'.
 * Incluye métodos para crear, leer, actualizar y eliminar registros de elementos, así como búsquedas y validaciones específicas.
 * 
 * @package App\Models
 * @date 2025-08-11
 */

namespace App\Models;

require_once __DIR__ . '/Conexion.php';

use App\Models\Conexion;


/**
 * Clase Elemento
 * 
 * Propiedades:
 * @property int $id                      ID del elemento
 * @property string $codigo               Código único del elemento
 * @property string $descripcion          Descripción del elemento
 * @property string $foto                 Ruta o nombre de la foto
 * @property float $valor                 Valor monetario
 * @property string $factura              Número de factura
 * @property string $fecha_ingreso        Fecha de ingreso al inventario
 * @property int $usuario_registro_id     ID del usuario que registró el elemento
 */
class Elemento {
    public $id;
    public $codigo;
    public $descripcion;
    public $foto;
    public $valor;
    public $factura;
    public $fecha_ingreso;
    public $usuario_registro_id;

    /**
     * Crea un nuevo elemento en la base de datos.
     * @param array $data Datos del elemento
     * @return bool True si la inserción fue exitosa, False en caso contrario
     */
    public static function create($data) {
        $pdo = Conexion::conectar();
        $params = [
            'codigo' => $data['codigo'] ?? '',
            'descripcion' => $data['descripcion'] ?? '',
            'foto' => $data['foto'] ?? '',
            'valor' => $data['valor'] ?? 0,
            'factura' => $data['factura'] ?? '',
            'fecha_ingreso' => $data['fecha_ingreso'] ?? date('Y-m-d'),
            'usuario_registro_id' => $data['usuario_registro_id'] ?? 1
        ];
        $stmt = $pdo->prepare('INSERT INTO elementos (codigo, descripcion, foto, valor, factura, fecha_ingreso, usuario_registro_id) VALUES (:codigo, :descripcion, :foto, :valor, :factura, :fecha_ingreso, :usuario_registro_id)');
        return $stmt->execute($params);
    }

    /**
     * Obtiene todos los elementos registrados.
     * @return array Lista de elementos
     */
    public static function getAll() {
        $pdo = Conexion::conectar();
        $stmt = $pdo->query('SELECT * FROM elementos');
        return $stmt->fetchAll();
    }

    /**
     * Obtiene un elemento por su ID.
     * @param int $id ID del elemento
     * @return array|false Datos del elemento o false si no existe
     */
    public static function getById($id) {
        $pdo = Conexion::conectar();
        $stmt = $pdo->prepare('SELECT * FROM elementos WHERE id = :id');
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    /**
     * Actualiza los datos de un elemento.
     * @param int $id ID del elemento
     * @param array $data Datos actualizados
     * @return bool True si la actualización fue exitosa, False en caso contrario
     */
    public static function update($id, $data) {
        $pdo = Conexion::conectar();
        $params = [
            'codigo' => $data['codigo'] ?? '',
            'descripcion' => $data['descripcion'] ?? '',
            'foto' => $data['foto'] ?? '',
            'valor' => $data['valor'] ?? 0,
            'factura' => $data['factura'] ?? '',
            'fecha_ingreso' => $data['fecha_ingreso'] ?? date('Y-m-d'),
            'usuario_registro_id' => $data['usuario_registro_id'] ?? 1,
            'id' => $id
        ];
        $sql = 'UPDATE elementos SET codigo=:codigo, descripcion=:descripcion, foto=:foto, valor=:valor, factura=:factura, fecha_ingreso=:fecha_ingreso, usuario_registro_id=:usuario_registro_id WHERE id=:id';
        $stmt = $pdo->prepare($sql);
        return $stmt->execute($params);
    }

    /**
     * Elimina un elemento por su ID.
     * @param int $id ID del elemento
     * @return bool True si la eliminación fue exitosa, False en caso contrario
     */
    public static function delete($id) {
        $pdo = Conexion::conectar();
        $stmt = $pdo->prepare('DELETE FROM elementos WHERE id = :id');
        return $stmt->execute(['id' => $id]);
    }

    /**
     * Verifica si un código ya existe en la base de datos (excepto para un ID dado).
     * @param string $codigo Código a verificar
     * @param int|null $exceptId ID a excluir de la búsqueda (para edición)
     * @return bool True si existe, False si es único
     */
    public static function codigoExiste($codigo, $exceptId = null) {
        $pdo = Conexion::conectar();
        if ($exceptId) {
            $stmt = $pdo->prepare('SELECT COUNT(*) FROM elementos WHERE codigo = :codigo AND id != :id');
            $stmt->execute(['codigo' => $codigo, 'id' => $exceptId]);
        } else {
            $stmt = $pdo->prepare('SELECT COUNT(*) FROM elementos WHERE codigo = :codigo');
            $stmt->execute(['codigo' => $codigo]);
        }
        return $stmt->fetchColumn() > 0;
    }
}
