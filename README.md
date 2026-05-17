# 🦷 SmileCare - Système de gestion de clinique dentaire

SmileCare est une application Web développée avec **Laravel** dans le cadre du projet intégrateur du programme **Techniques de l'informatique** au Cégep de Sherbrooke. Elle permet à une clinique dentaire de gérer ses utilisateurs (dentistes, réceptionnistes, administrateurs), ses rendez-vous, ses paiements et ses services/traitements, le tout depuis une interface Web sécurisée.

---

## 👥 Équipe 3 — Groupe 4218

| Membre | Initiales | Grandes fonctionnalités développées |
|---|---|---|
| **Sèdrick Zahn** | SZT | Structure du projet Laravel & Docker, gestion des rendez-vous (CRUD complet), validations RegEx, requêtes asynchrones (fetch), middlewares, API des rendez-vous |
| **Bernardo Gonçalves da Cruz** | BGDC | Pages d'authentification, gestion des traitements/services (CRUD complet), CSS des pages de services, API des services |
| **Abdoulaye Dembele** | AD | Authentification avec MFA par courriel, gestion des paiements (CRUD complet), API des paiements, recherche asynchrone (fetch), envoi de courriels |
| **Alexandre Doe-Langevin** | ADL | Structure de la base de données, gestion des utilisateurs (CRUD complet), header & menu latéral, page des quarts de travail, API des utilisateurs |

---

## ✅ Fonctionnalités implémentées

### Gestion des utilisateurs
- Ajouter, lister, chercher, modifier et supprimer un utilisateur
- Activation / désactivation d'un compte
- Affichage des quarts de travail (punch in / punch out)

### Gestion des rendez-vous
- Ajouter, lister, chercher, modifier et supprimer un rendez-vous
- Messages flash de confirmation
- Barre de recherche asynchrone (fetch)

### Gestion des paiements
- Ajouter, lister, chercher, modifier et consulter un paiement
- Affichage du nom du client et de la date/heure du rendez-vous associé
- Barre de recherche asynchrone (fetch)

### Gestion des traitements / services
- Ajouter, lister, consulter, modifier et supprimer un traitement/service
- Activation / désactivation d'un service

### Authentification
- Login avec MFA (authentification à multiples facteurs par lien courriel)
- Changement de mot de passe avec confirmation MFA
- Récupération de mot de passe
- Gestion des rôles (Admin, Dentiste, Réceptionniste)

### API REST
- Authentification par token (Laravel Sanctum)
- Endpoints pour les utilisateurs, rendez-vous, paiements et services
- Middlewares de protection selon les rôles

### Autres
- Envoi de courriels personnalisés
- Validations RegEx côté JavaScript et PHP sur tous les formulaires
- Interface responsive avec TailwindCSS
- Backup automatique journalier

---

## 🔌 API REST

L'API permet à l'application mobile de communiquer avec le serveur. Elle utilise **Laravel Sanctum** pour l'authentification par token.

### Authentification

| Méthode | Endpoint | Description |
|---|---|---|
| `POST` | `/api/login` | Obtenir un token d'accès |
| `POST` | `/api/logout` | Révoquer le token |

### Utilisateurs

| Méthode | Endpoint | Description |
|---|---|---|
| `GET` | `/api/users` | Lister tous les utilisateurs |
| `GET` | `/api/users/{id}` | Consulter un utilisateur |
| `POST` | `/api/users` | Ajouter un utilisateur |
| `PUT` | `/api/users/{id}` | Modifier un utilisateur |

### Rendez-vous

| Méthode | Endpoint | Description |
|---|---|---|
| `GET` | `/api/rendezvous` | Lister tous les rendez-vous |
| `GET` | `/api/rendezvous/{id}` | Consulter un rendez-vous |
| `POST` | `/api/rendezvous` | Ajouter un rendez-vous |
| `PUT` | `/api/rendezvous/{id}` | Modifier un rendez-vous |
| `DELETE` | `/api/rendezvous/{id}` | Supprimer un rendez-vous |

### Paiements

| Méthode | Endpoint | Description |
|---|---|---|
| `GET` | `/api/paiements` | Lister tous les paiements |
| `GET` | `/api/paiements/{id}` | Consulter un paiement |
| `POST` | `/api/paiements` | Ajouter un paiement |
| `PUT` | `/api/paiements/{id}` | Modifier un paiement |

