FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    nginx git curl unzip nodejs npm \
    libpng-dev libjpeg62-turbo-dev libfreetype6-dev libzip-dev libicu-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql zip intl opcache \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY . .

RUN composer install --no-dev --optimize-autoloader
RUN npm install && npm run build

RUN mkdir -p storage/framework/views storage/framework/cache storage/framework/sessions bootstrap/cache \
    && chown -R www-data:www-data storage bootstrap/cache

COPY .docker/nginx/http.conf /etc/nginx/conf.d/default.conf

RUN sed -i 's/fastcgi_pass app:9000;/fastcgi_pass 127.0.0.1:9000;/g' /etc/nginx/conf.d/default.conf

EXPOSE 80

CMD php-fpm -D && nginx -g "daemon off;"
