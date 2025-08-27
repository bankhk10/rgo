# --- Stage 1: Composer vendor (ใช้ PHP 8.2 CLI) ---
FROM php:8.2-cli-alpine AS vendor

# ติดตั้งเครื่องมือที่ composer ต้องใช้
RUN apk add --no-cache git zip unzip

# เอา composer จากอิมเมจทางการ
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app
COPY composer.json composer.lock ./

# ตรงนี้ข้ามเช็ก ext-gd เพราะ runtime stage จะมี gd อยู่แล้ว
RUN composer install --no-dev --prefer-dist --no-progress --no-interaction \
    --ignore-platform-req=ext-gd

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

# คัดลอกซอร์ส + vendor ที่ build จาก stage แรก
COPY . .
COPY --from=vendor /app/vendor ./vendor

# Permission ที่ Laravel ต้องใช้
RUN chown -R www-data:www-data storage bootstrap/cache \
 && chmod -R 775 storage bootstrap/cache

EXPOSE 9000
CMD ["php-fpm", "-F"]
