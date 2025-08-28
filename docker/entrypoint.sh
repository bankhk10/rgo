#!/usr/bin/env bash
set -e
echo "[entrypoint] Syncing app code from image to volume..."

if command -v rsync >/dev/null 2>&1; then
  rsync -a --delete \
    --exclude=.env \
    --exclude=.git \
    --exclude=node_modules \
    --exclude=storage \
    /app-src/ /var/www/html/
else
  echo "[entrypoint] rsync not found, fallback to cp -a"
  cp -a /app-src/. /var/www/html/
  # ลบไฟล์/โฟลเดอร์ที่โดนลบใน image ไม่ได้เหมือน --delete ของ rsync (แต่พอเอาตัวรอดได้)
fi

chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache || true
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache || true

exec "$@"
