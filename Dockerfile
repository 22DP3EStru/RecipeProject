FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    nginx git curl unzip nodejs npm default-mysql-client \
    libpng-dev libjpeg62-turbo-dev libfreetype6-dev libzip-dev libicu-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql zip intl opcache \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY . .

RUN mkdir -p storage/framework/views \
    storage/framework/cache \
    storage/framework/cache/data \
    storage/framework/sessions \
    bootstrap/cache \
    && chown -R www-data:www-data storage bootstrap/cache

RUN composer install --no-dev --optimize-autoloader

RUN npm install && npm run build

RUN rm -f /etc/nginx/sites-enabled/default /etc/nginx/conf.d/default.conf

COPY .docker/nginx/http.conf /etc/nginx/conf.d/default.conf

COPY docker/recipeproject.sql /var/www/recipeproject.sql

RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

EXPOSE 80

CMD ["sh", "-c", "php artisan config:clear && php artisan cache:clear && php artisan view:clear && php artisan migrate --force && php-fpm -D && nginx -g 'daemon off;'"]