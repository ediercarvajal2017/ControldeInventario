
<?php
// Vista: Listado de instituciones
ob_start(); ?>
<link rel="stylesheet" href="/ControldeInventario/public/assets/css/instituciones-actions.css">
<h2>Instituciones Educativas</h2>
<a href="/ControldeInventario/public/instituciones/create" class="instituciones-action-btn instituciones-action-create">
    <i class="fa fa-plus-circle"></i>
    <img src="/ControldeInventario/public/assets/img/add.png" alt="Crear" />
    Registrar Institución
</a>
<?php if (!empty($error)): ?>
    <div class="alert alert-danger"><?= $error ?></div>
<?php endif; ?>
<table class="tabla">
    <thead>
        <tr>
            <th>Código DANE</th>
            <th>Nombre</th>
            <th>Dirección</th>
            <th>Tipo de Sede</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($instituciones) && is_array($instituciones)): ?>
            <?php foreach ($instituciones as $inst): ?>
            <tr>
                <td><?= isset($inst['codigo_dane']) ? htmlspecialchars($inst['codigo_dane']) : '' ?></td>
                <td><?= htmlspecialchars($inst['nombre']) ?></td>
                <td><?= htmlspecialchars($inst['direccion']) ?></td>
                <td><?= htmlspecialchars($inst['tipo_sede']) ?></td>
                <td>
                    <a href="/ControldeInventario/public/instituciones/edit?id=<?= $inst['id'] ?>" class="instituciones-action-btn instituciones-action-edit">
                        <i class="fa fa-pen-to-square"></i>
                        <img src="/ControldeInventario/public/assets/img/edit.png" alt="Editar" />
                        Editar
                    </a>
                    <a href="/ControldeInventario/public/instituciones/delete?id=<?= $inst['id'] ?>" class="instituciones-action-btn instituciones-action-delete" onclick="return confirm('¿Eliminar institución?')">
                        <i class="fa fa-trash"></i>
                        <img src="/ControldeInventario/public/assets/img/delete.png" alt="Eliminar" />
                        Eliminar
                    </a>
                </td>
            </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="5">No hay instituciones registradas.</td></tr>
        <?php endif; ?>
    </tbody>
</table>
<?php $content = ob_get_clean(); include __DIR__ . '/../layout.php'; ?>
