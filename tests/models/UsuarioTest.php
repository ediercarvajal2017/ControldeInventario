<?php
use PHPUnit\Framework\TestCase;
require_once __DIR__ . '/../../app/models/Usuario.php';

class UsuarioTest extends TestCase
{
    private static $idCreado;

    public function testCrearUsuario()
    {
        $data = [
            'nombre' => 'Test Usuario',
            'correo' => 'usuario@prueba.com',
            'rol' => 'admin',
            'password' => '123456'
        ];
        $resultado = \App\Models\Usuario::create($data);
        $this->assertTrue($resultado);
        $usuarios = \App\Models\Usuario::getAll();
        $ultimo = end($usuarios);
        self::$idCreado = $ultimo['id'] ?? null;
        $this->assertNotNull(self::$idCreado);
    }

    /**
     * @depends testCrearUsuario
     */
    public function testObtenerUsuarioPorId()
    {
        $usuario = \App\Models\Usuario::getById(self::$idCreado);
        $this->assertIsArray($usuario);
        $this->assertEquals('Test Usuario', $usuario['nombre']);
    }

    /**
     * @depends testCrearUsuario
     */
    public function testActualizarUsuario()
    {
        $data = [
            'nombre' => 'Usuario Actualizado',
            'correo' => 'actualizado@prueba.com',
            'rol' => 'user',
            'password' => '654321'
        ];
        $resultado = \App\Models\Usuario::update(self::$idCreado, $data);
        $this->assertTrue($resultado);
        $usuario = \App\Models\Usuario::getById(self::$idCreado);
        $this->assertEquals('Usuario Actualizado', $usuario['nombre']);
    }

    /**
     * @depends testCrearUsuario
     */
    public function testEliminarUsuario()
    {
        $resultado = \App\Models\Usuario::delete(self::$idCreado);
        $this->assertTrue($resultado);
        $usuario = \App\Models\Usuario::getById(self::$idCreado);
        $this->assertFalse($usuario);
    }
}
