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

# 5. Clean Apache Config (Cloudflare / Proxy Friendly)
RUN a2enmod rewrite headers \
    && sed -i 's|/var/www/html|/var/www/html/public|g' \
       /etc/apache2/sites-available/000-default.conf

# Prepare SSL vhost (disabled by default)
RUN sed -i 's|/var/www/html|/var/www/html/public|g' \
       /etc/apache2/sites-available/default-ssl.conf \
 && sed -i 's|/etc/ssl/certs/ssl-cert-snakeoil.pem|/etc/apache2/ssl/fullchain.pem|g' \
       /etc/apache2/sites-available/default-ssl.conf \
 && sed -i 's|/etc/ssl/private/ssl-cert-snakeoil.key|/etc/apache2/ssl/privkey.pem|g' \
       /etc/apache2/sites-available/default-ssl.conf



# 5. Clean Apache Config (Cloudflare Friendly)
#RUN a2enmod rewrite ssl headers \
#    && a2ensite default-ssl \
#    && sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf \
#    && sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/default-ssl.conf

# 5b. FIX: Point to /etc/apache2/ssl/ instead of hardcoded Let's Encrypt paths
# This allows us to mount whatever certs we have into a standard folder
#RUN sed -i 's|/etc/ssl/certs/ssl-cert-snakeoil.pem|/etc/apache2/ssl/fullchain.pem|g' /etc/apache2/sites-available/default-ssl.conf \
#    && sed -i 's|/etc/ssl/private/ssl-cert-snakeoil.key|/etc/apache2/ssl/privkey.pem|g' /etc/apache2/sites-available/default-ssl.conf

# 6. Get Composer from official image
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 7. Copy manifest files first (for better caching)
COPY composer.json composer.lock package.json package-lock.json ./

# 8. Install dependencies
RUN composer install --no-interaction --prefer-dist --no-scripts
RUN npm install

# 9. Copy the rest of the app
COPY . .

# 10. FINAL FIX: Permission handling
# We move chown to an entrypoint script or do it globally here
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# EXPOSE MODIFIED: Added 443 for HTTPS traffic
EXPOSE 80 443

# SSL related
COPY docker-entrypoint.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

ENTRYPOINT ["docker-entrypoint.sh"]
