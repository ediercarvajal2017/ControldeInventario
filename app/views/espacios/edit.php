

<!-- Enlace a estilos específicos del formulario de espacios y asignaciones -->
<link rel="stylesheet" href="<?= BASE_URL ?>assets/css/form-espacios.css">
<link rel="stylesheet" href="<?= BASE_URL ?>assets/css/form-asignaciones.css">
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
// Vista: Editar espacio
ob_start();
// Verificar que $espacio esté definido y sea array
if (!isset($espacio) || !is_array($espacio)) {
    echo '<div class="error">No se encontró el espacio a editar.</div>';
} else {
?>
    <h2 class="titulo-espacios">Editar Espacio Físico</h2>

    <?php if (!empty($error)): ?>
        <div class="mensaje-error">
            <?= htmlspecialchars($error) ?>
        </div>
    <?php endif; ?>

    <?php if ((isset($exito) && $exito) || (isset($_GET['exito']) && $_GET['exito'] == 1)): ?>
        <div class="mensaje-exito">
            ¡El espacio fue actualizado exitosamente!
        </div>
    <?php endif; ?>

    <form action="<?= BASE_URL ?>espacios/update?id=<?= $espacio['id'] ?>" method="post" class="form-espacio">
        <input type="hidden" name="id" value="<?= htmlspecialchars($espacio['id']) ?>">

        <label for="nombre">Nombre del Espacio:</label>
        <input type="text" name="nombre" id="nombre" required value="<?= htmlspecialchars($espacio['nombre']) ?>">

        <label for="numeracion">Número del Espacio:</label>
        <input type="text" name="numeracion" id="numeracion" required value="<?= htmlspecialchars($espacio['numeracion']) ?>">

    <button type="submit" class="btn-espacios btn-espacios-edit">Actualizar</button>
    </form>
<?php }
$content = ob_get_clean();
include __DIR__ . '/../layout.php';
?>
