<?php
// Vista: Listado de instituciones
ob_start(); ?>
<link rel="stylesheet" href="<?= BASE_URL ?>assets/css/form-instituciones.css">
<h2 class="titulo-instituciones">Instituciones Educativas</h2>
<?php if (!empty($_SESSION['mensaje_exito'])): ?>
    <div class="mensaje-exito-institucion"><?= $_SESSION['mensaje_exito']; unset($_SESSION['mensaje_exito']); ?></div>
<?php endif; ?>
<?php if (!empty($_SESSION['mensaje_error'])): ?>
    <div class="mensaje-error-institucion"><?= $_SESSION['mensaje_error']; unset($_SESSION['mensaje_error']); ?></div>
<?php endif; ?>
<?php if (!empty($error)): ?>
    <div class="mensaje-error-institucion"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>
<div>
    <a href="<?= BASE_URL ?>instituciones/create" class="btn-institucion">
        <i class="fa fa-plus-circle"></i> Registrar Institución
    </a>
    <table class="tabla-instituciones">
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
                    <td class="acciones-institucion">
                        <a href="<?= BASE_URL ?>instituciones/edit?id=<?= $inst['id'] ?>" class="btn-editar-institucion" title="Editar">
                            <i class="fa fa-pen-to-square"></i> Editar
                        </a>
                        <a href="<?= BASE_URL ?>instituciones/delete?id=<?= $inst['id'] ?>" class="btn-eliminar-institucion" title="Eliminar" onclick="return confirm('¿Eliminar institución?')">
                            <i class="fa fa-trash"></i>Eliminar
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="5">No hay instituciones registradas.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<?php $content = ob_get_clean(); include __DIR__ . '/../layout.php'; ?>
