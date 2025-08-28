#!/usr/bin/env bash
set -e

echo "[entrypoint] Syncing app code from image to volume..."
rsync -a --delete \
  --exclude=.env \
  --exclude=.git \
  --exclude=node_modules \
  --exclude=storage \
  /app-src/ /var/www/html/

# ensure permissions
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache || true
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache || true

exec "$@"
