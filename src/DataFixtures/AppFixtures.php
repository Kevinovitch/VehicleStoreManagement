<?php

namespace App\DataFixtures;

use App\Entity\Caracteristique;
use App\Entity\Proprietaire;
use App\Entity\User;
use App\Entity\Vehicule;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function __construct(
        private UserPasswordHasherInterface $passwordHasher
    ) {
    }

    public function load(ObjectManager $manager): void
    {
        // Créer un utilisateur admin
        $admin = new User();
        $admin->setEmail('admin@example.com')
            ->setRoles(['ROLE_ADMIN'])
            ->setPassword($this->passwordHasher->hashPassword($admin, 'admin123'));

        $manager->persist($admin);

        // Créer des propriétaires
        $proprietaires = [];
        $prenoms = ['Jean', 'Marie', 'Pierre', 'Sophie', 'Paul'];
        $noms = ['Dupont', 'Martin', 'Durand', 'Lefebvre', 'Moreau'];

        foreach ($prenoms as $i => $prenom) {
            $proprietaire = new Proprietaire();
            $proprietaire->setNom($noms[$i])
                ->setPrenom($prenom)
                ->setEmail(strtolower($prenom . '.' . $noms[$i] . '@example.com'));

            $proprietaires[] = $proprietaire;
            $manager->persist($proprietaire);
        }

        // Créer des véhicules
        $marques = ['Renault', 'Peugeot', 'Citroën', 'Volkswagen', 'BMW'];
        $modeles = ['Clio', '208', 'C3', 'Golf', 'Serie 3'];

        foreach ($proprietaires as $proprietaire) {
            $nbVehicules = rand(1, 3);

            for ($i = 0; $i < $nbVehicules; $i++) {
                $marqueIndex = array_rand($marques);

                $vehicule = new Vehicule();
                $vehicule->setMarque($marques[$marqueIndex])
                    ->setModele($modeles[$marqueIndex])
                    ->setDateImmatriculation(new \DateTime('-' . rand(1, 60) . ' months'))
                    ->setNumeroImmatriculation(sprintf('AA-%03d-BB', rand(100, 999)))
                    ->setProprietaire($proprietaire);

                // Ajouter des caractéristiques
                $caracteristiques = [
                    ['Nombre de portes', (rand(0, 1) ? '3' : '5')],
                    ['Énergie', ['Essence', 'Diesel', 'Électrique'][rand(0, 2)]],
                    ['Boîte de vitesse', ['Manuelle', 'Automatique'][rand(0, 1)]]
                ];

                foreach ($caracteristiques as [$nom, $valeur]) {
                    $caracteristique = new Caracteristique();
                    $caracteristique->setNom($nom)
                        ->setValeur($valeur)
                        ->setVehicule($vehicule);

                    $manager->persist($caracteristique);
                }

                $manager->persist($vehicule);
            }
        }

        $manager->flush();
    }
}
