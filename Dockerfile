FROM php:8.4-apache

# 1. Set working directory
WORKDIR /var/www/html

# 2. Install system dependencies
RUN apt-get update && apt-get install -y \
    git unzip zip curl npm \
    libpng-dev libonig-dev libxml2-dev libzip-dev \
    libicu-dev libbz2-dev libgmp-dev libldap2-dev \
    libpq-dev libxslt1-dev libtidy-dev \
    libsodium-dev libsnmp-dev snmp \
    libfreetype6-dev libjpeg62-turbo-dev \
    pkg-config \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# 3. Configure and Install PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
    bcmath bz2 calendar exif gd gettext gmp intl \
    mysqli opcache pcntl pdo_mysql pdo_pgsql \
    shmop snmp soap sockets sodium tidy xsl zip

# 4. Install Node.js 23.x
RUN curl -fsSL https://deb.nodesource.com/setup_23.x | bash - \
    && apt-get install -y nodejs

# 5. Enable Apache rewrite module and configure DocumentRoot
RUN a2enmod rewrite ssl \
    && a2ensite default-ssl \
    && sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf \
    && sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/default-ssl.conf \
    && sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/apache2.conf

# 5b. NEW: Redirecting Apache to your real Let's Encrypt certificates
# REPLACE 'yourdomain.com' with your actual domain name (e.g., barchuma.com)
RUN sed -i 's|/etc/ssl/certs/ssl-cert-snakeoil.pem|/etc/letsencrypt/live/yourdomain.com/fullchain.pem|g' /etc/apache2/sites-available/default-ssl.conf \
    && sed -i 's|/etc/ssl/private/ssl-cert-snakeoil.key|/etc/letsencrypt/live/yourdomain.com/privkey.pem|g' /etc/apache2/sites-available/default-ssl.conf

# 6. Get Composer from official image
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 7. Copy manifest files first (for better caching)
COPY composer.json composer.lock package.json package-lock.json ./

# 8. Install dependencies
RUN composer install --no-interaction --prefer-dist --no-scripts
RUN npm install

# 9. Copy the rest of the app
COPY . .

# 10. Final optimizations
RUN composer dump-autoload
RUN chown -R www-data:www-data storage bootstrap/cache && chmod -R 775 storage bootstrap/cache

EXPOSE 80
