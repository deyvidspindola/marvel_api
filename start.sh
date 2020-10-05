#!/bin/sh

docker-compose up -d

cd api
composer install

cd ..
echo 'Aguardando resposta do container do mysql'
sleep 10
docker exec -i marvel_mysql sh -c 'exec mysql -uadmin_user -pmarvel' < ./config/mysql/scripts.sql
sleep 10
echo 'Criando o banco de dados da aplicacao'
docker exec -i marvel_app sh -c 'php artisan migrate --force'
sleep 5
docker exec -i marvel_app sh -c 'php artisan db:seed --force'

echo FINISH
