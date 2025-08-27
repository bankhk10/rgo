# Base Image (เลือกเวอร์ชัน PHP ที่โปรเจกต์คุณใช้)
FROM php:8.2-fpm-alpine

# ตั้งค่า Working Directory ภายใน Container
WORKDIR /var/www/html

# ติดตั้ง Dependencies ที่จำเป็นสำหรับ Laravel
RUN apk update && apk add --no-cache \
    nginx \
    supervisor \
    nodejs \
    npm \
    libzip-dev \
    zip \
    unzip \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    libxml2-dev \
    icu-dev \
    curl \
    git \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install pdo pdo_mysql zip bcmath intl opcache

# ติดตั้ง Composer (PHP Dependency Manager)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# คัดลอกไฟล์ Composer และติดตั้ง Dependencies
COPY composer.json composer.lock ./
RUN composer install --no-dev --no-interaction --no-plugins --no-scripts --prefer-dist

# คัดลอกไฟล์โปรเจกต์ทั้งหมด
COPY . .

# ตั้งค่า Permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# สร้างไฟล์ Config สำหรับ Nginx (ตัวอย่าง)
# COPY .docker/nginx/default.conf /etc/nginx/conf.d/default.conf
COPY .docker/nginx/default.conf /etc/nginx/http.d/default.conf
# สร้างไฟล์ Config สำหรับ Supervisor (ตัวอย่าง)
COPY .docker/supervisor/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Expose port
EXPOSE 80

# คำสั่งที่จะรันเมื่อ Container เริ่มทำงาน
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
