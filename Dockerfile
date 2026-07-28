FROM dunglas/frankenphp:latest

RUN install-php-extensions \
    pdo_pgsql \
    pgsql \
    intl \
    zip \
    opcache \
    pcntl

WORKDIR /app

COPY . /app

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN composer install --no-dev --optimize-autoloader --no-interaction --no-progress

COPY docker/Caddyfile /etc/caddy/Caddyfile
COPY docker/entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

RUN chown -R www-data:www-data /app/storage /app/bootstrap/cache

ENTRYPOINT ["/entrypoint.sh"]