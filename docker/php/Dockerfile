FROM php:8.4-fpm-alpine

# Установка зависимостей
RUN apk add --no-cache \
    git \
    curl \
    libpng-dev \
    libwebp-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    zip \
    unzip \
    nodejs \
    npm

# Установка PHP расширений
RUN docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-install pdo_mysql mbstring exif gd zip

# Установка Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Установка нужных пакетов (без supervisord)
RUN apk add --no-cache supervisor bash

WORKDIR /var/www/html
USER www-data

# Простой запуск FPM (для разработки)

CMD ["php-fpm"]

