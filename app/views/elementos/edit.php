<!-- Enlace a estilos unificados del módulo elementos -->
<link rel="stylesheet" href="<?= BASE_URL ?>assets/css/form-elementos.css">
<script>
    // Ocultar mensaje de éxito/error después de 3.5 segundos
    setTimeout(function() {
        var msg = document.querySelector('.mensaje-exito, .mensaje-error');
        if (msg) {
            msg.style.transition = 'opacity 0.7s';
            msg.style.opacity = 0;
            setTimeout(function() { msg.style.display = 'none'; }, 700);
        }
    }, 3500);
</script>

<?php
    // Vista: Editar elemento
    ob_start();
    // Verificar que $elemento esté definido y sea array
    if (!isset($elemento) || !is_array($elemento)) {
        echo '<div class="error">No se encontró el elemento a editar.</div>';
    } else {
?>
    <h2 class="titulo-elementos">Editar Elemento</h2>

    <?php if (!empty($error)): ?>
        <div class="mensaje-error">
            <?= $error ?>
        </div>
    <?php endif; ?>

    <?php if ((isset($exito) && $exito) || (isset($_GET['exito']) && $_GET['exito'] == 1)): ?>
        <div class="mensaje-exito">
            ¡El elemento fue actualizado exitosamente!
        </div>
    <?php endif; ?>
    <form action="<?= BASE_URL ?>elementos/update?id=<?= $elemento['id'] ?>" method="post" enctype="multipart/form-data" class="form-elementos">
        <label for="codigo">Código:</label>
    <input type="text" name="codigo" id="codigo-elementos" value="<?= htmlspecialchars($elemento['codigo']) ?>" required>

        <label for="descripcion">Descripción:</label>
    <textarea name="descripcion" id="descripcion-elementos" required><?= htmlspecialchars($elemento['descripcion']) ?></textarea>

        <label for="foto">Foto actual:</label>
        <?php
        // Ruta absoluta real para file_exists (compatible Windows/Linux)
    $foto_path = dirname(__DIR__, 3) . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . basename($elemento['foto']);
        if (!empty($elemento['foto']) && file_exists($foto_path)) {
            // Miniatura clickeable para ampliar
            echo '<span class="miniatura-foto-edit" style="display:inline-block;cursor:pointer;">'
                . '<img src="' . BASE_URL . 'uploads/' . htmlspecialchars(basename($elemento['foto'])) . '" alt="Foto" width="60" style="border-radius:6px;border:1px solid #b2dfdb;background:#fafafa;object-fit:cover;object-position:center;aspect-ratio:1/1;">'
                . '</span>';
        } else {
            echo '<span style="display:inline-flex;align-items:center;gap:6px;color:#bdbdbd;font-size:1em;background:#f5f5f5;border:1px solid #e0e0e0;padding:7px 12px;border-radius:6px;">
                <i class="fa fa-image" style="font-size:1.5em;"></i> Sin foto disponible
            </span>';
        }
        ?>

        <label for="foto">Nueva foto (opcional):</label>
    <input type="file" name="foto" id="foto-elementos" accept="image/*">

        <label for="valor">Valor:</label>
    <input type="number" name="valor" id="valor-elementos" value="<?= htmlspecialchars($elemento['valor']) ?>" required min="0">

    <label for="factura">Factura actual:</label>
    <a href="<?= BASE_URL ?>uploads/<?= htmlspecialchars(basename($elemento['factura'])) ?>" target="_blank" class="btn-ver-factura-elementos">
        <i class="fa fa-file-invoice" style="font-size:1.1em;"></i> Ver factura
    </a>

        <label for="factura">Nueva factura (opcional):</label>
    <input type="file" name="factura" id="factura-elementos" accept="application/pdf">

        <label for="fecha_ingreso">Fecha de ingreso:</label>
    <input type="date" name="fecha_ingreso" id="fecha-ingreso-elementos" value="<?= htmlspecialchars($elemento['fecha_ingreso']) ?>" required>

    <button type="submit" class="btn-elementos">Actualizar</button>
    </form>
    <!-- Modal para ver foto grande -->
    <div id="modal-foto-edit" style="display:none;position:fixed;z-index:9999;top:0;left:0;width:100vw;height:100vh;background:rgba(0,0,0,0.7);align-items:center;justify-content:center;">
        <span id="cerrar-modal-foto-edit" style="position:absolute;top:30px;right:50px;font-size:2.5em;color:#fff;cursor:pointer;z-index:10001;"><i class="fa fa-times-circle"></i></span>
        <img id="img-modal-foto-edit" src="" alt="Foto grande" style="max-width:90vw;max-height:80vh;border-radius:12px;box-shadow:0 4px 32px #0008;background:#fff;z-index:10000;">
    </div>
    <script>
    // Modal para ampliar foto en edición
    document.addEventListener('DOMContentLoaded', function() {
        var miniatura = document.querySelector('.miniatura-foto-edit img');
        var modal = document.getElementById('modal-foto-edit');
        var imgModal = document.getElementById('img-modal-foto-edit');
        var cerrar = document.getElementById('cerrar-modal-foto-edit');
        if (miniatura && modal && imgModal && cerrar) {
            miniatura.addEventListener('click', function() {
                imgModal.src = miniatura.src;
                modal.style.display = 'flex';
            });
            cerrar.addEventListener('click', function() {
                modal.style.display = 'none';
                imgModal.src = '';
            });
            modal.addEventListener('click', function(e) {
                if (e.target === modal) {
                    modal.style.display = 'none';
                    imgModal.src = '';
                }
            });
        }
    });
    </script>
<?php
    }
    $content = ob_get_clean();
    include __DIR__ . '/../layout.php';
?>
