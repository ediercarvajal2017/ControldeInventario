

<?php
// Vista: Listado de asignaciones
ob_start();
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION['exito'])) {
    echo '<div class="mensaje-exito">' . $_SESSION['exito'] . '</div>';
    unset($_SESSION['exito']);
}
if (isset($_SESSION['error'])) {
    echo '<div class="mensaje-error">' . $_SESSION['error'] . '</div>';
    unset($_SESSION['error']);
}
?>
<link rel="stylesheet" href="<?= BASE_URL ?>assets/css/form-asignaciones.css">
<h2 class="titulo-asignaciones" style="margin-top:2.7em;">Asignaciones</h2>
<a href="<?= BASE_URL ?>asignaciones/create" class="btn-asignaciones btn-asignaciones-create" style="margin-bottom:1.5em;">
    <i class="fa fa-plus-circle"></i> Nueva Asignación
</a>
<table class="tabla-asignaciones tabla-asignaciones-separada">
    <thead>
        <tr>
            <th>Elemento</th>
            <th>Espacio</th>
            <th>Responsable</th>
            <th>Fecha Asignación</th>
            <th>Estado</th>
            <th>Ubicación</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($asignaciones) && is_array($asignaciones)): ?>
            <?php foreach ($asignaciones as $as): ?>
            <tr>
                <td><?= htmlspecialchars($as['elemento_id']) ?></td>
                <td><?= htmlspecialchars($as['espacio_id']) ?></td>
                <td><?= htmlspecialchars($as['responsable_id']) ?></td>
                <td><?= htmlspecialchars($as['fecha_asignacion']) ?></td>
                <td><?= htmlspecialchars($as['estado']) ?></td>
                <td><?= htmlspecialchars($as['ubicacion']) ?></td>
                <td>
                    <a href="<?= BASE_URL ?>asignaciones/edit?id=<?= $as['id'] ?>" class="btn-asignaciones btn-asignaciones-edit" title="Editar">
                        <i class="fa fa-pen-to-square"></i> Editar
                    </a>
                    <a href="<?= BASE_URL ?>asignaciones/delete?id=<?= $as['id'] ?>" class="btn-asignaciones btn-asignaciones-delete" title="Eliminar" onclick="return confirm('¿Eliminar asignación?')">
                        <i class="fa fa-trash"></i> Eliminar
                    </a>
                </td>
            </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="7">No hay asignaciones registradas.</td></tr>
        <?php endif; ?>
    </tbody>
</table>
<?php $content = ob_get_clean(); include __DIR__ . '/../layout.php'; ?>
