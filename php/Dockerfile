FROM php:8.1-fpm

# Install PHP extensions.
RUN docker-php-ext-install pdo_mysql

# Копируем базовый конфигурационный файл сборки.
RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"