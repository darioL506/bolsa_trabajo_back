#!/bin/sh

apt update

apt-get -y --no-install-recommends install docker-php-ext-install mysqli pdo pdo_mysql
apt-get update
apt-get upgrade -y
apt-get install -y git zip unzip
apt-get clean
rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*
curl -sS https://getcomposer.org/installer | php
mv composer.phar /usr/local/bin/composer

cp .env.example .env
echo "export PATH="$HOME/.config/composer/vendor/bin:$PATH"" >>~/.bashrc

composer update
chmod 777 -R /app
php artisan key:generate

php artisan migrate --seed
php artisan passport:install --force
php artisan serve --host=0.0.0.0 --port=$APP_PORT
