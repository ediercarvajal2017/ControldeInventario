<?php
    // Vista: Listado de movimientos
    ob_start();
    if (isset($_SESSION['exito'])) {
        echo '<div class="alert alert-success">'.htmlspecialchars($_SESSION['exito']).'</div>';
        unset($_SESSION['exito']);
    }
    if (!isset($movimientos)) $movimientos = [];
?>
    <link rel="stylesheet" href="/ControldeInventario/public/assets/css/movimientos-actions.css">
    <h2>Movimientos</h2>
    <a href="/ControldeInventario/public/movimientos/create" class="movimientos-action-btn movimientos-action-create">
        <i class="fa fa-plus-circle"></i>
        <img src="/ControldeInventario/public/assets/img/add.png" alt="Crear" />
        Nuevo Movimiento
    </a>
    <table class="tabla">
        <thead>
            <tr>
                <th>ID</th>
                <th>Elemento ID</th>
                <th>Tipo de Movimiento</th>
                <th>Fecha</th>
                <th>Estado</th>
                <th>Usuario Movimiento ID</th>
                <th>Destino</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        <?php if (empty($movimientos)): ?>
            <tr><td colspan="8">No hay movimientos.</td></tr>
        <?php else: foreach ($movimientos as $m): ?>
            <tr>
                <td><?= htmlspecialchars($m['id']) ?></td>
                <td><?= htmlspecialchars($m['elemento_id']) ?></td>
                <td><?= htmlspecialchars($m['tipo_movimiento']) ?></td>
                <td><?= htmlspecialchars($m['fecha']) ?></td>
                <td><?= htmlspecialchars($m['estado']) ?></td>
                <td><?= htmlspecialchars($m['usuario_movimiento_id']) ?></td>
                <td><?= htmlspecialchars($m['destino']) ?></td>
                <td>
                    <a href="/ControldeInventario/public/movimientos/edit?id=<?= $m['id'] ?>" class="movimientos-action-btn movimientos-action-edit">
                        <i class="fa fa-pen-to-square"></i>
                        <img src="/ControldeInventario/public/assets/img/edit.png" alt="Editar" />
                        Editar
                    </a>
                    <a href="/ControldeInventario/public/movimientos/delete?id=<?= $m['id'] ?>" class="movimientos-action-btn movimientos-action-delete" onclick="return confirm('¿Eliminar?')">
                        <i class="fa fa-trash"></i>
                        <img src="/ControldeInventario/public/assets/img/delete.png" alt="Eliminar" />
                        Eliminar
                    </a>
                </td>
            </tr>
        <?php endforeach; endif; ?>
        </tbody>
    </table>
<?php $content = ob_get_clean(); include __DIR__ . '/../layout.php'; ?>
