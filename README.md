Système de Gestion de Véhicules

Application Symfony 7 permettant la gestion de véhicules et de leurs propriétaires.
Prérequis

PHP 8.2 ou supérieur
Composer
Node.js et npm
MySQL/MariaDB
Symfony CLI (optionnel mais recommandé)

Installation

1. Cloner le projet
   bashCopygit clone <URL_DU_REPO>
   cd VehicleStoreManagement

2. Installer les dépendances PHP
   bashCopycomposer install

3. Installer les dépendances JavaScript
   bashCopynpm install
   npm run build

4. Configurer la base de données

Copier le fichier .env en .env.local :

bashCopycp .env .env.local

Modifier la ligne DATABASE_URL dans .env.local avec vos informations :

CopyDATABASE_URL="mysql://votre_user:votre_password@127.0.0.1:3306/vehicle_store?serverVersion=8.0.32&charset=utf8mb4"

Créer la base de données :

bashCopyphp bin/console doctrine:database:create

Exécuter les migrations :

bashCopyphp bin/console doctrine:migrations:migrate
5. Charger les données de test (fixtures)
   bashCopyphp bin/console doctrine:fixtures:load
6. Compiler les assets
   Pour le développement avec recompilation automatique :
   bashCopynpm run watch
   Pour la production :
   bashCopynpm run build
7. Démarrer le serveur
   Avec Symfony CLI :
   bashCopysymfony serve
   Ou avec le serveur PHP intégré :
   bashCopyphp -S localhost:8000 -t public/
   Connexion à l'application
   Après avoir chargé les fixtures, vous pouvez vous connecter avec les identifiants suivants :
   CopyEmail : admin@example.com
   Mot de passe : admin123
   Structure du projet

src/Controller/ : Contrôleurs de l'application
src/Entity/ : Entités Doctrine
src/Repository/ : Repositories pour l'accès aux données
templates/ : Templates Twig
assets/ : Fichiers JavaScript et SCSS

Fonctionnalités principales

Gestion des propriétaires (CRUD)
Gestion des véhicules et leurs caractéristiques
Interface responsive
Système de recherche et filtrage
Statistiques véhicules/propriétaires
Authentication et autorisation