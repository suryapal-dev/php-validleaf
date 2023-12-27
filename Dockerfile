FROM php:8.2-cli-alpine

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /app

COPY . ./

RUN composer install --no-interaction --optimize-autoloader
