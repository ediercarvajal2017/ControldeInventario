<?php
use PHPUnit\Framework\TestCase;
require_once __DIR__ . '/../../app/models/Espacio.php';

class EspacioTest extends TestCase
{
    private static $idCreado;

    public function testCrearEspacio()
    {
        $data = [
            'nombre' => 'Test Espacio',
            'numeracion' => 'E-001',
            // 'institucion_id' => null // Puedes agregarlo si es requerido
        ];
        $resultado = \App\Models\Espacio::create($data);
        $this->assertTrue($resultado);
        $espacios = \App\Models\Espacio::getAll();
        $ultimo = end($espacios);
        self::$idCreado = $ultimo['id'] ?? null;
        $this->assertNotNull(self::$idCreado);
    }

    /**
     * @depends testCrearEspacio
     */
    public function testObtenerEspacioPorId()
    {
        $espacio = \App\Models\Espacio::getById(self::$idCreado);
        $this->assertIsArray($espacio);
        $this->assertEquals('Test Espacio', $espacio['nombre']);
    }

    /**
     * @depends testCrearEspacio
     */
    public function testActualizarEspacio()
    {
        $data = [
            'nombre' => 'Espacio Actualizado',
            'numeracion' => 'E-002',
            // 'institucion_id' => null // Puedes agregarlo si es requerido
        ];
        $resultado = \App\Models\Espacio::update(self::$idCreado, $data);
        $this->assertTrue($resultado);
        $espacio = \App\Models\Espacio::getById(self::$idCreado);
        $this->assertEquals('Espacio Actualizado', $espacio['nombre']);
    }

    /**
     * @depends testCrearEspacio
     */
    public function testEliminarEspacio()
    {
        $resultado = \App\Models\Espacio::delete(self::$idCreado);
        $this->assertTrue($resultado);
        $espacio = \App\Models\Espacio::getById(self::$idCreado);
        $this->assertFalse($espacio);
    }
}
