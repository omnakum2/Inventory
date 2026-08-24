#!/usr/bin/env bash
set -e

cd /var/www/html

# 0. APP_KEY fallback (set APP_KEY in Render env for stable sessions).
if [ -z "${APP_KEY}" ]; then
  export APP_KEY="$(php artisan key:generate --show)"
  echo "[entrypoint] Generated ephemeral APP_KEY. Set APP_KEY env var in Render for stable sessions."
fi

# 1. Ensure storage tree + sqlite database file exist.
mkdir -p storage/framework/cache/data \
         storage/framework/sessions \
         storage/framework/views \
         storage/logs \
         storage/app/public \
         database
DB_FILE="${DB_DATABASE:-/var/www/html/database/database.sqlite}"
[ -f "$DB_FILE" ] || touch "$DB_FILE"

# 2. Permissions.
chown -R www-data:www-data storage bootstrap/cache database || true
chmod -R 775 storage bootstrap/cache || true

# 3. Clear stale caches (do NOT config:cache — keeps env() working in the seeder).
php artisan optimize:clear || true

# 4. Migrate + seed (idempotent).
php artisan migrate --force
php artisan db:seed --force

# 5. Apache must listen on Render's dynamic $PORT.
: "${PORT:=80}"
sed -ri "s/^Listen 80/Listen ${PORT}/" /etc/apache2/ports.conf
sed -ri "s/:80>/:${PORT}>/" /etc/apache2/sites-available/000-default.conf

exec apache2-foreground
