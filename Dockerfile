FROM php:8.2-fpm

# System deps + PHP extensions (Laravel-friendly)
RUN apt-get update && apt-get install -y --no-install-recommends \
    git curl unzip \
    libpng-dev libjpeg62-turbo-dev libfreetype6-dev \
    libzip-dev \
    libicu-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
        gd \
        pdo pdo_mysql \
        zip \
        intl \
        opcache \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Optional: better defaults for PHP
RUN { \
    echo "memory_limit=512M"; \
    echo "upload_max_filesize=32M"; \
    echo "post_max_size=32M"; \
    echo "max_execution_time=120"; \
} > /usr/local/etc/php/conf.d/99-custom.ini

# Opcache (helps performance; safe in dev too)
RUN { \
    echo "opcache.enable=1"; \
    echo "opcache.enable_cli=1"; \
    echo "opcache.memory_consumption=128"; \
    echo "opcache.interned_strings_buffer=16"; \
    echo "opcache.max_accelerated_files=20000"; \
    echo "opcache.validate_timestamps=1"; \
    echo "opcache.revalidate_freq=0"; \
} > /usr/local/etc/php/conf.d/10-opcache.ini

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www