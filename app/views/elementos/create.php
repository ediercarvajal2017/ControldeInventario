<?php
    // Vista: Crear elemento
    ob_start();
?>
    <!-- Enlace a estilos unificados del módulo elementos -->
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/form-elementos.css">


    <h2 class="titulo-elementos">Agregar Elemento</h2>

    <?php if (!empty($error)): ?>
        <div class="mensaje-error">
            <?= $error ?>
        </div>
    <?php endif; ?>

    <?php if ((isset($exito) && $exito) || (isset($_GET['exito']) && $_GET['exito'] == 1)): ?>
        <div class="mensaje-exito">
            ¡El elemento fue registrado exitosamente!
        </div>
    <?php endif; ?>

    <form action="<?= BASE_URL ?>elementos/store" method="post" enctype="multipart/form-data" class="form-elementos">
        <label for="codigo">Código:</label>
    <input type="text" name="codigo" id="codigo-elementos" required value="<?= isset($_POST['codigo']) ? htmlspecialchars($_POST['codigo']) : '' ?>">

        <label for="descripcion">Descripción:</label>
    <textarea name="descripcion" id="descripcion-elementos" required><?= isset($_POST['descripcion']) ? htmlspecialchars($_POST['descripcion']) : '' ?></textarea>

        <label for="foto">Foto:</label>
    <input type="file" name="foto" id="foto-elementos" accept="image/*" required>

        <label for="valor">Valor:</label>
    <input type="number" name="valor" id="valor-elementos" required min="0" value="<?= isset($_POST['valor']) ? htmlspecialchars($_POST['valor']) : '' ?>" style="appearance: textfield; -moz-appearance: textfield; -webkit-appearance: textfield;">

    <label for="factura">Factura:</label>
    <input type="file" name="factura" id="factura-elementos" accept="application/pdf" required>

        <label for="fecha_ingreso">Fecha de ingreso:</label>
    <input type="date" name="fecha_ingreso" id="fecha-ingreso-elementos" required value="<?= isset($_POST['fecha_ingreso']) ? htmlspecialchars($_POST['fecha_ingreso']) : '' ?>">

    <button type="submit" class="btn-elementos">Guardar</button>
    </form>
<script src="<?= BASE_URL ?>assets/js/elementos.js"></script>
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
    $content = ob_get_clean();
    include __DIR__ . '/../layout.php';
?>
