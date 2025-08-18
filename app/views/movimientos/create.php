
<?php
    // Vista: Crear movimiento
    ob_start();
?>
    <h2>Nuevo Movimiento</h2>
    <form action="/ControldeInventario/public/movimientos/store" method="post" class="formulario">
        <label for="elemento_id">Elemento:</label>
        <input type="number" name="elemento_id" id="elemento_id" required>
        <label for="tipo_movimiento">Tipo de movimiento:</label>
        <select name="tipo_movimiento" id="tipo_movimiento" required>
            <option value="Ingreso">Ingreso</option>
            <option value="Retiro">Retiro</option>
            <option value="Traslado">Traslado</option>
            <option value="Reintegro">Reintegro</option>
            <option value="Reparación">Reparación</option>
        </select>
        <label for="fecha">Fecha:</label>
        <input type="date" name="fecha" id="fecha" required>
        <label for="estado">Estado:</label>
        <select name="estado" id="estado" required>
            <option value="En uso">En uso</option>
            <option value="Traslado">Traslado</option>
            <option value="Reintegro">Reintegro</option>
            <option value="Reparación">Reparación</option>
        </select>
        <label for="usuario_movimiento_id">Usuario:</label>
        <input type="number" name="usuario_movimiento_id" id="usuario_movimiento_id" required>
        <label for="destino">Destino:</label>
        <input type="text" name="destino" id="destino">
        <button type="submit" class="btn">Guardar</button>
    </form>
<?php $content = ob_get_clean(); include __DIR__ . '/../layout.php'; ?>
