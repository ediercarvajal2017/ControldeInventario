<?php
// Archivo temporal para generar un hash seguro de contraseña
// Accede a http://localhost/ControldeInventario/public/hash.php

$password = 'Inventario2025';
echo 'Hash para la contraseña "Inventario2025":<br><textarea rows="2" cols="80">' . password_hash($password, PASSWORD_DEFAULT) . '</textarea>';
