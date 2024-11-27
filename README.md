Système de Gestion de Véhicules

Application Symfony 7 permettant la gestion de véhicules et de leurs propriétaires.


Installation

1. Cloner le projet
   
   git clone <URL_DU_REPO>

2. Installer les dépendances PHP
   
   composer install

3. Installer les dépendances JavaScript
 
   npm install
   
   npm run build

4. Configurer la base de données

Copier le fichier .env en .env.local :

cp .env .env.local

Modifier la ligne DATABASE_URL dans .env.local avec vos informations :

Copier DATABASE_URL="mysql://votre_user:votre_password@127.0.0.1:3306/vehicle_store?serverVersion=8.0.32&charset=utf8mb4"

Créer la base de données :

php bin/console doctrine:database:create

Exécuter les migrations :

php bin/console doctrine:migrations:migrate

5. Charger les données de test (fixtures)

php bin/console doctrine:fixtures:load


6. Compiler les assets
   
   Pour le développement avec recompilation automatique :
   
   npm run watch
   
   Pour la production :
   
   npm run build

7. Démarrer le serveur
   
   Avec Symfony CLI :

   symfony serve
   
   Ou avec le serveur PHP intégré :
   bphp -S localhost:8000 -t public/
   
   Connexion à l'application
   
   Après avoir chargé les fixtures, vous pouvez vous connecter avec les identifiants suivants :
   
   Email : admin@example.com
   Mot de passe : admin123

