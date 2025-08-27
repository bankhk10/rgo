#!/usr/bin/env bash
set -e

# ถ้ายังไม่มี artisan แปลว่ายังไม่เคย copy โค้ดลง volume
if [ ! -f /var/www/html/artisan ]; then
  echo "[entrypoint] First run: copying app code to volume..."
  cp -R /app-src/. /var/www/html/
  chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache || true
  chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache || true
else
  echo "[entrypoint] Volume already initialized. Skipping code copy."
fi

exec "$@"
