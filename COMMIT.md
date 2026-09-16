# Convention de Commit - Docker Training

Pour maintenir un historique Git clair et lisible dans ce monorepo, nous respectons la norme **Conventional Commits**.

## Format d'un message

---

## 1. Types autorisés

- **`feat`** : Nouvelle fonctionnalité
- **`fix`** : Correction d'un bug
- **`docs`** : Modification de la documentation (ex: README, COMMIT.md)
- **`style`** : Formatting, point-virgule manquant, indentation (sans impact sur la logique)
- **`refactor`** : Refactorisation de code sans ajout de fonction ou correction de bug
- **`test`** : Ajout ou modification de tests unitaires ou d'intégration
- **`chore`** : Mise à jour de dépendances, configurations de build, scripts utilitaires

---

## 2. Scopes recommandés

Précisez le sous-projet concerné entre parenthèses :

- `(laravel)` : Pour les modifications relatives au projet Laravel
- `(django)` : Pour le projet Django
- `(fastapi)` : Pour le projet FastAPI
- `(nodejs)` : Pour le projet Node.js
- `(docker)` : Pour la configuration globale Docker / Docker Compose
- `(root)` : Pour les fichiers à la racine (`.gitignore`, `README.md`, etc.)

---

## 3. Exemples de commits valides

- `feat(laravel): ajout du scope de recherche full-text postgresql`
- `feat(laravel): implémentation du CRUD d'articles avec téléchargement d'images`
- `fix(django): correction de la connexion à la base de données`
- `docs(root): mise à jour de la documentation principale et ajout des règles de commit`
- `chore(docker): mise à jour de l'image base php-fpm vers 8.2`
- `test(fastapi): ajout des tests unitaires sur la route /health`