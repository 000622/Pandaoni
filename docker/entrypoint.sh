#!/bin/sh
set -e

php artisan config:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache

php artisan migrate --force

exec frankenphp run --config /etc/caddy/Caddyfile --adapter caddyfile
