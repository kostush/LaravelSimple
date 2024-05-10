#!/usr/bin/env bash
set -e

#cp laravel/.env.example laravel.env

echo "all params $@"
echo "applying db migrations"
sleep 20
php /var/www/artisan migrate --env=local
echo "starting php-fpm"
exec $@