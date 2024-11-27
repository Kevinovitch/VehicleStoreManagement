<?php

namespace App\Service;

use App\Entity\Vehicule;
use Doctrine\ORM\EntityManagerInterface;


class VehiculeService
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function findAllVehicules()
    {
        return $this->entityManager->getRepository(Vehicule::class)->findAll();
    }

    public function searchVehicles($search, $proprietaireId, $sortBy, $order)
    {
        return $this->entityManager->getRepository(Vehicule::class)->search($search, $proprietaireId, $sortBy, $order);
    }
}