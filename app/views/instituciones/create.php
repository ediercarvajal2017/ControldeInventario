<link rel="stylesheet" href="<?= BASE_URL ?>assets/css/form-instituciones.css">
<?php
// Vista: Registrar institución
ob_start();
?>

<h2 class="titulo-instituciones">Registrar Institución Educativa</h2>
<?php if (!empty($error)): ?>
    <div class="mensaje-error-institucion"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>
<?php if (!empty($_SESSION['mensaje_exito'])): ?>
    <div class="mensaje-exito-institucion"><?= $_SESSION['mensaje_exito']; unset($_SESSION['mensaje_exito']); ?></div>
<?php endif; ?>

<form action="<?= BASE_URL ?>instituciones/store" method="post" class="formulario form-moderno">
    <div class="form-row">
        <div class="form-group">
            <label for="codigo_dane">Código DANE</label>
            <input type="text" name="codigo_dane" id="codigo_dane" class="input-text" required value="<?= isset($_POST['codigo_dane']) ? htmlspecialchars($_POST['codigo_dane']) : '' ?>" aria-label="Código DANE">
        </div>
        <div class="form-group">
            <label for="nombre">Nombre de la Institución</label>
            <input type="text" name="nombre" id="nombre" class="input-text" required value="<?= isset($_POST['nombre']) ? htmlspecialchars($_POST['nombre']) : '' ?>" aria-label="Nombre de la Institución">
        </div>
    </div>
    <div class="form-row">
        <div class="form-group">
            <label for="direccion">Dirección</label>
            <input type="text" name="direccion" id="direccion" class="input-text" required value="<?= isset($_POST['direccion']) ? htmlspecialchars($_POST['direccion']) : '' ?>" aria-label="Dirección">
        </div>
        <div class="form-group">
            <label for="tipo_sede">Tipo de Sede</label>
            <select name="tipo_sede" id="tipo_sede" class="input-select" required aria-label="Tipo de Sede">
                <option value="Principal" <?= (isset($_POST['tipo_sede']) && $_POST['tipo_sede']=='Principal')?'selected':'' ?>>Principal</option>
                <option value="Sección" <?= (isset($_POST['tipo_sede']) && $_POST['tipo_sede']=='Sección')?'selected':'' ?>>Sección</option>
            </select>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group">
            <label for="telefono1">Teléfono 1</label>
            <input type="text" name="telefono1" id="telefono1" class="input-text" maxlength="20" value="<?= isset($_POST['telefono1']) ? htmlspecialchars($_POST['telefono1']) : '' ?>" aria-label="Teléfono 1">
        </div>
        <div class="form-group">
            <label for="telefono2">Teléfono 2</label>
            <input type="text" name="telefono2" id="telefono2" class="input-text" maxlength="20" value="<?= isset($_POST['telefono2']) ? htmlspecialchars($_POST['telefono2']) : '' ?>" aria-label="Teléfono 2">
        </div>
    </div>
    <div class="form-row">
        <div class="form-group">
            <label for="celular">Celular</label>
            <input type="text" name="celular" id="celular" class="input-text" maxlength="20" value="<?= isset($_POST['celular']) ? htmlspecialchars($_POST['celular']) : '' ?>" aria-label="Celular">
        </div>
        <div class="form-group">
            <label for="email">Correo electrónico</label>
            <input type="email" name="email" id="email" class="input-text" maxlength="100" value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>" aria-label="Correo electrónico">
        </div>
    </div>
    <button type="submit" class="btn-institucion" aria-label="Registrar">Registrar</button>
</form>

<!-- Mensajes ya gestionados arriba del formulario -->

<?php
$content = ob_get_clean();
include __DIR__ . '/../layout.php';
?>
