FROM php:7.4.14-fpm

WORKDIR "/app"

# Install selected extensions and other stuff
RUN apt-get update \
    && apt-get -y --no-install-recommends install \
    && docker-php-ext-install mysqli pdo pdo_mysql \
    && apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

COPY ./init.sh /tmp/
ENTRYPOINT ["sh","/tmp/init.sh"]

#CMD php artisan serve --host=0.0.0.0 --port=$APP_PORT
