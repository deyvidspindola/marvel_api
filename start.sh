#!/bin/sh

cd api
composer install
php artisan migrate --force