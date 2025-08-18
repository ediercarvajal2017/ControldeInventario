<?php
/**
 * Modelo Usuario
 * 
 * Clase para gestionar operaciones CRUD en la tabla 'usuarios'.
 * Incluye métodos para crear, leer, actualizar y eliminar usuarios, así como búsquedas adicionales.
 * 
 * @package App\Models
 * @date 2025-08-11
 */

namespace App\Models;

require_once __DIR__ . '/Conexion.php';

use App\Models\Conexion;

class Usuario
{
    public static function all()
    {
        $pdo = Conexion::conectar();
        $stmt = $pdo->query("SELECT * FROM usuarios");
        return $stmt->fetchAll();
    }

    public static function find($id)
    {
        $pdo = Conexion::conectar();
        $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public static function findByUsername($username)
    {
        $pdo = Conexion::conectar();
        $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE username = ? LIMIT 1");
        $stmt->execute([$username]);
        return $stmt->fetch();
    }

    public static function create($data)
    {
        $pdo = Conexion::conectar();
        try {
            $stmt = $pdo->prepare("INSERT INTO usuarios (documento, nombres, apellidos, cargo, username, password, rol, activo) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $result = $stmt->execute([
                $data['documento'],
                $data['nombres'],
                $data['apellidos'],
                $data['cargo'],
                $data['username'],
                password_hash($data['password'], PASSWORD_DEFAULT),
                $data['rol'],
                $data['activo']
            ]);
            return $result;
        } catch (\PDOException $e) {
            return $e;
        }
    }

    public static function update($id, $data)
    {
        $pdo = Conexion::conectar();
        $sql = "UPDATE usuarios SET documento=?, nombres=?, apellidos=?, cargo=?, username=?, rol=?, activo=? WHERE id=?";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([
            $data['documento'],
            $data['nombres'],
            $data['apellidos'],
            $data['cargo'],
            $data['username'],
            $data['rol'],
            $data['activo'],
            $id
        ]);
    }

    public static function delete($id)
    {
        $pdo = Conexion::conectar();
        $stmt = $pdo->prepare("DELETE FROM usuarios WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public static function verifyPassword($username, $password)
    {
        $user = self::findByUsername($username);
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }
}
