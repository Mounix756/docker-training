# Docker Training Repository

Bienvenue dans le dépôt **Docker Training**. Ce projet regroupe différentes expérimentations de conteneurisation d'applications web modernes avec Docker et Docker Compose.

---

## Structure du Dépôt

| Dossier / Fichier | Description |
| :--- | :--- |
| **`laravel/`** | Application de blog Laravel avec PostgreSQL, système de recherche textuelle et notifications par mail |
| **`django/`** | Microservice / Application Python avec Django |
| **`fastapi/`** | API haute performance avec Python et FastAPI |
| **`nodejs/`** | Service / API avec Node.js |
| **`COMMIT.md`** | Normes et règles de commits du projet |
| **`README.md`** | Documentation générale du dépôt |

---

## Projets inclus

### 1. Blog Laravel (`/laravel`)
- **Framework** : Laravel 10+
- **Base de données** : PostgreSQL 15 (avec Full-Text Search)
- **Serveur de Mail** : Mailpit (SMTP local pour le développement)
- **Fonctionnalités** :
  - CRUD d'articles sans authentification.
  - Galerie d'images associées (jusqu'à 4 images par article).
  - Envoi automatique de mails aux abonnés lors de la publication.
  - Moteur de recherche rapide basé sur `to_tsvector`.

#### Démarrage rapide du projet Laravel :
```bash
cd laravel
docker compose up -d --build