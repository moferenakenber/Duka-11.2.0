#!/bin/bash
set -e

# YOUR DISCORD URL

WEBHOOK_URL="https://discord.com/api/webhooks/1474657844451086386/N6NZm690JGGN7M4Ve8jdvKfdP4gc0b4Q4VqjTq_MlcKZGBcdZ84IUW5E3Hml0OhGz3Vf"

# 🛑 This function runs ONLY if a command fails
failure_notice() {
    MESSAGE="❌ **Deployment FAILED!** \n**Step:** The last command failed. \n**Check the terminal for details.**"
    curl -H "Content-Type: application/json" -X POST -d "{\"content\": \"$MESSAGE\"}" $WEBHOOK_URL
}

# "Trap" any error and run the failure_notice function
trap 'failure_notice' ERR

echo "🚀 Starting Smart Deployment..."

# 1️⃣ Fetch changes without merging yet
git fetch origin main

# 2️⃣ Check for Docker-related changes
# This compares your local code to the incoming Git changes
DOCKER_CHANGES=$(git diff --name-only HEAD origin/main | grep -E 'docker|Dockerfile|docker-compose|.env' || true)

# 3️⃣ Pull the latest code
git merge origin main

if [ -n "$DOCKER_CHANGES" ]; then
    echo "⚙️ Docker changes detected. Running Deep Build..."
    sudo docker compose down --remove-orphans
    sudo docker compose build
    sudo docker compose up -d

    # Clean up old images to save space
    sudo docker image prune -f
else
    echo "🏃 No Docker changes. Fast-tracking deployment..."
    sudo docker compose up -d --build app
fi

# 4️⃣ Wait for MySQL
echo "Waiting for MySQL..."
until sudo docker compose exec db mysqladmin ping -h "localhost" --silent; do
    echo -n "."; sleep 1
done

# 3️⃣ Wait for MySQL to be ready
echo "Waiting for MySQL to be ready..."
until sudo docker compose exec db mysqladmin ping -h "localhost" --silent; do
    echo -n "."; sleep 1
done
echo "MySQL is ready!"

# 4️⃣ Compile frontend assets
echo "📦 Installing npm dependencies..."
sudo docker compose exec app npm install

# 4️⃣.2 Compile frontend assets
echo "Compiling frontend assets..."
sudo docker compose exec app npm run build

# 5️⃣ Run Laravel migrations and seed
echo "Running migrations..."
# no new one's along as possibe
# sudo docker compose exec app php artisan migrate:fresh --force
sudo docker compose exec app php artisan migrate --force

echo "Seeding database Temporarily paused..."
# echo "Seeding database..."
# sudo docker compose exec app php artisan db:seed --force

# 6️⃣ Link storage
echo "Seeding database Temporarily paused..."
# echo "Linking storage..."
# sudo docker compose exec app php artisan storage:link --force

# 7️⃣ Clear and optimize cache
echo "Optimizing Laravel performance..."
sudo docker compose exec app php artisan optimize:clear
sudo docker compose exec app php artisan optimize

echo "Deployment complete! Site is live."

# Discord Notification
MESSAGE="🚀 **Deployment Successful!** \n**Project:** Your-App-Name \n**Time:** $(date '+%Y-%m-%d %H:%M:%S') \n**Status:** Assets built and Migrations synced."

curl -H "Content-Type: application/json" \
     -X POST \
     -d "{\"content\": \"$MESSAGE\"}" \
     $WEBHOOK_URL

# ✅ Successful Finish Notification
echo "Deployment complete!"

