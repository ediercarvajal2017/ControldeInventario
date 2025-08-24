
<?php
// Vista: Crear asignación
ob_start();
?>
<link rel="stylesheet" href="<?= BASE_URL ?>assets/css/form-asignaciones.css">
<h2 class="titulo-asignaciones" style="margin-top:2.7em;">Nueva Asignación</h2>
<?php if (isset($exito)): ?>
    <div class="mensaje-exito" style="margin-top:0.7em;"><?= htmlspecialchars($exito) ?></div>
<?php endif; ?>
<?php if (isset($error)): ?>
    <div class="mensaje-error" style="margin-top:0.7em;"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>
<form action="<?= BASE_URL ?>asignaciones/store" method="post" class="form-espacio form-asignacion">
    <div class="form-grid-2col">
        <div class="form-group">
            <label for="elemento_id"><strong>Elemento</strong></label>
            <select name="elemento_id" id="elemento_id" required>
                <option value="">Seleccione un elemento</option>
                <?php if (isset($elementos) && is_array($elementos)): ?>
                    <?php foreach ($elementos as $el): ?>
                        <option value="<?= htmlspecialchars($el['id']) ?>">
                            <?= htmlspecialchars($el['codigo']) ?> - <?= htmlspecialchars($el['descripcion']) ?>
                        </option>
                    <?php endforeach; ?>
                <?php endif; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="espacio_id"><strong>Espacio</strong></label>
            <select name="espacio_id" id="espacio_id" required>
                <option value="">Seleccione un espacio</option>
                <?php if (isset($espacios) && is_array($espacios)): ?>
                    <?php foreach ($espacios as $es): ?>
                        <option value="<?= htmlspecialchars($es['id']) ?>">
                            <?= htmlspecialchars($es['nombre']) ?> (<?= htmlspecialchars($es['numeracion']) ?>)
                        </option>
                    <?php endforeach; ?>
                <?php endif; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="fecha_asignacion"><strong>Fecha de asignación</strong></label>
            <input type="text" name="fecha_asignacion" id="fecha_asignacion" required placeholder="Ingrese la fecha de asignación">
        </div>
        <div class="form-group">
            <label for="ubicacion"><strong>Ubicación del objeto en la institución</strong></label>
            <input type="text" name="ubicacion" id="ubicacion" required placeholder="Ingrese la ubicación">
        </div>
        <div class="form-group">
            <label for="estado"><strong>Estado del elemento</strong></label>
            <select name="estado" id="estado" required>
                <option value="">Seleccione el estado</option>
                <option value="En uso">En uso</option>
                <option value="Reintegro">Reintegro</option>
                <option value="Reparación">Reparación</option>
                <option value="Traslado">Traslado</option>
            </select>
        </div>
        <div class="form-group">
            <label for="responsable_id"><strong>Responsable asignado</strong></label>
            <input type="text" name="responsable_id" id="responsable_id" required placeholder="Ingrese el nombre del responsable">
        </div>
        <div class="form-group">
            <label for="usuario_asigna_id"><strong>Asignación por: </strong></label>
            <input type="text" name="usuario_asigna_id" id="usuario_asigna_id" placeholder="Asignado por" required>
        </div>
    </div>
    <div style="text-align:center; margin-top:1.5em;">
        <button type="submit" class="btn-asignaciones btn-asignaciones-create">Guardar</button>
    </div>
</form>
<?php $content = ob_get_clean(); include __DIR__ . '/../layout.php'; ?>
