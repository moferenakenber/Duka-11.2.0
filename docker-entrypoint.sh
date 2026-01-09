#!/bin/bash
set -e

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
