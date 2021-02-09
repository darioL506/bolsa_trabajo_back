#!/bin/sh
echo "------copiando .env------"
cp .env.example .env
echo "------Generando clave------"
php artisan key:generate
echo "------Generando BD y contenido------"
php artisan migrate --seed
echo "------Generando claves passport------"
php artisan passport:install --force
echo "------Iniciando servidor Laravel------"
php artisan serve --host=0.0.0.0 --port=$APP_PORT
echo "------Fin de Script------"
