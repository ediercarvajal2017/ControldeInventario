<?php
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
<?php
    // Vista: Listado de elementos
    ob_start();
?>
    <link rel="stylesheet" href="/ControldeInventario/public/assets/css/elementos-actions.css">
    <h2 class="titulo-elementos">Inventario de Elementos</h2>
    <a href="/ControldeInventario/public/elementos/create" class="elementos-action-btn elementos-action-create">
        <i class="fa fa-plus-circle"></i>
        Agregar Elemento
    </a>
    <table class="tabla-elementos tabla-elementos-separada">
        <thead>
            <tr>
                <th>Código</th>
                <th>Descripción</th>
                <th>Foto</th>
                <th>Valor</th>
                <th>Factura</th>
                <th>Fecha Ingreso</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($elementos) && is_array($elementos)): ?>
                <?php foreach ($elementos as $el): ?>
                    <tr>
                        <td><?= htmlspecialchars($el['codigo']) ?></td>
                        <td><?= htmlspecialchars($el['descripcion']) ?></td>
                        <td>
                            <?php
                            $foto_path = $_SERVER['DOCUMENT_ROOT'] . '/ControldeInventario/public/uploads/' . basename($el['foto']);
                            if (!empty($el['foto']) && file_exists($foto_path)) {
                                echo '<img src="/ControldeInventario/public/uploads/' . htmlspecialchars(basename($el['foto'])) . '" alt="Foto" width="60" height="60" class="miniatura-foto" style="object-fit:cover;object-position:center;border-radius:6px;border:1px solid #b2dfdb;background:#fafafa;cursor:pointer;aspect-ratio:1/1;">';
                            } else {
                                echo '<span style="display:inline-flex;align-items:center;gap:6px;color:#bdbdbd;font-size:1em;background:#f5f5f5;border:1px solid #e0e0e0;padding:7px 12px;border-radius:6px;">
                                    <i class="fa fa-image" style="font-size:1.5em;"></i> Sin foto
                                </span>';
                            }
                            ?>
                        </td>
                        <td>$<?= number_format($el['valor'], 2) ?></td>
                        <td>
                            <a href="/ControldeInventario/public/<?= htmlspecialchars($el['factura']) ?>" target="_blank" class="btn-ver-factura">
                                <i class="fa fa-file-invoice"></i> Ver factura
                            </a>
                        </td>
                        <td><?= htmlspecialchars($el['fecha_ingreso']) ?></td>
                        <td>
                            <a href="/ControldeInventario/public/elementos/edit?id=<?= $el['id'] ?>" class="elementos-action-btn elementos-action-edit">
                                <i class="fa fa-pen-to-square"></i>
                                Editar
                            </a>
                            <a href="/ControldeInventario/public/elementos/delete?id=<?= $el['id'] ?>" class="elementos-action-btn elementos-action-delete">
                                <i class="fa fa-trash"></i>
                                Eliminar
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="7">No hay elementos registrados.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
<!-- Modal para ver foto grande -->
<div id="modal-foto" style="display:none;position:fixed;z-index:9999;top:0;left:0;width:100vw;height:100vh;background:rgba(0,0,0,0.7);align-items:center;justify-content:center;">
    <span id="cerrar-modal-foto" style="position:absolute;top:30px;right:50px;font-size:2.5em;color:#fff;cursor:pointer;z-index:10001;"><i class="fa fa-times-circle"></i></span>
    <img id="img-modal-foto" src="" alt="Foto grande" style="max-width:90vw;max-height:80vh;border-radius:12px;box-shadow:0 4px 32px #0008;background:#fff;z-index:10000;">
</div>
<script>
// Modal para ver foto grande
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.miniatura-foto').forEach(function(img) {
        img.addEventListener('click', function() {
            document.getElementById('img-modal-foto').src = img.src;
            document.getElementById('modal-foto').style.display = 'flex';
        });
    });
    document.getElementById('cerrar-modal-foto').onclick = function() {
        document.getElementById('modal-foto').style.display = 'none';
        document.getElementById('img-modal-foto').src = '';
    };
    document.getElementById('modal-foto').onclick = function(e) {
        if (e.target === this) {
            this.style.display = 'none';
            document.getElementById('img-modal-foto').src = '';
        }
    };
});
</script>
<script src="/ControldeInventario/public/assets/js/elementos.js"></script>
<?php $content = ob_get_clean(); include __DIR__ . '/../layout.php'; ?>
