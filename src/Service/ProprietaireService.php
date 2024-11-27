<?php

namespace App\Service;

use App\Entity\Proprietaire;
use Doctrine\ORM\EntityManagerInterface;

class ProprietaireService
{

    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function findAllProprietaires()
    {
        return $this->entityManager->getRepository(Proprietaire::class)->findAll();
    }
}