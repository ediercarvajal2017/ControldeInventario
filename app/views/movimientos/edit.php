<?php
    // Vista: Editar movimiento
    ob_start();
?>
    <h2>Editar Movimiento</h2>
    <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    <form action="/ControldeInventario/public/movimientos/update" method="post" class="formulario">
        <input type="hidden" name="id" value="<?= htmlspecialchars($movimiento['id']) ?>">
        <label for="elemento_id">Elemento:</label>
        <input type="number" name="elemento_id" id="elemento_id" value="<?= htmlspecialchars($movimiento['elemento_id']) ?>" required>
        <label for="tipo_movimiento">Tipo de movimiento:</label>
        <select name="tipo_movimiento" id="tipo_movimiento" required>
            <option value="Ingreso" <?= $movimiento['tipo_movimiento']=='Ingreso'?'selected':'' ?>>Ingreso</option>
            <option value="Retiro" <?= $movimiento['tipo_movimiento']=='Retiro'?'selected':'' ?>>Retiro</option>
            <option value="Traslado" <?= $movimiento['tipo_movimiento']=='Traslado'?'selected':'' ?>>Traslado</option>
            <option value="Reintegro" <?= $movimiento['tipo_movimiento']=='Reintegro'?'selected':'' ?>>Reintegro</option>
            <option value="Reparación" <?= $movimiento['tipo_movimiento']=='Reparación'?'selected':'' ?>>Reparación</option>
        </select>
        <label for="fecha">Fecha:</label>
        <input type="date" name="fecha" id="fecha" value="<?= htmlspecialchars($movimiento['fecha']) ?>" required>
        <label for="estado">Estado:</label>
        <select name="estado" id="estado" required>
            <option value="En uso" <?= $movimiento['estado']=='En uso'?'selected':'' ?>>En uso</option>
            <option value="Traslado" <?= $movimiento['estado']=='Traslado'?'selected':'' ?>>Traslado</option>
            <option value="Reintegro" <?= $movimiento['estado']=='Reintegro'?'selected':'' ?>>Reintegro</option>
            <option value="Reparación" <?= $movimiento['estado']=='Reparación'?'selected':'' ?>>Reparación</option>
        </select>
        <label for="usuario_movimiento_id">Usuario:</label>
        <input type="number" name="usuario_movimiento_id" id="usuario_movimiento_id" value="<?= htmlspecialchars($movimiento['usuario_movimiento_id']) ?>" required>
        <label for="destino">Destino:</label>
        <input type="text" name="destino" id="destino" value="<?= htmlspecialchars($movimiento['destino']) ?>">
        <button type="submit" class="btn">Actualizar</button>
    </form>
<?php
    $content = ob_get_clean();
    include __DIR__ . '/../layout.php';
?>
