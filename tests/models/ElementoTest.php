<?php
use PHPUnit\Framework\TestCase;
require_once __DIR__ . '/../../app/models/Elemento.php';

class ElementoTest extends TestCase
{
    public static function setUpBeforeClass(): void
    {
        $pdo = \App\Models\Conexion::conectar();
        $pdo->exec('DELETE FROM elementos');
    }
    private static $idCreado;

    public function testCrearElemento()
    {
        $data = [
            'codigo' => 'ELEM123',
            'descripcion' => 'Elemento de prueba',
            'foto' => '',
            'valor' => 1000,
            'factura' => 'FAC-001',
            'fecha_ingreso' => date('Y-m-d'),
            'usuario_registro_id' => 1
        ];
        $resultado = \App\Models\Elemento::create($data);
        $this->assertTrue($resultado);
        $elementos = \App\Models\Elemento::getAll();
        $ultimo = end($elementos);
        self::$idCreado = $ultimo['id'] ?? null;
        $this->assertNotNull(self::$idCreado);
    }

    /**
     * @depends testCrearElemento
     */
    public function testObtenerElementoPorId()
    {
        $elemento = \App\Models\Elemento::getById(self::$idCreado);
        $this->assertIsArray($elemento);
        $this->assertEquals('ELEM123', $elemento['codigo']);
    }

    /**
     * @depends testCrearElemento
     */
    public function testActualizarElemento()
    {
        $data = [
            'codigo' => 'ELEM999',
            'descripcion' => 'Descripción actualizada',
            'foto' => '',
            'valor' => 2000,
            'factura' => 'FAC-002',
            'fecha_ingreso' => date('Y-m-d'),
            'usuario_registro_id' => 1
        ];
        $resultado = \App\Models\Elemento::update(self::$idCreado, $data);
        $this->assertTrue($resultado);
        $elemento = \App\Models\Elemento::getById(self::$idCreado);
        $this->assertEquals('ELEM999', $elemento['codigo']);
    }

    /**
     * @depends testCrearElemento
     */
    public function testEliminarElemento()
    {
        $resultado = \App\Models\Elemento::delete(self::$idCreado);
        $this->assertTrue($resultado);
        $elemento = \App\Models\Elemento::getById(self::$idCreado);
        $this->assertFalse($elemento);
    }
}
