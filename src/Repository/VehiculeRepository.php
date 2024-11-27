<?php

namespace App\Repository;

use App\Entity\Vehicule;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

class VehiculeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Vehicule::class);
    }

    public function search(?string $query = null, ?int $proprietaireId = null, ?string $sortBy = null, string $order = 'ASC'): array
    {
        $qb = $this->createQueryBuilder('v')
            ->leftJoin('v.proprietaire', 'p')
            ->addSelect('p')
            ->leftJoin('v.caracteristiques', 'c')
            ->addSelect('c');

        if ($query) {
            $qb->andWhere('v.marque LIKE :query')
                ->orWhere('v.modele LIKE :query')
                ->orWhere('v.numeroImmatriculation LIKE :query')
                ->orWhere('p.nom LIKE :query')
                ->orWhere('p.prenom LIKE :query')
                ->setParameter('query', '%' . $query . '%');
        }

        if ($proprietaireId) {
            $qb->andWhere('p.id = :proprietaireId')
                ->setParameter('proprietaireId', $proprietaireId);
        }

        // Gestion du tri
        switch ($sortBy) {
            case 'marque':
                $qb->orderBy('v.marque', $order);
                break;
            case 'modele':
                $qb->orderBy('v.modele', $order);
                break;
            case 'dateImmatriculation':
                $qb->orderBy('v.dateImmatriculation', $order);
                break;
            case 'proprietaire':
                $qb->orderBy('p.nom', $order)
                    ->addOrderBy('p.prenom', $order);
                break;
            default:
                $qb->orderBy('v.marque', 'ASC');
        }

        return $qb->getQuery()->getResult();
    }

    public function findWithFullDetails(int $id): ?Vehicule
    {
        return $this->createQueryBuilder('v')
            ->leftJoin('v.proprietaire', 'p')
            ->addSelect('p')
            ->leftJoin('v.caracteristiques', 'c')
            ->addSelect('c')
            ->where('v.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function findByProprietaire(int $proprietaireId): array
    {
        return $this->createQueryBuilder('v')
            ->leftJoin('v.caracteristiques', 'c')
            ->addSelect('c')
            ->where('v.proprietaire = :proprietaireId')
            ->setParameter('proprietaireId', $proprietaireId)
            ->orderBy('v.dateImmatriculation', 'DESC')
            ->getQuery()
            ->getResult();
    }

    public function getStatisticsParProprietaire(): array
    {
        return $this->createQueryBuilder('v')
            ->select('p.nom', 'p.prenom', 'COUNT(v.id) as nbVehicules')
            ->leftJoin('v.proprietaire', 'p')
            ->groupBy('p.id')
            ->orderBy('nbVehicules', 'DESC')
            ->getQuery()
            ->getResult();
    }
}