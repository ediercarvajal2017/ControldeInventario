
<?php
    // Vista: Listado de asignaciones
    // ...
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
    // ...
?>
    <h2 class="titulo-asignaciones">Asignaciones de Elementos</h2>
    <a href="/ControldeInventario/asignaciones/create" class="action-btn action-create">
        <i class="fa fa-plus-circle"></i>
    <img src="/ControldeInventario/assets/img/add.png" alt="Crear" />
        Nueva Asignación
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
                            <a href="/ControldeInventario/asignaciones/edit?id=<?= $as['id'] ?>" class="action-btn action-edit">
                                <i class="fa fa-pen-to-square"></i>
                                <img src="/ControldeInventario/assets/img/edit.png" alt="Editar" />
                                Editar
                            </a>
                            <a href="/ControldeInventario/asignaciones/delete?id=<?= $as['id'] ?>" class="action-btn action-delete">
                                <i class="fa fa-trash"></i>
                                <img src="/ControldeInventario/assets/img/delete.png" alt="Eliminar" />
                                Eliminar
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="7">No hay asignaciones registradas.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
<script src="/ControldeInventario/public/assets/js/asignaciones.js"></script>
<?php $content = ob_get_clean(); include __DIR__ . '/../layout.php'; ?>
