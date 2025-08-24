<?php
    // Vista: Listado de movimientos
    ob_start();
    if (isset($_SESSION['exito'])) {
            echo '<div class="mensaje-movimiento-exito">'.htmlspecialchars($_SESSION['exito']).'</div>';
        unset($_SESSION['exito']);
    }
    if (!isset($movimientos)) $movimientos = [];
?>
    <h2 class="titulo-movimientos">Movimientos</h2>
        <a href="<?= rtrim(BASE_URL, '/') ?>/movimientos/create" class="btn-movimiento movimientos-action-create" style="margin-bottom:1.2em;display:inline-block;">
        <i class="fa fa-plus-circle"></i> Nuevo Movimiento
    </a>
        <table class="tabla-movimientos tabla-movimientos-separada">
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
                    <a href="<?= rtrim(BASE_URL, '/') ?>/movimientos/edit?id=<?= $m['id'] ?>" class="btn-movimiento movimientos-action-edit" title="Editar">
                        <i class="fa fa-pen-to-square"></i> Editar
                    </a>
                    <a href="<?= rtrim(BASE_URL, '/') ?>/movimientos/delete?id=<?= $m['id'] ?>" class="btn-movimiento movimientos-action-delete" onclick="return confirm('¿Eliminar?')" title="Eliminar">
                        <i class="fa fa-trash"></i> Eliminar
                    </a>
                </td>
            </tr>
        <?php endforeach; endif; ?>
        </tbody>
    </table>
<?php $content = ob_get_clean(); include __DIR__ . '/../layout.php'; ?>


