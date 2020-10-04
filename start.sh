#!/bin/sh

docker-compose up -d

cd api
composer install

cd ..
docker exec -i marvel_mysql sh -c 'exec mysql -uroot -pmarvel' < ./config/mysql/scripts.sql

cp ./config/app.env ./api/.env

cd api
php artisan migrate --force