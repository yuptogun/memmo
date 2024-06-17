# install composer packages first
FROM php:8.2-apache AS s
WORKDIR /app
RUN curl -sSL https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions -o - | sh -s redis pdo_mysql zip opcache
COPY . .
COPY --from=composer /usr/bin/composer /usr/bin/composer
RUN composer install --prefer-dist --no-dev --no-scripts && \
    composer dump-autoload --no-scripts && \
    mv vendor/ .vendor/

# build client with ../../vendor/livewire/livewire/dist/livewire.esm
FROM node:lts AS c
WORKDIR /app
COPY . .
COPY --from=s /app/.vendor /app/vendor
RUN npm i && npm run build && \
    mv public/ .public/

FROM s AS a
WORKDIR /var/www
RUN sed -ri -e 's!/var/www/html!/var/www/public!g' /etc/apache2/sites-available/*.conf && \
    sed -ri -e 's!/var/www/!/var/www/public!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf && \
    a2enmod rewrite && \
    rm -rf /var/www/html && \
    mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"
COPY .docker/php/conf.d/* /usr/local/etc/php/conf.d/
COPY . .
COPY --from=s /app/.vendor       /var/www/vendor
COPY --from=c /app/.public/build /var/www/public/build
RUN chown -R www-data:www-data /var/www && \
    chmod +x /var/www/artisan