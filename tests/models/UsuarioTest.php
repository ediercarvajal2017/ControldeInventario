<?php
use PHPUnit\Framework\TestCase;
require_once __DIR__ . '/../../app/models/Usuario.php';

class UsuarioTest extends TestCase
{
    public static function setUpBeforeClass(): void
    {
        $pdo = \App\Models\Conexion::conectar();
        $pdo->exec('DELETE FROM usuarios');
    }
    private static $idCreado;

    public function testCrearUsuario()
    {
        $data = [
            'documento' => '123456789',
            'nombres' => 'Test',
            'apellidos' => 'Usuario',
            'cargo' => 'Tester',
            'username' => 'testusuario',
            'password' => '123456',
            'rol' => 'admin',
            'activo' => 1
        ];
        $resultado = \App\Models\Usuario::create($data);
        $this->assertTrue($resultado);
        $usuarios = \App\Models\Usuario::all();
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
    $this->assertEquals('Test', $usuario['nombres']);
    }

    /**
     * @depends testCrearUsuario
     */
    public function testActualizarUsuario()
    {
        $data = [
            'documento' => '987654321',
            'nombres' => 'Usuario',
            'apellidos' => 'Actualizado',
            'cargo' => 'QA',
            'username' => 'usuarioactualizado',
            'rol' => 'user',
            'activo' => 1
        ];
        $resultado = \App\Models\Usuario::update(self::$idCreado, $data);
        $this->assertTrue($resultado);
        $usuario = \App\Models\Usuario::getById(self::$idCreado);
        $this->assertEquals('Usuario', $usuario['nombres']);
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
