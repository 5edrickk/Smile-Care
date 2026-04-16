## Étapes pour faire fonctionner le projet

1. Connectez-vous à WSL depuis **Visual Studio Code** (recommandé : WSL 2 avec la distro **Ubuntu**).

    **Prérequis (une seule fois sur Windows)**
    - WSL installé et une distro Ubuntu disponible (Normalement c'est deja fait sur docker pour les labs).

    **Dans VS Code**
    - Ouvrez la palette de commandes : `Ctrl+Shift+P`.
    - Exécutez **`WSL: Connect to WSL using Distro...`** puis choisissez **Ubuntu**.
    - Attendez que la fenêtre se reconnecte : la barre d’état en bas à gauche doit afficher **`WSL: Ubuntu`** (icône verte). Vous êtes alors dans un VS Code attaché à Linux.

    **Ouvrir ce projet depuis le bon système de fichiers**
    - `Fichier` → `Ouvrir un dossier...` (ou `Ctrl+K` `Ctrl+O`) et naviguez sous le chemin Linux, par ex. **`/home/www`**.

---

2. Dans un terminal **Ubuntu (WSL)** intégré à VS Code (`Terminal` → `Nouveau terminal`), exécutez la commande suivante :

```
cd /home/www/
```

---

3. Clonez le dépôt :

```
git clone https://github.com/5edrickk/SmileCare.git
```

---

4. Entrez dans le dossier du projet :

```
cd SmileCare
```

---

5. Copiez le fichier d’exemple :

```
cp .env.example .env
```

---

6. Copiez les variables d’environnement de Discord dans le `.env`.

---

7. Fermez le conteneur Docker qu’on utilise pour les laboratoires (Laravel).

---

8. Exécutez la commande suivante :

```
docker compose -f compose.dev.yaml build --no-cache
```

---

9. Quand la commande est terminée, lancez la commande suivante :

```
docker compose -f compose.dev.yaml up -d
```

---

10. Puis, entrez dans l’environnement Linux :

```
docker compose -f compose.dev.yaml exec workspace bash
```

---

11. Vous devriez être connecté à l’environnement Linux `"www@user:blabla"`.

---

12. Faites :

```
composer install
composer update
npx @tailwindcss/upgrade --force
npm install
php artisan migrate:fresh
```
