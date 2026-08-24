# Render build-recipe for Laravel 10 (PHP 8.2 + Apache, SQLite).
# You never run Docker locally — Render builds this on every commit.
FROM php:8.2-apache

# ---- System deps + PHP extensions ----
RUN apt-get update && apt-get install -y --no-install-recommends \
        libzip-dev libpng-dev libonig-dev libjpeg-dev libfreetype6-dev \
        libsqlite3-dev unzip git \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_sqlite mbstring zip gd bcmath \
    && a2enmod rewrite \
    && rm -rf /var/lib/apt/lists/*

# ---- Composer ----
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Install PHP deps first for better layer caching
COPY composer.json composer.lock ./
RUN composer install --no-dev --no-scripts --no-autoloader --no-interaction --prefer-dist

# App source
COPY . .
RUN composer dump-autoload --optimize --no-dev

# ---- Apache: docroot -> public, allow .htaccess overrides ----
RUN sed -ri 's!DocumentRoot /var/www/html!DocumentRoot /var/www/html/public!g' /etc/apache2/sites-available/000-default.conf \
    && printf '<Directory /var/www/html/public>\n    AllowOverride All\n    Require all granted\n</Directory>\n' > /etc/apache2/conf-available/laravel.conf \
    && a2enconf laravel

# ---- Writable dirs ----
RUN chown -R www-data:www-data storage bootstrap/cache database 2>/dev/null || true \
    && chmod -R 775 storage bootstrap/cache 2>/dev/null || true

COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
