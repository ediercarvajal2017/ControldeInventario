# Checklist para despliegue a producción

## 1. Seguridad y configuración
- [x] Revisa que `config.php` y otros archivos sensibles no sean accesibles desde la web.
- [ ] Usa variables de entorno para contraseñas y datos sensibles (considera implementar `.env`).
- [ ] Asegúrate de que `display_errors` esté desactivado y `log_errors` activado en producción.
- [ ] Verifica que el archivo `.htaccess` en `public/` bloquee el acceso a carpetas sensibles y evite la ejecución de scripts en `uploads/`.

## 2. Dependencias y código
- [ ] Ejecuta `composer install --no-dev --optimize-autoloader` en el servidor de producción.
- [ ] Elimina archivos de test y carpetas de pruebas si no son necesarios en producción (`tests/`).
- [ ] No subas la carpeta `vendor` si vas a instalar dependencias en el servidor.

## 3. Archivos y permisos
- [ ] Asigna permisos mínimos a `uploads/` (solo escritura para el servidor web).
- [ ] No dejes archivos de ejemplo, backups o temporales en el servidor.

## 4. Base de datos
- [ ] Usa un usuario de base de datos con permisos mínimos.
- [ ] Realiza un respaldo antes de migrar.

## 5. Optimización y recursos
- [ ] Habilita OPcache en el servidor.
- [ ] Minimiza y comprime CSS/JS en `public/assets/`.
- [ ] Elimina imágenes o archivos no utilizados en `uploads/`.

## 6. Pruebas y documentación
- [ ] Ejecuta todos los tests (`tests/models/`) y asegúrate de que pasen.
- [ ] Actualiza el `README.md` con instrucciones de despliegue y configuración.

## Recomendaciones para aplicarle a una pagina
- Implementar slugs en las URLs para mejorar la SEO y la usabilidad.
- Asegurarse de que todas las páginas tengan títulos y descripciones únicas.
- Utilizar etiquetas HTML semánticas para mejorar la accesibilidad y el SEO.
No incluyas extensiones de archivo (.php, .html) en la URL

