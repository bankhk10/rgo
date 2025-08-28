# --- Stage 1: Composer vendor ---
FROM php:8.2-cli-bookworm AS vendor
ENV COMPOSER_ALLOW_SUPERUSER=1
RUN apt-get update && apt-get install -y --no-install-recommends git unzip && rm -rf /var/lib/apt/lists/*
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
WORKDIR /app
COPY composer.json composer.lock ./
RUN composer install --no-dev --prefer-dist --no-progress --no-interaction \
    --no-scripts \
    --ignore-platform-req=ext-gd \
    --ignore-platform-req=ext-zip

# --- Stage 2: PHP-FPM runtime ---
FROM php:8.2-fpm-bookworm

RUN apt-get update && apt-get install -y --no-install-recommends rsync && rm -rf /var/lib/apt/lists/*
# ใช้ mlocati เพื่อติดตั้ง ext เร็ว ๆ
COPY --from=mlocati/php-extension-installer:latest /usr/bin/install-php-extensions /usr/local/bin/
RUN install-php-extensions gd intl zip bcmath pdo_mysql opcache

ENV TZ=Asia/Bangkok
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone
RUN { \
  echo 'opcache.enable=1'; \
  echo 'opcache.enable_cli=0'; \
  echo 'opcache.jit_buffer_size=64M'; \
  echo 'opcache.memory_consumption=192'; \
  echo 'opcache.interned_strings_buffer=16'; \
  echo 'opcache.max_accelerated_files=100000'; \
} > /usr/local/etc/php/conf.d/opcache-prod.ini

# เก็บโค้ดไว้ที่ /app-src (อย่าเขียนทับ /var/www/html ตอน build)
WORKDIR /app-src
COPY . .
COPY --from=vendor /app/vendor ./vendor

# entrypoint จะคัดลอกโค้ดจาก /app-src -> /var/www/html (ซึ่งเป็น named volume)
COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

# โฟลเดอร์จริงที่รันแอป (เป็น volume ตอน runtime)
WORKDIR /var/www/html

EXPOSE 9000
ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
CMD ["php-fpm","-F"]
