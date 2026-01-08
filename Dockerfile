FROM php:8.2-apache

# Install useful packages and PHP extensions (adjust if you need more)
RUN apt-get update \
    && apt-get install -y --no-install-recommends \
        libzip-dev \
        unzip \
    && docker-php-ext-install zip \
    && a2enmod rewrite \
    && sed -ri 's/AllowOverride None/AllowOverride All/g' /etc/apache2/apache2.conf \
    && rm -rf /var/lib/apt/lists/*

# Copy application files
COPY . /var/www/html/

# Copy custom PHP configuration
COPY docker/php.ini /usr/local/etc/php/conf.d/docker-php.ini

# Fix permissions
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80

CMD ["apache2-foreground"]
