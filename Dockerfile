FROM php:7.4.14-fpm

WORKDIR "/app"

# Install selected extensions and other stuff
RUN apt-get update \
    && apt-get -y --no-install-recommends install zip unzip docker-php-ext-install mysqli pdo pdo_mysql php-cli \
    && apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/* \
    && curl -sS https://getcomposer.org/installer -o composer-setup.php \
    && HASH=`curl -sS https://composer.github.io/installer.sig` \
    && php composer-setup.php --install-dir=/usr/local/bin --filename=composer
#COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY ./init.sh /tmp/
ENTRYPOINT ["sh","/tmp/init.sh"]

#CMD php artisan serve --host=0.0.0.0 --port=$APP_PORT
