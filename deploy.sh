#!/bin/bash
set -e

echo "Starting Full Deployment..."

# 1️⃣ Pull the latest code
echo "Pulling latest changes from Git..."
git pull origin main

# 2️⃣ STOP and REMOVE everything
# This kills orphaned containers and clears the networking cache
echo "Stopping and removing old containers..."
sudo docker compose down -v --remove-orphans

# 3️⃣ FORCE REBUILD (No Cache)
# This ensures your PHP syntax fix and new Dockerfile steps are applied
echo "Building fresh images..."
sudo docker compose build --no-cache

# 4️⃣ Start fresh
echo "Launching containers..."
sudo docker compose up -d --build app db

# 3️⃣ Wait for MySQL to be ready
echo "Waiting for MySQL to be ready..."
until sudo docker compose exec db mysqladmin ping -h "localhost" --silent; do
    echo -n "."; sleep 1
done
echo "MySQL is ready!"

# 4️⃣ Compile frontend assets
echo "Compiling frontend assets..."
sudo docker compose exec app npm run build

# 5️⃣ Run Laravel migrations and seed
echo "Running migrations..."
sudo docker compose exec app php artisan migrate:refresh --force

echo "Seeding database..."
sudo docker compose exec app php artisan db:seed --force

# 6️⃣ Link storage
echo "Linking storage..."
sudo docker compose exec app php artisan storage:link --force

# 7️⃣ Clear and optimize cache
echo "Optimizing Laravel performance..."
sudo docker compose exec app php artisan optimize:clear
sudo docker compose exec app php artisan optimize

echo "Deployment complete! Site is live."
