#!/bin/bash
set -e

echo "🔧 Fixing Laravel permissions..."

# Ensure required directories exist
mkdir -p /var/www/html/storage \
         /var/www/html/bootstrap/cache

# Fix ownership & permissions (AFTER volumes are mounted)
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

echo "✅ Permissions OK"

# Enable SSL only if in production AND certs exist
if [ "$APP_ENV" = "production" ] \
   && [ -f /etc/apache2/ssl/fullchain.pem ] \
   && [ -f /etc/apache2/ssl/privkey.pem ]; then
    echo "🔒 Enabling Apache SSL"
    a2enmod ssl
    a2ensite default-ssl
else
    echo "🌐 Running HTTP only"
fi

exec apache2-foreground
