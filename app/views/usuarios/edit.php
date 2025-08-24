<?php
// Vista: Editar usuario
ob_start();
?>
<link rel="stylesheet" href="<?= BASE_URL ?>assets/css/form-usuarios.css">
<div style="max-width:600px;margin:0 auto 1em auto;">
    <h2 class="titulo-usuarios">Editar Usuario</h2>
    <?php if (!empty($error)): ?>
        <div class="mensaje-error" style="margin-top:0.7em;"> <?= htmlspecialchars($error) ?> </div>
    <?php endif; ?>
</div>
<form action="<?= BASE_URL ?>usuarios/update" method="post" class="formulario" autocomplete="off">
    <input type="hidden" name="id" value="<?= htmlspecialchars($usuario['id']) ?>">
    <div class="form-grid-2col">
        <div class="form-group">
            <label for="documento">Documento:</label>
            <input type="text" name="documento" id="documento" required value="<?= htmlspecialchars($usuario['documento']) ?>">
        </div>
        <div class="form-group">
            <label for="nombres">Nombres:</label>
            <input type="text" name="nombres" id="nombres" required value="<?= htmlspecialchars($usuario['nombres']) ?>">
        </div>
        <div class="form-group">
            <label for="apellidos">Apellidos:</label>
            <input type="text" name="apellidos" id="apellidos" required value="<?= htmlspecialchars($usuario['apellidos']) ?>">
        </div>
        <div class="form-group">
            <label for="cargo">Cargo:</label>
            <input type="text" name="cargo" id="cargo" required value="<?= htmlspecialchars($usuario['cargo']) ?>">
        </div>
        <div class="form-group">
            <label for="username">Usuario:</label>
            <input type="text" name="username" id="username" required value="<?= htmlspecialchars($usuario['username']) ?>">
        </div>
        <div class="form-group">
            <label for="rol">Rol:</label>
            <input type="text" name="rol" id="rol" required value="<?= htmlspecialchars($usuario['rol']) ?>">
        </div>
        <div class="form-group">
            <label for="activo">Activo:</label>
            <select name="activo" id="activo" required>
                <option value="1" <?= ($usuario['activo'] == '1') ? 'selected' : '' ?>>Sí</option>
                <option value="0" <?= ($usuario['activo'] == '0') ? 'selected' : '' ?>>No</option>
            </select>
        </div>
    </div>
    <div style="text-align:center; margin-top:1.5em;">
        <button type="submit" class="btn-usuario btn-usuario-edit">Actualizar</button>
    </div>
</form>
<?php
    $content = ob_get_clean();
    include __DIR__ . '/../layout.php';
?>
