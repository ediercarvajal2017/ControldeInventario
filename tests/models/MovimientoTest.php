<?php
use PHPUnit\Framework\TestCase;
require_once __DIR__ . '/../../app/models/Movimiento.php';

class MovimientoTest extends TestCase
{
    public static function setUpBeforeClass(): void
    {
        $pdo = \App\Models\Conexion::conectar();
        $pdo->exec('DELETE FROM movimientos');
    }
    private static $idCreado;

    public function testCrearMovimiento()
    {
        $data = [
            'elemento_id' => 1,
            'tipo_movimiento' => 'Traslado',
            'fecha' => '2025-08-16',
            'estado' => 'En uso',
            'usuario_movimiento_id' => 1,
            'destino' => 'Aula 101'
        ];
        $resultado = \App\Models\Movimiento::create($data);
        $this->assertTrue($resultado);
        $movimientos = \App\Models\Movimiento::getAll();
        $ultimo = end($movimientos);
        self::$idCreado = $ultimo['id'] ?? null;
        $this->assertNotNull(self::$idCreado);
    }

    /**
     * @depends testCrearMovimiento
     */
    public function testObtenerMovimientoPorId()
    {
        $movimiento = \App\Models\Movimiento::getById(self::$idCreado);
        $this->assertIsArray($movimiento);
        $this->assertEquals('Traslado', $movimiento['tipo_movimiento']);
    }

    /**
     * @depends testCrearMovimiento
     */
    public function testActualizarMovimiento()
    {
        $data = [
            'elemento_id' => 1,
            'tipo_movimiento' => 'Reintegro',
            'fecha' => '2025-08-16',
            'estado' => 'Reintegrado',
            'usuario_movimiento_id' => 1,
            'destino' => 'Aula 102'
        ];
        $resultado = \App\Models\Movimiento::update(self::$idCreado, $data);
        $this->assertTrue($resultado);
        $movimiento = \App\Models\Movimiento::getById(self::$idCreado);
        $this->assertEquals('Reintegro', $movimiento['tipo_movimiento']);
    }

    /**
     * @depends testCrearMovimiento
     */
    public function testEliminarMovimiento()
    {
        $resultado = \App\Models\Movimiento::delete(self::$idCreado);
        $this->assertTrue($resultado);
        $movimiento = \App\Models\Movimiento::getById(self::$idCreado);
        $this->assertFalse($movimiento);
    }
}
