#!/usr/bin/env bash

echo "Running composer install..."
composer install --no-dev --optimize-autoloader

echo "Caching configs..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "Running migrations..."
php artisan migrate --force

echo "Starting PHP-FPM + Nginx..."
/start.sh