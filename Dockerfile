FROM php:8.4-fpm-alpine

RUN apk add --no-cache libzip-dev \
    && docker-php-ext-install pdo pdo_mysql zip

RUN apk add --no-cache bash libzip-dev

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
    /var/www/storage/app/backups \
    /var/www/bootstrap/cache \
    /etc/supervisor/conf.d \
    /var/log/supervisor \
    /var/run/supervisor

# 3. Меняем владельца ВСЕХ директорий
RUN chown -R appuser:appuser /var/www

# 5. Копируем код с правильным владельцем
COPY --chown=appuser:appuser . /var/www

# 4. Ставим права (775 для директорий, 777 для cache/sessions)
RUN chmod -R 775 /var/www/storage /var/www/bootstrap/cache \
    && chmod -R 777 /var/www/storage/framework/cache/data \
    /var/www/storage/framework/sessions

COPY ./docker/.bashrc /home/appuser/.bashrc
RUN chmod 644 /home/appuser/.bashrc

USER appuser
WORKDIR /var/www
CMD ["php-fpm"]