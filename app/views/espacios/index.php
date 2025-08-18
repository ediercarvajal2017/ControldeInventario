<?php
// Vista: Listado de espacios
ob_start(); ?>
<link rel="stylesheet" href="/ControldeInventario/public/assets/css/form-espacios.css">
<h2 class="titulo-elementos">Consulta de Espacios</h2>
<a href="/ControldeInventario/public/espacios/create" class="btn-ver-factura" style="margin-bottom:1.5em;">
    <i class="fa fa-plus-circle"></i> Registrar Espacio
</a>
<table class="tabla-elementos">
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
                    <a href="/ControldeInventario/public/espacios/edit?id=<?= $esp['id'] ?>" class="btn-ver-factura" title="Editar">
                        <i class="fa fa-pen-to-square"></i> Editar
                    </a>
                    <a href="/ControldeInventario/public/espacios/delete?id=<?= $esp['id'] ?>" class="btn-ver-factura" style="background:#fff0f3;color:#d32f2f;border-color:#f7b2b2;" title="Eliminar" onclick="return confirm('¿Eliminar espacio?')">
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
