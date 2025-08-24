<?php
ob_start();
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<h2 class="titulo-usuarios">Usuarios</h2>
<?php if (isset($_SESSION['exito'])): ?>
    <div class="mensaje-exito"><?= htmlspecialchars($_SESSION['exito']) ?></div>
    <?php unset($_SESSION['exito']); ?>
<?php endif; ?>
<?php if (isset($_SESSION['error'])): ?>
    <div class="mensaje-error"><?= htmlspecialchars($_SESSION['error']) ?></div>
    <?php unset($_SESSION['error']); ?>
<?php endif; ?>
<a href="<?= BASE_URL ?>usuarios/create" class="btn-usuario btn-usuario-create" style="margin-bottom:1.5em;">
    <i class="fa fa-plus-circle"></i>
    Nuevo Usuario
</a>
<div class="tabla-responsive">
<table class="tabla-usuarios">
    <thead>
        <tr>
            <th>ID</th>
            <th>Documento</th>
            <th>Nombres</th>
            <th>Apellidos</th>
            <th>Cargo</th>
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
                <td><?= htmlspecialchars($usuario['username']) ?></td>
                <td><?= htmlspecialchars($usuario['rol']) ?></td>
                <td><?= $usuario['activo'] ? 'Sí' : 'No' ?></td>
                <td>
                    <a href="<?= BASE_URL ?>usuarios/edit?id=<?= $usuario['id'] ?>" class="btn-usuario btn-usuario-edit">
                        <i class="fa fa-pen-to-square"></i>
                        Editar
                    </a>
                    <a href="<?= BASE_URL ?>usuarios/delete?id=<?= $usuario['id'] ?>" class="btn-usuario btn-usuario-delete" onclick="return confirm('¿Eliminar usuario?')">
                        <i class="fa fa-trash"></i>
                        Eliminar
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</div>
<?php
$content = ob_get_clean();
include __DIR__ . '/../layout.php';
?>
