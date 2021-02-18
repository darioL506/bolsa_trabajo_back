FROM php:7.4.14-fpm

WORKDIR "/app"

# Install selected extensions and other stuff
COPY . /app
COPY ./init.sh /tmp/
ENTRYPOINT ["sh","/tmp/init.sh"]

#CMD php artisan serve --host=0.0.0.0 --port=$APP_PORT
