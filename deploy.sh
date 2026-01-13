#!/bin/bash
set -e

echo "🚀 Starting Full Deployment..."

# 1. Pull the latest code
echo "📥 Pulling latest changes from Git..."
git pull origin main

# 2. Build and Restart Containers
# This also handles the Composer/NPM install defined in your Dockerfile
echo "🏗️ Rebuilding containers..."
# sudo docker compose up -d --build

sudo docker compose pull       # optional, update image
sudo docker compose up -d app
sudo docker compose exec app npm run build


# 2.1. NPM Build (Compiling Assets)
echo "🎨 Compiling frontend assets..."
sudo docker compose exec app npm run build

# 3. FIX PERMISSIONS (The most important step for 500 errors) -> moved this to docker-entrypoint
# echo "🔑 Fixing file permissions..."
# sudo docker compose exec app chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
# sudo docker compose exec app chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# 4. WAIT FOR MYSQL TO BE READY
echo "⏳ Waiting for MySQL to be ready..."
until sudo docker compose exec db mysqladmin ping -h "localhost" --silent; do
    echo -n "."; sleep 1
done
echo "✅ MySQL is ready!"

# 5. Run Migrations & Seed (production safe!)
echo "🔄 Running migrations..."
sudo docker compose exec app php artisan migrate:fresh --force
# If you really need seed data, run this:
sudo docker compose exec app php artisan db:seed --force

# 6. Link Storage (Ensure images work)
echo "🔗 Linking storage..."
sudo docker compose exec app php artisan storage:link --force

# 7. Clear and Re-optimize Cache
echo "🧹 Optimizing Laravel performance..."
sudo docker compose exec app php artisan optimize:clear
sudo docker compose exec app php artisan optimize

echo "🚀 Deployment complete! Site is live at https://www.mezgebedirijit.com"

