🦷 SmileCare — Système de gestion de clinique dentaire
SmileCare est une application Web développée avec Laravel dans le cadre du projet intégrateur du programme Techniques de l'informatique au Cégep de Sherbrooke. Elle permet à une clinique dentaire de gérer ses utilisateurs (dentistes, réceptionnistes, administrateurs), ses rendez-vous, ses paiements et ses services/traitements, le tout depuis une interface Web sécurisée.

👥 Équipe 3 — Groupe 4218
MembreInitialesGrandes fonctionnalités développéesSèdrick ZahnSZTStructure du projet Laravel & Docker, gestion des rendez-vous (CRUD complet), validations RegEx, requêtes asynchrones (fetch), middlewares, API des rendez-vousBernardo Gonçalves da CruzBGDCPages d'authentification, gestion des traitements/services (CRUD complet), CSS des pages de services, API des servicesAbdoulaye DembeleADAuthentification avec MFA par courriel, gestion des paiements (CRUD complet), API des paiements, recherche asynchrone (fetch), envoi de courrielsAlexandre Doe-LangevinADLStructure de la base de données, gestion des utilisateurs (CRUD complet), header & menu latéral, page des quarts de travail, API des utilisateurs

✅ Fonctionnalités implémentées
Gestion des utilisateurs

Ajouter, lister, chercher, modifier et supprimer un utilisateur
Activation / désactivation d'un compte
Affichage des quarts de travail (punch in / punch out)

Gestion des rendez-vous

Ajouter, lister, chercher, modifier et supprimer un rendez-vous
Messages flash de confirmation
Barre de recherche asynchrone (fetch)

Gestion des paiements

Ajouter, lister, chercher, modifier et consulter un paiement
Affichage du nom du client et de la date/heure du rendez-vous associé
Barre de recherche asynchrone (fetch)

Gestion des traitements / services

Ajouter, lister, consulter, modifier et supprimer un traitement/service
Activation / désactivation d'un service

Authentification

Login avec MFA (authentification à multiples facteurs par lien courriel)
Changement de mot de passe avec confirmation MFA
Récupération de mot de passe
Gestion des rôles (Admin, Dentiste, Réceptionniste)

API REST

Authentification par token (Laravel Sanctum)
Endpoints pour les utilisateurs, rendez-vous, paiements et services
Middlewares de protection selon les rôles

Autres

Envoi de courriels personnalisés
Validations RegEx côté JavaScript et PHP sur tous les formulaires
Interface responsive avec TailwindCSS
Backup automatique journalier


🔌 API REST
L'API permet à l'application mobile de communiquer avec le serveur. Elle utilise Laravel Sanctum pour l'authentification par token.
Authentification
MéthodeEndpointDescriptionPOST/api/loginObtenir un token d'accèsPOST/api/logoutRévoquer le token
Utilisateurs
MéthodeEndpointDescriptionGET/api/usersLister tous les utilisateursGET/api/users/{id}Consulter un utilisateurPOST/api/usersAjouter un utilisateurPUT/api/users/{id}Modifier un utilisateur
Rendez-vous
MéthodeEndpointDescriptionGET/api/rendezvousLister tous les rendez-vousGET/api/rendezvous/{id}Consulter un rendez-vousPOST/api/rendezvousAjouter un rendez-vousPUT/api/rendezvous/{id}Modifier un rendez-vousDELETE/api/rendezvous/{id}Supprimer un rendez-vous
Paiements
MéthodeEndpointDescriptionGET/api/paiementsLister tous les paiementsGET/api/paiements/{id}Consulter un paiementPOST/api/paiementsAjouter un paiementPUT/api/paiements/{id}Modifier un paiement
Services / Traitements
MéthodeEndpointDescriptionGET/api/servicesLister tous les servicesGET/api/services/{id}Consulter un servicePOST/api/servicesAjouter un servicePUT/api/services/{id}Modifier un service

Note : Toutes les routes API (sauf login) requièrent un header Authorization: Bearer {token}.
Pour tester l'API, utilisez Postman en pointant sur http://localhost/api/....


🚀 Étapes pour faire fonctionner le projet
1. Se connecter à WSL depuis Visual Studio Code
Prérequis (une seule fois sur Windows)

WSL installé avec la distro Ubuntu (normalement déjà fait sur Docker pour les labs).

Dans VS Code

Ouvrez la palette de commandes : Ctrl+Shift+P.
Exécutez WSL: Connect to WSL using Distro... puis choisissez Ubuntu.
Attendez que la fenêtre se reconnecte : la barre d'état en bas à gauche doit afficher WSL: Ubuntu (icône verte).

Ouvrir ce projet depuis le bon système de fichiers

Fichier → Ouvrir un dossier... (Ctrl+K Ctrl+O) et naviguez sous /home/www.


2. Aller dans le bon dossier
bashcd /home/www/

3. Cloner le dépôt
bashgit clone https://github.com/5edrickk/Smile-Care.git

4. Entrer dans le dossier du projet
bashcd Smile-Care

5. Copier le fichier d'environnement
bashcp .env.example .env

6. Configurer les variables d'environnement
Copiez les variables d'environnement depuis Discord dans le fichier .env.

7. Fermer le conteneur Docker des laboratoires
Fermez le conteneur Docker utilisé pour les laboratoires (Laravel) avant de continuer.

8. Construire l'image Docker
bashdocker compose -f compose.dev.yaml build --no-cache

9. Démarrer les conteneurs
bashdocker compose -f compose.dev.yaml up -d

10. Entrer dans l'environnement Linux
bashdocker compose -f compose.dev.yaml exec workspace bash
Vous devriez voir l'invite www@user:....

11. Installer les dépendances et initialiser la base de données
bashcomposer install
composer update
npx @tailwindcss/upgrade --force
npm install
npm run build
npm run dev
php artisan migrate:fresh
php artisan migrate --seed

🔧 Pistes d'amélioration

Définir et modifier les horaires des employés — la gestion complète des quarts de travail (assignation, modification) n'a pas été entièrement complétée.
Suppression de compte complète — la fonctionnalité est présente mais mériterait des tests plus approfondis.
Aide en ligne — une section d'aide contextuelle pourrait être ajoutée pour les nouveaux employés.
Notifications en temps réel — utiliser des WebSockets (ex. : Laravel Echo) pour notifier les employés lors d'un nouveau rendez-vous.
Tableau de bord statistique — afficher des graphiques sur les paiements, les rendez-vous et l'achalandage de la clinique.
Gestion des médicaments/ordonnances — la table est présente en base de données mais l'interface Web n'a pas été développée.
Support multilingue — ajouter le support de l'anglais pour les utilisateurs anglophones.
Tests automatisés — ajouter des tests unitaires et fonctionnels avec PHPUnit pour sécuriser les futures modifications.


🛠️ Technologies utilisées
TechnologieUtilisationLaravel 11Framework PHP (MVC)TailwindCSS 4Styles et mise en pageAlpine.jsComposants interactifs (modals)MySQLBase de données relationnelleDockerEnvironnement de développementLaravel SanctumAuthentification API par tokenMailtrap / SMTPEnvoi de courriels (MFA, notifications)PostmanTest de l'API RESTGit / GitHubGestion de version et collaboration
