<?php
    // Vista: Crear usuario
    ob_start();
    if (!isset($instituciones)) $instituciones = [];
?>
    <h2>Nuevo Usuario</h2>
    <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>
   
    <form action="/ControldeInventario/public/usuarios/store" method="post" class="formulario">
        <label for="documento">Documento:</label>
        <input type="text" name="documento" id="documento" required value="<?= isset($_POST['documento']) ? htmlspecialchars($_POST['documento']) : '' ?>">

        <label for="nombres">Nombres:</label>
        <input type="text" name="nombres" id="nombres" required value="<?= isset($_POST['nombres']) ? htmlspecialchars($_POST['nombres']) : '' ?>">

        <label for="apellidos">Apellidos:</label>
        <input type="text" name="apellidos" id="apellidos" required value="<?= isset($_POST['apellidos']) ? htmlspecialchars($_POST['apellidos']) : '' ?>">

        <label for="cargo">Cargo:</label>
        <input type="text" name="cargo" id="cargo" required value="<?= isset($_POST['cargo']) ? htmlspecialchars($_POST['cargo']) : '' ?>">


        <label for="username">Usuario:</label>
        <input type="text" name="username" id="username" required value="<?= isset($_POST['username']) ? htmlspecialchars($_POST['username']) : '' ?>">

        <label for="password">Contraseña:</label>
        <input type="password" name="password" id="password" required>

        <label for="rol">Rol:</label>
        <input type="text" name="rol" id="rol" required value="<?= isset($_POST['rol']) ? htmlspecialchars($_POST['rol']) : '' ?>">

        <label for="activo">Activo:</label>
        <select name="activo" id="activo" required>
            <option value="1" <?= (isset($_POST['activo']) && $_POST['activo'] == '1') ? 'selected' : '' ?>>Sí</option>
            <option value="0" <?= (isset($_POST['activo']) && $_POST['activo'] == '0') ? 'selected' : '' ?>>No</option>
        </select>

        <button type="submit" class="btn">Guardar</button>
    </form>
<?php $content = ob_get_clean(); include __DIR__ . '/../layout.php'; ?>
