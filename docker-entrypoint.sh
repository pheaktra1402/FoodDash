#!/bin/sh

set -e

echo "Starting FoodDash..."

# Make sure SQLite database exists
touch /var/www/html/database/database.sqlite

# Run database migrations
php artisan migrate --force

# Sync demo products and categories (safe to re-run; uses updateOrCreate)
echo "Syncing demo food products..."
php artisan db:seed --class=DummyDataSeeder --force

# Link public storage for uploaded product images
php artisan storage:link --force 2>/dev/null || ln -sf /var/www/html/storage/app/public /var/www/html/public/storage

# Clear Laravel caches
php artisan config:clear
php artisan cache:clear

echo "FoodDash is ready!"

# Start Apache
exec apache2-foreground