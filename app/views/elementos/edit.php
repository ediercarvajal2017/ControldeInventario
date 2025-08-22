<!-- Enlace a estilos específicos del formulario de elementos y asignaciones -->
<link rel="stylesheet" href="/ControldeInventario/public/assets/css/form-asignaciones.css">
<link rel="stylesheet" href="/ControldeInventario/assets/css/form-elementos.css">
<link rel="stylesheet" href="/ControldeInventario/assets/css/form-asignaciones.css">
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

    <h2 class="titulo-elementos">Editar Elemento</h2>
    <form action="/ControldeInventario/elementos/update?id=<?= $elemento['id'] ?>" method="post" enctype="multipart/form-data" class="form-elemento form-asignacion">
        <label for="codigo">Código:</label>
        <input type="text" name="codigo" id="codigo" value="<?= htmlspecialchars($elemento['codigo']) ?>" required>

        <label for="descripcion">Descripción:</label>
        <textarea name="descripcion" id="descripcion" required><?= htmlspecialchars($elemento['descripcion']) ?></textarea>

        <label for="foto">Foto actual:</label>
        <?php
        $foto_path = $_SERVER['DOCUMENT_ROOT'] . '/ControldeInventario/uploads/' . basename($elemento['foto']);
        if (!empty($elemento['foto']) && file_exists($foto_path)) {
            echo '<img src="/ControldeInventario/uploads/' . htmlspecialchars(basename($elemento['foto'])) . '" alt="Foto" width="60" style="border-radius:6px;border:1px solid #b2dfdb;background:#fafafa;">';
        } else {
            echo '<span style="display:inline-flex;align-items:center;gap:6px;color:#bdbdbd;font-size:1em;background:#f5f5f5;border:1px solid #e0e0e0;padding:7px 12px;border-radius:6px;">
                <i class="fa fa-image" style="font-size:1.5em;"></i> Sin foto disponible
            </span>';
        }
        ?>

        <label for="foto">Nueva foto (opcional):</label>
        <input type="file" name="foto" id="foto" accept="image/*">

        <label for="valor">Valor:</label>
        <input type="number" name="valor" id="valor" value="<?= htmlspecialchars($elemento['valor']) ?>" required min="0">

    <label for="factura">Factura actual:</label>
    <a href="/ControldeInventario/<?= htmlspecialchars($elemento['factura']) ?>" target="_blank" class="btn-ver-factura" style="display:inline-flex;align-items:center;gap:7px;padding:7px 16px;background:#e0f2f1;color:#00695c;font-weight:600;border-radius:6px;text-decoration:none;border:1px solid #b2dfdb;transition:background .2s,border .2s;box-shadow:0 1px 4px #0001;">
        <i class="fa fa-file-invoice" style="font-size:1.1em;"></i> Ver factura
    </a>

        <label for="factura">Nueva factura (opcional):</label>
        <input type="file" name="factura" id="factura" accept="application/pdf">

        <label for="fecha_ingreso">Fecha de ingreso:</label>
        <input type="date" name="fecha_ingreso" id="fecha_ingreso" value="<?= htmlspecialchars($elemento['fecha_ingreso']) ?>" required>

        <button type="submit" class="btn">Actualizar</button>
    </form>
<?php
    }
    $content = ob_get_clean();
    include __DIR__ . '/../layout.php';
?>
