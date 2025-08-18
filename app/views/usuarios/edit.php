<?php
    // Vista: Editar usuario
    ob_start();
?>
    <h2>Editar Usuario</h2>
    <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    <form action="/ControldeInventario/public/usuarios/update" method="post" class="formulario" autocomplete="off">
        <input type="hidden" name="id" value="<?= htmlspecialchars($usuario['id']) ?>">

        <label for="documento">Documento:</label>
        <input type="text" name="documento" id="documento" required value="<?= htmlspecialchars($usuario['documento']) ?>">

        <label for="nombres">Nombres:</label>
        <input type="text" name="nombres" id="nombres" required value="<?= htmlspecialchars($usuario['nombres']) ?>">

        <label for="apellidos">Apellidos:</label>
        <input type="text" name="apellidos" id="apellidos" required value="<?= htmlspecialchars($usuario['apellidos']) ?>">

        <label for="cargo">Cargo:</label>
        <input type="text" name="cargo" id="cargo" required value="<?= htmlspecialchars($usuario['cargo']) ?>">


        <label for="username">Usuario:</label>
        <input type="text" name="username" id="username" required value="<?= htmlspecialchars($usuario['username']) ?>">

        <label for="rol">Rol:</label>
        <input type="text" name="rol" id="rol" required value="<?= htmlspecialchars($usuario['rol']) ?>">

        <label for="activo">Activo:</label>
        <select name="activo" id="activo" required>
            <option value="1" <?= ($usuario['activo'] == '1') ? 'selected' : '' ?>>Sí</option>
            <option value="0" <?= ($usuario['activo'] == '0') ? 'selected' : '' ?>>No</option>
        </select>

        <button type="submit" class="btn">Actualizar</button>
    </form>
<?php
    $content = ob_get_clean();
    include __DIR__ . '/../layout.php';
?>
