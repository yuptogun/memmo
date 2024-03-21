# composer 먼저 설치 (../../vendor/livewire/livewire/dist/livewire.esm 파일이 필요)
FROM composer AS s
WORKDIR /app
COPY . .
RUN rm -rf vendor/ && composer install --optimize-autoloader --prefer-dist

# 그 다음 클라이언트 빌드
FROM node AS c
WORKDIR /app
COPY . .
COPY --from=s /app/vendor /app/vendor
RUN rm -rf node_modules/ && npm i && npm run build && rm -rf node_modules/

FROM php:8.2-apache AS a
WORKDIR /var/www
COPY . .
COPY --from=c /app/vendor       /var/www/vendor
COPY --from=c /app/public/build /var/www/public/build
RUN curl -sSL https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions -o - | sh -s redis
RUN sed -ri -e 's!/var/www/html!/var/www/public!g' /etc/apache2/sites-available/*.conf && \
    chown -R www-data:www-data /var/www && \
    chmod +x /var/www/artisan && \
    php artisan config:cache && \
    php artisan event:cache && \
    php artisan route:cache && \
    php artisan view:cache && \
    chown -R www-data:www-data /var/www
EXPOSE 80 443