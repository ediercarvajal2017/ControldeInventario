<?php
// Vista: Crear asignación
ob_start(); ?>
<?php if (isset($error)): ?>
    <div class="error" style="color:red; margin-bottom:10px;">
        <?= htmlspecialchars($error) ?>
    </div>
<?php endif; ?>
<h2 class="titulo-asignaciones">Nueva Asignación</h2>
<form action="/ControldeInventario/asignaciones/store" method="post" class="formulario form-asignacion">

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
    <label for="fecha_asignacion"><strong>Fecha de asignación</strong></label>
    <input type="text" name="fecha_asignacion" id="fecha_asignacion" required placeholder="Ingrese la fecha de asignación">

    <label for="ubicacion"><strong>Ubicación del objeto en la institución</strong></label>
    <input type="text" name="ubicacion" id="ubicacion" required placeholder="Ingrese la ubicación">

    <label for="estado"><strong>Estado del elemento</strong></label>
    <select name="estado" id="estado" required>
        <option value="">Seleccione el estado</option>
        <option value="En uso">En uso</option>
        <option value="Reintegro">Reintegro</option>
        <option value="Reparación">Reparación</option>
        <option value="Traslado">Traslado</option>
    </select>

    <label for="responsable_id"><strong>Responsable asignado</strong></label>
    <input type="text" name="responsable_id" id="responsable_id" required placeholder="Ingrese el nombre del responsable">

    <label for="usuario_asigna_id"><strong>Asignacion por: </strong></label>
    <input type="text" name="usuario_asigna_id" id="usuario_asigna_id" placeholder="Asignado por" required>

    <button type="submit" class="btn">Guardar</button>
</form>
<?php $content = ob_get_clean(); include __DIR__ . '/../layout.php'; ?>
