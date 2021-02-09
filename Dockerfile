FROM php:7.4.14-fpm

WORKDIR "/app"

# Install selected extensions and other stuff
RUN apt-get update \
    && apt-get -y --no-install-recommends install \
    && docker-php-ext-install mysqli pdo pdo_mysql  \
    && apt-get update  \
    && apt-get upgrade -y  \
    && apt-get install -y git zip unzip \
    && apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/* \
    && curl -sS https://getcomposer.org/installer | php \
    && mv composer.phar /usr/local/bin/composer

COPY ./init.sh /tmp/
ENTRYPOINT ["sh","/tmp/init.sh"]

#CMD php artisan serve --host=0.0.0.0 --port=$APP_PORT
