#!/bin/bash

# Se tiver muita atualizacao do S.O, migrar isso para uma imagem e importar no docker-compose
apt-get update  && apt-get upgrade && apt-get install iputils-ping -y

php artisan migrate:fresh

php artisan serve --host=0.0.0.0