<?php
use PHPUnit\Framework\TestCase;
require_once __DIR__ . '/../../app/models/Institucion.php';

class InstitucionTest extends TestCase
{
    public static function setUpBeforeClass(): void
    {
        $pdo = \App\Models\Conexion::conectar();
        $pdo->exec('DELETE FROM instituciones');
    }
    private static $idCreado;

    public function testCrearInstitucion()
    {
        $data = [
            'codigo_dane' => 'DANE123',
            'nombre' => 'Test Institucion',
            'direccion' => 'Calle Falsa 123',
            'tipo_sede' => 'Principal'
        ];
        $resultado = \App\Models\Institucion::create($data);
        $this->assertTrue($resultado, 'La institución debería crearse correctamente');
        $instituciones = \App\Models\Institucion::getAll();
        $ultimo = end($instituciones);
        self::$idCreado = $ultimo['id'] ?? null;
        $this->assertNotNull(self::$idCreado);
    }

    /**
     * @depends testCrearInstitucion
     */
    public function testObtenerInstitucionPorId()
    {
        $institucion = \App\Models\Institucion::getById(self::$idCreado);
        $this->assertIsArray($institucion);
        $this->assertEquals('Test Institucion', $institucion['nombre']);
    }

    /**
     * @depends testCrearInstitucion
     */
    public function testActualizarInstitucion()
    {
        $data = [
            'codigo_dane' => 'DANE999',
            'nombre' => 'Institucion Actualizada',
            'direccion' => 'Nueva Direccion',
            'tipo_sede' => 'Alterna'
        ];
        $resultado = \App\Models\Institucion::update(self::$idCreado, $data);
        $this->assertTrue($resultado);
        $institucion = \App\Models\Institucion::getById(self::$idCreado);
        $this->assertEquals('Institucion Actualizada', $institucion['nombre']);
    }

    /**
     * @depends testCrearInstitucion
     */
    public function testEliminarInstitucion()
    {
        $resultado = \App\Models\Institucion::delete(self::$idCreado);
        $this->assertTrue($resultado);
        $institucion = \App\Models\Institucion::getById(self::$idCreado);
        $this->assertFalse($institucion);
    }
}
