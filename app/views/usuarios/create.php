
<?php
// Vista: Crear usuario
ob_start();
?>
<link rel="stylesheet" href="<?= BASE_URL ?>assets/css/form-usuarios.css">
<div style="max-width:600px;margin:0 auto 1em auto;">
    <h2 class="titulo-usuarios">Nuevo Usuario</h2>
    <?php if (!empty($error)): ?>
        <div class="mensaje-error" style="margin-top:0.7em;"> <?= htmlspecialchars($error) ?> </div>
    <?php endif; ?>
</div>
<form action="<?= BASE_URL ?>usuarios/store" method="post" class="formulario">
    <div class="form-grid-2col">
        <div class="form-group">
            <label for="documento">Documento:</label>
            <input type="text" name="documento" id="documento" required value="<?= isset($_POST['documento']) ? htmlspecialchars($_POST['documento']) : '' ?>">
        </div>
        <div class="form-group">
            <label for="nombres">Nombres:</label>
            <input type="text" name="nombres" id="nombres" required value="<?= isset($_POST['nombres']) ? htmlspecialchars($_POST['nombres']) : '' ?>">
        </div>
        <div class="form-group">
            <label for="apellidos">Apellidos:</label>
            <input type="text" name="apellidos" id="apellidos" required value="<?= isset($_POST['apellidos']) ? htmlspecialchars($_POST['apellidos']) : '' ?>">
        </div>
        <div class="form-group">
            <label for="cargo">Cargo:</label>
            <input type="text" name="cargo" id="cargo" required value="<?= isset($_POST['cargo']) ? htmlspecialchars($_POST['cargo']) : '' ?>">
        </div>
        <div class="form-group">
            <label for="username">Usuario:</label>
            <input type="text" name="username" id="username" required value="<?= isset($_POST['username']) ? htmlspecialchars($_POST['username']) : '' ?>">
        </div>
        <div class="form-group">
            <label for="password">Contraseña:</label>
            <input type="password" name="password" id="password" required>
        </div>
        <div class="form-group">
            <label for="rol">Rol:</label>
            <input type="text" name="rol" id="rol" required value="<?= isset($_POST['rol']) ? htmlspecialchars($_POST['rol']) : '' ?>">
        </div>
        <div class="form-group">
            <label for="activo">Activo:</label>
            <select name="activo" id="activo" required>
                <option value="1" <?= (isset($_POST['activo']) && $_POST['activo'] == '1') ? 'selected' : '' ?>>Sí</option>
                <option value="0" <?= (isset($_POST['activo']) && $_POST['activo'] == '0') ? 'selected' : '' ?>>No</option>
            </select>
        </div>
    </div>
    <div style="text-align:center; margin-top:1.5em;">
        <button type="submit" class="btn-usuario btn-usuario-create">Guardar</button>
    </div>
</form>
<?php $content = ob_get_clean(); include __DIR__ . '/../layout.php'; ?>
