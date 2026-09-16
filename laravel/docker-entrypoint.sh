#!/bin/sh
set -e

# S'assurer que les dossiers de stockage existent et sont inscriptibles
mkdir -p storage/framework/views storage/framework/cache/data storage/framework/sessions storage/app/public
chmod -R 777 storage bootstrap/cache

# 1. Attendre que PostgreSQL soit prêt
echo "Vérification de la connexion à PostgreSQL ($DB_HOST:$DB_PORT)..."
until php -r "try { new PDO('pgsql:host=' . getenv('DB_HOST') . ';port=' . getenv('DB_PORT') . ';dbname=' . getenv('DB_DATABASE'), getenv('DB_USERNAME'), getenv('DB_PASSWORD')); exit(0); } catch (Exception \$e) { exit(1); }"; do
    echo "PostgreSQL indisponible, attente de 1 seconde..."
    sleep 1
done
echo "PostgreSQL est disponible !"

# 2. Générer la clé d'application
if ! grep -q "^APP_KEY=base64:" .env 2>/dev/null; then
    echo "Génération de APP_KEY..."
    php artisan key:generate --force
fi

# 3. Exécuter les migrations
echo "Exécution des migrations..."
php artisan migrate --force

# 4. Créer le lien symbolique
if [ ! -L public/storage ]; then
    echo "Création du lien symbolique de stockage..."
    php artisan storage:link
fi

exec "$@"
