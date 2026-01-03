FROM php:8.4-fpm-alpine

RUN apk add --no-cache libzip-dev \
    && docker-php-ext-install pdo pdo_mysql zip

RUN apk add --no-cache bash

# Устанавливаем Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Копируем конфигурационные файлы (если нужно)
COPY ./docker/php/php.ini /usr/local/etc/php/conf.d/php.ini

# 1. Создаем пользователя
RUN addgroup -g 1000 appuser && \
    adduser -u 1000 -G appuser -D -h /home/appuser appuser

# 2. Создаем ВСЕ необходимые директории ОДНОЙ командой
RUN mkdir -p /var/www/storage/framework/sessions \
    /var/www/storage/framework/views \
    /var/www/storage/framework/cache/data \
    /var/www/storage/framework/testing \
    /var/www/storage/logs \
    /var/www/storage/app/public \
    /var/www/bootstrap/cache \
    && chmod -R 755 /var/www/storage \
    && chmod -R 775 /var/www/storage/framework/sessions \
    /var/www/storage/framework/cache \
    /var/www/storage/framework/views \
    && chmod -R 775 /var/www/bootstrap/cache \
    && chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# 3. Меняем владельца ВСЕХ директорий
RUN chown -R appuser:appuser /var/www

# 5. Копируем код с правильным владельцем
COPY --chown=appuser:appuser . /var/www

COPY ./docker/.bashrc /home/appuser/.bashrc
RUN chmod 644 /home/appuser/.bashrc

USER appuser
WORKDIR /var/www
CMD ["php-fpm"]