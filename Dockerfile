FROM php:7.4.14-fpm
WORKDIR "/app"

# Install selected extensions and other stuff
RUN apt-get update \
  && apt-get -y --no-install-recommends install  php7.4-mysql php-xdebug libmcrypt-dev \
  && apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

CMD php artisan serve --host=0.0.0.0 --port=8000
EXPOSE 8000