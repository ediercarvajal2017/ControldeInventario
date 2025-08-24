

<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// Vista: Listado de espacios
ob_start();
?>
<link rel="stylesheet" href="<?= BASE_URL ?>assets/css/form-espacios.css">
<link rel="stylesheet" href="<?= BASE_URL ?>assets/css/elementos-actions.css">
<h2 class="titulo-espacios">Inventario de Espacios</h2>

<?php if (isset($_SESSION['exito'])): ?>
    <div class="mensaje-exito"><?= $_SESSION['exito']; unset($_SESSION['exito']); ?></div>
<?php endif; ?>
<?php if (isset($_SESSION['error'])): ?>
    <div class="mensaje-error"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
<?php endif; ?>

<a href="<?= BASE_URL ?>espacios/create" class="btn-espacios btn-espacios-create" style="margin-bottom:1.5em;">
    <i class="fa fa-plus-circle"></i> Registrar Espacio
</a>
<table class="tabla-elementos tabla-elementos-separada">
    <thead>
        <tr>
            <th>Nombre del Espacio</th>
            <th>Número del Espacio</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($espacios) && is_array($espacios)): ?>
            <?php foreach ($espacios as $esp): ?>
            <tr>
                <td><?= htmlspecialchars($esp['nombre']) ?></td>
                <td><?= htmlspecialchars($esp['numeracion']) ?></td>
                <td>
                    <a href="<?= BASE_URL ?>espacios/edit?id=<?= $esp['id'] ?>" class="btn-espacios btn-espacios-edit" title="Editar">
                        <i class="fa fa-pen-to-square"></i> Editar
                    </a>
                    <a href="<?= BASE_URL ?>espacios/delete?id=<?= $esp['id'] ?>" class="btn-espacios btn-espacios-delete" title="Eliminar" onclick="return confirm('¿Eliminar espacio?')">
                        <i class="fa fa-trash"></i> Eliminar
                    </a>
                </td>
            </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="3">No hay espacios registrados.</td></tr>
        <?php endif; ?>
    </tbody>
</table>
<?php $content = ob_get_clean(); include __DIR__ . '/../layout.php'; ?>
