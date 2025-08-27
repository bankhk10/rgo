# --- Stage 1: Composer vendor ---
FROM composer:2 AS vendor
WORKDIR /app
COPY composer.json composer.lock ./
RUN composer install --no-dev --prefer-dist --no-progress --no-interaction

# --- Stage 2: PHP-FPM runtime ---
FROM php:8.2-fpm-alpine

RUN apk add --no-cache \
      icu-dev libzip-dev libpng-dev freetype-dev libjpeg-turbo-dev oniguruma-dev \
      git curl bash tzdata \
  && docker-php-ext-configure gd --with-freetype --with-jpeg \
  && docker-php-ext-install -j$(nproc) gd pdo_mysql zip bcmath intl opcache

ENV TZ=Asia/Bangkok
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

WORKDIR /var/www/html

# คัดลอกโค้ด + vendor
COPY . .
COPY --from=vendor /app/vendor ./vendor

# สิทธิ์ที่ Laravel ต้องใช้
RUN chown -R www-data:www-data storage bootstrap/cache \
 && chmod -R 775 storage bootstrap/cache

EXPOSE 9000
CMD ["php-fpm", "-F"]
