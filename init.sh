#!/bin/sh
cp .env.example .env
echo "export PATH="$HOME/.config/composer/vendor/bin:$PATH"" >> ~/.bashrc
composer install --prefer-dist
composer update
php artisan key:generate

php artisan migrate --seed
php artisan passport:install --force
php artisan serve --host=0.0.0.0 --port=$APP_PORT
