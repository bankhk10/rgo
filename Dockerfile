# --- Stage 1: Composer vendor (ใช้ PHP 8.2 CLI) ---
FROM php:8.2-cli-alpine AS vendor
ENV COMPOSER_ALLOW_SUPERUSER=1

RUN apk add --no-cache git zip unzip
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app
COPY composer.json composer.lock ./

# ข้ามเช็ก ext ที่ยังไม่มีใน vendor stage (runtime stage ติดตั้งจริงแล้ว)
RUN composer install --no-dev --prefer-dist --no-progress --no-interaction \
    --ignore-platform-req=ext-gd \
    --ignore-platform-req=ext-zip

# --- Stage 2: PHP-FPM runtime (8.2) ---
FROM php:8.2-fpm-alpine

RUN apk add --no-cache \
      icu-dev libzip-dev libpng-dev freetype-dev libjpeg-turbo-dev oniguruma-dev \
      git curl bash tzdata \
  && docker-php-ext-configure gd --with-freetype --with-jpeg \
  && docker-php-ext-install -j$(nproc) gd pdo_mysql zip bcmath intl opcache

ENV TZ=Asia/Bangkok
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

WORKDIR /var/www/html
COPY . .
COPY --from=vendor /app/vendor ./vendor

RUN chown -R www-data:www-data storage bootstrap/cache \
 && chmod -R 775 storage bootstrap/cache

EXPOSE 9000
CMD ["php-fpm", "-F"]
