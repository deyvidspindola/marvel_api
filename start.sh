#!/bin/sh

docker-compose up -d

cd api
composer install

cd ..
sleep 2
docker exec -i marvel_mysql sh -c 'exec mysql -uadmin_user -pmarvel' < ./config/mysql/scripts.sql
sleep 2
docker exec -i marvel_app sh -c 'php artisan migrate --force'

echo FINISH
