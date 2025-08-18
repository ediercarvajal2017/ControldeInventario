<?php
use PHPUnit\Framework\TestCase;
require_once __DIR__ . '/../../app/models/Asignacion.php';

class AsignacionTest extends TestCase
{
    private static $idCreado;

    public function testObtenerTodasLasAsignaciones()
    {
        $asignaciones = \App\Models\Asignacion::getAll();
        $this->assertIsArray($asignaciones, 'getAll debe devolver un array');
    }

    public function testCrearAsignacion()
    {
        $data = [
            'elemento_id' => 1,
            'espacio_id' => 1,
            'responsable_id' => 1,
            'fecha_asignacion' => '2025-08-16',
            'estado' => 'En uso',
            'ubicacion' => 'Aula 101',
            'usuario_asigna_id' => 1
        ];
        $resultado = \App\Models\Asignacion::create($data);
        $this->assertTrue($resultado, 'La asignación debería crearse correctamente');

        // Obtener el último ID insertado para pruebas siguientes
        $asignaciones = \App\Models\Asignacion::getAll();
        $ultimo = end($asignaciones);
        self::$idCreado = $ultimo['id'] ?? null;
        $this->assertNotNull(self::$idCreado, 'Debe obtenerse el ID de la asignación creada');
    }

    /**
     * @depends testCrearAsignacion
     */
    public function testObtenerAsignacionPorId()
    {
        $asignacion = \App\Models\Asignacion::getById(self::$idCreado);
        $this->assertIsArray($asignacion, 'getById debe devolver un array');
        $this->assertEquals('Aula 101', $asignacion['ubicacion']);
    }

    /**
     * @depends testCrearAsignacion
     */
    public function testActualizarAsignacion()
    {
        $data = [
            'elemento_id' => 1,
            'espacio_id' => 1,
            'responsable_id' => 1,
            'fecha_asignacion' => '2025-08-16',
            'estado' => 'Reparación',
            'ubicacion' => 'Aula 102',
            'usuario_asigna_id' => 1
        ];
        $resultado = \App\Models\Asignacion::update(self::$idCreado, $data);
        $this->assertTrue($resultado, 'La asignación debería actualizarse correctamente');

        $asignacion = \App\Models\Asignacion::getById(self::$idCreado);
        $this->assertEquals('Aula 102', $asignacion['ubicacion']);
        $this->assertEquals('Reparación', $asignacion['estado']);
    }

    /**
     * @depends testCrearAsignacion
     */
    public function testBuscarPorElementoEspacioFecha()
    {
        $asignacion = \App\Models\Asignacion::getByElementoEspacioFecha(1, 1, '2025-08-16');
        $this->assertIsArray($asignacion, 'getByElementoEspacioFecha debe devolver un array');
    }

    /**
     * @depends testCrearAsignacion
     */
    public function testEliminarAsignacion()
    {
        $resultado = \App\Models\Asignacion::delete(self::$idCreado);
        $this->assertTrue($resultado, 'La asignación debería eliminarse correctamente');
        $asignacion = \App\Models\Asignacion::getById(self::$idCreado);
        $this->assertFalse($asignacion, 'La asignación ya no debe existir');
    }
}
