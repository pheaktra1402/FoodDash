#!/bin/sh

set -e

echo "Starting FoodDash..."

# Make sure SQLite database exists
touch /var/www/html/database/database.sqlite

# Run database migrations
php artisan migrate --force

# Seed database only when products table is empty
PRODUCT_COUNT=$(php artisan tinker --execute="echo App\Models\Product::count();")

if [ "$PRODUCT_COUNT" = "0" ]; then
    echo "No products found. Running database seeder..."
    php artisan db:seed --force
else
    echo "Products already exist. Skipping seeder."
fi

# Clear Laravel caches
php artisan config:clear
php artisan cache:clear

echo "FoodDash is ready!"

# Start Apache
exec apache2-foreground