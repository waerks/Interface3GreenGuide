## Cloner le projet
````powershell
git clone https://github.com/waerks/Interface3GreenGuide.git symfonyGreenGuide
````

## Naviguer dans le dossier du projet
````powershell
cd symfonyGreenGuide
````

## Installer les dépendances via Composer
````posershell
composer install
````

## Créer la base de données
````powershell
symfony console doctrine:database:create
````

## Exécuter les migrations (si nécessaire)
````powershell
symfony console doctrine:migrations:migrate
````

## Lancer le serveur de développement Symfony
````powershell
symfony serve
````