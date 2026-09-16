FROM php:8.4-fpm

RUN apt-get update && apt-get install -y \
    libpq-dev zip unzip git \
    && docker-php-ext-install pdo pdo_pgsql

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# 1. Copie uniquement les fichiers de configuration des dépendances
COPY composer.json composer.lock ./

# 2. Installation des paquets
RUN composer install --no-dev --no-scripts --no-autoloader

# 3. Copie du reste du code source de l'application
COPY . .

# 4. Finalisation de l'autoloader
RUN composer dump-autoload --optimize

COPY docker-entrypoint.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

EXPOSE 9000
ENTRYPOINT ["docker-entrypoint.sh"]
CMD ["php-fpm"]
