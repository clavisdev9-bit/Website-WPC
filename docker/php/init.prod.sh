#!/bin/bash
set -e
set -x

cd /var/www/html

# Install dependency Laravel (biasanya sudah terinstall saat build image)
if [ ! -d vendor ]; then
  echo "Menjalankan composer install..."
  composer install --optimize-autoloader --no-dev
fi

# Copy .env kalau belum ada
if [ ! -f .env ]; then
  cp .env.example .env
fi

# Update .env dengan environment variables (agar fleksibel)
sed -i "s/^DB_CONNECTION=.*/DB_CONNECTION=${DB_CONNECTION}/" .env
sed -i "s/^DB_HOST=.*/DB_HOST=${DB_HOST}/" .env
sed -i "s/^DB_PORT=.*/DB_PORT=${DB_PORT}/" .env
sed -i "s/^DB_DATABASE=.*/DB_DATABASE=${DB_DATABASE}/" .env
sed -i "s/^DB_USERNAME=.*/DB_USERNAME=${DB_USERNAME}/" .env
sed -i "s/^DB_PASSWORD=.*/DB_PASSWORD=${DB_PASSWORD}/" .env

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

# Jalankan migrate (jika gagal → hentikan container biar tidak jalan setengah-setengah)
php artisan migrate --force

# Cache config untuk performa
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Atur permission storage & cache
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Jalankan Apache
exec apache2-foreground
