<link rel="stylesheet" href="<?= BASE_URL ?>assets/css/form-instituciones.css">
<?php
// Vista: Editar institución
ob_start(); ?>
<?php if (!isset($institucion) || !is_array($institucion)): ?>
    <div class="mensaje-error">No se encontró la institución a editar.</div>
<?php else: ?>
<!-- Título duplicado eliminado -->
<h2 class="titulo-instituciones">Editar Institución Educativa</h2>
<?php if (!empty($error)): ?>
    <div class="mensaje-error"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>
<?php if (!empty($_SESSION['mensaje_exito'])): ?>
    <div class="mensaje-exito"><?= $_SESSION['mensaje_exito']; unset($_SESSION['mensaje_exito']); ?></div>
<?php endif; ?>
<form action="<?= BASE_URL ?>instituciones/update?id=<?= $institucion['id'] ?>" method="post" class="formulario form-moderno">
    <div class="form-row">
        <div class="form-group">
            <label for="codigo_dane">Código DANE</label>
            <input type="text" name="codigo_dane" id="codigo_dane" class="input-text" required value="<?= htmlspecialchars($institucion['codigo_dane']) ?>" aria-label="Código DANE">
        </div>
        <div class="form-group">
            <label for="nombre">Nombre de la Institución</label>
            <input type="text" name="nombre" id="nombre" class="input-text" required value="<?= htmlspecialchars($institucion['nombre']) ?>" aria-label="Nombre de la Institución">
        </div>
    </div>
    <div class="form-row">
        <div class="form-group">
            <label for="direccion">Dirección</label>
            <input type="text" name="direccion" id="direccion" class="input-text" required value="<?= htmlspecialchars($institucion['direccion']) ?>" aria-label="Dirección">
        </div>
        <div class="form-group">
            <label for="tipo_sede">Tipo de Sede</label>
            <select name="tipo_sede" id="tipo_sede" class="input-select" required aria-label="Tipo de Sede">
                <option value="Principal" <?= $institucion['tipo_sede']=='Principal'?'selected':'' ?>>Principal</option>
                <option value="Sección" <?= $institucion['tipo_sede']=='Sección'?'selected':'' ?>>Sección</option>
            </select>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group">
            <label for="telefono1">Teléfono 1</label>
            <input type="text" name="telefono1" id="telefono1" class="input-text" maxlength="20" value="<?= htmlspecialchars($institucion['telefono1'] ?? '') ?>" aria-label="Teléfono 1">
        </div>
        <div class="form-group">
            <label for="telefono2">Teléfono 2</label>
            <input type="text" name="telefono2" id="telefono2" class="input-text" maxlength="20" value="<?= htmlspecialchars($institucion['telefono2'] ?? '') ?>" aria-label="Teléfono 2">
        </div>
    </div>
    <div class="form-row">
        <div class="form-group">
            <label for="celular">Celular</label>
            <input type="text" name="celular" id="celular" class="input-text" maxlength="20" value="<?= htmlspecialchars($institucion['celular'] ?? '') ?>" aria-label="Celular">
        </div>
        <div class="form-group">
            <label for="email">Correo electrónico</label>
            <input type="email" name="email" id="email" class="input-text" maxlength="100" value="<?= htmlspecialchars($institucion['email'] ?? '') ?>" aria-label="Correo electrónico">
        </div>
    </div>
    <div class="form-row">
    <button type="submit" class="btn-institucion" aria-label="Actualizar">Actualizar</button>
    </div>
</form>
<?php endif; ?>
<?php $content = ob_get_clean(); include __DIR__ . '/../layout.php'; ?>
