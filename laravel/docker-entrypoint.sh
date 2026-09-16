#!/bin/sh
set -e

# 1. Attendre que PostgreSQL soit prêt à recevoir des connexions
echo "Vérification de la connexion à PostgreSQL ($DB_HOST:$DB_PORT)..."
until php -r "try { new PDO('pgsql:host=' . getenv('DB_HOST') . ';port=' . getenv('DB_PORT') . ';dbname=' . getenv('DB_DATABASE'), getenv('DB_USERNAME'), getenv('DB_PASSWORD')); exit(0); } catch (Exception \$e) { exit(1); }"; do
    echo "PostgreSQL n'est pas encore disponible - attente de 1 seconde..."
    sleep 1
done
echo "PostgreSQL est prêt !"

# 2. Générer la clé d'application si absente du .env
if ! grep -q "^APP_KEY=base64:" .env 2>/dev/null; then
    echo "Génération de APP_KEY..."
    php artisan key:generate --force
fi

# 3. Exécuter automatiquement les migrations de base de données
echo "Exécution des migrations..."
php artisan migrate --force

# 4. Créer le lien symbolique pour les images si absent
if [ ! -L public/storage ]; then
    echo "Création du lien symbolique de stockage..."
    php artisan storage:link
fi

# 5. Passer la main à la commande principale du Dockerfile (php-fpm)
exec "$@"
