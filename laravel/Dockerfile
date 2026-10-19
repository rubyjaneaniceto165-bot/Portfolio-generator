
FROM php:8.4-cli

RUN apt-get update && apt-get install -y \
    git unzip libzip-dev libicu-dev \
    && docker-php-ext-install pdo pdo_mysql zip intl \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY laravel/ .

RUN composer install --no-dev --optimize-autoloader --no-interaction

CMD php artisan serve --host=0.0.0.0 --port=${PORT:-8080} --no-reload