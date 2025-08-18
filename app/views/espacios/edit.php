
<?php
// Vista: Editar espacio
ob_start();
?>
<!-- Enlace a estilos específicos del formulario de espacios y asignaciones -->
<link rel="stylesheet" href="/ControldeInventario/public/assets/css/form-espacios.css">
<link rel="stylesheet" href="/ControldeInventario/public/assets/css/form-asignaciones.css">

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

<h2 class="titulo-elementos">Editar Espacio Físico</h2>

<form action="/ControldeInventario/public/espacios/update" method="post" class="form-espacio form-asignacion">
    <input type="hidden" name="id" value="<?= htmlspecialchars($espacio['id']) ?>">

    <label for="nombre">Nombre del Espacio:</label>
    <input type="text" name="nombre" id="nombre" required value="<?= htmlspecialchars($espacio['nombre']) ?>">

    <label for="numeracion">Número del Espacio:</label>
    <input type="text" name="numeracion" id="numeracion" required value="<?= htmlspecialchars($espacio['numeracion']) ?>">

    <button type="submit" class="btn">Actualizar</button>
</form>
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
