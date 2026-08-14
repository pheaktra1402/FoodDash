#!/bin/sh
set -e

cd /var/www/html

# Use Render environment variables when .env is not mounted
if [ ! -f .env ]; then
    cp .env.example .env
fi

# Generate APP_KEY at runtime when not provided in Render env vars
if [ -z "$APP_KEY" ]; then
    php artisan key:generate --force --no-interaction
fi

php artisan storage:link --force --no-interaction 2>/dev/null || true
php artisan migrate --force --no-interaction
php artisan db:seed --force --no-interaction || true
php artisan config:cache --no-interaction
php artisan route:cache --no-interaction
php artisan view:cache --no-interaction

exec apache2-foreground
