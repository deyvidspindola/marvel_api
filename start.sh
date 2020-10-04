#!/bin/sh

docker-compose up -d
cd api
chmod -R 777 storage
composer install
php artisan migrate --force