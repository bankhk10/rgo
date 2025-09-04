# --- Stage 1: Composer vendor build ---
FROM php:8.2-cli-bookworm AS vendor
ENV COMPOSER_ALLOW_SUPERUSER=1

RUN apt-get update && apt-get install -y --no-install-recommends \
    git unzip rsync && \
    rm -rf /var/lib/apt/lists/*

# ติดตั้ง composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app
COPY composer.json composer.lock ./

RUN composer install --no-dev --prefer-dist --no-progress --no-interaction \
    --no-scripts \
    --ignore-platform-req=ext-gd \
    --ignore-platform-req=ext-zip

# --- Stage 2: PHP-FPM runtime ---
FROM php:8.2-fpm-bookworm

# Install extensions
COPY --from=mlocati/php-extension-installer:latest /usr/bin/install-php-extensions /usr/local/bin/
RUN install-php-extensions gd intl zip bcmath pdo_mysql opcache

# Timezone
ENV TZ=Asia/Bangkok
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

# PHP Opcache config
RUN { \
  echo 'opcache.enable=1'; \
  echo 'opcache.enable_cli=0'; \
  echo 'opcache.jit_buffer_size=64M'; \
  echo 'opcache.memory_consumption=192'; \
  echo 'opcache.interned_strings_buffer=16'; \
  echo 'opcache.max_accelerated_files=100000'; \
} > /usr/local/etc/php/conf.d/opcache.ini

# โค้ด Laravel จะอยู่ใน /app-src (ต้นฉบับ)
WORKDIR /app-src
COPY . .
COPY --from=vendor /app/vendor ./vendor

# Entrypoint
COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

WORKDIR /var/www/html
EXPOSE 9000
ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
CMD ["php-fpm", "-F"]
