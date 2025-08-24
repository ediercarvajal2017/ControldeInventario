

<?php
// Vista: Editar asignación
ob_start();
?>
<link rel="stylesheet" href="<?= BASE_URL ?>assets/css/form-asignaciones.css">
<?php
if (!isset($asignacion) || !is_array($asignacion)) {
    echo '<div class="mensaje-error">No se encontró la asignación a editar.</div>';
} else {
?>
    <h2 class="titulo-asignaciones" style="margin-top:2.7em;">Editar Asignación</h2>
    <?php if (isset($_GET["exito"]) && $_GET["exito"] === "1"): ?>
        <div class="mensaje-exito" style="margin-top:0.7em;">¡Asignación actualizada correctamente!</div>
    <?php endif; ?>
    <?php if (isset($exito)): ?>
        <div class="mensaje-exito" style="margin-top:0.7em;"><?= htmlspecialchars($exito) ?></div>
    <?php endif; ?>
    <?php if (isset($error)): ?>
        <div class="mensaje-error" style="margin-top:0.7em;"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    <form action="<?= BASE_URL ?>asignaciones/update?id=<?= $asignacion['id'] ?>" method="post" class="form-espacio form-asignacion">
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
        <label for="usuario_asigna_id"><strong>Asignación por: </strong></label>
        <input type="text" name="usuario_asigna_id" id="usuario_asigna_id" value="<?= htmlspecialchars($asignacion['usuario_asigna_id']) ?>" placeholder="Asignado por" required>
    <button type="submit" class="btn-asignaciones btn-asignaciones-edit">Actualizar</button>
    </form>
<?php }
$content = ob_get_clean(); include __DIR__ . '/../layout.php'; ?>
