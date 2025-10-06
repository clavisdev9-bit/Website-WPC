#!/bin/bash
set -e
set -x

cd /var/www/html

# Install dependency Laravel
if [ ! -d vendor ]; then
  echo "Menjalankan composer install..."
  composer install --optimize-autoloader
fi

# Copy .env kalau belum ada
if [ ! -f .env ]; then
  cp .env.example .env
fi

# Generate APP_KEY jika belum ada
if ! grep -q "^APP_KEY=" .env || [ -z "$(grep '^APP_KEY=' .env | cut -d '=' -f2)" ]; then
  php artisan key:generate
fi

# Tunggu PostgreSQL siap sebelum migrate
echo "Menunggu database PostgreSQL siap..."
until php -r "new PDO('pgsql:host=${DB_HOST};port=${DB_PORT};dbname=${DB_DATABASE}', '${DB_USERNAME}', '${DB_PASSWORD}');" 2>/dev/null; do
  echo "Database belum siap - retry dalam 2 detik..."
  sleep 2
done

# Jalankan migrate (jangan hentikan container kalau gagal)
php artisan migrate --force || true

# Bersihkan cache (bagus untuk dev)
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear

# Atur permission storage & cache
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Jalankan Apache
exec apache2-foreground
