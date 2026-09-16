# Application Blog Laravel (Docker & PostgreSQL)

Ce dossier contient le code source de l'application de blog développée avec Laravel, conteneurisée à l'aide de Docker et orchestrée via Docker Compose.

---

## Fonctionnalités Principales

- **Gestion des Articles (CRUD)** : Création, consultation et suppression d'articles de blog.
- **Galerie d'Images** : Prise en charge du téléversement d'images multiples (limité à 4 images par article).
- **Moteur de Recherche Avancé** : Recherche textuelle rapide basée sur les fonctions natives PostgreSQL (`to_tsvector` et `to_tsquery`) couvrant le titre, l'auteur et le contenu.
- **Notification des Abonnés** : Envoi ciblé d'e-mails aux abonnés actifs (`is_active = true`) lors de la publication d'un article.
- **Environnement de Test SMTP** : Capture et inspection des e-mails envoyés en développement via le service Mailpit.

---

## Architecture Technique

- **Framework PHP** : Laravel 10.x (PHP 8.4 FPM)
- **Base de Données** : PostgreSQL 15 (Alpine)
- **Serveur de Mail Dev** : Mailpit
- **Conteneurisation** : Docker & Docker Compose

---

## Prérequis

- Docker Engine (version 20.10 ou supérieure)
- Docker Compose (version 2.0 ou supérieure)

---

## Installation et Démarrage Rapide

### 1. Configuration de l'environnement

S'assurer que le fichier `.env` est présent à la racine du dossier `laravel/`. Si ce n'est pas le cas, copier le fichier d'exemple :

```bash
cp .env.example .env
```

Vérifier la configuration des accès aux services conteneurisés dans le fichier `.env` :

```ini
DB_CONNECTION=pgsql
DB_HOST=db
DB_PORT=5432
DB_DATABASE=blog_db
DB_USERNAME=postgres_user
DB_PASSWORD=secretpassword

MAIL_MAILER=smtp
MAIL_HOST=mailpit
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="newsletter@blog.test"
MAIL_FROM_NAME="${APP_NAME}"
```

### 2. Démarrage des services Docker

Lancer la construction et l'exécution des conteneurs en arrière-plan :

```bash
docker compose up -d --build
```

Le script d'entrée (`docker-entrypoint.sh`) s'exécute automatiquement au démarrage pour :
1. Attendre la disponibilité du serveur PostgreSQL.
2. Générer la clé d'application (`APP_KEY`) si elle est absente.
3. Exécuter les migrations de base de données.

### 3. Création du lien symbolique de stockage

Pour rendre les images téléversées accessibles publiquement sur le Web :

```bash
docker compose exec app php artisan storage:link
```

---

## Services et Ports

| Service | Adresse URL / Port | Description |
| :--- | :--- | :--- |
| **Application Laravel** | `http://localhost:8000` | Interface utilisateur du blog |
| **Mailpit (Web UI)** | `http://localhost:8025` | Client Web d'inspection des e-mails |
| **PostgreSQL** | `localhost:5432` | Instance de base de données |

---

## Commandes de Maintenance

### Exécution des commandes Artisan

Toute commande Laravel doit être exécutée à l'intérieur du conteneur `app` :

```bash
# Exécuter les migrations manuellement
docker compose exec app php artisan migrate

# Réinitialiser la base de données
docker compose exec app php artisan migrate:fresh

# Lister les routes de l'application
docker compose exec app php artisan route:list
```

### Gestion des Conteneurs

```bash
# Arrêter les services sans supprimer les données
docker compose stop

# Arrêter et supprimer les conteneurs et les réseaux
docker compose down

# Consulter les journaux d'exécution (logs)
docker compose logs -f app
```
