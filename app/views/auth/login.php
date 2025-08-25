<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar sesión</title>
    <?php require_once __DIR__ . '/../../../config/config.php'; ?>
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/style.css">
    <style>
        body {
            background: linear-gradient(120deg, #e0f7fa 0%, #b2f7ef 100%);
            font-family: 'Segoe UI', 'Montserrat', Arial, sans-serif;
            min-height: 100vh;
        }
        .login-container {
            max-width: 410px;
            margin: 60px auto;
            background: #fff;
            padding: 2.5em 2em 2em 2em;
            border-radius: 18px;
            box-shadow: 0 6px 32px #90e0ef55, 0 1.5px 8px #b2f7ef44;
            border: 1.5px solid #90e0ef;
        }
        h2 {
            text-align: center;
            margin-bottom: 1.2em;
            color: #0077b6;
            font-weight: 700;
            letter-spacing: 1px;
        }
        .form-group { margin-bottom: 1.2em; }
        label {
            display: block;
            margin-bottom: 0.5em;
            color: #333;
            font-weight: 500;
        }
        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 0.7em 0.9em;
            border: 1.5px solid #b2f7ef;
            border-radius: 7px;
            font-size: 1.05em;
            background: #f8fafc;
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        input[type="text"]:focus, input[type="password"]:focus {
            border-color: #0077b6;
            outline: none;
            box-shadow: 0 0 0 2px #b2f7ef88;
        }
        .btn {
            width: 100%;
            padding: 0.8em;
            background: linear-gradient(90deg, #00b4d8 0%, #48e5c2 100%);
            color: #fff;
            border: none;
            border-radius: 7px;
            font-size: 1.1em;
            font-weight: 600;
            cursor: pointer;
            box-shadow: 0 2px 8px #b2f7ef33;
            transition: background 0.2s, box-shadow 0.2s;
        }
        .btn:hover, .btn:focus {
            background: linear-gradient(90deg, #0077b6 0%, #00b4d8 100%);
            box-shadow: 0 4px 16px #90e0ef55;
        }
        .error {
            color: #b30000;
            margin-bottom: 1em;
            text-align: center;
            background: #ffeaea;
            border-radius: 6px;
            padding: 0.7em 0.5em;
            border: 1px solid #ffb3b3;
        }
        @media (max-width: 500px) {
            .login-container { padding: 1.2em 0.5em; }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div style="text-align:center; margin-bottom:1.2em;">
            <img src="<?= BASE_URL ?>assets/img/logo-colegio.png" alt="Logo institucional" style="width:68px;height:68px;border-radius:14px;box-shadow:0 2px 8px #b2f7ef44;background:#fff;object-fit:contain;">
        </div>
        <h2>Iniciar sesión</h2>
        <div style="text-align:center; color:#0077b6; font-size:1.08em; margin-bottom:1.1em; font-weight:500;">Bienvenido al sistema de control de inventario. Por favor, ingresa tus credenciales.</div>
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
