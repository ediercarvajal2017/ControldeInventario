<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar sesión</title>
    <?php require_once __DIR__ . '/../../../config/config.php'; ?>
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/style.css">
    <style>
        body { background: #f4f4f4; font-family: Arial, sans-serif; }
        .login-container { max-width: 400px; margin: 60px auto; background: #fff; padding: 2em; border-radius: 8px; box-shadow: 0 2px 8px #ccc; }
        h2 { text-align: center; margin-bottom: 1em; }
        .form-group { margin-bottom: 1em; }
        label { display: block; margin-bottom: 0.5em; }
        input[type="text"], input[type="password"] { width: 100%; padding: 0.5em; border: 1px solid #ccc; border-radius: 4px; }
        .btn { width: 100%; padding: 0.7em; background: #007bff; color: #fff; border: none; border-radius: 4px; font-size: 1em; cursor: pointer; }
        .btn:hover { background: #0056b3; }
        .error { color: #b30000; margin-bottom: 1em; text-align: center; }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Iniciar sesión</h2>
        <?php if (!empty($error)): ?>
            <div class="error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
    <form method="post" action="<?= BASE_URL ?>login">
            <div class="form-group">
                <label for="username">Usuario</label>
                <input type="text" id="username" name="username" required autofocus>
            </div>
            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="btn">Entrar</button>
        </form>
    </div>
</body>
</html>
