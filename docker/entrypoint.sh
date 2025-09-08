#!/bin/bash
set -e

echo ">> Syncing source code..."
rsync -a --delete /app-src/ /var/www/html/

echo ">> Setting permissions..."
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

echo ">> Artisan optimize..."
php artisan config:clear || true
php artisan config:cache || true
php artisan route:cache || true
php artisan view:cache || true

echo ">> Running migrations..."
php artisan migrate --force || true

echo ">> Ready, starting php-fpm"
exec "$@"