### Services / Traitements

| Méthode | Endpoint | Description |
|---|---|---|
| `GET` | `/api/services` | Lister tous les services |
| `GET` | `/api/services/{id}` | Consulter un service |
| `POST` | `/api/services/store` | Ajouter un service |
| `PUT` | `/api/services/update/{id}` | Modifier un service |

> **Note :** Toutes les routes API (sauf login) requièrent un header `Authorization: Bearer {token}`.  
> Pour tester l'API, utilisez **Postman** en pointant sur `http://localhost/api/...`.

---

## 🚀 Étapes pour faire fonctionner le projet

### 1. Se connecter à WSL depuis Visual Studio Code

**Prérequis (une seule fois sur Windows)**
- WSL installé avec la distro **Ubuntu** (normalement déjà fait sur Docker pour les labs).

**Dans VS Code**
- Ouvrez la palette de commandes : `Ctrl+Shift+P`.
- Exécutez **`WSL: Connect to WSL using Distro...`** puis choisissez **Ubuntu**.
- Attendez que la fenêtre se reconnecte : la barre d'état en bas à gauche doit afficher **`WSL: Ubuntu`** (icône verte).

**Ouvrir ce projet depuis le bon système de fichiers**
- `Fichier` → `Ouvrir un dossier...` (`Ctrl+K` `Ctrl+O`) et naviguez sous **`/home/www`**.

---

### 2. Aller dans le bon dossier
```bash
cd /home/www/
```

---

### 3. Cloner le dépôt
```bash
git clone https://github.com/5edrickk/Smile-Care.git
```

---

### 4. Entrer dans le dossier du projet
```bash
cd Smile-Care
```

---

### 5. Copier le fichier d'environnement
```bash
cp .env.example .env
```

---

### 6. Configurer les variables d'environnement
Copiez les variables d'environnement depuis Discord dans le fichier `.env`.

---

### 7. Fermer le conteneur Docker des laboratoires
Fermez le conteneur Docker utilisé pour les laboratoires (Laravel) avant de continuer.

---

### 8. Construire l'image Docker
```bash
docker compose -f compose.dev.yaml build --no-cache
```

---

### 9. Démarrer les conteneurs
```bash
docker compose -f compose.dev.yaml up -d
```

---

### 10. Entrer dans l'environnement Linux
```bash
docker compose -f compose.dev.yaml exec workspace bash
```

Vous devriez voir l'invite `www@user:...`.

---

### 11. Installer les dépendances et initialiser la base de données
```bash
composer install
composer update
npx @tailwindcss/upgrade --force
npm install
npm run build
npm run dev
php artisan migrate:fresh
php artisan migrate --seed
```

---

## 🔧 Pistes d'amélioration

- **Définir et modifier les horaires des employés** — la gestion complète des quarts de travail (assignation, modification) n'a pas été entièrement complétée.
- **Suppression de compte complète** — la fonctionnalité est présente mais mériterait des tests plus approfondis.
- **Aide en ligne** — une section d'aide contextuelle pourrait être ajoutée pour les nouveaux employés.
- **Notifications en temps réel** — utiliser des WebSockets (ex. : Laravel Echo) pour notifier les employés lors d'un nouveau rendez-vous.
- **Tableau de bord statistique** — afficher des graphiques sur les paiements, les rendez-vous et l'achalandage de la clinique.
- **Gestion des médicaments/ordonnances** — la table est présente en base de données mais l'interface Web n'a pas été développée.
- **Support multilingue** — ajouter le support de l'anglais pour les utilisateurs anglophones.
- **Tests automatisés** — ajouter des tests unitaires et fonctionnels avec PHPUnit pour sécuriser les futures modifications.

---

## 🛠️ Technologies utilisées

| Technologie | Utilisation |
|---|---|
| **Laravel 11** | Framework PHP (MVC) |
| **TailwindCSS 4** | Styles et mise en page |
| **Alpine.js** | Composants interactifs (modals) |
| **MySQL** | Base de données relationnelle |
| **Docker** | Environnement de développement |
| **Laravel Sanctum** | Authentification API par token |
| **MailHog** | Envoi et test de courriels en local (MFA, notifications) |
| **Postman** | Test de l'API REST |
| **Git / GitHub** | Gestion de version et collaboration |
