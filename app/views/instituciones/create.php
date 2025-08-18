<?php
// Vista: Registrar institución
ob_start();
?>
<h2>Registrar Institución Educativa</h2>
<form action="/ControldeInventario/public/instituciones/store" method="post" class="formulario">
    <label for="codigo_dane">Código DANE:</label>
    <input type="text" name="codigo_dane" id="codigo_dane" required>

    <label for="nombre">Nombre de la Institución:</label>
    <input type="text" name="nombre" id="nombre" required>

    <label for="direccion">Dirección:</label>
    <input type="text" name="direccion" id="direccion" required>

    <label for="tipo_sede">Tipo de Sede:</label>
    <select name="tipo_sede" id="tipo_sede" required>
        <option value="Principal">Principal</option>
        <option value="Sección">Sección</option>
    </select>

    <label for="telefono1">Teléfono 1:</label>
    <input type="text" name="telefono1" id="telefono1" maxlength="20">

    <label for="telefono2">Teléfono 2:</label>
    <input type="text" name="telefono2" id="telefono2" maxlength="20">

    <label for="celular">Celular:</label>
    <input type="text" name="celular" id="celular" maxlength="20">

    <label for="email">Correo electrónico:</label>
    <input type="email" name="email" id="email" maxlength="100">

    <button type="submit" class="btn">Registrar</button>
</form>

<?php if (isset($error)): ?>
    <div class="error" style="color:red; margin-bottom:10px;">
        <?= htmlspecialchars($error) ?>
    </div>
<?php endif; ?>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layout.php';
?>
