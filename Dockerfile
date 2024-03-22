# install composer packages first
FROM composer AS s
WORKDIR /app
COPY . .
RUN composer install --prefer-dist --no-dev --no-scripts && \
    composer dump-autoload

# build client with ../../vendor/livewire/livewire/dist/livewire.esm
FROM node AS c
WORKDIR /app
COPY . .
COPY --from=s /app/vendor /app/
RUN rm -rf node_modules/ && npm i && npm run build && rm -rf node_modules/

FROM php:8.2-apache AS a
WORKDIR /var/www
COPY . .
RUN rm -rf ./vendor/ ./public/build/
COPY --from=s /app/vendor       /var/www/vendor
COPY --from=c /app/public/build /var/www/public/build
RUN curl -sSL https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions -o - | sh -s redis
RUN sed -ri -e 's!/var/www/html!/var/www/public!g' /etc/apache2/sites-available/*.conf && \
    sed -ri -e 's!/var/www/!/var/www/public!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf && \
    rm -rf /var/www/html && \
    mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini" && \
    chown -R www-data:www-data /var/www && \
    chmod +x /var/www/artisan