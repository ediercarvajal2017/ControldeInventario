<!DOCTYPE html>
<html lang="es">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Control de Inventario</title>
    <link rel="stylesheet" href="/ControldeInventario/public/assets/css/style.css">
    <!-- Estilos específicos para asignaciones y elementos -->
    <?php if (isset($_SERVER['REQUEST_URI']) && strpos($_SERVER['REQUEST_URI'], '/asignaciones') !== false): ?>
        <link rel="stylesheet" href="/ControldeInventario/public/assets/css/form-asignaciones.css">
    <?php endif; ?>
    <?php if (isset($_SERVER['REQUEST_URI']) && strpos($_SERVER['REQUEST_URI'], '/elementos') !== false): ?>
        <link rel="stylesheet" href="/ControldeInventario/public/assets/css/form-elementos.css">
        <link rel="stylesheet" href="/ControldeInventario/public/assets/css/form-asignaciones.css">
    <?php endif; ?>
    <!-- Font Awesome para iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    </head>
    <body>
        <header>
            <div class="header-flex">
                <div class="logo-header">
                    <img src="/ControldeInventario/public/assets/img/logo-colegio.png" alt="Logo Colegio" class="logo-colegio">
                </div>
                <h1>Gestión de Inventario</h1>
                <div class="usuario-header">
                    <?php 
                    if (session_status() === PHP_SESSION_NONE) session_start();
                    $usuario = $_SESSION['usuario'] ?? null;
                    $nombre = $usuario['nombres'] ?? 'Invitado';
                    $foto = $usuario['foto'] ?? '/ControldeInventario/public/assets/img/avatar-default.png';
                    ?>
                    <img src="<?= htmlspecialchars($foto) ?>" alt="Avatar" class="avatar-usuario">
                    <span class="nombre-usuario"><?= htmlspecialchars($nombre) ?></span>
                </div>
            </div>
            <nav class="main-nav">
                <ul>
                    <li><a href="/ControldeInventario/public/" class="nav-link"><i class="fa fa-home"></i> Inicio</a></li>
                    <li><a href="/ControldeInventario/public/elementos" class="nav-link"><i class="fa fa-box"></i> Elementos</a></li>
                    <li><a href="/ControldeInventario/public/espacios" class="nav-link"><i class="fa fa-building"></i> Espacios</a></li>
                    <li><a href="/ControldeInventario/public/asignaciones" class="nav-link"><i class="fa fa-arrow-right-arrow-left"></i> Asignaciones</a></li>
                    <li><a href="/ControldeInventario/public/usuarios" class="nav-link"><i class="fa fa-users"></i> Usuarios</a></li>
                    <li><a href="/ControldeInventario/public/instituciones" class="nav-link"><i class="fa fa-school"></i> Instituciones</a></li>
                </ul>
            </nav>
        </header>
        <main>
            <?php echo $content ?? ''; ?>
        </main>
        <footer>
            <div class="footer-info">
                <strong>Institución Educativa Ejemplo</strong><br>
                Calle 123 #45-67, Ciudad, País<br>
                Tel: (601) 123 4567
            </div>
        </footer>
    </body>
</html>