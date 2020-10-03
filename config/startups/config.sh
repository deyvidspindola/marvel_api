#!/bin/sh

php-fpm
chown www-data -R .
chown -R www-data:www-data /var/www/storage