<?php
// Vista: Editar institución
ob_start(); ?>
<?php if (!isset($institucion) || !is_array($institucion)): ?>
    <div class="error">No se encontró la institución a editar.</div>
<?php else: ?>
<h2>Editar Institución Educativa</h2>
<form action="/ControldeInventario/public/instituciones/update?id=<?= $institucion['id'] ?>" method="post" class="formulario">
    <label for="codigo_dane">Código DANE:</label>
    <input type="text" name="codigo_dane" id="codigo_dane" value="<?= htmlspecialchars($institucion['codigo_dane']) ?>" required>
    <label for="nombre">Nombre de la Institución:</label>
    <input type="text" name="nombre" id="nombre" value="<?= htmlspecialchars($institucion['nombre']) ?>" required>
    <label for="direccion">Dirección:</label>
    <input type="text" name="direccion" id="direccion" value="<?= htmlspecialchars($institucion['direccion']) ?>" required>
    <label for="tipo_sede">Tipo de Sede:</label>
    <select name="tipo_sede" id="tipo_sede" required>
        <option value="Principal" <?= $institucion['tipo_sede']=='Principal'?'selected':'' ?>>Principal</option>
        <option value="Sección" <?= $institucion['tipo_sede']=='Sección'?'selected':'' ?>>Sección</option>
    </select>

    <label for="telefono1">Teléfono 1:</label>
    <input type="text" name="telefono1" id="telefono1" maxlength="20" value="<?= htmlspecialchars($institucion['telefono1'] ?? '') ?>">

    <label for="telefono2">Teléfono 2:</label>
    <input type="text" name="telefono2" id="telefono2" maxlength="20" value="<?= htmlspecialchars($institucion['telefono2'] ?? '') ?>">

    <label for="celular">Celular:</label>
    <input type="text" name="celular" id="celular" maxlength="20" value="<?= htmlspecialchars($institucion['celular'] ?? '') ?>">

    <label for="email">Correo electrónico:</label>
    <input type="email" name="email" id="email" maxlength="100" value="<?= htmlspecialchars($institucion['email'] ?? '') ?>">
    <button type="submit" class="btn">Actualizar</button>
</form>
<?php endif; ?>
<?php $content = ob_get_clean(); include __DIR__ . '/../layout.php'; ?>
