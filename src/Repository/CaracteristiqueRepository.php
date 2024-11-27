<?php

namespace App\Repository;

use App\Entity\Caracteristique;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class CaracteristiqueRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Caracteristique::class);
    }

    public function findByVehicule(int $vehiculeId): array
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.vehicule = :vehiculeId')
            ->setParameter('vehiculeId', $vehiculeId)
            ->orderBy('c.nom', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function findByNomAndVehicule(string $nom, int $vehiculeId): ?Caracteristique
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.vehicule = :vehiculeId')
            ->andWhere('c.nom = :nom')
            ->setParameter('vehiculeId', $vehiculeId)
            ->setParameter('nom', $nom)
            ->getQuery()
            ->getOneOrNullResult();
    }
}