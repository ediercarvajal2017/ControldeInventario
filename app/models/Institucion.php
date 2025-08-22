<?php
namespace App\Models;
/**
 * Modelo Institucion
 * 
 * Clase para gestionar operaciones CRUD en la tabla 'instituciones'.
 * Permite gestionar información de instituciones, incluyendo registro y actualizaciones.
 * 
 * @package App\Models
 * @date 2025-08-11
 */


require_once __DIR__ . '/Conexion.php';

require_once __DIR__ . '/Conexion.php';
use App\Models\Conexion;


/**
 * Clase Institucion
 * 
 * Propiedades:
 * @property int $id              ID de la institución
 * @property string $codigo_dane  Código DANE de la institución
 * @property string $nombre       Nombre de la institución
 * @property string $direccion    Dirección física
 * @property string $tipo_sede    Tipo de sede (principal, alterna, etc.)
 */
class Institucion {
    public $id;
    public $codigo_dane;
    public $nombre;
    public $direccion;
    public $tipo_sede;

    /**
     * Crea una nueva institución en la base de datos.
     * @param array $data Datos de la institución (codigo_dane, nombre, direccion, tipo_sede)
     * @return bool True si la inserción fue exitosa, False en caso contrario
     */
    public static function create($data) {
        $pdo = Conexion::conectar();
        $params = [
            'codigo_dane' => $data['codigo_dane'] ?? '',
            'nombre' => $data['nombre'] ?? '',
            'direccion' => $data['direccion'] ?? '',
            'tipo_sede' => $data['tipo_sede'] ?? '',
            'telefono1' => $data['telefono1'] ?? null,
            'telefono2' => $data['telefono2'] ?? null,
            'celular' => $data['celular'] ?? null,
            'email' => $data['email'] ?? null
        ];
        $stmt = $pdo->prepare('INSERT INTO instituciones (codigo_dane, nombre, direccion, tipo_sede, telefono1, telefono2, celular, email) VALUES (:codigo_dane, :nombre, :direccion, :tipo_sede, :telefono1, :telefono2, :celular, :email)');
        return $stmt->execute($params);
    }
    // ...existing code...

    /**
     * Obtiene todas las instituciones registradas.
     * @return array Lista de instituciones
     */
    public static function getAll() {
        $pdo = Conexion::conectar();
        $stmt = $pdo->query('SELECT id, codigo_dane, nombre, direccion, tipo_sede FROM instituciones');
        return $stmt->fetchAll();
    }

    /**
     * Obtiene una institución por su ID.
     * @param int $id ID de la institución
     * @return array|false Datos de la institución o false si no existe
     */
    public static function getById($id) {
        $pdo = Conexion::conectar();
        $stmt = $pdo->prepare('SELECT * FROM instituciones WHERE id = :id');
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    /**
     * Busca una institución por su código DANE.
     * @param string $codigo_dane
     * @return array|false
     */
    public static function getByCodigoDane($codigo_dane) {
        $pdo = Conexion::conectar();
        $stmt = $pdo->prepare('SELECT * FROM instituciones WHERE codigo_dane = :codigo_dane');
        $stmt->execute(['codigo_dane' => $codigo_dane]);
        return $stmt->fetch();
    }

    /**
     * Actualiza los datos de una institución.
     * @param int $id ID de la institución
     * @param array $data Datos actualizados
     * @return bool True si la actualización fue exitosa, False en caso contrario
     */
    public static function update($id, $data) {
        $pdo = Conexion::conectar();
        $params = [
            'codigo_dane' => $data['codigo_dane'] ?? '',
            'nombre' => $data['nombre'] ?? '',
            'direccion' => $data['direccion'] ?? '',
            'tipo_sede' => $data['tipo_sede'] ?? '',
            'telefono1' => $data['telefono1'] ?? null,
            'telefono2' => $data['telefono2'] ?? null,
            'celular' => $data['celular'] ?? null,
            'email' => $data['email'] ?? null,
            'id' => $id
        ];
        $sql = 'UPDATE instituciones SET codigo_dane=:codigo_dane, nombre=:nombre, direccion=:direccion, tipo_sede=:tipo_sede, telefono1=:telefono1, telefono2=:telefono2, celular=:celular, email=:email WHERE id=:id';
        $stmt = $pdo->prepare($sql);
        return $stmt->execute($params);
    }

    /**
     * Elimina una institución por su ID.
     * @param int $id ID de la institución
     * @return bool True si la eliminación fue exitosa, False en caso contrario
     */
    public static function delete($id, &$errorMsg = null) {
        $pdo = Conexion::conectar();
        try {
            $stmt = $pdo->prepare('DELETE FROM instituciones WHERE id = :id');
            return $stmt->execute(['id' => $id]);
        } catch (\PDOException $e) {
            $errorMsg = 'Error al eliminar la institución: ' . $e->getMessage();
            return false;
        }
    }
}
