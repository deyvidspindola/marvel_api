#!/bin/sh

#cd /var/www
#composer install --no-interaction --no-dev --prefer-dist
#
php-fpm
#service nginx start
#
#chmod 777 -R /var/run/php/php7.1-fpm.sock
chown www-data -R .
#
#php artisan migrate --force
#
chown -R www-data:www-data /var/www/storage