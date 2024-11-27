<?php

namespace App\Repository;

use App\Entity\Proprietaire;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class ProprietaireRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Proprietaire::class);
    }

    public function findAllWithVehicules(): array
    {
        return $this->createQueryBuilder('p')
            ->leftJoin('p.vehicules', 'v')
            ->addSelect('v')
            ->orderBy('p.nom', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function search(string $query): array
    {
        return $this->createQueryBuilder('p')
            ->where('p.nom LIKE :query')
            ->orWhere('p.prenom LIKE :query')
            ->orWhere('p.email LIKE :query')
            ->setParameter('query', '%' . $query . '%')
            ->orderBy('p.nom', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function countVehicules(int $proprietaireId): int
    {
        return $this->createQueryBuilder('p')
            ->select('COUNT(v.id)')
            ->leftJoin('p.vehicules', 'v')
            ->where('p.id = :id')
            ->setParameter('id', $proprietaireId)
            ->getQuery()
            ->getSingleScalarResult();
    }
}