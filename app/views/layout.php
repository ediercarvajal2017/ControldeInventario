<!DOCTYPE html>
<html lang="es">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Control de Inventario</title>
    <link rel="stylesheet" href="/ControldeInventario/assets/css/style.css">
    <!-- Estilos específicos para asignaciones y elementos -->
    <?php if (isset($_SERVER['REQUEST_URI']) && strpos($_SERVER['REQUEST_URI'], '/asignaciones') !== false): ?>
    <link rel="stylesheet" href="/ControldeInventario/assets/css/form-asignaciones.css">
    <?php endif; ?>
    <?php if (isset($_SERVER['REQUEST_URI']) && strpos($_SERVER['REQUEST_URI'], '/elementos') !== false): ?>
    <link rel="stylesheet" href="/ControldeInventario/assets/css/form-elementos.css">
    <link rel="stylesheet" href="/ControldeInventario/assets/css/form-asignaciones.css">
    <?php endif; ?>
    <!-- Font Awesome para iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    </head>
    <body>
        <header>
            <div class="header-flex">
                <div class="logo-header">
                    <img src="/ControldeInventario/assets/img/logo-colegio.png" alt="Logo Colegio" class="logo-colegio">
                </div>
                <h1>Gestión de Inventario</h1>
                <div class="usuario-header">
                    <?php 
                    if (session_status() === PHP_SESSION_NONE) session_start();
                    $usuario = $_SESSION['usuario'] ?? null;
                    $nombre = $usuario['nombres'] ?? 'Invitado';
                    $foto = $usuario['foto'] ?? '/ControldeInventario/assets/img/avatar-default.png';
                    ?>
                    <img src="<?= htmlspecialchars($foto) ?>" alt="Avatar" class="avatar-usuario">
                    <span class="nombre-usuario"><?= htmlspecialchars($nombre) ?></span>
                    <?php if ($usuario): ?>
                        <a href="/ControldeInventario/logout" class="logout-link" style="margin-left:15px;color:#b30000;font-weight:bold;">Cerrar sesión <i class="fa fa-sign-out-alt"></i></a>
                    <?php endif; ?>
                </div>
            </div>
            <nav class="main-nav">
                <ul>
                    <li><a href="/ControldeInventario/" class="nav-link"><i class="fa fa-home"></i> Inicio</a></li>
                    <li><a href="/ControldeInventario/elementos" class="nav-link"><i class="fa fa-box"></i> Elementos</a></li>
                    <li><a href="/ControldeInventario/espacios" class="nav-link"><i class="fa fa-building"></i> Espacios</a></li>
                    <li><a href="/ControldeInventario/asignaciones" class="nav-link"><i class="fa fa-arrow-right-arrow-left"></i> Asignaciones</a></li>
                    <li><a href="/ControldeInventario/usuarios" class="nav-link"><i class="fa fa-users"></i> Usuarios</a></li>
                    <li><a href="/ControldeInventario/instituciones" class="nav-link"><i class="fa fa-school"></i> Instituciones</a></li>
                </ul>
            </nav>
        </header>
        <main>
            <?php echo $content ?? ''; ?>
        </main>
        <footer>
            <div class="footer-info">
                <span><strong>Institución Educativa Ejemplo</strong></span>
                <span>Calle 123 #45-67, Ciudad, País</span>
                <span>Tel: (601) 123 4567</span>
            </div>
        </footer>
    </body>
</html>