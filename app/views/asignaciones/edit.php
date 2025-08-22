
<?php
    // Vista: Editar asignación
    ob_start();
    // Verificar que $asignacion esté definido y sea array
    if (!isset($asignacion) || !is_array($asignacion)) {
        echo '<div class="error">No se encontró la asignación a editar.</div>';
    } else {
        // Mostrar mensaje de éxito si existe
        if (isset($_GET['exito']) && $_GET['exito'] === '1') {
            echo '<div class="mensaje-exito">¡Asignación actualizada correctamente!</div>';
        }
?>
    <h2 class="titulo-asignaciones">Editar Asignación</h2>
    <form action="/ControldeInventario/asignaciones/update?id=<?= $asignacion['id'] ?>" method="post" class="formulario form-asignacion">
        <label for="fecha_asignacion"><strong>Fecha de asignación</strong></label>
        <input type="text" name="fecha_asignacion" id="fecha_asignacion" value="<?= htmlspecialchars($asignacion['fecha_asignacion']) ?>" required placeholder="Ingrese la fecha de asignación">

        <label for="ubicacion"><strong>Ubicación del objeto en la institución</strong></label>
        <input type="text" name="ubicacion" id="ubicacion" value="<?= htmlspecialchars($asignacion['ubicacion']) ?>" required placeholder="Ingrese la ubicación">

        <label for="estado"><strong>Estado del elemento</strong></label>
        <select name="estado" id="estado" required>
            <option value="">Seleccione el estado</option>
            <option value="En uso" <?= $asignacion['estado']=='En uso'?'selected':'' ?>>En uso</option>
            <option value="Reintegro" <?= $asignacion['estado']=='Reintegro'?'selected':'' ?>>Reintegro</option>
            <option value="Reparación" <?= $asignacion['estado']=='Reparación'?'selected':'' ?>>Reparación</option>
            <option value="Traslado" <?= $asignacion['estado']=='Traslado'?'selected':'' ?>>Traslado</option>
        </select>

        <label for="responsable_id"><strong>Responsable asignado</strong></label>
        <input type="text" name="responsable_id" id="responsable_id" value="<?= htmlspecialchars($asignacion['responsable_id']) ?>" required placeholder="Ingrese el nombre del responsable">

        <label for="usuario_asigna_id"><strong>Asignacion por: </strong></label>
        <input type="text" name="usuario_asigna_id" id="usuario_asigna_id" value="<?= htmlspecialchars($asignacion['usuario_asigna_id']) ?>" placeholder="Asignado por" required>

        <button type="submit" class="btn">Actualizar</button>
    </form>
<?php }
    $content = ob_get_clean(); include __DIR__ . '/../layout.php'; ?>
