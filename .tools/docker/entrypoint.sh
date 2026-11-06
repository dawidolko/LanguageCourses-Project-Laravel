#!/bin/bash
set -e

echo "🚀 Initialising project LanguageCourses..."

# Copy .env if it does not exist
if [ ! -f "/var/www/html/.env" ]; then
    echo "📋 Copying the .env file..."
    cp /var/www/html/.tools/docker/.env.docker /var/www/html/.env
fi

# Install Composer dependencies.
# Check `autoload.php`, not the directory itself: an interrupted install leaves
# an empty `vendor/` that used to pass this check as "ready", after which
# artisan crashed on the missing autoloader and the container restart-looped.
if [ ! -f "/var/www/html/vendor/autoload.php" ]; then
    echo "📦 Installing PHP dependencies (Composer)..."
    composer install --no-interaction --optimize-autoloader
else
    echo "✅ PHP dependencies already installed"
fi

# Install NPM dependencies and build assets
if [ ! -d "/var/www/html/node_modules/vite" ]; then
    echo "📦 Installing Node.js dependencies..."
    npm install
    echo "🔨 Building assets..."
    npm run build
else
    echo "✅ Node.js dependencies already installed"
fi

# Generate the application key if it does not exist
if ! grep -q "APP_KEY=base64:" /var/www/html/.env; then
    echo "🔑 Generating the application key..."
    php artisan key:generate --no-interaction
else
    echo "✅ Application key already exists"
fi

# Generate course images
echo "🖼️  Generating course images..."
php /var/www/html/.tools/docker/generate-images.php || echo "⚠️  Warning: problem generating images, continuing..."

# Create the storage symlink
echo "🔗 Creating the storage symlink..."
php artisan storage:link --force 2>/dev/null || echo "✅ Storage symlink already exists"

# Wait for MySQL
echo "⏳ Waiting for the database..."
for i in {1..30}; do
    if php artisan db:show 2>/dev/null | grep -q "MySQL"; then
        echo "✅ Database available"
        break
    fi
    echo "   Attempt $i/30 - waiting 2s..."
    sleep 2
done

# Run migrations
echo "🗄️  Running migrations..."
php artisan migrate --force --no-interaction

# Check whether the database already has data
USER_COUNT=$(php artisan tinker --execute="echo \App\Models\User::count();" 2>/dev/null | tail -1 | tr -d '\n\r ' || echo "0")

if [ "$USER_COUNT" = "0" ] || [ -z "$USER_COUNT" ]; then
    echo "📊 Seeding the database with test data..."
    php artisan db:seed --force --no-interaction
else
    echo "✅ Database already has data (users: $USER_COUNT)"
fi

# Set permissions
echo "🔐 Setting permissions..."
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache 2>/dev/null || true
chmod -R 755 /var/www/html/storage
chmod -R 755 /var/www/html/bootstrap/cache

echo "✨ Projekt LanguageCourses ready!"
echo "📍 Application available at: http://localhost:8001"

# Start supervisord
echo "🚀 Starting the server..."
exec /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf
