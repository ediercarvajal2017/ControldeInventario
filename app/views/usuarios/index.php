<?php
ob_start();
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION['exito'])) {
    echo '<div class="alert alert-success">' . $_SESSION['exito'] . '</div>';
    unset($_SESSION['exito']);
}
?>
<link rel="stylesheet" href="/ControldeInventario/public/assets/css/usuarios-actions.css">
<h2>Usuarios</h2>
<a href="/ControldeInventario/public/usuarios/create" class="usuarios-action-btn usuarios-action-create">
    <i class="fa fa-plus-circle"></i>
    <img src="/ControldeInventario/public/assets/img/add.png" alt="Crear" />
    Nuevo Usuario
</a>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Documento</th>
            <th>Nombres</th>
            <th>Apellidos</th>
            <th>Cargo</th>
            <th>Institución</th>
            <th>Usuario</th>
            <th>Rol</th>
            <th>Activo</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($usuarios as $usuario): ?>
            <tr>
                <td><?= htmlspecialchars($usuario['id']) ?></td>
                <td><?= htmlspecialchars($usuario['documento']) ?></td>
                <td><?= htmlspecialchars($usuario['nombres']) ?></td>
                <td><?= htmlspecialchars($usuario['apellidos']) ?></td>
                <td><?= htmlspecialchars($usuario['cargo']) ?></td>
                <td><?= htmlspecialchars($usuario['institucion_id']) ?></td>
                <td><?= htmlspecialchars($usuario['username']) ?></td>
                <td><?= htmlspecialchars($usuario['rol']) ?></td>
                <td><?= $usuario['activo'] ? 'Sí' : 'No' ?></td>
                <td>
                    <a href="/ControldeInventario/public/usuarios/edit?id=<?= $usuario['id'] ?>" class="usuarios-action-btn usuarios-action-edit">
                        <i class="fa fa-pen-to-square"></i>
                        <img src="/ControldeInventario/public/assets/img/edit.png" alt="Editar" />
                        Editar
                    </a>
                    <a href="/ControldeInventario/public/usuarios/delete?id=<?= $usuario['id'] ?>" class="usuarios-action-btn usuarios-action-delete" onclick="return confirm('¿Eliminar usuario?')">
                        <i class="fa fa-trash"></i>
                        <img src="/ControldeInventario/public/assets/img/delete.png" alt="Eliminar" />
                        Eliminar
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php
$content = ob_get_clean();
include __DIR__ . '/../layout.php';
?>
